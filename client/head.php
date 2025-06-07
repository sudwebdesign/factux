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
 * File Name: fckconfig.js
 * 	Editor configuration settings.
 *
 * * * * Version:  8.0.0
 * * * * Modified: 07/06/2025
 *
 * File Authors:
 * 		Guy Hendrickx
 *.
 */

$sql = "SELECT num_client, civ, nom, nom2 FROM " . $tblpref ."client WHERE login = '".$login."'";
$req = mysql_query($sql);
$data = mysql_fetch_array($req);
$nom = $data['nom'];
$civ = $data['civ'];
$nom2 = $data['nom2'];
$num_client = $data['num_client'];
$now='../';
#require ("../include/del_pdf.php");
?>
<!-- <a href='logout.php' style="float:right;"><?php echo $lang_sortir; ?></a> -->
<h6><?php echo sprintf('%s %s %s %s', $lang_bienvenue, $civ, $nom, $nom2); ?></h6>
<center><img height="161" src="../image/<?php echo $logo ?>" alt="<?php echo $entrep_nom ?>"></center><br><hr>
