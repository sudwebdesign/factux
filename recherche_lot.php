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
 * File Name: recherche_lot.php
 * 	resultat d'une recherche de lot
 * 
 * * * Version:  1.1.5
 * * * * Modified: 23/07/2005
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */

 $num_lot=isset($_POST['num_lot'])?$_POST['num_lot']:"";
 if($num_lot==''){
 $num_lot=isset($_GET['num_lot'])?$_GET['num_lot']:"";
 }
 require_once("include/verif.php");
include_once("include/config/common.php");
include_once("include/config/var.php");
include_once("include/language/$lang.php");
include_once("include/utils.php");
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
if ($user_com == n) { 
echo"<h1>$lang_commande_droit";
exit;  
}
 ?> 
<?php 
$mois = date("m");
$annee = date("Y");
$sql = "SELECT  num_bon, mail, login, num_client, num_bon, tot_htva, tot_tva, nom, DATE_FORMAT(date,'%d/%m/%Y') AS date 
		 FROM " . $tblpref ."bon_comm 
		 RIGHT JOIN " . $tblpref ."cont_bon on " . $tblpref ."bon_comm.num_bon = " . $tblpref ."cont_bon.bon_num
		 LEFT JOIN " . $tblpref ."client on " . $tblpref ."bon_comm.client_num = num_client  
		 WHERE `num_lot` = $num_lot
		 ORDER BY " . $tblpref ."bon_comm.`num_bon` DESC";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());

?>
 <br>
        <center><table class="boiteaction">
  <caption><?php echo "$lang_com_cont_lot $num_lot"; ?></caption>
          <tr> 
            <th><?php echo $lang_numero; ?></th>
            <th><?php echo $lang_client; ?></th>
            <th><?php echo $lang_date; ?></th>
            <th><?php echo $lang_total_h_tva; ?></th>
            <th><?php echo $lang_total_ttc; ?></th>
            <th colspan="5"><?php echo $lang_action; ?></th>
          </tr>
          <?php
while($data = mysql_fetch_array($req))
{
  $num_bon = $data['num_bon'];
  $total = $data['tot_htva'];
  $tva = $data["tot_tva"];
  $date = $data["date"];
  $nom = $data['nom'];
	$num_client = $data['num_client'];
	$mail = $data['mail'];
	$login = $data['login'];
  $ttc = $total + $tva ;
  ?>
          <tr> 
            <td  class='<?php echo couleur_alternee (); ?>'><?php echo $num_bon; ?></td>
            <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo $nom; ?></td>
            <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo $date; ?></td>
            <td class='<?php echo couleur_alternee (FALSE, "nombre"); ?>'><?php echo montant_financier($total); ?></td>
            <td class='<?php echo couleur_alternee (FALSE,"nombre"); ?>'><?php echo montant_financier($ttc); ?></td>
            <td  class='<?php echo couleur_alternee (FALSE); ?>'>
			<a href='edit_bon.php?num_bon=<?php echo $num_bon; ?>&nom=<?php echo $nom; ?>' > 
              <img border=0 alt=editer src=image/edit.gif></a> &nbsp;
<td  class='<?php echo couleur_alternee (FALSE); ?>'>
		 		
			  <a href=delete_bon_suite.php?num_bon=<?php echo $num_bon; ?>&nom=<?php echo $nom; ?> onClick='return confirmDelete()'>
              <img border=0 src= image/delete.jpg ></a>
<td  class='<?php echo couleur_alternee (FALSE); ?>'>
<form action="fpdf/bon_pdf.php" method="post" target="_blank" >
<input type="hidden" name="num_bon" value="<?php echo $num_bon; ?>" />
<input type="hidden" name="nom" value="<?php echo $nom; ?>" />
<input type="hidden" name="user" VALUE="adm">

<input type="image" src="image/printer.gif" alt="imprimer" />
</form>

							<?php if ($mail != '' and $login !='') { ?>
<td  class='<?php echo couleur_alternee (FALSE); ?>'>
<?php echo "<a href='notifi_cli.php?type=comm&mail=$mail'><img src= image/mail.gif border='0' ></a>";
} else{?>
<td  class='<?php echo couleur_alternee (FALSE); ?>'>
<?php }
if ($mail != '' ) {
?>
<td  class='<?php echo couleur_alternee (FALSE); ?>'>
		 <form action="fpdf/bon_pdf.php" method="post" >
<input type="hidden" name="num_bon" value="<?php echo $num_bon; ?>" />
<input type="hidden" name="nom" value="<?php echo $nom; ?>" />
<input type="hidden" name="user" VALUE="adm">
<input type="hidden" name="ext" VALUE=".pdf">
 <input type="hidden" name="mail" VALUE="y">
<input type="image" src="image/pdf.gif" alt="mail" />
</form>	
<?php 
}else{
 ?>  
<td  class='<?php echo couleur_alternee (FALSE); ?>'>
<?php 
}
 ?>  
</td>
</tr>
<?php } ?> 
</table>
   </td></tr>
</table>
<?php
include("help.php");
include_once("include/bas.php");
?>
</body>
</html>
