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
 * File Name: edit_lot_suite.php
 * 	Insertions des lots dans la table apres edition
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
include_once("include/language/$lang.php");
include_once("include/utils.php");
$mois = date("m");
$annee = date("Y");
$jour =date("d");
$date_jour= $annee-$mois-$jour ;

$prod=isset($_POST['prod'])?$_POST['prod']:"";
$num_lot=isset($_POST['num_lot'])?$_POST['num_lot']:"";

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


for ($i=1; $i<12; $i++) {

$o = "ing_$i";
$a = "four_$i";
$b = "lot_four_$i";
$c = "num_cont_bon_$i";


if($$o !=''and $$c !=''){

$sql2 = "UPDATE " . $tblpref ."cont_lot SET ingr='{$$o}', fourn='{$$a}', fourn_lot='{$$b}' WHERE num = '{$$c}'";

mysql_query($sql2) OR die("<p>Erreur Mysql<br/>$sql2<br/>".mysql_error()."</p>");
}//fin if
if($$o !=''and $$c ==''){

$sql3 = "INSERT INTO " . $tblpref ."cont_lot(num_lot, ingr, fourn, fourn_lot) VALUES ('$num_lot', '{$$o}', '{$$a}', '{$$b}')";

mysql_query($sql3) OR die("<p>Erreur Mysql<br/>$sql3<br/>".mysql_error()."</p>");

}
if($$o =='' and $$b=='' and $$a =='' and $$c !=''){
echo"ligne {$$c} a suprimer";
$sql5="DELETE FROM " . $tblpref ."cont_lot WHERE num = '{$$c}'";
mysql_query($sql5) OR die("<p>Erreur Mysql<br/>$sql5<br/>".mysql_error()."</p>");
}

}//fin for

$sql4 = "UPDATE " . $tblpref ."lot SET prod ='".$prod."' WHERE num = '".$num_lot."'";
mysql_query($sql4) OR die("<p>Erreur Mysql<br/>$sql4<br/>".mysql_error()."</p>");
include("lister_lot.php");


