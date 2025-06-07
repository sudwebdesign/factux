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
 * File Name: edit_lot.php
 * 	Formulaire d'edition des lots
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
$num_get=isset($_GET['num'])?$_GET['num']:"";
//POUR LE RETOUR
$mois_1=isset($_GET['mois_1'])?$_GET['mois_1']:date("m");
$annee_1=isset($_GET['annee_1'])?$_GET['annee_1']:date("Y");

$sql1 = "SELECT prod
FROM " . $tblpref .('lot
WHERE num = ' . $num_get);
$req1 = mysql_query($sql1) or die('Erreur SQL1 !<br>'.$sql1.'<br>'.mysql_error());
$data = mysql_fetch_array($req1);
$produit= $data['prod'];
$sql = "
SELECT ingr, fourn, fourn_lot, num
FROM " . $tblpref ."cont_lot
WHERE num_lot= {$num_get}
";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error())
?>
   <form action="edit_lot_suite.php" method="post" name="lot" id="lot">
    <table class="page boiteaction">
     <caption><?php echo $lang_edit_lot; ?></caption>
     <tr>
      <th colspan="3" align="center"><?php echo $lang_produit; ?></th>
     </tr>
     <tr>
      <td class="texte1"><input name="num_lot" type="hidden" value="<?php echo $num_get; ?>"></td>
      <td class="texte1"><input name="prod" type="text" id="prod" size="27" maxlength="25" value="<?php echo $produit ?>"></td>
      <td class="texte1"></td>
     </tr>
     <tr>
      <th><?php echo $lang_ingred; ?></th>
      <th><?php echo $lang_fournisseur; ?></th>
      <th><?php echo $lang_lot_four; ?></th>
     </tr>
<?php
$tab_fourn[] = 0;
$tab_ingr[] = 0;
$tab_fourn_lot[] = 0;
$tab_num[] = 0;
while($data = mysql_fetch_array($req)){
 $ingr= $data['ingr'];
 $fourn = $data['fourn'];
 $fourn_lot = $data['fourn_lot'];
 $num = $data['num'];
 $tab_num[] = $num ;
 $tab_ingr[]= $ingr;
 $tab_fourn[] = $fourn;
 $tab_fourn_lot[] = $fourn_lot;
}
for ($i=1; $i<13; $i++) {
?>
     <tr class='<?php echo couleur_alternee (); ?>'>
      <td>
       <input name="<?php echo 'ing_' . $i ?>" type="text" size="27" maxlength="20" value='<?php echo @$tab_ingr[$i]; ?>' />
      </td>
      <td>
       <input name="<?php echo 'four_' . $i ?>" type="text"  size="27" maxlength="15" value='<?php echo @$tab_fourn[$i]; ?>' />
      </td>
      <td>
       <input name="<?php echo 'lot_four_' . $i ?>" type="text" size="27" maxlength="20" value='<?php echo @$tab_fourn_lot[$i]; ?>' />
       <input name="<?php echo 'num_cont_bon_' . $i;?>" type="hidden" value='<?php echo @$tab_num[$i]; ?>' />
      </td>
     </tr>
<?php } ?>
     <tr>
      <td colspan="3" class="submit">
       <center>
        <input type="submit" name="Submit" value="<?php echo $lang_modifier; ?>">
        &nbsp;&nbsp;
        <input type="reset" name="Submit2" value="<?php echo $lang_retablir; ?>">
       </center>
      </td>
     </tr>
     <input type="hidden" name="mois_1" value="<?php echo $mois_1; ?>" >
     <input type="hidden" name="annee_1" value="<?php echo $annee_1; ?>" >
    </table>
   </form>
  </td>
 </tr>
 <tr>
  <td>
<?php
$aide='lots';
include(__DIR__ . "/help.php");
include_once(__DIR__ . "/include/bas.php");
?>
  </td>
 </tr>
</table>
</body>
</html>
