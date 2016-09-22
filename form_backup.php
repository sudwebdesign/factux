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
require_once("include/config/common.php");
require_once("include/language/$lang.php");
include_once("include/headers.php");
include_once("include/finhead.php");




$page = split("/", getenv('SCRIPT_NAME')); 
$n = count($page)-1; 
$page = $page[$n]; 
$page = split("\.", $page, 2); 
$extension = $page[1];
$page = $page[0];
$script 	= "$page.$extension";
$directory 	= $_SERVER['PHP_SELF'];
$script_base = "$base_url$directory";
$base_path = $_SERVER['PATH_TRANSLATED'];
$url_base = ereg_replace("$script", '', "$_SERVER[PATH_TRANSLATED]");
?>	
<table width="760" border="0" class="page" align="center">
<tr>
<td  class="page" align="center">
<?php 
require_once("include/head.php");
if ($user_admin != y) { 
echo "<h1>$lang_admin_droit";
exit;
}
 ?> 

<br><hr><center>
<table class="boiteaction">
 <tr><td><FORM NAME="dobackup" METHOD="post" ACTION="main.php">
    <center><TABLE WIDTH="500" BORDER="0" CELLPADDING="5" CELLSPACING="1" >
       
        <caption><?php echo $lang_bc_titre ?> </caption>
      
      <TR> 
        <td  class="texte0" colspan="2"><?php echo $lang_bc_host ?> </TD>
        <td  class="texte0" colspan="2"> <INPUT NAME="dbhost" TYPE="text" class="textbox" VALUE="<?php echo $host; ?>" SIZE="37" MAXLENGTH="100"> 
        </TD>
      </TR>
      <TR> 
        <td  class="texte0" colspan="2"><?php echo $lang_bc_bata ?></TD>
        <td  class="texte0" colspan="2"> <INPUT NAME="dbuser" TYPE="text" class="textbox" VALUE="<?php echo $user; ?>" SIZE="37" MAXLENGTH="100"> 
        </TD>
      </TR>
      <TR> 
        <td  class="texte0" colspan="2"><?php echo $lang_bc_bata_pwd ?> </TD>
        <td  class="texte0" colspan="2"> <INPUT NAME="dbpass" TYPE="password" class="textbox" VALUE="<?php echo $pwd; ?>" SIZE="37" MAXLENGTH="100"> 
        </TD>
      </TR>
      <TR> 
        <td  class="texte0" colspan="2"><?php echo $lang_bc_login ?> </TD>
        <td  class="texte0" colspan="2"> <INPUT NAME="dbname" TYPE="text" class="textbox" VALUE="<?php echo $db; ?>" SIZE="37" MAXLENGTH="100"> 
        <INPUT NAME="path" TYPE="hidden" class="textbox" VALUE="<? echo $url_base; ?>" SIZE="37" MAXLENGTH="100"> 
				</TD>
      </TR>
      
        
        
        
      
      <TR> 
        <td  class="texte0" colspan="2"></TD>
        <td  class="texte0" colspan="2"><INPUT NAME="send2" TYPE="submit" class="textbox" VALUE="  ok  "></TD>
      </TR>
    </TABLE></center>
</FORM></table></center>
<tr><td>
<?php 
$aide = backups;
include("help.php");
echo"</td></tr><tr><td>";
require_once("include/bas.php");
 ?> 
</td></tr></table>
