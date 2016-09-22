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



echo "<br><center><table><tr>";
echo "<caption>Vérification des droits.</caption>";
echo "<td>$verif $doss1 :<td>";
if (is_writable("$doss1")) {
echo "<font color=green> OK</font></td></tr>";
} else {
echo "<font color=red> $erreur</td></tr>";
}
echo "<tr><td>$verif $doss2 :<td>";
if (is_writable("$doss2")) {
echo "<font color=green> OK</font></td></tr>";
} else {
echo "<font color=red> $erreur</td></tr>";
}

echo "<td>$verif $doss3 :<td>";
if (is_writable("$doss3")) {
echo "<font color=green> OK</font></td></tr>";
} else {
echo "<font color=red> $erreur</td></tr>";
}
echo "<td>$verif $doss4 :<td>";
if (is_writable("$doss4")) {
echo "<font color=green> OK</font></td></tr>";
} else {
echo "<font color=red> $erreur</td></tr>";
}

echo "<td>$verif $doss5 :<td>";
if (is_writable("$doss5")) {
echo "<font color=green> OK</font></td></tr>";
} else {
echo "<font color=red> $erreur</td></tr>";
}

echo "<td>$verif $doss6 :<td>";
if (is_writable("$doss6")) {
echo "<font color=green> OK</font></td></tr>";
} else {
echo "<font color=red> $erreur</td></tr>";
}

echo "<td>$verif2 $fich1 :<td>";
if (is_writable("$fich1")) {
echo "<font color=green> OK</font></td></tr>";
} else {
echo "<font color=red> $erreur</td></tr>";
}

echo "<td>$verif2 $fich2 :<td>";
if (is_writable("$fich2")) {
echo "<font color=green> OK</font></td></tr>";
} else {
echo "<font color=red> $erreur</font></td></tr>";
}
echo "</table><br>";
if (!is_writable ($doss1 )||!is_writable ($doss2) || !is_writable ($doss3) || !is_writable ($doss4) || !is_writable ($doss5) || !is_writable ($fich1) || !is_writable ($fich2))
{echo "<h1>Veuiller vérifier les erreurs ci-dessus avant de poursuivre</h1>";
  }else {
	include("index3.php");

}

 ?>