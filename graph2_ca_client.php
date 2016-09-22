<?php
/* fait partie de stats2.2.php
 * Factux le facturier libre
 * Copyright (C) 2003-2004 Guy Hendrickx
 * 
 * Licensed under the terms of the GNU  General Public License:
 * 		http://www.opensource.org/licenses/gpl-license.php
 * 
 * For further information visit:
 * 		http://factux.sourceforge.net
 * 
 * File Name: graph2_client.php
 * 	parametrage d'appel du camembert ca / client.
 * 
 * * * Version:  1.1.5
 * * * * Modified: 23/07/2005
 * 
 * File Authors:
 * 		Guy Hendrickx
 *
 */
require_once("include/verif.php");
include_once("include/config/common.php");
$annee_1 = (isset($_GET['annee_1']))?$_GET['annee_1']:date("Y");
$sql = "
SELECT SUM(tot_htva) tot, nom 
FROM " . $tblpref ."bon_comm 
LEFT JOIN " . $tblpref ."client on client_num = num_client 
WHERE Year(date)=$annee_1 
GROUP BY nom
ORDER BY tot DESC
";#LIMIT 1536

$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$cd=369;
while($data = mysql_fetch_array($req)){
 $ChartLabel[]=$data['nom'];
 $ChartData[]=$data['tot'];
 $cd++;
}
if($cd==369){#si vide
 $ChartLabel[]='N/A';
 $ChartData[]=0;
}
$ChartDiameter=($cd<=760)?$cd:760;
$ChartFont=13;
include("graph_circulaire_base.php");#Graphique sectoriel au format GIF
