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
 * File Name: fact.php
 * 	enregistrement de données de la facture
 *
 * * * Version:  5.0.1
 * * * * Modified: 10/06/2017
 *
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
include_once(__DIR__ . "/include/headers.php");
include_once(__DIR__ . "/include/finhead.php");
?>
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php
include_once(__DIR__ . "/include/head.php");
if ($user_fact == 'n') {
 echo sprintf('<h1>%s</h1>', $lang_facture_droit);
 include_once(__DIR__ . "/include/bas.php");
 exit;
}
$acompte=floatval(isset($_POST['acompte'])?$_POST['acompte']:"");
$date_deb=isset($_POST['date_deb'])?$_POST['date_deb']:"";
$date_fin=isset($_POST['date_fin'])?$_POST['date_fin']:"";
$date_fact=isset($_POST['date_fact'])?$_POST['date_fact']:"";
$client=isset($_POST['listeclients'])?$_POST['listeclients']:"";
$coment=isset($_POST['coment'])?$_POST['coment']:"";
if($client=='' || $date_deb==''|| $date_fin=='' || $date_fact=='' ){
 $message= sprintf('<h1>%s</h1>', $lang_oubli_champ);
 include(__DIR__ . '/form_facture.php');
 exit;
}
list($jour_deb, $mois_deb,$annee_deb) = preg_split('/\//', $date_deb, 3);
list($jour_f, $mois_f,$annee_f) = preg_split('/\//', $date_fin, 3);
list($jour_fact, $mois_fact,$annee_fact) = preg_split('/\//', $date_fact, 3);
$debut = sprintf('%s-%s-%s', $annee_deb, $mois_deb, $jour_deb) ;
$fin = sprintf('%s-%s-%s', $annee_f, $mois_f, $jour_f) ;
$date_fact =sprintf('%s-%s-%s', $annee_fact, $mois_fact, $jour_fact);

$sql = " SELECT civ, nom, nom2 From " . $tblpref .sprintf('client WHERE num_client = %s ', $client);
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_array($req)){
 $civ = $data['civ'];
 $nom = $data['nom'];
 $nom2 = $data['nom2'];
}

$sql = "
SELECT * FROM " . $tblpref ."bon_comm
WHERE client_num = '".$client."'
AND " . $tblpref ."bon_comm.date >= '".$debut."'
AND " . $tblpref ."bon_comm.date <= '".$fin."'
AND fact != '0'";#AND fact = 'ok'

$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_array($req)){
 $fact = $data['fact'];
}

if(isset($fact)&&$fact!='0'){#$fact=='ok'
 $message= sprintf('<h1>%s</h1>', $lang_err_fact);
 include(__DIR__ . '/form_facture.php');
 exit;
}
$sql = "
SELECT SUM(tot_htva), SUM(tot_tva)
FROM " . $tblpref ."bon_comm
WHERE " . $tblpref ."bon_comm.client_num = '".$client."'
AND " . $tblpref ."bon_comm.date >= '".$debut."'
AND " . $tblpref ."bon_comm.date <= '".$fin."'
";

$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
$total_htva = $data['SUM(tot_htva)'];
$total_tva = $data['SUM(tot_tva)'];
$total_ttc = $total_htva + $total_tva ;
#var_dump($total_htva);exit;
if($total_htva==''){
 $message= sprintf('<h1>%s %s</h1>', $lang_err_fact_2, $nom);
 include(__DIR__ . '/form_facture.php');
 exit;
}

//nouvelle methode
$sql = "
SELECT num_bon
FROM " . $tblpref ."bon_comm
WHERE " . $tblpref ."bon_comm.client_num = '".$client."'
AND " . $tblpref ."bon_comm.date >= '".$debut."'
AND " . $tblpref ."bon_comm.date <= '".$fin."'
";

$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_array($req)){
 $list_num[] = $data['num_bon'];
}

$suite_sql="and " . $tblpref .sprintf("bon_comm.num_bon ='%s'", $list_num[0]);
$counter = count($list_num);
for($m=1; $m<$counter; $m++){
 $suite_sql .= " or " . $tblpref .sprintf("bon_comm.num_bon ='%s'", $list_num[$m]);
}

