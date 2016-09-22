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
 * File Name: fckconfig.js
 * 	Editor configuration settings.
 * 
 * * * Version:  1.1.5
 * * * * Modified: 23/07/2005
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
if(!isset($num_client))
 header("Location:index.php");
?>
 <form action="client_update.php" method="post" name="client" id="client" onSubmit="return verif_formulaire()">
  <table class="page boiteaction">
    <caption><?php echo $lang_chng_mdp; ?></caption> 
    <tr>
      <td class="texte0"><?php echo $lang_login; ?></td>
      <td class="texte0"><b><?php echo $login ?></b></td>
    </tr>
    <tr>
      <td class="texte0"><?php echo $lang_motdepasse_ancien; ?></td>
      <td class="texte0"><input name = "pass" type="password" maxlength="40" /></td>
    </tr>
    <tr>
      <td class="texte0"><?php echo $lang_motdepasse_nouveau; ?></td>
      <td class="texte0"> <input name = "pass_new" type= "password" maxlength="40" /></td>
    </tr>
    <tr>
      <td class="texte0"><?php echo $lang_motdepasse_verification; ?></td>
      <td class="texte0"><input name = "pass_new2" type = "password" maxlength="40" /></td>
    </tr>
    <tr>
      <td class="submit" colspan="3"> 
        <input type="submit" value="<?php echo $lang_motdepasse_changer; ?>" /> 
        <input type="reset" value="<?php echo $lang_annuler; ?>" />
        <input name="login" type="hidden" id="login" value="<?php echo $login; ?>" />
      </td>
    </tr>
  </table>
  <input name="num_client" type="hidden" value='<?php echo $num_client; ?>'>
</form>
<a href='logout.php'><h2><?php echo $lang_sortir; ?></h2></a> 
<?php
include_once("../include/bas_cli.php");
