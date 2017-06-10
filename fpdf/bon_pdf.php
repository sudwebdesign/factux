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
 * File Name: bon_pdf.php
 * 	generation des bons de commande au format pdf.
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

require_once("bon_pdf.inc.php"); 
//page 1

class PDF extends PDF_MySQL_Table{

function Header()
{		}
//debut Js
var $javascript;
    var $n_js;

    function IncludeJS($script) {
        $this->javascript=$script;
    }
    function putjavascript() {
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
    function putresources() {
        parent::_putresources();
        if (!empty($this->javascript)) {
            $this->_putjavascript();
        }
    }
    function putcatalog() {
        parent::_putcatalog();
        if (isset($this->javascript)) {
            $this->_out('/Names <</JavaScript '.($this->n_js).' 0 R>>');
        }
    }
    function AutoPrint($dialog=false, $nb_impr){
         //Ajoute du JavaScript pour lancer la boîte d'impression ou imprimer immediatement
         $param=($dialog ? 'true' : 'false');
         $script=str_repeat("print($param);",$nb_impr);
         $this->IncludeJS($script);
    }
//fin js
}
$pdf=new PDF('p','mm','a4');
$pdf->Open();
$pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);

for ($i=0;$i<$nb_pa;$i++){
 $nb = $i * 31;
 $num_pa = $i;
 $num_pa2 = $num_pa + 1;

 $pdf->AddPage();
 //la date
 $pdf->SetFillColor(255,255,255);
 $pdf->SetFont('DejaVu','',10);
 $pdf->SetY(4);
 $pdf->SetX(120);
 $pdf->MultiCell(50,6,"$lang_date: $date_bon",1,'C',1);
 //le logo
 $pdf->Image("../image/$logo",10,4,50,24,'jpg');
 //Troisieme cellule le slogan
 $pdf->SetFont('DejaVu','',15);
 $pdf->SetY(60);
 $pdf->SetX(10);
 $pdf->MultiCell(90,4,"$slogan",0,'C',0);
 //deuxieme cellule les coordoné clients
 $pdf->SetFont('DejaVu','',10);
 $pdf->SetY(33);
 $pdf->SetX(120);
 $pdf->MultiCell(65,6,"$nom\n$nom2\n$rue\n$cp $ville",1,'C',1);
 //Troisieme cellule les coordoné vendeur
 $pdf->SetFont('DejaVu','',8);
 $pdf->SetY(33);
 $pdf->SetX(10);
 $pdf->MultiCell(40,4,"$lang_dev_pdf_soc",1,'R',1);
 //le cntenu des coordonées vendeur
 $pdf->SetFont('DejaVu','',8);
 $pdf->SetY(33);
 $pdf->SetX(51);
 $pdf->MultiCell(50,4,"$entrep_nom\n$social\n $tel_vend\n $tva_vend \n$compte \n$mail",1,'L',1);//
 $pdf->Line(10,65,196,65);
 //$pdf->ln(10);
 //premiere celule le numero de bon
 $pdf->SetFont('DejaVu','',10);
 $pdf->SetY(11);
 $pdf->SetX(120);
 $pdf->Cell(65,6,"$lang_num_bon_ab $num_bon",1,0,'C',1);
 if($num_tva!=' '){//cellule la tva client
  $pdf->SetFont('DejaVu','',10);
  $pdf->SetY(18);
  $pdf->SetX(120);
  $pdf->MultiCell(65,6,"$num_tva",1,'C',1);
 }

 //la grande cellule sous le tableau

 $pdf->SetY(74);
 $pdf->SetX(10);
 $pdf->Cell(186,161,"",1,0,'C',1);

 //Le tableau : on définit les colonnes
 $pdf->AddCol('quanti',15,"$lang_quanti",'R');
  
 if($lot=='y'){
  $pdf->AddCol('uni',10,"$lang_unite",'L');
  $pdf->AddCol('article',63,"$lang_article",'L');	
  $pdf->AddCol('num_lot',18,"$lang_num_lot",'L');
  if($total_remise_htva!=0){
   $pdf->AddCol('taux_tva',15,"$lang_tva",'R');
   $pdf->AddCol('p_u_jour',25,"$lang_prix_htva",'R');
   $pdf->AddCol('remise',15,"$lang_remise",'R');
  }else{
   $pdf->AddCol('taux_tva',20,"$lang_tva",'R');
   $pdf->AddCol('p_u_jour',35,"$lang_prix_htva",'R');
   #$pdf->AddCol('remise',15,"$lang_remise",'R');
  }
 }else{
  $pdf->AddCol('uni',15,"$lang_unite",'L');
  $pdf->AddCol('article',71,"$lang_article",'L');	
  if($total_remise_htva!=0){
   $pdf->AddCol('taux_tva',20,"$lang_t_tva",'R');
   $pdf->AddCol('p_u_jour',25,"$lang_prix_htva",'R');
   $pdf->AddCol('remise',15,"$lang_remise",'R');
  }else{
   $pdf->AddCol('taux_tva',25,"$lang_t_tva",'R');
   $pdf->AddCol('p_u_jour',35,"$lang_prix_htva",'R');
   #$pdf->AddCol('remise',15,"$lang_remise",'R');
  }
 }
 $pdf->AddCol('tot_art_htva',25,"$lang_tot_arti",'R');

 $prop=array(
  'HeaderColor'=>array(255,150,100),
  'color1'=>array(255,255,255),
  'color2'=>array(255,238,204),
  'align' =>'L',
  'padding'=>2
 );
 $pdf->Table(
 "SELECT " . $tblpref ."cont_bon.num, num_lot, quanti, remise, uni, article, taux_tva, p_u_jour, tot_art_htva 
 FROM " . $tblpref ."cont_bon 
 LEFT JOIN " . $tblpref ."article on " . $tblpref ."cont_bon.article_num = " . $tblpref ."article.num 
 WHERE  bon_num = $num_bon 
 LIMIT $nb, 31",
 $prop
 );
$pdf->SetFillColor(255,255,255);#$pdf->SetFillColor(255,238,204);
 if($num_pa2 >= $nb_pa){
  //Quatrieme cellule les enoncés de totaux
  $pdf->SetFont('DejaVu','',10);
  $pdf->SetY(235);
  $pdf->SetX(156);
  $pdf->MultiCell(40,4,montant_financier($total_htva)."\n".montant_financier($total_tva)."\n".montant_financier($tot_tva_inc),1,'R',1);
  //Cinquieme cellule les totaux
  $pdf->SetFont('DejaVu','',9);
  $pdf->SetY(235);
  $pdf->SetX(116);
  $pdf->MultiCell(40,4,"$lang_totaux",1,'R',1);
  $pdf->Line(10,266,196,266);
  
  if($lang=='fr'){//le total en toute lettre nombre_literal only in french
   $pdf->SetFont('DejaVu','',9);
   $pdf->SetY(248);
   $pdf->SetX(116);
   $pdf->MultiCell(80,4,nombre_literal(avec_virgule($tot_tva_inc)),0,'L',0);#/i\work only with #,##
  }
  //pour les commentaire
  $pdf->SetFont('DejaVu','',8);
  $pdf->SetY(236);
  $pdf->SetX(10);
  $pdf->MultiCell(108,4,"$coment",0,'L',0);
  if($total_remise_htva!=0){//Pour le total de la remise
   $pdf->SetFont('DejaVu','',8);
   $pdf->SetY(235);
   $pdf->SetX(83);
   $pdf->MultiCell(27,4,"$lang_total $lang_remise $lang_htva",1,'C',1);
   $pdf->SetFont('DejaVu','',8);
   $pdf->SetY(239);
   $pdf->SetX(83);
   $pdf->SetTextColor(0, 207, 0);
   $pdf->Cell(27,5,montant_financier ($total_remise_htva),1,1,'R',1);
  }
  //total marge
  #$pdf->SetY(244);
  #$pdf->SetX(83);
  #$pdf->MultiCell(27,5,montant_financier ($total_marge_htva),1,'R',1);#o
  
  $pdf->SetTextColor(0, 0, 0);
 }

 //la derniere cellule conditions de facturation
 $pdf->SetFont('DejaVu','',6);
 $pdf->SetY(268);
 $pdf->SetX(30);
 $pdf->MultiCell(160,4,"$lang_condi",0,'C',0);

 //le nombre de page
 $pdf->SetFont('DejaVu','',9);
 $pdf->SetY(270);
 $pdf->SetX(170);
 $pdf->MultiCell(30,4,"$lang_page $num_pa2 / $nb_pa\n",0,'L',0);

 //les coordonnées vendeurs 2
 /*
 $pdf->SetFont('DejaVu','',8);
 $pdf->SetY(240);
 $pdf->SetX(25);
 $pdf->MultiCell(35,4,"$social\n $tel_vend\n $tva_vend \n$compte \n$reg",0,'C',0);*/
 //Pour la signature
 /*$pdf->SetFont('DejaVu','',10);
 $pdf->SetY(238);
 $pdf->SetX(110);
 $pdf->MultiCell(40,10,"$lang_po_rec",1,'C',1);
 //Place libre pour la signature
 $pdf->SetFont('DejaVu','',10);
 $pdf->SetY(238);
 $pdf->SetX(148);
 $pdf->MultiCell(40,10,"\n\n",1,'C',1);*/
} 

