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
 * File Name: form_devis
 * 	formulaire de saisie des devis
 *
 * * * Version:  5.0.0
 * * * * Modified: 07/10/2016
 *
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
include_once(__DIR__ . "/include/headers.php");
include_once(__DIR__ . "/include/finhead.php");
?>
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php
include_once(__DIR__ . "/include/head.php");
if ($user_dev == 'n') {
 echo sprintf('<h1>%s</h1>', $lang_devis_droit);
 include_once(__DIR__ . "/include/bas.php");
 exit;
}
if (isset($message)&&$message!='') {
 echo $message;
 $message='';#onlyHere
}
$rqSql = "SELECT num_client, nom FROM " . $tblpref ."client WHERE actif != 'non'";
if ($user_dev == 'r') {
$rqSql = "SELECT num_client, nom FROM " . $tblpref ."client WHERE actif != 'non'
  AND (" . $tblpref ."client.permi LIKE '{$user_num},'
  or  " . $tblpref ."client.permi LIKE '%,{$user_num},'
  or  " . $tblpref ."client.permi LIKE '%,{$user_num},%'
  or  " . $tblpref .sprintf("client.permi LIKE '%s,%%') ", $user_num);
}
$annee = date("Y");
$mois = date("m");
$jour = date("d");
?>
<center>
 <form name="formu" method="post" action="devis.php">
  <table border='0' class='page' align='center'>
   <caption><?php echo $lang_devis_créer; ?></caption>
   <tr>
    <td class="texte0"><?php echo $lang_client; ?></td>
    <td class="texte0">
<?php
if ($liste_cli!='y') {
  $rqSql .= ' order by nom';
  $result = mysql_query( $rqSql ) or die('Erreur SQL !<br>'.$rqSql.'<br>'.mysql_error());
?>
     <select name='listeclients'>
      <option value='0'><?php echo $lang_choisissez; ?></option>
<?php while ( $row = mysql_fetch_array( $result)) {?>
      <option value='<?php echo $row["num_client"]; ?>'><?php echo $row["nom"]; ?></option>
<?php } ?>
     </select>
<?php }else{include_once(__DIR__ . "/include/choix_cli.php"); } ?>
    </td>
   </tr>
   <tr>
    <td class="texte0"><?php echo "date" ?></td>
    <td class="texte0"><input type="text" name="date" value="<?php echo sprintf('%s/%s/%s', $jour, $mois, $annee) ?>" readonly="readonly"/>
      <a href="#" onClick=" window.open('include/pop.calendrier.php?frm=formu&amp;ch=date','calendrier','width=460,height=170,scrollbars=0').focus();"><img src="image/petit_calendrier.gif" alt="calendrier" border="0"/></a>
    </td>
   </tr>
   <tr>
    <td class="submit" colspan="2"><input type="submit" name="Submit" value="<?php echo $lang_devis_créer; ?>"></td>
   </tr>
  </table>
 </form>
</center>
  </td>
 </tr>
 <tr>
  <td>
<?php
include_once(__DIR__ . "/lister_devis.php");
