<?php
/*
 * Factux le facturier libre
 * Copyright (C) 2003-2005 Guy Hendrickx, 2017~ Thomas Ingles
 *
 * Licensed under the terms of the GNU  General Public License:
 * 		http://opensource.org/licenses/GPL-3.0
 *
 * For further information visit:
 * 		http://factux.free.fr
 *
 * File Name: ajouter_cat.php
 * 	permet l'ajout de catégories d'articles
 *
 * * * * Version:  8.0.0
 * * * * Modified: 07/06/2025
 *
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
if (!isset($user_art) || $user_art == 'n') {
 include_once(__DIR__ . "/include/headers.php");
 include_once(__DIR__ . "/include/finhead.php");
?>
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php
 include_once(__DIR__ . "/include/head.php");
 echo sprintf('<h1>%s</h1>', $lang_article_droit);
 include_once(__DIR__ . "/include/bas.php");
 exit;
}
?>
   <form action="categorie_new.php" method="post">
    <center>
     <table class="page">
      <caption><?php echo $lang_categorie_ajout; ?></caption>
      <tr>
       <td class="texte0"> <?php echo $lang_cat_nom ?></td>
       <td class="texte0"><input name="categorie" type="text" id="uni2" size="27" maxlength="30" value=""></td>
      </tr>
      <tr>
       <td class="submit" colspan="2">
        <input type="submit" name="Submit2" value="<?php echo $lang_ajouter; ?>">
        &nbsp;&nbsp;
        <input name="reset" type="reset" id="reset2" value="<?php echo $lang_effacer; ?>">
       </td>
      </tr>
     </table>
    </center>
   </form>
