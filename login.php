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
 * Modified: 07/10/2016
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */

$login=isset($_POST['login'])?$_POST['login']:"";
$pass=isset($_POST['pass'])?$_POST['pass']:"";
$lang=isset($_POST['lang'])?$_POST['lang']:"";
ini_set('session.save_path', 'include/session'); 
include_once("include/config/common.php");	    
if ($lang=='') { 
 $lang ="$default_lang";  
}
include_once("include/config/var.php");#4 include_once("include/utils.php"); in from_commande
include_once("include/language/$lang.php");

if($login=='' || $pass==''){
 $message = "<h1>$lang_oublie_champ</h1>";
 include('login.inc.php'); // On inclus le formulaire d'identification
 exit;
}

// on recupère le password de la table qui correspond au login du visiteur
$sql = "select pwd from " . $tblpref ."user where login= '$login'";
$req = mysql_query($sql) or die('Erreur SQL!<br>'.$sql.'<br>'.mysql_error());

$data = mysql_fetch_array($req);
$pass_crypt = md5($pass);
if($data['pwd'] != $pass_crypt){
 $message = "<h1>$lang_bad_log</h1>";
 include('login.inc.php'); // On inclus le formulaire d'identification
 exit;
} else {
 session_start();
 //session_register('login');
 $_SESSION['trucmuch'] = $login ;
 $_SESSION['lang'] = $lang ; 
 $message= "<h2>$lang_authentification_ok <br> $lang_bienvenue $login</h2>";
 include_once("include/verif.php");
 include_once("form_commande.php");
}
