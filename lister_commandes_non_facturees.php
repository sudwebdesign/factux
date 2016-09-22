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
 * File Name: lister_commandes_non_facturees.php
 * 	liste les bons de commande orphelins
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
include_once("include/headers.php");
include_once("include/finhead.php");
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
if ($user_com == n) { 
echo"<h1>$lang_commande_droit";
exit;  
}
?> 
<?php
$mois = date("m");

$sql = "SELECT client_num, num_bon, tot_htva, tot_tva, nom, DATE_FORMAT(date,'%d/%m/%Y') AS date 
FROM " . $tblpref ."bon_comm 
RIGHT JOIN " . $tblpref ."client on " . $tblpref ."bon_comm.client_num = num_client 
WHERE fact='0'";
if ($user_com == r) { 
$sql = "SELECT num_bon, tot_htva, tot_tva, nom, client_num DATE_FORMAT(date,'%d/%m/%Y') AS date 
FROM " . $tblpref ."bon_comm 
RIGHT JOIN " . $tblpref ."client on " . $tblpref ."bon_comm.client_num = num_client 
WHERE fact='0' 
	 and " . $tblpref ."client.permi LIKE '$user_num,' 
	 or  " . $tblpref ."client.permi LIKE '%,$user_num,' 
	 or  " . $tblpref ."client.permi LIKE '%,$user_num,%' 
	 or  " . $tblpref ."client.permi LIKE '$user_num,%'";  
}
if ( isset ( $_GET['ordre'] ) && $_GET['ordre'] != '')
{
$sql .= " ORDER BY " . $_GET[ordre] . " ASC";
}else{
$sql .= "ORDER BY " . $tblpref ."bon_comm.`num_bon` DESC";
}

$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
?>
  <table class="boiteaction">
  <caption><?php echo $lang_commandes_non_facturees; ?></caption>

<tr>
<th><a href="lister_commandes_non_facturees.php?ordre=num_bon"><?php echo $lang_numero; ?></a></th>
<th><a href="lister_commandes_non_facturees.php?ordre=nom"><?php echo $lang_client; ?></a></th>
<th><a href="lister_commandes_non_facturees.php?ordre=date"><?php echo $lang_date; ?></a></th>
<th><a href="lister_commandes_non_facturees.php?ordre=tot_htva"><?php echo $lang_total_h_tva; ?></a> </th>
<th><a href="lister_commandes_non_facturees.php?ordre=tot_tva"><?php echo $lang_tot_tva; ?></a></th>
<th colspan="4"><?php echo $lang_action; ?></th>
</tr>
<?php
$nombre=1;
while($data = mysql_fetch_array($req))
    {
		$num_bon = $data['num_bon'];
		$total = $data['tot_htva'];
		$tva = $data['tot_tva'];
		$date = $data['date'];
		$nom = $data['nom'];
		$nom_html = urlencode($nom);
		$num_client= $data['client_num'];
		$nombre = $nombre +1;
		if($nombre & 1){
		$line="0";
		}else{
		$line="1";
	  }
		?>
		<tr class="texte<?php echo"$line" ?>" onmouseover="this.className='highlight'" onmouseout="this.className='texte<?php echo"$line" ?>'">
  	 		<td class="highlight"><?php echo $num_bon; ?></td>
				<td class="highlight"><?php echo $nom; ?></td>
				<td class="highlight"><?php echo $date; ?></td>
				<td class="highlight"><?php echo montant_financier($total); ?></td>
				<td class="highlight"><?php echo montant_financier($tva); ?></td>
				<td class="highlight">
				<?php echo "<a href=\"edit_bon.php?num_bon=$num_bon&amp;nom=$nom_html\" >" ?>
				<img border=0 alt=editer src=image/edit.gif></a>
				<td class="highlight">
				<?php  echo "<a href=\"delete_bon_suite.php?num_bon=$num_bon&amp;nom=$nom_html\" onClick='return confirmDelete()' ><img border='0' src='image/delete.jpg' alt=\"$lang_effacercer\"></a>&nbsp; "?>
				<td class="highlight">
				<form action="fpdf/bon_pdf.php" method="post" target="_blank" >
				<input type="hidden" name="num_bon" value="<?php echo $num_bon ?>" />
				<input type="hidden" name="nom" value="<?php echo $nom ?>" />	
				<input type="hidden" name="user" value="adm" />
				<input type="image" src="image/printer.gif" style=" border: none; margin: 0;" alt="<?php echo $lang_imprimer; ?>" />
				</form>
				</td>
				<td class="highlight"><a href="fact_bon_orph.php?num=<?php echo"$num_bon"; ?>&amp;client=<?php echo"$num_client"; ?>"><?php echo"Facturer ce bon"; ?></a>
		</tr>
<?php
		 }
?>
  

<tr><td colspan="9" class="submit"></td></tr>
</table>
<tr><td>

<?php
include("help.php");
echo"</td></tr><tr><td>";
include_once("include/bas.php");
?>
</table>
</body>
</html>
