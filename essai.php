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
$coul_date = "255,238,204";

$fichier = fopen("fpdf/essai.php", "w+"); 
//$un = '"'.$un.'";//l\'utilisateur de la base de données mysql' . "\n";
$a= '<?php' . "\n" .
'include_once("bon_pdf.inc.test.php");' ."\n" .
'class PDF extends PDF_MySQL_Table { }' . "\n" .
'$pdf' . "=new PDF('p','mm','a4');" . "\n" .
'$pdf->Open();' . "\n" .
'for ($i=0;$i<$nb_pa;$i++){' . "\n" .
'$nb = $i *15;' . "\n" .
'$num_pa = $i;' . "\n" .
'$num_pa2 = $num_pa +1;' . "\n" .
'$pdf->AddPage();' . "\n" .

 '$pdf->SetFillColor(' . "$coul_date);" . "\n" .
 '$pdf->SetFont("Arial","B",10);' . "\n" .
 '$pdf->SetY(4);' . "\n" .
 '$pdf->SetX(135);' . "\n" .
 
 '$pdf->MultiCell(50,6,"$lang_date: $date_bon",1,C,1);' . "\n" .
 
 '$pdf->Image("../image/$logo",10,8,0, 0,"jpg");' . "\n" .
 
 '$pdf->SetFont("Arial","B",15);' . "\n" .
 '$pdf->SetY(45);' . "\n" .
 '$pdf->SetX(10);' . "\n" .
 '$pdf->MultiCell(71,4,"$slogan",0,C,0);' . "\n" .
 
 '$pdf->SetFont("Arial","B",10);' . "\n" .
 '$pdf->SetY(27);' . "\n" .
 '$pdf->SetX(120);' . "\n" .
 '$pdf->MultiCell(65,6,"$nom \n $nom2 \n $rue \n $cp  $ville \n ",1,C,1);' . "\n" .
 
 '$pdf->SetFont("Arial","B",8);' . "\n" .
 '$pdf->SetY(70);' . "\n" .
 '$pdf->SetX(10);' . "\n" .
 '$pdf->MultiCell(40,4,"$lang_dev_pdf_soc",1,R,1);' . "\n" .
 
 '$pdf->SetFont("Arial","",8);' . "\n" .
 '$pdf->SetY(70);' . "\n" .
 '$pdf->SetX(51);' . "\n" .
 '$pdf->MultiCell(50,4,"$entrep_nom\n$social\n $tel\n $tva_vend \n$compte \n$mail",1,L,1);' . "\n" .
 '$pdf->Line(20,65,200,65);' . "\n" .
 
 '$pdf->SetFont("Arial","B",10);' . "\n" .
 '$pdf->SetY(85);' . "\n" .
 '$pdf->SetX(120);' . "\n" .
 '$pdf->Cell(65,6,"$lang_num_bon_ab $num_bon",1,0,"C",1);' . "\n" .
 
 '$pdf->SetFont("Arial","B",10);' . "\n" .
 '$pdf->SetY(70);' . "\n" .
 '$pdf->SetX(120);' . "\n" .
 '$pdf->MultiCell(65,6,"$lang_tva: $num_tva",1,C,1);' . "\n" .
 
 '$pdf->SetY(105);' . "\n" .
 '$pdf->SetX(12);' . "\n" .
 '$pdf->Cell(186,95,"",1,0,"C",1);' . "\n" .
 
 '$pdf->AddCol("quanti",16,"$lang_quanti","C");' . "\n" .
 '$pdf->AddCol("uni",15,"$lang_unite","C");' . "\n" .
 '$pdf->AddCol("article",70,"$lang_article","C");' . "\n" .
 '$pdf->AddCol("taux_tva",15,"$lang_t_tva","C");' . "\n" .
 '$pdf->AddCol("p_u_jour",35,"$lang_prix_htva","C");' . "\n" .
 '$pdf->AddCol("tot_art_htva",35,"$lanf_tot_arti","C");' . "\n" .
 '$prop=array("HeaderColor"=>array(255,150,100),' . "\n" .
 '"color1"=>array(255,255,210),' . "\n" .
 '"color2"=>array(255,238,204),' . "\n" .
 '"padding"=>2);' . "\n" .
 '$pdf->Table("SELECT " . $tblpref ."cont_bon.num, quanti, uni, article, taux_tva, prix_htva, p_u_jour, tot_art_htva FROM " . $tblpref ."cont_bon RIGHT JOIN " . $tblpref ."article on " . $tblpref ."cont_bon.article_num = " . $tblpref ."article.num WHERE  bon_num = $num_bon LIMIT $nb, 15",$prop);' . "\n" .

 '$pdf->SetFillColor(255,238,204);' . "\n" .
 '$pdf->SetFont("Arial","",8);' . "\n" .
 '$pdf->SetY(240);' . "\n" .
 '$pdf->SetX(25);' . "\n" .
 '$pdf->MultiCell(35,4,"$social\n $tel\n $tva_vend \n$compte \n$reg",0,C,0);' . "\n" .

 '$pdf->SetFont("Arial","B",10);' . "\n" .
 '$pdf->SetY(238);' . "\n" .
 '$pdf->SetX(110);' . "\n" .
 '$pdf->MultiCell(40,10,"$lang_po_rec",1,C,1);' . "\n" .
 
 '$pdf->SetFont("Arial","B",10);' . "\n" .
 '$pdf->SetY(238);' . "\n" .
 '$pdf->SetX(148);' . "\n" .
 '$pdf->MultiCell(40,10,"\n\n",1,C,1);' . "\n" .

 'if($num_pa2 >= $nb_pa)  {' . "\n" .

 '$pdf->SetFont("Arial","B",12);' . "\n" .
 '$pdf->SetY(200);' . "\n" .
 '$pdf->SetX(158);' . "\n" .
 '$pdf->MultiCell(40,4,"$total_htva $devise\n $total_tva $devise\n $tot_tva_inc $devise ",1,C,1);' . "\n" .
 
 '$pdf->SetFont("Arial","B",10);' . "\n" .
 '$pdf->SetY(200);' . "\n" .
 '$pdf->SetX(118);' . "\n" .
 '$pdf->MultiCell(40,4,"$lang_totaux",1,R,1);' . "\n" .
 '$pdf->Line(20,266,200,266);' . "\n" .
 
 '$pdf->SetFont("Arial","",10);' . "\n" .
 '$pdf->SetY(217);' . "\n" .
 '$pdf->SetX(10);' . "\n" .
 '$pdf->MultiCell(190,4,"$coment",0,C,0);' . "\n" .
 '   }' . "\n" .
 
 '$pdf->SetFont("Arial","B",10);' . "\n" .
 '$pdf->SetY(268);' . "\n" .
 '$pdf->SetX(30);' . "\n" .
 '$pdf->MultiCell(160,4,"$lang_condi",0,C,0);' . "\n" .
 
 '$pdf->SetFont("Arial","B",10);' . "\n" .
 '$pdf->SetY(260);' . "\n" .
 '$pdf->SetX(30);' . "\n" .
 '$pdf->MultiCell(160,4,"$lang_page $num_pa2 $lang_de $nb_pa\n",0,C,0);' . "\n" .
 '}' . "\n" .
 
 '$file=basename(tempnam(getcwd(),"tmp"));' . "\n" .
 'rename($file,$file.".pdf");' . "\n" .
 '$file.=".pdf";' . "\n" .
 
 '$pdf->Output($file);' . "\n" .
 'echo "<HTML><SCRIPT>document.location=' . "'". '$file'. "';". '</SCRIPT></HTML>";' . "\n" .
 '?> ' . "\n" ;
 
$ecrire= "$a";
fwrite($fichier,$ecrire );
fclose($fichier);

?> 