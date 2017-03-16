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
require_once("include/verif.php");
include_once("include/config/common.php");
include_once("include/config/var.php");
include_once("include/language/$lang.php");
$lib=isset($_POST['lib'])?apostrophe($_POST['lib']):"";
$fourn=isset($_POST['fourn'])?apostrophe($_POST['fourn']):"";#new
$fournisseur=isset($_POST['fournisseur'])?$_POST['fournisseur']:"";#select
$prix=isset($_POST['prix'])?$_POST['prix']:"";
$tx_tva=isset($_POST['tva'])?$_POST['tva']:"";
$date=isset($_POST['date'])?$_POST['date']:"";
list($jour, $mois,$annee) = preg_split('/\//', $date, 3);

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
//calcul du montant de la tva
$mont_tva = ($prix * ($tx_tva /100));

if($fournisseur =='default'){
 $fourn=apostrophe($fourn);
 $sql1 = "INSERT INTO " . $tblpref ."depense(fournisseur, lib, prix, tx_tva, mont_tva, date) VALUES ('$fourn', '$lib', '$prix', '$tx_tva', '$mont_tva', '$annee-$mois-$jour')";
 mysql_query($sql1) or die('Erreur SQL !<br>'.$sql1.'<br>'.mysql_error());
 $message = "<h2>$lang_dep_enr</h2>";
}else{
 $fournisseur=apostrophe($fournisseur);
 $sql1 = "INSERT INTO " . $tblpref ."depense(fournisseur, lib, prix, tx_tva, mont_tva, date) VALUES ('$fournisseur', '$lib', '$prix', '$tx_tva', '$mont_tva', '$annee-$mois-$jour')";
 mysql_query($sql1) or die('Erreur SQL !<br>'.$sql1.'<br>'.mysql_error());
 $message ="<h2>$lang_dep_enr</h2>";  
}
include("form_depenses.php");
