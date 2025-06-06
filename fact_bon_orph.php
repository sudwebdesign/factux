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
 * File Name: lister_commandes_non_facturees.php
 * 	liste les bons de commande orphelins
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
$num=isset($_GET['num'])?$_GET['num']:"";
$client=isset($_GET['client'])?$_GET['client']:"";
$jour = date("d");
$mois = date("m");
$annee = date("Y");
?>
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php
include_once("include/head.php");
if ($user_fact == 'n') {
 echo"<h1>$lang_facture_droit</h1>";
 include_once("include/bas.php");
 exit;
}
?>
   <center>
    <form name="formu" method="post" action="fact_bon_orph_suite.php" >
     <table width="460" border="0" class="page" align="center">
      <caption><?php echo "$lang_cré_fac_orph $lang_numero $num"; ?></caption>
      <tr>
       <td class="texte0"><?php echo "date" ?></td>
       <td class="texte0">
        <input type="text" name="date_fact" value="<?php echo"$jour/$mois/$annee" ?>" readonly="readonly"/>
        <a href="#" onClick=" window.open('include/pop.calendrier.php?frm=formu&amp;ch=date_fact','calendrier','width=460,height=170,scrollbars=0').focus();">
         <img src="image/petit_calendrier.gif" alt="calendrier" border="0"/>
        </a>
       </td>
      </tr>
<?php
$rqSql = "
SELECT  num_bon, tot_htva, tot_tva, DATE_FORMAT(date,'%d/%m/%Y') AS date
FROM " . $tblpref ."bon_comm
WHERE fact='0'
AND client_num ='$client'
AND num_bon !='$num'
ORDER BY " . $tblpref ."bon_comm.`num_bon` DESC
";
$result = mysql_query( $rqSql ) or die('Erreur SQL !<br>'.$rqSql.'<br>'.mysql_error());
if(mysql_fetch_lengths($result)){
?>
      <tr>
       <td class="texte0"><?php echo"$lang_aj_au_bon"; ?></td>
       <td class="texte0">
        <select multiple size="5" name='bon_sup[]'>
<?php
while ( $row = mysql_fetch_array( $result)){
$num_bon = $row["num_bon"];
$tot = $row["tot_htva"];
$date = $row["date"];
?>
          <option value='<?php echo $num_bon; ?>'><?php echo "$lang_num_bon_ab $num_bon du $date $lang_pour_mont $tot $devise"; ?></option>
<?php } ?>
         </select>
        </td>
      </tr>
<?php } ?>
      <tr>
       <td class="texte0"><?php echo $lang_acompte; ?></td>
       <td class="texte0"><input type="text" name="acompte"/><?php echo $devise; ?></td>
      </tr>
      <tr>
       <th colspan="2" ><?php echo $lang_ajo_fact ?></th>
      </tr>
      <tr>
       <td class="submit" colspan="2"><textarea name="coment" cols="45" rows="3"></textarea><br>
        <input type="hidden" name="num" value="<?php echo"$num"; ?>" />
        <input type="hidden" name="client" value="<?php echo"$client"; ?>" />
        <input type="submit" name="Submit" value="<?php echo $lang_facture_creer_bouton; ?>" />
        <input alt="<?php echo $lang_simu; ?>" type="checkbox" name="simuler" <?php echo (isset($_POST['simuler']))?' checked="checked"':'';?> />
       </td>
      </tr>
     </table>
    </form>
   </center>
  </td>
 </tr>
 <tr>
  <td>
<?php include_once("include/bas.php"); ?>
  </td>
 </tr>
</table>
</body>
</html>
