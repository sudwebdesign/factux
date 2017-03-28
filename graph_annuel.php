<?php
/*
 * Factux le facturier libre
 * Copyright (C) 2003-2005 Guy Hendrickx, 2017 Thomas Ingles
 * 
 * Licensed under the terms of the GNU  General Public License:
 * 		http://opensource.org/licenses/GPL-3.0
 * 
 * For further information visit:
 * 		http://factux.free.fr
 * 
 * File Name: ca_annee_1.php
 * 	statisqiques annuelles decrtiquées par mois
 * 
 * * * Version:  5.0.0
 * * * * Modified: 07/10/2016
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
include_once("include/headers.php");
include_once("include/finhead.php");
$annee_1 = (isset($_POST['annee_1']))?$_POST['annee_1']:date('Y');
?>
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php include_once("include/head.php"); ?>
   <form action="graph_annuel.php" method="post" name="annee_1">
<?php echo $lang_annee; ?>
    <select name="annee_1">
<?php for ($i=date("Y");$i>=date("Y")-13;$i--){?>
     <option value="<?php echo$i; ?>"<?php echo ($i==$annee_1)?' selected="selected"':''; ?>><?php echo $i; ?></option>
<?php } ?>
    </select>
    <input type="submit" value="<?php echo $lang_envoyer; ?>" />
   </form>
  </td>
 </tr>
 <tr>
  <td class="page" align="center">
<?php
if ($user_stat== 'n'){
 echo"<h1>$lang_statistique_droit</h1>";
 exit;
}
$liste_mois = calendrier_local_mois ();

// initialisation à 0
$recettes = array ();
$depenses = array ();
$resultat_net = array ();
reset ($liste_mois);
while (list ($numero_mois, $nom_mois) = each ($liste_mois))  {
 $recettes [$numero_mois] = array ("htva" => 0.0, "tva" => 0.0, "T.T.C" => 0.0);
 $depenses [$numero_mois] = array ("htva" => 0.0, "tva" => 0.0, "T.T.C" => 0.0);
 $resultat_net [$numero_mois] = 0.0;
}
// Recettes
$sql1 = "
SELECT  MONTH(date) numero_mois, SUM(tot_htva) htva, SUM(tot_tva) tva
FROM " . $tblpref ."bon_comm
WHERE YEAR(date) = $annee_1
GROUP BY numero_mois;
";
$req = mysql_query($sql1) or die('Erreur SQL !<br>'.$sql1.'<br>'.mysql_error());
while ($data = mysql_fetch_array($req)){
 $numero_mois = $data["numero_mois"];
 $recettes [$numero_mois] = $data;
 $recettes [$numero_mois]["T.T.C"] = $data ["htva"] + $data ["tva"];
}

// Dépenses
$sql2 = "
SELECT MONTH(date) numero_mois, SUM(prix) htva
FROM " . $tblpref ."depense
WHERE YEAR(date) = $annee_1
GROUP BY numero_mois
";
$req = mysql_query($sql2) or die('Erreur SQL !<br>'.$sql2.'<br>'.mysql_error());
while ($data = mysql_fetch_array($req)){
 $numero_mois = $data["numero_mois"];
 $depenses [$numero_mois] = $data;
}

// Résultat net
reset ($liste_mois);
while (list($numero_mois, $nom_mois) = each($liste_mois)){
 $resultat_net [$numero_mois] = $recettes [$numero_mois]["htva"]  - $depenses [$numero_mois]["htva"] ;
}
?>
<table class='page boiteaction'>
 <caption><?php echo "$lang_statistiques_annee $annee_1"; ?></caption>
 <tr>
  <th><?php echo $lang_mois; ?></th>
  <th><?php echo $lang_depenses_htva; ?></th>
  <th><?php echo $lang_ca_htva; ?></th>
  <th><?php echo $lang_resultat_net; ?></th>
  <th><?php echo $lang_ca_ttc; ?></th>
  <th rowspan="14" width="200px"><img src="graph2_ca_ttc.php?annee_1=<?php echo $annee_1; ?>"></th>
 </tr>
<?php
reset ($liste_mois);
$de=$ca=$cat=$re=0;
while (list ($numero_mois, $nom_mois) = each ($liste_mois)){
 $de+=$depenses [$numero_mois]["htva"];
 $ca+=$recettes [$numero_mois]["htva"];
 $cat+=$recettes [$numero_mois]["T.T.C"];
 $re+=$recettes [$numero_mois]["htva"] - $depenses [$numero_mois]["htva"];
?>
 <tr>
  <td class='<?php echo couleur_alternee (); ?>'><?php echo ucfirst ($nom_mois); ?></td>
  <td class='<?php echo couleur_alternee (FALSE, "nombre"); ?>'><?php echo montant_financier ($depenses [$numero_mois]["htva"]); ?></td>
  <td class='<?php echo couleur_alternee (FALSE, "nombre"); ?>'><?php echo montant_financier ($recettes [$numero_mois]["htva"]); ?></td>
  <td class='<?php echo couleur_alternee (FALSE, "nombre"); ?>'><?php echo montant_financier ($recettes [$numero_mois]["htva"] - $depenses [$numero_mois]["htva"]); ?></td>
  <td class='<?php echo couleur_alternee (FALSE, "nombre"); ?>'><?php echo montant_financier ($recettes [$numero_mois]["T.T.C"]); ?></td>
 </tr>
<?php } ?>
 <tr>
  <td class='totaltexte'><?php echo $lang_annee; ?></td>
  <td class='totalmontant'><?php echo montant_financier ($de); ?></td>
  <td class='totalmontant'><?php echo montant_financier ($ca); ?></td>
  <td class='totalmontant'><?php echo montant_financier ($re); ?></td>
  <td class='totalmontant'><?php echo montant_financier ($cat); ?></td>
 </tr>
</table>
<br>
<?php
include("graph_ca.php");
echo "<br>";
include("graph_dep.php");
echo "<br>";
include("graph_ben.php");
?>
  </td>
 </tr> <!---->
 <tr>
  <th>
   <center>
    <div style="display:inline-block;width:33%;"><?php echo ucfirst($lang_commandé); ?><br /><img src="graph2_ca.php?annee_1=<?php echo $annee_1; ?>"></div>
    <div style="display:inline-block;width:33%;"><?php echo ucfirst($lang_facturé); ?><br /><img src="graph2_ca_fact.php?annee_1=<?php echo $annee_1; ?>"></div>
    <div style="display:inline-block;width:33%;"><?php echo ucfirst($lang_acquitté); ?><br /><img src="graph2_ca_payes.php?annee_1=<?php echo $annee_1; ?>"></div>
   </center>
<?php #include("graph_circulaire_annuel.php"); ?>
  </th>
 </tr> <!---->
 <tr>
  <td>
<?php
$aide='stats';
include("help.php");
include_once("include/bas.php");
?>
  </td>
 </tr>
</table>
</body>
</html>
