<?php
/*
 * Factux le facturier libre
 * Copyright (C) 2003-2005 Guy Hendrickx, 2017 Thomas Ingles
 *
 * Licensed under the terms of the GNU  General Public License:
 *   http://opensource.org/licenses/GPL-3.0
 *
 * For further information visit:
 *   http://factux.free.fr
 *
 * File Name: graph_ca.php
 *  graphique suivant le chiffre d'affaire
 *
 * * * Version:  5.0.0
 * * * * Modified: 07/10/2016
 *
 * File Authors:
 *   Guy Hendrickx
 *.incluse dans graph_annuel
 */
?>
<table class='page boiteaction'>
 <caption><?php echo sprintf('%s %s', $lang_evo_ca, $annee_1); ?></caption>
 <tr>
  <th><?php echo $lang_mois; ?></th>
  <th></th>
  <th><?php echo $lang_ca_htva; ?></th>
  <th rowspan="14" width="200px"><img src="graph2_ca.php?annee_1=<?php echo $annee_1; ?>"></th>
 </tr>
<?php
$sql = "SELECT SUM( tot_htva ) FROM " . $tblpref .sprintf('bon_comm WHERE YEAR( date ) = %s ', $annee_1);
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$total= mysql_result($req,0);

//~ reset ($liste_mois);
foreach($liste_mois as $numero_mois => $nom_mois){
 $tot = $recettes[$numero_mois]["htva"];
 $pourcentage = ($total)?round($tot / $total * 100):0;#Unwarning: Division by zero  $pourcentage = number_format( round( ($tot*100)/$total), 0, ",", " ");
?>
  <tr>
   <td class='<?php echo couleur_alternee (); ?>'><?php echo ucfirst ($nom_mois); ?></td>
   <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo stat_baton_horizontal($pourcentage); ?> %</td>
   <td class='<?php echo couleur_alternee (FALSE, "nombre"); ?>'><?php echo montant_financier ($recettes[$numero_mois]["htva"]); ?></td>
  </tr>
<?php
}
?>
  <tr>
 <td class='totaltexte'></td>
 <td class='totalmontant'><?php echo $lang_total; ?></td>
 <td class='totalmontant'><?php echo montant_financier($total); ?></td>
  </tr>
</table>
