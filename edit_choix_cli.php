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
$jour = date("d");
$mois = date("m");
$annee = date("Y");

$rqSql = "SELECT num_client, nom 
FROM " . $tblpref ."client 
WHERE (actif != 'non')
						 		 	 and (" . $tblpref ."client.permi NOT LIKE '$num_user,' )
		 			 				 and  (" . $tblpref ."client.permi NOT LIKE '%,$num_user,' )
									 and  (" . $tblpref ."client.permi NOT LIKE '%,$num_user,%' )
									 and  (" . $tblpref ."client.permi NOT LIKE '$num_user,%')  
ORDER BY nom";
$result = mysql_query( $rqSql ) or die( "Exécution requête impossible.");
?>
<td  class="page" align="center">
<form name="choisir_client" method="post" action="choisir_client.php" >
  <table class="boiteaction">
  <caption><?php echo "$lang_ajou_cli_util"; ?></caption>
<tr> 

  <td  class="texte0" colspan="2"><?php echo "$lang_client";?> </td>
  <td  class="texte0" colspan="2"><SELECT NAME='client[]' size="6" multiple>
      <?php
while ( $row = mysql_fetch_array( $result)) {
    $numclient = $row["num_client"];
    $nom = $row["nom"];
    ?>
      <OPTION VALUE='<?php echo $numclient; ?>'><?php echo $nom; ?></OPTION>
      <?
}
?>
    </SELECT>
		 </td>
		 <tr><td class="texte1" colspan="3"><?php echo $lang_multi_ctrl ?></td>
		 <input type="hidden" name="login" value="<?php echo $login ?>" />
		 </tr>
		 <tr>
<td class="submit" colspan="3"><input type="submit" value= "<?php echo $lang_envoyer ?>"/></td>
</tr>