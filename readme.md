![Factux](http://factux.free.fr/goodies/factux.png)
# Factux révision 2017
## v5.0.1
## Le facturier libre
## The free/libre invoicer

Factux est un webiciel PHP multilingue libre auto-hébergé pour une TPE/PME
Il est utile dans la vente de services, produits et marchandises, pour la gestion des dépenses, devis, bons de commandes, factures et l'encaissement de la clientelle.

Les documents sont générés en pdf, des statistiques sont disponible pour avoir une bonne visibilité de l'état des dépenses, en cours et réglements
Une partie client est disponible afin qu'ils puissent eux même accepter ou non leurs devis et de pouvoir les imprimés ainsi que leurs bons de commandes et factures.

Il s'agit d'une version révisé, amélioré, plus rapide et sécurisé de [Factux.1.1.5](http://web.archive.org/web/20070626110226/http://www.factux.org/wiki/index.php?display=PageIndex) de Guy Hendrickx.

J'ai fait de mon mieux pour que la mise a niveau de Factux 1.1.5 vers celle-ci soit possible sans encombre.


### Documentation
La documentation de Factux se trouve dans le dossier /doc et aussi sur le [site de Factux](http://factux.free.fr).

## Spécifications
1. PHP 5.1.6 et plus (php 7 ready)
2. Base de données MariaDB/MySQL
3. Serveur web Linux / Windows (Apache de préférence)

## Instructions d'installation 
1. Téléverser tout les fichiers se trouvant dans le dossier 'factux' dans votre serveur web.
2. S'assurerr que les dossiers suivant soit autorisés en écriture (0755 or 0777)
   - /
   - /include
   - /include/config
   - /fpdf
   - /image
   - /dump
3. Dans votre navigateur préféré, allez a l'adresse (www.mon-factux.com) puis cliquer sur 'ici' dans le texte en rouge
4. Suivre les instructions de chaque étapes dans l'installeur pour configurer et compléter l'installation de Factux

Plus d'informations ce trouve dans le README.txt

## Translations
Factux is translated in French, English, Neederland, Español*, Italiano*, Deutsch*, Polski* & Ελληνικά*
*Translated by a Robots with 2 choices and this is translate helper for human in native language (use a file comparator).

Maybe ready for all country with tax (or not) and money symbol (Exemple French T.V.A. and €)


# English
Factux is a web-apps self-hosted open source solution built with PHP for managing your epxpendures, estimates, order, invoices, clients and payments. 

## Requirements
1. PHP 5.1.6 and above (php 7 ready)
2. MariaDB/MySQL database
3. Linux / Windows web server (Apache preferred)

## Installation Instructions
1. Upload all the files INSIDE the 'factux' folder onto your web server.
2. Ensure the following folders are writable (0755 or 0777)
   - /
   - /include
   - /include/config
   - /fpdf
   - /image
   - /dump
3. On your preferred web browser, load the application (www.your-factux.com) and click on 'ici' link
4. Follow the the stages installation instructions to complete the installation

Rem: the installator is only in french, but is a classical type of install (todo)

## License

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA 02111-1307, USA.