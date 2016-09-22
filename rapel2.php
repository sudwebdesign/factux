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
include_once("include/head.php");
include_once("include/config/common.php");
include_once("include/language/$lang.php");
echo '<link rel="stylesheet" type="text/css" href="include/style.css">';
echo'<link rel="shortcut icon" type="image/x-icon" href="image/favicon.ico" >';
$date_jour = date("d/m/Y");
echo "<h2><hr>";
$sql = "SELECT * FROM cclient Where num_client = $client";
$req = mysql_query($sql)or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_array($req))
			{
			$nom = $data[nom];
			echo "$nom";
			}
echo "<h2>Les factures selectionnées sont:<br>";
for ($i=0 ; $i< sizeof($choix) ; $i++)
   if (isset($choix[$i]) )
   {
	 $sql1 = "UPDATE facture SET r$rapel_num ='".$date_jour."' WHERE num = '".$choix[$i]."'";
   mysql_query($sql1) or die('Erreur SQL !<br>'.$sql1.'<br>'.mysql_error());
	 $sql = "SELECT DATE_FORMAT(date_fact,'%d/%m/%Y') AS date, total_fact_T.T.C FROM " . $tblpref ."`facture` WHERE num = $choix[$i]";
   $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_array($req))
	 {
	 $total = $data['total_fact_T.T.C'];
	 $date = $data['date'];
	 echo "rappel enregistré<br>";
	 echo "facture n° $choix[$i] du $date pour un montant de $total €<br>";
   }
	 };
	 $choix = serialize($choix);
	 $choix = urlencode($choix);
	 echo "<a href='fpdf/rapel_pdf.php?client=$client&amp;choix=$choix'>imprimer</a>";
	 echo "<hr>";
include_once("include/bas.php");
?>