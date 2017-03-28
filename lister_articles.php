<?php 
/*
 * Factux le facturier libre
 * Copyright (C) 2003-2005 Guy Hendrickx, 2017 Thomas Ingles
 * 
 * Licensed under the terms of the GNU  General Public License:
 * 		http://opensource.org/licenses/GPL-3.0
 * 
 * For further information visit:
 * 		http://factux.free.fr
 * 
 * File Name: lister_article.php
 * 	liste les article et donne acces a differentes actions
 * 
 * * * Version:  5.0.0
 * * * * Modified: 07/10/2016
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
include_once("include/headers.php");
?><script type="text/javascript" src="javascripts/confdel.js"></script><?php
include_once("include/finhead.php");
?>
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php
include_once("include/head.php");
if (isset($message)&&$message!='') { 
 echo $message; 
}
if ($user_art == 'n') { 
 echo "<h1>$lang_article_droit</h1>";
 exit;  
}
$sql = "
SELECT * 
FROM " . $tblpref ."article 
LEFT JOIN " . $tblpref ."categorie ON " . $tblpref ."categorie.id_cat = " . $tblpref ."article.cat
WHERE actif != 'non' ";
if ( isset ( $_GET['ordre'] ) && $_GET['ordre'] != ''){
 $sql .= " ORDER BY " . $_GET['ordre'] . " ASC";
}else{
 $sql .= "ORDER BY article ASC ";
}
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
?>
  <center>
   <table class="page boiteaction">
   <caption><?php echo $lang_articles_liste; ?></caption>
   <tr> 
    <th><a href="lister_articles.php?ordre=article"><?php echo $lang_article; ?></a></th>
<?php
if ($use_categorie =='y'){ ?>
    <th><a href="lister_articles.php?ordre=categorie"><?php echo $lang_categorie ?></a></th>
<?php } ?>
    <th><a href="lister_articles.php?ordre=prix_htva"><?php echo $lang_prix; ?></a></th>
    <th><a href="lister_articles.php?ordre=taux_tva"><?php echo $lang_tva; ?></a></th>
    <th><a href="lister_articles.php?ordre=marge"><?php echo $lang_marge;?></a></th>
    <th><a href="lister_articles.php?ordre=uni"><?php echo $lang_unite; ?></a></th>
<?php if($use_stock=='y'){ ?>
    <th><a href="lister_articles.php?ordre=stock"><?php echo $lang_stock; ?></a></th>
    <th><a href="lister_articles.php?ordre=stomin"><?php echo $lang_stomin; ?></a></th>
    <th><a href="lister_articles.php?ordre=stomax"><?php echo $lang_stomax; ?></a></th>
<?php } ?>
    <th colspan="2"><?php echo $lang_action; ?></th>
   </tr>
<?php
$c=0;
while($data = mysql_fetch_array($req)){
 $article = $data['article'];
 $article = thespecialchars($article);
 #$article = htmlentities($article, ENT_QUOTES);
 $cat = $data['categorie'];
 #$cat = htmlentities($cat, ENT_QUOTES);#if actif undisplayed
 $num =$data['num'];
 $prix = $data['prix_htva']*$data['marge'];
 $tva = $data['taux_tva'];
 $marge = $data['marge'];
 $uni = $data['uni'];
 $stock = $data['stock'];
 $min = $data['stomin'];
 $max = $data['stomax'];
 if ($stock <= $min || $stock >= $max){ 
  $stock="<b style='color:red;'>$stock</b>";
 }
 if($c++ & 1){
  $line="0";
 }else{
  $line="1";
 }
?>
   <tr class="texte<?php echo $line; ?>" onmouseover="this.className='highlight'" onmouseout="this.className='texte<?php echo $line; ?>'">
    <td title='<?php echo $data['commentaire']; ?>' class='<?php echo couleur_alternee (); ?>'><?php echo $article; ?></td>
<?php if ($use_categorie =='y') { ?>
    <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo $cat; ?></td>
<?php } ?>
    <td class='<?php echo couleur_alternee (FALSE,"nombre"); ?>'><?php echo montant_financier ($prix); ?></td>
    <td class='<?php echo couleur_alternee (FALSE,"nombre"); ?>'><?php echo montant_taux ($tva); ?></td>
    <td class='<?php echo couleur_alternee (FALSE,"nombre"); ?>'><?php echo $marge;?></td>
    <td class='<?php echo couleur_alternee (FALSE,"nombre"); ?>'><?php echo $uni; ?></td>
<?php if($use_stock=='y'){ ?>
    <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo $stock; ?></td>
    <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo $min; ?></td>
    <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo $max; ?></td>
<?php } ?>
    <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'>
     <a href='edit_art.php?article=<?php echo $num; ?>'>
      <img border="0" alt="<?php echo $lang_editer; ?>" src="image/edit.gif">
     </a>
    </td>
    <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'>
     <a href="delete_article.php?article=<?php echo $num; ?>" 
        onClick="return confirmDelete('<?php echo $lang_art_effa.$article; ?>?');">
      <img border="0" alt="<?php echo $lang_supprimer; ?>" src="image/delete.jpg">
     </a>
    </td>
   </tr>
<?php
}#fi while
?>
   <tr><td colspan="11" class="td2"></td></tr>
  </table>
 </center>
  </td>
 </tr>
 <tr>
  <td>
<?php
$aide = 'article';
include("help.php");
include_once("include/bas.php");
if(!strstr($_SERVER['SCRIPT_FILENAME'],__FILE__)){#autre qu'elle meme
 echo"\n  </td>\n </tr>\n</table>\n"; 
}
?>
   </td>
  </tr>
 </table>
</body>
</html>
