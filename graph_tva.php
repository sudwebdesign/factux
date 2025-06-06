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
 * File Name: graph_tva.php
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
$annee_1 =(isset($_POST['annee_1'])&&$_POST['annee_1'] !='')?$_POST['annee_1']:date("Y");
$fact=(isset($_POST['fact']))?$_POST['fact']:null;
?>
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php
include_once("include/head.php");
if ($user_stat== 'n'){
 echo"<h1>$lang_statistique_droit</h1>";
 include_once("include/bas.php");
 exit;
}

?>
   <form action="graph_tva.php" method="post" name="annee">
<?php echo $lang_annee; ?>
    <select name="annee_1">
     <option value="<?php echo $lang_toutes; ?>"<?php echo ($lang_toutes==$annee_1)?' selected="selected"':''; ?>><?php echo ucfirst($lang_toutes); ?></option>
<?php for ($i=date("Y");$i>=date("Y")-13;$i--){?>
     <option value="<?php echo$i; ?>"<?php echo ($i==$annee_1)?' selected="selected"':''; ?>><?php echo $i; ?></option>
<?php } ?>
    </select>
     <input type="submit" value="<?php echo $lang_envoyer; ?>" /><input alt="<?php echo $lang_au_reel; ?>" type="checkbox" name="fact"<?php echo ($fact)?' checked="checked"':''; ?> /> 
   </form>
  </td>
 </tr>
 <tr>
  <td class="page" align="center">
<?php
// initialisation à 0
$liste_mois = calendrier_local_mois ();$recettes = array ();
$depenses = array ();
$resultat_net = array ();
//~ reset ($liste_mois);
foreach($liste_mois as $numero_mois => $nom_mois){
 $recettes [$numero_mois] = array ("htva" => 0.0, "tva" => 0.0, "ttc" => 0.0);
 $depenses [$numero_mois] = array ("htva" => 0.0, "tva" => 0.0, "ttc" => 0.0);
 #$avoirs [$numero_mois] = array ("htva" => 0.0, "tva" => 0.0, "ttc" => 0.0);
 $resultat_net [$numero_mois] = 0.0;
}


// Recettes commandes/*
$sql1 = "
SELECT  MONTH(date) numero_mois, SUM(tot_htva) htva, SUM(tot_tva) tva
FROM " . $tblpref ."bon_comm
".(($annee_1!=$lang_toutes)?"WHERE YEAR(date) = $annee_1":"")."
GROUP BY numero_mois
";

if($fact)//réelles
$sql1 = "
SELECT  MONTH(date_fact) numero_mois, SUM(total_fact_h) as htva, SUM(total_fact_ttc) as ttc
FROM " . $tblpref ."facture
".(($annee_1!=$lang_toutes)?"WHERE YEAR(date_fact) = $annee_1 AND ":"WHERE ")."payement != 'non'
GROUP BY numero_mois
";
$req = mysql_query($sql1) or die('Erreur SQL !<br>'.$sql1.'<br>'.mysql_error());
while ($data = mysql_fetch_array($req)){
 $numero_mois = $data["numero_mois"];
 $recettes[$numero_mois] = $data;
 #$recettes[$numero_mois]["ttc"] = $data["ttc"];
 $recettes[$numero_mois]["tva"] = ($fact)?$data["ttc"]-$data["htva"]:$data["tva"];
}

// Dépenses
$sql2 = "
SELECT MONTH(date) numero_mois, SUM(prix) as htva, SUM(mont_tva) as tva
FROM " . $tblpref ."depense
".(($annee_1!=$lang_toutes)?"WHERE YEAR(date) = $annee_1":"")."
GROUP BY numero_mois
";
$req = mysql_query($sql2) or die('Erreur SQL !<br>'.$sql2.'<br>'.mysql_error());
while ($data = mysql_fetch_array($req)){
 $numero_mois = $data["numero_mois"];
 $depenses[$numero_mois] = $data;
 #$depenses[$numero_mois]["ttc"] = $data["htva"] + $data["tva"];
 $depenses[$numero_mois]["tva"] = $data["tva"];
}

