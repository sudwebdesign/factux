-- phpMyAdmin SQL Dump
-- version 2.6.2
-- http://www.phpmyadmin.net
-- 
-- Serveur: localhost
-- Généré le : Mardi 21 Juin 2005 à 17:20
-- Version du serveur: 4.0.24
-- Version de PHP: 4.3.10-15
-- 
-- Base de données: `test_factu`
-- 

-- --------------------------------------------------------

-- 
-- Structure de la table `factux_article`
-- 

CREATE TABLE `factux_article` (
  `num` int(10) NOT NULL auto_increment,
  `article` varchar(40) NOT NULL default '0',
  `prix_htva` float NOT NULL default '0',
  `taux_tva` float default '0',
  `commentaire` varchar(30) NOT NULL default '0',
  `uni` varchar(5) NOT NULL default '',
  `actif` varchar(5) NOT NULL default '',
  `stock` float(15,2) NOT NULL default '0.00',
  `stomin` float(15,2) NOT NULL default '0.00',
  `stomax` float(15,2) NOT NULL default '0.00',
  `cat` varchar(10) NOT NULL default '',
  PRIMARY KEY  (`num`)
) TYPE=MyISAM AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

-- 
-- Structure de la table `factux_bon_comm`
-- 

CREATE TABLE `factux_bon_comm` (
  `num_bon` int(30) NOT NULL auto_increment,
  `client_num` varchar(10) NOT NULL default '',
  `date` date NOT NULL default '0000-00-00',
  `tot_htva` float(20,2) NOT NULL default '0.00',
  `tot_tva` float(20,2) NOT NULL default '0.00',
  `fact` varchar(4) NOT NULL default '0',
  `coment` varchar(200) NOT NULL default '',
  PRIMARY KEY  (`num_bon`)
) TYPE=MyISAM AUTO_INCREMENT=261 ;

-- --------------------------------------------------------

-- 
-- Structure de la table `factux_categorie`
-- 

CREATE TABLE `factux_categorie` (
  `id_cat` int(11) NOT NULL auto_increment,
  `categorie` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`id_cat`)
) TYPE=MyISAM AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

-- 
-- Structure de la table `factux_client`
-- 

CREATE TABLE `factux_client` (
  `num_client` int(10) NOT NULL auto_increment,
  `nom` varchar(30) NOT NULL default '',
  `nom2` varchar(30) NOT NULL default '',
  `rue` varchar(30) NOT NULL default '',
  `ville` varchar(30) NOT NULL default '',
  `cp` varchar(5) NOT NULL default '',
  `num_tva` varchar(30) NOT NULL default '',
  `login` varchar(10) NOT NULL default '',
  `pass` varchar(40) NOT NULL default '',
  `mail` varchar(30) NOT NULL default '',
  `actif` varchar(5) NOT NULL default '',
  `permi` varchar(255) NOT NULL default '',
  `civ` varchar(15) NOT NULL default '',
  `tel` varchar(30) NOT NULL default '',
  `fax` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`num_client`)
) TYPE=MyISAM AUTO_INCREMENT=37 ;

-- --------------------------------------------------------

-- 
-- Structure de la table `factux_cont_bon`
-- 

CREATE TABLE `factux_cont_bon` (
  `num` int(30) NOT NULL auto_increment,
  `bon_num` varchar(30) NOT NULL default '',
  `num_lot` varchar(15) NOT NULL default '',
  `article_num` varchar(30) NOT NULL default '',
  `quanti` double NOT NULL default '0',
  `tot_art_htva` float(20,2) NOT NULL default '0.00',
  `to_tva_art` float(20,2) NOT NULL default '0.00',
  `p_u_jour` float(20,2) NOT NULL default '0.00',
  PRIMARY KEY  (`num`)
) TYPE=MyISAM AUTO_INCREMENT=440 ;

-- --------------------------------------------------------

-- 
-- Structure de la table `factux_cont_dev`
-- 

CREATE TABLE `factux_cont_dev` (
  `num` int(30) NOT NULL auto_increment,
  `dev_num` varchar(30) NOT NULL default '',
  `article_num` varchar(30) NOT NULL default '',
  `quanti` double NOT NULL default '0',
  `tot_art_htva` float(20,2) NOT NULL default '0.00',
  `to_tva_art` float(20,2) NOT NULL default '0.00',
  `p_u_jour` float(20,2) NOT NULL default '0.00',
  PRIMARY KEY  (`num`)
) TYPE=MyISAM AUTO_INCREMENT=119 ;

