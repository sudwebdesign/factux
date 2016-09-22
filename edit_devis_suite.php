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
include_once("include/verif.php");
include_once("include/config/common.php");
include_once("include/config/var.php");
include_once("include/language/$lang.php");
include_once("include/utils.php");
$nom=isset($_POST['nom'])?$_POST['nom']:"";
$num_dev=isset($_POST['num_dev'])?$_POST['num_dev']:"";
$quanti=isset($_POST['quanti'])?$_POST['quanti']:"";
$article=isset($_POST['article'])?$_POST['article']:"";
$remise=isset($_POST['remise'])?$_POST['remise']:"";

if($article!=0&&$quanti!=''){
    //on recupere le prix htva		
    $sql2 = "SELECT prix_htva FROM " . $tblpref ."article WHERE num = $article";
    $result = mysql_query($sql2) or die('Erreur SQL1 !<br>'.$sql2.'<br>'.mysql_error());
    $prix_article = mysql_result($result, 0);
    //on recupere le taux de tva
    $sql3 = "SELECT taux_tva FROM " . $tblpref ."article WHERE num = $article";
    $result = mysql_query($sql3) or die('Erreur SQL2 !<br>'.$sql3.'<br>'.mysql_error());
    $taux_tva = mysql_result($result, 0);
    //on recupere le coeff de marge
    $sql4="select marge FROM " . $tblpref ."article WHERE num = $article";
    $result=mysql_query($sql4) or die('Erreur SQL !<br>'.$sql4.'<br>'.mysql_error());
    $marge=mysql_result($result, 0);
    //calcul du prix unitaire du jour (margé et remisé)#2015
    $prix_article=$prix_article * $marge;
    $total_htva = $prix_article * (1-($remise/100)) * $quanti;
    $mont_tva = $total_htva / 100 * $taux_tva ;
    //inserer les données dans la table du contenu des devis.
    mysql_select_db($db) or die ("Could not select $db database");
    $sql1 = "INSERT INTO " . $tblpref ."cont_dev( p_u_jour, quanti, article_num, dev_num, tot_art_htva, to_tva_art, remise, marge_jour) 
             VALUES ('$prix_article', '$quanti', '$article', '$num_dev', '$total_htva', '$mont_tva', '$remise', '$marge' )";
    mysql_query($sql1) or die('Erreur SQL3 !<br>'.$sql1.'<br>'.mysql_error());
}else
 $message = "<h1>$lang_champ_oubli</h1>";
$dev_num = $num_dev;
include ("edit_devis.php");
