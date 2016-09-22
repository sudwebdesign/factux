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
 * File Name: edit_bon_suite.php
 * 	
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
include_once("include/language/$lang.php");
include_once("include/utils.php");
require_once("include/configav.php");
$article=isset($_POST['article'])?$_POST['article']:"";
$nom=isset($_POST['nom'])?$_POST['nom']:"";
$num_bon=isset($_POST['num_bon'])?$_POST['num_bon']:"";
$quanti=isset($_POST['quanti'])?$_POST['quanti']:"";
$num_lot=isset($_POST['lot'])?$_POST['lot']:"";

//on recupere le prix htva		
$sql2 = "SELECT prix_htva FROM " . $tblpref ."article WHERE num = $article";
$result = mysql_query($sql2) or die('Erreur SQL1 !<br>'.$sql2.'<br>'.mysql_error());
$prix_article = mysql_result($result, 'prix_htva');
//on recupere le taux de tva
$sql3 = "SELECT taux_tva FROM " . $tblpref ."article WHERE num = $article";
$result = mysql_query($sql3) or die('Erreur SQL2 !<br>'.$sql3.'<br>'.mysql_error());
$taux_tva = mysql_result($result, 'taux_tva');

$total_htva = $prix_article * $quanti ;
$mont_tva = $total_htva / 100 * $taux_tva ;
//inserer les données dans la table du contenu des bons.

mysql_select_db($db) or die ("Could not select $db database");
$sql1 = "INSERT INTO " . $tblpref ."cont_bon(num_lot, quanti, article_num, bon_num, tot_art_htva, to_tva_art, p_u_jour) 
VALUES ('$num_lot', '$quanti', '$article', '$num_bon', '$total_htva', '$mont_tva', '$prix_article')";
mysql_query($sql1) or die('Erreur SQL3 !<br>'.$sql1.'<br>'.mysql_error());


include_once("edit_bon.php");