<?php 
/*
 * Factux le facturier libre
 * Copyright (C) 2003-2005 Guy Hendrickx, 2017 Thomas Ingles
 * 
 * Licensed under the terms of the GNU  General Public License:
 *                 http://opensource.org/licenses/GPL-3.0
 * 
 * For further information visit:
 *                 http://factux.free.fr
 * 
 * File Name: form_article
 *         Formulaire de saisie des articles
 * 
 * * * Version:  5.0.0
 * * * * Modified: 07/10/2016
 * 
 * File Authors:
 *                 Guy Hendrickx
 *.
 */
include_once("include/headers.php");
include_once("javascripts/verif_form.js");
include_once("include/finhead.php");
?>
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php
include_once("include/head.php");
if ($user_art == 'n') { 
 echo "<h1>$lang_article_droit</h1>";
 include_once("include/bas.php");
 exit;
}
if (isset($message)&&$message!='') { 
 echo $message; $message='';#onlyHere
}
?>
<script type="text/javascript" style="display:none;">//calcul du prix de vente HT margé
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
   <center>
    <form action="article_new.php" method="post" name="newart" id="newart" onSubmit="return verif_formulaire()" >
     <table class="page">
      <caption><?php echo $lang_article_creer; ?></caption>
      <tr> 
       <td class="texte0"><?php echo $lang_art_no; ?></td>
       <td class="texte0"><input name="article" type="text" id="article" size="40" maxlength="40"></td>
      </tr>
<?php if ($use_categorie =='y') { ?>
      <tr>
       <td class='<?php echo couleur_alternee (); ?>'><?php echo$lang_categorie; ?> 
       <td class='<?php echo couleur_alternee (FALSE); ?>'>
<?php
$rqSql = "SELECT id_cat, categorie FROM " . $tblpref ."categorie WHERE 1";
$result = mysql_query( $rqSql ) or die( "Exécution requête impossible."); 
?> 
        <select name='categorie'>
         <option value='0'><?php echo $lang_divers; ?></option>
<?php while($row = mysql_fetch_array( $result)) {?>
         <option value="<?php echo $row["id_cat"] ; ?>"><?php echo $row["categorie"]; ?></option>
<?php } ?>
        </select> 
       </td>
      </tr>
<?php } ?>
      <tr> 
        <td class='<?php echo couleur_alternee (); ?>'><?php echo $lang_uni_art; ?></td>
        <td class='<?php echo couleur_alternee (FALSE); ?>'><input name="uni" type="text" id="uni" size="8" maxlength="8" value=""></td>
      </tr>
      <tr> 
        <td class='<?php echo couleur_alternee (); ?>' id="titre_prix"><?php echo $lang_prix_uni; ?></td>
        <td class='<?php echo couleur_alternee (FALSE); ?>'><input name="prix" onChange="pht(this.form)" type="text" id="prix"><?php echo $devise; ?></td>
      </tr>
      <tr> 
        <td class='<?php echo couleur_alternee (); ?>'><?php echo $lang_ttva; ?></td>
        <td class='<?php echo couleur_alternee (FALSE); ?>'><input name="taux_tva" type="text" id="taux_tva" size="5" maxlength="5"> %</td>
      </tr>
      <tr>
        <td class='<?php echo couleur_alternee (); ?>'><?php echo $lang_marge; ?></td>
        <td class='<?php echo couleur_alternee (FALSE); ?>'>
         <span
          onClick="
           var m = (1-(1/this.firstElementChild.form.elements['marge'].value))*100;
           var p = this.firstElementChild.form.elements['prix'].value;
           var t = this.firstElementChild.form.elements['taux_tva'].value;
           window.open('include/pop.marge.php?frm=newart&amp;ch=marge&amp;tv='+t+'&amp;ma='+m+'&amp;pa='+p,'Calcul de Marge','width=415,height=160,scrollbars=0').focus();
          "
         >
          <input name="marge" type="text" size="7" value="1" title="<?php echo $lang_coef_de_marge; ?>" readonly="readonly" />
          <input name="prixvente" type="hidden" size="6" value="" title="<?php echo $lang_pdv_mrg_ht; ?> (<?php echo $devise; ?>)" readonly="readonly"/>
          <input name="tauxmarge" type="hidden" size="4" value="" title="<?php echo $lang_taux_marge; ?> (%)" readonly="readonly"/>
         </span>
        </td>
      </tr>
      <tr> 
        <td class='<?php echo couleur_alternee (); ?>'><?php echo $lang_commentaire_opt; ?> : </td>
        <td class='<?php echo couleur_alternee (FALSE); ?>'><input name="commentaire" type="text" id="commentaire"></td>
      </tr>
<?php if($use_stock=='y'){ ?>
      <tr>
       <td class='<?php echo couleur_alternee (); ?>'><?php echo $lang_stock; ?></td>
       <td class='<?php echo couleur_alternee (FALSE); ?>'><input name='stock' type='text'></td>
      </tr>
      <tr>
       <td class='<?php echo couleur_alternee (); ?>'><?php echo $lang_stomin; ?></td>
       <td class='<?php echo couleur_alternee (FALSE); ?>'><input name='stomin' type='text'></td>
      </tr>
      <tr>
       <td class='<?php echo couleur_alternee (); ?>'><?php echo $lang_stomax; ?></td>
       <td class='<?php echo couleur_alternee (FALSE); ?>'><input name='stomax' type='text'></td>
      </tr>
<?php }else{ ?>
      <tr>
	      <td>
        <input name='stock' type='hidden'>
        <input name='stomin' type='hidden'>
        <input name='stomax' type='hidden'>
       </td>
      </tr>
<?php } ?>
      <tr>
       <td class="submit" colspan="2">
        <input type="submit" name="Submit" value="<?php echo $lang_ajouter; ?>"> 
        <input name="reset" type="reset" id="reset" value="<?php echo $lang_effacer; ?>">
       </td>
      </tr>
     </table>
    </form>
   </center>
  </td>
 </tr>
 <tr>
  <td>
<?php
if ($use_categorie =='y') { 
  include_once("ajouter_cat.php");
  echo "\n  </td></tr>\n  <tr><td>\n";
}
require_once("lister_articles.php");
