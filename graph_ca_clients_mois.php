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
 * File Name: ca_paeclient_1mois.php
 * 	Donne les statistiques de chiffre d'affaire par mois
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
$mois_1=isset($_POST['mois_1'])?$_POST['mois_1']:date("m");
$annee_1=isset($_POST['annee_1'])?$_POST['annee_1']:date("Y");
?>
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php
include_once("include/head.php");
if ($user_stat== 'n') { 
 echo"<h1>$lang_statistique_droit</h1>";
 include_once("include/bas.php");
 exit;
}
?>
  <form action="graph_ca_clients_mois.php" method="post"> 
   <select name="mois_1">
<?php
$calendrier = calendrier_local_mois ();
foreach ($calendrier as $numero_mois => $nom_mois){
?>
    <option value="<?php echo $numero_mois; ?>"
    <?php if ( intval($numero_mois) == intval($mois_1) ) { ?> selected="selected"<?php }  ?>
    ><?php echo ucfirst($nom_mois); ?></option>
<?php } ?>
   </select>
   <select name="annee_1">
<?php for ($i=date("Y");$i>=date("Y")-13;$i--){?>
        <option value="<?php echo$i; ?>"<?php echo ($i==$annee_1)?' selected="selected"':''; ?>><?php echo $i; ?></option>
<?php } ?>

   </select>
   <button type="submit"><?php echo $lang_envoyer; ?></button>
  </form>
  <br>
<?php 
$sql = "SELECT num_client FROM " . $tblpref ."client";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql2.'<br>'.mysql_error());
$nb = mysql_num_rows($req);
?>
  <table class='page boiteaction'>
   <caption><?php echo "$lang_ca_par_client_1mois $mois_1/$annee_1" ?></caption>
   <tr> 
    <th><?php echo $lang_client; ?></th>
    <th width="380"><?php echo $lang_pourcentage;?></th>
    <th><?php echo "$lang_total_mois $mois_1/$annee_1"; ?></th>
   </tr>
<?php
//pour le total
$sql = "SELECT SUM(tot_htva)FROM " . $tblpref ."bon_comm WHERE MONTH(date)= $mois_1 AND Year(date)=$annee_1 ";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
$total = $data['SUM(tot_htva)'];
$sql = "SELECT SUM(tot_htva) AS tot_htva, nom FROM  " . $tblpref ."bon_comm 
RIGHT JOIN " . $tblpref ."client on client_num = num_client 
WHERE Year(date)=$annee_1 
AND MONTH(date)=$mois_1 
GROUP BY nom
ORDER BY tot_htva DESC";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while ($data = mysql_fetch_array($req)){
$nom = $data['nom'];
$tot = $data['tot_htva'];
$pourcentage = avec_virgule ($tot / $total * 100.00, 2);//number_format( round( ($tot*100.000)/$total), 3, ",", " ");
?>
   <tr> 
    <td class='<?php echo couleur_alternee (); ?>'><?php echo $nom; ?></td>
    <td class='<?php echo couleur_alternee (FALSE); ?>'> <?php echo stat_baton_horizontal("$pourcentage %",2); ?></td>
    <td class='<?php echo couleur_alternee (FALSE, "nombre"); ?>'><?php echo montant_financier($tot); ?></td>
   </tr>
<?php } ?>
   <tr> 
    <td class="totalmontant"></td>
    <td class="totaltexte"><?php echo $lang_total; ?></td>
    <td class="totalmontant"><?php echo montant_financier($total); ?></td>
   </tr>
  </table>
  </td>
 </tr>
 <tr> 
  <td>
<?php
$aide='stats';
include("help.php");
include_once("include/bas.php");
?>
  </td>
 </tr>
</table>
</body>
</html>
