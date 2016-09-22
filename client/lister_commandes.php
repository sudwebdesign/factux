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
      <caption><?php echo $lang_commandes; ?></caption>
<?php
include_once("../include/config/common.php");
include_once("../include/language/$lang.php");
include_once("../include/config/var.php");
include_once("../include/utils.php");
$sql2 = "SELECT num_bon, tot_htva, tot_tva, DATE_FORMAT(date,'%d/%m/%Y') AS date, nom FROM " . $tblpref ."bon_comm RIGHT JOIN " . $tblpref ."client on " . $tblpref ."bon_comm.client_num = num_client WHERE client_num = '".$num_client."' ORDER BY " . $tblpref ."bon_comm.num_bon DESC ";
$req2 = mysql_query($sql2) or die('Erreur SQL2 !<br>'.$sql2.'<br>'.mysql_error());
?>
      <tr> 
        <th><?php echo $lang_numero; ?> </th>
        <th><?php echo $lang_client; ?></th>
        <th><?php echo $lang_date; ?></th>
        <th><?php echo $lang_total_h_tva; ?></th>
        <th><?php echo $lang_total_ttc; ?></th>
        <th><?php echo $lang_imprimer; ?></th>
      </tr>
      <?php
while($data = mysql_fetch_array($req2))
    {
		$num_bon = $data['num_bon'];
		$total = $data['tot_htva'];
		$tva = $data['tot_tva'];
		$date = $data['date'];
		$nom = $data['nom'];
		$ttc = $total + $tva ;
		?>
      <tr> 
        <td class='<?php echo couleur_alternee (TRUE,"nombre"); ?>'><?php echo $num_bon; ?></td>
        <td  class='<?php echo couleur_alternee (FALSE); ?>'><?php echo $nom; ?></td>
        <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo $date; ?></td>
        <td  class='<?php echo couleur_alternee (FALSE,"nombre"); ?>'><?php echo montant_financier($total); ?></td>
        <td class='<?php echo couleur_alternee (FALSE,"nombre"); ?>'>
		<?php echo montant_financier($ttc); ?></td>
        <td class='<?php echo couleur_alternee (FALSE); ?>'>
				<form action="../fpdf/bon_pdf.php" method="post" target="_blank">
				<input type="hidden" name="num_bon" value="<?php echo $num_bon; ?>" />
				<input type="hidden" name="nom" value="<?php echo $nom; ?>" />
<input type="image" src="../image/printer.gif " alt="imprimer" />
</form> 
</td>
      </tr>
        <?php 
		}
    ?>
	</table>
<br><br>