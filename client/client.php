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
require_once("../include/verif_client.php");
//variables a modifier afin de parametrer l'affichage de l'interface client.
//
$devis_auth = "ok";//ok permet l'affichage des devis
$bon_auth = "ok";//ok permet l'affichage des bons de commnde
$fact_auth = "ok";//ok permet l'afichage des factures
//
//Ne rien modifier ci dessous
 ?> 
 <title><?php echo "$lang_factux" ?></title>
<table width="760" border="0" class="page" align="center">
<tr>
<td class="page" align="center">
</td>
</tr>
<tr>
<td  class="page" align="center">
<?php

include ("head.php");

if ($devis_auth == "ok") { 
  include ("lister_devis.php");
}
if ($bon_auth == "ok") { 
  include ("lister_commandes.php");
}
if ($fact_auth == "ok") { 
  include ("lister_factures.php");
}


include ("compte_client.php");
?>
</td></tr>
</table>
