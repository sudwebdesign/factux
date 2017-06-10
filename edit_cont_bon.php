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
 * File Name: edit_cont_bon.php
 * 	editiion du contenu des bon de commande
 * 
 * * * Version:  5.0.0
 * * * * Modified: 07/10/2016
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
include_once("include/headers.php");
include_once("include/finhead.php");
$num_cont=isset($_POST['num_cont'])?$_POST['num_cont']:"";
?>
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php include_once("include/head.php"); ?>
   <center>
    <form name="formu2" method="post" action="edit_cont_bon_suite.php">
     <table class='page boiteaction'>
      <caption><?php  echo $lang_edi_cont_bon ?></caption>
<?php
$sql = "
SELECT * FROM " . $tblpref ."cont_bon  
LEFT JOIN " . $tblpref ."article on " . $tblpref ."cont_bon.article_num = " . $tblpref ."article.num 
WHERE  " . $tblpref ."cont_bon.num = $num_cont
";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_array($req)){
 $quanti = $data['quanti'];
 $article = $data['article'];
 $tot = $data['tot_art_htva'];
 $num_art = $data['num'];
 $article_num = $data['article_num'];
 $bon_num = $data['bon_num'];
 $prix_ht = $data['prix_htva'];
 $num_lot = $data['num_lot'];
 $remise=$data['remise'];
}
?>
     <tr>
      <td class="texte0"><?php echo $lang_article ;?></td>
      <td class="texte0">
<?php include("include/article_choix.php"); ?>
     </td>
<?php 
if ($lot == 'y') { 
  $rqSql = "SELECT num, prod FROM " . $tblpref ."lot WHERE actif != 'non' ORDER BY num";
  $result = mysql_query( $rqSql )or die( "Exécution de la requête impossible.");
?>
       <td class="texte0"><?php echo $lang_lot; ?></td>
       <td class="texte0">
        <select name='num_lot'>
         <option value=''><?php echo $lang_choisissez;?></option>
<?php
while ( $row = mysql_fetch_array( $result)) {
  $sel=($row['num']==$num_lot)?"' selected='selected":'';
?>
         <option value='<?php echo "$row[num]$sel"; ?>'><?php echo "$row[num] $row[prod] "; ?></option>
<?php } ?>
        </select>
       </td>  
<?php } ?>
      </tr>
      <tr>
       <td class="texte0"><?php echo $lang_quanti ?></td>
       <td colspan="3" class="texte0">
        <input name="quanti" type="text" size="5" id="quanti" value="<?php echo"$quanti"?>">
       </td>
      </tr>
      <tr>
       <td class="texte0"><?php echo $lang_remise ?></td>
       <td colspan="3" class="texte0">
        <input name="remise" type="text" size="5" id="remise" value="<?php echo"$remise"?>">%
       </td>
      </tr>
      <tr>
       <td class="submit" colspan="4">
        <input type="submit" name="Submit2" value="<?php echo $lang_modifier; ?>">
        <input name="num_cont" type="hidden" value="<?php echo $num_cont ?>">
        <input name="bon_num" type="hidden" value="<?php echo $bon_num ?>">
       </td>
      </tr>
     </table>
    </form>
   </center>
  </td>
 </tr>
 <tr>
  <td>
<?php
$aide='bon';
include("help.php");
include_once("include/bas.php");
?>
  </td>
 </tr>
</table>
</body>
</html>
