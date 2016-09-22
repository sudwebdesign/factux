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
 * File Name: index2.php
 * 	suite de l'installation choix et enregistrement des parametres.
 * 
 * * * Version:  1.1.5
 * * * * Modified: 23/07/2005
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
 $etape = "Étape N°2 : Informations de connexion à la Base de données mysql";
 include_once('headers.php');
?> 
  <h3>Les paramètres de connexion à votre base de données mysql.</h3>
  <hr><br>
   <form action="setup.php" method="post" name="artice" id="artice">
    <center>
     <table>
      <caption>Paramètres d'installation :</caption>
      <tr>
       <td>Utilisateur (login) de la base de données mysql</td>
       <td><input name="un" type="text" id="article" maxlength="40"></td>
      </tr>
      <tr>
       <td>Mot de passe de l'utilisateur mysql</td>
       <td><input name="deux" type="password"  ></td>
      </tr>
      <tr>
       <td>Nom de la base de donnée mysql</td>
       <td><input name="trois" type="text" ></td>
      <tr>
       <td>Adresse de la base de données mysql (adresse ip ou non d'hôte)</td>
       <td><input name="quatre" type="text" ></td>
      <tr>
       <td>Langage par défaut de l'interface et des factures<br>Les autres langages seront disponibles via un menu</td>
       <td>
        <select name="cinq" >
         <option value="fr">Francais</option>
         <option value="en">Anglais</option>
         <option value="nl">Neerlandais</option>
        </select>
       </td>
      </tr>
      <tr>
       <td>Préfixe des tables dans la base de données</td>
       <td><input name="six" type="text" value="factux_" ></td>
      <tr>
       <td><input type="submit" name="Submit" value="Envoyer"></td>
       <td><input name="reset" type="reset" id="reset" value="effacer"></td>
      </tr>
     </table>
    </center>
   </form>
<?php include_once("../include/bas_cli.php"); ?> 
  </td>
 </tr>
</table>
</body>
</html>

 
