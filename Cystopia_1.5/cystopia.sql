-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 06 Novembre 2017 à 15:15
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
-- Structure de la table `carte_modele`
--

CREATE TABLE `carte_modele` (
  `c_id` int(11) NOT NULL,
  `c_nom` varchar(128) NOT NULL,
  `c_mana` int(11) NOT NULL,
  `c_attaque` int(11) DEFAULT NULL,
  `c_defense` int(11) DEFAULT NULL,
  `c_type` int(11) NOT NULL,
  `c_team` int(11) NOT NULL,
  `c_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `carte_modele`
--

INSERT INTO `carte_modele` (`c_id`, `c_nom`, `c_mana`, `c_attaque`, `c_defense`, `c_type`, `c_team`, `c_description`) VALUES
(1, 'Naruto', 4, 2, 4, 1, 1, 'Jeune ninja qui est l''hôte du démon renard à neuf queues.'),
(2, 'Luffy', 5, 7, 5, 1, 1, 'Il a mangé le fruit de GumGum qui lui permet d''étirer ses membres.'),
(3, 'Mononoke', 1, 2, 1, 1, 1, 'Elevée par les loups, elle se bat pour protéger la forêt.'),
(4, 'Eva-01', 7, 8, 6, 1, 1, 'Appelé aussi Shogoki, l''Eva-01 est un robot à l''apparence bestiale.'),
(5, 'Kaneda', 2, 2, 3, 1, 1, 'Petit délinquant d''apparence drogué, motivé par la colère.'),
(6, 'Motoko', 3, 5, 3, 1, 1, 'Forte et intelligente, elle est bien connue pour ses tactiques militaires.'),
(7, 'Deathnote', 5, 7, NULL, 2, 1, 'Utilisé par Light Yagami pour tuer les personnes dont le nom est écrit.'),
(8, 'Eclair', 3, 5, NULL, 2, 1, 'Pikachu envoie une décharge électrique de 120000 volts.'),
(9, 'Marteau', 1, 2, NULL, 2, 1, 'Laura Marconi, attaque ses adversaire à coup de marteau de 100 tonnes.'),
(10, 'Goldorak', 3, 3, 6, 3, 1, 'Goldorak est un gigantesque robot doté de multiples armes puissantes.'),
(11, 'Alphonse', 1, 1, 3, 3, 1, 'Alchimiste dont l''âme a été enfermée dans une armure. Il recherche son corps.'),
(12, 'San Goku', 9, 9, 9, 4, 1, 'Transformé en Super Saiyan, son kaméhaméha est redoutable.'),
(13, 'Sentinelle', 7, 8, 6, 1, 2, 'C''est une machine dotée de tentacules et d''un laser pouvant tout découper.'),
(14, 'Chappie', 4, 2, 4, 1, 2, 'Robot policier kidnappé par la population et reprogrammé.'),
(15, 'Quorra', 2, 2, 3, 1, 2, 'Originaire de la ville de Tron, elle possède un disque mortel.'),
(16, 'Adam', 5, 6, 5, 1, 2, 'Humain au corps rempli de millions de nanorobots qui augmentent ses capacités.'),
(17, 'Roy Batty', 1, 1, 1, 1, 2, 'Il est le chef des Replicants. C''est un chef très intelligent et habile.'),
(18, 'Major', 3, 4, 3, 1, 2, 'Cette humaine est dotée d''un corps aux capacités cybernétiques uniques.'),
(19, 'ZF-1', 3, 5, NULL, 2, 2, 'Arme puissante qui peut tuer l''adversaire de dizaine de façon différentes.'),
(20, 'Virus', 5, 7, NULL, 2, 2, 'Virus mortel propagé par l''armée des 12 singes.'),
(21, 'Sentence', 1, 2, NULL, 2, 2, 'Condamnation à mort prononcées par judge Dredd.'),
(22, 'T800', 9, 9, 9, 4, 2, 'Robot militaire crée par le super ordinateur Skynet pour détruire les rebelles.'),
(23, 'Big Daddy', 3, 3, 6, 3, 2, 'Humain dont le corps est directement greffé dans une combinaison blindée.'),
(24, 'Robocop', 1, 1, 3, 3, 2, 'Policier qui possède un corps cybernétique indestructible.');

-- --------------------------------------------------------

--
-- Structure de la table `carte_tmp`
--

CREATE TABLE `carte_tmp` (
  `c_tmp_id` int(11) NOT NULL,
  `c_tmp_nom` varchar(128) NOT NULL,
  `c_tmp_attaque` int(11) NOT NULL,
  `c_tmp_defense` int(11) NOT NULL,
  `c_tmp_position` int(11) NOT NULL,
  `c_tmp_carte_model_fk` int(11) NOT NULL,
  `c_tmp_hero_tmp_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Structure de la table `deck`
--

CREATE TABLE `deck` (
  `d_id` int(11) NOT NULL,
  `d_nom` varchar(128) NOT NULL,
  `d_hero_model_fk` int(11) NOT NULL,
  `d_user_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `deck`
--

INSERT INTO `deck` (`d_id`, `d_nom`, `d_hero_model_fk`, `d_user_fk`) VALUES
(1, 'MangaTest1', 1, 1),
(2, 'CyberTest2', 2, 2),
(3, 'Cyber2', 2, 3),
(4, 'cyberTest2', 2, 1),
(5, 'marieDeck1', 2, 9),
(6, 'MarieDeck2', 2, 9),
(7, 'LeDeCKDeMarie3', 2, 9),
(8, '4 Eme Deck De Marie', 2, 9),
(9, 'Le deck de Marie qui se trouve a la position 5 ', 2, 9),
(16, 'la table de marie qui veut pas s''effacer', 2, 9),
(17, '', 1, 9),
(18, '', 2, 4);

-- --------------------------------------------------------

--
-- Structure de la table `hero_modele`
--

CREATE TABLE `hero_modele` (
  `h_model_id` int(11) NOT NULL,
  `h_model_nom` varchar(128) NOT NULL,
  `h_model_pv` int(11) NOT NULL DEFAULT '20'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `hero_modele`
--

INSERT INTO `hero_modele` (`h_model_id`, `h_model_nom`, `h_model_pv`) VALUES
(1, 'Seiya', 20),
(2, 'NS5 Sonny', 20);

-- --------------------------------------------------------

--
-- Structure de la table `hero_tmp`
--

CREATE TABLE `hero_tmp` (
  `h_tmp_id` int(11) NOT NULL,
  `h_tmp_pv` int(11) NOT NULL,
  `h_tmp_mana` int(11) NOT NULL,
  `h_tmp_initiative` int(11) NOT NULL,
  `h_tmp_user_fk` int(11) NOT NULL,
  `h_tmp_partie_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `historique`
--

CREATE TABLE `historique` (
  `hist_id` int(11) NOT NULL,
  `hist_texte` varchar(256) NOT NULL,
  `hist_date` datetime NOT NULL,
  `hist_partie_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Structure de la table `partie`
--

CREATE TABLE `partie` (
  `p_id` int(11) NOT NULL,
  `p_date` datetime NOT NULL,
  `p_tour` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `rel_deck_carte`
--

CREATE TABLE `rel_deck_carte` (
  `d_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `rel_deck_carte`
--

INSERT INTO `rel_deck_carte` (`d_id`, `c_id`) VALUES
(1, 2),
(1, 3),
(1, 6),
(1, 9),
(1, 11),
(2, 16),
(2, 18),
(2, 21),
(3, 17),
(3, 19),
(3, 21),
(3, 24),
(16, 13),
(16, 14),
(16, 15),
(16, 16),
(16, 17),
(16, 18),
(16, 19),
(16, 20),
(17, 1),
(17, 2),
(17, 3),
(17, 4),
(18, 13),
(18, 14),
(18, 15),
(18, 16),
(18, 17),
(18, 22),
(18, 23),
(18, 24);

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

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `u_id` int(11) NOT NULL,
  `u_login` varchar(64) NOT NULL,
  `u_mdp` varchar(128) NOT NULL,
  `u_prenom` varchar(64) NOT NULL,
  `u_nom` varchar(64) NOT NULL,
  `u_mail` varchar(128) NOT NULL,
  `u_date_inscription` datetime NOT NULL,
  `u_hero_tmp_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`u_id`, `u_login`, `u_mdp`, `u_prenom`, `u_nom`, `u_mail`, `u_date_inscription`, `u_hero_tmp_fk`) VALUES
(1, 'Babar', '$2y$10$HQo1fL7h4TXYgFtfHfIgCu/8bMQ54W5SASsN/lLtNU1IaIHZS7d12', 'tyui', 'Popopo', 'ttyui@hkjh.com', '2017-10-06 14:50:57', NULL),
(2, 'nolo', '$2y$10$ba89T9YNuR3sGGeYKqTwbeT.iAMdCMIkBn9MSaLOx/uggkb29SOfu', 'patafiole', 'jean-guy', 'ttyui@hkjh.com', '2017-10-06 14:58:47', NULL),
(3, 'juijuij', '$2y$10$DQnKg66Y134SGIdjPj9RFuisQj3y/QEDOnPiwX2qiCq9fdM/2KZ2.', 'aaaaaaaaaaaa', 'aaaaaaaaa', 'aaaaaaaa@hjk.com', '2017-10-06 15:17:17', NULL),
(4, 'bob', '$2y$10$2Cg1He.emIp2kbFm7EBKfettob4dQ/8r7fi3WawUxksi6axaNcfEe', 'azert', 'azert', 'azert@atzyu.com', '2017-10-06 16:23:40', NULL),
(5, 'Bilbon', '$2y$10$Rh/sbsboximHDgenK8uKZuLmxd2GeWTAX6PfXVJ2hzWck/vJ1jh6u', 'tyu', 'ama', 'tyu@ghj.com', '2017-10-11 15:31:36', NULL),
(6, 'polo', '$2y$10$pjjKv1YHGBDVpsme5CWvfubiTt412TCstt4PhGIncmxgSlqYauxoa', 'polo', 'polo', 'ghj@kjhkjh.com', '2017-10-18 11:12:42', NULL),
(7, 'tata', '$2y$10$fjUhOUQFG5cZWgYAE7.xtOgmVb8TszrrbbCOiH2AU/Jgm6GkSTxy6', 'tata', 'tata', 'tggat@tata.com', '2017-10-18 11:19:09', NULL),
(8, 'toto', '$2y$10$fCYZl19hsHbdTUhwAgAbkO5wzURWMbE59hhhW1dm60icvcO9ufI2a', 'toto', 'toto', 'tggat@tata.com', '2017-10-18 11:24:28', NULL),
(9, 'marie', '$2y$10$AYnaiZv/iDW6lPFQwhPsUetrt4DNyy7R0Z5alkBV5yGhyxFe5EtpW', 'marie', 'marie', 'marie@o3d.fr', '2017-10-25 09:13:45', NULL);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `carte_modele`
--
ALTER TABLE `carte_modele`
  ADD PRIMARY KEY (`c_id`);

--
-- Index pour la table `carte_tmp`
--
ALTER TABLE `carte_tmp`
  ADD PRIMARY KEY (`c_tmp_id`),
  ADD KEY `c_tmp_carte_model_fk` (`c_tmp_carte_model_fk`),
  ADD KEY `c_tmp_hero_tmp_fk` (`c_tmp_hero_tmp_fk`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`c_id`);

--
-- Index pour la table `deck`
--
ALTER TABLE `deck`
  ADD PRIMARY KEY (`d_id`),
  ADD KEY `d_hero_model_fk` (`d_hero_model_fk`),
  ADD KEY `d_user_fk` (`d_user_fk`);

--
-- Index pour la table `hero_modele`
--
ALTER TABLE `hero_modele`
  ADD PRIMARY KEY (`h_model_id`);

--
-- Index pour la table `hero_tmp`
--
ALTER TABLE `hero_tmp`
  ADD PRIMARY KEY (`h_tmp_id`),
  ADD KEY `h_tmp_partie_fk` (`h_tmp_partie_fk`),
  ADD KEY `h_tmp_user_fk` (`h_tmp_user_fk`);

--
-- Index pour la table `historique`
--
ALTER TABLE `historique`
  ADD PRIMARY KEY (`hist_id`),
  ADD KEY `hist_partie_fk` (`hist_partie_fk`);

--
-- Index pour la table `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `partie`
--
ALTER TABLE `partie`
  ADD PRIMARY KEY (`p_id`);

--
-- Index pour la table `rel_deck_carte`
--
ALTER TABLE `rel_deck_carte`
  ADD PRIMARY KEY (`d_id`,`c_id`),
  ADD KEY `c_id` (`c_id`);

--
-- Index pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD PRIMARY KEY (`r_id`),
  ADD KEY `r_contact_fk` (`r_contact_fk`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`),
  ADD KEY `u_hero_fk` (`u_hero_tmp_fk`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `carte_modele`
--
ALTER TABLE `carte_modele`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT pour la table `carte_tmp`
--
ALTER TABLE `carte_tmp`
  MODIFY `c_tmp_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `deck`
--
ALTER TABLE `deck`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT pour la table `hero_modele`
--
ALTER TABLE `hero_modele`
  MODIFY `h_model_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `hero_tmp`
--
ALTER TABLE `hero_tmp`
  MODIFY `h_tmp_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `historique`
--
ALTER TABLE `historique`
  MODIFY `hist_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `partie`
--
ALTER TABLE `partie`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `reponse`
--
ALTER TABLE `reponse`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `carte_tmp`
--
ALTER TABLE `carte_tmp`
  ADD CONSTRAINT `carte_tmp_ibfk_1` FOREIGN KEY (`c_tmp_carte_model_fk`) REFERENCES `carte_modele` (`c_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `carte_tmp_ibfk_2` FOREIGN KEY (`c_tmp_hero_tmp_fk`) REFERENCES `hero_tmp` (`h_tmp_id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `contact_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `reponse` (`r_contact_fk`);

--
-- Contraintes pour la table `deck`
--
ALTER TABLE `deck`
  ADD CONSTRAINT `deck_ibfk_1` FOREIGN KEY (`d_user_fk`) REFERENCES `users` (`u_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `deck_ibfk_2` FOREIGN KEY (`d_hero_model_fk`) REFERENCES `hero_modele` (`h_model_id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `hero_tmp`
--
ALTER TABLE `hero_tmp`
  ADD CONSTRAINT `hero_tmp_ibfk_1` FOREIGN KEY (`h_tmp_partie_fk`) REFERENCES `partie` (`p_id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `historique`
--
ALTER TABLE `historique`
  ADD CONSTRAINT `historique_ibfk_1` FOREIGN KEY (`hist_partie_fk`) REFERENCES `partie` (`p_id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `rel_deck_carte`
--
ALTER TABLE `rel_deck_carte`
  ADD CONSTRAINT `rel_deck_carte_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `carte_modele` (`c_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `rel_deck_carte_ibfk_2` FOREIGN KEY (`d_id`) REFERENCES `deck` (`d_id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`u_hero_tmp_fk`) REFERENCES `hero_tmp` (`h_tmp_id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
