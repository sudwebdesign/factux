<?php
###4 change (') simple quote &#39; to Right single quotation mark &#146; &rsquo; ::: http://ascii-code.com/
function apostrophe($str){
 return str_replace(chr(39),'’',$str);#tips iso = chr(146)
}
# go to php7
if (version_compare(phpversion(),'7', '>='))
 include_once(__DIR__ . '/7mysql.php');#non testé (Fixed) TEP
// Fix for removed Session functions http://php.net/manual/en/function.session-register.php#96241
if(version_compare(phpversion(),'5.4.0','>=')){#function fix_session_register(){
 function session_register(){#DEPRECATED as of PHP 5.3.0 and REMOVED as of PHP 5.4.0
  $args = func_get_args();
  foreach ($args as $key){
   $_SESSION[$key]=@$GLOBALS[$key];#var_dump($_SESSION[$key],$GLOBALS,$args);
  }
 }
 function session_is_registered($key){
  return isset($_SESSION[$key]);
 }
 function session_unregister($key){
  unset($_SESSION[$key]);
 }
}
#if (!function_exists('session_register')) fix_session_register();
// 2025
function unQuote($content) {
 # On traite un tableau
 if(is_array($content)) {
  $new_content = array();
  foreach($content as $k=>$v) { # On parcourt le tableau
   if(is_array($v)) {
    $new_content[$k] = array();
    foreach($v as $key=>$val)
     $new_content[$k][$key] = unQuote($val);
   } else {
    $new_content[$k] = apostrophe($v);
   }
  }
  return $new_content;
 }

 # On traite une chaine
 return apostrophe($content);
}
# Echappement des caractères
if($_SERVER['REQUEST_METHOD'] == 'POST') $_POST = unQuote($_POST);