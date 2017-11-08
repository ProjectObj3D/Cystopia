-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:8889
-- Généré le :  Dim 01 Octobre 2017 à 23:59
-- Version du serveur :  5.6.35
-- Version de PHP :  7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

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
  `c_attaque` int(11) DEFAULT NULL,
  `c_defense` int(11) DEFAULT NULL,
  `c_type` int(11) NOT NULL,
  `c_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(9, 'jeand@gyto.com', 'jean', 'jeanjean', 'Bonjour je souhaiterai avoir plus d\'informations sur le jeu.', '2017-09-28 13:24:43'),
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

-- --------------------------------------------------------

--
-- Structure de la table `hero_modele`
--

CREATE TABLE `hero_modele` (
  `h_model_id` int(11) NOT NULL,
  `h_model_nom` varchar(128) NOT NULL,
  `h_model_pv` int(11) NOT NULL DEFAULT '20'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `u_hero_tmp_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT;
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
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `hero_modele`
--
ALTER TABLE `hero_modele`
  MODIFY `h_model_id` int(11) NOT NULL AUTO_INCREMENT;
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
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT;
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
