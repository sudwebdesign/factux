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
 * File Name: lister_clients.php
 *  liste les clients et permet de multiples action sur les clients
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
if ($user_cli == 'n') {
 echo sprintf('<h1>%s</h1>', $lang_client_droit);
 include_once(__DIR__ . "/include/bas.php");
 exit;
}
if (isset($message)&&$message!='') {
 echo$message;
 $message='';#onlyHere
}
$sql = " SELECT * FROM " . $tblpref ."client WHERE actif != 'non' ";
if ( isset ( $_GET['ordre'] ) && $_GET['ordre'] != ''){
 $sql .= " ORDER BY " . $_GET['ordre'] . " ASC";
}
else{
 $sql .= "ORDER BY nom ASC ";
}
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
?>
   <center>
    <table class="page boiteaction">
     <caption><?php echo $lang_clients_existants; ?></caption>
      <tr>
       <th><a href="lister_clients.php?ordre=civ"><?php echo $lang_civ; ?> </a></th>
       <th><a href="lister_clients.php?ordre=nom"><?php echo $lang_nom; ?></a></th>
       <th><a href="lister_clients.php?ordre=nom2"><?php echo $lang_complement; ?></a></th>
       <th><a href="lister_clients.php?ordre=rue"><?php echo $lang_rue; ?></a></th>
       <th><a href="lister_clients.php?ordre=cp"><?php echo $lang_code_postal; ?></a></th>
       <th><a href="lister_clients.php?ordre=ville"><?php echo $lang_ville; ?></a></th>
       <th><a href="lister_clients.php?ordre="><?php echo $lang_numero_tva; ?></a></th>
       <th><a href="lister_clients.php?ordre=tel"><?php echo $lang_tele;?></a></th>
       <th><a href="lister_clients.php?ordre=fax"><?php echo $lang_fax;?></a></th>
       <th><a href="lister_clients.php?ordre=mail"><?php echo $lang_email; ?></a></th>
       <th colspan="2"><?php echo $lang_action; ?></th>
      </tr>
<?php
$c=0;
while($data = mysql_fetch_array($req)){
  $nom = $data['nom'];
  $nom_html= thespecialchars($nom);#4 js#addslashes($nom);
  $nom2 = $data['nom2'];
  $rue = $data['rue'];
  $ville = $data['ville'];
  $cp = $data['cp'];
  $tva = $data['num_tva'];
  $mail = $data['mail'];
  $num = $data['num_client'];
  $civ = $data['civ'];
  $tel = $data['tel'];
  $fax = $data['fax'];
  $line = $c++ & 1 ? "0" : "1";
?>
    <tr class="texte<?php echo $line; ?>" onmouseover="this.className='highlight'" onmouseout="this.className='texte<?php echo $line; ?>'">
     <td class='<?php echo couleur_alternee (); ?>'><?php echo $civ; ?></td>
     <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo $nom; ?></td>
     <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo $nom2; ?></td>
     <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo $rue; ?></td>
     <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo $cp; ?></td>
     <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo $ville; ?></td>
     <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo $tva; ?></td>
     <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo $tel; ?></td>
     <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo $fax; ?></td>
     <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'>
      <a href="mailto:<?php echo $mail; ?>" ><?php echo $mail; ?></a>
     </td>
     <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'>
      <a href='edit_client.php?num=<?php echo $num ?>'>
       <img border='0' src='image/edit.gif' alt='<?php echo $lang_editer; ?>'>
      </a>
     </td>
     <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'>
      <a href='del_client.php?num=<?php echo $num; ?>'
       onClick="return confirmDelete('<?php echo $lang_cli_effa.$nom_html; ?>?')">
       <img border='0' src='image/delete.jpg' alt='<?php echo $lang_supprimer; ?>'>
      </a>
     </td>
<?php } ?>
     <tr><td colspan="12" class="td2"></td></tr>
    </table>
   </center>
  </td>
 </tr>
 <tr>
  <td>
<?php
$aide='client';
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
