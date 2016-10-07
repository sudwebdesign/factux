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
 * File Name: bon_pdf.inc.php
 * 	Fichier dependant de bon_pdf.php
 * 
 * * * Version:  5.0.0
 * * * * Modified: 07/10/2016
 * 
 * File Authors:
 * 		Guy Hendrickx
 *
 *      Création Informatique Ingles Thomas
 *              Factux 10 years Remix.8.2015
 */
session_cache_limiter('private');
if(isset($_POST['user'])&&$_POST['user']=='adm'){
 require_once("../include/verif2.php");  
}else{
 $from_cli='../client/';
 require_once("../include/verif_client.php");  
}
$now='../'; 
include_once("../include/config/common.php");
include_once("../include/config/var.php");
include_once("../include/language/$lang.php");
include_once("../include/configav.php"); 
define('FPDF_FONTPATH','font/');
require_once('mysql_table.php');
$_POST['mail']=isset($_POST['mail'])?$_POST['mail']:"n";

$num_bon=isset($_POST['num_bon'])?$_POST['num_bon']:"";
$nom=isset($_POST['nom'])?$_POST['nom']:"";

$slogan = stripslashes($slogan);
$entrep_nom= stripslashes($entrep_nom);
$social= stripslashes($social);
$tel_vend= stripslashes($tel_vend);
$tva_vend= stripslashes($tva_vend);
$compte= stripslashes($compte);
$reg= stripslashes($reg);
$mail= stripslashes($mail);

//on compte le nombre de ligne
$sql = "
SELECT " . $tblpref ."cont_bon.num, quanti, uni, article, prix_htva, p_u_jour, marge_jour, remise, tot_art_htva 
FROM " . $tblpref ."cont_bon 
LEFT JOIN " . $tblpref ."article on " . $tblpref ."cont_bon.article_num = " . $tblpref ."article.num 
WHERE  bon_num = $num_bon
";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
	$nb_li = mysql_num_rows($req);
	$nb_pa1 = $nb_li / 31 ;
	$nb_pa = ceil($nb_pa1);
	$nb_li = $nb_pa * 31 ;
 
//on calcule le montant de la remise #2015
$total_marge_htva = 0;
$total_remise_htva = 0;
while($data = mysql_fetch_array($req)){
 $ttl_htva = $data['tot_art_htva'];#remisé & margé
 $prx_v = $data['p_u_jour'];#margé & non remisé
 $qnt = $data['quanti'];
 $tx_remise = (1-($data['remise']/100));#taux
 $tx_marge = $data['marge_jour'];#taux

 $remise_art_htva = ($prx_v * $qnt) - $ttl_htva;
 $marge_art_htva = $ttl_htva - ((($prx_v / $tx_marge) * $qnt) * $tx_remise);

 $total_remise_htva += $remise_art_htva;
 $total_marge_htva += $marge_art_htva;
}
//pour la date
$sql = "
select coment, tot_htva, tot_tva, DATE_FORMAT(date,'%d/%m/%Y') AS date_2 
from " . $tblpref ."bon_comm 
where num_bon = $num_bon
";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
	$date_bon = $data['date_2'];
	$total_htva = $data['tot_htva'];
	$total_tva = $data['tot_tva'];
	$tot_tva_inc = $total_htva + $total_tva ;
	$coment = $data['coment'];

//pour le nom de client
$sql1 = "
SELECT mail, nom, nom2, rue, ville, cp, num_tva 
FROM " . $tblpref ."client 
LEFT JOIN " . $tblpref ."bon_comm on client_num = num_client 
WHERE  num_bon = $num_bon
";
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
