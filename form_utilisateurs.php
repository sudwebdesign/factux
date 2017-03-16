<?php 
/*
 * Factux le facturier libre
 * Copyright (C) 2003-2005 Guy Hendrickx, 2017 Thomas Ingles
 * 
 * Licensed under the terms of the GNU  General Public License:
 *   http://opensource.org/licenses/GPL-3.0
 * 
 * For further information visit:
 *   http://factux.free.fr
 * 
 * File Name: fckconfig.js
 * 	Editor configuration settings.
 * 
 * * * Version:  5.0.0
 * * * * Modified: 07/10/2016
 * 
 * File Authors:
 *   Guy Hendrickx
 *.
 */
include_once("include/headers.php");
include_once("include/finhead.php");
?>
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php
include_once("include/head.php");
if (isset($message)&&$message!='') { 
 echo $message; 
}
if ($user_admin != 'y') { 
 echo "<h1>$lang_admin_droit</h1>";
 exit;
}
?> 
   <form action="register.php" method="post" name="utilisateur" id="utilisateur">
    <table class='page boiteaction'>
     <caption><?php echo $lang_utilisateur_ajouter; ?></caption>
     <tr> 
      <td class='<?php echo couleur_alternee (); ?>'><?php echo $lang_utilisateur_nom; ?></td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'><input name="login2" type="text" id="login2" maxlength="10" /></td>
     </tr>
     <tr> 
      <td class='<?php echo couleur_alternee (); ?>'> <?php echo $lang_nom; ?></td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'><input name="nom" type="text" id="nom" maxlength="20" /></td>
     </tr>
     <tr> 
      <td class='<?php echo couleur_alternee (); ?>'><?php echo $lang_prenom; ?></td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'><input name="prenom" type="text" id="prenom" maxlength="20" /></td>
     </tr>
     <tr> 
      <td class='<?php echo couleur_alternee (); ?>'><?php echo $lang_motdepasse; ?></td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'><input name="pass" type="password" id="pass" maxlength="30" /></td>
     </tr>
     <tr> 
      <td class='<?php echo couleur_alternee (); ?>'><?php echo $lang_mot_de_passe; ?></td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'><input name="pass2" type="password" id="pass2" maxlength="30" /></td>
     </tr>
     <tr> 
      <td class='<?php echo couleur_alternee (); ?>'><?php echo $lang_mail; ?></td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'><input name="mail" type="text" id="mail" maxlength="30" /></td>
     </tr>
     <tr>
      <td class="submit" colspan="2" ><?php echo $lang_util_droit ?></td>
     </tr>
     <tr>
      <td class='<?php echo couleur_alternee (); ?>'><?php echo $lang_ger_dev ?></td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'>
       <select name ="dev">
        <option value="n"><?php echo $lang_non ?></option>
        <option value="y"><?php echo $lang_oui ?></option>
        <option value="r"><?php echo $lang_restrint ?></option>
       </select>
      </td>
     </tr>
     <tr>
      <td class='<?php echo couleur_alternee (); ?>'><?php echo $lang_ger_com ?></td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'>
       <select name ="com">
        <option value="n"><?php echo $lang_non ?></option>
        <option value="y"><?php echo $lang_oui ?></option>
        <option value="r"><?php echo $lang_restrint ?></option>
       </select>
      </td>
     </tr>
     <tr>
      <td class='<?php echo couleur_alternee (); ?>'><?php echo $lang_ger_fact ?></td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'>
       <select name ="fact">
        <option value="n"><?php echo $lang_non ?></option>
        <option value="y"><?php echo $lang_oui ?></option>
        <option value="r"><?php echo $lang_restrint ?></option>
       </select>
      </td>
     </tr>
     <tr>
      <td class='<?php echo couleur_alternee (); ?>'><?php echo $lang_ger_dep ?></td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'>
       <select name ="dep">
        <option value="n"><?php echo $lang_non ?></option>
        <option value="y"><?php echo $lang_oui ?></option>
       </select>
      </td>
     </tr>
     <tr>
      <td class='<?php echo couleur_alternee (); ?>'><?php echo $lang_ger_stat ?></td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'>
       <select name ="stat">
        <option value="n"><?php echo $lang_non ?></option>
        <option value="y"><?php echo $lang_oui ?></option>
       </select>
      </td>
     </tr>
     <tr>
      <td class='<?php echo couleur_alternee (); ?>'><?php echo $lang_ger_art ?></td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'>
       <select name ="art">
        <option value="n"><?php echo $lang_non ?></option>
        <option value="y"><?php echo $lang_oui ?></option>
       </select>
      </td>
     </tr>
     <tr>
      <td class='<?php echo couleur_alternee (); ?>'><?php echo $lang_ger_cli ?></td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'>
       <select name ="cli">
        <option value="n"><?php echo $lang_non ?></option>
        <option value="y"><?php echo $lang_oui ?></option>
       </select>
      </td>
     </tr>
     <tr>
      <td class='<?php echo couleur_alternee (); ?>'><?php echo $lang_dr_admi ?><br><?php echo $lang_admi_modu ?></td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'>
       <select name ="admin">
        <option value="n"><?php echo $lang_non ?></option>
        <option value="y"><?php echo $lang_oui ?></option>
       </select>
      </td>
     </tr>
     <tr>
      <td class="submit" colspan="2">
       <input type="submit" name="Submit" value="<?php echo $lang_envoyer; ?>" />
       <input name="reset" type="reset" id="reset" value="<?php echo $lang_effacer; ?>" />
      </td>
     </tr>
    </table>
   </form>
  </td>
 </tr>
 <tr>
  <td>
<?php
$aide='admin';
include("help.php");
include_once("include/bas.php");
?>
  </td>
 </tr>
</table>
</body>
</html>
