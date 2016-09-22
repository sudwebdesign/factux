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
 * File Name: form_lot.php
 * 	Formulaire de creation des lots
 * 
 * * * Version:  1.1.5
 * * * * Modified: 23/07/2005
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
require_once("include/verif.php");
include_once("include/config/common.php");
include_once("include/language/$lang.php");
include_once("include/utils.php");
include_once("include/headers.php");
include_once("include/finhead.php");
?>
<table width="760" border="0" class="page" align="center">
<tr>
<td class="page" align="center">
<?php
include_once("include/head.php");
if ($user_admin != y) { 
echo "<h1>$lang_admin_droit";
exit;
}
?>
</td>
</tr>
<?php
if($message !=''){
echo"<tr><TD>$message</TD></tr>";
}
?>
<tr>
<td  class="page" align="center">
<form action="admin_modif.php" method="post" >
        <table class="boiteaction">
          <caption>
          <?php echo "$lang_modif_par"; ?>
          </caption>
					 <tr> 
					<th ><?php echo "$lang_use_cat"; ?> 
					<td class="texte1"><select name="choix_use_cat">
											<option <?php if($use_categorie =='y'){echo"selected";}?> value="y">oui</option>
											<option <?php if($use_categorie !='y'){echo"selected";}?> value="n">non</option>
					
					</select>
					
					<tr>
            <th><?php echo "$lang_use_list_client"; ?>
					<td class="texte0"><select name="choix_use_liste_cli">
											<option <?php if($liste_cli =='y'){echo"selected";}?> value="y">oui</option>
											<option <?php if($liste_cli !='y'){echo"selected";}?> value="n">non</option>
					
					</select>
					<tr>
            <th><?php echo"$lang_use_payement"; ?>
					<td class="texte1"><select name="choix_use_payement">
											<option <?php if($use_payement =='y'){echo"selected";}?> value="y">oui</option>
											<option <?php if($use_payement !='y'){echo"selected";}?> value="n">non</option>
				
					</select>
					<tr>
            <th><?php echo"$lang_choix_use_lot"; ?>
					<td class="texte0"><select name="choix_use_lot">
											<option <?php if($lot =='y'){echo"selected";}?> value="y">oui</option>
											<option <?php if($lot !='y'){echo"selected";}?> value="n">non</option>
					
					</select>
					<tr>
            <th><?php echo"$lang_choix_use_stock"; ?>
					<td class="texte1"><select name="choix_use_stock">
											<option <?php if($use_stock =='y'){echo"selected";}?> value="y">oui</option>
											<option <?php if($use_stock !='y'){echo"selected";}?> value="n">non</option>
					
					</select>
					<!--impression -->
					<tr>
            <th><?php echo"$lang_choix_Impression"; ?>
						<script type="text/javascript">
function montrer_cacher(laCase,value,leCalk,leCalk2)
{
    if (value=='y') 
    {
        document.getElementById(leCalk).style.visibility="visible";
				document.getElementById(leCalk2).style.visibility="visible";
    }
    else 
    {
        document.getElementById(leCalk).style.visibility="hidden";
				document.getElementById(leCalk2).style.visibility="hidden";
    }
}
</script>
					<td class="texte0"><select name="choix_impression" onchange="montrer_cacher(this,value,'cluster','cluster2')">
											<option <?php if($autoprint =='y'){echo"selected";}?> value="y">oui</option>
											<option <?php if($autoprint !='y'){echo"selected";}?> value="n">non</option>					
					</select>
					<div id="cluster2" <?php if($autoprint !='y'){ echo"style=\"visibility:hidden\"";}?> ><?php echo"$lang_nbr_impression"; ?> </div>
<input type="text" size="3" value="<?php echo"$nbr_impr"; ?>" name="nbr_impr" id="cluster" <?php if($autoprint !='y'){ echo"style=\"visibility:hidden\"";}?> />
					<!-- fin impression -->
					<tr>
            <th><?php echo"$lang_choix_theme"; ?>
					<td class="texte1"><select name="choix_theme">
					<?php 
if ($handle = opendir('include/themes')) {
   while (false !== ($file = readdir($handle))) {
       if ($file != "." && $file != ".." && is_dir("include/themes/$file")) {
           echo "<option ";
					 if($theme ==$file){
					 echo"selected ";
					 }
					 echo"value=\"$file\">$file</option>";
       }
   }
   closedir($handle);
}
 ?> 
					</select>
					
					<tr>
					<td colspan="2" class="submit"><input type="submit" /><input type="reset" />
					
					
					</table>
					</form>
					</td></tr><tr><td>

<?php
$aide = 'admin';
include("help.php");
include_once("include/bas.php");
?></table>
</body>
</html>
