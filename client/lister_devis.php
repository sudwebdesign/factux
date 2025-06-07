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

include_once(__DIR__ . "/../include/verif_client.php");
include_once(__DIR__ . "/../include/config/common.php");
include_once(__DIR__ . sprintf('/../include/language/%s.php', $lang));
include_once(__DIR__ . "/../include/config/var.php");
include_once(__DIR__ . "/../include/utils.php");
$sql3 = "
SELECT num_dev, tot_htva, tot_tva, DATE_FORMAT(date,'%d/%m/%Y') AS date, nom
FROM " . $tblpref ."devis
LEFT JOIN " . $tblpref ."client  on " . $tblpref ."devis.client_num = num_client
WHERE client_num = '".$num_client."'
AND resu = '0'
ORDER BY " . $tblpref ."devis.num_dev DESC
";
$req3 = mysql_query($sql3) or die('Erreur SQL3 !<br>'.$sql3.'<br>'.mysql_error());
?>
<table class="page boiteaction">
 <caption><?php echo $lang_devis_pluriel; ?></caption>
 <tr>
  <th><?php echo $lang_numero; ?></th>
  <th><?php echo $lang_date; ?></th>
  <th><?php echo $lang_total_h_tva; ?></th>
  <th><?php echo $lang_total_ttc; ?></th>
  <th><?php echo $lang_refu; ?></th>
  <th><?php echo $lang_accepter; ?></th>
  <th><?php echo $lang_imprimer; ?></th>
 </tr>
  <?php
while($data = mysql_fetch_array($req3)){
 $num_dev = $data['num_dev'];
 $total = $data['tot_htva'];
 $tva = $data['tot_tva'];
 $date = $data['date'];
 $nom = $data['nom'];
 $ttc = $total + $tva ;
?>
 <tr>
  <td class="<?php echo couleur_alternee (); ?>"><?php echo $num_dev; ?></td>
  <td class="<?php echo couleur_alternee (FALSE, "c texte"); ?>"><?php echo $date; ?></td>
  <td class="<?php echo couleur_alternee (FALSE, "nombre"); ?>"><?php echo montant_financier ($total); ?></td>
  <td class="<?php echo couleur_alternee (FALSE, "nombre"); ?>"><?php echo montant_financier ($ttc); ?></td>
  <td class="<?php echo couleur_alternee (FALSE, "c texte"); ?>">
   <a href="refu_devis.php?num_dev=<?php echo $num_dev ?>&login=<?php echo $login ?>">
    <img src="../image/delete.jpg" border="0" alt="<?php echo $lang_refu; ?>">
   </a>
  </td>
  <td class="<?php echo couleur_alternee (FALSE, "c texte"); ?>">
   <a href="pre_convert.php?num_dev=<?php echo $num_dev ?>&login=<?php echo $login ?>">
    <img src="../image/ok.jpg" border="0" alt="<?php echo $lang_accepter; ?>">
   </a>
  </td>
  <td class="<?php echo couleur_alternee (FALSE, "c texte"); ?>">
   <form action="../fpdf/devis_pdf.php" method="post" target="_blank">
    <input type="hidden" name="num_dev" value="<?php echo $num_dev; ?>" />
    <input type="hidden" name="nom" value="<?php echo $nom; ?>" />
    <input type="image" src="../image/printer.gif" alt="<?php echo $lang_imprimer; ?>" />
   </form>
  </td>
 </tr>
<?php } ?>
</table>
