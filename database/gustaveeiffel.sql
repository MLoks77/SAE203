-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 19 mai 2025 à 19:50
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
(1, 1, 'Le matériel était en très bon état, merci !'),
(2, 2, 'La salle était bien équipée, je recommande.'),
(3, 3, 'Petit souci avec la manette, mais résolu rapidement.');

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
  `Descriptif` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `materiel`
--

INSERT INTO `materiel` (`ID_materiel`, `Reference`, `Type`, `Date_achat`, `Etat_global`, `Descriptif`) VALUES
(1, 'HTC Vive Cosmos', 'Casque', '2010-01-01', 'Super', 'Le HTC Vive Cosmos est un casque de réalité virtuelle offrant un tracking inside-out, un confort optimisé et une visière relevable, idéal pour des expériences immersives interactives sur PC.'),
(2, 'Le Microsoft HoloLens 2', 'Casque', '2010-01-01', 'Excellent', 'Le Microsoft HoloLens 2 est un casque de réalité mixte autonome, permettant d’interagir avec des hologrammes en 3D grâce à des capteurs, la reconnaissance gestuelle et une visière transparente.\r\n'),
(3, 'La manette MSI GC30', 'Multimédia', '2010-01-01', 'Super', 'La MSI GC30 est une manette sans fil polyvalente, compatible PC et Android, offrant une prise en main confortable et des commandes réactives pour une expérience de jeu fluide.'),
(4, 'La tablette WACOM', 'Multimédia', '2010-01-01', 'Super', 'La tablette Wacom est un outil de dessin numérique précis, utilisée avec un stylet sensible à la pression, idéale pour la création graphique et le travail artistique.'),
(5, 'La drone DJI Tello', 'Multimédia', '2010-01-01', 'Super', 'Le DJI Tello est un mini-drone ludique et facile à piloter, idéal pour débuter. Il capture des vidéos HD, réalise des figures et se contrôle via smartphone.'),
(6, 'Trépied', 'Audiovisuelle', '2010-01-01', 'Excellent', 'Ce Trépied est idéal pour stabiliser votre caméra , en exterieur comme en intérieur.'),
(7, 'GoPro', 'Audiovisuelle', '2010-01-01', 'Neuf', 'La GoPro HERO est une caméra robuste idéale pour filmer en action. Parfaite pour le sport et les aventures extrêmes..'),
(8, 'Microphone Professionnel', 'Audiovisuelle', '2010-01-01', 'Excellent', 'Ce microphone est conçu pour offrir une qualité sonore optimale, adapté aux enregistrements audio professionnels ou aux conférences.');

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
(1, '2025-05-10', 'Projet audiovisuel', 1, 'Besoin d’un micro pour le tournage.', 1),
(2, '2025-05-12', 'Travail en groupe sur Unity', 1, 'Utilisation du HTC Vive.', 2),
(3, '2025-05-15', 'Atelier de dessin numérique', 1, 'Utilisation de la tablette Wacom.', 3),
(4, '2025-05-18', 'Montage vidéo pour projet final', 1, 'Besoin de la GoPro et du trépied.', 1),
(5, '2025-05-20', 'Test de la réalité augmentée', 1, 'Essai du HoloLens 2.', 2),
(6, '2025-05-22', 'Projet de drone en audiovisuel', 1, 'Captation avec le DJI Tello.', 3),
(7, '2025-06-10', 'Besoin de la Gopro pour tourner une vidéo', 1, 'Besoin de la salle avec vidéoprojecteur', 4);

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
(1, 8),
(2, 1),
(3, 4),
(4, 6),
(4, 7),
(5, 2),
(6, 5),
(7, 7);

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
(2, 212),
(3, 138),
(4, 212),
(5, 138),
(6, 212),
(7, 138);

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
(1, 'Administrateur'),
(2, 'Eleve'),
(3, 'Professeur'),
(4, 'Agent');

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

CREATE TABLE `salle` (
  `ID` int(11) NOT NULL,
  `Descriptif` varchar(250) NOT NULL,
  `Etat` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `salle`
--

INSERT INTO `salle` (`ID`, `Descriptif`, `Etat`) VALUES
(138, 'Idéale si vous êtes seul(e) ou en petit groupe de 2 à 5 personnes, cette salle regroupe 3 ordinateurs équipés de double écran ainsi qu’un bureau à 90 degrés pour accueillir tous vos cahiers.', 'Excellent'),
(212, 'Idéale si vous êtes seul(e) ou en groupe...', 'Très bon état');

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
(1, 'Dupont', 'Alice', 'alice.dupont@example.com', 'password123', 2),
(2, 'Martin', 'Jean', 'jean.martin@example.com', 'password456', 3),
(3, 'Durand', 'Sophie', 'sophie.durand@example.com', 'password789', 1),
(4, 'Martin', 'Léa', 'lea.martin@example.com', 'motdepasse456', 4);

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
  MODIFY `ID_commentaire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `materiel`
--
ALTER TABLE `materiel`
  MODIFY `ID_materiel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
