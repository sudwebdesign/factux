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
 * File Name: edit_art.php
 * 	Permet de modifier certains parametres des articles.
 * 
 * * * Version:  1.1.5
 * * * * Modified: 23/07/2005
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
include_once("include/verif.php");
include_once("include/config/common.php");
include_once("include/config/var.php");

include_once("include/language/$lang.php");
include_once("include/headers.php");
include_once("include/finhead.php");

$article=isset($_GET['article'])?$_GET['article']:"";
$sql = "SELECT * FROM " . $tblpref ."article  left join " . $tblpref ."categorie on " . $tblpref ."article.cat = " . $tblpref ."categorie.id_cat
 WHERE num=$article";

$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_array($req))
    {
		$article = $data['article'];
		$num =$data['num'];
		$prix = $data['prix_htva'];
		$tva = $data['taux_tva'];
		$uni = $data['uni'];
		$stock = $data['stock'];
		$min = $data['stomin'];
		$max = $data['stomax'];
		$cate = $data['categorie'];
		$cat_id = $data['id_cat'];
		}
	?>			
<table width="760" border="0" class="page" align="center">
<tr>
<td class="page" align="center">
<?php
include_once("include/head.php");
?>
<tr><td><?php echo"<h2>$lang_modi_pri $article </h2>"; ?></tr><tr><td>

<center><form action="article_update.php" method="post" name="article" id="article"><table>

 <tr>
 <th><?php  echo "$lang_prixunitaire " ?></th>
 						<?php
 						include_once("include/configav.php");
 				  							if ($use_categorie =='y') { ?>
 												<th><?php echo "$lang_categorie" ?></th>
 						<?php } ?>
	<?php
		if($use_stock=='y'){?>
 <th><?php echo "$lang_stock"; ?></th>
 <th><?php echo "$lang_stomax"; ?></th>
 <th><?php echo "$lang_stomin"; ?></th>
 <?php } ?>
 <tr>
    <td><input name="prix" type="text"  value ="<?php echo"$prix" ?> <?php echo "$devise" ?>"></td>
	<?php  if ($use_categorie =='y') { ?>
 <td>
 <?php 
 			 			$rqSql = "SELECT id_cat, categorie FROM " . $tblpref ."categorie WHERE 1";
										$result = mysql_query( $rqSql ) or die( "Exécution requête impossible."); ?> 
  									<SELECT NAME='categorie'>
      							<OPTION VALUE='<?php echo"$cat_id" ?>'><?php echo $cate; ?></OPTION>
      							<?php
										while ( $row = mysql_fetch_array( $result)) {
   						 			$num_cat = $row["id_cat"];
    					 			$categorie = $row["categorie"];
    								?>
      							<OPTION VALUE='<?php echo "$num_cat" ; ?>'><?php echo "$categorie"; ?></OPTION>
      							<?
										}
										?>
    								</SELECT></td>
										<?php } ?>
					<?php
		if($use_stock=='y'){?>
 <td><input name="stock" type="text" value ="<?php echo"$stock" ?>"></td>
 <td><input name="max" type="text" value ="<?php echo"$max" ?>"></td>
 <td><input name="min" type="text" value ="<?php echo"$min" ?>"></td>
 <?php } ?>
 <tr>
				<td colspan="3" class="submit"><input name="article" type="hidden" value= <?php echo "$num" ?>  />
<input type="submit" name="Submit" value="<?php echo $lang_envoyer; ?>">
<?php
		if($use_stock=='y'){?>

        <td colspan="2" class="submit">
				<?php } ?>
				<input name="reset" type="reset" id="reset" value="effacer">
    </table></form>	</center>
		
<?php
echo "<tr><td>";
include_once("include/bas.php");
?>
</td></tr></table>