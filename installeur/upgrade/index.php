
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"> 
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15">
<title>Factux : l'installeur</title>


<link rel='stylesheet' type='text/css' href='../../include/themes/default/style.css'>
<link rel="shortcut icon" type="image/x-icon" href="../../image/favicon.ico" >
</head><body>
<?php
echo '<center><img src="../../image/factux.gif" alt="">';
echo '<h2>Upgrade de Factux 1.1.4 --> 1.1.5</h2><hr>';
echo 'Vous voici dans le module d\'upgrade de Factux  avant de commencer l\'upgrade <b>
<font color=red>faite un backup de votre base de donnée </font></b><br> ';
echo 'Si vous avez bien suivit les informations du fichier readme.txt vous avez:';
echo '<ul><li>Décompressez l\'archive sur votre disque dur, sauvgardez le fichier /include/common.php 
et /include/var.php </li>';
echo '<li>Uploader les fichier de l\'archive sur votre serveur en ecrassant les fichiers de la version précedente de Factux 1.1.2</li>';
echo '<li>Reuploader les fichier var.php dans le dossier /include/config/(si vous utiliser le sigle  vous devez remplacer la ligne <code>$devise ="&amp;#128;";</code> par <code>$devise ="&amp;euro;";</code> avant de reuploader le fichier )</li>';
echo '<li>Reuploader les fichier common.php dans le dossier /include/config/ </li>';

echo '<li>Si vous avez modifié les fichier fact_pdf.php ou bon_pdf.php 
vous devrez malheureusement refaire ces modifications</li></ul>';

$erreur = "Erreur veuiller vérifier les droits en écriture sur ce fichier !!";
$verif = "Vérification des droits d'écriture pour le répertoire";
$verif2 = "Vérification des droits d'écriture pour le fichier";
$doss1 = "../../include";
$doss2 = "../../dump";
$doss4 = "../../image";
$doss3 = "../..";
$doss5 = "../../include/session";
$doss6 = "../../fpdf";
$fich3 = "../../include/configav.php";

	$error='0';

echo "<br><hr><br><center><table>";
echo"<caption>Vérification des droits.</caption>";
echo "<tr><td>$verif $doss1 :<td>";
if (is_writable("$doss1")) {
echo "<font color=green> OK</font></td></tr>";  
} else {
echo "<font color=red> $erreur</td></tr>";
$error='1';
}
echo "<tr><td>$verif $doss2 :<td>";
if (is_writable("$doss2")) {
echo "<font color=green> OK</font></td></tr>";  
} else {
echo "<font color=red> $erreur</td></tr>";  
$error='1';
}

echo "<tr><td>$verif $doss3 :<td>";
if (is_writable("$doss3")) {
echo "<font color=green> OK</font></td></tr>";  
} else {
echo "<font color=red> $erreur</td></tr>";  
$error='1';
}
echo "<tr><td>$verif $doss4 :<td>";
if (is_writable("$doss4")) {
echo "<font color=green> OK</font></td></tr>";  
} else {
echo "<font color=red> $erreur</td></tr>";  
$error='1';
}

echo "<tr><td>$verif $doss5 :<td>";
if (is_writable("$doss5")) {
echo "<font color=green> OK</font></td></tr>";  
} else {
echo "<font color=red> $erreur</td></tr>";  
$error='1';
}

echo "<tr><td>$verif $doss6 :<td>";
if (is_writable("$doss6")) {
echo "<font color=green> OK</font></td></tr>";
} else {
echo "<font color=red> $erreur</td></tr>";
$error='1';
}
echo "<tr><td>$verif2 $fich3 :<td>";
if (is_writable("$fich3")) {
echo "<font color=green> OK</font></td></tr>";
} else {
echo "<font color=red> $erreur</font></td></tr>";
$error='1';
}

echo "</table></center>";	
if($error !='1'){
echo "<br><hr><br><center>Si tout est corect si dessus et que vous avez bien suivit le readme.txt vous pouver continuer</br>je le repete faite <font color=red> une sauvgarde de votre base de donnée avant de poursuivre</font><br>";
echo "En cliquant sur le lien suivant vos bases de données seront modifiées et Factux 1.1.5 pret à fonctionner.<br><br>";
echo"<center><b>attention</b></center><br>Les bases de données seront profondement modifiées et vos anciens fichiers de backup seront des lors inutilisable.<br>";
echo"Des la fin de la mise à jour verifier que vos anciennes factures sont correctes et faite un backup sur base de la nouvelle installation de Factux<br>"; 
echo "<a href='upgrade.php'><button>continuer</button></a></center>";
}else{
echo "<font color='red'>Veuillez corriger les erreurs si dessus avant de poursuivre</font>";
}
?>