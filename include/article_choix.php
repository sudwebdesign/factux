<?php
if ($use_categorie !='y') { 
  $rqSql = "SELECT num, article, prix_htva, marge, uni FROM " . $tblpref ."article WHERE actif != 'non' ORDER BY article, prix_htva asc";
  $result = mysql_query( $rqSql ) or die('Erreur SQL !<br>'.$rqSql.'<br>'.mysql_error());
?>
       <select name="article" id="article">
<?php
$cartmun = (isset($article_num))?$article_num:$first_art;#not selected option admin, quel article a afficher en premier
while ($row = mysql_fetch_array( $result)) {
 $sel=(isset($cartmun)&&$cartmun==$row["num"])?'" selected="selected':'';
 $articl3 = "$row[article] ".montant_financier($row["prix_htva"])." / $row[uni]";
 if ($row["marge"]>1)
  $articl3 = "$row[article] [".montant_financier($row["prix_htva"])."] ".montant_financier($row["prix_htva"]*$row["marge"])." / $row[uni]";#margé
?>
        <option value="<?php echo $row["num"].$sel; ?>"><?php echo $articl3; ?></option>
<?php } ?>
       </select>
<?php
}else
 include("include/categorie_choix.php"); 
