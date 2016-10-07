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

$now='../';
include_once("../include/verif_client.php");
include_once("../include/config/common.php");
include_once("../include/config/var.php");
include_once("../include/language/$lang.php");
include_once("../include/utils.php");
include_once("../include/headers.php");
include_once("../include/finhead.php");
?> 
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php
/**/
if(!isset($login))
 if(isset($_GET['login']))
  $login = $_GET['login'];

include ("head.php");
if ($auth_cli_devis == 'y') { // permet l'affichage des devis et permet leurs transformation en commandes par le client
 include ("lister_devis.php");echo"<br><br>";
}
if ($auth_cli_bon == 'y') { // permet l'affichage des bons de commnde
 include ("lister_commandes.php");echo"<br><br>";
}
if ($auth_cli_fact == 'y') { // permet l'afichage des factures
 include ("lister_factures.php");echo"<br><br>";
}
include ("compte_client.php");
?>
  </td>
 </tr>
</table>
