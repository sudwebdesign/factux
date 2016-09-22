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
include_once("include/config/var.php");
include_once("include/head.php");
include_once("include/language/$lang.php");
$client=isset($_GET['client'])?$_GET['client']:"";

echo '<link rel="stylesheet" type="text/css" href="include/style.css">';
echo'<link rel="shortcut icon" type="image/x-icon" href="image/favicon.ico" >';
echo("<h2><br><hr>$lang_rappel");?>
<br>
<form name="form_bon" method="post" action="fpdf/rapel_pdf.php" target="_blank">
      <center><table class="boiteaction">
  <caption>
  Titre du tableau
  </caption>
 <?php 
$rqSql = "SELECT TO_DAYS(NOW()) - TO_DAYS(date_fact) AS peri, client, date_deb, date_fin, total_fact_ttc, num, nom, DATE_FORMAT(date_fact,'%d/%m/%Y') AS date_fact FROM " . $tblpref ."facture RIGHT JOIN " . $tblpref ."client on " . $tblpref ."facture.client = " . $tblpref ."client.num_client WHERE payement = 'non' AND " . $tblpref ."client.num_client = $client ORDER BY peri DESC";

$result = mysql_query( $rqSql )
             or die( "Exécution requête impossible. $rqSql");
while ( $row = mysql_fetch_array( $result)) {
    $num = $row["num"];
    $nom = $row["nom"];
		$peri = $row["peri"];
		$total = $row["total_fact_ttc"];
    $ld .="<tr><td><input type='checkbox' name='choix[]'value='$num'>Facture $num de $total € envoyée depuis $peri jours</tr>";
}
print $ld;

?>
<input type="hidden" name="client" value=<?php echo $client ?>>
<SELECT NAME='rapel_num'>"

<OPTION VALUE=0>Choisissez</OPTION>
<OPTION VALUE=1>Premier rappel</OPTION>
<OPTION VALUE=2>Deuxieme rappel</OPTION>
<OPTION VALUE=3>Troisième rappel</OPTION>
<tr><td><input type="submit" value="Valider"></tr>
</FORM></table>

<?
$aide = rappel;
include("help.php");

include_once("include/bas.php");
?>