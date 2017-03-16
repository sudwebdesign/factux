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
if(basename($_SERVER['PHP_SELF'])==basename(__FILE__)){
?>
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php 
 require_once("include/head.php"); 
} 
?>
<table class="page boiteaction" align="center">
<?php 
$annee_1 = isset($annee_1)?$annee_1:date("Y");
echo "
<caption>$lang_statistiques_annee $annee_1 $lang_facturé</caption>
<tr>
 <td><b>&nbsp;</b></td>
 <td class='td2'><b>$lang_depenses_htva</b></td>
 <td class='td2'><b>$lang_ca_htva</b></td>
 <td class='td2'><b>$lang_ca_ttc</b></td>
 <td class='td2'><b>$lang_resultat_net</b></td>
 <td rowspan='13' class='td2'><br><b>$lang_graph_cir</b><br><br><img src='graph2_ca_fact.php?annee_1=$annee_1'></td>
</tr>
";
for ($i=1;$i<=12;$i++){
 $sql = "
 SELECT SUM(total_fact_h), SUM(total_fact_ttc)
 FROM " . $tblpref ."facture 
 WHERE MONTH(date_fact) = '$i' 
 AND YEAR(date_fact) = $annee_1;
 ";
 $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
 $data = mysql_fetch_array($req);
 $entre[$i] = $data['SUM(total_fact_h)'];
 $totva[$i] = $data['SUM(total_fact_ttc)'] - $data['SUM(total_fact_h)'];


 $sql = "
 SELECT SUM(prix)
 FROM " . $tblpref ."depense
 WHERE MONTH(date) = $i 
 AND YEAR(date) = $annee_1
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
<?php if(basename($_SERVER['PHP_SELF'])==basename(__FILE__)){?>
  </td>
 </tr>
 <tr>
  <td>
<?php require_once("include/bas.php"); ?>
  </td>
 </tr>
</table>
</body>
</html>
<?php }
