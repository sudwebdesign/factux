<?php
/*
 * Factux le facturier libre
 * Copyright (C) 2003-2005 Guy Hendrickx, 2017 Thomas Ingles
 *
 * Licensed under the terms of the GNU  General Public License:
 *   http://opensource.org/licenses/GPL-3.0
 *
 * For further information visit:
 *   http://factux.free.fr
 *
 * File Name: fact_pdf.php
 *  Fichier generant les factures au format pdf
 *
 * * * Version:  5.0.0
 * * * * Modified: 07/10/2016
 *
 * File Authors:
 *   Guy Hendrickx
 *.
 * Modifications :
 *      Daemon2a Corse Informatique Assistance
 *              Le Facturier 2 beta 1
 *
 *      Création Informatique Ingles Thomas
 *              Factux 10 years Remix.8.2015
 */
session_cache_limiter('private');
if(isset($_POST['user'])&&$_POST['user']=='adm'){
 require_once(__DIR__ . "/../include/verif2.php");
}else{
 $from_cli='../client/';
 require_once(__DIR__ . "/../include/verif_client.php");
}

$now='../';
require_once(__DIR__ . "/../include/config/common.php");
require_once(__DIR__ . "/../include/config/var.php");
require_once(__DIR__ . sprintf('/../include/language/%s.php', $lang));
require_once(__DIR__ . "/../include/nb.php");
require_once(__DIR__ . "/../include/configav.php");
define('FPDF_FONTPATH','font/');
require_once(__DIR__ . '/mysql_table.php');

$_POST['mail']=isset($_POST['mail'])?$_POST['mail']:"n";
$client=isset($_POST['client'])?$_POST['client']:"";
$client=[0=>$client];

$debut=isset($_POST['debut'])?$_POST['debut']:"";
$debut=[0=>$debut];
$fin=isset($_POST['fin'])?$_POST['fin']:"";
$fin=[0=>$fin];
$num=isset($_POST['num'])?$_POST['num']:"";
$num=[0=>$num];
$oneclick=isset($_POST['oneclick'])?$_POST['oneclick']:"";
if($oneclick!=''){
 list($jour, $mois,$annee) = preg_split('/\//', $oneclick, 3);
 $oneclick =sprintf('%s-%s-%s', $annee, $mois, $jour);
 $oneclick2= $oneclick;
}


$slogan = stripslashes($slogan);
$entrep_nom= stripslashes($entrep_nom);
$social= stripslashes($social);
$tel_vend= stripslashes($tel_vend);
$compte= stripslashes($compte);
$tva_vend= stripslashes($tva_vend);
$reg= stripslashes($reg);
$mail= stripslashes($mail);
$g=1;

//nouvelle methode
$sql_new ="SELECT * FROM " . $tblpref .sprintf("facture WHERE `num` = '%s'", $num[0]);
$req_new = mysql_query($sql_new) or die('Erreur SQL !<br>'.$sql_new.'<br>'.mysql_error());

while($data_new = mysql_fetch_array($req_new)){
 $list_num = $data_new['list_num'];
}

$list_num = (isset($list_num))?unserialize($list_num):'';#$list_num undefined if oneclick
if(is_array($list_num)&&isset($list_num[0])){
 $suite_sql=" and " . $tblpref .sprintf("bon_comm.num_bon ='%s'", $list_num[0]);
 $counter = count($list_num);
 for($m=1; $m<$counter; $m++){
  $suite_sql .= " or " . $tblpref .sprintf("bon_comm.num_bon ='%s'", $list_num[$m]);
 }
}else{
 $suite_sql=" and " . $tblpref ."bon_comm.num_bon ='-1'";#Blank#tips:si $suite_sql = '';#toutlesprodduclient_recapglobal
}

$suite_sql=[0=>$suite_sql];
if($oneclick!=''){
 $sql2 ="SELECT * FROM " . $tblpref .sprintf("facture WHERE `date_fact` = '%s'", $oneclick);
 $reqd = mysql_query($sql2) or die('Erreur SQL !<br>'.$sql2.'<br>'.mysql_error());
 $nb_fact = mysql_num_rows($reqd);
 unset($client);
 unset($debut);
 unset($fin);
 unset($num);
 unset($suite_sql);
 $g=0;
 if ($nb_fact=='0') {
  echo sprintf('%s %s', $lang_fact_mu_err, $oneclick);
  exit;
 }

 $suite_sql=[];
 while($datad = mysql_fetch_array($reqd)){
  $debut[]= $datad['date_deb'];
  $guy=$datad['client'];
  $fin[]=$datad['date_fin'];
  $num[] = $datad['num'];
  $client[]= $datad['client'];
  $list_num = $datad['list_num'];
  $list_num = unserialize($list_num);
  $suite_sql[]=" and " . $tblpref .sprintf("bon_comm.num_bon ='%s'", $list_num[0]);
  $counter = count($list_num);
  for($m=1; $m<$counter; $m++){
   $suite_sql[$g] .= " or " . $tblpref .sprintf("bon_comm.num_bon ='%s'", $list_num[$m]);
  }

  $g += 1;
 }
}

