<?php
$now='../';
include_once(__DIR__ . "/../include/config/common.php");
include_once(__DIR__ . "/../include/config/var.php");
$lang = (isset($lang))?$lang:$default_lang;#default_lg in common
include_once(__DIR__ . sprintf('/../include/language/%s.php', $lang));
include_once(__DIR__ . "/../include/headers.php");
?>
<div align="center">
<?php
if (isset($message)&&$message!='') {
 $message = ($message=="i")?sprintf('<h1>%s</h1>', $lang_interdit):$message;
 echo "<div>{$message}</div>\n";
}
?>
 <p><?php echo $lang_factux ?></p>
 <p><?php echo $lang_en_cli ?></p>
 <p><?php echo $lang_ident ?></p>
 <p><?php echo $entrep_nom ?></p>
 <p><img height="161" src="../image/<?php echo $logo ?>" alt="<?php echo $entrep_nom ?>"></p>
 <p>&nbsp;</p>
 <form action="<?php echo @$from_cli; ?>login_client.php" method='post'>
  <table width="339" border="0" align="center" class="page">
   <tr>
    <td width="57" rowspan="3" class="boiteaction"><img src="../image/factux.png" width="160" height="160"></td>
    <td width="64" class="boiteaction"><?php echo $lang_login ?></td>
    <td width="196" class="boiteaction"><input type="text" name="login" maxlength="250"></td>
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
    <td class="boiteaction"><a href="../index.php"><?php echo $lang_en_admi; ?></a></td>
    <td class="boiteaction">&nbsp;</td>
    <td class="boiteaction"><input name="submit" type="submit" value="<?php echo $lang_enter; ?>"></td>
  </tr>
 </table>
</form>
</div>
