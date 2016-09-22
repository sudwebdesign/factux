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
include_once("include/headers.php");?>
<script type="text/javascript" src="javascripts/confdel.js"></script>
<?php
include_once("include/finhead.php");
?>

<table width="760" border="0" class="page" align="center">
<tr>
<td class="page" align="center">
<?php
include_once("include/head.php");
?>
</td>
</tr>
<tr>
<td  class="page" align="center">
<?php 
if ($user_dep == n) { 
echo "<h1>$lang_depense_droit";
exit;
}
 ?> 
<?php
$sql = "SELECT num, lib, fournisseur, prix, DATE_FORMAT(date,'%d/%m/%Y') AS date 
	FROM " . $tblpref ."depense  
	ORDER BY `num` DESC LIMIT 10";
$req = mysql_query($sql);
?>
<table class="boiteaction">
  <caption><?php echo $lang_depenses_liste; ?></caption>
  <tr> 
    <th><?php echo $lang_numero; ?></th>
    <th><?php echo $lang_libelle; ?></th>
    <th><?php echo $lang_montant; ?></th>
    <th><?php echo $lang_fournisseur; ?></th>
    <th><?php echo $lang_date; ?></th>
    <th><?php echo $lang_editer; ?></th>
    <th><?php echo $lang_effacer; ?></th>
  </tr>
  <?php
	$nombre = 1;
while($data = mysql_fetch_array($req))
{
  $num = $data['num'];
  $date = $data['date'];
  $lib = $data['lib'];
  $fou = $data['fournisseur'];
  $fou = stripslashes($fou);
  $montant = $data['prix'];
	$nombre = $nombre +1;
		if($nombre & 1){
		$line="0";
		}else{
		$line="1"; 
		}
?>
  <tr class="texte<?php echo"$line" ?>" onmouseover="this.className='highlight'" onmouseout="this.className='texte<?php echo"$line" ?>'">
  	<td class="highlight"><?php echo $num; ?></td>
    <td class="highlight"><?php echo $lib; ?></td>
    <td class="highlight"><?php echo montant_financier ($montant); ?></td>
    <td class="highlight"><?php echo $fou; ?></td>
    <td class="highlight"><?php echo $date; ?></td>
    <td class="highlight"><a href='edit_dep.php?num_dep=<?php echo $num; ?>'>
	  <img border=0 alt=editer src=image/edit.gif></a></td>
    <td class="highlight"><a href="delete_dep.php?num=<?php echo $num; ?>" onClick="return confirmDelete('<?php echo"$lang_eff_conf_dep $num ?"; ?>')"> 
      <img border="0" src="image/delete.jpg" alt="effacer"></a></td>
  </tr>
  <?php
		}
		?>

<tr><td colspan="7" class="submit"></td></tr></table>
<tr><td>

<?php
include("help.php");
echo"</td></tr><tr><td>";
include_once("include/bas.php");
?>
</td></tr>
</table>
<?php 
$url = $_SERVER['PHP_SELF'];
$file = basename ($url); 
if ($file=="form_depenses.php") { 
echo"</table>";
}
 ?> 
</body>
</html>
