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
echo "<link rel='stylesheet' type='text/css' href='../include/themes/default/style.css'>";
echo'<link rel="shortcut icon" type="image/x-icon" href="../image/favicon.ico" >';
echo '<table width="100%" border="1" cellpadding="0" cellspacing="0" summary="">';
echo '<tr><td class ="install"><img src="../image/factux.gif" alt=""><br><IMG SRC="../image/spacer.gif" WIDTH=150 HEIGHT=400 ALT=""><br></th><td>';

require_once("../include/config/common.php");
$login2=isset($_POST['login2'])?$_POST['login2']:"";
$pass=isset($_POST['pass'])?$_POST['pass']:"";
$nom=isset($_POST['nom'])?$_POST['nom']:"";
$prenom=isset($_POST['prenom'])?$_POST['prenom']:"";
$mail=isset($_POST['mail'])?$_POST['mail']:"";
$pass2=isset($_POST['pass2'])?$_POST['pass2']:"";
if($login2=='' || $pass==''|| $nom=='' || $prenom=='' || $mail=='' )
{
echo "<h1>Vous avez oublié de remplir un champ !!!";
include('');
exit;
}
if($pass != $pass2)
    {
    echo "<h1>Erreur, les deux mots de passe ne correspondent pas</h1>";
    include('user_create.php'); // On inclus le formulaire d'identification
    exit;
    }
else
$pass_crypt = md5($pass);
mysql_select_db($db) or die ("Could not select $db database");
$sql7 = "INSERT INTO " . $tblpref ."user (login, pwd, nom, prenom, email, dev, com, fact, admin, dep, stat, art, cli) VALUES ('$login2', '$pass_crypt', '$nom', '$prenom', '$mail', 'y', 'y', 'y', 'y', 'y', 'y', 'y', 'y')";
mysql_query($sql7) or die('Erreur SQL !<br>'.$sql7.'<br>'.mysql_error());
echo " <br><br><center><h2>$prenom $nom est maintenant enregistré et a comme login : $login2 mot de passe : $pass .<br>";
include("upload.php");
//echo "<br><a href=''>Continuer</a>"; 
 ?> 
