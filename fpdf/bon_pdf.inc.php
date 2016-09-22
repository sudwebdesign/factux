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
 * File Name: bon_pdf.inc.php
 * 	Fichier dependant de bon_pdf.php
 * 
 * * * Version:  1.1.5
 * * * * Modified: 23/07/2005
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
session_cache_limiter('private');
if ($_POST['user']== 'adm') { 
require_once("../include/verif2.php");  
}else{
require_once("../include/verif_client.php");  
}
//error_reporting(0);
require('mysql_table.php');	
include("../include/config/common.php");
include("../include/config/var.php");
include("../include/language/$lang.php");
include_once("../include/configav.php"); 
$num_bon=isset($_POST['num_bon'])?$_POST['num_bon']:"";
$nom=isset($_POST['nom'])?$_POST['nom']:"";
define('FPDF_FONTPATH','font/');
$euro= '€';
$devise = ereg_replace('&euro;', $euro, $devise);
$slogan = stripslashes($slogan);
$entrep_nom= stripslashes($entrep_nom);
$social= stripslashes($social);
$tel= stripslashes($tel);
$tva_vend= stripslashes($tva_vend);
$compte= stripslashes($compte);
$reg= stripslashes($reg);
$mail= stripslashes($mail);
//on compte le nombre de ligne
$sql = "SELECT " . $tblpref ."cont_bon.num, quanti, uni, article, prix_htva, tot_art_htva FROM " . $tblpref ."cont_bon RIGHT JOIN " . $tblpref ."article on " . $tblpref ."cont_bon.article_num = " . $tblpref ."article.num WHERE  bon_num = $num_bon";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql2.'<br>'.mysql_error());
$nb_li = mysql_num_rows($req);
$nb_pa1 = $nb_li /15 ;
$nb_pa = ceil($nb_pa1);
$nb_li =$nb_pa * 15 ;
//pour la date
$sql = "select coment, tot_htva, tot_tva, DATE_FORMAT(date,'%d/%m/%Y') AS date_2 from " . $tblpref ."bon_comm where num_bon = $num_bon";
$req = mysql_query($sql) or die('Erreur SQL
!<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
$date_bon = $data[date_2];
$total_htva = $data[tot_htva];
$total_tva = $data[tot_tva];
$tot_tva_inc = $total_htva + $total_tva ;
$coment = $data[coment];
//pour le nom de client
$sql1 = "SELECT mail, nom, nom2, rue, ville, cp, num_tva FROM " . $tblpref ."client RIGHT JOIN " . $tblpref ."bon_comm on client_num = num_client WHERE  num_bon = $num_bon";
$req = mysql_query($sql1) or die('Erreur SQL !<br>'.$sql1.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
		$nom = $data['nom'];
		$nom2 = $data['nom2'];
		$rue = $data['rue'];
		$ville = $data['ville'];
		$cp = $data['cp'];
		$num_tva = $data['num_tva'];
		$mail_client = $data['mail'];

?>
