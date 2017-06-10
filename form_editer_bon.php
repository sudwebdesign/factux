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
 * File Name: form_editer_bon.php
 * 	fomulaire pour editer les bons de commande
 * 
 * * Version:  5.0.0
 * * Modified: 07/10/2016
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
$sql = "
SELECT  coment, client_num, nom FROM " . $tblpref ."bon_comm 
LEFT join " . $tblpref ."client on " . $tblpref ."bon_comm.client_num = " . $tblpref ."client.num_client
WHERE num_bon = $num_bon
";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
$num = $data['client_num'];#htmlentities($data['client_num'], ENT_QUOTES);
$coment = $data['coment'];#htmlentities($data['coment'], ENT_QUOTES);
$nom = $data['nom'];#htmlentities($data['nom'], ENT_QUOTES);
$sql = "
SELECT " . $tblpref ."cont_bon.num, num_lot, quanti, remise, p_u_jour, marge_jour, uni, article, tot_art_htva, to_tva_art tva
FROM " . $tblpref ."cont_bon 
LEFT JOIN " . $tblpref ."article on " . $tblpref ."cont_bon.article_num = " . $tblpref ."article.num
WHERE  bon_num = $num_bon
";
$req5 = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$rqSql1 = "
SELECT num, article, prix_htva, uni, marge FROM " . $tblpref ."article 
WHERE actif != 'non' 
ORDER BY article,prix_htva
";
$result = mysql_query( $rqSql1 ) or die('Erreur SQL !<br>'.$rqSql1.'<br>'.mysql_error());

//chang_cli.php
$rqSql = "
SELECT num_client, nom 
FROM " . $tblpref ."client 
WHERE actif != 'non'
";

if ($user_com == 'r') { 
  $rqSql .= "
  and (" . $tblpref ."client.permi LIKE '$user_num,' 
  or  " . $tblpref ."client.permi LIKE '%,$user_num,' 
  or  " . $tblpref ."client.permi LIKE '%,$user_num,%' 
  or  " . $tblpref ."client.permi LIKE '$user_num,%')  
";  
}
$result2 = mysql_query( $rqSql ) or die('Erreur SQL !<br>'.$rqSql.'<br>'.mysql_error());	     
?>

<form action="chang_cli.php" method="post" name="formu">
 <table class="page boiteaction">
  <caption><?php echo "$lang_bon_editer $lang_numero $num_bon de $nom"; ?></caption>
  <tr>
   <td><?php echo $lang_changer_client; ?></td>
   <td>
<?php 
if ($liste_cli!='y') { 
 $rqSql="$rqSql order by nom";
 $result = mysql_query( $rqSql ) or die('Erreur SQL !<br>'.$rqSql.'<br>'.mysql_error());
?> 
  <select name='listeclients'>
<?php
while ( $row = mysql_fetch_array( $result2)) {
$numcli = $row["num_client"];
$nomcli = $row["nom"];
?>
   <option value="<?php echo $numcli; ?>"<?php echo ($numcli==$num)?' selected="selected"':''; ?>><?php echo $nomcli; ?></option>
<?php } ?>
  </select>
<?php 
}else{
 include_once("include/choix_cli.php");
}
?> 
   </td>
   <td><input type="hidden" name="num_bon" value="<?php echo $num_bon; ?>" /></td>
   <td><input type="submit" name="changer" value="<?php echo $lang_changer_client; ?>"></td>
   <td colspan="3">&nbsp;</td>
  </tr>
 </table>
</form>

<table class="page boiteaction">
 <tr> 
  <th><?php echo $lang_quantite; ?></th>
  <th><?php echo $lang_unite; ?></th>
  <th><?php echo $lang_article; ?></th>
  <th><?php echo $lang_remise; ?></th>
  <th><?php echo $lang_montant_htva; ?></th>
<?php if ($lot =='y') { ?>
  <th><?php echo $lang_num_lot; ?></th>  
<?php } ?> 
  <th colspan="2"><?php echo $lang_action; ?></th>
 </tr>
<?php
//trouver le client correspodant devis à editer

