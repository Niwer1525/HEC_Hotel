-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 05 mai 2025 à 13:38
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `s220972`
--

-- --------------------------------------------------------

--
-- Structure de la table `chambre`
--

CREATE TABLE `chambre` (
  `id_chambre` int(11) NOT NULL,
  `etage` int(11) NOT NULL,
  `id_type_chambre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Déchargement des données de la table `chambre`
--

INSERT INTO `chambre` (`id_chambre`, `etage`, `id_type_chambre`) VALUES
(1, 1, 4),
(2, 1, 4),
(3, 1, 4),
(4, 2, 5),
(5, 2, 5),
(6, 2, 5),
(7, 3, 6),
(8, 3, 6),
(9, 3, 6),
(10, 4, 7),
(11, 4, 7),
(12, 4, 7),
(13, 5, 8),
(14, 5, 8),
(15, 5, 8);

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id_client` int(11) NOT NULL,
  `nom_client` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `rue` varchar(50) NOT NULL,
  `code_postal` int(11) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `gsm` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mot_de_passe` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id_client`, `nom_client`, `prenom`, `rue`, `code_postal`, `ville`, `gsm`, `email`, `mot_de_passe`) VALUES
(17, 'Doe', 'John', 'Rue de l\'Hotel 12', 8500, 'Roubaix', '06 78 96 96', 'JohnDoe@dayrep.com', 'JohnDoe1'),
(18, 'Delta', 'Kilo', 'Rue St Joseph 78', 4790, 'Esneux', '0478 94 67 67', 'Delta.Kilo@dayrep.com', 'DeltaKilo1'),
(19, 'Bradford', 'Tim', 'Rue de la concaténation 24', 7800, 'Nuke Town', '0472 94 61 65', 'Tim.Bradford94@dayrep.com', 'TimBradford1'),
(20, 'Pinkman', 'Jesse', 'Rue du Cristal 13', 6900, 'Albuquerque', '06 36 65 65 65', 'Jesse.Pinkman@dayrep.com', 'JessePinkman1'),
(21, 'White', 'Walter', 'Rue Marie Curie 61', 6900, 'Albuquerque', '06 89 68 75 41', 'Walter.White@dayrep.com', 'WalterWhite1'),
(22, 'Redouté', 'Daniel', 'Voie de comblain 10', 4170, 'Oneux', '0471 58 30 62', 'Daniel.Redoute@dayrep.com', 'DanielRedoute1'),
(23, 'Lopez', 'Angela', 'Rue de la République 17', 1110, 'Bruxelles', '0470 70 40 20', 'Angela.Lopez@dayrep.com', 'AngelaLopez1'),
(24, 'Miller', 'Joel', 'Avenue de l\'apocalypse 13', 4980, 'Boston', ' 06 78 96 13 13', 'Joel.Miller@dayrep.com', 'JoelMiller1'),
(25, 'Bernard', 'Clément', 'Rue de l\'enfermement 19', 4930, 'Martinrives ', '0490 10 29 70', 'Clement.Bernard@dayrep.com', 'ClementBernard1'),
(26, 'May', 'Rick', 'Rue de l\'affrontement 20', 5600, 'Florzé', '0450 10 20 30', 'Rick.May@dayrep.com', 'RickMay1');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `id_reservation` int(11) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `nbre_pers` int(11) NOT NULL,
  `id_chambre` int(11) NOT NULL,
  `id_client` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id_reservation`, `date_debut`, `date_fin`, `nbre_pers`, `id_chambre`, `id_client`) VALUES
(7, '2025-05-06', '2025-05-07', 2, 1, 17),
(8, '2025-05-12', '2025-05-15', 2, 7, 18),
(9, '2025-05-14', '2025-05-18', 4, 4, 19),
(10, '2025-05-12', '2025-05-15', 4, 10, 20),
(11, '2025-05-19', '2025-05-21', 2, 8, 21),
(12, '2025-05-20', '2025-05-23', 6, 13, 22),
(13, '2025-05-14', '2025-05-18', 4, 14, 23),
(14, '2025-05-26', '2025-05-31', 3, 5, 24),
(15, '2025-05-16', '2025-05-18', 2, 2, 25),
(16, '2025-05-12', '2025-05-31', 8, 15, 26);

-- --------------------------------------------------------

--
-- Structure de la table `type_chambre`
--

CREATE TABLE `type_chambre` (
  `id_type_chambre` int(11) NOT NULL,
  `nom_type` varchar(50) NOT NULL,
  `capacite` int(11) NOT NULL,
  `prix_nuit_pers` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Déchargement des données de la table `type_chambre`
--

INSERT INTO `type_chambre` (`id_type_chambre`, `nom_type`, `capacite`, `prix_nuit_pers`) VALUES
(4, 'Chambre simple', 2, 125),
(5, 'Chambre familial', 5, 140),
(6, 'Chambre premium', 2, 499),
(7, 'Chambre premium ultra pro max', 4, 799),
(8, 'The Suite Deluxe Edition™', 8, 1299);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `chambre`
--
ALTER TABLE `chambre`
  ADD PRIMARY KEY (`id_chambre`),
  ADD KEY `id_chambre_type` (`id_type_chambre`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id_reservation`),
  ADD KEY `id_chambre_reserv` (`id_chambre`),
  ADD KEY `id_client_reserv` (`id_client`);

--
-- Index pour la table `type_chambre`
--
ALTER TABLE `type_chambre`
  ADD PRIMARY KEY (`id_type_chambre`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `chambre`
--
ALTER TABLE `chambre`
  MODIFY `id_chambre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id_reservation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `type_chambre`
--
ALTER TABLE `type_chambre`
  MODIFY `id_type_chambre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `chambre`
--
ALTER TABLE `chambre`
  ADD CONSTRAINT `chambre_ibfk_1` FOREIGN KEY (`id_type_chambre`) REFERENCES `type_chambre` (`id_type_chambre`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`id_chambre`) REFERENCES `chambre` (`id_chambre`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
