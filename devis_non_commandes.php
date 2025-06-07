<?php
/*
 * Factux le facturier libre
 * Copyright (C) 2003-2005 Guy Hendrickx, 2017~ Thomas Ingles
 *
 * Licensed under the terms of the GNU  General Public License:
 *   http://opensource.org/licenses/GPL-3.0
 *
 * For further information visit:
 *   http://factux.free.fr
 *
 * File Name: fckconfig.js
 *  Editor configuration settings.
 *
 * * * * Version:  8.0.0
 * * * * Modified: 07/06/2025
 *
 * File Authors:
 *   Guy Hendrickx
 *.
 */
include_once(__DIR__ . "/include/headers.php");
?><script type="text/javascript" src="javascripts/confdel.js"></script><?php
include_once(__DIR__ . "/include/finhead.php");
?>
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php
include_once(__DIR__ . "/include/head.php");
if ($user_dev == 'n') {
 echo sprintf('<h1>%s</h1>', $lang_devis_droit);
 include_once(__DIR__ . "/include/bas.php");
 exit;
}
$num_dev=isset($_GET['num_dev'])?$_GET['num_dev']:"";
if ($num_dev !='') {
 $sql2 = "UPDATE " . $tblpref .("devis SET resu = '-1' WHERE num_dev = " . $num_dev);
 mysql_query($sql2) || die('Erreur SQL2 !<br>'.$sql2.'<br>'.mysql_error());
 echo sprintf('<p>%s</p>', $lang_de_per);
}
?>
   <center>
    <table class='page boiteaction'>
     <caption><?php echo $lang_devis_perdus; ?></caption>
     <tr>
      <th><?php echo $lang_numero; ?></th>
      <th><?php echo $lang_client; ?></th>
      <th><?php echo $lang_date; ?></th>
      <th><?php echo $lang_total_h_tva; ?></th>
      <th><?php echo $lang_total_ttc; ?></th>
      <th colspan ="2"><?php echo $lang_action; ?></th>
     </tr>
<?php
$sql = "
SELECT num_dev, tot_htva, tot_tva, DATE_FORMAT(date,'%d/%m/%Y') AS date, nom
FROM " . $tblpref ."devis
LEFT JOIN " . $tblpref ."client on " . $tblpref ."devis.client_num = num_client
WHERE num_dev >0 AND resu = '-1'";
if ($user_dev == 'r') {
$sql .= "
AND " . $tblpref ."client.permi LIKE '{$user_num},'
or  " . $tblpref ."client.permi LIKE '%,{$user_num},'
or  " . $tblpref ."client.permi LIKE '%,{$user_num},%'
or  " . $tblpref .sprintf("client.permi LIKE '%s,%%'", $user_num);
}
$sql .= "
ORDER BY " . $tblpref ."devis.num_dev DESC ";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$c=0;
while($data = mysql_fetch_array($req)){
 $num_dev = $data['num_dev'];
 $total = $data['tot_htva'];
 $tva = $data['tot_tva'];
 $date = $data['date'];
 $nom = $data['nom'];
 $ttc = $total + $tva ;
 $line = $c++ & 1 ? "0" : "1";
?>
     <tr class="texte<?php echo $line; ?>" onmouseover="this.className='highlight'" onmouseout="this.className='texte<?php echo $line; ?>'">
      <td class='<?php echo couleur_alternee (); ?>'><?php echo $num_dev; ?></td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo $nom; ?></td>
      <td class='<?php echo couleur_alternee (FALSE, "c texte"); ?>'><?php echo $date; ?></td>
      <td class='<?php echo couleur_alternee (FALSE, "nombre"); ?>'><?php echo montant_financier($total); ?></td>
      <td class='<?php echo couleur_alternee (FALSE, "nombre"); ?>'><?php echo montant_financier($ttc); ?></td>
      <td class='<?php echo couleur_alternee (FALSE, "c texte"); ?>'>
       <a href="delete_dev.php?num_dev=<?php echo $num_dev; ?>&amp;nom=<?php echo $nom; ?>"
         onClick='return confirmDelete("<?php echo $lang_con_dev_effa; ?>")'>
        <img border='0' src='image/delete.jpg' alt='<?php echo $lang_effacer; ?>'>
       </a>
      </td>
      <td class='<?php echo couleur_alternee (FALSE, "c texte"); ?>'>
       <form action="fpdf/devis_pdf.php" method="post" target="_blank">
        <input type="hidden" name="num_dev" value="<?php echo $num_dev; ?>" />
        <input type="hidden" name="nom" value="<?php echo $nom; ?>" />
        <input type="hidden" name="user" value="adm" />
        <input type="image" src="image/printer.gif" style="border:none;margin:0;" alt="<?php echo $lang_imprimer; ?>" />
       </form>
      </td>
     </tr>
<?php } ?>
    </table>
   </center>
  </td>
 </tr>
 <tr>
  <td>
<?php
$aide='devis';
include(__DIR__ . "/help.php");
include_once(__DIR__ . "/include/bas.php");
?>
  </td>
 </tr>
</table>
</body>
</html>
