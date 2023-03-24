-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 24 mars 2023 à 16:56
-- Version du serveur : 10.4.25-MariaDB
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `finance`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `id_client` varchar(15) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `activity` varchar(50) DEFAULT NULL,
  `locations` varchar(50) NOT NULL,
  `client_num` varchar(15) NOT NULL,
  `register_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `id_client`, `first_name`, `last_name`, `activity`, `locations`, `client_num`, `register_date`) VALUES
(1, '63246734200b5', 'dqs', 'sdqs', 'dqsds', 'FSDFSQF', '1234567898', '2022-09-16'),
(2, '6324839fb9198', 'kader', 'kader', 'COMMER&amp;ccedil;ANT', 'COCODY', '0534562782', '2022-09-16'),
(3, '632ea1b5c480d', 'Bamba', 'abdulahi', 'commer&amp;ccedil;ant', 'Adjam&amp;eacute;', '0790876543', '2022-09-24'),
(4, '635b4043bd89a', 'YANICK', 'FRAN&amp;ccedil;OIR', 'MACANICIEN', 'ADJAME', '0123456789', '2022-10-28'),
(5, '635c19c90dde5', 'sidibe', 'karidja', 'd&amp;eacute;veloppeur', 'Cocody', '0987654321', '2022-10-28'),
(6, '641bcc9d382b7', 'Kader', 'kader', 'commer&amp;ccedil;ante ', 'abobo', '0512345678', '2023-03-23');

-- --------------------------------------------------------

--
-- Structure de la table `emprunt`
--

CREATE TABLE `emprunt` (
  `id` int(11) NOT NULL,
  `id_emprunt` varchar(30) NOT NULL,
  `montant_emprunt` int(30) NOT NULL,
  `montant_remb` int(30) DEFAULT NULL,
  `date_emprunt` date NOT NULL,
  `statut_emprunt` int(1) NOT NULL,
  `id_client` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `emprunt`
--

INSERT INTO `emprunt` (`id`, `id_emprunt`, `montant_emprunt`, `montant_remb`, `date_emprunt`, `statut_emprunt`, `id_client`) VALUES
(1, '63271cf154020', 400000, 400000, '2022-09-18', 0, '6324839fb9198'),
(2, '63281572331ca', 500000, 171000, '2022-09-19', 1, '6324839fb9198'),
(3, '632ea24c234b7', 320000, 320000, '2022-09-24', 0, '632ea1b5c480d'),
(4, '632f3344977a4', 400000, 400000, '2022-09-24', 0, '632ea1b5c480d'),
(5, '635b417fa486b', 50000, 10000, '2022-10-28', 1, '635b4043bd89a'),
(6, '635cb057bd140', 225000, 4000, '2022-10-29', 1, '635c19c90dde5'),
(7, '641bcce8aeb1b', 500000, 100000, '2023-03-23', 1, '641bcc9d382b7');

-- --------------------------------------------------------

--
-- Structure de la table `historique`
--

CREATE TABLE `historique` (
  `id` int(11) NOT NULL,
  `date_his` date NOT NULL,
  `heure_his` time NOT NULL,
  `id_client_his` varchar(20) NOT NULL,
  `type_op` varchar(50) NOT NULL,
  `mont_op` int(50) UNSIGNED NOT NULL,
  `id_op` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `historique`
--

INSERT INTO `historique` (`id`, `date_his`, `heure_his`, `id_client_his`, `type_op`, `mont_op`, `id_op`) VALUES
(1, '2022-10-24', '06:26:00', '6324839fb9198', 'remboursement', 5000, ''),
(2, '2022-10-24', '06:28:00', '6324839fb9198', 'remboursement', 10000, ''),
(4, '2022-10-24', '08:16:00', '6324839fb9198', 'remboursement', 500, '635649ea6df5c'),
(5, '2022-10-25', '01:26:00', '6324839fb9198', 'remboursement', 10000, '63573b2c9a971'),
(6, '2022-10-28', '04:42:00', '635b4043bd89a', 'emprunt', 50000, '635b417fa486b'),
(7, '2022-10-28', '04:44:00', '635b4043bd89a', 'remboursement', 10000, '635b421984fcc'),
(8, '2022-10-29', '06:47:00', '635c19c90dde5', 'emprunt', 225000, '635cb057bd140'),
(9, '2022-10-29', '06:57:00', '635c19c90dde5', 'remboursement', 2000, '635cb2b9caac0'),
(10, '2022-10-29', '08:26:00', '635c19c90dde5', 'remboursement', 2000, '635cc78ba9d2d'),
(11, '2023-03-23', '04:52:00', '641bcc9d382b7', 'emprunt', 500000, '641bcce8aeb1b'),
(12, '2023-03-23', '04:53:00', '641bcc9d382b7', 'remboursement', 100000, '641bcd2e41278');

-- --------------------------------------------------------

--
-- Structure de la table `remboursement`
--

CREATE TABLE `remboursement` (
  `id` int(11) NOT NULL,
  `id_remb` varchar(30) NOT NULL,
  `montant_remb` int(30) NOT NULL,
  `id_emprunt` varchar(30) NOT NULL,
  `id_client` varchar(15) NOT NULL,
  `date_remb` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `remboursement`
--

INSERT INTO `remboursement` (`id`, `id_remb`, `montant_remb`, `id_emprunt`, `id_client`, `date_remb`) VALUES
(8, '6327338e95e7c', 160000, '63271cf154020', '6324839fb9198', '2022-09-18'),
(7, '6327311b53623', 28240, '63271cf154020', '6324839fb9198', '2022-09-18'),
(6, '63272e3a732f0', 2000, '63271cf154020', '6324839fb9198', '2022-09-18'),
(5, '63272de4bf765', 200000, '63271cf154020', '6324839fb9198', '2022-09-18'),
(9, '6327345114439', 20, '63271cf154020', '6324839fb9198', '2022-09-18'),
(11, '632758109e5aa', 740, '63271cf154020', '6324839fb9198', '2022-09-18'),
(12, '632758ca734b9', 1, '63271cf154020', '6324839fb9198', '2022-09-18'),
(13, '63280ce1715d1', 200, '63271cf154020', '6324839fb9198', '2022-09-19'),
(14, '63280d86be458', 1, '63271cf154020', '6324839fb9198', '2022-09-19'),
(15, '6328142e32cee', 1, '63271cf154020', '6324839fb9198', '2022-09-19'),
(16, '632814a11f0b8', 1, '63271cf154020', '6324839fb9198', '2022-09-19'),
(17, '632814f4e0ab2', 8796, '63271cf154020', '6324839fb9198', '2022-09-19'),
(23, '632ea74ab15a6', 300000, '632ea24c234b7', '632ea1b5c480d', '2022-09-24'),
(21, '632ea46555d19', 20000, '632ea24c234b7', '632ea1b5c480d', '2022-09-24'),
(24, '632ea7dcc353d', 60000, '63281572331ca', '6324839fb9198', '2022-09-24'),
(25, '632ea82cdbed2', 40000, '63281572331ca', '6324839fb9198', '2022-09-24'),
(26, '632ea89ca6156', 25000, '63281572331ca', '6324839fb9198', '2022-09-24'),
(27, '632f335a63eec', 2000, '632f3344977a4', '632ea1b5c480d', '2022-09-24'),
(28, '632f337f42047', 4788, '632f3344977a4', '632ea1b5c480d', '2022-09-24'),
(29, '632f339fdd9b7', 393212, '632f3344977a4', '632ea1b5c480d', '2022-09-24'),
(30, '63562de648df7', 5000, '63281572331ca', '6324839fb9198', '2022-10-24'),
(31, '63562e49abb6a', 5000, '63281572331ca', '6324839fb9198', '2022-10-24'),
(32, '6356301ad5d96', 5000, '63281572331ca', '6324839fb9198', '2022-10-24'),
(33, '635630701c300', 10000, '63281572331ca', '6324839fb9198', '2022-10-24'),
(34, '635647b054945', 500, '63281572331ca', '6324839fb9198', '2022-10-24'),
(35, '635649ea6df5c', 500, '63281572331ca', '6324839fb9198', '2022-10-24'),
(36, '63573af8e39f2', 10000, '63281572331ca', '6324839fb9198', '2022-10-25'),
(37, '63573b2c9a971', 10000, '63281572331ca', '6324839fb9198', '2022-10-25'),
(38, '635b421984fcc', 10000, '635b417fa486b', '635b4043bd89a', '2022-10-28'),
(39, '635cb2b9caac0', 2000, '635cb057bd140', '635c19c90dde5', '2022-10-29'),
(40, '635cc78ba9d2d', 2000, '635cb057bd140', '635c19c90dde5', '2022-10-29'),
(41, '641bcd2e41278', 100000, '641bcce8aeb1b', '641bcc9d382b7', '2023-03-23');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `pass_word` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='table de connexion à l''application';

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `pass_word`) VALUES
(1, 'coulibaly', 'motdepasse');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `emprunt`
--
ALTER TABLE `emprunt`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `historique`
--
ALTER TABLE `historique`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `remboursement`
--
ALTER TABLE `remboursement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `emprunt`
--
ALTER TABLE `emprunt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `historique`
--
ALTER TABLE `historique`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `remboursement`
--
ALTER TABLE `remboursement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
