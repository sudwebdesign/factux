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
 * File Name: insert_lot.php
 * 	Insertions des lots dans la table
 * 
 * * * Version:  5.0.0
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
$mois = date("m");
$annee = date("Y");
$jour = date("d");
$date_jour= $annee-$mois-$jour ;
 
$prod=isset($_POST['prod'])?$_POST['prod']:"";
for ($i=1; $i<13; $i++) {#2015
 $ing[$i] = isset($_POST["ing_$i"])?$_POST["ing_$i"]:"";
 $four[$i] = isset($_POST["four_$i"])?$_POST["four_$i"]:"";
 $lot_four[$i] = isset($_POST["lot_four_$i"])?$_POST["lot_four_$i"]:"";  
}

$sql1 = "INSERT INTO " . $tblpref ."lot(prod, actif, date) VALUES ('$prod', 'oui', '$annee-$mois-$jour')";
mysql_query($sql1) or die('Erreur SQL1 !<br>'.$sql1.'<br>'.mysql_error());
$num_lot = mysql_insert_id();//le numero de lot

for ($i=1; $i<13; $i++) {#2015
 if($ing[$i]!=''){
 $sql3 = "INSERT INTO " . $tblpref ."cont_lot(num_lot, ingr, fourn, fourn_lot) VALUES ('$num_lot', '".$ing[$i]."', '".$four[$i]."', '".$lot_four[$i]."')";
 mysql_query($sql3) or die('Erreur SQL3 !<br>'.$sql3.'<br>'.mysql_error());
 }
}
include_once("lister_lot.php");
