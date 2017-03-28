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
 * File Name: table_create.php
 * 	creation des tables
 * 
 * * * Version:  5.0.0
 * * * * Modified: 07/10/2016
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
$now='../';
$etape = "Étape N°4 : Initialiser la base de données, créer les tables et l'utilisateur primaire";
include_once('headers.php');
require_once($now."include/config/common.php");
$cdb = mysql_connect($host,$user,$pwd) or die ("serveur de base de données injoignable. Vérifiez dans /factux/include/common.php si $host est correct.");
if(function_exists('mysql_set_charset'))//connexion en utf-8 maintenant
 mysql_set_charset('utf8', $cdb);
else
 mysql_query("SET NAMES 'utf8'", $cdb);//before 5.2.3
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");#, collation-server = 'utf8_general_ci' /?\ with : interclassement==latin1_swedish_ci /?\ but, (comme ici) if not in SET query : interclassement == utf8_general_ci :Yep:
if(isset($sqldbc)){
 $sql = "create database $db";
 mysql_query($sql)or die('Erreur SQL !'.$sql.''.mysql_error());
 echo "Votre base de donnée $db à été crée avec succes<hr>";
}
mysql_select_db($db) or die ("La base de données est injoignable. Vérifiez dans /factux/include/common.php si $user, $pwd, $db sont exacts.");
$connect = '$cdb = mysql_connect($host,$user,$pwd) or die ("serveur de base de données injoignable. Vérifiez dans /factux/include/common.php si $host est correct.");
mysql_select_db($db) or die ("La base de données est injoignable. Vérifiez dans /factux/include/common.php si $user, $pwd, $db sont exacts.");
if(function_exists(\'mysql_set_charset\'))//connexion en utf-8 maintenant
 mysql_set_charset(\'utf8\', $cdb);
else
 mysql_query("SET NAMES \'utf8\'", $cdb);//before 5.2.3
mysql_query("SET character_set_results = \'utf8\', character_set_client = \'utf8\', character_set_connection = \'utf8\', character_set_database = \'utf8\', character_set_server = \'utf8\', collation-server = \'utf8_general_ci\'");
';
$monfichier = fopen($now."include/config/common.php", "a+");
fwrite($monfichier, $connect);
fclose($monfichier);

  $sql = 'CREATE TABLE '."$tblpref".'article ( `num` int( 10 ) NOT NULL AUTO_INCREMENT ,'
        . ' article varchar(40) NOT NULL default \'0\','
        . ' prix_htva float(20,2) NOT NULL default \'0.00\','
        . ' taux_tva float(6,2) NOT NULL default \'0.00\','
        . ' marge float(6,2) NOT NULL default \'1.00\','
        . ' commentaire varchar( 30 ) NOT NULL default \'0\','
        . ' uni varchar( 5 ) NOT NULL default \'\','
        . ' actif VARCHAR( 5 ) NOT NULL default \'\','
        . ' stock float(15,2) NOT NULL default \'0.00\','
        . ' stomin float(15,2) NOT NULL default \'0.00\','
        . ' stomax float(15,2) NOT NULL default \'0.00\','
        . ' cat int(11) NOT NULL default \'0\','
        . ' PRIMARY KEY ( `num` ) ) '
        . ' ';
 mysql_query($sql)or die('Erreur SQL1 !'.$sql.''.mysql_error());
 $sql2 = 'CREATE TABLE '."$tblpref".'bon_comm ( `num_bon` int( 30 ) NOT NULL AUTO_INCREMENT ,'
        . ' client_num int( 10 ) NOT NULL default \'0\','
        . ' date date NOT NULL default \'0000-00-00\','
        . ' tot_htva float( 20, 2 ) NOT NULL default \'0.00\','
        . ' tot_tva float( 20, 2 ) NOT NULL default \'0.00\','
        . ' fact int( 11 ) NOT NULL default \'0\','
        . ' coment VARCHAR( 200 ) NOT NULL default \'\','
        . ' PRIMARY KEY ( `num_bon` ) ) '
        . ' ';
mysql_query($sql2)or die('Erreur SQL2 !'.$sql2.''.mysql_error());//2
 $sql3 = 'CREATE TABLE '."$tblpref".'client ( num_client int( 10 ) NOT NULL AUTO_INCREMENT ,'
        . ' nom varchar( 30 ) NOT NULL default \'\','
        . ' nom2 varchar( 30 ) NOT NULL default \'\','
        . ' rue varchar( 30 ) NOT NULL default \'\','
        . ' ville varchar( 30 ) NOT NULL default \'\','
        . ' cp varchar( 5 ) NOT NULL default \'\','
        . ' num_tva varchar( 30 ) NOT NULL default \'\','
        . ' login varchar( 10 ) NOT NULL default \'\','
        . ' pass varchar( 40 ) NOT NULL default \'\','
        . ' mail varchar( 30 ) NOT NULL default \'\','
        . ' actif VARCHAR( 5 ) NOT NULL default \'\','
        . ' permi varchar(255) NOT NULL default \'\','
        . ' civ varchar(15) NOT NULL default \'\','
        . ' tel varchar(30) NOT NULL default \'\','
        . ' fax varchar(30) NOT NULL default \'\','
        . ' PRIMARY KEY ( num_client ) ) '
        . ' ';
mysql_query($sql3) or die ('erreur sql3 !'.$sql3.''.mysql_error());//3

$sql_cat='CREATE TABLE '."$tblpref".'categorie (`id_cat` int(11) NOT NULL auto_increment,'
        .' `categorie` varchar(30) NOT NULL default \'\','
        .' PRIMARY KEY  (`id_cat`) ) '
        .' ';
mysql_query($sql_cat) or die ('erreur sql !'.$sql_cat.''.mysql_error());//sql_cat
 $sql4 = ' CREATE TABLE '."$tblpref".'cont_bon( num int( 40 ) NOT NULL AUTO_INCREMENT ,'
        . ' bon_num int(30) NOT NULL default \'0\','
        . ' num_lot int(10) default \'0\','
        . ' article_num int(10) NOT NULL default \'0\','
        . ' quanti double NOT NULL default \'0\','
        . ' tot_art_htva float( 20, 2 ) NOT NULL default \'0.00\','
        . ' to_tva_art float( 20, 2 ) NOT NULL default \'0.00\','
        . ' p_u_jour float( 20, 2 ) NOT NULL default \'0.00\','
        . ' marge_jour float( 6, 2 ) NOT NULL default \'1.00\','
        . ' remise float( 6, 2 ) NOT NULL default \'0.00\','
        . ' PRIMARY KEY ( num ) ) '
        . ' ';
mysql_query($sql4) or die ('erreur sql4 ! '.$sql4.''.mysql_error());//4
 $sql5 = ' CREATE TABLE '."$tblpref".'depense( num int( 11 ) NOT NULL AUTO_INCREMENT ,'
        . ' date date NOT NULL default \'0000-00-00\','
        . ' lib varchar( 50 ) NOT NULL default \'\','
        . ' fournisseur varchar( 30 ) NOT NULL default \'\','
        . ' prix float( 10, 2 ) NOT NULL default \'0.00\','
        . ' mont_tva float( 10, 2 ) NOT NULL default \'0.00\','
        . ' tx_tva float( 10, 2 ) NOT NULL default \'0.00\','
        . ' PRIMARY KEY ( num ) ) '
        . ' ';
mysql_query($sql5) or die ('erreur sql5 ! '.$sql5.''.mysql_error());//5
 $sql6 = ' CREATE TABLE '."$tblpref".'facture( num int( 11 ) NOT NULL AUTO_INCREMENT ,'
        . ' date_deb date NOT NULL default \'0000-00-00\','
        . ' date_fin date NOT NULL default \'0000-00-00\','
        . ' date_fact date NOT NULL default \'0000-00-00\','
        . ' date_pay date NOT NULL default \'0000-00-00\','
        . ' client int(10) NOT NULL default \'0\','
        . ' payement varchar( 15 ) NOT NULL default \'non\','
        . ' total_fact_h float( 20, 2 ) NOT NULL default \'0.00\','
        . ' total_fact_ttc float( 20, 2 ) NOT NULL default \'0.00\','
        . ' r1 varchar( 10 ) NOT NULL default \'non\','
        . ' r2 varchar( 10 ) NOT NULL default \'non\','
        . ' r3 varchar( 10 ) NOT NULL default \'non\','
        . ' coment VARCHAR( 200 ) NOT NULL default \'\','
        . ' acompte float( 10, 2 ) NOT NULL default \'0.00\','
        . ' list_num mediumtext NOT NULL ,'
        . ' PRIMARY KEY ( num ) ) '
        . ' ';
mysql_query($sql6)or die ('erreur sql6 ! ! '.$sql6.''.mysql_error());//6
 $sql7 = ' CREATE TABLE '."$tblpref".'payement( num int( 10 ) NOT NULL AUTO_INCREMENT ,'
        . ' num_fact varchar( 30 ) NOT NULL default \'\','
        . ' pay varchar( 4 ) NOT NULL default \'\','
        . ' date_pay date NOT NULL default \'0000-00-00\','
        . ' PRIMARY KEY ( num ) ) '
        . ' ';
#mysql_query($sql7)or die ('erreur sql7 ! ! '.$sql7.''.mysql_error());//7 payement obsolete
 $sql8 = ' CREATE TABLE '."$tblpref".'user ( num int( 10 ) NOT NULL AUTO_INCREMENT ,'
        . ' login varchar( 10 ) NOT NULL default \'\','
        . ' nom varchar( 20 ) NOT NULL default \'\','
        . ' prenom varchar( 20 ) NOT NULL default \'\','
        . ' pwd varchar( 40 ) NOT NULL default \'\','
        . ' email varchar( 30 ) NOT NULL default \'\','
        . ' dev char( 1 ) NOT NULL default \'n\','
        . ' com char( 1 ) NOT NULL default \'n\','
        . ' fact char( 1 ) NOT NULL default \'n\','
        . ' admin char( 1 ) NOT NULL default \'n\','
        . ' dep char( 1 ) NOT NULL default \'n\','
        . ' stat char( 1 ) NOT NULL default \'n\','
        . ' art char( 1 ) NOT NULL default \'n\','
        . ' cli char( 1 ) NOT NULL default \'n\','
        . ' PRIMARY KEY ( num ) ) '
				. ' ';
mysql_query($sql8)or die ('erreur sql8 ! '.$sql8.''.mysql_error());//8
 $sql9 = ' CREATE TABLE '."$tblpref".'cont_dev( num int( 40 ) NOT NULL AUTO_INCREMENT ,'
        . ' dev_num int( 30 ) NOT NULL default \'0\','
        . ' article_num int( 10 ) NOT NULL default \'0\','
        . ' quanti double NOT NULL default \'0\','
        . ' tot_art_htva float( 20, 2 ) NOT NULL default \'0.00\','
        . ' to_tva_art float( 20, 2 ) NOT NULL default \'0.00\','
        . ' p_u_jour float( 20, 2 ) NOT NULL default \'0.00\','
        . ' marge_jour float( 6, 2 ) NOT NULL default \'1.00\','
        . ' remise float( 6, 2 ) NOT NULL default \'0.00\','
        . ' PRIMARY KEY ( num ) ) '
        . ' ';
mysql_query($sql9)or die ('erreur sql9 ! '.$sql9.''.mysql_error());//9
 $sql10 = ' CREATE TABLE '."$tblpref".'devis ( `num_dev` int( 30 ) NOT NULL AUTO_INCREMENT ,'
        . ' client_num int( 10 ) NOT NULL default \'0\','
        . ' date date NOT NULL default \'0000-00-00\','
        . ' tot_htva float( 20, 2 ) NOT NULL default \'0.00\','
        . ' tot_tva float( 20, 2 ) NOT NULL default \'0.00\','
        . ' resu int( 30 ) NOT NULL default \'0\','
        . ' coment VARCHAR( 200 ) NOT NULL default \'\','
        . ' PRIMARY KEY ( `num_dev` ) ) '
        . ' ';
mysql_query($sql10)or die('Erreur SQL10 !'.$sql10.''.mysql_error());//10
 $sql11 = ' CREATE TABLE '."$tblpref".'cont_lot ( `num` int( 15 ) NOT NULL AUTO_INCREMENT ,'
        . ' num_lot int( 10 ) NOT NULL default \'0\','
        . ' ingr varchar(20) NOT NULL default \'\','
        . ' fourn varchar(15) NOT NULL default \'\','
        . ' fourn_lot varchar( 20 ) NOT NULL default \'\','
        . ' PRIMARY KEY ( `num` ) ) '
        . ' ';
 mysql_query($sql11)or die('Erreur SQL11 !'.$sql11.''.mysql_error());//11
  $sql12 = ' CREATE TABLE '."$tblpref".'lot ( `num` int( 10 ) NOT NULL AUTO_INCREMENT ,'
        . ' prod varchar( 25 ) NOT NULL default \'\','
        . ' actif char(3) NOT NULL default \'0\','
        . ' date date NOT NULL default \'0000-00-00\','
        . ' PRIMARY KEY ( `num` ) ) '
        . ' ';
 mysql_query($sql12)or die('Erreur SQL12 !'.$sql12.''.mysql_error());//12
?><br><hr><br><b style="color:green">Tables créées</b><br><hr><br><?php
include("user_create.php");
