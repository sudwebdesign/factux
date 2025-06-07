<?php
/*
 * Factux le facturier libre
 * Copyright (C) 2003-2005 Guy Hendrickx, 2017~ Thomas Ingles
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
 * * * * Version:  8.0.0
 * * * * Modified: 07/06/2025
 *
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
require_once(__DIR__ . "/include/verif.php");
include_once(__DIR__ . "/include/config/common.php");
include_once(__DIR__ . "/include/config/var.php");
include_once(__DIR__ . sprintf('/include/language/%s.php', $lang));
$tot_ht=isset($_POST['tot_ht'])?$_POST['tot_ht']:"";
$tot_tva=isset($_POST['tot_tva'])?$_POST['tot_tva']:"";
$bon_num=isset($_POST['bon_num'])?$_POST['bon_num']:"";
$coment=isset($_POST['coment'])?$_POST['coment']:"";

$sql2 = "UPDATE " . $tblpref ."bon_comm SET tot_htva='".$tot_ht.("'  WHERE num_bon = " . $bon_num);
mysql_query($sql2) || die(sprintf('<p>Erreur Mysql<br/>%s<br/>', $sql2).mysql_error()."</p>");
$sql3 = "UPDATE " . $tblpref ."bon_comm SET tot_tva='".$tot_tva.("'  WHERE num_bon = " . $bon_num);
mysql_query($sql3) || die(sprintf('<p>Erreur Mysql<br/>%s<br/>', $sql3).mysql_error()."</p>");
$sql4 = "UPDATE " . $tblpref ."bon_comm SET coment='".$coment.("'  WHERE num_bon = " . $bon_num);
mysql_query($sql4) || die(sprintf('<p>Erreur Mysql<br/>%s<br/>', $sql4).mysql_error()."</p>");
$message= sprintf('<h2>%s</h2>', $lang_enre);
include(__DIR__ . "/form_commande.php");