////

////
class PDF extends PDF_MySQL_Table{
    public function Header(){}

//debut Js
    public $javascript;

    public $n_js;

    public function IncludeJS($script) {
        $this->javascript=$script;
    }

    public function putjavascript() {
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

    public function putresources() {
        parent::_putresources();
        if (!empty($this->javascript)) {
            $this->_putjavascript();
        }
    }

    public function putcatalog() {
        parent::_putcatalog();
        if (property_exists($this, 'javascript') && $this->javascript !== null) {
            $this->_out('/Names <</JavaScript '.($this->n_js).' 0 R>>');
        }
    }

    public function AutoPrint($dialog=false, $nb_impr=1){
         //Ajoute du JavaScript pour lancer la boîte d'impression ou imprimer immediatement
         $param=($dialog ? 'true' : 'false');
         $script=str_repeat(sprintf('print(%s);', $param),$nb_impr);
         $this->IncludeJS($script);
    }

//fin js
}

$pdf=new PDF('p','mm','a4');
$pdf->Open();
$pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
$toto="guy";
$tot_tva_inc=0;
$from_joint_where_client = "
 FROM " . $tblpref ."client
 LEFT JOIN " . $tblpref ."bon_comm on " . $tblpref ."client.num_client = " . $tblpref ."bon_comm.client_num
 LEFT JOIN " . $tblpref ."cont_bon on " . $tblpref ."bon_comm.num_bon = " . $tblpref ."cont_bon.bon_num
 LEFT JOIN  " . $tblpref ."article on " . $tblpref ."article.num = " . $tblpref ."cont_bon.article_num
 WHERE " . $tblpref ."client.num_client = ";
for ($o=0;$o<$g;$o++){
 $file = sprintf('%s %s.pdf', $lang_facture, $num[$o]);
 if ($oneclick!='') {
     $file = sprintf('%s %s%s.pdf', $lang_factures, $lang_bon_cree2, $oneclick);
 }

 //on compte le nombre de lignes #prix_htva, date, quanti, article, tot_art_htva, to_tva_art, taux_tva, remise, uni, num_bon
 $sql = "
 SELECT prix_htva, p_u_jour, quanti, tot_art_htva, marge_jour, remise
 {$from_joint_where_client}'".$client[$o]."'
 ";
 // AND " . $tblpref ."bon_comm.date >= '".$debut[$o]."' and " . $tblpref ."bon_comm.date <= '".$fin[$o]."'";
 $sql =sprintf('%s %s', $sql, $suite_sql[$o]);

 $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
 $nb_li = mysql_num_rows($req);
 $nb_pa1 = $nb_li /31 ;
 $nb_pa = ceil($nb_pa1);
 $nb_li =$nb_pa * 31 ;

 //on calcule le montant de la remise #2015
 $total_marge_htva = 0;
 $total_remise_htva = 0;
 while($data = mysql_fetch_array($req)){
  $prx_a = $data['prix_htva'];#prix d'achat du jour#inutiliséici*4memo

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

 $sql = "
 SELECT payement, coment, acompte, DATE_FORMAT(date_fact,'%d/%m/%Y') AS date_2, DATE_FORMAT(date_pay,'%d/%m/%Y') AS date_pay
 FROM " . $tblpref .('facture
 WHERE num = ' . $num[$o]);
 $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
 $data = mysql_fetch_array($req);
 $date_fact = $data['date_2'];
 $coment = $data['coment'];
 $acompte = $data['acompte'];
 $payement= $data['payement'];
 $date_pay= $data['date_pay'];

 //pour les totaux
 $sql = "SELECT SUM(tot_art_htva), SUM(to_tva_art)
 {$from_joint_where_client}'".$client[$o]."'";
 //AND " . $tblpref ."bon_comm.date >= '".$debut[$o]."' and " . $tblpref ."bon_comm.date <= '".$fin[$o]."'";
 $sql =sprintf('%s %s', $sql, $suite_sql[$o]);
 $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
 $data = mysql_fetch_array($req);
 $total_htva = $data["SUM(tot_art_htva)"];
 $total_tva = $data["SUM(to_tva_art)"];
 $tot_tva_inc += $total_htva;

 //pour le nom de client
 $sql1 = "SELECT mail, nom, nom2, rue, ville, cp, num_tva FROM " . $tblpref .('client WHERE  num_client = ' . $client[$o]);
 $req = mysql_query($sql1) or die('Erreur SQL !<br>'.$sql1.'<br>'.mysql_error());
 $data = mysql_fetch_array($req);
  $nom = $data['nom'];
  $nom2 = $data['nom2'];
  $rue = $data['rue'];
  $ville = $data['ville'];
  $cp = $data['cp'];
  $num_tva = $data['num_tva'];
  $mail_client = $data['mail'];


 for ($i=0;$i<$nb_pa;$i++){
  $nb = $i * 31;
  $num_pa = $i;
  $num_pa2 = $num_pa +1;

  $pdf->AddPage();
  $pdf->SetFillColor(255,255,255);
  //la date
  $pdf->SetFont('DejaVu','',10);
  $pdf->SetY(4);
  $pdf->SetX(120);
  $pdf->MultiCell(50,6,sprintf('%s: %s', $lang_date, $date_fact),1,'C',1);//
  //la grande cellule sous le tableau
  $pdf->SetFont('DejaVu','',6);
  $pdf->SetY(74);
  $pdf->SetX(10);
  $pdf->Cell(187,161,"",1,0,'C',1);
  //premiere celule le numero de fact
  $pdf->SetFont('DejaVu','',10);
  $pdf->SetY(11);
  $pdf->SetX(120);
  $pdf->Cell(65,6,sprintf('%s %s', $lang_fact_num_ab, $num[$o]),1,0,'C',1);
  //deuxieme cellule les coordoné clients
  $pdf->SetFont('DejaVu','',10);
  $pdf->SetY(33);
  $pdf->SetX(120);
  $pdf->MultiCell(65,6,sprintf('%s%s%s%s%s%s%s %s', $nom, PHP_EOL, $nom2, PHP_EOL, $rue, PHP_EOL, $cp, $ville),1,'C',1);
  if($num_tva!=' '){//cellule la tva client
   $pdf->SetFont('DejaVu','',10);
   $pdf->SetY(18);
   $pdf->SetX(120);
   $pdf->MultiCell(65,6,$num_tva,1,'C',1);
  }

  //le logo
  $pdf->Image('../image/' . $logo,10,4,50,24,'jpg');
  $pdf->ln(20);
  //Troisieme cellule le slogan
  $pdf->SetFont('DejaVu','',15);
  $pdf->SetY(60);
  $pdf->SetX(10);
  $pdf->MultiCell(90,4,$slogan,0,'C',0);
  //Troisieme cellule les coordoné vendeur
  $pdf->SetFont('DejaVu','',8);
  $pdf->SetY(33);
  $pdf->SetX(10);
  $pdf->MultiCell(40,4,$lang_dev_pdf_soc,1,'R',1);
  //le cntenu des coordonées vendeur
  $pdf->SetFont('DejaVu','',8);
  $pdf->SetY(33);
  $pdf->SetX(51);
  $pdf->MultiCell(50,4,"{$entrep_nom}\n{$social}\n {$tel_vend}\n {$tva_vend} \n{$compte} \n{$mail}",1,'L',1);//
  $pdf->Line(10,65,197,65);
  $pdf->ln(17);
  //Le tableau : on définit les colonnes
  $pdf->AddCol('num_bon',15,$lang_num_bon_ab,'L');
  $pdf->AddCol('date',16,$lang_date,'C');
  $pdf->AddCol('quanti',18,$lang_quantite,'R');
  if($total_remise_htva!=0){
   $pdf->AddCol('article',45,$lang_articles,'L');
   $pdf->AddCol('p_u_jour',22,$lang_prixunitaire,'R');
   $pdf->AddCol('taux_tva',15,$lang_t_tva,'R');
   $pdf->AddCol('to_tva_art',19,$lang_tva,'R');
   $pdf->AddCol('remise',15,$lang_remise,'R');
   $pdf->AddCol('tot_art_htva',22,$lang_total_h_tva,'R');
  }else{
   $pdf->AddCol('article',50,$lang_articles,'L');
   $pdf->AddCol('p_u_jour',25,$lang_prixunitaire,'R');
   $pdf->AddCol('taux_tva',16,$lang_t_tva,'R');
   $pdf->AddCol('to_tva_art',22,$lang_tva,'R');
   #$pdf->AddCol('remise',21,$lang_remise,'R');
   $pdf->AddCol('tot_art_htva',25,$lang_total_h_tva,'R');
  }

  $prop=[
   'HeaderColor'=>[255,255,120],
   'color1'=>[255,255,255],
   'color2'=>[255,255,200],
   'align' =>'L',
   'padding'=>2
  ];
  $sql_table = "SELECT p_u_jour, DATE_FORMAT(date,'%d/%m/%Y') AS date, quanti, remise, article, tot_art_htva, to_tva_art, taux_tva, uni, num_bon
  {$from_joint_where_client}'".$client[$o]."'";
  $suite2_sql = sprintf('LIMIT %d, 31', $nb);
  $sql_table=sprintf('%s %s %s', $sql_table, $suite_sql[$o], $suite2_sql);
  $pdf->Table($sql_table,$prop);

  //deuxieme cellule les coordonnées vendeurs 2
  $pdf->SetFillColor(255,255,255);#$pdf->SetFillColor(243,244,251);
  /*$pdf->SetFont('DejaVu','',8);
  $pdf->SetY(235);
  $pdf->SetX(5);
  $pdf->MultiCell(50,4,"$entrep_nom\n$social\n $tel_vend\n $tva_vend \n$compte \n$reg",0,'C',0);*/
  if($num_pa2 >= $nb_pa){
   if ($acompte == '0'){//aucun acompte
    //Quatrieme cellule les enoncés de totaux
    $pdf->SetFont('DejaVu','',10);
    $pdf->SetTextColor(255, 0, 0);
    $pdf->SetY(235);
    $pdf->SetX(157);
    $pdf->MultiCell(40,4,montant_financier($total_htva)."\n". montant_financier($total_tva),1,'R',1);

    $pdf->SetY(243);
    $pdf->SetX(157);
    $pdf->SetTextColor(255, 0, 0);
    $pdf->MultiCell(40,4,montant_financier ($total_htva + $total_tva)."\n",1,'R',1);
    //Cinquieme cellule les totaux
    $pdf->SetFont('DejaVu','',9);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetY(235);
    $pdf->SetX(117);
    $pdf->MultiCell(40,4,$lang_totaux,1,'R',1);#$pdf->MultiCell(40,4,"$lang_total_h_tva: \n $lang_tot_tva: \n $lang_tot_ttc: ",1,'R',1);
   }else{//si un acompte est present
    //Quatrieme cellule les enoncés de totaux
    $pdf->SetFont('DejaVu','',10);
    $pdf->SetY(235);
    $pdf->SetX(157);
    $pdf->MultiCell(40,4,montant_financier ($total_htva)."\n".montant_financier ($total_tva)."\n".montant_financier ($total_htva + $total_tva)."\n".montant_financier ($acompte)."\n",1,'R',1);
    $pdf->SetFont('DejaVu','',9);
    $pdf->SetTextColor(255, 0, 0);
    $pdf->SetY(251);
    $pdf->SetX(157);
    $pdf->MultiCell(40,4, montant_financier ($total_htva + $total_tva - $acompte)."\n",1,'R',1);
    //Cinquieme cellule les totaux
    $pdf->SetFont('DejaVu','',9);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetY(235);
    $pdf->SetX(117);
    $pdf->MultiCell(40,4,"{$lang_totaux}\n{$lang_acompte}:\n{$lang_rest_pay}:",1,'R',1);#$pdf->MultiCell(40,4,"$lang_total_h_tva: \n $lang_tot_tva: \n $lang_tot_ttc: \n $lang_acompte: \n $lang_rest_pay: ",1,'R',1);
   }

   //la ventillation de la tva
   $pdf->SetFont('DejaVu','',8);
   $pdf->SetY(235);
   $pdf->SetX(10);
   $pdf->MultiCell(20,4,$lang_t_tva,1,'C',1);

   $pdf->SetFont('DejaVu','',8);
   $pdf->SetY(235);
   $pdf->SetX(30);
   $pdf->MultiCell(20,4,$lang_montant,1,'C',1);

   $pdf->SetFont('DejaVu','',8);
   $pdf->SetY(235);
   $pdf->SetX(50);
   $pdf->MultiCell(25,4,$lang_ba_imp,1,'C',1);

   $sql2="
   SELECT SUM(to_tva_art), SUM(tot_art_htva),taux_tva
   {$from_joint_where_client}'".$client[$o]."'";
   $suite3_sql=" GROUP BY taux_tva";
   $sql2=sprintf('%s %s %s', $sql2, $suite_sql[$o], $suite3_sql);
   ///echo"$sql2<br>";
   ////$resu = mysql_query( $sql2 ) or die('Erreur SQL !<br>'.$sql2.'<br>'.mysql_error());
   $pdf->AddCol('taux_tva',20,$lang_taux_tva,'R');
   $pdf->AddCol('SUM(to_tva_art)',20,$lang_mont_tva,'R');
   $pdf->AddCol('SUM(tot_art_htva)',25,$lang_ba_imp,'R');
   $prop=['
    color1'=>[255,255,230],
    'color2'=>[255,255,255],
    'padding'=>2,
    'entete'=>0,
    'align' =>'L'
   ];
   $pdf->Table($sql2,$prop);
   //fin ventillation

   if($total_remise_htva!=0){//Pour le total de la remise
    $pdf->SetFont('DejaVu','',8);
    $pdf->SetY(235);
    $pdf->SetX(83);
    $pdf->MultiCell(27,4,sprintf('%s %s %s', $lang_total, $lang_remise, $lang_htva),1,'C',1);
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
   //pour les commentaire
   $pdf->SetFont('DejaVu','',8);
   $pdf->SetY(257);
   $pdf->SetX(10);
   $pdf->MultiCell(187,3,$coment,0,'L',0);
  }

  $pdf->Line(10,266,197,266);

  //le pied de page
  $pdf->SetFont('DejaVu','',6);
  $pdf->SetY(268);
  $pdf->SetX(30);
  $pdf->MultiCell(160,4,"{$entrep_nom} {$social} Tel :{$tel_vend} \n{$tva_vend} {$compte} {$reg}",0,'C',0);

  $pdf->SetY(270);
  $pdf->SetX(10);
  if ($payement!='non') {
   $pdf->SetFont('DejaVu','u',9);
   $pdf->MultiCell(60,3,$lang_po_acquis.($date_pay!="00/00/0000"?sprintf('%s%s %s', PHP_EOL, $lang_pay_le, $date_pay):""),0,'C',0);
  }else{//Pour l'échéance
   $pdf->SetFont('DejaVu','',12);
   $pdf->MultiCell(160,4,$lang_echea." ".(($lang=='fr')?ucfirst(nombre_literal(30)):30)." ".$lang_jours,0,'L',0);//le total en toute lettre nombre_literal only in french
  }

  //le nombre de page
  $pdf->SetFont('DejaVu','',9);
  $pdf->SetY(270);
  $pdf->SetX(170);
  $pdf->MultiCell(30,4,sprintf('%s %d / %s%s', $lang_page, $num_pa2, $nb_pa, PHP_EOL),0,'L',0);
 }

 if($_POST['mail'] =='y'){
  $pdf->AddPage();
  $pdf->SetFont('DejaVu','',10);
  $pdf->SetY(10);
  $pdf->SetX(30);
  $pdf->MultiCell(160,4,"Conditions génerales de vente\n",0,'C',0);
  $pdf->SetY(70);
  $pdf->SetX(10);
  $pdf->MultiCell(160,4,$lang_condi_ven,0,'C',0);
 }
}

if($autoprint == 'y' && $_POST['mail'] != 'y' && $_POST['user'] == 'adm'){
 $pdf->AutoPrint(false, $nbr_impr);
}

$pdf->Output($file);

if ($_POST['mail']=='y') {
 $to = $mail_client;
 $sujet = $lang_mail_client_fact_sujet.$entrep_nom;
 $message = $lang_mail_client_fact_message.$entrep_nom;
 $fichier = $file;
 $typemime = "pdf";
 $nom = $file;
 $reply = $mail;
 $from = $mail;
 require __DIR__ . "/../include/CMailFile.php";
 $newmail = new CMailFile($sujet,$to,$from,$message,$fichier,"application/pdf");
 if ($newmail->sendfile()) {
     echo "<html><script>window.location='../lister_factures.php';</script></html>";
 } else {
     echo sprintf("<html><h3 style='color:red;'>%s</h3><script>setTimeout(function(){window.location='../lister_factures.php'},2000);</script></html>", $lang_env_par_mail_non);
 }
}else{
 echo "<html><script>window.location='".str_replace('+',' ',urlencode($file))."';</script></html>";
}



