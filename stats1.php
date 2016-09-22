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
$annee = date("Y");
echo "<h2><br>$lang_statistiques_annee $annee<br><hr>";
//1
$sql = "SELECT SUM(tot_htva), SUM(tot_tva)FROM " . $tblpref ."bon_comm WHERE MONTH(date) = '1' AND YEAR(date) = YEAR(NOW());";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
		$entre1 = $data['SUM(tot_htva)'];
		$totva1 = $data['SUM(tot_tva)'];
$sql = " SELECT SUM(prix)FROM " . $tblpref ."`depense` WHERE MONTH(date) = 1 AND YEAR(date) = YEAR(NOW())";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
		$depe1 = $data['SUM(prix)'];
//2
$sql = "SELECT SUM(tot_htva), SUM(tot_tva)FROM " . $tblpref ."bon_comm WHERE MONTH(date) = '2' AND YEAR(date) = YEAR(NOW())";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
   		$entre2 = $data['SUM(tot_htva)'];
			$totva2 = $data['SUM(tot_tva)'];
$sql = " SELECT SUM(prix)FROM " . $tblpref ."`depense` WHERE MONTH(date) = 2 AND YEAR(date) = YEAR(NOW())";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
		$depe2 = $data['SUM(prix)'];
//3
$sql = "SELECT SUM(tot_htva), SUM(tot_tva)FROM " . $tblpref ."bon_comm WHERE MONTH(date) = '3' AND YEAR(date) = YEAR(NOW())";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
		$entre3 = $data['SUM(tot_htva)'];
		$totva3 = $data['SUM(tot_tva)'];
$sql = " SELECT SUM(prix)FROM " . $tblpref ."`depense` WHERE MONTH(date) = 3 AND YEAR(date) = YEAR(NOW())";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
		$depe3 = $data['SUM(prix)'];
//4
$sql = "SELECT SUM(tot_htva), SUM(tot_tva)FROM " . $tblpref ."bon_comm WHERE MONTH(date) = '4' AND YEAR(date) = YEAR(NOW())";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
		$entre4 = $data['SUM(tot_htva)'];
		$totva4 = $data['SUM(tot_tva)'];
$sql = " SELECT SUM(prix)FROM " . $tblpref ."`depense` WHERE MONTH(date) = 4 AND YEAR(date) = YEAR(NOW())";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
		$depe4 = $data['SUM(prix)'];
//5
$sql = "SELECT SUM(tot_htva), SUM(tot_tva)FROM " . $tblpref ."bon_comm WHERE MONTH(date) = '5' AND YEAR(date) = YEAR(NOW())";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
		$entre5 = $data['SUM(tot_htva)'];
		$totva5 = $data['SUM(tot_tva)'];
$sql = " SELECT SUM(prix)FROM " . $tblpref ."`depense` WHERE MONTH(date) = 5 AND YEAR(date) = YEAR(NOW())";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
		$depe5 = $data['SUM(prix)'];
//6
$sql = "SELECT SUM(tot_htva), SUM(tot_tva)FROM " . $tblpref ."bon_comm WHERE MONTH(date) = '6' AND YEAR(date) = YEAR(NOW())";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
		$entre6 = $data['SUM(tot_htva)'];
		$totva6 = $data['SUM(tot_tva)'];
$sql = " SELECT SUM(prix)FROM " . $tblpref ."`depense` WHERE MONTH(date) = 6 AND YEAR(date) = YEAR(NOW())";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
		$depe6 = $data['SUM(prix)'];
//7
$sql = "SELECT SUM(tot_htva), SUM(tot_tva)FROM " . $tblpref ."bon_comm WHERE MONTH(date) = '7' AND YEAR(date) = YEAR(NOW())";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
		$entre7 = $data['SUM(tot_htva)'];
		$totva7 = $data['SUM(tot_tva)'];
$sql = " SELECT SUM(prix)FROM " . $tblpref ."`depense` WHERE MONTH(date) = 7 AND YEAR(date) = YEAR(NOW())";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_array($req))
    {
		$depe7 = $data['SUM(prix)'];
		}
//8
$sql = "SELECT SUM(tot_htva), SUM(tot_tva)FROM " . $tblpref ."bon_comm WHERE MONTH(date) = '8' AND YEAR(date) = YEAR(NOW())";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
		$entre8 = $data['SUM(tot_htva)'];
		$totva8 = $data['SUM(tot_tva)'];
