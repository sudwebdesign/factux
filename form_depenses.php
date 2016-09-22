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
 * File Name: form_depense.php
 * 	formulaire de saisie des depenses
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
include_once("include/finhead.php"); 
$jour = date("d");
$mois = date("m");
$annee = date("Y");

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
if ($message!='') { 
 echo"<table><tr><td>$message</td></tr></table>"; 
}
if ($user_dep == n) { 
echo "<h1>$lang_depense_droit";
exit;
}
 ?> 
<?php
  $rqSql = "SELECT * FROM " . $tblpref ."depense GROUP by fournisseur ORDER BY fournisseur";
  $result = mysql_query( $rqSql ) or die( "Ex&eacute;cution requ&ecirc;te impossible.");
$jour = date("d");
$mois = date("m");
$annee = date("Y");
  ?>
      <form action="form_dep_suite.php" method="post" name="depense" id="depense">
        <center><table>
          <caption>
          <?php echo $lang_depense_ajouter; ?>
          </caption>
          <tr> 
            <td class="texte0"> 
                <?php echo "$lang_fournisseur" ?>: 
                </td><td class="texte0"><SELECT NAME='fournisseur'>
                  <OPTION VALUE=default><?php echo $lang_choisissez; ?></OPTION>
                  <?php
while ( $row = mysql_fetch_array( $result))
{
  $four = $row["fournisseur"];
  $four = stripslashes($four);
  $four2 = addslashes($four);
?>
                  <OPTION VALUE="<?php echo "$four2"; ?>"><?php echo"$four"; ?></OPTION>
                  <?php
}
?>
                </SELECT>
                 </td><td class="texte0"  colspan="2"><?php echo $lang_fournisseur_entrez; ?> 
                </td><td class="texte0"  colspan="2"><input name="fourn" type="text" id="article" size="30" maxlength="30">
            </td>
          </tr>
          <tr>
            <td class="texte0" > <?php echo $lang_libelle; ?> </td><td colspan="4" class="texte0" ><input name="lib" type="text" id="lib" size="30" maxlength="30"> 
            </td>
          </tr>
          <tr>
            <td class="texte0"> <?php echo $lang_prix_h_tva;  ?> </td><td colspan="4" class="texte0" ><input name="prix" type="text" id="prix"> 
              <?php echo $devise; ?></td>
          </tr>
          <tr>
            <td class="texte0"> <?php echo date; ?> </td>
						<td colspan="4" class="texte0"><input type="text" name="date" value="<?php echo"$jour/$mois/$annee" ?>" readonly="readonly"/>
    <a href="#" onClick=" window.open('include/pop.calendrier.php?frm=depense&amp;ch=date','calendrier','width=415,height=160,scrollbars=0').focus();"><img src="image/petit_calendrier.gif" alt="calendrier" border="0"/></a>
    </td>
						</tr>
          <tr>
            <td class="submit" colspan="6"> <input type="submit" name="Submit" value="<?php echo $lang_envoyer; ?>"> 
              <input name="reset" type="reset" id="reset" value="<?php echo $lang_effacer; ?>"> 
            </td>
          </tr>
        
      </table></center></form>
      <?php
$aide = depense;
 ?>
</td></tr><tr><td>

<?php
include("help.php");
echo"</td></tr><tr><td>";
include_once("lister_depenses.php");
?>


