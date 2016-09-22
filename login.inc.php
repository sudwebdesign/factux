<?php 
/*
 * Factux le facturier libre
 * Copyright (C) 2003-2004 Hendrickx
 * 
 * Licensed under the terms of the GNU  General Public License:
 * 		http://www.opensource.org/licenses/gpl-license.php
 * 
 * For further information visit:
 * 		http://factux.sourceforge.net
 * 
 * File Name: login.php.inc
 * 	Editor configuration settings.
 * 
 * * * Version:  1.1.5
 * Modified: 22/01/2005
 * 
 * File Authors:
 * 		Hendrickx Guy
 *.
 */	 
include_once("include/config/common.php");
include_once("include/config/var.php"); 
if (!isset($lang)) {
   $lang ="$default_lang";
}

include_once("include/language/$lang.php");
include_once("include/headers.php");?>
<script type="text/javascript">


function popUp(URL) {
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=250,height=450,left = 412,top = 234');");
}

</script>

<?php
include_once("include/finhead.php");


if (ereg("MSIE", $_SERVER["HTTP_USER_AGENT"])) {?>
    <BODY onLoad="javascript:popUp('ie.php')">
		<?php
} 
?>

 
 <div align="center" >
   <p><?php echo $lang_factux ?></p>
	 <p><?php echo $lang_en_admi ?></p>
   <p><?php echo $lang_ident ?></p>
   <p><?php echo $entrep_nom ?></p>
   <p><img src="image/<?php echo $logo ?>" alt="<?php echo $entrep_nom ?>"></p>
   <p>&nbsp;</p>
 </div>
<form action="login.php" method='post'>
  <table width="339" border="1" align="center">
  <tr>
    <td class="highlight.login"width="57" rowspan="3" ><img src="image/factux.gif" width="160" height="160" alt="factux"></td>
    <td class="highlight.login"width="64" ><?php echo $lang_login ?></td>
    <td class="highlight.login"width="196" ><input type="text" name="login" maxlength="250"></td>
  </tr>
  <tr>
    <td class="highlight.login"><?php echo $lang_mai_cr_pa ?></td>
    <td class="highlight.login"><input type="password"name="pass" maxlength="30"></td>
  </tr>
	<tr> 
			<td class="highlight.login">Langue</td>
			<td class="highlight.login"><select name="lang">
					<option value="<?php echo "$default_lang" ?>"><?php echo "$lang_deflang" ?></option>
					<option value="fr">Francais</option>
					<option value="en">English</option>
					<option value="nl">Neederlands</option>
			
			</select></td> 
	</tr>
  <tr class="submit">
    <td class="submit">&nbsp;</td>
    <td class="submit"><input name="submit" type="submit" value="login"></td>
		<td class="submit">&nbsp;</td>
  </tr>
</table>
</form>
<center><a href="client/index.php"><?php echo $lang_en_cli ?></a></center>

