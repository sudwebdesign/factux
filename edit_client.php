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
include_once(__DIR__ . "/include/headers.php");
include_once(__DIR__ . "/include/finhead.php");
?>
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php
include_once(__DIR__ . "/include/head.php");
if (isset($message)&&$message!='') {
 echo $message;
}
$num=isset($_GET['num'])?$_GET['num']:"";
$sql = " SELECT * FROM " . $tblpref .sprintf("client WHERE num_client='%s'", $num);
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_array($req)){
 $nom = $data['nom'];#htmlentities($data['nom'], ENT_QUOTES);
 $nom2 = $data['nom2'];#htmlentities($data['nom2'], ENT_QUOTES);
 $rue = $data['rue'];#htmlentities($data['rue'], ENT_QUOTES);
 $ville = $data['ville'];#htmlentities($data['ville'], ENT_QUOTES);
 $cp = $data['cp'];#htmlentities($data['cp'], ENT_QUOTES);
 $tva = $data['num_tva'];#htmlentities($data['num_tva'], ENT_QUOTES);
 $mail = $data['mail'];#htmlentities($data['mail'], ENT_QUOTES);
 $login = $data['login'];#htmlentities($data['login'], ENT_QUOTES);
 $civ = $data['civ'];#htmlentities($data['civ'], ENT_QUOTES);
 $tel = $data['tel'];#htmlentities($data['tel'], ENT_QUOTES);
 $fax = $data['fax'];#htmlentities($data['fax'], ENT_QUOTES);
}
?>
   <form name="edit_client" method="post" action="client_update.php" onsubmit="return confirmUpdate()">
    <table border="0" class="page" align="center">
     <caption><?php echo sprintf('%s %s', $lang_client_modifier, $nom); ?></caption>
     <tr>
      <td class="texte0"><?php echo $lang_civ; ?></td>
      <td class="texte0"> <input name="civ" type="text" id="civ" maxlength="15" value='<?php echo $civ; ?>'></td>
     </tr>
     <tr>
      <td class="texte1"><?php echo $lang_nom; ?></td>
      <td class="texte1"> <input name="nom" type="text" id="nom" maxlength="30" value='<?php echo $nom; ?>'></td>
     </tr>
     <tr>
      <td class="texte0"> <?php echo $lang_complement; ?> </td>
      <td class="texte0"><input name="nom_sup" type="text" id="nom_sup" maxlength="30" value='<?php echo $nom2; ?>'></td>
     </tr>
     <tr>
      <td class="texte1"> <?php echo $lang_rue; ?> </td>
      <td class="texte1"><input name="rue" type="text" id="rue" maxlength="30" value='<?php echo $rue; ?>'></td>
     </tr>
     <tr>
      <td class="texte0"><?php echo $lang_code_postal; ?></td>
      <td class="texte0"><input name="code_post" type="text" id="code_post" maxlength="5" size="5" value="<?php echo $cp; ?>"></td>
     </tr>
     <tr>
      <td class="texte1"><?php echo $lang_ville; ?></td>
      <td class="texte1"><input name="ville" type="text" id="ville" maxlength="30" value='<?php echo $ville; ?>'></td>
     </tr>
     <tr>
      <td class="texte0"><?php echo $lang_numero_tva; ?></td>
      <td class="texte0"><input name="num_tva" type="text" id="num_tva" maxlength="30" value='<?php echo $tva; ?>'></td>
     </tr>
     <tr>
      <td class="texte1"><?php echo $lang_tele; ?></td>
      <td class="texte1"><input name="tel" type="text" id="tel" maxlength="30" value='<?php echo $tel; ?>'></td>
     </tr>
     <tr>
      <td class="texte0"><?php echo 'fax'; ?></td>
      <td class="texte0"><input name="fax" type="text" id="fax" maxlength="30" value='<?php echo $fax; ?>'></td>
     </tr>
     <tr>
      <td class="submit" colspan="2"><?php echo $lang_client_accesprive; ?></td>
     </tr>
	    <tr>
      <td class="texte0"><?php echo $lang_login; ?></td>
      <td class="texte0">
<?php
 if ($login != '') {
echo $login;
?>
        <input name='login2' type='hidden' id='login2' value='<?php echo $login; ?>'>
<?php } else { ?>
        <input name='logincli' type='text' maxlength="10">
<?php } ?>
      </td>
     </tr>
     <tr>
      <td class="texte1"><?php echo $lang_mot_de_passe; ?></td>
      <td class="texte1"><input name="passcli" type="password" maxlength="40"></td>
     </tr>
     <tr>
      <td class="texte0"><?php echo $lang_motdepasse_verification; ?></td>
      <td class="texte0"><input name="pass2cli" type="password" maxlength="40"></td>
     </tr>
     <tr>
      <td class="texte1"><?php echo $lang_email; ?></td>
      <td class="texte1"> <input name="mail" type="text" id="mail" maxlength="30" value="<?php echo $mail; ?>"></td>
     </tr>
     <tr>
      <td class="submit" colspan="2">
       <input type="submit" name="Submit" value="<?php echo $lang_envoyer; ?>">
            &nbsp;
       <input type="reset" name="Submit2" value="<?php echo $lang_retablir; ?>">
	      <input name="num" type="hidden" value="<?php echo $num; ?>">
      </td>
     </tr>
    </table>
   </form>
  </td>
 </tr>
 <tr>
  <td>
<?php
$aide='client';
include(__DIR__ . "/help.php");
include_once(__DIR__ . "/include/bas.php");
?>
  </td>
 </tr>
</table>
</body>
</html>
