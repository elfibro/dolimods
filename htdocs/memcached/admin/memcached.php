<?php
/* Copyright (C) 2010 Laurent Destailleur  <eldy@users.sourceforge.net>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA 02111-1307, USA.
 */

/**
 *     \file       htdocs/memcached/admin/memcached.php
 *     \brief      Page administration de memcached
 *     \version    $Id: memcached.php,v 1.15 2011/01/16 13:30:09 eldy Exp $
 */

$res=0;
if (! $res && file_exists("../main.inc.php")) $res=@include("../main.inc.php");
if (! $res && file_exists("../../main.inc.php")) $res=@include("../../main.inc.php");
if (! $res && file_exists("../../../dolibarr/htdocs/main.inc.php")) $res=@include("../../../dolibarr/htdocs/main.inc.php");     // Used on dev env only
if (! $res && file_exists("../../../../dolibarr/htdocs/main.inc.php")) $res=@include("../../../../dolibarr/htdocs/main.inc.php");   // Used on dev env only
if (! $res && file_exists("../../../../../dolibarr/htdocs/main.inc.php")) $res=@include("../../../../../dolibarr/htdocs/main.inc.php");   // Used on dev env only
if (! $res) die("Include of main fails");
$res=dol_include_once("/memcached/lib/memcached.lib.php");
require_once(DOL_DOCUMENT_ROOT."/lib/admin.lib.php");

// Security check
if (!$user->admin)
accessforbidden();
if (! empty($dolibarr_memcached_view_disable))	// Hidden variable to add to conf file to disable browsing
accessforbidden();

$langs->load("admin");
$langs->load("errors");
$langs->load("install");
$langs->load("memcached@memcached");

//exit;

/*
 * Actions
 */
if ($_POST["action"] == 'set')
{
	$error=0;
	if (! $error)
	{
		dolibarr_set_const($db,"MEMCACHED_SERVER",$_POST["MEMCACHED_SERVER"],'chaine',0,'',$conf->entity);
	}
}




/*
 * View
 */

$html=new Form($db);

$help_url="EN:Module_MemCached_En|FR:Module_MemCached|ES:M&oacute;dulo_MemCached";
llxHeader("",$langs->trans("MemcachedSetup"),$help_url);

$linkback='<a href="'.DOL_URL_ROOT.'/admin/modules.php">'.$langs->trans("BackToModuleList").'</a>';
print_fiche_titre($langs->trans('MemcachedSetup'),$linkback,'setup');

$head=memcached_prepare_head();
dol_fiche_head($head, 'serversetup', $langs->trans("MemCached"));

print $langs->trans("MemcachedDesc")."<br>\n";
print "<br>\n";

$error=0;

// Check prerequisites
if (! class_exists("Memcache") && ! class_exists("Memcached"))
{
	print '<div class="error">';
	//var_dump($langs->tab_translate['ClientNotFound']);
	//var_dump($langs->trans('ClientNotFound'));
	print $langs->trans("ClientNotFound");
	print '</div>';
	$error++;
}
else
{
	print $langs->trans("MemcachedClient","Memcached").': ';
	if (class_exists("Memcached")) print $langs->trans("Available");
	else print $langs->trans("NotAvailable");
	print '<br>';
	print $langs->trans("MemcachedClient","Memcache").': ';
	if (class_exists("Memcache")) print $langs->trans("Available");
	else print $langs->trans("NotAvailable");
	print '<br>';
	if (class_exists("Memcached") && class_exists("Memcache")) print $langs->trans("MemcachedClientBothAvailable",'Memcached').'<br>';
	else if (class_exists("Memcached")) print $langs->trans("OnlyClientAvailable",'Memcached').'<br>';
	else if (class_exists("Memcache")) print $langs->trans("OnlyClientAvailable",'Memcache').'<br>';
}
print '<br>';


// Param
$var=true;
print '<form action="'.$_SERVER["PHP_SELF"].'" method="post">';
print '<input type="hidden" name="token" value="'.$_SESSION['newtoken'].'">';
print '<input type="hidden" name="action" value="set">';

