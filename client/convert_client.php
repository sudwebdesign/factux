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
$now='../';
require_once("../include/verif_client.php");
include_once("../include/config/common.php");
include_once("../include/config/var.php");
include_once("../include/language/$lang.php");
include_once("../include/utils.php");
include_once("../include/headers.php");
include_once("../include/finhead.php");

$num_dev=isset($_POST['num_dev'])?$_POST['num_dev']:"";
$login=isset($_POST['login'])?$_POST['login']:"";
$message=isset($_POST['message'])?$_POST['message']:"";
$jour = date("d");
$mois = date("m");
$annee = date("Y");
//on recpere les donnée de devis
$sql0 = "SELECT * FROM " . $tblpref ."devis WHERE num_dev = $num_dev";
$req = mysql_query($sql0) or die('Erreur SQL !<br>'.$sql0.'<br>'.mysql_error());
while($data = mysql_fetch_array($req)){
 $num_dev = $data['num_dev'];
 $client_num = $data['client_num'];
 $date = $data['date'];
 $tot_htva = $data['tot_htva'];
 $tot_tva = $data['tot_tva'];
 $resu = $data['resu'];
}
if ($resu>0){#f5
 $message= "<h2>$lang_devis $lang_déja_commandé ($resu)</h2>";
 include_once("client.php");
 exit;
}
//on les reinjecte dans la base bon_comm
$sql1 = "INSERT INTO " . $tblpref ."bon_comm ( client_num, date, tot_htva, tot_tva ) VALUES ( '$client_num', '$annee-$mois-$jour', '$tot_htva', '$tot_tva' )";
mysql_query($sql1) or die('Erreur SQL !<br>'.$sql1.'<br>'.mysql_error());
$num_bon = mysql_insert_id();//le numero de bon

//Mise a jour du devis
$sql2 = "UPDATE " . $tblpref ."devis SET resu='$num_bon' WHERE num_dev = $num_dev";
mysql_query($sql2) or die('Erreur SQL !<br>'.$sql2.'<br>'.mysql_error());

$sql3 = "SELECT * FROM " . $tblpref ."cont_dev WHERE dev_num = $num_dev";
$req = mysql_query($sql3) or die('Erreur SQL !<br>'.$sql3.'<br>'.mysql_error());
while($data = mysql_fetch_array($req)){
 $article_num = $data['article_num'];
 $quanti = $data['quanti'];
 $tot_art_htva = $data['tot_art_htva'];
 $to_tva_art = $data['to_tva_art'];
 $p_u_jour = $data['p_u_jour'];
 $marge = $data['marge_jour'];
 $remise = $data['remise'];
 $sql4 = "INSERT INTO " . $tblpref ."cont_bon(bon_num, p_u_jour, article_num, quanti, tot_art_htva, to_tva_art, remise, marge_jour) VALUES ('$num_bon', '$p_u_jour', '$article_num', '$quanti', '$tot_art_htva', '$to_tva_art', '$remise', '$marge')";
 mysql_query($sql4) or die('Erreur SQL !<br>'.$sql4.'<br>'.mysql_error());
 //on decremente le stock
 $sql12 = "UPDATE `" . $tblpref ."article` SET `stock` = (stock - $quanti) WHERE `num` = '$article_num'";
 mysql_query($sql12) or die('Erreur SQL12 !<br>'.$sql12.'<br>'.mysql_error());
}
echo "$lang_dev_cov $client_num ";
//a verifier
$from = "$mail" ;
$to = "$mail";
$subject = "$lang_de_num $num_dev $lang_con_cli" ;
//$message =  ""; 
$header = 'From: '.$from."\n"
 .'MIME-Version: 1.0'."\n"
 .'Content-Type: text/html; charset= ISO-8859-1'."\n"
 .'Content-Transfer-Encoding: 7bit'."\n\n";
if(mail($to,$subject,$message,$header))
 echo "<h2>$lang_email_envoyé</h2>";
else
 echo "<h1>$lang_email_envoi_err</h1>";
include_once("client.php");
