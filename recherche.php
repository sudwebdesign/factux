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
 * File Name: recherche.php
 * 	reponse du formulaire de recherche de bons.
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

$client=isset($_POST['listeville'])?$_POST['listeville']:"";
$numero=isset($_POST['numero'])?$_POST['numero']:"";
$mois=isset($_POST['mois'])?$_POST['mois']:"";
$jour=isset($_POST['jour'])?$_POST['jour']:"";
$annee=isset($_POST['annee'])?$_POST['annee']:"";
$montant=isset($_POST['montant'])?$_POST['montant']:"";
$tri=isset($_POST['tri'])?$_POST['tri']:"";
?>
<SCRIPT language="JavaScript" type="text/javascript">
		function confirmDelete()
		{
		var agree=confirm('<?php echo "$lang_con_effa"; ?>');
		if (agree)
		 return true ;
		else
		 return false ;
		}
		</script>
<?php

$requete = "SELECT DATE_FORMAT(date,'%d/%m/%Y')as date, num_bon, tot_htva, tot_tva, num_bon, nom FROM " . $tblpref ."bon_comm RIGHT JOIN " . $tblpref ."client on " . $tblpref ."bon_comm.client_num = num_client WHERE num_bon !=''";
//on verifie le client

if($liste_cli == 'y'){
if($_POST['list_client']=='on')
{
$requete .= " AND num_client='" . $_POST['listeville'] . "'";
}
}else{
if ( isset ( $_POST['listeville'] ) && $_POST['listeville'] != '')
{
$requete .= " AND num_client='" . $_POST['listeville'] . "'";
}
}

//on verifie le numero
if ( isset ( $_POST['numero'] ) && $_POST['numero'] != '')
{
$requete .= " AND num_bon='" . $_POST['numero'] . "'";
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
$requete .= " AND trim(bon_comm.tot_htva)='" . $_POST['montant'] . "'";
}

if ($user_com == 'r') {
$requete .="  and " . $tblpref ."client.permi LIKE '$user_num,' 
		 		or  " . $tblpref ."client.permi LIKE '%,$user_num,' 
					or  " . $tblpref ."client.permi LIKE '%,$user_num,%' 
				 or  " . $tblpref ."client.permi LIKE '$user_num,%' ";
}

$requete .= " ORDER BY $tri";  
//on execute

$req = mysql_query($requete) or die('Erreur SQL !<br>'.$requete.'<br>'.mysql_error());
echo "<center><table>
  <caption>
  $lang_res_rech
  </caption>
"; 
echo "<tr><th>Bon N&deg; <th>Client<th>Date du bon <th>$lang_total_h_tva <th>Total T.V.A <th colspan='3'>action</tr>";
while($data = mysql_fetch_array($req))
    {
		$num_bon = $data['num_bon'];
		$total = $data['tot_htva'];
		$tva = $data['tot_tva'];
		$date = $data['date'];
		$nom = $data['nom'];
?><tr>
<td class='<?php echo couleur_alternee (); ?>'><?php echo $num_bon; ?></td>
<td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo $nom; ?> </td>
<td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo $date; ?> </td>
<td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo montant_financier($total); ?> </td>
<td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo montant_financier($tva); ?> </td>
<td class='<?php echo couleur_alternee (FALSE); ?>'><div align='center'>
		<a href="edit_bon.php?num_bon=<?php echo "$num_bon"; ?> &amp;nom=<?php echo "$nom"; ?>  "><img border="0" alt="editer" src="image/edit.gif"></a></div>
<td class='<?php echo couleur_alternee (FALSE); ?>'><div align='center'><a href=delete_bon_suite.php?num_bon=<?php echo $num_bon; ?> &nom=<?php echo $nom; ?>  onClick='return confirmDelete()'><img border=0 src= image/delete.jpg ></a></div>
<td class='<?php echo couleur_alternee (FALSE); ?>'>
<div align='center'>
<form action="fpdf/bon_pdf.php" method="post" target="_blank" >
<input type="hidden" name="num_bon" value="<?php echo$num_bon; ?>" />
<input type="hidden" name="nom" value="<?php echo $nom; ?>" />
<input type="hidden" name="user" value="adm" />
<input type="image" src="image/printer.gif" style=" border: none; margin: 0;" alt="imprimer" />
</form>
</div></td>
<?php		}
echo "</table><br><hr>";
include("chercher_commande.php");

 ?>