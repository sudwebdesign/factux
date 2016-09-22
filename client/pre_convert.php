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
require_once("../include/verif_client.php");
require_once("../include/utils.php");
include_once("../include/config/common.php");
include_once("../include/config/var.php");
include_once("../include/language/$lang.php");

echo '<link rel="stylesheet" type="text/css" href="../include/style.css">';
$num_dev=isset($_GET['num_dev'])?$_GET['num_dev']:"";
$login=isset($_GET['login'])?$_GET['login']:"";
 include_once("head.php");

 ?> 
 <title><?php echo "$lang_factux" ?></title>
 <table width="760" border="0" class="page" align="center">
 <caption><?php echo "$lang_accepter $lang_de_num $num_dev"; ?></caption>
 <th><? echo $lang_quantite ;?></th>
  <th><? echo $lang_unite ;?></th>
  <th><? echo $lang_article ;?></th>
  <th><? echo $lang_montant_htva ;?></th>
  </tr>
 <?php
 $sql2 = "SELECT " . $tblpref ."cont_dev.num, uni, quanti, article, tot_art_htva FROM " . $tblpref ."cont_dev RIGHT JOIN " . $tblpref ."article on " . $tblpref ."cont_dev.article_num = " . $tblpref ."article.num WHERE  dev_num = \"$num_dev\"";
$req = mysql_query($sql2) or die('Erreur SQL2 !<br>'.$sql2.'<br>'.mysql_error());
while($data = mysql_fetch_array($req))
    {
		$quanti = $data['quanti'];
		$uni = $data['uni'];
		$article = $data['article'];
		$tot = $data['tot_art_htva'];
		$num_cont = $data['num'];
		?>
		<td class ='<?php echo couleur_alternee (TRUE, "nombre"); ?>'><?php echo $quanti ?> 
		<td class ='<?php echo couleur_alternee (FALSE); ?>'><?php echo $uni  ?>
		<td class ='<?php echo couleur_alternee (FALSE); ?>'><?php echo $article ?>
		<td class ='<?php echo couleur_alternee (FALSE, "nombre"); ?>'><?php echo "$tot $devise" ?>
		</tr>
		<?php }
//on calcule la somme des contenus du bon
$sql = " SELECT SUM(tot_art_htva) FROM " . $tblpref ."cont_dev WHERE dev_num = \"$num_dev\"";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_array($req))
    {
		$total_bon = $data['SUM(tot_art_htva)'];
}
//on calcule la some de la tva des contenus du bon
$sql = " SELECT SUM(to_tva_art) FROM " . $tblpref ."cont_dev WHERE dev_num = \"$num_dev\"";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_array($req))
    {
		$total_tva = $data['SUM(to_tva_art)'];
		}    
echo "<td class='totalmontant'colspan='1'> $lang_total ";
echo "<td class='totalmontant'colspan='1'>$total_bon $devise<td class='totalmontant'>$lang_tva<td class='totalmontant'> $total_tva $devise<tr>"; 
?>

<td colspan="4" class="page" align="center">
<form action="convert_client.php" method="post">
  <table class="boiteaction">
    <tr>
      <td class="titretableau" colspan="2"><?php echo ; ?></td>
    </tr>
    <tr>
      <td class="texte0"><?php echo $lang_conf_conv; ?></td>
	  <td class="texte0"><TEXTAREA rows="10" cols="60" name="message"></TEXTAREA></td>
	  </tr>
    <tr>
     <td colspan="2">
		 <input type="hidden" name="login" value ='<?php echo "$login" ?>'>
		 <input type="hidden" name="num_dev" value ='<?php echo "$num_dev" ?>'>
		 <input type="submit" value="<?php echo $lang_envoyer; ?>">
	 &nbsp;&nbsp;<input type="reset" Value= "<?php echo $lang_annuler; ?>"></td>
    </tr>
  </table>
</form>