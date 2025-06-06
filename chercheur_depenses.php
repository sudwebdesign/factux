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
include_once("include/finhead.php");
$tri=isset($_POST['tri'])?$_POST['tri']:"";
$requete = "
SELECT DATE_FORMAT(date,'%d/%m/%Y')as date, num, prix, lib, fournisseur
FROM " . $tblpref ."depense WHERE 1";

if ( isset ( $_POST['fournisseur'] ) && $_POST['fournisseur'] != '')//on verifie le client
	$requete .= " AND fournisseur='" . $_POST['fournisseur'] . "'";
if ( isset ( $_POST['numero'] ) && $_POST['numero'] != '')//on verifie le numero
	$requete .= " AND num='" . $_POST['numero'] . "'";
if ( isset ( $_POST['mois'] ) && $_POST['mois'] != '')//on verifie le mois
	$requete .= " AND MONTH(date)='" . $_POST['mois'] . "'";
if ( isset ( $_POST['annee'] ) && $_POST['annee'] != '')//on verifie l'année
	$requete .= " AND Year(date)='" . $_POST['annee'] . "'";
if ( isset ( $_POST['jour'] ) && $_POST['jour'] != '')//on verifie le jour
	$requete .= " AND DAYOFMONTH(date)='" . $_POST['jour'] . "'";
if ( isset ( $_POST['montant'] ) && $_POST['montant'] != '')//on verifie le montant
	$requete .= " AND trim(prix)='" . $_POST['montant'] . "'";
$requete .= " ORDER BY $tri";
?>
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php include_once("include/head.php"); ?>
   <table width='760' border='0' class='page' align='center'>
    <caption><?php echo $lang_res_rech; ?></caption>
    <tr>
     <th><?php echo $lang_numero; ?></th>
     <th><?php echo $lang_fournisseur; ?></th>
     <th><?php echo "$lang_date $lang_depenses"; ?></th>
     <th><?php echo "$lang_prix $lang_htva"; ?></th>
     <th><?php echo $lang_libelle; ?></th>
     <th><?php echo $lang_action; ?></th>
   </tr>
<?php
//on execute
$req = mysql_query($requete) or die('Erreur SQL !<br>'.$requete.'<br>'.mysql_error());
$c=0;
while($data = mysql_fetch_array($req)){
 $num = $data['num'];
 $total = $data['prix'];
 $lib = $data['lib'];
 $date = $data['date'];
 $nom = $data['fournisseur'];
 $line=($c++ & 1)?0:1;
?>
   <tr class="texte<?php echo $line; ?>" onmouseover="this.className='highlight'" onmouseout="this.className='texte<?php echo $line; ?>'">
    <td class= '<?php echo couleur_alternee (); ?>'><?php echo $num; ?></td>
    <td class= '<?php echo couleur_alternee (FALSE); ?>'><?php echo $nom; ?></td>
    <td class= '<?php echo couleur_alternee (FALSE,"c texte"); ?>'><?php echo $date; ?></td>
    <td class= '<?php echo couleur_alternee (FALSE,"nombre"); ?>'><?php echo montant_financier($total); ?></td>
    <td class= '<?php echo couleur_alternee (FALSE); ?>'><?php echo $lib; ?></td>
    <td class= '<?php echo couleur_alternee (FALSE,"c texte"); ?>'>
     <a href="edit_dep.php?num_dep=<?php echo $num; ?>">
      <img border="0" alt="editer" src="image/edit.gif">
     </a>
    </td>
   </tr>
<?php } ?>
   <tr><td colspan="10" class="td2"></td></tr>
  </table>
<?php
include("chercher_depenses.php");
?>
  </td>
 </tr>
</table>
</body>
</html>
