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
 * File Name: activer_lot.php
 * 	desactive les lot a la demande.
 * 
 * * * Version:  5.0.0
 * * * * Modified: 07/10/2016
 * 
 * File Authors:
 * 		Guy Hendrickx
 *
 */
include_once("include/config/common.php");
$num=isset($_GET['num'])?$_GET['num']:"";
$acte=isset($_GET['acte'])?$_GET['acte']:"non";
$sql2 = "UPDATE " . $tblpref ."lot SET actif='".$acte."' WHERE num = '".$num."'";
mysql_query($sql2) OR die("<p>Erreur Mysql<br/>$sql2<br/>".mysql_error()."</p>");
include_once("lister_lot.php");
