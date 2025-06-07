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
 * File Name: fckconfig.js
 * 	Editor configuration settings.
 *
 * * * * Version:  8.0.0
 * * * * Modified: 07/06/2025
 *
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
include_once(__DIR__ . "/include/headers.php");
include_once(__DIR__ . "/include/finhead.php");
if(basename($_SERVER['PHP_SELF'])==basename(__FILE__)){
$annee_1 = (isset($_POST['annee_1']))?$_POST['annee_1']:date('Y');
?>
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php  require_once(__DIR__ . "/include/head.php"); ?>
   <form action="graph_circulaire_annuel.php" method="post" name="annee_1">
<?php echo $lang_annee; ?>
    <select name="annee_1">
<?php for ($i=date("Y");$i>=date("Y")-13;$i--){?>
     <option value="<?php echo$i; ?>"<?php echo ($i==$annee_1)?' selected="selected"':''; ?>><?php echo $i; ?></option>
<?php } ?>
    </select>
    <input type="submit" value="<?php echo $lang_envoyer; ?>" />
   </form>
  </td>
 </tr>
 <tr>
  <td>
<?php } ?>
   <table class="page boiteaction" align="center">
<?php
$annee_1 = isset($annee_1)?$annee_1:date("Y");
echo "
<caption>{$lang_statistiques_annee} {$annee_1}</caption>
<tr>
 <td><b>&nbsp;</b></td>
 <td class='td2'><b>{$lang_depenses_htva}</b></td>
 <td class='td2'><b>{$lang_ca_htva}</b></td>
 <td class='td2'><b>{$lang_ca_ttc}</b></td>
 <td class='td2'><b>{$lang_resultat_net}</b></td>
 <td rowspan='13' class='td2'><br><b>{$lang_graph_cir}</b><br><br><img src='graph2_ca.php?annee_1={$annee_1}'></td>
</tr>";
for ($i=1;$i<=12;$i++){
 $sql = "
 SELECT SUM(tot_htva), SUM(tot_tva)
 FROM " . $tblpref ."bon_comm
 WHERE MONTH(date) = '{$i}'
 AND YEAR(date) = {$annee_1};
 ";
 $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
 $data = mysql_fetch_array($req);
 $entre[$i] = $data['SUM(tot_htva)'];
 $totva[$i] = $data['SUM(tot_tva)'];

 $sql = "
 SELECT SUM(prix)
 FROM " . $tblpref ."depense
 WHERE MONTH(date) = {$i}
 AND YEAR(date) = {$annee_1}
 ";
 $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
 $data = mysql_fetch_array($req);
 $depe[$i] = $data['SUM(prix)'];

 $stat[$i] = $entre[$i] - $depe[$i] ;
 $tottva[$i] = $entre[$i] + $totva[$i] ;
//a verifier echo "$stat<br>";
echo "
 <tr>
  <td class='td2'>".DateTime::createFromFormat('!m', $i)->format('F')."</td>
  <td class='td2montant'>".montant_financier ($depe[$i])."</td>
  <td class='td2montant'>".montant_financier ($entre[$i])."</td>
  <td class='td2montant'>".montant_financier ($tottva[$i])."</td>
  <td class='td2montant'>".montant_financier ($stat[$i])."</td>
 </tr>
";
}
?>
   </table>
  </td>
 </tr>
 <tr>
  <td>
<?php include(__DIR__ . "/graph_circulaire_annuel_fact.php"); ?>
  </td>
 </tr>
 <tr>
  <td>
<?php include(__DIR__ . "/graph_circulaire_annuel_payes.php"); ?>
  </td>
 </tr>
 <tr>
  <td>
<?php require_once(__DIR__ . "/include/bas.php"); ?>
  </td>
 </tr>
<?php if(basename($_SERVER['PHP_SELF'])==basename(__FILE__)){?>
</table>
</body>
</html>
<?php }
