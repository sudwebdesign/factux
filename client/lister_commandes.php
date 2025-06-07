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
if (!isset($num_client)) {
    header("Location:index.php");
}

include_once(__DIR__ . "/../include/config/common.php");
include_once(__DIR__ . sprintf('/../include/language/%s.php', $lang));
include_once(__DIR__ . "/../include/config/var.php");
include_once(__DIR__ . "/../include/utils.php");
?>
<table class="page boiteaction">
 <caption><?php echo $lang_commandes; ?></caption>
 <tr>
  <th><?php echo $lang_numero; ?> </th>
  <th><?php echo $lang_date; ?></th>
  <th><?php echo $lang_total_h_tva; ?></th>
  <th><?php echo $lang_total_ttc; ?></th>
  <th><?php echo $lang_imprimer; ?></th>
 </tr>
<?php
$sql2 = "
SELECT num_bon, tot_htva, tot_tva, DATE_FORMAT(date,'%d/%m/%Y') AS date, nom FROM " . $tblpref ."bon_comm
LEFT JOIN " . $tblpref ."client on " . $tblpref ."bon_comm.client_num = num_client
WHERE client_num = '".$num_client."'
ORDER BY " . $tblpref ."bon_comm.num_bon DESC
";
$req2 = mysql_query($sql2) or die('Erreur SQL2 !<br>'.$sql2.'<br>'.mysql_error());
while($data = mysql_fetch_array($req2)){
?>
 <tr>
  <td class='<?php echo couleur_alternee (); ?>'><?php echo $data['num_bon']; ?></td>
  <td class='<?php echo couleur_alternee (FALSE, "c texte"); ?>'><?php echo $data['date']; ?></td>
  <td class='<?php echo couleur_alternee (FALSE,"nombre"); ?>'><?php echo montant_financier($data['tot_htva']); ?></td>
  <td class='<?php echo couleur_alternee (FALSE,"nombre"); ?>'><?php echo montant_financier($data['tot_htva']+$data['tot_tva']); ?></td>
  <td class='<?php echo couleur_alternee (FALSE, "c texte"); ?>'>
   <form action="../fpdf/bon_pdf.php" method="post" target="_blank">
    <input type="hidden" name="num_bon" value="<?php echo $data['num_bon']; ?>" />
    <input type="hidden" name="nom" value="<?php echo $data['nom']; ?>" />
    <input type="image" src="../image/printer.gif " alt="<?php echo $lang_imprimer; ?>" />
   </form>
  </td>
 </tr>
<?php } ?>
</table>
