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
include_once("include/config/common.php");
include_once("include/head.php");
include_once("include/language/$lang.php");
include_once("include/nb.php");
echo '<link rel="stylesheet" type="text/css" href="include/style.css">';
echo'<link rel="shortcut icon" type="image/x-icon" href="image/favicon.ico" >';
?>
<?php
echo "<table cellspacing='0'>";
$sql = "SELECT SUM(tot_htva) FROM  " . $tblpref ."bon_comm LEFT JOIN " . $tblpref ."client on client_num = num_client WHERE YEAR(date) = $annee  AND client_num = $client";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql2.'<br>'.mysql_error());
//echo "<tr><td>Bon N&deg; <td>Client<td>Date du bon <td>$lang_total_h_tva <td>Total T.T.C <td>action</tr>";
while($data = mysql_fetch_array($req))
    {
		$total = $data['SUM(tot_htva)'];
		}
echo "<tr><td><b>$lang_mois</td><td><b>$lang_ca_htva $annee</b></td></tr>";

for ($i=1;$i<=12;$i++)
{

$sql = "SELECT SUM(tot_htva) FROM  " . $tblpref ."bon_comm LEFT JOIN " . $tblpref ."client on client_num = num_client WHERE MONTH(date) = \"$i\" AND YEAR(date) = $annee  AND client_num = $client";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
$art = $data['article'];
$tot = $data['SUM(tot_htva)'];
$prix = $data['SUM(tot_htva)'];
$tot = number_format(($tot*100)/$total, 2, ",", " ");
$barre = floor($tot)*3;
echo "<tr><td>$i/$annee (".avec_virgule ($prix)." €) ($tot%)&nbsp;</td><td class='tdgraph' width='300' height='30' background='image/fond.gif'><img src='image/barre.gif' width='$barre' height='10'></td></tr>";
}

?>
</table>