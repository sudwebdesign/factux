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
 * File Name: fckconfig.js
 * 	Editor configuration settings.
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
echo '<link rel="stylesheet" type="text/css" href="include/style.css">';
echo'<link rel="shortcut icon" type="image/x-icon" href="image/favicon.ico" >';
$lib=isset($_POST['lib'])?$_POST['lib']:"";
$prix=isset($_POST['prix'])?$_POST['prix']:"";
$fourn=isset($_POST['fourn'])?$_POST['fourn']:"";
$fournisseur=isset($_POST['fournisseur'])?$_POST['fournisseur']:"";
$date=isset($_POST['date'])?$_POST['date']:"";
list($jour, $mois,$annee) = preg_split('/\//', $date, 3);
//$mois=isset($_POST['mois'])?$_POST['mois']:"";
//$jour=isset($_POST['jour'])?$_POST['jour']:"";
$fournisseur = stripslashes($fournisseur);
if($lib==''|| $prix=='')
{
echo $lang_oublie_champ;
include('form_depenses.php');
exit;
}
if ($fourn=='' and $fournisseur=='default') { 
echo "<center><h1>$lang_dep_choi";
include('form_depenses.php');
exit;  
}
if ($fournisseur =='default') {
$fourn= addslashes($fourn);
  mysql_select_db($db) or die ("Could not select $db database");
$sql1 = "INSERT INTO " . $tblpref ."depense(fournisseur, lib, prix, date) VALUES ('$fourn', '$lib', '$prix', '$annee-$mois-$jour')";
mysql_query($sql1) or die('Erreur SQL !<br>'.$sql1.'<br>'.mysql_error());
echo "<center><br><h2>$lang_dep_enr<br><hr>";
} else {
$fournisseur=addslashes($fournisseur);
mysql_select_db($db) or die ("Could not select $db database");
$sql1 = "INSERT INTO " . $tblpref ."depense(fournisseur, lib, prix, date) VALUES ('$fournisseur', '$lib', '$prix', '$annee-$mois-$jour')";
mysql_query($sql1) or die('Erreur SQL !<br>'.$sql1.'<br>'.mysql_error());
$message="<center><h2>$lang_dep_enr</h2>";  
}

include("form_depenses.php");

 ?> 