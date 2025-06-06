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
 * File Name: form_client.php
 * 	Formulaire d'enregistrement des clients
 *
 * * * Version:  5.0.0
 * * * * Modified: 07/10/2016
 *
 * File Authors:
 * 		Guy Hendrickx
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
if ($user_cli == 'n') {
 echo"<h1>$lang_client_droit</h1>";
 include_once("include/bas.php");
 exit;
}
if(isset($message)&&$message!='') {
 echo $message;$message='';
}
?>
   <center>
    <form action="client_new.php" method="post" name="client" id="client" >
     <table border='0' class='page' align='center'>
      <caption><?php echo $lang_client_ajouter; ?></caption>
      <tr>
       <td class="texte0"><?php echo $lang_civ; ?></td>
       <td class="texte0"><input name="civ" type="text" id="civ" maxlength="15" value="<?php echo @$civ; ?>"></td>
      </tr>
      <tr>
       <td class="texte1"><?php echo $lang_nom; ?></td>
       <td class="texte1"><input name="nom" type="text" id="nom" maxlength="30" value="<?php echo @$nom; ?>"></td>
      </tr>
      <tr>
       <td class="texte0"><?php echo $lang_complement; ?></td>
       <td class="texte0"><input name="nom_sup" type="text" id="nom_sup" maxlength="30" value="<?php echo @$nom_sup; ?>"></td>
      </tr>
      <tr>
       <td class="texte1"><?php echo $lang_rue; ?></td>
       <td class="texte1"><input name="rue" type="text" id="rue" maxlength="30" value="<?php echo @$rue; ?>"></td>
      </tr>
      <tr>
       <td class="texte0"><?php echo $lang_code_postal; ?></td>
       <td class="texte0"><input name="code_post" type="text" maxlength="5" size="5" id="code_post" value="<?php echo @$code_post; ?>"></td>
      </tr>
      <tr>
       <td  class="texte1"><?php echo $lang_ville; ?></td>
       <td class="texte1"><input name="ville" type="text" id="ville" maxlength="30" value="<?php echo @$ville; ?>"></td>
      </tr>
      <tr>
       <td class="texte0"><?php echo $lang_numero_tva; ?></td>
       <td class="texte0"><input name="num_tva" type="text" id="num_tva" maxlength="30" value="<?php echo @$num_tva; ?>"></td>
      </tr>
      <tr>
       <td class="texte1"><?php echo $lang_tele; ?></td>
       <td class="texte1"><input name="tel" type="text" id="tel" maxlength="30" value="<?php echo @$tel; ?>"></td>
      </tr>
      <tr>
       <td class="texte0"><?php echo 'fax'; ?></td>
       <td class="texte0"><input name="fax" type="text" id="fax" maxlength="30" value="<?php echo @$fax; ?>"></td>
      </tr>
      <tr>
       <td class="submit" colspan="2" align="left"><?php echo $lang_client_accesprive; ?></td>
      </tr>
      <tr>
       <td class="texte0"><?php echo $lang_login; ?></td>
       <td class="texte0"><input name="login" type="text" maxlength="10" value="<?php echo @$login; ?>"></td>
      </tr>
      <tr>
       <td class="texte1"><?php echo $lang_mot_de_passe; ?></td>
       <td class="texte1"><input name="pass" type="password" maxlength="40"></td>
      </tr>
      <tr>
       <td class="texte0"><?php echo $lang_motdepasse_verification; ?></td>
       <td class="texte0"><input name="pass2" type="password" maxlength="40"></td>
      </tr>
      <tr>
       <td class="texte1"><?php echo $lang_email; ?></td>
       <td class="texte1"><input name="mail" type="text" id="mail" maxlength="30" value="<?php echo @$mail_cli; ?>"></td>
      </tr>
      <tr>
       <td class="submit" colspan="2">
        <input type="submit" name="Submit" value="<?php echo $lang_envoyer; ?>">
         &nbsp;&nbsp;
        <input type="reset" name="Submit2" value="<?php echo $lang_retablir; ?>">
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
include("lister_clients.php");
