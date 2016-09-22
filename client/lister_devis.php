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
 include_once("../include/config/common.php");
include_once("../include/language/$lang.php");
include_once("../include/config/var.php");
include_once("../include/utils.php");
$sql3 = "SELECT num_dev, tot_htva, tot_tva, DATE_FORMAT(date,'%d/%m/%Y') AS date, nom
       FROM " . $tblpref ."devis RIGHT JOIN " . $tblpref ."client  on " . $tblpref ."devis.client_num = num_client
	   WHERE client_num = '".$num_client."' AND resu = '0' ORDER BY " . $tblpref ."devis.num_dev DESC ";
$req3 = mysql_query($sql3) or die('Erreur SQL3 !<br>'.$sql3.'<br>'.mysql_error());
?>
<table class="boiteaction">
  <caption>
  <?php echo $lang_devis_pluriel; ?> 
  </caption>
  <tr> 
    <th><?php echo $lang_numero; ?></th>
    <th><?php echo $lang_client; ?></th>
    <th><?php echo $lang_date; ?></th>
    <th><?php echo $lang_total_h_tva; ?></th>
    <th><?php echo $lang_total_ttc; ?></th>
    <th><?php echo $lang_imprimer; ?></th>
		<th><?php echo $lang_accepter ?> </th>
		<th><?php echo $lang_refu ?></th>
  </tr>
  <?php
while($data = mysql_fetch_array($req3))
{
  $num_dev = $data['num_dev'];
  $total = $data['tot_htva'];
  $tva = $data['tot_tva'];
  $date = $data['date'];
  $nom = $data['nom'];
  $ttc = $total + $tva ;
?>
  <tr> 
    <td class="<?php echo couleur_alternee (); ?>"><?php echo  $num_dev; ?></td>
    <td class="<?php echo couleur_alternee (FALSE); ?>"><?php echo $nom; ?></td>
    <td class="<?php echo couleur_alternee (FALSE); ?>"><?php echo $date; ?></td>
    <td class="<?php echo couleur_alternee (FALSE, "nombre"); ?>"><?php echo montant_financier ($total); ?></td>
    <td class="<?php echo couleur_alternee (FALSE, "nombre"); ?>"><?php echo montant_financier ($ttc); ?></td>
    <td class="<?php echo couleur_alternee (FALSE); ?>">
		<form action="../fpdf/devis_pdf.php" method="get" target="_blank">
		<input type="hidden" name="num_dev" value="<?php echo $num_dev; ?>" />
		<input type="hidden" name="nom" value="<?php echo $nom; ?>" />
		<input type="image" src="../image/printer.gif" alt="impimer" />

</form>

</td>
		 <td class="<?php echo couleur_alternee (FALSE); ?>"><a href="pre_convert.php?num_dev=<?php echo $num_dev ?>&login=<?php echo $login ?>"><img src="../image/ok.jpg" border="0" alt=""></a></td>
		 <td class="<?php echo couleur_alternee (FALSE); ?>"><a href="refu_devis.php?num_dev=<?php echo $num_dev ?>&login=<?php echo $login ?>"><img src="../image/delete.jpg" border="0" alt=""></a></td>
  </tr>
  <?php 
		}
?>
</table>
<br>
<br>
