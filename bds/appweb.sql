-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 13 juin 2023 à 14:24
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
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

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
(8, 8, 'kbs', 'jnecjne', '2023-05-26 19:55:30'),
(9, 2, 'hbjvqbu', 'jjccoihCEI', '2023-06-02 07:31:01'),
(10, 1, 'je suis le king', 'pense tu que je te fume ?? ', '2023-06-08 19:28:02'),
(11, 1, 'Sidoine', 'qui est tu ??', '2023-06-08 19:38:39'),
(12, 1, 'derniere', 'je quitte le groupe', '2023-06-08 19:51:03'),
(13, 1, 'serieux', 'je bouge ', '2023-06-08 19:52:27'),
(14, 1, 'just', 'klms', '2023-06-08 19:54:12');

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
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;

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
(25, 8, 1, 'n d', '2023-05-26 20:18:43'),
(26, 1, 9, 'jj', '2023-06-08 14:44:32'),
(27, 1, 9, 'jj', '2023-06-08 14:44:34'),
(28, 1, 9, 'khadafi', '2023-06-08 14:44:56'),
(29, 1, 9, 'fgcutk', '2023-06-08 14:45:02'),
(30, 1, 9, 'v:kjvlo', '2023-06-08 14:46:00'),
(31, 1, 9, 'jmnoop', '2023-06-08 14:46:07'),
(32, 1, 9, 'jbkojb', '2023-06-08 14:46:11'),
(33, 2, 9, 'hvj', '2023-06-08 14:53:19'),
(34, 2, 9, 'hvj', '2023-06-08 14:53:21'),
(35, 2, 9, '11552', '2023-06-08 14:53:30'),
(36, 1, 10, 'qui doute ?', '2023-06-08 19:28:31'),
(37, 1, 11, 'jvjj', '2023-06-08 19:42:48'),
(38, 1, 11, 'jvjj', '2023-06-08 19:42:54'),
(39, 1, 11, 'kk', '2023-06-08 19:43:03'),
(40, 1, 11, 'kk', '2023-06-08 19:43:06'),
(41, 1, 11, 'jbb', '2023-06-08 19:44:09'),
(42, 1, 11, 'jb', '2023-06-08 19:44:11'),
(43, 1, 11, 'kalo', '2023-06-08 19:44:18'),
(44, 1, 11, ',pi', '2023-06-08 19:46:12'),
(45, 1, 11, 'kqali kali', '2023-06-08 19:46:20'),
(46, 1, 8, 'salut', '2023-06-08 19:46:56'),
(47, 1, 8, 'salut', '2023-06-08 19:47:01'),
(48, 1, 11, 'jdbj', '2023-06-08 19:47:09'),
(49, 1, 11, 'jdbj', '2023-06-08 19:47:11'),
(50, 1, 11, 'jdbj', '2023-06-08 19:47:26'),
(51, 1, 8, 'kado bb', '2023-06-08 19:48:52'),
(52, 1, 6, 'sois humble', '2023-06-08 19:49:13'),
(53, 1, 14, 'iobyi_v', '2023-06-08 19:54:23');

-- --------------------------------------------------------

--
-- Structure de la table `followers`
--

