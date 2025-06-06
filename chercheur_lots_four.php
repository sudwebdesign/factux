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
 * File Name: chercher_lot_fourn.php.php
 * 	resultat d'une recherche de lot a partir d'un num de lot fournisseur
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
?>
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php
include_once("include/head.php");
$lot_fou=isset($_POST['lot_fou'])?(int)$_POST['lot_fou']:"";
if(!is_int($lot_fou)){
  echo"<h1>*Erreur $lang_num_lot! Utiliser uniquement les chiffres.</h1>";
  $lot_fou=-1;
}
$sql = "
SELECT fourn_lot, num_lot, ingr, DATE_FORMAT(date,'%m') AS mois_1, DATE_FORMAT(date,'%Y') AS annee_1
FROM " . $tblpref ."cont_lot
LEFT JOIN " . $tblpref ."lot  on " . $tblpref ."cont_lot.num_lot = " . $tblpref ."lot.num
WHERE `fourn_lot`LIKE '%$lot_fou%'
ORDER BY num_lot DESC
";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$lot_fou=($lot_fou==-1)?'*':$lang_numero.$lot_fou;
?>
 <table width="760" border="0" class="page" align="center">
  <caption>Les lots suivants contiennent le lot fournisseur <?php echo "$lot_fou"; ?> </caption>
  <tr>
   <th><?php echo $lang_ingred; ?></th>
   <th><?php echo $lang_num_lot; ?></th>
   <th><?php echo $lang_num_lot.' '.$lang_fournisseur; ?></th>
   <th colspan="2"><?php echo $lang_action; ?></th>
  </tr>
<?php
$c=0;
while($data = mysql_fetch_array($req)){
  $ingr = $data['ingr'];
  $num_lot = $data['num_lot'];
  $fourn_lot = $data['fourn_lot'];
  $mois_1 = $data['mois_1'];
  $annee_1 = $data['annee_1'];
 if($c++ & 1){
  $line="0";
 }else{
  $line="1";
 }
?>
  <tr class="texte<?php echo $line; ?>" onmouseover="this.className='highlight'" onmouseout="this.className='texte<?php echo $line; ?>'">
   <td class='<?php echo couleur_alternee (); ?>'><?php echo $ingr; ?></td>
   <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo $num_lot; ?></td>
   <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo $fourn_lot; ?></td>
   <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'>
    <a href='voir_lot.php?num=<?php echo $num_lot; ?>&amp;mois_1=<?php echo $mois_1; ?>&amp;annee_1=<?php echo $annee_1; ?>'><?php echo $lang_voir; ?></a>
   </td>
   <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'>
    <a href='chercheur_lots.php?num_lot=<?php echo $num_lot; ?>'><?php echo $lang_voir_bons_du_lot; ?></a>
   </td>
  </tr>
<?php } ?>
  <tr><td colspan="10" class="td2"></td></tr>
 </table>
  </td>
 </tr>
 <tr>
  <td>
<?php
$aide='admin';
include("help.php");
include_once("include/bas.php");
?>
  </td>
 </tr>
</table>
</body>
</html>
