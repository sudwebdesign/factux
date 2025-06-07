<?php
/*
 * Factux le facturier libre
 * Copyright (C) 2003-2005 Guy Hendrickx, 2017~ Thomas Ingles
 *
 * Licensed under the terms of the GNU  General Public License:
 * 		http://opensource.org/licenses/GPL-3.0
 *
 * For further information visit:
 * 		http://factux.free.fr
 *
 * File Name: fact_multi.php
 * 	enregistrement de données de la facture
 *
 * * * * Version:  8.0.0
 * * * * Modified: 07/06/2025
 *
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
include_once(__DIR__ . "/include/headers.php");
$acompte=isset($_POST['acompte'])?$_POST['acompte']:"";
$date_deb=isset($_POST['date_deb'])?$_POST['date_deb']:"";
$date_fin=isset($_POST['date_fin'])?$_POST['date_fin']:"";
$date_fact=isset($_POST['date_fact'])?$_POST['date_fact']:"";
$coment=isset($_POST['coment'])?$_POST['coment']:"";
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
if($date_deb==''|| $date_fin=='' || $date_fact=='' || !isset($_POST['client']) ){
 $message= sprintf('<h1>%s</h1>', $lang_oubli_champ);
 include(__DIR__ . '/form_multi_facture.php');
 exit;
}
$message='';
list($jour_deb, $mois_deb,$annee_deb) = preg_split('/\//', $date_deb, 3);
list($jour_f, $mois_f,$annee_f) = preg_split('/\//', $date_fin, 3);
list($jour_fact, $mois_fact,$annee_fact) = preg_split('/\//', $date_fact, 3);
$debut = sprintf('%s-%s-%s', $annee_deb, $mois_deb, $jour_deb) ;
$fin = sprintf('%s-%s-%s', $annee_f, $mois_f, $jour_f) ;
$date_fact =sprintf('%s-%s-%s', $annee_fact, $mois_fact, $jour_fact);
foreach($_POST['client'] as $client){
 $sql = " SELECT * From " . $tblpref .sprintf('client WHERE num_client = %s ', $client);
 $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());

 while($data = mysql_fetch_array($req)){
  $nom = $data['nom'];
  $nom2 = $data['nom2'];
 }

 $sql = "
 SELECT * FROM " . $tblpref ."bon_comm
 WHERE client_num = '".$client."'
 AND " . $tblpref ."bon_comm.date >= '".$debut."'
 AND " . $tblpref ."bon_comm.date <= '".$fin."'
 AND fact > 0";# = 'ok'

 $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
 $p=0;
 while($data = mysql_fetch_array($req)){
  $fact = $data['fact'];
  $p++;
 }
 $guy=count($data);
 if($p !='0'){
  $message .= sprintf('<h1>%s %s</h1>', $lang_err_fact, $nom);
  $error = '1';
 }else{
  $error = '0';
 }

 $sql = "
 SELECT SUM(tot_htva), SUM(tot_tva)
 FROM " . $tblpref ."bon_comm
 WHERE " . $tblpref ."bon_comm.client_num = '".$client."'
 AND " . $tblpref ."bon_comm.date >= '".$debut."'
 AND " . $tblpref ."bon_comm.date <= '".$fin."'";

 $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
 $data = mysql_fetch_array($req);
 $total_htva = $data['SUM(tot_htva)'];
 $total_tva = $data['SUM(tot_tva)'];
 $total_ttc = $total_htva + $total_tva ;
 if($total_htva==''){
  $message .= sprintf('<h1>%s %s</h1>', $lang_err_fact_2, $nom);
  $error2 = '1';
 }else{
  $error2 = '0';
 }

 if($error != '1' && $error2 != '1'){
  //nouvelle methode
  $sql = "
  SELECT num_bon
  FROM " . $tblpref ."bon_comm
  WHERE " . $tblpref ."bon_comm.client_num = '".$client."'
  AND " . $tblpref ."bon_comm.date >= '".$debut."'
  AND " . $tblpref ."bon_comm.date <= '".$fin."'";
  $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
  unset($list_num);
  while($data = mysql_fetch_array($req)){
   $list_num[] = $data['num_bon'];
  }
  $list_num = serialize($list_num);
  //on enregistre le contenu de la facture
  $sql1 = "INSERT INTO " . $tblpref ."facture(acompte, coment, client, date_deb, date_fin, date_fact, total_fact_h, total_fact_ttc, list_num)
  VALUES ('{$acompte}', '{$coment}', '{$client}', '{$debut}', '{$fin}', '{$date_fact}', '{$total_htva}', '{$total_ttc}', '{$list_num}')";
  mysql_query($sql1) || die('Erreur SQL1 !<br>'.$sql1.'<br>'.mysql_error());
  $num_fact = mysql_insert_id();//le numero de la facture créée

  $sql2 = "UPDATE " . $tblpref .sprintf("bon_comm SET fact='%s' WHERE ", $num_fact) . $tblpref ."bon_comm.client_num = '".$client."' AND " . $tblpref ."bon_comm.date >= '".$debut."' and " . $tblpref ."bon_comm.date <= '".$fin."'";
  mysql_query($sql2) || die('Erreur SQL2 !<br>'.$sql2.'<br>'.mysql_error());

  $message .= "
     <h2>{$lang_fact_enr} {$nom} {$nom2}
      <form action='fpdf/fact_pdf.php' method='post' target='_blank' class='img'>
       <input type='hidden' name='client' value='{$client}' />
       <input type='hidden' name='num' value='{$num_fact}' />
       <input type='hidden' name='user' value='adm' />
       <input type='image' src='image/prinfer.gif' alt='{$lang_imprimer} {$lang_fact_num_ab} {$num_fact}' />
      </form>
     </h2>\n";
 }
}
echo $message;
include_once(__DIR__ . "/include/bas.php");
?>
  </td>
 </tr>
</table>
</body>
</html>
