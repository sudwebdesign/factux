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
include_once("include/verif.php");
include_once("include/config/common.php");
include_once("include/config/var.php");
include_once("include/language/$lang.php");
$id_cat=isset($_GET['id_cat'])?$_GET['id_cat']:"";
$categorie=isset($_GET['categorie'])?$_GET['categorie']:"";
$sql = "SELECT actif FROM " . $tblpref ."article WHERE cat = $id_cat";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_array($req)){
 $actif = $data['actif'];
}
if(isset($actif)&&$actif==''){
 $message = "<h1>$lang_err_efa_cat</h1>";
 include('lister_cat.php');
 exit;
}
/* idée option
$sql = "UPDATE " . $tblpref ."article SET actif='non' WHERE cat = '".$id_cat."'";
mysql_query($sql) OR die("<p>Erreur Mysql<br/>$sql<br/>".mysql_error()."</p>");
*/
$sql = "UPDATE " . $tblpref ."article SET cat='' WHERE cat = '".$id_cat."'";
mysql_query($sql) OR die("<p>Erreur Mysql<br/>$sql<br/>".mysql_error()."</p>");

$sql = "DELETE FROM " . $tblpref ."categorie WHERE id_cat = '".$id_cat."'";
mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$message= "<h2>$lang_cat_eff</h2>";
include('lister_cat.php');
