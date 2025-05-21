-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 21 mai 2025 à 13:48
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
  `ID_utilisateur` int(11) DEFAULT NULL,
  `salle` varchar(3) DEFAULT NULL,
  `materiel` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`ID_reservation`, `Date`, `Motif`, `Signature`, `Commentaire`, `ID_utilisateur`, `salle`, `materiel`) VALUES
(1, '2025-05-27', 'Réunion de travail afin de finir une sae', 1, 'non', 1, '138', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `reservation_demande`
--

CREATE TABLE `reservation_demande` (
  `motif` text NOT NULL,
  `date_demande` date NOT NULL,
  `ID_demande` int(11) NOT NULL,
  `Mail_demande` varchar(100) DEFAULT NULL,
  `Date_acces` date DEFAULT NULL,
  `H_acces` time DEFAULT NULL,
  `H_arrive` time DEFAULT NULL,
  `Motif_demande` varchar(200) DEFAULT NULL,
  `Num_etudiant` varchar(6) DEFAULT NULL,
  `Num_annee` int(1) DEFAULT NULL,
  `identifiant_demande` varchar(50) DEFAULT NULL,
  `salle_d` varchar(3) DEFAULT NULL,
  `materiel_d` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservation_demande`
--

INSERT INTO `reservation_demande` (`motif`, `date_demande`, `ID_demande`, `Mail_demande`, `Date_acces`, `H_acces`, `H_arrive`, `Motif_demande`, `Num_etudiant`, `Num_annee`, `identifiant_demande`, `salle_d`, `materiel_d`) VALUES
('', '2025-05-27', 1, 'ibrahimdrame165@gmail.com', '2025-05-26', '08:30:00', '15:00:00', 'Réunion de travail afin de finir une sae', '277583', 1, 'ibrahim.DRAME', '138', NULL);

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
  `role` varchar(250) NOT NULL,
  `Identifiant` varchar(50) DEFAULT NULL,
  `n_etudiant` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`ID_utilisateur`, `Nom`, `Prenom`, `Mail`, `Mot_de_passe`, `role`, `Identifiant`, `n_etudiant`) VALUES
(1, 'DRAME', 'ibrahim', 'ibrahimdrame165@gmail.com', '$2y$10$NKFOH31Shdo/cPoYWhy6.OgKmHloF4SGOQ1b8jZ3noP8wxd9e4hZ6', 'etudiant', 'ibrahim.drame', NULL);

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
-- Index pour la table `reservation_demande`
--
ALTER TABLE `reservation_demande`
  ADD PRIMARY KEY (`ID_demande`);

--
-- Index pour la table `salle`
--
ALTER TABLE `salle`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`ID_utilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `ID_commentaire` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `materiel`
--
ALTER TABLE `materiel`
  MODIFY `ID_materiel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `reservation_demande`
--
ALTER TABLE `reservation_demande`
  MODIFY `ID_demande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `ID_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
