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
include_once("include/headers.php");
?><script type="text/javascript" src="javascripts/confdel.js"></script><?php
include_once("include/finhead.php");
?>
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php
include_once("include/head.php");
if ($user_dep == 'n'){ 
 echo "<h1>$lang_depense_droit</h1>";
 include_once("include/bas.php");
 exit;
}
if (isset($message)&&$message!=''){ 
 echo $message; 
}
//pour le formulaire
$mois_1=isset($_GET['mois_1'])?$_GET['mois_1']:date("m");
$annee_1=isset($_GET['annee_1'])?$_GET['annee_1']:date("Y");
$ands = ($annee_1==$lang_toutes)?'':"WHERE YEAR(date) = $annee_1";#si année choisie
$aw = (($annee_1==$lang_toutes&&$mois_1!=$lang_tous))?'WHERE':' AND';#si toutes années et mois choisi #idée GROUP BY DAY(date)
$ands .= ($mois_1==$lang_tous)?'':"$aw MONTH(date) = $mois_1";#si année entiere

$calendrier = calendrier_local_mois ();

$sql = "
SELECT num, lib, fournisseur, prix, DATE_FORMAT(date,'%d/%m/%Y') AS date_aff, date 
FROM " . $tblpref ."depense  
$ands
";
if ( isset ( $_GET['ordre'] ) && $_GET['ordre'] != ''){
 $sql .= " ORDER BY " . $_GET['ordre'] . " DESC";
}else{
 $sql .= "ORDER BY `num` DESC";
}

$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
?>
   <center>
    <form action="lister_depenses.php" method="get">
     <table class="page">
      <caption><?php echo "$lang_lister $lang_depenses"; ?></caption>
      <tr>
       <td class="texte0"><?php echo $lang_mois; ?></td>
       <td class="texte0">
        <select name="mois_1">
         <option value="<?php echo $lang_tous; ?>"<?php echo ($lang_tous==$mois_1)?' selected="selected"':''; ?>><?php echo ucfirst($lang_tous); ?></option>
<?php for ($i=1;$i<=12;$i++){?>
         <option value="<?php echo $i; ?>"<?php echo ($i==$mois_1)?' selected="selected"':''; ?>><?php echo ucfirst($calendrier [$i]); ?></option>
<?php } ?>
        </select>
       </td>
       <td class="texte0"><?php echo $lang_annee; ?></td>
       <td class="texte0">
 	      <select name="annee_1">
         <option value="<?php echo $lang_toutes; ?>"<?php echo ('tout'==$annee_1)?' selected="selected"':''; ?>><?php echo ucfirst($lang_toutes); ?></option>
<?php for ($i=date("Y");$i>=date("Y")-13;$i--){?>
         <option value="<?php echo $i; ?>"<?php echo ($i==$annee_1)?' selected="selected"':''; ?>><?php echo $i; ?></option>
<?php } ?>
        </select>
       </td>
      </tr>
      <tr>
       <td class="submit" colspan="4">
        <input type="submit" value='<?php echo $lang_lister; ?>'>
       </td>
      </tr>        
     </table>
    </form>
   </center>
  <br>
   <center>
    <table class='page boiteaction'>
     <caption><?php naviguer("lister_depenses.php?ordre=".@$_GET['ordre'],$mois_1,$annee_1,$lang_depenses_liste); ?></caption>
     <tr> 
      <th><a href="lister_depenses.php?ordre=num&amp;mois_1=<?php echo $mois_1; ?>&amp;annee_1=<?php echo $annee_1; ?>"><?php echo $lang_numero; ?></a></th>
      <th><a href="lister_depenses.php?ordre=fournisseur&amp;mois_1=<?php echo $mois_1; ?>&amp;annee_1=<?php echo $annee_1; ?>"><?php echo $lang_fournisseur; ?></a></th>
      <th><a href="lister_depenses.php?ordre=date&amp;mois_1=<?php echo $mois_1; ?>&amp;annee_1=<?php echo $annee_1; ?>"><?php echo $lang_date; ?></a></th>
      <th><a href="lister_depenses.php?ordre=lib&amp;mois_1=<?php echo $mois_1; ?>&amp;annee_1=<?php echo $annee_1; ?>"><?php echo $lang_libelle; ?></a></th>
      <th><a href="lister_depenses.php?ordre=mont_tva&amp;mois_1=<?php echo $mois_1; ?>&amp;annee_1=<?php echo $annee_1; ?>"><?php echo $lang_montant; ?></a></th>
      <th colspan="2"><b><?php echo $lang_action; ?></b></th>
     </tr>
<?php
$c=0;
while($data = mysql_fetch_array($req))
{
  $num = $data['num'];
  $date = $data['date_aff'];
  $lib = $data['lib'];
  $fou = $data['fournisseur'];
  $fou = stripslashes($fou);
  $montant = $data['prix'];
  if($c++ & 1)
    $line="0";
  else
    $line="1";
?>
     <tr class="texte<?php echo $line; ?>" onmouseover="this.className='highlight'" onmouseout="this.className='texte<?php echo $line; ?>'">
      <td class='<?php echo couleur_alternee (); ?>'><?php echo $num; ?></td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo $fou; ?></td>
      <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'><?php echo $date; ?></td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo $lib; ?></td>
      <td class='<?php echo couleur_alternee (FALSE,"nombre"); ?>'><?php echo montant_financier ($montant); ?></td>
      <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'>
       <a href="edit_dep.php?num_dep=<?php echo $num; ?>">
        <img src="image/edit.gif" border="0" alt="<?php echo $lang_editer; ?>">
       </a>
      </td>
      <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'>
       <a href="delete_dep.php?num=<?php echo $num; ?>" 
        onClick="return confirmDelete('<?php echo"$lang_eff_conf_dep $num ?"; ?>')"
        > 
        <img src="image/delete.jpg" border="0" alt="<?php echo $lang_effacer; ?>">
       </a>
      </td>
     </tr>
<?php } ?>
     <tr>
      <td colspan="7" class="td2"></td>
     </tr>
    </table>
   </center>
  </td>
 </tr>
 <tr>
  <td>

<?php
$aide='depense';
include("help.php");
include_once("include/bas.php");
if(!strstr($_SERVER['SCRIPT_FILENAME'],__FILE__)){#autre qu'elle meme
 echo"\n  </td>\n </tr>\n</table>\n"; 
}
?>
  </td>
 </tr>
</table>
</body>
</html>
