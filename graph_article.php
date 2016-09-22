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

$sql = "SELECT SUM(tot_art_htva), date, article_num, article, prix_htva FROM  " . $tblpref ."cont_bon RIGHT JOIN " . $tblpref ."bon_comm on bon_num = num_bon LEFT JOIN " . $tblpref ."article on article.num = article_num  WHERE article_num =\"$i\" AND YEAR(date) = $annee  GROUP BY  article";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
$art = $data['article'];
$tot = $data['SUM(tot_art_htva)'];
$total = $tot2;
$prix = $data['prix_htva'];
$tot = number_format(($tot*100)/$total, 2, ",", " ");
$barre = floor($tot)*3;
echo "<tr><td>$art ($prix) ($tot%)&nbsp;</td><td class='tdgraph' width='300' height='30' background='image/fond.gif'><img src='image/barre.gif' width='$barre' height='10'></td></tr>";
}

?>
</table>