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
 * File Name: bon.php
 * 	Editor configuration settings.
 * 
 * * Version:  1.1.5
 * * * * Modified: 23/07/2005
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
 
require_once("include/verif.php");
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

include_once("include/language/$lang.php"); 
if($client=='0')
    {
    $message="<h1> $lang_choix_client</h1>";
    include('form_commande.php');
    exit;
    }

$sql_nom = "SELECT  nom, nom2 FROM " . $tblpref ."client WHERE num_client = $client";
$req = mysql_query($sql_nom) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_array($req))
    {
		$nom = $data['nom'];
		$nom2 = $data['nom2'];
		$phrase = "$lang_bon_cree";
		echo "$phrase $nom $nom2 $lang_bon_cree2 $date<br>";
		}
$sql1 = "INSERT INTO " . $tblpref ."bon_comm(client_num, date) VALUES ('$client', '$annee-$mois-$jour')";
mysql_query($sql1) or die('Erreur SQL !<br>'.$sql1.'<br>'.mysql_error());
?>
<center>
<form name='formu2' method='post' action='bon_suite.php'>
    <table class="boiteaction">
      <caption><? echo $lang_donne_bon ; ?></caption>
      <tr>
        <td class="texte0"><?php echo $lang_quanti; ?> </td>
        <td class="texte0" colspan="3"><input name='quanti' type='text' id='quanti' size='6'></td>
				</tr>
		<tr>
        <td class="texte0"><?php echo $lang_remise; ?> </td>
        <td class="texte0" colspan="3"><input name='remise' type='text' id='remise' size='6'></td>
				</tr>
				<tr>
			   <td class="texte0"><?php echo "$lang_article";
				 include_once("include/configav.php");
				  if ($use_categorie !='y') { 
  

				 $rqSql = "SELECT uni, num, article, prix_htva FROM " . $tblpref ."article WHERE actif != 'non' ORDER BY article, prix_htva";
				 $result = mysql_query( $rqSql )
             or die( "Exécution requête impossible.");?>
        <td class="texte0"><SELECT NAME='article'>
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
			<?php 
if ($lot=='y') { ?>
<td class="texte0">Lot </td>
		<?php $rqSql = "SELECT num, prod FROM " . $tblpref ."lot WHERE actif != 'non' ORDER BY num";
			$result = mysql_query( $rqSql )
             or die( "Exécution requête impossible.");?>
					<td class="texte0"><SELECT NAME='lot'>
					<OPTION VALUE=0><?php echo $lang_choisissez; ?></OPTION>
            <?php
						while ( $row = mysql_fetch_array( $result)) {
    							$num = $row["num"];
    							$prod = $row["prod"];
		    ?>
            <OPTION VALUE='<?php echo $num; ?>'><?php echo "$num $prod "; ?></OPTION>
						
					<?php 
}
 ?> </SELECT></td>  
<?php  }
 ?> 
      </tr>
      <tr>
        	 		<td class="submit" colspan="4"><input name="nom" type="hidden" id="nom" value="<?php echo $nom ?>"><input type="submit" name="Submit" value='<?php echo "$lang_valid "; ?>'></td>
      </tr>
    
    
  </table></form></center>
</td></tr><tr><td>

<?php
include("help.php");
echo"</td></tr><tr><td>";
include_once("include/bas.php");
?></td></tr></table>
</body>
</html>
