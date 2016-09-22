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
require_once("include/config/common.php");
require_once("include/language/$lang.php");
include_once("include/headers.php");
include_once("include/finhead.php");
$annee = date(Y);
$mois = date(m);
?>
<table width="760" border="0" class="page" align="center">
<tr><td class="page" align="center">
<?php 
require_once("include/head.php");
 ?> 
<form action="stats_dep.php" method="post">
<select name="mois_1"><option value="1">Janvier</option><option value="2">Février</option><option value="3">Mars</option>
<option value="4">Avril</option><option value="5">Mai</option><option value="6">Juin</option><option value="7">Juillet</option>
<option value="8">Août</option><option value="9">Septembre</option><option value="10">Octobre</option><option value="11">Novembre</option>
<option value="12">Decembre</option></select><select name="annee_1"><option value="<?php $date=(date("Y")-1);echo"$date"; ?>"><?php $date=(date("Y")-1);echo"$date"; ?></option><option value="<?php $date=(date("Y"));echo"$date"; ?>"><?php $date=(date("Y"));echo"$date"; ?></option><option value="<?php $date=(date("Y")+1);echo"$date"; ?>"><?php $date=(date("Y")+1);echo"$date"; ?></option></select>
<button type="submit">Envoyer</button>

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
echo "<center><table class='boiteaction'>
  <caption>
	$lang_depenses_tri_par_fournisseur le mois $mois_1/$annee_1  
  </caption>
";
$sql = "SELECT fournisseur, SUM(prix) FROM " . $tblpref ."depense WHERE MONTH(date) = $mois_1  AND YEAR(date) = $annee_1 GROUP BY fournisseur";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql2.'<br>'.mysql_error());
echo "<tr><td class='td2'>Fournisseur<td class='td2'>$lang_total</tr>";

while($data = mysql_fetch_array($req))
    {
		$four = $data['fournisseur'];
		$total = $data['SUM(prix)'];
		?>
		<tr><td><?php echo $four; ?></td>
		<td class='td2montant'><?php echo montant_financier ($total); ?></td>
		<?php
		}
?>
<tr><td class= 'totaltexte'><?php echo " $lang_total"; ?></td>
<td class="totalmontant"><?php echo $total_gene; ?></td></tr>
</table></center><hr><br>
<?php
//stats annuelles
$sql2 = "SELECT SUM(prix)FROM " . $tblpref ."depense WHERE YEAR(date) = $annee_1";
$req = mysql_query($sql2);
while ($data = mysql_fetch_array($req))
			{
			$total_gene = $data['SUM(prix)'];
			}
echo "<center><table class='boiteaction'>
  <caption>$lang_depenses_tri_par_fournisseur l'année $annee_1
  
  </caption>
";
$sql = "SELECT fournisseur, SUM(prix) FROM " . $tblpref ."depense WHERE YEAR(date) = $annee_1 GROUP  BY fournisseur ORDER  BY fournisseur";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql2.'<br>'.mysql_error());
echo "<tr><td class='td2'>Fournisseur<td class='td2'>$lang_total</tr>";
while($data = mysql_fetch_array($req))
    {
		$four = $data['fournisseur'];
		$total = $data['SUM(prix)'];
		?>
		<tr><td><?php echo $four; ?></td>
		<td class='td2montant'><?php echo montant_financier($total); ?></td></tr>
		<?php
		}
?>
<tr><td class= 'totaltexte'><?php echo $lang_total; ?></td>
      <td class='totalmontant'><?php echo montant_financier($total_gene); ?></tr>
</table></center><hr><br>
<tr><td>
<?php
require_once("include/bas.php");
 ?> 
 </td></tr></table>