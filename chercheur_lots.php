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
 * File Name: chercheur_lots.php
 * 	resultat d'une recherche de lot
 * 
 * * * Version:  1.1.5
 * * * * Modified: 23/07/2005
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
include_once("include/headers.php");
?><script type="text/javascript" src="javascripts/confdel.js"></script><?php
include_once("include/finhead.php");
$num_lot=isset($_POST['num_lot'])?(int)$_POST['num_lot']:"";
if($num_lot==''){
  $num_lot=isset($_GET['num_lot'])?(int)$_GET['num_lot']:"";
}
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
if(!is_int($num_lot)){
  echo "<h1>*Erreur $lang_num_lot! Utiliser uniquement les chiffres.</h1>";
  $num_lot=-1;
}
#$mois = date("m");
#$annee = date("Y");
$sql = "
SELECT mail, login, num_client, num_bon, tot_htva, tot_tva, nom, fact,
DATE_FORMAT(date,'%d/%m/%Y') AS date,(tot_htva + tot_tva) as ttc
FROM " . $tblpref ."bon_comm 
LEFT JOIN " . $tblpref ."cont_bon on " . $tblpref ."bon_comm.num_bon = " . $tblpref ."cont_bon.bon_num
LEFT JOIN " . $tblpref ."client on " . $tblpref ."bon_comm.client_num = num_client  
WHERE `num_lot` = $num_lot
";

if ($user_com == 'r'){ 
$sql .= "
and " . $tblpref ."client.permi LIKE '$user_num,' 
or  " . $tblpref ."client.permi LIKE '%,$user_num,' 
or  " . $tblpref ."client.permi LIKE '%,$user_num,%' 
or  " . $tblpref ."client.permi LIKE '$user_num,%' 
";
}

$sql .= "
GROUP BY " . $tblpref ."bon_comm.`num_bon`
ORDER BY " . $tblpref ."bon_comm.`num_bon` DESC
";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$num_lot=($num_lot==-1)?'*':$lang_numero.$num_lot;
?>
  <center>
   <table class='page boiteaction'>
    <caption><?php echo "$lang_com_cont_lot $num_lot"; ?></caption>
     <tr> 
      <th><?php echo $lang_numero; ?></th>
      <th><?php echo $lang_client; ?></th>
      <th><?php echo $lang_date; ?></th>
      <th><?php echo $lang_total_h_tva; ?></th>
      <th><?php echo $lang_total_ttc; ?></th>
      <th colspan="5"><?php echo $lang_action; ?></th>
     </tr>
<?php
$c=0;
while($data = mysql_fetch_array($req)){
 $num_bon = $data['num_bon'];
 $total = $data['tot_htva'];
 $tva = $data['tot_tva'];
 $date = $data['date'];
 $nom = $data['nom'];
 $nom_html = htmlentities(urlencode ($nom)); 
 $num_client = $data['num_client'];
 $mail = $data['mail'];
 $login = $data['login'];
 $ttc = $data['ttc'];
 $fact = $data['fact'];
 $line=($c++ & 1)?0:1;
?>
    <tr class="texte<?php echo $line; ?>" onmouseover="this.className='highlight'" onmouseout="this.className='texte<?php echo $line; ?>'">
     <td class='<?php echo couleur_alternee (); ?>'><?php echo "$num_bon"; ?></td>
     <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo "$nom"; ?></td>
     <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'><?php echo "$date"; ?></td>
     <td class='<?php echo couleur_alternee (FALSE,"nombre"); ?>'><?php echo montant_financier($total); ?></td>
     <td class='<?php echo couleur_alternee (FALSE,"nombre"); ?>'><?php echo montant_financier($ttc); ?></td>
     <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'>
<?php if ($fact == "0") {?>
      <a href='edit_bon.php?num_bon=<?php echo "$num_bon"; ?>&amp;nom=<?php echo $nom_html; ?>'> 
       <img border="0" src="image/edit.gif" alt="<?php echo $lang_editer; ?>">
      </a>
<?php }else{ ?>
      <a href='edit_fact.php?num_fact=<?php echo $fact; ?>'>
       <img border="0" src="image/fact.gif" alt="<?php echo "$lang_editer $lang_facture $lang_numero $fact"; ?>">
      </a>
<?php } ?>
     </td>
     <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'>
<?php if ($fact == "0") {?>
      <a href='delete_bon.php?num_bon=<?php echo $num_bon; ?>&amp;nom=<?php echo $nom_html; ?>' 
         onClick="return confirmDelete('<?php echo $lang_con_effa.$num_bon; ?> ?')">
       <img border="0" src="image/delete.jpg" alt="<?php echo $lang_effacer; ?>">
      </a>
<?php }else{ ?>
       <!--<i alt="<?php echo $lang_err_efa_bon; ?>"><?php echo $fact; ?></i>-->
       <form action="fpdf/fact_pdf.php" method="post" target="_blank">
        <input type="hidden" name="client" value="<?php echo $num_client; ?>" />
        <input type="hidden" name="num" value="<?php echo $fact; ?>" />
        <input type="hidden" name="user" value="adm" />
        <input type="image" src="image/prinfer.gif" style="border:none;margin:0;" alt="<?php echo "$lang_imprimer $lang_facture $lang_numero $fact"; ?>" />
       </form>
 <?php } ?>
     </td>
     <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'>
       <form action="fpdf/bon_pdf.php" method="post" target="_blank">
       <input type="hidden" name="num_bon" value="<?php echo "$num_bon"; ?>" />
       <input type="hidden" name="nom" value="<?php echo "$nom_html"; ?>" />
       <input type="hidden" name="user" value="adm" />
       <input type="image" src="image/printer.gif" alt="<?php echo $lang_imprimer; ?>" />
      </form>
     </td>
     <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'>
<?php if ($mail != '' and $login !='') { ?>
      <a href='notifi_cli.php?type=comm&amp;mail=<?php echo"$mail"; ?>' 
         onClick="return confirmDelete('<?php echo $lang_con_env_notif.$num_bon; ?> ?')">
       <img src='image/mail.gif' border='0' alt='mail'>
      </a>
<?php }else{ ?><img src='image/spacer.gif' width='15' height='15' border='0' alt='space'><?php } ?>
     </td>
     <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'>
<?php if ($mail != '' ) {?>
      <form action="fpdf/bon_pdf.php" method="post" 
            onClick="return confirmDelete('<?php echo $lang_con_env_pdf.$num_bon; ?> ?')">
       <input type="hidden" name="num_bon" value="<?php echo $num_bon; ?>" />
       <input type="hidden" name="nom" value="<?php echo $nom; ?>" />
       <input type="hidden" name="user" value="adm" />
       <input type="hidden" name="ext" value=".pdf" />
       <input type="hidden" name="mail" value="y" />
       <input type="image" src="image/pdf.gif" alt="<?php echo $lang_env_par_mail; ?>" />
      </form>
<?php }else{ ?><img src='image/spacer.gif' width='15' height='15' border='0' alt='space'><?php } ?>
     </td> 
    </tr>
<?php }#fi while ?> 
    <tr><td colspan="10" class="td2"></td></tr>
   </table>
  </center>
  </td>
 </tr>
 <tr>
  <td>
<?php
$aide='admin';
include("help.php");
include_once("include/bas.php");
?>
  </td>
 </tr>
</table>
</body>
</html>
