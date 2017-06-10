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
 * File Name: onclick.php
 * 	formulaire d'impression des factures multiples
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
?>
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php
include_once("include/head.php");
if ($user_fact == 'n') { 
 echo "<h1>$lang_facture_droit</h1>";
 include_once("include/bas.php");
 exit;
}
$mois = date("m");
$annee = date("Y");
$jour = date("d");
?>
   <center>
    <form name="form_facture" method="post" target="_blank" action="fpdf/fact_pdf.php">
     <table>
      <caption><?php echo $lang_facture_onclick; ?></caption>
      <tr>
       <td class='<?php echo couleur_alternee (); ?>'>
        <input type="hidden" name="user" value="adm" /><?php echo $lang_facture_date; ?>
       </td>
       <td class='<?php echo couleur_alternee (FALSE); ?>'>
        <input type="text" name="oneclick" value="<?php echo "$jour/$mois/$annee" ?>" readonly="readonly"/>
        <a href="#" onClick=" window.open('include/pop.calendrier.php?frm=form_facture&amp;ch=oneclick','calendrier','width=460,height=170,scrollbars=0').focus();">
         <img src="image/petit_calendrier.gif" alt="calendier"border="0"/>
        </a>
       </td>
      </tr>
      <tr>
       <td class="submit" colspan="2">
        <input type="submit" name="Submit" value="<?php echo $lang_facture_impri; ?>">
       </td>
      </tr>
     </table>
    </form>
   </center>
  </td>
 </tr>
 <tr>
  <td>
<?php
$aide = 'oneclick';
include("help.php");
include_once("include/bas.php");
?>
  </td>
 </tr>
</table>
</body>
</html>
