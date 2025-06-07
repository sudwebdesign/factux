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
 * File Name: verif.php
 * 	Fichier de crÃ©ation et verification de la session
 *
 * * Version:  5.0.0
 * Modified: 07/10/2016
 *
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
if(session_id() === '') { # ( !isset($login)||$login=='')#Only in login.php?
 ini_set('session.save_path', 'include/session');
 session_start();#Warning: session_start() [function.session-start]: Cannot send session cache limiter - headers already sent (output started at /mnt/111/sdb/b/d/factux/demo/include/headers.php:30) in /mnt/111/sdb/b/d/factux/demo/include/verif.php on line 24
}

$page_name = isset($page_name)?$page_name:'';#fix bon/devis_fin,...
if(!isset($_SESSION['trucmuch']) || $_SESSION['trucmuch']==''){
 if (!strstr($page_name,'Log')&!strstr($page_name,'Index')) {
     $message = "i";
 }

 #interdit
 $login=1;#in verif emule login.php (evite de refaire sessions start et créer un fichier vide)
 include(__DIR__ . '/logout.php');
 if ($_SESSION !== []) {
     #count($_SESSION)>0
     session_destroy();
 }

 exit;
}

$utili = $_SESSION['trucmuch'];
$lang = $_SESSION['lang'];
include_once(__DIR__ . "/config/common.php");

$sqlz = "SELECT * FROM " . $tblpref ."user WHERE " . $tblpref .sprintf('user.login = "%s"', $utili);
$req = mysql_query($sqlz) or die('Erreur SQL !<br>'.$sqlz.'<br>'.mysql_error());
while($data = mysql_fetch_array($req)){
 $user_num = $data['num'];
 $user_nom = $data["nom"];
 $user_prenom = $data["prenom"];
 $user_email = $data['email'];
 $user_fact = $data['fact'];
 $user_com = $data['com'];
 $user_dev = $data['dev'];
 $user_admin = $data['admin'];
 $user_dep = $data['dep'];
 $user_stat = $data['stat'];
 $user_art = $data['art'];
 $user_cli = $data['cli'];
}
