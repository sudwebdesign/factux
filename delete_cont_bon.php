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
$num_cont=isset($_GET['num_cont'])?$_GET['num_cont']:"";
$num_bon=isset($_GET['num_bon'])?$_GET['num_bon']:"";
$nom=isset($_POST['nom'])?$_POST['nom']:"";
mysql_select_db($db) or die ("Could not select $db database");
$sql1 = "DELETE FROM " . $tblpref ."cont_bon WHERE num = '".$num_cont."'";
mysql_query($sql1) or die('Erreur SQL !<br>'.$sql1.'<br>'.mysql_error());
header("Location: edit_bon.php?num_bon=$num_bon&nom=$nom"); 
 ?> 