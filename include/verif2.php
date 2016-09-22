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
 * File Name: verif2.php
 * 	Fichier de création et verification de la session
 * 
 * * Version:  1.1.5
 * * * Modified: 23/07/2005
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
 include('../login.inc.php');
 exit;
}	
$lang = $_SESSION['lang'];
