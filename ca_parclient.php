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
 * File Name: ca_parclient.php
 * 	Statistiques du chiffre d'affaire par clients
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
<table width="760" border="0" class="page" align="center">
<tr>
<td class="page" align="center">
<?php
include_once("include/head.php");
?>
</td></tr>
<tr>
<td><form action="ca_parclient.php" method="post" name="annee">
année <select name="an">
<option value="<?php $date=(date("Y")-1);echo"$date"; ?>"><?php echo"$date"; ?></option>
<option value="<?php $date=date("Y");echo"$date"; ?>"><?php echo"$date"; ?></option></select><input type="submit" /></form>
<tr>

<td  class="page" align="center">
<?php 
if ($user_stat== n) { 
echo"<h1>$lang_statistique_droit";
exit;  
}
if($_POST['an'] !=''){
$annee = $_POST['an'];
}
 ?> 
<?php	
if ($annee =='') { 
$annee = date("Y");  
}

$sql = "SELECT num_client FROM " . $tblpref ."client";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql2.'<br>'.mysql_error());
$nb = mysql_num_rows($req);
?>
<table class="boiteaction">
  <caption>
<?php echo "$lang_ca_par_client $annee" ?>
  </caption>
  <tr> 
    <th><?php echo $lang_client; ?></th>
    <th><?php echo $lang_montant; ?></th>
    <th><?php echo $lang_pourcentage;?></th>
  </tr>
  <?php
//pour le total
$sql = "SELECT SUM(tot_htva)FROM " . $tblpref ."bon_comm";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
$total = $data['SUM(tot_htva)'];

for ($i=1;$i<=$nb;$i++)
{

$sql = "SELECT SUM(tot_htva), nom FROM " . $tblpref ."bon_comm LEFT JOIN " . $tblpref ."client on client_num = num_client WHERE client_num =\"$i\" AND YEAR(date) = $annee GROUP BY nom ";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
$nom = $data['nom'];
$tot = montant_financier ($data['SUM(tot_htva)']);
$pourcentage = number_format( round( ($tot*100)/$total), 0, ",", " ");
?>
  <tr>
    <td class='<?php echo couleur_alternee (); ?>'><?php echo $nom; ?></td>
    <td  class='<?php echo couleur_alternee (FALSE, "nombre"); ?>'><?php echo $tot; ?></td>
    <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo stat_baton_horizontal("$pourcentage %"); ?></td>
  </tr>
  <?php
}

?>
  <tr> 
          <td class='totaltexte'><?php echo $lang_total; ?></td>
    <td  class='totalmontant'><?php echo montant_financier ($total); ?></td>
    <td class='td2'>&nbsp;</td>
  </tr></table><tr><td>

<?php
include("help.php");
echo"</td></tr><tr><td>";
include_once("include/bas.php");
?>
</td></tr></table></body>
</html>
