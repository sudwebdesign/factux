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
 * File Name: article_new.php
 * 	Enregistrement des nouveaux articles
 *
 * * Version:  5.0.0
 * * * * Modified: 07/10/2016
 *
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
require_once(__DIR__ . "/include/verif.php");
include_once(__DIR__ . "/include/config/common.php");
include_once(__DIR__ . "/include/config/var.php");
include_once(__DIR__ . sprintf('/include/language/%s.php', $lang));
$article=isset($_POST['article'])?$_POST['article']:"";### ‘	&#145;	&lsquo;	Left single quotation mark ::: 4 change Single quote (') http://ascii-code.com/
$uni=isset($_POST['uni'])?$_POST['uni']:"";
$prix=floatval(isset($_POST['prix'])?$_POST['prix']:"");
$taux_tva=floatval(isset($_POST['taux_tva'])?$_POST['taux_tva']:"");
$commentaire=isset($_POST['commentaire'])?$_POST['commentaire']:"";###
$stock=floatval(isset($_POST['stock'])?$_POST['stock']:"");
$stomin=floatval(isset($_POST['stomin'])?$_POST['stomin']:"");
$stomax=floatval(isset($_POST['stomax'])?$_POST['stomax']:"");
$categorie=isset($_POST['categorie'])?$_POST['categorie']:"";
$marge=floatval(isset($_POST['marge'])?$_POST['marge']:"");
if($article=='' || $prix==''|| $taux_tva=='' || $uni=='' ){
 $message = sprintf('<h1>%s</h1>', $lang_oubli_champ);
 include(__DIR__ . '/form_article.php');
 exit;
}

$sql1 = "INSERT INTO " . $tblpref .sprintf("article(article, prix_htva, taux_tva, commentaire, uni, stock, stomin, stomax, cat, marge) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')", $article, $prix, $taux_tva, $commentaire, $uni, $stock, $stomin, $stomax, $categorie, $marge);
mysql_query($sql1) || die('Erreur SQL !<br>'.$sql1.'<br>'.mysql_error());
$message = sprintf('<h2>%s<br>%s %s</h2>', $lang_nouv_art, $lang_commentaire, $commentaire);
include(__DIR__ . "/form_article.php");
