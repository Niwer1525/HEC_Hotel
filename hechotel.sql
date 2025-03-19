--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id_client` int NOT NULL AUTO_INCREMENT,
  `nom_client` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `prenom` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `rue` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `code_postal` int NOT NULL,
  `ville` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `gsm` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `mot_de_passe` varchar(50) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_client`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `type_chambre`
--

DROP TABLE IF EXISTS `type_chambre`;
CREATE TABLE IF NOT EXISTS `type_chambre` (
  `id_type_chambre` int NOT NULL AUTO_INCREMENT,
  `nom_type` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `capacite` int NOT NULL,
  `prix_nuit_pers` int NOT NULL,
  PRIMARY KEY (`id_type_chambre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chambre`
--

DROP TABLE IF EXISTS `chambre`;
CREATE TABLE IF NOT EXISTS `chambre` (
  `id_chambre` int NOT NULL AUTO_INCREMENT,
  `etage` int NOT NULL,
  `id_type_chambre` int NOT NULL,
  PRIMARY KEY (`id_chambre`),
  KEY `id_chambre_type` (`id_type_chambre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `id_reservation` int NOT NULL AUTO_INCREMENT,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL, 
  `nbre_pers` int NOT NULL,  
  `id_chambre` int NOT NULL,  
  `id_client` int NOT NULL,
  PRIMARY KEY (`id_reservation`),
  KEY `id_chambre_reserv` (`id_chambre`),
  KEY `id_client_reserv` (`id_client`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;


--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`),
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`id_chambre`) REFERENCES `chambre` (`id_chambre`);

--
-- Contraintes pour la table `chambre`
--
ALTER TABLE `chambre`
  ADD CONSTRAINT `chambre_ibfk_1` FOREIGN KEY (`id_type_chambre`) REFERENCES `type_chambre` (`id_type_chambre`);

