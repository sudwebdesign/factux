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
session_cache_limiter('private');
require_once("../include/verif2.php");
error_reporting(0);
define('FPDF_FONTPATH','font/');
require('mysql_table.php');
include("../include/config/common.php");
include("../include/config/var.php");
$client=isset($_POST['client'])?$_POST['client']:"";
$rapel_num=isset($_POST['rapel_num'])?$_POST['rapel_num']:"";
$choix=isset($_POST['choix'])?$_POST['choix']:"";
$euro= '€';
$devise = ereg_replace('&#128;', $euro, $devise);


//Pour la date
$date_jour = date("d/m/Y");
//pour le nom de client
$sql1 = "SELECT nom, nom2, rue, ville, cp, num_tva FROM " . $tblpref ."client WHERE num_client = $client";
$req = mysql_query($sql1) or die('Erreur SQL !<br>'.$sql1.'<br>'.mysql_error());
while($data = mysql_fetch_array($req))
    {
		$nom = $data['nom'];
		$nom2 = $data['nom2'];
		$rue = $data['rue'];
		$ville = $data['ville'];
		$cp = $data['cp'];
		$num_tva = $data['num_tva'];
		}
//page 1
class PDF extends PDF_MySQL_Table
{

}
//Connexion à la base
mysql_connect("$host","$user","$pwd");
mysql_select_db("$db");

$pdf=new PDF();
$pdf->Open();
$pdf->AddPage();
//deuxieme cellule les coodoné clients
$pdf->SetFillColor(255,238,204);
$pdf->SetFont('Arial','B',10);
$pdf->SetY(27);
$pdf->SetX(120);
$pdf->MultiCell(65,6,"$nom \n $nom2 \n $rue \n $cp  $ville \n $num_tva",1,C,1);//le numero de facture(largeur,hauteur

//le logo
$pdf->Image("../image/$logo",10,8,0, 0,'jpg');
//$pdf->ln(20);
//Troisieme cellule le slogan
$pdf->SetFillColor(255,238,204);
$pdf->SetFont('Arial','B',15);
$pdf->SetY(45);
$pdf->SetX(10);
$pdf->MultiCell(71,4,"$slogan",0,C,0);
//Troisieme cellule les coordoné vendeur
$pdf->SetFillColor(255,238,204);
$pdf->SetFont('Arial','B',8);
$pdf->SetY(70);
$pdf->SetX(10);
$pdf->MultiCell(40,4,"Siege social/Social zetel\n Tel/Fax\n T.V.A/B.T.W\n Compte\n email",1,R,1);
//la date
$pdf->SetFillColor(255,238,204);
$pdf->SetFont('Arial','B',10);
$pdf->SetY(70);
$pdf->SetX(130);
$pdf->MultiCell(50,6,"Date: $date_jour",1,C,1);//
//Si on a oublié le num de rappel
if($rapel_num=='0')
{
$pdf->SetFillColor(255,238,204);
$pdf->SetFont('Arial','',20);
$pdf->SetY(100);
$pdf->SetX(30);
$pdf->MultiCell(160,8,"Erreur!!!\nVous devez renseigner un n° de rappel",0,C,1);
}
//pour le premier rappel
if($rapel_num=='1')
{
$pdf->SetFillColor(255,238,204);
$pdf->SetFont('Arial','',10);
$pdf->SetY(110);
$pdf->SetX(30);
$pdf->MultiCell(160,5,"Nous avons constatés que vous aver probablement oublié de regler les factures si dessous. \n Merci de bien vouloir y remedier au plus tôt. \n Veuiller agréer Madame Monsieur L'expression de nos sentiments respectueux.\nSi votre payement avait croisé ce rappel, veuillez le considérer comme nul et non avenu\n",0,L,0);
}