$sql = " SELECT SUM(prix)FROM " . $tblpref ."`depense` WHERE MONTH(date) = 8 AND YEAR(date) = YEAR(NOW())";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
		$depe8 = $data['SUM(prix)'];
//9
$sql = "SELECT SUM(tot_htva), SUM(tot_tva)FROM " . $tblpref ."bon_comm WHERE MONTH(date) = '9' AND YEAR(date) = YEAR(NOW())";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
		$entre9 = $data['SUM(tot_htva)'];
		$totva9 = $data['SUM(tot_tva)'];
$sql = " SELECT SUM(prix)FROM " . $tblpref ."`depense` WHERE MONTH(date) = 9 AND YEAR(date) = YEAR(NOW())";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
		$depe9 = $data['SUM(prix)'];
//10
$sql = "SELECT SUM(tot_htva), SUM(tot_tva)FROM " . $tblpref ."bon_comm WHERE MONTH(date) = '10' AND YEAR(date) = YEAR(NOW())";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
		$entre10 = $data['SUM(tot_htva)'];
		$totva10 = $data['SUM(tot_tva)'];
$sql = " SELECT SUM(prix)FROM " . $tblpref ."`depense` WHERE MONTH(date) = 10 AND YEAR(date) = YEAR(NOW())";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
		$depe10 = $data['SUM(prix)'];
//11
$sql = "SELECT SUM(tot_htva), SUM(tot_tva)FROM " . $tblpref ."bon_comm WHERE MONTH(date) = '11'";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
		$entre11 = $data['SUM(tot_htva)'];
		$totva11 = $data['SUM(tot_tva)'];
$sql = " SELECT SUM(prix)FROM " . $tblpref ."`depense` WHERE MONTH(date) = 11 AND YEAR(date) = YEAR(NOW())";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
		$depe11 = $data['SUM(prix)'];
//12
$sql = "SELECT SUM(tot_htva), SUM(tot_tva)FROM " . $tblpref ."bon_comm WHERE MONTH(date) = '12' AND YEAR(date) = YEAR(NOW())";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
		$entre12 = $data['SUM(tot_htva)'];
		$totva12 = $data['SUM(tot_tva)'];
$sql = " SELECT SUM(prix)FROM " . $tblpref ."`depense` WHERE MONTH(date) = 12 AND YEAR(date) = YEAR(NOW())";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
		$depe12 = $data['SUM(prix)'];
$stat1 = $entre1 - $depe1 ;
$stat2 = $entre2 - $depe2 ;
$stat3 = $entre3 - $depe3 ;
$stat4 = $entre4 - $depe4 ;
$stat5 = $entre5 - $depe5 ;
$stat6 = $entre6 - $depe6 ;
$stat7 = $entre7 - $depe7 ;
$stat8 = $entre8 - $depe8 ;
$stat9 = $entre9 - $depe9 ;
$stat10 = $entre10 - $depe10 ;
$stat11 = $entre11 - $depe11 ;
$stat12 = $entre12 - $depe12 ;

$tottva1 = $entre1 + $totva1 ;
$tottva2 = $entre2 + $totva2 ;
$tottva3 = $entre3 + $totva3 ;
$tottva4 = $entre4 + $totva4 ;
$tottva5 = $entre5 + $totva5 ;
$tottva6 = $entre6 + $totva6 ;
$tottva7 = $entre7 + $totva7 ;
$tottva8 = $entre8 + $totva8 ;
$tottva9 = $entre9 + $totva9 ;
$tottva10 = $entre10 + $totva10 ;
$tottva11 = $entre11 + $totva11 ;
$tottva12 = $entre12 + $totva12 ;

//a verifier echo "$stat<br>";
echo "<center><table>";
echo "<tr><td><strong>&nbsp;</strong><td class='td2'><strong>$lang_depenses_htva</strong><td><strong>$lang_ca_htva</strong><td class='td2'><b>$lang_ca_ttc</b><td><strong>Résultat net</strong></tr>";
echo "<tr><td class='td2'>Janvier<td class='td2montant'>&nbsp;"
     .montant_financier ($depe1)."<td class='td2montant'>&nbsp;"
	 .montant_financier ($entre1)."<td class='td2montant'>"
	 .montant_financier ($tottva1)."<td class='td2montant'>"
     .montant_financier ($stat1)."</tr>";
