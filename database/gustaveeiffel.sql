-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

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
(1, 2, 'J\'ai adoré le matériel wow c\'est vraiment un super site de réservation.'),
(2, 1, 'Super'),
(3, 4, 'Les salles sont superbes'),
(7, 3, 'Sa bute chokbar'),
(8, 5, 'Sa arrache, le matériel est dément'),
(9, 6, 'J\'adore la salle 212 car WOW est elle grosse'),
(11, 2, 'Ce site est vraiment super !'),
(12, 2, 'j\'adore ce site'),
(13, 2, 'j\'adore ce site'),
(14, 2, 'j\'adore ce site'),
(15, 2, 'j\'adore ce site'),
(16, 2, 'WOW c\'est super bien');

-- --------------------------------------------------------

--
-- Structure de la table `images_materiel`
--

CREATE TABLE `images_materiel` (
  `ID_image` int(11) NOT NULL,
  `ID_materiel` int(11) NOT NULL,
  `chemin_image` varchar(255) NOT NULL,
  `ordre` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `images_salle`
--

CREATE TABLE `images_salle` (
  `ID_image` int(11) NOT NULL,
  `ID_salle` int(11) NOT NULL,
  `chemin_image` varchar(255) NOT NULL,
  `ordre` int(11) DEFAULT 1
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
(2, 'Le Microsoft HoloLens 2', 'Casque', '2010-01-01', 'Excellent', 'Le Microsoft HoloLens 2 est un casque de réalité mixte autonome, permettant d'interagir avec des hologrammes en 3D grâce à des capteurs, la reconnaissance gestuelle et une visière transparente.\r\n'),
(3, 'La manette MSI GC30', 'Multimédia', '2010-01-01', 'Super', 'La MSI GC30 est une manette sans fil polyvalente, compatible PC et Android, offrant une prise en main confortable et des commandes réactives pour une expérience de jeu fluide.'),
(4, 'La tablette WACOM', 'Multimédia', '2010-01-01', 'Super', 'La tablette Wacom est un outil de dessin numérique précis, utilisée avec un stylet sensible à la pression, idéale pour la création graphique et le travail artistique.'),
(5, 'La drone DJI Tello', 'Multimédia', '2010-01-01', 'Super', 'Le DJI Tello est un mini-drone ludique et facile à piloter, idéal pour débuter. Il capture des vidéos HD, réalise des figures et se contrôle via smartphone.'),
(6, 'Trépied', 'Audiovisuelle', '2010-01-01', 'Excellent', 'Ce Trépied est idéal pour stabiliser votre caméra , en exterieur comme en intérieur.'),
(7, 'GoPro', 'Audiovisuelle', '2010-01-01', 'Neuf', 'La GoPro HERO est une caméra robuste idéale pour filmer en action. Parfaite pour le sport et les aventures extrêmes..'),
(8, 'Microphone Professionnel', 'Audiovisuelle', '2010-01-01', 'Excellent', 'Ce microphone est conçu pour offrir une qualité sonore optimale, adapté aux enregistrements audio professionnels ou aux conférences.'),
(17, 'OCULUS RIFT', 'Casque', '2023-12-15', 'Excellent', 'Le casque oculus rift vous permettra de réaliser des travaux en VR.\r\nLien vers la vidéo d\'utilisation : https://youtube.fr'),
(18, 'casque audio Steelseries', 'Casque', '2025-05-24', 'Neuf', 'Avec ce super casque vous pourrez réaliser vos travaux ou jouer avec un super son\r\nLien vers la vidéo de démo :');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `ID_reservation` int(11) NOT NULL AUTO_INCREMENT,
  `Date` date DEFAULT NULL,
  `date_demande` date DEFAULT NULL,
  `Motif` text DEFAULT NULL,
  `Signature` tinyint(1) DEFAULT NULL,
  `Commentaire` text DEFAULT NULL,
  `ID_utilisateur` int(11) DEFAULT NULL,
  `salle` varchar(3) DEFAULT NULL,
  `materiel` varchar(3) DEFAULT NULL,
  `H_debut` time DEFAULT NULL,
  `H_fin` time DEFAULT NULL,
  `e_concerne` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID_reservation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`ID_reservation`, `Date`, `date_demande`, `Motif`, `Signature`, `Commentaire`, `ID_utilisateur`, `salle`, `materiel`, `H_debut`, `H_fin`, `e_concerne`) VALUES
(0, '2025-05-22', '2025-05-22', 'Besoin du matériel pour un projet multimédia', NULL, NULL, 2, '', '7', '16:00:00', '18:45:00', 'thomas savourin, ibrahim drame'),
(8, '2025-05-13', '2025-05-13', 'Besoin du matériel pour un projet multimédia', 1, 'non', 2, '', '7', '16:00:00', '18:45:00', NULL),
(11, '2025-05-19', '2025-05-19', 'Besoin du matériel pour un projet multimédia', 1, 'non', 2, '', '3', '16:00:00', '18:45:00', NULL),
(12, '2025-05-09', '2025-05-09', 'Besoin du matériel pour un projet multimédia', 1, 'non', 2, '138', '2', '16:00:00', '18:45:00', NULL),
(13, '2025-05-06', '2025-05-06', 'Besoin du matériel pour un projet multimédia', 1, 'non', 2, '138', '7', '16:00:00', '18:45:00', NULL),
(14, '2025-05-06', '2025-05-06', 'il faut que je film', 1, 'non', 2, '138', '7', '16:00:00', '18:45:00', NULL),
(20, '2025-06-04', '2025-06-04', 'Il me faut une salle', 1, 'non', 2, '138', '', '16:00:00', '18:45:00', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `reservation_demande`
--

CREATE TABLE `reservation_demande` (
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
  `materiel_d` varchar(2) DEFAULT NULL,
  `e_concerne_d` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservation_demande`
--

INSERT INTO `reservation_demande` (`date_demande`, `ID_demande`, `Mail_demande`, `Date_acces`, `H_acces`, `H_arrive`, `Motif_demande`, `Num_etudiant`, `Num_annee`, `identifiant_demande`, `salle_d`, `materiel_d`, `e_concerne_d`) VALUES
('2025-06-10', 14, 'maximederenes@gmail.com', '2025-06-10', '14:00:00', '16:00:00', 'besoin trepied', '285630', 1, 'maxime.derenes', '212', '7', 'Kacper');

-- --------------------------------------------------------

--
-- Structure de la table `reservation_refus`
--

CREATE TABLE `reservation_refus` (
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
  `materiel_d` varchar(2) DEFAULT NULL,
  `e_concerne_d` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservation_refus`
--

INSERT INTO `reservation_refus` (`date_demande`, `ID_demande`, `Mail_demande`, `Date_acces`, `H_acces`, `H_arrive`, `Motif_demande`, `Num_etudiant`, `Num_annee`, `identifiant_demande`, `salle_d`, `materiel_d`, `e_concerne_d`) VALUES
('2025-06-01', 9, 'maximederenes@gmail.com', '2025-06-10', '14:00:00', '16:00:00', 'Besoin du matériel pour un projet vidéo', '285630', 1, 'maxime.derenes', '212', '7', 'thomas savourin, ibrahim drame');

-- --------------------------------------------------------

--
-- Structure de la table `reservation_refus`
--

CREATE TABLE `reservation_refus` (
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
  `materiel_d` varchar(2) DEFAULT NULL,
  `e_concerne_d` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(138, 'Idéale si vous êtes seul(e) ou en petit groupe de 2 à 5 personnes, cette salle regroupe 3 ordinateurs équipés de double écran ainsi qu'un bureau à 90 degrés pour accueillir tous vos cahiers.', 'Excellent'),
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
  `n_etudiant` varchar(6) DEFAULT NULL,
  `adresse` varchar(30) DEFAULT NULL,
  `Date_naissance` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`ID_utilisateur`, `Nom`, `Prenom`, `Mail`, `Mot_de_passe`, `role`, `Identifiant`, `n_etudiant`, `adresse`, `Date_naissance`) VALUES
(1, 'drame', 'ibrahim', 'ibrahimdrame165@gmail.com', '$2y$10$NKFOH31Shdo/cPoYWhy6.OgKmHloF4SGOQ1b8jZ3noP8wxd9e4hZ6', 'etudiant', 'ibrahim.drame', NULL, NULL, NULL),
(2, 'derenes', 'maxime', 'maximederenes@gmail.com', '$2y$10$mgEqJtuHvX2c6pqlxQFonOppaUx1UHW4V2LXy2fn7G7t.V.XweFGm', 'etudiant', 'maxime.derenes', '285630', '1 allée des lys', '2006-04-19'),
(3, 'Robert', 'agent', 'agent@gmail.com', '$2y$10$EgTbCZ9KHHLHzCDuL8Dzou2uCTRYIDsuqFqzV/NpZa7m5YLTfUsSm', 'agent', 'agent.agent', NULL, NULL, NULL),
(4, 'Tom', 'Paul', 'PT@gmail.com', '$2y$10$PV3IV8eNv9vpVqPPLrdqeOBWpcuPMY8SnvfZqvEGPmUxFdi.r8112', 'enseignant', 'paul.tom', NULL, NULL, NULL),
(6, 'zaidi', 'fares', 'fares@gmail.com', '$2y$10$0BT5pQb8pxnE.YYsVTBnReCB7BzbUq2IdwUkGeaOzWgOVAnLsZRQ6', 'admin', 'fares.zaidi', NULL, '1 allée du dev', '1989-12-19');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`ID_commentaire`);

--
-- Index pour la table `images_materiel`
--
ALTER TABLE `images_materiel`
  ADD PRIMARY KEY (`ID_image`),
  ADD KEY `ID_materiel` (`ID_materiel`);

--
-- Index pour la table `images_salle`
--
ALTER TABLE `images_salle`
  ADD PRIMARY KEY (`ID_image`),
  ADD KEY `ID_salle` (`ID_salle`);

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
-- Index pour la table `reservation_refus`
--
ALTER TABLE `reservation_refus`
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
  MODIFY `ID_commentaire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `images_materiel`
--
ALTER TABLE `images_materiel`
  MODIFY `ID_image` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `images_salle`
--
ALTER TABLE `images_salle`
  MODIFY `ID_image` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `materiel`
--
ALTER TABLE `materiel`
  MODIFY `ID_materiel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `reservation_demande`
--
ALTER TABLE `reservation_demande`
  MODIFY `ID_demande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `reservation_refus`
--
ALTER TABLE `reservation_refus`
  MODIFY `ID_demande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `reservation_refus`
--
ALTER TABLE `reservation_refus`
  MODIFY `ID_demande` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `ID_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `images_materiel`
--
ALTER TABLE `images_materiel`
  ADD CONSTRAINT `images_materiel_ibfk_1` FOREIGN KEY (`ID_materiel`) REFERENCES `materiel` (`ID_materiel`);

--
-- Contraintes pour la table `images_salle`
--
ALTER TABLE `images_salle`
  ADD CONSTRAINT `images_salle_ibfk_1` FOREIGN KEY (`ID_salle`) REFERENCES `salle` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
