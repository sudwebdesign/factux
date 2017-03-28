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
 * File Name: fckconfig.js
 * 	Editor configuration settings.
 * 
 * * * Version:  5.0.0
 * * * * Modified: 07/10/2016
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
$now='../';
require_once("../include/verif_client.php");
include_once("../include/config/common.php");
include_once("../include/config/var.php");
include_once("../include/language/$lang.php");
include_once("../include/utils.php");
include_once("../include/headers.php");
include_once("../include/finhead.php");
$num_dev=isset($_GET['num_dev'])?$_GET['num_dev']:"";
$login=isset($_GET['login'])?$_GET['login']:"";
?>
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
  <?php include_once("head.php");?></td>
 </tr>
 <tr>
  <td class="page" align="center">
   <table width="760" border="0" class="page" align="center">
    <caption>Refuser le devis n° <?php echo "$num_dev"; ?></caption>
    <tr>
     <th><?php echo $lang_quantite ;?></th>
     <th><?php echo $lang_unite ;?></th>
     <th><?php echo $lang_article ;?></th>
     <th><?php echo $lang_montant_htva ;?></th>
    </tr>
<?php
 $sql2 = "SELECT " . $tblpref ."cont_dev.num, uni, quanti, article, tot_art_htva FROM " . $tblpref ."cont_dev RIGHT JOIN " . $tblpref ."article on " . $tblpref ."cont_dev.article_num = " . $tblpref ."article.num WHERE  dev_num = \"$num_dev\"";
$req = mysql_query($sql2) or die('Erreur SQL2 !<br>'.$sql2.'<br>'.mysql_error());
while($data = mysql_fetch_array($req)){
    $num_cont = $data['num'];
?>
   <tr>
    <td class ='<?php echo couleur_alternee (TRUE, "nombre"); ?>'><?php echo $data['quanti']; ?> 
    <td class ='<?php echo couleur_alternee (FALSE); ?>'><?php echo $data['uni']; ?>
    <td class ='<?php echo couleur_alternee (FALSE); ?>'><?php echo $data['article']; ?>
    <td class ='<?php echo couleur_alternee (FALSE, "nombre"); ?>'><?php echo "$data[tot_art_htva] $devise"; ?>
   </tr>
<?php }
//on calcule la somme des contenus du bon
$sql = " SELECT SUM(tot_art_htva) FROM " . $tblpref ."cont_dev WHERE dev_num = \"$num_dev\"";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_array($req)){
 $total_bon = $data['SUM(tot_art_htva)'];
}
//on calcule la some de la tva des contenus du bon
$sql = " SELECT SUM(to_tva_art) FROM " . $tblpref ."cont_dev WHERE dev_num = \"$num_dev\"";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_array($req)){
 $total_tva = $data['SUM(to_tva_art)'];
}
?>
   <tr>
    <td class='totalmontant' colspan='3'><?php echo $lang_total_htva; ?><br><?php echo $lang_tot_tva; ?><br><?php echo $lang_tot_ttc; ?></td>
    <td class='totalmontant'><?php echo montant_financier($total_bon); ?><br><?php echo montant_financier($total_tva); ?><br><?php echo montant_financier($total_bon+$total_tva); ?></td>
   </tr>
   <tr>  <td colspan="4" class="page" align="center">
     <form action="refu_devis_suite.php" method="post">
      <table width="760" border="0" class="page" align="center">
       <tr>
        <td class="titretableau" colspan="2"><?php echo "$lang_refu $lang_de_num $num_dev"; ?>?</td>
       </tr>
       <tr>
        <td class="texte0"><?php echo $lang_conf_conv; ?></td>
        <td class="texte0"><textarea rows="10" cols="60" name="message"></textarea></td>
       </tr>
       <tr>
        <td colspan="2" class="nombre0"><?php echo nombre_literal(avec_virgule($total_bon+$total_tva)); ?></td>
       </tr>
       <tr>
        <td colspan="2" class="nombre0">
         <input type="hidden" name="login" value ='<?php echo "$login" ?>'>
         <input type="hidden" name="num_dev" value ='<?php echo "$num_dev" ?>'>
         <input type="submit" value="<?php echo $lang_refu; ?>">
         <a type="button" href="client.php?login=<?php echo "$login" ?>" ><?php echo $lang_annuler; ?></a>
       </td>
       </tr>
      </table>
     </form>
    </td>
   </tr>
  </table>
<?php
include_once("../include/bas_cli.php");
