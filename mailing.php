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
 * File Name: mailing.php
 * 	envoie des courriels aux clients
 * 
 * * * Version:  5.0.0
 * * * * Modified: 07/10/2016
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
include_once("include/headers.php");
$titre=isset($_POST['titre'])?$_POST['titre']:"";
$message=isset($_POST['message'])?$_POST['message']:"";
if(empty($titre)&&$message=='&nbsp;'){
 $message = "<h1>$lang_oubli_champ</h1>";
 include_once("form_mailing.php");
 exit;
}
?>
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php
include_once("include/head.php");
$titre = stripslashes($titre);
$meText = stripslashes($message);
$message = $meText."\n";
$message = nl2br($message);
$from = "\"$entrep_nom\"<$mail>" ;//From: MonNom <monmon@monsite.com>\n"
$subject = "$titre" ;
?>
   <table class="page boiteaction">
    <caption><?php echo $lang_mail_a; ?></caption>
<?php
$sql2 = "SELECT * FROM " . $tblpref ."client WHERE mail!= ''AND actif != 'non'";
$req = mysql_query($sql2) or die('Erreur SQL !<br>'.$sql2.'<br>'.mysql_error());
while($data = mysql_fetch_array($req)){
  $to = $data['mail'];
  $nom = $data['nom'];
  $nom2 = $data['nom2'];
?>
    <tr>
     <td><a alt="mailto:<?php echo $to; ?>" href='mailto:<?php echo "$to?subject=".apostrophe($titre)."&amp;body=".strip_tags(str_replace("<br />","%0d%0a",apostrophe($meText))); ?>'><?php echo "$nom $nom2"; ?></a></td>
     <td><?php echo(courriel($to,$subject,$message,$from,$logo))?"$lang_email_envoyé":"$lang_email_envoi_err";?></td>
    </tr>
<?php } ?>
   </table>
<?php 
include_once("include/bas.php");
?> 
  </td>
 </tr>
</table>
</body>
</html>
