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
 include_once("include/config/common.php");
$num_bon=isset($_POST['num_bon'])?$_POST['num_bon']:"";
$num_dev=isset($_POST['num_dev'])?$_POST['num_dev']:"";
$client=isset($_POST['listeclients'])?$_POST['listeclients']:"";
if($num_bon!=""){
 $sql2 = "UPDATE " . $tblpref ."bon_comm SET client_num='".$client."' WHERE num_bon = '".$num_bon."'";
 $relative_url="edit_bon.php?num_bon=$num_bon&amp;nom=$client";
}
if($num_dev!=""){
 $sql2 = "UPDATE " . $tblpref ."devis SET client_num='".$client."' WHERE num_dev = '".$num_dev."'";
 $relative_url="edit_devis.php?num_dev=$num_dev&amp;nom=$client";
}
mysql_query($sql2) OR die("<p>Erreur Mysql<br/>$sql2<br/>".mysql_error()."</p>");
header("Location: http://" . $_SERVER['HTTP_HOST']
                     . dirname($_SERVER['PHP_SELF'])
                     . "/" . $relative_url);
