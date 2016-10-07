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
include_once("include/headers.php");
include_once("include/finhead.php");
$type =isset($_GET['type'])?$_GET['type']:"";
$email =isset($_GET['mail'])?$_GET['mail']:"";
//p?type=comm&mail=$mail
?>
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php
include_once("include/head.php");
if ($type == 'comm') { 
$titre = $lang_notifi_titre_bon;
$message = $lang_notifi_message_bon;
}
if ($type == 'fact') { 
$titre = $lang_notifi_titre_fact;  
$message = $lang_notifi_message_fact;
}
if ($type == 'devis') { 
$titre = $lang_notifi_titre_dev;
$message = $lang_notifi_message_dev;
}
$to = "$email";
$from = "$entrep_nom<$mail>" ;
$subject = "$titre" ;
$header = 'From: '.$mail ."\n"
 .'MIME-Version: 1.0'."\n"
 .'Reply-To: '.$from."\n"
 .'X-priority: 3 (Normal)'."\n"
 .'X-Mailer: Factux'."\n"
 .'Content-Type: text/html; charset= ISO-8859-1; charset= ISO-8859-1'."\n"
 .'Content-Transfer-Encoding: 8bit'."\n\n";
if(mail($to,$subject,$message,$header))
 $message = "<h2>$lang_notifi_cli</h2>";
else
 $message = "<h1>$lang_notifi_cli_non</h1>";#<br>$message
if ($type == 'comm') {
include_once("lister_commandes.php");
}
if ($type == 'fact') { 
include_once("lister_factures.php");
}
if ($type == 'devis') { 
include_once("lister_devis.php");
}
