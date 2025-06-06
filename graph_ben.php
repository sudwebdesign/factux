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
 * File Name: graph_ben.php
 * 	Graphique suivant les benefices
 *
 * * * Version:  5.0.0
 * * * * Modified: 07/10/2016
 *
 * File Authors:
 * 		Guy Hendrickx
 *.incluse dans graph_annuel
 */
?>
<table class='page boiteaction'>
  <caption><?php echo "$lang_evo_ben $annee_1" ?></caption>
  <tr>
   <th><?php echo $lang_mois; ?></th>
   <th></th>
   <th><?php echo $lang_benef; ?></th>
   <th rowspan="14" width="200px"><img src="graph2_ben.php?annee_1=<?php echo $annee_1; ?>"></th>
  </tr>
<?php
$sql = "SELECT SUM( prix ) htva FROM " . $tblpref ."depense WHERE YEAR( date ) = $annee_1 ";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$total_dep= floatval(mysql_result($req,0));
$total_gen = $total - $total_dep ;

//~ reset ($liste_mois);
foreach($liste_mois as $numero_mois => $nom_mois){
 $tot = floatval ($recettes [$numero_mois]["htva"] - $depenses [$numero_mois]["htva"]);
 $pourcentage = ($total)?round($tot / $total * 100.00):0;#Unwarning: Division by zero $pourcentage = number_format( round( ($tot*100)/$total), 0, ",", " ");
?>
  <tr>
    <td class='<?php echo couleur_alternee (); ?>'><?php echo ucfirst ($nom_mois); ?></td>
    <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo stat_baton_horizontal($pourcentage); ?> %</td>
    <td class='<?php echo couleur_alternee (FALSE, "nombre"); ?>'><?php echo montant_financier ($recettes [$numero_mois]["htva"]- $depenses [$numero_mois]["htva"]); ?></td>
  </tr>
<?php
}
?>
  <tr>
    <td class='totaltexte'></td>
    <td class='totalmontant'><?php echo $lang_total; ?></td>
    <td class='totalmontant'><?php echo montant_financier($total_gen)?></td>
  </tr>
</table>
