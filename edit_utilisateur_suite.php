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
require_once("include/verif.php");
include_once("include/config/common.php");
include_once("include/config/var.php");
include_once("include/language/$lang.php");
$login2=isset($_POST['login2'])?$_POST['login2']:"";
$pass=isset($_POST['pass'])?$_POST['pass']:"";
$nom=isset($_POST['nom'])?$_POST['nom']:"";
$prenom=isset($_POST['prenom'])?$_POST['prenom']:"";
$mail=isset($_POST['mail'])?$_POST['mail']:"";
$pass2=isset($_POST['pass2'])?$_POST['pass2']:"";
$num_user=isset($_POST['num_user'])?$_POST['num_user']:"";

$dev=isset($_POST['dev'])?$_POST['dev']:"";
$com=isset($_POST['com'])?$_POST['com']:"";
$fact=isset($_POST['fact'])?$_POST['fact']:"";
$dep=isset($_POST['dep'])?$_POST['dep']:"";
$stat=isset($_POST['stat'])?$_POST['stat']:"";
$art=isset($_POST['art'])?$_POST['art']:"";
$cli=isset($_POST['cli'])?$_POST['cli']:"";
$admin=isset($_POST['admin'])?$_POST['admin']:""
;
#evitelesdéconvenues 2015
if($num_user == 1)
 $admin = 'y';#protection du 1er utilisateur (les champs sont tous a non) #wip in editer_utilisteur.php 
if ($admin == 'y'){ 
 $dev = "y";
 $com = "y";
 $fact = "y";
 $dep = "y"; 
 $stat = "y";
 $art = "y";
 $cli = "y";
}

if($login2=='' || $nom=='' || $prenom=='' || $mail=='' ){
 $message = "$lang_oublie_champ";
 include('lister_utilisateurs.php');
 exit;
}

if($pass != $pass2){
 $message = "<h1>$lang_suite_edit_utilisateur_err_pass</h1>";
 include('edit_utilisateur.php'); // On inclus le formulaire d'identification
 exit;
}

$sql = "SELECT * FROM " . $tblpref ."user WHERE email = '".$mail."' AND num != '".$num_user."'";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$test = mysql_num_rows($req);
if ($test > 0){ 
 $message = "<h1>$lang_mail_exist</h1>";
 include('edit_utilisateur.php');
 exit;
}

if ($pass != '') { 
 $pass_crypt = md5($pass);
 $sql7 = "UPDATE " . $tblpref ."user 
 SET `pwd` = '".$pass_crypt."', 
 `nom` = '".$nom."', 
 `prenom` = '".$prenom."', 
 `email` = '".$mail."', 
 `dev` = '".$dev."', 
 `com` = '".$com."', 
 `fact` = '".$fact."', 
 `dep` = '".$dep."', 
 `stat` = '".$stat."', 
 `art` = '".$art."', 
 `cli` = '".$cli."', 
 `admin` = '".$admin."'
 WHERE `num` = '".$num_user."'";
}
if ($pass == '') {
 $sql7 = "UPDATE " . $tblpref ."user 
 SET `nom` = '".$nom."', 
 `prenom` = '".$prenom."', 
 `email` = '".$mail."', 
 `dev` = '".$dev."', 
 `com` = '".$com."', 
 `fact` = '".$fact."', 
 `dep` = '".$dep."', 
 `stat` = '".$stat."', 
 `art` = '".$art."', 
 `cli` = '".$cli."', 
 `admin` = '".$admin."'
 WHERE `num` = '".$num_user."'";
}
mysql_query($sql7) or die('Erreur SQL !<br>'.$sql7.'<br>'.mysql_error());
$message="<h2>$lang_suite_edit_utilisateur_succes</h2>";
include("edit_utilisateur.php");
