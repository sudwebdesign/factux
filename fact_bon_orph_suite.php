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
 * File Name: fact_bon_orph_suite.php
 * 	enregistrement de données de la facture a partir d'un bon orphelin
 * 
 * * * * Version:  5.0.1
 * * * * Modified: 10/06/2017
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
include_once("include/headers.php");
include_once("include/finhead.php");
$date_fact=isset($_POST['date_fact'])?$_POST['date_fact']:"";
$list_num=isset($_POST['bon_sup'])?$_POST['bon_sup']:"";
$acompte=isset($_POST['acompte'])?(integer)$_POST['acompte']:"";
$coment=isset($_POST['coment'])?apostrophe($_POST['coment']):"";
$num=isset($_POST['num'])?$_POST['num']:"";
$client=isset($_POST['client'])?$_POST['client']:"";

if($client=='' || $list_num==''|| $num=='' || $date_fact=='' ){#if reload page (f5) && $fact=='ok'
 $message= "<h1>$lang_oubli_champ</h1>";
 include('form_facture.php');
 exit;
}
list($jour_fact, $mois_fact,$annee_fact) = preg_split('/\//', $date_fact, 3);
$date_fact ="$annee_fact-$mois_fact-$jour_fact";

$sql = "
SELECT * FROM " . $tblpref ."bon_comm 
WHERE client_num = '".$client."' 
AND " . $tblpref ."bon_comm.num_bon = '".$num."' 
AND fact != '0'";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_array($req)){
 $fact = $data['fact'];
}
if(isset($fact)&&$fact!='0'){#if reload page (f5) && $fact=='ok'
 $message= "<h1>$lang_err_fact</h1>";
 include('form_facture.php');
 exit;
}

$sql = " SELECT civ, nom, nom2 From " . $tblpref ."client WHERE num_client = $client ";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_array($req)){
 $civ = $data['civ'];
 $nom = $data['nom'];
 $nom2 = $data['nom2'];
}

if($list_num !=''){
 $nb_bon=count($list_num);
 $list_num[$nb_bon]=$num;
}else{
 $list_num=array(0=>$num);
}

$suite_sql="and " . $tblpref ."bon_comm.num_bon ='$list_num[0]'";
for($m=1; $m<count($list_num); $m++){
 $suite_sql .= " or " . $tblpref ."bon_comm.num_bon ='$list_num[$m]'";
}
$sql9 = "SELECT date, quanti, article, remise, prix_htva, p_u_jour, tot_art_htva, to_tva_art, taux_tva, uni, num_bon 
FROM " . $tblpref ."client 
LEFT JOIN " . $tblpref ."bon_comm on " . $tblpref ."client.num_client = " . $tblpref ."bon_comm.client_num 
LEFT JOIN " . $tblpref ."cont_bon on " . $tblpref ."bon_comm.num_bon = " . $tblpref ."cont_bon.bon_num  
LEFT JOIN  " . $tblpref ."article on " . $tblpref ."article.num = " . $tblpref ."cont_bon.article_num 
WHERE " . $tblpref ."client.num_client = '".$client."'"; 
$sql9="$sql9 $suite_sql";
$req = mysql_query($sql9) or die('Erreur SQL9 !<br>'.$sql9.'<br>'.mysql_error());

/*//OLD
$sql = " SELECT SUM(tot_htva), SUM(tot_tva) 
		FROM " . $tblpref ."bon_comm 
		 WHERE " . $tblpref ."bon_comm.client_num = '".$client."'*/ 

//NEW Version CALUL TVA A LA FIN
$sql = "SELECT SUM(tot_art_htva), SUM(to_tva_art) 
FROM " . $tblpref ."client 
LEFT JOIN " . $tblpref ."bon_comm on " . $tblpref ."client.num_client = " . $tblpref ."bon_comm.client_num 
LEFT JOIN " . $tblpref ."cont_bon on " . $tblpref ."bon_comm.num_bon = " . $tblpref ."cont_bon.bon_num  
LEFT JOIN  " . $tblpref ."article on " . $tblpref ."article.num = " . $tblpref ."cont_bon.article_num 
WHERE " . $tblpref ."client.num_client = '".$client."'"; 

$sql="$sql $suite_sql GROUP BY bon_num";
$req2 = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req2);
$total_htva = $data['SUM(tot_art_htva)'];
$total_tva = $data['SUM(to_tva_art)'];
$total_ttc = $total_htva + $total_tva ;

if($total_htva==''){
 $message = "<h1>$lang_err_fact_2 $nom</h1>";
 include('form_facture.php');
 exit;
}
if (!isset($_POST['simuler'])){	
 $list_num=serialize($list_num);//
 $sql1 = "
 INSERT INTO " . $tblpref ."facture(acompte, coment, client, date_fact, total_fact_h, total_fact_ttc, list_num)
 VALUES ('$acompte', '$coment', '$client', '$date_fact', '$total_htva', '$total_ttc', '$list_num')
 ";/**/
 mysql_query($sql1) or die('Erreur SQL1 !<br>'.$sql1.'<br>'.mysql_error());
 $num_fact = mysql_insert_id();//le numero de la facture créée

 $sql2 = "UPDATE " . $tblpref ."bon_comm SET fact='$num_fact' WHERE " . $tblpref ."bon_comm.client_num = '".$client."'";
 $sql2 .= " $suite_sql";
 mysql_query($sql2) or die('Erreur SQL2 !<br>'.$sql2.'<br>'.mysql_error());
}else
 $num_fact = $lang_simu;
