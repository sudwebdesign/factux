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
require_once("include/verif.php");
include_once("include/config/common.php");
include_once("include/head.php");
include_once("include/language/$lang.php");
echo '<link rel="stylesheet" type="text/css" href="include/style.css">';
echo'<link rel="shortcut icon" type="image/x-icon" href="image/favicon.ico" >';
?> 
<?php 
include_once("include/verif.php");
include_once("include/config/common.php");
include_once("include/head.php");
echo '<link rel="stylesheet" type="text/css" href="include/style.css">';

echo "<h2><br><hr><br><ul>";
echo "<li><a href='stats1.php'>Statistiques anuelles</a><li><a href='stats2.php'>Répartition du C.A. annuel par client</a></font>";
echo "<li><a href='stats2.2.php'>Les statistiques client pour une période donnée</a><br>";
echo "<li><a href='stats_art.php'>Répartition du C.A. annuel par article</a>";
echo "<li><a href='form_stat_client.php'>Les stats mensuelles par client</a>";
echo "<li><a href='stats_dep.php'>$lang_depenses_tri_par_fournisseur</a>";
echo"</ul><br>$lang_statistiques_basees_bons<br><br><hr>";
include_once("include/bas.php");
 ?> 