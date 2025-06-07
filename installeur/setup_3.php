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
 *.ATTENTION EN UTF-8 LE SIGLE EURO EST INCONNU, ENFIN SI :  C'EST CURIEUX
 */
$etape = "Étape N°3 : Données des bons de commande et factures enregistrées";
include(__DIR__ . '/headers.php');
$zero=isset($_POST['zero'])?apostrophe($_POST['zero']):"";
$un=isset($_POST['un'])?apostrophe($_POST['un']):"";
$deux=isset($_POST['deux'])?$_POST['deux']:"";
$trois=isset($_POST['trois'])?$_POST['trois']:"";
$quatre=isset($_POST['quatre'])?$_POST['quatre']:"";
$cinq=isset($_POST['cinq'])?apostrophe($_POST['cinq']):"";
$six=isset($_POST['six'])?$_POST['six']:"";
$sept=isset($_POST['sept'])?$_POST['sept']:"";
$huit=isset($_POST['huit'])?$_POST['huit']:"";
#$euro = '&euro;';//En fait nul besoin de toucher kelk chose a la devise, php se demerde bien avec le bon encodage :::  === sigle euro en utf-8
#$huit = preg_replace('~~', $euro, $huit);#ereg_replace('', $euro, $huit);
$type = '<?php' . "\n";
/*$type_fin ='?>';*/
$com= '//var.php créé grâce à l\'installeur de Factux soyez prudent si vous l\'éditez' . "\n";
$zero = '"'.$zero.'";//Nom de l\'entreprise' . "\n";
$un = '"'.$un.'";//Siège social de l\'entreprise' . "\n";
$deux = '"'.$deux.'";//numéro de tel. de l\'entreprise' . "\n";
$trois = '"'.$trois.'";//numéro de T.V.A. de l\'entreprise' . "\n";
$quatre = '"'.$quatre.'";//Compte en banque de l\'entreprise ' . "\n";
$cinq = '"'.$cinq.'";//slogan de l\'entreprise' . "\n";
$six = '"'.$six.'";//Registre de commerce de l\'entreprise' . "\n";
$sept = '"'.$sept.'";//adresse email' . "\n";
$huit = '"'.$huit.'";//devise utilisée par Factux' . "\n";

$monfichier = fopen("../include/config/var.php", "w+");
fwrite($monfichier, ''.$type.''.$com.'$entrep_nom= '.$zero.'$social= '.$un.'$tel_vend= '.$deux.'$tva_vend= '.$trois.'$compte= '.$quatre.'$slogan= '.$cinq.'$reg= '.$six.'$mail= '.$sept.'$devise= '.$huit);
fclose($monfichier);
?><br><br>
   <center>
     <h2>Vos données ont été enregistrées avec succès dans le fichier<font color=red>/factux/include/config/var.php</font>.</h2>
     <h2>En cas d'erreur, vous avez 2 choix : recommencer l'installeur de Factux ou éditer ce fichier.<br>
     Ce fichier est largement commenté (en francais) pour vous y aider.</h2>
     <br><hr><h3>Étape suivante</h3><br>
     <h2>Si la base de données existe <a href='table_create.php'>cliquez ici</a></h2>
     <h2>Si l'installeur de Factux doit la créer, <a href='db_create.php'>cliquez ici</a></h2>
     <hr>
   </center>
<?php include_once(__DIR__ . "/../include/bas_cli.php"); ?>
  </td>
 </tr>
</table>
</body>
</html>
