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
 * File Name: logout.php
 * 	deconnexion du programme
 * 
 * * * Version:  1.1.5_modif
 * Modified: 11/04/2005
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
 
 ini_set('session.save_path', 'include/session'); 

session_start();
session_register('trucmuch');

session_unset();
session_destroy();
    //Efface les fichiers temporaires
    $dir = "fpdf" ;
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

include("login.inc.php");

 ?> 