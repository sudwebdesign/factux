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
 * File Name: form_article
 * 	Formulaire de saisie des articles
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
include_once("include/language/$lang.php");
include_once("include/utils.php");
include_once("include/headers.php");
include_once("javascripts/verif_form.js");
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
if ($user_art == n) { 
echo "<h1>$lang_article_droit";
exit;  
}
 if ($message !='') { 
 echo"<table><tr><td>$message</td></tr></table>"; 
}?>
  
      <form action="article_new.php" method="post" name="artice" id="artice" onSubmit="return verif_formulaire()" >
        <center><table>
          <caption>
          <?php echo $lang_article_creer; ?>
          </caption>
          <tr> 
            <td class="texte0"> <?php echo "$lang_art_no"; ?> </td>
            <td class="texte0"> <input name="article" type="text" id="article" size="40" maxlength="40"> 
            </td>
          </tr>
					<?php 
					include_once("include/configav.php");
					if ($use_categorie =='y') { ?>
  
					<tr>
							<td  class='<?php echo couleur_alternee (); ?>'><?php echo"$lang_categorie" ?> 
							<td class='<?php echo couleur_alternee (FALSE); ?>'><?php
																	$rqSql = "SELECT id_cat, categorie FROM " . $tblpref ."categorie WHERE 1";
																	$result = mysql_query( $rqSql ) or die( "Exécution requête impossible."); ?> 
  																<SELECT NAME='categorie'>
      														<OPTION VALUE='0'><?php echo $lang_choisissez; ?></OPTION>
      														<?php
																	while ( $row = mysql_fetch_array( $result)) {
   													 			$num_cat = $row["id_cat"];
    												 			$categorie = $row["categorie"];
    												 			?>
      											 			<OPTION VALUE='<?php echo "$num_cat" ; ?>'><?php echo "$categorie"; ?></OPTION>
      											 			<?
														 			}
														 			?>
    															</SELECT> 
					<?php } ?>
          <tr> 
            <td class='<?php echo couleur_alternee (); ?>'> <?php echo "$lang_uni_art" ?> </td>
            <td class='<?php echo couleur_alternee (FALSE); ?>'><input name="uni" type="text" id="uni" size="8" maxlength="8" value=""> 
            </td>
          </tr>
          <tr> 
            <td class='<?php echo couleur_alternee (); ?>'> <?php echo $lang_prix_uni; ?></td>
            <td class='<?php echo couleur_alternee (FALSE); ?>'> <input name="prix" type="text" id="prix"> &euro;</td>
          </tr>
          <tr> 
            <td class='<?php echo couleur_alternee (); ?>'> <?php echo "$lang_ttva" ?></td>
            <td class='<?php echo couleur_alternee (FALSE); ?>'> <input name="taux_tva" type="text" id="taux_tva" size="5" maxlength="5">
              %</td>
          </tr>
		  <tr>
		  	<td class='<?php echo couleur_alternee (); ?>'><?php echo $lang_marge;?></td>
			<td class='<?php echo couleur_alternee (FALSE); ?>'><input name="marge" type="text" id="marge" size="5"></td>
		  </tr>
          <tr> 
            <td class='<?php echo couleur_alternee (); ?>'> <?php echo "$langCommentaire" ?> : </td>
            <td class='<?php echo couleur_alternee (FALSE); ?>'><input name="commentaire" type="text" id="commentaire"> 
            </td>
          </tr>
	  <tr>
	  <td class='<?php echo couleur_alternee (); ?>'><?php echo "$lang_stock"; ?></TD>
	  <td class='<?php echo couleur_alternee (FALSE); ?>'><input name='stock' type='text'> </td>
	  </tr>
	  <tr>
	  <td class='<?php echo couleur_alternee (); ?>'><?php echo"$lang_stomin"; ?></td>
	  <td class='<?php echo couleur_alternee (FALSE); ?>'><input name='stomin' type='text'></td>
	  </tr>
	  <tr>
	  <td class='<?php echo couleur_alternee (); ?>'><?php echo"$lang_stomax"; ?></td>
	  <td class='<?php echo couleur_alternee (FALSE); ?>'><input name='stomax' type='text'></td>
          <tr>
	  
            <td class="submit" colspan="2"> <input type="submit" name="Submit" value="<?php echo $lang_envoyer; ?>"> 
              <input name="reset" type="reset" id="reset" value="<?php echo $lang_effacer; ?>"> </td>
          </tr>
        </table></center>
      </form>
      <?php
			if ($use_categorie =='y') { 
			echo"<tr><td>";
			include_once("ajouter_cat.php");
			}
			$aide = article;
			require_once("lister_articles.php");

?>




