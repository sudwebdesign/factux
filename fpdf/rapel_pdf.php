<?php
/*
 * Factux le facturier libre
 * Copyright (C) 2003-2004 Guy Hendrickx
 * 
 * Licensed under the terms of the GNU  General Public License:
 *   http://www.opensource.org/licenses/gpl-license.php
 * 
 * For further information visit:
 *   http://factux.sourceforge.net
 * 
 * File Name: fckconfig.js
 *  Editor configuration settings.
 * 
 * * * Version:  1.1.5
 * * * * Modified: 23/07/2005
 * 
 * File Authors:
 *   Guy Hendrickx
 *
 *      Création Informatique Ingles Thomas
 *              Factux 10 years Remix.8.2015
 */
session_cache_limiter('private');
require_once("../include/verif2.php");
$now = "../";#4 0.php in common
include_once("../include/config/common.php");
include_once("../include/config/var.php");
include_once("../include/language/$lang.php");
#error_reporting(0);
define('FPDF_FONTPATH','font/');
require_once('mysql_table.php');
$client=isset($_POST['client'])?$_POST['client']:"";
$rapel_num=isset($_POST['rapel_num'])?$_POST['rapel_num']:"";
$choix=isset($_POST['choix'])?$_POST['choix']:"";
//Pour la date
$date_jour = date("d/m/Y");
//pour le nom de client
$sql1 = "SELECT nom, nom2, rue, ville, cp, num_tva FROM " . $tblpref ."client WHERE num_client = $client";
$req = mysql_query($sql1) or die('Erreur SQL !<br>'.$sql1.'<br>'.mysql_error());
while($data = mysql_fetch_array($req)){
 $nom = $data['nom'];
 $nom2 = $data['nom2'];
 $rue = $data['rue'];
 $ville = $data['ville'];
 $cp = $data['cp'];
 $num_tva = $data['num_tva'];
}
//page 1
class PDF extends PDF_MySQL_Table{}

$pdf=new PDF();
$pdf->Open();
$pdf->AddPage();
//deuxieme cellule les coodoné clients
$pdf->SetFillColor(255,238,204);
$pdf->SetFont('Arial','B',10);
$pdf->SetY(27);
$pdf->SetX(120);
$pdf->MultiCell(65,6,"$nom \n $nom2 \n $rue \n $cp  $ville \n $num_tva",1,'C',1);//le numero de facture(largeur,hauteur

//le logo
$pdf->Image("../image/$logo",10,4,50,24,'jpg');
//$pdf->ln(20);
//Troisieme cellule le slogan
$pdf->SetFillColor(255,238,204);
$pdf->SetFont('Arial','B',15);
$pdf->SetY(60);
$pdf->SetX(10);
$pdf->MultiCell(90,4,"$slogan",0,'C',0);
//Troisieme cellule les coordoné vendeur
$pdf->SetFillColor(255,238,204);
$pdf->SetFont('Arial','B',8);
$pdf->SetY(33);
$pdf->SetX(10);
$pdf->MultiCell(40,4,"$lang_dev_pdf_soc",1,'R',1);
//le cntenu des coordonées vendeur
$pdf->SetFillColor(255,238,204);
$pdf->SetFont('Arial','',8);
$pdf->SetY(33);
$pdf->SetX(51);
$pdf->MultiCell(50,4,"$entrep_nom\n$social\n $tel_vend\n $tva_vend \n$compte \n$mail",1,'L',1);//
//la date
$pdf->SetFillColor(255,238,204);
$pdf->SetFont('Arial','B',10);
$pdf->SetY(70);
$pdf->SetX(130);
$pdf->MultiCell(50,6,"Date: $date_jour",1,'C',1);//

