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
 *.
 */
require_once("include/verif.php");
include_once("include/config/common.php");

$num=isset($_GET['num'])?$_GET['num']:"";
if($num !=''){

$sql2 = "UPDATE " . $tblpref ."facture SET payement='ok' WHERE num = '".$num."'";
mysql_query($sql2) OR die("<p>Erreur Mysql<br/>$sql2<br/>".mysql_error()."</p>");
$message="<center><h2>facture $num reglée</h2>";
}else{
$num=isset($_POST['num'])?$_POST['num']:"";
$methode=isset($_POST['methode'])?$_POST['methode']:"";
$sql2 = "UPDATE " . $tblpref ."facture SET payement='$methode' WHERE num = '".$num."'";
mysql_query($sql2) OR die("<p>Erreur Mysql<br/>$sql2<br/>".mysql_error()."</p>");
$message="<center><h2>facture $num reglée par $methode </h2>";
}
include_once("lister_factures_non_reglees.php");
 ?> 