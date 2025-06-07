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
 * File Name: payement_suite.php
 * 	valide le payement et le type de reglement
 *
 * * * * Version:  8.0.0
 * * * * Modified: 07/06/2025
 *
 * File Authors:
 * 		Guy Hendrickx
 *
 */
require_once(__DIR__ . "/include/verif.php");
include_once(__DIR__ . "/include/config/common.php");
include_once(__DIR__ . "/include/config/var.php");
include_once(__DIR__ . sprintf('/include/language/%s.php', $lang));
function validateDate($date, $format = 'Y-m-d'): bool{#php.net/manual/fr/function.checkdate.php#113205
 $d = DateTime::createFromFormat($format, $date);
 return $d && $d->format($format) == $date;
}

$num=isset($_GET['num_fact'])?$_GET['num_fact']:"";
if($num !=''){
 $ok=isset($_GET['ir'])?'Irrecouvrable':'ok';
 $dat = date("Y-m-d");
 $sql2 = "UPDATE " . $tblpref .sprintf("facture SET payement='%s', date_pay = '", $ok).$dat."' WHERE num = '".$num."'";
 mysql_query($sql2) || die(sprintf('<p>Erreur Mysql<br/>%s<br/>', $sql2).mysql_error()."</p>");
 $message=sprintf('<h2>%s %s %s %s</h2>', $lang_facture, $lang_numero, $num, $lang_reglee);
}else{
 $num=isset($_POST['num'])?$_POST['num']:"";
 $dat=isset($_POST['date_pay'])?$_POST['date_pay']:"";
 if(validateDate($dat)){
  $methode=isset($_POST['methode'])?$_POST['methode']:"";
  $sql2 = "UPDATE " . $tblpref ."facture SET payement='".$methode."', date_pay = '".$dat."' WHERE num = '".$num."'";
  mysql_query($sql2) || die(sprintf('<p>Erreur Mysql<br/>%s<br/>', $sql2).mysql_error()."</p>");
  $message=sprintf('<h2>%s %s %s %s %s %s </h2>', $lang_facture, $lang_numero, $num, $lang_reglee, $lang_par, $methode);
 }else{
  $message=sprintf('<h1>%s</h1>', $lang_dat_inva);
 }
}

include_once(__DIR__ . "/lister_factures_non_reglees.php");
