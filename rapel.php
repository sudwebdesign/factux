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
include_once("include/headers.php");
$client=isset($_GET['client'])?$_GET['client']:"";
?>
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php include_once("include/head.php"); ?>
   <form name="form_bon" method="post" action="fpdf/rapel_pdf.php" target="_blank">
    <table class="page boiteaction">
     <caption><?php echo"$lang_rappel";?></caption>
     <tr>
      <td class="page" align="center">
       <input type="hidden" name="client" value='<?php echo $client ?>'>
       <select name='rapel_num'>"
        <option value='0'><?php echo $lang_choisissez ?></option>
        <option value='1'><?php echo "$lang_premier $lang_rappel" ?></option>
        <option value='2'><?php echo "$lang_deuxieme $lang_rappel" ?></option>
        <option value='3'><?php echo "$lang_troisieme $lang_rappel" ?></option>
       </select>
      </td>
     </tr>
<?php 
$rqSql = "
SELECT TO_DAYS(NOW()) - TO_DAYS(date_fact) AS peri, client, date_deb, date_fin, total_fact_ttc, num, nom, DATE_FORMAT(date_fact,'%d/%m/%Y') AS date_fact 
FROM " . $tblpref ."facture 
LEFT JOIN " . $tblpref ."client on " . $tblpref ."facture.client = " . $tblpref ."client.num_client 
WHERE payement = 'non' 
AND " . $tblpref ."client.num_client = $client 
ORDER BY peri DESC
";
$result = mysql_query( $rqSql ) or die('Erreur SQL !<br>'. $rqSql.'<br>'.mysql_error());
while ( $row = mysql_fetch_array( $result)) {
$num = $row["num"];
$nom = $row["nom"];
$peri = $row["peri"];
$total = $row["total_fact_ttc"];
?>
     <tr>
      <td>
       <input type='checkbox' name='choix[]' value='<?php echo $num; ?>'>
         <?php echo $lang_facture.' '.$num.' '.$lang_de.' '.$nom.' '.$lang_pour_mont.' '.montant_financier($total).' '.$lang_envoyée_depuis.' '.$peri.' '.$lang_jours; ?>
      </td>
     </tr>
<?php } ?>
     <tr>
      <td><input type="submit" value="<?php echo $lang_envoyer; ?>"></td>
     </tr>
    </table>
   </form>
  </td>
 </tr>
 <tr>
  <td>
<?php
$aide = 'rappel';
include("help.php");
include_once("include/bas.php");
?>
  </td>
 </tr>
</table>
</body>
</html>
