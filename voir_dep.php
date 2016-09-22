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
include_once("include/head.php");
include_once("include/language/$lang.php");
echo '<link rel="stylesheet" type="text/css" href="include/style.css">';
echo'<link rel="shortcut icon" type="image/x-icon" href="image/favicon.ico" >';
?>
<SCRIPT language="JavaScript" type="text/javascript">
		function confirmDelete()
		{
		var agree=confirm('<?php echo "Estes vous sûr de vouloir effacer cette dépense ?"; ?>');
		if (agree)
		 return true ;
		else
		 return false ;
		}
		</script>
<?php
echo "<br><center><h2>Les 20 dernieres dépenses<br><hr>";
$sql = "SELECT num, lib, fournisseur, prix, DATE_FORMAT(date,'%d/%m/%Y') AS date FROM " . $tblpref ."`depense`  ORDER BY `num` DESC LIMIT 20";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql2.'<br>'.mysql_error());
echo "<center><table class="boiteaction">
  <caption>
  Titre du tableau
  </caption>
"; 
echo "<tr><td>Dépense N&deg; <td class='td2'>$lang_libelle<td>$lang_total_h_tva <td class='td2'>$lang_fournisseur<td>$lang_date<td class='td2'><b>Editer</td><td><b>Effacer</tr>";
while($data = mysql_fetch_array($req))
    {
		$num = $data['num'];
		$date = $data['date'];
		$lib = $data['lib'];
		$fou = $data['fournisseur'];
		$fou = stripslashes($fou);
		$prix = $data['prix'];
		echo "<tr><td class='td2'>$num</div></td><td>$lib</td><td class='td2'>$prix</td><td>$fou</td><td class='td2'>$date</td><td><a href='edit_dep.php?num_dep=$num'><img border=0 alt=editer src=image/edit.gif></a><td class='td2'><a href=delete_dep.php?num=$num onClick='return confirmDelete()'><img border=0 src= image/delete.jpg ></a>";
		}
echo "</table><hr>";		
include_once("chercher_dep.php");
echo "<br><hr>"; 
include_once("include/bas.php");	
?>