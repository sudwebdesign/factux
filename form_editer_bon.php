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
 * File Name: form_editer_bon.php
 * 	fomulaire pour editer les bons de commande
 * 
 * * Version:  1.1.4
 * * Modified: 25/04/2005
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
$sql = "SELECT  coment, client_num, nom FROM " . $tblpref ."bon_comm 
	RIGHT join " . $tblpref ."client on " . $tblpref ."bon_comm.client_num = " . $tblpref ."client.num_client
	WHERE num_bon = $num_bon";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
$num = htmlentities($data['client_num'], ENT_QUOTES);
$coment = htmlentities($data['coment'], ENT_QUOTES);
$nom = htmlentities($data['nom'], ENT_QUOTES);


$sql = "SELECT " . $tblpref ."cont_bon.num, num_lot, quanti, uni, article, tot_art_htva, to_tva_art tva
        FROM " . $tblpref ."cont_bon 
				RIGHT JOIN " . $tblpref ."article on " . $tblpref ."cont_bon.article_num = " . $tblpref ."article.num
		WHERE  bon_num = $num_bon";
$req5 = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$rqSql1 = "SELECT num, article, prix_htva, uni FROM " . $tblpref ."article WHERE actif != 'non' ORDER BY article,prix_htva";
$result = mysql_query( $rqSql1 )
             or die( "Exécution requête impossible.");

$rqSql = "SELECT num_client, nom FROM " . $tblpref ."client WHERE actif != 'non'";
if ($user_com == r) { 
$rqSql = "SELECT num_client, nom FROM " . $tblpref ."client WHERE actif != 'non'
	 and (" . $tblpref ."client.permi LIKE '$user_num,' 
	 or  " . $tblpref ."client.permi LIKE '%,$user_num,' 
	 or  " . $tblpref ."client.permi LIKE '%,$user_num,%' 
	 or  " . $tblpref ."client.permi LIKE '$user_num,%')  
	";  
}


$result2 = mysql_query( $rqSql )
             or die('Erreur SQL !<br>'.$rqSql2.'<br>'.mysql_error());	     

?>

<FORM action="chang_cli.php" method="POST" name="formu">
<table class="boiteaction">
  <caption>
  <?php echo "$lang_bon_editer $lang_numero $num_bon de $nom"; ?> 
  </caption>
  <tr><TD>Changer le client</TD><td>
		<?php 
	require_once("include/configav.php");
if ($liste_cli!='y') { 
 $rqSql="$rqSql order by nom";
 $result = mysql_query( $rqSql ) or die( "Exécution requête impossible.");
 ?> 
  			<SELECT NAME='listeville'>
 								<OPTION VALUE=<?php echo"$num_client"; ?> ><?php echo $nom; ?></OPTION>
  							<?php
								while ( $row = mysql_fetch_array( $result2)) {
    						$numcli = $row["num_client"];
    						$nomcli = $row["nom"];
   							?>
  							<OPTION VALUE='<?php echo "$numcli"; ?>'><?php echo "$nomcli "; ?></OPTION>
								<?php 
 								}
 								?>
								</select>
								<?php }else{include_once("include/choix_cli.php");
										} ?> 
<td><input type="hidden" name="num_bon" value="<?php echo "$num_bon"; ?>" />
<td><INPUT type="submit" name="changer" value="changer">
<td colspan="3">
</tr></table></FORM>
<table class="boiteaction">
 <tr> 
  <th><? echo $lang_quantite ;?></th>
  <th><? echo $lang_unite ;?></th>
  <th><? echo $lang_article ;?></th>
  <th><? echo $lang_montant_htva ;?></th>
	<?php 
				if ($lot =='y') { ?>
	 <th><? echo "N° lot"; ?></th>  
	 				<?php
					}
 					?> 
  <th><? echo $lang_editer ;?></th>
  <th><? echo $lang_supprimer ;?></th>
      <?php
//trouver le client correspodant devis à editer

// echo $lang_cont_devis;

//trouver le contenu du bon
$total = 0.0;
$total_bon = 0.0;
$total_tva = 0.0;
//echo "$sql";
while($data = mysql_fetch_array($req5))

