-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mer. 21 mai 2025 à 11:33
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

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
-- Structure de la table `Commentaire`
--

CREATE TABLE `Commentaire` (
  `ID_commentaire` int(11) NOT NULL,
  `ID_utilisateur` int(11) DEFAULT NULL,
  `Message` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Materiel`
--

CREATE TABLE `Materiel` (
  `ID_materiel` int(11) NOT NULL,
  `Reference` varchar(100) DEFAULT NULL,
  `Type` varchar(100) DEFAULT NULL,
  `Date_achat` date DEFAULT NULL,
  `Etat_global` varchar(100) DEFAULT NULL,
  `Descriptif` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Materiel`
--

INSERT INTO `Materiel` (`ID_materiel`, `Reference`, `Type`, `Date_achat`, `Etat_global`, `Descriptif`) VALUES
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
-- Structure de la table `Reservation`
--

CREATE TABLE `Reservation` (
  `ID_reservation` int(11) NOT NULL,
  `Date` date DEFAULT NULL,
  `Motif` text DEFAULT NULL,
  `Signature` tinyint(1) DEFAULT NULL,
  `Commentaire` text DEFAULT NULL,
  `ID_utilisateur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Reservation_demande`
--

CREATE TABLE `Reservation_demande` (
  `id_demande` int(11) NOT NULL,
  `utilisateur` varchar(100) NOT NULL,
  `motif` text NOT NULL,
  `date_demande` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Reservation_Materiel`
--

CREATE TABLE `Reservation_Materiel` (
  `ID_reservation` int(11) NOT NULL,
  `ID_materiel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Reservation_Salle`
--

CREATE TABLE `Reservation_Salle` (
  `ID_reservation` int(11) NOT NULL,
  `ID_salle` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Role`
--

CREATE TABLE `Role` (
  `ID_role` int(11) NOT NULL,
  `Libelle` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Salle`
--

CREATE TABLE `Salle` (
  `ID` int(11) NOT NULL,
  `Descriptif` varchar(250) NOT NULL,
  `Etat` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Salle`
--

INSERT INTO `Salle` (`ID`, `Descriptif`, `Etat`) VALUES
(138, 'Idéale si vous êtes seul(e) ou en petit groupe de 2 à 5 personnes, cette salle regroupe 3 ordinateurs équipés de double écran ainsi qu’un bureau à 90 degrés pour accueillir tous vos cahiers.', 'Excellent'),
(212, 'Idéale si vous êtes seul(e) ou en groupe...', 'Très bon état');

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateur`
--

CREATE TABLE `Utilisateur` (
  `ID_utilisateur` int(11) NOT NULL,
  `Nom` varchar(50) DEFAULT NULL,
  `Prenom` varchar(50) DEFAULT NULL,
  `Mail` varchar(100) DEFAULT NULL,
  `Mot_de_passe` varchar(255) DEFAULT NULL,
  `role` varchar(250) NOT NULL,
  `Identifiant` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Utilisateur`
--

INSERT INTO `Utilisateur` (`ID_utilisateur`, `Nom`, `Prenom`, `Mail`, `Mot_de_passe`, `role`, `Identifiant`) VALUES
(1, 'DRAME', 'ibrahim', 'ibrahimdrame165@gmail.com', '$2y$10$NKFOH31Shdo/cPoYWhy6.OgKmHloF4SGOQ1b8jZ3noP8wxd9e4hZ6', 'etudiant', 'ibrahim.drame');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Commentaire`
--
ALTER TABLE `Commentaire`
  ADD PRIMARY KEY (`ID_commentaire`),
  ADD UNIQUE KEY `ID_utilisateur` (`ID_utilisateur`);

--
-- Index pour la table `Materiel`
--
ALTER TABLE `Materiel`
  ADD PRIMARY KEY (`ID_materiel`);

--
-- Index pour la table `Reservation`
--
ALTER TABLE `Reservation`
  ADD PRIMARY KEY (`ID_reservation`),
  ADD KEY `ID_utilisateur` (`ID_utilisateur`);

--
-- Index pour la table `Reservation_demande`
--
ALTER TABLE `Reservation_demande`
  ADD PRIMARY KEY (`id_demande`);

--
-- Index pour la table `Reservation_Materiel`
--
ALTER TABLE `Reservation_Materiel`
  ADD PRIMARY KEY (`ID_reservation`,`ID_materiel`),
  ADD KEY `ID_materiel` (`ID_materiel`);

--
-- Index pour la table `Reservation_Salle`
--
ALTER TABLE `Reservation_Salle`
  ADD PRIMARY KEY (`ID_reservation`,`ID_salle`),
  ADD KEY `ID_salle` (`ID_salle`);

--
-- Index pour la table `Role`
--
ALTER TABLE `Role`
  ADD PRIMARY KEY (`ID_role`);

--
-- Index pour la table `Salle`
--
ALTER TABLE `Salle`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  ADD PRIMARY KEY (`ID_utilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Commentaire`
--
ALTER TABLE `Commentaire`
  MODIFY `ID_commentaire` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Materiel`
--
ALTER TABLE `Materiel`
  MODIFY `ID_materiel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `Reservation_demande`
--
ALTER TABLE `Reservation_demande`
  MODIFY `id_demande` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  MODIFY `ID_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Reservation_Materiel`
--
ALTER TABLE `Reservation_Materiel`
  ADD CONSTRAINT `reservation_materiel_ibfk_1` FOREIGN KEY (`ID_reservation`) REFERENCES `Reservation` (`ID_reservation`),
  ADD CONSTRAINT `reservation_materiel_ibfk_2` FOREIGN KEY (`ID_materiel`) REFERENCES `Materiel` (`ID_materiel`);

--
-- Contraintes pour la table `Reservation_Salle`
--
ALTER TABLE `Reservation_Salle`
  ADD CONSTRAINT `reservation_salle_ibfk_1` FOREIGN KEY (`ID_reservation`) REFERENCES `Reservation` (`ID_reservation`),
  ADD CONSTRAINT `reservation_salle_ibfk_2` FOREIGN KEY (`ID_salle`) REFERENCES `Salle` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
