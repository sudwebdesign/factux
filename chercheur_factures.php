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
 * File Name: chercheur_factures.php
 * 	resultat de la recherche des factures
 *
 * * * Version:  5.0.0
 * * * * Modified: 07/10/2016
 *
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
include_once(__DIR__ . "/include/headers.php");
include_once(__DIR__ . "/include/finhead.php");
$tri=isset($_POST['tri'])?$_POST['tri']:"";
$requete = "SELECT *, TO_DAYS(NOW()) - TO_DAYS(date_fact) AS peri FROM " . $tblpref ."facture
LEFT JOIN " . $tblpref ."client on " . $tblpref ."facture.client = num_client
WHERE num >0";
//on verifie le client
if (isset($_POST['listeclients']) && $_POST['listeclients']!='') {
 $requete .= " AND client='" . $_POST['listeclients'] . "'";
}

//on verifie le numero
if ( isset ( $_POST['numero'] ) && $_POST['numero'] != ''){
 $requete .= " AND num='" . $_POST['numero'] . "'";
}
//on verifie le mois
if ( isset ( $_POST['mois'] ) && $_POST['mois'] != ''){
 $requete .= " AND MONTH(date_fact)='" . $_POST['mois'] . "'";
}
//on verifie l'année
if ( isset ( $_POST['annee'] ) && $_POST['annee'] != ''){
 $requete .= " AND Year(date_fact)='" . $_POST['annee'] . "'";
}
//on verifie le jour
if ( isset ( $_POST['jour'] ) && $_POST['jour'] != ''){
 $requete .= " AND DAYOFMONTH(date_fact)='" . $_POST['jour'] . "'";
}
//on verifie le montant
if ( isset ( $_POST['montant'] ) && $_POST['montant'] != ''){
 $requete .= " AND trim(total_fact_ttc) =" . $_POST['montant'] . "";
}
//
if ($use_payement =='y') {
 if ( isset ( $_POST['payement'] ) && $_POST['payement'] != ''){
  $requete .= " AND payement ='" . $_POST['payement'] . "'";
 }
} elseif (isset ( $_POST['payement'] ) && $_POST['payement'] != '') {
 if($_POST['payement'] =='non'){
  $requete .= " AND payement ='non'";
 }else{
  $requete .= " AND payement !='non'";
 }
}
if ($user_fact == 'r'){
$requete .="
and " . $tblpref ."client.permi LIKE '{$user_num},'
or  " . $tblpref ."client.permi LIKE '%,{$user_num},'
or  " . $tblpref ."client.permi LIKE '%,{$user_num},%'
or  " . $tblpref .sprintf("client.permi LIKE '%s,%%' ", $user_num);
}
// Tri
$requete .= ' ORDER BY ' . $tri;
?>
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php include_once(__DIR__ . "/include/head.php"); ?>
   <center>
    <table class='page boiteaction'>
     <caption><?php echo $lang_res_rech; ?></caption>
     <tr>
      <th><?php echo $lang_numero; ?></th>
      <th><?php echo $lang_client; ?></th>
      <th><?php echo $lang_date; ?></th>
      <th><?php echo $lang_total_h_tva; ?></th>
      <th><?php echo $lang_tot_ttc; ?></th>
      <th><?php echo $lang_pay; ?></th>
      <th colspan="2"><?php echo $lang_action; ?></th>
     </tr>
<?php
//on execute
$req = mysql_query($requete) or die('Erreur SQL !<br>'.$requete.'<br>'.mysql_error());
$c=0;
while($data = mysql_fetch_array($req)){
 $num = $data['num'];
 $total = $data['total_fact_h'];
 $tva = $data['total_fact_ttc'];
 $date = $data['date_fact'];
 $nom = $data['nom'];
 $debut = $data['date_deb'];
 $fin = $data['date_fin'];
 $client = $data['client'];
 $num_client = $data['num_client'];
 $peri = $data['peri'];
 $pay = $data['payement'];
 switch ($pay) {
  case "carte":
   $pay=$lang_carte_ban;
  break;
  case "Especes":
   $pay=$lang_liquide;
  break;
  case "ok":
   $pay=$lang_pay_ok;
  break;
  case "Cheque":
   $pay=$lang_paypal;
  break;
  case "virement":
   $pay=$lang_virement;
  break;
  case "visa":
   $pay=$lang_visa;
  break;
  case "non":
   $pay=sprintf("<a href='lister_factures_non_reglees.php?num=%s' alt='%s'", $num, $lang_regler).(($peri>=$echeance_fact)?' style="color:red;"':'').sprintf('>%s</a>', $lang_non_pay);
  break;
 }
 $line=($c++ & 1)?0:1;
?>
     <tr class="texte<?php echo $line; ?>" onmouseover="this.className='highlight'" onmouseout="this.className='texte<?php echo $line; ?>'">
      <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo $num; ?></td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo $nom; ?></td>
      <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'><?php echo $date ;?></td>
      <td class='<?php echo couleur_alternee (FALSE,"nombre"); ?>'><?php echo montant_financier($total); ?></td>
      <td class='<?php echo couleur_alternee (FALSE,"nombre"); ?>'><?php echo montant_financier($tva); ?></td>
      <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'><?php echo $pay;?></td>
      <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'>
       <form action="fpdf/fact_pdf.php" method="post" target="_blank">
        <input type="hidden" name="client" value="<?php echo $num_client; ?>" />
        <input type="hidden" name="debut" value="<?php echo $debut; ?>" />
        <input type="hidden" name="fin" value="<?php echo $fin; ?>" />
        <input type="hidden" name="num" value="<?php echo $num; ?>" />
        <input type="hidden" name="user" value="adm" />
        <input type="image" src="image/printer.gif" style=" border: none; margin: 0;" alt="<?php echo $lang_imprimer; ?>" />
       </form>
      </td>
      <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'>
       <a href="edit_fact.php?num_fact=<?php echo $num;?>">
        <img src="image/fact.gif" border="0" alt="<?php echo $lang_editer; ?>" />
       </a>
      </td>
     </tr>
<?php } ?>
     <tr><td colspan="10" class="td2"></td></tr>
    </table>
   </center>
<?php include(__DIR__ . "/chercher_factures.php"); ?>
  </td>
 </tr>
</table>
</body>
</html>
