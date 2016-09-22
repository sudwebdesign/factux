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
$devis_auth = $auth_cli_devis;// permet l'affichage des devis et permet leurs transformation en commandes par le client
$bon_auth = $auth_cli_bon;// permet l'affichage des bons de commnde
$fact_auth = $auth_cli_fact;// permet l'afichage des factures
if ($devis_auth == 'y') { 
 include ("lister_devis.php");echo"<br><br>";
}
if ($bon_auth == 'y') { 
 include ("lister_commandes.php");echo"<br><br>";
}
if ($fact_auth == 'y') { 
 include ("lister_factures.php");echo"<br><br>";
}
include ("compte_client.php");
?>
  </td>
 </tr>
</table>
