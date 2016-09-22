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
echo "<link rel='stylesheet' type='text/css' href='../include/themes/default/style.css'>";
echo'<link rel="shortcut icon" type="image/x-icon" href="../image/favicon.ico" >';
echo '<table width="100%" border="1" cellpadding="0" cellspacing="0" summary="">';
echo '<tr><td class ="install"><img src="../image/factux.gif" alt=""><br><IMG SRC="../image/spacer.gif" WIDTH=150 HEIGHT=400 ALT=""><br></th><td>';

$un=isset($_POST['un'])?$_POST['un']:"";
$deux=isset($_POST['deux'])?$_POST['deux']:"";
$trois=isset($_POST['trois'])?$_POST['trois']:"";
$quatre=isset($_POST['quatre'])?$_POST['quatre']:"";
$cinq=isset($_POST['cinq'])?$_POST['cinq']:"";
$six=isset($_POST['six'])?$_POST['six']:"";
mysql_connect($quatre,$un,$deux) or die ("<font color= red size=4 > Les informations que vous avez entrées semblent incorrectes, veuillez les verifier et recommencer l'installeur.");

$type = '<?php' . "\n";
/*$type_fin = '?>';*/
$com= '//common.php créé grace à l\'installeur de Factux, soyez prudent si vous l\'éditez'. "\n";
//$connect = 'mysql_connect($host,$user,$pwd) or die ("serveur de base de données injoignable, verifiez dans /factux/include/common.php si $host est correct.");' . "\n";
//$connect2 = 'mysql_select_db($db) or die ("La base de données est injoignable, verifiez dans /factux/include/common.php si $user, $pwd, $db sont exacts.");' . "\n";
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

//a modifier avant realease common et pas common2
$monfichier = fopen("../include/config/common.php", "w+"); 

fwrite($monfichier, ''.$type.''.$com.'$user= '.$un.'$pwd= '.$deux.'$db= '.$trois.'$host= '.$quatre.'$default_lang= '.$cinq.'$tblpref= '.$six.'');
echo "<center><br><br><b><font color= green> Vos données ont été enregistrées avec succès dans le fichier <font color=red>/factux/include/config/common.php<font color=green><br>En cas d'erreur, vous avez 2 choix : recommencer l'installeur de Factux ou éditer ce fichier.<br>Ce fichier est largement commenté (en francais) pour vous y aider.<br>";
fclose($monfichier);
include("setup_suite.php");
?>
