<?php 
/*
 * Factux le facturier libre
 * Copyright (C) 2003-2004 Guy Hendrickx
 * 
 * Licensed under the terms of the GNU  General Public License:
 *     http://www.opensource.org/licenses/gpl-license.php
 * 
 * For further information visit:
 *     http://factux.sourceforge.net
 * 
 * File Name: fckconfig.js
 * 	Editor configuration settings.
 * 
 * * * Version:  1.1.5
 * * * * Modified: 23/07/2005
 * 
 * File Authors:
 *     Guy Hendrickx
 *.
 */
if(!isset($num_user))
 if(isset($_GET['num_user']))
  $num_user=$_GET['num_user'];#if redirected with get
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
$sql = " SELECT * FROM " . $tblpref ."user WHERE num = $num_user ";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_array($req)){
 $nom = $data['nom'];
 $prenom = $data['prenom'];
 $login = $data['login'];
 $dev = $data['dev'];
 $com = $data['com'];
 $fact = $data['fact'];
 $mail =$data['email'];
 $dep = $data['dep'];
 $stat = $data['stat'];
 $art = $data['art'];
 $cli = $data['cli'];
 $admin = $data['admin'];
 $num_user = $data['num'];
}
?>
   <form action="edit_utilisateur_suite.php" method="post" name="utilisateur" id="utilisateur">
    <table class='page boiteaction'>
     <caption><?php echo $lang_utilisateur_editer; ?></caption>
     <tr> 
      <td class='<?php echo couleur_alternee (); ?>'><?php echo $lang_utilisateur_nom; ?></td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'><b><?php echo $login ?></b>
       <input type="hidden" name="login2" value="<?php echo $login ?>" />
      </td>
     </tr>
     <tr> 
      <td class='<?php echo couleur_alternee (); ?>'> <?php echo $lang_nom; ?></td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'><input name="nom" type="text" id="nom" value="<?php echo $nom ?>" maxlength="10" /></td>
     </tr>
     <tr> 
      <td class='<?php echo couleur_alternee (); ?>'><?php echo $lang_prenom; ?></td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'><input name="prenom" type="text" id="prenom" value="<?php echo $prenom ?>" maxlength="20" /></td>
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
      <td class='<?php echo couleur_alternee (FALSE); ?>'><input name="mail" type="text" id="mail" value="<?php echo $mail ?>" maxlength="30" /></td>
     </tr>
     <tr>
      <th><?php echo $lang_util_droit; ?></th>
      <th><?php echo $lang_choisissez; ?></th>
     </tr>
     <tr>
      <td class='<?php echo couleur_alternee (); ?>'><?php echo $lang_ger_dev ?></td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'>
       <select name ="dev">
        <option <?php if($dev =='n'){echo "selected";} ?> value="n"><?php echo $lang_non ?></option>
        <option <?php if($dev =='y'){echo "selected";} ?> value="y"><?php echo $lang_oui ?></option>
        <option <?php if($dev =='r'){echo "selected";} ?> value="r"><?php echo $lang_restrint ?></option>
       </select>
      </td>
     </tr>
     <tr>
      <td class='<?php echo couleur_alternee (); ?>'><?php echo $lang_ger_com ?></td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'>
       <select name ="com">
        <option <?php if($com =='n'){echo "selected";} ?> value="n"><?php echo $lang_non ?></option>
        <option <?php if($com =='y'){echo "selected";} ?> value="y"><?php echo $lang_oui ?></option>
        <option <?php if($com =='r'){echo "selected";} ?> value="r"><?php echo $lang_restrint ?></option>
       </select>
      </td>
     </tr>
     <tr>
      <td class='<?php echo couleur_alternee (); ?>'><?php echo $lang_ger_fact ?></td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'>
       <select name ="fact">
        <option <?php if($fact =='n'){echo "selected";} ?> value="n"><?php echo $lang_non ?></option>
        <option <?php if($fact =='y'){echo "selected";} ?> value="y"><?php echo $lang_oui ?></option>
        <option <?php if($fact =='r'){echo "selected";} ?> value="r"><?php echo $lang_restrint ?></option>
       </select>
      </td>
     </tr>
     <tr>
      <td class='<?php echo couleur_alternee (); ?>'><?php echo $lang_ger_dep ?></td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'>
       <select name ="dep">
        <option <?php if($dep =='n'){echo "selected";} ?> value="n"><?php echo $lang_non ?></option>
        <option <?php if($dep =='y'){echo "selected";} ?> value="y"><?php echo $lang_oui ?></option>
       </select>
      </td>
     </tr>
     <tr>
      <td class='<?php echo couleur_alternee (); ?>'><?php echo $lang_ger_stat ?></td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'>
       <select name ="stat">
        <option <?php if($stat =='n'){echo "selected";} ?> value="n"><?php echo $lang_non ?></option>
        <option <?php if($stat =='y'){echo "selected";} ?> value="y"><?php echo $lang_oui ?></option>
       </select>
      </td>
     </tr>
     <tr>
      <td class='<?php echo couleur_alternee (); ?>'><?php echo $lang_ger_art ?></td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'>
       <select name ="art">
        <option <?php if($art =='n'){echo "selected";} ?> value="n"><?php echo $lang_non ?></option>
        <option <?php if($art =='y'){echo "selected";} ?> value="y"><?php echo $lang_oui ?></option>
       </select>
      </td>
     </tr>
     <tr>
      <td class='<?php echo couleur_alternee (); ?>'><?php echo $lang_ger_cli ?></td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'>
       <select name ="cli">
        <option <?php if($cli =='n'){echo "selected";} ?> value="n"><?php echo $lang_non ?></option>
        <option <?php if($cli =='y'){echo "selected";} ?> value="y"><?php echo $lang_oui ?></option>
       </select>
      </td>
     </tr>
     <tr>
      <td class='<?php echo couleur_alternee (); ?>'><?php echo $lang_dr_admi ?><br><?php echo $lang_admi_modu ?></td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'>
       <select name ="admin">
        <option <?php if($admin =='n'){echo "selected";} ?> value="n"><?php echo $lang_non ?></option>
        <option <?php if($admin =='y'){echo "selected";} ?> value="y"><?php echo $lang_oui ?></option>
       </select>
      </td>
     </tr>
     <tr>
      <td class="submit" colspan="3"> 
       <input type="submit" name="Submit" value="<?php echo $lang_modifier; ?>" />
       &nbsp;&nbsp;
       <input name="reset" type="reset" id="reset" value="<?php echo $lang_val_actu; ?>" />
       <input type="hidden" name="num_user" value="<?php echo $num_user ?>" /> 
      </td>
     </tr>
    </table>
   </form>
  </td>
 </tr>
 <tr>
  <td>
<?php 
if ($fact == 'r' || $com == 'r' || $dev == 'r' ){ 
	include("edit_choix_cli.php");
	include("lister_clients_restreint.php");

?>
  </td>
 </tr>
 <tr>
  <td>
<?php 
}#fi fact,com,dev
$aide='utilisateurs';
include("help.php");
include_once("include/bas.php");
?>
   </td>
  </tr>
 </table>
</body>
</html>
