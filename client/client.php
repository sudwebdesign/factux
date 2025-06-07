<?php
/*
 * Factux le facturier libre
 * Copyright (C) 2003-2005 Guy Hendrickx, 2017~ Thomas Ingles
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
 * * * * Version:  8.0.0
 * * * * Modified: 07/06/2025
 *
 * File Authors:
 * 		Guy Hendrickx
 *.
 */

$now='../';
include_once(__DIR__ . "/../include/verif_client.php");
include_once(__DIR__ . "/../include/config/common.php");
include_once(__DIR__ . "/../include/config/var.php");
include_once(__DIR__ . sprintf('/../include/language/%s.php', $lang));
include_once(__DIR__ . "/../include/utils.php");
include_once(__DIR__ . "/../include/headers.php");
include_once(__DIR__ . "/../include/finhead.php");
?>
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php
/**/
if (!isset($login) && isset($_GET['login'])) {
    $login = $_GET['login'];
}

include (__DIR__ . "/head.php");
if ($auth_cli_devis == 'y') { // permet l'affichage des devis et permet leurs transformation en commandes par le client
 include (__DIR__ . "/lister_devis.php");
 echo"<br><br>";
}
if ($auth_cli_bon == 'y') { // permet l'affichage des bons de commnde
 include (__DIR__ . "/lister_commandes.php");
 echo"<br><br>";
}
if ($auth_cli_fact == 'y') { // permet l'afichage des factures
 include (__DIR__ . "/lister_factures.php");
 echo"<br><br>";
}
include (__DIR__ . "/compte_client.php");
?>
  </td>
 </tr>
</table>
