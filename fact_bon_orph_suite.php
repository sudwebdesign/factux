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
 * File Name: fact_bon_orph_suite.php
 * 	enregistrement de données de la facture a partir d'un bon orphelin
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
include_once("include/headers.php");
include_once("include/finhead.php");

$date=isset($_POST['date'])?$_POST['date']:"";
$list_num=isset($_POST['bon_sup'])?$_POST['bon_sup']:"";
$acompte=isset($_POST['acompte'])?$_POST['acompte']:"";
$coment=isset($_POST['coment'])?$_POST['coment']:"";
$num=isset($_POST['num'])?$_POST['num']:"";
$client=isset($_POST['client'])?$_POST['client']:"";

$sql = "SELECT MAX(num) As Maxi FROM " . $tblpref ."facture";
$result = mysql_query($sql) or die('Erreur');
$num_fact = mysql_result($result, 'Maxi');
$num_fact = $num_fact + 1 ;
$sql = " SELECT nom, nom2 From " . $tblpref ."client WHERE num_client = $client ";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());


while($data = mysql_fetch_array($req))
    {
		$nom = $data['nom'];
		$nom2 = $data['nom2'];
		}

if($list_num !=''){
$nb_bon=count($list_num);
$list_num[$nb_bon]=$num;
}else{
$list_num=array(0=>$num);
}

$suite_sql="and " . $tblpref ."bon_comm.num_bon ='$list_num[0]'";
for($m=1; $m<count($list_num); $m++){
$suite_sql .= " or " . $tblpref ."bon_comm.num_bon ='$list_num[$m]'";

}
$sql9 = "SELECT date, quanti, article, tot_art_htva, to_tva_art, taux_tva, uni, num_bon 
FROM " . $tblpref ."client 
RIGHT JOIN " . $tblpref ."bon_comm on " . $tblpref ."client.num_client = " . $tblpref ."bon_comm.client_num 
LEFT join " . $tblpref ."cont_bon on " . $tblpref ."bon_comm.num_bon = " . $tblpref ."cont_bon.bon_num  
LEFT JOIN  " . $tblpref ."article on " . $tblpref ."article.num = " . $tblpref ."cont_bon.article_num 
WHERE " . $tblpref ."client.num_client = '".$client."'"; 
$sql9="$sql9 $suite_sql";

$req = mysql_query($sql9) or die('Erreur SQL9 !<br>'.$sql9.'<br>'.mysql_error());

$sql = " SELECT SUM(tot_htva), SUM(tot_tva) 
		FROM " . $tblpref ."bon_comm 
		 WHERE " . $tblpref ."bon_comm.client_num = '".$client."' 
		 ";
$sql="$sql $suite_sql";
  $req2 = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req2);
		$total_htva = $data['SUM(tot_htva)'];
		$total_tva = $data['SUM(tot_tva)'];
		$total_ttc = $total_htva + $total_tva ;
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
echo "<center><br><hr><br><table class='boiteaction'>
  <caption>
  Facture $num_fact créée pour $nom $nom2
  </caption>
"; 

echo "<tr><th>Quanti <th>$lang_unite<th>$lang_article<th>$lang_prix_h_tva<th>$lang_taux_tva<th>$lang_tot_tva<th>$lang_num_bon<th>$lang_date_bon</tr>";
while($data = mysql_fetch_array($req))
    {
		$quanti = $data['quanti'];
		$article = $data['article'];
		$tot_htva = $data['tot_art_htva'];
		$tot_tva = $data['to_tva_art'];
		$taux = $data['taux_tva'];
		$uni = $data['uni'];
		$num_bon = $data['num_bon'];
		$date = $data['date'];
		echo "<tr><td>$quanti<td>$uni<td>$article<td>$tot_htva<td>$taux<td>$tot_tva<td>$num_bon<td>$date</tr>";
		}
		
		echo "<tr><td>";
		?>
		<form action="fpdf/fact_pdf.php" method="post" target="_blank" >
		<input type="hidden" name="client" value="<?php echo $client ?>" />
		<input type="hidden" name="num" value="<?php echo $num_fact ?>" />
		<input type="hidden" name="user" value="adm" />
		<input type="image" src="image/printer.gif" alt="imprimer" />

</form>
		
		<?php  
$rest = $total_htva + $total_tva - $acompte ;
		echo"<td>&nbsp;<td><b>$lang_total</b><td><b>$total_htva $devise htva </b><td><b>$lang_tot_tva</b><td><b> $total_tva  $devise de tva</b><td><b><font color='#ff0000'>$lang_tot_ttc </font></b><td><b><font color='#ff0000'>$total_ttc $devise</font></b></tr>";    
		echo " <tr><td colspan='6'>&nbsp;<td>$lang_acompte<td>$acompte $devise</tr>";
		echo "<tr><td colspan='6'>&nbsp;<td>Reste a payer<td>$rest $devise</tr>
		</table></center><br><hr>";





$list_num=serialize($list_num);

$sql1 = "INSERT INTO " . $tblpref ."facture(acompte, coment, client, date_fact, total_fact_h, total_fact_ttc, list_num)
	 VALUES ('$acompte', '$coment', '$client', '$date', '$total_htva', '$total_ttc', '$list_num')";
mysql_query($sql1) or die('Erreur SQL1 !<br>'.$sql1.'<br>'.mysql_error());
$sql2 = "UPDATE " . $tblpref ."bon_comm SET fact='ok' WHERE " . $tblpref ."bon_comm.client_num = '".$client."'";
$sql2="$sql2 $suite_sql";
mysql_query($sql2) or die('Erreur SQL2 !<br>'.$sql2.'<br>'.mysql_error());
?>
<table><tr><td>
<?php
include_once("include/bas.php");
?> 
</table></table>


