-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 17 Novembre 2015 à 14:35
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `edison_ways`
--

-- --------------------------------------------------------

--
-- Structure de la table `boitier_primaire`
--

CREATE TABLE IF NOT EXISTS `boitier_primaire` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Objet` int(11) NOT NULL,
  `Consommation` decimal(10,0) NOT NULL,
  `Etat_actuel` tinyint(1) NOT NULL,
  `Bug` tinyint(1) NOT NULL,
  `Type_bug` varchar(255) NOT NULL,
  `Detail_bug` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `boitier_primaire`
--

INSERT INTO `boitier_primaire` (`ID`, `ID_Objet`, `Consommation`, `Etat_actuel`, `Bug`, `Type_bug`, `Detail_bug`) VALUES
(1, 0, '12', 1, 0, 'RAS', 'RAS');

-- --------------------------------------------------------

--
-- Structure de la table `boitier_secondaire`
--

CREATE TABLE IF NOT EXISTS `boitier_secondaire` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Objet` int(11) NOT NULL,
  `Consommation` decimal(10,0) NOT NULL,
  `Etat_actuel` tinyint(1) NOT NULL,
  `Bug` tinyint(1) NOT NULL,
  `Type_bug` varchar(255) NOT NULL,
  `Detail_bug` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `boitier_secondaire`
--

INSERT INTO `boitier_secondaire` (`ID`, `ID_Objet`, `Consommation`, `Etat_actuel`, `Bug`, `Type_bug`, `Detail_bug`) VALUES
(1, 1, '24', 1, 0, 'RAS', 'RAS');

-- --------------------------------------------------------

--
-- Structure de la table `charges`
--

CREATE TABLE IF NOT EXISTS `charges` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Objet` int(11) NOT NULL,
  `Priorite` int(11) NOT NULL,
  `Calibre` int(11) NOT NULL,
  `Etat_actuel` tinyint(1) NOT NULL,
  `Preference` tinyint(1) NOT NULL,
  `Nom_source` varchar(255) NOT NULL,
  `Consommation` decimal(10,0) NOT NULL,
  `Bug` tinyint(1) NOT NULL,
  `Detail_bug` text NOT NULL,
  `Alerte` tinyint(1) NOT NULL,
  `Detail_alerte` text NOT NULL,
  `Icones` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `charges`
--

INSERT INTO `charges` (`ID`, `ID_Objet`, `Priorite`, `Calibre`, `Etat_actuel`, `Preference`, `Nom_source`, `Consommation`, `Bug`, `Detail_bug`, `Alerte`, `Detail_alerte`, `Icones`) VALUES
(1, 1, 8, 14, 0, 0, 'EOLIEN', '13', 1, 'Ampoule grillée', 1, 'Changer ampoule', 3);

-- --------------------------------------------------------

--
-- Structure de la table `comptes`
--

CREATE TABLE IF NOT EXISTS `comptes` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nom_compte` varchar(255) NOT NULL,
  `Type_compte` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `comptes`
--

INSERT INTO `comptes` (`ID`, `Nom_compte`, `Type_compte`) VALUES
(1, 'Jean- Luc', 'ADMINISTRATEUR');

-- --------------------------------------------------------

--
-- Structure de la table `fil`
--

CREATE TABLE IF NOT EXISTS `fil` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Objet` int(11) NOT NULL,
  `Etat_actuel` tinyint(1) NOT NULL,
  `Bug` tinyint(1) NOT NULL,
  `Type_bug` varchar(255) NOT NULL,
  `Detail_bug` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `fil`
--

INSERT INTO `fil` (`ID`, `ID_Objet`, `Etat_actuel`, `Bug`, `Type_bug`, `Detail_bug`) VALUES
(1, 4, 1, 0, 'RAS', 'RAS');

-- --------------------------------------------------------

--
-- Structure de la table `historique_alerte`
--

CREATE TABLE IF NOT EXISTS `historique_alerte` (
  `ID` int(11) NOT NULL,
  `Etat_Alerte` tinyint(1) NOT NULL,
  `ID_Objet` int(11) NOT NULL,
  `Type_Alerte` varchar(50) NOT NULL,
  `Detail_Alerte` text NOT NULL,
  `Conseil` text NOT NULL,
  `Date_alerte` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `historique_consommation`
--

CREATE TABLE IF NOT EXISTS `historique_consommation` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Objet` int(11) NOT NULL,
  `Consommation` decimal(10,0) NOT NULL,
  `Date` date NOT NULL,
  `Heure` time NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `historique_panne`
--

CREATE TABLE IF NOT EXISTS `historique_panne` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Objet` int(11) NOT NULL,
  `Bug` tinyint(1) NOT NULL,
  `Type_bug` varchar(255) NOT NULL,
  `Detail_bug` text NOT NULL,
  `Date_bug` date NOT NULL,
  `Intervention` tinyint(1) NOT NULL,
  `Date_intervention` date NOT NULL,
  `Nom_agent` varchar(255) NOT NULL,
  `Etat_final` tinyint(1) NOT NULL,
  `Type_intervention` varchar(255) NOT NULL,
  `Detail_intervention` text NOT NULL,
  `autre` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `historique_panne`
--

INSERT INTO `historique_panne` (`ID`, `ID_Objet`, `Bug`, `Type_bug`, `Detail_bug`, `Date_bug`, `Intervention`, `Date_intervention`, `Nom_agent`, `Etat_final`, `Type_intervention`, `Detail_intervention`, `autre`) VALUES
(1, 0, 1, 'DEFAUT CHARGE', 'Ampoule grillée', '2015-11-04', 1, '2015-11-05', 'kevin', 1, 'REPARATION', 'Changement de l''ampoule', 3);

-- --------------------------------------------------------

--
-- Structure de la table `icônes`
--

CREATE TABLE IF NOT EXISTS `icônes` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nom_icônes` varchar(50) NOT NULL,
  `Adresse_fichier` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `interrupteur`
--

CREATE TABLE IF NOT EXISTS `interrupteur` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Objet` int(11) NOT NULL,
  `Bug` tinyint(1) NOT NULL,
  `Details_Bug` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `objet`
--

CREATE TABLE IF NOT EXISTS `objet` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nom_Objet` varchar(50) NOT NULL,
  `Type_Objet` varchar(50) NOT NULL,
  `Num_Boitier_Primaire` int(11) NOT NULL,
  `Num_Boitier_Secondaire` int(11) NOT NULL,
  `Num_Charge` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `programmation`
--

CREATE TABLE IF NOT EXISTS `programmation` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Objet` int(11) NOT NULL,
  `Nom_program` varchar(50) NOT NULL,
  `Action` tinyint(1) NOT NULL,
  `Hebdomadaire` tinyint(1) NOT NULL,
  `Date` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `source`
--

CREATE TABLE IF NOT EXISTS `source` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Objet` int(11) NOT NULL,
  `Consommation` decimal(10,0) NOT NULL,
  `Icones` int(11) NOT NULL,
  `Bug` tinyint(1) NOT NULL,
  `Detail_bug` text NOT NULL,
  `Prix` decimal(10,0) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `source`
--

INSERT INTO `source` (`ID`, `ID_Objet`, `Consommation`, `Icones`, `Bug`, `Detail_bug`, `Prix`) VALUES
(1, 0, '32', 3, 0, 'RAS', '0');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
