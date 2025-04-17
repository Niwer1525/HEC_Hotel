-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 17 avr. 2025 à 21:47
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
(4, 7, 1),
(5, 4, 3);

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
(13, 'Doe', 'John', 'Mont de fontaine', 4190, 'Xhoris', '0472946165', 'JohnDoe@dayrep.com', 'Juif123.'),
(14, 'Cuisse de Poulet', 'Ibrahim', 'Rue du KFC', 4000, 'Liège', '0477291672', 'IbrahCuisse@dayrep.com', 'KFC123.'),
(15, 'Kilo', 'Delta', 'Rue du St Juif 12', 5690, 'Berlin', '0473646589', 'dltkl@dayrep.com', 'Delta.Kilo'),
(16, 'Lincoln', 'Abraham', 'Rue de la liberté 79', 4550, 'Washington', '489060660', 'abradolf.lincolner@dayrep.com', 'Der_Furher_is_Da_Best');

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
(1, '2025-04-14', '2025-04-18', 2, 4, 14),
(2, '2025-04-20', '2025-04-30', 4, 5, 13),
(3, '2025-04-17', '2025-04-20', 3, 4, 15),
(4, '2025-04-18', '2025-04-23', 6, 5, 16);

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
(1, 'John Cena\'s room', 7, 750),
(3, 'Niwer\'s suite', 10, 799);

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
  MODIFY `id_chambre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id_reservation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `type_chambre`
--
ALTER TABLE `type_chambre`
  MODIFY `id_type_chambre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
