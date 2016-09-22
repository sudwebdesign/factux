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
require_once("include/verif.php");
include_once("include/config/common.php");
include_once("include/config/var.php");
include_once("include/language/$lang.php");
include_once("include/utils.php");
$type =isset($_GET['type'])?$_GET['type']:"";
$email =isset($_GET['mail'])?$_GET['mail']:"";
//p?type=comm&mail=$mail
 ?> 
 </head>
 <!-- InstanceBeginEditable name="doctitle" --> 
<title><?php echo "$lang_factux" ?></title>
<!-- InstanceEndEditable --> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="include/style.css">
<!-- InstanceBeginEditable name="head" --> <!-- InstanceEndEditable -->
</head>
<?php 
if ($type == comm) { 
$titre = "Nouveau bon de commande";
$message = "Un nouveau bon de commade vous est adressé par $entrep_nom <br>vous pouvez le consulter en vous rendant sur le site internet avec votre login mot de passe<br>$entrep_nom";
}
if ($type == fact) { 
$titre = "Nouvele facture";  
$message = "Une nouvelle facture vous est adressé par $entrep_nom <br>vous pouvez la consulter en vous rendant sur le site internet avec votre login mot de passe<br>$entrep_nom";
}
if ($type == devis) { 
$titre = "Nouveau devis";
$message = "Un nouveau devis vous est adressé par $entrep_nom <br>vous pouvez le consulter en vous rendant sur le site internet avec votre login mot de passe<br>$entrep_nom";
}
$to = "$email";
$from = "$entrep_nom<$mail>" ;
$subject = "$titre" ;
$header = 'From: '.$mail ."\n"
 .'MIME-Version: 1.0'."\n"
 .'Reply-To: '.$from."\n"
 .'X-priority: 3 (Normal)'."\n"
  .'X-Mailer: Factux'."\n"
 .'Content-Type: text/html; charset= ISO-8859-1; charset= ISO-8859-1'."\n"
 .'Content-Transfer-Encoding: 8bit'."\n\n";
	mail($to,$subject,$message,$header);
echo "mail de notification envoyé !";
if ($type == comm) {
include_once("lister_commandes.php");
}
if ($type == fact) { 
include_once("lister_factures.php");
}
if ($type == devis) { 
include_once("lister_devis.php");
}
?> 
