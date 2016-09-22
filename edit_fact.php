<?php 
/*
 * Factux le facturier libre
 * Copyright (C) 2003-2004 Guy Hendrickx
 * 
 * Licensed under the terms of the GNU  General Public License:
 *   http://www.opensource.org/licenses/gpl-license.php
 * 
 * For further information visit:
 *   http://factux.sourceforge.net
 * 
 * File Name: edit_fact.php
 *  Permet l'edition des factures.
 * 
 * * * Version:  1.1.5
 * * * * Modified: 23/07/2005
 * 
 * File Authors:
 *   Guy Hendrickx
 *.
 */
include_once("include/headers.php");
?><script type="text/javascript" src="javascripts/confdel.js"></script><?php
include_once("include/finhead.php");
$num_fact=isset($_GET['num_fact'])?$_GET['num_fact']:"";
?>
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php
include_once("include/head.php");
if ($user_fact == 'n') {
 echo "<h1>$lang_facture_droit</h1>";
 exit;
}
$sql = "
SELECT list_num,nom,client  
FROM " . $tblpref ."facture 
LEFT JOIN " . $tblpref ."client on " . $tblpref ."facture.client = num_client 
WHERE num = $num_fact
";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
$list_num = unserialize($data['list_num']);
$num_client= $data['client'];
$nom = $data['nom'];
$nom_html = htmlentities(urlencode ($nom)); 
?>  
   <center>
    <table class='page boiteaction'>
     <caption><?php echo "$lang_edit_fact_n $num_fact $lang_de $nom"; ?></caption>
     <tr>
      <th><?php echo $lang_num_bon_ab; ?></th>
      <th><?php echo $lang_date; ?></th>
      <th><?php echo $lang_montant_ttc; ?></th>
      <th colspan="3"><?php echo $lang_action; ?></th>
     </tr> 
<?php
$totttc=0;
$c=0;
foreach ($list_num as $num_bon){
 $sql="
 SELECT DATE_FORMAT(date,'%d/%m/%Y') AS date, tot_htva, tot_tva from " . $tblpref ."bon_comm 
 WHERE num_bon = '$num_bon'
 ";
 $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
 $data = mysql_fetch_array($req);
 $date = $data['date'];
 $tot_htva = $data['tot_htva'];
 $tot_tva = $data['tot_tva'];
 $ttc = ($tot_htva + $tot_tva);
 $totttc += $ttc;
 $line=($c++ & 1)?0:1;
?>
    <tr class="texte<?php echo $line; ?>" onmouseover="this.className='highlight'" onmouseout="this.className='texte<?php echo $line; ?>'">
      <td class='<?php echo couleur_alternee (); ?>'><?php echo $num_bon;?></td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo $date; ?></td>
      <td class='<?php echo couleur_alternee (FALSE, "nombre"); ?>'><?php echo montant_financier($ttc); ?></td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'><img src="image/spacer.gif" width="15px"></td>
      <td class='<?php echo couleur_alternee (FALSE, "c texte"); ?>'>
       <form action="fpdf/bon_pdf.php" method="post" enctype="multipart/form-data" target="_blank">
        <input type="hidden" name="num_bon" value="<?php echo $num_bon; ?>" />
        <input type="hidden" name="user" value="adm">
        <input type="image" src="image/printer.gif" alt="imprimer" />
       </form>
      </td>
      <td class='<?php echo couleur_alternee (FALSE, "c texte"); ?>'>
       <form action="edit_fact_suite.php" method="post" enctype="multipart/form-data"
             onclick='return confirmDelete("<?php echo $lang_retirer; ?>?")'>
        <input type="hidden" name="retirer" value="<?php echo $num_bon; ?>" >
        <input type="hidden" name="num_fact" value="<?php echo $num_fact; ?>" >
        <input type="image" src="image/non.gif" alt="<?php echo $lang_retirer; ?>">
       </form>
      </td>
     </tr>
<?php } ?>
     <tr>
      <td class="totaltexte" colspan="2"><?php echo $lang_total_ttc; ?></td>
      <td class="totalmontant"><?php echo montant_financier($totttc); ?></td>
      <td class="totaltexte" colspan="3">
       <center>
        <form action="fpdf/fact_pdf.php" method="post" target="_blank">
         <input type="hidden" name="client" value="<?php echo $num_client; ?>" />
         <input type="hidden" name="num" value="<?php echo $num_fact; ?>" />
         <input type="hidden" name="user" value="adm" />
         <input type="image" src="image/prinfer.gif" style="border:none;margin:0 0 0 -1em;" alt="<?php echo "$lang_imprimer $lang_facture $lang_numero $num_fact"; ?>" />
        </form>
       </center>
      </td>
     </tr>
    </table>
   </center>";
