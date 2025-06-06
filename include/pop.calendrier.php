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
 * File Name: pop.calendrier.php
 * 	Calendrier multilingue de sélèction d'une date.
 *
 * * Version:  5.0.0
 * * * Modified: 07/10/2016
 *
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
ini_set('session.save_path', '../include/session');
session_cache_limiter('private');
session_start();
$anneeMin = 1;
$anneeMax = 3;

$checkzero = "true";
$format = "/";
$ordre = array("j", "m", "a");
$affichage="fr";

/**
 ---------------------------------------------------------------------------------------------
 * Le reste du code PHP, à priori, y'a plus besoin de le toucher. Par contre, y'a la CSS juste
 * un peu plus bas. Celle-là est parfaitement modifiable (c'est d'ailleurs recommandé, c'est
 * toujours mieux de personnaliser un peu le truc)
 */
$l=(!empty($_SESSION['lang']))?$_SESSION['lang']:'fr';
include('lang_days_months.php');

for($z=0;$z<12;$z++){
 if($z<7)
  $nomj[$z] = $jc[$z][$l];
 $nomm[$z] = $jm[$z][$l];
}

$ajd = getdate();

$frm = $_GET["frm"];
$champ = $_GET["ch"];
$link = "?frm=".$frm."&amp;ch=".$champ;

if (isset($_POST["mois"])){
    $mois = $_POST["mois"];
    $annee = $_POST["annee"];
}else{
    $mois = $ajd["mon"];
    $annee = $ajd["year"];
}

$aujourdhui = array($ajd["mday"], $ajd["mon"], $ajd["year"]);

$moisCheck = $mois + 1;
$anneeCheck = $annee;
if ($moisCheck > 12){
 $moisCheck = 1;
 $anneeCheck = $annee + 1;
}

$dernierJour = strftime("%d", mktime(0, 0, 0, $moisCheck, 0, $anneeCheck));
$premierJour = date("w", mktime(0, 0, 0, $mois, 1, $annee));

if ($affichage != "en"){
 //On modifie la position du premier jour suivant la disposition des jours qu'on veut
 $origine = 1;
 $j = $origine;
 for ($i = 0; $i < count($nomj); $i++){
  if ($j >= count($nomj)){
   $j = 0;
  }
  $temp[] = $nomj[$j];
  $j++;
 }
 $nomj = $temp;
 //On décale le 1er jour en conséquence
 $premierJour--;
 if ($premierJour < 0){
  $premierJour = 6;
 }
}

/**
 * Renvoie une string qui vaut selected ou non, pour un champs SELECT
 *
 * @param   integer     $temps      L'année ou le mois choisi
 * @param   integer     $i          L'annee en cours
 * @return  string                  La string nécessaire pour sélectionner une OPTION
 */
function get_selected($temps, $i){
 $selected = "";
 if ($temps == $i){
  $selected = " selected=\"selected\"";
 }
 return $selected;
}

/**
 * Renvoie une string représentant l'appel à une classe CSS
 *
 * Pour les valeurs par défaut :
 *      - 1 : ' class="aut"'
 *      - 2 : ''
 *
 * @param   integer     $jour       Le jour en cours
 * @param   integer     $index      La valeur par défaut de la string
 * @return  string                  La string nécessaire pour appeller la classe CSS voulue
 */
function get_classe($jour, $index, $mode){
 switch ($index) {
  case 1:
   $classe = " class=\"aut\"";
   break;
  default:
   $classe = "";
 }
 switch ($mode) {
  case "en":
   $x1 = 0;
   $x2 = 6;
   break;
  default:
   $x1 = 6;
   $x2 = 5;
 }
 if ($jour == $x1){
  $classe = " class=\"dim\"";
 }elseif ($jour == $x2){
  $classe = " class=\"sam\"";
 }
 return $classe;
}

/**
 * Détermine si on est sur un dimanche ou un samedi, à partir du 1er du mois
 *
 * @param   array       $ajd            Le jour, mois et année de maintenant
 * @param   integer     $annee          L'année en cours
 * @param   integer     $mois           Le mois en cours
 * @param   integer     $jour           Le jour en cours
 * @param   integer     $cptJour        Le numéro du jour en cours de la semaine
 * @param   integer     $premierJour    Le numéro du 1er jour (dans la semaine) du mois
 * @param   array       $nomj           Le tableau des noms des jours
 * @param   integer     $prems          Le numéro du dernier jour de la semaine du mois précédent
 * @param   string      $mode           Le mode d'affichage du calendrier ("fr" ou "en")
 * @return  string                      La string nécessaire pour appeller la classe CSS voulue
 */
