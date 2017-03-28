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
 * File Name: bas.php
 * 	fichier commun de bas de page
 * 
 * * Version:  5.0.0
 * * * Modified: 07/10/2016
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
?>
  <table cellspacing="0" cellpadding="0" align="center">
   <tr>
    <td><?php echo $lang_factux; ?>
    <td rowspan="2"><a href="http://factux.free.fr" target="_blank" ><img src="image/factux.gif" height="77" alt="<?php echo "$lang_factux - $code_langue - $lang" ?>" ></a></td>
   <tr>
   <td> 
    <?php echo $lang_source_fac; ?> <a href="http://factux.free.fr" target="_blank" alt="Thomas">Thom@s</a>
   </td>
   </tr>
  </table>
  <hr>
  <p>
    <a href="https://<?php echo $default_lang; ?>.wikipedia.org/wiki/Open_source" target="_blank">
      <img border="0" src="image/opensource.png" title="Webiciel Libre!" alt="Webiciel Libre!" height="40">
    </a>
    <a href="https://gnu.org/licenses/quick-guide-gplv3.html" target="_blank">
      <img border="0" src="image/gplv3.png" title="Webiciel Libre!" alt="Webiciel Libre!" height="40">
    </a>
  </p>
