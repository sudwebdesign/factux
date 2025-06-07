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
include_once(__DIR__ . "/include/verif.php");
include_once(__DIR__ . "/include/config/common.php");
include_once(__DIR__ . "/include/config/var.php");
include_once(__DIR__ . sprintf('/include/language/%s.php', $lang));
$num_cont=isset($_GET['num_cont'])?$_GET['num_cont']:"";
$num_bon=isset($_GET['num_bon'])?$_GET['num_bon']:"";
$nom=isset($_POST['nom'])?$_POST['nom']:"";
/////////////////
$sql = "SELECT quanti, article_num from " . $tblpref ."cont_bon WHERE num = '".$num_cont."'";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
 $quantiplus = $data['quanti'];
 $artiplus = $data['article_num'];

$sql = "UPDATE `" . $tblpref .sprintf("article` SET `stock` = (stock + %s) WHERE `num` = '%s'", $quantiplus, $artiplus);
mysql_query($sql) || die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
////////////////

$sql = "DELETE FROM " . $tblpref ."cont_bon WHERE num = '".$num_cont."'";
mysql_query($sql) || die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());

#header("Location: edit_bon.php?num_bon=$num_bon&nom=$nom");
$message = sprintf('<h2>%s</h2>', $lang_li_effa);
include(__DIR__ . "/edit_bon.php");
