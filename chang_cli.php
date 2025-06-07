<?php
/*
 * Factux le facturier libre
 * Copyright (C) 2003-2005 Guy Hendrickx, 2017~ Thomas Ingles
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
 * * * * Version:  8.0.0
 * * * * Modified: 07/06/2025
 *
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
 include_once(__DIR__ . "/include/config/common.php");
$num_bon=isset($_POST['num_bon'])?$_POST['num_bon']:"";
$num_dev=isset($_POST['num_dev'])?$_POST['num_dev']:"";
$client=isset($_POST['listeclients'])?$_POST['listeclients']:"";
if($num_bon!=""){
 $sql2 = "UPDATE " . $tblpref ."bon_comm SET client_num='".$client."' WHERE num_bon = '".$num_bon."'";
 $relative_url=sprintf('edit_bon.php?num_bon=%s&amp;nom=%s', $num_bon, $client);
}

if($num_dev!=""){
 $sql2 = "UPDATE " . $tblpref ."devis SET client_num='".$client."' WHERE num_dev = '".$num_dev."'";
 $relative_url=sprintf('edit_devis.php?num_dev=%s&amp;nom=%s', $num_dev, $client);
}

mysql_query($sql2) || die(sprintf('<p>Erreur Mysql<br/>%s<br/>', $sql2).mysql_error()."</p>");
header("Location: http://" . $_SERVER['HTTP_HOST']
                     . dirname($_SERVER['PHP_SELF'])
                     . "/" . $relative_url);
