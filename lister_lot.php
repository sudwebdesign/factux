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
 * File Name: lister_lot.php
 * 	liste tout les lots actifs et inactifs
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
include_once("include/headers.php");?>
<script type="text/javascript" src="javascripts/confdel.js"></script>
<?php
include_once("include/finhead.php");
?>

<table width="500" border="0" class="page" align="center">
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
if ($user_com == n) { 
echo"<h1>$lang_commande_droit";
exit;  
}
 ?> 
<?php 
$mois = date("m");
$annee = date("Y");
//pour le formulaire
?>
      <?php 
$mois_1=isset($_POST['mois_1'])?$_POST['mois_1']:"";
$annee_1=isset($_POST['annee_1'])?$_POST['annee_1']:"";

if ($mois_1=='') {
 $mois_1= $mois ;
} 
if ($annee_1=='') { 
 $annee_1= $annee ; 
}

$calendrier = calendrier_local_mois ();
$sql = "SELECT num, prod, actif, date 
		 FROM " . $tblpref ."lot 
		 ORDER BY " . $tblpref ."lot.`num` DESC";

$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());

?>
     <form action="lister_lot.php" method="post">
        <center><table class="boiteaction">
  <caption><?php echo "$lang_Lister_lots"; ?></caption>

          <tr>
		  <td width="21%" class="texte0">&nbsp;</td>
            <td width="23%" class="texte0"> <select name="mois_1">
			<?php for ($i=1;$i<12;$i++)
			{
			?>
                <option value="<?php echo $i; ?>"><?php echo ucfirst($calendrier [$i]); ?></option>
				<?php
				}
				?>
              </select> </td><td width="27%" class="texte0">
			  <select name="annee_1">
                <option value="2005">2005</option>
                <option value="2006">2006</option>
              </select> </td>
			  <td width="29%"  class="texte0">&nbsp;</td>
          </tr>
<tr><td class="submit" colspan="4"><input type="submit" value='<?php echo $lang_envoyer; ?>'></td></tr>        
        </table></center></form>
		<br>
        <center><table class="boiteaction">
  <caption><?php echo "$lang_all_lots"; ?></caption>
          <tr> 
            <th><?php echo "$lang_lot"; ?></th>
            <th><?php echo "$lang_produit"; ?></th>
            <th><?php echo $lang_date; ?></th>
            <th colspan="3"><?php echo $lang_action; ?></th>
          </tr>
          <?php
while($data = mysql_fetch_array($req))
{
  $num = $data['num'];
  $prod = $data['prod'];
  $date = $data["date"];
	$actif = $data["actif"];
  ?>
          <tr> 
            <td  class='<?php echo couleur_alternee (); ?>'><?php echo $num; ?></td>
            <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo "$prod"; ?></td>
            <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo $date; ?></td>
             <td  class='<?php echo couleur_alternee (FALSE); ?>'>
			<a href='edit_lot.php?num=<?php echo $num; ?>' > 
              <img border=0 alt=editer src=image/edit.gif></a> &nbsp;
							<?php if($actif!=non){ ?>
							<td  class='<?php echo couleur_alternee (FALSE); ?>'>
<a href=activer_lot.php?num=<?php echo $num; ?> onClick="return confirmDelete('<?php echo"$lang_lot_inact $num ?"; ?>')"> actif</a>
<?php } else { ?> 
<td  class='<?php echo couleur_alternee (FALSE); ?>'>inactif
<?php } ?>
							<td  class='<?php echo couleur_alternee (FALSE); ?>'>
<a href=voir_lot.php?num=<?php echo $num ?>>Voir</a>

</td>
</tr>
<?php } ?> 
</table></center>
   </td></tr><tr><td>

<?php
include("help.php");
include_once("include/bas.php");
?></table>
</body>
</html>
