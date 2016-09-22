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
 * File Name: index.php
 * 	Premiere page du script d'installation
 * 
 * * * Version:  1.1.5
 * * * * Modified: 23/07/2005
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
 
 ?>
 <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"> 
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15">
<title>Factux : l'installeur</title>


<link rel='stylesheet' type='text/css' href='../include/themes/default/style.css'>
<link rel="shortcut icon" type="image/x-icon" href="../image/favicon.ico" >
</head><body>

<table width="100%" border="1" cellpadding="0" cellspacing="0" summary="">
			 <tr>
			 <td class ="install"><img src="../image/factux.gif" alt=""><br><IMG SRC="../image/spacer.gif" WIDTH=150 HEIGHT=400 ALT="">
			 <br>
			 </td>
			 			<td>


<h2><br>Installation de Factux</h2><br><hr><br>
<p>Vous voici dans l'instalalleur de Factux. Avant de commencer n'oubliez pas de receuillir les informations suivantes.</p><ul>
<li>Les paramètres de connexion à votre base de données mysql.</li>
<li>Les coordonnées de la société qui utilisera Factux.</li>
<li>Le logo de la société qui utilisera Factux.</li></ul><br><br>
<?php
$erreur = "Erreur, veuillez vérifier les droits en écriture sur ce fichier !!";
$verif = "Vérification des droits d'écriture pour le répertoire";
$verif2 = "Vérification des droits d'écriture pour le fichier";
$doss1 = "../include";
$doss2 = "../dump";
$doss4 = "../image";
$doss3 = "..";
$doss5 = "../include/session";
$doss6 = "../fpdf";
$fich1 ="../include/config/common.php";
$fich2 = "../include/config/var.php";
$fich3 = "../include/configav.php";
?>


<center><table>

<caption>Vérification des droits.</caption>
<?php
echo "<tr><td>$verif $doss1 :<td>";
if (is_writable("$doss1")) {
echo "<font color=green> OK</font></td></tr>";
} else {
echo "<font color=red> $erreur</font></td></tr>";
}
echo "<tr><td>$verif $doss2 :<td>";
if (is_writable("$doss2")) {
echo "<font color=green> OK</font></td></tr>";
} else {
echo "<font color=red> $erreur</font></td></tr>";
}

echo "<tr><td>$verif $doss3 :<td>";
if (is_writable("$doss3")) {
echo "<font color=green> OK</font></td></tr>";
} else {
echo "<font color=red> $erreur</font></td></tr>";
}
echo "<tr><td>$verif $doss4 :<td>";
if (is_writable("$doss4")) {
echo "<font color=green> OK</font></td></tr>";
} else {
echo "<font color=red> $erreur</font></td></tr>";
}

echo "<tr><td>$verif $doss5 :<td>";
if (is_writable("$doss5")) {
echo "<font color=green> OK</font></td></tr>";
} else {
echo "<font color=red> $erreur</font></td></tr>";
}

echo "<tr><td>$verif $doss6 :<td>";
if (is_writable("$doss6")) {
echo "<font color=green> OK</font></td></tr>";
} else {
echo "<font color=red> $erreur</font></td></tr>";
}

echo "<tr><td>$verif2 $fich1 :<td>";
if (is_writable("$fich1")) {
echo "<font color=green> OK</font></td></tr>";
} else {
echo "<font color=red> $erreur</font></td></tr>";
}

echo "<tr><td>$verif2 $fich2 :<td>";
if (is_writable("$fich2")) {
echo "<font color=green> OK</font></td></tr>";
} else {
echo "<font color=red> $erreur</font></td></tr>";
}

echo "<tr><td>$verif2 $fich3 :<td>";
if (is_writable("$fich3")) {
echo "<font color=green> OK</font></td></tr>";
} else {
echo "<font color=red> $erreur</font></td></tr>";
}
echo "</table></center><br>";
if (!is_writable ($doss1 )||!is_writable ($doss2) || !is_writable ($doss3) || !is_writable ($doss4) || !is_writable ($doss5) || !is_writable ($fich1) || !is_writable ($fich2)|| !is_writable ($fich3) )
{echo "<h1>Veuiller vérifier les erreurs ci-dessus avant de poursuivre</h1></table>";
  }else {
	include("index3.php");

}

?>