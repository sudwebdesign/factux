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
 * File Name: article_new.php
 * 	Enregistrement des nouveaux articles
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
$article=isset($_POST['article'])?apostrophe($_POST['article']):"";### ‘	&#145;	&lsquo;	Left single quotation mark ::: 4 change Single quote (') http://ascii-code.com/
$uni=isset($_POST['uni'])?$_POST['uni']:"";
$prix=isset($_POST['prix'])?$_POST['prix']:"";
$taux_tva=isset($_POST['taux_tva'])?$_POST['taux_tva']:"";
$commentaire=isset($_POST['commentaire'])?apostrophe($_POST['commentaire']):"";###
$stock=isset($_POST['stock'])?$_POST['stock']:"";
$stomin=isset($_POST['stomin'])?$_POST['stomin']:"";
$stomax=isset($_POST['stomax'])?$_POST['stomax']:"";
$categorie=isset($_POST['categorie'])?$_POST['categorie']:"";
$marge=isset($_POST['marge'])?$_POST['marge']:"";
if($article=='' || $prix==''|| $taux_tva=='' || $uni=='' ){
 $message = "<h1>$lang_oubli_champ</h1>";
 include('form_article.php');
 exit;
}
$sql1 = "INSERT INTO " . $tblpref ."article(article, prix_htva, taux_tva, commentaire, uni, stock, stomin, stomax, cat, marge) VALUES ('$article', '$prix', '$taux_tva', '$commentaire', '$uni', '$stock', '$stomin', '$stomax', '$categorie', '$marge')";
mysql_query($sql1) or die('Erreur SQL !<br>'.$sql1.'<br>'.mysql_error());
$message = "<h2>$lang_nouv_art<br>$lang_commentaire $commentaire</h2>";
include("form_article.php");
