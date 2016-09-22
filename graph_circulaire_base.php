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
 * File Name: fckconfig.js
 * 	Editor configuration settings.
 * 
 * * * Version:  1.1.5
 * * * * Modified: 23/07/2005
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
require_once("include/verif.php");
/*
** Graphique sectoriel au format GIF
*/


/*
** Convertir les degrés en radians
*/
function radians($degrees){
 return($degrees * (pi()/180.0));
}

/*
** prendre x,y dans le cercle,
** centre = 0,0
*/
function circle_point($degrees, $diameter){
 $x = cos(radians($degrees)) * ($diameter/2);
 $y = sin(radians($degrees)) * ($diameter/2);
 return (array($x, $y));
}

//remplir les paramètres
$ChartDiameter = isset($ChartDiameter)?$ChartDiameter:200;
$ChartFont = isset($ChartFont)?$ChartFont:3;
$ChartFontHeight = imagefontheight($ChartFont);

$ChartData = isset($ChartData)?$ChartData:array("$entre[1]", "$entre[2]", "$entre[3]", "$entre[4]", "$entre[5]", "$entre[6]", "$entre[7]", "$entre[8]", "$entre[9]", "$entre[10]", "$entre[11]", "$entre[12]");
$ChartLabel = isset($ChartLabel)?$ChartLabel:array("Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Decembre");
//détermine le total de toutes les valeurs
$ChartTotal = 0;
for($index = 0; $index < count($ChartData); $index++){
 $ChartTotal += $ChartData[$index];
}

//déterminer la taille du graphique
$ChartWidth = $ChartDiameter + 20;
$ChartHeight = $ChartDiameter + 20 + (($ChartFontHeight + 2) * count($ChartData));

$ChartCenterX = $ChartDiameter/2 + 10;
$ChartCenterY = $ChartDiameter/2 + 10;

//image
$image = imagecreate($ChartWidth, $ChartHeight);

//couleurs
$colorBody = imagecolorallocatealpha($image, 255, 255, 255, 127);
$colorBorder = imagecolorallocatealpha($image, 0, 0, 0, 0);
$colorText = imagecolorallocatealpha($image, 0, 0, 0, 0);

$m=count($ChartData)%6;
$p=(count($ChartData)>257)?1536:256;
#256*6
$c=round($p/(count($ChartData)/6));
for($i=0; $i<count($ChartData)/6; $i++){#var_dump($m,$p,$c,255-($i*$c),64%6);
 $colorSlice[] = imagecolorallocate($image, (255-($i*$c)), 0, 0);
 $colorSlice[] = imagecolorallocate($image, 0, (255-($i*$c)), 0);
 $colorSlice[] = imagecolorallocate($image, 0, 0, (255-($i*$c)));
 $colorSlice[] = imagecolorallocate($image, (255-($i*$c)), (255-($i*$c)), 0);
 $colorSlice[] = imagecolorallocate($image, (255-($i*$c)), 0, (255-($i*$c)));
 $colorSlice[] = imagecolorallocate($image, 0, (255-($i*$c)), (255-($i*$c)));
}

#var_dump($colorSlice);#exit;

/* 12 month ORIGIN
$colorSlice[] = imagecolorallocate($image, 0xFF, 0x00, 0x00);
$colorSlice[] = imagecolorallocate($image, 0x00, 0xFF, 0x00);
$colorSlice[] = imagecolorallocate($image, 0x00, 0x00, 0xFF);
$colorSlice[] = imagecolorallocate($image, 0xFF, 0xFF, 0x00);
$colorSlice[] = imagecolorallocate($image, 0xFF, 0x00, 0xFF);
$colorSlice[] = imagecolorallocate($image, 0x00, 0xFF, 0xFF);
$colorSlice[] = imagecolorallocate($image, 0xCC, 0x00, 0x00);
$colorSlice[] = imagecolorallocate($image, 0x00, 0xCC, 0x00);
$colorSlice[] = imagecolorallocate($image, 0x00, 0x00, 0xCC);
$colorSlice[] = imagecolorallocate($image, 0xCC, 0xCC, 0x00);
$colorSlice[] = imagecolorallocate($image, 0xCC, 0x00, 0xCC);
$colorSlice[] = imagecolorallocate($image, 0x00, 0xCC, 0xCC);
*/

