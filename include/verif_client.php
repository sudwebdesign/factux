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
 *
 */
if (session_id() === '') {
 ini_set('session.save_path', '../include/session');
 session_start();
}

if(!isset($_SESSION['login'])||$_SESSION['login']==''){
 $message = "i";#interdit
 include(@$from_cli.'login.php');
 exit;
}

$lang = $_SESSION['lang'];
