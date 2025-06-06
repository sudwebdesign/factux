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
 * File Name: form_multi_facture.php
 * 	formulaire de création des factures
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
?>
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php
include_once("include/head.php");
if ($user_fact == 'n') {
 echo "<h1>$lang_facture_droit</h1>";
 include_once("include/bas.php");
 exit;
}
if (isset($message)&&$message!='') {
 echo $message;
}
$mois = date("m");
$annee = date("Y");
$jour = date("d");
$rqSql = "SELECT num_client, nom FROM " . $tblpref ."client WHERE actif != 'non'";
if ($user_fact == 'r') {
$rqSql .= "
 and " . $tblpref ."client.permi LIKE '$user_num,'
 or  " . $tblpref ."client.permi LIKE '%,$user_num,'
 or  " . $tblpref ."client.permi LIKE '%,$user_num,%'
 or  " . $tblpref ."client.permi LIKE '$user_num,%'
";
}
$rqSql .= " ORDER BY nom";
$result = mysql_query( $rqSql ) or die('Erreur SQL !<br>'.$rqSql.'<br>'.mysql_error());
?>
   <form name="form_facture" method="post" action="fact_multi.php">
    <table border='0' class='page' align='center'>
     <caption><?php echo $lang_facture_creer; ?></caption>
     <tr>
      <td class="texte0"><?php echo $lang_clients; ?></td>
      <td class="texte0" >
       <select multiple name='client[]' size="10">
<?php
while ( $row = mysql_fetch_array( $result)) {
 $numclient = $row["num_client"];
 $nom = $row["nom"];
?>
        <option value='<?php echo $numclient; ?>'><?php echo $nom; ?></option>
<?php } ?>
       </select>
      </td>
     </tr>
     <tr>
      <td class='<?php echo couleur_alternee (FALSE); ?>'>&nbsp;</td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo $lang_multi_select_ctrl; ?></td>
     </tr>
     <tr>
      <td class='<?php echo couleur_alternee (); ?>'><?php echo $lang_date_deb; ?></td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'>
       <input type="text" name="date_deb" value="<?php echo "1/$mois/$annee" ?>" readonly="readonly"/>
       <a href="#" onClick=" window.open('include/pop.calendrier.php?frm=form_facture&amp;ch=date_deb','calendrier','width=460,height=170,scrollbars=0').focus();">
        <img src="image/petit_calendrier.gif" alt="calendrier" border="0"/>
       </a>
      </td>
     </tr>
     <tr>
      <td class='<?php echo couleur_alternee (); ?>'><?php echo $lang_date_fin; ?></td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'>
       <input type="text" name="date_fin" value="<?php echo "$jour/$mois/$annee" ?>" readonly="readonly"/>
       <a href="#" onClick=" window.open('include/pop.calendrier.php?frm=form_facture&amp;ch=date_fin','calendrier','width=460,height=170,scrollbars=0').focus();">
        <img src="image/petit_calendrier.gif" alt="calendrier" border="0"/>
       </a>
      </td>
     </tr>
     <tr>
      <td class='<?php echo couleur_alternee (); ?>'><?php echo $lang_facture_date; ?></td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'>
       <input type="text" name="date_fact" value="<?php echo "$jour/$mois/$annee" ?>" readonly="readonly"/>
       <a href="#" onClick=" window.open('include/pop.calendrier.php?frm=form_facture&amp;ch=date_fact','calendrier','width=460,height=170,scrollbars=0').focus();">
        <img src="image/petit_calendrier.gif" alt="calendier" border="0"/>
       </a>
      </td>
     </tr>
     <tr>
      <td class='<?php echo couleur_alternee (); ?>'><?php echo $lang_acompte; ?></td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'><input type="text" name="acompte" value="" /><?php echo  $devise; ?></td>
     </tr>
     <tr>
      <th colspan="2" ><?php echo $lang_ajo_fact ?></th>
     </tr>
     <tr>
      <td class="submit" colspan="2">
       <textarea name="coment" cols="45" rows="3"></textarea>
       <br />
       <input type="submit" name="Submit" value="<?php echo $lang_facture_creer_bouton; ?>">
      </td>
     </tr>
    </table>
   </form>
  </td>
 </tr>
 <tr>
  <td>
<?php
$aide = 'factures';
include("help.php");
include_once("include/bas.php");
?>
  </td>
 </tr>
</table>
</body>
</html>
