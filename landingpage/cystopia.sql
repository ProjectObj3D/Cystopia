-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 28 Septembre 2017 à 12:59
-- Version du serveur :  10.1.19-MariaDB
-- Version de PHP :  7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `cystopia`
--

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `c_id` int(11) NOT NULL,
  `c_email` varchar(128) NOT NULL DEFAULT '',
  `c_firstname` varchar(128) NOT NULL DEFAULT '',
  `c_lastname` varchar(128) NOT NULL DEFAULT '',
  `c_content` text NOT NULL,
  `c_valdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `contact`
--

INSERT INTO `contact` (`c_id`, `c_email`, `c_firstname`, `c_lastname`, `c_content`, `c_valdate`) VALUES
(9, 'jeand@gyto.com', 'jean', 'jeanjean', 'Bonjour je souhaiterai avoir plus d''informations sur le jeu.', '2017-09-28 13:24:43'),
(10, 'mazerty@gyto.com', 'Bob', 'Molo', 'Quand sortira le jeu ?', '2017-09-28 14:54:22');

-- --------------------------------------------------------

--
-- Structure de la table `newsletters`
--

CREATE TABLE `newsletters` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `valdate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

CREATE TABLE `reponse` (
  `r_id` int(11) NOT NULL,
  `r_sujet` varchar(255) NOT NULL,
  `r_content` text NOT NULL,
  `r_date` datetime NOT NULL,
  `r_contact_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `reponse`
--

INSERT INTO `reponse` (`r_id`, `r_sujet`, `r_content`, `r_date`, `r_contact_fk`) VALUES
(6, 'Service client', 'Bonjour,\r\n\r\nMerci de votre intÃ©rÃªt...\r\n\r\nCordialement,\r\n\r\nCystopia', '2017-09-28 13:25:33', 9),
(7, 'Sortie du jeu', 'Le jeu sortira le 28 novembre 2017.\r\n\r\nCordialement,\r\n\r\nCystopia', '2017-09-28 14:55:27', 10);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`c_id`);

--
-- Index pour la table `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD PRIMARY KEY (`r_id`),
  ADD KEY `r_contact_fk` (`r_contact_fk`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `reponse`
--
ALTER TABLE `reponse`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
