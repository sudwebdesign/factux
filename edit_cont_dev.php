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
$num_cont=isset($_POST['num_cont'])?$_POST['num_cont']:"";


$sql = "SELECT * FROM " . $tblpref ."cont_dev  RIGHT JOIN " . $tblpref ."article on " . $tblpref ."cont_dev.article_num = " . $tblpref ."article.num WHERE  " . $tblpref ."cont_dev.num = $num_cont";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_array($req))
{
  $quanti = $data['quanti'];
  $article = $data['article'];
  $tot = $data['tot_art_htva'];
  $num_art = $data['num'];
  $article_num = $data['article_num'];
  $dev_num = $data['dev_num'];
  $prix_ht = $data['prix_htva'];
  $remise = $data['remise'];
  //echo " $bon_num <br>";
}
?>
<form name="formu2" method="post" action="suite_edit_cont_dev.php">
  <table class="boiteaction">
    <caption>
    <?php  echo "$lang_edi_cont_devis"; ?>
    </caption>
    <tr> 
      <td class="texte0"><?php echo $lang_article ;
?> </td><td class="texte0">
<?php
include_once("include/configav.php");
				  if ($use_categorie !='y') { 
					$rqSql = "SELECT num, article, prix_htva, marge FROM " . $tblpref ."article WHERE actif != 'non' ORDER BY article asc";
					$result = mysql_query( $rqSql )
             or die( "Exécution requête impossible.");

					?>
          <SELECT NAME='article'>
            <?php
						while ( $row = mysql_fetch_array( $result)) {
    				$num = $row["num"];
    				$article2 = $row["article"];
						$prix = $row["prix_htva"];
						$marge= $row['marge'];
    				?>
            <OPTION VALUE=<?php echo "$num" ?>
			
						<?php
						if ($num == $article_num) { ?>selected<?php }
						?>
			
						><?php echo "$article2 $prix"; ?></OPTION>
            <?php
						}
						?>
          </SELECT>
					<?php
					}else{
					include("include/categorie_choix.php"); 
					} ?>
</td></tr>
    <tr> 
      <td  class="texte0" > <?php echo $lang_quanti ?> 
          </td><td class="texte0"><input name="quanti" type="text" size="5" id="quanti" value='<?php echo $quanti; ?>' >
      </td> 
    </tr>
	 <tr> 
      <td  class="texte0" > <?php echo $lang_remise ?> 
          </td><td class="texte0"><input name="remise" type="text" size="5" id="remise" value='<?php echo $remise; ?>' >
      </td> 
    </tr>
    <tr>
      
    <tr>
      <td class="submit" colspan="2"> <input type="submit" name="Submit" value=<?php echo $lang_modifier ?>> </p> 
      </td>
    </tr>
  </table>
  <input name="num_cont" type="hidden" id="nom" value=<?php echo $num_cont ?>>
  <input name="dev_num" type="hidden" id="nom" value=<?php echo $dev_num ?>>
</form> 
</td></tr><tr><td>

<?php
include("help.php");
include_once("include/bas.php");
?>
</td></tr></table></body>
</html>