/*//Avoirs OK 3.04
$sqlAv = "
SELECT  MONTH(date_avoir) numero_mois, SUM(total_avoir_ht) htva, SUM(total_avoir_tva) tva, " . $tblpref ."client.num_tva 
FROM " . $tblpref ."avoir
LEFT JOIN " . $tblpref ."client ON " . $tblpref ."client.num_client = " . $tblpref ."avoir.num_client
".(($annee_1!=$lang_toutes)?"WHERE YEAR(date_avoir) = $annee_1":"")."
GROUP BY numero_mois
";
//AND MONTH(date) = '$numero'
$reqAv = mysql_query($sqlAv)or die('Erreur SQLav !<br>'.$sqlAv.'<br>'.mysql_error());
while ($dataAv = mysql_fetch_array($reqAv)){
 $numero_mois = $dataAv["numero_mois"];
 $avoirs [$numero_mois] = $dataAv;
 $avoirs [$numero_mois]["tva"] = $dataAv ["tva"];
}
*/
// Résultat net

//~ reset ($liste_mois);
$re=$de=$av=0;
foreach($liste_mois as $numero_mois => $nom_mois){
 $resultat_net[$numero_mois] = $recettes[$numero_mois]["tva"] - $depenses[$numero_mois]["tva"];/* + $avoirs[$numero_mois]["tva"]*/
 $re += $recettes[$numero_mois]["tva"];
 $de += $depenses[$numero_mois]["tva"];
 #$av += ;$avoirs[$numero_mois]["tva"];
}
$titre_recette = $lang_commandes;
if($fact)//réelles
 $titre_recette = $lang_factures;
?>
  <table class="page boiteaction">
   <caption><?php echo "$lang_montant $lang_total $lang_tva $lang_par $lang_mois $lang_de ".(($annee_1!=$lang_toutes)?"$lang_l_année $annee_1":" $lang_toutes_les_années")." ".(($fact)?" $lang_au_reel":""); ?></caption>
   <tr>
    <th>&nbsp;</th>
    <th><?php echo "$lang_tva $lang_depenses"; ?></th>
    <th><?php echo "$lang_tva $titre_recette"; ?></th>
    <!--<th><?php //echo $lang_resultat_net; ?></th>
    <th><?php //echo "$lang_tva Avoir" ?></th>-->
    <th><?php echo "$lang_tva $lang_total_mois"; ?></th>
   </tr>
<?php
//~ reset ($liste_mois);
foreach($liste_mois as $numero_mois => $nom_mois){
?>
   <tr>
    <td class='<?php echo couleur_alternee (); ?>'><?php echo ucfirst ($nom_mois); ?></td>
    <td class='<?php echo couleur_alternee (FALSE, "nombre"); ?>'><?php echo montant_financier ($depenses [$numero_mois]["tva"]); ?></td>
    <td class='<?php echo couleur_alternee (FALSE, "nombre"); ?>'><?php echo montant_financier ($recettes [$numero_mois]["tva"]); ?></td>
    <!--<td class='<?php //echo couleur_alternee (FALSE, "nombre"); ?>'><?php //echo montant_financier ($recettes [$numero_mois]["ttc"]); ?></td>
    <td class='<?php //echo couleur_alternee (FALSE, "nombre"); ?>'><?php //echo montant_financier ($avoirs [$numero_mois]["tva"]); ?></td>-->
    <td class='<?php echo couleur_alternee (FALSE, "nombre"); ?>'><?php echo montant_financier ($recettes [$numero_mois]["tva"] - $depenses [$numero_mois]["tva"] /*+ $avoirs [$numero_mois]["tva"]*/); ?></td>
   </tr>
<?php } ?>
   <tr>
    <td class='totaltexte'><?php echo ucfirst ($lang_total_annee); ?></td>
    <td class='totalmontant'><?php echo montant_financier ($de); ?></td>
    <td class='totalmontant'><?php echo montant_financier ($re); ?></td>
    <!--<td class='totalmontant'><?php //echo montant_financier ($recettes [$numero_mois]["ttc"]); ?></td>
    <td class='totalmontant'><?php //echo montant_financier ($av); ?></td>-->
    <td class='totalmontant'><?php echo montant_financier ($re - $de /*+ $av*/); ?></td>
   </tr>
  </table>
 </td>
</tr>
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