print '<table class="noborder" width="100%">';
print '<tr class="liste_titre">';
print '<td>'.$langs->trans("Parameter").'</td><td>'.$langs->trans("Value").'</td>';
print '<td>'.$langs->trans("Examples").'</td>';
print '<td align="right"><input type="submit" class="button" value="'.$langs->trans("Modify").'"></td>';
print "</tr>\n";

$var=!$var;
print '<tr '.$bc[$var].'><td>'.$langs->trans("Server").':'.$langs->trans("Port").'</td>';
print '<td>';
print '<input size="40" type="text" name="MEMCACHED_SERVER" value="'.$conf->global->MEMCACHED_SERVER.'">';
print '</td>';
print '<td>127.0.0.1:11211<br>localhost:11211</td>';
print '<td>&nbsp;</td>';
print '</tr>';

print '</table>';

print "</form>\n";

print '</div>';


if (! $error)
{
	if (class_exists("Memcached")) $m=new Memcached();
	elseif (class_exists("Memcache")) $m=new Memcache();
	else dol_print_error('','Should not happen');

	if (! empty($conf->global->MEMCACHED_SERVER))
	{
    	$tmparray=explode(':',$conf->global->MEMCACHED_SERVER);
        $server=$tmparray[0];
        $port=$tmparray[1]?$tmparray[1]:11211;

    	dol_syslog("Try to connect to server ".$server." port ".$port." with class ".get_class($m));
    	$result=$m->addServer($server, $port);
    	//$m->setOption(Memcached::OPT_COMPRESSION, false);
        //print "xxx".$result;

    	// This action must be set here and not in actions to be sure all lang files are already loaded
    	if ($_GET["action"] == 'clear')
    	{
    		$error=0;
    		if (! $error)
    		{
    			$m->flush();

    			$mesg='<div class="ok">'.$langs->trans("Flushed").'</div>';
    		}
    	}

    	if ($mesg) print '<br>'.$mesg;


    	// Read cache
    	$arraycache=$m->getStats();
    	//var_dump($arraycache);
	}

	// Action
	print '<div class="tabsAction">';
	if (is_array($arraycache))
	{
		print '<a class="butAction" href="'.$_SERVER["PHP_SELF"].'?action=clear">'.$langs->trans("FlushCache").'</a>';
	}
	else
	{
		print '<a class="butActionRefused" href="#">'.$langs->trans("FlushCache").'</a>';
	}
	print '</div>';
	print '<br>';


	// Statistics of cache server
	print '<table class="noborder" width="60%">';
	print '<tr class="liste_titre"><td colspan="2">'.$langs->trans("Status").'</td></tr>';

	if (empty($conf->global->MEMCACHED_SERVER))
	{
		print '<tr><td colspan="2">'.$langs->trans("ConfigureParametersFirst").'</td></tr>';
	}
	else if (is_array($arraycache))
	{
		$newarraycache=array();
		if (class_exists("Memcached")) $newarraycache=$arraycache;
		else if (class_exists("Memcache")) $newarraycache[$conf->global->MEMCACHED_SERVER]=$arraycache;
		else dol_print_error('','Should not happen');

		foreach($newarraycache as $key => $val)
		{
			print '<tr '.$bc[0].'><td>'.$langs->trans("MemcachedServer").'</td>';
			print '<td>'.$key.'</td></tr>';

			print '<tr '.$bc[1].'><td>'.$langs->trans("Version").'</td>';
			print '<td>'.$val['version'].'</td></tr>';

			print '<tr '.$bc[0].'><td>'.$langs->trans("Status").'</td>';
			print '<td>'.$langs->trans("On").'</td></tr>';
		}
	}
	else
	{
		print '<tr><td colspan="2">'.$langs->trans("FailedToReadServer").' - Result code = '.$resultcode.'</td></tr>';
	}

	print '</table>';

}

llxfooter('$Date: 2011/01/16 13:30:09 $ - $Revision: 1.15 $');
?>