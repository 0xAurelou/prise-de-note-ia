-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 15 juin 2023 à 15:59
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bdd_ia`
--

-- --------------------------------------------------------

--
-- Structure de la table `fonctionnalites`
--

CREATE TABLE `fonctionnalites` (
  `id_fonctionnalites` int(11) NOT NULL,
  `nom_fonctionnalites` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `fonctionnalites`
--

INSERT INTO `fonctionnalites` (`id_fonctionnalites`, `nom_fonctionnalites`) VALUES
(1, 'Slack'),
(2, 'Notion'),
(3, 'Mail'),
(4, 'Jira'),
(5, 'Monday');

-- --------------------------------------------------------

--
-- Structure de la table `langues`
--

CREATE TABLE `langues` (
  `id_langues` int(11) NOT NULL,
  `nom_langue` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `langues`
--

INSERT INTO `langues` (`id_langues`, `nom_langue`) VALUES
(1, 'Allemand'),
(2, 'Neerlandais'),
(3, 'Francais'),
(4, 'Italien'),
(5, 'Anglais'),
(6, 'Espagnol'),
(7, 'Portugais'),
(8, 'Japonais');

-- --------------------------------------------------------

--
-- Structure de la table `logiciels`
--

CREATE TABLE `logiciels` (
  `id_logiciels` int(11) NOT NULL,
  `nom_logiciel` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `langues` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `note_qualite_retranscription` int(11) DEFAULT NULL,
  `note_qualite_resume` int(11) DEFAULT NULL,
  `note_fonctionnalite_additionnelle` int(11) DEFAULT NULL,
  `note_rapport_upload_prix` int(11) DEFAULT NULL,
  `integrations` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `logiciels`
--

INSERT INTO `logiciels` (`id_logiciels`, `nom_logiciel`, `langues`, `note_qualite_retranscription`, `note_qualite_resume`, `note_fonctionnalite_additionnelle`, `note_rapport_upload_prix`, `integrations`) VALUES
(1, 'Fireflies', 'Allemand, Neerlandais, Francais, Italien, Anglais, Espagnol, Portugais, Japonais', 5, 5, 5, 3, 'Slack, Notion, Mail, Monday'),
(2, 'Tactiq', 'Anglais, Allemand, Francais, Espagnol, Portugais', 4, 4, 2, 4, 'Slack, Notion, Mail, Monday, Jira'),
(3, 'Sembly', 'Allemand, Neerlandais, Francais, Italien, Anglais, Espagnol, Portugais, Japonais', 3, 3, 3, 3, 'Mail'),
(4, 'Fathom', 'Allemand, Neerlandais, Francais, Italien, Anglais, Espagnol, Portugais', 2, 3, 1, 5, 'Mail, Notion');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `fonctionnalites`
--
ALTER TABLE `fonctionnalites`
  ADD PRIMARY KEY (`id_fonctionnalites`);

--
-- Index pour la table `langues`
--
ALTER TABLE `langues`
  ADD PRIMARY KEY (`id_langues`);

--
-- Index pour la table `logiciels`
--
ALTER TABLE `logiciels`
  ADD PRIMARY KEY (`id_logiciels`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `fonctionnalites`
--
ALTER TABLE `fonctionnalites`
  MODIFY `id_fonctionnalites` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `langues`
--
ALTER TABLE `langues`
  MODIFY `id_langues` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
