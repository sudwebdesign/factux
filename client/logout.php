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
$now='../';
include('../include/config/common.php');#session_register();
ini_set('session.save_path', '../include/session'); 
session_start();
$_SESSION['trucmuch'] = '';#session_register('login');
$_SESSION['lang'] = ''; 
unset($_SESSION['trucmuch'],$_SESSION['lang']);
session_destroy();
require ("../include/del_pdf.php");
include("login.php");
