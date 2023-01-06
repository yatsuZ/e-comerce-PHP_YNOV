-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 02 jan. 2023 à 23:49
-- Version du serveur : 5.7.36
-- Version de PHP : 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `data_site`
--

-- --------------------------------------------------------

--
-- Structure de la table `address`
--

DROP TABLE IF EXISTS `address`;
CREATE TABLE IF NOT EXISTS `address` (
  `id_address` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `mail_address` varchar(100) DEFAULT NULL,
  `postal_code` varchar(100) DEFAULT NULL,
  `house_num` int(11) DEFAULT NULL,
  `floor_num` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_address`),
  KEY `id_user` (`id_user`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id_cart` int(11) NOT NULL AUTO_INCREMENT,
  `cart_date` int(11) DEFAULT NULL,
  `nb_products` int(11) DEFAULT NULL,
  `id_product` int(11) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_cart`),
  KEY `id_product` (`id_product`),
  KEY `id_user` (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cart`
--

INSERT INTO `cart` (`id_cart`, `cart_date`, `nb_products`, `id_product`, `size`, `id_user`) VALUES
(9, NULL, 1, 1, 45, 5),
(11, NULL, 3, 6, 45, 1),
(14, NULL, 4, 1, 42, 1);

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int(11) NOT NULL AUTO_INCREMENT,
  `name_category` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id_category`, `name_category`) VALUES
(1, 'DLYT Originals'),
(2, 'DLYT Bootlegs');

-- --------------------------------------------------------

--
-- Structure de la table `imgs`
--

DROP TABLE IF EXISTS `imgs`;
CREATE TABLE IF NOT EXISTS `imgs` (
  `id_img` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `url` varchar(255) DEFAULT NULL,
  `id_product` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_img`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `imgs`
--

INSERT INTO `imgs` (`id_img`, `url`, `id_product`) VALUES
(12, '/database/imgs/6_6_php7EFD.jpg', 6),
(11, '/database/imgs/5_5_php6922.jpg', 5),
(10, '/database/imgs/3_4_php5386.jpg', 3),
(8, '/database/imgs/1_2_php2669.jpg', 1),
(9, '/database/imgs/2_3_php389B.jpg', 2),
(13, '/database/imgs/7_7_php9EFA.jpg', 7),
(14, '/database/imgs/3_8_php6495.jpg', 3),
(15, '/database/imgs/3_9_php6496.jpg', 3);

-- --------------------------------------------------------

--
-- Structure de la table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
CREATE TABLE IF NOT EXISTS `invoices` (
  `id_invoices` int(11) NOT NULL AUTO_INCREMENT,
  `id_product` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_address` int(11) DEFAULT NULL,
  `id_command_line` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_invoices`),
  KEY `id_product` (`id_product`),
  KEY `id_user` (`id_user`),
  KEY `id_address` (`id_address`),
  KEY `id_command_line` (`id_command_line`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `id_payment` int(11) NOT NULL AUTO_INCREMENT,
  `iban` varchar(100) DEFAULT NULL,
  `card_number` varchar(100) DEFAULT NULL,
  `cryptogram` int(11) DEFAULT NULL,
  `expiration_date` date DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_command` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_payment`),
  KEY `id_user` (`id_user`),
  KEY `id_command` (`id_command`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

DROP TABLE IF EXISTS `photo`;
CREATE TABLE IF NOT EXISTS `photo` (
  `id_photo` int(11) NOT NULL AUTO_INCREMENT,
  `id_product` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_photo`),
  KEY `id_product` (`id_product`),
  KEY `id_user` (`id_user`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id_product` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `color` varchar(100) DEFAULT NULL,
  `id_category` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_product`),
  KEY `id_category` (`id_category`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id_product`, `name`, `price`, `color`, `id_category`) VALUES
(1, 'DLYT ShiroNerri', 150, 'black/white', 1),
(2, 'DLYT Manga Bell', 237, 'red/green/yellow', 1),
(3, 'DLYT Red Nimbus', 170, 'red', 1),
(5, 'DLYT 225', 225, 'orange/white/green', 2),
(6, 'DLYT DjazaÃ¯r', 213, 'green/white/red', 2),
(7, 'DLYT Kinshasa', 243, 'blue/yellow/red', 2);

-- --------------------------------------------------------

--
-- Structure de la table `rate`
--

DROP TABLE IF EXISTS `rate`;
CREATE TABLE IF NOT EXISTS `rate` (
  `id_rate` int(11) NOT NULL AUTO_INCREMENT,
  `grade` int(11) DEFAULT NULL,
  `id_product` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_rate`),
  KEY `id_product` (`id_product`),
  KEY `id_user` (`id_user`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `received_command`
--

DROP TABLE IF EXISTS `received_command`;
CREATE TABLE IF NOT EXISTS `received_command` (
  `id_command` int(11) NOT NULL AUTO_INCREMENT,
  `reception_date` date DEFAULT NULL,
  `id_valid_command` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_command`),
  KEY `id_valid_command` (`id_valid_command`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE IF NOT EXISTS `stock` (
  `id_stock` int(11) NOT NULL AUTO_INCREMENT,
  `id_product` int(11) NOT NULL,
  `size` int(11) DEFAULT NULL,
  `in_stock` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_stock`),
  UNIQUE KEY `id_product` (`id_product`,`size`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `stock`
--

INSERT INTO `stock` (`id_stock`, `id_product`, `size`, `in_stock`) VALUES
(7, 2, 36, 2),
(8, 2, 40, 1),
(9, 1, 45, 300),
(10, 1, 42, 200),
(11, 6, 45, 100);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `admin` int(11) DEFAULT NULL,
  `pseudo` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `password` text,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `admin`, `pseudo`, `email`, `date_of_birth`, `phone_number`, `password`) VALUES
(9, 0, 'paulLeBG', 'paullebg@gmail.com', '2001-03-31', '0111111111', '$2y$10$00cNMZVbnK2QBNB1HbKS5OfWwIUKFICD3LgnR7K2gAoks21KcmKua'),
(1, 1, 'admin', 'admin@delyatia.com', '2023-01-02', '0111111111', '$2y$10$SKTYug3W4PRZMWqv6pRlP.rAzy8V4houp4aY4wACWuczjT5PtjOyO'),
(5, 0, 'yassineSheep', 'yassine@sheep.fr', '2003-06-28', '0711111110', '$2y$10$B/jvsV06kWTxSsFetgpU0OFfCjHxEyZehuoyNJYOxCILKKVWFV0NO'),
(10, 1, 'admin2', 'admin2@delyatia.com', '2000-01-01', '0101010101', '$2y$10$xJEOkFvXWTgjleuaVGpmAevAFVxS0KLEXNG9PgReAE4mN/zsfJX3C');

-- --------------------------------------------------------

--
-- Structure de la table `valid_command`
--

DROP TABLE IF EXISTS `valid_command`;
CREATE TABLE IF NOT EXISTS `valid_command` (
  `id_valid_command` int(11) NOT NULL AUTO_INCREMENT,
  `id_cart` int(11) DEFAULT NULL,
  `valid_commande_date` date DEFAULT NULL,
  PRIMARY KEY (`id_valid_command`),
  KEY `id_cart` (`id_cart`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `valid_command`
--

INSERT INTO `valid_command` (`id_valid_command`, `id_cart`, `valid_commande_date`) VALUES
(2, 9, '2023-01-02');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
