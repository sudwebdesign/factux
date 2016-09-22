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
include_once("include/config/var.php");
include_once("include/language/$lang.php");
$mail_admin = "$mail";
$nom=isset($_POST['nom'])?apostrophe($_POST['nom']):"";
$nom_sup=isset($_POST['nom_sup'])?apostrophe($_POST['nom_sup']):"";
$rue=isset($_POST['rue'])?apostrophe($_POST['rue']):"";
$ville=isset($_POST['ville'])?apostrophe($_POST['ville']):"";
$code_post=isset($_POST['code_post'])?$_POST['code_post']:"";
$num_tva=isset($_POST['num_tva'])?$_POST['num_tva']:"";
$login=isset($_POST['login'])?$_POST['login']:"";
$pass=isset($_POST['pass'])?$_POST['pass']:"";
$mail_cli=isset($_POST['mail'])?$_POST['mail']:"";
$pass2=isset($_POST['pass2'])?$_POST['pass2']:"";
$civ=isset($_POST['civ'])?$_POST['civ']:"";
$tel=isset($_POST['tel'])?$_POST['tel']:"";
$fax=isset($_POST['fax'])?$_POST['fax']:"";

if($pass != $pass2){
 $message = "<h1>$lang_mot_pa</h1>";
 include('form_client.php');
 exit;
}

$pass = md5($pass);

if($nom=='' || $rue=='' || $ville=='' || $code_post=='' || $num_tva==''){
 $message= "<h1>$lang_oubli_champ</h1>";
 include('form_client.php'); // On inclus le formulaire d'identification
 exit;
}
if ($login !=''){
$sql = "SELECT * FROM " . $tblpref ."client WHERE login = '".$login."'";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$test = mysql_num_rows($req);
 if ($test > 0) { 
  $message = "<h1> $lang_er_mo_pa</h1>";
  include('form_client.php');
  exit;
 }
}
$sql1 = "INSERT INTO " . $tblpref ."client(nom, nom2, rue, ville, cp, num_tva, login, pass, mail, civ, tel, fax) VALUES ('$nom', '$nom_sup', '$rue', '$ville', '$code_post', '$num_tva', '$login', '$pass', '$mail_cli', '$civ', '$tel', '$fax')";
mysql_query($sql1) or die('Erreur SQL !<br>'.$sql1.'<br>'.mysql_error());
$message='';
if ($login!='' and $pass2 !='' and $mail_cli !=''){ 
 $to = "$mail_cli";
 $from = "$mail_admin" ;
 $subject2 = "$lang_cre_mo_pa" ;
 $message =  "$lang_mai_cre $login <br>$lang_mai_cr_pa $pass2 <br>$lang_mai_cre_enc <a href=mailto:'".$mail_admin."'>$lang_admini</a> $lang_pass_nou"; 
 $header = 'From: '.$from."\n"
  .'MIME-Version: 1.0'."\n"
  .'Content-Type: text/html; charset= ISO-8859-1'."\n"
  .'Content-Transfer-Encoding: 7bit'."\n\n";
 if(mail($to,$subject2,$message,$header))
  $message = "<h2>$lang_noti_pa</h2>";
 else
  $message = "<h1>$lang_notifi_cli_non</h1>";
}
$message = "<h2>$lang_client_enr</h2>".$message;
include("lister_clients.php");
