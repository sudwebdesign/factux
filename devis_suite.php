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
include_once("include/verif.php");
include_once("include/config/common.php");
include_once("include/config/var.php");
include_once("include/language/$lang.php");
include_once("include/utils.php");
include_once("include/headers.php");
include_once("include/finhead.php");
$quanti=isset($_POST['quanti'])?$_POST['quanti']:"";
$article=isset($_POST['article'])?$_POST['article']:"";
$remise=isset($_POST['remise'])?$_POST['remise']:"";
$num=isset($_POST['num'])?$_POST['num']:"";
$nom=isset($_POST['nom'])?$_POST['nom']:"";
?>
<SCRIPT language="JavaScript" type="text/javascript">
		function confirmDelete()
		{
		var agree=confirm('<?php echo "$lang_conf_effa"; ?>');
		if (agree)
		 return true ;
		else
		 return false ;
		}
		</script> 
		<?php
if($article=='0' || $quanti=='')
    {
    echo "<p><center><h1>$lang_champ_oubli</p>";
    include('form_devis.php'); 
    exit;
    }
echo '<table width="760" border="0" class="page" align="center"><td>';
echo "<center><table class='boiteaction'>
  <caption>
  <center>$lang_nv_devis
  </caption>
";?>
<th><? echo $lang_quantite ;?></th>
  <th><? echo $lang_unite ;?></th>
  <th><? echo $lang_article ;?></th>
  <th><? echo $lang_montant_htva ;?></th>
  <th><?php echo $lang_remise;?></th>
  <th><? echo $lang_editer ;?></th>
  <th><? echo $lang_supprimer ;?></th></tr>
<?php 
//touver le dernier enregistrement pour le numero de bon
$sql = "SELECT MAX(num_dev) As Maxi FROM " . $tblpref ."devis";
$result = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$max = mysql_result($result, 'Maxi');
//trouver le client correspodant au dernier bon
$sql = "SELECT client_num FROM " . $tblpref ."devis WHERE num_dev = $max";
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
//on recupere le coeff  de marge
$sql4 = "select marge from " . $tblpref ."article WHERE num = $article";
$result = mysql_query($sql4) or die('Erreur SQL !<br>'.$sql4.'<br>'.mysql_error());
$marge = mysql_result($result, 'marge');

//calcul du prix remisé
$prix_article=$prix_article*(1-($remise/100))*$marge;
$total_htva = $prix_article * $quanti ;
$mont_tva = $total_htva / 100 * $taux_tva ;
//inserer les données dans la table du conten des bons.
mysql_select_db($db) or die ("Could not select $db database");
$sql1 = "INSERT INTO " . $tblpref ."cont_dev(p_u_jour, quanti, remise, article_num, dev_num, tot_art_htva, to_tva_art) VALUES ('$prix_article', '$quanti', '$remise', '$article', '$max', '$total_htva', '$mont_tva')";
mysql_query($sql1) or die('Erreur SQL !<br>'.$sql1.'<br>'.mysql_error());
 ?> 
 <?php 
//echo "$lang_devis_compr <br>";
//on recherche tout les contenus du bon et on les detaille
$sql2 = "SELECT " . $tblpref ."cont_dev.num, uni, quanti, remise, article, tot_art_htva FROM " . $tblpref ."cont_dev RIGHT JOIN " . $tblpref ."article on " . $tblpref ."cont_dev.article_num = " . $tblpref ."article.num WHERE  dev_num = $max";
$req = mysql_query($sql2) or die('Erreur SQL2 !<br>'.$sql2.'<br>'.mysql_error());
while($data = mysql_fetch_array($req))
    {
		$quanti = $data['quanti'];
		$uni = $data['uni'];
		$article = $data['article'];
		$remise = $data['remise'];
		$tot = $data['tot_art_htva'];
		$num_cont = $data['num'];//$lang_li_tot2
		?>
		<td><?php echo $quanti ?> 
		<td><?php echo $uni  ?>
		<td><?php echo $article ?>
		<td><?php echo "$tot $devise" ?>
		<td><?php echo $remise;?></td>
		<td><a href=edit_cont_dev.php?num_cont=<?php echo $num_cont ?>><img border=0 alt=editer src=image/edit.gif></a>&nbsp;
		<td><a href=delete_cont_dev.php?num_cont=<?php echo $num_cont?>&num_dev=<?php echo $max ?> onClick='return confirmDelete()'><img border=0 src= image/delete.jpg ></a></tr>
		<?php }
//on calcule la somme des contenus du bon
$sql = " SELECT SUM(tot_art_htva) FROM " . $tblpref ."cont_dev WHERE dev_num = $max";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_array($req))
    {
		$total_bon = $data['SUM(tot_art_htva)'];
}
//on calcule la some de la tva des contenus du bon
$sql = " SELECT SUM(to_tva_art) FROM " . $tblpref ."cont_dev WHERE dev_num = $max";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_array($req))
    {
		$total_tva = $data['SUM(to_tva_art)'];
		}    
echo "<td class='totalmontant'colspan='4'> $lang_total ";
echo "<td class='totalmontant'colspan='1'>$total_bon $devise<td class='totalmontant'>$lang_tva<td class='totalmontant'> $total_tva $devise<tr>"; 
 echo "<form name='formu2' method='post' action='devis_suite.php'><td><td>$lang_quanti<td>";
 echo "<input name='quanti' type='text' id='quanti' size='6'>";
 echo "<td>$lang_remise</td><td><input name='remise' type='text' id='remise' size='6'></td>";
 echo "<td>$lang_article";
 include_once("include/configav.php");
				  if ($use_categorie !='y') {
$rqSql = "SELECT num, article, prix_htva, uni FROM " . $tblpref ."article WHERE actif != 'non' ORDER BY article, prix_htva";
$result = mysql_query( $rqSql )
             or die( "Exécution requête impossible.");
$ld = "<SELECT NAME='article'>";

$ld .= "<OPTION VALUE=0>Choisissez</OPTION>";
while ( $row = mysql_fetch_array( $result)) {
    $num = $row["num"];
    $article = $row["article"];
		$prix = $row["prix_htva"];
		$uni = $row["uni"];
    $ld .= "<OPTION VALUE='$num'>$article $prix $devise / $uni</OPTION>";
}
$ld .= "</SELECT>"; ?><td><?php
print $ld;
}else{
echo"<td>";
include("include/categorie_choix.php"); 
}
?><tr>
     <input name="nom" type="hidden" id="nom" value=<?php echo $nom ?>>
        <td class='submit'colspan="6"><center><input type="submit" name="Submit" value=<?php echo $lang_ajou_bon ?>>  
    </form></tr>
<form action="dev_fin.php" method="post" name="fin_dev">
<td colspan='6'class='submit'><?php echo $lang_ajo_com_dev ?><tr> 
<td colspan='6'class='submit'><textarea name="coment" cols="45" rows="3"></textarea><tr>
<input type="hidden" name="tot_ht" value=<?php echo $total_bon ?>>
<input type="hidden" name="tot_tva" value=<?php echo $total_tva ?>>
<input type="hidden" name="dev_num" value=<?php echo $max ?>>
<td colspan='6'class='submit'><input type="submit" name="Submit" value=<?php echo $lang_ter_enr ?>>
</form></td><br>    
</table><br><hr><?php 
include("include/bas.php");
 ?>