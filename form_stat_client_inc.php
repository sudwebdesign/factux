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
 * File Name: form_stat_client_inc.php
 * 	Editor configuration settings.
 * 
 * * * Version:  1.1.5
 * * * * Modified: 23/07/2005
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
 ?> <form name="form_bon" method="post" action="ca_client_parmois.php">
  <table class="boiteaction">
  <caption>
<?php echo $lang_statistiques_par_client; ?>
  </caption>

    <tr>
      <td colspan="3"class="titretableau"><?php echo $lang_statistiques_par_client; ?></td>
    </tr>
    <tr>
      <td class="td2"><?php echo $lang_client; ?></td><td colspan="2"class="td2">année
    </tr>
	<tr>
	<td><?php
$rqSql ="SELECT num_client, nom FROM " . $tblpref ."client WHERE actif != 'non'ORDER BY nom"; 
$result = mysql_query( $rqSql )
             or die( "Exécution requête impossible.");
?>
    <SELECT NAME='client'>
      <OPTION VALUE=0>Choisissez</OPTION>

      <?php
while ( $row = mysql_fetch_array( $result)) {
    $numclient = $row["num_client"];
    $nom = $row["nom"];
    ?>
	<OPTION VALUE='<?php echo $numclient; ?>'><? echo $nom; ?> </OPTION>
	<?
}
?>
    </SELECT>
	</td>
	<td>année<td><select name="an"><option value="2004"><?php $date=(date("Y")-1);echo"$date"; ?></option><option value="2005"><?php $date=date("Y");echo"$date"; ?></option></select></tr>
	<tr><td colspan="3">
    <input type="submit" name="Submit" value="<? echo $lang_envoyer; ?>"></td></tr></table>
</form>