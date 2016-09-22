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
include_once("include/verif.php");
include_once("include/config/common.php");
include_once("include/language/$lang.php");
include_once("include/utils.php");
include_once("include/headers.php");
include_once("include/finhead.php");
?>
<table width="760" border="0" class="page" align="center">
<tr>
<td  class="page" align="center">
<?php 
include_once("include/head.php");
if ($user_dev == n) {
echo "<h1>$lang_devis_droit"; 
exit;  
}
 ?>
<?php 
$rqSql = "SELECT num_client, nom FROM " . $tblpref ."client WHERE 1";
if ($user_dev == r) { 
$rqSql = "SELECT num_client, nom FROM " . $tblpref ."client 
	 WHERE " . $tblpref ."client.permi LIKE '$user_num,' 
	 or  " . $tblpref ."client.permi LIKE '%,$user_num,' 
	 or  " . $tblpref ."client.permi LIKE '%,$user_num,%' 
	 or  " . $tblpref ."client.permi LIKE '$user_num,%' ";
}
?>

<form name="formu" method="post" action="recherche_devis.php">
   <center><table> 
	<caption><?php echo $lang_devis_chercher ; ?></caption>
      <tr> 
        <td  class="texte1">
            <?php 
echo "$lang_client";
?>
</td><td class="texte1">
				 <?php 
				 require_once("include/configav.php");
				 if ($liste_cli!='y') { 
 				 $rqSql="$rqSql order by nom";
 				 $result = mysql_query( $rqSql ) or die( "Exécution requête impossible.");
 				 ?> 
				 <SELECT NAME='client'>
				 <OPTION VALUE=""><?php echo $lang_choisissez; ?></OPTION>
				 <?php
				 while ( $row = mysql_fetch_array( $result)) {
    		 $numclient = $row["num_client"];
    		 $nom = $row["nom"];
				 ?>
    		 <OPTION VALUE='<?php echo $numclient; ?>'><?php echo $nom; ?></OPTION>
				 <?php
				 }
				 ?>
				 </SELECT>
				 <?php }else{?>
				 <script type="text/javascript" src="javascripts/montrer_cacher.js"></script>
			<INPUT type="checkbox" checked name="list_client" onClick="montrer_cacher(this,'cluster','cluster2')">
			<?php
				 include_once("include/choix_cli.php");
										} ?>
</td></tr><tr><td class="texte0">
<?php
echo "$lang_devis_numero"; ?></td><td class="texte0">
            <input name="numero" type="text" id="numero" value="" size="2" >
             </td></tr><tr><td class="texte1"><?php echo $lang_jour; ?> </td><td class="texte1">
            <input name="jour" type="text" id="jour"  size="2" >
            </td></tr><tr><td class="texte0"><?php echo $lang_mois; ?> </td><td class="texte0">
            <input name="mois" type="text" id="mois" size="2"  maxlength="2">
             </td></tr><tr><td class="texte1"><?php echo $lang_annee; ?> </td><td class="texte1">
            <input name="annee" type="text" id="annee" size="4">
            </td></tr><tr><td class="texte0">
            <?php echo $lang_montant_htva; ?></td><td class="texte0">
            <input name="montant" type="text" id="montant">
             </td></tr><tr><td class="texte1">
              <?php  echo $lang_tri; ?></td><td class="texte1">
              <select name="tri" id="tri">
                <option value="nom"><?php echo $lang_client; ?></option>
                <option value="num_dev"><?php echo $lang_devis_numero; ?></option>
                <option value="date"><?php echo $lang_date ?></option>
                <option value="devis.tot_htva">
                <?php  echo $lang_montant_htva ?>
                </option>
              </select>
              </td></tr>
	     <tr><td class="submit" colspan="2"></td>
							
      </tr><tr><td class="submit" colspan="2"> <input type="submit" name="Submit" value=<?php echo $lang_rech ?>></td><td ></td></tr>
    
	</table></center></form>
	<tr><td>
<?php
include("help.php");
echo"</td></tr><tr><td>";
include_once("include/bas.php");
?>
</td></tr>
</table>

</body>
</html> 