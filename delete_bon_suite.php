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
include_once("include/verif.php");
include_once("include/config/common.php");
include_once("include/language/$lang.php");
echo '<link rel="stylesheet" type="text/css" href="include/style.css">';
echo'<link rel="shortcut icon" type="image/x-icon" href="image/favicon.ico" >';
$num_bon=isset($_GET['num_bon'])?$_GET['num_bon']:"";
$nom=isset($_GET['nom'])?$_GET['nom']:"";

$sql = "SELECT fact FROM " . $tblpref ."bon_comm WHERE num_bon = $num_bon";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql2.'<br>'.mysql_error());
while($data = mysql_fetch_array($req))
    {
		$fact = $data['fact'];
		}
if($fact=='ok')
{
$message = "<center><h1>$lang_err_efa_bon";
include('form_commande.php');
exit;
}
mysql_select_db($db) or die ("Could not select $db database");
$sql1 = "DELETE FROM " . $tblpref ."bon_comm WHERE num_bon = '".$num_bon."'";
mysql_query($sql1) or die('Erreur SQL !<br>'.$sql1.'<br>'.mysql_error());
$message= "<center><h1>$lang_bon_effa";
include("form_commande.php");
 ?> 