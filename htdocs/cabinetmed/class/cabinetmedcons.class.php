<?php
/* Copyright (C) 2011 Laurent Destailleur  <eldy@users.sourceforge.net>
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
 *      \file       cabinetmed/class/cabinetmedcons.class.php
 *      \ingroup    cabinetmed
 *      \brief      This file is an example for a CRUD class file (Create/Read/Update/Delete)
 *		\version    $Id: cabinetmedcons.class.php,v 1.4 2011/05/01 10:52:46 eldy Exp $
 *		\remarks	Initialy built by build_class_from_table on 2011-02-02 22:30
 */

// Put here all includes required by your class file
require_once(DOL_DOCUMENT_ROOT."/core/class/commonobject.class.php");
//require_once(DOL_DOCUMENT_ROOT."/societe/class/societe.class.php");
//require_once(DOL_DOCUMENT_ROOT."/product/class/product.class.php");


/**
 *      \class      Cabinetmed_cons
 *      \brief      Put here description of your class
 *		\remarks	Initialy built by build_class_from_table on 2011-02-02 22:30
 */
class CabinetmedCons extends CommonObject
{
	var $db;							//!< To store db handler
	var $error;							//!< To return error code (or message)
	var $errors=array();				//!< To return several error codes (or messages)
	//var $element='cabinetmed_cons';			//!< Id that identify managed objects
	//var $table_element='cabinetmed_cons';	//!< Name of table without prefix where object is stored

	var $id;

	var $fk_soc;
	var $datecons='';
	var $typepriseencharge;
	var $motifconsprinc;
	var $diaglecprinc;
	var $motifconssec;
	var $diaglecsec;
	var $examenclinique;
	var $examenprescrit;
	var $traitementprescrit;
	var $comment;
	var $typevisit='CS';
	var $infiltration;
	var $codageccam;
	var $montant_cheque;
	var $montant_espece;
	var $montant_carte;
	var $montant_tiers;
	var $banque;
	var $num_cheque;



	/**
	 *      \brief      Constructor
	 *      \param      DB      Database handler
	 */
	function CabinetmedCons($DB)
	{
		$this->db = $DB;
		return 1;
	}


