<?php
/*
 * Factux le facturier libre
 * Copyright (C) 2003-2005 Guy Hendrickx, 2017~ Thomas Ingles
 *
 * Licensed under the terms of the GNU  General Public License:
 * 		http://opensource.org/licenses/GPL-3.0
 *
 * For further information visit:
 * 		http://factux.free.fr
 *
 * File Name: form_lot.php
 * 	Formulaire de creation des lots
 *
 * * * * Version:  8.0.0
 * * * * Modified: 07/06/2025
 *
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
include_once(__DIR__ . "/include/headers.php");
include_once(__DIR__ . "/include/finhead.php");
?>
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php
include_once(__DIR__ . "/include/head.php");
if ($user_admin != 'y') {
 echo sprintf('<h1>%s</h1>', $lang_admin_droit);
 include_once(__DIR__ . "/include/bas.php");
 exit;
}
if (isset($message)&&$message!='') {
 echo $message;
}
?>
   <form action="admin_modif.php" method="post" name="formu2">
    <table class='page boiteaction'>
     <caption><?php echo $lang_modif_par; ?></caption>
     <tr>
      <td class="td2"><?php echo $lang_use_cat; ?></td>
      <td class="texte1">
        <select name="choix_use_cat">
          <option <?php if($use_categorie =='y'){echo"selected";}?> value="y"><?php echo $lang_oui; ?></option>
          <option <?php if($use_categorie !='y'){echo"selected";}?> value="n"><?php echo $lang_non; ?></option>
        </select>
      </td>
     </tr>
     <tr>
      <td class="td2"><?php echo $lang_use_list_client; ?></td>
      <td class="texte0">
        <select name="choix_use_liste_cli">
          <option <?php if($liste_cli =='y'){echo"selected";}?> value="y"><?php echo $lang_oui; ?></option>
          <option <?php if($liste_cli !='y'){echo"selected";}?> value="n"><?php echo $lang_non; ?></option>
        </select>
      </td>
     </tr>
     <tr>
      <td class="td2"><?php echo $lang_use_payement; ?></td>
      <td class="texte1">
        <select name="choix_use_payement">
          <option <?php if($use_payement =='y'){echo"selected";}?> value="y"><?php echo $lang_oui; ?></option>
          <option <?php if($use_payement !='y'){echo"selected";}?> value="n"><?php echo $lang_non; ?></option>
        </select>
      </td>
     </tr>
     <tr>
      <td class="td2"><?php echo $lang_choix_use_lot; ?></td>
      <td class="texte0">
        <select name="choix_use_lot">
          <option <?php if($lot =='y'){echo"selected";}?> value="y"><?php echo $lang_oui; ?></option>
          <option <?php if($lot !='y'){echo"selected";}?> value="n"><?php echo $lang_non; ?></option>
        </select>
      </td>
     </tr>
     <tr>
      <td class="td2"><?php echo $lang_choix_use_stock; ?></td>
      <td class="texte1">
        <select name="choix_use_stock">
          <option <?php if($use_stock =='y'){echo"selected";}?> value="y"><?php echo $lang_oui; ?></option>
          <option <?php if($use_stock !='y'){echo"selected";}?> value="n"><?php echo $lang_non; ?></option>
        </select>
      </td>
     </tr>
     <!--impression -->
     <tr>
      <td class="td2"><?php echo $lang_choix_Impression; ?></td>
<script type="text/javascript">
function montrer_cacher(laCase,value,leCalk,leCalk2){
  if (value=='y'||laCase.checked){
    document.getElementById(leCalk).style.visibility="visible";
    document.getElementById(leCalk2).style.visibility="visible";
  } else {
    document.getElementById(leCalk).style.visibility="hidden";
    document.getElementById(leCalk2).style.visibility="hidden";
  }
}
</script>
      <td class="texte0">
        <select name="choix_impression" onchange="montrer_cacher(this,value,'cluster','cluster2')">
          <option <?php if($autoprint =='y'){echo"selected";}?> value="y"><?php echo $lang_oui; ?></option>
          <option <?php if($autoprint !='y'){echo"selected";}?> value="n"><?php echo $lang_non; ?></option>
        </select>
        <div id="cluster2"<?php if($autoprint !='y'){echo ' style="visibility:hidden"';}?>><b><?php echo $lang_nbr_impression; ?></b></div>
        <input type="text" size="3" value="<?php echo $nbr_impr; ?>" name="nbr_impr" id="cluster"<?php if($autoprint !='y'){echo ' style="visibility:hidden"';}?> />
      </td>
     </tr>
    <!-- fin impression -->
     <tr>
      <td class="td2"><?php echo $lang_choix_first_art; ?></td>
      <td class="texte1">
       <input type="checkbox" <?php if($first_art!=0){echo"checked";/*$article_num=$first_art;*/}?> name="choix_first_art" onchange="montrer_cacher(this,value,'article','clustart')" >
       <div id="clustart"<?php if($first_art==0){echo ' style="visibility:hidden"';}?> ><b><?php echo $lang_choisissez; ?>:</b><br />
