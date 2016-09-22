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
 * File Name: form_commande.php
 * 	Formulaire de saisie des commandes
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
if ($message!='') { 
 echo"<table><tr><td>$message</td></tr></table>"; 
}
if ($user_com == n) { 
echo"<h1>$lang_commande_droit";
exit;  
}
 ?> 
<?php
$jour = date("d");
$mois = date("m");
$annee = date("Y");

$rqSql = "SELECT num_client, nom FROM " . $tblpref ."client WHERE actif != 'non'";
if ($user_com == r) { 
$rqSql = "SELECT num_client, nom FROM " . $tblpref ."client WHERE actif != 'non'
	 and (" . $tblpref ."client.permi LIKE '$user_num,' 
	 or  " . $tblpref ."client.permi LIKE '%,$user_num,' 
	 or  " . $tblpref ."client.permi LIKE '%,$user_num,%' 
	 or  " . $tblpref ."client.permi LIKE '$user_num,%')  
	";  
}
?>
<form name="formu" method="post" action="bon.php" onSubmit="return verif_formulaire()">
  <center><table >
  <caption><?php echo "$lang_cre_bon"; ?></caption>
<tr> 
<td class="texte0">&nbsp;</td>
  <td  class="texte0" ><?php echo "$lang_client";?> </td>
  <td  class="texte0" >
	<?php 
	require_once("include/configav.php");
if ($liste_cli!='y') { 
 $rqSql="$rqSql order by nom";
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
      											 <?
														 }
														 ?>
    								</SELECT> 
										<?php }else{include_once("include/choix_cli.php");
										} ?> </td>
<td class="texte0">&nbsp;</td>
</tr>
<tr> 
  <td class="texte0"> &nbsp;</td>
  
  <td class="texte0"><?php echo "date" ?> </td>
  <td class="texte0"><input type="text" name="date" value="<?php echo"$jour/$mois/$annee" ?>" readonly="readonly"/>
    <a href="#" onClick=" window.open('include/pop.calendrier.php?frm=formu&amp;ch=date','calendrier','width=415,height=160,scrollbars=0').focus();"><img src="image/petit_calendrier.gif" alt="calendrier" border="0"/></a>
    </td>
  <td class="texte0">&nbsp;</td>
  
  </tr>
  <tr>
    <td class="submit" colspan="6"> <input type="submit" name="Submit"
                                   value="<?php echo "$lang_crer_bon" ?>"> </td>
</tr></table></center></form>
<?php
$aide = "bon";
?>


<?php
include("help.php");
include_once("lister_commandes.php");
?>


