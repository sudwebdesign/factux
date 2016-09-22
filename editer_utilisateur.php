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
if ($num_user=='') { 
$num_user=isset($_GET['num_user'])?$_GET['num_user']:"";
}
?>
<html>
<head>
 <title><?php echo "$lang_factux" ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="include/style.css">
<link rel="shortcut icon" type="image/x-icon" href="image/favicon.ico" >
</head>

<body>
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
<?php 
if ($user_admin != y) { 
echo "<h1>$lang_admin_droit";
exit;
}
 ?> 
<?php 
$sql = " SELECT * FROM " . $tblpref ."user WHERE num = $num_user ";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());

while($data = mysql_fetch_array($req))
{
$nom = $data['nom'];
$prenom = $data['prenom'];
$login = $data['login'];
$dev = $data['dev'];
		if ($dev == y) { $dev = $lang_oui ;}
		if ($dev == n) { $dev = $lang_non ; }
		if ($dev == r) { $dev = $lang_restrint ; }
$com = $data['com'];
				if ($com == y) { $com = $lang_oui ; }
		if ($com == n) { $com = $lang_non ; }
		if ($com == r) { $com = $lang_restrint ; }
$fact = $data['fact'];
				if ($fact == y) { $fact = $lang_oui ; }
		if ($fact == n) { $fact = $lang_non ; }
		if ($fact == r) { $fact = $lang_restrint ; }
$mail =$data['email'];
$dep = $data['dep'];
				if ($dep == y) { $dep = $lang_oui ; }
		if ($dep == n) { $dep = $lang_non ; }
$stat = $data['stat'];
				if ($stat == y) { $stat = $lang_oui ; }
		if ($stat == n) { $stat = $lang_non ; }
$art = $data['art'];
				if ($art == y) { $art = $lang_oui ; }
		if ($art == n) { $art = $lang_non ; }
$cli = $data['cli'];
				if ($cli == y) { $cli = $lang_oui ; }
		if ($cli == n) { $cli = $lang_non ; }
		if ($dev == r) { $dev = $lang_restrint ; }
$admin = $data['admin'];
		if ($admin == y) { $admin = $lang_oui ; }
		if ($admin == n) { $admin = $lang_non ; }
$num_user = $data['num'];
}
		?>