//pour le deuxieme rappel
if($rapel_num=='2')
{
$pdf->SetFillColor(255,238,204);
$pdf->SetFont('Arial','',10);
$pdf->SetY(100);
$pdf->SetX(30);
$pdf->MultiCell(160,5,"			 								Madame, Monsieur, \n 									 Malgrès notre premier rappel, vous n'avez toujours pas réglé les factures ci-dessous.\nMerci de bien vouloir créditer notre compte endéans les huits jours.\n Dans le cas contraire nous serions dans l'obligation d'appliquer nos conditions générales de vente se trouvant au dos de ce document ainssi qu'au dos de toutes nos factures.\n			Si votre payement avait croisé ce rappel, veuillez le considérer comme nul et non avenu.\n",0,L,1);
}
//Pour le troisieme rappel
if($rapel_num=='3')
{
$pdf->SetFillColor(255,238,204);
$pdf->SetFont('Arial','',10);
$pdf->SetY(100);
$pdf->SetX(30);
$pdf->MultiCell(160,5,"Troisieme rappel",0,L,1);
}
//le cntenu des coordonées vendeur
$pdf->SetFillColor(255,238,204);
$pdf->SetFont('Arial','',8);
$pdf->SetY(70);
$pdf->SetX(51);
$pdf->MultiCell(50,4,"$social\n $tel\n $tva_vend \n$compte \n$mail",0,L,1);
$pdf->Line(20,65,200,65);
$pdf->ln(65);
//Le tableau : on définit les colonnes
/*$pdf->AddCol('num',30,'N° de facture','C');
$pdf->AddCol('date',30,'Date','C');
$pdf->AddCol('total_fact_ttc',30,'Montant T.T.C','C');
$prop=array('HeaderColor'=>array(255,150,100),
		  'color1'=>array(255,238,204),
			'color2'=>array(255,255,210),
			'entete'=>0,
			'padding'=>2);
$pdf->Table("SELECT num, DATE_FORMAT(date_fact,'%d/%m/%Y') AS date, total_fact_ttc FROM " . $tblpref ."facture WHERE num = $choix[0]",$prop);
*/
//la boucle pour le tableau
for ($i=0 ; $i< sizeof($choix) ; $i++)
   if (isset($choix[$i]) )
   {
//Le tableau : on définit les colonnes
$pdf->AddCol('num',30,' ','C');
$pdf->AddCol('date',30,' ','C');
$pdf->AddCol('total_fact_ttc',30,' ','C');
$prop=array('HeaderColor'=>array(255,150,100),
		  'color1'=>array(255,238,204),
			'color2'=>array(255,255,210),
			'entete'=>0,
			'padding'=>2);
$pdf->Table("SELECT num, DATE_FORMAT(date_fact,'%d/%m/%Y') AS date, total_fact_ttc FROM " . $tblpref ."facture WHERE num = $choix[$i]",$prop);
}
//deuxieme cellule les coordonnées vendeurs 2
$pdf->SetFillColor(255,238,204);
$pdf->SetFont('Arial','',8);
$pdf->SetY(240);
$pdf->SetX(25);
$pdf->MultiCell(35,4,"$social\n $tel\n $tva_vend \n$compte \n$reg",0,C,0);//le numero de facture(largeur,hauteur
//la derniere cellule conditions de facturation
$pdf->SetFillColor(255,238,204);
$pdf->SetFont('Arial','B',10);
$pdf->SetY(268);
$pdf->SetX(30);
$pdf->MultiCell(160,4,"Conditions de vente au verso\n Algemene verkoopsvoorwaarden, zie keerzijde.\n",0,C,0);
//on enregisre les rappels
for ($i=0 ; $i< sizeof($choix) ; $i++)
   if (isset($choix[$i]) )
   {
	 $sql1 = "UPDATE " . $tblpref ."facture SET r$rapel_num ='".$date_jour."' WHERE num = '".$choix[$i]."'";
   mysql_query($sql1) or die('Erreur SQL !<br>'.$sql1.'<br>'.mysql_error());
	 }				
//Détermination d'un nom de fichier temporaire dans le répertoire courant
$file=basename(tempnam(getcwd(),'tmp'));
rename($file,$file.'.pdf');
$file.='.pdf';
//Sauvegarde du PDF dans le fichier
$pdf->Output($file);
//Redirection JavaScript
echo "<HTML><SCRIPT>document.location='$file';</SCRIPT></HTML>";
?> 