//Si on a oublié de cocher les factures
if(is_string($choix)){#var_dump($choix,count($choix),sizeof($choix),!is_array($choix),is_string($choix));exit;
 $rapel_num=($rapel_num!=0)?4:$rapel_num;#si rapel no error (4 inexist)
 $pdf->SetFillColor(255,238,204);
 $pdf->SetFont('Arial','',20);
 $pdf->SetY(116);
 $pdf->SetX(30);
 $pdf->MultiCell(160,8,"Vous devez séléctionner une Facture",0,'C',1);
}
//Si on a oublié le num de rappel
if($rapel_num=='0'){
 unset($choix);$choix=0;#not update
 $pdf->SetFillColor(255,238,204);
 $pdf->SetFont('Arial','',20);
 $pdf->SetY(100);
 $pdf->SetX(30);
 $pdf->MultiCell(160,8,"Erreur\nVous devez renseigner un n° de rappel",0,'C',1);
}
//pour le premier rappel
if($rapel_num=='1'){
 $pdf->SetFillColor(255,238,204);
 $pdf->SetFont('Arial','',10);
 $pdf->SetY(110);
 $pdf->SetX(30);
 $pdf->MultiCell(160,5,$lang_premier_rappel,0,'L',0);
}
//pour le deuxieme rappel
if($rapel_num=='2'){
 $pdf->SetFillColor(255,238,204);
 $pdf->SetFont('Arial','',10);
 $pdf->SetY(100);
 $pdf->SetX(30);
 $pdf->MultiCell(160,5,$lang_deuxieme_rappel,0,'L',1);
}
//Pour le troisieme rappel
if($rapel_num=='3'){
 $pdf->SetFillColor(255,238,204);
 $pdf->SetFont('Arial','',10);
 $pdf->SetY(100);
 $pdf->SetX(30);
 $pdf->MultiCell(160,5,$lang_troisieme_rappel,0,'L',1);
}
$pdf->Line(20,65,200,65);
$pdf->ln(65);

//la boucle pour le tableau
if(is_array($choix)){//Si facture(s)
 $sql="SELECT num, DATE_FORMAT(date_fact,'%d/%m/%Y') AS date, total_fact_ttc FROM " . $tblpref ."facture WHERE num = $choix[0]";
 for ($i=1 ; $i < sizeof($choix) ; $i++){
  if (isset($choix[$i])){
   $sql .= " OR num = $choix[$i]";
  }
 }
 //Le tableau : on définit les colonnes
 $pdf->AddCol('num',30,$lang_facture.' N°','C');
 $pdf->AddCol('date',30,$lang_date,'C');
 $pdf->AddCol('total_fact_ttc',60,$lang_montant_ttc,'C');
 $prop=array('
  HeaderColor'=>array(255,150,100),
  'color1'=>array(255,238,204),
  'color2'=>array(255,255,210),
  #'entete'=>0,
  'padding'=>2
  );
 $pdf->Table($sql,$prop);
}
//deuxieme cellule les coordonnées vendeurs 2
$pdf->SetFillColor(255,238,204);
$pdf->SetFont('Arial','',8);
$pdf->SetY(240);
$pdf->SetX(25);
$pdf->MultiCell(35,4,"$social\n $tel_vend\n $tva_vend \n$compte \n$reg",0,'C',0);//le numero de facture(largeur,hauteur
//la derniere cellule conditions de facturation
$pdf->SetFillColor(255,238,204);
$pdf->SetFont('Arial','B',10);
$pdf->SetY(268);
$pdf->SetX(30);
$pdf->MultiCell(160,4,"$lang_condi_ven\n",0,'C',0);
//on enregisre les rappels
if(is_array($choix)){//Si facture(s)
 $sql1 = "UPDATE " . $tblpref ."facture SET r$rapel_num ='".$date_jour."' WHERE num = '".$choix[0]."'";
 for ($i=1 ; $i < sizeof($choix) ; $i++){
  if (isset($choix[$i]) ){
   $sql1 .= " OR num = '".$choix[$i]."'";
  }
 }
 mysql_query($sql1) or die('Erreur SQL !<br>'.$sql1.'<br>'.mysql_error());
}
//Détermination d'un nom de fichier temporaire dans le répertoire courant
$file=basename(tempnam(getcwd(),'tmp'));
rename($file,$file.'.pdf');
$file.='.pdf';
//Sauvegarde du PDF dans le fichier
$pdf->Output($file);
//Redirection JavaScript
echo "<html><script>window.location='$file';</script></html>";
