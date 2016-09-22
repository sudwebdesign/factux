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
include_once("include/language/$lang.php");
include_once("include/utils.php");
?>
<html>
<head>

<title><?php echo "$lang_factux" ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="include/style.css">
<link rel="shortcut icon" type="image/x-icon" href="image/favicon.ico" >
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
$jour = date("d");
$mois = date("m");
$annee = date("Y");

$rqSql = "SELECT num_client, nom FROM " . $tblpref ."client WHERE actif != 'non' ORDER BY nom";
$result = mysql_query( $rqSql ) or die( "Exécution requête impossible.");

?>
<form name="choisir_client" method="post" action="choisir_client.php" >
  <table class="boiteaction">
  <caption><?php echo $lang_choi_cli_utis ?></caption>
<tr> 

  <td  class="texte0" colspan="2"><?php echo "$lang_client";?> </td>
  <td  class="texte0" colspan="2"><SELECT NAME='client[]' size="6" multiple>
      <?php
while ( $row = mysql_fetch_array( $result)) {
    $numclient = $row["num_client"];
    $nom = $row["nom"];
    ?>
      <OPTION VALUE='<?php echo $numclient; ?>'><?php echo $nom; ?></OPTION>
      <?
}
?>
    </SELECT>
		 </td>
		 <tr><td class="texte1" colspan="3"><?php echo $lang_ctrl ?></td>
		 <input type="hidden" name="login" value="<?php echo $login2 ?>" />
		 </tr>
		 <tr>
<td class="submit" colspan="3"><input type="submit" /></td>
</tr>