<?php 
/*
 * Factux le facturier libre
 * Copyright (C) 2003-2005 Guy Hendrickx, 2017 Thomas Ingles
 * 
 * Licensed under the terms of the GNU  General Public License:
 *   http://opensource.org/licenses/GPL-3.0
 * 
 * For further information visit:
 *   http://factux.free.fr
 * 
 * File Name: lister_commandes_non_facturees.php
 *  liste les bons de commande orphelins
 * 
 * * * Version:  5.0.0
 * * * * Modified: 07/10/2016
 * 
 * File Authors:
 *   Guy Hendrickx
 *.
 */
include_once("include/headers.php");
?><script type="text/javascript" src="javascripts/confdel.js"></script><?php
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
$sql = "
SELECT client_num, num_bon, tot_htva, tot_tva, nom, date, DATE_FORMAT(date,'%d/%m/%Y') AS date_aff 
FROM " . $tblpref ."bon_comm 
LEFT JOIN " . $tblpref ."client on " . $tblpref ."bon_comm.client_num = num_client 
WHERE fact='0'";
if ($user_com == 'r') { 
$sql .= "
  and " . $tblpref ."client.permi LIKE '$user_num,' 
  or  " . $tblpref ."client.permi LIKE '%,$user_num,' 
  or  " . $tblpref ."client.permi LIKE '%,$user_num,%' 
  or  " . $tblpref ."client.permi LIKE '$user_num,%'";  
}
if ( isset ( $_GET['ordre'] ) && $_GET['ordre'] != ''){
 $sql .= " ORDER BY " . $_GET['ordre'] . " DESC";
}else{
 $sql .= "ORDER BY " . $tblpref ."bon_comm.`num_bon` DESC";
}
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
?>
   <center>
    <table class='page boiteaction'>
     <caption><?php echo $lang_commandes_non_facturees; ?></caption>
     <tr>
      <th><a href="lister_commandes_non_facturees.php?ordre=num_bon"><?php echo $lang_numero; ?></a></th>
      <th><a href="lister_commandes_non_facturees.php?ordre=nom"><?php echo $lang_client; ?></a></th>
      <th><a href="lister_commandes_non_facturees.php?ordre=date"><?php echo $lang_date; ?></a></th>
      <th><a href="lister_commandes_non_facturees.php?ordre=tot_htva"><?php echo $lang_total_h_tva; ?></a></th>
      <th><a href="lister_commandes_non_facturees.php?ordre=tot_tva"><?php echo $lang_tot_tva; ?></a></th>
      <th colspan="4"><?php echo $lang_action; ?></th>
     </tr>
<?php
$c=0;
while($data = mysql_fetch_array($req)){
 $num_bon = $data['num_bon'];
 $total = $data['tot_htva'];
 $tva = $data['tot_tva'];
 $date = $data['date_aff'];
 $nom = $data['nom'];
 $nom_html = urlencode($nom);
 $num_client= $data['client_num'];

 if($c++ & 1){
  $line="0";
 }else{
  $line="1";
 }
?>
     <tr class="texte<?php echo $line; ?>" onmouseover="this.className='highlight'" onmouseout="this.className='texte<?php echo $line; ?>'">
      <td class='<?php echo couleur_alternee (); ?>'><?php echo $num_bon; ?></td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo $nom; ?></td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo $date; ?></td>
      <td class='<?php echo couleur_alternee (FALSE,"nombre"); ?>'><?php echo montant_financier($total); ?></td>
      <td class='<?php echo couleur_alternee (FALSE,"nombre"); ?>'><?php echo montant_financier($tva); ?></td>
      <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'>
       <a href="edit_bon.php?num_bon=<?php echo $num_bon; ?>&amp;nom=<?php echo $nom_html; ?>"> 
        <img border="0" src="image/edit.gif" alt="<?php echo $lang_editer; ?>">
       </a>
      </td>
      <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'>
       <a href="<?php echo "delete_bon.php?num_bon=$num_bon&amp;nom=$nom_html"?>" 
         onClick="return confirmDelete('<?php echo $lang_con_effa.$num_bon; ?>')">
        <img border="0" src="image/delete.jpg" alt="<?php echo $lang_effacer; ?>">
       </a>
      </td>
      <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'>
       <form action="fpdf/bon_pdf.php" method="post" target="_blank" >
        <input type="hidden" name="num_bon" value="<?php echo $num_bon ?>" />
        <input type="hidden" name="nom" value="<?php echo $nom ?>" /> 
        <input type="hidden" name="user" value="adm" />
        <input type="image" src="image/printer.gif" style="border:none;margin:0;" alt="<?php echo $lang_imprimer; ?>" />
       </form>
      </td>
      <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'>
       <a href="fact_bon_orph.php?num=<?php echo $num_bon; ?>&amp;client=<?php echo $num_client; ?>"><?php echo $lang_facturer_ce_bon; ?></a>
      </td>
     </tr>
<?php } ?>
     <tr><td colspan="9" class="td2"></td></tr>
    </table>
   </center>
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
</body>
</html>