<?php
$sql = "SELECT num_bon, tot_htva, tot_tva, nom, num_client, DATE_FORMAT(date,'%d/%m/%Y') AS date 
FROM " . $tblpref ."bon_comm 
LEFT JOIN " . $tblpref ."client on " . $tblpref ."bon_comm.client_num = num_client 
WHERE fact='0' AND client_num = '$num_client'
ORDER BY " . $tblpref ."bon_comm.`num_bon` DESC";
?>
   <center>
    <table class='page boiteaction'>
     <caption><?php echo "$lang_ajou_fact_n $num_fact"; ?></caption>
     <tr>
      <th><?php echo $lang_num_bon_ab; ?></th>
      <th><?php echo $lang_date; ?></th>
      <th><?php echo $lang_montant_ttc; ?></th>
      <th colspan="3"><?php echo $lang_action; ?></th>
     </tr>
<?php
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$totttc = 0;
while($data = mysql_fetch_array($req)){
$num_bon = $data['num_bon'];
$num_client = $data['num_client'];
$date =$data['date'];
$tot_htva =$data['tot_htva'];
$tot_tva =$data['tot_tva'];
$ttc =($tot_htva + $tot_tva);
$totttc += $ttc;
$line=($c++ & 1)?0:1;
?>
    <tr class="texte<?php echo $line; ?>" onmouseover="this.className='highlight'" onmouseout="this.className='texte<?php echo $line; ?>'">
      <td class='<?php echo couleur_alternee (); ?>'><?php echo $num_bon; ?></td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo $date; ?></td>
      <td class='<?php echo couleur_alternee (FALSE, "nombre"); ?>'><?php echo montant_financier($ttc); ?></td>
      <td class='<?php echo couleur_alternee (FALSE, "c texte"); ?>'>
       <a href='edit_bon.php?num_bon=<?php echo "$num_bon"; ?>&amp;nom=<?php echo $nom_html; ?>'> 
        <img border="0" src="image/edit.gif" alt="<?php echo $lang_editer; ?>">
       </a>
      </td>
      <td class='<?php echo couleur_alternee (FALSE, "c texte"); ?>'>
       <form action="fpdf/bon_pdf.php" method="post" enctype="multipart/form-data" target="_blank">
        <input type="hidden" name="num_bon" value="<?php echo $num_bon; ?>" />
        <input type="hidden" name="user" value="adm">
        <input type="image" src="image/printer.gif" alt="imprimer" />
       </form>
      </td>
      <td class='<?php echo couleur_alternee (FALSE, "c texte"); ?>'>
       <form action="edit_fact_suite.php" method="post" enctype="multipart/form-data"
             onclick='return confirmDelete("<?php echo $lang_ajouter; ?>?")'>
        <input type="hidden" name="ajouter" value="<?php echo $num_bon; ?>" onselect="submit">
        <input type="hidden" name="num_fact" value="<?php echo $num_fact; ?>" >
        <input type="image" src="image/oui.gif" alt="ajouter">
       </form>
      </td>
     </tr>
<?php } ?>
     <tr>
      <td class="totaltexte" colspan="2"><?php echo $lang_total_ttc; ?></td>
      <td class="totalmontant"><?php echo montant_financier($totttc); ?></td>
      <td class="totalmontant" colspan="3"></td>
     </tr>
    </table>
   </center>
  </td>
 </tr>
 <tr>
  <td>
<?php
$aide="factures";
include("help.php");
include("include/bas.php");
?>
  </td>
 </tr>
</table>
</body>
</html>
