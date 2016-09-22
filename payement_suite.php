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
 * File Name: payement_suite.php
 * 	valide le payement et le type de reglement
 * 
 * * * Version:  1.1.5
 * * * * Modified: 23/07/2005
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.irrécouvrable
 */
require_once("include/verif.php");
include_once("include/config/common.php");
include_once("include/config/var.php");
include_once("include/language/$lang.php");
function validateDate($date, $format = 'Y-m-d'){#php.net/manual/fr/function.checkdate.php#113205
 $d = DateTime::createFromFormat($format, $date);
 return $d && $d->format($format) == $date;
}
$num=isset($_GET['num_fact'])?$_GET['num_fact']:"";
if($num !=''){
 $ok=isset($_GET['ir'])?'Irrecouvrable':'ok';
 $dat = date("Y-m-d");
 $sql2 = "UPDATE " . $tblpref ."facture SET payement='$ok', date_pay = '".$dat."' WHERE num = '".$num."'";
 mysql_query($sql2) OR die("<p>Erreur Mysql<br/>$sql2<br/>".mysql_error()."</p>");
 $message="<h2>$lang_facture $lang_numero $num $lang_reglee</h2>";
}else{
 $num=isset($_POST['num'])?$_POST['num']:"";
 $dat=isset($_POST['date_pay'])?$_POST['date_pay']:"";
 if(validateDate($dat)){
  $methode=isset($_POST['methode'])?$_POST['methode']:"";
  $sql2 = "UPDATE " . $tblpref ."facture SET payement='".$methode."', date_pay = '".$dat."' WHERE num = '".$num."'";
  mysql_query($sql2) OR die("<p>Erreur Mysql<br/>$sql2<br/>".mysql_error()."</p>");
  $message="<h2>$lang_facture $lang_numero $num $lang_reglee $lang_par $methode </h2>";
 }else{
  $message="<h1>$lang_dat_inva</h1>";
 }
}
include_once("lister_factures_non_reglees.php");
