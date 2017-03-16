-- Adminer 4.2.4 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `factux_article`;
CREATE TABLE `factux_article` (
  `num` int(10) NOT NULL AUTO_INCREMENT,
  `article` varchar(40) NOT NULL DEFAULT '0',
  `prix_htva` float(20,2) NOT NULL DEFAULT '0.00',
  `taux_tva` float(4,2) NOT NULL DEFAULT '0.00',
  `marge` float(6,2) NOT NULL DEFAULT '1.00',
  `commentaire` varchar(30) NOT NULL DEFAULT '0',
  `uni` varchar(5) NOT NULL DEFAULT '',
  `actif` varchar(5) NOT NULL DEFAULT '',
  `stock` float(15,2) NOT NULL DEFAULT '0.00',
  `stomin` float(15,2) NOT NULL DEFAULT '0.00',
  `stomax` float(15,2) NOT NULL DEFAULT '0.00',
  `cat` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`num`)
) ENGINE=MyISAM;


DROP TABLE IF EXISTS `factux_bon_comm`;
CREATE TABLE `factux_bon_comm` (
  `num_bon` int(30) NOT NULL AUTO_INCREMENT,
  `client_num` int(10) NOT NULL DEFAULT '0',
  `date` date NOT NULL DEFAULT '0000-00-00',
  `tot_htva` float(20,2) NOT NULL DEFAULT '0.00',
  `tot_tva` float(20,2) NOT NULL DEFAULT '0.00',
  `fact` int(11) NOT NULL DEFAULT '0',
  `coment` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`num_bon`)
) ENGINE=MyISAM;