//On afiche le resultat
$sql9 = "
SELECT date, quanti, article, remise, p_u_jour, marge_jour, tot_art_htva, to_tva_art, taux_tva, uni, num_bon
FROM " . $tblpref ."client
LEFT JOIN " . $tblpref ."bon_comm on " . $tblpref ."client.num_client = " . $tblpref ."bon_comm.client_num
LEFT join " . $tblpref ."cont_bon on " . $tblpref ."bon_comm.num_bon = " . $tblpref ."cont_bon.bon_num
LEFT JOIN  " . $tblpref ."article on " . $tblpref ."article.num = " . $tblpref ."cont_bon.article_num
WHERE " . $tblpref ."client.num_client = '".$client."'
";
$sql9=sprintf('%s %s', $sql9, $suite_sql);
$req = mysql_query($sql9) or die('Erreur SQL9 !<br>'.$sql9.'<br>'.mysql_error());

if (!isset($_POST['simuler'])){
 //on enregistre le contenu de la facture
 $list_num = serialize($list_num);
 $sql1 = "
 INSERT INTO " . $tblpref ."facture(acompte, coment, client, date_fact, total_fact_h, total_fact_ttc, list_num)
 VALUES ('{$acompte}', '{$coment}', '{$client}', '{$date_fact}', '{$total_htva}', '{$total_ttc}', '{$list_num}')
 ";/**/
 mysql_query($sql1) || die('Erreur SQL1 !<br>'.$sql1.'<br>'.mysql_error());
 $num_fact = mysql_insert_id();//le numero de la facture créée

 $sql2 = "
 UPDATE " . $tblpref ."bon_comm
 SET fact = '{$num_fact}'
 WHERE " . $tblpref ."bon_comm.client_num = '".$client."'
 AND " . $tblpref ."bon_comm.date >= '".$debut."'
 AND " . $tblpref ."bon_comm.date <= '".$fin."'
 ";
 mysql_query($sql2) || die('Erreur SQL2 !<br>'.$sql2.'<br>'.mysql_error());
}else {
    $num_fact = $lang_simu;
}
 echo (isset($_POST['simuler']))?sprintf('<h1>%s</h1>', $lang_simu):'';?>
   <h2><?php echo sprintf('%s %s %s', $lang_fact_enr, $nom, $nom2); ?></h2>
   <table class="page boiteaction">
    <caption><?php echo sprintf('%s %s %s %s %s', $lang_facture, $num_fact, $lang_créée_pour, $civ, $nom); ?></caption>
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
 $tot_htva = $data['tot_art_htva'];#remisé & margé
 $tot_tva = $data['to_tva_art'];
 $taux = $data['taux_tva'];
 $uni = $data['uni'];
 $num_fact_bon = $data['num_bon'];
 $date = $data['date'];
 $remise = $data['remise'];
//+ calcul du montant de la remise #2015
 $prx_ht = ($data['p_u_jour']/$data['marge_jour']);#non margé
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
     <td class='<?php echo couleur_alternee (FALSE,"nombre"); ?>'><?php echo $num_fact_bon; ?></td>
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
     <td class='texte1'><?php echo sprintf('%s %s', $lang_total, $lang_remise); ?></td>
     <td class='nombre1'><?php echo montant_financier($total_remise_htva); ?></td>
    </tr>
    <tr>
     <td colspan='7'>&nbsp;</td>
     <td class='texte1'><?php echo sprintf('%s %s', $lang_total, $lang_marge); ?></td>
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
      <form action="fpdf/fact_pdf.php" method="post" target="_blank">
       <input type="hidden" name="client" value="<?php echo $client ?>" />
       <input type="hidden" name="debut" value="<?php echo $debut ?>" />
       <input type="hidden" name="fin" value="<?php echo $fin ?>" />
       <input type="hidden" name="num" value="<?php echo $num_fact ?>" />
       <input type="hidden" name="user" value="adm" />
       <input type="image" src="image/prinfer.gif" alt="<?php echo $lang_imprimer; ?>" />
      </form>
<?php } else {
    echo $lang_simu;
} ?>
     </td>
    </tr>
   </table>
  </td>
 </tr>
 <tr>
  <td>
<?php
include(__DIR__ . '/form_facture.php');