?>
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php include_once("include/head.php"); ?>
   <h2><?php echo "$lang_fact_enr $nom $nom2"; ?></h2>
   <table class="page boiteaction">
    <caption><?php echo "$lang_facture $num_fact $lang_créée_pour $civ $nom";?></caption>
    <tr>
     <th><?php echo $lang_quanti; ?></th>
     <th><?php echo $lang_unite; ?></th>
     <th><?php echo $lang_article; ?></th>
     <th><?php echo $lang_prix_h_tva; ?></th>
     <th><?php echo $lang_remise; ?></th>
     <th><?php echo $lang_taux_tva; ?></th>
     <th><?php echo $lang_tot_tva; ?></th>
     <th><?php echo $lang_num_bon; ?></th>
     <th><?php echo $lang_date_bon; ?></th>
    </tr>
<?php
$total_marge_htva = 0;
$total_remise_htva = 0;
while($data = mysql_fetch_array($req)){
 $quanti = $data['quanti'];
 $article = $data['article'];
 $tot_htva = $data['tot_art_htva'];
 $tot_tva = $data['to_tva_art'];
 $taux = $data['taux_tva'];
 $uni = $data['uni'];
 $num_bon = $data['num_bon'];
 $date = $data['date'];
 $remise = $data['remise'];
//+ calcul du montant de la remise #2015
 $prx_ht = $data['prix_htva'];#non margé
 $tx_remise = (1-($data['remise']/100));#taux remise

 $remise_art_htva = ( $data['p_u_jour'] * $quanti ) - $tot_htva;
 $marge_art_htva = $tot_htva - (( $prx_ht * $quanti ) * $tx_remise);

 $total_remise_htva += $remise_art_htva;
 $total_marge_htva += $marge_art_htva;
?>
    <tr>
     <td class='<?php echo couleur_alternee (TRUE,"nombre"); ?>'><?php echo $quanti; ?></td>
     <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo $uni; ?></td>
     <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo $article; ?></td>
     <td class='<?php echo couleur_alternee (FALSE,"nombre"); ?>'><?php echo montant_financier($tot_htva); ?></td>
     <td class='<?php echo couleur_alternee (FALSE,"nombre"); ?>'><?php echo montant_taux($remise); ?></td>
     <td class='<?php echo couleur_alternee (FALSE,"nombre"); ?>'><?php echo montant_taux($taux); ?></td>
     <td class='<?php echo couleur_alternee (FALSE,"nombre"); ?>'><?php echo montant_financier($tot_tva); ?></td>
     <td class='<?php echo couleur_alternee (FALSE,"nombre"); ?>'><?php echo $num_bon; ?></td>
     <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'><?php echo $date; ?></td>
    </tr>
<?php } 
$rest = $total_htva + $total_tva - $acompte;
?>
    <tr>
     <td colspan='9'><hr /></td>
    </tr>
    <tr>
     <td colspan='7'>&nbsp;</td>
     <td class='texte1'><?php echo "$lang_total $lang_remise"; ?></td>
     <td class='nombre1'><?php echo montant_financier($total_remise_htva); ?></td>
    </tr>
    <tr>
     <td colspan='7'>&nbsp;</td>
     <td class='texte1'><?php echo "$lang_total $lang_marge"; ?></td>
     <td class='nombre1'><?php echo montant_financier($total_marge_htva); ?></td>
    </tr>
    <tr>
     <td colspan='7'>&nbsp;</td>
     <td class='texte1'><b><?php echo $lang_total_htva; ?></b></td>
     <td class='nombre1'><b><?php echo montant_financier($total_htva); ?></b></td>
    </tr>
    <tr>
     <td colspan='7'>&nbsp;</td>
     <td class='texte1'><b><?php echo $lang_tot_tva; ?></b></td>
     <td class='nombre1'><b><?php echo montant_financier($total_tva); ?></b></td>
    </tr>
    <tr>
     <td colspan='7'>&nbsp;</td>
     <td class='totaltexte'><b><?php echo $lang_tot_ttc; ?></b></td>
     <td class='totalmontant'><b><?php echo montant_financier($total_ttc); ?></b></td>
    </tr>
    <tr>
     <td colspan='7'>&nbsp;</td>
     <td class='texte0'><?php echo $lang_acompte; ?></td>
     <td class='nombre0'><?php echo montant_financier($acompte); ?></td>
    </tr>
    <tr>
     <td colspan='7'>&nbsp;</td>
     <td class='texte0'><?php echo $lang_rest_pay; ?></td>
     <td class='nombre0'><?php echo montant_financier($rest); ?></td>
    </tr>
    <tr>
     <td colspan='7'>&nbsp;</td>
     <td colspan='2' class='nombre0'>
<?php if (!isset($_POST['simuler'])){ ?>
      <form action="fpdf/fact_pdf.php" method="post" target="_blank" >
       <input type="hidden" name="client" value="<?php echo $client ?>" />
       <input type="hidden" name="num" value="<?php echo $num_fact ?>" />
       <input type="hidden" name="user" value="adm" />
       <input type="image" src="image/prinfer.gif" alt="<?php echo $lang_imprimer; ?>" />
      </form>
<?php } else echo $lang_simu; ?>
     </td>
    </tr>
   </table>
  </td>
 </tr>
 <tr>
  <td>
<?php
include('form_facture.php');
