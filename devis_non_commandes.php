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
require_once("include/verif.php");
include_once("include/config/common.php");
include_once("include/config/var.php");
include_once("include/language/$lang.php");
include_once("include/utils.php");
include_once("include/headers.php");
include_once("include/finhead.php");
?>
<SCRIPT language="JavaScript" type="text/javascript">
		function confirmDelete()
		{
		var agree=confirm('<?php echo "$lang_con_dev_effa"; ?>');
		if (agree)
		 return true ;
		else
		 return false ;
		}
		</script>

<table width="760" border="0" class="page" align="center">
<tr>
<td class="page" align="center">
<?php
include_once("include/head.php");
?>
</td>
</tr>
<tr>
<td  class="page" align="center">
<?php 
if ($user_dev == n) {
echo "<h1>$lang_devis_droit"; 
exit;  
}
 ?>
<?php
$num_dev=isset($_GET['num_dev'])?$_GET['num_dev']:"";
if ($num_dev !='') { 
$sql2 = "UPDATE " . $tblpref ."devis SET resu='per' WHERE num_dev= $num_dev";
mysql_query($sql2) or die('Erreur SQL2 !<br>'.$sql2.'<br>'.mysql_error());
echo "$lang_de_per";
  
}
?>
<center><table class="boiteaction">
  <caption><?php echo $lang_devis_perdus; ?></caption>
        <?php
$sql = "SELECT num_dev, tot_htva, tot_tva, DATE_FORMAT(date,'%d/%m/%Y') AS date, nom FROM " . $tblpref ."devis RIGHT JOIN " . $tblpref ."client on " . $tblpref ."devis.client_num = num_client WHERE num_dev >0 AND  resu = 'per' ORDER BY " . $tblpref ."devis.num_dev DESC ";
if ($user_dev == r) { 
$sql = "SELECT num_dev, tot_htva, tot_tva, DATE_FORMAT(date,'%d/%m/%Y') AS date, nom FROM " . $tblpref ."devis RIGHT JOIN " . $tblpref ."client on " . $tblpref ."devis.client_num = num_client WHERE num_dev >0 AND  resu = 'per'  
		 			 				 AND " . $tblpref ."client.permi LIKE '$user_num,' 
		 			 				 or  " . $tblpref ."client.permi LIKE '%,$user_num,' 
									 or  " . $tblpref ."client.permi LIKE '%,$user_num,%' 
									 or  " . $tblpref ."client.permi LIKE '$user_num,%' ORDER BY " . $tblpref ."devis.num_dev DESC";
}
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
?>
        <tr>
          <th><?php echo $lang_devis_numero; ?></th>
          <th><?php echo $lang_client; ?></th>
          <th><?php echo $lang_devis_date; ?></th>
          <th><?php echo $lang_total_h_tva; ?></th>
          <th><?php echo $lang_total_ttc; ?></th>
          <th colspan ="2"><?php echo $lang_action; ?></th>
        </tr>
        <?php
while($data = mysql_fetch_array($req))
    {
		$num_dev = $data['num_dev'];
		$total = $data['tot_htva'];
		$tva = $data['tot_tva'];
		$date = $data['date'];
		$nom = $data['nom'];
		$ttc = $total + $tva ;
		?>
        <tr> 
          <td class='<?php echo couleur_alternee (); ?>'><?php echo $num_dev; ?></td>
          <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo $nom; ?></td>
          <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo $date; ?></td>
          <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo montant_financier($total); ?></td>
          <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo montant_financier($ttc); ?></td>
          <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo "<a href=\"delete_dev_suite.php?num_dev=$num_dev&amp;nom=$nom\" onClick='return confirmDelete()'><img border='0' src='image/delete.jpg' alt='effacer'></a> "?>
					<td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo "<a href=\"fpdf/devis_pdf.php?num_dev=$num_dev&amp;nom=$nom&amp;pdf_user=adm\" target='_blank' ><img border='0' src='image/printer.gif' alt='imprimer'></a><br>" ?> 
          </td>
        </tr>
        <?php
		}
 ?>
      </table></center>
      <?php
$aide="Devis";
?>
</td></tr><tr><td>

<?php
include("help.php");
echo"</td></tr><tr><td>";
include_once("include/bas.php");
?>
</td></tr>
</table>
</body>
</html>
