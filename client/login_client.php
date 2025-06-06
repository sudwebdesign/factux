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
ini_set('session.save_path', '../include/session');
$now='../';
include_once("../include/config/common.php");
include_once("../include/config/var.php");
$lang=isset($_POST['lang'])?$_POST['lang']:$default_lang;#default_lg in common
include_once("../include/language/$lang.php");
include_once("../include/utils.php");
$login=isset($_POST['login'])?$_POST['login']:"";
$pass=isset($_POST['pass'])?$_POST['pass']:"";

if($login=='' || $pass==''){
 $message = "<h1>$lang_oublie_champ</h1>";
 include(@$from_cli.'login.php');
 exit;
}

$sql = "select pass from " . $tblpref ."client where login= '$login'";
$req = mysql_query($sql) or die('Erreur SQL1
!<br>'.$sql.'<br>'.mysql_error());

$data = mysql_fetch_array($req);
  $pass_crypt = md5($pass);
if($data['pass'] != $pass_crypt){
 $message = "<h1>$lang_bad_log</h1>";
 include(@$from_cli.'login.php');
 exit;
} else {
 session_start();
 $_SESSION['login'] = $login;
 $_SESSION['lang'] = $lang;
 include_once("../include/headers.php");
 include_once("../include/finhead.php");
 include_once("client.php");
}

