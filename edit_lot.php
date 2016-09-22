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
 * File Name: edit_lot.php
 * 	Formulaire d'edition des lots
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
<?php 
if ($user_com == n) { 
echo"<h1>$lang_commande_droit";
exit;  
}
$num_get=isset($_GET['num'])?$_GET['num']:"";
$sql1 = "SELECT prod 
from " . $tblpref ."lot
WHERE num = $num_get";
$req1 = mysql_query($sql1) or die('Erreur SQL1 !<br>'.$sql1.'<br>'.mysql_error());
$data = mysql_fetch_array($req1);
$produit= $data['prod'];
$sql = "SELECT ingr, fourn, fourn_lot, num 
		 FROM " . $tblpref ."cont_lot 
		 WHERE num_lot= $num_get";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error())
?>
	<form action="edit_lot_suite.php" method="post" name="lot" id="lot"  >
	
        <table class="boiteaction">
          <caption>
          <?php echo "Editer un lot"; ?>
          </caption>
					<tr> 
            <td class="texte1"><input name="num_lot" type="HIDDEN" value="<?php echo "$num_get"; ?>"> <?php echo "produit"; ?> </td>
            <td class="texte1"> <input name="prod" type="text" id="prod" size="40" maxlength="40"value="<?php echo $produit ?>"> 
						<td class="texte1">
            </td>
          </tr>
          <tr> 
					<th>Ingrédient</th>
					<th>Fournisseur</th>
					<th>N° de lot fournisseur </th>
					</tr>
					
<?php 
$tab_fourn[] =0;
$tab_ingr[]=0;
$tab_fourn_lot[] = 0;
$tab_num[] = 0;
while($data = mysql_fetch_array($req))
{
   $ingr= $data['ingr'];
  $fourn = $data['fourn'];
  $fourn_lot = $data['fourn_lot'];
	$num = $data['num'];
	$tab_num[] = $num ;
	$tab_ingr[]= $ingr;
	$tab_fourn[] = $fourn;
	$tab_fourn_lot[] = $fourn_lot;

  }
	for ($i=1; $i<12; $i++) {
	?>
  <tr> 
            <td  class='<?php echo couleur_alternee (); ?>'><input name="<?php echo "ing_$i" ?>" type="text"  size="40" maxlength="40" value="<?php echo $tab_ingr[$i]; ?>"></td>
            <td class='<?php echo couleur_alternee (FALSE); ?>'><input name="<?php echo "four_$i" ?>" type="text"  size="40" maxlength="40" value="<?php echo $tab_fourn[$i]; ?>"></td>
            <td class='<?php echo couleur_alternee (FALSE); ?>'><input name="<?php echo "lot_four_$i" ?>" type="text" size="40"value="<?php echo $tab_fourn_lot[$i]; ?>">
 <input  name="<?php echo "num_cont_bon_$i";?>" type="hidden" value="<?php echo "$tab_num[$i]"; ?>" /></td>

<?php } ?> 
					<tr>
					<td class="submit"><input type="submit" />
					<td colspan="2"class="submit"><input type="reset" />
					
					</table></form>
          
             

</td>
</tr>


<tr><td>   
<?php
include("help.php");
include_once("include/bas.php");
?>
</td></tr>
</table>
</body>
</html>
