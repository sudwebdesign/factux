<?php
/*
 * Factux le facturier libre
 * Copyright (C) 2003-2005 Guy Hendrickx, 2017~ Thomas Ingles
 *
 * Licensed under the terms of the GNU  General Public License:
 *     http://opensource.org/licenses/GPL-3.0
 *
 * For further information visit:
 *     http://factux.free.fr
 *
 * File Name: fckconfig.js
 *   Editor configuration settings.
 *
 * * * * Version:  8.0.0
 * * * * Modified: 07/06/2025
 *
 * File Authors:
 *     Guy Hendrickx
 *.
 */
include_once(__DIR__ . "/include/headers.php");
include_once(__DIR__ . "/include/finhead.php");
$client=isset($_POST['listeclients'])?$_POST['listeclients']:"";
$date=isset($_POST['date'])?$_POST['date']:"";
if($client=='0'||$client==''){# '' si select client vide (aucun client enregisté)
 $message = sprintf('<h1>%s</h1>', $lang_choix_client);
 include(__DIR__ . '/form_devis.php');
 exit;
}
list($jour, $mois,$annee) = preg_split('/\//', $date, 3);
?>
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php
$sql_nom = "SELECT nom, nom2 FROM " . $tblpref .('client WHERE num_client = ' . $client);
$req = mysql_query($sql_nom) or die('Erreur SQL !<br>'.$sql_nom.'<br>'.mysql_error());
while($data = mysql_fetch_array($req)){
  $nom = $data['nom'];
#  $nom = htmlentities($nom, ENT_QUOTES);
  $nom2 = $data['nom2'];
  $phrase = $lang_bon_cree;
  $message = sprintf('%s %s %s %s %s', $phrase, $nom, $nom2, $lang_bon_cree2, $date);
}

$sql1 = "INSERT INTO " . $tblpref .sprintf("devis(client_num, date) VALUES ('%s', '%s-%s-%s')", $client, $annee, $mois, $jour);
mysql_query($sql1) || die('Erreur SQL !<br>'.$sql1.'<br>'.mysql_error());
$num_dev = mysql_insert_id();//le numero du devis créé
?>
  <form name='formu2' method='post' action='edit_devis_suite.php'>
   <center>
    <table class="page boiteaction">
      <caption><?php echo sprintf('%s %s %s %s %s', $lang_donne_devis, $lang_numero, $num_dev, $lang_de, $nom); ?></caption>
      <tr>
       <td class="texte0"><?php echo $lang_article; ?></td>
       <td class="texte0">
<?php include(__DIR__ . "/include/article_choix.php"); ?>
       </td>
      </tr>
      <tr>
       <td class="texte0"><?php echo $lang_quanti; ?></td>
       <td class="texte0"><input name='quanti' type='text' id='quanti' size='6'></td>
      </tr>
      <tr>
       <td class="texte0"><?php echo $lang_remise; ?></td>
       <td class="texte0"><input name="remise" type="text" id="remise" size="6">%</td>
      </tr>
      <tr>
       <td class="submit" colspan="2"><input type="submit" name="Submit" value='<?php echo $lang_valid; ?>'></td>
      </tr>
     </table>
     <input name="nom" type="hidden" id="nom" value='<?php echo $nom; ?>'>
     <input type="hidden" name="num_dev" value="<?php echo $num_dev; ?>" />
    </center>
   </form>
  </td>
 </tr>
 <tr>
  <td>
<?php
$aide='devis';
include(__DIR__ . "/help.php");
include_once(__DIR__ . "/include/bas.php");
?>
  </td>
 </tr>
</table>
</body>
</html>
