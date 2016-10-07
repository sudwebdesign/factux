<?php 
include_once("include/config/common.php");
include_once("include/config/var.php"); 
if (!isset($lang)) {
   $lang = $default_lang;
}
include_once("include/language/$lang.php");
include_once("include/headers.php");
$mes="internet explorer";
if (preg_match("~Edge~", $_SERVER["HTTP_USER_AGENT"]))#quel est celui de spartan ? "Edge/12.#### ça veut dire bord
 $mes="spartan";
?>
</head>
<body onBlur="window.focus()"> 
 <table class="page"> 
  <tr><td><h1 style="width:100%;">Vous utiliser <?php echo $mes; ?>. Ce navigateur est un logiciel a sources fermées contrairement a Factux</h1></td></tr>
  <tr><td><p>Je vous conseille vivement d'utiliser un navigateur libre et plus respectueux de votre vie privé numérique</p></td><tr>
  <tr><td><center><a target="_blank" href="https://www.mozilla.org/fr/firefox/products/"><img src="image/firefox.png" border="0" alt="firefox now" ></a></center></td></tr>
  <tr><td><center><a href="javascript:window.close()">fermer la fenêtre</a></center></td></tr>
 </table>
</body>
</html> 
