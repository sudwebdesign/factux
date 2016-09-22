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
