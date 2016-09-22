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
 * File Name: ca_annee.php
 * 	statisqiques annuelles decrtiquées par mois
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
include_once("include/language/$lang.php");
include_once("include/utils.php");
include_once("include/headers.php");
include_once("include/finhead.php");

?>
<table width="760" border="0" class="page" align="center">
<tr>
<td class="page" align="center">
<?php
include_once("include/head.php");
?>
</td>
</tr>
<tr>
<td><form action="ca_annee.php" method="post" name="annee">
année <select name="an">
<option value="2004"><?php $date=(date("Y")-1);echo"$date"; ?></option>
<option value="2005"><?php $date=date("Y");echo"$date"; ?></option></select><input type="submit" /></form>
<tr>
<td  class="page" align="center">

<?php
if ($user_stat== n) {
echo"<h1>$lang_statistique_droit";
exit;
}
if($_POST['an'] !=''){
$annee = $_POST['an'];
}
?>
<?php

$liste_mois = calendrier_local_mois ();
if ($annee =='') { 
$annee = date("Y");  
}

// initialisation à 0
$recettes = array ();
$depenses = array ();
$resultat_net = array ();
reset ($liste_mois);
while (list ($numero_mois, $nom_mois) = each ($liste_mois))
  {
  $recettes [$numero_mois] = array ("htva" => 0.0, "tva" => 0.0, "T.T.C" => 0.0);
  $depenses [$numero_mois] = array ("htva" => 0.0, "tva" => 0.0, "T.T.C" => 0.0);
  $resultat_net [$mois] = 0.0;
  }


// Recettes
$sql1 = "SELECT  MONTH(date) numero_mois, SUM(tot_htva) htva, SUM(tot_tva) tva
        FROM " . $tblpref ."bon_comm
        WHERE YEAR(date) = $annee
		GROUP BY numero_mois;";
// 		AND MONTH(date) = '$numero'

$req = mysql_query($sql1);

while ($data = mysql_fetch_array($req))
{
  $numero_mois = $data["numero_mois"];
  $recettes [$numero_mois] = $data;
  $recettes [$numero_mois]["T.T.C"] = $data ["htva"] + $data ["tva"];
}

// Dépenses
$sql2 = "SELECT MONTH(date) numero_mois, SUM(prix) htva
        FROM " . $tblpref ."depense
        WHERE YEAR(date) = $annee
		GROUP BY numero_mois";
$req = mysql_query($sql2);
while ($data = mysql_fetch_array($req))
{
  $numero_mois = $data["numero_mois"];
  $depenses [$numero_mois] = $data;
}

// Résultat net
reset ($liste_mois);
while (list ($numero_mois, $nom_mois) = each ($liste_mois))
{
  $numero_mois = $data->$numero_mois;
  $resultat_net [$numero_mois] = $recettes [$numero_mois]["htva"]  - $depenses [$numero_mois]["htva"] ;
}

?>
<table class="boiteaction">
  <caption>
 <?php echo "$lang_ca_annee $annee"; ?>
  </caption>

  <tr>
    <th>&nbsp;</th>
    <th><?php echo $lang_depenses_htva; ?></th>
    <th><?php echo $lang_ca_htva; ?></th>
    <th><?php echo $lang_ca_ttc; ?></th>
    <th><?php echo $lang_resultat_net; ?></th>
  </tr>
<?php
reset ($liste_mois);
while (list ($numero_mois, $nom_mois) = each ($liste_mois))
{
  ?>
  <tr>
    <td class='<?php echo couleur_alternee (); ?>'><?php echo ucfirst ($nom_mois); ?></td>
	<td class='<?php echo couleur_alternee (FALSE, "nombre"); ?>'><?php echo montant_financier ($depenses [$numero_mois]["htva"]); ?></td>
	<td class='<?php echo couleur_alternee (FALSE, "nombre"); ?>'><?php echo montant_financier ($recettes [$numero_mois]["htva"]); ?></td>
	<td class='<?php echo couleur_alternee (FALSE, "nombre"); ?>'><?php echo montant_financier ($recettes [$numero_mois]["T.T.C"]); ?></td>
	<td class='<?php echo couleur_alternee (FALSE, "nombre"); ?>'><?php echo montant_financier ($recettes [$numero_mois]["htva"]
	                                                   - $depenses [$numero_mois]["htva"]); ?></td>
  </tr>
<?php
}
?>
</table><br>
<?php
include("graph_ca.php");
echo "<br>";
include("graph_ben.php");
?>
</td></tr><tr><td>

<?php
include("help.php");
echo"</td></tr><tr><td>";
include_once("include/bas.php");
?>
</td></tr>
</table></body>
</html>