	/**
	 *      \brief      Create in database
	 *      \param      user        	User that create
	 *      \param      notrigger	    0=launch triggers after, 1=disable triggers
	 *      \return     int         	<0 if KO, Id of created object if OK
	 */
	function create($user, $notrigger=0)
	{
		global $conf, $langs;
		$error=0;

		// Clean parameters

		if (isset($this->fk_soc)) $this->fk_soc=trim($this->fk_soc);
		if (isset($this->typepriseencharge)) $this->typepriseencharge=trim($this->typepriseencharge);
		if (isset($this->motifconsprinc)) $this->motifconsprinc=trim($this->motifconsprinc);
		if (isset($this->diaglesprinc)) $this->diagles=trim($this->diaglesprinc);
		if (isset($this->motifconssec)) $this->motifconssec=trim($this->motifconssec);
		if (isset($this->diaglessec)) $this->diaglessec=trim($this->diaglessec);
		if (isset($this->examenclinique)) $this->examenclinique=trim($this->examenclinique);
		if (isset($this->examenprescrit)) $this->examenprescrit=trim($this->examenprescrit);
		if (isset($this->traitementprescrit)) $this->traitementprescrit=trim($this->traitementprescrit);
		if (isset($this->comment)) $this->comment=trim($this->comment);
		if (isset($this->typevisit)) $this->typevisit=trim($this->typevisit);
		if (isset($this->infiltration)) $this->infiltration=trim($this->infiltration);
		if (isset($this->codageccam)) $this->codageccam=trim($this->codageccam);
		if (isset($this->montant_cheque)) $this->montant_cheque=trim($this->montant_cheque);
		if (isset($this->montant_espece)) $this->montant_espece=trim($this->montant_espece);
		if (isset($this->montant_carte)) $this->montant_carte=trim($this->montant_carte);
		if (isset($this->montant_tiers)) $this->montant_tiers=trim($this->montant_tiers);
		if (isset($this->banque)) $this->banque=trim($this->banque);



		// Check parameters
		// Put here code to add control on parameters values

		// Insert request
		$sql = "INSERT INTO ".MAIN_DB_PREFIX."cabinetmed_cons(";

		$sql.= "fk_soc,";
		$sql.= "datecons,";
		$sql.= "typepriseencharge,";
		$sql.= "motifconsprinc,";
		$sql.= "diaglesprinc,";
		$sql.= "motifconssec,";
		$sql.= "diaglessec,";
		$sql.= "examenclinique,";
		$sql.= "examenprescrit,";
		$sql.= "traitementprescrit,";
		$sql.= "comment,";
		$sql.= "typevisit,";
		$sql.= "infiltration,";
		$sql.= "codageccam,";
		$sql.= "montant_cheque,";
		$sql.= "montant_espece,";
		$sql.= "montant_carte,";
		$sql.= "montant_tiers,";
		$sql.= "banque";


		$sql.= ") VALUES (";

		$sql.= " ".(! isset($this->fk_soc)?'NULL':"'".$this->fk_soc."'").",";
		$sql.= " ".(! isset($this->datecons) || dol_strlen($this->datecons)==0?'NULL':$this->db->idate($this->datecons)).",";
		$sql.= " ".(! isset($this->typepriseencharge)?'NULL':"'".addslashes($this->typepriseencharge)."'").",";
		$sql.= " ".(! isset($this->motifconsprinc)?'NULL':"'".addslashes($this->motifconsprinc)."'").",";
		$sql.= " ".(! isset($this->diaglesprinc)?'NULL':"'".addslashes($this->diaglesprinc)."'").",";
		$sql.= " ".(! isset($this->motifconssec)?'NULL':"'".addslashes($this->motifconssec)."'").",";
		$sql.= " ".(! isset($this->diaglessec)?'NULL':"'".addslashes($this->diaglessec)."'").",";
		$sql.= " ".(! isset($this->examenclinique)?'NULL':"'".addslashes($this->examenclinique)."'").",";
		$sql.= " ".(! isset($this->examenprescrit)?'NULL':"'".addslashes($this->examenprescrit)."'").",";
		$sql.= " ".(! isset($this->traitementprescrit)?'NULL':"'".addslashes($this->traitementprescrit)."'").",";
		$sql.= " ".(! isset($this->comment)?'NULL':"'".addslashes($this->comment)."'").",";
		$sql.= " ".(! isset($this->typevisit)?'NULL':"'".addslashes($this->typevisit)."'").",";
		$sql.= " ".(! isset($this->infiltration)?'NULL':"'".addslashes($this->infiltration)."'").",";
		$sql.= " ".(! isset($this->codageccam)?'NULL':"'".addslashes($this->codageccam)."'").",";
		$sql.= " ".(! isset($this->montant_cheque)?'NULL':"'".$this->montant_cheque."'").",";
		$sql.= " ".(! isset($this->montant_espece)?'NULL':"'".$this->montant_espece."'").",";
		$sql.= " ".(! isset($this->montant_carte)?'NULL':"'".$this->montant_carte."'").",";
		$sql.= " ".(! isset($this->montant_tiers)?'NULL':"'".$this->montant_tiers."'").",";
		$sql.= " ".(! isset($this->banque)?'NULL':"'".addslashes($this->banque)."'")."";


		$sql.= ")";

		$this->db->begin();

		dol_syslog(get_class($this)."::create sql=".$sql, LOG_DEBUG);
		$resql=$this->db->query($sql);
		if (! $resql) { $error++; $this->errors[]="Error ".$this->db->lasterror(); }

		if (! $error)
		{
			$this->id = $this->db->last_insert_id(MAIN_DB_PREFIX."cabinetmed_cons");

			if (! $notrigger)
			{
				// Uncomment this and change MYOBJECT to your own tag if you
				// want this action call a trigger.

				//// Call triggers
				//include_once(DOL_DOCUMENT_ROOT . "/core/class/interfaces.class.php");
				//$interface=new Interfaces($this->db);
				//$result=$interface->run_triggers('MYOBJECT_CREATE',$this,$user,$langs,$conf);
				//if ($result < 0) { $error++; $this->errors=$interface->errors; }
				//// End call triggers
			}
		}

		// Commit or rollback
		if ($error)
		{
			foreach($this->errors as $errmsg)
			{
				dol_syslog(get_class($this)."::create ".$errmsg, LOG_ERR);
				$this->error.=($this->error?', '.$errmsg:$errmsg);
			}
			$this->db->rollback();
			return -1*$error;
		}
		else
		{
			$this->db->commit();
			return $this->id;
		}
	}


