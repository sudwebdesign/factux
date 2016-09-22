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
 * File Name: insert_lot.php
 * 	Insertions des lots dans la table
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
//$guy = count($_POST);
//echo "$guy post";
//foreach ($_POST as $value) {
//       print "$value <br>";
  //     }
$prod=isset($_POST['prod'])?$_POST['prod']:"";

$ing_1 =isset($_POST['ing_1'])?$_POST['ing_1']:"";
$four_1=isset($_POST['four_1'])?$_POST['four_1']:"";
$lot_four_1=isset($_POST['lot_four_1'])?$_POST['lot_four_1']:"";  

$ing_2 =isset($_POST['ing_2'])?$_POST['ing_2']:"";
$four_2=isset($_POST['four_2'])?$_POST['four_2']:"";
$lot_four_2=isset($_POST['lot_four_2'])?$_POST['lot_four_2']:"";

$ing_3 =isset($_POST['ing_3'])?$_POST['ing_3']:"";
$four_3=isset($_POST['four_3'])?$_POST['four_3']:"";
$lot_four_3=isset($_POST['lot_four_3'])?$_POST['lot_four_3']:"";

$ing_4 =isset($_POST['ing_4'])?$_POST['ing_4']:"";
$four_4=isset($_POST['four_4'])?$_POST['four_4']:"";
$lot_four_4=isset($_POST['lot_four_4'])?$_POST['lot_four_4']:"";

$ing_5 =isset($_POST['ing_5'])?$_POST['ing_5']:"";
$four_5=isset($_POST['four_5'])?$_POST['four_5']:"";
$lot_four_5=isset($_POST['lot_four_5'])?$_POST['lot_four_5']:"";

$ing_6 =isset($_POST['ing_6'])?$_POST['ing_6']:"";
$four_6=isset($_POST['four_6'])?$_POST['four_6']:"";
$lot_four_6=isset($_POST['lot_four_6'])?$_POST['lot_four_6']:"";

$ing_7 =isset($_POST['ing_7'])?$_POST['ing_7']:"";
$four_7=isset($_POST['four_7'])?$_POST['four_7']:"";
$lot_four_7=isset($_POST['lot_four_7'])?$_POST['lot_four_7']:"";

$ing_8 =isset($_POST['ing_8'])?$_POST['ing_8']:"";
$four_8=isset($_POST['four_8'])?$_POST['four_8']:"";
$lot_four_8=isset($_POST['lot_four_8'])?$_POST['lot_four_8']:"";

$ing_9 =isset($_POST['ing_9'])?$_POST['ing_9']:"";
$four_9=isset($_POST['four_9'])?$_POST['four_9']:"";
$lot_four_9=isset($_POST['lot_four_9'])?$_POST['lot_four_9']:"";

$ing_10 =isset($_POST['ing_10'])?$_POST['ing_10']:"";
$four_10=isset($_POST['four_10'])?$_POST['four_10']:"";
$lot_four_10=isset($_POST['lot_four_10'])?$_POST['lot_four_10']:"";

$ing_11 =isset($_POST['ing_11'])?$_POST['ing_11']:"";
$four_11=isset($_POST['four_11'])?$_POST['four_11']:"";
$lot_four_11=isset($_POST['lot_four_11'])?$_POST['lot_four_11']:"";

$sql1 = "INSERT INTO " . $tblpref ."lot(prod, actif, date) VALUES ('$prod', 'oui', '$annee-$mois-$jour')";
mysql_query($sql1) or die('Erreur SQL1 !<br>'.$sql1.'<br>'.mysql_error());

$sql2="SELECT MAX(num)as max FROM " . $tblpref ."lot WHERE 1";

$req2 = mysql_query($sql2) or die('Erreur SQL2 !<br>'.$sql2.'<br>'.mysql_error());
while($data = mysql_fetch_array($req2))
{
  $max = $data['max'];

	}

