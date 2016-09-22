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
include_once("include/config/var.php");
include_once("include/language/$lang.php");
$nom=isset($_POST['nom'])?$_POST['nom']:"";
$num=isset($_POST['num'])?$_POST['num']:"";
$prix=isset($_POST['prix'])?$_POST['prix']:"";
$commentaire=isset($_POST['commentaire'])?apostrophe($_POST['commentaire']):"";###
$marge=isset($_POST['marge'])?$_POST['marge']:"";
$stock=isset($_POST['stock'])?$_POST['stock']:"";
$max=isset($_POST['max'])?$_POST['max']:"";
$min=isset($_POST['min'])?$_POST['min']:"";
$categorie=isset($_POST['categorie'])?$_POST['categorie']:"";

$article=isset($_POST['article'])?apostrophe($_POST['article']):"";### ‘	&#145;	&lsquo;	Left single quotation mark ::: 4 change Single quote (') http://ascii-code.com/
$uni=isset($_POST['uni'])?$_POST['uni']:"";
$set='';
if($article!=""&&$uni!="")#jamais commandé
 $set=",
`article`='".$article."',
`uni`='".$uni."'  
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
