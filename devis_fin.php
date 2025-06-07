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
$tot_ht=isset($_POST['tot_ht'])?$_POST['tot_ht']:"";
$tot_tva=isset($_POST['tot_tva'])?$_POST['tot_tva']:"";
$dev_num=isset($_POST['dev_num'])?$_POST['dev_num']:"";
$coment=isset($_POST['coment'])?$_POST['coment']:"";

$sql2 = "UPDATE " . $tblpref ."devis SET tot_htva='".$tot_ht.("'  WHERE num_dev = " . $dev_num);
mysql_query($sql2) || die(sprintf('<p>Erreur Mysql1<br/>%s<br/>', $sql2).mysql_error()."</p>");
$sql3 = "UPDATE " . $tblpref ."devis SET tot_tva='".$tot_tva.("'  WHERE num_dev = " . $dev_num);
mysql_query($sql3) || die(sprintf('<p>Erreur Mysql2<br/>%s<br/>', $sql3).mysql_error()."</p>");
$sql4 = "UPDATE " . $tblpref ."devis SET coment='".$coment.("'  WHERE num_dev = " . $dev_num);
mysql_query($sql4) || die(sprintf('<p>Erreur Mysql2<br/>%s<br/>', $sql4).mysql_error()."</p>");
$message= sprintf('<h2>%s %s</h2>', $lang_devis, $lang_enregistre);
include(__DIR__ . "/form_devis.php");
