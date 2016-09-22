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
 * * * Version:  1.1.5_modif
 * Modified: 11/04/2005
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */

$login=isset($_POST['login'])?$_POST['login']:"";
$pass=isset($_POST['pass'])?$_POST['pass']:"";
$lang=isset($_POST['lang'])?$_POST['lang']:"";
ini_set('session.save_path', 'include/session'); 
if ($lang=='') { 
$lang ="$default_lang";  
}
include_once("include/config/common.php");	    
include_once("include/language/$lang.php");

if($login=='' || $pass=='')
{
  echo $lang_oublie_champ;
  include('login.inc.php'); // On inclus le formulaire d'identification
  exit;
}

// on recupère le password de la table qui correspond au login du
//visiteur
$sql = "select pwd from " . $tblpref ."user where login= '$login'";
$req = mysql_query($sql) or die('Erreur SQL
!<br>'.$sql.'<br>'.mysql_error());

$data = mysql_fetch_array($req);
$pass_crypt = md5($pass);
if($data['pwd'] != $pass_crypt)
    {
    echo "<h1>Mauvais login / password. Merci de recommencer</h1>";
    include('login.inc.php'); // On inclus le formulaire d'identification
    exit;
    }
else
{
  session_start();
  //session_register('login');
  $_SESSION['trucmuch'] = $login ;
	$_SESSION['lang'] = $lang ; 
  include_once("include/config/common.php");	    
  include_once("include/language/$lang.php");
  $message= "$lang_authentification_ok <br> $lang_bienvenue $login";
	
?>
<?php
include_once("form_commande.php");
?> 
<?php
  }
?> 