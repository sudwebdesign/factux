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
include_once("include/verif.php");
include_once("include/config/common.php");
include_once("include/head.php");
include_once("include/language/$lang.php");
echo '<link rel="stylesheet" type="text/css" href="include/style.css">';
echo'<link rel="shortcut icon" type="image/x-icon" href="image/favicon.ico" >';
?> 
<?php
include_once("include/head.php");
include_once("include/config/common.php");
echo '<link rel="stylesheet" type="text/css" href="include/style.css">';
echo "<hr>";
?>
<center><h2><?php echo $lang_statistiques_par_client; ?></h2><br>
<form name="form_bon" method="post" action="ca_client_parmois.php">
      <p align="center"> <?php echo $lang_client;
$rqSql = "SELECT num_client, nom FROM " . $tblpref ."client ORDER BY nom";
$result = mysql_query( $rqSql )
             or die( "Exécution requête impossible.");
$ld = "<SELECT NAME='client'>";
$ld .= "<OPTION VALUE=0>Choisissez</OPTION>";
// On boucle sur la table
while ( $row = mysql_fetch_array( $result)) {
    $numclient = $row["num_client"];
    $nom = $row["nom"];
    $ld .= "<OPTION VALUE='$numclient'>$nom</OPTION>";
}
$ld .= "</SELECT>";
//mysql_close( $idConnect);
print $ld;
?><input type="submit" name="Submit" value="Voir les stats">  
    </form>
<?php 
echo " <hr>";
//include_once("include/bas.php");
?>