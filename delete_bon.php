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
$num_bon=isset($_GET['num_bon'])?$_GET['num_bon']:"";
$nom=isset($_GET['nom'])?$_GET['nom']:"";
$sql = "SELECT fact FROM " . $tblpref .('bon_comm WHERE num_bon = ' . $num_bon);
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_array($req)){
 $fact = $data['fact'];
}

if($fact!='0'){#=='ok'
 $message = sprintf('<h1>%s</h1>', $lang_err_efa_bon);
 include(__DIR__ . '/form_commande.php');
 exit;
}

$sql1 = "DELETE FROM " . $tblpref ."cont_bon WHERE bon_num = '".$num_bon."'";
mysql_query($sql1) || die('Erreur SQL !<br>'.$sql1.'<br>'.mysql_error());
$sql1 = "DELETE FROM " . $tblpref ."bon_comm WHERE num_bon = '".$num_bon."'";
mysql_query($sql1) || die('Erreur SQL !<br>'.$sql1.'<br>'.mysql_error());
$message= sprintf('<h2>%s %s</h2>', $lang_bon_effa, $nom);
include(__DIR__ . "/form_commande.php");
