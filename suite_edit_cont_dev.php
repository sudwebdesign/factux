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
$quanti=isset($_POST['quanti'])?$_POST['quanti']:"";
$num_cont=isset($_POST['num_cont'])?$_POST['num_cont']:"";
$dev_num=isset($_POST['dev_num'])?$_POST['dev_num']:"";
$article=isset($_POST['article'])?$_POST['article']:"";

$sql = "SELECT prix_htva, taux_tva FROM " . $tblpref ."article WHERE  " . $tblpref ."article.num = $article";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_array($req))
    {
		$prix_article = $data['prix_htva'];
		$taux_tva = $data['taux_tva'];
		//echo " $prix_ht <br>";
		}
$tot_htva = $quanti * $prix_article ;
$tot_tva = $tot_htva / 100 * $taux_tva ;		 
mysql_select_db($db) or die ("Could not select $db database");
$sql2 = "UPDATE " . $tblpref ."cont_dev SET p_u_jour='".$prix_article."', quanti='".$quanti."', article_num='".$article."', tot_art_htva='".$tot_htva."', to_tva_art='".$tot_tva."'  WHERE num = '".$num_cont."'";
mysql_query($sql2) OR die("<p>Erreur Mysql<br/>$sql2<br/>".mysql_error()."</p>");
  
 $num_dev = $dev_num ;
  include_once("edit_devis.php");
 ?> 