function get_classeJour($ajd, $annee, $mois, $jour, $cptJour, $premierJour, $nomj, $prems, $mode){
 $classe = "";
 if ($mode == "en"){
  if (($cptJour == 0 && $jour > 1) || ($jour == 1 && $premierJour == 0)){
   $classe = " class=\"dim\"";
  }elseif ($cptJour == 6 || (count($nomj) - $jour == $prems)){
   $classe = " class=\"sam\"";
  }
 }else{
  if ($cptJour == 6 || (count($nomj) - $jour == $prems)){
   $classe = " class=\"dim\"";
  }else if ($cptJour == 5 || (count($nomj) - $jour - 1 == $prems)){
   $classe = " class=\"sam\"";
  }
 }
 if ($jour == $ajd[0] && $mois == $ajd[1] && $annee == $ajd[2]){
  $classe = " class=\"ajd\"";
 }
 return $classe;
}

/**
 * Détermine si on est sur un samedi, lorsqu'on complète le tableau
 *
 * @param   integer     $i              Le jour en cours
 * @param   integer     $cptJour        Le numéro du dernier jour (dans la semaine) du mois
 * @param   string      $mode           Le mode d'affichage du calendrier ("fr" ou "en")
 * @return  string                      La string nécessaire pour appeller la classe CSS voulue
 */
function get_classeJourReste($i, $cptJour, $mode){
 $classe = "";
 if ($mode == "en"){
  if ($i == (7 - $cptJour) - 1){
   $classe = " class=\"sam\"";
  }
 }else{
  if ($i == (6 - $cptJour) - 1){
   $classe = " class=\"sam\"";
  }else if ($i == (7 - $cptJour) - 1){
   $classe = " class=\"dim\"";
  }
 }
 return $classe;
}

?>
<html>
<head>
 <title>Calendrier</title>
 <meta charset="utf-8" />
 <style>
  body, table, select {
   font-family: Arial;
   font-size: 11px;
  }

  body {
   background-image: url("../image/calendrier.gif");
   background-position: center center;
   background-repeat: no-repeat;
  }

  #calendar {
   width: 100%;
   border-collapse: collapse;
   border-right: 1px solid #999999;
   border-bottom: 1px solid #999999;
   margin: 0;
   padding: 0;
   text-align: center;
   font-size: 110%;
  }

  #calendar th {
   border-left: 1px solid #999999;
   border-top: 1px solid #999999;
   padding: 0.5em;
   font-weight: bold;
   width: 14%;
  }

  #calendar td {
   border-left: 1px solid #999999;
   border-top: 1px solid #999999;
   margin: 0;
   padding: 0;
  }

  #calendar td a {
   display: block;
   text-decoration: none;
   color: #FF0000;
  }

  #calendar td a:hover {
   background-color: #E99042;
   color: #660000;
  }

  .dim{
   background-color: #D8CDE8;
  }

  .aut {
   background-color: #EEEEEE;
  }

  .sam {
   background-color: #DDD69F;
  }

  .ajd {
   background-color: #EEEE44;
  }

  #calendrier {
   width: 100%;
   margin: 0;
   text-align: center;
  }

  #calendrier select {
   width: 49%;
   margin: 0;
   padding: 4px;
  }
  </style>
 </head>
 <body>
  <form id="calendrier" method="post" action="<?php echo $link; ?>">
   <select name="mois" id="mois" onChange="reload(this.form)">
<?php
/**
 * Affichage des mois
 */
for ($i = 0; $i < count($nomm); $i++){
 $selected = get_selected($mois - 1, $i);
?>
    <option value="<?php echo ($i + 1); ?>"<?php echo $selected; ?>><?php echo $nomm[$i]; ?></option>
<?php
}
?>
   </select>
   <select name="annee" id="annee" onChange="reload(this.form)">
<?php
/**
 * Affichage des années
 */
for ($i = $ajd["year"] - $anneeMin; $i < $ajd["year"] + $anneeMax; $i++){
 $selected = get_selected($annee, $i);
?>
    <option value="<?php echo $i; ?>"<?php echo $selected; ?>><?php echo $i; ?></option>
<?php
}
?>
   </select>
  </form>
  <table id="calendar">
   <tr>
<?php
/**
 * Affichage du nom des jours
 */
