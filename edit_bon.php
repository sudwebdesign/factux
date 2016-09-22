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
 * File Name: edit_bon.php
 * 	apel au formulaire d'edition du bon de commande
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

if($num_bon==''){
$num_bon=isset($_GET['num_bon'])?$_GET['num_bon']:"";
$nom=isset($_GET['nom'])?$_GET['nom']:"";
}
$sql = "SELECT fact FROM " . $tblpref ."bon_comm WHERE num_bon = $num_bon";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql2.'<br>'.mysql_error());
while($data = mysql_fetch_array($req))
    {
		$fact = $data['fact'];
		}
if($fact=='ok')
{
$message = "<center><h1>$lang_err_efa_bon";
include('form_commande.php');
exit;
}
?>
</td>
</tr>
<tr>
<td  class="page" align="center">
<SCRIPT language="JavaScript" type="text/javascript">
		function confirmDelete()
		{
		var agree=confirm("<?php echo $lang_sup_li; ?>");
		if (agree)
		 return true ;
		else
		 return false ;
		}
		</script>
		<?php
		include ("form_editer_bon.php");


include_once("include/bas.php");
?>
</table>
</body>
</html>
