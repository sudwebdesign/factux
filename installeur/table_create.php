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
 * File Name: table_create.php
 * 	creation des tables
 * 
 * * * Version:  1.1.5
 * * * * Modified: 23/07/2005
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
echo "<link rel='stylesheet' type='text/css' href='../include/themes/default/style.css'>";
echo'<link rel="shortcut icon" type="image/x-icon" href="../image/favicon.ico" >';
echo '<table width="100%" border="1" cellpadding="0" cellspacing="0" summary="">';
//echo '<tr><td class ="install"><img src="../image/factux.gif" alt=""><br><IMG SRC="../image/spacer.gif" WIDTH=150 HEIGHT=400 ALT=""><br></th><td>';

$connect = 'mysql_connect($host,$user,$pwd) or die ("serveur de base de données injoignable. Vérifiez dans /factux/include/common.php si $host est correct.");' . "\n";
$connect2 = 'mysql_select_db($db) or die ("La base de données est injoignable. Vérifiez dans /factux/include/common.php si $user, $pwd, $db sont exacts.");' . "\n";
$type_fin = '?>';
$monfichier = fopen("../include/config/common.php", "a+");
fwrite($monfichier, ''.$connect.''.$connect2.''.$type_fin.'');
fclose($monfichier);
require_once("../include/config/common.php");
mysql_select_db($db)or die ("la base n'est pas joignable");
  $sql = 'CREATE TABLE '."$tblpref".'article ( `num` int( 10 ) NOT NULL AUTO_INCREMENT ,'
        . ' `article` varchar( 40 ) NOT NULL default \'0\','
        . ' `prix_htva` float NOT NULL default \'0\','
        . ' `taux_tva` float default \'0\','
        . ' `commentaire` varchar( 30 ) NOT NULL default \'0\','
        . ' `uni` varchar( 5 ) NOT NULL default \'\','
				. ' actif VARCHAR( 5 ) NOT NULL default \'\','
				.'`stock` float(15,2) NOT NULL default \'0.00\','
  			.'`stomin` float(15,2) NOT NULL default \'0.00\','
  			.'`stomax` float(15,2) NOT NULL default \'0.00\','
  			.'`cat` varchar(10) NOT NULL default \'\','
        . ' PRIMARY KEY ( `num` ) ) TYPE = MYISAM '
        . ' ';
 mysql_query($sql)or die('Erreur SQL !'.$sql.'
'.mysql_error());
 $sql2 = 'CREATE TABLE '."$tblpref".'bon_comm ( `num_bon` int( 30 ) NOT NULL AUTO_INCREMENT ,'
        . ' `client_num` varchar( 10 ) NOT NULL default \'\','
        . ' `date` date NOT NULL default \'0000-00-00\','
        . ' `tot_htva` float( 20, 2 ) NOT NULL default \'0.00\','
        . ' `tot_tva` float( 20, 2 ) NOT NULL default \'0.00\','
        . ' `fact` varchar( 4 ) NOT NULL default \'0\','
				. ' `coment` VARCHAR( 200 ) NOT NULL default \'\','
        . ' PRIMARY KEY ( `num_bon` ) ) TYPE = MYISAM '
        . ' ';
mysql_query($sql2)or die('Erreur SQL !'.$sql2.'
'.mysql_error());//2
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
				. '`permi` varchar(255) NOT NULL default \'\','
				. '`civ` varchar(15) NOT NULL default \'\','
				. '`tel` varchar(30) NOT NULL default \'\','
				. '`fax` varchar(30) NOT NULL default \'\','
        . ' PRIMARY KEY ( num_client ) ) TYPE = MYISAM '
        . ' ';
mysql_query($sql3) or die ('erreur sql !'.$sql3.'
'.mysql_error());//3	 

$sql_cat='CREATE TABLE '."$tblpref".'categorie (`id_cat` int(11) NOT NULL auto_increment,'
  				.'`categorie` varchar(30) NOT NULL default \'\','
  				.'PRIMARY KEY  (`id_cat`) ) TYPE=MyISAM '
					.' ';
mysql_query($sql_cat) or die ('erreur sql !'.$sql_cat.'
'.mysql_error());//sql_cat	 

 $sql4 = 'CREATE TABLE '."$tblpref".'cont_bon( num int( 30 ) NOT NULL AUTO_INCREMENT ,'
        . ' bon_num varchar( 30 ) NOT NULL default \'\','
				. '`num_lot` varchar(15) NOT NULL default \'\','
        . ' article_num varchar( 30 ) NOT NULL default \'\','
        . ' quanti double NOT NULL default \'0\','
        . ' tot_art_htva float( 20, 2 ) NOT NULL default \'0.00\','
        . ' to_tva_art float( 20, 2 ) NOT NULL default \'0.00\','
				. ' `p_u_jour` float( 20, 2 ) NOT NULL default \'\','
        . ' PRIMARY KEY ( num ) ) TYPE = MYISAM '
        . ' ';
mysql_query($sql4) or die ('erreur sql ! '.$sql4.'
'.mysql_error());//4
 $sql5 = 'CREATE TABLE '."$tblpref".'depense( num int( 11 ) NOT NULL AUTO_INCREMENT ,'
        . ' date date NOT NULL default \'0000-00-00\','
        . ' lib varchar( 50 ) NOT NULL default \'\','
        . ' fournisseur varchar( 30 ) NOT NULL default \'\','
        . ' prix float( 10, 2 ) NOT NULL default \'0.00\','
        . ' PRIMARY KEY ( num ) ) TYPE = MYISAM '
        . ' ';
mysql_query($sql5) or die ('erreursql ! '.$sql5.'
'.mysql_error());//5
  $sql6 = 'CREATE TABLE '."$tblpref".'facture( num int( 11 ) NOT NULL AUTO_INCREMENT ,'
        . ' date_deb date NOT NULL default \'0000-00-00\','
        . ' date_fin date NOT NULL default \'0000-00-00\','
        . ' CLIENT varchar( 30 ) NOT NULL default \'\','
        . ' payement varchar( 15 ) NOT NULL default \'non\','
        . ' date_fact date NOT NULL default \'0000-00-00\','
        . ' total_fact_h float( 20, 2 ) NOT NULL default \'0.00\','
        . ' total_fact_ttc float( 20, 2 ) NOT NULL default \'0.00\','
				. ' `r1` varchar( 10 ) NOT NULL default \'non\','
        . ' `r2` varchar( 10 ) NOT NULL default \'non\','
        . ' `r3` varchar( 10 ) NOT NULL default \'non\','
				. ' `coment` VARCHAR( 200 ) NOT NULL default \'\','
				. ' `acompte` float( 10, 2 ) NOT NULL default \'0.00\','
				. ' `list_num` mediumtext NOT NULL ,'
        . ' PRIMARY KEY ( num ) ) TYPE = MYISAM '
        . ' ';
				//
mysql_query($sql6)or die ('erreur ! '.$sql6.'
'.mysql_error());//6
 $sql7 = 'CREATE TABLE '."$tblpref".'payement( num int( 10 ) NOT NULL AUTO_INCREMENT ,'
        . ' num_fact varchar( 30 ) NOT NULL default \'\','
        . ' pay varchar( 4 ) NOT NULL default \'\','
        . ' date_pay date NOT NULL default \'0000-00-00\','
        . ' PRIMARY KEY ( num ) ) TYPE = MYISAM '
        . ' ';
mysql_query($sql7)or die ('erreur ! '.$sql7.'
'.mysql_error());//7
 $sql8 = 'CREATE TABLE '."$tblpref".'user ( num int( 10 ) NOT NULL AUTO_INCREMENT ,'
     . ' login varchar( 10 ) NOT NULL default \'\','
       .' nom varchar( 20 ) NOT NULL default \'\','
       .' prenom varchar( 20 ) NOT NULL default \'\','
	.' pwd varchar( 40 ) NOT NULL default \'\','
	.' email varchar( 30 ) NOT NULL default \'\','
	.' dev char( 1 ) NOT NULL default \'n\','
	.' com char( 1 ) NOT NULL default \'n\','
	.' fact char( 1 ) NOT NULL default \'n\','
	.' admin char( 1 ) NOT NULL default \'n\','
	.' dep char( 1 ) NOT NULL default \'n\','
	.' stat char( 1 ) NOT NULL default \'n\','
	.' art char( 1 ) NOT NULL default \'n\','
	.' cli char( 1 ) NOT NULL default \'n\','
	. ' PRIMARY KEY ( num ) ) TYPE = MYISAM '
				. ' ';
mysql_query($sql8)or die ('erreur ! '.$sql8.'
'.mysql_error());//8	

 $sql9 = 'CREATE TABLE '."$tblpref".'cont_dev( num int( 30 ) NOT NULL AUTO_INCREMENT ,'
        . ' dev_num varchar( 30 ) NOT NULL default \'\','
        . ' article_num varchar( 30 ) NOT NULL default \'\','
        . ' quanti double NOT NULL default \'0\','
        . ' tot_art_htva float( 20, 2 ) NOT NULL default \'0.00\','
        . ' to_tva_art float( 20, 2 ) NOT NULL default \'0.00\','
	 . ' `p_u_jour` float( 20, 2 ) NOT NULL default \'0.00\','
        . ' PRIMARY KEY ( num ) ) TYPE = MYISAM '
        . ' ';
mysql_query($sql9) or die ('erreur sql ! '.$sql9.'
'.mysql_error());//9

 $sql10 = 'CREATE TABLE '."$tblpref".'devis ( `num_dev` int( 30 ) NOT NULL AUTO_INCREMENT ,'
        . ' `client_num` varchar( 10 ) NOT NULL default \'\','
        . ' `date` date NOT NULL default \'0000-00-00\','
        . ' `tot_htva` float( 20, 2 ) NOT NULL default \'0.00\','
        . ' `tot_tva` float( 20, 2 ) NOT NULL default \'0.00\','
        . ' `resu` varchar( 4 ) NOT NULL default \'0\','
	. ' `coment` VARCHAR( 200 ) NOT NULL default \'\','
        . ' PRIMARY KEY ( `num_dev` ) ) TYPE = MYISAM '
        . ' ';
mysql_query($sql10)or die('Erreur SQL !'.$sql10.'
'.mysql_error());//2

 $sql = 'CREATE TABLE '."$tblpref".'cont_lot ( `num` int( 15 ) NOT NULL AUTO_INCREMENT ,'
        . ' `num_lot` int( 10 ) NOT NULL default \'0\','
        . ' `ingr` varchar(20) NOT NULL default \'\','
        . ' `fourn` varchar(15) default \'\','
        . ' `fourn_lot` varchar( 20 ) NOT NULL default \'\','
        . ' PRIMARY KEY ( `num` ) ) TYPE = MYISAM '
        . ' ';
 mysql_query($sql)or die('Erreur SQL !'.$sql.'
'.mysql_error());	

  $sql = 'CREATE TABLE '."$tblpref".'lot ( `num` int( 10 ) NOT NULL AUTO_INCREMENT ,'
        . ' `prod` varchar( 25 ) NOT NULL default \'\','
        . ' `actif` char(3) NOT NULL default \'0\','
        . ' `date` date default \'0000-00-00\','
        . ' PRIMARY KEY ( `num` ) ) TYPE = MYISAM '
        . ' ';
 mysql_query($sql)or die('Erreur SQL !'.$sql.'
'.mysql_error());


include("user_create.php");

	?>
