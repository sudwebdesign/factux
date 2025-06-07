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
 * File Name: verif2.php
 * 	Fichier de création et verification de la session
 *
 * * * * Version:  8.0.0
 * * * * Modified: 07/06/2025
 *
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
//error_reporting(0);
ini_set('session.save_path', '../include/session');
session_cache_limiter('private');
session_start();
if(!isset($_SESSION['trucmuch'])||$_SESSION['trucmuch']==''){#if(isset($_SESSION['trucmuch'])&&$_SESSION['trucmuch']==''){
 $message = "i";#interdit
 include(__DIR__ . '/../login.inc.php');
 exit;
}

$lang = $_SESSION['lang'];
