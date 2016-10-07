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
 * File Name: edit_bon_suite.php
 * 	
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
include_once("include/utils.php");
$article=isset($_POST['article'])?$_POST['article']:"";
$nom=isset($_POST['nom'])?$_POST['nom']:"";
$num_bon=isset($_POST['num_bon'])?$_POST['num_bon']:"";
$quanti=isset($_POST['quanti'])?$_POST['quanti']:"";
$num_lot=isset($_POST['lot'])?$_POST['lot']:"";
$remise=isset($_POST['remise'])?$_POST['remise']:"";
if($article!=0&&$quanti!=''){
    //on recupere le prix htva		
    $sql2 = "SELECT prix_htva FROM " . $tblpref ."article WHERE num = $article";
    $result = mysql_query($sql2) or die('Erreur SQL !<br>'.$sql2.'<br>'.mysql_error());
    $prix_article = mysql_result($result, 0);
    //on recupere le taux de tva
    $sql3 = "SELECT taux_tva FROM " . $tblpref ."article WHERE num = $article";
    $result = mysql_query($sql3) or die('Erreur SQL !<br>'.$sql3.'<br>'.mysql_error());
    $taux_tva = mysql_result($result, 0);
    //on recupere le coeff de marge
    $sql4="select marge FROM " . $tblpref ."article WHERE num = $article";
    $result=mysql_query($sql4) or die('Erreur SQL !<br>'.$sql4.'<br>'.mysql_error());
    $marge=mysql_result($result, 0);
    //calcul du prix unitaire du jour (margé et remisé)#2015
    $prix_article=$prix_article * $marge;
    $total_htva = $prix_article * (1-($remise/100)) * $quanti;
    $mont_tva = $total_htva / 100 * $taux_tva ;
    //inserer les données dans la table du contenu des bons.
    $sql1 = "INSERT INTO " . $tblpref ."cont_bon(p_u_jour, quanti, article_num, bon_num, tot_art_htva, to_tva_art, num_lot, remise, marge_jour) 
             VALUES ('$prix_article', '$quanti', '$article', '$num_bon', '$total_htva', '$mont_tva', '$num_lot', '$remise', '$marge')";
    mysql_query($sql1) or die('Erreur SQL !<br>'.$sql1.'<br>'.mysql_error());
    
    //on decremente le stock
    $sql12 = "UPDATE `" . $tblpref ."article` SET `stock` = (stock - $quanti) WHERE `num` = '$article'";
    mysql_query($sql12) or die('Erreur SQL !<br>'.$sql12.'<br>'.mysql_error());
}else
 $message= "<h1>$lang_champ_oubli</h1>";
include_once("edit_bon.php");
