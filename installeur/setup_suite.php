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
 ?>
   <h2>Installation de Factux suite</h2>
   <p>Nous allons maintenant enregistrer les données qui figureront sur vos bons de commande et factures</p>
   <hr><br>
   <center>
    <form action="setup_3.php" method="post" name="artice" id="artice">
     <table style="color:green">
      <tr>
       <td>Nom de l'entreprise</td>
       <td><input name="zero" type="text" maxlength="140"></td>
      </tr>
      <tr>
       <td>Siège social de l'entreprise</td>
       <td><input name="un" type="text" maxlength="140"></td>
      </tr>
      <tr>
       <td>Numéro de téléphone de l'entreprise</td>
       <td><input name="deux" type="text"  ></td>
      </tr>
      <tr>
       <td>Numéro de T.V.A. de l'entreprise</td>
       <td><input name="trois" type="text" ></td>
      </tr>
      <tr>
       <td>Numéro de compte en banque de l'entreprise</td>
       <td><input name="quatre" type="text" ></td>
      </tr>
      <tr>
       <td>Slogan de l'entreprise (Faites assez court)</td>
       <td><input name="cinq" type="text" ></td>
      </tr>
      <tr>
       <td>Numéro de registre de commerce de l'entreprise</td>
       <td><input name="six" type="text" ></td>
      </tr>
      <tr>
       <td>Adresse email de l'entreprise</td>
       <td><input name="sept" type="text" ></td>
      </tr>
      <tr>
       <td>Devise utilisée par Factux (€, $...)</td>
       <td><input name="huit" type="text" ></td>
      </tr>
      <tr>
       <td><input type="submit" name="Submit" value="<?php echo $lang_envoyer; ?>" /></td>
       <td><input type="reset" name=reset" value="<?php echo $lang_retablir; ?>"></td>
      </tr>
     </table>
    </form>
   </center>
   <br><hr>
<?php include_once("../include/bas_cli.php"); ?>
  </td>
 </tr>
</table>
</body>
</html>
