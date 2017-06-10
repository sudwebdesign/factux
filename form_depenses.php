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
 * File Name: form_depense.php
 * 	formulaire de saisie des depenses
 * 
 * * * Version:  5.0.0
 * * * * Modified: 07/10/2016
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
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
if ($user_dep == 'n') { 
 echo "<h1>$lang_depense_droit</h1>";
 include_once("include/bas.php");
 exit;
}
if (isset($message)&&$message!='') { 
 echo $message;$message='';#no propagation
}
$rqSql = "SELECT * FROM " . $tblpref ."depense GROUP by fournisseur ORDER BY fournisseur";
$result = mysql_query( $rqSql ) or die( "Ex&eacute;cution requ&ecirc;te impossible.");
?>
   <form action="form_dep_suite.php" method="post" name="depense" id="depense">
    <table class="page boiteaction">
     <caption><?php echo $lang_depense_ajouter; ?></caption>
     <tr> 
      <td class="texte0"><?php echo "$lang_fournisseur" ?>:</td>
      <td class="texte0">
       <select name='fournisseur'>
        <option value=default><?php echo $lang_choisissez; ?></option>
                  <?php
while ( $row = mysql_fetch_array( $result)){
  $four = $row["fournisseur"];
?>
        <option value='<?php echo $four; ?>'><?php echo $four; ?></option>
<?php } ?>
       </select>
      </td>
      <td class="texte0"  colspan="2"><?php echo $lang_fournisseur_entrez; ?></td>
      <td class="texte0"  colspan="2">
       <input name="fourn" type="text" id="article" size="30" maxlength="30">
      </td>
     </tr>
     <tr>
      <td class="texte0" > <?php echo $lang_libelle; ?>: </td>
      <td colspan="4" class="texte0" >
       <input name="lib" type="text" id="lib" size="50" maxlength="50"> 
      </td>
     </tr>
     <tr>
      <td class="texte0"> <?php echo $lang_prix_h_tva;  ?>: </td><td colspan="4" class="texte0" ><input name="prix" type="text" id="prix"><?php echo $devise; ?></td>
     </tr>
     <tr>
      <td class="texte0"> <?php echo $lang_t_tva;  ?>: </td><td colspan="4" class="texte0" ><input name="tva" type="text" id="tva"><?php echo "%"; ?></td>
     </tr>
     <tr>
      <td class="texte0"> <?php echo $lang_date; ?>: </td>
      <td colspan="4" class="texte0"><input type="text" name="date" value="<?php echo"$jour/$mois/$annee" ?>" readonly="readonly"/>
       <a href="#" onClick=" window.open('include/pop.calendrier.php?frm=depense&amp;ch=date','calendrier','width=460,height=170,scrollbars=0').focus();">
        <img src="image/petit_calendrier.gif" alt="calendrier" border="0"/>
       </a>
      </td>
     </tr>
     <tr>
      <td class="submit" colspan="6">
       <input type="submit" name="Submit" value="<?php echo $lang_envoyer; ?>">
       &nbsp;&nbsp;
       <input name="reset" type="reset" id="reset" value="<?php echo $lang_effacer; ?>">
      </td>
     </tr>
    </table>
   </form>
  </td>
 </tr>
 <tr>
  <td>
<?php
include_once("lister_depenses.php");
