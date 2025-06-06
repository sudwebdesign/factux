
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8"><?php #html5 ?>
<title>Mise a niveau de Factux : verifier les droits des fichiers de configuration</title>


<link rel='stylesheet' type='text/css' href='../../include/themes/default/style.css'>
<link rel="shortcut icon" type="image/x-icon" href="../../image/favicon.ico" >
</head><body>
<?php
echo '<center><img src="../../image/factux.gif" alt="">';
echo '<h2>Mise à niveau de Factux 5.0.0 -->  FactuX5.0.0</h2><hr>';
echo 'Vous voici dans le module de mise à niveau de Factux. Avant de commencer la mise à niveau <b>
<font color=red>faite une sauvegarde de votre base de donnée </font></b><br> ';
echo 'Si vous avez bien suivit les informations du fichier readme.txt vous avez:';
echo '<ul><li>Décompressé l\'archive sur votre disque dur, sauvgardé les fichiers /include/common.php et /include/var.php,</li>';
echo '<li>Téléversé les fichiers de l\'archive sur votre serveur en ayant au préalble fait place nette des fichiers de la version précedente de Factux</li>';
echo '<li>Téléversé le fichier var.php dans le dossier /include/config/<br>
(si des problemes se déclares avec le sigle  veulliez remplacer la ligne <code>$devise="&amp;euro;";</code> par <code>$devise="";</code> avant de remplacer le fichier du serveur)</li>';
echo '<li>Téléversé le fichier common.php dans le dossier /include/config/ </li>';

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
?>
<br><hr><br><center>Si tout est correct si dessus et que vous avez bien suivit le readme.txt vous pouver continuer</br>
je le répete <font color="red"> faite une sauvegarde de votre base de donnée avant de poursuivre</font><br>
En cliquant sur un des boutons suivants, vos bases de données seront modifiées et FactuX.5 pret à fonctionner.<br><br>
<b>ATTENTION</b><br>
Les tables de votre base de données vont être profondément modifiées et vos anciennes sauvegardes seront des lors inutilisables.<br>
Des la fin de la mise à jour verifier que vos anciennes factures sont correctes et faite une sauvegarde sur base de la nouvelle installation de Factux<br>
<script type="text/javascript">
function addquery(){
 var j = document.getElementById('j').value;
 var a = document.getElementsByTagName('a');//document.anchors;
 var i;
 for (i = 0; i < a.length; ++i){
  a[i].href = a[i].href + j;
 }
}
</script>
<br>Vos factures sont en général réglées <input type="text" id="j" value="30" size="2" /> jours après leurs dates de facturation (date de payement)<br>
<a onclick="addquery()" href='upgrade.php?daytopay='><button>continuer</button></a><br>
<a onclick="addquery()" href='upgrade.php?devnet&amp;daytopay='><button>continuer et nettoyer les devis gagnés</button></a>
</center>
<?php
}else{
echo "<font color='red'>Veuillez corriger les erreurs si dessus avant de poursuivre</font>";
}
?>
</body>
</html>
