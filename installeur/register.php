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
require_once("../include/config/common.php");
$lang=(!isset($lang))?$default_lang:$lang;#default_lg in common
include_once("../include/language/$lang.php");
$login2=isset($_POST['login2'])?$_POST['login2']:"";
$pass=isset($_POST['pass'])?$_POST['pass']:"";
$nom=isset($_POST['nom'])?apostrophe($_POST['nom']):"";
$prenom=isset($_POST['prenom'])?apostrophe($_POST['prenom']):"";
$mail=isset($_POST['mail'])?$_POST['mail']:"";
$pass2=isset($_POST['pass2'])?$_POST['pass2']:"";
if($login2=='' || $pass==''|| $nom=='' || $prenom=='' || $mail=='' ){
 echo "<h1>$lang_oublie_champ</h1>";
 include('user_create.php'); // On inclus le formulaire d'identification
 exit;
}
if($pass != $pass2){
 echo "<h1>$lang_suite_edit_utilisateur_err_pass</h1>";
 include('user_create.php'); // On inclus le formulaire d'identification
 exit;
}
$pass_crypt = md5($pass);
$sql7 = "INSERT INTO " . $tblpref ."user (login, pwd, nom, prenom, email, dev, com, fact, admin, dep, stat, art, cli) VALUES ('$login2', '$pass_crypt', '$nom', '$prenom', '$mail', 'y', 'y', 'y', 'y', 'y', 'y', 'y', 'y')";
mysql_query($sql7) or die('Erreur SQL !<br>'.$sql7.'<br>'.mysql_error());

$etape = "�tape N�6 : Enregister le logo de l'entreprise";
include_once('headers.php');
echo "<h2>$prenom $nom est maintenant enregistr� et a comme login : $login2 et comme mot de passe : $pass</h2>";
include("upload.php");
