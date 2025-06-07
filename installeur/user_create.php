<?php
/*
 * Factux le facturier libre
 * Copyright (C) 2003-2005 Guy Hendrickx, 2017~ Thomas Ingles
 *
 * Licensed under the terms of the GNU  General Public License:
 * 		http://opensource.org/licenses/GPL-3.0
 *
 * For further information visit:
 * 		http://factux.free.fr
 *
 * File Name: user_create.php
 * 	creation de l'utilisateur principal
 *
 * * * * Version:  8.0.0
 * * * * Modified: 07/06/2025
 *
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
 $etape = "Étape N°5 : Enregister l'utilisateur primaire";
 include_once(__DIR__ . '/headers.php');
?>
    <br><h2><?php echo $lang_utilisateur_ajouter; ?></h2><br><br>
    <p><?php echo $lang_install_user_create; ?></p>
     <center>
      <form action="register.php" method="post" name="utilisateur" id="utilisateur">
       <table bgcolor="#FFFFCC" border="1" cellspacing="0" cellpadding="0">
        <tr>
         <td><?php echo $lang_nom; ?></td>
         <td><input name="nom" type="text" id="nom"></td>
        </tr>
        <tr>
         <td><?php echo $lang_prenom; ?></td>
         <td><input name="prenom" type="text" id="prenom"></td>
        </tr>
        <tr>
         <td><?php echo $lang_utilisateur_nom; ?></td>
         <td><input name="login2" type="text" id="login2"></td>
        </tr>
        <tr>
         <td><?php echo $lang_motdepasse; ?></td>
         <td><input name="pass" type="password" id="pass"></td>
        </tr>
        <tr>
         <td><?php echo $lang_mot_de_passe; ?></td>
         <td><input name="pass2" type="password" id="pass2"></td>
        </tr>
        <tr>
         <td><?php echo $lang_mail; ?></td>
         <td><input name="mail" type="text" id="mail"></td>
        </tr>
        <tr>
         <td><input type="submit" name="Submit" value="<?php echo $lang_envoyer; ?>"></td>
         <td><input name="reset" type="reset" id="reset" value="<?php echo $lang_effacer; ?>"></td>
        </tr>
       </table>
      </form>
     </center>
   <br><hr>
<?php include_once(__DIR__ . "/../include/bas_cli.php"); ?>
  </td>
 </tr>
</table>
</body>
</html>

