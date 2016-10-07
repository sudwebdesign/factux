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
 * * Version:  5.0.0
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
$tot_ht=isset($_POST['tot_ht'])?$_POST['tot_ht']:"";
$tot_tva=isset($_POST['tot_tva'])?$_POST['tot_tva']:"";
$bon_num=isset($_POST['bon_num'])?$_POST['bon_num']:"";
$coment=isset($_POST['coment'])?apostrophe($_POST['coment']):"";

$sql2 = "UPDATE " . $tblpref ."bon_comm SET tot_htva='".$tot_ht."'  WHERE num_bon = $bon_num";
mysql_query($sql2) OR die("<p>Erreur Mysql<br/>$sql2<br/>".mysql_error()."</p>");
$sql3 = "UPDATE " . $tblpref ."bon_comm SET tot_tva='".$tot_tva."'  WHERE num_bon = $bon_num";
mysql_query($sql3) OR die("<p>Erreur Mysql<br/>$sql3<br/>".mysql_error()."</p>");
$sql4 = "UPDATE " . $tblpref ."bon_comm SET coment='".$coment."'  WHERE num_bon = $bon_num";
mysql_query($sql4) OR die("<p>Erreur Mysql<br/>$sql4<br/>".mysql_error()."</p>");
$message= "<h2>$lang_enre</h2>";
include("form_commande.php");
