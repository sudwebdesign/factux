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
require_once("include/config/common.php");
include_once("include/verif.php");
include_once("include/language/$lang.php");
echo '<link rel="stylesheet" type="text/css" href="include/style.css">';
echo'<link rel="shortcut icon" type="image/x-icon" href="image/favicon.ico" >';
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
$admin=isset($_POST['admin'])?$_POST['admin']:"";

if ($admin == y) { 
$dev = "y";
$com = "y";
$fact = "y";
$dep = "y"; 
$stat = "y";
$art = "y";
$cli = "y";
}

if($login2=='' || $nom=='' || $prenom=='' || $mail=='' )
{
echo "$lang_oublie_champ";
include('lister_utilisateurs.php');
exit;
}
if($pass != $pass2)
    {
    echo "<h1>Erreur les deux mots de passe ne correspondent pas</h1>";
    include('editer_utilisateur.php'); // On inclus le formulaire d'identification
    exit;
    }
else

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

include("editer_utilisateur.php");
 
 ?> 