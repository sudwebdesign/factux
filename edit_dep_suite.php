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
include_once("include/head.php");
include_once("include/language/$lang.php");
$lib=isset($_POST['lib'])?$_POST['lib']:"";
$four=isset($_POST['four'])?$_POST['four']:"";
$prix=isset($_POST['prix'])?$_POST['prix']:"";
$num=isset($_POST['num'])?$_POST['num']:"";



echo '<link rel="stylesheet" type="text/css" href="include/style.css">';
echo'<link rel="shortcut icon" type="image/x-icon" href="image/favicon.ico" >';
mysql_select_db($db) or die ("Could not select $db database");
$sql2 = "UPDATE " . $tblpref ."depense SET lib = '".$lib."' , fournisseur = '".$four."' , prix = '".$prix."' WHERE num = $num ";
mysql_query($sql2) OR die("<p>Erreur Mysql<br/>$sql2<br/>".mysql_error()."</p>");
echo "<h2>Dépense mise à jour</h2>";
include_once("lister_depenses.php");
include_once("include/bas.php");
//echo "$num $prix";
 ?> 