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
 * * * * Version:  5.0.1
 * * * * Modified: 10/06/2017
 *
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
require_once("include/verif.php");
include_once("include/config/common.php");
include_once("include/config/var.php");
include_once("include/language/$lang.php");
$lib=isset($_POST['lib'])?$_POST['lib']:"";
$fourn=isset($_POST['fourn'])?$_POST['fourn']:"";#new
$fournisseur=isset($_POST['fournisseur'])?$_POST['fournisseur']:"";#select
$prix=floatval(isset($_POST['prix'])?$_POST['prix']:"");
$tx_tva=floatval(isset($_POST['tva'])?$_POST['tva']:"");
$date=isset($_POST['date'])?$_POST['date']:"";

if($lib==''|| $prix=='' || $tx_tva==''){
 $message = "<h1>$lang_oublie_champ</h1>";
 include('form_depenses.php');
 exit;
}
if($fourn=='' and $fournisseur=='default'){
 $message = "<h1>$lang_dep_choi</h1>";
 include('form_depenses.php');
 exit;
}
list($jour, $mois,$annee) = preg_split('/\//', $date, 3);
//calcul du montant de la tva
$mont_tva = ($prix * ($tx_tva /100));

if($fournisseur =='default'){
 $sql1 = "INSERT INTO " . $tblpref ."depense(fournisseur, lib, prix, tx_tva, mont_tva, date) VALUES ('$fourn', '$lib', '$prix', '$tx_tva', '$mont_tva', '$annee-$mois-$jour')";
 mysql_query($sql1) or die('Erreur SQL !<br>'.$sql1.'<br>'.mysql_error());
 $message = "<h2>$lang_dep_enr</h2>";
}else{
 $sql1 = "INSERT INTO " . $tblpref ."depense(fournisseur, lib, prix, tx_tva, mont_tva, date) VALUES ('$fournisseur', '$lib', '$prix', '$tx_tva', '$mont_tva', '$annee-$mois-$jour')";
 mysql_query($sql1) or die('Erreur SQL !<br>'.$sql1.'<br>'.mysql_error());
 $message ="<h2>$lang_dep_enr</h2>";
}
include("form_depenses.php");
