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
 * File Name: edit_fact.php
 * 	Permet l'edition des factures.
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
$num_fact=isset($_GET['num_fact'])?$_GET['num_fact']:"";
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
if ($user_fact == n) { 
echo "<h1>$lang_facture_droit";
exit;
}
$sql = "SELECT list_num,CLIENT  
			  FROM " . $tblpref ."facture 
        WHERE num = $num_fact";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
$list_num = unserialize($data['list_num']);
$num_client= $data['CLIENT'];

 ?> 	
<center><table class="boiteaction">
  <caption><?php echo "Editer la facure n° $num_fact"; ?></caption>
   	<tr><th>NumBon</th>
		<th>Date</th>
		<th>Montant TTC</th>
	<th>voir</th>
	<th>suprimer</th> 
	
	<?php
	foreach ($list_num as $num_bon) {
	$sql="SELECT DATE_FORMAT(date,'%d/%m/%Y') AS date, tot_htva, tot_tva from " . $tblpref ."bon_comm WHERE num_bon = '$num_bon'";
	$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
	$data = mysql_fetch_array($req);
	$date = $data['date'];
	$tot_htva =$data['tot_htva'];
	$tot_tva =$data['tot_tva'];
	$ttc =($tot_htva + $tot_tva);
	?>
	<tr>
	<td class='<?php echo couleur_alternee (); ?>'><?php echo"$num_bon";?></td>
	<td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo"$date" ?></td>
	<td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo"$ttc $devise" ?></td>
	<td class='<?php echo couleur_alternee (FALSE); ?>'><FORM action="fpdf/bon_pdf.php" method="POST" enctype="multipart/form-data" target="_blank">
           <input type="hidden" name="num_bon" value="<?php echo $num_bon; ?>" />
	   <input type="hidden" name="user" VALUE="adm">
	   <input type="image" src="image/printer.gif" alt="imprimer" />
         </FORM></td>
	 <td class='<?php echo couleur_alternee (FALSE); ?>'><FORM action="suite_edit_fact.php" method="POST" onClick='return confirmDelete()' enctype="multipart/form-data">
        <INPUT type="hidden" name="retirer" value="<?php echo"$num_bon"; ?>" >
				<INPUT type="hidden" name="num_fact" value="<?php echo"$num_fact"; ?>" >
				
	<INPUT type="submit" value="retirer">
	
      </FORM></td></tr>
       <?php
     } 
     echo"</table></center>";
     $sql = "SELECT num_bon, tot_htva, tot_tva, nom, DATE_FORMAT(date,'%d/%m/%Y') AS date 
FROM " . $tblpref ."bon_comm 
RIGHT JOIN " . $tblpref ."client on " . $tblpref ."bon_comm.client_num = num_client 
WHERE fact='0' AND client_num = '$num_client'
ORDER BY " . $tblpref ."bon_comm.`num_bon` DESC";
?>
<center><table class="boiteaction">
  <caption><?php echo "ajouter à la facure n° $num_fact"; ?></caption>
  	<tr><th>NumBon</th>
		<th>date</th>
		<th>Montant ttc</th>
	<th>voir</th>
	<th>Ajouter</th>
<?php
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());

while($data = mysql_fetch_array($req))
    {
$aj_num_bon = $data['num_bon'];
$date =$data['date'];
$tot_htva =$data['tot_htva'];
$tot_tva =$data['tot_tva'];
$ttc =($tot_htva + $tot_tva);
?>
<tr>
	<TD class='<?php echo couleur_alternee (); ?>'><?php echo"$aj_num_bon"; ?></TD>
	<td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo"$date "; ?></td>
	<td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo"$ttc $devise"; ?></td>
	<td class='<?php echo couleur_alternee (FALSE); ?>'><FORM action="fpdf/bon_pdf.php" method="POST" enctype="multipart/form-data" target="_blank">
           <input type="hidden" name="num_bon" value="<?php echo $aj_num_bon; ?>" />
	   <input type="hidden" name="user" VALUE="adm">
	   <input type="image" src="image/printer.gif" alt="imprimer" />
         </FORM></td>
	 <td class='<?php echo couleur_alternee (FALSE); ?>'><FORM action="suite_edit_fact.php" method="POST" onClick='return confirmDelete2()' enctype="multipart/form-data">
        <INPUT type="hidden" name="ajouter" value="<?php echo"$aj_num_bon"; ?>" onselect="submit">
				<INPUT type="hidden" name="num_fact" value="<?php echo"$num_fact"; ?>" >
	<INPUT type="submit" value="ajouter">
      </FORM></td>
</tr>
<?php
}
     ?>
     <tr><TD class="submit" colspan="5">&nbsp;</TD></tr></table></center>
     <TR><td>
     <?php
     include("include/bas.php");
     ?>
     </TD></tr></table></html>
