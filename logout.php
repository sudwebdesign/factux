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
 * File Name: logout.php
 * 	deconnexion du programme
 *
 * * * Version:  5.0.0
 * Modified: 07/10/2016
 *
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
include_once("include/config/common.php");
if(session_id() === ''){#if(basename($_SERVER['SCRIPT_FILENAME'])==basename(__FILE__))#elle meme
 ini_set('session.save_path', 'include/session');
 session_start();
}
$_SESSION['trucmuch'] = '';#session_register('login');
$_SESSION['lang'] = '';
unset($_SESSION['trucmuch'],$_SESSION['lang']);
session_destroy();
include("include/del_pdf.php");#remove olds files of session
include("login.inc.php");
