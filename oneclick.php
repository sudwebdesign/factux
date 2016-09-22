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
 * File Name: onclick.php
 * 	formulaire d'impression des factures multiples
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
if ($user_fact == n) { 
echo "<h1>$lang_facture_droit";
exit;
}
 ?> 
<?php
$mois = date("m");
$annee = date("Y");
$jour = date("d");
?>
      <form name="form_facture" method="post" target="_blank" action="fpdf/fact_pdf.php">
        <table class="boiteaction">
          <caption><?php echo $lang_facture_onclick; ?></caption>
          
                <tr>
								
                  <td class='<?php echo couleur_alternee (); ?>'><input type="hidden" name="user" value="adm" /><?php echo $lang_facture_date; ?></td>
                  <td class='<?php echo couleur_alternee (FALSE); ?>'><input type="text" name="oneclick" value="<?php echo "$jour/$mois/$annee" ?>" readonly="readonly"/>
    <a href="#" onClick=" window.open('include/pop.calendrier.php?frm=form_facture&amp;ch=oneclick','calendrier','width=415,height=160,scrollbars=0').focus();"><img src="image/petit_calendrier.gif" alt="calendier"border="0"/></a>
    </td>
                  </tr>
          <tr>
            <td class="submit" colspan="2"><input type="submit" name="Submit" value="<?php echo $lang_facture_impri; ?>"></td>
          </tr>
      </table></form>
      <hr>
      <?php 
$aide = oneclick;
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
