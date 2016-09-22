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
include("include/config/common.php");
include_once("include/config/var.php");
include("include/head.php");
require_once("include/graphisme.php");
echo '<link rel="stylesheet" type="text/css" href="include/style.css">';
echo'<link rel="shortcut icon" type="image/x-icon" href="image/favicon.ico" >';
$tri=isset($_POST['tri'])?$_POST['tri']:"";

//echo "<br><center><h2><b>$lang_res_rech</b><br><hr>";
$requete = "SELECT DATE_FORMAT(date,'%d/%m/%Y')as date, num, prix, lib, fournisseur FROM " . $tblpref ."depense WHERE 1";
//on verifie le client
if ( isset ( $_POST['fournisseur'] ) && $_POST['fournisseur'] != '')
{
$requete .= " AND fournisseur='" . $_POST['fournisseur'] . "'";
}
//on verifie le numero
if ( isset ( $_POST['numero'] ) && $_POST['numero'] != '')
{
$requete .= " AND num='" . $_POST['numero'] . "'";
}
//on verifie le mois
if ( isset ( $_POST['mois'] ) && $_POST['mois'] != '')
{
$requete .= " AND MONTH(date)='" . $_POST['mois'] . "'";
}
//on verifie l'année
if ( isset ( $_POST['annee'] ) && $_POST['annee'] != '')
{
$requete .= " AND Year(date)='" . $_POST['annee'] . "'";
}
//on verifie le jour
if ( isset ( $_POST['jour'] ) && $_POST['jour'] != '')
{
$requete .= " AND DAYOFMONTH(date)='" . $_POST['jour'] . "'";
}
//on verifie le montant
if ( isset ( $_POST['montant'] ) && $_POST['montant'] != '')
{
$requete .= " AND trim(prix)='" . $_POST['montant'] . "'";
}
$requete .= " ORDER BY $tri";  
//on execute
$req = mysql_query($requete) or die('Erreur SQL !<br>'.$sql2.'<br>'.mysql_error());
echo "<center><table width='760' border='0' class='page' align='center'>
  <caption>
  $lang_res_rech
  </caption>
"; 
echo "<tr><th>Bon N&deg; <th>Fournisseur<th>Date dépense<th>Prix<th>Libellé<th>action</tr>";
while($data = mysql_fetch_array($req))
    {
		$num = $data['num'];
		$total = $data['prix'];
		$lib = $data['lib'];
		$date = $data['date'];
		$nom = $data['fournisseur'];
?><tr>
		<td  class= '<?php echo couleur_alternee (); ?>'><?php echo $num; ?> </div></td>
		<td  class= '<?php echo couleur_alternee (FALSE); ?>'><?php echo $nom; ?> </td>
		<td  class= '<?php echo couleur_alternee (FALSE); ?>'><?php echo $date; ?> </td>
		<td  class= '<?php echo couleur_alternee (FALSE); ?>'><?php echo montant_financier($total); ?> </td>
		<td  class= '<?php echo couleur_alternee (FALSE); ?>'><?php echo $lib; ?> </td>
		<td  class= '<?php echo couleur_alternee (FALSE); ?>'><a href=edit_dep.php?num_dep=<?php echo $num; ?>  ><img border=0 alt=editer src=image/edit.gif></a>&nbsp;
		</div></td>
		<?php }
echo "</table><br><hr>";
include("chercher_dep.php");	
 ?>