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
echo '<link rel="stylesheet" type="text/css" href="include/style.css">';
echo'<link rel="shortcut icon" type="image/x-icon" href="image/favicon.ico" >';
$num_client=isset($_POST['num_client'])?$_POST['num_client']:"";
$num_user=isset($_POST['num_user'])?$_POST['num_user']:"";
$sql = "SELECT permi from " . $tblpref ."client WHERE num_client = $num_client";
$result = mysql_query($sql) or die('Erreur');
$permi = mysql_result($result, 'permi');
$permi = ereg_replace("$num_user,",'', $permi);

$sql2 = "UPDATE " . $tblpref ."client SET permi = '".$permi."' WHERE num_client = '".$num_client."'";
mysql_query($sql2) OR die("<p>Erreur Mysql<br/>$sql2<br/>".mysql_error()."</p>");
include_once("editer_utilisateur.php");
 ?> 