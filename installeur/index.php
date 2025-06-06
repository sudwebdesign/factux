<?php 
/*
 * Factux le facturier libre
 * Copyright (C) 2003-2005 Guy Hendrickx, 2017 Thomas Ingles
 * 
 * Licensed under the terms of the GNU  General Public License:
 *   http://opensource.org/licenses/GPL-3.0
 * 
 * For further information visit:
 *   http://factux.free.fr
 * 
 * File Name: index.php
 *  Premiere page du script d'installation
 * 
 * * * Version:  5.0.0
 * * * * Modified: 07/10/2016
 * 
 * File Authors:
 *   Guy Hendrickx
 *.
 */
 include('headers.php');
?>
  <h3>Vous voici dans l'instalalleur de Factux.</h3>
  <p>Avant de commencer n'oubliez pas de receuillir les informations suivantes.</p>
  <ul>
   <li>Les paramètres de connexion à votre base de données mysql.</li>
   <li>Les coordonnées de la société qui utilisera Factux.</li>
   <li>Le logo de la société qui utilisera Factux.</li>
  </ul>
  <hr><br>
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
$fich1 = "../include/config/common.php";
$fich2 = "../include/config/var.php";
$fich3 = "../include/configav.php";
?>
  <center>
   <table>
    <caption>Vérification des droits.</caption>
<?php
echo "<tr><td>$verif $doss1 :</td><td>";
if (is_writable("$doss1")) {
echo "<font color='green'>$lang_oui</font></td></tr>";
} else {
echo "<font color='red'> $erreur</font></td></tr>";
}
echo "<tr><td>$verif $doss2 :</td><td>";
if (is_writable("$doss2")) {
echo "<font color='green'>$lang_oui</font></td></tr>";
} else {
echo "<font color='red'> $erreur</font></td></tr>";
}

echo "<tr><td>$verif $doss3 :</td><td>";
if (is_writable("$doss3")) {
echo "<font color='green'>$lang_oui</font></td></tr>";
} else {
echo "<font color='red'> $erreur</font></td></tr>";
}
echo "<tr><td>$verif $doss4 :</td><td>";
if (is_writable("$doss4")) {
echo "<font color='green'>$lang_oui</font></td></tr>";
} else {
echo "<font color='red'> $erreur</font></td></tr>";
}

echo "<tr><td>$verif $doss5 :</td><td>";
if (is_writable("$doss5")) {
echo "<font color='green'>$lang_oui</font></td></tr>";
} else {
echo "<font color='red'> $erreur</font></td></tr>";
}

echo "<tr><td>$verif $doss6 :</td><td>";
if (is_writable("$doss6")) {
echo "<font color='green'>$lang_oui</font></td></tr>";
} else {
echo "<font color='red'> $erreur</font></td></tr>";
}

echo "<tr><td>$verif2 $fich1 :</td><td>";
if (is_writable("$fich1")) {
echo "<font color='green'>$lang_oui</font></td></tr>";
} else {
echo "<font color='red'> $erreur</font></td></tr>";
}

echo "<tr><td>$verif2 $fich2 :</td><td>";
if (is_writable("$fich2")) {
echo "<font color='green'>$lang_oui</font></td></tr>";
} else {
echo "<font color='red'> $erreur</font></td></tr>";
}

echo "<tr><td>$verif2 $fich3 :</td><td>";
if (is_writable("$fich3")) {
echo "<font color='green'>$lang_oui</font></td></tr>";
} else {
echo "<font color='red'> $erreur</font></td></tr>";
}
echo "
   </table>
  </center>
  <br>
";
if (
 is_writable ($doss1)
 && is_writable ($doss2)
 && is_writable ($doss3)
 && is_writable ($doss4)
 && is_writable ($doss5)
 && is_writable ($doss6)
 && is_writable ($fich1)
 && is_writable ($fich2)
 && is_writable ($fich3)
){
 echo "<h2>Tout est bien réglé ici.<br><a href='index2.php'>Étape Suivante</a></h2>";
}else {
 echo "<h1>Veuiller vérifier les erreurs ci-dessus avant de poursuivre</h1>";
}
include_once("../include/bas_cli.php");
?> 
  </td>
 </tr>
</table>
</body>
</html>
