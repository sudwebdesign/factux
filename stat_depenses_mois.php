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
require_once("include/verif.php");
include_once("include/config/common.php");
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
$annee = date(Y);
$mois = date(m);
$calendrier = calendrier_local_mois ();
?>
      <form action="stat_depenses_annee.php" method="post">
        <table class="boiteaction">
        <caption>
        <?php echo $lang_choisissez; ?> 
        </caption>
				<tr><td class="texte0">
          <select name="mois_1">
            <?php
foreach ($calendrier as $numero_mois => $nom_mois)
{
?>
            <option value="<?php echo $numero_mois; ?>"><?php echo ucfirst($nom_mois); ?></option>
            <?php
 }
?>
          </select>
		  </td><td class="texte0">
          <select name="annee_1">
            <option value="<?php $date=(date("Y")-2);echo"$date"; ?>"><?php echo"$date"; ?></option>
            <option value="<?php $date=(date("Y")-1);echo"$date"; ?>"><?php echo"$date"; ?></option>
            <option value="<?php $date=date("Y");echo"$date"; ?>"><?php echo"$date"; ?></option>
          </select>
          </td></tr>
          <tr>
            <td class="submit" colspan="2"> <input type="submit" value='<?php echo $lang_envoyer; ?>'> 
            </td>
          </tr>
        </table>
      </form>
      <?php 
$mois_1=isset($_POST['mois_1'])?$_POST['mois_1']:"";
$annee_1=isset($_POST['annee_1'])?$_POST['annee_1']:"";


if ($mois_1=='') {
 $mois_1= $mois ;
} 
if ($annee_1=='') { 
 $annee_1= $annee ; 
}
 ?>
      <?php

//stats mensuelles
$sql2 = "SELECT SUM(prix)FROM " . $tblpref ."depense WHERE MONTH(date) = $mois_1 AND YEAR(date) = $annee_1 ";
$req = mysql_query($sql2);
while ($data = mysql_fetch_array($req))
{
  $total_gene = $data['SUM(prix)'];
}
$sql = "SELECT fournisseur, SUM(prix) FROM " . $tblpref ."depense WHERE MONTH(date) = $mois_1  AND YEAR(date) = $annee_1 GROUP BY fournisseur";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql2.'<br>'.mysql_error());
?>
      <table class="boiteaction">
        <caption>
        <?php echo "$lang_depenses_tri_par_fournisseur $mois_1 $annee_1"; ?> 
        </caption>
        <?php
?>
        <tr> 
          <th><?php echo $lang_fournisseur; ?></th>
          <th><?php echo $lang_total; ?></th>
        </tr>
        <?
while($data = mysql_fetch_array($req))
    {
		$four = $data['fournisseur'];
		$total = $data['SUM(prix)'];
		?>
        <tr> 
          <td class='<?php echo couleur_alternee (); ?>'><?php echo $four; ?></td>
          <td class='<?php echo couleur_alternee (FALSE,"nombre"); ?>'><?php echo montant_financier ($total); ?></td>
          <?php
		}
?>
        <tr> 
          <td class= 'totaltexte'><?php echo $lang_total; ?></td>
          <td class="totalmontant"><?php echo  montant_financier ($total_gene); ?></td>
        </tr></table>
<tr><td>      
<?php
include("help.php");
include_once("include/bas.php");
?>
</td></tr>
</table>
</body>
</html>
