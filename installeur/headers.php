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
 * File Name: headers.php
 *
 *
 * * * * Version:  8.0.0
 * * * * Modified: 07/06/2025
 *
 * File Authors:
 * 		Thomas Ingles
 */
 $etape=(isset($etape)?$etape:'Étape N°1 : Bienvenue et verification des droits des dossiers et fichiers interne de Factux');
 $default_lang=isset($default_lang)?$default_lang:'fr';
 include(__DIR__ . "/../include/language/fr.php");
 require_once(__DIR__ . "/../include/0.php");#uptophp7 & apostrophe()
?>
<!DOCTYPE html>
<html>
 <head>
  <meta charset="UTF-8">
  <title>L'installeur de Factux : <?php echo $etape; ?></title>
  <link rel='stylesheet' type='text/css' href='../include/themes/light/style.css'>
  <link rel="shortcut icon" type="image/x-icon" href="../image/favicon.ico" >
 </head>
 <body>
  <table width="100%" height="100%" border="1" cellpadding="0" cellspacing="0" summary="">
   <tr>
    <td class ="install">
     <h2>Installation de Factux</h2>
     <img src="../image/factux.gif" alt=""><br>
     <h1><?php echo $etape; ?></h1>
     <img src="../image/spacer.gif" width="150" height="400" alt=""><br>
    </td>
    <td style="vertical-align: top;"><br><h3><?php echo $etape; ?></h3><hr>
