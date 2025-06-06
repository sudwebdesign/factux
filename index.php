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
 *
 */

require_once("include/config/common.php");
if(!isset($host)) {
?>
<link rel="stylesheet" type="text/css" href="include/theme/red/style.css">
<link rel="shortcut icon" type="image/x-icon" href="image/favicon.ico" >
<?php
$message = '<h1>Le logiciel ne semble pas encore avoir ete configuré.<br />
Cliquez <a href="installeur/index.php">ici</a> pour le configurer dès maintenant.</h1>';
$default_lang='fr';$entrep_nom='Factux 5';$logo='installer.jpg';
}
include("logout.php");
