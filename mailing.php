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
 * 	envoie des mail au clients
 * 
 * * * Version:  1.1.5
 * * * * Modified: 23/07/2005
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
require_once("include/verif.php");
include_once("include/config/common.php");
include_once("include/head.php");
include_once("include/config/var.php");
echo '<link rel="stylesheet" type="text/css" href="include/style.css">';
echo'<link rel="shortcut icon" type="image/x-icon" href="image/favicon.ico" >';
echo "<hr>";
$titre=isset($_POST['titre'])?$_POST['titre']:"";
$message=isset($_POST['message'])?$_POST['message']:"";
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

echo "<center><table class='boiteaction'>
  <caption>
$lang_mail_a
  </caption>
";
$sql2 = "SELECT * FROM " . $tblpref ."client WHERE mail!= ''AND actif != 'non'";
$req = mysql_query($sql2) or die('Erreur SQL !<br>'.$sql2.'<br>'.mysql_error());
while($data = mysql_fetch_array($req))
    {
	$to = $data['mail'];
	$nom = $data['nom'];
	$nom2 = $data['nom2'];
		echo "<tr><td><a href='mailto:$to'>$nom $nom2</a></td></tr>";
	mail($to,$subject,$message,$header);
	}
	echo "</table>$titre<br>$message<br>$from<br><hr>";
include_once("include/bas.php");
 ?> 