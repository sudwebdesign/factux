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
$now='../';
include('../include/config/common.php');#session_register();
ini_set('session.save_path', '../include/session');
session_start();
$_SESSION['trucmuch'] = '';#session_register('login');
$_SESSION['lang'] = '';
unset($_SESSION['trucmuch'],$_SESSION['lang']);
session_destroy();
require (__DIR__ . "/../include/del_pdf.php");
include(__DIR__ . "/login.php");
