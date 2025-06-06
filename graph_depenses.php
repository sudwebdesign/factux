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
include_once("include/headers.php");
include_once("include/finhead.php");
?>
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php
include_once("include/head.php");
if ($user_stat== 'n') {
 echo"<h1>$lang_statistique_droit</h1>";
 include_once("include/bas.php");
 exit;
}
//pour le formulaire
$mois_1=isset($_POST['mois_1'])?$_POST['mois_1']:date("m");
$annee_1=isset($_POST['annee_1'])?$_POST['annee_1']:date("Y");
$calendrier = calendrier_local_mois ();
?>
   <form action="graph_depenses.php" method="post">
    <?php echo $lang_choisissez; ?>
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
    <input type="submit" value='<?php echo $lang_envoyer; ?>'>
   </form>
   <br>
<?php
//stats mensuelles
$sql2 = "SELECT SUM(prix) FROM " . $tblpref ."depense WHERE MONTH(date) = $mois_1 AND YEAR(date) = $annee_1 ";
$req = mysql_query($sql2) or die('Erreur SQL !<br>'.$sql2.'<br>'.mysql_error());
while ($data = mysql_fetch_array($req)){
 $total_gene = $data['SUM(prix)'];
}
$sql = "
SELECT fournisseur, SUM(prix), SUM(mont_tva)
FROM " . $tblpref ."depense
WHERE MONTH(date) = $mois_1
AND YEAR(date) = $annee_1
GROUP BY fournisseur
";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
?>
   <table class='page boiteaction'>
    <caption><?php echo "$lang_depenses_tri_par_fournisseur $mois_1 $annee_1"; ?></caption>
    <tr>
     <th><?php echo $lang_fournisseur; ?></th>
     <th><?php echo $lang_total_htva; ?></th>
     <th><?php echo $lang_tot_tva; ?></th>
     <th><?php echo $lang_total_ttc; ?></th>
    </tr>
<?php
$ttva=$tttc=0;
while($data = mysql_fetch_array($req)){
 $four = $data['fournisseur'];
 $total = $data['SUM(prix)'];
 $tva = $data['SUM(mont_tva)'];
 $ttc = $total+$tva;
 $ttva+=$tva;
 $tttc+=$ttc;
?>
    <tr>
     <td class='<?php echo couleur_alternee (); ?>'><?php echo $four; ?></td>
     <td class='<?php echo couleur_alternee (FALSE,"nombre"); ?>'><?php echo montant_financier ($total); ?></td>
     <td class='<?php echo couleur_alternee (FALSE,"nombre"); ?>'><?php echo montant_financier ($tva); ?></td>
     <td class='<?php echo couleur_alternee (FALSE,"nombre"); ?>'><?php echo montant_financier ($ttc); ?></td>
    </tr>
<?php } ?>
    <tr>
     <td class="totalmontant"><?php echo $lang_total; ?></td>
     <td class="totalmontant"><?php echo montant_financier ($total_gene); ?></td>
     <td class="totalmontant"><?php echo montant_financier ($ttva); ?></td>
     <td class="totalmontant"><?php echo montant_financier ($tttc); ?></td>
    </tr>
   </table>
  </td>
 </tr>
 <tr>
  <td>
<?php
$aide='depense';
include("help.php");
include_once("include/bas.php");
?>
  </td>
 </tr>
</table>
</body>
</html>
