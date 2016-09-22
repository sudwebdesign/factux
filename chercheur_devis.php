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
 * File Name: fckconfig.js
 *   Editor configuration settings.
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

$requete = "SELECT DATE_FORMAT(date,'%d/%m/%Y')as date, num_dev, tot_htva, tot_tva, resu, nom 
FROM " . $tblpref ."devis 
LEFT JOIN " . $tblpref ."client on " . $tblpref ."devis.client_num = num_client 
WHERE num_dev > 0";

if ( isset ( $_POST['listeclients'] ) && $_POST['listeclients'] != '')//on verifie le client
  $requete .= " AND num_client='" . $_POST['listeclients'] . "'";
if ( isset ( $_POST['numero'] ) && $_POST['numero'] != '')//on verifie le numero
  $requete .= " AND num_dev='" . $_POST['numero'] . "'";
if ( isset ( $_POST['mois'] ) && $_POST['mois'] != '')//on verifie le mois
  $requete .= " AND MONTH(date)='" . $_POST['mois'] . "'";
if ( isset ( $_POST['annee'] ) && $_POST['annee'] != '')//on verifie l'année
  $requete .= " AND Year(date)='" . $_POST['annee'] . "'";
if ( isset ( $_POST['jour'] ) && $_POST['jour'] != '')//on verifie le jour
  $requete .= " AND DAYOFMONTH(date)='" . $_POST['jour'] . "'";
if ( isset ( $_POST['montant'] ) && $_POST['montant'] != '')//on verifie le montant
  $requete .= " AND trim(" . $tblpref ."devis.tot_htva)='" . $_POST['montant'] . "'";
if ($user_dev == 'r'){
  $requete .=" AND " . $tblpref ."client.permi LIKE '$user_num,' 
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
  <caption><?php echo $lang_res_rech; ?></caption>
   <tr>
    <th><?php echo $lang_numero; ?></th>
    <th><?php echo $lang_client; ?></th>
    <th><?php echo $lang_dev_date; ?></th>
    <th><?php echo $lang_total_h_tva; ?></th>
    <th><?php echo $lang_total_ttc; ?></th>
    <th colspan='3'><?php echo $lang_action; ?></th>
    <th colspan='2'><?php echo $lang_ga_per; ?></th>
   </tr>
<?php
//on execute
$req = mysql_query($requete) or die('Erreur SQL !<br>'.$requete.'<br>'.mysql_error());
$c=0;
while($data = mysql_fetch_array($req)){
 $num_dev = $data['num_dev'];
 $total = $data['tot_htva'];
 $tva = $data['tot_tva'];
 $date = $data['date'];
 $nom = $data['nom'];
 $resu = $data['resu'];
 $line=($c++ & 1)?0:1;
?>
   <tr class="texte<?php echo $line; ?>" onmouseover="this.className='highlight'" onmouseout="this.className='texte<?php echo $line; ?>'">
    <td class='<?php echo couleur_alternee (); ?>'><?php echo $num_dev; ?></td>
    <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo $nom; ?></td>
    <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'><?php echo $date; ?></td>
    <td class='<?php echo couleur_alternee (FALSE,"nombre"); ?>'><?php echo montant_financier($total); ?></td>
    <td class='<?php echo couleur_alternee (FALSE,"nombre"); ?>'><?php echo montant_financier($tva); ?></td>
<?php if ($resu =='0'){ ?>
    <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'>
     <a href="edit_devis.php?num_dev=<?php echo $num_dev; ?>&amp;nom=<?php echo $nom; ?>">
      <img border="0" alt="editer" src="image/edit.gif">
     </a>
    </td>
<?php } else { ?>
    <td class='<?php echo couleur_alternee (FALSE); ?>'>&nbsp;</td>
<?php } ?>
    <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'>
     <a href="delete_dev.php?num_dev=<?php echo $num_dev; ?>&amp;nom=<?php echo $nom; ?>" 
        onClick="return confirmDelete('<?php echo"$lang_eff_dev $num_dev ?"; ?>')">
      <img border="0" src="image/delete.jpg">
     </a>
    </td>
    <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'>
     <form action="fpdf/devis_pdf.php" method="post" target="_blank">
      <input type="hidden" name="num_dev" value="<?php echo $num_dev; ?>" />
      <input type="hidden" name="nom" value="<?php echo $nom; ?>" />
      <input type="hidden" name="user" value="adm" />
      <input type="image" src="image/printer.gif" style="border:none;margin:0;" alt="<?php echo $lang_imprimer; ?>" />
     </form>
    </td>
<?php if ($resu =='0'){ ?>
    <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'>
      <a href="convert.php?num_dev=<?php echo $num_dev; ?>" title="<?php echo $lang_convertir; ?>"
         onClick="return confirmDelete('<?php echo"$lang_convert_dev $num_dev $lang_convert_dev2 "; ?>')">
       <img border="0" src= 'image/icon_lol.gif'>
      </a>
    </td>
    <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'>
     <a href="devis_non_commandes.php?num_dev=<?php echo $num_dev; ?>" title="<?php echo $lang_perdu; ?>" 
        onClick="return confirmDelete('<?php echo"$lang_dev_perd $num_dev $lang_dev_perd2 "; ?>')">
      <img border="0" src="image/icon_cry.gif">
     </a>
    </td>
<?php } if ($resu >'0'){ ?>
    <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'><?php echo $lang_ga;?></td>
    <td class='<?php echo couleur_alternee (FALSE); ?>'>&nbsp;</td>
<?php } if ($resu == '-1') {?>
    <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'>&nbsp;</td>
    <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo $lang_perdu;?></td>
<?php } ?>
  </tr>
<?php } ?>
  <tr><td colspan="10" class="td2"></td></tr>
 </table>
</center>
<?php
include_once("chercher_devis.php");
?>
  </td>
 </tr>
</table>
</body>
</html>
