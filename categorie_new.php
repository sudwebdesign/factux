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
 * File Name: categorie_new.php
 * 	Enregistrement des nouvelles categories
 * 
 * * * Version:  1.1.5
 * * Modified: 25/05/2005
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
require_once("include/verif.php");
include_once("include/config/common.php");
include_once("include/config/var.php");
include_once("include/language/$lang.php");
$categorie=isset($_POST['categorie'])?apostrophe($_POST['categorie']):"";
$sql = "INSERT INTO " . $tblpref ."categorie(categorie) VALUES ('$categorie')";
if($categorie!=''&&$categorie!=$lang_divers){
 mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
 $message = "<h2>$lang_nouv_categorie</h2>";
}
if($categorie==$lang_divers)
 $message = "<h1>$lang_categorie $lang_divers</h1>";
if(basename($_SERVER['HTTP_REFERER'])==basename(__file__))#if self call by ajouter_cat.php.php
 $_SERVER['HTTP_REFERER']="lister_cat.php";
if(strstr($_SERVER['HTTP_REFERER'],"_cat.php"))#? if query (old) #delete_cat.php or edit_cat.php?id_cat=1
 $_SERVER['HTTP_REFERER']="lister_cat.php";
include_once(basename($_SERVER['HTTP_REFERER']));#include("lister_cat.php");#include("form_article.php");
