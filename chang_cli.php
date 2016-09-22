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
 include_once("include/config/common.php");
$num_bon=isset($_POST['num_bon'])?$_POST['num_bon']:"";		
$client=isset($_POST['listeville'])?$_POST['listeville']:"";	

//echo "num_bon $num_bon client $client ";
$sql2 = "UPDATE " . $tblpref ."bon_comm SET client_num='".$client."' WHERE num_bon = '".$num_bon."'";
mysql_query($sql2) OR die("<p>Erreur Mysql<br/>$sql2<br/>".mysql_error()."</p>");
$relative_url="edit_bon.php?num_bon=$num_bon&ampnom=$client";		
header("Location: http://" . $_SERVER['HTTP_HOST']
                     . dirname($_SERVER['PHP_SELF'])
                     . "/" . $relative_url);
 ?> 