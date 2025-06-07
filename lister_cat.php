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
 * File Name: lister_cat.php
 * 	liste toutes les categories
 *
 * * * * Version:  8.0.0
 * * * * Modified: 07/06/2025
 *
 * File Authors:
 * 		Thomas Ingles
 *.
 */
include_once(__DIR__ . "/include/headers.php");
?><script type="text/javascript" src="javascripts/confdel.js"></script><?php
include_once(__DIR__ . "/include/finhead.php");
?>
 <table width="760" border="0" class="page" align="center">
  <tr>
   <td class="page" align="center">
<?php
include_once(__DIR__ . "/include/head.php");
if ($user_com == 'n'){
 echo sprintf('<h1>%s</h1>', $lang_commande_droit);
 include_once(__DIR__ . "/include/bas.php");
 exit;
}
if (isset($message)&&$message!='') {
 echo $message;
}
$sql = "
SELECT id_cat, categorie
FROM " . $tblpref ."categorie
ORDER BY " . $tblpref ."categorie.categorie ASC
";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
?>
  </td>
 </tr>
 <tr>
  <td>
<?php include_once(__DIR__ . "/ajouter_cat.php");?>
  </td>
 </tr>
 <tr>
  <td>
  <center>
   <table class="page boiteaction">
    <caption><?php echo $lang_categorie; ?>s</caption>
     <tr>
      <th><?php echo $lang_cat_nom; ?></th>
      <th colspan="2"><?php echo $lang_action; ?></th>
     </tr>
<?php
$c=0;
while($data = mysql_fetch_array($req)){
 $id_cat = $data['id_cat'];
 $categorie = $data['categorie'];
 $line = $c++ & 1 ? 0 : 1;
?>
     <tr class="texte<?php echo $line; ?>" onmouseover="this.className='highlight'" onmouseout="this.className='texte<?php echo $line ?>'">
      <td class='<?php echo couleur_alternee (); ?>'><?php echo $categorie; ?></td>
      <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'>
       <a href="edit_cat.php?id_cat=<?php echo $id_cat; ?>">
        <img border="0" alt="<?php echo $lang_editer; ?>" src="image/edit.gif">
       </a>
      </td>
      <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'>
       <a href="delete_cat.php?id_cat=<?php echo $id_cat; ?>&amp;categorie=<?php echo $categorie; ?>"
          onClick="return confirmDelete('<?php echo $lang_cat_effa.$categorie; ?>?');">
        <img border="0" alt="<?php echo $lang_supprimer; ?>" src="image/delete.jpg" >
       </a>
      </td>
     </tr>
<?php } ?>
     <tr><td colspan="3" class="td2"></td></tr>
    </table>
   </center>
  </td>
 </tr>
 <tr>
  <td>
<?php
$aide='article';
include(__DIR__ . "/help.php");
include_once(__DIR__ . "/include/bas.php");
if(!strstr($_SERVER['SCRIPT_FILENAME'],__FILE__)){#autre qu'elle meme
 echo"\n  </td>\n </tr>\n</table>\n";
}
?>
  </td>
 </tr>
</table>
</body>
</html>
