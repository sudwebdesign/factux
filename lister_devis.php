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
 * File Name: lister_devis.php
 * 	Liste les devis et permet de multiples actions
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
if ($message !='') { 
 echo"<table><tr><td>$message</td></tr></table>"; 
}
if ($user_dev == n) {
echo "<h1>$lang_devis_droit";
exit;  
}
 ?>
<?php
$sql = "SELECT login, mail, num_dev, tot_htva, tot_tva, DATE_FORMAT(date,'%d/%m/%Y') AS date, nom
       FROM " . $tblpref ."devis RIGHT JOIN " . $tblpref ."client on " . $tblpref ."devis.client_num = num_client
	   WHERE num_dev >0 AND  resu = '0'
		 ";
		 if ($user_dev == r) { 
$sql = "SELECT login, mail, num_dev, tot_htva, tot_tva, DATE_FORMAT(date,'%d/%m/%Y') AS date, nom
       FROM " . $tblpref ."devis RIGHT JOIN " . $tblpref ."client on " . $tblpref ."devis.client_num = num_client
	   WHERE num_dev >0 AND  resu = '0' 
	 and " . $tblpref ."client.permi LIKE '$user_num,' 
	 or  " . $tblpref ."client.permi LIKE '%,$user_num,' 
	 or  " . $tblpref ."client.permi LIKE '%,$user_num,%' 
	 or  " . $tblpref ."client.permi LIKE '$user_num,%' 
	";
};
if ( isset ( $_GET['ordre'] ) && $_GET['ordre'] != '')
{
$sql .= " ORDER BY " . $_GET[ordre] . " DESC";
}else{
$sql .= "ORDER BY num_dev DESC ";
}
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
?>
<center><table class="boiteaction">
  <caption><?php echo $lang_devis_liste; ?></caption>
  <tr>
    <th><a href="lister_devis.php?ordre=num_dev"><?php echo $lang_num_dev; ?></a> </th>
    <th><a href="lister_devis.php?ordre=nom"><?php echo $lang_client; ?></a> </th>
    <th><a href="lister_devis.php?ordre=date"><?php echo $lang_date; ?></a> </th>
    <th><a href="lister_devis.php?ordre=tot_htva"><?php echo $lang_total_h_tva; ?></a> </th>
    <th><a href="lister_devis.php?ordre=tot_tva"><?php echo $lang_total_ttc; ?></a> </th>
    <th colspan="5"><?php echo $lang_action; ?> </th>
    <th colspan="2"><?php echo $lang_gagne_perdu; ?> </th>
	</tr>
  <?
	$nombre =1;
while($data = mysql_fetch_array($req))
    {
		$num_dev = $data['num_dev'];
		$total = $data['tot_htva'];
		$tva = $data['tot_tva'];
		$date = $data['date'];
		$nom = $data['nom'];
		$nom_html =urlencode($nom);
		$login = $data['login'];
		$mail = $data['mail'];
		$ttc = $total + $tva ; 
		$nom = htmlentities($data['nom'], ENT_QUOTES);
		$nombre = $nombre +1;
		if($nombre & 1){
		$line="0";
		}else{
		$line="1";
		}
		?>
  <tr class="texte<?php echo"$line" ?>" onmouseover="this.className='highlight'" onmouseout="this.className='texte<?php echo"$line" ?>'">
  	
    <td class="highlight"><?php echo $num_dev; ?></td>
    <td class="highlight"><?php echo $nom; ?></td>
    <td class="highlight"><?php echo$date; ?></td>
    <td class="highlight"><?php echo montant_financier ($total); ?></td>
    <td class="highlight"><?php echo montant_financier ($ttc); ?></td>
    <td class="highlight">
					 <a href="edit_devis.php?num_dev=<?php echo $num_dev; ?>&amp;nom=<?php echo $nom_html; ?>"> 
					 <img src="image/edit.gif" align="middle" border="0"alt="<?php echo $lang_editer; ?>"></a></td>
		<td class="highlight"><a href="delete_dev_suite.php?num_dev=<?php echo $num_dev; ?>&amp;nom=<?php echo $nom_html; ?>" onClick="return confirmDelete('<?php echo"$lang_eff_dev $num_dev ?"; ?>')">
				<img src="image/delete.jpg" align="middle" border="0" alt="<?php echo $lang_supprimer; ?>"></a></td>
		<td class="highlight"> 
				<a href="fpdf/devis_pdf.php?num_dev=<?php echo $num_dev; ?>&amp;nom=<?php echo $nom_html; ?>&amp;pdf_user=adm" target="_blank">
				<img src="image/printer.gif" alt="<?php echo $lang_imprimer; ?>" align="middle" border="0" ></a></td>
	<?php 
if ($mail != '' and $login != '') { ?>
	 <td class="highlight"> 
	 		 <a href="notifi_cli.php?type=devis&amp;mail=<?php echo $mail; ?>">
			 <img src="image/mail.gif" align="middle" alt="mail" border="0"/></a>
<?php 
}else {?>
	 <td class="highlight">&nbsp;</td>
<?php
}
if($mail != ''){ ?>
	<td class="highlight">
			<a href="fpdf/devis_pdf.php?num_dev=<?php echo $num_dev; ?>&amp;nom=<?php echo $nom; ?>&amp;action=mail&amp;pdf_user=adm" >
			<img src="image/pdf.gif" alt="<?php echo $lang_imprimer; ?>" align="middle" border="0" ></a></td>	 
<?php
}else{?>
	<td class="highlight">&nbsp;</td>
<?php
}
 ?> 
 <td class="highlight">
 		 <a href="convert.php?num_dev=<?php echo $num_dev; ?>"
		 onClick="return confirmDelete('<?php echo"$lang_convert_dev $num_dev $lang_convert_dev2 "; ?>')"
		 <img src="image/icon_lol.gif" alt="<?php echo $lang_devis_gagner; ?>" align="middle" border="0" ></a></td>
 <td class="highlight">
			<a href="devis_non_commandes.php?num_dev=<?php echo $num_dev; ?>"
			onClick="return confirmDelete('<?php echo"$lang_dev_perd $num_dev $lang_dev_perd2 "; ?>')"
			<img src="image/icon_cry.gif"alt="<?php echo $lang_devis_perdre; ?>"align="middle" border="0" ></a></td>
<?php
		}
 ?>
  </tr><tr>
	<TD colspan="12" class="submit"></TD></tr>
			</table></center><tr><td>
<?php
include("help.php");
echo"</td></tr><tr><td>";
include_once("include/bas.php");
?>
</td></tr>
<?php
$url = $_SERVER['PHP_SELF'];
$file = basename ($url); 


if ($file=="form_devis.php") { 
echo"</table>";  
}
?>
</table>
</body>
</html>
