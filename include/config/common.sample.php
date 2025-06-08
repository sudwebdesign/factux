<?php
//common.php créé grace à l'installeur de Factux, soyez prudent si vous l'éditez
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);#cache les éléments dépréciés
$user= 'Nom_Utilisateur_BDD';//l'utilisateur de la base de données mysql
$pwd= 'Mot_de_Passe_BDD';//le mot de passe à la base de données mysql
$db= 'Nom_BDD';//le nom de la base de données mysql
$host= 'localhost';//l'adresse de la base de données mysql
$default_lang= 'fr';//la langue de l'interface et des factures créées par Factux : voir la doc pour les abbréviations
$tblpref= 'factux_';//prefixe des tables
require_once(__DIR__ . '/../include/0.php');#uptophp7 & apostrophe()
$cdb = mysql_connect($host,$user,$pwd) or die (sprintf('serveur de base de données injoignable. Vérifiez dans /factux/include/common.php si %s est correct.', $host));
if (!mysql_select_db($db)) {
    die (sprintf('La base de données est injoignable. Vérifiez dans /factux/include/common.php si %s, %s, %s sont exacts.', $user, $pwd, $db));
}

if (function_exists('mysql_set_charset')) {
    //connexion en utf-8 maintenant
    mysql_set_charset('utf8', $cdb);
} else {
    mysql_query("SET NAMES 'utf8'", $cdb);
}

//before 5.2
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8', collation-server = 'utf8_general_ci'");
