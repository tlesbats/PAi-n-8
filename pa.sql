-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 16 Février 2016 à 16:15
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `pa`
--

-- --------------------------------------------------------

--
-- Structure de la table `alerte`
--

CREATE TABLE IF NOT EXISTS `alerte` (
  `id` int(11) NOT NULL,
  `nameAlerte` varchar(15) NOT NULL,
  `description` text NOT NULL,
  `priorite` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `alerte`
--

INSERT INTO `alerte` (`id`, `nameAlerte`, `description`, `priorite`) VALUES
(2, 'prisechambre1', 'Il n''y a plus de courant dans la prisechambre1', 2);

-- --------------------------------------------------------

--
-- Structure de la table `batterie`
--

CREATE TABLE IF NOT EXISTS `batterie` (
  `id` int(11) NOT NULL,
  `stockage` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `batterie`
--

INSERT INTO `batterie` (`id`, `stockage`) VALUES
(1, '12');

-- --------------------------------------------------------

--
-- Structure de la table `cable`
--

CREATE TABLE IF NOT EXISTS `cable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nameCable` varchar(15) NOT NULL,
  `etatBug` int(1) NOT NULL,
  `localisation` int(4) NOT NULL,
  `icone` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `cable`
--

INSERT INTO `cable` (`id`, `nameCable`, `etatBug`, `localisation`, `icone`) VALUES
(1, 'int lum cuis', 0, 1191, ''),
(2, 'int lum évier', 0, 1192, ''),
(3, 'int réveil ch1', 0, 1291, ''),
(4, 'int lum ch1', 0, 1292, ''),
(5, 'frigo', 0, 1119, ''),
(6, 'four', 0, 1129, ''),
(7, 'lum cuisine', 0, 1139, ''),
(8, 'lum évier', 0, 1149, ''),
(9, 'réveil ch1', 0, 1159, ''),
(10, 'prise ch1', 0, 1169, '');

-- --------------------------------------------------------

--
-- Structure de la table `charge`
--

CREATE TABLE IF NOT EXISTS `charge` (
  `id` int(11) NOT NULL,
  `IDSource` int(11) NOT NULL,
  `priorite` int(11) NOT NULL,
  `calibre` int(11) NOT NULL,
  `etatBase` tinyint(1) NOT NULL,
  `etatCommande` int(1) NOT NULL,
  `pilotable` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `C_IDObjet` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `charge`
--

INSERT INTO `charge` (`id`, `IDSource`, `priorite`, `calibre`, `etatBase`, `etatCommande`, `pilotable`) VALUES
(2, 6, 1, 1, 1, 1, 0),
(3, 6, 2, 1, 0, 0, 1),
(4, 1, 3, 3, 0, 1, 1),
(5, 1, 3, 3, 0, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

CREATE TABLE IF NOT EXISTS `compte` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `typeCompte` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Nom_compte` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `compte`
--

INSERT INTO `compte` (`id`, `username`, `password`, `typeCompte`) VALUES
(1, 'Jean- Luc', 'ADMINISTRATEUR', 'admin'),
(2, 'Serge', 'UTILISATEUR', 'user'),
(3, 'Robert', 'MAINTENANCE', 'agent de maintenance');

-- --------------------------------------------------------

--
-- Structure de la table `conso_objet`
--

CREATE TABLE IF NOT EXISTS `conso_objet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `IDObjet` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `consommation` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDObjet` (`IDObjet`),
  KEY `consommation` (`consommation`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=63 ;

--
-- Contenu de la table `conso_objet`
--

INSERT INTO `conso_objet` (`id`, `IDObjet`, `date`, `consommation`) VALUES
(15, 3, '2016-02-15 00:00:00', 0),
(16, 3, '2016-02-15 00:30:00', 5),
(17, 3, '2016-02-15 01:00:00', 3),
(18, 3, '2016-02-15 01:30:00', 0.2),
(19, 3, '2016-02-15 02:00:00', 0),
(20, 3, '2016-02-15 02:30:00', 0),
(21, 3, '2016-02-15 03:00:00', 0),
(22, 3, '2016-02-15 03:30:00', 0),
(23, 3, '2016-02-15 04:00:00', 0),
(24, 3, '2016-02-15 04:30:00', 0),
(25, 3, '2016-02-15 05:00:00', 0),
(26, 3, '2016-02-15 05:30:00', 3),
(27, 3, '2016-02-15 06:00:00', 0.5),
(28, 3, '2016-02-15 06:30:00', 0),
(29, 3, '2016-02-15 07:00:00', 0),
(30, 3, '2016-02-15 07:30:00', 0),
(31, 3, '2016-02-15 08:00:00', 0),
(32, 3, '2016-02-15 08:30:00', 0),
(33, 3, '2016-02-15 09:00:00', 0),
(34, 3, '2016-02-15 09:30:00', 0),
(35, 3, '2016-02-15 10:00:00', 0),
(36, 3, '2016-02-15 10:30:00', 5),
(37, 3, '2016-02-15 11:00:00', 5),
(38, 3, '2016-02-15 11:30:00', 5),
(39, 3, '2016-02-15 12:00:00', 4),
(40, 3, '2016-02-15 12:30:00', 2),
(41, 3, '2016-02-15 13:00:00', 0),
(42, 3, '2016-02-15 13:30:00', 0),
(43, 3, '2016-02-15 14:00:00', 0),
(44, 3, '2016-02-15 14:30:00', 0),
(45, 3, '2016-02-15 15:00:00', 0),
(46, 3, '2016-02-15 15:30:00', 4),
(47, 3, '2016-02-15 16:00:00', 2),
(48, 3, '2016-02-15 16:30:00', 0),
(49, 3, '2016-02-15 17:00:00', 0),
(50, 3, '2016-02-15 17:30:00', 0),
(51, 3, '2016-02-15 18:00:00', 0),
(52, 3, '2016-02-15 18:30:00', 0),
(53, 3, '2016-02-15 19:00:00', 5),
(54, 3, '2016-02-15 19:30:00', 4),
(55, 3, '2016-02-15 20:00:00', 5),
(56, 3, '2016-02-15 20:30:00', 3),
(57, 3, '2016-02-15 21:00:00', 1),
(58, 3, '2016-02-15 21:30:00', 0),
(59, 3, '2016-02-15 22:00:00', 0),
(60, 3, '2016-02-15 22:30:00', 0),
(61, 3, '2016-02-15 23:00:00', 0),
(62, 3, '2016-02-15 23:30:00', 0);

-- --------------------------------------------------------

--
-- Structure de la table `constitution_goupe`
--

CREATE TABLE IF NOT EXISTS `constitution_goupe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `IDGroupe` int(11) NOT NULL,
  `IDObjet` int(11) DEFAULT NULL,
  `idSousGroupe` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDGroupe` (`IDGroupe`),
  KEY `IDObjet` (`IDObjet`),
  KEY `idSousGroupe` (`idSousGroupe`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `constitution_goupe`
--

INSERT INTO `constitution_goupe` (`id`, `IDGroupe`, `IDObjet`, `idSousGroupe`) VALUES
(1, 3, 2, NULL),
(2, 3, 3, NULL),
(3, 3, 4, NULL),
(4, 3, 5, NULL),
(5, 3, 4, 2),
(6, 3, 5, 2),
(7, 4, 9, NULL),
(8, 1, NULL, 4),
(9, 1, NULL, 3),
(10, 1, NULL, 6),
(11, 6, 4, NULL),
(12, 6, 5, NULL),
(13, 6, 10, NULL),
(14, 4, 10, NULL),
(15, 4, 11, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

CREATE TABLE IF NOT EXISTS `groupe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nameGroupe` varchar(50) NOT NULL,
  `icone` text NOT NULL,
  `salle` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `groupe`
--

INSERT INTO `groupe` (`id`, `nameGroupe`, `icone`, `salle`) VALUES
(1, 'home', 'home.png', 0),
(2, 'luminaires cuisine', 'lampe.png', 0),
(3, 'cuisine', 'icone_casserole.png', 1),
(4, 'chambre1', 'bed.svg', 1),
(6, 'luminaires', 'lampe.png', 0);

-- --------------------------------------------------------

--
-- Structure de la table `ip`
--

CREATE TABLE IF NOT EXISTS `ip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nameIp` varchar(50) NOT NULL,
  `localisation` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `ip`
--

INSERT INTO `ip` (`id`, `nameIp`, `localisation`) VALUES
(1, 'lumière cuisine', 1101),
(2, 'lumière évier', 1102),
(3, 'réveil', 1201),
(4, 'lumière chambre', 1202);

-- --------------------------------------------------------

--
-- Structure de la table `iv`
--

CREATE TABLE IF NOT EXISTS `iv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `pilotable` tinyint(1) NOT NULL,
  `icone` text NOT NULL,
  `etat` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `iv`
--

INSERT INTO `iv` (`id`, `nom`, `pilotable`, `icone`, `etat`) VALUES
(1, 'lumières cuisine', 1, 'lampe.png', 1),
(2, 'prisechambre1', 1, '', 1);

-- --------------------------------------------------------

--
-- Structure de la table `objet`
--

CREATE TABLE IF NOT EXISTS `objet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(20) NOT NULL,
  `localisation` int(4) NOT NULL,
  `etatBug` int(1) NOT NULL,
  `etatEffectif` int(1) NOT NULL,
  `consommation` float NOT NULL,
  `icone` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `objet`
--

INSERT INTO `objet` (`id`, `nom`, `localisation`, `etatBug`, `etatEffectif`, `consommation`, `icone`) VALUES
(1, 'batterie', 1, 0, 0, 0, ''),
(2, 'frigo', 1110, 0, 1, 2.5, 'frigo.png'),
(3, 'four', 1120, 0, 0, 0, 'icone_casserole.png'),
(4, 'lumière cuisine', 1130, 0, 1, 0.2, 'lampe.png'),
(5, 'lumière évier', 1140, 0, 0, 0, 'lampe.png'),
(6, 'EDF', 1012, 0, 1, 20, 'energy37.svg'),
(7, 'boitier primaire1', 2, 0, 1, 25, ''),
(8, 'boitier secondaire1', 1100, 0, 1, 17, ''),
(9, 'réveil', 1150, 0, 1, 0.2, 'reveil.png'),
(10, 'lumière chambre', 1210, 0, 1, 0.2, 'lampe.png'),
(11, 'prisechambre1', 1160, 1, 0, 0, '');

-- --------------------------------------------------------

--
-- Structure de la table `objet_programmation`
--

CREATE TABLE IF NOT EXISTS `objet_programmation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `IDObjet` int(11) NOT NULL,
  `IDProgrammation` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `objet_programmation`
--

INSERT INTO `objet_programmation` (`id`, `IDObjet`, `IDProgrammation`) VALUES
(1, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `panne`
--

CREATE TABLE IF NOT EXISTS `panne` (
  `id` int(11) NOT NULL,
  `namePanne` varchar(15) NOT NULL,
  `description` text NOT NULL,
  `priorite` int(11) NOT NULL,
  `date` date NOT NULL,
  `A_IDCompte` int(11) NOT NULL,
  `IDObjet` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `A_IDCompte` (`A_IDCompte`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `panne`
--

INSERT INTO `panne` (`id`, `namePanne`, `description`, `priorite`, `date`, `A_IDCompte`, `IDObjet`) VALUES
(2, 'panne courant', 'Cours circuit dans une prise de la chammbre', 2, '2016-02-15', 3, 11);

-- --------------------------------------------------------

--
-- Structure de la table `pboitier`
--

CREATE TABLE IF NOT EXISTS `pboitier` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `pboitier`
--

INSERT INTO `pboitier` (`id`) VALUES
(7);

-- --------------------------------------------------------

--
-- Structure de la table `pilotage_ip_objet`
--

CREATE TABLE IF NOT EXISTS `pilotage_ip_objet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `IDIp` int(11) NOT NULL,
  `C_IDObjet` int(11) DEFAULT NULL,
  `IDGroupe` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDIp` (`IDIp`),
  KEY `C_IDObjet` (`C_IDObjet`),
  KEY `IDGroupe` (`IDGroupe`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `pilotage_ip_objet`
--

INSERT INTO `pilotage_ip_objet` (`id`, `IDIp`, `C_IDObjet`, `IDGroupe`) VALUES
(3, 1, 4, 2),
(4, 2, 5, 2);

-- --------------------------------------------------------

--
-- Structure de la table `pilotage_iv_charge`
--

CREATE TABLE IF NOT EXISTS `pilotage_iv_charge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `IDIv` int(11) NOT NULL,
  `C_IDObjet` int(11) DEFAULT NULL,
  `IDGroupe` int(11) DEFAULT NULL,
  `IDIp` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDIv` (`IDIv`),
  KEY `C_IDObjet` (`C_IDObjet`),
  KEY `IDGroupe` (`IDGroupe`),
  KEY `IDIp` (`IDIp`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `pilotage_iv_charge`
--

INSERT INTO `pilotage_iv_charge` (`id`, `IDIv`, `C_IDObjet`, `IDGroupe`, `IDIp`) VALUES
(1, 1, NULL, 2, NULL),
(2, 2, 11, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `pilotage_reveil_objet`
--

CREATE TABLE IF NOT EXISTS `pilotage_reveil_objet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `IDReveil` int(11) DEFAULT NULL,
  `IDObjet` int(11) DEFAULT NULL,
  `IDGroupe` int(11) DEFAULT NULL,
  `IDIv` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDReveil` (`IDReveil`),
  KEY `IDObjet` (`IDObjet`),
  KEY `IDGroupe` (`IDGroupe`),
  KEY `IDIv` (`IDIv`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `pilotage_reveil_objet`
--

INSERT INTO `pilotage_reveil_objet` (`id`, `IDReveil`, `IDObjet`, `IDGroupe`, `IDIv`) VALUES
(1, 1, NULL, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `programmation`
--

CREATE TABLE IF NOT EXISTS `programmation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `programmation` int(11) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `programmation`
--

INSERT INTO `programmation` (`id`, `programmation`, `date_debut`, `date_fin`) VALUES
(1, 0, '2016-02-20', '2016-02-27');

-- --------------------------------------------------------

--
-- Structure de la table `rapport`
--

CREATE TABLE IF NOT EXISTS `rapport` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nameRapport` varchar(15) NOT NULL,
  `date` date NOT NULL,
  `typeRapport` varchar(15) NOT NULL,
  `IDObjet` int(11) DEFAULT NULL,
  `IDGroupe` int(11) DEFAULT NULL,
  `IDReseau` int(11) DEFAULT NULL,
  `IDCable` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDObjet` (`IDObjet`),
  KEY `IDGroupe` (`IDGroupe`,`IDReseau`,`IDCable`),
  KEY `IDReseau` (`IDReseau`,`IDCable`),
  KEY `IDCable` (`IDCable`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `rapport`
--

INSERT INTO `rapport` (`id`, `nameRapport`, `date`, `typeRapport`, `IDObjet`, `IDGroupe`, `IDReseau`, `IDCable`) VALUES
(1, 'conso frigo', '2016-02-09', 'consommation', 2, NULL, NULL, NULL),
(2, 'prisechambre1', '2016-02-15', 'alerte', 11, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `reseau`
--

CREATE TABLE IF NOT EXISTS `reseau` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nameReseau` varchar(20) NOT NULL,
  `etatBug` int(1) NOT NULL,
  `localisation` int(4) NOT NULL,
  `icone` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `reseau`
--

INSERT INTO `reseau` (`id`, `nameReseau`, `etatBug`, `localisation`, `icone`) VALUES
(1, 'pb to sb1', 0, 1111, ''),
(2, 'sb1 to sb2', 0, 1211, '');

-- --------------------------------------------------------

--
-- Structure de la table `reveil`
--

CREATE TABLE IF NOT EXISTS `reveil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nameReveil` varchar(15) NOT NULL,
  `activation` tinyint(1) NOT NULL,
  `weekly` tinyint(1) NOT NULL,
  `date` datetime NOT NULL,
  `choix` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `reveil`
--

INSERT INTO `reveil` (`id`, `nameReveil`, `activation`, `weekly`, `date`, `choix`) VALUES
(1, 'Allumage lumC', 1, 1, '2016-02-08 07:30:00', 0);

-- --------------------------------------------------------

--
-- Structure de la table `sboitier`
--

CREATE TABLE IF NOT EXISTS `sboitier` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `sboitier`
--

INSERT INTO `sboitier` (`id`) VALUES
(8);

-- --------------------------------------------------------

--
-- Structure de la table `source`
--

CREATE TABLE IF NOT EXISTS `source` (
  `id` int(11) NOT NULL,
  `prix` decimal(10,0) NOT NULL,
  `couleur` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `source`
--

INSERT INTO `source` (`id`, `prix`, `couleur`) VALUES
(1, '5', 'vert'),
(6, '6', 'jaune');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `alerte`
--
ALTER TABLE `alerte`
  ADD CONSTRAINT `fk_alerte_rapport` FOREIGN KEY (`id`) REFERENCES `rapport` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `batterie`
--
ALTER TABLE `batterie`
  ADD CONSTRAINT `fk_batterie_source` FOREIGN KEY (`id`) REFERENCES `source` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `charge`
--
ALTER TABLE `charge`
  ADD CONSTRAINT `fk_charge_objet` FOREIGN KEY (`id`) REFERENCES `objet` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `conso_objet`
--
ALTER TABLE `conso_objet`
  ADD CONSTRAINT `fk_conso_objet` FOREIGN KEY (`IDObjet`) REFERENCES `objet` (`id`);

--
-- Contraintes pour la table `constitution_goupe`
--
ALTER TABLE `constitution_goupe`
  ADD CONSTRAINT `fk_groupe` FOREIGN KEY (`IDGroupe`) REFERENCES `groupe` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_groupe_objet` FOREIGN KEY (`IDObjet`) REFERENCES `objet` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_groupe_ssgroupe` FOREIGN KEY (`idSousGroupe`) REFERENCES `groupe` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Contraintes pour la table `panne`
--
ALTER TABLE `panne`
  ADD CONSTRAINT `fk_panne_compte` FOREIGN KEY (`A_IDCompte`) REFERENCES `compte` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rapport_panne` FOREIGN KEY (`id`) REFERENCES `rapport` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `pboitier`
--
ALTER TABLE `pboitier`
  ADD CONSTRAINT `fk_pb_objet` FOREIGN KEY (`id`) REFERENCES `objet` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `pilotage_ip_objet`
--
ALTER TABLE `pilotage_ip_objet`
  ADD CONSTRAINT `fk_ip` FOREIGN KEY (`IDIp`) REFERENCES `ip` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ip_charge` FOREIGN KEY (`C_IDObjet`) REFERENCES `charge` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ip_groupe` FOREIGN KEY (`IDGroupe`) REFERENCES `groupe` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `pilotage_reveil_objet`
--
ALTER TABLE `pilotage_reveil_objet`
  ADD CONSTRAINT `fk_reveil` FOREIGN KEY (`IDReveil`) REFERENCES `reveil` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reveil_groupe` FOREIGN KEY (`IDGroupe`) REFERENCES `groupe` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_reveil_iv` FOREIGN KEY (`IDIv`) REFERENCES `iv` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_reveil_objet` FOREIGN KEY (`IDObjet`) REFERENCES `objet` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Contraintes pour la table `rapport`
--
ALTER TABLE `rapport`
  ADD CONSTRAINT `fk_rapport_cable` FOREIGN KEY (`IDCable`) REFERENCES `cable` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rapport_groupe` FOREIGN KEY (`IDGroupe`) REFERENCES `groupe` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rapport_objet` FOREIGN KEY (`IDObjet`) REFERENCES `objet` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rapport_reseau` FOREIGN KEY (`IDReseau`) REFERENCES `reseau` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Contraintes pour la table `sboitier`
--
ALTER TABLE `sboitier`
  ADD CONSTRAINT `fk_sb_objet` FOREIGN KEY (`id`) REFERENCES `objet` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `source`
--
ALTER TABLE `source`
  ADD CONSTRAINT `fk_source_objet` FOREIGN KEY (`id`) REFERENCES `objet` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
