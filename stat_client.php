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
require_once("include/config/common.php");
require_once("include/head.php");
require_once("include/language/$lang.php");
require_once("include/nb.php");
echo '<link rel="stylesheet" type="text/css" href="include/style.css">';
echo'<link rel="shortcut icon" type="image/x-icon" href="image/favicon.ico" >';
?>
<?php
require_once("form_stat2_client.php");
$client=isset($_POST['client'])?$_POST['client']:"";

$annee = date("Y");
//$client = 1 ;
echo "<center><table>"; 
echo "<tr><td><strong>Mois</strong><td class='td2'><strong>$lang_ca_htva</strong></tr>";

for ($i=1;$i<=12;$i++)
{

$sql = "SELECT SUM(tot_htva) FROM  " . $tblpref ."bon_comm LEFT JOIN " . $tblpref ."client on client_num = num_client WHERE MONTH(date) = \"$i\" AND YEAR(date) = $annee  AND client_num = $client";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
$nom = $data['nom'];
$tot = $data['SUM(tot_htva)'];
echo "<tr><td class='td2'>$i/$annee<td class='td2montant'>". avec_virgule ($tot)." €</tr>";
}
echo "</table>";
include_once("graph_client_moi.php");
require_once("include/bas.php");
?>