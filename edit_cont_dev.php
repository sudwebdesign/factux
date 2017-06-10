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
include_once("include/headers.php");
include_once("include/finhead.php");
$num_cont=isset($_POST['num_cont'])?$_POST['num_cont']:"";
$sql = "
SELECT * FROM " . $tblpref ."cont_dev 
LEFT JOIN " . $tblpref ."article on " . $tblpref ."cont_dev.article_num = " . $tblpref ."article.num 
WHERE  " . $tblpref ."cont_dev.num = $num_cont";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
?>
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php
include_once("include/head.php");
while($data = mysql_fetch_array($req)){
 $quanti = $data['quanti'];
 $article = $data['article'];
 $tot = $data['tot_art_htva'];
 $num_art = $data['num'];
 $article_num = $data['article_num'];
 $dev_num = $data['dev_num'];
 $prix_ht = $data['prix_htva'];
 $remise = $data['remise'];
}
?>
<form name="formu2" method="post" action="edit_cont_dev_suite.php">
  <table class="page boiteaction">
    <caption><?php echo "$lang_edi_cont_devis"; ?></caption>
    <tr> 
      <td class="texte0"><?php echo $lang_article; ?></td>
      <td class="texte0">
<?php include("include/article_choix.php"); ?>
     </td>
    </tr>
    <tr> 
     <td class="texte0"><?php echo $lang_quanti ?></td>
     <td class="texte0">
      <input name="quanti" type="text" size="5" id="quanti" value="<?php echo $quanti; ?>">
     </td> 
    </tr>
	   <tr> 
     <td class="texte0"><?php echo $lang_remise ?></td>
     <td class="texte0">
      <input name="remise" type="text" size="5" id="remise" value="<?php echo $remise; ?>">%
     </td> 
    </tr>
    <tr>
     <td class="submit" colspan="2">
      <input type="submit" name="Submit2" value="<?php echo $lang_modifier; ?>">
      <input name="num_cont" type="hidden" id="nom" value=<?php echo $num_cont ?>>
      <input name="dev_num" type="hidden" id="nom" value=<?php echo $dev_num ?>>
    </tr>
   </table>
  </form> 
 </td>
</tr>
<tr>
 <td>
<?php
$aide='devis';
include("help.php");
include_once("include/bas.php");
?>
 </td>
</tr>
</table>
</body>
</html>
