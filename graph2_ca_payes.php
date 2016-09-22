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
$annee_1 = (isset($_GET['annee_1']))?$_GET['annee_1']:date("Y");
for ($i=1;$i<=12;$i++){
 $sql = "
 SELECT SUM(total_fact_h), SUM(acompte), payement
 FROM " . $tblpref ."facture 
 WHERE MONTH(date_fact) = '$i' 
 AND YEAR(date_fact) = $annee_1;
 ";
 $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
 $data = mysql_fetch_array($req);
 if($data['payement']!= 'non')
  $entre[$i] = $data['SUM(total_fact_h)'];
 else
  $entre[$i] = $data['SUM(acompte)'];
}
include("graph_circulaire_base.php");#Graphique sectoriel au format GIF
