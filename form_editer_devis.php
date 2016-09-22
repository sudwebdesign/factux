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
 * File Name: form_editer_devis.php
 * 	
 * 
 * * * Version:  1.1.5
 * * * * Modified: 23/07/2005
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
$sql = "SELECT  coment, client_num FROM " . $tblpref ."devis WHERE num_dev = $num_dev";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
$num = $data['client_num'];
$coment = $data['coment'];
$sql = "SELECT " . $tblpref ."cont_dev.num, quanti, remise, uni, article, tot_art_htva, to_tva_art tva
        FROM " . $tblpref ."cont_dev RIGHT JOIN " . $tblpref ."article on " . $tblpref ."cont_dev.article_num = " . $tblpref ."article.num
		WHERE  dev_num = $num_dev";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());

?>
<table class="boiteaction">
  <caption>
  <?php echo "$lang_devis_editer $lang_numero $num_dev"; ?> 
  </caption>
  <th><? echo $lang_quantite ;?></th>
  <th><? echo $lang_unite ;?></th>
  <th><? echo $lang_article ;?></th>
  <th><? echo $lang_montant_htva ;?></th>
  <th><?php echo $lang_remise;?></th>
  <th><? echo $lang_editer ;?></th>
  <th><? echo $lang_supprimer ;?></th>
      <?php

$total = 0.0;
$total_dev = 0.0;
$total_tva = 0.0;

while($data = mysql_fetch_array($req))
{
  $quanti = $data['quanti'];
  $uni = $data['uni'];
  $article = $data['article'];
  $tot = $data['tot_art_htva'];
  $tva = $data['tva'];
  $num_cont = $data['num'];
  $remise=$data['remise'];
  
$total_dev += $tot;
$total_tva += $tva;
		
  ?>
  <tr><td class='<?php echo couleur_alternee (TRUE,"nombre"); ?>'><?php echo $quanti; ?></td>
  <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo  $uni; ?>
  </td><td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo  $article; ?></td>
   <td  class='<?php echo couleur_alternee (FALSE,"nombre"); ?>'><?php echo montant_financier ($tot); ?>
   <td class="<?php echo couleur_alternee (FALSE,'nombre');?>"><?php echo $remise;?></td>
   </td><td class='<?php echo couleur_alternee (FALSE); ?>'>
   <form method="post" action="edit_cont_dev.php">
  <input name="<?php echo $lang_editer; ?>"
type="image" value="<?php echo $lang_editer; ?>"
src="image/edit.gif"
alt="<?php echo $lang_editer; ?>"
align="middle" border="0" onclick="submit ()">
<input type="hidden" name="num_cont" value="<?php echo $num_cont; ?>">
</form>
  </td><td class='<?php echo couleur_alternee (FALSE); ?>'>
  <?php echo "<a href=delete_cont_dev.php?num_cont=$num_cont&num_dev=$num_dev&nom=$nom onClick='return confirmDelete()'><img border=0 src= image/delete.jpg ></a>" ?>
  </td> </tr>
   <?php
$total += $tot;
}
?>
  
  
    <tr><td class='totalmontant' colspan="3"><?php echo $lang_total; ?></td>

   <td  class='totalmontant'><?php echo montant_financier ($total); ?>
   </td><td class='totaltexte'>&nbsp;
  </td><td class='totaltexte'>&nbsp;</td> <td class='totaltexte'>&nbsp;</td></tr>
<?php
//on calcule la somme des contenus du bon
$sql = " SELECT SUM(tot_art_htva) FROM " . $tblpref ."cont_dev WHERE dev_num = $num_dev";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
?>

</table>

      <form name="formu2" method="post" action="edit_dev_suite.php">
<table class="boiteaction">
  <caption>
  <?php echo "$lang_devis_ajouter $lang_numero $num_dev"; ?> 
  </caption>


<tr> 
          <td class="texte0"><?php echo $lang_article; ?>
        
        </td> 
          <td class="texte0" colspan="6"> 
					<?php
					$rqSql = "SELECT num, article, prix_htva, uni FROM " . $tblpref ."article WHERE actif != 'non' ORDER BY article,prix_htva";
					$result = mysql_query( $rqSql ) or die( "Exécution requête impossible.");
					include_once("include/configav.php");
				  if ($use_categorie !='y') { ?>
					<SELECT NAME='article'>
          <OPTION VALUE=0><?php echo $lang_choisissez; ?></OPTION>
          <?php
					while ( $row = mysql_fetch_array( $result)) {
   				 $num = $row["num"];
    			 $article = $row["article"];
					 $prix = $row["prix_htva"];
					 $uni = $row["uni"];
  				  ?>
              <OPTION VALUE='<?php echo $num; ?>'><?php echo "$article $prix $devise /$uni"; ?></OPTION>
              <?php
							}
							?>
            </SELECT>
						<?php }else{
						include("include/categorie_choix.php"); 
					 }
					 ?> 
				</td></tr>
			        <tr> 
          <td class="texte0"><?php echo $lang_quantite; ?> 
        </td><td class="texte0" colspan="6"><input name="quanti" type="text" id="quanti" size="6">
        </td></tr>
		<tr><td class="texte0" colspan="6"><?php echo $lang_remise;?></td><td class="texte0" colspan="6"><input name="remise" type="text" id="remise" size="6"></td></tr>
        <tr> 
          <td class="submit" colspan="7"> <input type="submit" name="Submit2"
		   value='<?php echo $lang_devis_ajouter; ?>'></td>
        </tr>
			<input name="nom" type="hidden" id="nom" value='<?php echo $nom; ?>'> 
            <input name="num_dev" type="hidden" id="nom" value='<?php echo $num_dev; ?>'> 
</table>
      </form>
      <form action="dev_fin.php" method="post" name="fin_dev">
<table class="boiteaction">
  <caption>
  <?php echo "$lang_devis_enregistrer $lang_numero $num_dev"; ?> 
  </caption>
  <td class="submit" colspan="7">
	<?php echo $lang_ajo_com_dev ?><br> 
<textarea name="coment" cols="45" rows="3"><?php echo $coment; ?></textarea><br> 
        <input type="submit" name="Submit" value='<?php echo $lang_ter_enr; ?>'>
      </td>    
  </tr>
</table>
        <input type="hidden" name="tot_ht" value='<?php echo $total_dev; ?>'>
        <input type="hidden" name="tot_tva" value='<?php echo $total_tva; ?>'>
        <input type="hidden" name="dev_num" value='<?php echo $num_dev; ?>'>
</form>