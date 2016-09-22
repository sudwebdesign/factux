<?php 
/*
 * Factux le facturier libre
 * Copyright (C) 2003-2004 Guy Hendrickx
 * 
 * Licensed under the terms of the GNU  General Public License:
 * 		http://www.opensource.org/licenses/gpl-license.php
 * 
 * For further information visit:
 * 		http://factux.sourceforge.net
 * 
 * File Name: fckconfig.js
 * 	Editor configuration settings.
 * 
 * * * Version:  1.1.5
 * * * * Modified: 23/07/2005
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
require_once("include/verif.php");
include_once("include/config/common.php");
include_once("include/config/var.php");
include_once("include/language/$lang.php");
$lib=isset($_POST['lib'])?apostrophe($_POST['lib']):"";
$four=isset($_POST['four'])?apostrophe($_POST['four']):"";
$prix=isset($_POST['prix'])?$_POST['prix']:"";
$num=isset($_POST['num'])?$_POST['num']:"";
$sql2 = "UPDATE " . $tblpref ."depense SET lib = '".$lib."' , fournisseur = '".$four."' , prix = '".$prix."' WHERE num = $num ";
mysql_query($sql2) OR die("<p>Erreur Mysql<br/>$sql2<br/>".mysql_error()."</p>");
$message = "<h2>$lang_dep_maj</h2>";
include("lister_depenses.php");
