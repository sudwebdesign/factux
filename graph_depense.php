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
 * File Name: fckconfig.js
 * 	Editor configuration settings.
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
$mois_1=isset($_POST['mois_1'])?$_POST['mois_1']:date('m');
$annee_1=isset($_POST['annee_1'])?$_POST['annee_1']:date('Y');
?>
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php
include_once(__DIR__ . "/include/head.php");
$calendrier = calendrier_local_mois ();
?>
   <form action="graph_depense.php" method="post">
    <table class='page boiteaction'>
     <tr>
      <td class="page" align="center">
 <select name="mois_1">
<?php for ($i=1;$i<=12;$i++){?>
     <option value="<?php echo $i; ?>"<?php echo ($i==$mois_1)?' selected="selected"':''; ?>><?php echo ucfirst($calendrier [$i]); ?></option>
<?php } ?>
 </select>
 <select name="annee_1">
<?php for ($i=date("Y");$i>=date("Y")-13;$i--){?>
     <option value="<?php echo $i; ?>"<?php echo ($i==$annee_1)?' selected="selected"':''; ?>><?php echo $i; ?></option>
<?php } ?>
 </select>
 <button type="submit">Envoyer</button>
       </td>
      </tr>
     </table>
    </form>
<?php
//stats mensuelles
$sql2 = "SELECT SUM(prix)FROM " . $tblpref .sprintf('depense WHERE MONTH(date) = %s AND YEAR(date) = %s ', $mois_1, $annee_1);
$req = mysql_query($sql2) or die('Erreur SQL !<br>'.$sql2.'<br>'.mysql_error());
while ($data = mysql_fetch_array($req)){
    $total_gene = floatval($data['SUM(prix)']);
}
?>
<table class='page boiteaction'>
 <caption><?php echo sprintf('%s (%s/%s)', $lang_depenses_tri_par_fournisseur, $mois_1, $annee_1); ?></caption>
<?php
$sql = "SELECT fournisseur, SUM(prix) FROM " . $tblpref .sprintf('depense WHERE MONTH(date) = %s  AND YEAR(date) = %s GROUP BY fournisseur', $mois_1, $annee_1);
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
?>
 <tr>
  <td class='td2'><?php echo $lang_fournisseur; ?></td>
  <td class='td2'><?php echo $lang_pourcentage; ?></td>
  <td class='td2'><?php echo $lang_total; ?></td>
 </tr>
<?php
while($data = mysql_fetch_array($req)){
 $four = $data['fournisseur'];
 $total = $data['SUM(prix)'];
 $prix = $data['SUM(prix)'];
 $tot = $total_gene?($total*100)/$total_gene:0; // Fix divideperzero
 $barre = floor($tot)*3;
?>
 <tr>
  <td class='<?php echo couleur_alternee (); ?>'><?php echo $four; ?></td>
  <td class='<?php echo couleur_alternee (FALSE); ?>' width='380' height='16'>
   <img src='image/barre.jpg' width='<?php echo $barre; ?>' height='10'><?php echo montant_taux($tot); ?>
  </td>
  <td class='<?php echo couleur_alternee (FALSE, "nombre"); ?>'><?php echo montant_financier ($total); ?></td>
 </tr>
<?php
}
?>
 <tr>
     <td class='totalmontant'></td>
     <td class='totaltexte'><?php echo $lang_total; ?></td>
     <td class='totalmontant'><?php echo montant_financier($total_gene); ?></td>
 </tr>
</table>
<br>
<?php
//stats annuelles
$sql2 = "SELECT SUM(prix) FROM " . $tblpref .('depense WHERE YEAR(date) = ' . $annee_1);
$req = mysql_query($sql2) or die('Erreur SQL !<br>'.$sql2.'<br>'.mysql_error());
while ($data = mysql_fetch_array($req)){
 $total_gene = floatval($data['SUM(prix)']);
}
?>
<table class='page boiteaction'>
 <caption><?php echo sprintf('%s (%s)', $lang_depenses_tri_par_fournisseur, $annee_1); ?></caption>
<?php
$sql = "SELECT fournisseur, SUM(prix) FROM " . $tblpref .sprintf('depense WHERE YEAR(date) = %s GROUP  BY fournisseur ORDER  BY fournisseur', $annee_1);
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
?>
 <tr>
  <td class='td2'><?php echo $lang_fournisseur; ?></td>
  <td class='td2'><?php echo $lang_pourcentage; ?></td>
  <td class='td2'><?php echo $lang_total; ?></td>
 </tr>
<?php
while($data = mysql_fetch_array($req)){
 $four = $data['fournisseur'];
 $total = $data['SUM(prix)'];
 $prix = $data['SUM(prix)'];
 $tot = $total_gene?($total*100)/$total_gene:0; // fix / 0
 $barre = floor($tot)*3;
?>
    <tr>
     <td class='<?php echo couleur_alternee (); ?>'><?php echo $four; ?></td>
     <td class='<?php echo couleur_alternee (FALSE); ?>' width='380' height='16'>
      <img src='image/barre.jpg' width='<?php echo $barre; ?>' height='10'><?php echo montant_taux($tot); ?>
     </td>
     <td class='<?php echo couleur_alternee (FALSE, "nombre"); ?>'><?php echo montant_financier($total); ?></td>
    </tr>
<?php } ?>
    <tr>
     <td class='totalmontant'></td>
     <td class='totaltexte'><?php echo $lang_total; ?></td>
     <td class='totalmontant'><?php echo montant_financier($total_gene); ?></td>
    </tr>
</table>
<br>
 <tr>
  <td>
<?php
include_once(__DIR__ . "/include/bas.php");
?>
 </td>
</tr>
</table>
</body>
</html>