if($ing_1!=''){
$sql3 = "INSERT INTO " . $tblpref ."cont_lot(num_lot, ingr, fourn, fourn_lot) VALUES ('$max', '$ing_1', '$four_1', '$lot_four_1')";
mysql_query($sql3) or die('Erreur SQL3 !<br>'.$sql3.'<br>'.mysql_error());
}
if($ing_2!=''){
$sql3 = "INSERT INTO " . $tblpref ."cont_lot(num_lot, ingr, fourn, fourn_lot) VALUES ('$max', '$ing_2', '$four_2', '$lot_four_2')";
mysql_query($sql3) or die('Erreur SQL3 !<br>'.$sql3.'<br>'.mysql_error());
}

if($ing_3!=''){
$sql3 = "INSERT INTO " . $tblpref ."cont_lot(num_lot, ingr, fourn, fourn_lot) VALUES ('$max', '$ing_3', '$four_3', '$lot_four_3')";
mysql_query($sql3) or die('Erreur SQL3 !<br>'.$sql3.'<br>'.mysql_error());
}

if($ing_4!=''){
$sql3 = "INSERT INTO " . $tblpref ."cont_lot(num_lot, ingr, fourn, fourn_lot) VALUES ('$max', '$ing_4', '$four_4', '$lot_four_4')";
mysql_query($sql3) or die('Erreur SQL3 !<br>'.$sql3.'<br>'.mysql_error());
}

if($ing_5!=''){
$sql3 = "INSERT INTO " . $tblpref ."cont_lot(num_lot, ingr, fourn, fourn_lot) VALUES ('$max', '$ing_5', '$four_5', '$lot_four_5')";
mysql_query($sql3) or die('Erreur SQL3 !<br>'.$sql3.'<br>'.mysql_error());
}

if($ing_6!=''){
$sql3 = "INSERT INTO " . $tblpref ."cont_lot(num_lot, ingr, fourn, fourn_lot) VALUES ('$max', '$ing_6', '$four_6', '$lot_four_6')";
mysql_query($sql3) or die('Erreur SQL3 !<br>'.$sql3.'<br>'.mysql_error());
}

if($ing_7!=''){
$sql3 = "INSERT INTO " . $tblpref ."cont_lot(num_lot, ingr, fourn, fourn_lot) VALUES ('$max', '$ing_7', '$four_7', '$lot_four_7')";
mysql_query($sql3) or die('Erreur SQL3 !<br>'.$sql3.'<br>'.mysql_error());
}

if($ing_8!=''){
$sql3 = "INSERT INTO " . $tblpref ."cont_lot(num_lot, ingr, fourn, fourn_lot) VALUES ('$max', '$ing_8', '$four_8', '$lot_four_8')";
mysql_query($sql3) or die('Erreur SQL3 !<br>'.$sql3.'<br>'.mysql_error());
}

if($ing_9!=''){
$sql3 = "INSERT INTO " . $tblpref ."cont_lot(num_lot, ingr, fourn, fourn_lot) VALUES ('$max', '$ing_9', '$four_9', '$lot_four_9')";
mysql_query($sql3) or die('Erreur SQL3 !<br>'.$sql3.'<br>'.mysql_error());
}

if($ing_10!=''){
$sql3 = "INSERT INTO " . $tblpref ."cont_lot(num_lot, ingr, fourn, fourn_lot) VALUES ('$max', '$ing_10', '$four_10', '$lot_four_10')";
mysql_query($sql3) or die('Erreur SQL3 !<br>'.$sql3.'<br>'.mysql_error());
}

if($ing_11!=''){
$sql3 = "INSERT INTO " . $tblpref ."cont_lot(num_lot, ingr, fourn, fourn_lot) VALUES ('$max', '$ing_1', '$four_11', '$lot_four_11')";
mysql_query($sql3) or die('Erreur SQL3 !<br>'.$sql3.'<br>'.mysql_error());
}



include_once("lister_lot.php");
?> 