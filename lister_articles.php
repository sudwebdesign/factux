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
 * File Name: lister_article.php
 * 	liste les article et donne acces a differentes actions
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
include_once("include/headers.php");?>
<script type="text/javascript" src="javascripts/confdel.js"></script>
<?php
include_once("include/finhead.php");
include_once("include/configav.php");
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
<td style="text-align:center;"  >			
<?php 
if ($user_art == n) { 
echo "<h1>$lang_article_droit";
exit;  
}
if ($message !='') { 
 echo "<table><tr><td>$message</td></tr></table>"; 
} ?>
<?php
$sql = "SELECT * FROM " . $tblpref ."article 
LEFT JOIN " . $tblpref ."categorie ON " . $tblpref ."categorie.id_cat = " . $tblpref ."article.cat
WHERE actif != 'non' ";
if ( isset ( $_GET['ordre'] ) && $_GET['ordre'] != '')
{
$sql .= " ORDER BY " . $_GET[ordre] . " ASC";
}else{
$sql .= "ORDER BY article ASC ";
}
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql2.'<br>'.mysql_error());
?>
  <center><table class="boiteaction">	

  <caption><?php echo $lang_articles_liste; ?></caption>
  <tr> 
    <th><a href="lister_articles.php?ordre=article"> <?php echo $lang_article; ?></a></th>
		<?php
		if ($use_categorie =='y') { ?>
		<th><a href="lister_articles.php?ordre=categorie"><?php echo $lang_categorie ?> </a> 
		<?php } ?>
    <th><a href="lister_articles.php?ordre=prix_htva"><?php echo $lang_htva; ?></a> </th>
    <th><a href="lister_articles.php?ordre=taux_tva"><?php echo $lang_taux_tva; ?></a></th>
    <th><a href="lister_articles.php?ordre=uni"><?php echo $lang_unite; ?></a></th>
		<?php
		if($use_stock=='y'){?>
		<th><a href="lister_articles.php?ordre=stock"><?php echo $lang_stock; ?></a></th>
		<th><a href="lister_articles.php?ordre=stomin"><?php echo $lang_stomin; ?></a></th>
		<th><a href="lister_articles.php?ordre=stomax"><?php echo $lang_stomax; ?></a></th>
		<?php } ?>
    <th colspan="2"><?php echo $lang_action; ?></th>
  </tr>
  <?php
	$nombre="1";
while($data = mysql_fetch_array($req))
    {
		$article = $data['article'];
		$article_html=addslashes($article);
		$article = htmlentities($article, ENT_QUOTES);
		$cat = $data['categorie'];
		$cat = htmlentities($cat, ENT_QUOTES);
		$num =$data['num'];
		$prix = $data['prix_htva'];
		$tva = $data['taux_tva'];
		$uni = $data['uni'];
		$stock = $data['stock'];
		$min = $data['stomin'];
		$max = $data['stomax'];
		if ($stock <= $min ||$stock >= $max  ) { 
  	$stock="<h1>$stock</h1>";
		}
		$nombre = $nombre +1;
		if($nombre & 1){
$line="0";
}else{
$line="1";
 
}
		?>
		<tr class="texte<?php echo"$line" ?>" onmouseover="this.className='highlight'" onmouseout="this.className='texte<?php echo"$line" ?>'">
  	<td class="highlight"><?php echo "$article"; ?></td>
		<?php 
		
		if ($use_categorie =='y') { ?>
  	<td class="highlight"><?php echo $cat; ?></td>
		<?php } ?>
    <td class="highlight"><?php echo montant_financier ($prix); ?></td>
    <td class="highlight"><?php echo "$tva %"; ?></td>
		<td class="highlight"><?php echo $uni; ?></td>
		<?php
		if($use_stock=='y'){?>
    
		<td class="highlight"><?php echo $stock; ?></td>
		<td class="highlight"><?php echo $min; ?></td>
		<td class="highlight"><?php echo $max; ?></td>
		<?php } ?>
    <td class="highlight"><a href='edit_art.php?article=<?php echo $num; ?>'>
	                <img border=0 alt="<?php echo $lang_editer; ?>" src="image/edit.gif"></a></td>
		<td class="highlight"><a href="delete_article.php?article=<?php echo $num; ?>" onClick="return confirmDelete('<?php echo"$lang_art_effa $article_html ?"; ?>')">
	                <img border=0 alt="<?php echo $lang_suprimer; ?>" src="image/delete.jpg" ></a></td></tr>
    <?php
		}
 ?>
 <tr><td colspan="10" class="submit"></td>
  </table></center>
  <?php
 $aide = article;
 ?>
<?php
include("help.php");
include_once("include/bas.php");

$url = $_SERVER['PHP_SELF'];
$file = basename ($url);
if ($file=="form_article.php") { 
echo"</table>"; 
} ?>
</table></body>
</html>
