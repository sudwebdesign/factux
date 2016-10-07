<?php 
/*
 * Factux le facturier libre
 * Copyright (C) 2003-2005 Guy Hendrickx, 2017 Thomas Ingles
 * 
 * Licensed under the terms of the GNU  General Public License:
 *   http://opensource.org/licenses/GPL-3.0
 * 
 * For further information visit:
 *   http://factux.free.fr
 * 
 * File Name: edit_bon.php
 *  apel au formulaire d'edition du bon de commande
 * 
 * * * Version:  5.0.0
 * * * * Modified: 07/10/2016
 * 
 * File Authors:
 *   Guy Hendrickx
 *.
 */
include_once("include/headers.php");
?><script type="text/javascript" src="javascripts/confdel.js"></script><?php
include_once("include/finhead.php");
?>
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php
if(!isset($num_bon)/* && $num_bon==''*/){
 $num_bon=isset($_GET['num_bon'])?$_GET['num_bon']:"";
 $nom=isset($_GET['nom'])?$_GET['nom']:"";
}
$sql = "SELECT fact FROM " . $tblpref ."bon_comm WHERE num_bon = $num_bon";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_array($req)){
 $fact = $data['fact'];
}
if((isset($fact)) && $fact!='0'){#$fact=='ok'
 $message = "<h1>$lang_err_efa_bon</h1>";
 include('form_commande.php');
 exit;
}
if (isset($message)&&$message!='') { 
 echo $message;
}
include ("form_editer_bon.php");
?>
  </td>
 </tr>
 <tr>
  <td>
<?php
$aide='bon';
include("help.php");
include_once("include/bas.php");
?>
  </td>
 </tr>
</table>
</body>
</html>