if($_POST['mail'] =='y'){
 $pdf->AddPage();
 $pdf->SetFont('DejaVu','',10);
 $pdf->SetY(10);
 $pdf->SetX(30);
 $pdf->MultiCell(160,4,"Conditions génerales de vente\n",0,'C',0);
 $pdf->SetY(70);
 $pdf->SetX(10);
 $pdf->MultiCell(160,4,"$lang_condi_ven",0,'C',0);
}

if($autoprint=='y' and $_POST['mail']!='y' and $_POST['user']=='adm'){
 $pdf->AutoPrint(false, $nbr_impr);
}
//Sauvegarde du PDF dans le fichier
$file="$lang_fi_b_c $num_bon.pdf";#exit;
$pdf->Output($file);    
//Redirection JavaScript
//echo "<html><script>window.location='$file';</script></html>";
if ($_POST['mail']=='y') {
 $to = "$mail_client";
 $sujet = $lang_mail_client_bon_sujet.$entrep_nom;
 $message = $lang_mail_client_bon_message.$entrep_nom;
 $fichier = "$file";
 $typemime = "pdf";
 $nom = "$file";
 $reply = "$mail";
 $from = "$entrep_nom<$mail>";
 require "../include/CMailFile.php";
 $newmail = new CMailFile("$sujet","$to","$from","$message","$fichier","application/pdf");
 if($newmail->sendfile())
  echo "<html><script>window.location='../lister_commandes.php';</script></html>";
 else
  echo "<html><h3 style='color:red;'>$lang_env_par_mail_non</h3><script>setTimeout(function(){window.location='../lister_commandes.php'},2000);</script></html>";
} else { 
 echo "<html><script>window.location='".str_replace('+',' ',urlencode($file))."';</script></html>";
}
?> 
