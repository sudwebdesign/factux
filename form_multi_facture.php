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
 * File Name: form_multi_facture.php
 * 	formulaire de création des factures
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
if ($message !="") { 
 echo"<table><tr><td>$message</td></tr></table>"; 
}
 
if ($user_fact == n) { 
echo "<h1>$lang_facture_droit";
exit;
}
 
$mois = date("m");
$annee = date("Y");
$jour = date("d");
$rqSql = "SELECT num_client, nom FROM " . $tblpref ."client WHERE actif != 'non'ORDER BY nom";
if ($user_fact == r) { 
$rqSql = "SELECT num_client, nom FROM " . $tblpref ."client WHERE actif != 'non'
		 	 and " . $tblpref ."client.permi LIKE '$user_num,' 
		 	 or  " . $tblpref ."client.permi LIKE '%,$user_num,' 
			 or  " . $tblpref ."client.permi LIKE '%,$user_num,%' 
			 or  " . $tblpref ."client.permi LIKE '$user_num,%' 
ORDER BY nom";  
}
$result = mysql_query( $rqSql ) or die( "Exécution requête impossible.");
?>
      <form name="form_facture" method="post" action="fact_multi.php">
        <table class="boiteaction">
          <caption><?php echo $lang_facture_creer; ?></caption>
          <tr> 
            <td class="texte0"> <?php echo $lang_client; ?> </td>
            <td class="texte0" > <SELECT MULTIPLE NAME='client[]' SIZE="10">
                <OPTION VALUE=""><?php echo $lang_choisissez; ?></OPTION>
                <?php
while ( $row = mysql_fetch_array( $result)) {
    $numclient = $row["num_client"];
    $nom = $row["nom"];
    ?>
                <OPTION VALUE='<?php echo $numclient; ?>'><?php echo $nom; ?></OPTION>
                <?php
}
?>
              </SELECT></td>
                <tr>
                  <td class='<?php echo couleur_alternee (); ?>'><?php echo $lang_date_deb; ?></td>
                  <td class='<?php echo couleur_alternee (FALSE); ?>'><input type="text" name="date_deb" value="<?php echo "1/$mois/$annee" ?>" readonly="readonly"/>
    <a href="#" onClick=" window.open('include/pop.calendrier.php?frm=form_facture&amp;ch=date_deb','calendrier','width=415,height=160,scrollbars=0').focus();"><img src="image/petit_calendrier.gif" alt="calendrier"border="0"/></a>
    </td>
                  
                </tr>
                <tr>
                  <td class='<?php echo couleur_alternee (); ?>'><?php echo $lang_date_fin; ?></td>
                  <td class='<?php echo couleur_alternee (FALSE); ?>'><input type="text" name="date_fin" value="<?php echo "$jour/$mois/$annee" ?>" readonly="readonly"/>
    <a href="#" onClick=" window.open('include/pop.calendrier.php?frm=form_facture&amp;ch=date_fin','calendrier','width=415,height=160,scrollbars=0').focus();"><img src="image/petit_calendrier.gif"alt="calendrier" border="0"/></a>
    
                  </td>
                  
                </tr>
                <tr>
                  <td class='<?php echo couleur_alternee (); ?>'><?php echo $lang_facture_date; ?></td>
                  <td class='<?php echo couleur_alternee (FALSE); ?>'><input type="text" name="date_fact" value="<?php echo "$jour/$mois/$annee" ?>" readonly="readonly"/>
    <a href="#" onClick=" window.open('include/pop.calendrier.php?frm=form_facture&amp;ch=date_fact','calendrier','width=415,height=160,scrollbars=0').focus();"><img src="image/petit_calendrier.gif"alt="calendier" border="0"/></a>
    </td>
                  </tr>
<tr>
<td class='<?php echo couleur_alternee (); ?>'><?php echo $lang_acompte; ?>
<td class='<?php echo couleur_alternee (); ?>'><input type="text" name="acompte" value="" /><?php echo  $devise; ?>
</tr>
    <tr><td class="submit"colspan="2" >
	<?php echo $lang_ajo_fact ?></tr>
	<tr>
<td class="submit" colspan="2"><textarea name="coment" cols="45" rows="3"></textarea> 
          <tr>
            <td class="submit" colspan="2"><input type="submit" name="Submit" value="<?php echo $lang_facture_creer_bouton; ?>"></td>
          </tr>
      </table></form>
      <hr>
      <?php 
$aide = factures;
 ?>
</td></tr><tr><td>
<?php
include("help.php");
echo"</td></tr><tr><td>";
include_once("include/bas.php");
?>
</td></tr>
</table>
</body>
</html>
