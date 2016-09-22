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
 * File Name: chercher_factures.php
 * 	formulaire de recherche des factures
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
include_once("include/headers.php");?>

<?php
include_once("include/finhead.php");
?>
<table width="760" border="0" class="page" align="center">
<tr>
<td class="page" align="center">
<?php
include_once("include/head.php");

if ($user_fact == n) { 
echo "<h1>$lang_facture_droit";
exit;
}

$rqSql = "SELECT num_client, nom FROM " . $tblpref ."client WHERE 1";
if ($user_fact == r) { 
$rqSql = "SELECT num_client, nom FROM " . $tblpref ."client 
	WHERE " . $tblpref ."client.permi LIKE '$user_num,' 
	 or  " . $tblpref ."client.permi LIKE '%,$user_num,' 
	 or  " . $tblpref ."client.permi LIKE '%,$user_num,%' 
	 or  " . $tblpref ."client.permi LIKE '$user_num,%' 
	";  
}

?>
<form name="formu" method="post" action="recherche_fact.php">
  <center><table >
  <caption><?php echo $lang_factures_chercher; ?></caption>
    <tr> 
      <td class="texte1"> 
        <?php echo $lang_client; ?></td><td class="texte1">
				<?php 
				require_once("include/configav.php");
				if ($liste_cli!='y') { 
 				$rqSql="$rqSql order by nom";
 				$result = mysql_query( $rqSql ) or die( "Exécution requête impossible.");
 				?> 
        			<SELECT NAME='listeville'>
          		<OPTION VALUE="null"><?php echo $lang_choisissez; ?></OPTION>
          		<?php
							while ( $row = mysql_fetch_array( $result)) {
    					$numclient = $row["num_client"];
    					$nom = $row["nom"];
    					?>
          		<OPTION VALUE='<?php echo "$numclient" ?>'><?php echo $nom; ?></OPTION>
          		<?php
							}
							?>
        			</SELECT> 
			<?php }else{ ?>
			<script type="text/javascript" src="javascripts/montrer_cacher.js"></script>
			<INPUT type="checkbox" checked name="list_client" onClick="montrer_cacher(this,'cluster','cluster2')">
			<?php
			include_once("include/choix_cli.php");
										} ?>
    <tr>
      <td class="texte0"><?php echo $lang_numero; ?> </td><td class="texte0"><input name="numero" type="text" id="numero" value="" size="2" > 
      </td>
    </tr>
    <tr>
      <td class="texte1"><?php echo $lang_jour?> </td><td class="texte1"><input name="jour" type="text" id="jour"  size="2" > 
      </td>
    </tr>
    <tr>
      <td class="texte0"><?php echo $lang_mois ?> </td><td class="texte0"><input name="mois" type="text" id="mois" size="2"  maxlength="2"> 
      </td>
    </tr>
    <tr>
      <td class="texte1"><?php echo $lang_annee?> </td><td class="texte1"><input name="annee" type="text" id="annee" size="4"> 
      </td>
    </tr>
    <tr>
      <td class="texte0"><?php echo $lang_montant_ttc; ?> </td><td class="texte0"><input name="montant" type="text" id="montant"> 
      </td>
    </tr>
		<tr>
		<td class="texte1"><?php echo"$lang_status_pay"; ?></td>
		<td class="texte1">
		<?php 
		if($use_payement == 'y'){
		?>
		<select name="payement">
		<option value="">Mode de paiement</option>
	<option value="non">non payées</option>
  <option value="liquide">liquide</option>
  <option value="virement">virement</option>
  <option value="paypal">paypal</option>
  <option value="carte">Carte banquaire</option>
  <option value="visa">Visa</option>
		</select>
		<?php 
		}else{ ?>
		<select name="payement">
		<option value="">Choisissez</option>
	<option value="non">non payées</option>
  <option value="oui">Payée</option>
 </select>
		<?php
		} ?>
    <tr>
      <td class="texte0">
        <?php  echo $lang_tri ?></td><td class="texte0">
        <select name="tri" id="tri">
          <option value="nom"><?php echo $lang_client ?></option>
          <option value="num"><?php echo $lang_numero; ?></option>
          <option value="date_fact"><?php echo $lang_date ?></option>
          <option value="<?php echo total_fact_ttc; ?>">
          <?php echo $lang_montant_ttc; ?>
          </option>
        </select> </td>
    </tr>
    <tr>
      <td  class="submit" colspan="2"> <input type="submit" name="submit" value=<?php echo $lang_rech ?>> 
      </td>
    </tr>
  
</table></center></form>
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