<?php include(__DIR__ . "/include/article_choix.php"); ?>
       </div>
      </td>
     </tr>
     <tr>
      <td class="td2"><?php echo $lang_choix_echeance_fact; ?></td>
      <td class="texte0">
       <input value="<?php echo $echeance_fact; ?>" name="choix_echeance_fact" type="text" maxlength="2" size="2" /> <?php echo $lang_jours; ?>
      </td>
     </tr>
     <tr>
      <td class="td2"><?php echo $lang_choix_theme; ?></td>
      <td class="texte1">
        <select name="choix_theme">
<?php
if ($handle = opendir('include/themes')){
 while (false !== ($file = readdir($handle))) {
  if ($file != "." && $file != ".." && is_dir('include/themes/' . $file)) {
   echo "
         <option ";
   if($theme ==$file){
    echo"selected='selected' ";
   }
   echo sprintf('value="%s">%s</option>', $file, $file);
  }
 }
 closedir($handle);
}
?>
        </select>
      </td>
     </tr>
     <tr>
      <td colspan="2" class="td2"><hr /></td>
     <tr>
      <td class="td2"><?php echo $lang_choix_auth_cli_devis; ?></td>
      <td class="texte0">
        <select name="choix_auth_cli_devis">
          <option <?php if( $auth_cli_devis=='y'){echo"selected";}?> value="y"><?php echo $lang_oui; ?></option>
          <option <?php if( $auth_cli_devis!='y'){echo"selected";}?> value="n"><?php echo $lang_non; ?></option>
        </select>
      </td>
     </tr>
     <tr>
      <td class="td2"><?php echo $lang_choix_auth_cli_bon; ?></td>
      <td class="texte1">
        <select name="choix_auth_cli_bon">
          <option <?php if( $auth_cli_bon=='y'){echo"selected";}?> value="y"><?php echo $lang_oui; ?></option>
          <option <?php if( $auth_cli_bon!='y'){echo"selected";}?> value="n"><?php echo $lang_non; ?></option>
        </select>
      </td>
     </tr>
     <tr>
      <td class="td2"><?php echo $lang_choix_auth_cli_fact; ?></td>
      <td class="texte0">
        <select name="choix_auth_cli_fact">
          <option <?php if( $auth_cli_fact=='y'){echo"selected";}?> value="y"><?php echo $lang_oui; ?></option>
          <option <?php if( $auth_cli_fact!='y'){echo"selected";}?> value="n"><?php echo $lang_non; ?></option>
        </select>
      </td>
     </tr>
     <tr>
      <td colspan="2" class="submit">
       <input type="submit" value="<?php echo $lang_envoyer; ?>" />
       <input type="reset" value="<?php echo $lang_annuler; ?>" />
      </td>
     </tr>
    </table>
   </form>
  </td>
 </tr>
 <tr>
  <td>
<?php
$aide = 'admin';
include(__DIR__ . "/help.php");
include_once(__DIR__ . "/include/bas.php");
?>
  </td>
 </tr>
</table>
</body>
</html>
