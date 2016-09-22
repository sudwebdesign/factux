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
 * File Name: lister_factures.php
 *  
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
if ($user_fact == 'n') { 
 echo "<h1>$lang_facture_droit</h1>";
 exit;
}
//pour le formulaire
$mois_1=isset($_GET['mois_1'])?$_GET['mois_1']:date("m");
$annee_1=isset($_GET['annee_1'])?$_GET['annee_1']:date("Y");
$ands = ($annee_1==$lang_toutes)?'':" AND YEAR(date_fact) = $annee_1";#si année choisie
$ands .= ($mois_1==$lang_tous)?'':" AND MONTH(date_fact) = $mois_1";#si année entiere
$calendrier = calendrier_local_mois ();

$sql = "
SELECT mail, login, date_fact, 
DATE_FORMAT(date_fact,'%d/%m/%Y') AS date_aff,
DATE_FORMAT(date_pay,'%d/%m/%Y') AS date_reglee,
total_fact_ttc, payement, num_client, date_deb, 
DATE_FORMAT(date_deb,'%d/%m/%Y') AS date_deb2, date_fin,
DATE_FORMAT(date_fin,'%d/%m/%Y') AS date_fin2, num, nom,
TO_DAYS(NOW()) - TO_DAYS(date_fact) AS peri
FROM " . $tblpref ."facture 
LEFT JOIN " . $tblpref ."client on client = num_client
WHERE num >0".$ands;
//ORDER BY 'num' DESC

if ($user_fact == 'r') { 
$sql .= "
and " . $tblpref ."client.permi LIKE '$user_num,' 
or  " . $tblpref ."client.permi LIKE '%,$user_num,' 
or  " . $tblpref ."client.permi LIKE '%,$user_num,%' 
or  " . $tblpref ."client.permi LIKE '$user_num,%' 
";  
//ORDER BY 'num' DESC
}
if ( isset ( $_GET['ordre'] ) && $_GET['ordre'] != ''){
 $sql .= " ORDER BY " . $_GET['ordre'] . " DESC ";
}else{
 $sql .= " ORDER BY num DESC ";
}
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
?>
   <center>
    <form action="lister_factures.php" method="get">
     <table class="page">
      <caption><?php echo $lang_facture_lister; ?></caption>
      <tr>
       <td class="texte0"><?php echo $lang_mois; ?></td>
       <td class="texte0">
        <select name="mois_1">
         <option value="<?php echo $lang_tous; ?>"<?php echo ($lang_tous==$mois_1)?' selected="selected"':''; ?>><?php echo ucfirst($lang_tous); ?></option>
<?php for ($i=1;$i<=12;$i++){?>
         <option value="<?php echo $i; ?>"<?php echo ($i==$mois_1)?' selected="selected"':''; ?>><?php echo ucfirst($calendrier [$i]); ?></option>
<?php } ?>
        </select>
       </td>
       <td class="texte0"><?php echo $lang_annee; ?></td>
       <td class="texte0">
 	      <select name="annee_1">
         <option value="<?php echo $lang_toutes; ?>"<?php echo ('tout'==$annee_1)?' selected="selected"':''; ?>><?php echo ucfirst($lang_toutes); ?></option>
<?php for ($i=date("Y");$i>=date("Y")-13;$i--){?>
        <option value="<?php echo$i; ?>"<?php echo ($i==$annee_1)?' selected="selected"':''; ?>><?php echo $i; ?></option>
<?php } ?>
        </select>
       </td>
      </tr>
      <tr>
       <td class="submit" colspan="4">
        <input type="submit" value='<?php echo $lang_lister; ?>'>
       </td>
      </tr>        
     </table>
    </form>
   </center>
  <br>
  <center>
   <table class='page boiteaction'>
    <caption><?php naviguer("lister_factures.php?ordre=".@$_GET['ordre'],$mois_1,$annee_1,$lang_tou_fact); ?></caption>
    <tr> 
     <th><a href="lister_factures.php?ordre=num&amp;mois_1=<?php echo $mois_1; ?>&amp;annee_1=<?php echo $annee_1; ?>"><?php echo $lang_numero; ?></a></th>
     <th><a href="lister_factures.php?ordre=nom&amp;mois_1=<?php echo $mois_1; ?>&amp;annee_1=<?php echo $annee_1; ?>"><?php echo $lang_client; ?></a></th>
     <th><a href="lister_factures.php?ordre=date_fact&amp;mois_1=<?php echo $mois_1; ?>&amp;annee_1=<?php echo $annee_1; ?>"><?php echo $lang_date; ?></a></th>
     <th><a href="lister_factures.php?ordre=total_fact_ttc&amp;mois_1=<?php echo $mois_1; ?>&amp;annee_1=<?php echo $annee_1; ?>"><?php echo $lang_tot_ttc; ?></a></th>
     <th><a href="lister_factures.php?ordre=payement&amp;mois_1=<?php echo $mois_1; ?>&amp;annee_1=<?php echo $annee_1; ?>"><?php echo $lang_pay; ?></a></th>
     <th colspan="4"><?php echo $lang_action; ?></th>
    </tr>
