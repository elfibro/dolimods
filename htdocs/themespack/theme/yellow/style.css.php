<?php
/* Copyright (C) 2002-2004 Rodolphe Quiedeville <rodolphe@quiedeville.org>
 * Copyright (C) 2004-2010 Laurent Destailleur  <eldy@users.sourceforge.net>
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
 *		\file       htdocs/theme/yellow/style.css.php
 *		\brief      Fichier de style CSS du theme Yellow
 */

//if (! defined('NOREQUIREUSER')) define('NOREQUIREUSER','1');	// Not disabled cause need to load personalized language
//if (! defined('NOREQUIREDB'))   define('NOREQUIREDB','1');	// Not disabled to increase speed. Language code is found on url.
if (! defined('NOREQUIRESOC'))    define('NOREQUIRESOC', '1');
//if (! defined('NOREQUIRETRAN')) define('NOREQUIRETRAN','1');	// Not disabled cause need to do translations
if (! defined('NOCSRFCHECK'))     define('NOCSRFCHECK', 1);
if (! defined('NOTOKENRENEWAL'))  define('NOTOKENRENEWAL', 1);
if (! defined('NOLOGIN'))         define('NOLOGIN', 1);
if (! defined('NOREQUIREMENU'))   define('NOREQUIREMENU', 1);
if (! defined('NOREQUIREHTML'))   define('NOREQUIREHTML', 1);
if (! defined('NOREQUIREAJAX'))   define('NOREQUIREAJAX', '1');

session_cache_limiter('public');

$res=0;
if (! $res && file_exists("../main.inc.php")) $res=@include "../main.inc.php";
if (! $res && file_exists("../../main.inc.php")) $res=@include "../../main.inc.php";
if (! $res && file_exists("../../../main.inc.php")) $res=@include "../../../main.inc.php";
if (! $res && file_exists("../../../../main.inc.php")) $res=@include "../../../../main.inc.php";
if (! $res && file_exists("../../../../../main.inc.php")) $res=@include "../../../../../main.inc.php";
if (! $res && preg_match('/\/nltechno([^\/]*)\//', $_SERVER["PHP_SELF"], $reg)) $res=@include "../../../../../dolibarr".$reg[1]."/htdocs/main.inc.php"; // Used on dev env only
if (! $res) die("Include of main fails");

// Load user to have $user->conf loaded (not done into main because of NOLOGIN constant defined)
if (empty($user->id) && ! empty($_SESSION['dol_login'])) $user->fetch('', $_SESSION['dol_login']);

// Define css type
header('Content-type: text/css');
// Important: Following code is to avoid page request by browser and PHP CPU at
// each Dolibarr page access.
if (empty($dolibarr_nocache)) header('Cache-Control: max-age=10800, public, must-revalidate');
else header('Cache-Control: no-cache');

// On the fly GZIP compression for all pages (if browser support it). Must set the bit 3 of constant to 1.
if (isset($conf->global->MAIN_OPTIMIZE_SPEED) && ($conf->global->MAIN_OPTIMIZE_SPEED & 0x04)) { ob_start("ob_gzhandler"); }

if (GETPOST('lang')) $langs->setDefaultLang(GETPOST('lang'));  // If language was forced on URL
if (GETPOST('theme')) $conf->theme=GETPOST('theme');  // If theme was forced on URL
$langs->load("main", 0, 1);
$right=($langs->trans("DIRECTION")=='rtl'?'left':'right');
$left=($langs->trans("DIRECTION")=='rtl'?'right':'left');
?>

/* ============================================================================== */
/* Styles by default                                                              */
/* ============================================================================== */

body {
<?php if (! empty($_GET["optioncss"]) && $_GET["optioncss"] == 'print') {  ?>
	background-color: #FFFFFF;
<?php } else { ?>
	background-color: #fbfbf0;
<?php } ?>
  font-size: 12px;
  font-family: helvetica, verdana, arial, sans-serif;
  margin-top: 0;
  margin-bottom: 0;
  margin-right: 0;
  margin-left: 0;
}

