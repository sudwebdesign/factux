<?php 
/*
 * Factux le facturier libre
 * Copyright (C) 2003-2015 Guy Hendrickx
 * 
 * Licensed under the terms of the GNU  General Public License:
 * 		http://www.opensource.org/licenses/gpl-license.php
 * 
 * For further information visit:
 * 		http://factux.sourceforge.net
 * 
 * File Name: headers.php
 * 
 * 
 * * * Version:  1.1.5
 * * * * Modified: 23/09/2015
 * 
 * File Authors:
 * 		Thomas
 */
 $etape=(isset($etape)?$etape:'Étape N°1 : Bienvenue et verification des droits des dossiers et fichiers interne de FactuX');
 include("../include/language/fr.php");
?>
<!DOCTYPE html> 
<html>
 <head>
  <meta charset="ISO-8859-1"><?php #html5 ?>
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
