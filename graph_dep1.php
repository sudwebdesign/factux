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
echo "<table cellspacing='0'>";
//$annee = date("Y");
echo "<tr><td><b>Article</td><td><b>Total de ventes  $annee</b></td></tr>";

for ($i=1;$i<=$nb;$i++)
{

$sql = "SELECT fournisseur, SUM(prix) FROM " . $tblpref ."depense WHERE MONTH(date) = $mois_1  AND YEAR(date) = $annee_1 GROUP BY fournisseur";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
$art = $data['fournisseur'];
$tot = $data['SUM(prix)'];
$total = $total_gene;
$prix = $data['prix_htva'];
$tot = number_format(($tot*100)/$total, 2, ",", " ");
$barre = floor($tot)*3;
echo "<tr><td>$art ($prix) ($tot%)&nbsp;</td><td class='tdgraph' width='300' height='30' background='image/fond.gif'><img src='image/barre.gif' width='$barre' height='10'></td></tr>";
}

?>
</table>