a:link    { font-family: helvetica, verdana, arial, sans-serif; font-weight: bold; color: #000000; text-decoration: none; }
a:visited { font-family: helvetica, verdana, arial, sans-serif; font-weight: bold; color: #000000; text-decoration: none; }
a:active  { font-family: helvetica, verdana, arial, sans-serif; font-weight: bold; color: #000000; text-decoration: none; }
a:hover   { font-family: helvetica, verdana, arial, sans-serif; font-weight: bold; color: #000000; text-decoration: underline; }
input
{
	font-size: 12px;
	font-family: helvetica, verdana, arial, sans-serif;
	border: 1px solid #cccccc;
	padding: 0px 0px 0px 0px;
	margin: 0px 0px 0px 0px;
}
input.flat
{
	font-size: 12px;
	font-family: helvetica, verdana, arial, sans-serif;
	border: 1px solid #cccccc;
	padding: 0px 0px 0px 0px;
	margin: 0px 0px 0px 0px;
}
input:disabled {
background:#ddd;
}
textarea  {
	font-size: 12px;
	font-family: helvetica, verdana, arial, sans-serif;
	border: 1px solid #cccccc;
	padding: 0px 0px 0px 0px;
	margin: 0px 0px 0px 0px;
}
textarea.flat
{
	font-size: 12px;
	font-family: helvetica, verdana, arial, sans-serif;
	border: 1px solid #cccccc;
	padding: 0px 0px 0px 0px;
	margin: 0px 0px 0px 0px;
}
textarea:disabled {
background:#ddd;
}
select.flat
{
	background: #FDFDFD;
	font-size: 12px;
	font-family: helvetica, verdana, arial, sans-serif;
	font-weight: normal;
	border: 1px solid #cccccc;
	padding: 0px 0px 0px 0px;
	margin: 0px 0px 0px 0px;
}
.button
{
	font-family: arial,verdana,helvetica, sans-serif;
	font-size: 100%;
	font-weight: normal;
	border: 1px solid #bbbb99;
	background-image : url(/theme/yellow/img/button_bg.png);
	background-position : bottom;
}
form
{
	padding: 0em 0em 0em 0em;
	margin: 0em 0em 0em 0em;
}
div.float
{
	float:<?php print $left; ?>;
}

/* ============================================================================== */
/* Styles to hide objects                                                         */
/* ============================================================================== */

.hideobject { display: none; }
<?php if (! empty($conf->browser->phone)) { ?>
.hideonsmartphone { display: none; }
<?php } ?>
.linkobject { cursor: pointer; }

/* ============================================================================== */
/* Styles for dragging lines                                                      */
/* ============================================================================== */

.dragClass {
	color: #002244;
}
td.showDragHandle {
	cursor: move;
}
.tdlineupdown {
	white-space: nowrap;
}



/* ============================================================================== */
/* Styles de positionnement des zones                                             */
/* ============================================================================== */

div.fiche
{
	margin-<?php print $left; ?>: <?php print empty($conf->browser->phone)?'8':'2'; ?>px;
	margin-<?php print $right; ?>: <?php print empty($conf->browser->phone)?'4':''; ?>px;
}

div.fichecenter {
	width: 100%;
	clear: both;	/* This is to have div fichecenter that are true rectangles */
}
div.fichethirdleft {
	<?php if (empty($conf->browser->phone)) { print "float: ".$left.";\n"; } ?>
	<?php if (empty($conf->browser->phone)) { print "width: 35%;\n"; } ?>
}
div.fichetwothirdright {
	<?php if (empty($conf->browser->phone)) { print "float: ".$left.";\n"; } ?>
	<?php if (empty($conf->browser->phone)) { print "width: 65%;\n"; } ?>
}
div.fichehalfleft {
	<?php if (empty($conf->browser->phone)) { print "float: ".$left.";\n"; } ?>
	<?php if (empty($conf->browser->phone)) { print "width: 50%;\n"; } ?>
}
div.fichehalfright {
	<?php if (empty($conf->browser->phone)) { print "float: ".$left.";\n"; } ?>
	<?php if (empty($conf->browser->phone)) { print "width: 50%;\n"; } ?>
}
div.ficheaddleft {
	<?php if (empty($conf->browser->phone)) { print "padding-left: 6px;\n"; } ?>
}


/* ============================================================================== */
/* Menu superieur et 1ere ligne tableau                                           */
/* ============================================================================== */

div.tmenu
{
<?php if (! empty($_GET["optioncss"]) && $_GET["optioncss"] == 'print') {  ?>
	display:none;
<?php } else { ?>
	position: relative;
	display: block;
	white-space: nowrap;
	border: 0px;
	border-right: 1px solid #555555;
	border-bottom: 1px solid #555555;
	padding: 0px 0px 0px 0px;
	margin: 0px 0px 4px 0px;
	font-weight: bold;
	font-size: 12px;
	height: 20px;
	background: #dcdcb3;
	color: #000000;
	text-decoration: none;
<?php } ?>
}

a.tmenudisabled
{
	color: #757575;
	font-size: 12px;
	padding: 0px 5px;
	cursor: not-allowed;
}
a.tmenudisabled:link
{
	color: #757575;
	font-weight: normal;
}
a.tmenudisabled:visited
{
	color: #757575;
	font-weight: normal;
}
a.tmenudisabled:hover
{
	color: #757575;
	font-weight: normal;
}
a.tmenudisabled:active
{
	color: #757575;
	font-weight: normal;
}

a.tmenu:link
{
  color: #234046;
  padding: 0px 5px;
  border: 1px solid #dcdcb3;
  font-weight:bold;
  font-size:12px;
}
a.tmenu:visited
{
  color: #234046;
  padding: 0px 5px;
  border: 1px solid #dcdcb3;
  font-weight:bold;
  font-size:12px;
}
a.tmenu:hover
{
  color: #234046;
  background: #eeeecc;
  padding: 0px 5px;
  border: 1px solid #eeeecc;
  text-decoration: none;
}

a.tmenusel
{
  color: #234046;
  background: #eeeecc;
  padding: 0px 5px;
  border: 1px solid #eeeecc;
}



/* Top menu */

table.tmenu
{
	padding: 0px 0px 10px 0px;
	margin: 0px 0px 0px 6px;
}

* html li.tmenu a
{
	width:40px;
}

ul.tmenu {
	padding: 0px 0px 0px 0px;
	margin: 0px 0px 0px 0px;
}
li.tmenu {
	float: left;
	border-right: solid 1px #000000;
	height: 18px;
	position:relative;
	display: block;
	margin:0;
	padding:0;
}
li.tmenu a{
	  font-size: 13px;
	color:#000000;
	text-decoration:none;
	padding-left:10px;
	padding-right:10px;
	padding-top: 2px;
	height: 18px;
	display: block;
	font-weight: normal;
}
li.tmenu a.tmenusel
{
	background:#FFFFFF;
	color:#000000;
	font-weight: normal;
}
li.tmenu a:visited
{
	color:#000000;
	font-weight: normal;
}
li.tmenu a:hover
{
	background:#FFFFFF;
	color:#000000;
	font-weight: normal;
}
li.tmenu a:active
{
	color:#000000;
	font-weight: normal;
}
li.tmenu a:link
{
	font-weight: normal;
}

.tmenuimage {
	padding:0 0 0 0 !important;
	margin:0 0px 0 0 !important;
}


/* Login */

div.login_block {
	<?php if (GETPOST("optioncss") == 'print') { ?>
	display: none;
	<?php } ?>
}

div.login {
  position: absolute;
  <?php print $right; ?>: 30px;
  top: 2px;
  padding: 0px 8px;
  margin: 0px 0px 1px 0px;
  border: 1px solid #dcdcb3;
  font-weight:bold;
  font-size:12px;
}
div.login a {
	color: #234046;
}
div.login a:hover {
	color: black;
	text-decoration:underline;
}

img.login
{
  position: absolute;
  <?php print $right; ?>: 20px;
  top: 2px;

  text-decoration:none;
  color:white;
  font-weight:bold;
}
img.printer
{
  position: absolute;
  <?php print $right; ?>: 4px;
  top: 4px;

  text-decoration: none;
  color: white;
  font-weight: bold;
}


/* ============================================================================== */
/* Menu gauche                                                                    */
/* ============================================================================== */

<?php if (GETPOST("optioncss") == 'print') { ?>
.vmenu {
	display: none;
}
<?php } ?>

td.vmenu
{
	padding-right: 2px;
	padding: 0px;
	padding-bottom: 0px;
	width: 164px;
}

a.vmenu:link    { font-family: helvetica, verdana, arial, sans-serif; text-align:left; font-weight: bold; }
a.vmenu:visited { font-family: helvetica, verdana, arial, sans-serif; text-align:left; font-weight: bold; }
a.vmenu:active  { font-family: helvetica, verdana, arial, sans-serif; text-align:left; font-weight: bold; }
a.vmenu:hover   { font-family: helvetica, verdana, arial, sans-serif; text-align:left; font-weight: bold; }
font.vmenudisabled { font-size:12px; font-family: helvetica, verdana, arial, sans-serif; text-align:left; font-weight: normal; color: #aaa593; margin: 0em 0em 0em 0em; }

a.vsmenu:link    { font-family: helvetica, verdana, arial, sans-serif; text-align:left; font-weight: normal; color: #202020; margin: 1px 1px 1px 6px; }
a.vsmenu:visited { font-family: helvetica, verdana, arial, sans-serif; text-align:left; font-weight: normal; color: #202020; margin: 1px 1px 1px 6px; }
a.vsmenu:active  { font-family: helvetica, verdana, arial, sans-serif; text-align:left; font-weight: normal; color: #202020; margin: 1px 1px 1px 6px; }
a.vsmenu:hover   { font-family: helvetica, verdana, arial, sans-serif; text-align:left; font-weight: normal; color: #202020; margin: 1px 1px 1px 6px; }
font.vsmenudisabled { font-size:12px; font-family: helvetica, verdana, arial, sans-serif; text-align:left; font-weight: normal; color: #aaa593; margin: 1px 1px 1px 6px; }

a.help:link    { font-size:11px; font-family: helvetica, verdana, arial, sans-serif; text-align:left; font-weight: normal; }
a.help:visited { font-size:11px; font-family: helvetica, verdana, arial, sans-serif; text-align:left; font-weight: normal; }
a.help:active  { font-size:11px; font-family: helvetica, verdana, arial, sans-serif; text-align:left; font-weight: normal; }
a.help:hover   { font-size:11px; font-family: helvetica, verdana, arial, sans-serif; text-align:left; font-weight: normal; }

div.blockvmenupair, div.blockvmenuimpair
{
	width:160px;
	border-right: 1px solid #555555;
	border-bottom: 1px solid #555555;
	background: #dcdcb3;
	font-family: helvetica, verdana, arial, sans-serif;
	color: #000000;
	text-align:left;
	text-decoration: none;
	padding-left: 3px;
	padding-right: 1px;
	padding-top: 3px;
	padding-bottom: 3px;
	margin: 1px 0px 0px 0px;
}

div.blockvmenusearch
{
	width:160px;
	border-right: 1px solid #555555;
	border-bottom: 1px solid #555555;
	background: #dcdcb3;
	font-family: helvetica, verdana, arial, sans-serif;
	color: #000000;
	text-align:left;
	text-decoration: none;
	padding-left: 3px;
	padding-right: 1px;
	padding-top: 3px;
	padding-bottom: 3px;
	margin: 1px 0px 0px 0px;
}

div.blockvmenubookmarks
{
	width:160px;
	border-right: 1px solid #555555;
	border-bottom: 1px solid #555555;
	background: #dcdcb3;
	font-family: helvetica, verdana, arial, sans-serif;
	color: #000000;
	text-align:left;
	text-decoration: none;
	padding-left: 3px;
	padding-right: 1px;
	padding-top: 3px;
	padding-bottom: 3px;
	margin: 1px 0px 0px 0px;
}

div.blockvmenuhelp
{
<?php if (empty($conf->browser->phone)) { ?>
	width:160px;
	border-right: 1px solid #000000;
	border-bottom: 1px solid #000000;
	background: #f0f0f0;
	font-family: helvetica, verdana, arial, sans-serif;
	color: #000000;
	text-align:left;
	text-decoration: none;
	padding-left: 3px;
	padding-right: 1px;
	padding-top: 3px;
	padding-bottom: 3px;
	margin: 1px 0px 0px 0px;
<?php } else { ?>
	display: none;
<?php } ?>
}

td.barre {
	border-right: 1px solid #000000;
	border-bottom: 1px solid #000000;
	background: #b3c5cc;
	font-family: helvetica, verdana, arial, sans-serif;
	color: #000000;
	text-align:left;
	text-decoration: none
}

td.barre_select {
	background: #b3c5cc;
	color: #000000
}
td.photo {
	background: #FFFFFF;
	color: #000000
}


/* ============================================================================== */
/* Panes for Main                                                   */
/* ============================================================================== */

/*
 *  PANES and CONTENT-DIVs
 */

#mainContent, #leftContent .ui-layout-pane {
	padding:    0px;
	overflow:	auto;
}

#mainContent, #leftContent .ui-layout-center {
	padding:    0px;
	position:   relative; /* contain floated or positioned elements */
	overflow:   auto;  /* add scrolling to content-div */
}

/* ============================================================================== */
/* Barre de redmiensionnement menu                                                */
/* ============================================================================== */

.ui-layout-resizer-west-open {
	/*left: 200px !important;*/
}

.ui-layout-north {
		height: 57px !important;
}

/* ============================================================================== */
/* Toolbar for ECM or Filemanager                                                 */
/* ============================================================================== */

.toolbar {
	background-image: url(<?php echo DOL_URL_ROOT.'/theme/'.$conf->theme.'/img/tmenu2.png' ?>) !important;
	background-repeat: repeat-x !important;
	border: 1px solid #BBB !important;
}

.toolbarbutton {
	margin-top: 2px;
	margin-left: 4px;
/*    border: solid 1px #AAAAAA;
	width: 34px;*/
	height: 34px;
/*    background: #FFFFFF;*/
}


/* ============================================================================== */
/* Panes for ECM or Filemanager                                                   */
/* ============================================================================== */

#containerlayout .layout-with-no-border {
	border: 0 !important;
	border-width: 0 !important;
}

#containerlayout .layout-padding {
	padding: 2px !important;
}

/*
 *  PANES and CONTENT-DIVs
 */
#containerlayout .ui-layout-pane { /* all 'panes' */
	background: #FFF;
	border:     1px solid #BBB;
	/* DO NOT add scrolling (or padding) to 'panes' that have a content-div,
	   otherwise you may get double-scrollbars - on the pane AND on the content-div
	*/
	padding:    0px;
	overflow:   auto;
}
/* (scrolling) content-div inside pane allows for fixed header(s) and/or footer(s) */
#containerlayout .ui-layout-content {
	padding:    10px;
	position:   relative; /* contain floated or positioned elements */
	overflow:   auto; /* add scrolling to content-div */
}

/*
 *  RESIZER-BARS
 */
.ui-layout-resizer  { /* all 'resizer-bars' */
	width: 8px !important;
}
.ui-layout-resizer-hover    {   /* affects both open and closed states */
}
/* NOTE: It looks best when 'hover' and 'dragging' are set to the same color,
	otherwise color shifts while dragging when bar can't keep up with mouse */
/*.ui-layout-resizer-open-hover ,*/ /* hover-color to 'resize' */
.ui-layout-resizer-dragging {   /* resizer beging 'dragging' */
	background: #DDD;
	width: 8px;
}
.ui-layout-resizer-dragging {   /* CLONED resizer being dragged */
	border-left:  1px solid #BBB;
	border-right: 1px solid #BBB;
}
/* NOTE: Add a 'dragging-limit' color to provide visual feedback when resizer hits min/max size limits */
.ui-layout-resizer-dragging-limit { /* CLONED resizer at min or max size-limit */
	background: #E1A4A4; /* red */
}
.ui-layout-resizer-closed:hover {
	background-color: #EEDDDD;
}
.ui-layout-resizer-sliding {    /* resizer when pane is 'slid open' */
	opacity: .10; /* show only a slight shadow */
	filter:  alpha(opacity=10);
	}
	.ui-layout-resizer-sliding-hover {  /* sliding resizer - hover */
		opacity: 1.00; /* on-hover, show the resizer-bar normally */
		filter:  alpha(opacity=100);
	}
/* sliding resizer - add 'outside-border' to resizer on-hover
 * this sample illustrates how to target specific panes and states */
.ui-layout-resizer-north-sliding-hover  { border-bottom-width:  1px; }
.ui-layout-resizer-south-sliding-hover  { border-top-width:     1px; }
.ui-layout-resizer-west-sliding-hover   { border-right-width:   1px; }
.ui-layout-resizer-east-sliding-hover   { border-left-width:    1px; }

/*
 *  TOGGLER-BUTTONS
 */
.ui-layout-toggler {
	border-top: 1px solid #AAA; /* match pane-border */
	border-right: 1px solid #AAA; /* match pane-border */
	border-bottom: 1px solid #AAA; /* match pane-border */
	background-color: #DDD;
	top: 5px !important;
	}
.ui-layout-toggler-open {
	height: 48px !important;
	width: 5px !important;
	-moz-border-radius:0px 10px 10px 0px;
	-webkit-border-radius:0px 10px 10px 0px;
	border-radius:0px 10px 10px 0px;
}
.ui-layout-toggler-closed {
	height: 48px !important;
	width: 5px !important;
	-moz-border-radius:0px 10px 10px 0px;
	-webkit-border-radius:0px 10px 10px 0px;
	border-radius:0px 10px 10px 0px;
}
.ui-layout-toggler .content {	/* style the text we put INSIDE the togglers */
	color:          #666;
	font-size:      12px;
	font-weight:    bold;
	width:          100%;
	padding-bottom: 0.35ex; /* to 'vertically center' text inside text-span */
}

/* hide the toggler-button when the pane is 'slid open' */
.ui-layout-resizer-sliding  ui-layout-toggler {
	display: none;
}

.ui-layout-north {
	height: <?php print (empty($conf->browser->phone)?'21':'21'); ?>px !important;
}

/* ECM */

#containerlayout .ecm-layout-pane { /* all 'panes' */
	background: #FFF;
	border:     1px solid #BBB;
	/* DO NOT add scrolling (or padding) to 'panes' that have a content-div,
	   otherwise you may get double-scrollbars - on the pane AND on the content-div
	*/
	padding:    0px;
	overflow:   auto;
}
/* (scrolling) content-div inside pane allows for fixed header(s) and/or footer(s) */
#containerlayout .ecm-layout-content {
	padding:    10px;
	position:   relative; /* contain floated or positioned elements */
	overflow:   auto; /* add scrolling to content-div */
}

.ecm-layout-toggler {
	background-color: #DDD;
	}
.ecm-layout-toggler-open {
	height: 48px !important;
	width: 6px !important;
}
.ecm-layout-toggler-closed {
	height: 48px !important;
	width: 6px !important;
}
.ecm-layout-toggler .content {	/* style the text we put INSIDE the togglers */
	color:          #666;
	font-size:      12px;
	font-weight:    bold;
	width:          100%;
	padding-bottom: 0.35ex; /* to 'vertically center' text inside text-span */
}
#ecm-layout-west-resizer {
	width: 6px !important;
}

.ecm-layout-resizer  { /* all 'resizer-bars' */
	background:     #EEE;
	border:         1px solid #BBB;
	border-width:   0;
	}

.ecm-in-layout-center {
	border-left: 1px !important;
	border-right: 0px !important;
	border-top: 0px !important;
}

.ecm-in-layout-south {
	border-left: 0px !important;
	border-right: 0px !important;
	border-bottom: 0px !important;
	padding: 4px 0 4px 4px !important;
}



/* ============================================================================== */
/* Onglets                                                                        */
/* ============================================================================== */

div.tabBar {
	background: #dcdcd3;
	padding-top: 14px;
	padding-left: 14px;
	padding-right: 14px;
	padding-bottom: 14px;
	margin: 0px 0px 10px 0px;
	border: 1px solid #999999;
	border-top: 1px solid #999999;
}

div.tabs {
	top: 20px;
	margin: 1px 0px 0px 0px;
	padding: 0px 6px 0px 0px;
	text-align: left;
}

div.tabsAction {
	margin: 20px 0em 1px 0em;
	padding: 0em 0em;
	text-align: right;
}

a.tabTitle {
	background: #436976;
	border: 1px solid #8CACBB;
	color: white;
	font-weight: normal;
	padding: 0px 6px;
	margin: 0px 6px;
	text-decoration: none;
	white-space: nowrap;
}
a.tabTitle:hover {
	background: #436976;
	border: 1px solid #8CACBB;
	color: white;
	font-weight: normal;
	padding: 0px 6px;
	margin: 0px 6px;
	text-decoration: none;
	white-space: nowrap;
}

a.tab:link {
  background: white;
  border: 1px solid #999999;
  color: #436976;
  padding: 0px 6px;
  margin: 0em 0.2em;
  text-decoration: none;
  white-space: nowrap;
}
a.tab:visited {
  background: white;
  border: 1px solid #999999;
  color: #436976;
  padding: 0px 6px;
  margin: 0em 0.2em;
  text-decoration: none;
  white-space: nowrap;
}
a.tab#active {
  background: #dcdcd3;
  border-bottom: #dcdcd3 1px solid;
  padding: 0px 6px;
  margin: 0em 0.2em;
  text-decoration: none;
}
a.tab:hover {
  background: #eeeecc;
  padding: 0px 6px;
  margin: 0em 0.2em;
  text-decoration: none;
}

