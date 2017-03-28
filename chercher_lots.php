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
 * File Name: chercher_lots.php
 * 	formulaire de recherche de lot
 * 
 * * * Version:  5.0.0
 * * * * Modified: 07/10/2016
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
include_once("include/headers.php");
include_once("include/finhead.php");
?>
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php include_once("include/head.php"); ?>
   <center>
    <form action="chercheur_lots.php" method="post">
     <table class="page" border="0" align="center">
      <caption><?php echo $lang_lot_cherche_lot; ?></caption>
      <tr>
       <td class="texte0"><?php echo $lang_num_lot; ?></td>
      </tr>
      <tr>
       <td class="texte0"><input type="text" name="num_lot" /></td>
      </tr>
      <tr>
       <td class="submit" colspan="2"><input type="submit" value="<?php echo $lang_cherc; ?>" /></td>
      </tr>
     </table>
    </form>
   </center>
  </td>
 </tr>
 <tr>
  <td>
   <center>
    <form action="chercheur_lots_four.php" method="POST">
     <table class="page" border="0" align="center">
      <caption><?php echo $lang_lot_cherche_four; ?></caption>
      <tr>
       <td class="texte0"><?php echo $lang_lot_four; ?></td>
      </tr>
      <tr>
       <td class="texte0"><input type="text" name="lot_fou" /></td>
      </tr>
      <tr>
       <td class="submit" colspan="2"><input type="submit" value="<?php echo $lang_cherc; ?>" /></td>
      </tr>
     </table>
    </form>
   </center>
  </td>
 </tr>
 <tr>
  <td>
<?php
$aide='lots';
include("help.php");
include_once("include/bas.php");
?>
  </td>
 </tr>
</table>
</body>
</html>
