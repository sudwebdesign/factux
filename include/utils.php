<?php
/*
 * Factux le facturier libre
 * Copyright (C) 2003-2005 Guy Hendrickx, 2017 Thomas Ingles
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
 * * Version:  5.0.0
 * * * Modified: 07/10/2016
 *
 * File Authors:
 * 		Guy Hendrickx
 *.
 */

include_once("nb.php");
include_once("date.php");
include_once("graphisme.php");
function naviguer($ou,$mois_1,$annee_1,$titre, $style="color:#ffffff;text-decoration:none;"){#lister_* caption's
 $adresse = $ou.'&amp;mois_1=';
 $an = '&amp;annee_1=';
 $m=$d=$n=$f=0;
 if($mois_1==1){
  $m=12;
  $d=1;
 }
 if($mois_1==12){
  $n=-12;
  $f=1;
 }
 $style = '" style="'.$style;
 global $lang_toutes;
 global $lang_tous;
 if ($annee_1==$lang_toutes){$dan=$annee_1;$fan=$annee_1;}else{$dan=($annee_1-$d);$fan=($annee_1+$f);}#an protect word
?><?php if ($annee_1!=$lang_toutes): ?>
     <a href="<?php echo $adresse.$mois_1.$an.($annee_1-1).$style; ?>" title="Année Precedente">&laquo;<?php echo ($annee_1-1);#ââ ?></a>
     &nbsp;&nbsp;<?php endif; if ($mois_1!=$lang_tous): ?>
     <a href="<?php echo $adresse.($m+$mois_1-1).$an.$dan.$style; ?>" title="Mois Precedent">&lt;<?php printf("%02d", ($m+$mois_1-1));#â ?></a>
     &nbsp;&nbsp;<?php endif; ?>
     <?php echo $titre." (".(($mois_1!=$lang_tous)?sprintf("%02d",$mois_1):$mois_1)."/$annee_1)"; ?>
     &nbsp;&nbsp;<?php if ($mois_1!=$lang_tous): ?>
     <a href="<?php echo $adresse.($n+$mois_1+1).$an.$fan.$style; ?>" title="Mois Suivant"><?php printf("%02d", ($n+$mois_1+1));#âº ?>&gt;</a>
     &nbsp;&nbsp;<?php endif; if ($annee_1!=$lang_toutes): ?>
     <a href="<?php echo $adresse.$mois_1.$an.($annee_1+1).$style; ?>" title="Année Suivante"><?php echo ($annee_1+1);#âºâº ?>&raquo;</a>
<?php endif;
}
function thespecialchars ($str){
 if (version_compare(phpversion(), '5.4', '<'))
  return htmlspecialchars($str, ENT_COMPAT , ini_get("default_charset"));
 else
  return htmlspecialchars($str, ENT_COMPAT | ENT_HTML401 | ENT_SUBSTITUTE, ini_get("default_charset"), FALSE);
}
function courriel($a,$sujet,$mess,$de,$logo){//inspiré de : https://openclassrooms.com/courses/e-mail-envoyer-un-e-mail-en-php
 if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $a)) // On filtre les serveurs qui présentent des bogues.
  $cr = "\r\n";
 else
  $cr = "\n";

 //~ $mess = utf8_decode(str_replace('€','',$mess));//Failed with errno=32 Broken pipe
 //~ $mess = utf8_decode(str_replace('€','euro',$mess));//Failed with errno=32 Broken pipe
 $mess = iconv("UTF-8", "CP1252", $mess);#http://php.net/manual/fr/function.utf8-decode.php#88488

 //=====Déclaration des messages au format texte et au format HTML.
 $message_txt = strip_tags(str_replace("<br />","%0d%0a",$mess));
 $message_html = "<html><head></head><body>".$mess."</body></html>";

 //=====Lecture et mise en forme de la pièce jointe.
 $fichier   = fopen("image/$logo", "r");
 $attachement = fread($fichier, filesize("image/$logo"));
 $attachement = chunk_split(base64_encode($attachement));
 fclose($fichier);

 //=====Création de la boundary.
 $boundary = "-----=".md5(rand());
 $boundary_alt = "-----=".md5(rand());

 //=====Création du header de l'e-mail.
 $header = "From: ".$de.$cr;
 $header.= "Reply-to: ".$de.$cr;
 $header.= "MIME-Version: 1.0".$cr;
 $header.= "Date: ".date("r").$cr;
 $header.= "Content-Type: multipart/mixed;".$cr." boundary=\"$boundary\"".$cr;

 //=====Création du message.
 $message = $cr."--".$boundary.$cr;
 $message.= "Content-Type: multipart/alternative;".$cr." boundary=\"$boundary_alt\"".$cr;
 $message.= $cr."--".$boundary_alt.$cr;
 //=====Ajout du message au format texte.
 $message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$cr;
 $message.= "Content-Transfer-Encoding: 8bit".$cr;
 $message.= $cr.$message_txt.$cr;
 //==========

 $message.= $cr."--".$boundary_alt.$cr;

 //=====Ajout du message au format HTML.
 $message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$cr;
 $message.= "Content-Transfer-Encoding: 8bit".$cr;
 $message.= $cr.$message_html.$cr;

 //=====On ferme la boundary alternative.
 $message.= $cr."--".$boundary_alt."--".$cr;

 $message.= $cr."--".$boundary.$cr;

 //=====Ajout du logo en pièce jointe.
 $message.= "Content-Type: image/jpeg; name=\"$logo\"".$cr;
 $message.= "Content-Transfer-Encoding: base64".$cr;
 $message.= "Content-Disposition: attachment; filename=\"$logo\"".$cr;
 $message.= $cr.$attachement.$cr.$cr;
 $message.= $cr."--".$boundary."--".$cr;
 //==========
 //=====Envoi de l'e-mail.
 return (mail($a,$sujet,$message,$header))?true:false;
}