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
echo '<link rel="stylesheet" type="text/css" href="include/style.css">';
echo'<link rel="shortcut icon" type="image/x-icon" href="image/favicon.ico" >';
?>
<SCRIPT language="JavaScript" type="text/javascript">
		function confirmDelete()
		{
		var agree=confirm("<?php echo 'Désirer vous vraiment effacer ce bon de livraison ?'; ?>");
		if (agree)
		 return true ;
		else
		 return false ;
		}
		</script>
<?php
$mois = date("m");

echo "<br><h2>Les bons de livraison qui ne font pas encore l'objet d'une facture<br><hr>";
$sql = "SELECT num_bon, tot_htva, tot_tva, nom, DATE_FORMAT(date,'%d/%m/%Y') AS date FROM " . $tblpref ."`bon_comm` RIGHT JOIN " . $tblpref ."client on " . $tblpref ."bon_comm.client_num = num_client WHERE fact='0' ORDER BY `bon_comm`.`num_bon` DESC";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql2.'<br>'.mysql_error());
echo "<center><table>"; 
echo "<tr><td><strong>Bon N&deg; </strong><td class='td2'><strong>Client</strong><td><strong>Date du bon </strong><td class='td2'><strong>$lang_total_h_tva </strong><td><strong>Total T.V.A </strong><td class='td2'><strong>action</strong></tr>";
while($data = mysql_fetch_array($req))
    {
		$num_bon = $data['num_bon'];
		$total = $data['tot_htva'];
		$tva = $data['tot_tva'];
		$date = $data['date'];
		$nom = $data['nom'];
		echo "<tr><td class='td2'>$num_bon</td><td>$nom</td><td class='td2'>$date</td><td>$total €</td><td class='td2'>$tva €</td><td><div align='center'><a href=edit_bon.php?num_bon=$num_bon&nom=$nom ><img border=0 alt=editer src=image/edit.gif></a>&nbsp;<a href=delete_bon_suite.php?num_bon=$num_bon&nom=$nom onClick='return confirmDelete()' ><img border=0 src= image/delete.jpg alt='effacer'></a>&nbsp;<a href=fpdf/bon_pdf.php?num_bon=$num_bon&nom=$nom target=_blank ><img border=0 src= image/printer.gif alt='imprimer'></a><br></div></td>";
		}
		echo "</table><br><hr>";
include("form_fact.php");
require_once("include/bas.php");		
 ?> 