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
 * File Name: fckconfig.js
 * 	Editor configuration settings.
 *
 * * * Version:  5.0.0
 * * * * Modified: 07/10/2016
 *
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
if (!isset($num_client)) {
    header("Location:index.php");
}
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
include_once(__DIR__ . "/../include/bas_cli.php");
