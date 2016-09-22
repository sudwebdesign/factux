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
 * File Name: edit_cont_bon.php
 * 	editiion du contenu des bon de commande
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
$num_cont=isset($_GET['num_cont'])?$_GET['num_cont']:"";

?>
<table width="760" border="0" class="page" align="center">
<tr>
<td class="page" align="center">
<?php
include_once("include/head.php");
?>
<hr><form name="formu2" method="post" action="suite_edit_cont_bon.php">
<center><table class="boiteaction">
  <caption>
  <?php  echo $lang_edi_cont_bon ?>
  </caption>

  
    <?php
$sql = "SELECT * FROM " . $tblpref ."cont_bon  RIGHT JOIN " . $tblpref ."article on " . $tblpref ."cont_bon.article_num = " . $tblpref ."article.num WHERE  " . $tblpref ."cont_bon.num = $num_cont";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_array($req))
    {
		$quanti = $data['quanti'];
		$article = $data['article'];
		$tot = $data['tot_art_htva'];
		$num_art = $data['num'];
		$article_num = $data['article_num'];
		$bon_num = $data['bon_num'];
		$prix_ht = $data['prix_htva'];
		$num_lot = $data['num_lot'];
		
		}
?>
  <tr>
     <td colspan="4">
     <tr>
     <td class="texte0"><?php echo $lang_quanti ?>
     <td colspan="3" class="texte0"><input name="quanti" type="text" size="5" id="quanti" value='<?php echo"$quanti"?>' >
	<tr>
	<td class="texte0"><?php echo $lang_article ;?>
<?php 
include_once("include/configav.php");
				  if ($use_categorie !='y') { 
$rqSql = "SELECT uni, num, article, prix_htva FROM " . $tblpref ."article WHERE actif != 'non' ORDER BY article, prix_htva";
$result = mysql_query( $rqSql )
             or die( "Exécution requête impossible.");
$ld = "<SELECT NAME='article'>";
$ld .= "<OPTION VALUE=$article_num>".$article."/".$prix_ht.$devise."</OPTION>";
while ( $row = mysql_fetch_array( $result)) {
    $num = $row["num"];
    $article2 = $row["article"];
		$prix = $row["prix_htva"];
		$uni = $row["uni"];
    $ld .= "<OPTION VALUE='$num'>$article2 $prix $devise /$uni</OPTION>";
}?>
<td class="texte0">
<?php 
$ld .= "</SELECT>";
print $ld;
}else{
echo "<td class='texte0'>";
include("include/categorie_choix.php"); 
}
if ($lot == 'y') { 
$rqSql = "SELECT num, prod FROM " . $tblpref ."lot WHERE actif != 'non' ORDER BY num";
			$result = mysql_query( $rqSql )
             or die( "Exécution de la requête impossible.");?>
<td class="texte0">Lot</td>
<td class="texte0"><select NAME='num_lot'>
					<option VALUE=<?php echo "$num_lot >$num_lot"; ?></OPTION>
            <?php
						while ( $row = mysql_fetch_array( $result)) {
    							$num = $row["num"];
    							$prod = $row["prod"];
		    ?>
            <option VALUE='<?php echo $num; ?>'><?php echo "$num $prod "; ?></option>
						
					<?php 
}
 ?> </select>  
<?php
}
?>
	<input name="num_cont" type="hidden" value=<?php echo $num_cont ?>>
	<input name="bon_num" type="hidden" value=<?php echo $bon_num ?>>
        <tr>
	<td class="submit" colspan="4"><input type="submit" name="Submit" value=<?php echo $lang_modifier ?>>

    </td>
    </tr>
  </table></center></form>
<tr><TD>
<?php 
include_once("include/bas.php");
 ?>
</TD></tr></table>