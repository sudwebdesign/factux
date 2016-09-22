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
