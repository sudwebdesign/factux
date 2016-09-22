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
include_once("include/config/common.php");
$annee = date(Y);
//1
$sql = "SELECT SUM(tot_htva)FROM bon_comm WHERE MONTH(date) = '1' AND YEAR(date) = YEAR(NOW());";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
		$entre1 = $data['SUM(tot_htva)'];
$sql = " SELECT SUM(prix)FROM `depense` WHERE MONTH(date) = 1 AND YEAR(date) = YEAR(NOW())";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
		$depe1 = $data['SUM(prix)'];
//2
$sql = "SELECT SUM(tot_htva)FROM bon_comm WHERE MONTH(date) = '2' AND YEAR(date) = YEAR(NOW())";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
   		$entre2 = $data['SUM(tot_htva)'];
$sql = " SELECT SUM(prix)FROM `depense` WHERE MONTH(date) = 2 AND YEAR(date) = YEAR(NOW())";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
		$depe2 = $data['SUM(prix)'];
//3
$sql = "SELECT SUM(tot_htva)FROM bon_comm WHERE MONTH(date) = '3' AND YEAR(date) = YEAR(NOW())";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
		$entre3 = $data['SUM(tot_htva)'];
$sql = " SELECT SUM(prix)FROM `depense` WHERE MONTH(date) = 3 AND YEAR(date) = YEAR(NOW())";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
		$depe3 = $data['SUM(prix)'];
//4
$sql = "SELECT SUM(tot_htva)FROM bon_comm WHERE MONTH(date) = '4' AND YEAR(date) = YEAR(NOW())";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
		$entre4 = $data['SUM(tot_htva)'];
$sql = " SELECT SUM(prix)FROM `depense` WHERE MONTH(date) = 4 AND YEAR(date) = YEAR(NOW())";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
		$depe4 = $data['SUM(prix)'];
//5
$sql = "SELECT SUM(tot_htva)FROM bon_comm WHERE MONTH(date) = '5' AND YEAR(date) = YEAR(NOW())";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
		$entre5 = $data['SUM(tot_htva)'];
$sql = " SELECT SUM(prix)FROM `depense` WHERE MONTH(date) = 5 AND YEAR(date) = YEAR(NOW())";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
		$depe5 = $data['SUM(prix)'];
//6
$sql = "SELECT SUM(tot_htva)FROM bon_comm WHERE MONTH(date) = '6' AND YEAR(date) = YEAR(NOW())";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
		$entre6 = $data['SUM(tot_htva)'];
$sql = " SELECT SUM(prix)FROM `depense` WHERE MONTH(date) = 6 AND YEAR(date) = YEAR(NOW())";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
		$depe6 = $data['SUM(prix)'];
//7
$sql = "SELECT SUM(tot_htva)FROM bon_comm WHERE MONTH(date) = '7' AND YEAR(date) = YEAR(NOW())";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
		$entre7 = $data['SUM(tot_htva)'];
$sql = " SELECT SUM(prix)FROM `depense` WHERE MONTH(date) = 7 AND YEAR(date) = YEAR(NOW())";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_array($req))
    {
		$depe7 = $data['SUM(prix)'];
		}
//8
$sql = "SELECT SUM(tot_htva)FROM bon_comm WHERE MONTH(date) = '8' AND YEAR(date) = YEAR(NOW())";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
		$entre8 = $data['SUM(tot_htva)'];
$sql = " SELECT SUM(prix)FROM `depense` WHERE MONTH(date) = 8 AND YEAR(date) = YEAR(NOW())";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
		$depe8 = $data['SUM(prix)'];
//9
$sql = "SELECT SUM(tot_htva)FROM bon_comm WHERE MONTH(date) = '9' AND YEAR(date) = YEAR(NOW())";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
		$entre9 = $data['SUM(tot_htva)'];
$sql = " SELECT SUM(prix)FROM `depense` WHERE MONTH(date) = 9 AND YEAR(date) = YEAR(NOW())";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
		$depe9 = $data['SUM(prix)'];
//10
$sql = "SELECT SUM(tot_htva)FROM bon_comm WHERE MONTH(date) = '10' AND YEAR(date) = YEAR(NOW())";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
		$entre10 = $data['SUM(tot_htva)'];
$sql = " SELECT SUM(prix)FROM `depense` WHERE MONTH(date) = 10 AND YEAR(date) = YEAR(NOW())";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
		$depe10 = $data['SUM(prix)'];
//11
$sql = "SELECT SUM(tot_htva)FROM bon_comm WHERE MONTH(date) = '11'";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
		$entre11 = $data['SUM(tot_htva)'];
$sql = " SELECT SUM(prix)FROM `depense` WHERE MONTH(date) = 11 AND YEAR(date) = YEAR(NOW())";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
		$depe11 = $data['SUM(prix)'];
