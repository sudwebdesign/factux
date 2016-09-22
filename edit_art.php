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
 * File Name: edit_art.php
 * 	Permet de modifier certains parametres des articles.
 * 
 * * * Version:  1.1.5
 * * * * Modified: 23/07/2005
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
include_once("include/headers.php");
include_once("include/finhead.php");
$article=isset($_GET['article'])?$_GET['article']:"";
$sql = "
SELECT " . $tblpref ."article.num,
article,prix_htva,taux_tva,commentaire,marge,uni,stock,stomin,stomax,categorie,id_cat,SUM(quanti)
FROM " . $tblpref ."article 
LEFT JOIN " . $tblpref ."categorie on " . $tblpref ."article.cat = " . $tblpref ."categorie.id_cat
LEFT JOIN " . $tblpref ."cont_bon on " . $tblpref ."article.num = " . $tblpref ."cont_bon.article_num
WHERE " . $tblpref ."article.num=$article";

$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_array($req)){
 $article = $data['article'];
 $num =$data['num'];
 $prix = $data['prix_htva'];
 $tva = $data['taux_tva'];
 $commentaire = $data['commentaire'];
 $marge = $data['marge'];
 $uni = $data['uni'];
 $stock = $data['stock'];
 $min = $data['stomin'];
 $max = $data['stomax'];
 $cate = $data['categorie'];
 $cat_id = $data['id_cat'];
 $quanti = $data['SUM(quanti)'];
}
?>
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php include_once("include/head.php"); ?>
   <center>
    <form action="article_update.php" method="post" name="article_edit" id="article_edit">
     <table class="page boiteaction">
      <caption><?php echo"$lang_modi_pri $article ".(($quanti)?"<br><sup>$quanti $uni $lang_déja_commandé(s)</sup>":''); ?></caption>
<?php if($quanti==0){ ?>
      <tr>
       <th colspan="2"><?php echo $lang_art_no; ?></th>
       <th><?php echo $lang_uni_art; ?></th>
      </tr>
      <tr> 
       <td colspan="2" class="c texte0"><input name="article" type="text" id="article" size="40" maxlength="40" value="<?php echo $article; ?>"></td>
       <td class="c texte0"><input name="uni" type="text" id="uni" size="8" maxlength="8" value="<?php echo $uni; ?>"></td>
      </tr>
<?php } ?>
      <tr>
       <th id="titre_prix"><?php echo ($marge==1)?$lang_prixunitaire:$lang_prix_dachat; ?></th>
       <th><?php if ($use_categorie =='y') { echo $lang_categorie; } ?></th>
       <th><?php echo $lang_marge; ?></th>
      </tr>
      <tr>
       <td class="c texte0"><input name="prix" type="text" onChange="pht(this.form)" value="<?php echo $prix; ?>"><?php echo $devise; ?></td>
       <td class="c texte0">
<?php  if ($use_categorie =='y') {
$rqSql = "SELECT id_cat, categorie FROM " . $tblpref ."categorie WHERE 1";
$result = mysql_query( $rqSql ) or die( "Exécution requête impossible.");  
?>
        <select name='categorie'>
         <option value=''><?php echo $lang_divers; ?></option>
<?php
while ( $row = mysql_fetch_array( $result)) {
	$num_cat = $row["id_cat"];
	$categorie = $row["categorie"];
	$sel=($cat_id==$num_cat)?"' selected='selected":'';
?>
         <option value='<?php echo "$num_cat$sel" ; ?>'><?php echo $categorie; ?></option>
<?php } ?>
        </select>
<?php } ?>
       </td>
       <td class="c texte0">
        <span
         onClick="
          var m = (1-(1/this.firstElementChild.form.elements['marge'].value))*100;
          var p = this.firstElementChild.form.elements['prix'].value;
          window.open('include/pop.marge.php?frm=article_edit&amp;ch=marge&amp;tv=<?php echo $tva; ?>&amp;ma='+m+'&amp;pa='+p,'Calcul de Marge','width=415,height=160,scrollbars=0').focus();
         "
        >
         <input <?php echo ($marge==1)?'':'size="3" '; ?>
          name="marge" 
          type="text" 
          value="<?php echo $marge; ?>" 
          title="<?php echo $lang_coef_de_marge; ?>"
          readonly="readonly"
         >
         <input <?php echo ($marge==1)?'type="hidden" ':'type="text" '; ?>
          name="prixvente" 
          size="6" 
          value="<?php echo montant_financier($prix*$marge); ?>" 
          title="<?php echo $lang_pdv_mrg_ht; ?> (<?php echo $devise; ?>)"
          readonly="readonly"
         >
         <input <?php echo ($marge==1)?'type="hidden" ':'type="text" '; ?>
          name="tauxmarge" 
          size="4" 
          value="<?php echo montant_taux((1-(1/$marge))*100); ?>" 
          title="<?php echo $lang_taux_marge; ?> (%)"
          readonly="readonly"
         >
        </span>
       </td>
      </tr>
<?php if($use_stock=='y'){ ?>
      <tr>
       <th><?php echo $lang_stock; ?></th>
       <th><?php echo $lang_stomax; ?></th>
       <th><?php echo $lang_stomin; ?></th>
      </tr>
      <tr>
       <td class="c texte0"><input name="stock" type="text" value ="<?php echo $stock; ?>"></td>
       <td class="c texte0"><input name="max" type="text" value ="<?php echo $max; ?>"></td>
       <td class="c texte0"><input name="min" type="text" value ="<?php echo $min; ?>"></td>
      </tr>
<?php } ?>
      <tr>
       <th colspan="3"><?php echo $lang_commentaire_opt; ?> : <br />
        <input name="commentaire" type="text" value ='<?php echo $commentaire; ?>' id="commentaire">
       </th>
      </tr>
      <tr>
       <td colspan="3" class="submit">
        <input name="num" type="hidden" value="<?php echo $num; ?>"  />
        <input name="nom" type="hidden" value='<?php echo $article; ?>'  />
        <input type="submit" name="Submit" value="<?php echo $lang_modifier; ?>">
        <input name="reset" type="reset" id="reset" value="<?php echo $lang_retablir; ?>">
       </td>
      </tr>
     </table>
    </form>
   </center>
  </td>
 </tr>
 <tr>
  <td>
<?php include_once("include/bas.php"); ?>
  </td>
 </tr>
</table>
<script type="text/javascript">//calcul du prix de vente HT margé
 function pht(frm){
  if(frm.elements["marge"].value>1){//calc
   var p = parseFloat(frm.elements["prix"].value * frm.elements["marge"].value).toFixed(2);//arrondir a 2 decimales
   frm.elements["prixvente"].value = p +'<?php echo $devise; ?>';
   document.getElementById("titre_prix").textContent = "<?php echo $lang_prix_dachat; ?>";//innerText
  }else{
   document.getElementById("titre_prix").textContent = "<?php echo $lang_prixunitaire; ?>";//innerText
  }
 }
</script>
</body>
</html>
