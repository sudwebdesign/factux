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
 * File Name: voir_lot.php
 * 	montre les lots
 *
 * * * Version:  5.0.0
 * * * * Modified: 07/10/2016
 *
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
include_once(__DIR__ . "/include/headers.php");
include_once(__DIR__ . "/include/finhead.php");
?>
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php
include_once(__DIR__ . "/include/head.php");
if ($user_com == 'n') {
 echo sprintf('<h1>%s</h1>', $lang_commande_droit);
 include_once(__DIR__ . "/include/bas.php");
 exit;
}
$num_lot=isset($_GET['num'])?$_GET['num']:"";
$sql = "
SELECT ingr, fourn, fourn_lot
FROM " . $tblpref ."cont_lot
WHERE num_lot = {$num_lot}
";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
?>
<?php
if ($num_lot > '0') {
$mois_1=isset($_GET['mois_1'])?$_GET['mois_1']:date("m");
$annee_1=isset($_GET['annee_1'])?$_GET['annee_1']:date("Y");
?>
   <table width='760' border='0' class='page' align='center'>
    <caption><?php echo sprintf('%s %s', $lang_cont_lot, $num_lot); ?></caption>
    <tr>
     <th><?php echo $lang_ingred; ?></th>
     <th><?php echo $lang_fournisseur; ?></th>
     <th><?php echo $lang_lot_four; ?></th>
    </tr>
<?php
$c=0;
while($data = mysql_fetch_array($req)){
  $ingr = $data['ingr'];
  $fourn = $data['fourn'];
  $fourn_lot = $data['fourn_lot'];
 $line = $c++ & 1 ? "0" : "1";
?>
    <tr class="texte<?php echo $line; ?>" onmouseover="this.className='highlight'" onmouseout="this.className='texte<?php echo $line; ?>'">
     <td class='<?php echo couleur_alternee (); ?>'><?php echo $ingr; ?></td>
     <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo $fourn; ?></td>
     <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo $fourn_lot; ?></td>
    </tr>
<?php } ?>
   </table>
  </td>
 <tr>
  <td class="page">
   <a href="edit_lot.php?num=<?php echo $num_lot; ?>&amp;mois_1=<?php echo $mois_1; ?>&amp;annee_1=<?php echo $annee_1; ?>"><?php echo $lang_editer; ?></a>
   &nbsp;&nbsp;
   <a href="lister_lot.php?mois_1=<?php echo $mois_1; ?>&amp;annee_1=<?php echo $annee_1; ?>"><?php echo $lang_lister; ?></a>
  </td>
 </tr>
 </tr>
 <tr>
  <td>
<?php
}else{
 echo sprintf('<h2>%s</h2>', $lang_lot_zero);
}
$aide='admin';
include(__DIR__ . "/help.php");
include_once(__DIR__ . "/include/bas.php");
?>
  </td>
 </tr>
</table>
</body>
</html>
