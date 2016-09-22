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
 * File Name: lister_factures.php
 * 	
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
if ($user_fact == n) { 
echo "<h1>$lang_facture_droit";
exit;
}
 ?>
<?php 
$sql = "SELECT mail, login, DATE_FORMAT(date_fact,'%d/%m/%Y') AS date_fact,
               total_fact_ttc, payement, num_client, date_deb, 
			   DATE_FORMAT(date_deb,'%d/%m/%Y') AS date_deb2, date_fin,
			   DATE_FORMAT(date_fin,'%d/%m/%Y') AS date_fin2, num, nom
	    FROM " . $tblpref ."facture RIGHT JOIN " . $tblpref ."client on client = num_client
        WHERE num >0 ";
				//ORDER BY 'num' DESC
				if ($user_fact == r) { 
$sql = "SELECT mail, login, DATE_FORMAT(date_fact,'%d/%m/%Y') AS date_fact,
               total_fact_ttc, payement, num_client, date_deb, 
			   DATE_FORMAT(date_deb,'%d/%m/%Y') AS date_deb2, date_fin,
			   DATE_FORMAT(date_fin,'%d/%m/%Y') AS date_fin2, num, nom
	    FROM " . $tblpref ."facture RIGHT JOIN " . $tblpref ."client on client = num_client
        WHERE num >0 
	 and " . $tblpref ."client.permi LIKE '$user_num,' 
	 or  " . $tblpref ."client.permi LIKE '%,$user_num,' 
	 or  " . $tblpref ."client.permi LIKE '%,$user_num,%' 
	 or  " . $tblpref ."client.permi LIKE '$user_num,%' 
	";  
	//ORDER BY 'num' DESC
}
if ( isset ( $_GET['ordre'] ) && $_GET['ordre'] != '')
{
$sql .= " ORDER BY " . $_GET[ordre] . " DESC";
}else{
$sql .= "ORDER BY num DESC ";
}
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
?>
<center><table class="boiteaction">
  <caption><?php echo $lang_tou_fact; ?></caption>
  <tr> 
    <th><a href="lister_factures.php?ordre=num"><?php echo $lang_numero; ?></a></th>
    <th><a href="lister_factures.php?ordre=nom"><?php echo $lang_client; ?></a></th>
    <th><a href="lister_factures.php?ordre=total_fact_ttc"><?php echo $lang_tot_ttc; ?></a></th>
    <th><a href="lister_factures.php?ordre=date_fact"><?php echo $lang_date; ?></a></th>
		<th><a href="lister_factures.php?ordre=payement"><?php echo $lang_pay; ?></a></th>
    <th colspan="4"><?php echo $lang_action; ?></th>
  </tr>
  <?php
	$nombre=1;
while($data = mysql_fetch_array($req))
{
  $client = $data['nom'];
	$client = htmlentities($client, ENT_QUOTES);
  $debut = $data['date_deb2'];
  $debut2 = $data['date_deb'];
  $fin = $data['date_fin2'];
  $fin2 = $data['date_fin'];
  $pay = $data['payement'];
	$nombre = $nombre +1;
		if($nombre & 1){
		$line="0";
		}else{
		$line="1";
 		}
	switch ($pay) {
	case carte:
   $payement="$lang_carte_ban";
   break;
	case "liquide":
   $payement="$lang_liquide";
   break;
	case "ok":
   $payement="$lang_pay_ok";
   break;
	case "paypal":
   $payement="$lang_paypal";
   break;
	case "virement":
   $payement="$lang_virement";
   break;
	case "visa":
   $payement="$lang_visa";
   break;
	case "non":
   $payement="<font color=red>$lang_non_pay</font>";
   break;
	 }
  $num = $data['num'];
  $num_client =$data['num_client'];
  $total = $data['total_fact_ttc'];
  $date_fact = $data['date_fact'];
	$mail = $data['mail'];
	$login = $data['login'];
  ?>
  <tr class="texte<?php echo"$line" ?>" onmouseover="this.className='highlight'" onmouseout="this.className='texte<?php echo"$line" ?>'">
  	<td class="highlight"><?php echo $num; ?></td>
    <td class="highlight"><?php echo $client; ?></td>
    <td class="highlight"><?php echo montant_financier($total); ?></td>
    <td class="highlight"><?php echo $date_fact; ?></td>
		<td class="highlight"><?php echo $payement; ?></td> 
		<td class="highlight"><a href="edit_fact.php?num_fact=<?php echo"$num"; ?>"><img src="image/edit.gif" border="0" alt="editer"></a>
    <td class="highlight">
		<form action="fpdf/fact_pdf.php" method="post" target="_blank">
		<input type="hidden" name="client" value="<?php echo $num_client ?>" />
		<input type="hidden" name="debut" value="<?php echo $debut2 ?>" />
		<input type="hidden" name="fin" value="<?php echo $fin2 ?>" />
		<input type="hidden" name="num" value="<?php echo $num ?>" />
		<input type="hidden" name="user" value="adm" />
		<input type="image" src="image/printer.gif" style=" border: none; margin: 0;"alt="imprimer" />

</form>
		
			<?php if ($mail != '' and $login != '') {?>
<td class="highlight">
 
<a href='notifi_cli.php?type=fact&amp;mail=<?php echo"$mail"; ?>'><img src='image/mail.gif' alt='mail' border='0' onClick="return confirmDelete('<?php echo"$lang_conf_notif $client $lang_conf_notif2 $num ?"; ?>')"></a>
<?php 
}else {?>
<td class="highlight">
<?php }
 
if ($mail != '') {
?>
 <td class="highlight">
 <form action="fpdf/fact_pdf.php" method="post" onClick="return confirmDelete('<?php echo"$lang_conf_env $num $lang_conf_env2 $client ?"; ?>')">
		<input type="hidden" name="client" value="<?php echo $num_client ?>" />
		<input type="hidden" name="debut" value="<?php echo $debut2 ?>" />
		<input type="hidden" name="fin" value="<?php echo $fin2 ?>" />
		<input type="hidden" name="num" value="<?php echo $num ?>" />	
		<input type="hidden" name="user" value="adm" />
		<input type="hidden" name="mail" value="y" />
		<input type="image" src="image/pdf.gif" style=" border: none; margin: 0;" alt="envoyer par mail" />
		</form>
  </td>
  </tr>
  <?php
	}else{
?>
<td class="highlight">
<?php
}
}
?>
 
</td></tr>
<tr><TD colspan="11" class="submit"></TD></tr></table></center>
<tr><td>
<?php
$aide="factures";
include("help.php");
echo"</td></tr><tr><td>";
include_once("include/bas.php");
?>
</td></tr>
</table>
</body>
</html>
