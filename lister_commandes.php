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
 * File Name: lister_commandes.php
 * 	liste les commandes et permet de multiples actions
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
?> 
<table width="760" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php 
include_once("include/head.php");
if (isset($message)&&$message!='') { 
 echo $message; $message='';
}
if ($user_com == 'n') { 
 echo "<h1>$lang_commande_droit</h1>";
 exit;  
}
//pour le formulaire
$mois_1=isset($_GET['mois_1'])?$_GET['mois_1']:date("m");
$annee_1=isset($_GET['annee_1'])?$_GET['annee_1']:date("Y");
$whr = ($annee_1==$lang_toutes)?'':"WHERE YEAR(date) = $annee_1";#si année choisie
$aw = (($annee_1==$lang_toutes&&$mois_1!=$lang_tous))?'WHERE':' AND';#si toutes années et mois choisi #idée GROUP BY DAY(date)
$whr .= ($mois_1==$lang_tous)?'':"$aw MONTH(date) = $mois_1";#si année entiere

//$whr=(isset($_GET['tout'])?"":"WHERE MONTH(date) = $mois_1 AND Year(date)=$annee_1 ");
$calendrier = calendrier_local_mois ();
$sql = "
SELECT mail, login, num_client, num_bon, tot_htva, tot_tva, nom, fact, date,
DATE_FORMAT(date,'%d/%m/%Y') AS date_aff,(tot_htva + tot_tva) as ttc
FROM " . $tblpref ."bon_comm 
LEFT JOIN " . $tblpref ."client on " . $tblpref ."bon_comm.client_num = num_client 
$whr
";

if ($user_com == 'r'){ 
$sql .= "
and " . $tblpref ."client.permi LIKE '$user_num,' 
or  " . $tblpref ."client.permi LIKE '%,$user_num,' 
or  " . $tblpref ."client.permi LIKE '%,$user_num,%' 
or  " . $tblpref ."client.permi LIKE '$user_num,%' 
";
}

if ( isset ( $_GET['ordre'] ) && $_GET['ordre'] != ''){
 $sql .= " ORDER BY " . $_GET['ordre'] . " DESC";
}else{
 $sql .= " ORDER BY num_bon DESC ";
}
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
?>
   <center>
    <form action="lister_commandes.php" method="get">
     <table border='0' class='page' align='center'>
      <caption><?php echo $lang_commandes_lister; ?></caption>
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
  <table class='page boiteaction'>
   <caption><?php naviguer("lister_commandes.php?ordre=".@$_GET['ordre'],$mois_1,$annee_1,$lang_commandes_liste); ?></caption>
    <tr> 
     <th><a href="lister_commandes.php?ordre=num_bon&amp;mois_1=<?php echo $mois_1; ?>&amp;annee_1=<?php echo $annee_1; ?>"><?php echo $lang_numero; ?></a></th>
     <th><a href="lister_commandes.php?ordre=nom&amp;mois_1=<?php echo $mois_1; ?>&amp;annee_1=<?php echo $annee_1; ?>"><?php echo $lang_client; ?></a></th>
     <th><a href="lister_commandes.php?ordre=date&amp;mois_1=<?php echo $mois_1; ?>&amp;annee_1=<?php echo $annee_1; ?>"><?php echo $lang_date; ?></a></th>
     <th><a href="lister_commandes.php?ordre=tot_htva&amp;mois_1=<?php echo $mois_1; ?>&amp;annee_1=<?php echo $annee_1; ?>"><?php echo $lang_total_h_tva; ?></a></th>
     <th><a href="lister_commandes.php?ordre=ttc&amp;mois_1=<?php echo $mois_1; ?>&amp;annee_1=<?php echo $annee_1; ?>"><?php echo $lang_total_ttc; ?></a></th>
     <th colspan="5"><?php echo $lang_action; ?></th>
    </tr>
<?php
$c=0;
while($data = mysql_fetch_array($req)){
 $num_bon = $data['num_bon'];
 $total = $data['tot_htva'];
 $tva = $data['tot_tva'];
 $date = $data['date_aff'];
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
<?php } ?> 
    <tr><td colspan="10" class="td2"></td></tr>
   </table>
  </td>
 </tr>
 <tr>
  <td>
<?php
$aide='bon';
include("help.php");
include_once("include/bas.php");
?>
  </table>
<?php
$file = basename($_SERVER['PHP_SELF']); 
if ($file!=basename(__FILE__)){#($file=="form_commande.php" or $file=="login.php".....) 
echo"</table>";  
}
?>
</body>
</html>


