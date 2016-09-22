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
 * File Name: lister_factures_non_reglees.php
 * 	liste les facture non reglées et permet de changer leur status de payement
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
include_once("include/configav.php");
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
if($message!=''){
echo"<table><tr><td>$message</td></tr></table>";
}
if ($user_fact == n) { 
echo "<h1>$lang_facture_droit";
exit;
}
 ?>
<?php
$sql = "SELECT TO_DAYS(NOW()) - TO_DAYS(date_fact) AS peri, client,r1, r2, r3,  date_deb, date_fin,
               total_fact_ttc, num, nom, nom2, DATE_FORMAT(date_fact,'%d/%m/%Y') AS date_fact
               FROM " . $tblpref ."facture 
	        RIGHT JOIN " . $tblpref ."client on " . $tblpref ."facture.client = " . $tblpref ."client.num_client
               WHERE payement = 'non'";
		if ($user_fact == r) { 
$sql = "SELECT TO_DAYS(NOW()) - TO_DAYS(date_fact) AS peri, client,r1, r2, r3,  date_deb, date_fin,
               total_fact_ttc, num, nom, nom2, DATE_FORMAT(date_fact,'%d/%m/%Y') AS date_fact
               FROM " . $tblpref ."facture 
		 RIGHT JOIN " . $tblpref ."client on " . $tblpref ."facture.client = " . $tblpref ."client.num_client
               WHERE payement = 'non' 
		 and " . $tblpref ."client.permi LIKE '$user_num,' 
		 or  " . $tblpref ."client.permi LIKE '%,$user_num,' 
		 or  " . $tblpref ."client.permi LIKE '%,$user_num,%' 
		 or  " . $tblpref ."client.permi LIKE '$user_num,%'";  
}
if ( isset ( $_GET['ordre'] ) && $_GET['ordre'] != '')
{
$sql .= " ORDER BY " . $_GET[ordre] . " ASC";
}else{
$sql .= "ORDER BY num ASC";
}

$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
?>
      <table class="boiteaction">
  <caption><?php echo $lang_factures_non_reglees; ?></caption>
        <tr> 
          <th><a href="lister_factures_non_reglees.php?ordre=num"><?php echo $lang_numero; ?></a></th>
          <th><a href="lister_factures_non_reglees.php?ordre=nom"><?php echo $lang_client; ?></a></th>
          <th><a href="lister_factures_non_reglees.php?ordre=date_fact"><?php echo $lang_date; ?></a></th>
          <th><a href="lister_factures_non_reglees.php?ordre=total_fact_ttc"><?php echo $lang_total_ttc; ?></a></th>
          <th><a href="lister_factures_non_reglees.php?ordre=peri"><?php echo $lang_depuis; ?></a></th>
          <th><?php echo $lang_regler; ?></th>
          <th><?php echo $lang_voir; ?></th>
          <th><a href="lister_factures_non_reglees.php?ordre=r1"><?php echo $lang_rappel; ?> 1</a></th>
          <th><a href="lister_factures_non_reglees.php?ordre=r2"><?php echo $lang_rappel; ?> 2</a></th>
          <th><a href="lister_factures_non_reglees.php?ordre=r3"><?php echo $lang_rappel; ?> 3</a></th>
        </tr>
        <?php
				$nombre =1;
