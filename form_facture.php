<?php
/*
 * Factux le facturier libre
 * Copyright (C) 2003-2005 Guy Hendrickx, 2017~ Thomas Ingles
 *
 * Licensed under the terms of the GNU  General Public License:
 * 		http://opensource.org/licenses/GPL-3.0
 *
 * For further information visit:
 * 		http://factux.free.fr
 *
 * File Name: form_facture.php
 * 	formulaire de création des factures
 *
 * * * * Version:  8.0.0
 * * * * Modified: 07/06/2025
 *
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
include_once(__DIR__ . "/include/headers.php");
include_once(__DIR__ . "/include/finhead.php");?>
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php
include_once(__DIR__ . "/include/head.php");
if ($user_fact == 'n') {
 echo sprintf('<h1>%s</h1>', $lang_facture_droit);
 include_once(__DIR__ . "/include/bas.php");
 exit;
}
if (isset($message)&&$message!='') {
 echo $message;
 $message='';#onlyHere
}

$rqSql = "SELECT num_client, nom FROM " . $tblpref ."client WHERE actif != 'non'";
if ($user_fact == 'r') {
$rqSql .= "
and (" . $tblpref ."client.permi LIKE '{$user_num},'
or  " . $tblpref ."client.permi LIKE '%,{$user_num},'
or  " . $tblpref ."client.permi LIKE '%,{$user_num},%'
or  " . $tblpref ."client.permi LIKE '{$user_num},%')
";
}
$mois = date("m");
$annee = date("Y");
$jour = date("d");
$acompte=isset($_POST['acompte'])?$_POST['acompte']:"";
$date_deb=isset($_POST['date_deb'])?$_POST['date_deb']:sprintf('1/%s/%s', $mois, $annee);
$date_fin=isset($_POST['date_fin'])?$_POST['date_fin']:sprintf('%s/%s/%s', $jour, $mois, $annee);
$date_fact=isset($_POST['date_fact'])?$_POST['date_fact']:sprintf('%s/%s/%s', $jour, $mois, $annee);
$coment=isset($_POST['coment'])?$_POST['coment']:"";

$num="";
if (isset($_POST['simuler'])) {
    $num=isset($client)?$client:"";
}
?>
   <form name="formu" method="post" action="fact.php">
    <table border='0' class='page' align='center'>
     <caption><?php echo $lang_facture_creer; ?></caption>
     <tr>
      <td class="texte0"> <?php echo $lang_client; ?></td>
      <td class="texte0">
<?php
if ($liste_cli!='y') {
$rqSql .= ' order by nom';
$result = mysql_query( $rqSql ) or die('Erreur SQL !<br>'.$rqSql.'<br>'.mysql_error());
?>
       <select name='listeclients'>
        <option value=""><?php echo $lang_choisissez; ?></option>
<?php
while ( $row = mysql_fetch_array( $result)) {
$numclient = $row["num_client"];
$nom = $row["nom"];
?>
        <option value='<?php echo $numclient; ?>'<?php echo ($num==$numclient)?" selected='selected'":''; ?>><?php echo $nom; ?></option>
<?php } ?>
       </select>
<?php }else{ include_once(__DIR__ . "/include/choix_cli.php");} ?>
      </td>
     </tr>
     <tr>
      <td class='<?php echo couleur_alternee (); ?>'><?php echo $lang_date_deb; ?></td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'>
       <input type="text" name="date_deb" value="<?php echo $date_deb; ?>" readonly="readonly"/>
       <a href="#" onClick=" window.open('include/pop.calendrier.php?frm=formu&amp;ch=date_deb','calendrier','width=460,height=170,scrollbars=0').focus();"><img src="image/petit_calendrier.gif" border="0" alt="calendrier"/></a>
      </td>
     </tr>
     <tr>
      <td class='<?php echo couleur_alternee (); ?>'><?php echo $lang_date_fin; ?></td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'><input type="text" name="date_fin" value="<?php echo $date_fin; ?>" readonly="readonly"/>
       <a href="#" onClick=" window.open('include/pop.calendrier.php?frm=formu&amp;ch=date_fin','calendrier','width=460,height=170,scrollbars=0').focus();"><img src="image/petit_calendrier.gif" border="0" alt="calendrier"/></a>
      </td>
     </tr>
     <tr>
      <td class='<?php echo couleur_alternee (); ?>'><?php echo $lang_facture_date; ?></td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'><input type="text" name="date_fact" value="<?php echo $date_fact; ?>" readonly="readonly"/>
       <a href="#" onClick=" window.open('include/pop.calendrier.php?frm=formu&amp;ch=date_fact','calendrier','width=460,height=170,scrollbars=0').focus();"><img src="image/petit_calendrier.gif" border="0" alt="calendrier"/></a>
      </td>
     </tr>
     <tr>
      <td class='<?php echo couleur_alternee (); ?>'><?php echo $lang_acompte; ?></td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'><input type="text" name="acompte" value="<?php echo $acompte; ?>"/><?php echo  $devise; ?></td>
     </tr>
     <tr>
      <th colspan="2"><?php echo $lang_ajo_fact ?></th>
     </tr>
     <tr>
      <td class="submit" colspan="2">
       <textarea name="coment" cols="45" rows="3"><?php echo $coment; ?></textarea><br>
       <input type="submit" name="Submit" value="<?php echo $lang_facture_creer_bouton; ?>">
       <input alt="<?php echo $lang_simu; ?>" type="checkbox" name="simuler" <?php echo (isset($_POST['simuler']))?' checked="checked"':'';?> />
      </td>
     </tr>
    </table>
   </form>
  </td>
 </tr>
 <tr>
  <td>
<?php
include_once(__DIR__ . "/lister_factures.php");
