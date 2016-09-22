<?php 
/*
 * actifux le actifurier libre
 * Copyright (C) 2003-2004 Guy Hendrickx
 * 
 * Licensed under the terms of the GNU  General Public License:
 * 		http://www.opensource.org/licenses/gpl-license.php
 * 
 * For further information visit:
 * 		http://actifux.sourceforge.net
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
