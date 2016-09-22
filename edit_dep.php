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
 * File Name: fckconfig.js
 * 	Editor configuration settings.
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
include_once("include/headers.php");
include_once("include/finhead.php");
include_once("include/head.php");

$num_dep=isset($_GET['num_dep'])?$_GET['num_dep']:"";
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
<?php
$sql = "SELECT * FROM " . $tblpref ."depense WHERE num=$num_dep";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_array($req))
    {
		$article = htmlentities($data['article'], ENT_QUOTES);
		$num =htmlentities($data['num'], ENT_QUOTES);
		$prix = htmlentities($data['prix'], ENT_QUOTES);
		$lib = htmlentities($data['lib'], ENT_QUOTES);
		$four = htmlentities($data['fournisseur'], ENT_QUOTES);
		//$four = stripslashes($four);
		}
		?>
<center><br><form name="form1" method="post" action="edit_dep_suite.php">
  <table class="boiteaction">
  <caption>
  Modifier une dépense
  </caption>

	<tr>
      <td><b>Libellé</b></td>
      <td><b>Montant Htva</b></td>
      <td><b>Fournisseur</b></td>
    </tr>
    <tr>
      <td><input name="lib" type="text" value="<?php echo "$lib" ?>"></td>
      <td><input name="prix" type="text" value="<?php echo "$prix" ?>"></td>
      <td><input name="four" type="text" value="<?php echo "$four" ?>"><input name="num" type="hidden" value="<?php echo "$num" ?>"></td>
			
    </tr>
    <tr>
      
      <td colspan="2" class="submit"><input type="submit" name="Submit" value="Modifier"></td>
      <td class="submit"><input type="reset" name="Submit2" value="Annuler"></td>
      </tr>
  </table>
</form>	</center>
<?php
echo "<hr>";
include_once("include/bas.php");
?>
</td></tr></table>