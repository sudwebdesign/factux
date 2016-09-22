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
 * File Name: lister_utilisateurs.php
 * 	crée la liste des utilisateurs
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
include_once("include/language/$lang.php");
include_once("include/utils.php");
include_once("include/headers.php");
include_once("include/finhead.php");
?>
<SCRIPT language="JavaScript" type="text/javascript">
		function confirmDelete2()
		{
		var agree=confirm('<?php echo "$lang_con_effa_utils"; ?>');
		if (agree)
		 return true ;
		else
		 return false ;
		}
		</script>
<SCRIPT language="JavaScript" type="text/javascript">
		function confirmDelete()
		{
		var agree=confirm('<?php echo "$lang_cli_effa"; ?>');
		if (agree)
		 return true ;
		else
		 return false ;
		}
		</script>
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
if ($user_admin != y) { 
echo "<h1>$lang_admin_droit";
exit;
}
 ?> 
<?php 
$sql = " SELECT * FROM " . $tblpref ."user WHERE 1 ORDER BY `nom` ASC";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
?>
<center><table class="boiteaction">
  <caption><?php echo "Les utilisateurs"; ?></caption>
 <tr><th><?php echo $lang_nom; ?></th>
<th><?php echo prenom; ?></th>
<th><?php echo login; ?></th>
<th><?php echo "Est admin ?"; ?></th>
<th><?php echo "Gerer devis?"; ?></th>
<th><?php echo "Gerer commandes"; ?></th>
<th><?php echo "Gerer factures"; ?></th>
<th><?php echo "Gerer depenses"; ?></th>
<th><?php echo "Voir stat"; ?></th>
<th><?php echo "Gerer art"; ?></th>
<th><?php echo "Gerer clients"; ?></th>
<th colspan="2"><?php echo "$lang_action"; ?></th>
</tr>
<?php
$nombre =1;
while($data = mysql_fetch_array($req))
    {
		$nom = $data['nom'];
		$prenom = $data['prenom'];
		$login = $data['login'];
		$dev = $data['dev'];
		if ($dev == y) { $dev = $lang_oui ;}
		if ($dev == n) { $dev = $lang_non ; }
		if ($dev == r) { $dev = $lang_restrint ; }
		$com = $data['com'];
				if ($com == y) { $com = $lang_oui ; }
		if ($com == n) { $com = $lang_non ; }
		if ($com == r) { $com = $lang_restrint ; }
		$fact = $data['fact'];
				if ($fact == y) { $fact = $lang_oui ; }
		if ($fact == n) { $fact = $lang_non ; }
		if ($fact == r) { $fact = $lang_restrint ; }
		$mail =$data['mail'];
		$dep = $data['dep'];
				if ($dep == y) { $dep = $lang_oui ; }
		if ($dep == n) { $dep = $lang_non ; }
		$stat = $data['stat'];
				if ($stat == y) { $stat = $lang_oui ; }
		if ($stat == n) { $stat = $lang_non ; }
		$art = $data['art'];
				if ($art == y) { $art = $lang_oui ; }
		if ($art == n) { $art = $lang_non ; }
		$cli = $data['cli'];
				if ($cli == y) { $cli = $lang_oui ; }
		if ($cli == n) { $cli = $lang_non ; }
		if ($dev == r) { $dev = $lang_restrint ; }
		$admin = $data['admin'];
		if ($admin == y) { $admin = $lang_oui ; }
		if ($admin == n) { $admin = $lang_non ; }
		$num_user = $data['num'];
		$nombre = $nombre +1;
		if($nombre & 1){
		$line="0";
		}else{
		$line="1"; 
		}
		?>
		<tr class="texte<?php echo"$line" ?>" onmouseover="this.className='highlight'" onmouseout="this.className='texte<?php echo"$line" ?>'">
  	   	<td class="highlight"><b><?php echo $nom; ?></b></td>
		<td class="highlight"><b><?php echo $prenom; ?></b></td>
		<td class="highlight"><b><?php echo $login; ?></b></td>
		<td class="highlight"><?php echo $admin; ?></td>
		<td class="highlight"><?php echo $dev; ?></td>
		<td class="highlight"><?php echo $com; ?></td>
		<td class="highlight"><?php echo $fact; ?></td>
		<td class="highlight"><?php echo $stat; ?></td>
		<td class="highlight"><?php echo $art; ?></td>
		<td class="highlight"><?php echo $cli; ?></td>
		<td class="highlight"><a href="editer_utilisateur.php?num_user=<?php echo $num_user ?>"><img src="image/edit.gif" border="0" alt="<?php echo $lang_editer ;?>r"></a></td>
		<td class="highlight"><a href="del_utilisateur.php?num_user=<?php echo $num_user ?>"><img src="image/delete.jpg" border="0" alt="<?php echo $lang_suprimer ;?>r" onClick='return confirmDelete2()'></a></td>

		<?php
		}
 ?>
 </tr><tr><TD colspan="13" class="submit"></TD></tr>
 </table></center><tr><td>
<?php 
$aide = client;
?>

<?php
include("help.php");
echo"</td></tr><tr><td>";
include_once("include/bas.php");
?>
</td></tr>
</table></body>
</html>