//trouver le contenu du bon
$total_bon = 0.0;
$total_tva = 0.0;
$total_marge_htva = 0;
$total_remise_htva = 0;
$c=0;
while($data = mysql_fetch_array($req5)){
  $quanti = $data['quanti'];
  $uni = $data['uni'];
  $article = $data['article'];
  $tot = $data['tot_art_htva'];
  $tva = $data['tva'];
  $remise=$data['remise'];
  $num_cont = $data['num'];
  $num_lot = $data['num_lot'];
//+ calcul du montant de la remise #2015
 $prx_ht = ($data['p_u_jour']/$data['marge_jour']);#non margé
 $tx_remise = (1-($data['remise']/100));#taux remise

 $remise_art_htva = ( $data['p_u_jour'] * $quanti ) - $tot;
 $marge_art_htva = $tot - (( $prx_ht * $quanti ) * $tx_remise);

 $total_remise_htva += $remise_art_htva;
 $total_marge_htva += $marge_art_htva;


  $total_bon += $tot;
  $total_tva += $tva;
  if($c++ & 1){
  $line="0";
 }else{
  $line="1"; 
 }
?>
 <tr class="texte<?php echo $line; ?>" onmouseover="this.className='highlight'" onmouseout="this.className='texte<?php echo $line; ?>'">
  <td class='<?php echo couleur_alternee (TRUE,"nombre"); ?>'><?php echo $quanti; ?></td>
  <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo  $uni; ?> </td>
  <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo  $article; ?></td>
  <td class='<?php echo couleur_alternee (FALSE,"nombre"); ?>'><?php echo montant_taux($remise); ?></td>
  <td class='<?php echo couleur_alternee (FALSE,"nombre"); ?>'><?php echo montant_financier($tot); ?></td>
<?php if ($lot =='y') { ?>
  <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'>
   <a href="voir_lot.php?num=<?php echo $num_lot;?>" target="_blank"><?php echo $num_lot;?></a>
  </td>
<?php } ?>  
  <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'>
   <form method="post" action="edit_cont_bon.php">
    <input name="<?php echo $lang_editer; ?>"
     type="image" value="<?php echo $lang_editer; ?>"
     src="image/edit.gif"
     alt="<?php echo $lang_editer; ?>"
     align="top" 
     onclick="submit()"
    >
    <input type="hidden" name="num_cont" value="<?php echo $num_cont; ?>">
   </form>
  </td>
  <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'>
   <a href="delete_cont_bon.php?num_cont=<?php echo $num_cont; ?>&amp;num_bon=<?php echo $num_bon; ?>" 
      onClick="return confirmDelete('<?php echo $lang_sup_li; ?>')"
   >
    <img border="0" src="image/delete.jpg" alt="<?php echo $lang_effacer; ?>">
   </a>
  </td>
 </tr>
<?php } ?>
 <tr>
  <td class='totalmontant' colspan="2"><?php echo "$lang_total $lang_remise"; ?><br /><?php echo "$lang_total $lang_marge"; ?></td>
  <td class='totalmontant'><?php echo montant_financier($total_remise_htva); ?><br /><?php echo montant_financier($total_marge_htva); ?></td>
  <td class='totalmontant'><?php echo $lang_total_h_tva; ?><br /><?php echo $lang_tva; ?></td>
  <td class='totalmontant'><?php echo montant_financier($total_bon); ?><br /><?php echo montant_financier($total_tva); ?></td>
<?php if ($lot =='y') { ?>
  <td class='totaltexte'></td>
<?php } ?>
  <td class='totalmontant' colspan="2"></td>
 </tr>
<?php
//on calcule la somme des contenus du bon
$sql = " SELECT SUM(tot_art_htva) FROM " . $tblpref ."cont_bon WHERE bon_num = $num_bon";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
?>
</table>

<form action="edit_bon_suite.php" method="post" name="formu2">
 <table class="page boiteaction">
  <caption><?php echo "$lang_bon_ajouter $lang_numero $num_bon"; ?></caption>
   <tr> 
    <td class="texte0"><?php echo $lang_article; ?></td>
    <td class="texte0">
<?php include("include/article_choix.php"); ?>
    </td>
<?php if ($lot=='y') { ?>
  <td class="texte0"><?php echo $lang_lot; ?></td>
<?php
$rqSql = "
SELECT num, prod FROM " . $tblpref ."lot 
WHERE actif != 'non' 
ORDER BY num
";
$result = mysql_query( $rqSql )or die('Erreur SQL !<br>'.$rqSql.'<br>'.mysql_error());
?>
  <td class="texte0">
    <select name='lot'>
     <option value=''><?php echo $lang_choisissez; ?></option>
<?php
while ( $row = mysql_fetch_array( $result)) {
$num = $row["num"];
$prod = $row["prod"];
?>
     <option value='<?php echo $num; ?>'><?php echo "$num $prod "; ?></option>
<?php } ?>
    </select>
   </td> 
<?php } ?> 
  </tr>
  <tr> 
   <td class="texte0"><?php echo $lang_quantite; ?></td>
   <td class="texte0" colspan="8"><input name="quanti" type="text" id="quanti" size="6"></td>
  </tr>
  <tr> 
   <td class="texte0"><?php echo $lang_remise; ?></td>
   <td class="texte0" colspan="8"><input name="remise" type="text" id="remise" size="6">%</td>
  </tr>
  <tr> 
   <td class="submit" colspan="9">
     <input type="submit" name="Submit2" value='<?php echo $lang_bon_ajouter; ?>'>
     <input name="nom" type="hidden"  value='<?php echo $nom; ?>'> 
     <input name="num_bon" type="hidden" value='<?php echo $num_bon; ?>'>
   </td>
  </tr> 
 </table>
</form>
<?php if($c){ ?>
<form action="bon_fin.php" method="post" name="fin_bon">
 <table class="page boiteaction">
   <caption><?php echo "$lang_bon_enregistrer $lang_numero $num_bon"; ?></caption>
   <tr>
     <th><?php echo $lang_ajo_com_bo ?></th>    
   </tr>
   <tr>
     <td class="submit">
       <textarea name="coment" cols="45" rows="3"><?php echo $coment; ?></textarea><br> 
       <input type="submit" name="Submit" value='<?php echo $lang_ter_enr; ?>'>
     </td>    
   </tr>
 </table>
 <input type="hidden" name="tot_ht" value='<?php echo $total_bon; ?>'>
 <input type="hidden" name="tot_tva" value='<?php echo $total_tva; ?>'>
 <input type="hidden" name="bon_num" value='<?php echo $num_bon; ?>'>
</form>
<?php } ?>
