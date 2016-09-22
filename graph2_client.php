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
echo "<table  cellspacing='0'>";
//$annee = date("Y");
echo "<tr><td><b>client</td><td><b>Total de ventes $mois_1/$annee_1</b></td></tr>";

for ($i=1;$i<=$nb;$i++)
{

$sql = "SELECT SUM(tot_htva), nom FROM  " . $tblpref ."bon_comm RIGHT JOIN " . $tblpref ."client on client_num = num_client WHERE client_num =\"$i\" AND Year(date)= $annee_1 AND MONTH(date)= $mois_1 GROUP BY nom";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
$nom = $data['nom'];
$tot = $data['SUM(tot_htva)'];
$total = $tot2;
$tot = number_format(($tot*100)/$total, 2, ",", " ");
$barre = floor($tot)*3;
echo "<tr><td >$nom ($tot%)&nbsp;</td><td class='tdgraph' width='300' height='30' background='image/fond.gif'><img src='image/barre.gif' width='$barre' height='10'></td></tr>";
}

?>
</table>