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
?>
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php
include_once("include/head.php");
if (isset($message)&&$message!='') {
 echo $message;
}
$jour = date("d");
$mois = date("m");
$annee = date("Y");
$rqSql = "SELECT num_client, nom FROM " . $tblpref ."client WHERE actif != 'non' ORDER BY nom";
$result = mysql_query( $rqSql ) or die( "Exécution requête impossible.");
$cl_sz=mysql_num_rows($result);
if($cl_sz>0){
?>
<center>
 <form name="choisir_client" method="post" action="choisir_client.php" >
  <table width='50%' border='0' class='page' align='center' class='boiteaction'>
  <caption><?php echo $lang_choi_cli_utis; ?></caption>
   <tr>
    <td class="texte0" colspan="2"><?php echo $lang_clients; ?> </td>
    <td class="texte0" colspan="2">
      <select name='client[]' size="<?php echo $cl_sz;?>" multiple width="300" style="width:300px;">
<?php
while ( $row = mysql_fetch_array( $result)) {
    $numclient = $row["num_client"];
    $nom = $row["nom"];
?>
       <option value='<?php echo $numclient; ?>'><?php echo $nom; ?></option>
<?php } ?>
      </select>
     </td>
    </tr>
   <tr>
     <td class="texte1" colspan="3"><?php echo $lang_multi_select_ctrl; ?>
       <input type="hidden" name="login" value="<?php echo $login2; ?>" />
     </td>
   </tr>
   <tr>
    <td class="submit" colspan="3"><input type="submit" value="<?php echo $lang_envoyer; ?>" /></td>
   </tr>
  </table>
 </form>
</center>
<?php } ?>