	/**
	 *    Load object in memory from database
	 *    @param      id          id object
	 *    @return     int         <0 if KO, >0 if OK
	 */
	function fetch($id)
	{
		global $langs;
		$sql = "SELECT";
		$sql.= " t.rowid,";
		$sql.= " t.fk_soc,";
		$sql.= " t.datecons,";
		$sql.= " t.typepriseencharge,";
		$sql.= " t.motifconsprinc,";
		$sql.= " t.diaglesprinc,";
		$sql.= " t.motifconssec,";
		$sql.= " t.diaglessec,";
		$sql.= " t.hdm,";
		$sql.= " t.examenclinique,";
		$sql.= " t.examenprescrit,";
		$sql.= " t.traitementprescrit,";
		$sql.= " t.comment,";
		$sql.= " t.typevisit,";
		$sql.= " t.infiltration,";
		$sql.= " t.codageccam,";
		$sql.= " t.montant_cheque,";
		$sql.= " t.montant_espece,";
		$sql.= " t.montant_carte,";
		$sql.= " t.montant_tiers,";
		$sql.= " t.banque,";
		$sql.= " b.num_chq";
		$sql.= " FROM ".MAIN_DB_PREFIX."cabinetmed_cons as t";
		$sql.= " LEFT JOIN ".MAIN_DB_PREFIX."bank_url as bu ON bu.url_id = t.rowid AND bu.type='consultation'";
		$sql.= " LEFT JOIN ".MAIN_DB_PREFIX."bank as b ON b.rowid = bu.fk_bank";
		$sql.= " WHERE t.rowid = ".$id;

		dol_syslog(get_class($this)."::fetch sql=".$sql, LOG_DEBUG);
		$resql=$this->db->query($sql);
		if ($resql)
		{
			if ($this->db->num_rows($resql))
			{
				$obj = $this->db->fetch_object($resql);

				$this->id    = $obj->rowid;

				$this->fk_soc = $obj->fk_soc;
				$this->datecons = $this->db->jdate($obj->datecons);
				$this->typepriseencharge = $obj->typepriseencharge;
				$this->motifconsprinc = $obj->motifconsprinc;
				$this->diaglesprinc = $obj->diaglesprinc;
				$this->motifconssec = $obj->motifconssec;
				$this->diaglessec = $obj->diaglessec;
				$this->hdm = $obj->hdm;
				$this->examenclinique = $obj->examenclinique;
				$this->examenprescrit = $obj->examenprescrit;
				$this->traitementprescrit = $obj->traitementprescrit;
				$this->comment = $obj->comment;
				$this->typevisit = $obj->typevisit;
				$this->infiltration = $obj->infiltration;
				$this->codageccam = $obj->codageccam;
				$this->montant_cheque = $obj->montant_cheque;
				$this->montant_espece = $obj->montant_espece;
				$this->montant_carte = $obj->montant_carte;
				$this->montant_tiers = $obj->montant_tiers;
				$this->banque = $obj->banque;
				$this->num_cheque = $obj->num_chq;
			}
			$this->db->free($resql);

			return 1;
		}
		else
		{
			$this->error="Error ".$this->db->lasterror();
			dol_syslog(get_class($this)."::fetch ".$this->error, LOG_ERR);
			return -1;
		}
	}


