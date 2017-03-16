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
if(!isset($num_client))
 header("Location:index.php");

include_once("../include/config/common.php");
include_once("../include/language/$lang.php");
include_once("../include/config/var.php");
include_once("../include/utils.php");
$sql = "
SELECT num, DATE_FORMAT(date_fact,'%d/%m/%Y') AS date_fact,  total_fact_ttc,
payement, date_deb, DATE_FORMAT(date_deb,'%d/%m/%Y') AS date_deb2, date_fin,
DATE_FORMAT(date_fin,'%d/%m/%Y') AS date_fin2
FROM " . $tblpref ."facture
WHERE client = '".$num_client."'
ORDER BY 'num' DESC
";
$req = mysql_query($sql);
?>
<table class="page boiteaction">
 <caption><?php echo $lang_factures; ?></caption>
  <tr> 
   <th><?php echo $lang_numero; ?></th>
   <th><?php echo $lang_date; ?></th>
   <th><?php echo $lang_tot_ttc; ?></th>
   <th><?php echo $lang_pay; ?></th>
   <th><?php echo $lang_imprimer; ?></th>
  </tr>
<?php
while($data = mysql_fetch_array($req)){
  $debut = $data['date_deb2'];
  $debut2 = $data['date_deb'];
  $fin2 = $data['date_fin'];
  $pay = $data['payement'];
  $num = $data['num'];
  $total = $data['total_fact_ttc'];
  $date_fact = $data['date_fact'];
 switch ($pay) {
  case "carte":$pay=$lang_carte_ban;break;
  case "Especes":$pay=$lang_liquide;break;
  case "ok":$pay=$lang_pay_ok;break;
  case "Cheque":$pay=$lang_paypal;break;
  case "virement":$pay=$lang_virement;break;
  case "visa":$pay=$lang_visa;break;
  case "non":$pay=$lang_non_pay;break;
 }
?>
 <tr> 
  <td class='<?php echo couleur_alternee (); ?>'><?php echo $num; ?></td>
  <td class='<?php echo couleur_alternee (FALSE, "c texte"); ?>'><?php echo $date_fact; ?></td>
  <td class='<?php echo couleur_alternee (FALSE, "nombre"); ?>'><?php echo montant_financier($total); ?></td>
  <td class='<?php echo couleur_alternee (FALSE, "c texte"); ?>'><?php echo $pay; ?></td>
  <td class='<?php echo couleur_alternee (FALSE, "c texte"); ?>'> 
  <form action="../fpdf/fact_pdf.php" method="post" target="_blank">
    <input type="hidden" name="client" value="<?php echo $num_client; ?>" />
    <input type="hidden" name="debut" value="<?php echo $debut2; ?>" />
    <input type="hidden" name="fin" value="<?php echo $fin2; ?>" />
    <input type="hidden" name="num" value="<?php echo $num; ?>" />
    <input type="image" src="../image/printer.gif" alt="<?php echo $lang_imprimer; ?>" />
   </form>
  </td>
 </tr>
<?php } ?>
</table>
