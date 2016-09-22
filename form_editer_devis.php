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
 * File Name: form_editer_devis.php
 * 	
 * 
 * * * Version:  1.1.5
 * * * * Modified: 23/07/2005
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
$sql = "SELECT  coment, client_num, nom FROM " . $tblpref ."devis
LEFT join " . $tblpref ."client on " . $tblpref ."devis.client_num = " . $tblpref ."client.num_client
WHERE num_dev = $num_dev";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
$num = $data['client_num'];
$nom = $data['nom'];#htmlentities($data['nom'], ENT_QUOTES);
$coment = $data['coment'];
$sql = "
SELECT " . $tblpref ."cont_dev.num, quanti, remise, p_u_jour, marge_jour, uni, article, tot_art_htva, to_tva_art tva
FROM " . $tblpref ."cont_dev 
LEFT JOIN " . $tblpref ."article on " . $tblpref ."cont_dev.article_num = " . $tblpref ."article.num
WHERE dev_num = $num_dev
";
$req5 = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());

//chang_cli.php
$rqSql = "
SELECT num_client, nom 
FROM " . $tblpref ."client 
WHERE actif != 'non'
";

if ($user_dev == 'r') { 
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
  <caption><?php echo "$lang_dev_editer $lang_numero $num_dev de $nom"; ?></caption>
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
   <td><input type="hidden" name="num_dev" value="<?php echo $num_dev; ?>" /></td>
   <td><input type="submit" name="changer" value="changer"></td>
   <td colspan="3">&nbsp;</td>
  </tr>
 </table>
</form>

<table class="page boiteaction">
 <caption><?php echo "$lang_devis_editer $lang_numero $num_dev"; ?></caption>
 <tr>
  <th><?php echo $lang_quantite; ?></th>
  <th><?php echo $lang_unite; ?></th>
  <th><?php echo $lang_article; ?></th>
  <th><?php echo $lang_remise;?></th>
  <th><?php echo $lang_montant_htva; ?></th>
  <th colspan="2"><?php echo $lang_action; ?></th>
 </tr>
<?php
$total_dev = 0.0;
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
 $num_cont = $data['num'];
 $remise=$data['remise'];
//+ calcul du montant de la remise #2015
 $prx_ht = ($data['p_u_jour']/$data['marge_jour']);#non margé
 $tx_remise = (1-($data['remise']/100));#taux remise

 $remise_art_htva = ( $data['p_u_jour'] * $quanti ) - $tot;
 $marge_art_htva = $tot - (( $prx_ht * $quanti ) * $tx_remise);

 $total_remise_htva += $remise_art_htva;
 $total_marge_htva += $marge_art_htva;

 $total_dev += $tot;
 $total_tva += $tva;
 if($c++ & 1){
  $line="0";
 }else{
  $line="1"; 
 }
?>
 <tr class="texte<?php echo $line; ?>" onmouseover="this.className='highlight'" onmouseout="this.className='texte<?php echo $line; ?>'">
  <td class="<?php echo couleur_alternee (TRUE,"nombre"); ?>"><?php echo $quanti; ?></td>
  <td class="<?php echo couleur_alternee (FALSE); ?>"><?php echo  $uni; ?></td>
  <td class="<?php echo couleur_alternee (FALSE); ?>"><?php echo  $article; ?></td>
  <td class="<?php echo couleur_alternee (FALSE,"nombre");?>"><?php echo montant_taux($remise); ?></td>
  <td class="<?php echo couleur_alternee (FALSE,"nombre");?>"><?php echo montant_financier($tot); ?></td>
  <td class="<?php echo couleur_alternee (FALSE,"c texte"); ?>">
   <form method="post" action="edit_cont_dev.php">
    <input name="<?php echo $lang_editer; ?>"
     type="image" value="<?php echo $lang_editer; ?>"
     src="image/edit.gif"
     alt="<?php echo $lang_editer; ?>"
     align="middle" border="0" onclick="submit()"
    >
    <input type="hidden" name="num_cont" value="<?php echo $num_cont; ?>">
   </form>
  </td>
  <td class="<?php echo couleur_alternee (FALSE,"c texte"); ?>">
   <a href="delete_cont_dev.php?num_cont=<?php echo $num_cont; ?>&amp;num_dev=<?php echo $num_dev; ?>&amp;nom=<?php echo $nom; ?>" 
      onClick='return confirmDelete("<?php echo $lang_effacer_ligne_devis; ?>")'>
    <img border="0" src="image/delete.jpg" alt="<?php echo $lang_effacer; ?>">
   </a>
  </td>
 </tr>
<?php } ?>
 <tr>
  <td class='totalmontant' colspan="2"><?php echo "$lang_total $lang_remise"; ?><br /><?php echo "$lang_total $lang_marge"; ?></td>
  <td class='totalmontant'><?php echo montant_financier($total_remise_htva); ?><br /><?php echo montant_financier($total_marge_htva); ?></td>
  <td class='totalmontant'><?php echo $lang_total_h_tva; ?><br /><?php echo $lang_tva; ?></td>
  <td class='totalmontant'><?php echo montant_financier($total_dev); ?><br /><?php echo montant_financier($total_tva); ?></td>
  <td class="totaltexte" colspan="2">&nbsp;</td>
 </tr>
<?php
//on calcule la somme des contenus du bon
$sql = " SELECT SUM(tot_art_htva) FROM " . $tblpref ."cont_dev WHERE dev_num = $num_dev";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
?>
</table>
 <form name="formu2" method="post" action="edit_devis_suite.php">
  <table class="page boiteaction">
   <caption><?php echo "$lang_devis_ajouter $lang_numero $num_dev"; ?></caption>
   <tr> 
    <td class="texte0"><?php echo $lang_article; ?></td> 
    <td class="texte0">
<?php include("include/article_choix.php"); ?>
    </td>
   </tr>
   <tr> 
    <td class="texte0"><?php echo $lang_quantite; ?></td>
    <td class="texte0" colspan="6">
     <input name="quanti" type="text" id="quanti" size="6">
    </td>
   </tr>
   <tr>
    <td class="texte0"><?php echo $lang_remise;?></td>
    <td class="texte0" colspan="6"><input name="remise" type="text" id="remise" size="6">%</td>
   </tr>
   <tr> 
    <td class="submit" colspan="7">
    <input type="submit" name="Submit2" value="<?php echo $lang_devis_ajouter; ?>">
     <input name="nom" type="hidden" id="nom" value="<?php echo $nom; ?>">
     <input name="num_dev" type="hidden" id="nom" value="<?php echo $num_dev; ?>"> 
    </td>
   </tr>
  </table>
 </form>
<?php if($c){ ?>
<form action="devis_fin.php" method="post" name="fin_dev">
 <table class="page boiteaction">
  <caption><?php echo"$lang_devis_enregistrer $lang_numero $num_dev"; ?></caption>
  <tr>
   <th><?php echo $lang_ajo_com_dev; ?></th>    
  </tr>
  <tr>
   <td class="submit">
    <textarea name="coment" cols="45" rows="3"><?php echo $coment; ?></textarea><br> 
    <input type="submit" name="Submit" value="<?php echo $lang_ter_enr; ?>">
   </td>    
  </tr>
 </table>
 <input type="hidden" name="tot_ht" value="<?php echo $total_dev; ?>">
 <input type="hidden" name="tot_tva" value="<?php echo $total_tva; ?>">
 <input type="hidden" name="dev_num" value="<?php echo $num_dev; ?>">
</form>
<?php } ?>
