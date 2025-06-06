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
require_once("include/verif.php");
include_once("include/config/common.php");
$quanti=isset($_POST['quanti'])?$_POST['quanti']:"";
$num_cont=isset($_POST['num_cont'])?$_POST['num_cont']:"";
$dev_num=isset($_POST['dev_num'])?$_POST['dev_num']:"";
$article=isset($_POST['article'])?$_POST['article']:"";
$remise=isset($_POST['remise'])?$_POST['remise']:"";

$sql = "SELECT prix_htva, taux_tva, marge FROM " . $tblpref ."article WHERE  " . $tblpref ."article.num = $article";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_array($req)){
  $prix_article = $data['prix_htva'];
  $taux_tva = $data['taux_tva'];
  $marge=$data['marge'];
}
//calcul du prix unitaire du jour (margé et remisé)#2015
$prix_article=$prix_article * $marge;
$total_htva = $prix_article * (1-($remise/100)) * $quanti;
$mont_tva = $total_htva / 100 * $taux_tva ;

$sql2 = "UPDATE " . $tblpref ."cont_dev
         SET p_u_jour='".$prix_article."', quanti='".$quanti."', article_num='".$article."', tot_art_htva='".$total_htva."', to_tva_art='".$mont_tva."', remise='".$remise."', marge_jour='".$marge."'
         WHERE num = '".$num_cont."'";
mysql_query($sql2) OR die("<p>Erreur Mysql<br/>$sql2<br/>".mysql_error()."</p>");

$num_dev = $dev_num ;#/!\i/mportant
include_once("edit_devis.php");
