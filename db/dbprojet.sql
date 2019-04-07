-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Mar 08 Janvier 2019 à 19:13
-- Version du serveur :  10.1.37-MariaDB-0+deb9u1
-- Version de PHP :  7.0.33-0+deb9u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `dbprojet`
--

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

CREATE TABLE `news` (
  `titre` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `categorie` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `date` date NOT NULL,
  `description` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `link` varchar(40) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `news`
--

INSERT INTO `news` (`titre`, `categorie`, `date`, `description`, `link`) VALUES
('News 1', 'Politique', '2018-12-13', 'Débat Politique sur les bananes', 'http://www.lemonde.fr'),
('News 2', 'Sport', '2018-12-13', 'Course de chauve', 'http://www.pmu.fr'),
('News 3', 'Informatique', '2018-12-13', 'Une raclette sur un pc qui tourne une application java.', 'http://www.net.net'),
('News 4', 'Animaux', '2018-12-13', 'Un dauphin en appartement étudiant ?', 'http://www.crous.fr'),
('News 5', 'Sport', '2018-12-13', 'Natation sur gazon', 'http://www.pmu.fr'),
('News 6', 'Ikea', '2018-12-13', 'Nouvelle table basse GLBSTKF', 'http://www.ikea.fr'),
('News 7', 'Politique', '2018-12-13', 'Trois élèvent restent jusqu\'à 19h30 pour finir un projet de php', 'http://www.crouton.net');

-- --------------------------------------------------------

--
-- Structure de la table `visiteur`
--

CREATE TABLE `visiteur` (
  `id_visit` int(11) NOT NULL,
  `login` varchar(15) CHARACTER SET utf8mb4 NOT NULL,
  `password` varchar(1000) CHARACTER SET utf8mb4 NOT NULL,
  `mail` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `role` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `visiteur`
--

INSERT INTO `visiteur` (`id_visit`, `login`, `password`, `mail`, `role`) VALUES
(1, 'jean', '$2y$10$1V7sk4CjambrxNX9yNC8QODZoCiRNATEq3AlK59mZuElnoCIdf/YG', 'jean@jean.fr', 'superAdmin'),
(2, 'gaspard', '$2y$10$pL1Vdn59uYITmJ44qpvqo.h05hkJ2ILOP2k7WARjZQjMIWU6R9J/i', 'gaspard@gaspard.fr', 'admin');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`titre`);

--
-- Index pour la table `visiteur`
--
ALTER TABLE `visiteur`
  ADD PRIMARY KEY (`id_visit`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `visiteur`
--
ALTER TABLE `visiteur`
  MODIFY `id_visit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
