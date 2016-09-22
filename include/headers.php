<?php
$here=(isset($now))?$now:'';#if client callin
$page_name = ucfirst(str_replace(['_','.php'],[' ',''],basename($_SERVER['PHP_SELF'])));
include_once($here."include/config/common.php");
$lang=(empty($lang))?$default_lang:$lang;#default_lg in common
include_once($here."include/config/var.php");
include_once($here."include/language/$lang.php");
include_once($here."include/utils.php");
include_once($here."include/configav.php");
?><!DOCTYPE html>
<html>
 <head>
  <meta charset="ISO-8859-1">
  <title><?php echo "$page_name - $lang_factux" ?></title>
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
<?php
if(!strstr($_SERVER['PHP_SELF'],'/client/')&!strstr($_SERVER['PHP_SELF'],'logout.php'))
 require_once("include/verif.php");
