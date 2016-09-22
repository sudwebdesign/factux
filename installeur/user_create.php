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
 * File Name: user_create.php
 * 	creation de l'utilisateur principal
 * 
 * * * Version:  1.1.5
 * * * * Modified: 23/07/2005
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
echo '<table width="100%" border="1" cellpadding="0" cellspacing="0" summary="">';
 ?>
 <br><h2> Ajouter un utilisateur </font><br><br>
 <p>Cet utilisateur aura les droits d'administrateur et ne pourra être effacé par la suite</p>
<center><table bgcolor="#FFFFCC" border="1" cellspacing="0" cellpadding="0">
  <tr >
    <td colspan="2"><form action="register.php" method="post" name="utilisateur" id="utilisateur">
      <p align="right"><font color =#006600>Nom d'utilisateur (login) :
          <input name="login2" type="text" id="login2"> 
          </p>
      <p align="right">Nom : 
        <input name="nom" type="text" id="nom">
Pr&eacute;nom: 
<input name="prenom" type="text" id="prenom">
</p>
      <p align="right">Mot de passe : 
        <input name="pass" type="password" id="pass">
</p>
      <p align="right">Mot de passe (pour vérification) :
        <input name="pass2" type="password" id="pass2"> 
      </p>
      <p align="right">Adresse email : 
        <input name="mail" type="text" id="mail"> 
      </p>
      <p align="right">
        <input type="submit" name="Submit" value="Envoyer">
        <input name="reset" type="reset" id="reset" value="R&eacute;initialiser">    
          </p>
    </form></td>    
  </tr>
</table><br><hr>

