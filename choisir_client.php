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
require_once("include/config/common.php");
include_once("include/verif.php");
include_once("include/language/$lang.php");
echo '<link rel="stylesheet" type="text/css" href="include/style.css">';
echo'<link rel="shortcut icon" type="image/x-icon" href="image/favicon.ico" >';
$login=isset($_POST['login'])?$_POST['login']:"";
//on recupere le num user
$sql = "SELECT num FROM " . $tblpref ."user WHERE login = '".$login."'";
$result = mysql_query($sql) or die("<p>Erreur Mysql<br/>$sql<br/>".mysql_error()."</p>");
$num_user = mysql_result($result, 'num');
$num_user_vir = "$num_user," ;

//on extrai les variables du select multiple
$nbr_li = count($HTTP_POST_VARS['client']);
for($i=0;$i<=($nbr_li - 1);$i++)
{
//on trouve le contenu actuel de permi
$num_client = $HTTP_POST_VARS['client'][$i];
$sql3 = "SELECT permi FROM " . $tblpref ."client WHERE num_client = '".$num_client."'";
$result = mysql_query($sql3) or die("<p>Erreur Mysql<br/>$sql3<br/>".mysql_error()."</p>");
$permi_av = mysql_result($result, 'permi');

$permi = "$permi_av$num_user_vir";

//on introduit les variables dans la base

$sql2 = "UPDATE " . $tblpref ."client SET permi='$permi' WHERE num_client = '".$num_client."'";

mysql_query($sql2) OR die("<p>Erreur Mysql<br/>$sql2<br/>".mysql_error()."</p>");
}
 
include_once("editer_utilisateur.php");
 ?> 
