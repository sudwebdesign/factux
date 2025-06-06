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
 *
 *      Création Informatique Ingles Thomas
 *              Factux 10 years Remix.8.2015
 */
session_cache_limiter('private');
if(isset($_POST['user'])&&$_POST['user']=='adm'){
 require_once("../include/verif2.php");
} else {
 $from_cli='../client/';
 require_once("../include/verif_client.php");
}
 $now='../';
include_once("../include/config/common.php");
require_once("../include/config/var.php");
require_once("../include/configav.php");
require_once("../include/language/$lang.php");

define('FPDF_FONTPATH','font/');
require_once('mysql_table.php');

$_POST['mail']=isset($_POST['mail'])?$_POST['mail']:"n";
$num_dev=(isset($_POST['num_dev']))?$_POST['num_dev']:"";
$nom=(isset($_POST['nom']))?$_POST['nom']:"";

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
SELECT " . $tblpref ."cont_dev.num, quanti, uni, article, p_u_jour, marge_jour, remise, tot_art_htva
FROM " . $tblpref ."cont_dev
LEFT JOIN " . $tblpref ."article on " . $tblpref ."cont_dev.article_num = " . $tblpref ."article.num
WHERE  dev_num = $num_dev";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql2.'<br>'.mysql_error());
$nb_li = mysql_num_rows($req);
$nb_pa1 = $nb_li /31 ;
$nb_pa = ceil($nb_pa1);
$nb_li =$nb_pa * 31 ;

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
from " . $tblpref ."devis where num_dev = $num_dev";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
$date_dev = $data['date_2'];
$total_htva = $data['tot_htva'];
$total_tva = $data['tot_tva'];
$coment = $data['coment'];
$tot_tva_inc = $total_htva + $total_tva ;
//pour le nom de client
$sql1 = "
SELECT mail, nom, nom2, rue, ville, cp, num_tva
FROM " . $tblpref ."client
LEFT JOIN " . $tblpref ."devis on client_num = num_client
WHERE  num_dev = $num_dev";
$req = mysql_query($sql1) or die('Erreur SQL !<br>'.$sql1.'<br>'.mysql_error());
while($data = mysql_fetch_array($req)){
 $nom = $data['nom'];
 $nom2 = $data['nom2'];
 $rue = $data['rue'];
 $ville = $data['ville'];
 $cp = $data['cp'];
 $num_tva = $data['num_tva'];
 $mail_client = $data['mail'];
}
//page 1
class PDF extends PDF_MySQL_Table{
    function Header(){}
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
    function AutoPrint($dialog=false, $nb_impr=1){
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
 $nb = $i *31;#15
 $num_pa = $i;
 $num_pa2 = $num_pa +1;

 $pdf->AddPage();
 //la date
 $pdf->SetFillColor(255,255,255);
 $pdf->SetFont('DejaVu','',10);
 $pdf->SetY(4);
 $pdf->SetX(120);
 $pdf->MultiCell(50,6,"$lang_date: $date_dev",1,'C',1);//
 //la grande cellule sous le tableau
 $pdf->SetFont('DejaVu','',6);
 $pdf->SetY(75);
 $pdf->SetX(10);
 $pdf->Cell(187,161,"",1,0,'C',1);
 //premiere celule le numero de devis
 $pdf->SetFont('DejaVu','',10);
 $pdf->SetY(11);
 $pdf->SetX(120);
 $pdf->Cell(65,6,"$lang_de_num : $num_dev",1,0,'C',1);
 //deuxieme cellule les coordoné clients
 $pdf->SetFont('DejaVu','',10);
 $pdf->SetY(33);
 $pdf->SetX(120);
 $pdf->MultiCell(65,6,"$nom\n$nom2\n$rue\n$cp $ville",1,'C',1);
 if($num_tva!=' '){//cellule la tva client
  $pdf->SetFont('DejaVu','',10);
  $pdf->SetY(18);
  $pdf->SetX(120);
  $pdf->MultiCell(65,6,"$num_tva",1,'C',1);
 }
 //le logo
 $pdf->Image("../image/$logo",10,4,50,24,'jpg');
 $pdf->ln(20);
 //Troisieme cellule le slogan
 $pdf->SetFont('DejaVu','',15);
 $pdf->SetY(60);
 $pdf->SetX(10);
 $pdf->MultiCell(90,4,"$slogan",0,'C',0);
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
 $pdf->Line(10,65,197,65);
 $pdf->ln(18);
 //Le tableau : on définit les colonnes
 $pdf->AddCol('quanti',16,"$lang_quanti",'R');
 $pdf->AddCol('uni',15,"$lang_unite",'L');
 if($total_remise_htva!=0){
  $pdf->AddCol('article',60,"$lang_article",'L');
  $pdf->AddCol('taux_tva',15,"$lang_t_tva",'R');
  $pdf->AddCol('p_u_jour',30,"$lang_prix_htva",'R');
  $pdf->AddCol('remise',16,"$lang_remise",'R');
  $pdf->AddCol('tot_art_htva',35,"$lang_tot_arti",'R');
 }else{
  $pdf->AddCol('article',66,"$lang_article",'L');
  $pdf->AddCol('taux_tva',20,"$lang_t_tva",'R');
  $pdf->AddCol('p_u_jour',35,"$lang_prix_htva",'R');
  #$pdf->AddCol('remise',15,"$lang_remise",'R');
  $pdf->AddCol('tot_art_htva',35,"$lang_tot_arti",'R');
 }
 $prop=array(
 'HeaderColor'=>array(255,150,100),
 //couleur ligne 1
 'color1'=>array(255,255,255),
 //couleur ligne 2
 'color2'=>array(230,245,209),
 'align' =>'L',
 'padding'=>2);
 $pdf->Table("
 SELECT " . $tblpref ."cont_dev.num, quanti, remise, uni, article, taux_tva, prix_htva, p_u_jour, tot_art_htva
 FROM " . $tblpref ."cont_dev
 LEFT JOIN " . $tblpref ."article on " . $tblpref ."cont_dev.article_num = " . $tblpref ."article.num
 WHERE  dev_num = $num_dev
 LIMIT $nb, 31",$prop);

 $pdf->SetFillColor(255,255,255);
 if($num_pa2 >= $nb_pa){
  //Quatrieme cellule les enoncés de totaux
  $pdf->SetFont('DejaVu','',10);
  $pdf->SetY(236);
  $pdf->SetX(157);
  $pdf->MultiCell(40,4,montant_financier($total_htva)."\n".montant_financier($total_tva)."\n".montant_financier($tot_tva_inc),1,'R',1);
  //Cinquieme cellule les totaux
  $pdf->SetFont('DejaVu','',9);
  $pdf->SetY(236);
  $pdf->SetX(117);
  $pdf->MultiCell(40,4,"$lang_totaux",1,'R',1);#$pdf->MultiCell(40,4,"$lang_total_h_tva: \n $lang_tot_tva: \n $lang_tot_ttc: ",1,'R',1);
  $pdf->Line(10,266,197,266);

  if($lang=='fr'){//le total en toute lettre nombre_literal only in french
   $pdf->SetFont('DejaVu','',8);
   $pdf->SetY(249);
   $pdf->SetX(117);
   $pdf->MultiCell(80,4,nombre_literal(avec_virgule($tot_tva_inc)),0,'L',0);
  }
  //pour les commentaire
  $pdf->SetFont('DejaVu','',8);
  $pdf->SetY(252);
  $pdf->SetX(10);
  $pdf->MultiCell(101,4,"$coment",0,'L',0);
  if($total_remise_htva!=0){//Pour le total de la remise
   $pdf->SetFont('DejaVu','',8);
   $pdf->SetY(236);
   $pdf->SetX(83);
   $pdf->MultiCell(27,4,"$lang_total $lang_remise $lang_htva",1,'C',1);
   $pdf->SetFont('DejaVu','',8);
   $pdf->SetY(240);
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


 //les coordonnées vendeurs 2
 /*$pdf->SetFillColor(255,255,255);
 $pdf->SetFont('DejaVu','',8);
 $pdf->SetY(240);
 $pdf->SetX(15);
 $pdf->MultiCell(35,4,"$social\n $tel_vend\n $tva_vend \n$compte \n$reg",0,'C',0);*/

 //Place libre pour la signature
 $pdf->SetFont('DejaVu','',10);
 $pdf->SetY(239);
 $pdf->SetX(10);
 $pdf->MultiCell(66,8,"",1,'C',1);
 //Pour la signature
 $pdf->SetFont('DejaVu','',10);
 $pdf->SetY(239);
 $pdf->SetX(10);
 $pdf->MultiCell(20,4,"$lang_po_rec",1,'C',1);
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
}
if ($_POST['mail']=='y'){
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
$file=$lang_devis."_".$num_dev.".pdf";#2015
$pdf->Output($file);

if ($_POST['mail']=='y') {
 $to = "$mail_client";
 $sujet = $lang_mail_client_dev_sujet.$entrep_nom;
 $message = $lang_mail_client_dev_message.$entrep_nom;
 $fichier = "$file";
 $typemime = "pdf";
 $nom = "$file";
 $reply = "$mail";
 $from = "$mail";
 require "../include/CMailFile.php";
 $newmail = new CMailFile("$sujet","$to","$from","$message","$fichier","application/pdf");
 if($newmail->sendfile())
  echo "<html><script>window.location='../lister_devis.php';</script></html>";
 else
  echo "<html><h3 style='color:red;'>$lang_env_par_mail_non</h3><script>setTimeout(function(){window.location='../lister_devis.php'},2000);</script></html>";
} else {
 echo "<html><script>window.location='".str_replace('+',' ',urlencode($file))."';</script></html>";
}
