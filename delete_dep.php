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
require_once(__DIR__ . "/include/verif.php");
include_once(__DIR__ . "/include/config/common.php");
include_once(__DIR__ . "/include/config/var.php");
include_once(__DIR__ . sprintf('/include/language/%s.php', $lang));
$num=isset($_GET['num'])?$_GET['num']:"";
if (!mysql_select_db($db)) {
    die (sprintf('Could not select %s database', $db));
}

$sql1 = "DELETE FROM " . $tblpref ."depense WHERE num = '".$num."'";
mysql_query($sql1) || die('Erreur SQL !<br>'.$sql1.'<br>'.mysql_error());
$message = sprintf('<h2>%s</h2>', $lang_dep_eff);
include(__DIR__ . "/lister_depenses.php");
