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
 * File Name: lister_factures_non_reglees.php
 * 	liste les facture non reglées et permet de changer leur status de payement
 * 
 * * * Version:  5.0.0
 * * * * Modified: 07/10/2016
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
include_once("include/headers.php");
?>
<script type="text/javascript" src="javascripts/confdel.js"></script>
<script type="text/javascript">
<!--
function isDate(v) {
 var d = new Date(v);
 return !isNaN(d.valueOf());
}
function regler_fact(message,date_fr){
 var r = prompt(message,date_fr);
 if (isDate(r)){
  var e = r.split('/');
  j = e[0];
  m = e[1];
  a = e[2];
  return a+'-'+m+'-'+j;//anglaise4bdd
 }else
  return false;
}
//-->
</script>
<?php
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
if(isset($message)&&$message!='') {
 echo $message;
}
$this_fact=isset($_GET['num'])?"AND num=$_GET[num]":'';
$fact_irre=isset($_GET['ir'])?"OR payement = 'Irrecouvrable'":'';
$fact_uri=isset($_GET['ir'])?"&amp;ir":'';
$sql = "
SELECT TO_DAYS(NOW()) - TO_DAYS(date_fact) AS peri, client,r1, r2, r3,  date_deb, date_fin,
total_fact_ttc, payement, num, nom, nom2, DATE_FORMAT(date_fact,'%d/%m/%Y') AS date_aff, date_fact
FROM " . $tblpref ."facture 
LEFT JOIN " . $tblpref ."client on " . $tblpref ."facture.client = " . $tblpref ."client.num_client
WHERE payement = 'non'
$fact_irre
$this_fact
";
if ($user_fact == 'r') {
 $sql .= "
  and " . $tblpref ."client.permi LIKE '$user_num,' 
  or  " . $tblpref ."client.permi LIKE '%,$user_num,' 
  or  " . $tblpref ."client.permi LIKE '%,$user_num,%' 
  or  " . $tblpref ."client.permi LIKE '$user_num,%'
";  
}
$drdre='';
if ( isset ( $_GET['ordre'] ) && $_GET['ordre'] != ''){
 $sql .= " ORDER BY " . $_GET['ordre'] . " DESC";
 $drdre=$_GET['ordre'];
}
else{
 $sql .= " ORDER BY num DESC";
}

$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
?>
   <table class='page boiteaction'>
    <caption><?php echo $lang_factures_non_reglees; ?></caption>
    <tr> 
     <th><a href="lister_factures_non_reglees.php?ordre=num<?php echo $fact_uri; ?>"><?php echo $lang_numero; ?></a></th>
     <th><a href="lister_factures_non_reglees.php?ordre=nom<?php echo $fact_uri; ?>"><?php echo $lang_client; ?></a></th>
     <th><a href="lister_factures_non_reglees.php?ordre=date_fact<?php echo $fact_uri; ?>"><?php echo $lang_date; ?></a></th>
     <th><a href="lister_factures_non_reglees.php?ordre=total_fact_ttc<?php echo $fact_uri; ?>"><?php echo $lang_total_ttc; ?></a></th>
     <th><a href="lister_factures_non_reglees.php?ordre=peri<?php echo $fact_uri; ?>"><?php echo $lang_depuis; ?></a></th>
     <th><?php echo $lang_regler; ?></th>
     <th><?php echo $lang_voir; ?></th>
     <th><a href="lister_factures_non_reglees.php?ordre=r1<?php echo $fact_uri; ?>"><?php echo $lang_rappel; ?>&nbsp;1</a></th>
     <th><a href="lister_factures_non_reglees.php?ordre=r2<?php echo $fact_uri; ?>"><?php echo $lang_rappel; ?>&nbsp;2</a></th>
     <th><a href="lister_factures_non_reglees.php?ordre=r3<?php echo $fact_uri; ?>"><?php echo $lang_rappel; ?>&nbsp;3</a></th>
    </tr>
