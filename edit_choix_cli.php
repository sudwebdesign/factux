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
 * File Name: fckconfig.js
 * 	Editor configuration settings.
 * 
 * * * Version:  1.1.5
 * * * * Modified: 23/07/2005
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
$rqSql = "
SELECT num_client, nom 
FROM " . $tblpref ."client 
WHERE (actif != 'non')
and (" . $tblpref ."client.permi NOT LIKE '$num_user,' )
and  (" . $tblpref ."client.permi NOT LIKE '%,$num_user,' )
and  (" . $tblpref ."client.permi NOT LIKE '%,$num_user,%' )
and  (" . $tblpref ."client.permi NOT LIKE '$num_user,%')  
ORDER BY nom";
$result = mysql_query( $rqSql ) or die( "Ex�cution requ�te impossible.");
$cl_sz=mysql_num_rows($result);
if($cl_sz>0){
?>
<div class="left50">
 <form name="choisir_client" method="post" action="choisir_client.php" >
  <table width='99%' border='0' class='page' align='left' class='boiteaction'>
   <caption><?php echo "$lang_ajou_cli_util"; ?></caption>
   <tr> 
    <td class="texte0" colspan="2"><?php echo $lang_clients;?></td>
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
    <td class="texte1" colspan="3"><?php echo $lang_multi_select_ctrl ?></td>
   </tr>
   <tr>
    <td class="submit" colspan="3"><input type="submit" value= "<?php echo $lang_ajouter ?>"/></td>
   </tr>
  </table>
  <input type="hidden" name="login" value="<?php echo $login ?>" />
 </form>
</div>
<?php } ?>
