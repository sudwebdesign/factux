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
 * File Name: fckconfig.js
 * 	Editor configuration settings.
 * 
 * * * Version:  1.1.5
 * * * * Modified: 23/07/2005
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
echo "$lang_client";
$rqSql = "SELECT num_client, nom FROM " . $tblpref ."client ORDER BY nom";
$result = mysql_query( $rqSql )
             or die( "Ex&eacute;cution requ&ecirc;te impossible.");

?>
<form name="form_bon" method="post" action="recherche_fact.php">
  <table border="1" cellspacing="0" cellpadding="0">
    <tr> 
      <td class="texte0" colspan="4"> 
        <?php echo $lang_client; ?>
        <SELECT NAME='client'>
          <OPTION VALUE=><?php echo $lang_choisissez; ?></OPTION>
          <?php
while ( $row = mysql_fetch_array( $result)) {
    $numclient = $row["num_client"];
    $nom = $row["nom"];
    ?>
          <OPTION VALUE='$numclient'><?php echo $nom; ?></OPTION>
          <?php
}
?>
        </SELECT> 
    <tr>
      <td class="texte0"><?php echo $lang_numero; ?> <input name="numero" type="text" id="numero" value="" size="2" > 
      </td>
    </tr>
    <tr>
      <td class="texte0"><?php echo $lang_jour?> <input name="jour" type="text" id="jour"  size="2" > 
      </td>
    </tr>
    <tr>
      <td class="texte0"><?php echo $lang_mois ?> <input name="mois" type="text" id="mois" size="2"  maxlength="2"> 
      </td>
    </tr>
    <tr>
      <td class="texte0"><?php echo $lang_annee?> <input name="annee" type="text" id="annee" size="4"> 
      </td>
    </tr>
    <tr>
      <td class="texte0"><?php echo $lang_montant_ttc; ?> <input name="montant" type="text" id="montant"> 
      </td>
    </tr>
    <tr>
      <td>
        <?php  echo $lang_tri ?>
        <select name="tri" id="tri">
          <option value="nom"><?php echo $lang_client?></option>
          <option value="num"><?php $echo $lang_numero; ?></option>
          <option value="date_fact"><?php echo $lang_date ?></option>
          <option value="<?php $echo total_fact_ttc; ?>">
          <?php $lang_montant_ttc ?>
          </option>
        </select> </td>
    </tr>
    <tr>
      <td> <input type="submit" name="Submit" value=<?php echo $lang_rech ?>> 
      </td>
    </tr>
  </table>
</form>
