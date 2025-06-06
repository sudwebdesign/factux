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
 * File Name: article_update.php
 * 	saisie de la modification d'un article
 * 
 * * Version:  5.0.0
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
$nom=isset($_POST['nom'])?$_POST['nom']:"";
$num=isset($_POST['num'])?$_POST['num']:"";
$prix=floatval(isset($_POST['prix'])?$_POST['prix']:"");
$commentaire=isset($_POST['commentaire'])?apostrophe($_POST['commentaire']):"";###
$marge=floatval(isset($_POST['marge'])?$_POST['marge']:"");
$stock=floatval(isset($_POST['stock'])?$_POST['stock']:"");
$max=floatval(isset($_POST['max'])?$_POST['max']:"");
$min=floatval(isset($_POST['min'])?$_POST['min']:"");
$categorie=intval(isset($_POST['categorie'])?$_POST['categorie']:"");

$article=isset($_POST['article'])?apostrophe($_POST['article']):"";### ‘	&#145;	&lsquo;	Left single quotation mark ::: 4 change Single quote (') http://ascii-code.com/
$uni=isset($_POST['uni'])?$_POST['uni']:"";
$taux_tva=floatval(isset($_POST['taux_tva'])?$_POST['taux_tva']:"");
$set='';
if($article!="")#jamais commandé
 $set.=",
`article`='".$article."'
";
if($uni!="")#jamais commandé
 $set.=",
`uni`='".$uni."'  
";
if($taux_tva!="")#jamais commandé
 $set.=",
`taux_tva`='".$taux_tva."'  
";

$sql2 = "
UPDATE " . $tblpref ."article 
SET 
`prix_htva`='".$prix."',
`commentaire`='".$commentaire."',
`marge`='".$marge."',
`stock`='".$stock."',
`stomin`='".$min."',
`stomax`='".$max."',
`cat`='".$categorie."' 
$set 
WHERE num ='".$num."' 
LIMIT 1
";

mysql_query($sql2) OR die("<p>Erreur Mysql<br/>$sql2<br/>".mysql_error()."</p>");
$message= "<h2>$lang_stock_jour &laquo;$nom&raquo;</h2>";
include_once("lister_articles.php");
