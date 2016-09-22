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
 * File Name: ca_clients_parmois.php
 * 	Editor configuration settings.
 * 
 * * * Version:  1.1.5
 * * * * Modified: 23/07/2005
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
include_once("include/headers.php");
include_once("include/finhead.php");
?>
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php 
include_once("include/head.php");
if ($user_stat== 'n') { 
  echo"<h1>$lang_statistique_droit</h1>";
  exit;  
}
$annee_1=isset($_POST['annee_1'])?$_POST['annee_1']:"";
$client=isset($_POST['client'])?$_POST['client']:"";
#include_once("form_stat_client_inc.php");
?>
<form name="form_bon" action="graph_ca_client.php" method="post">
 <center>
  <table class="page">
    <caption><?php echo $lang_statistiques_par_client; ?></caption>
    <tr>
      <td class="td2"><?php echo $lang_client; ?></td>
      <td colspan="2"class="td2"><?php echo $lang_annee; ?></td>
    </tr>
    <tr>
      <td>
        <select name="client">
          <option value="0"><?php echo $lang_choisissez; ?></option>
<?php
$rqSql ="SELECT num_client, nom FROM " . $tblpref ."client WHERE actif != 'non'ORDER BY nom"; 
$result = mysql_query( $rqSql ) or die('Erreur SQL !<br>'.$rqSql.'<br>'.mysql_error());
while ( $row = mysql_fetch_array( $result)) {
    $numclient = $row["num_client"];
    $nom = $row["nom"];
?>
          <option value='<?php echo $numclient; ?>'><?php echo $nom; ?> </option>
<?php } ?>
        </select>
      </td>
      <td><?php echo $lang_annee; ?></td>
      <td>
        <select name="annee_1">
<?php for ($i=date("Y");$i>=date("Y")-13;$i--){?>
         <option value="<?php echo$i; ?>"<?php echo ($i==$annee_1)?' selected="selected"':''; ?>><?php echo $i; ?></option>
<?php } ?>
        </select>
      </td>
    </tr>
    <tr>
      <td colspan="3">
        <input type="submit" name="Submit" value="<?php echo $lang_envoyer; ?>">
      </td>
    </tr>
  </table>
 </center>
</form>
  </td>
 </tr>
 <tr>
  <td>
<?php
if($client==0)
  goto fin;

$sql = "SELECT nom from " . $tblpref ."client WHERE num_client = $client";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
$client_nom = $data["nom"];
$calendrier = calendrier_local_mois ();

$sql = "
SELECT SUM(tot_htva) FROM " . $tblpref ."bon_comm 
LEFT JOIN " . $tblpref ."client on client_num = num_client 
WHERE YEAR(date) = $annee_1  
AND client_num = $client
";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
$total = $data['SUM(tot_htva)'];
?>
   <table class='page boiteaction'>
    <caption><?php echo "$lang_ca_htva $annee_1 $lang_client: $client_nom"; ?></caption>
     <tr>
      <th><?php echo $lang_mois; ?></th>
      <th width="380"><?php echo $lang_pourcentage; ?></th>
      <th><?php echo $lang_ca_htva; ?></th>
    </tr>
<?php
for ($i=1;$i<=12;$i++){
  $sql = "
  SELECT nom, SUM(tot_htva) FROM " . $tblpref ."bon_comm 
  LEFT JOIN " . $tblpref ."client on client_num = num_client 
  WHERE MONTH(date) = \"$i\" 
  AND YEAR(date) = $annee_1  
  AND client_num = $client";
  $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
  $data = mysql_fetch_array($req);
  $nom = $data['nom'];
  $tot = $data['SUM(tot_htva)'];
  $pourcentage = ($total)?round($tot / $total * 100,2):0;#Unwarning: Division by zero
?>
    <tr>
      <td class='<?php echo couleur_alternee (); ?>'><?php echo $calendrier [$i]; ?></td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo stat_baton_horizontal("$pourcentage%"); ?></td>  
      <td class='<?php echo couleur_alternee (FALSE,"nombre"); ?>'><?php echo montant_financier ($tot); ?></td>
    </tr>
<?php
}
?>
</table>
<?php
fin:
?>
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