<?php
$c=0;
while($data = mysql_fetch_array($req)){
 if($data['payement']=="Irrecouvrable")
  continue;
 $client = $data['nom'];
 #$client = htmlentities($client, ENT_QUOTES);
 $debut = $data['date_deb2'];
 $debut2 = $data['date_deb'];
 $fin = $data['date_fin2'];
 $fin2 = $data['date_fin'];
 $num = $data['num'];
 $num_client =$data['num_client'];
 $peri = $data['peri'];
 $total = $data['total_fact_ttc'];
 $date_fact = $data['date_aff'];
 $date_reglee = $data['date_reglee'];
 $mail = $data['mail'];
 $login = $data['login'];
 $pay = $data['payement'];
 switch ($pay) {
  case "carte":$pay="<b alt='$lang_le $date_reglee'>$lang_carte_ban</b>";break;
  case "Especes":$pay="<b alt='$lang_le $date_reglee'>$lang_liquide</b>";break;
  case "ok":$pay="<b alt='$lang_le $date_reglee'>$lang_pay_ok</b>";break;
  case "Cheque":$pay="<b alt='$lang_le $date_reglee'>$lang_paypal</b>";break;
  case "virement":$pay="<b alt='$lang_le $date_reglee'>$lang_virement</b>";break;
  case "visa":$pay="<b alt='$lang_le $date_reglee'>$lang_visa</b>";break;
  case "non":$pay="<a href='lister_factures_non_reglees.php?num=$num' alt='$lang_regler'".(($peri>=$echeance_fact)?' style="color:red;"':'').">$lang_non_pay</a>";break;
 }
 $line=($c++ & 1)?0:1;
?>
     <tr class="texte<?php echo $line; ?>" onmouseover="this.className='highlight'" onmouseout="this.className='texte<?php echo $line; ?>'">
      <td class='<?php echo couleur_alternee (); ?>'><?php echo $num; ?></td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo $client; ?></td>
      <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'><?php echo $date_fact; ?></td>
      <td class='<?php echo couleur_alternee (FALSE,"nombre"); ?>'><?php echo montant_financier($total); ?></td>
      <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'><?php echo $pay; ?></td> 
      <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'>
       <a href="edit_fact.php?num_fact=<?php echo"$num"; ?>">
        <img src="image/fact.gif" border="0" alt="<?php echo $lang_editer; ?>">
       </a>
      </td>
      <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'>
       <form action="fpdf/fact_pdf.php" method="post" target="_blank">
        <input type="hidden" name="client" value="<?php echo $num_client; ?>" />
        <input type="hidden" name="debut" value="<?php echo $debut2; ?>" />
        <input type="hidden" name="fin" value="<?php echo $fin2; ?>" />
        <input type="hidden" name="num" value="<?php echo $num; ?>" />
        <input type="hidden" name="user" value="adm" />
        <input type="image" src="image/prinfer.gif" style="border:none;margin:0;" alt="<?php echo $lang_imprimer; ?>" />
       </form>
      </td>
<?php if ($mail != '' and $login != '') { ?>
      <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'>
       <a href='notifi_cli.php?type=fact&amp;mail=<?php echo "$mail"; ?>'>
        <img src='image/mail.gif' alt='mail' border='0' 
             onClick="return confirmDelete('<?php echo"$lang_conf_notif $client $lang_conf_notif2 $num ?"; ?>')">
       </a>
      </td>
<?php }else { ?>
       <td class='<?php echo couleur_alternee (FALSE); ?>'>&nbsp;</td>
<?php }
if ($mail != '') {
?>
      <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'>
       <form action="fpdf/fact_pdf.php" method="post" onClick="return confirmDelete('<?php echo"$lang_conf_env $num $lang_conf_env2 $client ?"; ?>')">
        <input type="hidden" name="client" value="<?php echo $num_client ?>" />
        <input type="hidden" name="debut" value="<?php echo $debut2 ?>" />
        <input type="hidden" name="fin" value="<?php echo $fin2 ?>" />
        <input type="hidden" name="num" value="<?php echo $num ?>" /> 
        <input type="hidden" name="user" value="adm" />
        <input type="hidden" name="mail" value="y" />
        <input type="image" src="image/pdf.gif" style="border:none;margin:0;" alt="<?php echo $lang_env_par_mail ?>" />
       </form>
      </td>
<?php }else{ ?>
      <td class='<?php echo couleur_alternee (FALSE); ?>'>&nbsp;</td>
<?php } ?>
     </tr>
<?php }#fi while ?>
     <tr><td colspan="11" class="td2"></td></tr>
    </table>
   </center>
  </td>
 </tr>
 <tr>
  <td>
<?php
$aide="factures";
include("help.php");
include_once("include/bas.php");
if(basename($_SERVER['SCRIPT_FILENAME'])!=basename(__FILE__)){#autre qu'elle meme
?>
     </td>
    </tr>
   </table>
<?php } ?>
  </td>
 </tr>
</table>
</body>
</html>
