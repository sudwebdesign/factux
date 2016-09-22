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
?>
</td>
</tr>
<tr>
<td  class="page" align="center">
<tr><TD>
<?php
$num=isset($_GET['num'])?$_GET['num']:"";
$sql = " SELECT * FROM " . $tblpref ."client WHERE num_client='$num'";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql2.'<br>'.mysql_error());
while($data = mysql_fetch_array($req))
{
  $nom = htmlentities($data['nom'], ENT_QUOTES);
  $nom2 = htmlentities($data['nom2'], ENT_QUOTES);
  $rue = htmlentities($data['rue'], ENT_QUOTES);
  $ville = htmlentities($data['ville'], ENT_QUOTES);
  $cp = htmlentities($data['cp'], ENT_QUOTES);
  $tva = htmlentities($data['num_tva'], ENT_QUOTES);
  $mail =htmlentities($data['mail'], ENT_QUOTES);
  $login = htmlentities($data['login'], ENT_QUOTES);
	$civ = htmlentities($data['civ'], ENT_QUOTES);
	$tel = htmlentities($data['tel'], ENT_QUOTES);
	$fax = htmlentities($data['fax'], ENT_QUOTES);
}
?>
<form name="edit_client" method="post" action="client_update.php" onsubmit="return confirmUpdate()">
  <table class="boiteaction">
    <caption>
    <?php echo "$lang_client_modifier $nom"; ?> 
    </caption>
		    <tr> 
      <td class="texte0"><?php echo civilité; ?></td>
      <td class="texte0"> <input name="civ" type="text" id="civ" value='<?php echo "$civ"; ?>'></td>
    </tr>
    <tr> 
      <td class="texte1"><?php echo $lang_nom; ?></td>
      <td class="texte1"> <input name="nom" type="text" id="nom" value="<?php echo "$nom"; ?>"></td>
    </tr>
    <tr> 
      <td class="texte0"> <?php echo $lang_complement; ?> </td>
      <td class="texte0"><input name="nom_sup" type="text" id="nom_sup"
	    value='<?php echo "$nom2"; ?>'> </td>
    </tr>
    <tr> 
      <td class="texte1"> <?php echo $lang_rue; ?> </td>
      <td class="texte1"><input name="rue" type="text" id="rue"
	  value='<?php echo "$rue"; ?>'> </td>
    </tr>
    <tr> 
      <td class="texte0"> <?php echo $lang_code_postal; ?></td>
      <td class="texte0"><input name="code_post" type="text" id="code_post" value="<?php echo "$cp"; ?>"> 
      </td>
    <tr> 
      <td class="texte1"> <?php echo $lang_ville; ?> </td>
      <td class="texte1"><input name="ville" type="text" id="ville" value="<?php echo "$ville"; ?>"></td>
    <tr> 
      <td class="texte0"> <?php echo $lang_numero_tva; ?> </td>
      <td class="texte0"><input name="num_tva" type="text" id="num_tva" value="<?php echo "$tva"; ?>"> 
      </td>
    </tr>
		    <tr> 
      <td class="texte1"><?php echo telephone; ?></td>
      <td class="texte1"> <input name="tel" type="text" id="tel" value='<?php echo "$tel"; ?>'></td>
    </tr>
		    <tr> 
      <td class="texte0"><?php echo fax; ?></td>
      <td class="texte0"> <input name="fax" type="text" id="fax" value='<?php echo "$fax"; ?>'></td>
    </tr>
    <tr> 
      <td class="submit" colspan="2"> <?php echo $lang_client_accesprive; ?> 
	  
	 </td>
	 <tr><td class="texte0"> 
	  <?php echo $lang_login; ?> 
      </td>
      <td class="texte0"> 
        <?php 
if ($login != '') {
echo $login; ?>
        <input name='login2' type='hidden' id='login2' value='<?php echo $login; ?>'>
        <?php } else { ?> 
        <input name='logincli' type='text' > 
        <?php
	}
	?>
      </td>
    </tr>
    <tr> 
      <td class="texte1"><?php echo $lang_mot_de_passe; ?> </td>
      <td class="texte1"><input name="passcli" type="password" > </td>
    </tr>
    <tr> 
      <td class="texte0"><?php echo "$lang_motdepasse_verification"; ?> </td>
      <td class="texte0"><input name="pass2cli" type="password" > </td>
    </tr>
    <tr> 
      <td class="texte1"><?php echo $lang_email; ?> </td>
      <td class="texte1"> <input name="mail" type="text" id="mail"
	  value="<?php echo "$mail"; ?>"> </td>
    </tr>
    <tr> 
      <td class="submit" colspan="2"><input type="submit" name="Submit" value="<?php echo $lang_envoyer; ?>">
            &nbsp; 
              <input type="reset" name="Submit2" value="<?php echo $lang_retablir; ?>">
	      <input name="num" type="hidden" value="<?php echo $num; ?>">
	      </td> </tr></table></form>

</td></tr>
<tr><td>
<?php
include("help.php");
include_once("include/bas.php");
?>
</td></tr></table></body>
</html>
