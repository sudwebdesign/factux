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
 * File Name: form_devis
 * 	formulaire de saisie des devis
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
if ($message !='') { 
echo"<table><tr><td>$message</td></tr></table>";  
}
 
if ($user_dev == n) {
echo "<h1>$lang_devis_droit"; 
exit;  
}
 ?> 
<?php
$rqSql = "SELECT num_client, nom FROM " . $tblpref ."client WHERE actif != 'non'";
if ($user_dev == r) { 
$rqSql = "SELECT num_client, nom FROM " . $tblpref ."client WHERE actif != 'non'
		 			 				 AND (" . $tblpref ."client.permi LIKE '$user_num,' 
		 			 				 or  " . $tblpref ."client.permi LIKE '%,$user_num,' 
									 or  " . $tblpref ."client.permi LIKE '%,$user_num,%' 
									 or  " . $tblpref ."client.permi LIKE '$user_num,%') ";
}

$annee = date("Y");
$mois = date("m");
$jour = date("d");

?>
<form name="formu" method="post" action="devis.php" >
  <center><table >
    <caption>
    <?php echo $lang_devis_créer; ?>
    </caption>
    <tr> 
      <td class="texte0"><?php echo "$lang_client"; ?></td>
      <td class="texte0">
			<?php 
						require_once("include/configav.php");
						if ($liste_cli!='y') { 
						$rqSql="$rqSql order by nom";
						echo"$rqSql";
						$result = mysql_query( $rqSql ) or die( "Exécution requête impossible.");
 ?>  
			<SELECT NAME='listeville'>
          <OPTION VALUE='0'><?php echo $lang_choisissez; ?></OPTION>
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
				<?php }else{include_once("include/choix_cli.php");
										} ?> 
							 </td>
    </tr>
    <tr> 
      <td class="texte0"><?php echo "date" ?> </td>
      <td class="texte0"><input type="text" name="date" value="<?php echo "$jour/$mois/$annee" ?>" readonly="readonly"/>
    <a href="#" onClick=" window.open('include/pop.calendrier.php?frm=formu&amp;ch=date','calendrier','width=415,height=160,scrollbars=0').focus();"><img src="image/petit_calendrier.gif" alt="calendrier" border="0"/></a>
      </td>
    </tr>

    <tr> 
      <td class="submit" colspan="2"><input type="submit" name="Submit" value="<?php echo "Créer le devis" ?>">
      </td>
    
  </table></center>
</form>
<?php
$aide = $lang_devis;
 ?>
</td><tr><td>

<?php
include_once("lister_devis.php");
?> 

