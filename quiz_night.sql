-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 13 fév. 2025 à 14:17
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `quiz_night`
--

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `id` int NOT NULL AUTO_INCREMENT,
  `quiz_id` int NOT NULL,
  `content` text NOT NULL,
  `create_at` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `quiz_id` (`quiz_id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`id`, `quiz_id`, `content`, `create_at`) VALUES
(22, 1, 'Quel est le premier agent ajouté après la sortie officielle du jeu ?', '2025-02-13'),
(23, 1, 'Quelle est la capacité ultime de Jett ?', '2025-02-13'),
(24, 1, 'Combien de balles un Vandal tire-t-il avant de devoir recharger ?', '2025-02-13'),
(25, 2, 'Qui a remporté la Coupe du Monde 2018 ?', '2025-02-13'),
(26, 2, 'Quel joueur a gagné le plus de Ballons d\'Or ?', '2025-02-13'),
(27, 2, 'Combien de joueurs composent une équipe sur le terrain ?', '2025-02-13'),
(28, 4, 'Quel est le muscle le plus gros du corps humain ?', '2025-02-13'),
(29, 4, 'Quelle prise de main sollicite le plus le biceps lors des tractions ?', '2025-02-13'),
(30, 4, 'Combien de répétitions sont recommandées pour un travail en force ?', '2025-02-13'),
(31, 5, 'Quel langage est utilisé principalement pour le développement web côté client ?', '2025-02-13'),
(32, 5, 'Que signifie SQL ?', '2025-02-13'),
(33, 5, 'Quelle balise HTML est utilisée pour créer un lien hypertexte ?', '2025-02-13');

-- --------------------------------------------------------

--
-- Structure de la table `quizzes`
--

DROP TABLE IF EXISTS `quizzes`;
CREATE TABLE IF NOT EXISTS `quizzes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `image` blob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `quizzes`
--

INSERT INTO `quizzes` (`id`, `title`, `description`, `created_at`, `image`) VALUES
(1, 'Quiz Valorant', 'Etes-vous un fin connaisseur du jeu vidéo Valorant ?', '2025-02-10 12:53:26', ''),
(2, 'Quiz Football', 'Etes-vous un fin connaisseur du foot ?', '2025-02-10 13:16:34', ''),
(4, 'Quiz musculation', 'YEAH BUDDY !', '2025-02-10 13:17:46', ''),
(5, 'Quiz LaPlateforme', 'Testez vos connaissances en dev', '2025-02-10 14:39:43', '');

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

DROP TABLE IF EXISTS `reponse`;
CREATE TABLE IF NOT EXISTS `reponse` (
  `id` int NOT NULL AUTO_INCREMENT,
  `question_id` int NOT NULL,
  `content` text NOT NULL,
  `is_correct` tinyint(1) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `question_id` (`question_id`)
) ENGINE=MyISAM AUTO_INCREMENT=121 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `reponse`
--

INSERT INTO `reponse` (`id`, `question_id`, `content`, `is_correct`, `create_at`) VALUES
(73, 22, 'Killjoy', 0, '2025-02-12 22:00:00'),
(74, 22, 'Reyna', 1, '2025-02-12 22:00:00'),
(75, 22, 'Yoru', 0, '2025-02-12 22:00:00'),
(76, 22, 'Skye', 0, '2025-02-12 22:00:00'),
(77, 23, 'Lame tempête', 1, '2025-02-12 22:00:00'),
(78, 23, 'Frappe orbitale', 0, '2025-02-12 22:00:00'),
(79, 23, 'Ressuscitation', 0, '2025-02-12 22:00:00'),
(80, 23, 'Téléportation', 0, '2025-02-12 22:00:00'),
(81, 24, '25 balles', 1, '2025-02-12 22:00:00'),
(82, 24, '30 balles', 0, '2025-02-12 22:00:00'),
(83, 24, '35 balles', 0, '2025-02-12 22:00:00'),
(84, 24, '40 balles', 0, '2025-02-12 22:00:00'),
(85, 25, 'France', 1, '2025-02-12 22:00:00'),
(86, 25, 'Brésil', 0, '2025-02-12 22:00:00'),
(87, 25, 'Allemagne', 0, '2025-02-12 22:00:00'),
(88, 25, 'Argentine', 0, '2025-02-12 22:00:00'),
(89, 26, 'Cristiano Ronaldo', 0, '2025-02-12 22:00:00'),
(90, 26, 'Lionel Messi', 1, '2025-02-12 22:00:00'),
(91, 26, 'Pelé', 0, '2025-02-12 22:00:00'),
(92, 26, 'Johan Cruyff', 0, '2025-02-12 22:00:00'),
(93, 27, '9 joueurs', 0, '2025-02-12 23:00:00'),
(94, 27, '10 joueurs', 0, '2025-02-12 23:00:00'),
(95, 27, '11 joueurs', 1, '2025-02-12 23:00:00'),
(96, 27, '12 joueurs', 0, '2025-02-12 23:00:00'),
(97, 28, 'Le grand fessier', 1, '2025-02-13 14:03:20'),
(98, 28, 'Le quadriceps', 0, '2025-02-13 14:03:20'),
(99, 28, 'Le grand dorsal', 0, '2025-02-13 14:03:20'),
(100, 28, 'Le pectoral', 0, '2025-02-13 14:03:20'),
(101, 29, 'Prise large en supination', 0, '2025-02-13 14:03:20'),
(102, 29, 'Prise serrée en supination', 1, '2025-02-13 14:03:20'),
(103, 29, 'Prise large en pronation', 0, '2025-02-13 14:03:20'),
(104, 29, 'Prise neutre', 0, '2025-02-13 14:03:20'),
(105, 30, '1-3 répétitions', 1, '2025-02-13 14:03:20'),
(106, 30, '8-12 répétitions', 0, '2025-02-13 14:03:20'),
(107, 30, '15-20 répétitions', 0, '2025-02-13 14:03:20'),
(108, 30, '25-30 répétitions', 0, '2025-02-13 14:03:20'),
(109, 31, 'PHP', 0, '2025-02-13 14:04:17'),
(110, 31, 'JavaScript', 1, '2025-02-13 14:04:17'),
(111, 31, 'Python', 0, '2025-02-13 14:04:17'),
(112, 31, 'Java', 0, '2025-02-13 14:04:17'),
(113, 32, 'Structured Query Language', 1, '2025-02-13 14:04:17'),
(114, 32, 'Simple Question Logic', 0, '2025-02-13 14:04:17'),
(115, 32, 'Scripted Query Logic', 0, '2025-02-13 14:04:17'),
(116, 32, 'Software Query Language', 0, '2025-02-13 14:04:17'),
(117, 33, '<div>', 0, '2025-02-13 14:04:17'),
(118, 33, '<span>', 0, '2025-02-13 14:04:17'),
(119, 33, '<a>', 1, '2025-02-13 14:04:17'),
(120, 33, '<p>', 0, '2025-02-13 14:04:17');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `pass`) VALUES
(4, 'Justin', 'Morales'),
(5, 'Axel', 'Heureux'),
(10, 'Maxime', 'Cuadro'),
(14, 'admin', 'admin');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
