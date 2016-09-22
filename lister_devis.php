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
 * File Name: lister_devis.php
 *  Liste les devis et permet de multiples actions
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
?>
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php
include_once("include/head.php");
if (isset($message)&&$message!='') { 
 echo $message;
}
if ($user_dev == 'n') {
    echo "<h1>$lang_devis_droit</h1>";
    exit;  
}
$sql = "
SELECT login, mail, num_dev, tot_htva, tot_tva, DATE_FORMAT(date,'%d/%m/%Y') AS date_aff, date, nom
FROM " . $tblpref ."devis 
LEFT JOIN " . $tblpref ."client on " . $tblpref ."devis.client_num = num_client
WHERE num_dev > 0 AND resu = '0'
";
if ($user_dev == 'r') { 
 $sql = "
  SELECT login, mail, num_dev, tot_htva, tot_tva, DATE_FORMAT(date,'%d/%m/%Y') AS date, nom
  FROM " . $tblpref ."devis 
  LEFT JOIN " . $tblpref ."client on " . $tblpref ."devis.client_num = num_client
  WHERE num_dev > 0 AND resu = '0' 
  and " . $tblpref ."client.permi LIKE '$user_num,' 
  or  " . $tblpref ."client.permi LIKE '%,$user_num,' 
  or  " . $tblpref ."client.permi LIKE '%,$user_num,%' 
  or  " . $tblpref ."client.permi LIKE '$user_num,%' 
  ";
};
if ( isset ( $_GET['ordre'] ) && $_GET['ordre'] != ''){
 $sql .= " ORDER BY " . $_GET['ordre'] . " DESC";
}else{
 $sql .= "ORDER BY num_dev DESC ";
}
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
?>
   <center>
    <table class='page boiteaction'>
     <caption><?php echo $lang_devis_liste; ?></caption>
     <tr>
      <th><a href="lister_devis.php?ordre=num_dev"><?php echo $lang_numero; ?></a></th>
      <th><a href="lister_devis.php?ordre=nom"><?php echo $lang_client; ?></a></th>
      <th><a href="lister_devis.php?ordre=date"><?php echo $lang_date; ?></a></th>
      <th><a href="lister_devis.php?ordre=tot_htva"><?php echo $lang_total_h_tva; ?></a></th>
      <th><a href="lister_devis.php?ordre=tot_tva"><?php echo $lang_total_ttc; ?></a></th>
      <th colspan="5"><?php echo $lang_action; ?></th>
      <th colspan='2'><?php echo $lang_ga_per; ?></th>
     </tr>
  <?php
$c=0;
while($data = mysql_fetch_array($req)){
 $num_dev = $data['num_dev'];
 $total = $data['tot_htva'];
 $tva = $data['tot_tva'];
 $date = $data['date_aff'];
 $nom = $data['nom'];
 $nom_html = urlencode($nom);
 $login = $data['login'];
 $mail = $data['mail'];
 $ttc = $total + $tva ; 
// $nom = $data['nom'];#htmlentities($data['nom'], ENT_QUOTES);
 if($c++ & 1){
  $line="0";
 }else{
  $line="1";
 }
?>
     <tr class="texte<?php echo $line; ?>" onmouseover="this.className='highlight'" onmouseout="this.className='texte<?php echo $line; ?>'">
      <td class='<?php echo couleur_alternee (); ?>'><?php echo $num_dev; ?></td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo $nom; ?></td>
      <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'><?php echo $date; ?></td>
      <td class='<?php echo couleur_alternee (FALSE,"nombre"); ?>'><?php echo montant_financier ($total); ?></td>
      <td class='<?php echo couleur_alternee (FALSE,"nombre"); ?>'><?php echo montant_financier ($ttc); ?></td>
      <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'>
       <a href="edit_devis.php?num_dev=<?php echo $num_dev; ?>&amp;nom=<?php echo $nom_html; ?>"> 
        <img src="image/edit.gif" align="middle" border="0" alt="<?php echo $lang_editer; ?>">
       </a>
      </td>
      <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'>
       <a href="delete_dev.php?num_dev=<?php echo $num_dev; ?>&amp;nom=<?php echo $nom_html; ?>" 
          onClick="return confirmDelete('<?php echo"$lang_eff_dev $num_dev ?"; ?>')">
        <img src="image/delete.jpg" align="middle" border="0" alt="<?php echo $lang_supprimer; ?>">
       </a>
      </td>
      <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'> 
       <form action="fpdf/devis_pdf.php" method="post" target="_blank">
        <input type="hidden" name="num_dev" value="<?php echo $num_dev; ?>" />
        <input type="hidden" name="nom" value="<?php echo $nom; ?>" />
        <input type="hidden" name="user" value="adm" />
        <input type="image" src="image/printer.gif" align="middle" style="border:none;margin:0;" alt="<?php echo $lang_imprimer; ?>" />
       </form>
      </td>
<?php if ($mail != '' and $login != '') { ?>
      <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'> 
       <a href="notifi_cli.php?type=devis&amp;mail=<?php echo $mail; ?>">
        <img src="image/mail.gif" align="middle" alt="mail" border="0"/>
       </a>
      </td>
<?php }else { ?>
      <td class='<?php echo couleur_alternee (FALSE); ?>'>&nbsp;</td>
<?php
}
if($mail != ''){ 
?>
      <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'>
       <form action="fpdf/devis_pdf.php" method="post" target="_blank">
        <input type="hidden" name="num_dev" value="<?php echo $num_dev; ?>" />
        <input type="hidden" name="nom" value="<?php echo $nom; ?>" />
        <input type="hidden" name="user" value="adm" />
        <input type="hidden" name="mail" value="y" />
        <input type="image" src="image/pdf.gif" align="middle" style="border:none;margin:0;" alt="<?php echo $lang_envoyer; ?>" />
       </form>
      </td>  
<?php }else{ ?>
      <td class='<?php echo couleur_alternee (FALSE); ?>'>&nbsp;</td>
<?php } ?> 
      <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'>
       <a href="convert.php?num_dev=<?php echo $num_dev; ?>"
          onClick="return confirmDelete('<?php echo"$lang_convert_dev $num_dev $lang_convert_dev2 "; ?>')">
        <img src="image/icon_lol.gif" alt="<?php echo $lang_devis_gagner; ?>" align="middle" border="0" >
       </a>
      </td>
      <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'>
       <a href="devis_non_commandes.php?num_dev=<?php echo $num_dev; ?>"
          onClick="return confirmDelete('<?php echo"$lang_dev_perd $num_dev $lang_dev_perd2 "; ?>')">
        <img src="image/icon_cry.gif" alt="<?php echo $lang_devis_perdre; ?>" align="middle" border="0" >
       </a>
      </td>
     </tr>
<?php }  ?>
     <tr><td colspan="12" class="td2"></td></tr>
    </table>
   </center>
  </td>
 </tr>
 <tr>
  <td>
<?php
$aide = $lang_devis;
include("help.php");
include_once("include/bas.php");
if(!strstr($_SERVER['SCRIPT_FILENAME'],__FILE__)){#autre qu'elle meme
 echo"\n  </td>\n </tr>\n</table>\n"; 
}
?>
 </td>
</tr>
</table>
</body>
</html>