	/**
	 *      Update database
	 *      @param      user        	User that modify
	 *      @param      notrigger	    0=launch triggers after, 1=disable triggers
	 *      @return     int         	<0 if KO, >0 if OK
	 */
	function update($user=0, $notrigger=0)
	{
		global $conf, $langs;
		$error=0;

		// Clean parameters

		if (isset($this->fk_soc)) $this->fk_soc=trim($this->fk_soc);
		if (isset($this->typepriseencharge)) $this->typepriseencharge=trim($this->typepriseencharge);
		if (isset($this->motifconsprinc)) $this->motifcons=trim($this->motifconsprinc);
		if (isset($this->diaglesprinc)) $this->diaglec=trim($this->diaglesprins);
		if (isset($this->motifconssec)) $this->motifconssec=trim($this->motifconssec);
		if (isset($this->diaglessec)) $this->diaglessec=trim($this->diaglessec);
		if (isset($this->hdm)) $this->hdm=trim($this->hdm);
		if (isset($this->examenclinique)) $this->examenclinique=trim($this->examenclinique);
		if (isset($this->examenprescrit)) $this->examenprescrit=trim($this->examenprescrit);
		if (isset($this->traitementprescrit)) $this->traitementprescrit=trim($this->traitementprescrit);
		if (isset($this->comment)) $this->comment=trim($this->comment);
		if (isset($this->typevisit)) $this->typevisit=trim($this->typevisit);
		if (isset($this->infiltration)) $this->infiltration=trim($this->infiltration);
		if (isset($this->codageccam)) $this->codageccam=trim($this->codageccam);
		if (isset($this->montant_cheque)) $this->montant_cheque=trim($this->montant_cheque);
		if (isset($this->montant_espece)) $this->montant_espece=trim($this->montant_espece);
		if (isset($this->montant_carte)) $this->montant_carte=trim($this->montant_carte);
		if (isset($this->montant_tiers)) $this->montant_tiers=trim($this->montant_tiers);
		if (isset($this->banque)) $this->banque=trim($this->banque);


		// Check parameters
		// Put here code to add control on parameters values

		// Update request
		$sql = "UPDATE ".MAIN_DB_PREFIX."cabinetmed_cons SET";

		$sql.= " fk_soc=".(isset($this->fk_soc)?$this->fk_soc:"null").",";
		$sql.= " datecons=".(dol_strlen($this->datecons)!=0 ? "'".$this->db->idate($this->datecons)."'" : 'null').",";
		$sql.= " typepriseencharge=".(isset($this->typepriseencharge)?"'".addslashes($this->typepriseencharge)."'":"null").",";
		$sql.= " motifconsprinc=".(isset($this->motifconsprinc)?"'".addslashes($this->motifconsprinc)."'":"null").",";
		$sql.= " diaglesprinc=".(isset($this->diaglesprinc)?"'".addslashes($this->diaglesprinc)."'":"null").",";
		$sql.= " motifconssec=".(isset($this->motifconssec)?"'".addslashes($this->motifconssec)."'":"null").",";
		$sql.= " diaglessec=".(isset($this->diaglessec)?"'".addslashes($this->diaglessec)."'":"null").",";
		$sql.= " hdm=".(isset($this->hdm)?"'".addslashes($this->hdm)."'":"null").",";
		$sql.= " examenclinique=".(isset($this->examenclinique)?"'".addslashes($this->examenclinique)."'":"null").",";
		$sql.= " examenprescrit=".(isset($this->examenprescrit)?"'".addslashes($this->examenprescrit)."'":"null").",";
		$sql.= " traitementprescrit=".(isset($this->traitementprescrit)?"'".addslashes($this->traitementprescrit)."'":"null").",";
		$sql.= " comment=".(isset($this->comment)?"'".addslashes($this->comment)."'":"null").",";
		$sql.= " typevisit=".(isset($this->typevisit)?"'".addslashes($this->typevisit)."'":"null").",";
		$sql.= " infiltration=".(isset($this->infiltration)?"'".addslashes($this->infiltration)."'":"null").",";
		$sql.= " codageccam=".(isset($this->codageccam)?"'".addslashes($this->codageccam)."'":"null").",";
		$sql.= " montant_cheque=".(isset($this->montant_cheque)?$this->montant_cheque:"null").",";
		$sql.= " montant_espece=".(isset($this->montant_espece)?$this->montant_espece:"null").",";
		$sql.= " montant_carte=".(isset($this->montant_carte)?$this->montant_carte:"null").",";
		$sql.= " montant_tiers=".(isset($this->montant_tiers)?$this->montant_tiers:"null").",";
		$sql.= " banque=".(isset($this->banque)?"'".addslashes($this->banque)."'":"null")."";


		$sql.= " WHERE rowid=".$this->id;

		$this->db->begin();

		dol_syslog(get_class($this)."::update sql=".$sql, LOG_DEBUG);
		$resql = $this->db->query($sql);
		if (! $resql) { $error++; $this->errors[]="Error ".$this->db->lasterror(); }

		if (! $error)
		{
			if (! $notrigger)
			{
				// Uncomment this and change MYOBJECT to your own tag if you
				// want this action call a trigger.

				//// Call triggers
				//include_once(DOL_DOCUMENT_ROOT . "/core/class/interfaces.class.php");
				//$interface=new Interfaces($this->db);
				//$result=$interface->run_triggers('MYOBJECT_MODIFY',$this,$user,$langs,$conf);
				//if ($result < 0) { $error++; $this->errors=$interface->errors; }
				//// End call triggers
			}
		}

		// Commit or rollback
		if ($error)
		{
			foreach($this->errors as $errmsg)
			{
				dol_syslog(get_class($this)."::update ".$errmsg, LOG_ERR);
				$this->error.=($this->error?', '.$errmsg:$errmsg);
			}
			$this->db->rollback();
			return -1*$error;
		}
		else
		{
			$this->db->commit();
			return 1;
		}
	}


