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
 * File Name: ca_clients_parmois.php
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
?><html>
<head>
<title><?php echo "$lang_factux" ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="include/style.css">
</head>

<body>
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
if ($user_stat== n) { 
echo"<h1>$lang_statistique_droit";
exit;  
}
 ?> 
<?php
include_once("form_stat_client_inc.php");
$client=isset($_POST['client'])?$_POST['client']:"";	 
$annee=isset($_POST['an'])?$_POST['an']:"";	 
$sql = "SELECT nom from " . $tblpref ."client WHERE num_client = $client";
$req = mysql_query($sql);
$data = mysql_fetch_array($req);
$client_nom = $data["nom"];

//$annee = date("Y");
$calendrier = calendrier_local_mois ();
$sql = "SELECT SUM(tot_htva) FROM " . $tblpref ."bon_comm LEFT JOIN " . $tblpref ."client on client_num = num_client WHERE YEAR(date) = $annee  AND client_num = $client";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql2.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
$total = $data['SUM(tot_htva)'];

?>
<table class="boiteaction">
  <caption>
<?php echo "$lang_client: $client_nom $annee";  ?>
  </caption>

   
    <th><?php echo $lang_mois; ?></th>
    <th><?php echo $lang_ca_htva; ?></th>
    <th><?php echo $lang_pourcentage; ?></th>
  </tr>
  <?php

for ($i=1;$i<=12;$i++)
{

$sql = "SELECT SUM(tot_htva) FROM " . $tblpref ."bon_comm LEFT JOIN " . $tblpref ."client on client_num = num_client WHERE MONTH(date) = \"$i\" AND YEAR(date) = $annee  AND client_num = $client";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
$nom = $data['nom'];
$tot = $data['SUM(tot_htva)'];
$pourcentage = round($tot / $total * 100.0);
?>
<tr><td class='<?php echo couleur_alternee (); ?>'><?php echo $calendrier [$i]; ?></td>
  <td class='<?php echo couleur_alternee (FALSE,"nombre"); ?>'><?php echo montant_financier ($tot); ?></td>
    <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo stat_baton_horizontal("$pourcentage %"); ?></td>  
   </tr>
  <?php
}
?>
&
<?php
include("help.php");
include_once("include/bas.php");
?>
</body>
</html>
