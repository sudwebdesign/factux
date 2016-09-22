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
 * File Name: bon_pdf.php
 * 	generation des bons de commande au format pdf.
 * 
 * * * Version:  1.1.5
 * * * * Modified: 23/07/2005
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */

include_once("bon_pdf.inc.php"); 
//page 1

class PDF extends PDF_MySQL_Table
{

function Header()
{		}
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
$pdf=new PDF('p','mm','a4');
$pdf->Open();

for ($i=0;$i<$nb_pa;$i++)
{
$nb = $i *15;
$num_pa = $i;
$num_pa2 = $num_pa +1;

$pdf->AddPage();
//la date
$pdf->SetFillColor(255,255,255);
$pdf->SetFont('Arial','B',10);
$pdf->SetY(4);
$pdf->SetX(135);
$pdf->MultiCell(50,6,"$lang_date: $date_bon",1,C,1);
//le logo
$pdf->Image("../image/$logo",10,8,50, 0,'jpg');
//Troisieme cellule le slogan

$pdf->SetFont('Arial','B',15);
$pdf->SetY(60);
$pdf->SetX(10);
$pdf->MultiCell(90,4,"$slogan",0,C,0);

//deuxieme cellule les coordoné clients
$pdf->SetFont('Arial','B',10);
$pdf->SetY(27);
$pdf->SetX(120);
$pdf->MultiCell(65,6,"$nom \n $nom2 \n $rue \n $cp  $ville \n ",1,C,1);
//Troisieme cellule les coordoné vendeur
$pdf->SetFont('Arial','B',8);
$pdf->SetY(70);
$pdf->SetX(10);
$pdf->MultiCell(40,4,"$lang_dev_pdf_soc",1,R,1);

//le cntenu des coordonées vendeur
$pdf->SetFont('Arial','',8);
$pdf->SetY(70);
$pdf->SetX(51);
$pdf->MultiCell(50,4,"$entrep_nom\n$social\n $tel\n $tva_vend \n$compte \n$mail",1,L,1);//
$pdf->Line(20,65,200,65);
//$pdf->ln(10);
//premiere celule le numero de bon
$pdf->SetFont('Arial','B',10);
$pdf->SetY(85);
$pdf->SetX(120);
$pdf->Cell(65,6,"$lang_num_bon_ab $num_bon",1,0,'C',1);
$file="$lang_fi_b_c $num_bon.pdf";
//cellule la tva client
$pdf->SetFont('Arial','B',10);
$pdf->SetY(70);
$pdf->SetX(120);
$pdf->MultiCell(65,6,"$lang_tva: $num_tva",1,C,1);


//la grande cellule sous le tableau

$pdf->SetY(105);
$pdf->SetX(12);
$pdf->Cell(186,95,"",1,0,'C',1);

//Le tableau : on définit les colonnes
$pdf->AddCol('quanti',15,"$lang_quanti",'C');


if($lot=='y'){
$pdf->AddCol('uni',10,"$lang_unite",'C');
$pdf->AddCol('article',66,"$lang_article",'C');	
$pdf->AddCol('num_lot',20,"$lang_num_lot",'C');
$pdf->AddCol('remise',15,"$lang_remise",'C');
$pdf->AddCol('taux_tva',10,"$lang_t_tva",'C');
$pdf->AddCol('p_u_jour',25,"$lang_prix_htva",'C');
}else {
$pdf->AddCol('uni',15,"$lang_unite",'C');
$pdf->AddCol('article',71,"$lang_article",'C');	
$pdf->AddCol('remise',15,"$lang_remise",'C');
$pdf->AddCol('taux_tva',20,"$lang_t_tva",'C');
$pdf->AddCol('p_u_jour',25,"$lang_prix_htva",'C');
}

$pdf->AddCol('tot_art_htva',25,"$lanf_tot_arti",'C');
$prop=array('HeaderColor'=>array(255,150,100),
		  'color1'=>array(255,255,255),
			'color2'=>array(255,238,204),
			'padding'=>2);
$pdf->Table("SELECT " . $tblpref ."cont_bon.num, num_lot, quanti, remise, uni, article, taux_tva, prix_htva, p_u_jour, tot_art_htva FROM " . $tblpref ."cont_bon RIGHT JOIN " . $tblpref ."article on " . $tblpref ."cont_bon.article_num = " . $tblpref ."article.num WHERE  bon_num = $num_bon LIMIT $nb, 15",$prop);
//les coordonnées vendeurs 2
/*$pdf->SetFillColor(255,238,204);
$pdf->SetFont('Arial','',8);
$pdf->SetY(240);
$pdf->SetX(25);
$pdf->MultiCell(35,4,"$social\n $tel\n $tva_vend \n$compte \n$reg",0,C,0);*/
//Pour la signature
$pdf->SetFont('Arial','B',10);
$pdf->SetY(238);
$pdf->SetX(110);
$pdf->MultiCell(40,10,"$lang_po_rec",1,C,1);
//Place libre pour la signature
$pdf->SetFont('Arial','B',10);
$pdf->SetY(238);
$pdf->SetX(148);
$pdf->MultiCell(40,10,"\n\n",1,C,1);

if($num_pa2 >= $nb_pa)
  {
//Quatrieme cellule les enoncés de totaux
$pdf->SetFont('Arial','B',12);
$pdf->SetY(200);
$pdf->SetX(158);
$pdf->MultiCell(40,4,"$total_htva $devise\n $total_tva $devise\n $tot_tva_inc $devise ",1,C,1);
//Cinquieme cellule les totaux
$pdf->SetFont('Arial','B',10);
$pdf->SetY(200);
$pdf->SetX(118);
$pdf->MultiCell(40,4,"$lang_totaux",1,R,1);
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
//le nombre de page 

$pdf->SetFont('Arial','B',10);
$pdf->SetY(260);
$pdf->SetX(30);
$pdf->MultiCell(160,4,"$lang_page $num_pa2 $lang_de $nb_pa\n",0,C,0);


}	 

if($_POST['mail'] =='y'){
$pdf->AddPage();
$pdf->SetFont('Arial','B',10);
$pdf->SetY(10);
$pdf->SetX(30);
$pdf->MultiCell(160,4,"Conditions génerales de vente\n",0,C,0);
$pdf->SetY(70);
$pdf->SetX(10);
$pdf->MultiCell(160,4,"$lang_condi_ven",0,C,0);
}

if($autoprint=='y' and $_POST['mail']!='y' and $_POST['user']=='adm'){
$pdf->AutoPrint(false, $nbr_impr);
}
//Sauvegarde du PDF dans le fichier
$pdf->Output($file);
//Redirection JavaScript
//echo "<HTML><SCRIPT>document.location='$file';</SCRIPT></HTML>";
if ($_POST['mail']=='y') {
$to = "$mail_client";
$sujet = "Bon de commande de $entrep_nom";
$message = "un nouveau bon de commande vous a été adressé par $entrep_nom. \n Vous le trouverez en piece jointe de ce mail. \n Salutations distinguées \n $entrep_nom";
$fichier = "$file";
$typemime = "pdf";
$nom = "$file";
$reply = "$mail";
$from = "$entrep_nom<$mail>";
require "../include/CMailFile.php";
$newmail = new CMailFile("$sujet","$to","$from","$message","$fichier","application/pdf");
$newmail->sendfile();

echo "<HTML><SCRIPT>document.location='../lister_commandes.php';</SCRIPT></HTML>";
  
} else { 
echo "<HTML><SCRIPT>document.location='$file';</SCRIPT></HTML>";
}
?> 
