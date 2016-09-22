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
$num_client=isset($_POST['num_client'])?$_POST['num_client']:"";
$num_user=isset($_POST['num_user'])?$_POST['num_user']:"";
$sql = "SELECT permi from " . $tblpref ."client WHERE num_client = $num_client";
$result = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$permi = mysql_result($result, 0);
$permi = str_replace($num_user.',','', $permi);#ereg_replace("$num_user,",'', $permi);
$sql = "UPDATE " . $tblpref ."client SET permi = '".$permi."' WHERE num_client = '".$num_client."'";
mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$message="<h2>$lang_suite_edit_utilisateur_succes</h2>";
include_once("edit_utilisateur.php");