-- --------------------------------------------------------

-- 
-- Structure de la table `factux_cont_lot`
-- 

CREATE TABLE `factux_cont_lot` (
  `num` int(15) NOT NULL auto_increment,
  `num_lot` int(10) NOT NULL default '0',
  `ingr` varchar(20) NOT NULL default '',
  `fourn` varchar(15) NOT NULL default '',
  `fourn_lot` varchar(20) NOT NULL default '',
  PRIMARY KEY  (`num`)
) TYPE=MyISAM AUTO_INCREMENT=66 ;

-- --------------------------------------------------------

-- 
-- Structure de la table `factux_depense`
-- 

CREATE TABLE `factux_depense` (
  `num` int(11) NOT NULL auto_increment,
  `date` date NOT NULL default '0000-00-00',
  `lib` varchar(50) NOT NULL default '',
  `fournisseur` varchar(30) NOT NULL default '',
  `prix` float(10,2) NOT NULL default '0.00',
  PRIMARY KEY  (`num`)
) TYPE=MyISAM AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

-- 
-- Structure de la table `factux_devis`
-- 

CREATE TABLE `factux_devis` (
  `num_dev` int(30) NOT NULL auto_increment,
  `client_num` varchar(10) NOT NULL default '',
  `date` date NOT NULL default '0000-00-00',
  `tot_htva` float(20,2) NOT NULL default '0.00',
  `tot_tva` float(20,2) NOT NULL default '0.00',
  `resu` varchar(4) NOT NULL default '0',
  `coment` varchar(200) NOT NULL default '',
  PRIMARY KEY  (`num_dev`)
) TYPE=MyISAM AUTO_INCREMENT=67 ;

-- --------------------------------------------------------

-- 
-- Structure de la table `factux_facture`
-- 

CREATE TABLE `factux_facture` (
  `num` int(11) NOT NULL auto_increment,
  `date_deb` date NOT NULL default '0000-00-00',
  `date_fin` date NOT NULL default '0000-00-00',
  `CLIENT` varchar(30) NOT NULL default '',
  `payement` varchar(15) NOT NULL default 'non',
  `date_fact` date NOT NULL default '0000-00-00',
  `total_fact_h` float(20,2) NOT NULL default '0.00',
  `total_fact_ttc` float(20,2) NOT NULL default '0.00',
  `r1` varchar(10) NOT NULL default 'non',
  `r2` varchar(10) NOT NULL default 'non',
  `r3` varchar(10) NOT NULL default 'non',
  `coment` varchar(200) NOT NULL default '',
  `acompte` float(10,2) NOT NULL default '0.00',
  `list_num` mediumtext NOT NULL,
  PRIMARY KEY  (`num`)
) TYPE=MyISAM AUTO_INCREMENT=151 ;

-- --------------------------------------------------------

-- 
-- Structure de la table `factux_lot`
-- 

CREATE TABLE `factux_lot` (
  `num` int(10) NOT NULL auto_increment,
  `prod` varchar(25) NOT NULL default '',
  `actif` char(3) NOT NULL default '0',
  `date` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`num`)
) TYPE=MyISAM AUTO_INCREMENT=25 ;

-- --------------------------------------------------------

-- 
-- Structure de la table `factux_payement`
-- 

CREATE TABLE `factux_payement` (
  `num` int(10) NOT NULL auto_increment,
  `num_fact` varchar(30) NOT NULL default '',
  `pay` varchar(4) NOT NULL default '',
  `date_pay` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`num`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Structure de la table `factux_user`
-- 

CREATE TABLE `factux_user` (
  `num` int(10) NOT NULL auto_increment,
  `login` varchar(10) NOT NULL default '',
  `nom` varchar(20) NOT NULL default '',
  `prenom` varchar(20) NOT NULL default '',
  `pwd` varchar(40) NOT NULL default '',
  `email` varchar(30) NOT NULL default '',
  `dev` char(1) NOT NULL default 'n',
  `com` char(1) NOT NULL default 'n',
  `fact` char(1) NOT NULL default 'n',
  `admin` char(1) NOT NULL default 'n',
  `dep` char(1) NOT NULL default 'n',
  `stat` char(1) NOT NULL default 'n',
  `art` char(1) NOT NULL default 'n',
  `cli` char(1) NOT NULL default 'n',
  PRIMARY KEY  (`num`)
) TYPE=MyISAM AUTO_INCREMENT=19 ;
        