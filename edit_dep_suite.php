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
require_once(__DIR__ . "/include/verif.php");
include_once(__DIR__ . "/include/config/common.php");
include_once(__DIR__ . "/include/config/var.php");
include_once(__DIR__ . sprintf('/include/language/%s.php', $lang));
$lib=isset($_POST['lib'])?$_POST['lib']:"";
$four=isset($_POST['four'])?$_POST['four']:"";
$prix=isset($_POST['prix'])?$_POST['prix']:"";
$num=isset($_POST['num'])?$_POST['num']:"";
$sql2 = "UPDATE " . $tblpref ."depense SET lib = '".$lib."' , fournisseur = '".$four."' , prix = '".$prix.sprintf("' WHERE num = %s ", $num);
mysql_query($sql2) || die(sprintf('<p>Erreur Mysql<br/>%s<br/>', $sql2).mysql_error()."</p>");
$message = sprintf('<h2>%s</h2>', $lang_dep_maj);
include(__DIR__ . "/lister_depenses.php");
