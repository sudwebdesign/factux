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
require_once(__DIR__ . "/include/verif.php");
include_once(__DIR__ . "/include/config/common.php");
include_once(__DIR__ . "/include/config/var.php");
include_once(__DIR__ . sprintf('/include/language/%s.php', $lang));
$num_client=isset($_POST['num_client'])?$_POST['num_client']:"";
$num_user=isset($_POST['num_user'])?$_POST['num_user']:"";
$sql = "SELECT permi from " . $tblpref .('client WHERE num_client = ' . $num_client);
$result = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$permi = mysql_result($result, 0);
$permi = str_replace($num_user.',','', $permi);#ereg_replace("$num_user,",'', $permi);
$sql = "UPDATE " . $tblpref ."client SET permi = '".$permi."' WHERE num_client = '".$num_client."'";
mysql_query($sql) || die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$message=sprintf('<h2>%s</h2>', $lang_suite_edit_utilisateur_succes);
include_once(__DIR__ . "/edit_utilisateur.php");
