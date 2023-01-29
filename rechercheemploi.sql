-- Adminer 4.7.7 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;

SET NAMES utf8mb4;

DROP DATABASE IF EXISTS `prod_rechercheemploi`;
CREATE DATABASE `prod_rechercheemploi` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `prod_rechercheemploi`;

DROP TABLE IF EXISTS `Contact`;
CREATE TABLE `Contact` (
  `ID` int(3) NOT NULL AUTO_INCREMENT,
  `IDEntreprise` int(5) DEFAULT NULL,
  `Prenom` varchar(255) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `Poste` varchar(255) DEFAULT NULL,
  `Mobile` varchar(255) DEFAULT NULL,
  `IDUser` int(4) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `IDEntreprise` (`IDEntreprise`),
  KEY `IDUser` (`IDUser`),
  CONSTRAINT `Contact_ibfk_1` FOREIGN KEY (`IDEntreprise`) REFERENCES `Entreprise` (`ID`),
  CONSTRAINT `Contact_ibfk_2` FOREIGN KEY (`IDUser`) REFERENCES `users` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `Entreprise`;
CREATE TABLE `Entreprise` (
  `ID` int(5) NOT NULL AUTO_INCREMENT,
  `NomSociete` varchar(255) NOT NULL,
  `Contact` int(3) DEFAULT NULL,
  `Adresse` varchar(255) DEFAULT NULL,
  `NumeroTel` varchar(255) DEFAULT NULL,
  `StatutEntretien` int(2) DEFAULT NULL,
  `UserID` int(4) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `Contact` (`Contact`),
  KEY `UserID` (`UserID`),
  CONSTRAINT `Entreprise_ibfk_1` FOREIGN KEY (`Contact`) REFERENCES `Contact` (`ID`),
  CONSTRAINT `Entreprise_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `users` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `EntretienPresentiel`;
CREATE TABLE `EntretienPresentiel` (
  `IDEntretienP` int(3) NOT NULL AUTO_INCREMENT,
  `IDEntreprise` int(5) NOT NULL,
  `IDContact` int(3) NOT NULL,
  `DateHeurePrevueEntretien` varchar(30) DEFAULT NULL,
  `DateHeureEffectiveEntretien` varchar(30) DEFAULT NULL,
  `PonctualiteEntreprise` binary(1) DEFAULT NULL,
  `Remuneration` varchar(255) DEFAULT NULL,
  `PosteAborde` varchar(255) DEFAULT NULL,
  `SuiviEntretien` longtext DEFAULT NULL,
  PRIMARY KEY (`IDEntretienP`),
  UNIQUE KEY `IDEntreprise` (`IDEntreprise`),
  UNIQUE KEY `IDContact` (`IDContact`),
  CONSTRAINT `EntretienPresentiel_ibfk_1` FOREIGN KEY (`IDEntreprise`) REFERENCES `Entreprise` (`ID`),
  CONSTRAINT `EntretienPresentiel_ibfk_2` FOREIGN KEY (`IDContact`) REFERENCES `Contact` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `EntretienTelephonique`;
CREATE TABLE `EntretienTelephonique` (
  `IDEntretienT` int(3) NOT NULL AUTO_INCREMENT,
  `IDEntreprise` int(5) NOT NULL,
  `IDContact` int(3) NOT NULL,
  `DateHeurePrevueEntretien` varchar(30) DEFAULT NULL,
  `DateHeureEffectiveEntretien` varchar(30) DEFAULT NULL,
  `PonctualiteEntreprise` binary(1) DEFAULT NULL,
  `Remuneration` varchar(255) DEFAULT NULL,
  `PosteAborde` varchar(255) DEFAULT NULL,
  `SuiviEntretien` longtext DEFAULT NULL,
  PRIMARY KEY (`IDEntretienT`),
  UNIQUE KEY `IDEntreprise` (`IDEntreprise`),
  UNIQUE KEY `IDContact` (`IDContact`),
  CONSTRAINT `EntretienTelephonique_ibfk_1` FOREIGN KEY (`IDEntreprise`) REFERENCES `Entreprise` (`ID`),
  CONSTRAINT `EntretienTelephonique_ibfk_2` FOREIGN KEY (`IDContact`) REFERENCES `Contact` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `StatutEntretien`;
CREATE TABLE `StatutEntretien` (
  `ID` int(2) NOT NULL AUTO_INCREMENT,
  `Statut` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `StatutEntretien` (`ID`, `Statut`) VALUES
(1,	'OFFRE REFUSÉE'),
(2,	'EN ATTENTE CRÉNEAU ENTRETIEN TÉLÉPHONIQUE'),
(3,	'ENTRETIEN TÉLÉPHONIQUE PLANIFIÉ'),
(4,	'ENTRETIEN TÉLÉPHONIQUE OK - ATTENTE ENTRETIEN PHYSIQUE'),
(5,	'ENTRETIEN PHYSIQUE PLANIFIÉ'),
(6,	'ENTRETIENS OK - EN ATTENTE RETOUR ENTREPRISE'),
(7,	'EMBAUCHE VALIDÉE PAR ENTREPRISE'),
(8,	'ENTRETIEN TÉLÉPHONIQUE NON CONVAINCANT'),
(9,	'ENTRETIEN PHYSIQUE NON CONVAINCANT'),
(10,	'REFUS ENTREPRISE');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `ID` int(4) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profession` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- 2023-01-28 18:36:11
