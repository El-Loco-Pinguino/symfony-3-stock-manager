-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 22 avr. 2019 à 14:18
-- Version du serveur :  5.7.21
-- Version de PHP :  7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `materiel_hourlier`
--

-- --------------------------------------------------------

--
-- Structure de la table `material`
--

DROP TABLE IF EXISTS `material`;
CREATE TABLE IF NOT EXISTS `material` (
  `material_id` int(11) NOT NULL AUTO_INCREMENT,
  `material_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `material_price` double NOT NULL,
  `material_quantity` int(11) NOT NULL,
  `material_created_at` datetime NOT NULL,
  PRIMARY KEY (`material_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `material`
--

INSERT INTO `material` (`material_id`, `material_name`, `material_price`, `material_quantity`, `material_created_at`) VALUES
(1, 'P8546', 44.81, 5, '2019-04-17 10:53:45'),
(2, 'H6920', 34.19, 3, '2019-04-17 10:53:45'),
(3, 'L6384', 92.28, 8, '2019-04-17 10:53:45'),
(4, 'Z8868', 67.95, 10, '2019-04-17 10:53:45'),
(5, 'U9279', 9.01, 4, '2019-04-17 10:53:45'),
(6, 'N7597', 47.25, 0, '2019-04-17 10:53:45'),
(7, 'R8573', 7.19, 10, '2019-04-17 10:53:45'),
(8, 'S9524', 2.2, 10, '2019-04-17 10:53:45'),
(9, 'S3051', 88.29, 7, '2019-04-17 10:53:45'),
(10, 'L5534', 55.78, 5, '2019-04-17 10:53:45');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
