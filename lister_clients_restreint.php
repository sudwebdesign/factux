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
$sql = "SELECT nom, num_client
       FROM " . $tblpref ."client 
	   WHERE 1
		 			 				 and " . $tblpref ."client.permi LIKE '$num_user,' 
		 			 				 or  " . $tblpref ."client.permi LIKE '%,$num_user,' 
									 or  " . $tblpref ."client.permi LIKE '%,$num_user,%' 
									 or  " . $tblpref ."client.permi LIKE '$num_user,%' 
		ORDER BY " . $tblpref ."client.nom DESC ";
		?></form>
<tr><td class='texte0'colspan='4'>&nbsp;</td></tr>
<tr><td class='submit' colspan='4'><?php echo $lang_ret_cli_util ?></td></tr>
<?php
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_array($req))
    {
		$num = $data['num_client'];
		$nom = $data['nom'];
?>
<tr>
<td  colspan="2" class='<?php echo couleur_alternee (); ?>'><?php echo $nom ?></td>
<td colspan="2" class='<?php echo couleur_alternee (FALSE); ?>'>
		<form action="retirer_client.php" method="post">
		<input type="hidden" name="num_client" value="<?php echo $num ?>" />
		<input type="hidden" name="num_user" value="<?php echo $num_user ?>" />
		<input type="submit" value="<?php echo $lang_retirer ?>"/>

</form></td>
</tr>
<?php 
}
 ?> 