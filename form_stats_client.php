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

include_once("include/verif.php");
include_once("include/head.php");
include_once("include/config/common.php");
include_once("include/headers.php");
include_once("include/finhead.php");
?>
<br><center><h2>Voir les stats par client pour le mois de</font><br><hr>
<table border="1" cellspacing="0" cellpadding="0">
  <tr>
    <tr colspan="4"><form name="form_facture" method="post" action="stats2.2.php">
      <p align="center">
 
          Mois: 
          <input name="mois" type="text" id="mois" size="2" value=<?php 
$mois = date("m");
echo "$mois"; 
 ?> maxlength="2">
ann&eacute;e:
<input name="annee" type="text" id="annee" value=<?php 
$annee = date("Y");
echo "$annee"; 
 ?> size="4"><br>
 
  <input type="submit" name="Submit" value="Voir les stats">  
        </p>
    </form><hr>
<?php 
include_once("include/bas.php");
 ?> 
</tr> </table></body></html>