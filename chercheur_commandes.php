<?php 
/*
 * Factux le facturier libre
 * Copyright (C) 2003-2004 Guy Hendrickx
 * 
 * Licensed under the terms of the GNU  General Public License:
 *     http://www.opensource.org/licenses/gpl-license.php
 * 
 * For further information visit:
 *     http://factux.sourceforge.net
 * 
 * File Name: chercheur_commandes.php
 *   reponse du formulaire de recherche de bons.
 * 
 * * * Version:  1.1.5
 * * * * Modified: 23/07/2005
 * 
 * File Authors:
 *     Guy Hendrickx
 *.
 */
include_once("include/headers.php");
?><script type="text/javascript" src="javascripts/confdel.js"></script><?php
include_once("include/finhead.php");
$requete = "
SELECT DATE_FORMAT(date,'%d/%m/%Y')as date, tot_htva, tot_tva, num_bon, nom, fact, mail, login, num_client
FROM " . $tblpref ."bon_comm 
LEFT JOIN " . $tblpref ."client on " . $tblpref ."bon_comm.client_num = num_client 
WHERE num_bon >0";

if ( isset ( $_POST['listeclients'] ) && $_POST['listeclients'] != '')//on verifie le client
  $requete .= " AND num_client='" . $_POST['listeclients'] . "'";
if ( isset ( $_POST['numero'] ) && $_POST['numero'] != '')//on verifie le numero
  $requete .= " AND num_bon='" . $_POST['numero'] . "'";
if ( isset ( $_POST['mois'] ) && $_POST['mois'] != '')//on verifie le mois
  $requete .= " AND MONTH(date)='" . $_POST['mois'] . "'";
if ( isset ( $_POST['annee'] ) && $_POST['annee'] != '')//on verifie l'année
  $requete .= " AND Year(date)='" . $_POST['annee'] . "'";
if ( isset ( $_POST['jour'] ) && $_POST['jour'] != '')//on verifie le jour
  $requete .= " AND DAYOFMONTH(date)='" . $_POST['jour'] . "'";
if ( isset ( $_POST['montant'] ) && $_POST['montant'] != '')//on verifie le montant
  $requete .= " AND trim(bon_comm.tot_htva)='" . $_POST['montant'] . "'";

if ($user_com == 'r'){
  $requete .="  AND " . $tblpref ."client.permi LIKE '$user_num,' 
  OR  " . $tblpref ."client.permi LIKE '%,$user_num,' 
  OR  " . $tblpref ."client.permi LIKE '%,$user_num,%' 
  OR  " . $tblpref ."client.permi LIKE '$user_num,%' ";
}
$tri=isset($_POST['tri'])?$_POST['tri']:"";
$requete .= " ORDER BY $tri";
?>
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php include_once("include/head.php"); ?>
<center>
 <table class='page boiteaction'>
  <caption><?php echo "$lang_res_rech"; ?></caption>
  <tr>
   <th><?php echo $lang_bon; ?> N&deg;</th>
   <th><?php echo $lang_client; ?></th>
   <th><?php echo $lang_date_bon; ?></th>
   <th><?php echo $lang_total_h_tva; ?></th>
   <th><?php echo $lang_tot_tva; ?></th>
   <th colspan='5'><?php echo $lang_action; ?></th>
  </tr>
