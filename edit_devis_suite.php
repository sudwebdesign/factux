<?php
/*
 * Factux le facturier libre
 * Copyright (C) 2003-2005 Guy Hendrickx, 2017~ Thomas Ingles
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
 * * * * Version:  8.0.0
 * * * * Modified: 07/06/2025
 *
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
include_once(__DIR__ . "/include/verif.php");
include_once(__DIR__ . "/include/config/common.php");
include_once(__DIR__ . "/include/config/var.php");
include_once(__DIR__ . sprintf('/include/language/%s.php', $lang));
include_once(__DIR__ . "/include/utils.php");
$nom=isset($_POST['nom'])?$_POST['nom']:"";
$num_dev=isset($_POST['num_dev'])?$_POST['num_dev']:"";
$quanti=isset($_POST['quanti'])?$_POST['quanti']:"";
$article=isset($_POST['article'])?$_POST['article']:"";
$remise=isset($_POST['remise'])?$_POST['remise']:"";

if($article!=0&&$quanti!=''){
    //on recupere le prix htva
    $sql2 = "SELECT prix_htva FROM " . $tblpref .('article WHERE num = ' . $article);
    $result = mysql_query($sql2) or die('Erreur SQL1 !<br>'.$sql2.'<br>'.mysql_error());
    $prix_article = mysql_result($result, 0);
    //on recupere le taux de tva
    $sql3 = "SELECT taux_tva FROM " . $tblpref .('article WHERE num = ' . $article);
    $result = mysql_query($sql3) or die('Erreur SQL2 !<br>'.$sql3.'<br>'.mysql_error());
    $taux_tva = mysql_result($result, 0);
    //on recupere le coeff de marge
    $sql4="select marge FROM " . $tblpref .('article WHERE num = ' . $article);
    $result=mysql_query($sql4) or die('Erreur SQL !<br>'.$sql4.'<br>'.mysql_error());
    $marge=mysql_result($result, 0);
    //calcul du prix unitaire du jour (margé et remisé)#2015
    $prix_article *= $marge;
    $total_htva = $prix_article * (1-($remise/100)) * $quanti;
    $mont_tva = $total_htva / 100 * $taux_tva ;
    //inserer les données dans la table du contenu des devis.
    if (!mysql_select_db($db)) {
        die (sprintf('Could not select %s database', $db));
    }

    $sql1 = "INSERT INTO " . $tblpref ."cont_dev( p_u_jour, quanti, article_num, dev_num, tot_art_htva, to_tva_art, remise, marge_jour)
             VALUES ('{$prix_article}', '{$quanti}', '{$article}', '{$num_dev}', '{$total_htva}', '{$mont_tva}', '{$remise}', '{$marge}' )";
    mysql_query($sql1) || die('Erreur SQL3 !<br>'.$sql1.'<br>'.mysql_error());
}else {
    $message = sprintf('<h1>%s</h1>', $lang_champ_oubli);
}

$dev_num = $num_dev;
include (__DIR__ . "/edit_devis.php");
