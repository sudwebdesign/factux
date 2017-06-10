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
 * File Name: chercher_factures.php
 * 	formulaire de recherche des factures
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
 exit;
 include_once("include/bas.php");
}
$rqSql = "SELECT num_client, nom FROM " . $tblpref ."client WHERE 1";
if ($user_fact == 'r') { 
$rqSql = "SELECT num_client, nom FROM " . $tblpref ."client 
WHERE " . $tblpref ."client.permi LIKE '$user_num,' 
or " . $tblpref ."client.permi LIKE '%,$user_num,' 
or " . $tblpref ."client.permi LIKE '%,$user_num,%' 
or " . $tblpref ."client.permi LIKE '$user_num,%' 
";  
}
?>
  <form name="formu" method="post" action="chercheur_factures.php">
   <center>
    <table class="page" border="0" align="center">
     <caption><?php echo $lang_factures_chercher; ?></caption>
      <tr> 
       <td class="texte1"><?php echo $lang_client; ?></td>
       <td class="texte1" colspan="5">
<?php 
if ($liste_cli!='y') { 
$rqSql="$rqSql order by nom";
$result = mysql_query( $rqSql ) or die( "Exécution requête impossible.");
?> 
        <select name='listeclients'>
         <option value=""><?php echo $lang_choisissez; ?></option>
<?php
while ( $row = mysql_fetch_array( $result)){
$numclient = $row["num_client"];
$nom = $row["nom"];
?>
         <option value='<?php echo "$numclient" ?>'><?php echo $nom; ?></option>
<?php } ?>
        </select> 
<?php }else{ ?>
       <script type="text/javascript" src="javascripts/montrer_cacher.js"></script>
       <input type="checkbox" checked name="list_client" onclick="montrer_cacher(this,'cluster','cluster2')">
<?php 
include_once("include/choix_cli.php");
}
?>
       </td>
      </tr>
      <tr>
       <td class="texte0"><?php echo $lang_num_fact; ?></td>
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
       <td class="texte0"><?php echo $lang_montant_ttc; ?></td>
       <td class="texte0" colspan="5"><input name="montant" type="text" id="montant"></td>
      </tr>
      <tr>
       <td class="texte1"><?php echo"$lang_status_pay"; ?></td>
       <td class="texte1" colspan="5">
<?php if($use_payement == 'y'){ ?>
        <select name="payement">
         <option value=""><?php echo $lang_mode_paiement; ?></option>
          <option value="Especes"><?php echo $lang_liquide; ?></option>
          <option value="Cheque"><?php echo $lang_paypal; ?></option>
          <option value="virement"><?php echo $lang_virement; ?></option>
          <option value="carte"><?php echo $lang_carte_ban; ?></option>
          <option value="visa"><?php echo $lang_visa; ?></option>
        </select>
<?php }else{ ?>
        <select name="payement">
         <option value=""><?php echo $lang_choisissez; ?></option>
         <option value="non"><?php echo $lang_non_pay; ?></option>
         <option value="oui"><?php echo $lang_pay_ok; ?></option>
        </select>
<?php } ?>
       </td>
      </tr>
      <tr>
       <td class="texte0"><?php echo $lang_tri ?></td>
       <td class="texte0" colspan="5">
        <select name="tri" id="tri">
         <option value="nom"><?php echo $lang_client ?></option>
         <option value="num"><?php echo $lang_num_fact; ?></option>
         <option value="date_fact"><?php echo $lang_date ?></option>
         <option value="total_fact_ttc"><?php echo $lang_montant_ttc; ?></option>
        </select>
       </td>
      </tr>
      <tr>
       <td class="submit" colspan="6">
        <input type="submit" name="submit" value="<?php echo $lang_rech ?>"> 
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
$aide='facture';
include("help.php");
include_once("include/bas.php");
?>
  </td>
 </tr>
</table>
<?php if(basename($_SERVER['PHP_SELF'])==basename(__FILE__)){?>
</body>
</html>
<?php }
