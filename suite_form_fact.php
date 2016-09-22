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
$sql = "SELECT nom, nom2, rue, ville, cp, num_tva FROM " . $tblpref ."client RIGHT JOIN " . $tblpref ."bon_comm on " . $tblpref ."client.num_client = " . $tblpref ."bon_comm.client_num LEFT join " . $tblpref ."cont_bon on " . $tblpref ."bon_comm.num_bon = " . $tblpref ."cont_bon.bon_num WHERE client.num_client = $client AND bon_comm.date >= $debut and bon_comm.date <= $fin";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_array($req))
    {
		$nom = $data['nom'];
		$nom2 = $data['nom2'];
		$rue = $data['rue'];
		$ville = $data['ville'];
		$cp = $data['cp'];
		$num_tva = $data['num_tva'];
		
		echo "<font size= 2>$num  <br>";
    } 
 ?> 