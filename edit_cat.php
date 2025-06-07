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
 * File Name: edit_cat.php
 * 	Formulaire d'edition d'une categorie
 *
 * * * * Version:  8.0.0
 * * * * Modified: 07/06/2025
 *
 * File Authors:
 * 		Thomas Ingles
 *.
 */
include_once(__DIR__ . "/include/headers.php");
$categorie=isset($_POST['categorie'])?$_POST['categorie']:"";
$id_cat=isset($_POST['id_cat'])?$_POST['id_cat']:"";
if($id_cat!=""&&$categorie!=""){#MAJ
 $sql = "SELECT categorie FROM " . $tblpref .('categorie WHERE id_cat = ' . $id_cat);
 $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
 $data = mysql_fetch_array($req);
 $anciennom = $data['categorie'];
 $sql = "UPDATE ".$tblpref.sprintf("categorie SET categorie ='%s' WHERE id_cat = '%s'", $categorie, $id_cat);
 if($categorie!=''&&$categorie!=$lang_divers){
  mysql_query($sql) || die(sprintf('<p>Erreur Mysql<br/>%s<br/>', $sql).mysql_error()."</p>");
  $message = sprintf('<h2>%s</h2><p>%s %s %s %s</p>', $lang_cat_maj, $lang_de, $anciennom, $lang_vers, $categorie);
 }
 if ($categorie==$lang_divers) {
     $message = sprintf('<h1>%s %s</h1>', $lang_categorie, $lang_divers);
 }
 include(__DIR__ . "/lister_cat.php");
 exit;
}
if($id_cat==""&&$categorie!=""){#NEW from edit_cat #fix
 include(__DIR__ . "/lister_cat.php");
 exit;
}
include_once(__DIR__ . "/include/finhead.php");
?>
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php
include_once(__DIR__ . "/include/head.php");
if ($user_com == 'n') {
 echo sprintf('<h1>%s</h1>', $lang_commande_droit);
 include_once(__DIR__ . "/include/bas.php");
 exit;
}
$id_cat=isset($_GET['id_cat'])?$_GET['id_cat']:"";
$sql = "
SELECT  id_cat, categorie
FROM " . $tblpref .('categorie
WHERE id_cat = ' . $id_cat);
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
 $categorie = $data['categorie'];
 $id_cat = $data['id_cat'];
?>
   <form action="edit_cat.php" method="post">
    <center>
     <table class="page">
      <caption><?php echo $lang_categorie_modif; ?></caption>
      <tr>
       <td class="texte0"><?php echo $lang_cat_nom ?><input name="id_cat" type="hidden" value='<?php echo $id_cat; ?>' /></td>
       <td class="texte0"><input name="categorie" type="text" id="uni2" size="27" maxlength="30" value='<?php echo $categorie; ?>' /></td>
      </tr>
      <tr>
       <td class="submit" colspan="2">
        <input type="submit" name="Submit2" value="<?php echo $lang_modifier; ?>">
        &nbsp;&nbsp;
        <input name="reset" type="reset" id="reset2" value="<?php echo $lang_retablir; ?>">
       </td>
      </tr>
     </table>
    </center>
   </form>
  </td>
 </tr>
 <tr>
  <td>
<?php
include(__DIR__ . "/lister_cat.php");
