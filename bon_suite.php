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
include_once("include/config/common.php");
include_once("include/config/var.php");
include_once("include/language/$lang.php");
include_once("include/utils.php");
include_once("include/headers.php");
include_once("include/finhead.php");
include_once("include/configav.php");
$quanti=isset($_POST['quanti'])?$_POST['quanti']:"";
$article=isset($_POST['article'])?$_POST['article']:"";
$num=isset($_POST['num'])?$_POST['num']:"";
$lot1=isset($_POST['lot'])?$_POST['lot']:"";
$nom=isset($_POST['nom'])?$_POST['nom']:"";
$remise=isset($_POST['remise'])?$_POST['remise']:"";

?>
<SCRIPT language="JavaScript" type="text/javascript">
		function confirmDelete(num)
		{
		var agree=confirm('<?php echo "$lang_conf_effa"; ?>'+num);
		if (agree)
		 return true ;
		else
		 return false ;
		}
		</script> 
		<?php
if($article=='0' || $quanti=='' )
    {
    $message= "<h1>$lang_champ_oubli </h1>";
    include('form_commande.php'); // On inclus le formulaire d'identification
    exit;
    }
    ?>
<table width="760" border="0" class="page" align="center">
<tr><TD>
<table class='boiteaction'>
<?php
  //touver le dernier enregistrement pour le numero de bon
$sql = "SELECT MAX(num_bon) As Maxi FROM " . $tblpref ."bon_comm";
$result = mysql_query($sql) or die('Erreur');
$max = mysql_result($result, 'Maxi');
//trouver le client correspodant au dernier bon
$sql = "SELECT client_num FROM " . $tblpref ."bon_comm WHERE num_bon = $max";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_array($req))
    {
		$num = $data['client_num'];
		}
//on recupere le prix htva		
$sql2 = "SELECT prix_htva FROM " . $tblpref ."article WHERE num = $article";
$result = mysql_query($sql2) or die('Erreur SQL !<br>'.$sql2.'<br>'.mysql_error());
$prix_article = mysql_result($result, 'prix_htva');
//on recupere le taux de tva
$sql3 = "SELECT taux_tva FROM " . $tblpref ."article WHERE num = $article";
$result = mysql_query($sql3) or die('Erreur SQL !<br>'.$sql3.'<br>'.mysql_error());
$taux_tva = mysql_result($result, 'taux_tva');
//on recupere le coeff de marge
$sql4="select marge FROM " . $tblpref ."article WHERE num = $article";
$result=mysql_query($sql4) or die('Erreur SQL !<br>'.$sql4.'<br>'.mysql_error());
$marge=mysql_result($result, 'marge');

$total_htva = $prix_article * $quanti * $marge * (1-($remise/100)) ;
$mont_tva = $total_htva / 100 * $taux_tva ;
//inserer les données dans la table du conten des bons.
$sql1 = "INSERT INTO " . $tblpref ."cont_bon(p_u_jour, quanti, remise, article_num, bon_num, tot_art_htva, to_tva_art, num_lot) 
VALUES ('$prix_article', '$quanti', '$remise', '$article', '$max', '$total_htva', '$mont_tva', '$lot1')";


mysql_query($sql1) or die('Erreur SQL !<br>'.$sql1.'<br>'.mysql_error());
//ici on decremnte le stock
$sql12 = "UPDATE `" . $tblpref ."article` SET `stock` = (stock - $quanti) WHERE `num` = '$article'";
mysql_query($sql12) or die('Erreur SQL12 !<br>'.$sql12.'<br>'.mysql_error());
 ?>
 <caption><?php echo"$lang_nv_bon"; ?> </caption>
 <tr>
 <th width="21"><?php echo $lang_quantite ;?></th>
  <th width="21"><?php echo $lang_unite ;?></th>
  <th width="21"><?php echo $lang_article ;?></th>
  <th width="21"><?php echo $lang_montant_htva ;?></th>
  <th width="43"><?php echo $lang_remise;?></th>
	<?php 
	if ($lot =='y') {?> 
 		 <th width="33"><?php echo "$lang_lot"; ?></th>
	<?php } ?>
   <th width="29"><? echo $lang_editer ;?></th>
  <th width="20"><? echo $lang_supprimer ;?></th>

 <?php 
//on recherche tout les contenus du bon et on les detaille
$sql = "SELECT " . $tblpref ."cont_bon.num ,num_lot, uni, quanti, remise, article, tot_art_htva FROM " . $tblpref ."cont_bon RIGHT JOIN " . $tblpref ."article on " . $tblpref ."cont_bon.article_num = " . $tblpref ."article.num WHERE  bon_num = $max";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());