echo "<tr><td class='td2'>Février<td class='td2montant'>&nbsp;"
     .montant_financier ($depe2)."<td class='td2montant'>&nbsp;"
     .montant_financier ($entre2)."<td class='td2montant'>"
	 .montant_financier ($tottva2)."<td class='td2montant'>"
     .montant_financier ($stat2)."</tr>";
echo "<tr><td class='td2'>Mars<td class='td2montant'>&nbsp;"
	 .montant_financier ($depe3)."<td class='td2montant'>&nbsp;"
 	 .montant_financier ($entre3)."<td class='td2montant'>"
 	 .montant_financier ($tottva3)."<td class='td2montant'>"
     .montant_financier ($stat3)."</tr>";
echo "<tr><td class='td2'>Avril<td class='td2montant'>&nbsp;"
     .montant_financier ($depe4)."<td class='td2montant'>&nbsp;"
     .montant_financier ($entre4)."<td class='td2montant'>"
	 .montant_financier ($tottva4)."<td class='td2montant'>"
     .montant_financier ($stat4)."</tr>";
echo "<tr><td class='td2'>Mai<td class='td2montant'>&nbsp;"
     .montant_financier ($depe5)."<td class='td2montant''>&nbsp;"
     .montant_financier ($entre5)."<td class='td2montant'>"
     .montant_financier ($tottva5)."<td class='td2montant'>"
     .montant_financier ($stat5)."</tr>";
echo "<tr><td class='td2'>Juin<td class='td2montant'>&nbsp;"
     .montant_financier ($depe6)."<td class='td2montant'>&nbsp;"
     .montant_financier ($entre6)."<td class='td2montant'>"
     .montant_financier ($tottva6)."<td class='td2montant'>"
     .montant_financier ($stat6)."</tr>";
echo "<tr><td class='td2'>Juillet<td class='td2montant'>&nbsp;"
     .montant_financier ($depe7)."<td class='td2montant'>&nbsp;"
     .montant_financier ($entre7)."<td class='td2montant'>"
     .montant_financier ($tottva7)."<td class='td2montant'>"
     .montant_financier ($stat7)."</tr>";
echo "<tr><td class='td2'>Août<td class='td2montant'>&nbsp;"
     .montant_financier ($depe8)."<td class='td2montant'>&nbsp;"
     .montant_financier ($entre8)."<td class='td2montant'>"
     .montant_financier ($tottva8)."<td class='td2montant'>"
     .montant_financier ($stat8)."</tr>";
echo "<tr><td class='td2'>Septembre<td class='td2montant'>&nbsp;"
     .montant_financier ($depe9)."<td class='td2montant'>&nbsp;"
	 .montant_financier ($entre9)."<td class='td2montant'>"
	 .montant_financier ($tottva9)."<td class='td2montant'>"
     .montant_financier ($stat9)."</tr>";
echo "<tr><td class='td2'>Octobre<td class='td2montant'>&nbsp;"
     .montant_financier ($depe10)."<td class='td2montant'>&nbsp;"
	 .montant_financier ($entre10)."<td class='td2montant'>"
	 .montant_financier ($tottva10)."<td class='td2montant'>"
     .montant_financier ($stat10)."</tr>";
echo "<tr><td class='td2'>Novembre<td class='td2montant'>&nbsp;"
     .montant_financier ($depe11)."<td class='td2montant'>&nbsp;"
	 .montant_financier ($entre11)."<td class='td2montant'>"
	 .montant_financier ($tottva11)."<td class='td2montant'>"
     .montant_financier ($stat11)."</tr>";
echo "<tr><td class='td2'>Décembre<td class='td2montant'>&nbsp;"
     .montant_financier ($depe12)."<td class='td2montant'>&nbsp;"
	 .montant_financier ($entre12)."<td class='td2montant'>"
	 .montant_financier ($tottva12)."<td class='td2montant'>"
     .montant_financier ($stat12)."</tr>";
echo "</table><br><hr><br>";
include("graph_ca.php");
include("graph_ben.php");
echo "<br><hr><br><img src='graph2_ca.php'><br><hr>";
require_once("include/bas.php");

?>