while($data = mysql_fetch_array($req))
{
  $num = $data['num'];
  $total = $data['total_fact_ttc'];
  $nom = $data['nom'];
  $nom2 = $data['nom2'];
  $date = $data['date_fact'];
  $debut = $data['date_deb'];
  $fin = $data['date_fin'];
  $num_client = $data['client'];
  $peri = $data['peri'];
  $r1 = $data['r1'];
  $r2 = $data['r2'];
  $r3 = $data['r3'];
	$nombre = $nombre +1;
		if($nombre & 1){
		$line="0";
		}else{
		$line="1"; 
		}
?>
        <tr class="texte<?php echo"$line" ?>" onmouseover="this.className='highlight'" onmouseout="this.className='texte<?php echo"$line" ?>'">
  	      <td class="highlight"><?php echo $num; ?></td>
          <td class="highlight"><?php echo "$nom $nom2"; ?></td>
          <td class="highlight"><?php echo $date; ?></td>
          <td class="highlight"><?php echo montant_financier($total); ?></td>
          <td class="highlight"><a href='rapel.php?client=<?php echo $num_client; ?>'><?php echo "$peri $lang_jours"; ?></a></td>
          <td class="highlight">
	<?php
	if($use_payement =='y'){ ?>				
					<form action="payement_suite.php" id="payement<?php echo "$num";?>" method="post" name="payement<?php echo "$num";?>">
  <select name="methode" onchange="if(this.value != -1){if(confirm('<?php echo"$lang_conf_carte_reg";?> '+ forms['payement<?php echo "$num";?>'].elements['num'].value +' <?php echo"$lang_par ";?>'+ this.value)){forms['payement<?php echo "$num";?>'].submit();}else{return false}}">
  <option value="-1"><?php echo"$lang_mode_paiement"; ?></option>
  <option value="liquide"><?php echo"$lang_liquide"; ?></option>
  <option value="virement"><?php echo"$lang_virement"; ?></option>
  <option value="paypal"><?php echo"$lang_paypal"; ?></option>
  <option value="carte"><?php echo"$lang_carte_ban"; ?></option>
  <option value="visa"><?php echo"$lang_visa"; ?></option>
  </select>
  <input type="hidden" name="num"  value="<?php echo"$num"; ?>" />
  <input type="submit" name="envoi" style="display: none" />
</form>
					
		<?php 
		}else{	?>		
					<a href='payement_suite.php?num=<?php echo $num; ?>'onClick="return confirmDelete('<?php echo"$lang_regler_fact $num $lang_regler_fact2"; ?>')"> 
            <img border=0 src='image/ok.jpg' alt='regler'></a>
	    <?php
	    } ?>
	    </td>
          
					
					
					<td class="highlight">
					<form action="fpdf/fact_pdf.php" method="post" target="_blank" >
					<input type="hidden" name="client" value="<?php echo $num_client ?>" />
					<input type="hidden" name="debut" value="<?php echo $debut ?>" />
		<input type="hidden" name="fin" value="<?php echo $fin ?>" />
		<input type="hidden" name="num" value="<?php echo $num ?>" />
				<input type="hidden" name="user" value="adm" />
		<input type="image" src="image/printer.gif" style=" border: none; margin: 0;" alt="imprimer" />

</form>
          <td class="highlight"><?php echo $r1; ?></td>
          <td class="highlight"><?php echo $r2; ?></td>
          <td class="highlight"><?php echo $r3; ?></td>
        </tr>
        <?php
		}
$sql = "SELECT SUM(total_fact_ttc) FROM " . $tblpref ."facture RIGHT JOIN " . $tblpref ."client on " . $tblpref ."facture.client = " . $tblpref ."client.num_client
        WHERE payement = 'non'";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql2.'<br>'.mysql_error());
while($data = mysql_fetch_array($req))
		{
		$tot = $data['SUM(total_fact_ttc)'];
		
		?>
        <tr> 
          <td colspan="3" class="totaltexte"><?php echo $lang_factures_non_reglees_total; ?></td>
          <td class="totalmontant"><?php echo montant_financier($tot) ; ?></td>
          <td  class="totaltexte" colspan="6">&nbsp;</td>
        </tr>
        <?php
		}
		$aide = payement;
?>
      

<tr><td colspan="10" class="submit"></td></tr></table>
<tr><td>
<?php
include("help.php");
echo"</td></tr><tr><td>";
include_once("include/bas.php");
?>
</td></tr></table>
</body>
</html>
