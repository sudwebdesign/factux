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
 *.
 */
$etape = "Étape N°3 : Données figurantes sur vos bons de commande et factures";
include('headers.php');
$un=isset($_POST['un'])?$_POST['un']:"";
$deux=isset($_POST['deux'])?$_POST['deux']:"";
$trois=isset($_POST['trois'])?$_POST['trois']:"";
$quatre=isset($_POST['quatre'])?$_POST['quatre']:"";
$cinq=isset($_POST['cinq'])?$_POST['cinq']:"";
$six=isset($_POST['six'])?$_POST['six']:"";
mysql_connect($quatre,$un,$deux) or die ("<font color='red' size='4'> Les informations que vous avez entrées semblent incorrectes, veuillez les verifier et recommencer l'installeur.");

$type = '<?php' . "\n";
$com = '//common.php créé grace à l\'installeur de Factux, soyez prudent si vous l\'éditez'. "\n";
$com .= 'error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);#cache les éléments dépréciés'. "\n";
//$un = "valeur1";
$un = '"'.$un.'";//l\'utilisateur de la base de données mysql' . "\n";
//$deux = "valeur2";
$deux = '"'.$deux.'";//le mot de passe à la base de données mysql' . "\n";
//$trois = "valeur3";
$trois = '"'.$trois.'";//le nom de la base de données mysql' . "\n";
//$quatre = "valeur4";
$quatre = '"'.$quatre.'";//l\'adresse de la base de données mysql ' . "\n";
//$cinq = "valeur5";
$cinq = '"'.$cinq.'";//la langue de l\'interface et des factures créées par Factux : voir la doc pour les abbréviations' . "\n";
$six = '"'.$six.'";//prefixe des tables ' . "\n";
$sept = 'require_once(@$now."include/0.php");#uptophp7 & apostrophe()'."\n";

$monfichier = fopen("../include/config/common.php", "w+"); 

fwrite($monfichier, ''.$type.''.$com.'$user= '.$un.'$pwd= '.$deux.'$db= '.$trois.'$host= '.$quatre.'$default_lang= '.$cinq.'$tblpref= '.$six.$sept);
fclose($monfichier);
?>
<center>
 <h2>Les informations de connexion a la base de données ont été enregistrées avec succès dans le fichier<font color="red">/factux/include/config/common.php</font></h2>
 <h2>En cas d'erreur, vous avez 2 choix : recommencer l'installeur de Factux ou éditer ce fichier.<br>
 Ce fichier est largement commenté (en francais) pour vous y aider.</h2>
</center><hr>
<?php
include("setup_suite.php");
