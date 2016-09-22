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
 * File Name: mailing.php
 * 	envoie des courriels aux clients
 * 
 * * * Version:  1.1.5
 * * * * Modified: 23/07/2005
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
$titre= stripslashes($titre);
$message = stripslashes($message);
$body = "<html><body>";
$body2 = "</body></html>";
$message = $body.$message."\n".$body2;
$message= nl2br($message);
$from = "$entrep_nom<$mail>" ;//From: MonNom <monmon@monsite.com>\n"
$subject = "$titre" ;
$header = 'From: '.$from ."\n"
 .'MIME-Version: 1.0'."\n"
 .'Reply-To: '.$from."\n"
 .'X-priority: 3 (Normal)'."\n"
  .'X-Mailer: Factux'."\n"
 .'Content-Type: text/html; charset= ISO-8859-1; charset= ISO-8859-1'."\n"
 .'Content-Transfer-Encoding: 8bit'."\n\n";
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
     <td><a alt="mailto:<?php echo $to; ?>" href='mailto:<?php echo "$to?subject=".$titre."&amp;body=".$message; ?>'><?php echo "$nom $nom2"; ?></a></td>
<?php
  if(mail($to,$subject,$message,$header)){
   echo "<td>$lang_email_envoyé</td></tr>";
  }else
   echo "<td>$lang_email_envoi_err</td></tr>";
}
$message = str_replace(['html>','body>'],['div>','div>'],$message);
?>
   </table>
   <?php echo $titre; ?>
   <?php echo $message; ?>
   <?php echo $from; ?>
<?php
include_once("include/bas.php");
?> 
  </td>
 </tr>
</table>
</body>
</html>
