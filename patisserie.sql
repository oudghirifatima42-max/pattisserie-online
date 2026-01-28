-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 28 jan. 2026 à 12:09
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `patisserie`
--

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `Id_client` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `telephone` int NOT NULL,
  `adresse` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`Id_client`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`Id_client`, `nom`, `prenom`, `email`, `telephone`, `adresse`) VALUES
(1, 'oudghiri', 'Fatima zahra', 'f.oudghiri-223@ump.ac.ma', 787967645, 'hay el moustakbel rue el madar 4,Nr:31 Oujda'),
(2, 'Khalfaoui', 'najlae', 's.khalfaoui@gmail.com', 787653245, 'village si lakhdar , Nr:32'),
(6, 'Youssfi', 'Siham', 'salma54@gmail.com', 676543423, 'village hakkou 45@gmail.com'),
(7, 'Lachaal', 'Hiba', 'hiba87@gmail.com', 787675467, 'hay salam 765'),
(8, 'hajaj', 'Riham', 'riham56@gmail.com', 787657654, 'salam larmoud 67'),
(11, 'hathout', 'asmae', 'asmae@gmail.com', 764678978, 'hay alnahda oujda'),
(12, 'hathout', 'asmae', 'asmae@gmail.com', 764678978, 'hay alnahda oujda'),
(13, 'oudghiri', 'Fatima zahra', 'f.oudghiri-223@ump.ac.ma', 787967645, 'hay el moustakbel rue el madar 4,Nr:31 Oujda'),
(14, 'oudghiri', 'Fatima zahra', 'f.oudghiri-223@ump.ac.ma', 787967645, 'hay el moustakbel rue el madar 4,Nr:31 Oujda'),
(15, 'siham', 'khlifi', 'f.oudghiri-223@ump.ac.ma', 787967645, 'hay el moustakbel rue el madar 4,Nr:31 Oujda');

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

DROP TABLE IF EXISTS `commandes`;
CREATE TABLE IF NOT EXISTS `commandes` (
  `Id_commande` int NOT NULL AUTO_INCREMENT,
  `date_commande` date NOT NULL,
  `totale` int NOT NULL,
  `Id_client` int NOT NULL,
  PRIMARY KEY (`Id_commande`),
  KEY `Id_client` (`Id_client`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`Id_commande`, `date_commande`, `totale`, `Id_client`) VALUES
(1, '2025-05-09', 198, 1),
(2, '2025-05-09', 304, 2),
(6, '2025-05-10', 56, 6),
(7, '2025-05-13', 420, 7),
(8, '2025-05-20', 20, 8),
(11, '2025-05-21', 61, 11),
(12, '2025-12-12', 61, 12),
(13, '2025-12-12', 61, 13),
(14, '2025-12-14', 61, 14),
(15, '2025-12-14', 30, 15);

-- --------------------------------------------------------

--
-- Structure de la table `commande_produit`
--

DROP TABLE IF EXISTS `commande_produit`;
CREATE TABLE IF NOT EXISTS `commande_produit` (
  `quantite` int NOT NULL,
  `Id_produit` int NOT NULL,
  `Id_commande` int NOT NULL,
  KEY `Id_produit` (`Id_produit`),
  KEY `Id_commande` (`Id_commande`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commande_produit`
--

INSERT INTO `commande_produit` (`quantite`, `Id_produit`, `Id_commande`) VALUES
(1, 1, 1),
(1, 14, 1),
(1, 27, 1),
(1, 40, 1),
(1, 51, 1),
(1, 7, 2),
(2, 15, 2),
(1, 43, 2),
(2, 51, 2),
(1, 16, 6),
(1, 15, 6),
(1, 51, 6),
(1, 52, 6),
(2, 39, 7),
(1, 43, 7),
(1, 4, 8),
(1, 54, 11),
(1, 3, 11),
(2, 14, 11),
(1, 54, 12),
(1, 3, 12),
(2, 14, 12),
(1, 54, 13),
(1, 3, 13),
(2, 14, 13),
(1, 54, 14),
(1, 3, 14),
(2, 14, 14),
(2, 14, 15),
(1, 27, 15);

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `Id_produit` int NOT NULL AUTO_INCREMENT,
  `intitule` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `prix` int NOT NULL,
  PRIMARY KEY (`Id_produit`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`Id_produit`, `intitule`, `prix`) VALUES
(1, 'Croissant au chocolat', 8),
(2, 'Macaron framboise', 50),
(3, 'Mille-Feuille Classique', 13),
(4, 'Mini tarte au citron', 20),
(5, 'Gauffre au chocolat', 29),
(6, 'Pancake Golden Stack', 30),
(7, 'Crêpe au citron', 40),
(8, 'Tablette chokolat lait', 20),
(9, 'Tartelette Noisette', 20),
(10, 'Craquant praline', 90),
(11, 'Chokolat dubai', 150),
(12, 'Mille-Feuille Exotique', 22),
(13, 'Batbout au poulet', 10),
(14, 'Mini Pizza végétarienne', 10),
(15, 'Quiche à la dinde', 12),
(16, 'Mini-Burger à la viande hachée', 15),
(17, 'Wrap au thon', 20),
(18, 'Brioche salée au fromage', 9),
(19, 'Mini-Tacos mixte', 15),
(20, 'Chaussons salés à la dinde', 10),
(21, 'Briouate à la viande hachée', 15),
(22, 'Msamens au poulet', 10),
(23, 'Mini bastilla aux fruits de mer', 25),
(24, 'Croissant Salé à la dinde fumée', 10),
(25, 'Baguette', 2),
(26, 'Foudasse', 5),
(27, 'Pain de campagne', 10),
(28, 'Pain complet', 10),
(29, 'Pain d\'épeautre', 15),
(30, 'Pain de noix', 15),
(31, 'Pain de seigle', 15),
(32, 'Pain de mie', 10),
(33, 'Pain de maïs', 20),
(34, 'Pain ciabatta', 10),
(35, 'Pain au levain', 10),
(36, 'Pain tranché', 10),
(37, 'Fekass', 100),
(38, 'Chebakia', 110),
(39, 'Corne de gazelle', 130),
(40, 'Ghriba aux amandes', 130),
(41, 'Kaak', 70),
(42, 'Makrout', 80),
(43, 'Sellou', 160),
(44, 'Boule de coco', 80),
(45, 'Bahla', 80),
(46, 'Zellige', 90),
(47, 'Sablé au fraise', 90),
(48, 'Sablé au chocolat', 90),
(49, 'Mojito', 30),
(50, 'Caramel Hazelnut Iced Coffee', 30),
(51, 'Soda', 8),
(52, 'Thé à la menthe', 21),
(53, 'Chocolat chaud', 25),
(54, 'Jus de fruits', 28),
(55, 'Eau de coco', 30),
(56, 'Bubble tea', 35),
(57, 'Citronnade', 35),
(58, 'Cidre chaud', 40),
(59, 'Matcha latte', 28),
(60, 'Lassi à la mangue', 40);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `commandes_ibfk_1` FOREIGN KEY (`Id_client`) REFERENCES `clients` (`Id_client`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `commande_produit`
--
ALTER TABLE `commande_produit`
  ADD CONSTRAINT `commande_produit_ibfk_2` FOREIGN KEY (`Id_produit`) REFERENCES `produits` (`Id_produit`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `commande_produit_ibfk_3` FOREIGN KEY (`Id_commande`) REFERENCES `commandes` (`Id_commande`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
