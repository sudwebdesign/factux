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
 * File Name: chercher_depenses.php
 * 	Formulaire de recherche pour les depenses
 *
 * * * Version:  5.0.0
 * * * * Modified: 07/10/2016
 *
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
include_once("include/headers.php");
include_once("include/utils.php");
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
?>
   <form name="form_rec_dep" method="post" action="chercheur_depenses.php">
    <center>
     <table class="page" border="0" align="center">
      <caption><?php echo $lang_che_dep; ?></caption>
      <tr>
       <td class="texte1"><?php echo $lang_fournisseur; ?></td>
       <td class="texte1" colspan="5">
        <select name='fournisseur'>
         <option value=''><?php echo $lang_choisissez; ?></option>
<?php
$rqSql = "SELECT * FROM " . $tblpref ."depense GROUP by fournisseur ORDER BY fournisseur";
$result = mysql_query( $rqSql ) or die('Erreur SQL !<br>'.$rqSql.'<br>'.mysql_error());
$ld = "
";
while ( $row = mysql_fetch_array( $result)){
    $four = $row["fournisseur"];
?>
         <option value='<?php echo $four; ?>'><?php echo $four; ?></option>
<?php } ?>
        </select>
       </td>
      </tr>
      <tr>
       <td class="texte0"><?php echo $lang_no_dep; ?></td>
       <td class="texte0" colspan="5"><input name="numero" type="text" id="numero" value="" size="2" ></td>
      </tr>
      <tr>
       <td class="texte1"><?php echo $lang_jour; ?></td>
       <td class="texte1"><input name="jour" type="text" id="jour" size="2"></td>
       <td class="texte1"><?php echo $lang_mois; ?></td>
       <td class="texte1"><input name="mois" type="text" id="mois" size="2" maxlength="2"></td>
       <td class="texte1"><?php echo $lang_annee; ?></td>
       <td class="texte1"><input name="annee" type="text" id="annee" size="4"></td>
      </tr>
      <tr>
       <td class="texte0"><?php echo "$lang_prix $lang_htva"; ?></td>
       <td class="texte0" colspan="5"><input name="montant" type="text" id="montant"></td>
      </tr>
      <tr>
       <td class="texte1"><?php  echo $lang_tri; ?></td>
       <td class="texte1" colspan="5">
        <select name="tri" id="tri">
         <option value="fournisseur"><?php echo $lang_fournisseur; ?></option>
         <option value="num"><?php echo $lang_no_dep; ?></option>
         <option value="date"><?php echo $lang_date; ?></option>
         <option value="prix"><?php  echo "$lang_prix $lang_htva"; ?></option>
        </select>
       </td>
      </tr>
      <tr>
       <td class="submit" colspan="6">
        <input type="submit" name="Submit" value="<?php echo $lang_rech; ?>">
       </td>
      </tr>
     </table>
    </center>
   </form>
  </td>
 </tr>
 <tr>
  <td>
<?php
$aide='depenses';
include("help.php");
include_once("include/bas.php");
?>
  </td>
 </tr>
</table>
<?php if(strstr($_SERVER['SCRIPT_FILENAME'],__FILE__)){?>
</body>
</html>
<?php }