{
 	
  $quanti = $data['quanti'];
  $uni = $data['uni'];
  $article = $data['article'];
  $tot = $data['tot_art_htva'];
  $tva = $data['tva'];
  $num_cont = $data['num'];
	$num_lot = $data['num_lot'];
$total_bon += $tot;
$total_tva += $tva;
		
  ?>
  <tr><td class='<?php echo couleur_alternee (TRUE,"nombre"); ?>'><?php echo $quanti; ?></td>
  <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo  $uni; ?> </td>
	<td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo  $article; ?></td>
  <td  class='<?php echo couleur_alternee (FALSE,"nombre"); ?>'><?php echo montant_financier ($tot); ?></td>
	<?php 
if ($lot =='y') { ?>
  <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo $num_lot; ?></td>
	<?php
	}
 ?>  
   <td class='<?php echo couleur_alternee (FALSE); ?>'>
   		 <form method="get" action="edit_cont_bon.php">
  		 			 <input name="<?php echo $lang_editer; ?>"
						 				type="image" value="<?php echo $lang_editer; ?>"
										src="image/edit.gif"
										alt="<?php echo $lang_editer; ?>"
										align="middle" onclick="submit ()">
						<input type="hidden" name="num_cont" value="<?php echo $num_cont; ?>">
			</form>
  </td><td class='<?php echo couleur_alternee (FALSE); ?>'>
  <?php echo "<a href=delete_cont_bon.php?num_cont=$num_cont&amp;num_bon=$num_bon onClick='return confirmDelete()'><img border=0 src= image/delete.jpg ></a>" ?>
  </td> </tr>
   <?php
	 
$total += $tot;
}
?>
  
  
    <tr><td class='totalmontant' colspan="3"><?php echo $lang_total; ?></td>

   <td  class='totalmontant'><?php echo montant_financier ($total); ?>
   </td><td class='totaltexte'>&nbsp;
  </td><td colspan='2' class='totaltexte'>&nbsp;</td> </tr>
<?php
//on calcule la somme des contenus du bon
$sql = " SELECT SUM(tot_art_htva) FROM " . $tblpref ."cont_bon WHERE bon_num = $num_bon";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
?>

</table>

      <form name="formu2" method="post" action="edit_bon_suite.php">
<table class="boiteaction">
  <caption>
  <?php echo "$lang_bon_ajouter $lang_numero $num_bon"; ?> 
  </caption>


<tr> 
          <td class="texte0"><?php echo $lang_article; ?>
        
        </td>
				<?php
				include_once("include/configav.php");
				  if ($use_categorie !='y') {  ?>
          	 <td class="texte0" colspan="6"> <SELECT NAME='article'>
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
            </SELECT> </td>
						<?php }else{?>
					 <td class="texte0">
					 <?php
					 include("include/categorie_choix.php"); 
					 }
					 ?>
					 				<?php 
									if ($lot=='y') { ?>
									<td class="texte0">Lot </td>
										<?php $rqSql = "SELECT num, prod FROM " . $tblpref ."lot WHERE actif != 'non' ORDER BY num";
										$result = mysql_query( $rqSql )
             or die( "Exécution requête impossible.");?>
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
<?php  }
 ?> 
						</tr>
			        <tr> 
          <td class="texte0"><?php echo $lang_quantite; ?> 
        </td><td class="texte0" colspan="8"><input name="quanti" type="text" id="quanti" size="6">
        </td></tr>
        <tr> 
          <td class="submit" colspan="9"> <input type="submit" name="Submit2"
		   value='<?php echo $lang_bon_ajouter; ?>'>
        
			<input name="nom" type="hidden"  value='<?php echo $nom; ?>'> 
            <input name="num_bon" type="hidden" id="nom" value='<?php echo $num_bon; ?>'>
						</td></tr> 
</table>
      </form>
      <form action="bon_fin.php" method="post" name="fin_bon">
<table class="boiteaction">
  <caption>
  <?php echo "$lang_bon_enregistrer $lang_numero $num_bon"; ?> 
  </caption>
  <tr><td class="submit" colspan="7">
	<?php echo $lang_ajo_com_bo ?><br> 
<textarea name="coment" cols="45" rows="3"><?php echo $coment; ?></textarea><br> 
        <input type="submit" name="Submit" value='<?php echo $lang_ter_enr; ?>'>
      </td>    
  </tr>
</table>
        <input type="hidden" name="tot_ht" value='<?php echo $total_bon; ?>'>
        <input type="hidden" name="tot_tva" value='<?php echo $total_tva; ?>'>
        <input type="hidden" name="bon_num" value='<?php echo $num_bon; ?>'>
</form>
