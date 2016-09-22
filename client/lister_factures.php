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
$sql = "SELECT num, DATE_FORMAT(date_fact,'%d/%m/%Y') AS date_fact,  total_fact_ttc,
               payement, date_deb, DATE_FORMAT(date_deb,'%d/%m/%Y') AS date_deb2, date_fin,
               DATE_FORMAT(date_fin,'%d/%m/%Y') AS date_fin2
			   FROM " . $tblpref ."facture
			   WHERE CLIENT = '".$num_client."'"
               ." ORDER BY 'num' DESC";
$req = mysql_query($sql);
?>
     <table class="boiteaction">
      <caption><?php echo $lang_factures; ?></caption>
      <tr> 
        <th><?php echo $lang_numero; ?></th>
        <th><?php echo $lang_tot_ttc; ?></th>
        <th><?php echo $lang_date; ?></th>
        <th><?php echo $lang_pay; ?></th>
        <th><?php echo $lang_imprimer; ?></th>
      </tr>
     <?php

while($data = mysql_fetch_array($req))
{
  $debut = $data['date_deb2'];
  $debut2 = $data['date_deb'];
  $fin2 = $data['date_fin'];
  $payement = $data['payement'];
  $num = $data['num'];
  $total = $data['total_fact_ttc'];
  $date_fact = $data['date_fact'];
?>
      <tr> 
        <td class='<?php echo couleur_alternee (); ?>'><?php echo $num; ?></td>
        <td class='<?php echo couleur_alternee (FALSE, "nombre"); ?>'><?php echo montant_financier($total); ?></td>
        <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo $date_fact; ?></td>
        <td  class='<?php echo couleur_alternee (FALSE); ?>'><?php echo $payement; ?></td>
        <td class='<?php echo couleur_alternee (FALSE); ?>'> 
				<form action="../fpdf/fact_pdf.php" method="post" target="_blanck">
				<input type="hidden" name="client" value="<?php echo $num_client; ?>" />
				<input type="hidden" name="debut" value="<?php echo $debut2; ?>" />
				<input type="hidden" name="fin" value="<?php echo $fin2; ?>" />
				<input type="hidden" name="num" value="<?php echo $num; ?>" />
				<input type="image" src="../image/printer.gif" alt="imprimer" />

</form>
 </td></tr>
		<?php
		}
?>
    </table>
<br><br>