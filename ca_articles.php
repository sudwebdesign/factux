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
 * File Name: ca_articles.php
 * 	graphiques du chiffre d'affaire suivant les articles
 * 
 * * Version:  1.1.5
 * * * Modified: 23/07/2005
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
if ($user_stat== n) { 
echo"<h1>$lang_statistique_droit";
exit;  
}

 ?> 
<?php 


//pour le total
$sql = "SELECT SUM(tot_art_htva)
        FROM " . $tblpref ."cont_bon RIGHT JOIN " . $tblpref ."bon_comm on bon_num = num_bon";
       
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
$tot2 = $data['SUM(tot_art_htva)'];
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql2.'<br>'.mysql_error());
$nb = mysql_num_rows($req);

?>
      <table class="boiteaction">
  <caption><?php echo "Statistiques par article"; ?></caption>
        <tr> 
          <th><?php echo $lang_article; ?></th>
          <th><?php echo $lang_prix_uni_abrege; ?></th>
          <th><?php echo $lang_quantite; ?></th>
          <th><?php echo $lang_total; ?></th>
          <th><?php echo $lang_pourcentage; ?></th>
        </tr>
        <?php

$sql = "SELECT SUM( tot_art_htva ) total FROM " . $tblpref ."cont_bon";
$req = mysql_query($sql);
$data = mysql_fetch_array($req);
$total = $data ["total"];

$sql = "SELECT " . $tblpref ."article.num, SUM( tot_art_htva ) , article, prix_htva, SUM(quanti) nombre , uni
        FROM " . $tblpref ."cont_bon
        RIGHT JOIN " . $tblpref ."article ON " . $tblpref ."article.num = article_num
				GROUP BY article
        ORDER BY article";
$req = mysql_query($sql)or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());;

while ($data = mysql_fetch_array($req))
{
$tot = $data['SUM(tot_art_htva)'];
$art = $data['article'];
$quanti = $data['nombre'];
$uni = $data['uni'];
$prix = $data['prix_htva'];
$tot = $quanti * $prix;
$pourcentage = avec_virgule ($tot / $total * 100.0, 1);
?>
        <tr> 
          <td class='<?php echo couleur_alternee (); ?>'><?php echo $art; ?></td>
          <td class='<?php echo couleur_alternee (FALSE, nombre); ?>'><?php echo montant_financier ($prix); ?></td>
          <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo "$quanti $uni"; ?></td>
          <td class='<?php echo couleur_alternee (FALSE, "nombre"); ?>'><?php echo montant_financier ($tot); ?></td>
<td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo stat_baton_horizontal("$pourcentage %", 1); ?></td>  
        </tr>
        <?php
}
?>
</table><tr><td>

<?php
include("help.php");
echo"</td></tr><tr><td>";
include_once("include/bas.php");
?>
</td></tr></table></body>
</html>
