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
include_once("include/verif.php");
include_once("include/config/common.php");
include_once("include/config/var.php");
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
<?php

$client=isset($_POST['listeville'])?$_POST['listeville']:"";
$date=isset($_POST['date'])?$_POST['date']:"";
list($jour, $mois,$annee) = preg_split('/\//', $date, 3);
//echo "jour $jour moi $mois année $année";

include_once("include/language/$lang.php"); 
if($client=='0')
    {
    echo "<p><center><h1>$lang_choix_client</p>";
    include('form_devis.php');
    exit;
    }
 ?>
    <?php 

$sql_nom = "SELECT  nom, nom2 FROM " . $tblpref ."client WHERE num_client = $client";
$req = mysql_query($sql_nom) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_array($req))
{
  $nom = $data['nom'];
	$nom = htmlentities($nom, ENT_QUOTES);
  $nom2 = $data['nom2'];
  $phrase = "$lang_bon_cree";
  echo "$phrase $nom $nom2 $lang_bon_cree2 $date";
}
mysql_select_db($db) or die ("Could not select $db database");
$sql1 = "INSERT INTO " . $tblpref ."devis(client_num, date) VALUES ('$client', '$annee-$mois-$jour')";
mysql_query($sql1) or die('Erreur SQL !<br>'.$sql1.'<br>'.mysql_error());
$rqSql = "SELECT num, article, prix_htva, uni FROM " . $tblpref ."article WHERE actif != 'non' ORDER BY article, prix_htva";
$result = mysql_query( $rqSql )
             or die( "Exécution requête impossible.");
?>
    <form name='formu2' method='post' action='devis_suite.php'>
      <table class="boiteaction">
        <caption>
        <?php echo $lang_donne_devis; ?> 
        </caption>
        <tr> 
          <td class="texte0"><?php echo $lang_article;  ?> </td>
					<?php
					include_once("include/configav.php");
				  if ($use_categorie !='y') { ?>
          <td class="texte0"> <SELECT NAME='article'>
              <OPTION VALUE=0><?php echo $lang_choisissez; ?></OPTION>
              <?php
							while ( $row = mysql_fetch_array( $result)) {
    					$num = $row["num"];
    					$article = $row["article"];
							$prix = $row["prix_htva"];
							$uni = $row["uni"];
    					?>
              <OPTION VALUE='<?php echo $num; ?>'><?php echo "$article $prix $devise / $uni"; ?></OPTION>
              <?php
							}
							?>
            </SELECT>
						<?php }else{?>
					 <td class="texte0">
					 <?php
					 include("include/categorie_choix.php"); 
					 }
					 ?>
						</td>
        </tr>
        <tr> 
          <td class="texte0"> <?php echo $lang_quanti; ?> </td>
          <td class="texte0"><input name='quanti' type='text' id='quanti' size='6'></td>
        </tr>
        <tr> 
          <td class="submit" colspan="2"><input type="submit" name="Submit" value='<?php echo $lang_valid; ?>'></td>
      </table>
      <input name="nom" type="hidden" id="nom" value='<?php echo $nom; ?>'>
    </form>
    
</td></tr><tr><td>

<?php
include("help.php");
include_once("include/bas.php");
?>
</td></tr></table>
</body>
</html>