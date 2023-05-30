-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 30 mai 2023 à 12:03
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `appweb`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `user_id`, `title`, `content`, `timestamp`) VALUES
(1, 5, 'Tower Defense', 'aimez vous mon personnages ?', '2023-05-25 21:22:20'),
(2, 6, 'yellow', 'are you ready ? ', '2023-05-25 21:50:34'),
(3, 7, 'Love', 'love it\'s true ??', '2023-05-26 18:14:12'),
(4, 8, 'hello', 'je suis nouvelle par ici. On fait connaissance ?', '2023-05-26 18:30:23'),
(5, 8, 'hvghv', 'gvkgkcgtk', '2023-05-26 18:35:40'),
(6, 8, 'savon', 'jqjbvuqbnubrrubr', '2023-05-26 19:34:01'),
(7, 8, 'cuisine italienne', 'je mange', '2023-05-26 19:51:42'),
(8, 8, 'kbs', 'jnecjne', '2023-05-26 19:55:30');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `article_id` int(11) DEFAULT NULL,
  `content` text,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `article_id`, `content`, `timestamp`) VALUES
(1, 8, 5, 'c\'est cool man', '2023-05-26 18:52:21'),
(2, 8, 4, 'vasy force', '2023-05-26 18:59:51'),
(3, 8, 6, 'khhk ', '2023-05-26 19:45:20'),
(4, 8, 6, 'khhk ', '2023-05-26 19:45:22'),
(5, 8, 6, 'khhk ', '2023-05-26 19:45:24'),
(6, 8, 6, 'khhk ', '2023-05-26 19:45:24'),
(7, 8, 6, ' h', '2023-05-26 19:46:04'),
(8, 8, 6, ',', '2023-05-26 19:47:14'),
(9, 8, 5, ' hj', '2023-05-26 19:50:07'),
(10, 8, 5, ' ,', '2023-05-26 19:50:13'),
(11, 8, 8, ' k: kj kh hk', '2023-05-26 19:55:57'),
(12, 8, 8, ' k: kj kh hk', '2023-05-26 19:55:59'),
(13, 8, 8, ' k: kj kh hk', '2023-05-26 19:56:08'),
(14, 8, 8, 'n k', '2023-05-26 19:56:17'),
(15, 8, 8, 'n ', '2023-05-26 19:56:20'),
(16, 8, 7, 'nk ', '2023-05-26 19:56:26'),
(17, 8, 7, 'nk ', '2023-05-26 19:56:28'),
(18, 8, 6, 'j', '2023-05-26 19:56:32'),
(19, 8, 7, 'n', '2023-05-26 19:56:36'),
(20, 8, 7, 'n', '2023-05-26 19:56:38'),
(21, 8, 7, 'n', '2023-05-26 19:56:39'),
(22, 8, 7, 'j', '2023-05-26 19:56:46'),
(23, 8, 1, 'good', '2023-05-26 20:18:34'),
(24, 8, 1, 'good', '2023-05-26 20:18:36'),
(25, 8, 1, 'n d', '2023-05-26 20:18:43');

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `article_id` int(11) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `article_id`, `timestamp`) VALUES
(1, 6, 2, '2023-05-25 22:02:39'),
(2, 7, 3, '2023-05-26 18:23:02'),
(3, 7, 3, '2023-05-26 18:23:22'),
(4, 7, 3, '2023-05-26 18:23:23'),
(5, 7, 3, '2023-05-26 18:23:24'),
(6, 7, 3, '2023-05-26 18:23:24'),
(7, 7, 3, '2023-05-26 18:23:26'),
(8, 8, 4, '2023-05-26 18:30:27'),
(9, 8, 5, '2023-05-26 18:38:21'),
(10, 8, 1, '2023-05-26 19:45:35'),
(11, 8, 6, '2023-05-26 19:46:06'),
(12, 8, 7, '2023-05-26 19:52:02'),
(13, 8, 8, '2023-05-26 19:55:53'),
(14, 9, 8, '2023-05-30 12:00:10'),
(15, 9, 8, '2023-05-30 12:00:11');

-- --------------------------------------------------------

--
-- Structure de la table `private_messages`
--

DROP TABLE IF EXISTS `private_messages`;
CREATE TABLE IF NOT EXISTS `private_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `sender_id` (`sender_id`),
  KEY `receiver_id` (`receiver_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `private_messages`
--

INSERT INTO `private_messages` (`id`, `sender_id`, `receiver_id`, `message`, `timestamp`) VALUES
(1, 1, 1, 'hello', '2023-05-23 19:41:20'),
(2, 2, 1, 'salut mec', '2023-05-23 19:45:28'),
(3, 2, 1, 'hello guys', '2023-05-23 19:52:31'),
(4, 3, 1, 'hello', '2023-05-23 19:55:20'),
(5, 3, 1, 'azerty', '2023-05-23 19:56:44'),
(6, 1, 2, 'vzhb iuf', '2023-05-25 11:52:49'),
(7, 6, 5, 'hello', '2023-05-25 20:35:46');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `description` text,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `photo`, `description`, `email`) VALUES
(1, 'diablo', '$2y$10$PwaHIPiM3kEKWh97aUPqu./4CptNleqL4vyeKgii3oglJG1iF8uCy', NULL, NULL, 'test@test.com'),
(2, 'toto', '$2y$10$ciGN2OIzM/FvELtmZVaPoubrAWr02RFBQKzLIgJX1xAom7T0XGBRW', NULL, NULL, 'toto@toto.com'),
(3, 'tata', '$2y$10$KpNn93N8NL0qccaY5CD/TuCpAG.CZYZYDhL78y1Wn6pICGwleJuT2', NULL, NULL, 'test@test.com'),
(4, 'jumelle', '$2y$10$5v0YodP3jTrdR4ChTNDsNepjFdnOwIJWAAJZ3wEuVSizp2RGFW9p.', NULL, NULL, 'toto@toto.com'),
(5, 'klein23', '$2y$10$2l7kh5nLeIntYL7oa4AmTeU7E88izKWx/pKAyuIysQVZHMinlXeMi', '../image/ynov.jpg', 'je suis un guerrier', 'toto@toto.com'),
(6, 'divin', '$2y$10$4x50.3sA5Ulp0NyQKgqmt.naJWmEg/MCMM0zdRAUqFHNOxdQ9PrkO', '../image/profil.jpg', 'Hey, Je suis nouveau.', 'test@test.com'),
(7, 'noura', '$2y$10$X8WJpWjzqW/PfOvoX20H6O4.RagoO39sfy95T70o0MTxSlDoRe8Gm', '../image/profil1.jpg', 'Hey, Je suis nouveau.', 'test@test.com'),
(8, 'maryam', '$2y$10$iyognI159cEkqi63Quh54eIQG1ByNi0w5AO3yejFwgLrmzbgYwTyy', '../image/profil1.jpg', 'Hey, Je suis nouveau.', 'test@test.com'),
(9, 'akash', '$2y$10$M30EzCTKqP3UZI.mbkjuVuxFJLtqPECAYCwurioJFhXuPE3k7L4d2', '../image/profil1.jpg', 'Hey, Je suis nouveau.', 'test@test.com');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `private_messages`
--
ALTER TABLE `private_messages`
  ADD CONSTRAINT `private_messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `private_messages_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
