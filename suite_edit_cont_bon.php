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
require_once("include/verif.php");
include_once("include/config/common.php");
echo '<link rel="stylesheet" type="text/css" href="include/style.css">';
echo'<link rel="shortcut icon" type="image/x-icon" href="image/favicon.ico" >';
$quanti=isset($_POST['quanti'])?$_POST['quanti']:"";
$num_cont=isset($_POST['num_cont'])?$_POST['num_cont']:"";
$bon_num=isset($_POST['bon_num'])?$_POST['bon_num']:"";
$article=isset($_POST['article'])?$_POST['article']:"";
$num_lot=isset($_POST['num_lot'])?$_POST['num_lot']:"";
$sql = "SELECT prix_htva, taux_tva FROM " . $tblpref ."article WHERE  " . $tblpref ."article.num = $article";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_array($req))
    {
		$prix_article = $data['prix_htva'];
		$taux_tva = $data['taux_tva'];
		}
$tot_htva = $quanti * $prix_article ;
$tot_tva = $tot_htva / 100 * $taux_tva ;		 
/////////////////
$sql = "SELECT quanti, article_num from " . $tblpref ."cont_bon WHERE num = '".$num_cont."'";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
$quantiplus = $data['quanti'];
$artiplus = $data['article_num'];
$sql11 = "UPDATE `" . $tblpref ."article` SET `stock` = (stock + $quantiplus) WHERE `num` = '$artiplus'";
mysql_query($sql11) or die('Erreur SQL11 !<br>'.$sql11.'<br>'.mysql_error());


$sql12 = "UPDATE `" . $tblpref ."article` SET `stock` = (stock - $quanti) WHERE `num` = '$article'";
mysql_query($sql12) or die('Erreur SQL12 !<br>'.$sql12.'<br>'.mysql_error());

////////////////
$sql2 = "UPDATE " . $tblpref ."cont_bon 
SET p_u_jour='".$prix_article."', num_lot='".$num_lot."', quanti='".$quanti."', article_num='".$article."', tot_art_htva='".$tot_htva."', to_tva_art='".$tot_tva."'  
WHERE num = '".$num_cont."'";
mysql_query($sql2) OR die("<p>Erreur Mysql<br/>$sql2<br/>".mysql_error()."</p>");
  
$num_bon=$bon_num;

 include_once("edit_bon.php");
 ?> 