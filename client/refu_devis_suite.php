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
require_once(__DIR__ . "/../include/verif_client.php");
include_once(__DIR__ . "/../include/config/common.php");
include_once(__DIR__ . "/../include/config/var.php");
include_once(__DIR__ . sprintf('/../include/language/%s.php', $lang));
include_once(__DIR__ . "/../include/utils.php");
include_once(__DIR__ . "/../include/headers.php");
include_once(__DIR__ . "/../include/finhead.php");
$num_dev=isset($_POST['num_dev'])?$_POST['num_dev']:"";
$login=isset($_POST['login'])?$_POST['login']:"";
$message=isset($_POST['message'])?$_POST['message']:"";
$sql2 = "UPDATE " . $tblpref .("devis SET resu = '-1' WHERE num_dev = " . $num_dev);
mysql_query($sql2) || die('Erreur SQL2 !<br>'.$sql2.'<br>'.mysql_error());
echo $lang_de_per;
$from = $mail ;
$to = $mail;
$subject = sprintf('%s %s %s', $lang_de_num, $num_dev, $lang_mail_ref) ;
$header = 'From: '.$from."\n"
 .'MIME-Version: 1.0'."\n"
 .'Content-Type: text/html; charset= ISO-8859-1'."\n"
 .'Content-Transfer-Encoding: 7bit'."\n\n";

if (mail($to,$subject,$message,$header)) {
    echo sprintf('<h2>%s</h2>', $lang_email_envoyé);
} else {
    echo sprintf('<h1>%s</h1>', $lang_email_envoi_err);
}

include_once(__DIR__ . "/client.php");

