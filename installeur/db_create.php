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
 * File Name: db_create.php
 * 	creation de la base de donnée
 *
 * * * Version:  5.0.0
 * * * * Modified: 07/10/2016
 *
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
$etape = "Étape N°4 : Initialiser la base de données, créer la base, les tables et l'utilisateur primaire";
include('headers.php');
$sqldbc = "yep";
include("table_create.php");
