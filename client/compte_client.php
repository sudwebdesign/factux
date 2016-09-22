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
 ?>  <form action="client_update.php" method="post" name="client" id="client"
	  onSubmit="return verif_formulaire()">
  <table class="boiteaction">
    <caption>
    <?php echo "$lang_chng_mdp"; ?>
    </caption>
    <tr> 
    <tr>
      <td class="texte0"><?php echo $lang_login; ?></td><td class="texte0"> <?php echo "<b>$login</b>" ?> </td>
      <input name="login" type="hidden" id="login" value="<?php echo "$login " ?>"></td>
    </tr>
    <tr>
      <td class="texte0"><?php echo $lang_motdepasse_ancien; ?> </td><td class="texte0"><input name = "pass" type="password"> 
      </td>
    </tr>
    <tr>
      <td class="texte0"><?php echo $lang_motdepasse_nouveau; ?></td><td class="texte0"> <input name = "pass_new" type= "password"> 
      </td>
    </tr>
    <tr>
      <td class="texte0"><?php echo $lang_motdepasse_verification; ?> </td><td class="texte0"><input name = "pass_new2" type = "password"> 
      </td>
    </tr>
    <tr>
      <td class="submit" colspan="2"> <input type="submit" value="<?php echo $lang_motdepasse_changer; ?>" /> 
        <input type="reset" value="<?php echo $lang_annuler; ?>" /> </td>
    </tr>
  </table>
  <input name="num_client" type="hidden" value='<?php echo $num_client; ?>'>
</form>
<center><a href='logout.php'><?php echo $lang_sortir ?></a> 
<?php
include_once("../include/bas_cli.php");
?>