//12
$sql = "SELECT SUM(tot_htva)FROM bon_comm WHERE MONTH(date) = '12' AND YEAR(date) = YEAR(NOW())";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
		$entre12 = $data['SUM(tot_htva)'];
$sql = " SELECT SUM(prix)FROM `depense` WHERE MONTH(date) = 12 AND YEAR(date) = YEAR(NOW())";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req);
		$depe12 = $data['SUM(prix)'];
$stat1 = $entre1 - $depe1 ;
$stat2 = $entre2 - $depe2 ;
$stat3 = $entre3 - $depe3 ;
$stat4 = $entre4 - $depe4 ;
$stat5 = $entre5 - $depe5 ;
$stat6 = $entre6 - $depe6 ;
$stat7 = $entre7 - $depe7 ;
$stat8 = $entre8 - $depe8 ;
$stat9 = $entre9 - $depe9 ;
$stat10 = $entre10 - $depe10 ;
$stat11 = $entre11 - $depe11 ;
$stat12 = $entre12 - $depe12 ;
    /*
    ** Graphique sectoriel au format GIF
    */


    /*
    ** Convertir les degrés en radians
    */
    function radians($degrees)
    {
        return($degrees * (pi()/180.0));
    }

    /*
    ** prendre x,y dans le cercle,
    ** centre = 0,0
    */
      function circle_point($degrees, $diameter)
      {
        $x = cos(radians($degrees)) * ($diameter/2);
        $y = sin(radians($degrees)) * ($diameter/2);

        return (array($x, $y));
      }


    //remplir les paramètres
    $ChartDiameter = 200;
    $ChartFont = 3;
    $ChartFontHeight = imagefontheight($ChartFont);
    $ChartData = array("$entre1", "$entre2", "$entre3", "$entre4", "$entre5","$entre6", "$entre7", "$entre8", "$entre9","$entre10","$entre11", "$entre12");
    $ChartLabel = array("Janvier", "Février",
        "Mars", "Avril", "Mai", "Juin", "Juillet", "Août","Septembre","Octobre", "Novembre", "Decembre");

    //déterminer la taille du graphique
    $ChartWidth = $ChartDiameter + 20;
    $ChartHeight = $ChartDiameter + 20 +
        (($ChartFontHeight + 2) * count($ChartData));

    //détermine le total de toutes les valeurs
    for($index = 0; $index < count($ChartData); $index++)
    {
        $ChartTotal += $ChartData[$index];
    }

    $ChartCenterX = $ChartDiameter/2 + 10;
    $ChartCenterY = $ChartDiameter/2 + 10;


    //image
    $image = imagecreate($ChartWidth, $ChartHeight);

    //couleurs
    $colorBody = imagecolorallocate($image, 0xCC, 0xCC, 0xCC);
    $colorBorder = imagecolorallocate($image, 0x00, 0x00, 0x00);
    $colorText = imagecolorallocate($image, 0x00, 0x00, 0x00);

    $colorSlice[] = imagecolorallocate($image, 0xFF, 0x00, 0x00);
    $colorSlice[] = imagecolorallocate($image, 0x00, 0xFF, 0x00);
    $colorSlice[] = imagecolorallocate($image, 0x00, 0x00, 0xFF);
    $colorSlice[] = imagecolorallocate($image, 0xFF, 0xFF, 0x00);
    $colorSlice[] = imagecolorallocate($image, 0xFF, 0x00, 0xFF);
    $colorSlice[] = imagecolorallocate($image, 0x00, 0xFF, 0xFF);
    $colorSlice[] = imagecolorallocate($image, 0x99, 0x00, 0x00);
    $colorSlice[] = imagecolorallocate($image, 0x00, 0x99, 0x00);
    $colorSlice[] = imagecolorallocate($image, 0x00, 0x00, 0x99);
    $colorSlice[] = imagecolorallocate($image, 0x99, 0x99, 0x00);
    $colorSlice[] = imagecolorallocate($image, 0x99, 0x00, 0x99);
    $colorSlice[] = imagecolorallocate($image, 0x00, 0x99, 0x99);

    //arrière-plan
    imagefill($image, 0, 0, $colorBody);


    /*
    ** Dessiner chaque portion
    */
    $Degrees = 0;
    for($index = 0; $index < count($ChartData); $index++)
    {
        $StartDegrees = round($Degrees);
        $Degrees += (($ChartData[$index]/$ChartTotal)*360);
        $EndDegrees = round($Degrees);

        $CurrentColor = $colorSlice[$index%(count($colorSlice))];

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
    for($index = 0; $index < count($ChartData); $index++)
    {
        $CurrentColor = $colorSlice[$index%(count($colorSlice))];
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


    //afficher l'image
    header("Content-type: image/png");
    imagepng($image);
		
?>
