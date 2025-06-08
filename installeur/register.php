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
require_once(__DIR__ . '/../include/config/common.php');
$lang=(isset($lang))?$lang:$default_lang;#default_lg in common
include_once(__DIR__ . sprintf('/../include/language/%s.php', $lang));
$login2=isset($_POST['login2'])?$_POST['login2']:"";
$pass=isset($_POST['pass'])?$_POST['pass']:"";
$nom=isset($_POST['nom'])?$_POST['nom']:"";
$prenom=isset($_POST['prenom'])?$_POST['prenom']:"";
$mail=isset($_POST['mail'])?$_POST['mail']:"";
$pass2=isset($_POST['pass2'])?$_POST['pass2']:"";
if($login2=='' || $pass==''|| $nom=='' || $prenom=='' || $mail=='' ){
 echo sprintf('<h1>%s</h1>', $lang_oublie_champ);
 include(__DIR__ . '/user_create.php'); // On inclus le formulaire d'identification
 exit;
}

if($pass != $pass2){
 echo sprintf('<h1>%s</h1>', $lang_suite_edit_utilisateur_err_pass);
 include(__DIR__ . '/user_create.php'); // On inclus le formulaire d'identification
 exit;
}

$pass_crypt = md5($pass);
$sql7 = "INSERT INTO " . $tblpref .sprintf("user (login, pwd, nom, prenom, email, dev, com, fact, admin, dep, stat, art, cli) VALUES ('%s', '%s', '%s', '%s', '%s', 'y', 'y', 'y', 'y', 'y', 'y', 'y', 'y')", $login2, $pass_crypt, $nom, $prenom, $mail);
mysql_query($sql7) || die('Erreur SQL !<br>'.$sql7.'<br>'.mysql_error());

$etape = "Étape N°6 : Enregister le logo de l'entreprise";
include_once(__DIR__ . '/headers.php');
echo sprintf('<h2>%s %s est maintenant enregistré et a comme login : %s et comme mot de passe : %s</h2>', $prenom, $nom, $login2, $pass);
include(__DIR__ . '/upload.php');
