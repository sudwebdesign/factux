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
 * File Name: categorie_new.php
 * 	Enregistrement des nouvelles categories
 * 
 * * * Version:  1.1.5
 * * Modified: 25/05/2005
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
 
require_once("include/verif.php");
include_once("include/config/common.php");
include_once("include/language/$lang.php");
echo '<link rel="stylesheet" type="text/css" href="include/style.css">';
echo'<link rel="shortcut icon" type="image/x-icon" href="image/favicon.ico" >';

$categorie=isset($_POST['categorie'])?$_POST['categorie']:"";
$sql1 = "INSERT INTO " . $tblpref ."categorie(categorie) VALUES ('$categorie')";
mysql_query($sql1) or die('Erreur SQL !<br>'.$sql1.'<br>'.mysql_error());
$message = "<center><h2>$lang_nouv_categorie<br>";

include("form_article.php");
?> 