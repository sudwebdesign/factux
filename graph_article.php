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
 * File Name: fckconfig.js
 * 	Editor configuration settings.
 * 
 * * * Version:  5.0.0
 * * * * Modified: 07/10/2016
 * 
 * File Authors:
 * 		Guy Hendrickx
 *#included in & end of ca_articles.php
 */
include_once("include/headers.php");
include_once("include/finhead.php");
//pour le formulaire
$mois_1 = isset($_GET['mois_1'])?$_GET['mois_1']:$lang_tous;#date("m")
$annee_1 = isset($_GET['annee_1'])?$_GET['annee_1']:$lang_toutes;#date("Y")
$ands = ($annee_1==$lang_toutes)?'':"WHERE YEAR(date) = $annee_1";#si année choisie
$aw = (($annee_1==$lang_toutes&&$mois_1!=$lang_tous))?'WHERE':' AND';#si toutes années et mois choisi #idée GROUP BY DAY(date)
$ands .= ($mois_1==$lang_tous)?'':"$aw MONTH(date) = $mois_1";#si année entiere
?>
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php include_once("include/head.php");$calendrier = calendrier_local_mois (); ?>
  <center>
    <form action="graph_article.php" method="GET" name="annee">
     <?php echo $lang_mois; ?>
     <select name="mois_1">
      <option value="<?php echo $lang_tous; ?>"<?php echo ($lang_tous==$mois_1)?' selected="selected"':''; ?>><?php echo ucfirst($lang_tous); ?></option>
<?php for ($i=1;$i<=12;$i++){?>
      <option value="<?php echo $i; ?>"<?php echo ($i==$mois_1)?' selected="selected"':''; ?>>
      <?php echo ucfirst($calendrier[$i]); ?></option>
<?php } ?>
     </select>
     <?php echo $lang_annee; ?>
     <select name="annee_1">
      <option value="<?php echo $lang_toutes; ?>"<?php echo ('tout'==$annee_1)?' selected="selected"':''; ?>><?php echo ucfirst($lang_toutes); ?></option>
<?php for ($i=date("Y");$i>=date("Y")-13;$i--){?>
        <option value="<?php echo$i; ?>"<?php echo ($i==$annee_1)?' selected="selected"':''; ?>><?php echo $i; ?></option>
<?php } ?>
      </select>
      <input type="submit" value="<?php echo $lang_envoyer; ?>" />
     </form>
    </center>
   </td>
  </tr>
  <tr>
   <td  class="page" align="center">
    <table class='page boiteaction'>
     <caption><?php naviguer("graph_article.php?ordre=".@$_GET['ordre'],$mois_1,$annee_1,$lang_stat_art); ?></caption>
     <tr>
       <th><?php echo $lang_article; ?></th>
       <th><?php echo "$lang_total_vente ($mois_1/$annee_1)"; ?></th>
       <th><?php echo $lang_quantite; ?></th>
       <th><?php echo $lang_total; ?></th>
       <th><?php echo "$lang_prix $lang_dachat"; ?></th>
       <th><?php echo "$lang_prix $lang_de_vente"; ?></th>
       <th> </th>
     </tr>
<?php 
//pour le total
$sql = "
SELECT SUM(tot_art_htva)
FROM " . $tblpref ."cont_bon 
LEFT JOIN " . $tblpref ."bon_comm on bon_num = num_bon
$ands
";

$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
$total = $data['SUM(tot_art_htva)'];

$sql = "
SELECT " . $tblpref ."article.num, 
SUM(tot_art_htva) AS tot_art_htva,
SUM(quanti) AS nombre,
p_u_jour,
prix_htva,
SUM((tot_art_htva - ((p_u_jour / marge_jour) * quanti)) * (1-(remise/100))) AS marge,
SUM((p_u_jour * quanti) - tot_art_htva) AS remise,
date,
article,
uni
FROM  " . $tblpref ."cont_bon 
LEFT JOIN " . $tblpref ."bon_comm on bon_num = num_bon 
LEFT JOIN " . $tblpref ."article on " . $tblpref ."article.num = article_num 
$ands
GROUP BY article
ORDER BY tot_art_htva DESC";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
//$data = mysql_fetch_array($req);
$c=$remise=$marge=$margereele=0;
while ($data = mysql_fetch_array($req)){
 $num = $data['num'];
 $art = $data['article'];
 $tot = $data['tot_art_htva'];
 $quanti = $data['nombre'];
 $uni = $data['uni'];
 $prix_achat = $data['prix_htva'];
 $prix = $data['p_u_jour'];
 $remise += $data['remise'];
 $marge += $data['marge'];
 $margereele += $data['marge']-$data['remise'];
 $pourcentage = avec_virgule ($tot / $total * 100.00, 2);
 $line=($c++&1)?1:0;
?>
   <tr class='texte<?php echo $line; ?>' onmouseover="this.className='highlight'" onmouseout="this.className='texte<?php echo $line; ?>'">
    <td class='<?php echo couleur_alternee (); ?>'><b title="<?php echo "$lang_numero $num"; ?>"><?php echo $art; ?></b></td>
    <td class='<?php echo couleur_alternee (FALSE); ?>' width='261'><?php echo stat_baton_horizontal($pourcentage, 2); ?> %</td>
    <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo "$quanti $uni "; ?></td>
    <td class='<?php echo couleur_alternee (FALSE, "nombre"); ?>'><?php echo montant_financier($tot); ?>&nbsp;</td>
    <td class='<?php echo couleur_alternee (FALSE, "nombre"); ?>'><?php echo montant_financier($prix_achat); ?></td>
    <td class='<?php echo couleur_alternee (FALSE, "nombre"); ?>'><?php echo montant_financier($prix); ?></td>
    <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'>
     <a href='edit_art.php?article=<?php echo $num; ?>'>
      <img border="0" alt="<?php echo $lang_editer; ?>" src="image/edit.gif">
     </a>
    </td>
   </tr>
<?php } ?>
   <tr>
    <td colspan="3" class='totalmontant'><?php echo $lang_total_h_tva; ?><br><?php echo "$lang_marge $lang_total_h_tva"; ?><br><?php echo "$lang_remise $lang_total_h_tva"; ?><br><?php echo "$lang_marge réele $lang_total_h_tva"; ?></td>
    <td colspan="4" class='totaltexte'><?php echo montant_financier($total); ?><br><?php echo montant_financier($marge); ?><br><?php echo montant_financier($remise); ?><br><?php echo montant_financier($margereele); ?></td>
   </tr>
  </table> 
  </td>
 </tr>
 <tr>
  <th>
   <center>
    <img src="graph2_ca_art_ht.php?annee_1=<?php echo $annee_1; ?>&amp;mois_1=<?php echo $mois_1; ?>">
   </center>
  </th>
 </tr>
 <tr>
  <td>
<?php
$aide='stats'; 
include("help.php");
include_once("include/bas.php");
?>
  </td>
 </tr>
</table>
</body>
</html>
