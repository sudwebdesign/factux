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
 * File Name: fckconfig.js
 * 	Editor configuration settings.
 *
 * * * * Version:  8.0.0
 * * * * Modified: 07/06/2025
 *
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
$sql = "
SELECT nom, num_client
FROM " . $tblpref ."client
WHERE 1
and " . $tblpref ."client.permi LIKE '{$num_user},'
or  " . $tblpref ."client.permi LIKE '%,{$num_user},'
or  " . $tblpref ."client.permi LIKE '%,{$num_user},%'
or  " . $tblpref ."client.permi LIKE '{$num_user},%'
ORDER BY " . $tblpref ."client.nom DESC
";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
if(mysql_num_rows($req)>0){
	$tbllgn=($cl_sz>0)?"right":"left";#$cl_sz from edit_choix_cli.php
?>
<div class="left50">
 <table width='99%' border='0' class='page' align='<?php echo $tbllgn; ?>'>
  <caption><?php echo $lang_ret_cli_util; ?></caption>
  <tr>
   <th><?php echo $lang_client; ?></th>
   <th><?php echo $lang_action; ?></th>
  </tr>
<?php
$c=0;
while($data = mysql_fetch_array($req)){
 $num = $data['num_client'];
 $nom = $data['nom'];
 $line = $c++ & 1 ? "0" : "1";
?>
  <tr class="texte<?php echo $line; ?>" onmouseover="this.className='highlight'" onmouseout="this.className='texte<?php echo $line; ?>'">
   <td width='75%' class='<?php echo couleur_alternee (); ?>'><?php echo $nom; ?></td>
   <td width='25%' class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'>
    <form action="desactiver_client.php" method="post">
     <input type="hidden" name="num_client" value="<?php echo $num; ?>" />
     <input type="hidden" name="num_user" value="<?php echo $num_user; ?>" />
     <input type="submit" value="<?php echo $lang_retirer; ?>"/>
    </form>
   </td>
  </tr>
<?php } ?>
  <tr><td colspan="2" class="td2"></td></tr>
 </table>
</div>
<?php }
