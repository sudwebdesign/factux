<?php
/*
 * Factux le facturier libre
 * Copyright (C) 2003-2005 Guy Hendrickx, 2017~ Thomas Ingles
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
 * * * * Version:  8.0.0
 * * * * Modified: 07/06/2025
 *
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
include_once(__DIR__ . "/include/headers.php");
include_once(__DIR__ . "/include/finhead.php");
?>
<table width="760" border="0" class="page" align="center">
 <tr>
  <td class="page" align="center">
<?php
require_once(__DIR__ . "/include/head.php");
if ($user_admin != 'y') {
 echo sprintf('<h1>%s</h1>', $lang_admin_droit);
 include_once(__DIR__ . "/include/bas.php");
 exit;
}
$page = explode("/", getenv('SCRIPT_NAME'));#split("/", getenv('SCRIPT_NAME'));#Deprecated
$n = count($page)-1;
$page = $page[$n];
$page = explode(".", $page, 2);#split("\.", $page, 2);#Deprecated
$extension = $page[1];
$page = $page[0];
/* 2005
$script 	= "$page.$extension";
$directory 	= $_SERVER['PHP_SELF'];
$base_url 	= "http://".$_SERVER['SERVER_NAME'];
$script_base = "$base_url$directory";
$base_path = $_SERVER['PATH_TRANSLATED'];
$url_base = ereg_replace("$script", '', "$_SERVER[PATH_TRANSLATED]");
*/
#2015 alpha
#$base_url = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME'];
$url_base = str_replace(sprintf('%s.%s', $page, $extension),'', $_SERVER['DOCUMENT_ROOT'].$_SERVER['PHP_SELF']);
//$path=str_replace("$page.$extension",'', $_SERVER['SCRIPT_FILENAME']);
#var_dump($url_base,$_SERVER);exit;
?>
  <form name="dobackup" method="post" action="main.php">
    <center>
     <table class="page" width="500" border="0" cellpadding="5" cellspacing="1" >
       <caption><?php echo $lang_bc_titre ?> </caption>
      <tr>
        <td  class="texte0" colspan="2"><?php echo $lang_bc_host ?> </td>
        <td  class="texte0" colspan="2"> <input name="dbhost" type="text" class="textbox" value="<?php echo $host; ?>" size="37" maxlength="100">
        </td>
      </tr>
      <tr>
        <td  class="texte0" colspan="2"><?php echo $lang_bc_bata ?></td>
        <td  class="texte0" colspan="2"> <input name="dbuser" type="text" class="textbox" value="<?php echo $user; ?>" size="37" maxlength="100">
        </td>
      </tr>
      <tr>
        <td  class="texte0" colspan="2"><?php echo $lang_bc_bata_pwd ?> </td>
        <td  class="texte0" colspan="2"> <input name="dbpass" type="password" class="textbox" value="<?php echo $pwd; ?>" size="37" maxlength="100">
        </td>
      </tr>
      <tr>
        <td  class="texte0" colspan="2"><?php echo $lang_bc_login ?> </td>
        <td  class="texte0" colspan="2"> <input name="dbname" type="text" class="textbox" value="<?php echo $db; ?>" size="37" maxlength="100">
        <input name="path" type="hidden" class="textbox" value="<?php echo $url_base; ?>" size="37" maxlength="100">
        </td>
      </tr>
      <tr>
        <td  class="texte0" colspan="2"></td>
        <td  class="texte0" colspan="2"><input name="send2" type="submit" class="textbox" value="<?php echo $lang_enter; ?>"></td>
      </tr>
    </table>
   </center>
  </form>
  </td>
 </tr>
 <tr>
  <td>
<?php
$aide = 'backups';
include(__DIR__ . "/help.php");
require_once(__DIR__ . "/include/bas.php");
?>
  </td>
 </tr>
</table>
</body>
</html>
