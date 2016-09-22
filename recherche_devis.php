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
include_once("include/language/$lang.php");
include_once("include/headers.php");?>
<script type="text/javascript" src="javascripts/confdel.js"></script>
<?php
include_once("include/finhead.php");

$client=isset($_POST['listeville'])?$_POST['listeville']:"";
$numero=isset($_POST['numero'])?$_POST['numero']:"";
$mois=isset($_POST['mois'])?$_POST['mois']:"";
$jour=isset($_POST['jour'])?$_POST['jour']:"";
$annee=isset($_POST['annee'])?$_POST['annee']:"";
$montant=isset($_POST['montant'])?$_POST['montant']:"";
$tri=isset($_POST['tri'])?$_POST['tri']:"";
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

$requete = "SELECT DATE_FORMAT(date,'%d/%m/%Y')as date, num_dev, tot_htva, tot_tva, resu, nom FROM " . $tblpref ."devis RIGHT JOIN " . $tblpref ."client on " . $tblpref ."devis.client_num = num_client WHERE num_dev !=''";
//on verifie le client
if ( isset ( $_POST['listeville'] ) && $_POST['listeville'] != '')
{
$requete .= " AND num_client='" . $_POST['listeville'] . "'";
}
//on verifie le numero
if ( isset ( $_POST['numero'] ) && $_POST['numero'] != '')
{
$requete .= " AND num_dev='" . $_POST['numero'] . "'";
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
$requete .= " AND trim(devis.tot_htva)='" . $_POST['montant'] . "'";
}
if ($user_dev == 'r') {
$requete .="  and " . $tblpref ."client.permi LIKE '$user_num,' 
		 		or  " . $tblpref ."client.permi LIKE '%,$user_num,' 
					or  " . $tblpref ."client.permi LIKE '%,$user_num,%' 
				 or  " . $tblpref ."client.permi LIKE '$user_num,%' ";
}
$requete .= " ORDER BY $tri";  
//on execute
$req = mysql_query($requete) or die('Erreur SQL !<br>'.$sql2.'<br>'.mysql_error());
echo "<center><table class=\"boiteaction\">
  <caption>
  $lang_res_rech
  </caption>
"; 
echo "<tr><th>$lang_de_num<th>$lang_client<th>$lang_dev_date<th>$lang_total_h_tva <th>$lang_total_ttc<th colspan='3'>$lang_action<th colspan='2'><b>$lang_ga_per</b></tr>";
while($data = mysql_fetch_array($req))
    {
		$num_dev = $data['num_dev'];
		$total = $data['tot_htva'];
		$tva = $data['tot_tva'];
		$date = $data['date'];
		$nom = $data['nom'];
		$resu = $data['resu'];
?>
<tr>
<td class='<?php echo couleur_alternee (); ?>'><?php echo $num_dev; ?></td>
		<td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo $nom; ?></td>
		<td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo $date; ?></td>
		<td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo montant_financier($total); ?></td>
		<td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo montant_financier($tva); ?></td>
		<?php if ($resu !='ok' and $resu !='per') {?>
		<td class='<?php echo couleur_alternee (FALSE); ?>'><div align='center'><a href=edit_devis.php?num_dev=<?php echo $num_dev; ?>&amp;nom=<?php echo $nom; ?> >
						 <img border=0 alt=editer src=image/edit.gif></a></div>
		<?php 
}else { ?>
<td class= '<?php echo couleur_alternee (FALSE); ?>'>
<?php } ?>
		<td class='<?php echo couleur_alternee (FALSE); ?>'><div align='center'><a href=delete_dev_suite.php?num_dev=<?php echo $num_dev; ?>&amp;nom=<?php echo $nom; ?> onClick="return confirmDelete('<?php echo"$lang_eff_dev $num_dev ?"; ?>')">
			 			<img border=0 src= image/delete.jpg ></a></div>
		<td class='<?php echo couleur_alternee (FALSE); ?>'><div align='center'><a href=fpdf/devis_pdf.php?num_dev=<?php echo $num_dev; ?>&amp;nom=<?php echo $nom; ?>&amp;pdf_user=adm target=_blank >
			 			<img border=0 src= image/printer.gif ></a></div><br></td>
<?php if ($resu !='ok' and $resu !='per') {?>
		<td class= '<?php echo couleur_alternee (FALSE); ?>'><div align='center'><a href= convert.php?num_dev=<?php echo $num_dev; ?> onClick="return confirmDelete('<?php echo"$lang_convert_dev $num_dev $lang_convert_dev2 "; ?>')">
							 <img border=0 src= 'image/icon_lol.gif' alt='convertir'></a></div>
		<td class='<?php echo couleur_alternee (FALSE); ?>'><div align='center'><a href= devis_non_commandes.php?num_dev=<?php echo $num_dev; ?> onClick="return confirmDelete('<?php echo"$lang_dev_perd $num_dev $lang_dev_perd2 "; ?>')">
			 			 <img border=0 src= image/icon_cry.gif alt='perdu'></a></div></td></tr>
<?php 
}if ($resu =='ok') { ?>
<td class= '<?php echo couleur_alternee (FALSE); ?>'>Gagné</td>
<td class= '<?php echo couleur_alternee (FALSE); ?>'>
<?php } if ($resu =='per') {?>
<td class= '<?php echo couleur_alternee (FALSE); ?>'></td>
<td class= '<?php echo couleur_alternee (FALSE); ?>'>Perdu</td>
<?php 
}
		}
?>
</table></center><br><hr><tr><td>
<?php
include_once("chercher_devis.php");
include_once("include/bas.php");		
 ?>
 </table>