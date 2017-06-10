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
 * File Name: convert.php
 * 	conversion des devis en bon de commande
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
include_once("include/config/var.php");
include_once("include/language/$lang.php");
$num_dev=isset($_GET['num_dev'])?$_GET['num_dev']:"";
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
if ($resu>0){
 $message= "<h2>$lang_devis $lang_déja_commandé ($resu)</h2>";
 include_once("lister_commandes.php");
 exit;
}
//on les reinjecte dans la base bon_comm
$sql1 = "INSERT INTO " . $tblpref ."bon_comm ( client_num, date, tot_htva, tot_tva ) VALUES ( $client_num, '$annee-$mois-$jour', $tot_htva, $tot_tva )";
mysql_query($sql1) or die('Erreur SQL !<br>'.$sql1.'<br>'.mysql_error());
$num_bon = mysql_insert_id();//le numero de bon

$sql2 = "UPDATE " . $tblpref ."devis SET resu='$num_bon' WHERE num_dev= $num_dev";
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
$message= "<h2>$lang_dev_cov $lang_numero $num_bon <form action='fpdf/bon_pdf.php' method='post' target= '_blank' class='img'><input type='hidden' name='num_bon' value='$num_bon' /><input type='hidden' name='user' value='adm'><input type='image' src='image/printer.gif' alt='$lang_imprimer' /></form></h2>";
include_once("lister_devis.php");
