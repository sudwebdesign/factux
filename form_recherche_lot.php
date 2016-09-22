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
 * File Name: form_recherche_lot.php
 * 	formulaire de recherche de lot
 * 
 * * * Version:  1.1.5
 * * * * Modified: 23/07/2005
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
 $num_lot = "20";
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
<td  class="page" align="center">
<center><table class="boiteaction">
  <caption><?php echo "Rechercher un bon par son n° de lot"; ?></caption>
	<form action="recherche_lot.php" method="post">


        <tr><td>N° de lot<td><input type="text" name="num_lot"  />	</td></tr>
	<tr><td class="submit" colspan="2"><input type="submit" /></td></tr>
	</form>
<tr><td colspan="2" ><form action="chercher_lot_fourn.php" method="POST"></TD></tr>
<tr><td colspan="2" class="submit">Rechercher à partir du lot fournisseur</td></tr>
  <tr><td>N° de lot fournisseur</td><td><input type="text" name="lot_fou"></td></tr>
  <tr><td class="submit" colspan="2"><input type="submit" value="envoyer"></td></tr>
</form>				
					</table>
<?php
include("help.php");
include_once("include/bas.php");
?>
</body>
</html>
