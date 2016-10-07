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
 * File Name: graph_ca_clients.php
 * 	Statistiques du chiffre d'affaire par clients
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
$annee_1 = (isset($_POST['annne_1']))?$_POST['annne_1']:date('Y');
?>
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php include_once("include/head.php"); ?>
   <form action="graph_ca_clients.php" method="post" name="annee">
<?php echo $lang_annee; ?>: 
    <select name="annne_1">
<?php for ($i=date("Y");$i>=date("Y")-13;$i--){?>
     <option value="<?php echo$i; ?>"<?php echo ($i==$annee_1)?' selected="selected"':''; ?>><?php echo $i; ?></option>
<?php } ?>
    </select>
    <input type="submit" name="Submit" value="<?php echo $lang_envoyer; ?>" />
   </form>
  </td>
 </tr>
 <tr>
  <td class="page" align="center">
<?php 
if ($user_stat == 'n'){ 
 echo"<h1>$lang_statistique_droit</h1>";
 exit;  
}
$sql = "SELECT * FROM " . $tblpref ."client";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql2.'<br>'.mysql_error());
$nb = mysql_num_rows($req);
?>
   <table class='page boiteaction'>
    <caption><?php echo "$lang_ca_par_client $annee_1" ?></caption>
     <tr>
     <th><?php echo $lang_client; ?></th>
     <th width="380"><?php echo $lang_pourcentage;?></th>
     <th><?php echo $lang_montant; ?></th>
    </tr>
<?php
//pour le total
$sql = "
SELECT SUM(tot_htva)
FROM " . $tblpref ."bon_comm
WHERE YEAR(date) = $annee_1 
";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
$total = $data['SUM(tot_htva)'];

$sql = "
SELECT SUM(tot_htva), nom 
FROM " . $tblpref ."bon_comm 
LEFT JOIN " . $tblpref ."client on client_num = num_client 
WHERE YEAR(date) = $annee_1 
GROUP BY nom ";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while ($data = mysql_fetch_array($req)){
$nom = $data['nom'];
$tot = $data['SUM(tot_htva)'];
$pourcentage = avec_virgule ((($tot*100)/$total), 2);
?>
    <tr>
     <td class='<?php echo couleur_alternee (); ?>'><?php echo $nom; ?></td>
     <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo stat_baton_horizontal("$pourcentage %"); ?></td>
     <td class='<?php echo couleur_alternee (FALSE, "nombre"); ?>'><?php echo montant_financier($tot); ?></td>
    </tr>
<?php } ?>
    <tr> 
     <td class='totalmontant'>&nbsp;</td>
     <td class='totaltexte'><?php echo $lang_total; ?></td>
     <td class='totalmontant'><?php echo montant_financier ($total); ?></td>
    </tr>
   </table>
  </td>
 </tr>
 <tr>
  <td class="c texte0">
   <center>
    <img src="graph2_ca_client.php?annee_1=<?php echo $annee_1; ?>">
   </center>
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
