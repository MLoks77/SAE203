-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 09 mai 2025 à 13:14
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
-- Base de données : `gustaveeiffel`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `ID_commentaire` int(11) NOT NULL,
  `ID_utilisateur` int(11) DEFAULT NULL,
  `Message` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`ID_commentaire`, `ID_utilisateur`, `Message`) VALUES
(1, 2, 'Très bon matériel, merci !'),
(2, 3, 'Petite panne sur le vidéoprojecteur.');

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

CREATE TABLE `groupe` (
  `ID_groupe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `groupe`
--

INSERT INTO `groupe` (`ID_groupe`) VALUES
(1),
(2);

-- --------------------------------------------------------

--
-- Structure de la table `materiel`
--

CREATE TABLE `materiel` (
  `ID_materiel` int(11) NOT NULL,
  `Reference` varchar(100) DEFAULT NULL,
  `Type` varchar(100) DEFAULT NULL,
  `Date_achat` date DEFAULT NULL,
  `Etat_global` varchar(100) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `materiel`
--

INSERT INTO `materiel` (`ID_materiel`, `Reference`, `Type`, `Date_achat`, `Etat_global`, `image_path`) VALUES
(1, 'REF123', 'Mini caméra', '2023-02-15', 'Très bon état', '/images/minicam.jpg'),
(2, 'REF456', 'Câble pour l\'oculus', '2022-11-20', 'Très bon état', '/image/materiel/cableoculus.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `ID_reservation` int(11) NOT NULL,
  `Date` date DEFAULT NULL,
  `Motif` text DEFAULT NULL,
  `Signature` tinyint(1) DEFAULT NULL,
  `Commentaire` text DEFAULT NULL,
  `ID_utilisateur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`ID_reservation`, `Date`, `Motif`, `Signature`, `Commentaire`, `ID_utilisateur`) VALUES
(1, '2025-05-10', 'Travail pour une sae', 1, 'Tout s’est bien passé.', 2),
(2, '2025-05-12', 'Réunion projet', 0, NULL, 3);

-- --------------------------------------------------------

--
-- Structure de la table `reservation_groupe`
--

CREATE TABLE `reservation_groupe` (
  `ID_reservation` int(11) NOT NULL,
  `ID_groupe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservation_groupe`
--

INSERT INTO `reservation_groupe` (`ID_reservation`, `ID_groupe`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `reservation_materiel`
--

CREATE TABLE `reservation_materiel` (
  `ID_reservation` int(11) NOT NULL,
  `ID_materiel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservation_materiel`
--

INSERT INTO `reservation_materiel` (`ID_reservation`, `ID_materiel`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `reservation_salle`
--

CREATE TABLE `reservation_salle` (
  `ID_reservation` int(11) NOT NULL,
  `ID_salle` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservation_salle`
--

INSERT INTO `reservation_salle` (`ID_reservation`, `ID_salle`) VALUES
(1, 138),
(2, 212);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `ID_role` int(11) NOT NULL,
  `Libelle` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`ID_role`, `Libelle`) VALUES
(1, 'admin'),
(2, 'agent'),
(3, 'enseignant'),
(4, 'étudiant');

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

CREATE TABLE `salle` (
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `salle`
--

INSERT INTO `salle` (`ID`) VALUES
(138),
(212);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `ID_utilisateur` int(11) NOT NULL,
  `Nom` varchar(50) DEFAULT NULL,
  `Prenom` varchar(50) DEFAULT NULL,
  `Mail` varchar(100) DEFAULT NULL,
  `Mot_de_passe` varchar(255) DEFAULT NULL,
  `ID_role` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`ID_utilisateur`, `Nom`, `Prenom`, `Mail`, `Mot_de_passe`, `ID_role`) VALUES
(1, 'Dupont', 'Jean', 'jean.dupont@gmail.com', '1234', 1),
(2, 'Martin', 'Claire', 'claire.martin@hotmail.fr', '5678', 3),
(3, 'Durand', 'Paul', 'paul.durand@gmail.com', 'Paul1', 4);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`ID_commentaire`),
  ADD UNIQUE KEY `ID_utilisateur` (`ID_utilisateur`);

--
-- Index pour la table `groupe`
--
ALTER TABLE `groupe`
  ADD PRIMARY KEY (`ID_groupe`);

--
-- Index pour la table `materiel`
--
ALTER TABLE `materiel`
  ADD PRIMARY KEY (`ID_materiel`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`ID_reservation`),
  ADD KEY `ID_utilisateur` (`ID_utilisateur`);

--
-- Index pour la table `reservation_groupe`
--
ALTER TABLE `reservation_groupe`
  ADD PRIMARY KEY (`ID_reservation`,`ID_groupe`),
  ADD KEY `ID_groupe` (`ID_groupe`);

--
-- Index pour la table `reservation_materiel`
--
ALTER TABLE `reservation_materiel`
  ADD PRIMARY KEY (`ID_reservation`,`ID_materiel`),
  ADD KEY `ID_materiel` (`ID_materiel`);

--
-- Index pour la table `reservation_salle`
--
ALTER TABLE `reservation_salle`
  ADD PRIMARY KEY (`ID_reservation`,`ID_salle`),
  ADD KEY `ID_salle` (`ID_salle`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`ID_role`);

--
-- Index pour la table `salle`
--
ALTER TABLE `salle`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`ID_utilisateur`),
  ADD KEY `ID_role` (`ID_role`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `ID_commentaire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `commentaire_ibfk_1` FOREIGN KEY (`ID_utilisateur`) REFERENCES `utilisateur` (`ID_utilisateur`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`ID_utilisateur`) REFERENCES `utilisateur` (`ID_utilisateur`);

--
-- Contraintes pour la table `reservation_groupe`
--
ALTER TABLE `reservation_groupe`
  ADD CONSTRAINT `reservation_groupe_ibfk_1` FOREIGN KEY (`ID_reservation`) REFERENCES `reservation` (`ID_reservation`),
  ADD CONSTRAINT `reservation_groupe_ibfk_2` FOREIGN KEY (`ID_groupe`) REFERENCES `groupe` (`ID_groupe`);

--
-- Contraintes pour la table `reservation_materiel`
--
ALTER TABLE `reservation_materiel`
  ADD CONSTRAINT `reservation_materiel_ibfk_1` FOREIGN KEY (`ID_reservation`) REFERENCES `reservation` (`ID_reservation`),
  ADD CONSTRAINT `reservation_materiel_ibfk_2` FOREIGN KEY (`ID_materiel`) REFERENCES `materiel` (`ID_materiel`);

--
-- Contraintes pour la table `reservation_salle`
--
ALTER TABLE `reservation_salle`
  ADD CONSTRAINT `reservation_salle_ibfk_1` FOREIGN KEY (`ID_reservation`) REFERENCES `reservation` (`ID_reservation`),
  ADD CONSTRAINT `reservation_salle_ibfk_2` FOREIGN KEY (`ID_salle`) REFERENCES `salle` (`ID`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`ID_role`) REFERENCES `role` (`ID_role`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
