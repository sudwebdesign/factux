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
include_once("../include/config/common.php");
include_once("../include/config/var.php");
$lang=isset($_POST['lang'])?$_POST['lang']:"";
$lang=(empty($lang))?$default_lang:$lang;#default_lg in common
include_once("../include/language/$lang.php");
include_once("../include/utils.php");
include_once("../include/headers.php");
include_once("../include/finhead.php");
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
}
ini_set('session.save_path', '../include/session'); 
session_start();
session_register('login');
session_register('lang');
include_once("client.php");