#var_dump($entre,$ChartTotal,$ChartData);exit;
/*
** Dessiner chaque portion
*/
$Degrees = 0;
if ($ChartTotal>0)#impossible de divisé par zéro*
 for($index = 0; $index < count($ChartData); $index++){
  if($ChartData[$index]>0){#evite de dessiné la ligne d'un pixel
   $StartDegrees = (int)$Degrees;#round($Degrees);
   $Degrees += (int)round((($ChartData[$index]/$ChartTotal)*360));#ici*
   $EndDegrees = ($Degrees>360)?360:(int)$Degrees;#round($Degrees);
   
   if($StartDegrees==$EndDegrees)#360&360 ou autre? (evite de remplir tout le cercle 360°)
    continue;

   $CurrentColor = $colorSlice[$index/*%(count($colorSlice))*/];

   /*var_dump($image,
    $StartDegrees,
    $EndDegrees,
    $CurrentColor);*/

   //dessiner un arc
   imagearc($image,
    $ChartCenterX,
    $ChartCenterY,
    $ChartDiameter,
    $ChartDiameter,
    $StartDegrees,
    $EndDegrees,
    $CurrentColor);

   //Tracer le début de la ligne à partir du centre
   list($ArcX, $ArcY) = circle_point($StartDegrees, $ChartDiameter);
   imageline($image,
    $ChartCenterX,
    $ChartCenterY,
    floor($ChartCenterX + $ArcX),
    floor($ChartCenterY + $ArcY),
    $CurrentColor);


   //dessiner la fin de la ligne
   list($ArcX, $ArcY) = circle_point($EndDegrees, $ChartDiameter);
   imageline($image,
    $ChartCenterX,
    $ChartCenterY,
    ceil($ChartCenterX + $ArcX),
    ceil($ChartCenterY + $ArcY),
    $CurrentColor);

   //remplir les portions
   $MidPoint = round((($EndDegrees - $StartDegrees)/2) +  $StartDegrees);
   list($ArcX, $ArcY) = circle_point($MidPoint, $ChartDiameter/2);
   imagefilltoborder($image,
    floor($ChartCenterX + $ArcX),
    floor($ChartCenterY + $ArcY),
    $CurrentColor,
    $CurrentColor);
  }
 }

#exit;
//la bordure
imagearc($image,
 $ChartCenterX,
 $ChartCenterY,
 $ChartDiameter,
 $ChartDiameter,
 0,
 180,
 $colorBorder);

imagearc($image,
 $ChartCenterX,
 $ChartCenterY,
 $ChartDiameter,
 $ChartDiameter,
 180,
 360,
 $colorBorder);


imagearc($image,
 $ChartCenterX,
 $ChartCenterY,
 $ChartDiameter+7,
 $ChartDiameter+7,
 0,
 180,
 $colorBorder);

imagearc($image,
 $ChartCenterX,
 $ChartCenterY,
 $ChartDiameter+7,
 $ChartDiameter+7,
 180,
 360,
 $colorBorder);


imagefilltoborder($image,
 floor($ChartCenterX +  ($ChartDiameter/2) +  2),
 $ChartCenterY,
 $colorBorder,
 $colorBorder);


//la légende
for($index = 0; $index < count($ChartData); $index++){
 $CurrentColor = $colorSlice[$index/*%(count($colorSlice))*/];
 $LineY = $ChartDiameter + 20 +  ($index*($ChartFontHeight+2));

 //la couleur des boîtes
 imagerectangle($image,
  10,
  $LineY,
  10 + $ChartFontHeight,
  $LineY+$ChartFontHeight,
  $colorBorder);

 imagefilltoborder($image,
  12,
  $LineY + 2,
  $colorBorder,
  $CurrentColor);

 //Les titres
 imagestring($image,
  $ChartFont,
  20 + $ChartFontHeight,
  $LineY,
  "$ChartLabel[$index]: $ChartData[$index]",
  $colorText);
}

//arrière-plan
imagefill($image, 0, 0, $colorBody);

//afficher l'image
header("Content-type: image/png");
imagepng($image);