a.tabimage {
	color: #436976;
	text-decoration: none;
	white-space: nowrap;
}

span.tabspan {
	background: #dee7ec;
	color: #436976;
	font-family: <?php print $fontlist ?>;
	padding: 0px 6px;
	margin: 0em 0.2em;
	text-decoration: none;
	white-space: nowrap;
	-moz-border-radius-topleft:6px;
	-moz-border-radius-topright:6px;

	border-<?php print $right; ?>: 1px solid #555555;
	border-<?php print $left; ?>: 1px solid #D8D8D8;
	border-top: 1px solid #D8D8D8;
}


/* ============================================================================== */
/* Boutons actions                                                                */
/* ============================================================================== */

a.butAction:link    { font-family: helvetica, verdana, arial, sans-serif; background: white; border: 1px solid #999999; color: #436969; padding: 0em 0.7em; margin: 0em 0.5em; text-decoration: none; white-space: nowrap; }
a.butAction:visited { font-family: helvetica, verdana, arial, sans-serif; background: white; border: 1px solid #999999; color: #436969; padding: 0em 0.7em; margin: 0em 0.5em; text-decoration: none; white-space: nowrap; }
a.butAction:active  { font-family: helvetica, verdana, arial, sans-serif; background: white; border: 1px solid #999999; color: #436969; padding: 0em 0.7em; margin: 0em 0.5em; text-decoration: none; white-space: nowrap; }
a.butAction:hover   { font-family: helvetica, verdana, arial, sans-serif; background: #eeeecc; border: 1px solid #999999; color: #436969; padding: 0em 0.7em; margin: 0em 0.5em; text-decoration: none; white-space: nowrap; }

.butActionRefused         { font-family: helvetica, verdana, arial, sans-serif; background: white; border: 1px solid #AAAAAA; color: #AAAAAA !important; padding: 0em 0.7em; margin: 0em 0.5em; text-decoration: none !important; white-space: nowrap; cursor: not-allowed; }

a.butActionDelete:link    { font-family: helvetica, verdana, arial, sans-serif; background: white; border: 1px solid #997777; color: #436976; padding: 0em 0.7em; margin: 0em 0.5em; text-decoration: none; white-space: nowrap; }
a.butActionDelete:active  { font-family: helvetica, verdana, arial, sans-serif; background: white; border: 1px solid #997777; color: #436976; padding: 0em 0.7em; margin: 0em 0.5em; text-decoration: none; white-space: nowrap; }
a.butActionDelete:visited { font-family: helvetica, verdana, arial, sans-serif; background: white; border: 1px solid #997777; color: #436976; padding: 0em 0.7em; margin: 0em 0.5em; text-decoration: none; white-space: nowrap; }
a.butActionDelete:hover   { font-family: helvetica, verdana, arial, sans-serif; background: #FFe7ec; border: 1px solid #997777; color: #436976; padding: 0em 0.7em; margin: 0em 0.5em; text-decoration: none; white-space: nowrap; }

span.butAction, span.butActionDelete {
	cursor: pointer;
}


/* ============================================================================== */
/* Tables                                                                         */
/* ============================================================================== */

.nocellnopadd {
list-style-type:none;
margin:0px;
padding:0px;
}

.notopnoleft {
border-collapse: collapse;
border: 0px;
padding-top: 0px;
padding-left: 0px;
padding-right: 4px;
padding-bottom: 4px;
margin: 0px 0px;
}
.notopnoleftnoright {
border-collapse: collapse;
border: 0px;
padding-top: 0px;
padding-left: 0px;
padding-right: 0px;
padding-bottom: 4px;
margin: 0px 0px;
}

table.border {
border-collapse: collapse;
border: 1px white;
}
table.border td {
border: 1px solid #6C7C8B;
padding: 1px 2px;
border-collapse: collapse;
}

table.noborder {
border-collapse: collapse;
border: 0px;
}
table.noborder td {
border: 0px;
padding: 1px 2px;
}

table.nobordernopadding {
border-collapse: collapse;
border: 0px;
}
table.nobordernopadding tr {
border: 0px;
padding: 0px 0px;
}
table.nobordernopadding td {
border: 0px;
padding: 0px 0px;
}

table.liste {
border-collapse: collapse;
border: 0px;
width: 100%;
background: #ddddcc;
}


td.border {
			border-top: 1px solid #000000;
			border-right: 1px solid #000000;
			border-bottom: 1px solid #000000;
			border-left: 1px solid #000000;
			}

div.menus {
			background: #eeeecc;
			color: #bbbb88;
			font-size: 0.95em;
			border-top:    1px dashed #ccccb3;
			border-right:  1px dashed #ccccb3;
			border-bottom: 1px dashed #ccccb3;
			border-left:   1px dashed #ccccb3;
			}


a.leftmenu {
			 font-weight: bold;
			 color: #202020;
			 }



div.leftmenu {
			   background: #ccccb3;
			   text-align: left;
			   border-right: 1px solid #000000;
			   border-bottom: 1px solid #000000;
			   margin: 1px 0em 0em 0em;
			   padding: 2px;
			   }



/*
 *   Normal, warning, erreurs
 */
.ok      { color: #114466; }
.warning { color: #777711; }
.error   { color: #550000; }

td.highlights { background: #f9c5c6; }

div.ok {
  color: #114466;
}

div.warning {
  color: #777711;
  padding: 0.2em 0.2em 0.2em 0.2em;
  border: 1px solid #ebebd4;
  -moz-border-radius:6px;
  background: #efefd4;
}

div.error {
  color: #550000; font-weight: bold;
  padding: 0.2em 0.2em 0.2em 0.2em;
  margin: 0.5em 0em 0.5em 0em;
  border: 1px solid #000000;
}

div.info {
  color: #777777;
  padding: 0.2em 0.2em 0.2em 0.2em;
  margin: 0.5em 0em 0.5em 0em;
  border: 1px solid #ACACAB;
}


/*
 *   Liens Payes/Non payes
 */

a.normal:link { font-weight: normal }
a.normal:visited { font-weight: normal }
a.normal:active { font-weight: normal }
a.normal:hover { font-weight: normal }

a.impayee:link { font-weight: bold; color: #550000; }
a.impayee:visited { font-weight: bold; color: #550000; }
a.impayee:active { font-weight: bold; color: #550000; }
a.impayee:hover { font-weight: bold; color: #550000; }





/*
 *  Other
 */

.fieldrequired { font-weight: bold; color: #442200; }

.photo {
border: 0px;
/* filter:alpha(opacity=55); */
/* opacity:.55; */
}

div.titre {
	font-family: helvetica, verdana, arial, sans-serif;
	font-weight: normal;
	color: #666633;
	text-decoration: none;
}


/*
 *  Tableaux
 */

input.liste_titre {
	background: #BBBB88;
	border: 0px;
}

tr.liste_titre {
	background: #BBBB88;
	font-family: helvetica, verdana, arial, sans-serif;
	border-bottom: 1px solid #000000;
	white-space: nowrap;
}

td.liste_titre {
	background: #BBBB88;
	font-family: helvetica, verdana, arial, sans-serif;
	border-top: 1px solid #FFFFFF;
	border-bottom: 1px solid #FFFFFF;
	white-space: nowrap;
}

.liste_titre_sel
{
	color: #fcfffc;
	background: #BBBB88;
	font-family: helvetica, verdana, arial, sans-serif;
	border-top: 1px solid #FFFFFF;
	border-bottom: 1px solid #FFFFFF;
	white-space: nowrap;
}

tr.liste_total td {
	background: #F0F0F0;
	white-space: nowrap;
	font-weight: bold;
	border-top: 1px solid #888888;
}

th {
	background: #BBBB88;
	font-family: helvetica, verdana, arial, sans-serif;
	border-left: 1px solid #FFFFFF;
	border-right: 1px solid #FFFFFF;
	border-top: 1px solid #FFFFFF;
	border-bottom: 1px solid #FFFFFF;
	white-space: nowrap;
}

.pair {
	background: #eeeecc;
}

.impair {
	background: #dcdcb3;
}


/*
 *  Boxes
 */

.boxtable {
-moz-box-shadow: 2px 4px 2px #AAA;
-webkit-box-shadow: 2px 4px 2px #AAA;
box-shadow: 2px 4px 2px #AAA;
}

.box {
	padding-right: 4px;
	padding-bottom: 4px;
}

tr.box_titre {
	background: #BBBB88;
	border-top: 1px solid #FFFFFF;
	border-bottom: 1px solid #FFFFFF;
	font-family: Helvetica, Verdana;
}

tr.box_pair {
	background: #dcdcb3;
}

tr.box_impair {
	background: #eeeecc;
	font-family: Helvetica, Verdana;
}

tr.fiche {
	font-family: Helvetica, Verdana;
}



/* ============================================================================== */
/* Formulaire confirmation (When Ajax JQuery is used)                             */
/* ============================================================================== */

.ui-dialog-titlebar {
}
.ui-dialog-content {
	font-size: 12px !important;
}

/* ============================================================================== */
/* Formulaire confirmation (When HTML is used)                                    */
/* ============================================================================== */

table.valid {
	border-top: solid 1px #E6E6E6;
	border-left: solid 1px #E6E6E6;
	border-right: solid 1px #444444;
	border-bottom: solid 1px #555555;
	padding-top: 0px;
	padding-left: 0px;
	padding-right: 0px;
	padding-bottom: 0px;
	margin: 0px 0px;
	background: pink;
}

.validtitre {
	background: #D5BAA8;
	font-weight: bold;
}


/* ============================================================================== */
/* Tooltips                                                                       */
/* ============================================================================== */

#tooltip {
position: absolute;
width: <?php print dol_size(450, 'width'); ?>px;
border-top: solid 1px #BBBBBB;
border-<?php print $left; ?>: solid 1px #BBBBBB;
border-<?php print $right; ?>: solid 1px #444444;
border-bottom: solid 1px #444444;
padding: 2px;
z-index: 3000;
background-color: #FFFFF0;
opacity: 1;
-moz-border-radius:6px;
}



/* ============================================================================== */
/* Calendar                                                                       */
/* ============================================================================== */
.bodyline {
	z-index: 3000;
	-moz-border-radius:8px;
	border: 1px #ECECE4 outset;
	padding:0px;
	margin-bottom:5px;
}
table.dp {
	width: 180px;
	background-color: #FFFFFF;
	border-top: solid 2px #DDDDDD;
	border-left: solid 2px #DDDDDD;
	border-right: solid 1px #222222;
	border-bottom: solid 1px #222222;
}
.dp td, .tpHour td, .tpMinute td{padding:2px; font-size:10px;}
/* Barre titre */
.#ccc5b3,.tpHead,.tpHour td:Hover .tpHead{
	font-weight:bold;
	background-color:#ccc5b3;
	color:black;
	font-size:11px;
	cursor:auto;
}
/* Barre navigation */
.dpButtons,.tpButtons {
	text-align:center;
	background-color:#dcdcb3;color:#000000; font-weight:bold;
	border: 1px outset black;
	cursor:pointer;
}
.dpButtons:Active,.tpButtons:Active{border: 1px outset black;}
.dpDayNames td,.dpExplanation {background-color:#D9DBE1; font-weight:bold; text-align:center; font-size:11px;}
.dpExplanation{ font-weight:normal; font-size:11px;}
.dpWeek td{text-align:center}

.dpToday,.dpReg,.dpSelected{
	cursor:pointer;
}
.dpToday{font-weight:bold; color:black; background-color:#DDDDDD;}
.dpReg:Hover,.dpToday:Hover{background-color:black;color:white}

/* Jour courant */
.dpSelected{background-color:#eeeecc;color:black;font-weight:bold; }

.tpHour{border-top:1px solid #DDDDDD; border-right:1px solid #DDDDDD;}
.tpHour td {border-left:1px solid #DDDDDD; border-bottom:1px solid #DDDDDD; cursor:pointer;}
.tpHour td:Hover {background-color:black;color:white;}

.tpMinute {margin-top:5px;}
.tpMinute td:Hover {background-color:black; color:white; }
.tpMinute td {background-color:#D9DBE1; text-align:center; cursor:pointer;}

/* Bouton X fermer */
.dpInvisibleButtons
{
border-style:none;
background-color:transparent;
padding:0px;
font-size:9px;
border-width:0px;
color:#222222;
vertical-align:middle;
cursor: pointer;
}



/* ============================================================================== */
/*  Module agenda                                                                 */
/* ============================================================================== */

.cal_other_month   { background: #DDDDDD; border: solid 1px #ACBCBB; padding-left: 2px; padding-right: 1px; padding-top: 0px; padding-bottom: 0px; }
.cal_past_month    { background: #EEEEEE; border: solid 1px #ACBCBB; padding-left: 2px; padding-right: 1px; padding-top: 0px; padding-bottom: 0px; }
.cal_current_month { background: #FFFFFF; border: solid 1px #ACBCBB; padding-left: 2px; padding-right: 1px; padding-top: 0px; padding-bottom: 0px; }
.cal_today         { background: #FFFFFF; border: solid 2px #6C7C7B; padding-left: 2px; padding-right: 1px; padding-top: 0px; padding-bottom: 0px; }
table.cal_event    { border-collapse: collapse; margin-bottom: 1px; }
table.cal_event td { border: 0px; padding-left: 0px; padding-right: 2px; padding-top: 0px; padding-bottom: 0px; } */
.cal_event a:link    { color: #111111; font-size: 11px; font-weight: normal !important; }
.cal_event a:visited { color: #111111; font-size: 11px; font-weight: normal !important; }
.cal_event a:active  { color: #111111; font-size: 11px; font-weight: normal !important; }
.cal_event a:hover   { color: #111111; font-size: 11px; font-weight: normal !important; }


/* ============================================================================== */
/*  Ajax - Liste deroulante de l'autocompletion                                   */
/* ============================================================================== */

.ui-widget { font-family: Verdana,Arial,sans-serif; font-size: 0.9em; }
.ui-autocomplete-loading { background: white url(<?php echo DOL_URL_ROOT.'/theme/eldy/img/working.gif' ?>) right center no-repeat; }

/* ============================================================================== */
/*  Ajax - In place editor                                                        */
/* ============================================================================== */

form.inplaceeditor-form { /* The form */
}

form.inplaceeditor-form input[type="text"] { /* Input box */
}

form.inplaceeditor-form textarea { /* Textarea, if multiple columns */
background: #FAF8E8;
color: black;
}

form.inplaceeditor-form input[type="submit"] { /* The submit button */
  font-size: 100%;
  font-weight:normal;
	border: 0px;
	background-image : url(<?php echo DOL_URL_ROOT.'/theme/eldy/img/button_bg.png' ?>);
	background-position : bottom;
	cursor:pointer;
}

form.inplaceeditor-form a { /* The cancel link */
  margin-left: 5px;
  font-size: 11px;
	font-weight:normal;
	border: 0px;
	background-image : url(<?php echo DOL_URL_ROOT.'/theme/eldy/img/button_bg.png' ?>);
	background-position : bottom;
	cursor:pointer;
}



/* ============================================================================== */
/* Admin Menu                                                                     */
/* ============================================================================== */

/* CSS a  appliquer a  l'arbre hierarchique */

/* Lien plier /deplier tout */
.arbre-switch {
	text-align: right;
	padding: 0 5px;
	margin: 0 0 -18px 0;
}

/* Arbre */
ul.arbre {
	padding: 5px 10px;
}
/* strong : A modifier en fonction de la balise choisie */
ul.arbre strong {
	font-weight: normal;
	padding: 0 0 0 20px;
	margin: 0 0 0 -7px;
	background-image: url(<?php echo DOL_URL_ROOT.'/theme/common/treemenu/branch.gif' ?>);
	background-repeat: no-repeat;
	background-position: 1px 50%;
}
ul.arbre strong.arbre-plier {
	background-image: url(<?php echo DOL_URL_ROOT.'/theme/common/treemenu/plus.gif' ?>);
	cursor: pointer;
}
ul.arbre strong.arbre-deplier {
	background-image: url(<?php echo DOL_URL_ROOT.'/theme/common/treemenu/minus.gif' ?>);
	cursor: pointer;
}
ul.arbre ul {
	padding: 0;
	margin: 0;
}
ul.arbre li {
	padding: 0;
	margin: 0;
	list-style: none;
}
ul.arbre li li {
	margin: 0 0 0 16px;
}
/* Classe pour masquer */
.hide {
	display: none;
}

img.menuNew
{
	display:block;
	border:0px;
}

img.menuEdit
{
	border: 0px;
	display: block;
}

img.menuDel
{
	display:none;
	border: 0px;
}

div.menuNew
{
	margin-top:-20px;
	margin-left:270px;
	height:20px;
	padding:0px;
	width:30px;
	position:relative;
}

div.menuEdit
{
	margin-top:-15px;
	margin-left:250px;
	height:20px;
	padding:0px;
	width:30px;
	position:relative;

}

div.menuDel
{
	margin-top:-20px;
	margin-left:290px;
	height:20px;
	padding:0px;
	width:30px;
	position:relative;

}

div.menuFleche
{
	margin-top:-16px;
	margin-left:320px;
	height:20px;
	padding:0px;
	width:30px;
	position:relative;

}



/* ============================================================================== */
/*  CSS for color picker                                                          */
/* ============================================================================== */

A.color, A.color:active, A.color:visited {
 position : relative;
 display : block;
 text-decoration : none;
 width : 10px;
 height : 10px;
 line-height : 10px;
 margin : 0px;
 padding : 0px;
 border : 1px inset white;
}
A.color:hover {
 border : 1px outset white;
}
A.none, A.none:active, A.none:visited, A.none:hover {
 position : relative;
 display : block;
 text-decoration : none;
 width : 10px;
 height : 10px;
 line-height : 10px;
 margin : 0px;
 padding : 0px;
 cursor : default;
 border : 1px solid #ccc5b3;
}
.tblColor {
 display : none;
}
.tdColor {
 padding : 1px;
}
.tblContainer {
 background-color : #DCDCB3;
}
.tblGlobal {
 position : absolute;
 top : 0px;
 left : 0px;
 display : none;
 background-color : #DCDCB3;
 border : 2px outset;
}
.tdContainer {
 padding : 5px;
}
.tdDisplay {
 width : 50%;
 height : 20px;
 line-height : 20px;
 border : 1px outset white;
}
.tdDisplayTxt {
 width : 50%;
 height : 24px;
 line-height : 12px;
 font-family: helvetica, verdana, arial, sans-serif;
 font-size : 8pt;
 color : black;
 text-align : center;
}
.btnColor {
 width : 100%;
 font-family: helvetica, verdana, arial, sans-serif;
 font-size : 10pt;
 padding : 0px;
 margin : 0px;
}
.btnPalette {
 width : 100%;
 font-family: helvetica, verdana, arial, sans-serif;
 font-size : 8pt;
 padding : 0px;
 margin : 0px;
}



/* Style to overwrites JQuery styles */
.ui-menu .ui-menu-item a {
	text-decoration:none;
	display:block;
	padding:.2em .4em;
	line-height:1.5;
	zoom:1;
	font-weight: normal;
	font-family:<?php echo $fontlist; ?>;
	font-size:1em;
}
.ui-widget {
	font-family:<?php echo $fontlist; ?>;
	font-size:<?php echo $fontsize; ?>px;
}
.ui-button { margin-left: -1px; }
.ui-button-icon-only .ui-button-text { height: 8px; }
.ui-button-icon-only .ui-button-text, .ui-button-icons-only .ui-button-text { padding: 2px 0px 6px 0px; }
.ui-button-text
{
	line-height: 1em !important;
}
.ui-autocomplete-input { margin: 0; padding: 1px; }


/* ============================================================================== */
/*  CKEditor                                                                      */
/* ============================================================================== */

.cke_editor table, .cke_editor tr, .cke_editor td
{
	border: 0px solid #FF0000 !important;
}
span.cke_skin_kama { padding: 0 ! important; }

a.cke_dialog_ui_button
{
	font-family: <?php print $fontlist ?> !important;
	background-image: url(<?php echo DOL_URL_ROOT.'/theme/yellow/img/button_bg.png' ?>) !important;
	background-position: bottom !important;
	border: 1px solid #ACBCBB !important;
	padding: 0.1em 0.7em !important;
	margin: 0em 0.5em !important;
	-moz-border-radius:0px 5px 0px 5px !important;
	-webkit-border-radius:0px 5px 0px 5px !important;
	border-radius:0px 5px 0px 5px !important;
	-moz-box-shadow: 4px 4px 4px #CCC !important;
	-webkit-box-shadow: 4px 4px 4px #CCC !important;
	box-shadow: 4px 4px 4px #CCC !important;
}


/* ============================================================================== */
/*  File upload                                                                   */
/* ============================================================================== */

.template-upload {
	height: 72px !important;
}

<?php
if (is_object($db)) $db->close();
