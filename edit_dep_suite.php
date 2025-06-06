<?php
/*
 * Factux le facturier libre
 * Copyright (C) 2003-2005 Guy Hendrickx, 2017 Thomas Ingles
 *
 * Licensed under the terms of the GNU  General Public License:
 * 		http://opensource.org/licenses/GPL-3.0
 *
 * For further information visit:
 * 		http://factux.free.fr
 *
 * File Name: fckconfig.js
 * 	Editor configuration settings.
 *
 * * * Version:  5.0.0
 * * * * Modified: 07/10/2016
 *
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
require_once("include/verif.php");
include_once("include/config/common.php");
include_once("include/config/var.php");
include_once("include/language/$lang.php");
$lib=isset($_POST['lib'])?$_POST['lib']:"";
$four=isset($_POST['four'])?$_POST['four']:"";
$prix=isset($_POST['prix'])?$_POST['prix']:"";
$num=isset($_POST['num'])?$_POST['num']:"";
$sql2 = "UPDATE " . $tblpref ."depense SET lib = '".$lib."' , fournisseur = '".$four."' , prix = '".$prix."' WHERE num = $num ";
mysql_query($sql2) OR die("<p>Erreur Mysql<br/>$sql2<br/>".mysql_error()."</p>");
$message = "<h2>$lang_dep_maj</h2>";
include("lister_depenses.php");
