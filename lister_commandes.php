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
 * File Name: lister_commandes.php
 * 	liste les commandes et permet de multiples actions
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


<table width="760"  class="page" align="center">
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
//pour le formulaire
?>
      <?php 
$mois_1=isset($_POST['mois_1'])?$_POST['mois_1']:"";
$annee_1=isset($_POST['annee_1'])?$_POST['annee_1']:"";

if ($mois_1=='') {
 $mois_1= $mois ;
} 
if ($annee_1=='') { 
 $annee_1= $annee ; 
}

$calendrier = calendrier_local_mois ();
$sql = "SELECT mail, login, num_client, num_bon, tot_htva, tot_tva, nom,
 DATE_FORMAT(date,'%d/%m/%Y') AS date,(tot_htva + tot_tva) as ttc
		 FROM " . $tblpref ."bon_comm 
		 RIGHT JOIN " . $tblpref ."client on " . $tblpref ."bon_comm.client_num = num_client 
		 WHERE MONTH(date) = $mois_1 AND Year(date)=$annee_1 
		 ";
		 //ORDER BY " . $tblpref ."bon_comm.`num_bon` DESC
		 
if ($user_com == r) { 
$sql = "SELECT mail, login, num_client, num_bon, tot_htva, tot_tva, nom,
 DATE_FORMAT(date,'%d/%m/%Y') AS date, (tot_htva + tot_tva) as ttc 
		 FROM " . $tblpref ."bon_comm 
		 RIGHT JOIN " . $tblpref ."client on " . $tblpref ."bon_comm.client_num = num_client
		 WHERE MONTH(date) = $mois_1 AND Year(date)=$annee_1 
		 and " . $tblpref ."client.permi LIKE '$user_num,' 
		 or  " . $tblpref ."client.permi LIKE '%,$user_num,' 
		 or  " . $tblpref ."client.permi LIKE '%,$user_num,%' 
		 or  " . $tblpref ."client.permi LIKE '$user_num,%' 
		 ";
		 //ORDER BY " . $tblpref ."bon_comm.`num_bon` DESC  
}
if ( isset ( $_GET['ordre'] ) && $_GET['ordre'] != '')
{
$sql .= " ORDER BY " . $_GET[ordre] . " DESC";
}else{
$sql .= "ORDER BY num_bon DESC ";
}
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql2.'<br>'.mysql_error());

?>
     <center><form action="lister_commandes.php" method="post">
        <table >
  <caption><?php echo $lang_commandes_lister; ?></caption>

          <tr>
		  <td  class="texte0">&nbsp;</td>
            <td  class="texte0"> <select name="mois_1">
			<?php for ($i=1;$i<=12;$i++)
			{
			?>
                <option value="<?php echo $i; ?>"><?php echo ucfirst($calendrier [$i]); ?></option>
				<?php
				}
				?>
              </select> </td><td width="27%" class="texte0">
			  <select name="annee_1">
				<option value="2005"><?php $date=date("Y");echo"$date"; ?></option>
                <option value="2004"><?php $date=(date("Y")-1);echo"$date"; ?></option>
                <option value="2006"><?php $date=(date("Y")+1);echo"$date"; ?></option>
              </select> </td>
			  <td width="29%"  class="texte0">&nbsp;</td>
          </tr>
<tr><td class="submit" colspan="4"><input type="submit" value='<?php echo $lang_envoyer; ?>'></td></tr>        
       </table></form> </center>
		<br>
        <center><table class="boiteaction">
  <caption><?php echo "$lang_commandes_liste de $mois_1 $annee_1"; ?></caption>
          <tr> 
            <th><a href="lister_commandes.php?ordre=num_bon"><?php echo $lang_numero; ?></a></th>
            <th><a href="lister_commandes.php?ordre=nom"><?php echo $lang_client; ?></a></th>
            <th><a href="lister_commandes.php?ordre=date"><?php echo $lang_date; ?></a></th>
            <th><a href="lister_commandes.php?ordre=tot_htva"><?php echo $lang_total_h_tva; ?></a></th>
            <th><a href="lister_commandes.php?ordre=ttc"><?php echo $lang_total_ttc; ?></a></th>
            <th colspan="5"><?php echo $lang_action; ?></th>
          </tr>
          <?php
	$nombre = 1;
while($data = mysql_fetch_array($req))
{
  $num_bon = $data['num_bon'];
  $total = $data['tot_htva'];
  $tva = $data["tot_tva"];
  $date = $data["date"];
  $nom = $data['nom'];
	$nom = htmlentities($nom, ENT_QUOTES);
  $nom_html = htmlentities (urlencode ($nom)); 
  $num_client = $data['num_client'];
  $mail = $data['mail'];
  $login = $data['login'];
  $ttc = $data['ttc'];
  $nombre = $nombre +1;
	if($nombre & 1){
	$line="0";
	}else{
	$line="1"; 
	}
  ?>
          <tr class="texte<?php echo"$line" ?>" onmouseover="this.className='highlight'" onmouseout="this.className='texte<?php echo"$line" ?>'">
  	   <td class="highlight"><?php echo "$num_bon"; ?></td>
           <td class="highlight"><?php echo "$nom"; ?></td>
           <td class="highlight"><?php echo "$date"; ?></td>
           <td class="highlight"><?php echo montant_financier($total); ?></td>
           <td class="highlight"><?php echo montant_financier($ttc); ?></td>
           <td class="highlight">
			<a href='edit_bon.php?num_bon=<?php echo "$num_bon"; ?>&amp;nom=<?php echo "$nom_html"; ?>' > 
              <img border="0" alt="editer" src="image/edit.gif"></a> &nbsp;
	   <td class="highlight">
			  <a href='delete_bon_suite.php?num_bon=<?php echo $num_bon; ?>&amp;nom=<?php echo "$nom_html"; ?>' 
			  onClick="return confirmDelete('<?php echo"$lang_con_effa $num_bon"; ?>')">
              		  <img border="0" src="image/delete.jpg" alt="delete" ></a>
<td class="highlight">
<form action="fpdf/bon_pdf.php" method="post" target="_blank" >
<input type="hidden" name="num_bon" value="<?php echo "$num_bon"; ?>" />
<input type="hidden" name="nom" value="<?php echo "$nom_html"; ?>" />
<input type="hidden" name="user" VALUE="adm">
<input type="image" src="image/printer.gif" alt="imprimer" />
</form>

<?php if ($mail != '' and $login !='') { ?>
<td class="highlight">
<a href='notifi_cli.php?type=comm&amp;mail=<?php echo"$mail"; ?>'><img src='image/mail.gif' border='0' alt='mail' onClick="return confirmDelete('<?php echo"$lang_con_env_notif $num_bon"; ?>')" ></a>
<?php
} else{?>
<td class="highlight">
<?php }
if ($mail != '' ) {
?>
<td class="highlight">
		 <form action="fpdf/bon_pdf.php" method="post" onClick="return confirmDelete('<?php echo"$lang_con_env_pdf $num_bon"; ?>')">
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
<td class="highlight">
<?php 
}
 ?>  
</td>
</tr>
<?php } ?> 
   
   <tr><td colspan="10" class="submit"></td></tr>
</table>
<?php
include("help.php");
include_once("include/bas.php");
$url = $_SERVER['PHP_SELF'];
$file = basename ($url); 
?>

</center></table>

<?php 

if ($file=="form_commande.php" or $file=="login.php") { 
echo"</table>"; 
}
 ?> 
<?php 
include_once("include/footers.php");
 ?> 
