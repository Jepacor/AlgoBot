-- phpMyAdmin SQL Dump
-- version 4.9.7deb1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : lun. 25 avr. 2022 à 15:39
-- Version du serveur :  8.0.27-0ubuntu0.21.04.1
-- Version de PHP : 8.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `Tests_Algo`
--

-- --------------------------------------------------------

--
-- Structure de la table `Entrees`
--

CREATE TABLE `Entrees` (
  `Id_Entrees` int NOT NULL,
  `Entree` varchar(50) DEFAULT NULL,
  `Id_Resultats` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `Entrees`
--

INSERT INTO `Entrees` (`Id_Entrees`, `Entree`, `Id_Resultats`) VALUES
(1, '2', 1),
(2, '8', 1);

-- --------------------------------------------------------

--
-- Structure de la table `Resultats`
--

CREATE TABLE `Resultats` (
  `Id_Resultats` int NOT NULL,
  `Niveau` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `Resultats`
--

INSERT INTO `Resultats` (`Id_Resultats`, `Niveau`) VALUES
(1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `Sorties`
--

CREATE TABLE `Sorties` (
  `Id_Sorties` int NOT NULL,
  `Sortie` varchar(50) DEFAULT NULL,
  `Id_Resultats` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `Sorties`
--

INSERT INTO `Sorties` (`Id_Sorties`, `Sortie`, `Id_Resultats`) VALUES
(1, '4', 1),
(2, '16', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Entrees`
--
ALTER TABLE `Entrees`
  ADD PRIMARY KEY (`Id_Entrees`),
  ADD KEY `Id_Resultats` (`Id_Resultats`);

--
-- Index pour la table `Resultats`
--
ALTER TABLE `Resultats`
  ADD PRIMARY KEY (`Id_Resultats`);

--
-- Index pour la table `Sorties`
--
ALTER TABLE `Sorties`
  ADD PRIMARY KEY (`Id_Sorties`),
  ADD KEY `Id_Resultats` (`Id_Resultats`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Entrees`
--
ALTER TABLE `Entrees`
  MODIFY `Id_Entrees` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `Resultats`
--
ALTER TABLE `Resultats`
  MODIFY `Id_Resultats` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `Sorties`
--
ALTER TABLE `Sorties`
  MODIFY `Id_Sorties` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Entrees`
--
ALTER TABLE `Entrees`
  ADD CONSTRAINT `Entrees_ibfk_1` FOREIGN KEY (`Id_Resultats`) REFERENCES `Resultats` (`Id_Resultats`);

--
-- Contraintes pour la table `Sorties`
--
ALTER TABLE `Sorties`
  ADD CONSTRAINT `Sorties_ibfk_1` FOREIGN KEY (`Id_Resultats`) REFERENCES `Resultats` (`Id_Resultats`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
