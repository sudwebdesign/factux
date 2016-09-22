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
 * File Name: admin_modif.php
 * 	Enregistrement des parametres: configav.php
 * 
 * * Version:  1.1.5
 * * * * Modified: 23/07/2005
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
require_once("include/verif.php");	 
include_once("include/config/common.php");
include_once("include/config/var.php");
include_once("include/language/$lang.php");
if ($user_admin !='y') { 
 echo "<h1>$lang_admin_droit</h1>";
 exit;
}
if (empty($_POST)) {#acces direct
 include("admin.php"); 
 exit;
}

$choix_use_lot=isset($_POST['choix_use_lot'])?$_POST['choix_use_lot']:"";
$choix_use_liste_cli=isset($_POST['choix_use_liste_cli'])?$_POST['choix_use_liste_cli']:"";
$choix_use_cat=isset($_POST['choix_use_cat'])?$_POST['choix_use_cat']:"";
$choix_use_payement=isset($_POST['choix_use_payement'])?$_POST['choix_use_payement']:"";
$choix_theme=isset($_POST['choix_theme'])?$_POST['choix_theme']:"";
$choix_use_stock=isset($_POST['choix_use_stock'])?$_POST['choix_use_stock']:"";
$choix_impression=isset($_POST['choix_impression'])?$_POST['choix_impression']:"";
$nbr_impression=isset($_POST['nbr_impr'])?$_POST['nbr_impr']:"";
$choix_auth_cli_devis=isset($_POST['choix_auth_cli_devis'])?$_POST['choix_auth_cli_devis']:"";
$choix_auth_cli_bon=isset($_POST['choix_auth_cli_bon'])?$_POST['choix_auth_cli_bon']:"";
$choix_auth_cli_fact=isset($_POST['choix_auth_cli_fact'])?$_POST['choix_auth_cli_fact']:"";
$choix_first_art=isset($_POST['choix_first_art'])?$_POST['article']:0;
$choix_echeance_fact=isset($_POST['choix_echeance_fact'])?$_POST['choix_echeance_fact']:30;

$filename = 'include/configav.php';
$texte='<?php';
$texte.="\n";
$texte.='$lot=\'';
$texte.=$choix_use_lot;
$texte.='\';';
$texte.="\n";
$texte.='$liste_cli=\'';
$texte.=$choix_use_liste_cli;
$texte.='\';';
$texte.="\n";
$texte.='$use_categorie =\'';
$texte.=$choix_use_cat;
$texte.='\';';
$texte.="\n";
$texte.='$use_payement =\'';
$texte.=$choix_use_payement;
$texte.='\';';
$texte.="\n";
$texte.='$theme=\'';
$texte.=$choix_theme;
$texte.='\';';
$texte.="\n";
$texte.='$use_stock=\'';
$texte.=$choix_use_stock;
$texte.='\';';
$texte.="\n";
$texte.='$autoprint=\'';
$texte.=$choix_impression;
$texte.='\';';
$texte.="\n";
$texte.='$nbr_impr=\'';
$texte.=$nbr_impression;
$texte.='\';';
$texte.="\n";
$texte.='$auth_cli_devis=\'';
$texte.=$choix_auth_cli_devis;
$texte.='\';';
$texte.="\n";
$texte.='$auth_cli_bon=\'';
$texte.=$choix_auth_cli_bon;
$texte.='\';';
$texte.="\n";
$texte.='$auth_cli_fact=\'';
$texte.=$choix_auth_cli_fact;
$texte.='\';';
$texte.="\n";
$texte.='$first_art=\'';
$texte.=$choix_first_art;
$texte.='\';';
$texte.="\n";
$texte.='$echeance_fact=\'';
$texte.=$choix_echeance_fact;
$texte.='\';';
$texte.="\n";

if (is_writable($filename)){
 if (!$handle = fopen($filename, 'w+')){
  echo "Impossible d'ouvrir le fichier ($filename)";
  include("admin.php"); 
  exit;
 }
 if (fwrite($handle, $texte) === FALSE){
  $message= "<h1>Impossible d'écrire dans le fichier ($filename)</h1>";
  include("admin.php"); 
  exit;
 }
 fclose($handle);
 $message="<h2>$lang_new_config_ok</h2>";
 include("admin.php");
}else{
 $message= "<h1>Le fichier $filename n'est pas accessible en écriture.</h1>";
 include("admin.php"); 
}
