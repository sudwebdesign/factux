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
include_once("../include/verif_client.php");
include_once("../include/config/common.php");
include_once("../include/config/var.php");
include_once("../include/language/$lang.php");
echo '<link rel="stylesheet" type="text/css" href="../include/style.css">';
$login=isset($_POST['login'])?$_POST['login']:"";
$pass=isset($_POST['pass'])?$_POST['pass']:"";
$pass_new=isset($_POST['pass_new'])?$_POST['pass_new']:"";
$pass_new2=isset($_POST['pass_new2'])?$_POST['pass_new2']:"";
$num_client=isset($_POST['num_client'])?$_POST['num_client']:"";

if($pass=='' || $pass_new=='' || $pass_new2=='' || $login=='' )
    {
    echo "<h1>$lang_err_chan_mdp";
    include('client.php'); // On inclus le formulaire d'identification
    exit;
    }
$sql2 = "SELECT * FROM " . $tblpref ."client WHERE num_client= $num_client";
$req = mysql_query($sql2) or die('Erreur SQL !<br>'.$sql2.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
$ancienpass= $data['pass'];
if($ancienpass != md5($pass) ){
echo "<h1>$lang_err_ancien_mdp";
    include('client.php'); // On inclus le formulaire d'identification
    exit;
}
if($pass_new != $pass_new2)
    {
    echo "<h1>$lang_err_mdp_corr";
    include('client.php');
    exit;
    }

$pass = md5($pass_new);
$sql2 = "UPDATE " . $tblpref ."client SET pass='".$pass."' WHERE num_client = $num_client";
mysql_query($sql2) OR die("<p>Erreur Mysql<br/>$sql2<br/>".mysql_error()."</p>");

$sql2 = "SELECT * FROM " . $tblpref ."client WHERE num_client= $num_client";
$req = mysql_query($sql2) or die('Erreur SQL !<br>'.$sql2.'<br>'.mysql_error());
while($data = mysql_fetch_array($req))
    {
	$to = $data['mail'];
	}
echo "<h2>$lang_mdp_chang $to</h2><br><hr>";

$from = "$mail" ;

$subject = "$lang_dif_mail_mdp" ;
$message =  "Cher client<br>$lang_mdp_jour<br><b>Login: $login $lang_mai_cr_pa $pass_new2</b><br>$lang_mai_cre_enc<br> "; 
$header = 'From: '.$from."\n"
 .'MIME-Version: 1.0'."\n"
 .'Content-Type: text/html; charset= ISO-8859-1'."\n"
 .'Content-Transfer-Encoding: 7bit'."\n\n";

mail($to,$subject,$message,$header);

include ("client.php");
 ?> 