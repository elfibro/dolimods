<?php
/* Copyright (C) 2018 Laurent Destailleur <eldy@users.sourceforge.net>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

/**
 *      \file       htdocs/sellyoursaas/core/login/functions_sellyoursaas.php
 *      \ingroup    core
 *      \brief      Authentication functions for Sellyoursaas backoffice
 */


/**
 * Check validity of user/password/entity
 * If test is ko, reason must be filled into $_SESSION["dol_loginmesg"]
 *
 * @param	string	$usertotest		Login
 * @param	string	$passwordtotest	Password
 * @param   int		$entitytotest   Number of instance (always 1 if module multicompany not enabled)
 * @return	string					Login if OK, '' if KO
 */
function check_user_password_sellyoursaas($usertotest, $passwordtotest, $entitytotest)
{
	global $conf, $langs, $db;

	dol_syslog("functions_sellyoursaas::check_user_password_sellyoursaas usertotest=".$usertotest);

	$thirdparty = new Societe($db);
	$result = $thirdparty->fetch(0, '', '', '', '', '', '', '', '', '', $usertotest);

	if ($result <= 0)
	{
		$login='';
		$langs->load("errors");
		$_SESSION["dol_loginmesg"]=$langs->trans("ErrorBadLoginPassword");
	}
	else
	{
		$passwordtotest_crypted = dol_hash($passwordtotest, 2);

		if ($passwordtotest_crypted == $thirdparty->array_options['options_password'])
		{
			if (empty($conf->global->SELLYOURSAAS_ANONYMOUSUSER))
			{
				$login='';
				$langs->load("errors");
				$_SESSION["dol_loginmesg"]=$langs->trans("SellYourSaasSetupNotComplete");
			}
			else
			{
				$tmpuser = new User($db);
				$tmpuser->fetch($conf->global->SELLYOURSAAS_ANONYMOUSUSER);
				if ($tmpuser->login)
				{
					// Login is ok
					$_SESSION["dol_loginsellyoursaas"] = $thirdparty->id;
					return $tmpuser->login;
				}
			}
		}
		else
		{
			$login='';
			$langs->load("errors");
			$_SESSION["dol_loginmesg"]=$langs->trans("ErrorBadLoginPassword");
		}
	}

	return $login;
}
