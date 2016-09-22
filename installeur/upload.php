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
 * File Name: upload.php
 * 	upload du logo de l'entreprise
 * 
 * * * Version:  1.1.5
 * * * * Modified: 23/07/2005
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
//Pour ne traiter que si un fichier est upLoadé
if (isset($_FILES["monfichier"]["name"]))
{

//definition des chemins d'accès
$repertoireDestination = "../image/";
$nomDestination = $_FILES["monfichier"]["name"];

//upload du fichier

if (is_uploaded_file($_FILES["monfichier"]["tmp_name"])) {

if (file_exists($repertoireDestination.$nomDestination)) {
//Un fichier existe portant le même nom existe déjà => le supprimer
//unlink ($repertoireDestination.$nomDestination);
echo "<br><h1>Un fichier portant le même nom existe. Veuillez renommer votre fichier avant de l'uploader !</h1>";
include_once('form_upload.inc.php');
exit();
}
///////////////////////
//$extention_autorize="jpg|jpe|jpeg"; 
$extention_fichier=substr(strrchr($nomDestination,'.'),1);
 
              if ($extention_fichier=='jpg' | $extention_fichier=='jpe' |$extention_fichier=='jpeg'){
                 $autorize="ok";
             }else{
			 echo"<br><h1>Le logo doit absolument etre au format jpg (extention .jpg, jpeg, jpe) </h1>";
			 include_once('form_upload.inc.php');
			 exit();
		 } 

if (rename($_FILES["monfichier"]["tmp_name"],
$repertoireDestination.$nomDestination)) {

echo "<link rel='stylesheet' type='text/css' href='../include/themes/default/style.css'>";
echo'<link rel="shortcut icon" type="image/x-icon" href="../image/favicon.ico" >';
echo '<table width="100%" border="1" cellpadding="0" cellspacing="0" summary="">';
echo '<tr><td class ="install"><img src="../image/factux.gif" alt=""><br><IMG SRC="../image/spacer.gif" WIDTH=150 HEIGHT=400 ALT=""><br></th><td>';

echo "<br>L'image ".$nomDestination." a bien été chargée dans le dossier : ".$repertoireDestination;

$type_fin ='?>';
$nomDestination = '"'.$nomDestination.'";//nom du logo de l\'entreprise' . "\n";
$monfichier = fopen("../include/config/var.php", "a"); 
fwrite($monfichier, '$logo= '.$nomDestination.''.$type_fin.'');
fclose($monfichier);
 
?>
<br><h2>La configuration de factux est terminée, félicitations.<br>
<h2>Entrez dans <a href="../index.php">Factux</a> 
<?php
} else {
echo "<br><h1>Le déplacement du fichier temporaire a échoué".
" vérifiez l'existence du répertoire ".$repertoireDestination;
}
} else {
echo "<br>Le fichier n'a pas été uploadé (trop volumineux ?)";
include_once('form_upload.inc.php');
}
}
else
{
include_once('form_upload.inc.php');

}
//Fin de ISSET et du programme
?> 