<?php
//common.php créé grace à l'installeur de Factux, soyez prudent si vous l'éditez
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);#cache les éléments dépréciés
$user= "Nom_Utilisateur_BDD";//l'utilisateur de la base de données mysql
$pwd= "Mot_de_Passe_BDD";//le mot de passe à la base de données mysql
$db= "Nom_BDD";//le nom de la base de données mysql
$host= "localhost";//l'adresse de la base de données mysql
$default_lang= "fr";//la langue de l'interface et des factures créées par Factux : voir la doc pour les abbréviations
$tblpref= "factux_";//prefixe des tables
require_once(@$now."include/0.php");#uptophp7 & apostrophe()
$cdb = mysql_connect($host,$user,$pwd) or die ("serveur de base de données injoignable. Vérifiez dans /factux/include/common.php si $host est correct.");
mysql_select_db($db) or die ("La base de données est injoignable. Vérifiez dans /factux/include/common.php si $user, $pwd, $db sont exacts.");
if(function_exists('mysql_set_charset'))//connexion en utf-8 maintenant
 mysql_set_charset('utf8', $cdb);
else
 mysql_query("SET NAMES 'utf8'", $cdb);//before 5.2
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8', collation-server = 'utf8_general_ci'");