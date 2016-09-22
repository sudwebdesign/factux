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
include_once("include/language/$lang.php");
echo '<link rel="stylesheet" type="text/css" href="include/style.css">';
echo'<link rel="shortcut icon" type="image/x-icon" href="image/favicon.ico" >';
 ?> 
<table width="80%" >
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2"><form name="form1" method="post" action="bon_suite.php">
      <p><?php $lang_quanti?>
          <input name="quanti" type="text" id="quanti" size="6">
     <?php $lang_article ?>
     <?php 
include("include/config/common.php");
// Requête SQL
$rqSql = "SELECT num, article, prix_htva FROM " . $tblpref ."article ORDER BY num";
// Exécution de la requête
$result = mysql_query( $rqSql )
             or die( "Exécution requête impossible.");
$ld = "<SELECT NAME='article'>";
$ld .= "<OPTION VALUE=0>Choisissez</OPTION>";
// On boucle sur la table
while ( $row = mysql_fetch_array( $result)) {
    $num = $row["num"];
    $article = $row["article"];
		$prix = $row["prix_htva"];
    $ld .= "<OPTION VALUE='$num'>$article $prix</OPTION>";
}
$ld .= "</SELECT>";
//mysql_close( $idConnect);
print $ld;
?>
     <input name="champ_cach&eacute;" type="hidden" id="champ_cach&eacute;" value="valeur_hidd">
      </p>
      <p>
        <input type="submit" name="Submit" value="Valider">  
          </p>
    </form></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html><?php 
include("include/bas.php");
 ?>
