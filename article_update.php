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
 * File Name: article_update.php
 * 	saisie de la modification d'un article
 * 
 * * Version:  1.1.5
 * * * * Modified: 23/07/2005
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
require_once("include/verif.php");
include_once("include/config/common.php");

include_once("include/language/$lang.php");
$article=isset($_POST['article'])?$_POST['article']:"";
$prix=isset($_POST['prix'])?$_POST['prix']:"";
$stock=isset($_POST['stock'])?$_POST['stock']:"";
$max=isset($_POST['max'])?$_POST['max']:"";
$min=isset($_POST['min'])?$_POST['min']:"";
$categorie=isset($_POST['categorie'])?$_POST['categorie']:"";

mysql_select_db($db) or die ("Could not select $db database");
$sql2 = "UPDATE " . $tblpref ."article SET `prix_htva`='".$prix."',`stock`='".$stock."',`stomin`='".$min."',`stomax`='".$max."', `cat`='".$categorie."'  
WHERE num ='".$article."' LIMIT 1 ";

mysql_query($sql2) OR die("<p>Erreur Mysql<br/>$sql2<br/>".mysql_error()."</p>");
$message= "<h2>$lang_stock_jour</h2><br><hr>";
include_once("lister_articles.php");
 ?> 