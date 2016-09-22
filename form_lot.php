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
 * File Name: form_lot.php
 * 	Formulaire de creation des lots
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
<td  class="page" align="center">
<form action="insert_lot.php" method="post" name="lot" id="lot"  >
        <table class="boiteaction">
          <caption>
          <?php echo "$lang_cr_lot"; ?>
          </caption>
					<tr> 
            <td class="texte1"> <?php echo "$lang_produit"; ?> </td>
            <td class="texte1"> <input name="prod" type="text" id="prod" size="40" maxlength="40"> 
						<td class="texte1">
            </td>
          </tr>
          <tr> 
					<th><?php echo "$lang_ingred"; ?> </th>
					<th><?php echo"$lang_fournisseur"; ?> </th>
					<th><?php echo "$lang_lot_four"; ?> </th>
					</tr>
					<tr>
            <td class="texte0"><input name="ing_1" type="text"  size="40" maxlength="40">
					<td class="texte0"><input name="four_1" type="text"  size="40" maxlength="40">
					<td class="texte0"><input name="lot_four_1" type="text" size="40">
					</tr>
					
					<tr>
            <td class="texte1"><input name="ing_2" type="text"  size="40" maxlength="40">
					<td class="texte1"><input name="four_2" type="text"  size="40" maxlength="40">
					<td class="texte1"><input name="lot_four_2" type="text" size="40">
					</tr>
					
					<tr>
            <td class="texte0"><input name="ing_3" type="text"  size="40" maxlength="40">
					<td class="texte0"><input name="four_3" type="text"  size="40" maxlength="40">
					<td class="texte0"><input name="lot_four_3" type="text" size="40">
					</tr>
					
					<tr>
            <td class="texte1"><input name="ing_4" type="text"  size="40" maxlength="40">
					<td class="texte1"><input name="four_4" type="text"  size="40" maxlength="40">
					<td class="texte1"><input name="lot_four_4" type="text" size="40">
					</tr>
					
					<tr>
            <td class="texte0"><input name="ing_5" type="text"  size="40" maxlength="40">
					<td class="texte0"><input name="four_5" type="text"  size="40" maxlength="40">
					<td class="texte0"><input name="lot_four_5" type="text" size="40">
					</tr>
					
					<tr>
            <td class="texte1"><input name="ing_6" type="text"  size="40" maxlength="40">
					<td class="texte1"><input name="four_6" type="text"  size="40" maxlength="40">
					<td class="texte1"><input name="lot_four_6" type="text" size="40">
					</tr>
					
					<tr>
            <td class="texte0"><input name="ing_7" type="text"  size="40" maxlength="40">
					<td class="texte0"><input name="four_7" type="text"  size="40" maxlength="40">
					<td class="texte0"><input name="lot_four_7" type="text" size="40">
					</tr>
					
					<tr>
            <td class="texte1"><input name="ing_8" type="text"  size="40" maxlength="40">
					<td class="texte1"><input name="four_8" type="text"  size="40" maxlength="40">
					<td class="texte1"><input name="lot_four_8" type="text" size="40">
					</tr>
					
					<tr>
            <td class="texte0"><input name="ing_9" type="text"  size="40" maxlength="40">
					<td class="texte0"><input name="four_9" type="text"  size="40" maxlength="40">
					<td class="texte0"><input name="lot_four_9" type="text" size="40">
					</tr>
					
					<tr>
            <td class="texte1"><input name="ing_10" type="text"  size="40" maxlength="40">
					<td class="texte1"><input name="four_10" type="text"  size="40" maxlength="40">
					<td class="texte1"><input name="lot_four_10" type="text" size="40">
					</tr>
					
					<tr>
            <td class="texte0"><input name="ing_11" type="text"  size="40" maxlength="40">
					<td class="texte0"><input name="four_11" type="text"  size="40" maxlength="40">
					<td class="texte0"><input name="lot_four_11" type="text" size="40">
					</tr>
					<tr>
					<td class="submit"><input type="submit" />
					<td colspan="2"class="submit"><input type="reset" />
					
					</table>
					</form>
					</td></tr><tr><td>

<?php
include("help.php");
include_once("include/bas.php");
?></table>
</body>
</html>