DROP TABLE IF EXISTS `factux_categorie`;
CREATE TABLE `factux_categorie` (
  `id_cat` int(11) NOT NULL AUTO_INCREMENT,
  `categorie` varchar(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_cat`)
) ENGINE=MyISAM;


DROP TABLE IF EXISTS `factux_client`;
CREATE TABLE `factux_client` (
  `num_client` int(10) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL DEFAULT '',
  `nom2` varchar(30) NOT NULL DEFAULT '',
  `rue` varchar(30) NOT NULL DEFAULT '',
  `ville` varchar(30) NOT NULL DEFAULT '',
  `cp` varchar(5) NOT NULL DEFAULT '',
  `num_tva` varchar(30) NOT NULL DEFAULT '',
  `login` varchar(10) NOT NULL DEFAULT '',
  `pass` varchar(40) NOT NULL DEFAULT '',
  `mail` varchar(30) NOT NULL DEFAULT '',
  `actif` varchar(5) NOT NULL DEFAULT '',
  `permi` varchar(255) NOT NULL DEFAULT '',
  `civ` varchar(15) NOT NULL DEFAULT '',
  `tel` varchar(30) NOT NULL DEFAULT '',
  `fax` varchar(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`num_client`)
) ENGINE=MyISAM;


DROP TABLE IF EXISTS `factux_cont_bon`;
CREATE TABLE `factux_cont_bon` (
  `num` int(40) NOT NULL AUTO_INCREMENT,
  `bon_num` int(30) NOT NULL DEFAULT '0',
  `num_lot` int(10) NOT NULL,
  `article_num` int(10) NOT NULL DEFAULT '0',
  `quanti` double NOT NULL DEFAULT '0',
  `tot_art_htva` float(20,2) NOT NULL DEFAULT '0.00',
  `to_tva_art` float(20,2) NOT NULL DEFAULT '0.00',
  `p_u_jour` float(20,2) NOT NULL DEFAULT '0.00',
  `marge_jour` float(6,2) NOT NULL DEFAULT '1.00',
  `remise` float(6,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`num`)
) ENGINE=MyISAM;


DROP TABLE IF EXISTS `factux_cont_dev`;
CREATE TABLE `factux_cont_dev` (
  `num` int(40) NOT NULL AUTO_INCREMENT,
  `dev_num` int(30) NOT NULL DEFAULT '0',
  `article_num` int(10) NOT NULL DEFAULT '0',
  `quanti` double NOT NULL DEFAULT '0',
  `tot_art_htva` float(20,2) NOT NULL DEFAULT '0.00',
  `to_tva_art` float(20,2) NOT NULL DEFAULT '0.00',
  `p_u_jour` float(20,2) NOT NULL DEFAULT '0.00',
  `marge_jour` float(6,2) NOT NULL DEFAULT '1.00',
  `remise` float(6,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`num`)
) ENGINE=MyISAM;


DROP TABLE IF EXISTS `factux_cont_lot`;
CREATE TABLE `factux_cont_lot` (
  `num` int(15) NOT NULL AUTO_INCREMENT,
  `num_lot` int(10) NOT NULL DEFAULT '0',
  `ingr` varchar(20) NOT NULL DEFAULT '',
  `fourn` varchar(15) NOT NULL DEFAULT '',
  `fourn_lot` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`num`)
) ENGINE=MyISAM;


DROP TABLE IF EXISTS `factux_depense`;
CREATE TABLE `factux_depense` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL DEFAULT '0000-00-00',
  `lib` varchar(50) NOT NULL DEFAULT '',
  `fournisseur` varchar(30) NOT NULL DEFAULT '',
  `prix` float(10,2) NOT NULL DEFAULT '0.00',
  `mont_tva` float(10,2) NOT NULL DEFAULT '0.00',
  `tx_tva` float(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`num`)
) ENGINE=MyISAM;


DROP TABLE IF EXISTS `factux_devis`;
CREATE TABLE `factux_devis` (
  `num_dev` int(30) NOT NULL AUTO_INCREMENT,
  `client_num` int(10) NOT NULL DEFAULT '0',
  `date` date NOT NULL DEFAULT '0000-00-00',
  `tot_htva` float(20,2) NOT NULL DEFAULT '0.00',
  `tot_tva` float(20,2) NOT NULL DEFAULT '0.00',
  `resu` int(30) NOT NULL DEFAULT '0',
  `coment` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`num_dev`)
) ENGINE=MyISAM;


DROP TABLE IF EXISTS `factux_facture`;
CREATE TABLE `factux_facture` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `date_deb` date NOT NULL DEFAULT '0000-00-00',
  `date_fin` date NOT NULL DEFAULT '0000-00-00',
  `date_fact` date NOT NULL DEFAULT '0000-00-00',
  `date_pay` date NOT NULL DEFAULT '0000-00-00',
  `client` int(10) NOT NULL DEFAULT '0',
  `payement` varchar(15) NOT NULL DEFAULT 'non',
  `total_fact_h` float(20,2) NOT NULL DEFAULT '0.00',
  `total_fact_ttc` float(20,2) NOT NULL DEFAULT '0.00',
  `r1` varchar(10) NOT NULL DEFAULT 'non',
  `r2` varchar(10) NOT NULL DEFAULT 'non',
  `r3` varchar(10) NOT NULL DEFAULT 'non',
  `coment` varchar(200) NOT NULL DEFAULT '',
  `acompte` float(10,2) NOT NULL DEFAULT '0.00',
  `list_num` mediumtext NOT NULL,
  PRIMARY KEY (`num`)
) ENGINE=MyISAM;


DROP TABLE IF EXISTS `factux_lot`;
CREATE TABLE `factux_lot` (
  `num` int(10) NOT NULL AUTO_INCREMENT,
  `prod` varchar(25) NOT NULL DEFAULT '',
  `actif` char(3) NOT NULL DEFAULT '0',
  `date` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`num`)
) ENGINE=MyISAM;


DROP TABLE IF EXISTS `factux_user`;
CREATE TABLE `factux_user` (
  `num` int(10) NOT NULL AUTO_INCREMENT,
  `login` varchar(10) NOT NULL DEFAULT '',
  `nom` varchar(20) NOT NULL DEFAULT '',
  `prenom` varchar(20) NOT NULL DEFAULT '',
  `pwd` varchar(40) NOT NULL DEFAULT '',
  `email` varchar(30) NOT NULL DEFAULT '',
  `dev` char(1) NOT NULL DEFAULT 'n',
  `com` char(1) NOT NULL DEFAULT 'n',
  `fact` char(1) NOT NULL DEFAULT 'n',
  `admin` char(1) NOT NULL DEFAULT 'n',
  `dep` char(1) NOT NULL DEFAULT 'n',
  `stat` char(1) NOT NULL DEFAULT 'n',
  `art` char(1) NOT NULL DEFAULT 'n',
  `cli` char(1) NOT NULL DEFAULT 'n',
  PRIMARY KEY (`num`)
) ENGINE=MyISAM;


-- 2016-10-07 12:02:07