<?php  
//on execute
$req = mysql_query($requete) or die('Erreur SQL !<br>'.$requete.'<br>'.mysql_error());
$c=0;
while($data = mysql_fetch_array($req)){
  $num_bon = $data['num_bon'];
  $total = $data['tot_htva'];
  $tva = $data['tot_tva'];
  $date = $data['date'];
  $nom = $data['nom'];
 $nom_html = htmlentities(urlencode ($nom));
 $num_client = $data['num_client'];
 $mail = $data['mail'];
 $login = $data['login'];
 $fact = $data['fact'];
 $line=($c++ & 1)?0:1;
?>
  <tr class="texte<?php echo $line; ?>" onmouseover="this.className='highlight'" onmouseout="this.className='texte<?php echo $line; ?>'">
   <td class='<?php echo couleur_alternee (); ?>'><?php echo $num_bon; ?></td>
   <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo $nom; ?></td>
   <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'><?php echo $date; ?></td>
   <td class='<?php echo couleur_alternee (FALSE,"nombre"); ?>'><?php echo montant_financier($total); ?></td>
   <td class='<?php echo couleur_alternee (FALSE,"nombre"); ?>'><?php echo montant_financier($tva); ?></td>
   <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'>
<?php if ($fact == "0") {?>
    <a href='edit_bon.php?num_bon=<?php echo "$num_bon"; ?>&amp;nom=<?php echo $nom_html; ?>'> 
     <img border="0" src="image/edit.gif" alt="<?php echo $lang_editer; ?>">
    </a>
<?php }else{ ?>
    <a href='edit_fact.php?num_fact=<?php echo $fact; ?>'>
     <img border="0" src="image/fact.gif" alt="<?php echo "$lang_editer $lang_facture $lang_numero $fact"; ?>">
    </a>
<?php } ?>
   </td>
   <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'>
<?php if ($fact == "0") {?>
    <a href='delete_bon.php?num_bon=<?php echo $num_bon; ?>&amp;nom=<?php echo $nom_html; ?>' 
       onClick="return confirmDelete('<?php echo $lang_con_effa.$num_bon; ?> ?')">
     <img border="0" src="image/delete.jpg" alt="<?php echo $lang_effacer; ?>">
    </a>
<?php }else{ ?>
     <!--<i alt="<?php echo $lang_err_efa_bon; ?>"><?php echo $fact; ?></i>-->
     <form action="fpdf/fact_pdf.php" method="post" target="_blank">
      <input type="hidden" name="client" value="<?php echo $num_client; ?>" />
      <input type="hidden" name="num" value="<?php echo $fact; ?>" />
      <input type="hidden" name="user" value="adm" />
      <input type="image" src="image/prinfer.gif" style="border:none;margin:0;" alt="<?php echo "$lang_imprimer $lang_facture $lang_numero $fact"; ?>" />
     </form>
<?php } ?>
   </td>
   <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'>
     <form action="fpdf/bon_pdf.php" method="post" target="_blank">
     <input type="hidden" name="num_bon" value="<?php echo "$num_bon"; ?>" />
     <input type="hidden" name="nom" value="<?php echo "$nom_html"; ?>" />
     <input type="hidden" name="user" value="adm" />
     <input type="image" src="image/printer.gif" alt="<?php echo $lang_imprimer; ?>" />
    </form>
   </td>
   <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'>
<?php if ($mail != '' and $login !='') { ?>
    <a href='notifi_cli.php?type=comm&amp;mail=<?php echo"$mail"; ?>' 
       onClick="return confirmDelete('<?php echo $lang_con_env_notif.$num_bon; ?> ?')">
     <img src='image/mail.gif' border='0' alt='mail'>
    </a>
<?php }else{ ?><img src='image/spacer.gif' width='15' height='15' border='0' alt='space'><?php } ?>
   </td>
   <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'>
<?php if ($mail != '' ) {?>
    <form action="fpdf/bon_pdf.php" method="post" 
          onClick="return confirmDelete('<?php echo $lang_con_env_pdf.$num_bon; ?> ?')">
     <input type="hidden" name="num_bon" value="<?php echo $num_bon; ?>" />
     <input type="hidden" name="nom" value="<?php echo $nom; ?>" />
     <input type="hidden" name="user" value="adm" />
     <input type="hidden" name="ext" value=".pdf" />
     <input type="hidden" name="mail" value="y" />
     <input type="image" src="image/pdf.gif" alt="mail" />
    </form>
<?php }else{ ?><img src='image/spacer.gif' width='15' height='15' border='0' alt='space'><?php } ?>
   </td>
  </tr>
<?php } ?>
  <tr><td colspan="10" class="td2"></td></tr>
 </table>
</center>
<?php
include("chercher_commandes.php");
?>
  </td>
 </tr>
</table>
</body>
</html>
