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
 * File Name: chercher_dep.php
 * 	Formulaire de recherche pour les depenses
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
include_once("include/headers.php");
include_once("include/finhead.php");
?>
<table width="760" border="0" class="page" align="center">
<tr><td class="page" align="center">
<?php 
include_once("include/head.php");
if ($user_dep == n) { 
echo "<h1>$lang_depense_droit";
exit;
}
 ?> 
<form name="form_rec_dep" method="post" action="rep_rech_dep.php">
<center><table>
  <caption>
<?php echo "$lang_che_dep" ?>
  </caption>

  <tr>
    
		<td class='texte1'>
                <?php 
echo "Fournisseur";
$rqSql = "SELECT * FROM " . $tblpref ."depense GROUP by fournisseur ORDER BY fournisseur";
$result = mysql_query( $rqSql )
             or die( "Ex&eacute;cution requ&ecirc;te impossible.");
$ld = "<SELECT NAME='fournisseur'>";
$ld .= "<OPTION VALUE=''>$lang_choisissez</OPTION>";
while ( $row = mysql_fetch_array( $result)) {
    $four = $row["fournisseur"];
    
    $ld .= "<OPTION VALUE='$four'>$four</OPTION>";
}
?><td class="texte1">
<?php 
$ld .= "</SELECT>";
print $ld;
?><tr><?php
echo "<td class='texte0'>Dépense n°" ?>
    <td class="texte0"><input name="numero" type="text" id="numero" value="" size="2" ></tr>
    <?php echo "<tr><td class='texte1'>$lang_jour;" ?>
    <td class="texte1"><input name="jour" type="text" id="jour"  size="2" ></tr>
    <?php echo "<tr><td class='texte0'>$lang_mois"; ?>
    <td class="texte0"><input name="mois" type="text" id="mois" size="2"  maxlength="2"></tr>
		
    <?php echo "<tr><td class='texte1'>$lang_annee"; ?>
    <td class="texte1"><input name="annee" type="text" id="annee" size="4"></tr>
		<?php echo "<tr><td class='texte0'>$lang_montant_htva"; ?>:
		<td class="texte0"><input name="montant" type="text" id="montant"></tr>
      <?php  echo "<tr><td class='texte1'> $lang_tri"; ?>
        <td class="texte1"><select name="tri" id="tri">
          <option value="fournisseur"><?php echo $lang_fournisseur; ?></option>
          <option value="num"><?php echo "$lang_no_dep" ?></option>
          <option value="date"><?php echo $lang_date ?></option>
					<option value="prix"><?php  echo $lang_montant_htva ?></option>
        </select> </tr>
          <tr><td  class="submit" colspan="2">
      <input type="submit" name="Submit" value=<?php echo $lang_rech ?>>
            </tr>
    </table></center></form>
		<tr><td>
    <?php
 include_once("include/bas.php"); 
 ?>
 </td></tr>
</table>