	/**
	 *   Delete object in database
	 *	 @param      user        	User that delete
	 *   @param      notrigger	    0=launch triggers after, 1=disable triggers
	 *	 @return	 int			<0 if KO, >0 if OK
	 */
	function delete($user, $notrigger=0)
	{
		global $conf, $langs;
		$error=0;

		$this->db->begin();

		// Search if there is a bank line
		$bid=0;
		$sql.= "SELECT b.rowid FROM ".MAIN_DB_PREFIX."bank_url as bu, ".MAIN_DB_PREFIX."bank as b";
		$sql.= " WHERE bu.url_id = ".$this->id." AND type = 'consultation'";
		$sql.= " AND bu.fk_bank = b.rowid";
		dol_syslog($sql);
		$resql=$this->db->query($sql);
		if ($resql)
		{
			$obj=$this->db->fetch_object($resql);
			if ($obj)
			{
				$bid=$obj->rowid;
			}
		}
		else
		{
			$error++;
			$consult->error=$this->db->lasterror();
		}

		if (! $error)
		{
			// If bid
			if ($bid)
			{
				$bankaccountline=new AccountLine($this->db);
				$result=$bankaccountline->fetch($bid);
				$bankaccountline->delete($user);
			}
		}

		$sql = "DELETE FROM ".MAIN_DB_PREFIX."cabinetmed_cons";
		$sql.= " WHERE rowid=".$this->id;

		dol_syslog(get_class($this)."::delete sql=".$sql);
		$resql = $this->db->query($sql);
		if (! $resql) { $error++; $this->errors[]="Error ".$this->db->lasterror(); }

		if (! $error)
		{
			if (! $notrigger)
			{
				// Uncomment this and change MYOBJECT to your own tag if you
				// want this action call a trigger.

				//// Call triggers
				//include_once(DOL_DOCUMENT_ROOT . "/core/class/interfaces.class.php");
				//$interface=new Interfaces($this->db);
				//$result=$interface->run_triggers('MYOBJECT_DELETE',$this,$user,$langs,$conf);
				//if ($result < 0) { $error++; $this->errors=$interface->errors; }
				//// End call triggers
			}
		}

		// Commit or rollback
		if ($error)
		{
			foreach($this->errors as $errmsg)
			{
				dol_syslog(get_class($this)."::delete ".$errmsg, LOG_ERR);
				$this->error.=($this->error?', '.$errmsg:$errmsg);
			}
			$this->db->rollback();
			return -1*$error;
		}
		else
		{
			$this->db->commit();
			return 1;
		}
	}



	/**
	 *		\brief      Load an object from its id and create a new one in database
	 *		\param      fromid     		Id of object to clone
	 * 	 	\return		int				New id of clone
	 */
	function createFromClone($fromid)
	{
		global $user,$langs;

		$error=0;

		$object=new Cabinetmed_cons($this->db);

		$this->db->begin();

		// Load source object
		$object->fetch($fromid);
		$object->id=0;
		$object->statut=0;

		// Clear fields
		// ...

		// Create clone
		$result=$object->create($user);

		// Other options
		if ($result < 0)
		{
			$this->error=$object->error;
			$error++;
		}

		if (! $error)
		{



		}

		// End
		if (! $error)
		{
			$this->db->commit();
			return $object->id;
		}
		else
		{
			$this->db->rollback();
			return -1;
		}
	}


	/**
	 *		\brief		Initialise object with example values
	 *		\remarks	id must be 0 if object instance is a specimen.
	 */
	function initAsSpecimen()
	{
		$this->id=0;

		$this->fk_soc='1';
		$this->datecons=time();
		$this->typepriseencharge='CMU';
		$this->motifconsprinc='AAAPRINC';
		$this->diaglesprinc='AAAPRINC';
		$this->motifconssec='AAASEC';
		$this->diaglessec='AAASEC';
		$this->examenclinique='Examen clinique';
		$this->examenprescrit='Examen prescrit';
		$this->traitementprescrit='Traitement prescrit';
		$this->comment='Commentaire';
		$this->typevisit='CCAM';
		$this->infiltration='Genou';
		$this->codageccam='NZLB001';
		$this->montant_cheque='50';
		$this->montant_espece='';
		$this->montant_carte='';
		$this->montant_tiers='';
		$this->banque='Crédit agricol';


	}

}
?>
