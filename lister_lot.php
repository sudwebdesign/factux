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
include_once("include/headers.php");
?><script type="text/javascript" src="javascripts/confdel.js"></script><?php
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
if ($user_com == 'n'){ 
 $message="<h1>$lang_commande_droit</h1>";
 exit;  
}

//pour le formulaire
$mois_1=isset($_GET['mois_1'])?$_GET['mois_1']:$lang_tous;#date("m")
$annee_1=isset($_GET['annee_1'])?$_GET['annee_1']:date("Y");
$ands = ($annee_1==$lang_toutes)?'':"WHERE YEAR(date) = $annee_1";#si année choisie
$aw = (($annee_1==$lang_toutes&&$mois_1!=$lang_tous))?'WHERE':' AND';#si toutes années et mois choisi #idée GROUP BY DAY(date)
$ands .= ($mois_1==$lang_tous)?'':"$aw MONTH(date) = $mois_1";#si année entiere
$calendrier = calendrier_local_mois ();

$sql = "
SELECT num, prod, actif, DATE_FORMAT(date,'%d/%m/%Y') AS date_aff, date 
FROM " . $tblpref ."lot
$ands
";

if ( isset ( $_GET['ordre'] ) && $_GET['ordre'] != ''){
 $sql .= " ORDER BY " . $_GET['ordre'] . " DESC";
}else{
 $sql .= "ORDER BY " . $tblpref ."lot.`num` DESC";
}

$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
?>
   <form action="lister_lot.php" method="get">
   <center>
    <table border='0' class='page' align='center'>
     <caption><?php echo $lang_Lister_lots; ?></caption>
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
         <option value="<?php echo$i; ?>"<?php echo ($i==$annee_1)?' selected="selected"':''; ?>><?php echo $i; ?></option>
<?php } ?>
        </select>
       </td>
      </tr>
     <tr>
      <td class="submit" colspan="4">
       <input type="submit" value="<?php echo $lang_lister; ?>">
      </td>
     </tr>        
    </table>
   </center>
  </form>
  <br>
  <center>
   <table class='page boiteaction'>
    <caption><?php naviguer("lister_lot.php?ordre=".@$_GET['ordre'],$mois_1,$annee_1,$lang_all_lots); ?></caption>
    <tr> 
      <th><a href="lister_lot.php?ordre=num&amp;mois_1=<?php echo $mois_1; ?>&amp;annee_1=<?php echo $annee_1; ?>"><?php echo "$lang_lot $lang_numero"; ?></a></th>
      <th><a href="lister_lot.php?ordre=prod&amp;mois_1=<?php echo $mois_1; ?>&amp;annee_1=<?php echo $annee_1; ?>"><?php echo $lang_produit; ?></a></th>
      <th><a href="lister_lot.php?ordre=date&amp;mois_1=<?php echo $mois_1; ?>&amp;annee_1=<?php echo $annee_1; ?>"><?php echo $lang_date; ?></a></th>
      <th colspan="3"><a href="#"><?php echo $lang_action; ?></a></th>
     </tr>
<?php
$c=0;
while($data = mysql_fetch_array($req)){
 $num = $data['num'];
 $prod = $data['prod'];
 $date = $data["date_aff"];
 $actif = $data["actif"];
 if($c++ & 1){
  $line=0;
 }else{
  $line=1;
 }
?>
     <tr class="texte<?php echo $line; ?>" onmouseover="this.className='highlight'" onmouseout="this.className='texte<?php echo $line ?>'"> 
      <td class='<?php echo couleur_alternee (); ?>'><?php echo $num; ?></td>
      <td class='<?php echo couleur_alternee (FALSE); ?>'><?php echo $prod; ?></td>
      <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'><?php echo $date; ?></td>
      <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'>
       <a href="edit_lot.php?num=<?php echo $num; ?>&amp;mois_1=<?php echo $mois_1; ?>&amp;annee_1=<?php echo $annee_1; ?>"> 
        <img border="0" alt="<?php echo $lang_editer; ?>" src="image/edit.gif">
       </a>
      </td>
<?php if($actif!='non'){ ?>
      <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'>
       <a href="activer_lot.php?num=<?php echo $num; ?>&amp;acte=non&amp;mois_1=<?php echo $mois_1; ?>&amp;annee_1=<?php echo $annee_1; ?>" title="<?php echo $lang_rendre_inactif; ?>"
          onClick="return confirmDelete('<?php echo "$lang_lot_inact $num ?"; ?>');"><?php echo $lang_actif; ?>
       </a>
      </td>
<?php } else { ?> 
      <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'>
       <a href="activer_lot.php?num=<?php echo $num; ?>&amp;acte=oui&amp;mois_1=<?php echo $mois_1; ?>&amp;annee_1=<?php echo $annee_1; ?>" title="<?php echo $lang_rendre_actif; ?>"
          onClick="return confirmDelete('<?php echo "$lang_lot_act $num ?"; ?>');"><?php echo $lang_inactif; ?>
       </a>
      </td>
<?php } ?>
      <td class='<?php echo couleur_alternee (FALSE,"c texte"); ?>'>
        <a href="voir_lot.php?num=<?php echo $num ?>&amp;mois_1=<?php echo $mois_1; ?>&amp;annee_1=<?php echo $annee_1; ?>"><?php echo $lang_voir; ?></a>
      </td>
     </tr>
<?php } ?>
     <tr><td colspan="6" class="td2"></td></tr>
    </table>
   </center>
  </td>
 </tr>
 <tr>
  <td>
<?php
$aide='lots';
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
