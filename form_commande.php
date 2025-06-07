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
 * File Name: form_commande.php
 * 	Formulaire de saisie des commandes
 *
 * * * * Version:  8.0.0
 * * * * Modified: 07/06/2025
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
if ($user_com == 'n') {
 echo sprintf('<h1>%s</h1>', $lang_commande_droit);
 include_once(__DIR__ . "/include/bas.php");
 exit;
}
if (isset($message)&&$message!='') {
 echo $message;
 $message='';#onlyHere
}
$jour = date("d");
$mois = date("m");
$annee = date("Y");

$rqSql = "SELECT num_client, nom FROM " . $tblpref ."client WHERE actif != 'non'";
if ($user_com == 'r') {
$rqSql = "SELECT num_client, nom FROM " . $tblpref ."client WHERE actif != 'non'
 and (" . $tblpref ."client.permi LIKE '{$user_num},'
 or  " . $tblpref ."client.permi LIKE '%,{$user_num},'
 or  " . $tblpref ."client.permi LIKE '%,{$user_num},%'
 or  " . $tblpref ."client.permi LIKE '{$user_num},%')
";
}
?>
<form name="formu" method="post" action="bon.php" onSubmit="return verif_formulaire()">
 <center>
  <table border='0' class='page' align='center'>
   <caption><?php echo $lang_cre_bon; ?></caption>
   <tr>
    <td class="texte0"></td>
    <td class="texte0"><?php echo $lang_client;?></td>
    <td class="texte0">
<?php
  if ($liste_cli!='y') {
   $rqSql .= ' order by nom';
   $result = mysql_query( $rqSql ) or die( "Exécution requête impossible.");
?>
      <select name='listeclients'>
       <option value='0'><?php echo $lang_choisissez; ?></option>
<?php
  while ( $row = mysql_fetch_array( $result)) {
    $numclient = $row["num_client"];
    $nom = $row["nom"];
?>
       <option value='<?php echo $numclient; ?>'><?php echo $nom; ?></option>
<?php } ?>
      </select>
<?php }else{include_once(__DIR__ . "/include/choix_cli.php"); } ?>
     </td>
     <td class="texte0"></td>
   </tr>
   <tr>
    <td class="texte0"></td>
    <td class="texte0"><?php echo "date" ?> </td>
    <td class="texte0"><input type="text" name="date" value="<?php echo sprintf('%s/%s/%s', $jour, $mois, $annee) ?>" readonly="readonly"/>
     <a href="#" onClick=" window.open('include/pop.calendrier.php?frm=formu&amp;ch=date','calendrier','width=460,height=170,scrollbars=0').focus();"><img src="image/petit_calendrier.gif" alt="calendrier" border="0"/></a>
    </td>
    <td class="texte0"></td>
   </tr>
   <tr>
    <td class="submit" colspan="6"><input type="submit" name="Submit" value="<?php echo $lang_crer_bon ?>"></td>
   </tr>
  </table>
 </center>
</form>
  </td>
 </tr>
 <tr>
  <td>
<?php
include_once(__DIR__ . "/lister_commandes.php");
