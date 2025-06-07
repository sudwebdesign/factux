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
 * File Name: edit_lot_suite.php
 * 	Insertions des lots dans la table apres edition
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
include_once(__DIR__ . "/include/utils.php");
$mois = date("m");
$annee = date("Y");
$jour =date("d");
$date_jour= $annee-$mois-$jour ;

$prod=isset($_POST['prod'])?$_POST['prod']:"";
$num_lot=isset($_POST['num_lot'])?$_POST['num_lot']:"";
if(1!=1){
/*
$ing_1 =isset($_POST['ing_1'])?$_POST['ing_1']:"";
$four_1=isset($_POST['four_1'])?$_POST['four_1']:"";
$lot_four_1=isset($_POST['lot_four_1'])?$_POST['lot_four_1']:"";
$num_cont_bon_1=isset($_POST['num_cont_bon_1'])?$_POST['num_cont_bon_1']:"";


$ing_2 =isset($_POST['ing_2'])?$_POST['ing_2']:"";
$four_2=isset($_POST['four_2'])?$_POST['four_2']:"";
$lot_four_2=isset($_POST['lot_four_2'])?$_POST['lot_four_2']:"";
$num_cont_bon_2=isset($_POST['num_cont_bon_2'])?$_POST['num_cont_bon_2']:"";

$ing_3 =isset($_POST['ing_3'])?$_POST['ing_3']:"";
$four_3=isset($_POST['four_3'])?$_POST['four_3']:"";
$lot_four_3=isset($_POST['lot_four_3'])?$_POST['lot_four_3']:"";
$num_cont_bon_3=isset($_POST['num_cont_bon_3'])?$_POST['num_cont_bon_3']:"";

$ing_4 =isset($_POST['ing_4'])?$_POST['ing_4']:"";
$four_4=isset($_POST['four_4'])?$_POST['four_4']:"";
$lot_four_4=isset($_POST['lot_four_4'])?$_POST['lot_four_4']:"";
$num_cont_bon_4=isset($_POST['num_cont_bon_4'])?$_POST['num_cont_bon_4']:"";

$ing_5 =isset($_POST['ing_5'])?$_POST['ing_5']:"";
$four_5=isset($_POST['four_5'])?$_POST['four_5']:"";
$lot_four_5=isset($_POST['lot_four_5'])?$_POST['lot_four_5']:"";
$num_cont_bon_5=isset($_POST['num_cont_bon_5'])?$_POST['num_cont_bon_5']:"";

$ing_6 =isset($_POST['ing_6'])?$_POST['ing_6']:"";
$four_6=isset($_POST['four_6'])?$_POST['four_6']:"";
$lot_four_6=isset($_POST['lot_four_6'])?$_POST['lot_four_6']:"";
$num_cont_bon_6=isset($_POST['num_cont_bon_6'])?$_POST['num_cont_bon_6']:"";

$ing_7 =isset($_POST['ing_7'])?$_POST['ing_7']:"";
$four_7=isset($_POST['four_7'])?$_POST['four_7']:"";
$lot_four_7=isset($_POST['lot_four_7'])?$_POST['lot_four_7']:"";
$num_cont_bon_7=isset($_POST['num_cont_bon_7'])?$_POST['num_cont_bon_7']:"";

$ing_8 =isset($_POST['ing_8'])?$_POST['ing_8']:"";
$four_8=isset($_POST['four_8'])?$_POST['four_8']:"";
$lot_four_8=isset($_POST['lot_four_8'])?$_POST['lot_four_8']:"";
$num_cont_bon_8=isset($_POST['num_cont_bon_8'])?$_POST['num_cont_bon_8']:"";

$ing_9 =isset($_POST['ing_9'])?$_POST['ing_9']:"";
$four_9=isset($_POST['four_9'])?$_POST['four_9']:"";
$lot_four_9=isset($_POST['lot_four_9'])?$_POST['lot_four_9']:"";
$num_cont_bon_9=isset($_POST['num_cont_bon_9'])?$_POST['num_cont_bon_9']:"";

$ing_10 =isset($_POST['ing_10'])?$_POST['ing_10']:"";
$four_10=isset($_POST['four_10'])?$_POST['four_10']:"";
$lot_four_10=isset($_POST['lot_four_10'])?$_POST['lot_four_10']:"";
$num_cont_bon_10=isset($_POST['num_cont_bon_10'])?$_POST['num_cont_bon_10']:"";

$ing_11 =isset($_POST['ing_11'])?$_POST['ing_11']:"";
$four_11=isset($_POST['four_11'])?$_POST['four_11']:"";
$lot_four_11=isset($_POST['lot_four_11'])?$_POST['lot_four_11']:"";
$num_cont_bon_11=isset($_POST['num_cont_bon_11'])?$_POST['num_cont_bon_11']:"";
*/
}

for ($i=1; $i<13; $i++) {
 $o = isset($_POST['ing_' . $i])?$_POST['ing_' . $i]:"";
 $a = isset($_POST['four_' . $i])?$_POST['four_' . $i]:"";
 $b = isset($_POST['lot_four_' . $i])?$_POST['lot_four_' . $i]:"";
 $c = isset($_POST['num_cont_bon_' . $i])?$_POST['num_cont_bon_' . $i]:"";
#echo "$o $a $b $c <br>";
 if($o != '' && $c != ''){#if($o !=''and $c !=''){
  $sql2 = "UPDATE " . $tblpref .sprintf("cont_lot SET ingr='%s', fourn='%s', fourn_lot='%s' WHERE num = '%s'", $o, $a, $b, $c);
  mysql_query($sql2) || die(sprintf('<p>Erreur Mysql<br/>%s<br/>', $sql2).mysql_error()."</p>");
 }

 if($o != '' && $c == ''){#if($o !=''and $c ==''){
  $sql3 = "INSERT INTO " . $tblpref .sprintf("cont_lot(num_lot, ingr, fourn, fourn_lot) VALUES ('%s', '%s', '%s', '%s')", $num_lot, $o, $a, $b);
  mysql_query($sql3) || die(sprintf('<p>Erreur Mysql<br/>%s<br/>', $sql3).mysql_error()."</p>");
 }

 if($o == '' && $b == '' && $a == '' && $c != ''){#if($o =='' and $b=='' and $a =='' and $c !=''){
  echo sprintf('ligne %s a suprimer', $c);
  $sql5="DELETE FROM " . $tblpref .sprintf("cont_lot WHERE num = '%s'", $c);
  mysql_query($sql5) || die(sprintf('<p>Erreur Mysql<br/>%s<br/>', $sql5).mysql_error()."</p>");
 }
}

//fin for
$sql4 = "UPDATE " . $tblpref .sprintf("lot SET prod ='%s' WHERE num = '%s'", $prod, $num_lot);
mysql_query($sql4) || die(sprintf('<p>Erreur Mysql<br/>%s<br/>', $sql4).mysql_error()."</p>");
$message=sprintf('<h2>%s %s</h2>', $lang_lot_maj, $prod);
//RETOUR
$_GET['mois_1']=$_POST['mois_1'];
$_GET['annee_1']=$_POST['annee_1'];
include(__DIR__ . "/lister_lot.php");
