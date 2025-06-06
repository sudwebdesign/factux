<?php
/*
 * Factux le facturier libre
 * Copyright (C) 2003-2005 Guy Hendrickx, 2017 Thomas Ingles
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
 * * Version:  5.0.0
 * * * Modified: 07/10/2016
 *
 * File Authors:
 * 		Guy Hendrickx
 *.
 */

function couleur_alternee ($alterne=TRUE, $type="texte")
{
  global $couleur_courante;
  return ($alterne? $type.++$couleur_courante % 2 :$type.$couleur_courante % 2);
}

function stat_baton_horizontal($valeur,$largeur = 3, $image = "image/barre.jpg",  $font=2)
{
  $barre = round(floatval($valeur)) * $largeur;
  return '<img src="'.$image.'" width="'.$barre.'" height="10" alt="barre"><font size='.$font.'>'. $valeur.'</font>';
}

function parseCSS($filename){
 $fp=fopen($filename, "r");
  $css = fread($fp, filesize ($filename));
  fclose($fp);

  $css=preg_replace("/[\s, ]+/", "", $css);
  $css_class = preg_split("/}/", $css);

  foreach($css_class as $key => $val){
   $aCSSObj=preg_split("/{/", $val);
   $a=preg_split("/;/", $aCSSObj[1]);
   foreach($a as $key => $val0){
    if($val0 !=''){
     $aCSSSub=preg_split("/:/", $val0);
     $aCSSItem[$aCSSSub[0]]=$aCSSSub[1];
    }
   }
   $aCSS[$aCSSObj[0]]=$aCSSItem;
   unset($aCSSItem);
  }

  unset($css);
  unset($css_class);
  unset($aCSSSub);
  unset($aCSSItem);
  unset($aCSSObj);

  return $aCSS;

}
?>
