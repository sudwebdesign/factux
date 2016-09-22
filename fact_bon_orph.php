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
 * File Name: lister_commandes_non_facturees.php
 * 	liste les bons de commande orphelins
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
<tr><td><center><form name="formu" method="post" action="fact_bon_orph_suite.php" >
<table>
<?php 
if ($user_fact == n) { 
echo"<h1>$lang_facture_droit";
exit;  
}
$num=isset($_GET['num'])?$_GET['num']:"";
$client=isset($_GET['client'])?$_GET['client']:"";
$jour = date("d");
$mois = date("m");
$annee = date("Y");
?>


  <caption><?php echo "$lang_cré_fac_orph $num"; ?></caption>

<tr>
 
 		<td class="texte0"><?php echo "date" ?> </td>
  	<td class="texte0"><input type="text" name="date" value="<?php echo"$jour/$mois/$annee" ?>" readonly="readonly"/>
    		<a href="#" onClick=" window.open('include/pop.calendrier.php?frm=formu&amp;ch=date','calendrier','width=415,height=160,scrollbars=0').focus();"><img src="image/petit_calendrier.gif" alt="calendrier" border="0"/></a></td></tr>
				<tr><td class="texte0"><?php echo"$lang_aj_au_bon"; ?> </td>
				<?php
$rqSql = "SELECT  num_bon, tot_htva, tot_tva, DATE_FORMAT(date,'%d/%m/%Y') AS date 
FROM " . $tblpref ."bon_comm 
WHERE fact='0'AND client_num ='$client' 
and num_bon !='$num'
ORDER BY " . $tblpref ."bon_comm.`num_bon` DESC";
$result = mysql_query( $rqSql )
             or die('Erreur SQL !<br>'.$rqSql.'<br>'.mysql_error());;?>
        <td class="texte0"><SELECT multiple size="5" NAME='bon_sup[]'>
                        <?php
						while ( $row = mysql_fetch_array( $result)) {
    							$num_bon = $row["num_bon"];
    							$tot = $row["tot_htva"];
									$date = $row["date"];
									?>
            <OPTION VALUE='<?php echo $num_bon; ?>'><?php echo "$lang_num_bon_ab $num_bon du $date $lang_Pour_mont $tot $devise"; ?></OPTION>
            <?php
						}
						?>
           </SELECT></td></tr>

		<tr><td class="texte0"><?php echo $lang_acompte; ?>
		<td class="texte0"><input type="text" name="acompte"/><?php echo  $devise; ?>
</tr>
    <tr><td class="submit"colspan="2" >
	<?php echo $lang_ajo_fact ?></tr>
	<tr>
<td class="submit" colspan="2"><textarea name="coment" cols="45" rows="3"></textarea> 
          <tr>
            <td class="submit" colspan="2">
	    <input type="hidden" name="num" value="<?php echo"$num"; ?>">
	    <input type="hidden" name="client" value="<?php echo"$client"; ?>">
	    <input type="submit" name="Submit" value="<?php echo $lang_facture_creer_bouton; ?>"></td>
        
      </table></form></center>
			<tr><td>
			<?php 
include_once("include/bas.php");
 ?> 
 </table></body></html>