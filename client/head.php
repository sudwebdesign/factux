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

$sql = "SELECT num_client, nom, nom2 FROM " . $tblpref ."client WHERE login = '".$login."'";
$req = mysql_query($sql);
$data = mysql_fetch_array($req);
$nom = $data['nom'];
$nom2 = $data['nom2'];
$num_client = $data['num_client'];
    //Efface les fichiers temporaires
		$dir = "../fpdf" ;
    $t=time();
    $h=opendir($dir);
    while($file=readdir($h))
    {
        if(substr($file,0,3)=='tmp' and substr($file,-4)=='.pdf')
        {
            $path=$dir.'/'.$file;
            if($t-filemtime($path)>3)
                @unlink($path);
        }
    }
    closedir($h);

?>
<h6>Bienvenue <?php echo "$nom  $nom2"; ?></h6>
<center><img src="../image/<?php echo $logo ?>" alt=""><br><hr>