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
$num_dep=isset($_GET['num_dep'])?$_GET['num_dep']:"";
?>
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php
include_once("include/head.php");
$sql = "SELECT * FROM " . $tblpref ."depense WHERE num=$num_dep";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_array($req)){
  $num = $data['num'];
  $prix = $data['prix'];
  $lib = $data['lib'];
  $four = $data['fournisseur'];
}
?>
  <center>
   <form name="form1" method="post" action="edit_dep_suite.php">
    <table class="page">
     <caption><?php echo $lang_modifier_depense; ?></caption>
     <tr>
      <th><b><?php echo $lang_libelle; ?></b></th>
      <th><b><?php echo $lang_montant_htva; ?></b></th>
      <th><b><?php echo $lang_fournisseur; ?></b></th>
     </tr>
     <tr>
      <td><input name="lib" type="text" value='<?php echo $lib; ?>'></td>
      <td><input name="prix" type="text" value="<?php echo $prix; ?>"></td>
      <td><input name="four" type="text" value='<?php echo $four; ?>'>
       <input name="num" type="hidden" value="<?php echo $num ?>">
      </td>
     </tr>
     <tr>
      <td colspan="3" class="submit">
       <center>
        <input type="submit" name="Submit" value="<?php echo $lang_modifier; ?>">
        &nbsp;&nbsp;
        <input type="reset" name="Submit2" value="<?php echo $lang_retablir; ?>">
       </center>
      </td>
     </tr>
    </table>
   </form>
  </center>
<?php
$aide='depense';
include_once("help.php");
include_once("include/bas.php");
?>
  </td>
 </tr>
 </table>
 </body>
 </html>
