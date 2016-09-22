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
 * File Name: ca_paeclient_1mois.php
 * 	Donne les statistiques de chiffre d'affaire par mois
 * 
 * * * Version:  1.1.5
 * * * * Modified: 23/07/2005
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
require_once("include/verif.php");
include_once("include/config/common.php");
include_once("include/config/var.php");
include_once("include/language/$lang.php");
include_once("include/utils.php");
include_once("include/headers.php");
include_once("include/finhead.php");
?>
<table width="760" border="0" class="page" align="center">
<tr>
<td class="page" align="center">
<?php
include_once("include/head.php");
?>
</td>
</tr>
<tr>
<td  class="page" align="center">
<?php 
if ($user_stat== n) { 
echo"<h1>$lang_statistique_droit";
exit;  
}
 ?> 
<?php
$annee = date("Y");
$mois = date("m");
$mois_choisi=isset($_POST['mois_1'])?$_POST['mois_1']:$mois;
$annee_1=isset($_POST['annee_1'])?$_POST['annee_1']:$annee;

?>

<form action="ca_parclient_1mois.php" method="post"> 
<select name="mois_1">
  <?php
$calendrier = calendrier_local_mois ();
foreach ($calendrier as $numero_mois => $nom_mois)
{
?>
  <option value="<?php echo $numero_mois; ?>" 
  <?php if ( intval($numero_mois) == intval($mois_choisi) ) { ?> selected
  <?php }
  ?>
  >
  <?php echo ucfirst($nom_mois); ?></option>
  <?php 
}
?>
</select>
<select name="annee_1">  
  <option value="2005">2005</option>
  <option value="2006">2006</option>
  <option value="2004">2004</option>
</select>
<button type="submit"><?php echo $lang_envoyer; ?></button>
</form>
<?php 

if ($mois_1=='') {
 $mois_1= $mois_choisi ;
} 
if ($annee_1=='') { 
 $annee_1= $annee ; 
}
 ?>
<?php

$sql = "SELECT num_client FROM " . $tblpref ."client";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql2.'<br>'.mysql_error());
$nb = mysql_num_rows($req);

?>
<table class="boiteaction">
  <caption>
<?php echo "$lang_ca_par_client_1mois $mois_1/$annee_1" ?>
  </caption>
  <tr> 
    <th><?php echo $lang_client; ?></th>
    <th><?php echo "$lang_total_mois $mois_1/$annee_1"; ?></th>
    <th><?php echo $lang_pourcentage;?></th>
  </tr>
  <?php
//pour le total
$sql = "SELECT SUM(tot_htva)FROM " . $tblpref ."bon_comm WHERE MONTH(date)= $mois_1 AND Year(date)=$annee_1 ";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
$total = $data['SUM(tot_htva)'];

for ($i=1;$i<=$nb;$i++)
{

$sql = "SELECT SUM(tot_htva), nom FROM  " . $tblpref ."bon_comm RIGHT JOIN " . $tblpref ."client on client_num = num_client WHERE client_num =\"$i\" AND Year(date)=$annee_1 AND MONTH(date)=$mois_1 GROUP BY nom";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
$nom = $data['nom'];
$tot = $data['SUM(tot_htva)'];
$pourcentage = number_format( round( ($tot*100)/$total), 0, ",", " ");

?>
  <tr> 
    <td class='<?php echo couleur_alternee (); ?>'><?php echo $nom; ?></td>
    <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo montant_financier($tot); ?></td>
    <td class='<?php echo couleur_alternee (FALSE); ?>'> <?php echo stat_baton_horizontal("$pourcentage %"); ?></td>
  </tr>
  <?php
}

?>
  <tr> 
    <td class="totaltexte"><?php echo $lang_total; ?></td>
    <td class='totalmontant'><? echo montant_financier($total); ?></td>
    <td class='totalmontant'>&nbsp;</td>
  </tr>
</table><!-- InstanceEndEditable --> 
</td></tr>
</table>
<?php
include("help.php");
include_once("include/bas.php");
?>
</body>
<!-- InstanceEnd --></html>
