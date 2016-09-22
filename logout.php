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
 * File Name: logout.php
 * 	deconnexion du programme
 * 
 * * * Version:  1.1.5
 * Modified: 11/04/2005
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
include("include/config/common.php");
ini_set('session.save_path', 'include/session'); 	
if(session_id() === '')#if(basename($_SERVER['SCRIPT_FILENAME'])==basename(__FILE__))#elle meme
 session_start();
$_SESSION['trucmuch'] = '';#session_register('login');
$_SESSION['lang'] = ''; 
unset($_SESSION['trucmuch'],$_SESSION['lang']);
session_destroy();
include("include/del_pdf.php");#remove olds files of session
include("login.inc.php");
