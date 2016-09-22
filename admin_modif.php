<?php 
require_once("include/verif.php");	 
include_once("include/language/$lang.php");
if ($user_admin !='y') { 
echo "<h1>$lang_admin_droit";
exit;
}		

$choix_use_cat=isset($_POST['choix_use_cat'])?$_POST['choix_use_cat']:"";
$choix_use_liste_cli=isset($_POST['choix_use_liste_cli'])?$_POST['choix_use_liste_cli']:"";
$choix_use_payement=isset($_POST['choix_use_payement'])?$_POST['choix_use_payement']:"";
$choix_use_lot=isset($_POST['choix_use_lot'])?$_POST['choix_use_lot']:"";
$choix_theme=isset($_POST['choix_theme'])?$_POST['choix_theme']:"";
$choix_use_stock=isset($_POST['choix_use_stock'])?$_POST['choix_use_stock']:"";
$choix_impression=isset($_POST['choix_impression'])?$_POST['choix_impression']:"";
$nbr_impression=isset($_POST['nbr_impr'])?$_POST['nbr_impr']:"";
$filename = 'include/configav.php';
$texte='<?php';
$texte.="\n";
$texte.='$lot=\'';
$texte.="$choix_use_lot";
$texte.='\';';
$texte.="\n";
$texte.='$liste_cli=\'';
$texte.="$choix_use_liste_cli";
$texte.='\';';
$texte.="\n";
$texte.='$use_categorie =\'';
$texte.="$choix_use_cat";
$texte.='\';';
$texte.="\n";
$texte.='$use_payement =\'';
$texte.="$choix_use_payement";
$texte.='\';';
$texte.="\n";
$texte.='$theme=\'';
$texte.="$choix_theme";
$texte.='\';';
$texte.="\n";
$texte.='$use_stock=\'';
$texte.="$choix_use_stock";
$texte.='\';';
$texte.="\n";
$texte.='$autoprint=\'';
$texte.="$choix_impression";
$texte.='\';';
$texte.="\n";
$texte.='$nbr_impr=\'';
$texte.="$nbr_impression";
$texte.='\';';
$texte.="\n";
$texte.='?>';
$texte.="\n";

if (is_writable($filename)) {

if (!$handle = fopen($filename, 'w+')) {
         echo "Impossible d'ouvrir le fichier ($filename)";
         exit;
   }

if (fwrite($handle, $texte) === FALSE) {
       $message= "<h2>Impossible d'écrire dans le fichier ($filename)</h2>";
       exit;
   }
     fclose($handle);
     $message="<h2>$lang_new_config_ok</h2>";
include_once("admin.php");
  
   
                  
} else {
   $message= "<h1>Le fichier $filename n'est pas accessible en écriture.</h1>";
  include_once("admin.php"); 
}

 ?> 