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
 * File Name: ajouter_cat.php
 * 	permet l'ajout de catégories d'articles
 * 
 * * Version:  1.1.5
 * * * * Modified: 23/07/2005
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
if ($user_art == 'n') { 
 echo "<h1>$lang_article_droit</h1>";
 exit;  
}
?>
   <form action="categorie_new.php" method="post">
    <center>
     <table class="page">
      <caption><?php echo $lang_categorie_ajout; ?></caption>
      <tr> 
       <td class="texte0"> <?php echo "$lang_cat_nom" ?></td>
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
