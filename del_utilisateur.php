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
 * File Name: del_utilisateurs.php
 * 	verification et efacage des utilisateurs
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
include_once(__DIR__ . "/include/utils.php");
$num_user=isset($_GET['num_user'])?$_GET['num_user']:"";
$sql = " SELECT * FROM " . $tblpref .sprintf('user WHERE num = %s ', $num_user);
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_array($req)){
 $admin = $data['admin'];
}

$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
if ($admin == 'y') {
 $message = sprintf('<h1>%s</h1>', $lang_impo_del_util);
 if ($num_user == 1) {
     #evitelesdéconvenues
     $message .= "<h2>Oops, super admin ;)</h2>";
 }

 #fixin edit_utilisateur_suite.php #2015
 include_once(__DIR__ . "/lister_utilisateurs.php");
 exit;
}

#from lister_client_restreint.php #2015
$sql = "
SELECT num_client
FROM " . $tblpref ."client
WHERE 1
and " . $tblpref ."client.permi LIKE '{$num_user},'
or  " . $tblpref ."client.permi LIKE '%,{$num_user},'
or  " . $tblpref ."client.permi LIKE '%,{$num_user},%'
or  " . $tblpref ."client.permi LIKE '{$num_user},%'
ORDER BY " . $tblpref ."client.nom DESC
";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_array($req)){
 $num_client = $data['num_client'];
 #from desactiver_client.php #2015
 $sql = "SELECT permi from " . $tblpref ."client WHERE num_client = '".$num_client."'";
 $result = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
 $permi = mysql_result($result, 0);
 $permi = str_replace($num_user . ',','', $permi);#ereg_replace("$num_user,",'', $permi);
 $sql = "UPDATE " . $tblpref ."client SET permi = '".$permi."' WHERE num_client = '".$num_client."'";
 mysql_query($sql) || die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
}

#fin
$sql ="DELETE FROM " . $tblpref .('user WHERE num = ' . $num_user);
mysql_query($sql) || die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$message=$lang_del_utilisateur_succes;
include_once(__DIR__ . "/form_utilisateurs.php");
