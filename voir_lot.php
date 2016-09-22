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
 * File Name: voir_lot.php
 * 	montre les lots
 * 
 * * * Version:  1.1.5
 * * * * Modified: 23/07/2005
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
include_once("include/headers.php");
include_once("include/finhead.php");
$num_lot=isset($_GET['num'])?$_GET['num']:"";
$sql = "
SELECT ingr, fourn, fourn_lot 
FROM " . $tblpref ."cont_lot 
WHERE num_lot = $num_lot
";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
?>
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php
include_once("include/head.php");
if ($user_com == 'n') { 
 echo"<h1>$lang_commande_droit</h1>";
 exit;  
}
if ($num_lot == '0') { 
 echo"<h2>$lang_lot_zero</h2>";
}
?>
   <table width='760' border='0' class='page' align='center'>
    <caption><?php echo "Contenu du lot $num_lot"; ?></caption>
    <tr> 
     <th><?php echo $lang_ingred; ?></th>
     <th><?php echo $lang_fournisseur; ?></th>
     <th><?php echo $lang_lot_four; ?></th>
    </tr>
<?php
$c=0;
while($data = mysql_fetch_array($req)){
  $ingr = $data['ingr'];
  $fourn = $data['fourn'];
  $fourn_lot = $data['fourn_lot'];
 if($c++ & 1){
  $line="0";
 }else{
  $line="1";
 }
?>
    <tr class="texte<?php echo $line; ?>" onmouseover="this.className='highlight'" onmouseout="this.className='texte<?php echo $line; ?>'">
     <td class='<?php echo couleur_alternee (); ?>'><?php echo $ingr; ?></td>
     <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo $fourn; ?></td>
     <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo $fourn_lot; ?></td>
    </tr>
<?php } ?> 
   </table>
  </td>
 <tr>
  <td class="page">
   <a href="edit_lot.php?num=<?php echo $num_lot; ?>&amp;mois_1=<?php echo $_GET['mois_1']; ?>&amp;annee_1=<?php echo $_GET['annee_1']; ?>"><?php echo $lang_editer; ?></a>
   &nbsp;&nbsp;
   <a href="lister_lot.php?mois_1=<?php echo $_GET['mois_1']; ?>&amp;annee_1=<?php echo $_GET['annee_1']; ?>"><?php echo $lang_lister; ?></a>
  </td>
 </tr>
 </tr>
 <tr> 
  <td>
<?php
$aide='admin';
include("help.php");
include_once("include/bas.php");
?>
  </td>
 </tr>
</table>
</body>
</html>