<?php
$date_pay = date("d/m/Y");;
$c=0;
while($data = mysql_fetch_array($req)){
 $num = $data['num'];
 $total = $data['total_fact_ttc'];
 $nom = $data['nom'];
 $nom2 = $data['nom2'];
 $date = $data['date_aff'];
 $debut = $data['date_deb'];
 $fin = $data['date_fin'];
 $num_client = $data['client'];
 $peri = $data['peri'];
 $pay = $data['payement'];
 for ($i=1;$i<=3;$i++)
  $r[$i] = ($data['r'.$i]=='non')?$lang_non:$data['r'.$i];
 if($c++ & 1){
  $line="0";
 }else{
  $line="1";
 }
?>
     <tr class="texte<?php echo $line; ?>" onmouseover="this.className='highlight'" onmouseout="this.className='texte<?php echo $line; ?>'">
      <td class='<?php echo couleur_alternee (); ?>'><?php echo $num; ?></td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo $nom; ?></td>
      <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'><?php echo $date; ?></td>
      <td class='<?php echo couleur_alternee (FALSE,"nombre"); ?>'><?php echo montant_financier($total); ?></td>
      <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'><a href='rapel.php?client=<?php echo $num_client; ?>'<?php echo ($peri>=$echeance_fact)?' style="color:red;"':''; ?> alt="<?php echo $lang_rappel; ?>"><?php echo "$peri $lang_jours"; ?></a></td>
      <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'>
<?php if($use_payement =='y'){ ?>
       <form action="payement_suite.php" id="payement<?php echo $num;?>" method="post" name="payement<?php echo "$num";?>">
        <select name="methode" 
                onchange="
                if(this.value != -1){
                 if(dr = regler_fact('<?php echo $lang_conf_carte_reg; ?>'
                 + forms['payement<?php echo $num; ?>'].elements['num'].value 
                 +' <?php echo $lang_par; ?> '+ this.value + ' <?php echo $lang_bon_cree2; ?>', 
                 forms['payement<?php echo $num; ?>'].elements['date_pay'].value)){
                  forms['payement<?php echo $num; ?>'].elements['date_pay'].value = dr;
                  forms['payement<?php echo $num; ?>'].submit();
                 }else{return false}}">
          <option value="-1"><?php echo $lang_mode_paiement; ?></option>
          <option value="Especes"><?php echo $lang_liquide; ?></option>
          <option value="Cheque"><?php echo $lang_paypal; ?></option>
          <option value="virement"><?php echo $lang_virement; ?></option>
          <option value="carte"><?php echo $lang_carte_ban; ?></option>
          <option value="visa"><?php echo $lang_visa; ?></option>
          <option value="Irrecouvrable"<?php echo ($pay!='non')?' selected="selected"':''; ?>><?php echo $lang_irrecouvrable; ?></option>
        </select>
        <input type="hidden" name="num" value="<?php echo $num; ?>" />
        <input type="hidden" name="date_pay" value="<?php echo $date_pay; ?>" />
        <input type="submit" name="envoi" style="display: none" />
       </form>
<?php }else{ ?>
       <a href='payement_suite.php?num_fact=<?php echo $num; ?>' 
          onClick="return confirmDelete('<?php echo "$lang_regler_fact $num $lang_regler_fact2"; ?>')"><img border='0' src='image/ok.jpg' alt='<?php echo $lang_regler; ?>'></a> <?php
 if($pay!='non'){#irrécouvrables
       ?><img border='0' src='image/non.gif' width='16' alt='<?php echo $lang_irrecouvrable; ?>'>
<?php }else{ 
       ?><a href='payement_suite.php?num_fact=<?php echo $num; ?>&amp;ir' 
            onClick="return confirmDelete('<?php echo "$lang_conf_carte_reg $num $lang_par $lang_irrecouvrable"; ?>')" ><img border='0' src='image/icon_cry.gif' alt='<?php echo $lang_irrecouvrable; ?>?'></a>
<?php
 }/*#irrécouvrables (dsl pour les places des 2 ? >. Ça evite un trait noir disgracieu entre les 2 icones???)*/
} 
?>
      </td>
      <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'>
       <form action="fpdf/fact_pdf.php" method="post" target="_blank" >
        <input type="hidden" name="client" value="<?php echo $num_client ?>" />
        <input type="hidden" name="debut" value="<?php echo $debut ?>" />
        <input type="hidden" name="fin" value="<?php echo $fin ?>" />
        <input type="hidden" name="num" value="<?php echo $num ?>" />
        <input type="hidden" name="user" value="adm" />
        <input type="image" src="image/prinfer.gif" style=" border: none; margin: 0;" alt="<?php echo $lang_imprimer; ?>" />
       </form>
      </td>
<?php for ($i=1;$i<=3;$i++): ?>
     <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'><?php echo $r[$i]; ?></td>
<?php endfor ?>
    </tr>
<?php
}#fi while

$sql = "
SELECT SUM(total_fact_ttc) FROM " . $tblpref ."facture 
LEFT JOIN " . $tblpref ."client on " . $tblpref ."facture.client = " . $tblpref ."client.num_client
WHERE payement = 'non'
$fact_irre
$this_fact
";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());

while($data = mysql_fetch_array($req)){
 $tot = $data['SUM(total_fact_ttc)'];
?>
    <tr> 
     <td colspan="2" class="totaltexte"><?php echo $lang_factures_non_reglees_total; ?></td>
     <td colspan="2" class="totalmontant"><?php echo montant_financier($tot) ; ?></td>
     <td class="totalmontant" colspan="6"><a href="lister_factures_non_reglees.php?ordre=<?php echo $drdre; ?>&amp;ir"><?php echo "$lang_voir $lang_irrecouvrable"; ?></td>
    </tr>
<?php } ?>
   </table>
  </td>
 </tr>
 <tr>
  <td>
<?php
$aide = 'payement';
include("help.php");
include_once("include/bas.php");
?>
  </td>
 </tr>
</table>
</body>
</html>
