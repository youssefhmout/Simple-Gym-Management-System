-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : ven. 15 août 2025 à 17:19
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sale_de_sport`
--

-- --------------------------------------------------------

--
-- Structure de la table `memb`
--

CREATE TABLE `memb` (
  `prenom` varchar(23) NOT NULL,
  `nom` varchar(23) NOT NULL,
  `cin` varchar(10) NOT NULL,
  `age` int(11) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `memb`
--

INSERT INTO `memb` (`prenom`, `nom`, `cin`, `age`, `date_debut`, `date_fin`) VALUES
('youssef', 'hmoutjjj', 'DA10297', 21, '2025-08-15', '2026-01-16'),
('oussama', 'hissi', 'DA34311', 23, '2025-03-05', '2025-08-16'),
('jamal', 'soujae', 'DE23434', 20, '2025-01-15', '2025-05-28');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'youssefhmout', 'youssef2003'),
(2, 'jamal2003', 'jamal2003'),
(3, 'fadi2006', 'fadi2006');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `memb`
--
ALTER TABLE `memb`
  ADD PRIMARY KEY (`cin`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