while($data = mysql_fetch_array($req))
    {
		$quanti = $data['quanti'];
		$uni = $data['uni'];
		$article = $data['article'];
		$tot = $data['tot_art_htva'];
		$num_cont = $data['num'];//$lang_li_tot2
		$num_lot = $data['num_lot'];
		$remise = $data['remise'];
		$nombre = $nombre +1;
		if($nombre & 1){
		$line="0";
		}else{
		$line="1"; 
		}
		?>		
	<tr class="texte<?php echo"$line" ?>" onmouseover="this.className='highlight'" onmouseout="this.className='texte<?php echo"$line" ?>'">
		<td class ='highlight' width="10%"><?php echo"$quanti";?>
		<td class ='highlight' width="10%"><?php echo"$uni";?>
		<td class ='highlight' width="30%"><?php echo"$article";?>
		<td class ='highlight' width="10%"><?php echo"$tot $devise"; ?>
		<td class ='highlight' width="10%"><?php echo"$remise"; ?>
		<?php
		if ($lot =='y') { ?>
  	<td class ='highlight'><a href=voir_lot.php?num=<?php echo"$num_lot";?> target='_blank'><?php echo"$num_lot";?></a>
	<?php } ?>
		<td class ='highlight'><a href="edit_cont_bon.php?num_cont=<?php echo"$num_cont";?>"><img border="0" alt="editer" src="image/edit.gif"></a>
		<td class ='highlight'><a href="delete_cont_bon.php?num_cont=<?php echo"$num_cont";?>&amp;num_bon=<?php echo"$max"; ?>" onClick='return confirmDelete(<?php echo"$num_cont"; ?>)'><img border="0" src="image/delete.jpg" alt="effacer" ></a>&nbsp;</tr>
		<?php }
//on calcule la somme des contenus du bon
$sql = " SELECT SUM(tot_art_htva) FROM " . $tblpref ."cont_bon WHERE bon_num = $max";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_array($req))
    {
		$total_bon = $data['SUM(tot_art_htva)'];
				}
//on calcule la some de la tva des contenus du bon
$sql = " SELECT SUM(to_tva_art) FROM " . $tblpref ."cont_bon WHERE bon_num = $max";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_array($req))
    {
		$total_tva = $data['SUM(to_tva_art)'];
		}?>
<tr><td class='totalmontant' colspan="3"><?php echo $lang_total_h_tva; ?></td>
<td class='totaltexte'><?php echo "$total_bon $devise"; ?>  </td>
<td class='totaltexte'><?php echo "$total_tva $devise $lang_tva"; ?></td><td colspan='3' class='totalmontant'>
</td></tr></table>
<form name='formu2' method='post' action='bon_suite.php'>
<table class="boiteaction">
  <caption>
  <?php echo "$lang_bon_ajouter $lang_numero $max"; ?> 
  </caption>

 <tr><td class='texte0'><?php echo "$lang_quanti"; ?>
 <td class='texte0'colspan='3'><input name='quanti' type='text' id='quanti' size='6'>
 <tr><td class='texte0'><?php echo "$lang_remise"; ?>
 <td class='texte0'colspan='3'><input name='remise' type='text' id='remise' size='6'>
 <tr><td class='texte0'><?php echo"$lang_article"; ?>
 <?php
include_once("include/configav.php");
				  if ($use_categorie !='y') { 
$rqSql = "SELECT num, article, prix_htva FROM " . $tblpref ."article WHERE actif != 'non' ORDER BY article, prix_htva";
$result = mysql_query( $rqSql )
             or die( "Exécution requête impossible.");
$ld = "<SELECT NAME='article'>";
$ld .= "<OPTION VALUE=0>Choisissez</OPTION>";
while ( $row = mysql_fetch_array( $result)) {
    $num = $row["num"];
    $article = $row["article"];
		$prix = $row["prix_htva"];
    $ld .= "<OPTION VALUE='$num'>$article $prix</OPTION>";
}
$ld .= "</SELECT>";?>
<td class='texte0'>
<?php 

print $ld;
}else{
echo "<td class='texte0'>";
include("include/categorie_choix.php"); 
}
if ($lot =='y') { 
 
  $rqSql = "SELECT num, prod FROM " . $tblpref ."lot WHERE actif != 'non' ORDER BY num";
			$result = mysql_query( $rqSql )
             or die( "Exécution requête impossible.");?>
<td class="texte0">Lot</td>
<td class="texte0"><SELECT NAME='lot'>
					<OPTION VALUE=0><?php echo $lang_choisissez; ?></OPTION>
            <?php
						while ( $row = mysql_fetch_array( $result)) {
    							$num = $row["num"];
    							$prod = $row["prod"];
		    ?>
            <OPTION VALUE='<?php echo $num; ?>'><?php echo "$num $prod "; ?></OPTION>
						
					<?php 
}
 ?> </SELECT></td> 
<?php  
}
?>


    <tr><td class="submit" colspan="4"><input name="nom" type="hidden" id="nom" value="<?php echo $nom ?>"><input type="submit" name="Submit" value=<?php echo $lang_ajou_bon ?>></td></tr>
    </table></form>
    <tr><td>
		
<form action="bon_fin.php" method="post" name="fin_bon">
 
<center><table class="boiteaction">
  <caption>
  <?php echo "$lang_bon_enregistrer "; ?> 
  </caption>
  <tr>
  <td class="submit" >
	<?php echo $lang_ajo_com_bo ?><tr>
<td class="submit" colspan="2"><textarea name="coment" cols="45" rows="3"></textarea>
<input type="hidden" name="tot_ht" value=<?php echo $total_bon ?>>
<input type="hidden" name="tot_tva" value=<?php echo $total_tva ?>>
<input type="hidden" name="bon_num" value=<?php echo $max ?>>
<tr>
<td colspan="2" class="submit">
	<center><input type="submit" name="Submit" value="<?php echo "$lang_ter_enr"; ?>">
	</center>
    
</table></center></form></td><tr><td>
<?php 
include("include/bas.php");
 ?>
 </td></tr></table>