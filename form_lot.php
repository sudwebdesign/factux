<?php
/*
 * Factux le facturier libre
 * Copyright (C) 2003-2005 Guy Hendrickx, 2017~ Thomas Ingles
 *
 * Licensed under the terms of the GNU  General Public License:
 *   http://opensource.org/licenses/GPL-3.0
 *
 * For further information visit:
 *   http://factux.free.fr
 *
 * File Name: form_lot.php
 *  Formulaire de creation des lots
 *
 * * * * Version:  8.0.0
 * * * * Modified: 07/06/2025
 *
 * File Authors:
 *   Guy Hendrickx
 *.
 */
include_once(__DIR__ . "/include/headers.php");
include_once(__DIR__ . "/include/finhead.php");
?>
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php include_once(__DIR__ . "/include/head.php"); ?>
<?php
if ($user_com == 'n') {
 echo sprintf('<h1>%s</h1>', $lang_commande_droit);
 include_once(__DIR__ . "/include/bas.php");
 exit;
}
?>
   <form action="insert_lot.php" method="post" name="lot" id="lot"  >
    <table class="page boiteaction">
     <caption><?php echo $lang_cr_lot; ?></caption>
     <tr>
      <th colspan="3" align="center"><?php echo $lang_produit; ?></th>
     </tr>
     <tr>
      <td class="texte1"></td>
      <td class="texte1"><input name="prod" type="text" id="prod" size="27" maxlength="25"></td>
      <td class="texte1"></td>
     </tr>
     <tr>
      <th><?php echo $lang_ingred; ?></th>
      <th><?php echo$lang_fournisseur; ?></th>
      <th><?php echo $lang_lot_four; ?></th>
     </tr>


<?php for ($i=1;$i<13;$i++){ ?>
     <tr class='<?php echo couleur_alternee (); ?>'>
      <td><input name="ing_<?php echo $i; ?>" type="text" size="27" maxlength="20"></td>
      <td><input name="four_<?php echo $i; ?>" type="text" size="27" maxlength="15"></td>
      <td><input name="lot_four_<?php echo $i; ?>" type="text" size="27" maxlength="20"></td>
     </tr>
<?php } ?>
     <tr>
      <td class="submit" colspan="3">
       <input type="submit" name="Submit" value="<?php echo $lang_envoyer; ?>">
       &nbsp;&nbsp;
       <input name="reset" type="reset" id="reset" value="<?php echo $lang_effacer; ?>">
      </td>
     </tr>
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
