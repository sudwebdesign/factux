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
 ?> 
<table class="boiteaction">
  <caption>
<?php echo "$lang_factux" ?> ?>
  </caption>

  <tr> 
    <td class='td2'><?php echo $lang_client; ?></td>
    <td class='td2'><?php echo "$lang_total_annee $annee"; ?></td>
  </tr>
  <?php
for ($i=1;$i<=$nb;$i++)
{

$sql = "SELECT SUM(tot_htva), nom FROM  " . $tblpref ."bon_comm RIGHT JOIN " . $tblpref ."client on client_num = num_client WHERE client_num =\"$i\" AND Year(date)= $annee GROUP BY nom";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
$nom = $data['nom'];
$tot = $data['SUM(tot_htva)'];
$total = $tot2;
$tot = number_format( round( ($tot*100)/$total), 0, ",", " ");
$barre = floor($tot)*3;
?>
  <tr> 
    <td class="<?php echo couleur_alternee (); ?>"><?php echo $nom; ?></td>
    <td class='tdgraph' width='300' height='30'>
	<img src='image/barre.gif' width='<?php echo $barre; ?>' height='10'><font size=4><?php echo "$tot%"; ?></font></td>
  </tr>
  <?php
}

?>
</table>
