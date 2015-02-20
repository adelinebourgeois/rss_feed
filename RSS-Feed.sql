-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost:3306
-- Généré le :  Ven 20 Février 2015 à 12:44
-- Version du serveur :  5.5.33-MariaDB
-- Version de PHP :  5.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `RSS-Feed`
--
CREATE DATABASE IF NOT EXISTS `RSS-Feed` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `RSS-Feed`;

-- --------------------------------------------------------

--
-- Structure de la table `flux`
--

CREATE TABLE IF NOT EXISTS `flux` (
`id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `link` text,
  `title` varchar(255) DEFAULT NULL,
  `activate` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `flux`
--

INSERT INTO `flux` (`id`, `id_user`, `link`, `title`, `activate`) VALUES
(11, 2, 'http://www.jeuxvideo.com/rss/rss-news-ps4.xml', 'jeuxvideo.com - News PlayStation 4', 1),
(12, 2, 'http://www.leparisien.fr/une/rss.xml', '', 1),
(13, 2, 'http://www.courrierinternational.com/rss/rp/17/0/rss.xml', '', 1),
(27, 2, 'http://www.lemonde.fr/m-actu/rss_full.xml', NULL, 0),
(29, 2, 'http://www.lemonde.fr/m-actu/rss_full.xml', NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id_user` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `login` varchar(255) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id_user`, `nom`, `prenom`, `login`, `mail`, `password`) VALUES
(2, 'Bourgeois', 'Adeline', 'Melo93', 'adeline.bourgeois.01@gmail.com', '96499afb91678375279dd108222754d9864be63e'),
(3, 'lariviere', 'Nelly', 'Fripouille', 'lariviere.nelly@yahoo.fr', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3'),
(4, 'Masson', 'solene', 'patchy', 'patchy@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b'),
(6, 'boubou', 'bibi', 'blu', 'blu@gmail.fr', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(8, 'coquelet', 'christophe', 'lesspion', 'coquelet.c@gmail.com', '33c71205ba5fcbc4b103652525047a53711aa4e7');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `flux`
--
ALTER TABLE `flux`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `flux`
--
ALTER TABLE `flux`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
