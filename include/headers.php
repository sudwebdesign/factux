<?php
/*
 * Factux le facturier libre
 * Copyright (C) 2015 Thomas Ingles
 *
 * Licensed under the terms of the GNU  General Public License:
 * 		http://opensource.org/licenses/GPL-3.0
 *
 * For further information visit:
 * 		http://factux.free.fr
 *
 * File Name: headers.php
 * 	Editor configuration settings.
 *
 * * * Version:  5.0.0
 * * * * Modified: 07/10/2016
 *
 * File Authors:
 * 		Thomas Ingles
 *.
 */
date_default_timezone_set('Europe/Paris');
$here=(isset($now))?$now:'';#if client callin
include_once($here."include/configav.php");
include_once($here."include/config/common.php");
if(
   !strstr($_SERVER['PHP_SELF'],'/client/')
  &!strstr($_SERVER['PHP_SELF'],'login.php')
  &!strstr($_SERVER['PHP_SELF'],'index.php')
  &!strstr($_SERVER['PHP_SELF'],'logout.php')
  )
  require_once("include/verif.php");
$lang=(!empty($_SESSION['lang'])?$_SESSION['lang']:(isset($lang)?$lang:$default_lang));# (isset=fix lang espace client) default_lg in common Fix PHP Fatal error:  Unparenthesized `a ? b : c ? d : e` is not supported. Use either `(a ? b : c) ? d : e` or `a ? b : (c ? d : e)` in /var/www/0.src.facturiers/factux/include/headers.php on line 33
include_once($here."include/config/var.php");
include_once($here."include/language/$lang.php");
include_once($here."include/utils.php");
$page_name = ucfirst(str_replace(array('_','.php'),array(' ',''),basename($_SERVER['PHP_SELF'])));
?><!DOCTYPE html>
<html>
 <head>
  <title><?php echo "Factux - $page_name" ?></title>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="<?php echo $here; ?>include/themes/<?php echo"$theme";?>/style.css">
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo $here; ?>image/favicon.ico" >
  <style style='display:none;'>
   /*h1,h2,h3,h4,h5,h6{width: 760px;}*/
   .xe-deprecated{display:none !important;}
   form.img{display:inline;}
  </style>
<script type="text/javascript">
function getElementsByAttribute(oElm, strTagName, strAttributeName, strAttributeValue){//http://snipplr.com/view/1853/get-elements-by-attribute/
 var arrElements = (strTagName == "*" && oElm.all)? oElm.all : oElm.getElementsByTagName(strTagName);
 var arrReturnElements = new Array();
 var oAttributeValue = (typeof strAttributeValue != "undefined")? new RegExp("(^|\\s)" + strAttributeValue + "(\\s|$)", "i") : null;
 var oCurrent;
 var oAttribute;
 for(var i=0; i<arrElements.length; i++){
  oCurrent = arrElements[i];
  oAttribute = oCurrent.getAttribute && oCurrent.getAttribute(strAttributeName);
  if(typeof oAttribute == "string" && oAttribute.length > 0){
   if(typeof strAttributeValue == "undefined" || (oAttributeValue && oAttributeValue.test(oAttribute))){
    arrReturnElements.push(oCurrent);
   }
  }
 }
 return arrReturnElements;
}
window.onload = function (){//add title attribute on alls elements with alt attribute when DOM is completly loaded
 var objets = getElementsByAttribute(window.document,'*', 'alt')
 for(var i=0; i<objets.length; i++){
  objets[i].setAttribute('title',objets[i].getAttribute('alt'))
 }
}
/*
document.addEventListener('DOMContentLoaded', function () {
    // ...interesting launched before windows.onload ;-)
    console.log(window.document.all); console.log(getElementsByAttribute(window.document,'*', 'href'));
});
*/
</script>