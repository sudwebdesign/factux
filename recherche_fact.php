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
 * File Name: recherche_fact.php
 * 	resultat de la recherche des factures
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
include_once("include/utils.php");
include_once("include/configav.php");
include_once("include/headers.php");
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

$tri=isset($_POST['tri'])?$_POST['tri']:"";

$requete = "SELECT * FROM " . $tblpref ."facture RIGHT JOIN " . $tblpref ."client on " . $tblpref ."facture.client = num_client WHERE num !=''";
//on verifie le client
if($liste_cli == 'y'){
if($_POST['list_client']=='on')
{
$requete .= " AND client='" . $_POST['listeville'] . "'";
}
}else{
if ( isset ( $_POST['listeville'] ) && $_POST['listeville'] != '')
{
$requete .= " AND client='" . $_POST['listeville'] . "'";
}
}
//on verifie le numero
if ( isset ( $_POST['numero'] ) && $_POST['numero'] != '')
{
$requete .= " AND num='" . $_POST['numero'] . "'";
}
//on verifie le mois
if ( isset ( $_POST['mois'] ) && $_POST['mois'] != '')
{
$requete .= " AND MONTH(date_fact)='" . $_POST['mois'] . "'";
}
//on verifie l'année
if ( isset ( $_POST['annee'] ) && $_POST['annee'] != '')
{
$requete .= " AND Year(date_fact)='" . $_POST['annee'] . "'";
}
//on verifie le jour
if ( isset ( $_POST['jour'] ) && $_POST['jour'] != '')
{
$requete .= " AND DAYOFMONTH(date_fact)='" . $_POST['jour'] . "'";
}
//on verifie le montant
if ( isset ( $_POST['montant'] ) && $_POST['montant'] != '')
{
$requete .= " AND trim(total_fact_T.T.C) =" . $_POST[montant] . "";
}
//
if($use_payement =='y'){
if ( isset ( $_POST['payement'] ) && $_POST['payement'] != '')
{
$requete .= " AND payement ='" . $_POST[payement] . "'";
}
}else{
if ( isset ( $_POST['payement'] ) && $_POST['payement'] != '')
{
if($_POST['payement'] =='non'){
$requete .= " AND payement ='non'";
}else{
$requete .= " AND payement !='non'";
}
}
}
if ($user_fact == 'r') {
$requete .="  and " . $tblpref ."client.permi LIKE '$user_num,' 
		 		or  " . $tblpref ."client.permi LIKE '%,$user_num,' 
					or  " . $tblpref ."client.permi LIKE '%,$user_num,%' 
				 or  " . $tblpref ."client.permi LIKE '$user_num,%' ";
}
//

$requete .= " ORDER BY $tri";
//on execute
$req = mysql_query($requete) or die('Erreur SQL !<br>'.$sql2.'<br>'.mysql_error());
echo "<center><table >
<caption>
 $lang_res_rech
  </caption>
"; 
echo "<tr><th>Fac N&deg; <th>Client<th>Date du bon <th>$lang_total_h_tva <th>Total T.T.C<th>pay<th colspan=\"2\">Action</tr>";
$nombre =1;
while($data = mysql_fetch_array($req))
    {
		$num = $data['num'];
		$total = $data['total_fact_h'];
		$tva = $data['total_fact_ttc'];
		$date = $data['date_fact'];
		$nom = $data['nom'];
		$debut = $data['date_deb'];
		$fin = $data['date_fin'];
		$client = $data['client'];
		$num_client = $data['num_client'];
		$pay = $data['payement'];
		$nombre = $nombre +1;
		if($nombre & 1){
		$line="0";
		}else{
		$line="1"; 
		}
?><tr class="texte<?php echo"$line" ?>" onmouseover="this.className='highlight'" onmouseout="this.className='texte<?php echo"$line" ?>'">
  	 <td class="highlight"><?php echo $num ; ?></td>
		<td class="highlight"><?php echo $nom ; ?></td>
		<td class="highlight"><?php echo $date ;?></td>
		<td class="highlight"><?php echo montant_financier($total) ; ?></td>
		<td class="highlight"><?php echo montant_financier($tva) ; ?></td>
		<td class="highlight"><?php echo $pay ;?>
		<td class="highlight">
		<form action="fpdf/fact_pdf.php" method="post" target="_blank" >
					<input type="hidden" name="client" value="<?php echo $num_client ?>" />
					<input type="hidden" name="debut" value="<?php echo $debut ?>" />
					</form>
		<input type="hidden" name="fin" value="<?php echo $fin ?>" />
		<input type="hidden" name="num" value="<?php echo $num ?>" />
		<input type="hidden" name="user" value="adm" />
		<input type="image" src="image/printer.gif" style=" border: none; margin: 0;" alt="imprimer" />
		<td class="highlight"><a href="edit_fact.php?num_fact=<?php echo"$num";?>"><img alt="editer" src="image/edit.gif" border="0" /></a>   


</td>
<?php }
echo "</table></center><br><hr>";
include("chercher_factures.php");
include_once("include/bas.php");		
 ?>
 </table>