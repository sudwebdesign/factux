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
 * File Name: bon.php
 *  Editor configuration settings.
 *
 * * * Version:  5.0.1
 * * * * Modified: 10/06/2017
 *
 * File Authors:
 *   Guy Hendrickx
 *.
 */
include_once(__DIR__ . "/include/headers.php");
include_once(__DIR__ . "/include/finhead.php");
?>
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php
$client=isset($_POST['listeclients'])?$_POST['listeclients']:"";
$date=isset($_POST['date'])?$_POST['date']:"";
if($client=='0'||$client==''){# '' si select client vide (aucun client enregisté)
 $message=sprintf('<h1>%s</h1>', $lang_choix_client);
 include(__DIR__ . '/form_commande.php');
 exit;
}
list($jour, $mois,$annee) = preg_split('/\//', $date, 3);

$sql_nom = "SELECT  nom, nom2 FROM " . $tblpref .('client WHERE num_client = ' . $client);
$req = mysql_query($sql_nom) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_array($req)){
 $nom = $data['nom'];
 $nom2 = $data['nom2'];
}
$sql1 = "INSERT INTO " . $tblpref .sprintf("bon_comm(client_num, date) VALUES ('%s', '%s-%s-%s')", $client, $annee, $mois, $jour);
mysql_query($sql1) || die('Erreur SQL !<br>'.$sql1.'<br>'.mysql_error());
$num_bon = mysql_insert_id();//le numero de bon créé
?>
   <center>
    <form name="formu2" method="post" action="edit_bon_suite.php">
     <table width="760" border="0" class="page" align="center" class="boiteaction">
      <caption><?php echo sprintf('%s %s %s %s %s', $lang_donne_bon, $lang_numero, $num_bon, $lang_de, $nom); ?></caption>
      <tr>
       <td class="texte0"><?php echo $lang_article; ?></td>
       <td class="texte0">
<?php include(__DIR__ . "/include/article_choix.php"); ?>
      </td>
<?php if ($lot=='y') { ?>
       <td class="texte0"><?php echo $lang_lot; ?></td>
<?php
$rqSql = "SELECT num, prod FROM " . $tblpref ."lot WHERE actif != 'non' ORDER BY num";
$result = mysql_query( $rqSql ) or die('Erreur SQL !<br>'.$rqSql.'<br>'.mysql_error());
?>
       <td class="texte0">
        <select name="lot">
         <option value=''><?php echo $lang_choisissez; ?></option>
<?php
while ($row = mysql_fetch_array($result)) {
 $num = $row["num"];
 $prod = $row["prod"];
?>
         <option value='<?php echo $num; ?>'><?php echo sprintf('%s %s ', $num, $prod); ?></option>
<?php } ?>
       </select>
       </td>
<?php } ?>
      </tr>
      <tr>
       <td class="texte0"><?php echo $lang_quanti; ?> </td>
       <td class="texte0" colspan="3"><input name="quanti" type="text" id="quanti" size="6"></td>
      </tr>
      <tr>
       <td class="texte0"><?php echo $lang_remise; ?> </td>
       <td class="texte0" colspan="3"><input name="remise" type="text" id="remise" size="6">%</td>
      </tr>
      <tr>
       <td class="submit" colspan="4">
        <input name="nom" type="hidden" id="nom" value="<?php echo $nom ?>">
        <input type="submit" name="Submit" value="<?php echo $lang_valid; ?>">
       </td>
      </tr>
     </table>
     <input name="num_bon" type="hidden" value='<?php echo $num_bon; ?>'>
    </form>
   </center>
  </td>
 </tr>
 <tr>
  <td>
<?php
$aide='bon';
include(__DIR__ . "/help.php");
include_once(__DIR__ . "/include/bas.php");
?>
  </td>
 </tr>
</table>
</body>
</html>