</tr>
<tr>
<td  class="page" align="center">
<form action="suite_edit_utilisateur.php" method="post" name="utilisateur" id="utilisateur">
  <table class="boiteaction">
  <caption>
  <?php echo $lang_utilisateur_editer; ?>
  </caption>
    <tr> 
      <td class='<?php echo couleur_alternee (); ?>'><?php echo $lang_utilisateur_nom; ?></td>
      <td colspan="2" class='<?php echo couleur_alternee (FALSE); ?>'><?php echo $login ?>
			<input type="hidden" name="login2" value="<?php echo $login ?>" /></td>
    </tr>
    <tr> 
      <td  class='<?php echo couleur_alternee (); ?>'> <?php echo $lang_nom; ?></td>
      <td colspan="2" class='<?php echo couleur_alternee (FALSE); ?>'><input name="nom" type="text" id="nom" value="<?php echo $nom ?>"></td>
    </tr>
    <tr> 
      <td  class='<?php echo couleur_alternee (); ?>'><?php echo $lang_prenom; ?></td>
      <td colspan="2" class='<?php echo couleur_alternee (FALSE); ?>'><input name="prenom" type="text" id="prenom" value="<?php echo $prenom ?>"></td>
    </tr>
    <tr> 
      <td  class='<?php echo couleur_alternee (); ?>'><?php echo $lang_motdepasse; ?></td>
      <td colspan="2" class='<?php echo couleur_alternee (FALSE); ?>'><input name="pass" type="password" id="pass"></td>
    </tr>
    <tr> 
      <td c class='<?php echo couleur_alternee (); ?>'><?php echo $lang_mot_de_passe; ?></td>
      <td colspan="2" class='<?php echo couleur_alternee (FALSE); ?>'><input name="pass2" type="password" id="pass2"></td>
    </tr>
    <tr> 
      <td  class='<?php echo couleur_alternee (); ?>'><?php echo $lang_mail; ?></td>
      <td colspan="2" class='<?php echo couleur_alternee (FALSE); ?>'><input name="mail" type="text" id="mail" value="<?php echo $mail ?>" ></td>
    </tr>
		<tr>
		<td class="submit" colspan="2" ><?php echo $lang_util_droit?></td>
		<td class="submit"><?php echo $lang_val_actu ?></td>
		</tr>
		<tr>
		<td class='<?php echo couleur_alternee (); ?>'><?php echo $lang_ger_dev ?></td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'><select name ="dev">
			<option value="n"><?php echo $lang_non ?></option>
			<option value="y"><?php echo $lang_oui ?></option>
			<option value="r"><?php echo $lang_restrint ?></option>
			</select>
			</td>
			<td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo "<b>$dev </b>"; ?></td>
			</tr>
			
		<tr>
		<td class='<?php echo couleur_alternee (); ?>'><?php echo $lang_ger_com ?></td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'><select name ="com">
			<option value="n"><?php echo $lang_non ?></option>
			<option value="y"><?php echo $lang_oui ?></option>
			<option value="r"><?php echo $lang_restrint ?></option>
			</select>
			</td>
			<td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo "<b>$com </b>"; ?></td>
			</tr>
			
		<tr>
		<td class='<?php echo couleur_alternee (); ?>'><?php echo $lang_ger_fact ?></td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'><select name ="fact">
			<option value="n"><?php echo $lang_non ?></option>
			<option value="y"><?php echo $lang_oui ?></option>
			<option value="r"><?php echo $lang_restrint ?></option>
			</select>
			</td>
			<td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo "<b>$fact </b>"; ?></td>
			</tr>
			
		<tr>
		<td class='<?php echo couleur_alternee (); ?>'><?php echo $lang_ger_dep ?></td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'><select name ="dep">
			<option value="n"><?php echo $lang_non ?></option>
			<option value="y"><?php echo $lang_oui ?></option>
			</select>
			</td>
			<td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo "<b>$dep </b>"; ?></td>
			</tr>
			
		<tr>
		<td class='<?php echo couleur_alternee (); ?>'><?php echo $lang_ger_stat ?></td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'><select name ="stat">
			<option value="n"><?php echo $lang_non ?></option>
			<option value="y"><?php echo $lang_oui ?></option>
			</select>
			</td>
			<td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo "<b>$stat </b>"; ?></td>
			</tr>
			
		<tr>
		<td class='<?php echo couleur_alternee (); ?>'><?php echo $lang_ger_art ?></td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'><select name ="art">
			<option value="n"><?php echo $lang_non ?></option>
			<option value="y"><?php echo $lang_oui ?></option>
			</select>
			</td>
			<td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo "<b>$art </b>"; ?></td>
			</tr>
			
		<tr>
		<td class='<?php echo couleur_alternee (); ?>'><?php echo $lang_ger_cli ?></td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'><select name ="cli">
			<option value="n"><?php echo $lang_non ?></option>
			<option value="y"><?php echo $lang_oui ?></option>
			</select>
			</td>
			<td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo "<b>$cli </b>"; ?></td>
			</tr>
			
		<tr>
		<td class='<?php echo couleur_alternee (); ?>'><?php echo $lang_dr_admi ?><br><?php echo $lang_admi_modu ?></td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'><select name ="admin">
			<option value="n"><?php echo $lang_non ?></option>
			<option value="y"><?php echo $lang_oui ?></option>
			</select>
			</td>
			<td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo "<b>$admin </b>"; ?></td>
			</tr>
    <tr><input type="hidden" name="num_user" value="<?php echo $num_user ?>" /> 
      <td class="submit" colspan="3"> <input type="submit" name="Submit" value="<?php echo $lang_envoyer; ?>"> 
        <input name="reset" type="reset" id="reset" value="<?php echo $lang_effacer; ?>"> 
      </td>
    </tr>
  </table>
</form>
</td></tr>
<?php 
if ($fact == $lang_restrint || $com == $lang_restrint || $dev == $lang_restrint ) { 
include_once("edit_choix_cli.php");
require_once("lister_clients_restreint.php");
}
 ?> 
</table>
<?php 
include_once("include/bas.php");
 ?> 