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
require_once(__DIR__ . "/include/verif.php");
include_once(__DIR__ . "/include/config/common.php");
include_once(__DIR__ . "/include/config/var.php");
include_once(__DIR__ . sprintf('/include/language/%s.php', $lang));
include_once(__DIR__ . "/include/utils.php");
$mail_admin = $mail;
$nom=isset($_POST['nom'])?$_POST['nom']:"";
$nom_sup=isset($_POST['nom_sup'])?$_POST['nom_sup']:"";
$rue=isset($_POST['rue'])?$_POST['rue']:"";
$ville=isset($_POST['ville'])?$_POST['ville']:"";
$code_post=isset($_POST['code_post'])?$_POST['code_post']:"";
$num_tva=isset($_POST['num_tva'])?$_POST['num_tva']:"";
$login=isset($_POST['logincli'])?$_POST['logincli']:"";
$login2=isset($_POST['login2'])?$_POST['login2']:"";
$pass=isset($_POST['passcli'])?$_POST['passcli']:"";
$mail_cli=isset($_POST['mail'])?$_POST['mail']:"";
$pass2=isset($_POST['pass2cli'])?$_POST['pass2cli']:"";
$num=isset($_POST['num'])?$_POST['num']:"";
$civ=isset($_POST['civ'])?$_POST['civ']:"";
$tel=isset($_POST['tel'])?$_POST['tel']:"";
$fax=isset($_POST['fax'])?$_POST['fax']:"";
$message='';

$_GET['num'] = $num;#edit_client
if($pass != $pass2){
 $message = sprintf('<h1>%s</h1>', $lang_mot_pa);
 include(__DIR__ . '/edit_client.php');#header("Location: ?num=$num");#include('form_client.php');
 exit;
}

$pass = md5($pass);

if($nom=='' || $rue=='' || $ville=='' || $code_post=='' || $num_tva==''){
 $message = sprintf('<h1>%s</h1>', $lang_oubli_champ);
 include(__DIR__ . '/edit_client.php');
 exit;
}

if ($login !='') {
 $sql = "SELECT * FROM " . $tblpref ."client WHERE login = '".$login."'";
 $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
 $test = mysql_num_rows($req);
 if ($test > 0) {
  $message = sprintf('<h1>%s</h1>', $lang_er_mo_pa);
  include(__DIR__ . '/edit_client.php');
  exit;
 }
}

if ($mail_cli !='') {
 $sql = "SELECT * FROM " . $tblpref ."client WHERE mail = '".$mail_cli."' AND num_client != '".$num."'";
 $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
 $test = mysql_num_rows($req);
 if ($test > 0){
  $message = sprintf('<h1>%s</h1>', $lang_mail_exist);
  include(__DIR__ . '/edit_client.php');
  exit;
 }
}

$sql2 = "UPDATE " . $tblpref ."client SET fax='" . $fax . "', tel='" . $tel . "', civ='" . $civ . "', nom='" . $nom . "', mail='" . $mail_cli . "', num_tva='" . $num_tva . "', nom2='" . $nom_sup . "', rue='" .$rue . "', ville='" . $ville . "', cp='" . $code_post . "' WHERE num_client = '" . $num . "'";
mysql_query($sql2) || die(sprintf('<p>Erreur Mysql<br/>%s<br/>', $sql2).mysql_error()."</p>");

if($pass2 != '' && $login != ''){
 $sql2 = "UPDATE " . $tblpref ."client SET login='" . $login . "', pass='" . $pass . "' WHERE num_client = '" . $num . "'";
 mysql_query($sql2) || die(sprintf('<p>Erreur Mysql<br/>%s<br/>', $sql2).mysql_error()."</p>");
}

if($pass2 != '' && $login2 != ''){
 $sql2 = "UPDATE " . $tblpref ."client SET login='" . $login2 . "', pass='" . $pass . "' WHERE num_client = '" . $num . "'";
 mysql_query($sql2) || die(sprintf('<p>Erreur Mysql<br/>%s<br/>', $sql2).mysql_error()."</p>");

 $to = $mail_cli;
 $from = $mail_admin ;
 $subject = $lang_pass_modif ;
 $mess =  sprintf('%s %s Mot de passe: %s</b><br>%s<br> ', $lang_mail_li_up1, $login2, $pass2, $lang_mail_cli_up);
 if (courriel($to,$subject,$mess,$from,$logo)) {
     #if(mail($to,$subject,$message_mail,$header))
     $message = sprintf('<h2>%s %s</h2>', $lang_notif_env, $mail_cli);
 } else {
     $message = sprintf('<h1>%s</h1>', $lang_notifi_cli_non);
 }
}

if($pass2 != '' && $login != '' && $mail_cli != ''){
 $to = $mail_cli;
 $from = $mail_admin ;
 $subject = $lang_cre_mo_pa ;
 #$message_mail = "Cher client<br>Votre mot de passe a ete créé par l'administrateur<br><b>Login: $login Mot de passe: $pass2</b><br><br>vous pouver changer ce mot de passe en ligne mais pas le login. <br>Ce mot de pass est encodé dans notre base de donnée .<br>Si vous le perdiez, veuilliez prévevir l <a href='$mail_admin'>administrateur</a> pour qu'il vous en donne un nouveau ";
 $mess =  sprintf("%s %s <br>%s %s <br>%s <a href='mailto:", $lang_mai_cre, $login, $lang_mai_cr_pa, $pass2, $lang_mai_cre_enc).$mail_admin.sprintf("'>%s</a> %s", $lang_admini, $lang_pass_nou);
 if (courriel($to,$subject,$mess,$from,$logo)) {
     #mail($to,$subject,$message_mail,$header)
     $message .= sprintf('<h2>%s</h2>', $lang_noti_pa);
 } else {
     $message .= sprintf('<h1>%s</h1>', $lang_notifi_cli_non);
 }
}

$message= sprintf('<h2>%s</h2>', $lang_cli_jour).$message;
include(__DIR__ . "/lister_clients.php");
