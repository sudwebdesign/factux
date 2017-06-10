<?php 
/*
 * Factux le facturier libre
 * Copyright (C) 2003-2004 Hendrickx
 * 
 * Licensed under the terms of the GNU  General Public License:
 * 		http://opensource.org/licenses/GPL-3.0
 * 
 * For further information visit:
 * 		http://factux.free.fr
 * 
 * File Name: login.php.inc
 * 	Editor configuration settings.
 * 
 * * * Version:  5.0.0
 * Modified: 07/10/2016
 * 
 * File Authors:
 * 		Hendrickx Guy
 *.
 */
include_once("include/config/common.php");
include_once("include/config/var.php"); 
$lang=isset($_POST['lang'])?$_POST['lang']:"";
$lang=(empty($lang))?$default_lang:$lang;#default_lg in common
include_once("include/language/$lang.php");
include_once("include/headers.php");
?>
<script type="text/javascript">
 function popUp(URL) {
  day = new Date();
  id = day.getTime();
  eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=250,height=450,left = 412,top = 234');");
 }
</script>
<?php

if (preg_match("~MSIE~", $_SERVER["HTTP_USER_AGENT"])||preg_match("~Edge~", $_SERVER["HTTP_USER_AGENT"]))#quel est celui de spartan ? "Edge/12.#### ça veut dire bord
 echo "</head>\n".'<body onLoad="javascript:popUp(\''.@$now.'ie.php\')">'."\n";
else
 include_once("include/finhead.php");
?>
<div align="center">
<?php
if (isset($message)&&$message!='') {
 $message = ($message=="i")?"<h1>$lang_interdit</h1>":$message;
 echo "<div>$message</div>\n"; 
}
?>
 <p><?php echo $lang_factux; ?></p>
 <p><?php echo $lang_en_admi; ?></p>
 <p><?php echo $lang_ident; ?></p>
 <p><?php echo $entrep_nom; ?></p>
 <p><img height="161" src="<?php echo @$now; ?>image/<?php echo $logo ?>" alt="<?php echo $entrep_nom; ?>"></p>
 <p>&nbsp;</p>
 <form action="<?php echo @$now; ?>login.php" method='post'>
  <table width="339" border="0" align="center" class="page">
   <tr>
    <td class="boiteaction" rowspan="3" ><a href="http://factux.free.fr/" target="_blank"><img src="<?php echo @$now; ?>image/factux.png" alt="<?php echo $lang_factux; ?>"></a></td>
    <td class="boiteaction"><?php echo $lang_login ?></td>
    <td class="boiteaction"><input type="text" name="login" maxlength="10"></td>
   </tr>
   <tr>
    <td class="boiteaction"><?php echo $lang_mai_cr_pa ?></td>
    <td class="boiteaction"><input type="password" name="pass" maxlength="30"></td>
   </tr>
   <tr> 
    <td class="boiteaction">Langue</td>
    <td class="boiteaction">
     <select name="lang">
      <option value="<?php echo $default_lang; ?>"><?php echo $lang_deflang; ?></option>
      <option value="fr">Francais</option>
      <option value="en">English</option>
      <option value="nl">Neederlands</option>
      <option value="es">Español (baby)</option>
      <option value="es.m">Español (bing)</option>
      <option value="it">Italiano (baby)</option>
      <option value="it.m">Italiano (bing)</option>
      <option value="de">Deutsch (baby)</option>
      <option value="de.m">Deutsch (bing)</option>
      <option value="pl">Polski (baby)</option>
      <option value="pl.m">Polski (bing)</option>
      <option value="el">Ελληνικά (baby)</option>
      <option value="el.m">Ελληνικά (bing)</option>
     </select>
    </td> 
   </tr>
   <tr>
    <td class="boiteaction"><a href="<?php echo @$now; ?>client/index.php"><?php echo $lang_en_cli; ?></a></td>
    <td class="boiteaction">&nbsp;</td>
    <td class="boiteaction"><input name="submit" type="submit" value="<?php echo ucfirst($lang_enter); ?>"></td>
   </tr>
  </table>
</form>
</div>
</body>
</html>
