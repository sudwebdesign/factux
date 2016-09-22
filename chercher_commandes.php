<?php 
/*
 * Factux le facturier libre
 * Copyright (C) 2003-2004 Guy Hendrickx
 * 
 * Licensed under the terms of the GNU  General Public License:
 *     http://www.opensource.org/licenses/gpl-license.php
 * 
 * For further information visit:
 *     http://factux.sourceforge.net
 * 
 * File Name: chercher_commandes.php
 *   formulaire de recherche des commandes
 * 
 * * * Version:  1.1.5
 * * * * Modified: 23/07/2005
 * 
 * File Authors:
 *     Guy Hendrickx
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
if ($user_com == 'n') { 
  echo"<h1>$lang_commande_droit</h1>";
  exit;  
}
$rqSql = "SELECT num_client, nom FROM " . $tblpref ."client WHERE 1";
if ($user_com == 'r') { 
$rqSql = "SELECT num_client, nom FROM " . $tblpref ."client 
  WHERE " . $tblpref ."client.permi LIKE '$user_num,' 
  or  " . $tblpref ."client.permi LIKE '%,$user_num,' 
  or  " . $tblpref ."client.permi LIKE '%,$user_num,%' 
  or  " . $tblpref ."client.permi LIKE '$user_num,%' 
  ";  
}
?>
   <form name="formu" method="post" action="chercheur_commandes.php">
    <center>
     <table class="page" border="0" align="center">
      <caption><?php echo $lang_commandes_chercher; ?></caption>
      <tr> 
       <td class="texte1"><?php echo $lang_client; ?></td>
       <td class="texte1" colspan="5">
<?php 
if ($liste_cli!='y') { 
$rqSql="$rqSql order by nom";
$result = mysql_query( $rqSql ) or die('Erreur SQL !<br>'.$rqSql.'<br>'.mysql_error());
?> 
        <select name="listeclients">
         <option value=''><?php echo $lang_choisissez; ?></option>
<?php
while ($row = mysql_fetch_array($result)) {
$numclient = $row["num_client"];
$nom = $row["nom"];
?>
         <option value="<?php echo $numclient; ?>"><?php echo $nom; ?></option>
<?php
}
?>
        </select>
<?php }else{?>
        <script type="text/javascript" src="javascripts/montrer_cacher.js"></script>
        <input type="checkbox" checked name="list_client" onClick="montrer_cacher(this,'cluster','cluster2')">
<?php        
include_once("include/choix_cli.php");
} 
?> 
       </td>
      </tr>
      <tr>
       <td class="texte0"> <?php echo $lang_num_bon; ?></td>
       <td class="texte0" colspan="5">
        <input name="numero" type="text" id="numero" value="" size="2" > 
       </td>
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
       <td class="texte0"><?php echo $lang_montant_htva; ?></td>
       <td class="texte0" colspan="5"><input name="montant" type="text" id="montant"></td>
      </tr>
      <tr>
       <td class="texte1"><?php  echo $lang_tri; ?></td>
       <td class="texte1" colspan="5">
        <select name="tri" id="tri">
         <option value="nom"><?php echo $lang_client; ?></option>
         <option value="num_bon"><?php echo $lang_num_bon; ?></option>
         <option value="date"><?php echo $lang_date; ?></option>
         <option value="tot_htva"><?php echo $lang_montant_htva; ?></option>
        </select>
       </td>
      </tr>
      <tr>
       <td class="submit" colspan="6"><input type="submit" name="Submit" value='<?php echo $lang_rech; ?>'></td>
      </tr>
     </table>
    </center>
   </form>
  </td>
 </tr>
 <tr>
  <td>
<?php 
$aide='bon';
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
