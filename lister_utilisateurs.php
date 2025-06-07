<?php
/*
 * Factux le facturier libre
 * Copyright (C) 2003-2005 Guy Hendrickx, 2017 Thomas Ingles
 *
 * Licensed under the terms of the GNU  General Public License:
 *   http://opensource.org/licenses/GPL-3.0
 *
 * For further information visit:
 *   http://factux.free.fr
 *
 * File Name: lister_utilisateurs.php
 *  crée la liste des utilisateurs
 *
 * * * Version:  5.0.0
 * * * * Modified: 07/10/2016
 *
 * File Authors:
 *   Guy Hendrickx
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
if ($user_admin != 'y'){
 echo sprintf('<h1>%s</h1>', $lang_admin_droit);
 include_once(__DIR__ . "/include/bas.php");
 exit;
}
if (isset($message)&&$message!='') {
 echo $message;
}
$sql = " SELECT * FROM " . $tblpref ."user WHERE 1 ORDER BY `nom` ASC";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
?>

 <table class='page boiteaction'>
  <caption><?php echo $lang_les_utl; ?></caption>
   <tr>
    <th><?php echo $lang_nom; ?></th>
    <th><?php echo $lang_prenom; ?></th>
    <th><?php echo $lang_login; ?></th>
    <th><?php echo $lang_admin . '?'; ?></th>
    <th><?php echo sprintf('%s %s?', $lang_gerer, $lang_devis); ?></th>
    <th><?php echo sprintf('%s %s?', $lang_gerer, $lang_commandes); ?></th>
    <th><?php echo sprintf('%s %s?', $lang_gerer, $lang_factures); ?></th>
    <th><?php echo sprintf('%s %s?', $lang_gerer, $lang_depenses); ?></th>
    <th><?php echo sprintf('%s %s?', $lang_voir, $lang_stat); ?></th>
    <th><?php echo sprintf('%s %s?', $lang_gerer, $lang_art); ?></th>
    <th><?php echo sprintf('%s %s?', $lang_gerer, $lang_clients); ?></th>
    <th colspan="2"><?php echo $lang_action; ?></th>
   </tr>
<?php
$nombre =1;
while($data = mysql_fetch_array($req)){
 $nom = $data['nom'];
 $prenom = $data['prenom'];
 $login = $data['login'];
 $dev = $data['dev'];
  if ($dev == 'y') { $dev = $lang_oui ;}
  if ($dev == 'n') { $dev = $lang_non ; }
  if ($dev == 'r') { $dev = $lang_restrint ; }
 $com = $data['com'];
  if ($com == 'y') { $com = $lang_oui ; }
  if ($com == 'n') { $com = $lang_non ; }
  if ($com == 'r') { $com = $lang_restrint ; }
 $fact = $data['fact'];
  if ($fact == 'y') { $fact = $lang_oui ; }
  if ($fact == 'n') { $fact = $lang_non ; }
  if ($fact == 'r') { $fact = $lang_restrint ; }
 $mail =$data['email'];
 $dep = $data['dep'];
  if ($dep == 'y') { $dep = $lang_oui ; }
  if ($dep == 'n') { $dep = $lang_non ; }
 $stat = $data['stat'];
  if ($stat == 'y') { $stat = $lang_oui ; }
  if ($stat == 'n') { $stat = $lang_non ; }
 $art = $data['art'];
  if ($art == 'y') { $art = $lang_oui ; }
  if ($art == 'n') { $art = $lang_non ; }
 $cli = $data['cli'];
  if ($cli == 'y') { $cli = $lang_oui ; }
  if ($cli == 'n') { $cli = $lang_non ; }
  if ($dev == 'r') { $dev = $lang_restrint ; }
 $admin = $data['admin'];
  if ($admin == 'y') { $admin = $lang_oui ; }
  if ($admin == 'n') { $admin = $lang_non ; }
 $num_user = $data['num'];
 $nombre += 1;
 $line = $nombre & 1 ? "0" : "1";
?>
   <tr class="texte<?php echo $line; ?>" onmouseover="this.className='highlight'" onmouseout="this.className='texte<?php echo $line; ?>'">
    <td class='<?php echo couleur_alternee (); ?>'><b><?php echo $nom; ?></b></td>
    <td class='<?php echo couleur_alternee (FALSE); ?>'><b><?php echo $prenom; ?></b></td>
    <td class='<?php echo couleur_alternee (FALSE); ?>'><b><?php echo $login; ?></b></td>
    <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'><?php echo $admin; ?></td>
    <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'><?php echo $dev; ?></td>
    <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'><?php echo $com; ?></td>
    <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'><?php echo $fact; ?></td>
    <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'><?php echo $dep; ?></td>
    <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'><?php echo $stat; ?></td>
    <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'><?php echo $art; ?></td>
    <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'><?php echo $cli; ?></td>
    <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'>
     <a href="edit_utilisateur.php?num_user=<?php echo $num_user ?>">
      <img src="image/edit.gif" border="0" alt="<?php echo $lang_editer ;?>">
     </a>
    </td>
    <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'>
     <a href="del_utilisateur.php?num_user=<?php echo $num_user ?>"
        onClick='return confirmDelete("<?php echo $lang_con_effa_utils; ?>")'>
      <img src="image/delete.jpg" border="0" alt="<?php echo $lang_supprimer ;?>">
     </a>
    </td>
   </tr>
<?php } ?>
   <tr>
    <td colspan="13" class="td2"></td>
   </tr>
  </table>
  </td>
 </tr>
 <tr>
  <td>
<?php
$aide = 'utilisateurs';
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
