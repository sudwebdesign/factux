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
include_once(__DIR__ . "/include/verif.php");
include_once(__DIR__ . "/include/config/common.php");
include_once(__DIR__ . "/include/config/var.php");
include_once(__DIR__ . sprintf('/include/language/%s.php', $lang));
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
 $message = sprintf('<h1>%s</h1>', $lang_oublie_champ);
 include(__DIR__ . '/form_utilisateurs.php');
 exit;
}

if($pass != $pass2){
 $message = sprintf('<h1>%s</h1>', $lang_suite_edit_utilisateur_err_pass);
 include(__DIR__ . '/form_utilisateurs.php'); // On inclus le formulaire d'identification
 exit;
}

$sql = "SELECT * FROM " . $tblpref ."user WHERE login = '".$login2."' OR email = '".$mail."'";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$test = mysql_num_rows($req);
if ($test > 0){
 $message = sprintf('<h1>%s</h1>', $lang_id_or_mail_exist);
 include(__DIR__ . '/form_utilisateurs.php');
 exit;
}

$pass_crypt = md5($pass);

if (!mysql_select_db($db)) {
    die (sprintf('Could not select %s database', $db));
}

$sql7 = "
INSERT INTO " . $tblpref ."user (login, pwd, nom, prenom, email, dev, com, fact, dep, stat, art, cli, admin)
VALUES ('{$login2}', '{$pass_crypt}', '{$nom}', '{$prenom}', '{$mail}', '{$dev}', '{$com}', '{$fact}', '{$dep}', '{$stat}', '{$art}', '{$cli}', '{$admin}')
";
mysql_query($sql7) || die('Erreur SQL !<br>'.$sql7.'<br>'.mysql_error());
$message = sprintf('<h2>%s %s %s %s .</h2>', $prenom, $nom, $lang_est_enr, $login2);
if ($dev == 'r' || $com == 'r' ||$fact == 'r'){
 $message = sprintf('<h1>%s %s %s</h1>', $lang_don_rest, $login2, $lang_choi_cli_enr);
 include_once(__DIR__ . "/form_choisir_client.php");
}else{
 include(__DIR__ . '/form_utilisateurs.php');
}
