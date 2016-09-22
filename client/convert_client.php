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
require_once("../include/verif_client.php");
include_once("../include/config/common.php");
include_once("../include/config/var.php");
include_once("../include/language/$lang.php");
echo '<link rel="stylesheet" type="text/css" href="../include/style.css">';
$num_dev=isset($_POST['num_dev'])?$_POST['num_dev']:"";
$login=isset($_POST['login'])?$_POST['login']:"";
$message=isset($_POST['message'])?$_POST['message']:"";
$jour = date("d");
$mois = date("m");
$annee = date("Y");
//on recpere les donnée de devis
$sql0 = "SELECT * FROM " . $tblpref ."devis WHERE num_dev = $num_dev";
$req = mysql_query($sql0) or die('Erreur SQL !<br>'.$sql0.'<br>'.mysql_error());
while($data = mysql_fetch_array($req))
    {
		$num_dev = $data['num_dev'];
		$client_num = $data['client_num'];
		$date = $data['date'];
		$tot_htva = $data['tot_htva'];
		$tot_tva = $data['tot_tva'];
		}
		//on les reinjecte dans la base bon_comm

$sql1 = "INSERT INTO " . $tblpref ."bon_comm ( client_num, date, tot_htva, tot_tva ) VALUES ( $client_num, '$annee-$mois-$jour', $tot_htva, $tot_tva )";

mysql_query($sql1) or die('Erreur SQL !<br>'.$sql1.'<br>'.mysql_error());
//erreu pas insert update
$sql2 = "UPDATE " . $tblpref ."devis SET resu='ok' WHERE num_dev= $num_dev";
mysql_query($sql2) or die('Erreur SQL !<br>'.$sql2.'<br>'.mysql_error());
//touver le dernier enregistrement pour le numero de bon
$sql = "SELECT MAX(num_bon) As Maxi FROM " . $tblpref ."bon_comm";
$result = mysql_query($sql) or die('Erreur');
$max = mysql_result($result, 'Maxi');

$sql3 = "SELECT * FROM " . $tblpref ."cont_dev WHERE dev_num = $num_dev";
$req = mysql_query($sql3) or die('Erreur SQL !<br>'.$sql3.'<br>'.mysql_error());
while($data = mysql_fetch_array($req))
    {
		$article_num = $data['article_num'];
		$quanti = $data['quanti'];
		$tot_art_htva = $data['tot_art_htva'];
		$to_tva_art = $data['to_tva_art'];
		$p_u_jour = $data['p_u_jour'];
		
$sql4 = "INSERT INTO " . $tblpref ."cont_bon(bon_num, article_num, quanti, tot_art_htva, to_tva_art, p_u_jour) 
VALUES ('$max', '$article_num', '$quanti', '$tot_art_htva', '$to_tva_art', '$p_u_jour')";
mysql_query($sql4) or die('Erreur SQL !<br>'.$sql4.'<br>'.mysql_error());
}
echo "$lang_dev_cov $num_client ";
//a verifier
$from = "$mail" ;
$to = "$mail";
$subject = "devis$lang_de_num $num_dev $lang_con_cli" ;
//$message =  ""; 
$header = 'From: '.$from."\n"
 .'MIME-Version: 1.0'."\n"
 .'Content-Type: text/html; charset= ISO-8859-1'."\n"
 .'Content-Transfer-Encoding: 7bit'."\n\n";

mail($to,$subject,$message,$header);
include_once("client.php");
 ?> 