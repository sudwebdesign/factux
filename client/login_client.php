<html>
<head>
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
if ($lang=='') { 
$lang ="fr";  
}
include_once("../include/config/common.php");
include_once("../include/language/$lang.php");
include_once("../include/config/var.php");
include_once("../include/utils.php");
?>
<title><?php echo $lang_factux; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="../include/style.css">

</head>

<body>
<?php
$login=isset($_POST['login'])?$_POST['login']:"";
$pass=isset($_POST['pass'])?$_POST['pass']:"";	
$lang=isset($_POST['lang'])?$_POST['lang']:"";
ini_set('session.save_path', '../include/session'); 

if($login=='' || $pass=='')
    {
    echo $lang_oublie_champ;
    include('login.htm');
    exit;
    }

$sql = "select pass from " . $tblpref ."client where login= '$login'";
$req = mysql_query($sql) or die('Erreur SQL1
!<br>'.$sql.'<br>'.mysql_error());

$data = mysql_fetch_array($req);
  $pass_crypt = md5($pass);
if($data['pass'] != $pass_crypt)
    {
    echo "<h1>$lang_bad_log</h1>";
    include('login.htm'); 
    exit;
    }
session_start();
//session_register('login');
$_SESSION['login_client'] = $login;
	$_SESSION['lang'] = $lang ; 
?>
<?php 
include_once("client.php");
 ?> 
</body>
</html>
