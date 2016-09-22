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
//ini_set('post_max_size', '2048000000');51000 == 51ko
//ini_set('upload_max_filesize', '2048000000');
$etape = "�tape N�6 : Enregister le fichier contenant le logo de l'entreprise.";
include_once('headers.php');
//Pour ne traiter que si un fichier est upLoad�
if (isset($_FILES["monfichier"]["name"])) {
/*   // Check $_FILES['monfichier']['error'] value. #http://php.net/manual/fr/features.file-upload.php#114004
    switch ($_FILES['monfichier']['error']) {
        case UPLOAD_ERR_OK:
            break;
        case UPLOAD_ERR_NO_FILE:
            throw new RuntimeException('No file sent.');
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            throw new RuntimeException('Exceeded filesize limit.');
        default:
            throw new RuntimeException('Unknown errors.');
    } 
*/
 //definition des chemins d'acc�s
 $repertoireDestination = "../image/";
 $nomDestination = $_FILES["monfichier"]["name"];
 //upload du fichier
 if (is_uploaded_file($_FILES["monfichier"]["tmp_name"])) {
  if (file_exists($repertoireDestination.$nomDestination)) {//Un fichier existe portant le m�me nom existe d�j� => le supprimer
   //unlink ($repertoireDestination.$nomDestination);
   echo "<br><h1>Un fichier portant le m�me nom existe. Veuillez renommer votre fichier avant de l'uploader !</h1>";
   include_once('form_upload.inc.php');
   exit();
  }
  ///////////////////////
  //$extention_autorize="jpg|jpe|jpeg"; 
  $extention_fichier=substr(strrchr($nomDestination,'.'),1);
  if ($extention_fichier!='jpg'&& $extention_fichier!='jpe'&&$extention_fichier!='jpeg'){
   echo"<br><h1>Le logo doit absolument etre au format jpg (extention .jpg, jpeg, jpe) </h1>";
   include_once('form_upload.inc.php');
   exit();
  }else{
   $autorize="ok";
  } 
  if (rename($_FILES["monfichier"]["tmp_name"],$repertoireDestination.$nomDestination)) {
   echo "<br><h2>L'image ".$nomDestination." a bien �t� charg�e dans le dossier : ".$repertoireDestination;
   $nomDestination = '"'.$nomDestination.'";//fichier comportant le logo de l\'entreprise' . "\n";
   $monfichier = fopen("../include/config/var.php", "a"); 
   fwrite($monfichier, '$logo = '.$nomDestination);
   fclose($monfichier);
?>
   <br>La configuration de factux est termin�e, f�licitations.<br>
   Voir la doc
   <a href="../doc/Utilisation-fr.html"
      onclick="window.open('','popup','width=500,height=220,top=200,left=150,toolbar=0,location=0,directories=0,status=0,menubar=1,scrollbars=1,resizable=1')" 
      target="popup">
    <img src="../image/help.png" border="0" alt="aide" title="aide"></a><br>
   <a href="../index.php">Entrez<br><img src="../image/factux.gif" border="0" alt="Entrez dans Factux" title="Entrez dans Factux"></a></h2> 
<?php
  }
  else {
   echo "<br><h1>Le d�placement du fichier temporaire a �chou�".
   " v�rifiez l'existence du r�pertoire ".$repertoireDestination."</h1>";
  }
 }
 else {
  echo "<br><h1>Le fichier n'a pas �t� upload� (trop volumineux ?)</h1>";
  include_once('form_upload.inc.php');
 }
}
else{
 include_once('form_upload.inc.php');
}
//var_dump($_FILES);
//Fin de ISSET et de l'installeur
include_once("../include/bas_cli.php");
?> 
  </td>
 </tr>
</table>
</body>
</html>
