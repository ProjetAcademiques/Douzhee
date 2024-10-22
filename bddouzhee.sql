-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 15 oct. 2024 à 15:25
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bddouzhee`
--

-- --------------------------------------------------------

--
-- Structure de la table `appartient_à`
--

DROP TABLE IF EXISTS `appartient_à`;
CREATE TABLE IF NOT EXISTS `appartient_à` (
  `Id_Partie` int NOT NULL,
  `Id_Partie_Joue` int NOT NULL,
  `Id_Joueur_Joue` int NOT NULL,
  PRIMARY KEY (`Id_Partie`,`Id_Partie_Joue`,`Id_Joueur_Joue`),
  CONSTRAINT `fk_a1` FOREIGN KEY (`Id_Joueur_Joue`) REFERENCES `jouer_partie` (`Id_Joueur_Joue`),
  CONSTRAINT `fk_a2` FOREIGN KEY (`Id_Partie`) REFERENCES `partie` (`Id_Partie`),
  CONSTRAINT `fk_a3` FOREIGN KEY (`Id_Partie_Joue`) REFERENCES `jouer_partie` (`Id_Partie_Joue`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `classement`
--

DROP TABLE IF EXISTS `classement`;
CREATE TABLE IF NOT EXISTS `classement` (
  `Id_classement` int NOT NULL,
  `Place_classement` int NOT NULL,
  `Score` int NOT NULL,
  `Pseudonyme` varchar(35) NOT NULL,
  PRIMARY KEY (`Id_classement`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `consulte`
--

DROP TABLE IF EXISTS `consulte`;
CREATE TABLE IF NOT EXISTS `consulte` (
  `Id_Statistiques` int NOT NULL,
  `Id_Joueur` int NOT NULL,
  PRIMARY KEY (`Id_Joueur`,`Id_Statistiques`),
  CONSTRAINT `fk_c2` FOREIGN KEY (`Id_Statistiques`) REFERENCES `statistiques` (`Id_Statistiques`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `effectue_achat`
--

DROP TABLE IF EXISTS `effectue_achat`;
CREATE TABLE IF NOT EXISTS `effectue_achat` (
  `Id_Joueur` int NOT NULL,
  `Id_Achat` int NOT NULL,
  PRIMARY KEY (`Id_Joueur`,`Id_Achat`),
   CONSTRAINT `fk_e` FOREIGN KEY (`Id_Achat`) REFERENCES `skin_achete` (`Id_Achat`),
   CONSTRAINT `fk_e2` FOREIGN KEY (`Id_Joueur`) REFERENCES `Id_Joueur` (`Id_Joueur`) 
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `jouer_partie`
--

DROP TABLE IF EXISTS `jouer_partie`;
CREATE TABLE IF NOT EXISTS `jouer_partie` (
  `Id_Joueur_Joue` int NOT NULL,
  `Id_Partie_Joue` int NOT NULL,
  `Score_Joueur` int NOT NULL,
  `PositionJoueur` int NOT NULL,
  `DateParticipation` date NOT NULL,
  `Est_Gagnant` tinyint(1) NOT NULL,
  PRIMARY KEY (`Id_Joueur_Joue`,`Id_Partie_Joue`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `joueur`
--

DROP TABLE IF EXISTS `joueur`;
CREATE TABLE IF NOT EXISTS `joueur` (
  `Id_Joueur` int NOT NULL AUTO_INCREMENT,
  `Pseudonyme` varchar(35) NOT NULL,
  `Mdp` varchar(35) NOT NULL,
  `Email` varchar(35) NOT NULL,
  `Biographie` varchar(100) DEFAULT NULL,
  `DouzCoin` int NOT NULL,
  `DateInscription` date NOT NULL,
  PRIMARY KEY (`Id_Joueur`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `obtient`
--

DROP TABLE IF EXISTS `obtient`;
CREATE TABLE IF NOT EXISTS `obtient` (
  `Id_Joueur` int NOT NULL,
  `Id_Succès` int NOT NULL,
  PRIMARY KEY (`Id_Joueur`,`Id_Succès`),
  CONSTRAINT `fk_ids` FOREIGN KEY (`Id_Succès`) REFERENCES `succès` (`Id_Succès`),
  CONSTRAINT `fk_ids2` FOREIGN KEY (`Id_Joueur`) REFERENCES `joueur` (`Id_Joueur`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `participe_à`
--

DROP TABLE IF EXISTS `participe_à`;
CREATE TABLE IF NOT EXISTS `participe_à` (
  `Id_Joueur` int NOT NULL,
  `Id_Partie_Joue` int NOT NULL,
  `Id_Joueur_Joue` int NOT NULL,
  PRIMARY KEY (`Id_Joueur`,`Id_Partie_Joue`,`Id_Joueur_Joue`),
  CONSTRAINT `fk_p2` FOREIGN KEY (`Id_Joueur_Joue`) REFERENCES `jouer_partie` (`Id_Joueur_Joue`),
  CONSTRAINT `fk_p3` FOREIGN KEY (`Id_Partie_Joue`) REFERENCES `jouer_partie` (`Id_Partie_Joue`),
  CONSTRAINT `fk_p3` FOREIGN KEY (`Id_Joueur`) REFERENCES `joueur` (`Id_Joueur`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `partie`
--

DROP TABLE IF EXISTS `partie`;
CREATE TABLE IF NOT EXISTS `partie` (
  `Id_Partie` int NOT NULL AUTO_INCREMENT,
  `Date_Partie` date NOT NULL,
  `Status` varchar(35) NOT NULL,
  `Score_Total_Partie` int NOT NULL,
  PRIMARY KEY (`Id_Partie`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `setrouve`
--

DROP TABLE IF EXISTS `setrouve`;
CREATE TABLE IF NOT EXISTS `setrouve` (
  `Id_Joueur` int NOT NULL,
  `Id_classement` int NOT NULL,
  PRIMARY KEY (`Id_Joueur`,`Id_classement`),
 CONSTRAINT `fk_t2` FOREIGN KEY (`Id_classement`) REFERENCES `classement` (`Id_classement`),
 CONSTRAINT `fk_t3` FOREIGN KEY (`Id_Joueur`) REFERENCES `joueur` (`Id_Joueur`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `skin_achetable`
--

DROP TABLE IF EXISTS `skin_achetable`;
CREATE TABLE IF NOT EXISTS `skin_achetable` (
  `Id_Skin` int NOT NULL AUTO_INCREMENT,
  `Nom_Skin` int NOT NULL,
  `Prix_Skin` int NOT NULL,
  PRIMARY KEY (`Id_Skin`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `skin_achete`
--

DROP TABLE IF EXISTS `skin_achete`;
CREATE TABLE IF NOT EXISTS `skin_achete` (
  `Id_Achat` int NOT NULL AUTO_INCREMENT,
  `Id_Skin` int NOT NULL,
  `Date_Achat` date NOT NULL,
  `Etat_Skin` tinyint(1) NOT NULL,
  `Type_Skin` varchar(35) NOT NULL,
  PRIMARY KEY (`Id_Achat`),
  CONSTRAINT `fk_s` FOREIGN KEY (`Id_Skin`) REFERENCES `skin_achetable` (`Id_Skin`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `statistiques`
--

DROP TABLE IF EXISTS `statistiques`;
CREATE TABLE IF NOT EXISTS `statistiques` (
  `Id_Statistiques` int NOT NULL,
  `NbPartieGagne` int NOT NULL,
  `ScoreElevée` int NOT NULL,
  `TempsJeu` time NOT NULL,
  `RatioVictoire` double NOT NULL,
  `NombreSuccès` int NOT NULL,
  PRIMARY KEY (`Id_Statistiques`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `succès`
--

DROP TABLE IF EXISTS `succès`;
CREATE TABLE IF NOT EXISTS `succès` (
  `Id_Succès` int NOT NULL AUTO_INCREMENT,
  `Nom_Succès` varchar(35) NOT NULL,
  `Condition` varchar(35) NOT NULL,
  `Type_Succès` varchar(35) NOT NULL,
  PRIMARY KEY (`Id_Succès`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
