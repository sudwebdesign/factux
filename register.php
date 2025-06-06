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
include_once("include/verif.php");
include_once("include/config/common.php");
include_once("include/config/var.php");
include_once("include/language/$lang.php");
$login2=isset($_POST['login2'])?$_POST['login2']:'';
$pass=isset($_POST['pass'])?$_POST['pass']:'';
$nom=isset($_POST['nom'])?$_POST['nom']:"";
$prenom=isset($_POST['prenom'])?$_POST['prenom']:"";
$mail=isset($_POST['mail'])?$_POST['mail']:'';
$pass2=isset($_POST['pass2'])?$_POST['pass2']:'';

$dev=isset($_POST['dev'])?$_POST['dev']:'';
$com=isset($_POST['com'])?$_POST['com']:'';
$fact=isset($_POST['fact'])?$_POST['fact']:'';
$dep=isset($_POST['dep'])?$_POST['dep']:'';
$stat=isset($_POST['stat'])?$_POST['stat']:'';
$art=isset($_POST['art'])?$_POST['art']:'';
$cli=isset($_POST['cli'])?$_POST['cli']:'';
$admin=isset($_POST['admin'])?$_POST['admin']:'';

if ($admin == 'y') { 
 $dev = 'y';
 $com = 'y';
 $fact = 'y';
 $dep = 'y'; 
 $stat = 'y';
 $art = 'y';
 $cli = 'y';
}

if($login2=='' || $pass==''|| $nom=='' || $prenom=='' || $mail=='' || $pass2==''){
 $message = "<h1>$lang_oublie_champ</h1>";
 include('form_utilisateurs.php');
 exit;
}
if($pass != $pass2){
 $message = "<h1>$lang_suite_edit_utilisateur_err_pass</h1>";
 include('form_utilisateurs.php'); // On inclus le formulaire d'identification
 exit;
}

$sql = "SELECT * FROM " . $tblpref ."user WHERE login = '".$login2."' OR email = '".$mail."'";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$test = mysql_num_rows($req);
if ($test > 0){ 
 $message = "<h1>$lang_id_or_mail_exist</h1>";
 include('form_utilisateurs.php');
 exit;
}

$pass_crypt = md5($pass);

mysql_select_db($db) or die ("Could not select $db database");
$sql7 = "
INSERT INTO " . $tblpref ."user (login, pwd, nom, prenom, email, dev, com, fact, dep, stat, art, cli, admin) 
VALUES ('$login2', '$pass_crypt', '$nom', '$prenom', '$mail', '$dev', '$com', '$fact', '$dep', '$stat', '$art', '$cli', '$admin')
";
mysql_query($sql7) or die('Erreur SQL !<br>'.$sql7.'<br>'.mysql_error());
$message = "<h2>$prenom $nom $lang_est_enr $login2 .</h2>";
if ($dev == 'r' || $com == 'r' ||$fact == 'r'){ 
 $message = "<h1>$lang_don_rest $login2 $lang_choi_cli_enr</h1>";
 include_once("form_choisir_client.php");  
}else{
 include('form_utilisateurs.php');
}
