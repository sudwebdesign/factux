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
include_once("../include/config/common.php");
include_once("../include/config/var.php");
include_once("../include/language/$lang.php");
echo '<link rel="stylesheet" type="text/css" href="../include/style.css">';
$num_dev=isset($_POST['num_dev'])?$_POST['num_dev']:"";
$login=isset($_POST['login'])?$_POST['login']:"";
$message=isset($_POST['message'])?$_POST['message']:"";
$sql2 = "UPDATE " . $tblpref ."devis SET resu='per' WHERE num_dev= $num_dev";
mysql_query($sql2) or die('Erreur SQL2 !<br>'.$sql2.'<br>'.mysql_error());
echo "$lang_de_per";
$from = "$mail" ;
$to = "$mail";
$subject = "$lang_de_num $num_dev $lang_mail_ref" ;
$header = 'From: '.$from."\n"
 .'MIME-Version: 1.0'."\n"
 .'Content-Type: text/html; charset= ISO-8859-1'."\n"
 .'Content-Transfer-Encoding: 7bit'."\n\n";

mail($to,$subject,$message,$header);
include_once("client.php");
 ?> 