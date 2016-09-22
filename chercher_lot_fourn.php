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
 * File Name: chercher_lot_fourn.php.php
 * 	resultat d'une recherche de lot a partir d'un num de lot fournisseur
 * 
 * * * Version:  1.1.5
 * * * * Modified: 23/07/2005
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */

 $num_lot=isset($_POST['num_lot'])?$_POST['num_lot']:"";
 require_once("include/verif.php");
include_once("include/config/common.php");
include_once("include/config/var.php");
include_once("include/language/$lang.php");
include_once("include/utils.php");
?>
<title><?php echo "$lang_factux" ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="include/style.css">
<link rel="shortcut icon" type="image/x-icon" href="image/favicon.ico" >
</head>

<body>
<table width="760" border="0" class="page" align="center">
<tr>
<td class="page" align="center">
<?php
include_once("include/head.php");
$lot_fou=isset($_POST['lot_fou'])?$_POST['lot_fou']:"";
$sql = "SELECT  fourn_lot, num_lot, ingr 
		 FROM " . $tblpref ."cont_lot 
		 WHERE `fourn_lot` = $lot_fou
		 ORDER BY num_lot DESC";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());

?>
</td>
</tr>
<tr>
<td><table class="boiteaction">
<caption>Les lot suivants contiennent le lot fournisseur <?php echo "$lot_fou"; ?> </caption>
<?php
while($data = mysql_fetch_array($req))
{
  $ingr = $data['ingr'];
  $num_lot = $data['num_lot'];

?>
<td  class='<?php echo couleur_alternee (); ?>'><?php echo"$ingr"; ?></td>
<td  class='<?php echo couleur_alternee (FALSE); ?>'><?php echo"$num_lot"; ?> </td>
<td  class='<?php echo couleur_alternee (FALSE); ?>'><a href='voir_lot.php?num=<?php echo"$num_lot"; ?>'>Voir</a></td>
<td  class='<?php echo couleur_alternee (FALSE); ?>'><a href='recherche_lot.php?num_lot=<?php echo"$num_lot"; ?>'>Voir les bons qui contiennent ce lot</a><td>
<?php
}

?>
</table>
<?php
include("help.php");
include_once("include/bas.php");
?>
</td></table>
</body>
</html>
