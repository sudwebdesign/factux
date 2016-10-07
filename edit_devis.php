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
 * * * Version:  5.0.0
 * * * * Modified: 07/10/2016
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
include_once("include/headers.php");
?><script type="text/javascript" src="javascripts/confdel.js"></script><?php
include_once("include/finhead.php");
if (!isset($dev_num) /*&& $dev_num ==''*/) { 
 $num_dev=isset($_GET['num_dev'])?$_GET['num_dev']:"";  
}
$nom=isset($_GET['article'])?$_GET['article']:"";
?>
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php
if (isset($message)&&$message!='') { 
 echo $message;
}
include ("form_editer_devis.php");
?>
  </td>
 </tr>
 <tr>
  <td>
<?php
$aide='devis';
include("help.php");
include("include/bas.php");
?>
  </td>
 </tr>
</table>
</body>
</html>
