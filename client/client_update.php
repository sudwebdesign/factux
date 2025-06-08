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

$login=isset($_POST['login'])?$_POST['login']:"";
$pass=isset($_POST['pass'])?$_POST['pass']:"";
$pass_new=isset($_POST['pass_new'])?$_POST['pass_new']:"";
$pass_new2=isset($_POST['pass_new2'])?$_POST['pass_new2']:"";
$num_client=isset($_POST['num_client'])?$_POST['num_client']:"";

if($pass=='' || $pass_new=='' || $pass_new2=='' || $login=='' ){
 echo sprintf('<h1>%s</h1>', $lang_err_chan_mdp);
 include(__DIR__ . '/client.php'); // On inclus le formulaire d'identification
 exit;
}

$sql2 = "SELECT * FROM " . $tblpref .('client WHERE num_client= ' . $num_client);
$req = mysql_query($sql2) or die('Erreur SQL !<br>'.$sql2.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
$ancienpass= $data['pass'];
if($ancienpass != md5($pass) ){
echo sprintf('<h1>%s</h1>', $lang_err_ancien_mdp);
 include(__DIR__ . '/client.php'); // On inclus le formulaire d'identification
 exit;
}

if($pass_new != $pass_new2){
 echo sprintf('<h1>%s</h1>', $lang_err_mdp_corr);
 include(__DIR__ . '/client.php');
 exit;
}

$pass = md5($pass_new);
$sql2 = "UPDATE " . $tblpref ."client SET pass='".$pass.("' WHERE num_client = " . $num_client);
mysql_query($sql2) || die(sprintf('<p>Erreur Mysql<br/>%s<br/>', $sql2).mysql_error()."</p>");

$sql2 = "SELECT * FROM " . $tblpref .('client WHERE num_client= ' . $num_client);
$req = mysql_query($sql2) or die('Erreur SQL !<br>'.$sql2.'<br>'.mysql_error());
while($data = mysql_fetch_array($req)){
 $to = $data['mail'];
}

$from = $mail ;
$subject = $lang_dif_mail_mdp;
$hide = substr($pass_new2, 1, -1);
$star = str_repeat('•', strlen($hide));
$hide = strtr($pass_new2, [$hide => $star]);
$message = sprintf('Cher client<br>%s<br><b>Login: %s %s %s</b><br>%s<br> ', $lang_mdp_jour, $login, $lang_mai_cr_pa, $hide, $lang_mai_cre_enc);
$header = 'From: '.$from."\r\n"
 .'MIME-Version: 1.0'."\r\n"
 .'Content-Type: text/html; charset= UTF-8'."\r\n"
 .'Content-Transfer-Encoding: 8bit'."\r\n\r\n";
if (mail($to,$subject,$message,$header)) {
    echo sprintf('<h2>%s %s</h2>', $lang_mdp_chang, $to);
} else {
    echo sprintf('<h1>%s</h1>', $lang_email_envoi_err);
}

include (__DIR__ . "/client.php");
