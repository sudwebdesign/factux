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
if ($_GET['pdf_user']=='adm') {
require_once("../include/verif2.php");
} else {
require_once("../include/verif_client.php");
  
}
error_reporting(0);
define('FPDF_FONTPATH','font/');
require('mysql_table.php');
include("../include/config/common.php");
require("../include/config/var.php");	
require("../include/configav.php");	
require_once("../include/language/$lang.php");
$num_dev=isset($_GET['num_dev'])?$_GET['num_dev']:"";
$nom=isset($_GET['nom'])?$_POST['nom']:"";	 
$euro= '€';
$devise = ereg_replace('&#128;', $euro, €);
$slogan = stripslashes($slogan);
$entrep_nom= stripslashes($entrep_nom);
$social= stripslashes($social);
$tel= stripslashes($tel);
$tva_vend= stripslashes($tva_vend);
$compte= stripslashes($compte);
$reg= stripslashes($reg);
$mail= stripslashes($mail);		

//on compte le nombre de ligne
$sql = "SELECT " . $tblpref ."cont_dev.num, quanti, uni, article, prix_htva, tot_art_htva FROM " . $tblpref ."cont_dev RIGHT JOIN " . $tblpref ."article on " . $tblpref ."cont_dev.article_num = " . $tblpref ."article.num WHERE  dev_num = $num_dev";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql2.'<br>'.mysql_error());
$nb_li = mysql_num_rows($req);
$nb_pa1 = $nb_li /15 ;
$nb_pa = ceil($nb_pa1);
$nb_li =$nb_pa * 15 ;
//pour la date
$sql = "select coment, tot_htva, tot_tva, DATE_FORMAT(date,'%d/%m/%Y') AS date_2 from " . $tblpref ."devis where num_dev = $num_dev";
$req = mysql_query($sql) or die('Erreur SQL
!<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
$date_dev = $data[date_2];
$total_htva = $data[tot_htva];
$total_tva = $data[tot_tva];
$coment = $data[coment];
$tot_tva_inc = $total_htva + $total_tva ;
//pour le nom de client
$sql1 = "SELECT mail, nom, nom2, rue, ville, cp, num_tva FROM " . $tblpref ."client RIGHT JOIN " . $tblpref ."devis on client_num = num_client WHERE  num_dev = $num_dev";
$req = mysql_query($sql1) or die('Erreur SQL !<br>'.$sql1.'<br>'.mysql_error());
while($data = mysql_fetch_array($req))
    {
		$nom = $data['nom'];
		$nom2 = $data['nom2'];
		$rue = $data['rue'];
		$ville = $data['ville'];
		$cp = $data['cp'];
		$num_tva = $data['num_tva'];
		$mail_client = $data['mail'];
		}
//page 1
class PDF extends PDF_MySQL_Table
{
//debut Js
var $javascript;
    var $n_js;

    function IncludeJS($script) {
        $this->javascript=$script;
    }

    function _putjavascript() {
        $this->_newobj();
        $this->n_js=$this->n;
        $this->_out('<<');
        $this->_out('/Names [(EmbeddedJS) '.($this->n+1).' 0 R ]');
        $this->_out('>>');
        $this->_out('endobj');
        $this->_newobj();
        $this->_out('<<');
        $this->_out('/S /JavaScript');
        $this->_out('/JS '.$this->_textstring($this->javascript));
        $this->_out('>>');
        $this->_out('endobj');
    }

    function _putresources() {
        parent::_putresources();
        if (!empty($this->javascript)) {
            $this->_putjavascript();
        }
    }

    function _putcatalog() {
        parent::_putcatalog();
        if (isset($this->javascript)) {
            $this->_out('/Names <</JavaScript '.($this->n_js).' 0 R>>');
        }
    }
		function AutoPrint($dialog=false, $nb_impr)
{
    //Ajoute du JavaScript pour lancer la boîte d'impression ou imprimer immediatement
    $param=($dialog ? 'true' : 'false');
    $script=str_repeat("print($param);",$nb_impr);
		
    $this->IncludeJS($script);
}
//fin js
}
$pdf=new PDF();
$pdf->Open();


for ($i=0;$i<$nb_pa;$i++)
{
$nb = $i *15;
$num_pa = $i;
$num_pa2 = $num_pa +1;

$pdf->AddPage();
//la grande cellule sous le tableau
$pdf->SetFillColor(255,255,255);
$pdf->SetFont('Arial','B',6);
$pdf->SetY(105);
$pdf->SetX(12);
$pdf->Cell(186,95,"",1,0,'C',1);
//premiere celule le numero de bon
$pdf->SetFont('Arial','B',10);
$pdf->SetY(85);
$pdf->SetX(120);
$pdf->Cell(65,6,"$lang_de_num : $num_dev",1,0,'C',1);
//deuxieme cellule les coodoné clients
$pdf->SetFont('Arial','B',10);
$pdf->SetY(27);
$pdf->SetX(120);
$pdf->MultiCell(65,6,"$nom \n $nom2 \n $rue \n $cp  $ville \n ",1,C,1);

//cellule la tva client
$pdf->SetFont('Arial','B',10);
$pdf->SetY(70);
$pdf->SetX(120);
$pdf->MultiCell(65,6,"$lang_tva: $num_tva",1,C,1);
//le logo
$pdf->Image("../image/$logo",10,8,50, 0,'jpg');
$pdf->ln(20);
//Troisieme cellule le slogan
$pdf->SetFont('Arial','B',15);
$pdf->SetY(60);
$pdf->SetX(10);
$pdf->MultiCell(90,4,"$slogan",0,C,0);
//Troisieme cellule les coordoné vendeur
$pdf->SetFont('Arial','B',8);
$pdf->SetY(70);
$pdf->SetX(10);
$pdf->MultiCell(40,4,"$lang_dev_pdf_soc",1,R,1);
//la date
$pdf->SetFont('Arial','B',10);
$pdf->SetY(4);
$pdf->SetX(135);
$pdf->MultiCell(50,6,"$lang_date: $date_dev",1,C,1);//
//le cntenu des coordonées vendeur
$pdf->SetFont('Arial','',8);
$pdf->SetY(70);
$pdf->SetX(51);
$pdf->MultiCell(50,4,"$entrep_nom\n$social\n $tel\n $tva_vend \n$compte \n$mail",0,L,1);//
$pdf->Line(20,65,200,65);
$pdf->ln(10);
//Le tableau : on définit les colonnes
$pdf->AddCol('quanti',16,"$lang_quanti",'C');
$pdf->AddCol('uni',15,"$lang_unite",'C');
$pdf->AddCol('article',60,"$lang_article",'C');
$pdf->AddCol('taux_tva',15,"$lang_t_tva",'C');
$pdf->AddCol('remise',15,"$lang_remise",'C');
$pdf->AddCol('p_u_jour',30,"$lang_prix_htva",'C');
$pdf->AddCol('tot_art_htva',35,"$lanf_tot_arti",'C');
$prop=array('HeaderColor'=>array(255,150,100),
//couleur ligne 1
		  'color1'=>array(255,255,255),
//couleur ligne 2
			'color2'=>array(230,245,209),
			'padding'=>2);
$pdf->Table("SELECT " . $tblpref ."cont_dev.num, quanti, remise, uni, article, taux_tva, prix_htva, p_u_jour, tot_art_htva FROM " . $tblpref ."cont_dev RIGHT JOIN " . $tblpref ."article on " . $tblpref ."cont_dev.article_num = " . $tblpref ."article.num WHERE  dev_num = $num_dev LIMIT $nb, 15",$prop);
//les coordonnées vendeurs 2
/*$pdf->SetFillColor(255,255,255);
$pdf->SetFont('Arial','',8);
$pdf->SetY(240);
$pdf->SetX(15);
$pdf->MultiCell(35,4,"$social\n $tel\n $tva_vend \n$compte \n$reg",0,C,0);*/
//Pour la signature
$pdf->SetFont('Arial','B',10);
$pdf->SetY(235);
$pdf->SetX(60);
$pdf->MultiCell(40,10,"$lang_po_rec",1,C,1);
//Place libre pour la signature
$pdf->SetFont('Arial','B',10);
$pdf->SetY(235);
$pdf->SetX(108);
$pdf->MultiCell(80,10,"\n\n",1,C,1);

if($num_pa2 >= $nb_pa)
  {
//Quatrieme cellule les enoncés de totaux
$pdf->SetFont('Arial','B',12);
$pdf->SetY(200);
$pdf->SetX(148);
$pdf->MultiCell(40,4,"$total_htva €\n $total_tva €\n $tot_tva_inc € ",1,C,1);
//Cinquieme cellule les totaux
$pdf->SetFont('Arial','B',10);
$pdf->SetY(200);
$pdf->SetX(108);
$pdf->MultiCell(40,4,"Total hors tva: \n Total tva: \n Total tva comprise:",1,R,1);
$pdf->Line(20,266,200,266);
//pour les commentaire
$pdf->SetFont('Arial','',10);
$pdf->SetY(217);
$pdf->SetX(10);
$pdf->MultiCell(190,4,"$coment",0,C,0);
   }
//la derniere cellule conditions de facturation
$pdf->SetFont('Arial','B',6);
$pdf->SetY(268);
$pdf->SetX(30);
$pdf->MultiCell(160,4,"$lang_condi",0,C,0);
//le nombre de page si necessaire
$pdf->SetFont('Arial','B',10);
$pdf->SetY(260);
$pdf->SetX(30);
$pdf->MultiCell(160,4,"$lang_page $num_pa2 $lang_de $nb_pa\n",0,C,0);
}
if ($_GET['action']=='mail') {
$pdf->AddPage();
$pdf->SetFont('Arial','B',10);
$pdf->SetY(10);
$pdf->SetX(30);
$pdf->MultiCell(160,4,"Conditions génerales de vente\n",0,C,0);
$pdf->SetY(70);
$pdf->SetX(10);
$pdf->MultiCell(160,4,"$lang_condi_ven",0,C,0);

}

//Détermination d'un nom de fichier temporaire dans le répertoire courant
$file=basename(tempnam(getcwd(),'tmp'));
rename($file,$file.'.pdf');
$file.='.pdf';
if($autoprint=='y' and $_GET['action']!='mail' and $_GET['pdf_user']=='adm'){
$pdf->AutoPrint(false, $nbr_impr);
}
//Sauvegarde du PDF dans le fichier
$pdf->Output($file); 
if ($_GET['action']=='mail') {
$to = "$mail_client";
$sujet = "Devis de $entrep_nom";
$message = "un nouveau devis vous a été adressé par $entrep_nom. \n Vous le trouverez en piece jointe de ce mail. \n Salutations distinguées \n $entrep_nom";
$fichier = "$file";
$typemime = "pdf";
$nom = "$file";
$reply = "$mail";
$from = "$mail";
require "../include/CMailFile.php";
$newmail = new CMailFile("$sujet","$to","$from","$message","$fichier","application/pdf");
$newmail->sendfile();

echo "<HTML><SCRIPT>document.location='../lister_devis.php';</SCRIPT></HTML>";
 
} else {
echo "<HTML><SCRIPT>document.location='$file';</SCRIPT></HTML>";
  
}
?> 
