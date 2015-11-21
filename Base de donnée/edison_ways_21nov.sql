-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Sam 21 Novembre 2015 à 18:20
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
-- Structure de la table `charge`
--

CREATE TABLE IF NOT EXISTS `charge` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Objet` int(11) NOT NULL,
  `Priorite` int(11) NOT NULL,
  `Calibre` int(11) NOT NULL,
  `Preference` tinyint(1) NOT NULL,
  `ID_Source` int(11) NOT NULL,
  `ID_Icone` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Icones` (`ID_Icone`),
  KEY `Nom_Source` (`ID_Source`),
  KEY `ID_Objet` (`ID_Objet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `comptes`
--

CREATE TABLE IF NOT EXISTS `comptes` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nom_compte` varchar(255) NOT NULL,
  `Type_compte` varchar(255) NOT NULL,
  `mot_de_passe` varchar(15) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Nom_compte` (`Nom_compte`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `comptes`
--

INSERT INTO `comptes` (`ID`, `Nom_compte`, `Type_compte`, `mot_de_passe`) VALUES
(1, 'Jean- Luc', 'ADMINISTRATEUR', '');

-- --------------------------------------------------------

--
-- Structure de la table `consommation`
--

CREATE TABLE IF NOT EXISTS `consommation` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Objet` int(11) NOT NULL,
  `Etat_Objet` tinyint(1) NOT NULL,
  `Consommation` decimal(10,0) NOT NULL,
  `Temps` datetime NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID_Objet` (`ID_Objet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `defaut`
--

CREATE TABLE IF NOT EXISTS `defaut` (
  `ID` int(11) NOT NULL,
  `ID_Objet` int(11) NOT NULL,
  `Nom_Defaut` varchar(15) NOT NULL,
  `Type_Defaut` varchar(50) NOT NULL,
  `Detail_Defaut` text NOT NULL,
  `Date_alerte` datetime NOT NULL,
  KEY `ID_Objet` (`ID_Objet`),
  KEY `Nom_Defaut` (`Nom_Defaut`),
  KEY `Type_Defaut` (`Type_Defaut`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `icone`
--

CREATE TABLE IF NOT EXISTS `icone` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nom_icônes` varchar(50) NOT NULL,
  `Adresse_fichier` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `nom_defaut`
--

CREATE TABLE IF NOT EXISTS `nom_defaut` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nom_Defaut` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Nom_Defaut` (`Nom_Defaut`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `nom_defaut`
--

INSERT INTO `nom_defaut` (`ID`, `Nom_Defaut`) VALUES
(2, 'ALERTE'),
(1, 'PANNE');

-- --------------------------------------------------------

--
-- Structure de la table `objet`
--

CREATE TABLE IF NOT EXISTS `objet` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nom_Objet` varchar(50) NOT NULL,
  `Type_Objet` varchar(30) NOT NULL,
  `Num_Boitier_Primaire` int(11) NOT NULL,
  `Num_Boitier_Secondaire` int(11) NOT NULL,
  `Num_Charge` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Type_Objet` (`Type_Objet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `programmation`
--

CREATE TABLE IF NOT EXISTS `programmation` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `type_compte` varchar(20) NOT NULL,
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
  `Prix` decimal(10,0) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID_Objet` (`ID_Objet`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `test`
--

CREATE TABLE IF NOT EXISTS `test` (
  `test` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`test`),
  UNIQUE KEY `test` (`test`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `type_defaut`
--

CREATE TABLE IF NOT EXISTS `type_defaut` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `nom_type` varchar(250) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `nom_type` (`nom_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `type_objet`
--

CREATE TABLE IF NOT EXISTS `type_objet` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `nom_type` varchar(30) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `nom_type` (`nom_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `type_objet`
--

INSERT INTO `type_objet` (`ID`, `nom_type`) VALUES
(2, 'BOITIER PRIMAIRE'),
(3, 'BOITIER SECONDAIRE'),
(1, 'CHARGE'),
(4, 'FIL'),
(5, 'INTERRUPTEUR');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `charge`
--
ALTER TABLE `charge`
  ADD CONSTRAINT `fk_charge_source` FOREIGN KEY (`ID_Source`) REFERENCES `source` (`ID`),
  ADD CONSTRAINT `fk_charge_icone` FOREIGN KEY (`ID_Icone`) REFERENCES `icone` (`ID`),
  ADD CONSTRAINT `fk_charge_objet` FOREIGN KEY (`ID_Objet`) REFERENCES `objet` (`ID`);

--
-- Contraintes pour la table `consommation`
--
ALTER TABLE `consommation`
  ADD CONSTRAINT `fk_consommation_objet` FOREIGN KEY (`ID_Objet`) REFERENCES `objet` (`ID`);

--
-- Contraintes pour la table `defaut`
--
ALTER TABLE `defaut`
  ADD CONSTRAINT `fk_defaut_type` FOREIGN KEY (`Type_Defaut`) REFERENCES `type_defaut` (`nom_type`),
  ADD CONSTRAINT `fk_defaut_nom` FOREIGN KEY (`Nom_Defaut`) REFERENCES `nom_defaut` (`Nom_Defaut`),
  ADD CONSTRAINT `fk_defaut_objet` FOREIGN KEY (`ID_Objet`) REFERENCES `objet` (`ID`);

--
-- Contraintes pour la table `objet`
--
ALTER TABLE `objet`
  ADD CONSTRAINT `fk_objet_type` FOREIGN KEY (`Type_Objet`) REFERENCES `type_objet` (`nom_type`);

--
-- Contraintes pour la table `source`
--
ALTER TABLE `source`
  ADD CONSTRAINT `ba` FOREIGN KEY (`ID_Objet`) REFERENCES `test` (`test`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