for ($jour = 0; $jour < 7; $jour++){
 $classe = get_classe($jour, 1, $affichage);
?>
        <th <?php echo $classe; ?>><?php echo $nomj[$jour]; ?></th>
<?php
}
?>
    </tr>
    <tr>
<?php
/**
 * Affichage des cellules vides en début de mois, s'il y en a
 */
for ($prems = 0; $prems < $premierJour; $prems++){
 $classe = get_classe($prems, 2, $affichage);
?>
     <td <?php echo $classe; ?>>&nbsp;</td>
<?php
}
/**
 * Affichage des jours du mois
 */
$cptJour = 0;
for ($jour = 1; $jour <= $dernierJour; $jour++){
 $classe = get_classeJour($aujourdhui, $annee, $mois, $jour, $cptJour, $premierJour, $nomj, $prems, $affichage);
 $cptJour++;
?>
     <td <?php echo $classe; ?>><a href="#" onClick="submitDate(<?php echo $jour; ?>)"><?php echo $jour; ?></a></td>
<?php
 if (is_int(($jour + $prems) / 7)){
     $cptJour = 0;
?>
    </tr>
<?php
  if ($jour < $dernierJour){
?>
    <tr>
<?php
  }
 }
}
/**
 * Affichage des cellules vides en fin de mois, s'il y en a
 */
if ($cptJour != 0){
 for ($i = 0; $i < (7 - $cptJour); $i++){
  $classe = get_classeJourReste($i, $cptJour, $affichage);
?>
     <td <?php echo $classe; ?>>&nbsp;</td>
<?php
    }
?>
    </tr>
<?php
}
?>
   </table>
<script type="text/javascript">
 var checkzero = <?php echo $checkzero; ?>;
 var format = "<?php echo $format; ?>";
 var ordre = new Array("<?php echo strtoupper(implode('", "', $ordre)); ?>");

 /**
  * Reload la fenêtre avec les nouveaux mois et année choisis
  *
  * @param   object   frm  L'object document du formulaire
  */
 function reload(frm){
  var mois = frm.elements["mois"];
  var annee = frm.elements["annee"];
  var index1 = mois.options[mois.selectedIndex].value;
  var index2 = annee.options[annee.selectedIndex].value;
  frm.submit();
 }

 /**
  * Ajoute un zéro devant le jour et le mois s'ils sont plus petit que 10
  *
  * @param   integer  jour  Le numéro du jour dans le mois
  * @param   integer  mois  Le numéro du mois
  */
 function checkNum(jour, mois){
  tab = new Array();
  tab[0] = jour;
  tab[1] = mois;
  if (this.checkzero){
   if (jour < 10){
    tab[0] = "0" + jour;
   }
   if (mois < 10){
    tab[1] = "0" + mois;
   }
  }
  return tab;
 }

 /**
  * Créé la string de retour et la renvoie à la page d'appel
  *
  * C'est ici que la string est créé. C'est également ici que le champ du formulaire
  * de la page d'appel reçoit la valeur. La fenêtre s'auto-fermera ensuite toute
  * seule comme une grande.
  * Paisible est l'étudiant qui comme la rivière peut suivre son cours sans quitter son lit...
  *
  * @param   integer  jour  Le numéro du jour dans le mois
  */
 function submitDate(jour){
  tab = this.checkNum(jour, <?php echo $mois; ?>);
  jour = tab[0];
  mois = tab[1];
  if (this.ordre[0] && this.ordre[0] == "M"){
   if (this.ordre[1] && this.ordre[1] == "A"){
    val = mois + this.format + "<?php echo $annee; ?>" + this.format + jour;
   }else{
    val = mois + this.format + jour + this.format + "<?php echo $annee; ?>";
   }
  }else if (this.ordre[0] && this.ordre[0] == "J"){
   if (this.ordre[1] == "A"){
    val = jour + this.format + "<?php echo $annee; ?>" + this.format + mois;
   }else{
    val = jour + this.format + mois + this.format + "<?php echo $annee; ?>";
   }
  }else{
   if (this.ordre[1] && this.ordre[1] == "J"){
    val = "<?php echo $annee; ?>" + this.format + jour + this.format + mois;
   }else{
    val = "<?php echo $annee; ?>" + this.format + mois + this.format + jour;
   }
  }
  window.opener.document.<?php echo $frm.".elements[\"".$champ."\"]"; ?>.value = val;
  window.close();
 }
</script>
</body>
</html>