DROP TABLE IF EXISTS `followers`;
CREATE TABLE IF NOT EXISTS `followers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `follower_id` int(11) NOT NULL,
  `following_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `follower_id` (`follower_id`),
  KEY `following_id` (`following_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `followers`
--

INSERT INTO `followers` (`id`, `follower_id`, `following_id`, `created_at`) VALUES
(1, 1, 2, '2023-06-08 20:44:50'),
(2, 1, 3, '2023-06-08 21:15:23'),
(3, 1, 7, '2023-06-08 21:20:46'),
(4, 1, 8, '2023-06-08 21:21:02'),
(5, 2, 1, '2023-06-08 21:32:05'),
(6, 2, 8, '2023-06-08 21:33:00'),
(7, 1, 6, '2023-06-11 16:22:53');

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
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=utf8;

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
(15, 9, 8, '2023-05-30 12:00:11'),
(16, 2, 9, '2023-06-02 07:31:59'),
(17, 1, 3, '2023-06-08 16:20:42'),
(18, 1, 3, '2023-06-08 16:20:42'),
(19, 1, 3, '2023-06-08 16:20:42'),
(20, 1, 3, '2023-06-08 16:20:42'),
(21, 1, 9, '2023-06-08 19:13:05'),
(22, 1, 9, '2023-06-08 19:13:05'),
(23, 1, 9, '2023-06-08 19:13:06'),
(24, 1, 9, '2023-06-08 19:13:06'),
(25, 1, 9, '2023-06-08 19:13:06'),
(26, 1, 9, '2023-06-08 19:16:41'),
(27, 1, 9, '2023-06-08 19:16:42'),
(28, 1, 9, '2023-06-08 19:16:42'),
(29, 1, 9, '2023-06-08 19:16:42'),
(30, 1, 9, '2023-06-08 19:16:43'),
(31, 1, 9, '2023-06-08 19:16:43'),
(32, 1, 9, '2023-06-08 19:16:43'),
(33, 1, 8, '2023-06-08 19:16:45'),
(34, 1, 8, '2023-06-08 19:16:45'),
(35, 1, 8, '2023-06-08 19:16:46'),
(36, 1, 8, '2023-06-08 19:16:46'),
(37, 1, 8, '2023-06-08 19:16:46'),
(38, 1, 7, '2023-06-08 19:16:47'),
(39, 1, 7, '2023-06-08 19:16:48'),
(40, 1, 7, '2023-06-08 19:16:48'),
(41, 1, 7, '2023-06-08 19:16:48'),
(42, 1, 6, '2023-06-08 19:16:51'),
(43, 1, 6, '2023-06-08 19:16:51'),
(44, 1, 9, '2023-06-08 19:17:03'),
(45, 1, 9, '2023-06-08 19:17:42'),
(46, 1, 9, '2023-06-08 19:17:43'),
(47, 1, 9, '2023-06-08 19:17:43'),
(48, 1, 9, '2023-06-08 19:17:44'),
(49, 1, 9, '2023-06-08 19:27:29'),
(50, 1, 8, '2023-06-08 19:27:31'),
(51, 1, 7, '2023-06-08 19:27:33'),
(52, 1, 10, '2023-06-08 19:28:15'),
(53, 1, 10, '2023-06-08 19:30:19'),
(54, 1, 9, '2023-06-08 19:30:22'),
(55, 1, 8, '2023-06-08 19:30:24'),
(56, 1, 7, '2023-06-08 19:30:26'),
(57, 1, 6, '2023-06-08 19:30:27'),
(58, 1, 5, '2023-06-08 19:30:29'),
(59, 1, 3, '2023-06-08 19:30:31'),
(60, 1, 2, '2023-06-08 19:30:33'),
(61, 1, 1, '2023-06-08 19:30:34'),
(62, 1, 11, '2023-06-08 19:38:47'),
(63, 1, 12, '2023-06-08 19:52:06'),
(64, 1, 13, '2023-06-08 19:52:41'),
(65, 1, 14, '2023-06-08 19:54:18');

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

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
(7, 6, 5, 'hello', '2023-05-25 20:35:46'),
(8, 2, 1, 'comme', '2023-06-02 07:32:28'),
(9, 1, 2, 'je suis pret', '2023-06-05 10:21:53'),
(10, 1, 3, 'hello ', '2023-06-08 19:55:30'),
(11, 1, 3, 'met toi une photo de profil\r\n', '2023-06-08 19:55:45'),
(12, 1, 1, 'pnrpni', '2023-06-08 19:56:14'),
(13, 1, 1, 'kkrk', '2023-06-08 19:56:19'),
(14, 1, 2, 'come', '2023-06-08 19:56:38');

-- --------------------------------------------------------

--
-- Structure de la table `streams`
--

DROP TABLE IF EXISTS `streams`;
CREATE TABLE IF NOT EXISTS `streams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `stream_key` varchar(255) NOT NULL,
  `status` enum('live','offline') NOT NULL DEFAULT 'offline',
  PRIMARY KEY (`id`),
  UNIQUE KEY `stream_key` (`stream_key`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `streams`
--

INSERT INTO `streams` (`id`, `user_id`, `stream_key`, `status`) VALUES
(2, 1, 'video_647e151858fe6.mp4', 'live'),
(3, 1, 'video_647e1908aac6e.mp4', 'live'),
(4, 1, 'video_647e1958c3668.mp4', 'live'),
(6, 1, 'video_64819f5d8674a.mp4', 'live');

-- --------------------------------------------------------

--
-- Structure de la table `subscriptions`
--

DROP TABLE IF EXISTS `subscriptions`;
CREATE TABLE IF NOT EXISTS `subscriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subscriber_id` int(11) DEFAULT NULL,
  `subscribed_to_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subscriber_id` (`subscriber_id`),
  KEY `subscribed_to_id` (`subscribed_to_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
(1, 'diablo', '$2y$10$PwaHIPiM3kEKWh97aUPqu./4CptNleqL4vyeKgii3oglJG1iF8uCy', '../image/bref.png', 'i am the king', 'test@test.com'),
(2, 'toto', '$2y$10$ciGN2OIzM/FvELtmZVaPoubrAWr02RFBQKzLIgJX1xAom7T0XGBRW', '../image/ynovc.jpg', 'arrete mec!', 'toto@toto.com'),
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

--
-- Contraintes pour la table `streams`
--
ALTER TABLE `streams`
  ADD CONSTRAINT `streams_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
