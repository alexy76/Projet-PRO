-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 10 mars 2022 à 14:40
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ecommerce`
--

-- --------------------------------------------------------

--
-- Structure de la table `ec_category`
--

DROP TABLE IF EXISTS `ec_category`;
CREATE TABLE IF NOT EXISTS `ec_category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(200) NOT NULL,
  `cat_position` int(11) NOT NULL,
  `cat_slug` varchar(200) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `ec_category`
--

INSERT INTO `ec_category` (`cat_id`, `cat_name`, `cat_position`, `cat_slug`) VALUES
(11, 'FEMME', 1, 'femme'),
(12, 'HOMME', 2, 'homme'),
(13, 'ENFANT', 3, 'enfant');

-- --------------------------------------------------------

--
-- Structure de la table `ec_collection`
--

DROP TABLE IF EXISTS `ec_collection`;
CREATE TABLE IF NOT EXISTS `ec_collection` (
  `col_id` int(11) NOT NULL AUTO_INCREMENT,
  `col_name` varchar(200) NOT NULL,
  `col_position` int(11) NOT NULL,
  `col_slug` varchar(255) DEFAULT NULL,
  `col_content_html` mediumtext,
  `col_meta_title` varchar(500) DEFAULT NULL,
  `col_meta_description` varchar(1000) DEFAULT NULL,
  `cat_id` int(11) NOT NULL,
  PRIMARY KEY (`col_id`),
  KEY `ec_collection_ec_category_FK` (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `ec_collection`
--

INSERT INTO `ec_collection` (`col_id`, `col_name`, `col_position`, `col_slug`, `col_content_html`, `col_meta_title`, `col_meta_description`, `cat_id`) VALUES
(17, 'Maillots', 1, 'maillots', NULL, NULL, NULL, 12),
(18, 'Vestes', 1, 'vestes', NULL, NULL, NULL, 11),
(19, 'Pantalons de Jogging', 2, 'pantalons-de-jogging', NULL, NULL, NULL, 11),
(20, 'Shorts', 2, 'shorts', NULL, NULL, NULL, 12),
(21, 'Baskets', 1, 'baskets', NULL, NULL, NULL, 13);

-- --------------------------------------------------------

--
-- Structure de la table `ec_commands_clients`
--

DROP TABLE IF EXISTS `ec_commands_clients`;
CREATE TABLE IF NOT EXISTS `ec_commands_clients` (
  `pdt_id` int(11) NOT NULL,
  `usr_id` int(11) NOT NULL,
  `cmd_qty` int(11) NOT NULL,
  `cmd_date` date NOT NULL,
  `cmd_nb_order` varchar(100) NOT NULL,
  PRIMARY KEY (`pdt_id`,`usr_id`),
  KEY `ec_commands_clients_ec_users0_FK` (`usr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `ec_comments_products`
--

DROP TABLE IF EXISTS `ec_comments_products`;
CREATE TABLE IF NOT EXISTS `ec_comments_products` (
  `cmt_id` int(11) NOT NULL AUTO_INCREMENT,
  `cmt_author` varchar(100) NOT NULL,
  `cmt_note` float NOT NULL,
  `cmt_date` date NOT NULL,
  `cmt_text` text NOT NULL,
  `cmt_validated` tinyint(1) NOT NULL,
  `pdt_id` int(11) NOT NULL,
  PRIMARY KEY (`cmt_id`),
  KEY `ec_comments_products_ec_products_FK` (`pdt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `ec_get_images`
--

DROP TABLE IF EXISTS `ec_get_images`;
CREATE TABLE IF NOT EXISTS `ec_get_images` (
  `img_id` int(11) NOT NULL,
  `pdt_id` int(11) NOT NULL,
  PRIMARY KEY (`img_id`,`pdt_id`),
  KEY `ec_get_images_ec_products0_FK` (`pdt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `ec_get_images`
--

INSERT INTO `ec_get_images` (`img_id`, `pdt_id`) VALUES
(39, 29),
(40, 29),
(41, 29),
(42, 30),
(43, 30),
(44, 30),
(45, 30),
(46, 31),
(47, 31),
(48, 31),
(49, 31),
(50, 32),
(51, 32),
(52, 33),
(53, 33),
(54, 33),
(55, 33),
(56, 34),
(57, 34),
(58, 34),
(59, 34),
(60, 35),
(61, 35),
(62, 35),
(63, 36),
(64, 36),
(65, 36),
(66, 37),
(67, 37),
(68, 38),
(69, 38),
(70, 38),
(71, 39),
(72, 39),
(73, 39),
(74, 40),
(75, 40),
(76, 40),
(77, 40),
(78, 41),
(79, 41),
(80, 41),
(81, 41),
(82, 42),
(83, 42),
(84, 42),
(85, 42),
(86, 43),
(87, 43),
(88, 43),
(89, 43),
(90, 44),
(91, 44),
(92, 44),
(93, 44),
(94, 45),
(95, 45),
(96, 45),
(97, 45),
(98, 46),
(99, 46),
(100, 46),
(101, 46),
(102, 47),
(103, 47),
(104, 47),
(105, 47),
(106, 48),
(107, 48),
(108, 48),
(109, 48),
(110, 49),
(111, 49),
(112, 49),
(113, 49),
(114, 50),
(115, 50),
(116, 50),
(117, 50),
(118, 51),
(119, 51),
(120, 51),
(121, 51),
(122, 52),
(123, 52),
(124, 52),
(125, 53),
(126, 53),
(127, 53),
(128, 54),
(129, 54),
(130, 54),
(131, 55),
(132, 55),
(133, 55),
(134, 55),
(135, 56),
(136, 56),
(137, 56),
(138, 57),
(139, 57),
(140, 57),
(141, 58),
(142, 58),
(143, 58),
(144, 59),
(145, 59),
(146, 60),
(147, 60),
(148, 61),
(149, 61),
(150, 61),
(151, 61),
(152, 62),
(153, 62),
(154, 62),
(155, 62),
(156, 63),
(157, 63),
(158, 64),
(159, 64),
(160, 64),
(161, 65),
(162, 65),
(163, 65),
(164, 66),
(165, 66),
(166, 66),
(167, 67),
(168, 67),
(169, 67),
(170, 67),
(171, 68),
(172, 68),
(173, 68),
(174, 69),
(175, 69),
(176, 69),
(177, 70),
(178, 70),
(179, 70),
(180, 71),
(181, 71),
(182, 72),
(183, 72),
(184, 72),
(185, 72),
(186, 73),
(187, 73),
(188, 73),
(189, 73),
(190, 74),
(191, 74),
(192, 74),
(193, 74),
(194, 75),
(195, 76),
(196, 76),
(197, 76),
(198, 77),
(199, 77),
(200, 77),
(201, 77),
(202, 78),
(203, 78),
(204, 78),
(205, 79),
(206, 79),
(207, 79),
(208, 80),
(209, 80),
(210, 80),
(211, 81),
(212, 81),
(213, 81),
(214, 82),
(215, 82),
(216, 82),
(217, 83),
(218, 83),
(219, 83);

-- --------------------------------------------------------

--
-- Structure de la table `ec_images`
--

DROP TABLE IF EXISTS `ec_images`;
CREATE TABLE IF NOT EXISTS `ec_images` (
  `img_id` int(11) NOT NULL AUTO_INCREMENT,
  `img_name_file` varchar(250) NOT NULL,
  `img_ext_file` varchar(20) NOT NULL,
  `img_label_file` varchar(500) NOT NULL,
  PRIMARY KEY (`img_id`)
) ENGINE=InnoDB AUTO_INCREMENT=220 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `ec_images`
--

INSERT INTO `ec_images` (`img_id`, `img_name_file`, `img_ext_file`, `img_label_file`) VALUES
(39, 'pdt_29_6229c21636d72.webp', 'webp', 'cire-impermeable-de-voile-femme-500-bleu'),
(40, 'pdt_29_6229c221c9501.webp', 'webp', 'cire-impermeable-de-voile-femme-500-bleu'),
(41, 'pdt_29_6229c22a59ffd.webp', 'webp', 'cire-impermeable-de-voile-femme-500-bleu'),
(42, 'pdt_30_6229c366e01bb.webp', 'webp', 'softshell-coupe-vent-de-trek-montagne-mt500-windwarm-noir-femme'),
(43, 'pdt_30_6229c370b524c.webp', 'webp', 'softshell-coupe-vent-de-trek-montagne-mt500-windwarm-noir-femme'),
(44, 'pdt_30_6229c381949e9.webp', 'webp', 'softshell-coupe-vent-de-trek-montagne-mt500-windwarm-noir-femme'),
(45, 'pdt_30_6229c38a95890.webp', 'webp', 'softshell-coupe-vent-de-trek-montagne-mt500-windwarm-noir-femme'),
(46, 'pdt_31_6229c52694749.webp', 'webp', 'veste-impermeable-de-randonnee-montagne-mh100-femme'),
(47, 'pdt_31_6229c52fe32cd.webp', 'webp', 'veste-impermeable-de-randonnee-montagne-mh100-femme'),
(48, 'pdt_31_6229c53ae3cf5.webp', 'webp', 'veste-impermeable-de-randonnee-montagne-mh100-femme'),
(49, 'pdt_31_6229c541eab3e.webp', 'webp', 'veste-impermeable-de-randonnee-montagne-mh100-femme'),
(50, 'pdt_32_6229cb31812c0.webp', 'webp', 'veste-france-collection-officielle-allez-les-bleus-femme'),
(51, 'pdt_32_6229cb3e5dac8.webp', 'webp', 'veste-france-collection-officielle-allez-les-bleus-femme'),
(52, 'pdt_33_6229cc28bd591.webp', 'webp', 'doudoune-sans-manche-en-duvet-de-trek-montagne-mt-100-noire-femme'),
(53, 'pdt_33_6229cc339d518.webp', 'webp', 'doudoune-sans-manche-en-duvet-de-trek-montagne-mt-100-noire-femme'),
(54, 'pdt_33_6229cc3e2e95f.webp', 'webp', 'doudoune-sans-manche-en-duvet-de-trek-montagne-mt-100-noire-femme'),
(55, 'pdt_33_6229cc4658f33.webp', 'webp', 'doudoune-sans-manche-en-duvet-de-trek-montagne-mt-100-noire-femme'),
(56, 'pdt_34_6229cd28cb7c4.webp', 'webp', 'veste-impermeable-de-randonnee-raincut-femme'),
(57, 'pdt_34_6229cd333107c.webp', 'webp', 'veste-impermeable-de-randonnee-raincut-femme'),
(58, 'pdt_34_6229cd42d505e.webp', 'webp', 'veste-impermeable-de-randonnee-raincut-femme'),
(59, 'pdt_34_6229cd4b59fea.webp', 'webp', 'veste-impermeable-de-randonnee-raincut-femme'),
(60, 'pdt_35_6229cdedcf333.webp', 'webp', 'veste-impermeable-de-randonnee-montagne-mh500-femme'),
(61, 'pdt_35_6229cdfb8a5e1.webp', 'webp', 'veste-impermeable-de-randonnee-montagne-mh500-femme'),
(62, 'pdt_35_6229ce0b67179.webp', 'webp', 'veste-impermeable-de-randonnee-montagne-mh500-femme'),
(63, 'pdt_36_6229ced42d4dd.webp', 'webp', 'veste-impermeable-de-randonnee-nh500-femme'),
(64, 'pdt_36_6229cede5dc35.webp', 'webp', 'veste-impermeable-de-randonnee-nh500-femme'),
(65, 'pdt_36_6229cee9e0442.webp', 'webp', 'veste-impermeable-de-randonnee-nh500-femme'),
(66, 'pdt_37_6229cf7037df5.webp', 'webp', 'veste-femme-hummel-hmlcima'),
(67, 'pdt_37_6229cf77b3fe8.webp', 'webp', 'veste-femme-hummel-hmlcima'),
(68, 'pdt_38_6229cfe52c127.webp', 'webp', 'veste-de-ski-180-bleue-marine'),
(69, 'pdt_38_6229cfef4af7f.webp', 'webp', 'veste-de-ski-180-bleue-marine'),
(70, 'pdt_38_6229cffda7cf2.webp', 'webp', 'veste-de-ski-180-bleue-marine'),
(71, 'pdt_39_6229d0c17c12a.webp', 'webp', 'veste-impermeable-coupevent-de-voile-femme-sailing-500-bleu'),
(72, 'pdt_39_6229d0ca95373.webp', 'webp', 'veste-impermeable-coupevent-de-voile-femme-sailing-500-bleu'),
(73, 'pdt_39_6229d0d380e8a.webp', 'webp', 'veste-impermeable-coupevent-de-voile-femme-sailing-500-bleu'),
(74, 'pdt_40_6229d2da291ab.webp', 'webp', 'pantalon-jogging-leger-fitness-coupe-droite-noir'),
(75, 'pdt_40_6229d2e4c8281.webp', 'webp', 'pantalon-jogging-leger-fitness-coupe-droite-noir'),
(76, 'pdt_40_6229d2ed4becd.webp', 'webp', 'pantalon-jogging-leger-fitness-coupe-droite-noir'),
(77, 'pdt_40_6229d2f4b1b0f.webp', 'webp', 'pantalon-jogging-leger-fitness-coupe-droite-noir'),
(78, 'pdt_41_6229d3d6207ea.webp', 'webp', 'pantalon-jogging-leger-fitness-coupe-carotte-noir'),
(79, 'pdt_41_6229d3df55bae.webp', 'webp', 'pantalon-jogging-leger-fitness-coupe-carotte-noir'),
(80, 'pdt_41_6229d3e71b5d3.webp', 'webp', 'pantalon-jogging-leger-fitness-coupe-carotte-noir'),
(81, 'pdt_41_6229d3f131c37.webp', 'webp', 'pantalon-jogging-leger-fitness-coupe-carotte-noir'),
(82, 'pdt_42_6229d4a5cc8d4.webp', 'webp', 'pantalon-jogging-fitness-avec-lien-bas-de-jambe-coupe-droite-noir'),
(83, 'pdt_42_6229d4ae24ef9.webp', 'webp', 'pantalon-jogging-fitness-avec-lien-bas-de-jambe-coupe-droite-noir'),
(84, 'pdt_42_6229d4b659490.webp', 'webp', 'pantalon-jogging-fitness-avec-lien-bas-de-jambe-coupe-droite-noir'),
(85, 'pdt_42_6229d4bd25994.webp', 'webp', 'pantalon-jogging-fitness-avec-lien-bas-de-jambe-coupe-droite-noir'),
(86, 'pdt_43_6229d56704de6.webp', 'webp', 'pantalon-de-jogging-running-respirant-femme-dry-noir'),
(87, 'pdt_43_6229d5706937e.webp', 'webp', 'pantalon-de-jogging-running-respirant-femme-dry-noir'),
(88, 'pdt_43_6229d57714a49.webp', 'webp', 'pantalon-de-jogging-running-respirant-femme-dry-noir'),
(89, 'pdt_43_6229d5804e89d.webp', 'webp', 'pantalon-de-jogging-running-respirant-femme-dry-noir'),
(90, 'pdt_44_6229d62150a8a.webp', 'webp', 'pantalon-jogging-fitness-bas-resserre-coupe-droite-noir'),
(91, 'pdt_44_6229d6298db0d.webp', 'webp', 'pantalon-jogging-fitness-bas-resserre-coupe-droite-noir'),
(92, 'pdt_44_6229d633b02ed.webp', 'webp', 'pantalon-jogging-fitness-bas-resserre-coupe-droite-noir'),
(93, 'pdt_44_6229d639d83c0.webp', 'webp', 'pantalon-jogging-fitness-bas-resserre-coupe-droite-noir'),
(94, 'pdt_45_6229d6bd5ff59.webp', 'webp', 'pantalon-jogging-fitness-bas-de-jambe-zippe-slim-noir'),
(95, 'pdt_45_6229d6c82440a.webp', 'webp', 'pantalon-jogging-fitness-bas-de-jambe-zippe-slim-noir'),
(96, 'pdt_45_6229d6cf3a9c9.webp', 'webp', 'pantalon-jogging-fitness-bas-de-jambe-zippe-slim-noir'),
(97, 'pdt_45_6229d6d65085b.webp', 'webp', 'pantalon-jogging-fitness-bas-de-jambe-zippe-slim-noir'),
(98, 'pdt_46_6229d7b0dce4e.webp', 'webp', 'pantalon-jogging-fitness-bas-resserre-slim-gris'),
(99, 'pdt_46_6229d7bbae621.webp', 'webp', 'pantalon-jogging-fitness-bas-resserre-slim-gris'),
(100, 'pdt_46_6229d7c2b2723.webp', 'webp', 'pantalon-jogging-fitness-bas-resserre-slim-gris'),
(101, 'pdt_46_6229d7ca107e2.webp', 'webp', 'pantalon-jogging-fitness-bas-resserre-slim-gris'),
(102, 'pdt_47_6229d8588ebea.webp', 'webp', 'pantalon-de-survetement-adidas-femme-gris'),
(103, 'pdt_47_6229d8600c187.webp', 'webp', 'pantalon-de-survetement-adidas-femme-gris'),
(104, 'pdt_47_6229d867aff99.webp', 'webp', 'pantalon-de-survetement-adidas-femme-gris'),
(105, 'pdt_47_6229d86d65749.webp', 'webp', 'pantalon-de-survetement-adidas-femme-gris'),
(106, 'pdt_48_6229d8f52802b.webp', 'webp', 'pantalon-de-jogging-running-chaud-femme-warm-noir'),
(107, 'pdt_48_6229d902bbc76.webp', 'webp', 'pantalon-de-jogging-running-chaud-femme-warm-noir'),
(108, 'pdt_48_6229d908ec974.webp', 'webp', 'pantalon-de-jogging-running-chaud-femme-warm-noir'),
(109, 'pdt_48_6229d910837f4.webp', 'webp', 'pantalon-de-jogging-running-chaud-femme-warm-noir'),
(110, 'pdt_49_6229d9a693f6c.webp', 'webp', 'pantalon-jogging-fitness-bas-resserre-slim-noir'),
(111, 'pdt_49_6229d9b0b1a1a.webp', 'webp', 'pantalon-jogging-fitness-bas-resserre-slim-noir'),
(112, 'pdt_49_6229d9bb27402.webp', 'webp', 'pantalon-jogging-fitness-bas-resserre-slim-noir'),
(113, 'pdt_49_6229d9c4255b1.webp', 'webp', 'pantalon-jogging-fitness-bas-resserre-slim-noir'),
(114, 'pdt_50_6229da7916217.webp', 'webp', 'pantalon-jogging-fitness-bas-de-jambe-zippe-slim-bleu-marine'),
(115, 'pdt_50_6229da8345964.webp', 'webp', 'pantalon-jogging-fitness-bas-de-jambe-zippe-slim-bleu-marine'),
(116, 'pdt_50_6229da8a7a716.webp', 'webp', 'pantalon-jogging-fitness-bas-de-jambe-zippe-slim-bleu-marine'),
(117, 'pdt_50_6229da97e4289.webp', 'webp', 'pantalon-jogging-fitness-bas-de-jambe-zippe-slim-bleu-marine'),
(118, 'pdt_51_6229ddb3c8442.webp', 'webp', 'maillot-de-trail-running-manches-longues-softshell-homme-noir-bronze'),
(119, 'pdt_51_6229ddbbe860e.webp', 'webp', 'maillot-de-trail-running-manches-longues-softshell-homme-noir-bronze'),
(120, 'pdt_51_6229ddc3744c2.webp', 'webp', 'maillot-de-trail-running-manches-longues-softshell-homme-noir-bronze'),
(121, 'pdt_51_6229ddca29971.webp', 'webp', 'maillot-de-trail-running-manches-longues-softshell-homme-noir-bronze'),
(122, 'pdt_52_6229dedc02a2b.webp', 'webp', 'maillot-rc-lens-home-21-22-adulte'),
(123, 'pdt_52_6229dee3c78c7.webp', 'webp', 'maillot-rc-lens-home-21-22-adulte'),
(124, 'pdt_52_6229deeb55f69.webp', 'webp', 'maillot-rc-lens-home-21-22-adulte'),
(125, 'pdt_53_6229e00e35df4.webp', 'webp', 'maillot-om-home-21-22-puma-adulte'),
(126, 'pdt_53_6229e016d5ef1.webp', 'webp', 'maillot-om-home-21-22-puma-adulte'),
(127, 'pdt_53_6229e02113823.webp', 'webp', 'maillot-om-home-21-22-puma-adulte'),
(128, 'pdt_54_6229e0bc0b85a.webp', 'webp', 'maillot-velo-route-endurance-racer-bordeaux'),
(129, 'pdt_54_6229e0c3a84ea.webp', 'webp', 'maillot-velo-route-endurance-racer-bordeaux'),
(130, 'pdt_54_6229e0caf3bf5.webp', 'webp', 'maillot-velo-route-endurance-racer-bordeaux'),
(131, 'pdt_55_6229ef51b0ff2.webp', 'webp', 'maillot-velo-route-neoracer-gris'),
(132, 'pdt_55_6229ef5bbe976.webp', 'webp', 'maillot-velo-route-neoracer-gris'),
(133, 'pdt_55_6229ef64f3680.webp', 'webp', 'maillot-velo-route-neoracer-gris'),
(134, 'pdt_55_6229ef6cb33ca.webp', 'webp', 'maillot-velo-route-neoracer-gris'),
(135, 'pdt_56_6229f00c1570a.webp', 'webp', 'maillot-velo-route-racer-team-blanc'),
(136, 'pdt_56_6229f014c82e6.webp', 'webp', 'maillot-velo-route-racer-team-blanc'),
(137, 'pdt_56_6229f01d8a9bf.webp', 'webp', 'maillot-velo-route-racer-team-blanc'),
(138, 'pdt_57_6229f0bea1336.webp', 'webp', 'maillot-de-football-entrada-22-homme-noir'),
(139, 'pdt_57_6229f0c8c41fc.webp', 'webp', 'maillot-de-football-entrada-22-homme-noir'),
(140, 'pdt_57_6229f0d43a6c8.webp', 'webp', 'maillot-de-football-entrada-22-homme-noir'),
(141, 'pdt_58_6229f17b0f237.webp', 'webp', 'maillot-velo-route-racer-team-jaune'),
(142, 'pdt_58_6229f186c4c45.webp', 'webp', 'maillot-velo-route-racer-team-jaune'),
(143, 'pdt_58_6229f1933ed3e.webp', 'webp', 'maillot-velo-route-racer-team-jaune'),
(144, 'pdt_59_6229f229c76f7.webp', 'webp', 'maillot-manches-longues-velo-route-triban-rc500-noir'),
(145, 'pdt_59_6229f2323ed26.webp', 'webp', 'maillot-manches-longues-velo-route-triban-rc500-noir'),
(146, 'pdt_60_6229f2b2ed24a.webp', 'webp', 'maillot-de-gardien-manches-longues-reusch-match-pro'),
(147, 'pdt_60_6229f2bad56d3.webp', 'webp', 'maillot-de-gardien-manches-longues-reusch-match-pro'),
(148, 'pdt_61_6229f358b915d.webp', 'webp', 'maillot-de-gardien-de-but'),
(149, 'pdt_61_6229f361c07ca.webp', 'webp', 'maillot-de-gardien-de-but'),
(150, 'pdt_61_6229f369ef96c.webp', 'webp', 'maillot-de-gardien-de-but'),
(151, 'pdt_61_6229f3742b4b6.webp', 'webp', 'maillot-de-gardien-de-but'),
(152, 'pdt_62_6229f46565bd2.webp', 'webp', 'short-cuissard-de-trail-running-confort-homme-noir'),
(153, 'pdt_62_6229f46eea72e.webp', 'webp', 'short-cuissard-de-trail-running-confort-homme-noir'),
(154, 'pdt_62_6229f478dd3ea.webp', 'webp', 'short-cuissard-de-trail-running-confort-homme-noir'),
(155, 'pdt_62_6229f4838130f.webp', 'webp', 'short-cuissard-de-trail-running-confort-homme-noir'),
(156, 'pdt_63_6229f58cbab8e.webp', 'webp', 'short-de-football-ecoconcu-adulte-f100-noir'),
(157, 'pdt_63_6229f59444387.webp', 'webp', 'short-de-football-ecoconcu-adulte-f100-noir'),
(158, 'pdt_64_6229f62a5e479.webp', 'webp', 'short-de-tennis-homme-dry-tsh-500-blanc'),
(159, 'pdt_64_6229f631ac6e7.webp', 'webp', 'short-de-tennis-homme-dry-tsh-500-blanc'),
(160, 'pdt_64_6229f6387a678.webp', 'webp', 'short-de-tennis-homme-dry-tsh-500-blanc'),
(161, 'pdt_65_6229f6d9e0057.webp', 'webp', 'short-adidas-tastigo-19'),
(162, 'pdt_65_6229f6e358b84.webp', 'webp', 'short-adidas-tastigo-19'),
(163, 'pdt_65_6229f6eaa62a5.webp', 'webp', 'short-adidas-tastigo-19'),
(164, 'pdt_66_6229f773df94b.webp', 'webp', 'short-cargo-de-trek-voyage-travel-100-marron-homme'),
(165, 'pdt_66_6229f77f1df93.webp', 'webp', 'short-cargo-de-trek-voyage-travel-100-marron-homme'),
(166, 'pdt_66_6229f786ec43d.webp', 'webp', 'short-cargo-de-trek-voyage-travel-100-marron-homme'),
(167, 'pdt_67_6229f805d289b.webp', 'webp', 'short-cargo-de-trek-voyage-travel-100-gris-homme'),
(168, 'pdt_67_6229f80e13246.webp', 'webp', 'short-cargo-de-trek-voyage-travel-100-gris-homme'),
(169, 'pdt_67_6229f8140dfbf.webp', 'webp', 'short-cargo-de-trek-voyage-travel-100-gris-homme'),
(170, 'pdt_67_6229f81a38ff7.webp', 'webp', 'short-cargo-de-trek-voyage-travel-100-gris-homme'),
(171, 'pdt_68_6229f8b150d2b.webp', 'webp', 'short-hummel-poly-hmlaction'),
(172, 'pdt_68_6229f8b8451ee.webp', 'webp', 'short-hummel-poly-hmlaction'),
(173, 'pdt_68_6229f8bebbc6d.webp', 'webp', 'short-hummel-poly-hmlaction'),
(174, 'pdt_69_6229f95ab2be5.webp', 'webp', 'short-adidas-tastigo-19'),
(175, 'pdt_69_6229f963703e4.webp', 'webp', 'short-adidas-tastigo-19'),
(176, 'pdt_69_6229f96b79d7f.webp', 'webp', 'short-adidas-tastigo-19'),
(177, 'pdt_70_6229fd622071d.webp', 'webp', 'sousshort-de-protection-rugby-homme-r500-noir-jaune'),
(178, 'pdt_70_6229fd6a139a2.webp', 'webp', 'sousshort-de-protection-rugby-homme-r500-noir-jaune'),
(179, 'pdt_70_6229fd7182179.webp', 'webp', 'sousshort-de-protection-rugby-homme-r500-noir-jaune'),
(180, 'pdt_71_6229fdf9a92e9.webp', 'webp', 'short-puma-power-colorblock'),
(181, 'pdt_71_6229fe01714cb.webp', 'webp', 'short-puma-power-colorblock'),
(182, 'pdt_72_6229feb0a4af6.webp', 'webp', 'short-hummel-hmlhmlcore'),
(183, 'pdt_72_6229feba9f71e.webp', 'webp', 'short-hummel-hmlhmlcore'),
(184, 'pdt_72_6229fec13f93f.webp', 'webp', 'short-hummel-hmlhmlcore'),
(185, 'pdt_72_6229fec863662.webp', 'webp', 'short-hummel-hmlhmlcore'),
(186, 'pdt_73_622a0071b1bcc.webp', 'webp', 'baskets-flexibles-a-scratch-enfant-pw-540-jr-bleues-du-28-au-39'),
(187, 'pdt_73_622a007a15e28.webp', 'webp', 'baskets-flexibles-a-scratch-enfant-pw-540-jr-bleues-du-28-au-39'),
(188, 'pdt_73_622a0080c58f9.webp', 'webp', 'baskets-flexibles-a-scratch-enfant-pw-540-jr-bleues-du-28-au-39'),
(189, 'pdt_73_622a0087e8f3e.webp', 'webp', 'baskets-flexibles-a-scratch-enfant-pw-540-jr-bleues-du-28-au-39'),
(190, 'pdt_74_622a01a5b9972.webp', 'webp', 'baskets-resistantes-a-scratch-enfant-ts-130-jr-bleu-marine-du-26-au-38'),
(191, 'pdt_74_622a01ae240ed.webp', 'webp', 'baskets-resistantes-a-scratch-enfant-ts-130-jr-bleu-marine-du-26-au-38'),
(192, 'pdt_74_622a01b533ff0.webp', 'webp', 'baskets-resistantes-a-scratch-enfant-ts-130-jr-bleu-marine-du-26-au-38'),
(193, 'pdt_74_622a01bd0b064.webp', 'webp', 'baskets-resistantes-a-scratch-enfant-ts-130-jr-bleu-marine-du-26-au-38'),
(194, 'pdt_75_622a024ab2d39.webp', 'webp', 'chaussures-de-marche-enfant-kappa-seattle-lacets-noir'),
(195, 'pdt_76_622a035455e90.webp', 'webp', 'chaussures-de-running-enfant-adidas-tensaur'),
(196, 'pdt_76_622a035dd128c.webp', 'webp', 'chaussures-de-running-enfant-adidas-tensaur'),
(197, 'pdt_76_622a036404b6d.webp', 'webp', 'chaussures-de-running-enfant-adidas-tensaur'),
(198, 'pdt_77_622a03f22653c.webp', 'webp', 'chaussures-de-basketball-pour-garcon-fille-ss500m-violet-nba-los-angeles-lakers'),
(199, 'pdt_77_622a03fc8a6ab.webp', 'webp', 'chaussures-de-basketball-pour-garcon-fille-ss500m-violet-nba-los-angeles-lakers'),
(200, 'pdt_77_622a040549117.webp', 'webp', 'chaussures-de-basketball-pour-garcon-fille-ss500m-violet-nba-los-angeles-lakers'),
(201, 'pdt_77_622a040ba7a81.webp', 'webp', 'chaussures-de-basketball-pour-garcon-fille-ss500m-violet-nba-los-angeles-lakers'),
(202, 'pdt_78_622a0a584f6fa.webp', 'webp', 'baskets-resistantes-a-scratch-enfant-ts-130-jr-roses-du-26-au-38'),
(203, 'pdt_78_622a0a621dc8b.webp', 'webp', 'baskets-resistantes-a-scratch-enfant-ts-130-jr-roses-du-26-au-38'),
(204, 'pdt_78_622a0a6991a10.webp', 'webp', 'baskets-resistantes-a-scratch-enfant-ts-130-jr-roses-du-26-au-38'),
(205, 'pdt_79_622a0b115bb83.webp', 'webp', 'chaussures-running-&amp;-athletisme-enfant-kiprun-grip-grises-et-noires-oranges-fluo'),
(206, 'pdt_79_622a0b199953e.webp', 'webp', 'chaussures-running-&amp;-athletisme-enfant-kiprun-grip-grises-et-noires-oranges-fluo'),
(207, 'pdt_79_622a0b23d6834.webp', 'webp', 'chaussures-running-&amp;-athletisme-enfant-kiprun-grip-grises-et-noires-oranges-fluo'),
(208, 'pdt_80_622a0ba0bebb4.webp', 'webp', 'chaussures-athletisme-enfant-eq21-bleu-orange'),
(209, 'pdt_80_622a0ba8ebab1.webp', 'webp', 'chaussures-athletisme-enfant-eq21-bleu-orange'),
(210, 'pdt_80_622a0bafeef05.webp', 'webp', 'chaussures-athletisme-enfant-eq21-bleu-orange'),
(211, 'pdt_81_622a0c4787043.webp', 'webp', 'chaussures-de-running-enfant-adidas-runfalcon-2.0'),
(212, 'pdt_81_622a0c53b0fb2.webp', 'webp', 'chaussures-de-running-enfant-adidas-runfalcon-2.0'),
(213, 'pdt_81_622a0c5b198bb.webp', 'webp', 'chaussures-de-running-enfant-adidas-runfalcon-2.0'),
(214, 'pdt_82_622a0cdc66a92.webp', 'webp', 'chaussures-de-basketball-easy-pour-garcon-fille-debutant(e)-se100-noir-rouge'),
(215, 'pdt_82_622a0ce4ec57a.webp', 'webp', 'chaussures-de-basketball-easy-pour-garcon-fille-debutant(e)-se100-noir-rouge'),
(216, 'pdt_82_622a0cecc93bd.webp', 'webp', 'chaussures-de-basketball-easy-pour-garcon-fille-debutant(e)-se100-noir-rouge'),
(217, 'pdt_83_622a0d64608e6.webp', 'webp', 'chaussures-de-tennis-enfant-japan-s-jr-blanc'),
(218, 'pdt_83_622a0d6c88d06.webp', 'webp', 'chaussures-de-tennis-enfant-japan-s-jr-blanc'),
(219, 'pdt_83_622a0d7706fa9.webp', 'webp', 'chaussures-de-tennis-enfant-japan-s-jr-blanc');

-- --------------------------------------------------------

--
-- Structure de la table `ec_newsletters`
--

DROP TABLE IF EXISTS `ec_newsletters`;
CREATE TABLE IF NOT EXISTS `ec_newsletters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `news_adress_mail` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `ec_newsletters`
--

INSERT INTO `ec_newsletters` (`id`, `news_adress_mail`) VALUES
(1, 'jenniferla@pute.bite'),
(2, 'jenniferla@pute.bite'),
(3, 'jenniferla@pute.bite'),
(4, 'jenniferla@pute.bite');

-- --------------------------------------------------------

--
-- Structure de la table `ec_products`
--

DROP TABLE IF EXISTS `ec_products`;
CREATE TABLE IF NOT EXISTS `ec_products` (
  `pdt_id` int(11) NOT NULL AUTO_INCREMENT,
  `pdt_title` varchar(200) NOT NULL,
  `pdt_price` float NOT NULL,
  `pdt_activated` tinyint(1) NOT NULL,
  `pdt_option` varchar(250) DEFAULT NULL,
  `pdt_discount` int(11) DEFAULT NULL,
  `pdt_slug` varchar(200) DEFAULT NULL,
  `pdt_tagname` varchar(1000) DEFAULT NULL,
  `pdt_short_description` text,
  `pdt_long_description` text,
  `pdt_meta_title` varchar(1000) DEFAULT NULL,
  `pdt_meta_description` varchar(1000) DEFAULT NULL,
  `col_id` int(11) NOT NULL,
  PRIMARY KEY (`pdt_id`),
  KEY `ec_products_ec_collection_FK` (`col_id`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `ec_products`
--

INSERT INTO `ec_products` (`pdt_id`, `pdt_title`, `pdt_price`, `pdt_activated`, `pdt_option`, `pdt_discount`, `pdt_slug`, `pdt_tagname`, `pdt_short_description`, `pdt_long_description`, `pdt_meta_title`, `pdt_meta_description`, `col_id`) VALUES
(29, 'CIRÉ IMPERMÉABLE DE VOILE FEMME 500 BLEU', 55, 1, '36,38,40,42,44,46,48,52', 36, 'cire-impermeable-de-voile-femme-500-bleu', NULL, NULL, 'IMPERMEABILITE\r\n- Membrane 2 couches\r\n- >5000 mm de pression d\'eau après 5 lavages\r\n- Coutures 100% étanches.\r\n- Capuche réglable en 2 dimensions.\r\n- Bas de manches ajustables par bandes auto-agrippantes.\r\n- Ouverture centrale avec sous patte à gouttière pour une imperméabilité optimale.\r\n\r\nRESPIRABILITE\r\nRET<12 : très respirant.\r\nDoublure Nylon/mesh pour optimiser l\'évacuation de la transpiration.\r\n\r\nPour savoir si un tissu est respirant, on mesure sa résistance évaporative, appelée RET (test basé sur la norme ISO 11092). C’est sa capacité à laisser s’échapper vers l’extérieur la vapeur d’eau produite par le corps pendant l’effort.\r\n\r\nCONFORT\r\n- Taille ajustable, intégré dans les poches.\r\n- Fermeture à glissière double curseur.\r\n\r\nRÉSISTANCE A L\'USURE\r\n- Traitement stoppant le phénomène d\'oxydation des membranes.\r\n- Fermeture à glissière résistant à l\'oxydation du sel\r\n\r\nUne note pour comparer l\'impact environnemental des produits\r\nLes impacts environnementaux du produit sont calculés sur l\'ensemble de son cycle de vie et avec différents indicateurs. Une note globale ABCDE est réalisée pour vous aider à identifier facilement les produits avec la meilleure performance environnementale en comparant les produits d\'un même type entre eux (T-shirts, pantalons, sacs à dos, ...). Decathlon est un acteur volontaire de cette démarche d\'affichage environnemental. Pour plus d\'infos: http://sustainability.decathlon.com/\r\n\r\nCOMMENT RÉACTIVER LA DÉPERLANCE DE SA VESTE? étape 1 : avant le lavage\r\nFermez tous les zips et les rabats et enlevez les éventuelles parties du vêtement qui ne se lavent pas. Pensez également à bien desserrer les sangles et les parties élastiques et à vider les poches.\r\nRetournez ensuite le vêtement pour le laver à l’envers.\r\n\r\nCOMMENT RÉACTIVER LA DÉPERLANCE DE SA VESTE? étape 2 : le lavage\r\nVous pouvez laver votre veste avec un programme synthétique à 30°ou 40°C avec votre lessive habituelle. N’utilisez pas d’assouplissant qui pourrait endommager les performances d’origines du vêtement, ni bien entendu de javel.\r\n\r\nVeillez également à ne pas trop plier votre veste lorsque vous la placez dans le lave-linge et à limiter le chargement de votre machine.\r\n\r\nTrès important : sélectionnez un rinçage abondant ou effectuez un double rinçage afin de supprimer totalement les résidus de lessive.\r\n\r\nCOMMENT RÉACTIVER LA DÉPERLANCE DE SA VESTE? étape 3 : le séchage\r\nSi malgré cette opération de lavage et rinçage abondant puis séchage en sèche-linge doux les gouttes d’eau ne ruissellent plus à la surface de votre veste, nous vous conseillons de la « réimperméabiliser » avec un spray.', 'Ciré imperméable de voile femme 500 TRIBORD | Ecommerce.net', 'Ciré imperméable de voile femme 500 au prix de ★ 35€ ★ sur Ecommerce.net. Conçu pour la navigatrice en croisière régulière (moins de 15 jours de par an), par tous les temps.', 18),
(30, 'SOFTSHELL COUPE VENT DE TREK MONTAGNE - MT500 WINDWARM NOIR FEMME', 50, 1, 'XS,S,M,L,XL,2XL', 0, 'softshell-coupe-vent-de-trek-montagne---mt500-windwarm-noir-femme', NULL, NULL, 'Quelle est la coupe de cette veste softshell?\r\nCoupe assez proche du corps. Volume intérieur permettant de porter cette veste en association avec un vêtement 2ème couche fine du type polaire.\r\n\r\nRespirabilité\r\nLe tissu principal présent sur toute la veste sauf les côtés, est doté d\'une membrane coupe vent dont la respirabilité est de 2814 g/m2 /24 h (selon la norme JIS 1099 A).\r\n\r\nFonctionnalités\r\n2 poches mains.\r\nRéglage bas de veste par cordon élastique + tankas.\r\nManchons lycra + passe-pouce en bouts de manches pour éviter toute déperditions de chaleur.\r\n\r\nConfort thermique et Coupe-vent\r\nLe vent augmente considérablement la sensation de froid.\r\nAinsi pour une température extérieure de 0°, avec 20km/h de vent la température perçue sera de -10°.\r\nLes composants dits «coupe-vent» permettent de supprimer l\'inconfort lié à ce \"freezing effect\". En constituant une barrière contre le vent ils réduisent très efficacement la déperdition de chaleur.\r\nCette veste Softshell Trek 500 est Confortable jusque 10°C en dynamique, portée en couche 2.\r\n\r\nDéperlance du composant (à ne surtout pas confondre avec imperméabilité)\r\nLa déperlance d’un tissu c’est sa capacité à laisser glisser l’eau sur sa surface, sans l’absorber. Ainsi le textile ne se gorge pas d’eau et reste léger et chaud. La déperlance s’obtient par un traitement appliqué sur la face externe du tissu. Ce traitement a besoin d’être renouvelé au cours de la durée de vie du vêtement (nous conseillons à chaque lavage). Des produits sont proposés à cet effet dans nos magasins.Toutes les Softshells Quechua bénéficient d’un traitement déperlant.\r\n\r\nLAVAGE, REACTIVATION DE DEPERLANCE: COMMENT ENTRETENIR MA VESTE SOFTSHELL?\r\nAvec le temps, les lavages, l\'usure, le traitement déperlant est moins performant. Trouvez tous nos conseils de lavage et de réactivation de déperlance ici:\r\nhttps://www.forclaz.fr/comment-entretenir-et-reparer-une-veste-impermeable\r\n\r\nUne note pour comparer l\'impact environnemental des produits\r\nLes impacts environnementaux du produit sont calculés sur l\'ensemble de son cycle de vie et avec différents indicateurs. Une note globale ABCDE est réalisée pour vous aider à identifier facilement les produits avec la meilleure performance environnementale en comparant les produits d\'un même type entre eux (T-shirts, pantalons, sacs à dos, ...).\r\nDecathlon est un acteur volontaire de cette démarche d\'affichage environnemental.\r\nPour plus d\'infos: http://sustainability.decathlon.com/', 'Softshell coupe vent de trek montagne - MT500 WINDWARM femme FORCLAZ | Ecommerce.net', 'Softshell coupe vent de trek montagne - MT500 WINDWARM femme au prix de ★ 50€ ★ sur Ecommerce.net. Passionnés de trekking montagne nos concepteurs ont pensé cette veste softshell pour vous permettre de faire face à des conditions météo changeantes', 18),
(31, 'VESTE IMPERMÉABLE DE RANDONNÉE MONTAGNE - MH100 - FEMME', 35, 1, 'XS,S,M,L,XL,2XL', 0, 'veste-impermeable-de-randonnee-montagne-mh100-femme', NULL, NULL, 'COUPE\r\nCette veste a une coupe s\'adaptant à toutes les silhouettes, tout en étant féminine. Une couche chaude, telle qu\'une polaire ou un pull léger peut être portée dessous. Une doublure intérieure permet également d\'offrir plus de confort.\r\nVous pouvez choisir votre taille habituelle, ou une taille au-dessus si vous ne souhaitez pas la porter cintrée.\r\n\r\nCAPUCHE\r\nLa capuche est amovible grâce à des boutons pression. Elle peut être ajustée en hauteur grâce à un cordon élastiqué, et réglée en profondeur grâce à une patte scratchée et située à l\'arrière de la capuche.\r\n\r\nCONSTRUCTION DE LA VESTE\r\nCette veste est construite avec 2 couches enduites, dont une doublure en mesh (doublure à large maille).\r\n\"2 couches\" signifie qu\'il y a le tissu extérieur et la doublure.\r\nUne enduction est appliquée à l\'intérieur du tissu, elle s\'apparente à une résine qui rend le composant imperméable, tout en restant respirant. La doublure intérieure de la veste a pour rôle de protéger cette enduction.\r\n\r\nTEST DE L\'IMPERMEABILITE\r\nL’imperméabilité est mesurée par la résistance d’un tissu à une pression d\'eau exprimée en mm de colonne d\'eau (test basé sur la norme ISO 811).\r\nPlus la pression est élevée, plus le tissu est imperméable.\r\nLe composant de ce produit a une imperméabilité de 5 000 mm et résiste donc à la pression exercée par 5 000 mm de colonne d\'eau.\r\nC\'est aussi équivalent à 5 000 Schmerbers.\r\n\r\nTEST DE LA RESPIRABILITE\r\nLa respirabilité d’un composant se mesure par sa “Résistance Évaporative Thermique” (RET).\r\nIl s\'agit de sa capacité à laisser échapper la vapeur d’eau produite par le corps pendant l’effort vers l’extérieur et ainsi éviter l’accumulation d’eau sur la peau.\r\nPlus la valeur de RET est faible, plus le tissu est respirant.\r\n\r\nRET ≤ 6: tissu très respirant\r\nRET ≤ 12: tissu respirant\r\nRET ≤ 20: tissu peu respirant\r\n\r\nNotre produit a une RET de 12.\r\n\r\nCOMMENT REACTIVER LA DEPERLANCE DE MA VESTE ?\r\nLa déperlance d’un tissu est sa capacité à laisser glisser l’eau sur sa surface, sans l’absorber. Ainsi, votre veste ne se gorge pas d’eau et reste légère et respirante. La déperlance est obtenue par un traitement appliqué sur la face externe du tissu, mais à l’usage ces propriétés peuvent être altérées.\r\n\r\nNOTRE ENGAGEMENT POUR CONSOMMER MOINS D\'EAU AVEC CE PRODUIT\r\nLa teinture des textiles nécessite beaucoup d\'eau mais rejette également des eaux usées issues des bains de teinture. Pour réduire notre impact sur l\'environnement, nous choisissons cette méthode de teinture dans la masse pour la veste de couleur noire (uniquement), en intégrant les pigments de couleurs dès la fabrication du fil.\r\n\r\nLA CONCEPTION DE PRODUITS : NOTRE SAVOIR-FAIRE\r\nNotre centre mondial de conception Quechua est basé à Passy, au pied du Mont-Blanc en Haute Savoie.\r\nCette localisation en fait un véritable lieu de rencontre entre nos équipes (designers, chefs de produit, ingénieurs...) et les pratiquants de sports outdoor.\r\nUn bel atout pour concevoir vos produits de randonnée montagne, et vous apporter toute notre expertise.', 'Veste imperméable de randonnée montagne - MH100 - Femme QUECHUA | Ecommerce.net', 'Veste imperméable de randonnée montagne - MH100 - Femme au prix de ★ 35€ ★ sur Ecommerce.net. Au pied du Mont Blanc, notre équipe de randonneuses a conçu cette veste imperméable, à prix accessible, pour les randonneuses occasionnelles', 18),
(32, 'VESTE FRANCE - COLLECTION OFFICIELLE ALLEZ LES BLEUS - FEMME', 54.99, 1, 'S,M,L,XL', 0, 'veste-france-collection-officielle-allez-les-bleus-femme', NULL, NULL, 'Veste FRANCE , Allez Les BleuEs. Femme.\r\nCollection officielle ALLEZ LES BLEUS. FRANCE.\r\nLa seule collection 100% féminine, 100% Officielle! Equipez vous et supportez les Filles qui défendront les couleurs de la France dans les compétitions Européennes et Mondiales !\r\nLa marque ALLEZ LES BLEUS appartient au Comité National Olympique et Sportif Français (CNOSF).\r\nVeste femme. 285 grs avec découpe horizontale tricolore. Signé d\'un marquage France\" et \"ALLEZ LES BLEUES\" en print relief haute densité. Matière 60% coton 40% polyester.\"', 'Veste France - Collection officielle ALLEZ LES BLEUS - Femme ALLEZ LES BLEUS ! | Ecommerce.net', 'Veste France - Collection officielle ALLEZ LES BLEUS - Femme au prix de ★ 54.99€ ★ sur Ecommerce.net. Veste FRANCE , Allez Les BleuEs. Femme.', 18),
(33, 'DOUDOUNE SANS MANCHE EN DUVET DE TREK MONTAGNE - MT 100 - NOIRE - FEMME', 40, 1, 'XS,S,M,L,XL,2XL', 0, 'doudoune-sans-manche-en-duvet-de-trek-montagne-mt-100-noire-femme', NULL, NULL, 'Que signifie la certification RDS ?\r\nRDS ou “Responsible Down Standard” est une certification mondiale délivrée par un organisme indépendant auprès de marques volontaires.\r\n\r\nCette norme nous permet de garantir la provenance des plumes en accord avec nos engagements sur les matériaux responsables. Nos fournisseurs s\'engagent à utiliser uniquement des plumes d\'oies et de canards élevés pour leur viande et abattus avant la collecte du duvet et de plumes.\r\nPour en savoir plus : https://www.forclaz.fr/quest-ce-que-la-certification-rds\r\n\r\nPouvoir Gonflant du garnissage duvet/plumes\r\nPour ce gilet garni en 85% duvet / 15% plumes, le pouvoir gonflant est garanti à 800 CUIN (norme européenne). Le pouvoir gonflant représente la capacité d’isolation thermique du duvet, par l\' «emprisonnement » d\'un certain volume d\'air. Donc plus le duvet est gonflant (+ le nombre de CUIN est élevé), plus il occupe de l’espace, plus il emprisonne l’air et donc plus il isole.\r\n\r\nQuels sont les avantages d\'un garnissage en duvet et plumes de canards?\r\nLa capacité gonflante et durable du duvet lui confère 3 qualités pour la randonnée:\r\n- Isolation thermique grâce à l\'air emprisonné dans le duvet et les plumes\r\n- Ultra légèreté: à chaleur égale la plume est plus légère qu\'une ouate synthétique. Cela permet de gagner encore du poids dans le sac à dos\r\n- Ultra compressibilité\r\n\r\nEn cas de pluie\r\nLa matière de cette doudoune est déperlante.\r\nElle permet aux gouttes d\'eau de rouler sur le tissu, ce qui retarde la pénétration de l\'eau dans la doudoune, le temps de vous mettre à l\'abri.\r\n\r\nNous vous conseillons néanmoins de porter une veste imperméable au dessus de la doudoune en cas d\'exposition prolongée à la pluie.\r\n\r\nComment laver ma doudoune en plume?\r\nDe manière générale, il est déconseillé de laver une doudoune trop fréquemment.\r\nVoici quelques conseils: fermez tous les zips de votre doudoune puis direction le lave-linge, programme synthétique 30°.\r\nAfin de conserver le gonflant et la chaleur, c\'est encore mieux d\' ajouter 2 balles de tennis dans la machine\r\nAttention à régler sur un essorage doux : un essorage trop fort risque de créer des boules de plumes difficiles à défaire.\r\n\r\nComment faire sécher ma doudoune en duvet?\r\nEn sortant votre doudoune du lave-linge vous aurez l\'impression que le duvet a disparu. Le sèche linge est le meilleur moyen de redonner du gonflant aux plumes. Mettez y votre doudoune avec 2 balles de tennis. C\'est parti pour 2 - 3 cycles de séchage.\r\nSi vous n\'avez pas de sèche linge, vous pouvez faire sécher votre doudoune sur un étendoir en la retournant et tapotant régulièrement.\r\nPour plus de conseils, c\'est par ici!\r\nhttps://www.forclaz.fr/comment-entretenir-et-reparer-une-doudoune-en-plumes\r\n\r\nComment ré-activer la déperlance ?\r\nAvec le temps, les lavages, l\'usure, le traitement déperlant est moins performant.\r\nVoici comment ré-activer la déperlance de votre doudoune!\r\nhttps://www.forclaz.fr/comment-reactiver-la-deperlance-de-sa-veste\r\n\r\nVous pouvez également utiliser le produit d\'entretien : liquide réimperméabilisant textile :\r\nhttps://www.decathlon.fr/p/liquide-reimpermeabilisant-textile-250-ml/_/R-p-308192?mc=8554908\r\n\r\nPoids du garnissage\r\nXS : 53 gr\r\nS : 57 gr\r\nM : 63 gr\r\nL : 70 gr\r\nXL : 75 gr\r\n2XL : 81 gr\r\n\r\nVOTRE DOUDOUNE A UN ACCRO, COMMENT LA REPARER?\r\nEn trek, un accroc sur une doudoune ca peut arriver et la bonne nouvelle c\'est que ca peut se réparer ! En effet, vous pouvez soit la raccommoder, soit y appliquer un patch thermocollant, afin d\'éviter que la déchirure ne s\'agrandisse ou que les plumes/duvet ne s\'échappent.\r\nVous ne vous sentez pas à l\'aise pour réaliser vous-même cette réparation ? Pas de panique ! Nos ateliers Decathlon vous proposent, en magasin, un service de réparation pour vos doudounes.\r\n\r\nUne note pour comparer l\'impact environnemental des produits\r\nLes impacts environnementaux du produit sont calculés sur l\'ensemble de son cycle de vie et avec différents indicateurs.\r\nUne note globale ABCDE est réalisée pour vous aider à identifier facilement les produits avec la meilleure performance environnementale en comparant les produits d\'un même type entre eux (T-shirts, pantalons, sacs à dos, ...).\r\nDecathlon est un acteur volontaire de cette démarche d\'affichage environnemental.\r\nPour plus d\'infos: http://sustainability.decathlon.com/', 'DOUDOUNE SANS MANCHE EN DUVET DE TREK MONTAGNE - MT 100 - NOIRE - FEMME FORCLAZ | Ecommerce.net', 'DOUDOUNE SANS MANCHE EN DUVET DE TREK MONTAGNE - MT 100 - NOIRE - FEMME au prix de ★ 40€ ★ sur Ecommerce.net. Notre équipe, passionnée de Trekking en montagne, a développé ce gilet en duvet et plumes certifiés RDS pour vous permettre de trekker par temps frais.', 18),
(34, 'VESTE IMPERMÉABLE DE RANDONNÉE - RAINCUT - FEMME', 10, 1, '2XS/XS,S/M,L/XL,2XL/3XL', 0, 'veste-impermeable-de-randonnee-raincut-femme', NULL, NULL, 'Notre engagement pour consommer moins d\'eau avec ce produit\r\nLa teinture des textiles nécessite beaucoup d\'eau et rejete également des eaux usées issues des bains de teinture. Pour réduire notre impact sur l\'environnement, nous choisissons cette méthode de teinture dans la masse, en intégrant les pigments de couleurs dès la fabrication du fil.\r\n\r\nDéperlance sans perfluorocarbure\r\nLe tissu de cette veste est déperlant: il laisse glisser l’eau sur sa surface sans l’absorber. Ainsi le textile ne se gorge pas d’eau et reste léger et respirant. La déperlance s’obtient par un traitement appliqué sur la face externe du tissu.\r\nNous avons entamé une démarche de traitement déperlant sans perfluorocarbure. Ainsi, au fil de l\'année 2022, ce modèle sera commercialisé avec un traitement déperlant plus respectueux de l\'environnement.\r\n\r\nDurabilité des performances de votre veste\r\nPour une déperlance durable du tissu, nous vous conseillons de la réactiver régulièrement.\r\nVous pouvez le faire tous les trois lavages (un rinçage abondant est capital), ou après une dizaine d\'utilisations sous la pluie.\r\nVous pouvez facilement réactiver la déperlance, à chaud :\r\n- avec votre sèche linge pendant 15 minutes (programme synthétique) - avec un sèche cheveu à 20 cm de distance en faisant 2 allers retours\r\n- ou 2 passages avec le fer à repasser, réglé sur délicat sans fonction vapeur.\r\n\r\nImperméabilité du tissu\r\nLe tissu de cette veste a une imperméabilité de 2000 mm.\r\nOn mesure la résistance d’un tissu à une pression d\'eau exprimée en mm de colonne d\'eau (test basé sur la norme ISO 811). Plus la pression est élevée, plus le tissu est imperméable. Un composant ayant une imperméabilité de 2000 mm résiste donc à la pression exercée par 2000 mm d\'eau.\r\n\r\nRespirabilité du tissu\r\nLe tissu de cette veste est respirant : RET=12.\r\nPour savoir si un tissu est respirant, on mesure son coefficient de Resistance Evaporative Thermique (RET) lors d\'un test basé sur la norme ISO 11092. Plus la résistance est faible, plus le tissu laisse s’échapper la vapeur d\'eau générée par le corps en activité et est respirant.\r\n- RET < 9 = tissu extrêmement respirant\r\n- 9 < RET < 12 = tissu très respirant\r\n- 12 < RET < 20 = tissu respirant\r\n- RET > 20 = tissu peu ou pas res\r\n\r\nChoisir sa veste imperméable en fonction de son effort sportif\r\nCe coupe-pluie est conçu pour une randonnée de 2h à un rythme de 5 km/h max, sans dénivelé.\r\nLors d\'un effort sportif, on transpire plus ou moins selon l\'intensité ou la longueur de l\'effort. Si la respirabilité du tissu n\'est pas adaptée à l\'effort, la vapeur de transpiration condense à l\'intérieur de la veste. On est mouillé à l\'intérieur : ce n\'est pas la pluie qui transperce, mais la vapeur de transpiration qui condense. Il faut choisir sa veste coupe-pluie en fonction de son type d\'effort.\r\n\r\nProduits complémentaires conseillés\r\nNous vous conseillons le surpantalon Raincut imperméable pour protéger également le bas de votre corps. Ainsi, vous disposerez d\'un ensemble de protection complet très efficace contre le vent et les averses.\r\nEt surtout : le surpantalon bénéficie également d\'une démarche d\'éco-conception, avec le procédé de teinture dans la masse.\r\n\r\nGarantie\r\n2 ans', 'Veste imperméable de randonnée - Raincut - Femme QUECHUA | Ecommerce.net', 'Veste imperméable de randonnée - Raincut - Femme au prix de ★ 10€ ★ sur Ecommerce.net. Nos concepteurs randonneurs ont éco-conçu cette veste Raincut imperméable, pour vos randonnée occasionnelles par temps de pluie.', 18),
(35, 'VESTE IMPERMÉABLE DE RANDONNÉE MONTAGNE - MH500 - FEMME', 80, 1, 'XS,S,M,L,XL', 0, 'veste-impermeable-de-randonnee-montagne-mh500-femme', NULL, NULL, 'COUPE\r\nCette veste a une coupe cintrée. Le tissu composé à 13% d\'élasthane et les manches dites \"raglan\" remontant jusqu\'à l\'encolure permettent une meilleure extensibilité et libèrent davantage vos mouvements durant votre randonnée.\r\nUne couche chaude, telle qu\'une polaire ou une doudoune légère peut être portée dessous.\r\nVous pouvez choisir votre taille habituelle, ou une taille au-dessus si vous ne souhaitez pas la porter cintrée.\r\n\r\nCAPUCHE\r\nLa capuche est attenante, ajustable en hauteur et en profondeur grâce à un cordon élastiqué. La visière rigide vous offre un maximum de protection au niveau du visage.\r\nLe petit détail qui fait la différence: une ouverture triangulaire sur le côté de la capuche pour une meilleure visibilité sur les côtés.\r\n\r\nCONSTRUCTION DE LA VESTE / 3 COUCHES\r\nCette veste est construite avec 3 couches, la meilleure protection existant sur le marché: la membrane est collée entre la couche intérieure et la couche extérieure du composant (d\'où l’appellation de composant 3 couches).\r\nLa membrane est une sorte de film en Polyuréthane très fin, qui rend le composant imperméable, tout en restant respirant.\r\nElle est protégée par un tricot, et a l\'avantage d\'être plus souple, plus légère, plus durable et souvent plus respirante qu\'une enduction.\r\n\r\nCOMMENT ENTRETENIR MA VESTE ?\r\nCette veste possède des bandes étanchées (pour garantir une parfaite imperméabilité) qui sont sensibles au lavage en machine et peuvent se décoller avec le temps. Nous recommandons donc de privilégier une éponge avec de l\'eau pour nettoyer d\'éventuelles traces sur votre veste, et de ne la laver que très rarement en machine à 30°C, si vous souhaitez qu\'elle vous accompagne le plus longtemps possible en randonnée.\r\n\r\nTEST DE L\'IMPERMEABILITE\r\nL’imperméabilité est mesurée par la résistance d’un tissu à une pression d\'eau exprimée en mm de colonne d\'eau (test basé sur la norme ISO 811).\r\nPlus la pression est élevée, plus le tissu est imperméable.\r\nLe composant de ce produit a une imperméabilité de 15 000 mm et résiste donc à la pression exercée par 15 000 mm de colonne d\'eau.\r\nC\'est aussi équivalent à 15 000 Schmerbers.\r\n\r\nTEST DE LA RESPIRABILITE\r\nLa respirabilité d’un composant se mesure par sa “Résistance Évaporative Thermique” (RET).\r\nIl s\'agit de sa capacité à laisser échapper la vapeur d’eau produite par le corps pendant l’effort vers l’extérieur et ainsi éviter l’accumulation d’eau sur la peau.\r\nPlus la valeur de RET est faible, plus le tissu est respirant.\r\n\r\nRET ≤ 6: tissu très respirant\r\nRET ≤ 12: tissu respirant\r\nRET ≤ 20: tissu peu respirant\r\n\r\nNotre produit a une RET de 6.\r\n\r\nLA CONCEPTION DE PRODUITS : NOTRE SAVOIR-FAIRE\r\nNotre centre mondial de conception Quechua est basé à Passy, au pied du Mont-Blanc en Haute Savoie.\r\nCette localisation en fait un véritable lieu de rencontre entre nos équipes (designers, chefs de produit, ingénieurs...) et les pratiquants de sports outdoor.\r\nUn bel atout pour concevoir vos produits de randonnée montagne, et vous apporter toute notre expertise.\r\n\r\nCOMMENT REACTIVER LA DEPERLANCE DE MA VESTE ?\r\nLa déperlance d’un tissu est sa capacité à laisser glisser l’eau sur sa surface, sans l’absorber. Ainsi, votre veste ne se gorge pas d’eau et reste légère et respirante. La déperlance est obtenue par un traitement appliqué sur la face externe du tissu, mais à l’usage ces propriétés peuvent être altérées.\r\n\r\nToutes les étapes pour réactiver la déperlance sont décrites ci-dessous:\r\nhttps://conseilsport.decathlon.fr/conseils/comment-reactiver-la-deperlance-de-sa-veste-tp_22965\r\n\r\nPRODUIT COMPLÉMENTAIRE CONSEILLE\r\nLe surpantalon MH500, pour protéger également le bas du corps et disposer ainsi d\'un ensemble complet et efficace de protection contre la pluie lors de vos sorties en montagne.\r\n\r\nNOTRE DEMARCHE ENVIRONNEMENTALE\r\nParce que nous avons conscience qu\'il faut agir pour préserver notre terrain de jeu, Quechua s\'engage pour limiter l\'impact environnemental de ses produits. Grâce à un composant plus technique, nos vestes MH500 sont plus légères, réduisant en moyenne leurs émissions de CO2 de 28%.\r\nCe n\'est pas encore suffisant, c\'est pourquoi nous travaillons pour que cette veste soit un jour 100% éco-conçue.\r\n\r\nGarantie\r\n2 ans', 'Veste imperméable de randonnée montagne - MH500 - Femme QUECHUA | Decathlon', 'Veste imperméable de randonnée montagne - MH500 - Femme au prix de ★ 80€ ★ sur Decathlon.fr. Au pied du Mont Blanc, notre équipe de randonneuses a éco-conçu cette veste pour les randonneuses régulières, prêtes à affronter les intempéries en montagne !', 18),
(36, 'VESTE IMPERMÉABLE DE RANDONNÉE - NH500 - FEMME', 30, 1, 'XS,S,M,L,XL', 0, 'veste-impermeable-de-randonnee-nh500-femme', NULL, NULL, 'Notre engagement pour consommer moins d\'eau avec ce produit\r\nLa teinture des textiles nécessite beaucoup d\'eau et rejete également des eaux usées issues des bains de teinture. Pour réduire notre impact sur l\'environnement, nous choisissons cette méthode de teinture dans la masse, en intégrant les pigments de couleurs dès la fabrication du fil.\r\n\r\nPolyester recyclé\r\nEn recyclant des bouteilles en plastique ou des textiles usagés pour produire notre polyester, nous diminuons l\'utilisation des ressources issues du pétrole tout en préservant les qualités et les performances de la matière pour vos randonnées.\r\n\r\nRespirabilité du tissu\r\nLe tissu de cette veste est respirant : RET=12.\r\nPour savoir si un tissu est respirant, on mesure son coefficient de Resistance Evaporative Thermique (RET) lors d\'un test basé sur la norme ISO 11092. Plus la résistance est faible, plus le tissu laisse s’échapper la vapeur d\'eau générée par le corps en activité et est respirant.\r\n- RET < 9 = tissu extrêmement respirant\r\n- 9 < RET < 12 = tissu très respirant\r\n- 12 < RET < 20 = tissu respirant\r\n- RET > 20 = tissu peu ou pas respirant\r\n\r\nDurabilité des performances de votre veste\r\nPour une déperlance durable du tissu, nous vous conseillons de la réactiver régulièrement.\r\nVous pouvez le faire tous les trois lavages (un rinçage abondant est capital), ou après une dizaine d\'utilisations sous la pluie.\r\nVous pouvez facilement réactiver la déperlance, à chaud :\r\n- avec votre sèche linge pendant 15 minutes (programme synthétique) - avec un sèche cheveu à 20 cm de distance en faisant 2 allers retours\r\n- ou 2 passages avec le fer à repasser, réglé sur délicat sans fonction vapeur.\r\n\r\nChoisir sa veste imperméable en fonction de son effort sportif\r\nCette veste est conçue pour une randonnée à la journée à un rythme de 5 km/h, sans dénivelé.\r\nLors d\'un effort sportif, on transpire plus ou moins selon l\'intensité ou la longueur de l\'effort. Si la respirabilité du tissu n\'est pas adaptée à l\'effort, la vapeur de transpiration condense à l\'intérieur de la veste. On est mouillé à l\'intérieur : ce n\'est pas la pluie qui transperce, mais la vapeur de transpiration qui condense. Il faut choisir sa veste imperméable en fonction de son type d\'effort.\r\n\r\nProduits complémentaires conseillés\r\nNous vous conseillons le surpantalon Raincut imperméable pour protéger également le bas de votre corps. Ainsi, vous disposerez d\'un ensemble de protection complet très efficace contre le vent et les averses.\r\nEt surtout : le surpantalon bénéficie également d\'une démarche d\'éco-conception, avec le procédé de teinture dans la masse.\r\n\r\nDisponible du (XS) au (3XL)\r\nNotre priorité ? Que nos vêtements de randonnée s\'adaptent à toutes les morphologies et toutes les silhouettes ! Pour que toutes celles et ceux qui le souhaitent puissent profiter des sentiers de randonnée en tout confort. C\'est pourquoi cette veste est disponible du (XS) au (3XL)\r\n\r\nGarantie\r\n2 ans', 'Veste imperméable de randonnée nature - NH500 Imper - Femme QUECHUA | Decathlon', 'Veste imperméable de randonnée nature - NH500 Imper - Femme au prix de ★ 30€ ★ sur Decathlon.fr. Nos concepteurs randonneurs ont éco-conçu cette veste NH500 imperméable, fabriquée en polyester recyclé pour vos randonnées à la journée par temps de pluie.', 18),
(37, 'VESTE FEMME HUMMEL HMLCIMA', 68.99, 1, 'XS,S,M,L,XL', 56, 'veste-femme-hummel-hmlcima', NULL, NULL, 'Veste femme zippée Hummel hmlcimaLe design élégant et épuré de la hmlCIMA ZIP JACKET WOMAN est à la fois fonctionnel et élégant, complétant n\'importe quel look. Créée dans un molleton pour une gestion optimale de l\'humidité, ainsi que des qualités respirantes et une durabilité accrue, cette veste hummel® dispose d\'une fermeture éclair à bout ouvert et facile à enfiler et à enlever avec un col montant pour plus de chaleur. Des poches zippées sur le côté et des chevrons et un logo imprimés emblématiques rehaussent un style classique.Molleton polyesterLogo imprimé haute densitéBande et chevrons imprimésPoches zippées et fermeture éclair sur toute la longueur', 'Veste femme Hummel hmlCIMA HUMMEL | Decathlon', 'Veste femme Hummel hmlCIMA au prix de ★ 29.99€ ★ sur Decathlon.fr. Cette veste de training femme se présente comme la seconde couche idéale pour vos sessions habituelles par temps frais, que vous évoluiez en salle ou à ciel ouvert.', 18),
(38, 'VESTE DE SKI 180 BLEUE MARINE', 50, 1, 'XS,S,M,L,XL', 0, 'veste-de-ski-180-bleue-marine', NULL, NULL, 'Quel garnissage garantit la chaleur de ma veste ?\r\nPour vous aider à vous maintenir au chaud, nous utilisons une isolation en ouate recyclée (60g/m² aux bras et 100g/m² au corps). Ce composant synthétique à base de polyester emmagasine, selon la taille de ses fibres, une quantité plus ou moins importante d’air, permettant de vous isoler du froid.\r\n\r\nQuels composants additionnés au garnissage permettent d\'avoir chaud ?\r\nEn complément du garnissage de votre veste, les zips imperméables, le col, le serrage du bas de veste et le réglage bas de manches permettent de vous isoler davantage du froid et de l\'humidité, pour une sensation de chaleur plus importante.\r\n\r\nVeste \"enduite\" : quels sont les avantages de l\'enduction ?\r\nL\'enduction consiste à étaler une matière imperméabilisante sur la face interne d’un tissu. Elle empêche la pénétration de l’eau dans le vêtement mais laisse s’échapper la vapeur d’eau produite par l’activité du corps. Vous restez ainsi au sec pour plus de confort pendant votre pratique sportive.\r\n\r\nComment est mesurée l\'imperméabilité de la veste ?\r\nOn mesure la résistance d’un tissu à une pression d\'eau exprimée en mm de colonne d\'eau (test basé sur la norme ISO 811). Plus la pression est élevée, plus le tissu est imperméable.Un composant ayant une imperméabilité de 5000mm résiste donc à la pression exercée par 5000mm d\'eau.\r\n\r\nQuels éléments de la veste me protègent des intempéries ?\r\nLa veste 150 a été développée avec un composant et un assemblage rigoureux qui bloquent le passage de l’eau et limitent la sensation du vent pour mieux vous aider à affronter les intempéries (pluie, neige, vent, etc.). Nous avons validé l\'étanchéité de ce produit en pratique lors de conditions météo différentes, plusieurs jours durant.\r\n\r\nÀ quoi sert la déperlance de ma veste ?\r\nLa déperlance d’un tissu est sa capacité à laisser glisser l’eau sur sa surface, sans l’absorber. Cette veste est équipée de composants déperlants qui prolongent sa résistance aux intempéries. La déperlance est obtenue par un traitement appliqué sur la face externe du tissu, mais à l\'usage ces propriétés peuvent être altérées.\r\n\r\nComment réactiver la déperlance de ma veste ?\r\nIl faut savoir que la déperlance est réactivable. Pour ce faire, passez la veste au sèche-linge sur programme synthétique, 10 à 15mn.\r\nVous pouvez aussi utiliser une bombe imperméable (vendue dans nos magasins) : pulvérisez le produit de manière homogène sur l\'ensemble du vêtement, puis laissez sécher 10h à 12h).\r\n\r\nQue signifie une veste \"respirante\" ?\r\nIl s\'agit d\'un produit capable de laisser s\'échapper la vapeur d’eau produite par votre corps durant l’effort. Pour savoir si un tissu est respirant, on mesure sa résistance-évaporative (RET) lors d\'un test normé ISO 11092. Plus la valeur de RET est faible, plus le tissu est respirant. La veste 150 a un RET de 7. Toutefois ce sont les solutions techniques (zips, aérations, mesh) que Wedze utilise, qui limitent la condensation à l’intérieur du vêtement et maximise la respirabilité.\r\n\r\nQuelle est la coupe de la veste 150 ?\r\nCoupe Regular. La veste a les flancs qui tombent droits et restent parallèles sans chercher à suivre les formes de votre buste. Le volume intérieur permet de porter cette veste en association avec une première et deuxième couche technique.\r\n\r\nComment s\'habiller pour rester au chaud sur les pistes ?\r\nPour rester bien au chaud et au sec, il suffit d\'appliquer la règle des 3 couches techniques :\r\n- La couche 1 ou seconde peau, pour rester au sec.\r\n- La couche 2 ou couche isolante, pour conserver la chaleur.\r\n- La couche 3 ou couche protectrice, pour protéger des intempéries.\r\n\r\nComment éviter les entrées de neige en cas de chute ?\r\nLe bas de veste réglable ainsi que le bas de manche élastiqué permettent d\'éviter les entrées de neige et les entrées d’air pendant la pratique et particulièrement en cas de chute.\r\n\r\nUne note pour comparer l\'impact environnemental des produits\r\nLes impacts environnementaux du produit sont calculés sur l\'ensemble de son cycle de vie et avec différents indicateurs. Une note globale ABCDE est réalisée pour vous aider à identifier facilement les produits avec la meilleure performance environnementale en comparant les produits d\'un même type entre eux (T-shirts, pantalons, sacs à dos, ...).\r\nDecathlon est un acteur volontaire de cette démarche d\'affichage environnemental.\r\nPour plus d\'infos: http://sustainability.decathlon.com/\r\n\r\nGarantie\r\n2 ans', 'VESTE DE SKI DE PISTE FEMME 180 GRISE WEDZE | Decathlon', 'VESTE DE SKI DE PISTE FEMME 180 GRISE au prix de ★ 50€ ★ sur Decathlon.fr. Chaude et confortable, cette veste fonctionnelle vous permettra de profiter du ski dans les meilleures conditions.', 18),
(39, 'VESTE IMPERMÉABLE COUPE-VENT DE VOILE FEMME SAILING 500 BLEU', 100, 1, 'XS,S,M,L,XL,2XL', 20, 'veste-impermeable-coupevent-de-voile-femme-sailing-500-bleu', NULL, NULL, 'Imperméabilité 1/2\r\nOn mesure la résistance d’un tissu à une pression d\'eau exprimée en mm de colonne d\'eau (test basé sur la norme ISO 811). Plus la pression est élevée, plus le tissu est imperméable.\r\nVoici les valeurs d\' imperméabilité :\r\nComposant résistant à une pression d\'eau de 5000mm après vieillissement (5 lavages). Cela équivaut à 5000 Schmerber - pression moyenne exercée par l\'eau lors d\'une averse.\r\nL\'imperméabilité de la veste a été testée sous une pluie de 100 litres d’eau / m² / heure pendant 3 heures.\r\n\r\nImperméabilité 2/2\r\n- Col haut doublé polaire\r\n- Fermeture à glissière en plastique injectée pour éviter l\'oxydation du sel\r\n- Composants déperlants (l\'eau ruisselle sur le tissu).\r\n- Coutures 100% étanchées.\r\n- Ouverture centrale avec sous patte à gouttière pour une imperméabilité optimale\r\n\r\nCapuche\r\nLa capuche ne se range pas dans le col, elle est attenante. De par son poids, elle ne bat pas au vent.\r\nCapuche entièrement réglable en hauteur et en profondeur.\r\nVisière avec bandeau pour apporter un haut niveau de protection et un meilleur maintien.\r\nLe col montant haut protège efficacement le bas du visage.\r\n\r\nPoches\r\n2 poches accessibles derrière les poches cargo, avec zip.\r\n2 poches cargo AIMANTEES sur le bas de veste pour y ranger VHF, raban, bonnet... Dans la poche de droite, petite poche intérieure pour y ranger son couteau ou démanilleur.\r\n1 poche extérieure sur la poitrine gauche pour y glisser son téléphone ou d\'autres éléments, fermée par un zip\r\n1 poche intérieure sur la poitrine droite pour y glisser son téléphone ou d\'autres éléments, fermée par un zip\r\nATTENTION : les poches ne sont PAS IMPERMEABLES\r\n\r\nFermeture éclair frontal\r\nUtilisation d\'un zip étanche YKK sur toute la longueur avec un rabat intérieur et une gouttière permettant de protéger du vent et de l\'eau.\r\nDouble curseur permettant une ouverture par le bas de la veste. Pour enclencher au mieux le double curseur d\'ouverture centrale, vérifier leur alignement.\r\nRabat en tissu doux en haut du col pour protéger le menton.\r\n\r\nProtection - manchons\r\n2 manchons par manche, recouvrant le poignet et réglable par scratch pour limiter les entrées d\'eau.\r\nLe premier manchon est dans un composant lisse et confortable pour éviter les entrées d\'eau et qu\'il soit confortable contre la peau. Réglage avec scratch.\r\nLe deuxième manchon peut-être mis par dessus un gant.\r\nPour désenfiler plus facilement la veste, bien l\'ouvrir au maximum\r\n\r\nRespirabilité du tissu\r\nPour savoir si un tissu est respirant, on mesure sa résistance évaporative RET (norme ISO 11092). Plus la résistance est faible, plus le tissu laisse s’échapper la vapeur d\'eau et donc plus le tissu est respirant.\r\nOn considère que si :\r\nRET < 9 = tissu très respirant\r\n9 < RET < 12 = tissu respirant.\r\nLe RET de la veste Sailing 500 est inférieur à 12.\r\n\r\nInformation déperlance\r\nLa déperlance d’un tissu, est sa capacité à laisser glisser l’eau sur sa surface sans l’absorber.\r\nAinsi, votre veste ne se gorge pas d’eau et reste légère et respirante. La déperlance est obtenue par un traitement appliqué sur la face externe du tissu, mais à l’usage ces propriétés peuvent être altérées.\r\nLa déperlance peut être réactivée en passant la veste au sèche linge 10 mn à basse température.\r\n\r\nComment laver sa veste ?\r\nPour préserver la déperlance nous vous conseillons de limiter les lavages.\r\nFermez tous les zips et les rabats, vider les poches et retournez ensuite le vêtement pour le laver à l’envers. Vous pouvez le laver avec un programme synthétique à 30°ou 40°C avec votre lessive habituelle. N’utilisez pas d’assouplissant qui pourrait endommager les performances d’origines du vêtement, ni bien entendu de javel. Très important : sélectionnez un rinçage abondant ou effectuez un double rinçage.\r\n\r\nComment réactiver la déperlance de sa veste ?\r\nLe séchage est une phase primordiale pour réactiver le traitement déperlant.\r\nNous conseillons de laisser sécher complètement votre veste à l’air libre et à plat sur un étendoir. Attention ne séchez jamais votre veste directement sur un radiateur.\r\nPassez là ensuite au sèche-linge programme synthétique sur un temps court c’est-à-dire de 10 à 15 minutes avant de la remettre à l’endroit. Attention, il ne faut surtout pas sur-sécher le vêtement.\r\n\r\nGarantie\r\n2 ans', 'Veste imperméable coupe-vent de voile femme SAILING 500 Navy TRIBORD | Decathlon', 'Veste imperméable coupe-vent de voile femme SAILING 500 Navy au prix de ★ 80€ ★ sur Decathlon.fr. Nos concepteurs navigateurs ont développé cette veste pour vos navigations régulières, toute l\'année et par tous les temps.', 18),
(40, 'PANTALON JOGGING LÉGER FITNESS COUPE DROITE NOIR', 12, 1, 'XS / W26 L30,S / W28 L31,M / W30 L31,L / W33 L31,XL / W35 L31,2XL / W38 L31,3XL / W41 L31', 0, 'pantalon-jogging-leger-fitness-coupe-droite-noir', NULL, NULL, 'UN PANTALON INITIALEMENT CONÇU POUR LE FITNESS... QUI S\'INVITE DANS VOTRE QUOTIDIEN !\r\nUne séance de tonification de bon matin ; un meeting au boulot ; une sortie de marche active entre midi et 14 h ; un petit détour par l\'épicerie pour remplir le frigo ; du temps de qualité en famille et/ou entre ami·es : et si vous faisiez tout cela dans une même tenue, stylée et confortable, ça serait chouette, non ?\r\n\r\nCela tombe bien, c\'est le pari que relève notre gamme : celui de gommer les frontières entre vos activités en vous permettant de passer de l\'une à l\'autre dans un seul look.\r\n\r\nVOUS AVEZ DIT CONFORT ?\r\nImaginez un peu être à l\'aise et trendy dans un quotidien à 100 à l\'heure rythmé par le travail, la famille, le sport, soi, et tout ce qu\'il y a à côté. Ah... Vous aussi vous l\'avez, cette folle envie ? Nous aussi. Du coup, on s\'est dit qu\'en tant que concepteur·trices de textile, on était plutôt bien placé·es pour lui donner vie, à cette folle envie. Et paf, voilà comment notre gamme est née ! Une gamme confortable mais pas moins trendy avec des vêtements autant sympas à porter qu\'à regarder !\r\n\r\n3 BONNES RAISONS D\'ADOPTER LA COUPE DROITE\r\nLe pantalon jogging ? On adore. La coupe droite ? On adore aussi. Alors autant vous dire que le pantalon coupe droite, on adore ++ ! Voici 3 bonnes raisons de l\'adopter : cette coupe est idéale pour se démarquer. En plus, la coupe droite habille vos chevilles et donne du mouvement au tissu lorsque vous marchez. Et pour ne rien gâcher, elle est super confortable !\r\n\r\nAlors, convaincue ?\r\n\r\nPS : notre pantalon n\'est pas pourvu de poches.\r\n\r\nUN PANTALON TOUT EN DÉTAILS\r\n\" Les tailles élastiquées sont essentielles à la bonne tenue d\'un pantalon \" ; ça, c\'est vrai. \" Oui, mais une taille élastiquée, c\'est parfois oppressant \" ; ça aussi, c\'est vrai, \" parfois \". Du coup, nous avons veillé à ce que la ceinture élastiquée de notre jogging soit tout particulièrement confortable, pour votre confort à vous. Par ailleurs, la matière extensible de ce dernier (12 % d\'élasthanne) vous promet une grande liberté de mouvement... Et encore et toujours plus de confort !\r\n\r\nGarantie\r\n2 ans', 'Pantalon jogging léger Fitness coupe droite Noir NYAMBA | Decathlon', 'Pantalon jogging léger Fitness coupe droite Noir au prix de ★ 12€ ★ sur Decathlon.fr. Un pantalon trendy à porter au quotidien ET pour faire du sport : c\'est la mission que nos stylistes ont su relever en designant ce pantalon à coupe droite.', 19),
(41, 'PANTALON JOGGING LÉGER FITNESS COUPE CAROTTE NOIR', 9, 1, 'XS / W26 L30,S / W28 L31,M / W30 L31,L / W33 L31,XL / W35 L31,2XL / W38 L31,3XL / W41 L31', 0, 'pantalon-jogging-leger-fitness-coupe-carotte-noir', NULL, NULL, 'UN PANTALON INITIALEMENT CONÇU POUR LE FITNESS... QUI S\'INVITE DANS VOTRE QUOTIDIEN !\r\nUne séance de tonification de bon matin ; un meeting au boulot ; une sortie de marche active entre midi et 14 h ; un petit détour par l\'épicerie pour remplir le frigo ; du temps de qualité en famille et/ou entre ami·es : et si vous faisiez tout cela dans une même tenue, stylée et confortable, ça serait chouette, non ?\r\n\r\nCela tombe bien, c\'est le pari que relève notre gamme : celui de gommer les frontières entre vos activités en vous permettant de passer de l\'une à l\'autre dans un seul look.\r\n\r\nVOUS AVEZ DIT CONFORT ?\r\nImaginez un peu être à l\'aise et trendy dans un quotidien à 100 à l\'heure rythmé par le travail, la famille, le sport, soi, et tout ce qu\'il y a à côté. Ah... Vous aussi vous l\'avez, cette folle envie ? Nous aussi. Du coup, on s\'est dit qu\'en tant que concepteur·trices de textile, on était plutôt bien placé·es pour lui donner vie, à cette folle envie. Et paf, voilà comment notre gamme est née ! Une gamme confortable mais pas moins trendy avec des vêtements autant sympas à porter qu\'à regarder !\r\n\r\nLA COUPE CAROTTE : QUÉSAKO ET COMMENT LA PORTER ?\r\nPour commencer, la coupe carotte est une forme qui se veut légèrement volumineuse au niveau des hanches et des cuisses, et qui se resserre ensuite progressivement jusqu\'aux chevilles. Son avantage ? Elle affine et donne de la longueur à la jambe !\r\nAussi, afin d\'effectuer la balance avec son côté ample, nous vous conseillons de porter un haut ajusté ou à coupe droite, et même pourquoi pas un crop top.\r\nEt vous, comment portez-vous la coupe carotte ?\r\n\r\nPS : notre pantalon n\'est pas pourvu de poches\r\n\r\nGarantie\r\n2 ans', 'Pantalon jogging léger Fitness Coupe carotte Noir NYAMBA | Decathlon', 'Pantalon jogging léger Fitness Coupe carotte Noir au prix de ★ 9€ ★ sur Decathlon.fr. Nos stylistes ont designé ce jogging coupe carotte afin que vous puissiez rester stylée en toutes circonstances : au sport comme dans la vie de tous les jours !', 19),
(42, 'PANTALON JOGGING FITNESS AVEC LIEN BAS DE JAMBE COUPE DROITE NOIR', 12, 1, 'XS / W26 L30,S / W28 L31,M / W30 L31,L / W33 L31,XL / W35 L31,2XL / W38 L31,3XL / W41 L31', 0, 'pantalon-jogging-fitness-avec-lien-bas-de-jambe-coupe-droite-noir', NULL, NULL, 'UN PANTALON INITIALEMENT CONÇU POUR LE FITNESS... QUI S\'INVITE DANS VOTRE QUOTIDIEN !\r\nUne séance de tonification de bon matin ; un meeting au boulot ; une sortie de marche active entre midi et 14 h ; un petit détour par l\'épicerie pour remplir le frigo ; du temps de qualité en famille et/ou entre ami·es : et si vous faisiez tout cela dans une même tenue, stylée et confortable, ça serait chouette, non ?\r\n\r\nCela tombe bien, c\'est le pari que relève notre gamme : celui de gommer les frontières entre vos activités en vous permettant de passer de l\'une à l\'autre dans un seul look.\r\n\r\nVOUS AVEZ DIT CONFORT ?\r\nImaginez un peu être à l\'aise et trendy dans un quotidien à 100 à l\'heure rythmé par le travail, la famille, le sport, soi, et tout ce qu\'il y a à côté. Ah... Vous aussi vous l\'avez, cette folle envie ? Nous aussi. Du coup, on s\'est dit qu\'en tant que concepteur·trices de textile, on était plutôt bien placé·es pour lui donner vie, à cette folle envie. Et paf, voilà comment notre gamme est née ! Une gamme confortable mais pas moins trendy avec des vêtements autant sympas à porter qu\'à regarder !\r\n\r\n3 BONNES RAISONS D\'ADOPTER LA COUPE DROITE\r\nLe pantalon jogging ? On adore. La coupe droite ? On adore aussi. Alors autant vous dire que le pantalon coupe droite, on adore ++ ! Voici 3 bonnes raisons de l\'adopter : cette coupe est idéale pour se démarquer. En plus, la coupe droite habille vos chevilles et donne du mouvement au tissu lorsque vous marchez. Et pour ne rien gâcher, elle est super confortable !\r\n\r\nAlors, convaincue ?\r\n\r\nPS : notre pantalon n\'est pas pourvu de poches.\r\n\r\nUN PANTALON TOUT EN DÉTAILS\r\n\"\"\" Les tailles élastiquées sont essentielles à la bonne tenue d\'un pantalon \"\" ; ça, c\'est vrai. \"\" Oui, mais une taille élastiquée, c\'est parfois oppressant \"\" ; ça aussi, c\'est vrai, \"\" parfois \"\". Du coup, nous avons veillé à ce que la ceinture élastiquée de notre jogging soit tout particulièrement confortable, pour votre confort à vous.\r\nPar ailleurs, le bas de ce pantalon est équipé d\'un lien grâce auquel vous pouvez le resserrer afin d\'apporter une finition ajustée sur votre cheville.\"\r\n\r\nGarantie\r\n2 ans', 'Pantalon jogging Fitness avec lien bas de jambe coupe droite Noir NYAMBA | Decathlon', 'Pantalon jogging Fitness avec lien bas de jambe coupe droite Noir au prix de ★ 12€ ★ sur Decathlon.fr. Un pantalon stylé à adopter au quotidien ET pour faire du sport ? Mission acceptée et accomplie par nos stylistes qui ont designé ce pantalon à coupe droite.', 19),
(43, 'PANTALON DE JOGGING RUNNING RESPIRANT FEMME - DRY NOIR', 15, 1, 'XS / W26 L30,S / W28 L31,M / W30 L31,L / W33 L31,XL / W35 L31,2XL / W38 L31,3XL / W41 L31', 0, 'pantalon-de-jogging-running-respirant-femme-dry-noir', NULL, NULL, 'Taille des modèles\r\nLes modèles portent une taille S et mesurent 1m70\r\n\r\nUNE NOTE POUR COMPARER L\'IMPACT ENVIRONNEMENTAL DES PRODUITS\r\nLes impacts environnementaux du produit sont calculés sur l\'ensemble de son cycle de vie et avec différents indicateurs. Une note globale ABCDE est réalisée pour vous aider à identifier facilement les produits avec la meilleure performance environnementale en comparant les produits d\'un même type entre eux (T-shirts, pantalons, sacs à dos, ...).\r\nDecathlon est un acteur volontaire de cette démarche d\'affichage environnemental.\r\nPour plus d\'infos: http://sustainability.decathlon.com/\r\n\r\nGarantie\r\n2 ans', 'Pantalon de jogging running respirant femme - Dry KALENJI | Decathlon', 'Pantalon de jogging running respirant femme - Dry au prix de ★ 15€ ★ sur Decathlon.fr. Notre équipe a conçu un pantalon léger, respirant et fluide. Parfait pour courir où vous voulez !', 19);
INSERT INTO `ec_products` (`pdt_id`, `pdt_title`, `pdt_price`, `pdt_activated`, `pdt_option`, `pdt_discount`, `pdt_slug`, `pdt_tagname`, `pdt_short_description`, `pdt_long_description`, `pdt_meta_title`, `pdt_meta_description`, `col_id`) VALUES
(44, 'PANTALON JOGGING FITNESS BAS RESSERRÉ COUPE DROITE NOIR', 15, 1, 'XS / W26 L30,S / W28 L31,M / W30 L31,L / W33 L31,XL / W35 L31,2XL / W38 L31,3XL / W41 L31', 0, 'pantalon-jogging-fitness-bas-resserre-coupe-droite-noir', NULL, NULL, 'UN PANTALON INITIALEMENT CONÇU POUR LE FITNESS... QUI S\'INVITE DANS VOTRE QUOTIDIEN !\r\nUne séance de tonification de bon matin ; un meeting au boulot ; une sortie de marche active entre midi et 14 h ; un petit détour par l\'épicerie pour remplir le frigo ; du temps de qualité en famille et/ou entre ami·es : et si vous faisiez tout cela dans une même tenue, stylée et confortable, ça serait chouette, non ?\r\n\r\nCela tombe bien, c\'est le pari que relève notre gamme : celui de gommer les frontières entre vos activités en vous permettant de passer de l\'une à l\'autre dans un seul look.\r\n\r\nVOUS AVEZ DIT CONFORT ?\r\nImaginez un peu être à l\'aise et trendy dans un quotidien à 100 à l\'heure rythmé par le travail, la famille, le sport, soi, et tout ce qu\'il y a à côté. Ah... Vous aussi vous l\'avez, cette folle envie ? Nous aussi. Du coup, on s\'est dit qu\'en tant que concepteur·trices de textile, on était plutôt bien placé·es pour lui donner vie, à cette folle envie. Et paf, voilà comment notre gamme est née ! Une gamme confortable mais pas moins trendy avec des vêtements autant sympas à porter qu\'à regarder !\r\n\r\n3 BONNES RAISONS D\'ADOPTER LA COUPE DROITE\r\nLe pantalon jogging ? On adore. La coupe droite ? On adore aussi. Alors autant vous dire que le pantalon coupe droite, on adore ++ ! Voici 3 bonnes raisons de l\'adopter : cette coupe est idéale pour se démarquer. En plus, la coupe droite habille vos chevilles et donne du mouvement au tissu lorsque vous marchez. Et pour ne rien gâcher, elle est super confortable !\r\n\r\nAlors, convaincue ?\r\n\r\nPS : notre pantalon n\'est pas pourvu de poches.\r\n\r\nUN PANTALON TOUT EN DÉTAILS\r\nLe bas de ce pantalon est resserré par un élastique afin d\'apporter une finition ajustée sur votre cheville.\r\nCe jogging est également équipé d\'un cordon de serrage à la taille afin que vous puissiez l\'ajuster à votre taille à vous.\r\nEnfin, nous avons choisi d\'insérer deux poches italiennes, vous savez, ces poches arrondies légèrement en biais : pratiques, elles habillent aussi davantage le vêtement sur lequel elles se trouvent.\r\n\r\nGarantie\r\n2 ans', 'Pantalon jogging Fitness Bas resserré coupe droite NYAMBA | Decathlon', 'Pantalon jogging Fitness Bas resserré coupe droite au prix de ★ 15€ ★ sur Decathlon.fr. Faites le pari d\'être stylée au quotidien et pendant votre séance de sport avec ce pantalon regular ultra confortable designé avec amour par nos stylistes.', 19),
(45, 'PANTALON JOGGING FITNESS BAS DE JAMBE ZIPPÉ SLIM NOIR', 20, 1, 'XS / W26 L30,S / W28 L31,M / W30 L31,L / W33 L31,XL / W35 L31,2XL / W38 L31,3XL / W41 L31', 0, 'pantalon-jogging-fitness-bas-de-jambe-zippe-slim-noir', NULL, NULL, 'UN PANTALON INITIALEMENT CONÇU POUR LE FITNESS... QUI S\'INVITE DANS VOTRE QUOTIDIEN !\r\nUne séance de tonification de bon matin ; un meeting au boulot ; une sortie de marche active entre midi et 14 h ; un petit détour par l\'épicerie pour remplir le frigo ; du temps de qualité en famille et/ou entre ami·es : et si vous faisiez tout cela dans une même tenue, stylée et confortable, ça serait chouette, non ?\r\n\r\nCela tombe bien, c\'est le pari que relève notre gamme : celui de gommer les frontières entre vos activités en vous permettant de passer de l\'une à l\'autre dans un seul look.\r\n\r\nVOUS AVEZ DIT CONFORT ?\r\nImaginez un peu être à l\'aise et trendy dans un quotidien à 100 à l\'heure rythmé par le travail, la famille, le sport, soi, et tout ce qu\'il y a à côté. Ah... Vous aussi vous l\'avez, cette folle envie ? Nous aussi. Du coup, on s\'est dit qu\'en tant que concepteur·trices de textile, on était plutôt bien placé·es pour lui donner vie, à cette folle envie. Et paf, voilà comment notre gamme est née ! Une gamme confortable mais pas moins trendy avec des vêtements autant sympas à porter qu\'à regarder !\r\n\r\n3 BONNES RAISONS D\'ADOPTER LA COUPE SLIM\r\nLa coupe slim, c\'est un grand classique, certes. Oui, mais pourquoi ? La coupe slim épouse vos courbes et souligne la longueur de vos jambes. C\'est aussi le juste milieu : ajustée au plus proche de votre corps, elle vous permet également d\'être libre de vos mouvements. Enfin, la coupe slim permet de passer d\'un extrême à l\'autre : vous portez un pantalon fitté ? Cassez votre look avec un gros sweat bien loose !\r\n\r\nAlors, le jogging slim, on valide ?\r\n\r\nUN PANTALON TOUT EN DÉTAILS\r\nLe bas de ce pantalon est resserré par un large élastique afin d\'apporter une finition ajustée sur votre cheville, mais aussi d\'un grand zip que vous pouvez ouvrir ou fermer à votre convenance.\r\nCe jogging est également équipé de deux poches zippées latérales (histoire que vous puissiez sécuriser ce qui s\'y trouve, et y placer tout ce que vous voulez), et d\'une poche passepoilée située à l\'arrière.\r\n\r\nGarantie\r\n2 ans', 'Pantalon 500 heavy zip Pilates Gym douce femme DOMYOS | Decathlon', 'Pantalon 500 heavy zip Pilates Gym douce femme au prix de ★ 20€ ★ sur Decathlon.fr. Désigné avec amour par nos stylistes, ce jogging slim vous accompagne au quotidien, mais aussi pendant vos séances de sport. Eh oui, on ne l\'arrête plus !', 19),
(46, 'PANTALON JOGGING FITNESS BAS RESSERRÉ SLIM GRIS', 20, 1, 'XS / W26 L30,S / W28 L31,M / W30 L31,L / W33 L31,XL / W35 L31,2XL / W38 L31,3XL / W41 L31', 0, 'pantalon-jogging-fitness-bas-resserre-slim-gris', NULL, NULL, 'UN PANTALON INITIALEMENT CONÇU POUR LE FITNESS... QUI S\'INVITE DANS VOTRE QUOTIDIEN !\r\nUne séance de tonification de bon matin ; un meeting au boulot ; une sortie de marche active entre midi et 14 h ; un petit détour par l\'épicerie pour remplir le frigo ; du temps de qualité en famille et/ou entre ami·es : et si vous faisiez tout cela dans une même tenue, stylée et confortable, ça serait chouette, non ?\r\n\r\nCela tombe bien, c\'est le pari que relève notre gamme : celui de gommer les frontières entre vos activités en vous permettant de passer de l\'une à l\'autre dans un seul look.\r\n\r\nVOUS AVEZ DIT CONFORT ?\r\nImaginez un peu être à l\'aise et trendy dans un quotidien à 100 à l\'heure rythmé par le travail, la famille, le sport, soi, et tout ce qu\'il y a à côté. Ah... Vous aussi vous l\'avez, cette folle envie ? Nous aussi. Du coup, on s\'est dit qu\'en tant que concepteur·trices de textile, on était plutôt bien placé·es pour lui donner vie, à cette folle envie. Et paf, voilà comment notre gamme est née ! Une gamme confortable mais pas moins trendy avec des vêtements autant sympas à porter qu\'à regarder !\r\n\r\n3 BONNES RAISONS D\'ADOPTER LA COUPE SLIM\r\nLa coupe slim, c\'est un grand classique, certes. Oui, mais pourquoi ? La coupe slim épouse vos courbes et souligne la longueur de vos jambes. C\'est aussi le juste milieu : ajustée au plus proche de votre corps, elle vous permet également d\'être libre de vos mouvements. Enfin, la coupe slim permet de passer d\'un extrême à l\'autre : vous portez un pantalon fitté ? Cassez votre look avec un gros sweat bien loose !\r\n\r\nAlors, le jogging slim, on valide ?\r\n\r\nUN PANTALON TOUT EN DÉTAILS\r\nNotre pantalon est pourvu de finitions revers, autrement dit, plutôt qu\'un ourlet situé à l\'intérieur du jogging, nous avons opté pour un revers visible et stylé.\r\nCe slim est également équipé d\'un cordon de serrage à la taille afin que vous puissiez l\'ajuster à votre taille à vous.\r\nEnfin, nous avons choisi d\'insérer deux poches italiennes, vous savez, ces poches arrondies légèrement en biais : pratiques, elles habillent aussi davantage le vêtement sur lequel elles se trouvent.', 'Pantalon jogging Fitness Bas resserré Slim NYAMBA | Decathlon', 'Pantalon jogging Fitness Bas resserré Slim au prix de ★ 15€ ★ sur Decathlon.fr. Adoptez un look casual et stylé au sport comme dans la vie quotidienne avec ce jogging slim imaginé et créé par nos stylistes.', 19),
(47, 'PANTALON DE SURVETEMENT ADIDAS FEMME GRIS', 45, 1, 'XS / W26 L30,S / W28 L31,M / W30 L31,L / W33 L31,XL / W35 L31,2XL / W38 L31,3XL / W41 L31', 0, 'pantalon-de-survetement-adidas-femme-gris', NULL, NULL, 'Garantie\r\n2 ans', 'PANTALON DE SURVETEMENT ADIDAS FEMME GRIS ADIDAS | Decathlon', 'PANTALON DE SURVETEMENT ADIDAS FEMME GRIS au prix de ★ 45€ ★ sur Decathlon.fr. Look sport pour ce pantalon de jogging doux et léger qui présente une coupe slim et les 3 bandes adidas, parfait pour vos sessions de fitness.', 19),
(48, 'PANTALON DE JOGGING RUNNING CHAUD FEMME - WARM NOIR', 0, 1, 'XS / W26 L30,S / W28 L31,M / W30 L31,L / W33 L31,XL / W35 L31,2XL / W38 L31,3XL / W41 L31', NULL, 'pantalon-de-jogging-running-chaud-femme-warm-noir', NULL, NULL, 'Taille du modèle\r\nClaire porte une taille S et mesure 1m77.\r\n\r\nCONFORT\r\nTissu doux et chaud.\r\nCeinture plate, large avec cordon de serrage intégré pour un meilleur ajustement de votre pantalon.\r\n\r\nUNE NOTE POUR COMPARER L\'IMPACT ENVIRONNEMENTAL DE NOS PRODUITS\r\nLes impacts environnementaux du produit sont calculés sur l\'ensemble de son cycle de vie et avec différents indicateurs. Une note globale ABCDE est réalisée pour vous aider à identifier facilement les produits avec la meilleure performance environnementale en comparant les produits d\'un même type entre eux (T-shirts, pantalons, sacs à dos, ...).\r\nDecathlon est un acteur volontaire de cette démarche d\'affichage environnemental.\r\nPour plus d\'infos: http://sustainability.decathlon.com/\r\n\r\nGarantie\r\n2 ans', 'Pantalon de jogging running chaud femme - Warm KALENJI | Decathlon', 'Pantalon de jogging running chaud femme - Warm au prix de ★ 14€ ★ sur Decathlon.fr. Notre équipe a développé un pantalon femme pour vous protéger du froid lors de vos footings. Testé pour un confort optimal entre -5 et 0°C.', 19),
(49, 'PANTALON JOGGING FITNESS BAS RESSERRÉ SLIM NOIR', 15, 1, 'XS / W26 L30,S / W28 L31,M / W30 L31,L / W33 L31,XL / W35 L31,2XL / W38 L31,3XL / W41 L31', 0, 'pantalon-jogging-fitness-bas-resserre-slim-noir', NULL, NULL, 'UN PANTALON INITIALEMENT CONÇU POUR LE FITNESS... QUI S\'INVITE DANS VOTRE QUOTIDIEN !\r\nUne séance de tonification de bon matin ; un meeting au boulot ; une sortie de marche active entre midi et 14 h ; un petit détour par l\'épicerie pour remplir le frigo ; du temps de qualité en famille et/ou entre ami·es : et si vous faisiez tout cela dans une même tenue, stylée et confortable, ça serait chouette, non ?\r\n\r\nCela tombe bien, c\'est le pari que relève notre gamme : celui de gommer les frontières entre vos activités en vous permettant de passer de l\'une à l\'autre dans un seul look.\r\n\r\nVOUS AVEZ DIT CONFORT ?\r\nImaginez un peu être à l\'aise et trendy dans un quotidien à 100 à l\'heure rythmé par le travail, la famille, le sport, soi, et tout ce qu\'il y a à côté. Ah... Vous aussi vous l\'avez, cette folle envie ? Nous aussi. Du coup, on s\'est dit qu\'en tant que concepteur·trices de textile, on était plutôt bien placé·es pour lui donner vie, à cette folle envie. Et paf, voilà comment notre gamme est née ! Une gamme confortable mais pas moins trendy avec des vêtements autant sympas à porter qu\'à regarder !\r\n\r\n3 BONNES RAISONS D\'ADOPTER LA COUPE SLIM\r\nLa coupe slim, c\'est un grand classique, certes. Oui, mais pourquoi ? La coupe slim épouse vos courbes et souligne la longueur de vos jambes. C\'est aussi le juste milieu : ajustée au plus proche de votre corps, elle vous permet également d\'être libre de vos mouvements. Enfin, la coupe slim permet de passer d\'un extrême à l\'autre : vous portez un pantalon fitté ? Cassez votre look avec un gros sweat bien loose !\r\n\r\nAlors, le jogging slim, on valide ?\r\n\r\nUN PANTALON TOUT EN DÉTAILS\r\nNotre pantalon est pourvu de finitions revers, autrement dit, plutôt qu\'un ourlet situé à l\'intérieur du jogging, nous avons opté pour un revers visible et stylé.\r\nCe slim est également équipé d\'un cordon de serrage à la taille afin que vous puissiez l\'ajuster à votre taille à vous.\r\nEnfin, nous avons choisi d\'insérer deux poches italiennes, vous savez, ces poches arrondies légèrement en biais : pratiques, elles habillent aussi davantage le vêtement sur lequel elles se trouvent.\r\n\r\nGarantie\r\n2 ans', 'Pantalon jogging Fitness Bas resserré Slim NYAMBA | Decathlon', 'Pantalon jogging Fitness Bas resserré Slim au prix de ★ 15€ ★ sur Decathlon.fr. Adoptez un look casual et stylé au sport comme dans la vie quotidienne avec ce jogging slim imaginé et créé par nos stylistes.', 19),
(50, 'PANTALON JOGGING FITNESS BAS DE JAMBE ZIPPÉ SLIM BLEU MARINE', 20, 1, 'XS / W26 L30,S / W28 L31,M / W30 L31,L / W33 L31,XL / W35 L31,2XL / W38 L31,3XL / W41 L31', 0, 'pantalon-jogging-fitness-bas-de-jambe-zippe-slim-bleu-marine', NULL, NULL, 'UN PANTALON INITIALEMENT CONÇU POUR LE FITNESS... QUI S\'INVITE DANS VOTRE QUOTIDIEN !\r\nUne séance de tonification de bon matin ; un meeting au boulot ; une sortie de marche active entre midi et 14 h ; un petit détour par l\'épicerie pour remplir le frigo ; du temps de qualité en famille et/ou entre ami·es : et si vous faisiez tout cela dans une même tenue, stylée et confortable, ça serait chouette, non ?\r\n\r\nCela tombe bien, c\'est le pari que relève notre gamme : celui de gommer les frontières entre vos activités en vous permettant de passer de l\'une à l\'autre dans un seul look.\r\n\r\nVOUS AVEZ DIT CONFORT ?\r\nImaginez un peu être à l\'aise et trendy dans un quotidien à 100 à l\'heure rythmé par le travail, la famille, le sport, soi, et tout ce qu\'il y a à côté. Ah... Vous aussi vous l\'avez, cette folle envie ? Nous aussi. Du coup, on s\'est dit qu\'en tant que concepteur·trices de textile, on était plutôt bien placé·es pour lui donner vie, à cette folle envie. Et paf, voilà comment notre gamme est née ! Une gamme confortable mais pas moins trendy avec des vêtements autant sympas à porter qu\'à regarder !\r\n\r\n3 BONNES RAISONS D\'ADOPTER LA COUPE SLIM\r\nLa coupe slim, c\'est un grand classique, certes. Oui, mais pourquoi ? La coupe slim épouse vos courbes et souligne la longueur de vos jambes. C\'est aussi le juste milieu : ajustée au plus proche de votre corps, elle vous permet également d\'être libre de vos mouvements. Enfin, la coupe slim permet de passer d\'un extrême à l\'autre : vous portez un pantalon fitté ? Cassez votre look avec un gros sweat bien loose !\r\n\r\nAlors, le jogging slim, on valide ?\r\n\r\nUN PANTALON TOUT EN DÉTAILS\r\nLe bas de ce pantalon est resserré par un large élastique afin d\'apporter une finition ajustée sur votre cheville, mais aussi d\'un grand zip que vous pouvez ouvrir ou fermer à votre convenance.\r\nCe jogging est également équipé de deux poches zippées latérales (histoire que vous puissiez sécuriser ce qui s\'y trouve, et y placer tout ce que vous voulez), et d\'une poche passepoilée située à l\'arrière.\r\n\r\nGarantie\r\n2 ans', 'Pantalon 500 heavy zip Pilates Gym douce femme DOMYOS | Decathlon', 'Pantalon 500 heavy zip Pilates Gym douce femme au prix de ★ 20€ ★ sur Decathlon.fr. Désigné avec amour par nos stylistes, ce jogging slim vous accompagne au quotidien, mais aussi pendant vos séances de sport. Eh oui, on ne l\'arrête plus !', 19),
(51, 'MAILLOT DE TRAIL RUNNING MANCHES LONGUES SOFTSHELL HOMME NOIR BRONZE', 40, 1, 'XS,S,M,L,XL,2XL', 0, 'maillot-de-trail-running-manches-longues-softshell-homme-noir-bronze', NULL, NULL, 'Faire du trail au chaud par temps froid\r\nParce que le ventre, la poitrine et les épaules sont les zones les plus exposées pendant nos courses, notre composant coupe-vent a été spécialement disposé sur ces zones. A l\'abri des courants d\'air, ne pensez plus qu\'à votre foulée, au paysage et à vos sensations.\r\nIdéale pour les trails d’hiver, vous pourrez courir par des températures comprises entre -5 et +15 degrés en mettant seulement une couche effet seconde peau (seamless manches longues) en-dessous!\r\n\r\nUn tee shirt à manches longues en-dessous suffit pour avoir bien chaud\r\nCyrille, chef de produit Evadict Trail nous livre ses conseils pour bien porter le maillot softshell : \"certaines personnes ont tendance à cumuler les couches par peur d\'avoir froid et leur trail devient vite désagréable car ils ont trop chaud. Avec le maillot softshell, il suffit de mettre une couche effet seconde peau en-dessous afin d\'avoir un confort optimal et être tout le temps à la bonne température.\"\r\n\r\nLa ventilation ? C\'est vous qui la contrôlez\r\nAvec son long zip central à double sens, vous pouvez facilement réguler l\'air qui circule. Besoin de protéger votre cou du froid tout en vous aérant ? Ouvrez le bas du zip, fermez le haut et lancez-vous à l\'assaut du dénivelé. Les zones d\'aération sous les aisselles, sur les bras et sur le dos vous permettent d\'évacuer la transpiration pour être bien au sec tout au long de votre trail.\r\n\r\nUne ouverture montre pour ne pas s\'exposer au froid\r\nUne ouverture sur la manche gauche de la veste vous permet de regarder votre montre sans relever la manche quand il fait froid.\r\n\r\nComment rester bien protégé et au sec avec la technique des 3 couches ? Maillot Softshell Trail = Couche 2\r\nIl est important de bien ajuster et choisir vos différentes couches en fonction de l\'intensité de votre activité, du terrain (montée, plat, descente) et/ou des conditions météos. Ceci permet d\'éviter d\'être mouillé.\r\nN\'hésitez pas à moduler les couches durant votre activité et à utiliser la superposition appropriée.\r\nCOUCHE 1 : RESPIRANTE (transfert de la transpiration de la peau vers les autres couches)\r\nCOUCHE 2 ISOLANTE (isole du froid et apporte de la chaleur)\r\nCOUCHE 3 PROTECTRICE (vent/pluie)\r\n\r\nUne poche compactable pour ranger le maillot dans son sac\r\nLe maillot est composé de deux poches principales. La première se trouve sur la poitrine afin d\'y mettre des choses légères. La deuxième est plus grande pour y mettre son bonnet ou ses gants. Vous pouvez compacter le maillot dans la grande poche afin de le ranger dans son sac sans qu\'il ne prenne trop de place.\r\n\r\nBien choisir sa taille\r\nPour vous maintenir au chaud tout restant libre de vos mouvements, la coupe de ce maillot a été pensée \"ajustée\".\r\nVous préférez porter des vêtements plus amples pour vos séances ? Optez pour la taille supérieure. Le cordon de serrage vous garantie maintien et protection contre le vent.\r\n\r\nDes produits durables pour une consommation plus responsable\r\nTous nos produits trails sont fabriqués dans une démarche d\'éco-conception. Nous cherchons toujours à utiliser des composants éco-responsables pour rendre les produits pus durables et qu\'ils résistent mieux aux agressions du temps.\r\nLa compatibilité du lecteur d\'écran est activée.\r\n\r\nUne note pour comparer l\'impact environnemental des produits\r\nLes impacts environnementaux du produit sont calculés sur l\'ensemble de son cycle de vie et avec différents indicateurs. Une note ABCDE est réalisée pour vous aider à identifier facilement les produits avec la meilleure performance environnementale en comparant les produits d\'un même type entre eux (T-shirts, pantalons, sacs à dos).\r\nDecathlon est un acteur volontaire de cette démarche d\'affichage environnemental.\r\nWeb : sustainability.decathlon.com\r\n\r\nGarantie\r\n2 ans', 'MAILLOT DE TRAIL RUNNING MANCHES LONGUES SOFTSHELL HOMME EVADICT | Decathlon', 'MAILLOT DE TRAIL RUNNING MANCHES LONGUES SOFTSHELL HOMME au prix de ★ 40€ ★ sur Decathlon.fr. Maillot manches longues trail softshell isolant pour courir par temps froid (idéal entre -5 et +15 degrés) sur toutes distances (entraînement ou compétition)', 17),
(52, 'MAILLOT RC LENS HOME 21/22 ADULTE', 80, 1, 'XS,S,M,L,XL,2XL', 0, 'maillot-rc-lens-home-21-22-adulte', NULL, NULL, 'Garantie\r\n1 an', 'Maillot RC Lens Home 21/22 Adulte PUMA | Decathlon', 'Maillot RC Lens Home 21/22 Adulte au prix de ★ 80€ ★ sur Decathlon.fr. Le maillot domicile 2021/2022 du RC Lens se pare des couleurs traditionnelles du club et rend hommage à son histoire. Porté par Jonas Martin.', 17),
(53, 'MAILLOT OM HOME 21/22 PUMA ADULTE', 90, 1, 'XS,S,M,L,XL', 0, 'maillot-om-home-21-22-puma-adulte', NULL, NULL, 'Garantie\r\n1 an', 'Maillot OM Home 21/22 PUMA adulte PUMA | Decathlon', 'Maillot OM Home 21/22 PUMA adulte au prix de ★ 90€ ★ sur Decathlon.fr. Le maillot de l\'Olympique de Marseille 2021/2022 reprend le blanc identitaire du club en apportant puissance et modernité à la tenue. Porté par Payet.', 17),
(54, 'MAILLOT VÉLO ROUTE ENDURANCE RACER BORDEAUX', 55, 1, 'XS,S,M,L,XL', 27, 'maillot-velo-route-endurance-racer-bordeaux', NULL, NULL, 'LE MAILLOT ENDURANCE PAR EXCELLENCE !\r\nNous vous présentons un tout nouveau né dans la famille des maillots Van Rysel. Sur la base de notre maillot Racer nous avons développé ce maillot au service de l\'endurance.\r\nL\'idée d\'un bloc 5 poches innovant nous est venue lors d\'une sortie en montagne durant laquelle nous alternions les phases ou l\'on enlevait et remettait nos manchettes et notre coupe vent sans jamais vraiment avoir la place de les ranger. Grâce à la double poche filée, fini les problématiques de place !\r\n\r\nUN CONFORT ET UNE LÉGERETÉ A VOUS COUPER LE SOUFFLE !\r\nPour ce maillot, notre choix s\'est orienté vers un ensemble de composants ultra-légers et au confort incomparable.\r\nPrincipalement composé de FIJI, vous serez surpris par la légèreté de ce maillot. Enfilé il se fera totalement oublié et vous procurera un sentiment de liberté de mouvements incroyable.\r\n\r\nUN MAILLOT QUI N\'A PAS OUBLIÉ D\'ÊTRE RESPIRANT !\r\nLe dos et les flancs du maillot, zone à fort échauffement ont été travaillées avec des tissus que l\'on appelle Mesh dont la particularité est d\'être ultra-respirant grâce à sa composition en mailles très aérées.\r\nVous retrouverez aussi un de nos composants phares : le Bradley sur l\'ensemble du dos et un Mesh beaucoup plus aéré sur les flancs : le Stanley.\r\nL\'ensemble de ces composants bénéficient d\'un traitement permettant d\'assurer une parfaite gestion de votre transpiration\r\n\r\nDES CHOIX DE CONCEPTION QUI FONT LA DIFFERENCE\r\n- Aération : Dos entièrement en Mesh pour une excellente respirabilité.\r\n- Poches : 4 poches dorsales dont une zippée.\r\n- Poches poubelles : deux poches poubelles situées sur les côtés du maillot.\r\n- Confort : Garage pour le zip en haut de la fermeture afin d\'éviter les frottements du zip sur le cou.\r\n- Protection : patte intérieure le long du zip afin de limiter l\'entrée d\'air depuis le zip.\r\n- Maintien : élastiques sur la taille et sur les manches pour un excellent maintien.\r\n\r\nCOUPE PRO FIT\r\nLa Coupe PRO FIT est une coupe dédiée aux cyclosportifs recherchant une coupe près du corps sans pour autant être trop serré. Bénéficiez d\'une coupe aérodynamique avec un effet seconde peau au service de la performance.\r\n\r\nLa Gamme RACER se démarque également avec des manches adoptant les codes ProTour et aérodynamiques, avec des manches recouvrant totalement le biceps\r\n\r\nCONSEILS D\'ENTRETIEN\r\nLavage en machine à 30°. Programme synthétique. Mettre le produit sur l’envers. Mettre peu de poudre à laver. Pas d\'adoucissant. Séchage sur cintre dans un endroit chaud et aéré. Pas de séchage en machine. Pas de nettoyage à sec. Pas de chlore. Ne pas poser sur un radiateur.\r\n\r\nDéveloppement Durable et Eco-Conception.\r\nEn recyclant des bouteilles en plastique ou en partie des textiles recyclés pour produire notre polyester, nous diminuons l\'utilisation des ressources issues du pétrole tout en préservant les qualités de respirabilité de la matière lors de votre pratique.\r\n\r\nGarantie\r\n2 ans', 'Maillot Vélo Route ENDURANCE RACER VAN RYSEL | Decathlon', 'Maillot Vélo Route ENDURANCE RACER au prix de ★ 40€ ★ sur Decathlon.fr. La gamme ENDURANCE RACER est la gamme de produits Van Rysel dédiée à la longue distance. Découvrez l\'ensemble des réponses à vos problématiques d\'endurance.', 17),
(55, 'MAILLOT VÉLO ROUTE NEO-RACER GRIS', 35, 1, 'XS,S,M,L,XL', 0, 'maillot-velo-route-neoracer-gris', NULL, NULL, 'UN MAILLOT SIMPLEMENT TOURNÉ VERS LA PERFORMANCE !\r\nNous avons travaillé notre gamme NEO RACER afin de vous proposer d\'entrer de la plus belle manière dans le monde de la performance. Ce maillot NEO RACER conviendra parfaitement à vos sorties de moyennes à fortes intensités dès le printemps et cela durant tout l\'été.\r\nPour faire simple, avec ce maillot NEO RACER nous avons souhaité vous proposer le meilleur rapport qualité-prix du marché !\r\n\r\nDES CHOIX DE CONCEPTION QUI FONT LA DIFFERENCE\r\nPour ce maillot, nous avons jeté notre dévolu sur un composant répondant au nom de code \"Opale\", un composant léger et respirant, ultra confortable. Grâce au traitement spécifique de ce composant, la gestion de votre transpiration sera optimisée !\r\nMais comme la performance se construit avec des détails : des panneaux en EVERSON (tissu en mesh hautement respirant) ont été positionnés sur les côtés du maillot pour vous garantir une parfaite régulation de votre température.\r\n\r\nCOUPE PRO FIT\r\nLa Coupe PRO FIT est une coupe dédiée aux CycloSportifs recherchant une coupe près du corps sans pour autant être trop serré. Bénéficiez d\'une coupe aérodynamique avec un effet seconde peau au service de la performance.\r\n\r\nLa Gamme NEO se démarque également avec des manches arrivant à mi-biceps.\r\n\r\nCONSEILS D\'ENTRETIEN\r\nLavage en machine à 30°. Programme synthétique. Mettre le produit sur l’envers. Mettre peu de poudre à laver. Pas d\'adoucissant. Séchage sur cintre dans un endroit chaud et aéré. Pas de séchage en machine. Pas de nettoyage à sec. Pas de chlore. Ne pas poser sur un radiateur.\r\n\r\nGarantie\r\n2 ans', 'Maillot Manches Courtes Vélo Route VAN RYSEL NEO-RACER VAN RYSEL | Decathlon', 'Maillot Manches Courtes Vélo Route VAN RYSEL NEO-RACER au prix de ★ 35€ ★ sur Decathlon.fr. La gamme Neo Racer a été conçue pour rendre la performance accessible au plus grand nombre. Une gamme dont l\'essence même est la simplicité et la performance.', 17),
(56, 'MAILLOT VÉLO ROUTE RACER TEAM BLANC', 50, 1, 'XS,S,M,L,XL,2XL', 0, 'maillot-velo-route-racer-team-blanc', NULL, NULL, 'LE MAILLOT COMPETITION PAR EXCELLENCE !\r\nVoici la toute nouvelle version de notre maillot Racer, encore plus léger, encore plus respirant. Un maillot idéal pour vos entrainements et compétitions ! Découvrez une toute nouvelle conception au service de la performance !\r\nLe brief de départ était clair : trouver le meilleur compromis entre la respirabilité et l\'aérodynamisme. Le résultat : notre maillot Racer.\r\n\r\nUN CONFORT ET UNE LÉGERETÉ A VOUS COUPER LE SOUFFLE !\r\nPour ce maillot notre choix s\'est orienté vers un ensemble de composants ultra-légers et au confort incomparable.\r\nPrincipalement composé de FIJI, vous serez surpris par la légèreté de ce maillot. Enfilé il se fera totalement oublier et vous procurera un sentiment de liberté de mouvements incroyable.\r\n\r\nUN MAILLOT QUI N\'A PAS OUBLIÉ D\'ÊTRE RESPIRANT !\r\nLe dos et les flancs du maillot, zone à fort échauffement puisque protéger du vent, ont été travaillé avec des tissus que l\'on appelle Mesh dont la particularité est d\'être ultra-respirant grâce à leur composition en maille très aérées.\r\nVous retrouverez ainsi un de nos composant phare, le Bradley sur l\'ensemble du dos, et un mesh beaucoup plus aéré sur les flancs, le Stanley.\r\nL\'ensemble de ces composants bénéficient d\'un traitement permettant d\'assurer une parfaite gestion de votre transpiration\r\n\r\nDES CHOIX DE CONCEPTION QUI FONT LA DIFFERENCE\r\n- Aération : Dos entièrement en mesh pour une excellente respirabilité.\r\n- Poches : 4 poches dorsales dont une zippée.\r\n- Poches poubelle : deux poches poubelle situées sur les côtés du maillot.\r\n- Confort : Garage pour le zip en haut de la fermeture afin d\'éviter les frottements du zip sur le cou.\r\n- Protection : patte intérieur le long du zip afin de limiter l\'entrée d\'air depuis le zipp.\r\n- Maintien : élastiques sur la taille et sur les manches pour un excellent maintien.\r\n\r\nCOUPE PRO FIT\r\nLa Coupe PRO FIT est une coupe dédiée aux CycloSportifs recherchant une coupe près du corps sans pour autant être trop serré. Bénéficiez d\'une coupe aérodynamique avec un effet seconde peau au service de la performance.\r\n\r\nLa Gamme RACER se démarque également avec des manches adoptant les codes ProTour et aérodynamiques, avec des manches recouvrant totalement le biceps\r\n\r\nCONSEILS D\'ENTRETIEN\r\nLavage en machine à 30°. Programme synthétique. Mettre le produit sur l’envers. Mettre peu de poudre à laver. Pas d\'adoucissant. Séchage sur cintre dans un endroit chaud et aéré. Pas de séchage en machine. Pas de nettoyage à sec. Pas de chlore. Ne pas poser sur un radiateur.\r\n\r\nDéveloppement Durable et Eco-Conception.\r\nEn recyclant des [bouteilles en plastique ou en partie des textiles recyclés] pour produire notre polyester, nous diminuons l\'utilisation des ressources issues du pétrole tout en préservant les qualités de respirabilité de la matière lors de votre pratique.\r\n\r\nGarantie\r\n2 ans', 'Maillot manches courtes Vélo Route VAN RYSEL RACER VAN RYSEL | Decathlon', 'Maillot manches courtes Vélo Route VAN RYSEL RACER au prix de ★ 50€ ★ sur Decathlon.fr. La gamme Racer est la gamme Héros de Van Rysel, vous y trouverez l\'ensemble des produits destinés à tous les cyclistes recherchant des produits pour se dépasser', 17),
(57, 'MAILLOT DE FOOTBALL ENTRADA 22 HOMME NOIR', 18, 1, 'XS,S,M,L,XL', 0, 'maillot-de-football-entrada-22-homme-noir', NULL, NULL, 'Garantie\r\n1 an', 'MAILLOT DE FOOTBALL ENTRADA 22 HOMME NOIR ADIDAS | Decathlon', 'MAILLOT DE FOOTBALL ENTRADA 22 HOMME NOIR au prix de ★ 18€ ★ sur Decathlon.fr. Un maillot de football adidas au design classique et épuré conçu pour l\'entrainement ou la compétition', 17),
(58, 'MAILLOT VÉLO ROUTE RACER TEAM JAUNE', 50, 1, 'XS,S,M,L,XL', 0, 'maillot-velo-route-racer-team-jaune', NULL, NULL, 'LE MAILLOT COMPETITION PAR EXCELLENCE !\r\nVoici la toute nouvelle version de notre maillot Racer, encore plus léger, encore plus respirant. Un maillot idéal pour vos entrainements et compétitions ! Découvrez une toute nouvelle conception au service de la performance !\r\nLe brief de départ était clair : trouver le meilleur compromis entre la respirabilité et l\'aérodynamisme. Le résultat : notre maillot Racer.\r\n\r\nUN CONFORT ET UNE LÉGERETÉ A VOUS COUPER LE SOUFFLE !\r\nPour ce maillot notre choix s\'est orienté vers un ensemble de composants ultra-légers et au confort incomparable.\r\nPrincipalement composé de FIJI, vous serez surpris par la légèreté de ce maillot. Enfilé il se fera totalement oublier et vous procurera un sentiment de liberté de mouvements incroyable.\r\n\r\nUN MAILLOT QUI N\'A PAS OUBLIÉ D\'ÊTRE RESPIRANT !\r\nLe dos et les flancs du maillot, zone à fort échauffement puisque protéger du vent, ont été travaillé avec des tissus que l\'on appelle Mesh dont la particularité est d\'être ultra-respirant grâce à leur composition en maille très aérées.\r\nVous retrouverez ainsi un de nos composant phare, le Bradley sur l\'ensemble du dos, et un mesh beaucoup plus aéré sur les flancs, le Stanley.\r\nL\'ensemble de ces composants bénéficient d\'un traitement permettant d\'assurer une parfaite gestion de votre transpiration\r\n\r\nDES CHOIX DE CONCEPTION QUI FONT LA DIFFERENCE\r\n- Aération : Dos entièrement en mesh pour une excellente respirabilité.\r\n- Poches : 4 poches dorsales dont une zippée.\r\n- Poches poubelle : deux poches poubelle situées sur les côtés du maillot.\r\n- Confort : Garage pour le zip en haut de la fermeture afin d\'éviter les frottements du zip sur le cou.\r\n- Protection : patte intérieur le long du zip afin de limiter l\'entrée d\'air depuis le zipp.\r\n- Maintien : élastiques sur la taille et sur les manches pour un excellent maintien.\r\n\r\nCOUPE PRO FIT\r\nLa Coupe PRO FIT est une coupe dédiée aux CycloSportifs recherchant une coupe près du corps sans pour autant être trop serré. Bénéficiez d\'une coupe aérodynamique avec un effet seconde peau au service de la performance.\r\n\r\nLa Gamme RACER se démarque également avec des manches adoptant les codes ProTour et aérodynamiques, avec des manches recouvrant totalement le biceps\r\n\r\nCONSEILS D\'ENTRETIEN\r\nLavage en machine à 30°. Programme synthétique. Mettre le produit sur l’envers. Mettre peu de poudre à laver. Pas d\'adoucissant. Séchage sur cintre dans un endroit chaud et aéré. Pas de séchage en machine. Pas de nettoyage à sec. Pas de chlore. Ne pas poser sur un radiateur.\r\n\r\nDéveloppement Durable et Eco-Conception.\r\nEn recyclant des [bouteilles en plastique ou en partie des textiles recyclés] pour produire notre polyester, nous diminuons l\'utilisation des ressources issues du pétrole tout en préservant les qualités de respirabilité de la matière lors de votre pratique.\r\n\r\nGarantie\r\n2 ans', 'Maillot manches courtes Vélo Route VAN RYSEL RACER VAN RYSEL | Decathlon', 'Maillot manches courtes Vélo Route VAN RYSEL RACER au prix de ★ 50€ ★ sur Decathlon.fr. La gamme Racer est la gamme Héros de Van Rysel, vous y trouverez l\'ensemble des produits destinés à tous les cyclistes recherchant des produits pour se dépasser', 17),
(59, 'MAILLOT MANCHES LONGUES VELO ROUTE TRIBAN RC500 NOIR', 35, 1, 'XS,S,M,L,XL', 0, 'maillot-manches-longues-velo-route-triban-rc500-noir', NULL, NULL, 'COUPE\r\nCLASSIC FIT : Ajustée et confortable. Cette coupe intemporelle est parfaite pour vos longues journées de vélo, que ce soit en selle ou pendant les pauses.\r\n\r\nCette coupe est plus ajustée que notre \"Relaxed Fit\", mais moins serrée que notre \"Pro Fit\".\r\n\r\nRESPIRABILITÉ DU COMPOSANT (RET)\r\nPour savoir si un tissu est respirant, on mesure sa résistance évaporative RET (test basé sur la norme ISO 11092). Plus la résistance est faible, plus le tissu laisse s’échapper la vapeur d\'eau générée par le corps en activité, et plus il est respirant.\r\n• RET <6 : extrêmement respirant, adapté aux efforts les plus intenses\r\n• RET 6 à 12 : très respirant, adaptée à un effort modéré\r\n• RET 12 à 20 : moyennement respirant, pas agréable en cas d’effort\r\n• RET >20 : peu respirant, inadapté à l’effort\r\n\r\nCONSEILS D\'ENTRETIEN\r\nLavage en machine à 30°. Programme synthétique. Mettre le produit sur l’envers. Pas d\'adoucissant. Séchage sur cintre dans un endroit chaud et aéré. Pas de séchage en machine. Pas de nettoyage à sec. Pas de chlore. Ne pas poser sur un radiateur.\r\n\r\nORIGINE DE LA LAINE\r\nNous utilisons exclusivement de la laine provenant de moutons Mérinos élevés dans des fermes en Afrique du Sud ne pratiquant pas le mulesing.\r\n\r\nGarantie\r\n2 ans', 'MAILLOT MANCHES LONGUES VELO ROUTE TRIBAN RC500 NOIR TRIBAN | Decathlon', 'MAILLOT MANCHES LONGUES VELO ROUTE TRIBAN RC500 NOIR au prix de ★ 35€ ★ sur Decathlon.fr. Trop froid pour un maillot manches courtes et trop chaud pour une veste hiver? Notre équipe à conçu ce maillot manches longues pour vous protéger en mi-saison.', 17),
(60, 'MAILLOT DE GARDIEN MANCHES LONGUES REUSCH MATCH PRO', 29.99, 1, 'XS,S,M,L,XL', 0, 'maillot-de-gardien-manches-longues-reusch-match-pro', NULL, NULL, 'Maillot de gardien manches longues Reusch Match Pro\r\nFONCTIONNALITÉS\r\nMMS ™ Cool, coudières, coupe slim\r\nMATÉRIEL\r\n100% Polyester', 'Maillot de gardien manches longues Reusch Match Pro REUSCH | Decathlon', 'Maillot de gardien manches longues Reusch Match Pro au prix de ★ 29.99€ ★ sur Decathlon.fr. Mettez ce maillot afin de pouvoir bouger librement tout au long de la partie. Il est confortable et respirant pour plus de confort tout au long de la partie.', 17),
(61, 'MAILLOT DE GARDIEN DE BUT', 39.99, 1, 'XS,S,M,L,XL', 15, 'maillot-de-gardien-de-but', NULL, NULL, 'HAUTE PERFORMANCE DANS LA SURFACE DE RÉPARATION\r\nMontre que tu es un T1TAN même pendant le match avec notre maillot gardien de but.\r\n\r\nLe maillot de gardien a une coupe longue et des nombreux détails cools font de la tenue de match du foot un must-have sur le terrain.\r\n\r\n✅ BODY FIT : La coupe s\'adapte bien au corps.\r\n\r\n✅ MATÉRIEL PROFESSIONEL : Maillot ultra léger & extrêmement souple sur le corps et broderie 3D sur les manches.\r\n\r\n✅ TAILLES : 2XS à 2XL\r\n\r\n✅ ENSEMBLE MAILLOT/SHORT : Tu peux choisir si tu veux combiner maillot et short et tu as le choix entre différentes tailles pour le maillot et le short.\r\n\r\nSPÉCIFICATIONS\r\nComposition : 100% Polyester\r\n\r\nEntretien : Lavage machine 30°C avec des couleurs similaires et sur l\'envers.', 'Maillot de Gardien de But T1TAN | Decathlon', 'Maillot de Gardien de But au prix de ★ 39.99€ ★ sur Decathlon.fr. Notre maillot de gardien de but looké possède une coupe près du corps. Il est ultra léger, respirant et extrêmement souple avec broderie 3D sur les manches. Se combine avec notre short de gardien.', 17),
(62, 'SHORT CUISSARD DE TRAIL RUNNING CONFORT HOMME NOIR', 35, 1, 'XS,S,M,L,XL', 0, 'short-cuissard-de-trail-running-confort-homme-noir', NULL, NULL, 'Un cuissard LEGER et CONFORTABLE\r\nNous avons développé ce cuissard intégré afin de vous assurer un confort ainsi qu\'une concentration maximale et non-parasitée, pendant votre sortie de trail et course à pied. Sa longueur idéale, ni trop courte, ni trop longue, préserve vos cuisses des frottements. Avec son intérieur en coutures plates, vous n\'êtes pas irrité (pour votre plus grand bonheur). Doux et léger, il est idéal pour les traileurs recherchant un confort optimal au cours de l\'effort... Pour performer ou admirer les paysages\r\n\r\nComment limiter les gênes, échauffements ou irritations ? TAILLANT POSITIONNEMENT CEINTURE\r\nLe choix du taillant est essentiel !\r\nLe produit doit parfaitement être ajusté à votre morphologie.\r\nUn short cuissard trop petit ou trop grand peut entrainer de mauvaises sensations.\r\nNous recommandons de prendre le temps d\'essayer le produit directement en magasin.\r\nLe positionnement de votre ceinture est également très important durant votre activité ; un short trop bas ou trop haut peut entrainer un mauvais placement des composants au niveau de l\'entrejambe.\r\n\r\nDe multiples poches : rangez malin !\r\nIdéale lorsque vous pensez pouvoir vous passer de votre sac de trail, cette ceinture portative intégrée vous permet d\'emporter vos essentiels. À l\'avant, une poche interne recouverte d\'une poche filet. Dans la première, vous pouvez glisser votre téléphone, et dans la seconde, une flasque de 250 ml. La large poche arrière, elle aussi zippée, peut également accueillir une flasque de 250 ml. Enfin, dans les 4 poches filets latérales, vous pouvez ranger vos gels, vos barres, vos mouchoirs, etc...\r\n\r\nMAINTIEN et STABILITE => ceinture => cordon\r\nLe cordon de serrage de la ceinture vous permet de fixer et de stabiliser le contenu de vos sept poches le long de votre taille lorsque vous courez. Ainsi, elle ne bouge pas, vous ne la sentez pas, et votre ventre n\'est pas compressé.\r\nNous conseillons de porter la ceinture en position haute et cordon ajusté lorsque la ceinture est chargée afin d\'avoir un maintien efficace et un stabilité optimale.\r\n\r\nDes astuces dédiées au confort du traileur : le slip intégré (à garder ou à découper)\r\nPour vous assurer un maximum de confort et de légèreté, ce short ample doublé d\'un cuissard, est également pourvu d\'un slip intégré. Tout doux, contenant un minimum de coutures et spécialement coupé pour pouvoir être porté sans sous-vêtement, ce slip vous assure un excellent maintien.\r\nSi vous préférez courir AVEC vos sous-vêtements, vous avez la possibilité de le retirer et de le découper facilement car il a été conçu pour.\r\nDe plus, l\'entre-jambes du short possède un mesh extensible respirant.\r\n\r\nZIP poche arrière avec un SEMI LOCK ? Ca veut dire quoi ? Ca sert à quoi ? Comment ça marche ?\r\nLa poche arrière de notre ceinture de portage est dotée d\'un ZIP particulier appelé \"SEMI LOCK\".\r\nCe zip peut se \"verrouiller\" et se \"déverrouiller\".\r\nLorsque la tirette est en position relevée, le zip peut être manipulé (ouverture ou fermeture).\r\nLorsque la tirette est en position basse (aplatie vers la droite), le zip est verrouillé. Cette position permet de sécuriser vos effets personnels durant l\'activité.\r\nNotre zip n\'aime pas que l\'on le manipule en position verrouillée ou semi verrouillée !\r\n\r\nUne note pour comparer l\'impact environnemental des produits\r\nLes impacts environnementaux du produit sont calculés sur l\'ensemble de son cycle de vie et avec différents indicateurs. Une note globale ABCDE est réalisée pour vous aider à identifier facilement les produits avec la meilleure performance environnementale en comparant les produits d\'un même type entre eux (T-shirts, pantalons, sacs à dos, ...).\r\nDecathlon est un acteur volontaire de cette démarche d\'affichage environnemental.\r\nPour plus d\'infos: http://sustainability.decathlon.com/\r\n\r\nGarantie\r\n2 ans', 'SHORT CUISSARD DE TRAIL RUNNING CONFORT HOMME EVADICT | Decathlon', 'SHORT CUISSARD DE TRAIL RUNNING CONFORT HOMME au prix de ★ 35€ ★ sur Decathlon.fr. Un short trail ample, doublé d\'un cuissard, et doté d\'un slip intégré, pour courir toutes les distances (entraînement/compétition).', 20),
(63, 'SHORT DE FOOTBALL ÉCO-CONÇU ADULTE F100 NOIR', 5, 1, 'XS,S,M,L,XL', 0, 'short-de-football-ecoconcu-adulte-f100-noir', NULL, NULL, 'Conception\r\nPar l\'observation et l\'écoute des footballeurs en apprentissage, nous avons développé ce short de football F100 d\'un composant résistant et léger pour guider vos premiers pas sur le terrain.\r\n\r\nGarantie\r\n2 ans', 'Short de football éco-conçu adulte F100 KIPSTA | Decathlon', 'Short de football éco-conçu adulte F100 au prix de ★ 5€ ★ sur Decathlon.fr. Nos concepteurs footballeurs ont développé ce short de football F100 pour vos entraînements et matchs, jusqu\'à 2 fois par semaine.', 20),
(64, 'SHORT DE TENNIS HOMME DRY TSH 500 BLANC', 7, 1, 'XS,S,M,L,XL', 0, 'short-de-tennis-homme-dry-tsh-500-blanc', NULL, NULL, 'SHORT DE TENNIS HOMME DRY TSH 500 BLANC\r\nETAT\r\nTrès bon\r\n\r\nproduit complet & parfaitement fonctionnel\r\n100% sécuritaire\r\naucune trace d\'utilisation\r\nemballage endommagé ou absent\r\nDESCRIPTION\r\nCe short vous apporte un maximum de confort grâce à son tissu léger, respirant et sa ceinture élastiquée. Ses poches accueillent facilement 2 ou 3 balles de tennis.\r\nNos équipes de conception ont créé ce short pour la pratique du tennis. Il convient également aux autres sports de raquette\r\n\r\nAVANTAGES PRODUIT\r\nPortage de balle\r\nVous pouvez transporter 3 balles sans aucune gêne grâce à ses poches.\r\n\r\nAdaptabilité morphologique\r\nSa ceinture élastiquée permet de s\'ajuster parfaitement sur votre bassin.\r\n\r\nEvacuation de la transpiration\r\nSa matière permet une gestion optimale de la transpiration et sèche rapidement.\r\n\r\nLégèreté\r\nCe short léger (140g en taille L) vous apporte confort et aisance en jeu.\r\n\r\nLiberté de mouvement\r\nCoupe spécialement étudiée pour procurer une totale liberté de mouvements.\r\n\r\nPOINTS DE CONTRÔLE\r\nTous nos produits 2nde vie ont été contrôlés, reconditionnés et reparés par nos technicien(ne)s.\r\n\r\nContrôle visuel du produit', 'SHORT DE TENNIS HOMME DRY TSH 500 BLANC - Très bon ARTENGO | Decathlon', 'SHORT DE TENNIS HOMME DRY TSH 500 BLANC - Très bon au prix de ★ 7€ ★ sur Decathlon.fr. Etat Très bon - Tous nos produits 2nde vie ont été contrôlés, reconditionnés et reparés par nos technicien(ne)s. Photos non contractuelles.', 20),
(65, 'SHORT ADIDAS TASTIGO 19', 28.99, 1, 'XS,S,M,L,XL', 0, 'short-adidas-tastigo-19', NULL, NULL, 'Conçu pour l\'entraînement ou pour les matchs improvisés au parc. Ce short de football t\'offre un maximum de confort quand tu peaufines ta technique. Il est confectionné en tissu à évacuation de la transpiration pour te maintenir au sec, et possède des détails en mesh à l\'arrière pour une ventilation supplémentaire.Matière Climalite qui évacue la transpiration. Taille élastique à cordon de serrage. Insert en mesh à l\'arrière de la jambe.Ce short est confectionné en polyester recyclé pour préserver les ressources de la planète et réduire les émissions carbone.Interlock', 'Short adidas Tastigo 19 ADIDAS | Decathlon', 'Short adidas Tastigo 19 au prix de ★ 28.99€ ★ sur Decathlon.fr. Ce short pour homme est conçu de manière à vous permettre de rester au frais et de bouger comme bon vous semble durant les entraînements partie de loisirs sous le soleil.', 20),
(66, 'SHORT CARGO DE TREK VOYAGE - TRAVEL 100 MARRON HOMME', 25, 1, NULL, 0, 'short-cargo-de-trek-voyage-travel-100-marron-homme', NULL, NULL, 'Réduction de l\'impact environnemental du pantalon\r\nLe coton issu de l’agriculture biologique a été cultivé sans l\'utilisation d\'engrais chimiques, de pesticides et d\'OGM, ce qui diminue le risque de pollution des sols et des nappes phréatiques. Ce mode de production, grâce à des meilleures pratiques environnementales, permet de mieux gérer la culture du coton.\r\n\r\nLe tissu principal de ce short est composé à 65% de ce type de coton, mélangé avec du polyester recyclé.\r\n\r\nUne matière qui ne vous lâchera pas !\r\nL\'armure tramée de la matière, en forme de petits carrés, lui confère des propriétés de résistance supérieures à une matière équivalente mais lisse.\r\n\r\nAdaptabilité morphologique\r\nLa ceinture amovible vous permettra d\'ajuster le pantalon à votre morphologie. Vous pourrez également vous servir de la ceinture sur d\'autres pantalons et shorts, car nous avons veillé à ce que ses dimensions soient standard.\r\n\r\nDe multiples poches\r\nCe short est doté de 8 poches, pour contenir vos indispensables quand vous partez en backpacking :\r\n- 1 poche coté fermée par un zip.\r\n- 1 petite poche ticket.\r\n- 2 poches à rabat sur les fesses, sécurisées par boutons pression.\r\n- 2 poches repose main non sécurisées.\r\n- 2 poches cargo sur les cotés, sécurisées par boutons pression.\r\n\r\nGarantie\r\n2 ans', 'Short cargo de trek voyage - TRAVEL 100 homme FORCLAZ | Decathlon', 'Short cargo de trek voyage - TRAVEL 100 homme au prix de ★ 25€ ★ sur Decathlon.fr. Nos concepteurs backpackers ont conçu ce short pour vous permettre de parcourir le monde en toute sérénité et dans tous les environnements', 20),
(67, 'SHORT CARGO DE TREK VOYAGE - TRAVEL 100 GRIS HOMME', 25, 1, 'XS,S,M,L,XL', 0, 'short-cargo-de-trek-voyage-travel-100-gris-homme', NULL, NULL, 'Réduction de l\'impact environnemental du pantalon\r\nLe coton issu de l’agriculture biologique a été cultivé sans l\'utilisation d\'engrais chimiques, de pesticides et d\'OGM, ce qui diminue le risque de pollution des sols et des nappes phréatiques. Ce mode de production, grâce à des meilleures pratiques environnementales, permet de mieux gérer la culture du coton.\r\n\r\nLe tissu principal de ce short est composé à 65% de ce type de coton, mélangé avec du polyester recyclé.\r\n\r\nUne matière qui ne vous lâchera pas !\r\nL\'armure tramée de la matière, en forme de petits carrés, lui confère des propriétés de résistance supérieures à une matière équivalente mais lisse.\r\n\r\nAdaptabilité morphologique\r\nLa ceinture amovible vous permettra d\'ajuster le pantalon à votre morphologie. Vous pourrez également vous servir de la ceinture sur d\'autres pantalons et shorts, car nous avons veillé à ce que ses dimensions soient standard.\r\n\r\nDe multiples poches\r\nCe short est doté de 8 poches, pour contenir vos indispensables quand vous partez en backpacking :\r\n- 1 poche coté fermée par un zip.\r\n- 1 petite poche ticket.\r\n- 2 poches à rabat sur les fesses, sécurisées par boutons pression.\r\n- 2 poches repose main non sécurisées.\r\n- 2 poches cargo sur les cotés, sécurisées par boutons pression.\r\n\r\nGarantie\r\n2 ans', 'Short cargo de trek voyage - TRAVEL 100 homme FORCLAZ | Decathlon', 'Short cargo de trek voyage - TRAVEL 100 homme au prix de ★ 25€ ★ sur Decathlon.fr. Nos concepteurs backpackers ont conçu ce short pour vous permettre de parcourir le monde en toute sérénité et dans tous les environnements.', 20),
(68, 'SHORT HUMMEL POLY HMLACTION', 16.89, 1, 'XS,S,M,L,XL', 40, 'short-hummel-poly-hmlaction', NULL, NULL, 'Combinant un tissu à double maille avec des panneaux en mesh, le short hmlACTION POLY offre une durabilité pendant le sport ainsi qu\'une ventilation améliorée. Ce short hummel® est composé à 100 % de polyester, qui évacue l\'humidité lorsque vous transpirez. Le short est mi-long et intègre un cordon de serrage à la taille pour ajuster la coupe.', 'Short Hummel Poly hmlACTION HUMMEL | Decathlon', 'Short Hummel Poly hmlACTION au prix de ★ 10.09€ ★ sur Decathlon.fr. Ce short de handball homme, particulièrement bien ventilé, est taillé pour les séances d’entraînement quotidiennes sous le soleil brûlant d’été.', 20);
INSERT INTO `ec_products` (`pdt_id`, `pdt_title`, `pdt_price`, `pdt_activated`, `pdt_option`, `pdt_discount`, `pdt_slug`, `pdt_tagname`, `pdt_short_description`, `pdt_long_description`, `pdt_meta_title`, `pdt_meta_description`, `col_id`) VALUES
(69, 'SHORT ADIDAS TASTIGO 19', 28.99, 1, 'XS,S,M,L,XL', 13, 'short-adidas-tastigo-19', NULL, NULL, 'Conçu pour l\'entraînement ou pour les matchs improvisés au parc. Ce short de football t\'offre un maximum de confort quand tu peaufines ta technique. Il est confectionné en tissu à évacuation de la transpiration pour te maintenir au sec, et possède des détails en mesh à l\'arrière pour une ventilation supplémentaire.Matière Climalite qui évacue la transpiration. Taille élastique à cordon de serrage. Insert en mesh à l\'arrière de la jambe.Ce short est confectionné en polyester recyclé pour préserver les ressources de la planète et réduire les émissions carbone.Interlock', 'Short adidas Tastigo 19 ADIDAS | Decathlon', 'Short adidas Tastigo 19 au prix de ★ 24.99€ ★ sur Decathlon.fr. Ce short de football pour adulte est conçu de manière à vos offrir un maximum de confort et de mobilité lors des entraînements ou les parties improvisées', 20),
(70, 'SOUS-SHORT DE PROTECTION RUGBY HOMME R500 NOIR JAUNE', 29, 1, 'XS,S,M,L,XL', 0, 'sousshort-de-protection-rugby-homme-r500-noir-jaune', NULL, NULL, 'Un sous short qui évolue avec vos remontées\r\nSuite aux différentes remontées de nos clients et utilisateurs, nous avons modifié les zones de protection au niveau des cuisses, et notamment en agrandissant la zone arrière, pour protéger davantage d\'éventuelles béquilles reçues pendant le jeu.\r\nPour compléter votre panoplie et jouer bien protégé, il se mariera parfaitement avec nos différents modèles d\'épaulières.\r\n\r\nLa norme World Rugby\r\nToutes nos protections sont conformes à la réglementation World Rugby (fédération internationale de rugby) pour jouer avec en match. Cette norme nous impose des règles de compositions des mousses sur leur densité (inférieure à 45 kg par M3) et leur épaisseur (inférieure à 1 cm).\r\n\r\nCo-conception\r\nNos protections sont conçus en collaboration avec nos partenaires techniques Juandre Kruger, Bernard Leroux, Eddy Ben Arous et Jonathan Wisniewski, tous joueurs professionnels évoluant en TOP14.\r\nIls nous accompagnent dans l\'amélioration de ces produits en participant à toutes les étapes de conception, et en les validant lors de tests reproduisant toutes les situations et conditions de jeu.\r\n\r\nMarquage CE\r\nLe marquage CE (en vigueur depuis 1993) est l’indicateur principal de la conformité d’un produit aux législations de l’UE et permet la libre circulation au sein du marché européen\r\n\r\nGarantie\r\n2 ans', 'Sous-short de protection rugby homme R500 OFFLOAD | Decathlon', 'Sous-short de protection rugby homme R500 au prix de ★ 29€ ★ sur Decathlon.fr. Nos équipes ont conçu ce sous short de rugby pour se protéger les cuisses, les hanches et le bas du dos des impacts lors des entraînements ou des matchs.', 20),
(71, 'SHORT PUMA POWER COLORBLOCK', 29.99, 1, 'XS,S,M,L,XL', 13, 'short-puma-power-colorblock', NULL, NULL, 'Short homme en mélange de tissu confortable et respirant. Doté d’une coupe longue, il apporte une touche urbaine à votre look estival.', 'Short Puma Power Colorblock PUMA | Decathlon', 'Short Puma Power Colorblock au prix de ★ 25.99€ ★ sur Decathlon.fr. Ce short à la coupe masculine est travaillé pour vous offrir un parfait mix entre confort décontracté et look athlétique lorsque vous sortez de la maison durant l’été', 20),
(72, 'SHORT HUMMEL HMLHMLCORE', 16.89, 1, 'XS,S,M,L,XL', 44, 'short-hummel-hmlhmlcore', NULL, NULL, 'Le hmlCORE XK POLY SHORTS est fabriqué dans une maille double avec une technologie BEECOOL® intégrée. Ce qui veut dire que le short offre une respirabilité améliorée, une grande durabilité et un séchage plus rapide pendant et après le sport. Ce short hummel® possède un cordon de serrage réglable à la taille pour parfaire la coupe. Maille double résistante Technologie BEECOOL® Cordon de serrage réglable à la taille Chevrons imprimés sur la jambe', 'Short Hummel hmlhmlCORE HUMMEL | Decathlon', 'Short Hummel hmlhmlCORE au prix de ★ 9.39€ ★ sur Decathlon.fr. Ce short d’entraînement homme fait appel à la technologie BEEECOOL pour vous apporter le confort et la liberté nécessaire durant vos séances quotidiennes indoor ou outdoor.', 20),
(73, 'BASKETS FLEXIBLES À SCRATCH ENFANT - PW 540 JR BLEUES DU 28 AU 39', 25, 1, '28,29,30,31,32,33,34,35,36,37,38,39', 0, 'baskets-flexibles-a-scratch-enfant-pw-540-jr-bleues-du-28-au-39', NULL, NULL, 'Le saviez-vous ?\r\nLes pieds des enfants sont en pleine croissance, il est normal que leurs pieds soient plats. Imposer une voûte plantaire pourrait, dans le temps, déformer le pied de l’enfant et engendrer des maux de dos. Il vaut mieux laisser le pied de l’enfant se former et se muscler tout seul. C\'est pourquoi les semelles intérieures de nos chaussures ne sont pas dotées de voûte plantaire.\r\nPour plus d’informations : www.newfeel.com\r\n\r\n*Qu\'est-ce-que le concept Flex-H ?\r\nLe concept Flex-H, est un système de trois encoches de flexion en forme de H positionnées à l’avant du pied. Il garantit une flexibilité optimale du pied lors de la phase de propulsion.\r\n\r\nConseil pour une bonne pointure.\r\nUne fois le pied de votre enfant dans la chaussure, maintenez-le en positionnant votre main sur le dessus, assurez-vous que ses orteils soient bien détendus et passez votre doigt dans l’arrière du talon. Si votre doigt est serré mais qu’il passe c’est bon ! N\'hésitez pas à vous reporter sur notre guide des tailles situé au dessus de la sélection des pointures.\r\n\r\nConseil pour des semelles orthopédiques.\r\nPrenez une pointure supérieure ou retirez les semelles intérieures de vos chaussures, elles sont amovibles !\r\n\r\nGarantie\r\n2 ans', 'Baskets flexibles à scratch enfant - PW 540 JR noires du 28 au 39 NEWFEEL | Decathlon', 'Baskets flexibles à scratch enfant - PW 540 JR noires du 28 au 39 au prix de ★ 25€ ★ sur Decathlon.fr. Les baskets PW540 sont conçues pour accompagner les enfants dans leurs activités sportives au quotidien sur toutes surfaces : gymnase, cour de récré, parc...', 21),
(74, 'BASKETS RÉSISTANTES À SCRATCH ENFANT - TS 130 JR BLEU MARINE DU 26 AU 38', 14, 1, '28,29,30,31,32,33,34,35,36,37,38,39', 0, 'baskets-resistantes-a-scratch-enfant-ts-130-jr-bleu-marine-du-26-au-38', NULL, NULL, 'Respirabilité\r\nLanguette en tissu \"MESH\" et perforations sur la tige pour une bonne aération. Le MESH est une matière synthétique permettant plus d’aération et de légèreté de votre chaussure.\r\n\r\nGarantie\r\n2 ans', 'CHAUSSURES ENFANT TENNIS ARTENGO TS130 JR METEOR FLASH ARTENGO | Decathlon', 'CHAUSSURES ENFANT TENNIS ARTENGO TS130 JR METEOR FLASH au prix de ★ 14€ ★ sur Decathlon.fr. Les baskets TS130 ont été conçues pour accompagner votre enfant dans ses journées actives.', 21),
(75, 'CHAUSSURES DE MARCHE ENFANT KAPPA SEATTLE LACETS NOIR', 45, 1, '28,29,30,31,32,33,34,35,36,37,38,39', 40, 'chaussures-de-marche-enfant-kappa-seattle-lacets-noir', NULL, NULL, 'Garantie\r\n2 ans', 'Chaussures de marche enfant Kappa Seattle lacets noir KAPPA | Decathlon', 'Chaussures de marche enfant Kappa Seattle lacets noir au prix de ★ 27€ ★ sur Decathlon.fr. Cette chaussure convient pour la marche, le sport à l\'école et les activités quotidiennes des enfants', 21),
(76, 'CHAUSSURES DE RUNNING ENFANT ADIDAS TENSAUR', 28.99, 1, '28,29,30,31,32,33,34,35,36,37,38,39', 0, 'chaussures-de-running-enfant-adidas-tensaur', NULL, NULL, 'Cette sneaker adidas est parfaite pour les kids qui préfèrent les fermetures à scratch aux lacets classiques. Parfaite pour courir pour attraper le bus, jouer au dodge ball en cours de sport, faire des courses après l\'école : sa tige durable leur offre un maintien durable toute la journée. Les 3 bandes adidas classiques de couleur contrastée apportent une touche sporty.Coupe standard.', 'Chaussures de running enfant adidas Tensaur ADIDAS | Decathlon', 'Chaussures de running enfant adidas Tensaur au prix de ★ 28.99€ ★ sur Decathlon.fr. Chaussures de running enfant adidas Tensaur', 21),
(77, 'CHAUSSURES DE BASKETBALL POUR GARCON/FILLE SS500M VIOLET NBA LOS ANGELES LAKERS', 55, 1, NULL, 0, 'chaussures-de-basketball-pour-garcon-fille-ss500m-violet-nba-los-angeles-lakers', NULL, NULL, 'Pourquoi choisir cette chaussure de basketball pour votre enfant ?\r\nCette chaussure assure un confort optimal pour votre enfant qui joue au basketball. Il pourra vous le confirmer juste en passant la chaussure à son pied ! La qualité de l\'amorti en fait un véritable chausson pour la pratique et vous nous le témoignez à travers vos avis clients ! Sa semelle extérieure est en caoutchouc supérieur favorisant l\'adhérence : votre enfant reste bien stable sur ses appuis. Respirante, vos petits champions pourront se donner à fond dans le jeu et garder les pieds au sec.\r\n\r\nQui conçoit les produits pour vos enfants ?\r\nTarmak, c\'est une équipe de passionnés qui travaille sur le développement de produits dédiés à la pratique du basketball. L\'ensemble de la gamme chaussures est conçue pour répondre aux joueurs et joueuses de basket les plus exigeants et vous permettre de prendre un maximum de plaisir pendant vos séances d\'entrainement et de matchs.\r\n\r\nSaviez vous que tous les produits TARMAK sont testés en conditions de jeu ?\r\nL\'équipe de conception des produits TARMAK est basée à Kipstadium dans le Nord de la France. Elle recherche en permanence à améliorer le confort des joueurs et joueuses dans la pratique du basket. Tous nos produits sont conçus avec des composants dont nous validons la qualité d\'amorti, le maintien, la résistance.... 100% des modèles sont testés en situation réelle par des basketteurs pendant plusieurs semaines et évoluent grâce à vos avis.\r\n\r\nS\'équiper, s\'entraîner...Découvrez tous nos conseils sportifs en basketball !\r\nTarmak vous accompagne dans votre pratique du basketball, débutant ou joueur régulier. Découvrez tous nos conseils pour vous entraîner, vous équiper, vous amuser seul ou à plusieurs !\r\n\r\nhttps://conseilsport.decathlon.fr/conseils/basketball-al_332\r\n\r\nTARMAK partenaire de la NBA !\r\nLa marque de Basketball de DECATHLON TARMAK est désormais partenaire de la NBA. \r\nCe partenariat avec la National Basketball Association se concrétise par une collection de produits cobrandés NBA X TARMAK aux couleurs et logo des meilleures franchises NBA sur des produits tels que : des chaussures, des protections (coudières et genouillères), sous-vêtements, sous-shorts, maintiens articulaires et musculaires.\r\n\r\nla NBA débarque chez DECATHLON !\r\nRetrouvez vos équipes NBA préférées comme les LOS ANGELES LAKERS, les GOLDEN STATE WARRIORS, les HOUSTON ROCKETS, les NEW-YORK KNICKS, les LOS ANGELES CLIPPERS, les BOSTON CELTICS, le HEAT de MIAMI, ou encore les BROOKLYN NETS', 'CHAUSSURES DE BASKETBALL POUR GARCON/FILLE CONFIRME(E) SS500M TARMAK | Decathlon', 'CHAUSSURES DE BASKETBALL POUR GARCON/FILLE CONFIRME(E) SS500M au prix de ★ 55€ ★ sur Decathlon.fr. Nos équipes de conception ont développé ce produit pour les enfants pratiquant le basketball de manière régulière. Joueurs ou joueuses confirmés.', 21),
(78, 'BASKETS RÉSISTANTES À SCRATCH ENFANT - TS 130 JR ROSES DU 26 AU 38', 14, 1, '28,29,30,31,32,33,34,35,36,37,38,39', 0, 'baskets-resistantes-a-scratch-enfant-ts-130-jr-roses-du-26-au-38', NULL, NULL, 'Respirabilité\r\nLanguette en tissu \"MESH\" et perforations sur la tige pour une bonne aération. Le MESH est une matière synthétique permettant plus d’aération et de légèreté de votre chaussure.\r\n\r\nGarantie\r\n2 ans', 'CHAUSSURES ENFANT TENNIS ARTENGO TS130 JR METEOR FLASH ARTENGO | Decathlon', 'CHAUSSURES ENFANT TENNIS ARTENGO TS130 JR METEOR FLASH au prix de ★ 14€ ★ sur Decathlon.fr. Les baskets TS130 ont été conçues pour accompagner votre enfant dans ses journées actives.', 21),
(79, 'CHAUSSURES RUNNING &amp; ATHLÉTISME ENFANT KIPRUN GRIP GRISES ET NOIRES ORANGES FLUO', 30, 1, '28,29,30,31,32,33,34,35,36,37,38,39', 0, 'chaussures-running-&amp;-athletisme-enfant-kiprun-grip-grises-et-noires-oranges-fluo', NULL, NULL, 'Deux concepts exclusifs, la mousse Kalensole® et le CS®\r\nGrâce à notre concept exclusif CS® au talon et notre mousse Kalensole®. La semelle du modèle Kiprun Grip lui permet d\'avoir une meilleure absorption des impacts ainsi qu\'une meilleure relance par rapport à une mousse classique.\r\n\r\nQu\'est ce que le drop ?\r\nLe drop sur une chaussure, c\'est la différence de hauteur de semelle entre l\'avant du pied et le talon. Un drop réduit préserve le mouvement naturel du pied lors de la course et permet de minimiser les sollicitations dites \"biomécaniques\". Ces dernières peuvent être à l\'origine des blessures. Sur ces chaussures AT Breath, le drop a été réduit de 6 mm avec pour ambition de respecter la foulée naturelle des plus petits !\r\n\r\nComment entretenir leurs chaussures ?\r\nLe traitement de surface pour la déperlance permet de faciliter le nettoyage et un séchage plus rapide. Comme il empêche la boue de s\'incruster dans la maille, il suffit de frotter avec une brosse légère et un peu d\'eau savonneuse puis de laisser sécher à l\'air libre.\r\n\r\nGarantie\r\n2 ans', 'CHAUSSURES RUNNING &amp; ATHLÉTISME ENFANT KIPRUN GRIP GRISES ET NOIRES ORANGES FLUO KALENJI | Decathlon', 'CHAUSSURES RUNNING &amp; ATHLÉTISME ENFANT KIPRUN GRIP GRISES ET NOIRES ORANGES FLUO au prix de ★ 30€ ★ sur Decathlon.fr. Notre équipe passionnée d\'athlétisme a conçu cette chaussure pour progresser en athlé ou découvrir le cross-country, sur des terrains gras comme rocailleux.', 21),
(80, 'CHAUSSURES ATHLÉTISME ENFANT EQ21 BLEU ORANGE', 55, 1, '28,29,30,31,32,33,34,35,36,37,38,39', 0, 'chaussures-athletisme-enfant-eq21-bleu-orange', NULL, NULL, 'Garantie\r\n1 an', 'Chaussures athlétisme enfant EQ21 Bleu orange ADIDAS | Decathlon', 'Chaussures athlétisme enfant EQ21 Bleu orange au prix de ★ 55€ ★ sur Decathlon.fr. Que tes enfants courent pour leur sport favori ou simplement pour s\'amuser, cette chaussure adidas leur offre un maximum de confort !', 21),
(81, 'CHAUSSURES DE RUNNING ENFANT ADIDAS RUNFALCON 2.0', 39.99, 1, '28,29,30,31,32,33,34,35,36,37,38,39', 10, 'chaussures-de-running-enfant-adidas-runfalcon-2.0', NULL, NULL, 'Une chaussure pour tous les jours, des salles de classe aux cours de sport en passant par les courses du week-end. Cette sneaker adidas est faite pour les kids qui viennent d\'intégrer l\'équipe d\'athlétisme ou qui ont juste besoin de bouger toute la journée avec confiance. Légère, elle reste confortable même pendant les longues journées.Coupe standard.', 'Chaussures de running enfant adidas Runfalcon 2.0 ADIDAS | Decathlon', 'Chaussures de running enfant adidas Runfalcon 2.0 au prix de ★ 35.99€ ★ sur Decathlon.fr. Ces baskets enfant se portent aussi bien lors des runs quotidiens qu’à l’école. Quelle que soit la situation, elles offrent un bon mix entre confort, performance et style', 21),
(82, 'CHAUSSURES DE BASKETBALL EASY POUR GARCON/FILLE DEBUTANT(E) SE100 NOIR ROUGE', 25, 1, 'XS,S,M,L,XL', 0, 'chaussures-de-basketball-easy-pour-garcon-fille-debutant(e)-se100-noir-rouge', NULL, NULL, 'Pourquoi choisir cette chaussure de basketball pour votre enfant ?\r\nIl n\'y a plus de lacet à faire ! Les enfants sont autonomes pour enfiler et retirer leurs chaussures. Il leur suffit d\'ouvrir le scratch sur le haut de la tige, mettre le pied dans la chaussure et refermer le scratch. Ensuite à eux les terrains ! Plus besoin d\'interrompre l\'entraînement ou le match pour refaire ses lacets et surtout éviter toute chute ! Soyez rassuré, même si c\'est simple le scratch et les élastiques garantissent le bon maintien du pied de votre petit/petite champion(e) !\r\n\r\nQui conçoit les produits pour vos enfants ?\r\nTarmak, c\'est une équipe de passionnés qui travaille sur le développement de produits dédiés à la pratique du basketball. L\'ensemble de la gamme chaussures est conçue pour répondre aux joueurs et joueuses de basket les plus exigeants et vous permettre de prendre un maximum de plaisir pendant vos séances d\'entrainement et de matchs.\r\n\r\nSaviez vous que tous les produits TARMAK sont testés en conditions de jeu ?\r\nL\'équipe de conception des produits TARMAK est basée dans le Nord de la France. Elle recherche en permanence à améliorer ses produits pour la satisfaction des sportifs. 100% des modèles sont testés en situation réelle par des sportifs exigeants pendant plusieurs semaines et évoluent grâce à vos avis.\r\n\r\nS\'équiper, s\'entraîner...Découvrez tous nos conseils sportifs en basketball !\r\nTarmak vous accompagne dans votre pratique du basketball, débutant ou joueur régulier. Découvrez tous nos conseils pour vous entraîner, vous équiper, vous amuser seul ou à plusieurs !\r\n\r\nhttps://conseilsport.decathlon.fr/conseils/basketball-al_332\r\n\r\nGarantie\r\n2 ans', 'CHAUSSURES DE BASKETBALL EASY POUR GARCON/FILLE DEBUTANT(E) SE100 TARMAK | Decathlon', 'CHAUSSURES DE BASKETBALL EASY POUR GARCON/FILLE DEBUTANT(E) SE100 au prix de ★ 25€ ★ sur Decathlon.fr. Cette chaussure de basketball pour enfant a été conçue pour les jeunes joueurs ou joueuses débutants pratiquant le basketball.', 21),
(83, 'CHAUSSURES DE TENNIS ENFANT JAPAN S JR BLANC', 45, 1, '28,29,30,31,32,33,34,35,36,37,38,39', 0, 'chaussures-de-tennis-enfant-japan-s-jr-blanc', NULL, NULL, 'STYLE\r\nImitant l\'esthétique d\'une basket rétro, ce style traditionnel pour enfant dispose également des emblèmes nostalgiques ASICS, comme les rayures tigres sur les quarts de panneaux et les caractères ASICS au talon.\r\n\r\nGarantie\r\n2 ans', 'CHAUSSURES DE TENNIS ENFANT JAPAN S JR BLANC ASICS | Decathlon', 'CHAUSSURES DE TENNIS ENFANT JAPAN S JR BLANC au prix de ★ 45€ ★ sur Decathlon.fr. Conçues pour le jeune joueur à la recherche d\'une chaussure au confort optimal et avec un amorti durable pour débuter le tennis ou pour le sport à l\'école.', 21);

-- --------------------------------------------------------

--
-- Structure de la table `ec_users`
--

DROP TABLE IF EXISTS `ec_users`;
CREATE TABLE IF NOT EXISTS `ec_users` (
  `usr_id` int(11) NOT NULL AUTO_INCREMENT,
  `usr_mail` varchar(200) NOT NULL,
  `usr_password` varchar(200) NOT NULL,
  `usr_lastname` varchar(100) NOT NULL,
  `usr_firstname` varchar(100) NOT NULL,
  `usr_accept_newsletters` tinyint(1) NOT NULL,
  `usr_registered` date NOT NULL,
  `usr_account_activate` tinyint(1) NOT NULL,
  `usr_role` int(11) NOT NULL,
  `usr_token_mail` varchar(255) DEFAULT NULL,
  `usr_token_password` varchar(255) DEFAULT NULL,
  `usr_time_validity_token` datetime DEFAULT NULL,
  `usr_adress` varchar(255) DEFAULT NULL,
  `usr_zip_code` varchar(10) DEFAULT NULL,
  `usr_city` varchar(255) DEFAULT NULL,
  `usr_country` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`usr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1258 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `ec_users`
--

INSERT INTO `ec_users` (`usr_id`, `usr_mail`, `usr_password`, `usr_lastname`, `usr_firstname`, `usr_accept_newsletters`, `usr_registered`, `usr_account_activate`, `usr_role`, `usr_token_mail`, `usr_token_password`, `usr_time_validity_token`, `usr_adress`, `usr_zip_code`, `usr_city`, `usr_country`) VALUES
(205, 'trablan45@mashable.com', 'cxVcVb', 'Rablan', 'Truman', 0, '2020-07-29', 1, 150, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(215, 'jstill4f@nydailynews.com', 'CWsvOIqgB5j9', 'Still', 'Junie', 0, '2020-03-29', 1, 160, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(221, 'sschach4l@ask.com', 'gRpCOrx', 'Schach', 'Sigfrid', 0, '2020-03-08', 1, 166, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(224, 'csaturley4o@friendfeed.com', 'VQEMRrORO', 'Saturley', 'Corrine', 1, '2020-11-03', 1, 169, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(231, 'ksollon4v@chronoengine.com', '7eMnVISnxqRG', 'Sollon', 'Killian', 0, '2021-09-14', 1, 176, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(250, 'mperview5e@uiuc.edu', 'HX0aYdhv', 'Perview', 'Meridel', 0, '2021-08-03', 1, 195, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(251, 'astenning5f@cdc.gov', '28Lm1nSSa1Y', 'Stenning', 'Aundrea', 0, '2021-12-12', 1, 196, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(276, 'bsongustk@mozilla.org', 'g81VVoy90m27', 'Songust', 'Bellanca', 0, '2021-12-24', 1, 21, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(280, 'oshamao@slate.com', '0SYzwC5Q', 'Shama', 'Orsa', 0, '2021-06-17', 1, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(290, 'gspeery@vimeo.com', 'CFsZ5C', 'Speer', 'Guendolen', 0, '2020-04-13', 1, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(294, 'jskrines12@state.tx.us', 'FdxqwrA4pol', 'Skrines', 'Juieta', 0, '2021-04-04', 1, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(305, 'ssibbald1d@google.com', 'LEdXfeW2bx', 'Sibbald', 'Shayne', 0, '2021-02-25', 1, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(336, 'tstuckey28@ustream.tv', '6K0L5Vj', 'Stuckey', 'Tommie', 1, '2020-08-26', 1, 81, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(355, 'bphilippart2r@yahoo.co.jp', '7P25RwM26eAU', 'Philippart', 'Blisse', 0, '2021-12-24', 1, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(375, 'lschutte3b@usnews.com', 'D4dF16e', 'Schutte', 'Lennard', 1, '2020-05-16', 1, 120, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(393, 'dschubart3t@blogspot.com', 'i1lkCQWC1Gqr', 'Schubart', 'Didi', 0, '2020-03-22', 1, 138, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(396, 'mpeterkin3w@hhs.gov', 'FVrFe1iz30k8', 'Peterkin', 'Mandie', 1, '2020-11-06', 1, 141, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(416, 'vscholl4g@apache.org', 'IfDAtN', 'Scholl', 'Vinnie', 0, '2020-07-21', 1, 161, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(433, 'jshaddock4x@zdnet.com', 'dwYY9cm6udu0', 'Shaddock', 'Jareb', 0, '2021-10-26', 1, 178, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(446, 'kstopford5a@desdev.cn', '7fqEsB20pu', 'Stopford', 'Kynthia', 0, '2020-06-07', 1, 191, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(451, 'lstitch5f@ebay.co.uk', 'U1fJ4R5B', 'Stitch', 'Leticia', 1, '2020-06-20', 1, 196, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(487, 'trarity6f@hatena.ne.jp', 'UmwGosI2EUN2', 'Rarity', 'Tamarra', 1, '2021-07-22', 1, 232, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(498, 'spulley6q@chicagotribune.com', 'pJP9GcMS91k', 'Pulley', 'Shaughn', 1, '2021-09-25', 1, 243, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(509, 'sraftery71@mlb.com', 'xmIsRZJ8To7a', 'Raftery', 'Stephenie', 0, '2020-09-07', 1, 254, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(529, 'srennison7l@ftc.gov', 'YmioaiHH4E2', 'Rennison', 'Shirl', 1, '2021-08-07', 1, 274, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(539, 'sstratton7v@google.com.hk', '8ltsm2iW', 'Stratton', 'Stearn', 1, '2021-08-24', 1, 284, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(554, 'dpersence8a@upenn.edu', 'CLGcD0AL', 'Persence', 'Dorothy', 1, '2022-01-13', 1, 299, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(571, 'eskaifedingerthorpe8r@bigcartel.com', 'UNHukLru', 'Skaife d\'Ingerthorpe', 'Elliot', 0, '2021-07-06', 1, 316, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(602, 'mriquet9m@discovery.com', 'nDk5aFU1zWH', 'Riquet', 'Midge', 0, '2021-07-09', 1, 347, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(622, 'triglesforda6@deviantart.com', 'TtT7hto', 'Riglesford', 'Trumaine', 1, '2021-09-04', 1, 367, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(631, 'aschustaf@ted.com', '6e6yjo0hR', 'Schust', 'Archer', 1, '2020-09-23', 1, 376, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(667, 'wscrannybf@about.com', 'AFCWT6KJ9UT6', 'Scranny', 'Wrennie', 1, '2020-06-26', 1, 412, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(670, 'asilcoxbi@foxnews.com', 'aSZuUOKXFwB', 'Silcox', 'Albertina', 0, '2020-05-10', 1, 415, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(715, 'ariddingtoncr@wunderground.com', 'HeaYTLwnwnmT', 'Riddington', 'Addia', 1, '2020-05-09', 1, 460, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(773, 'trawlynsed@ibm.com', '4G5zSg0LdCk', 'Rawlyns', 'Tiffie', 0, '2020-12-20', 1, 518, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(792, 'lribbensew@addtoany.com', 'DPYPKZa', 'Ribbens', 'Lester', 1, '2020-07-18', 1, 537, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(808, 'lserotskyfc@apache.org', '1hyo55P3t4v', 'Serotsky', 'Liz', 1, '2020-12-30', 1, 553, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(812, 'aserotfg@comsenz.com', 'FQ8NDvd', 'Serot', 'Ali', 1, '2020-04-23', 1, 557, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(837, 'csmallshawg5@theguardian.com', 'DuM3URKS', 'Smallshaw', 'Carolus', 0, '2021-04-11', 1, 582, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(845, 'bronnaygd@wordpress.com', '8Xejng', 'Ronnay', 'Bernadette', 0, '2020-04-08', 1, 590, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(857, 'epeytogp@devhub.com', 'rhy5vXkdP', 'Peyto', 'Etty', 1, '2022-01-24', 1, 602, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(862, 'eriggottgu@wordpress.org', 'WYABam8B', 'Riggott', 'Elbertina', 1, '2021-11-30', 1, 607, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(929, 'dsmeeip@skyrock.com', 'OkySpp', 'Smee', 'Dieter', 1, '2021-10-19', 1, 674, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(932, 'eskinnis@icio.us', 'iOaif2J', 'Skinn', 'Emmerich', 0, '2020-07-12', 1, 677, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(939, 'wstogglesiz@wufoo.com', 'kxdW4Cm5E', 'Stoggles', 'Wilt', 0, '2022-02-05', 1, 684, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(946, 'ashipseyj6@jugem.jp', '1IbZRfYIX1L', 'Shipsey', 'Adolphe', 0, '2021-04-11', 1, 691, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(957, 'jshepherdsonjh@webmd.com', 'wTKo5tUXQ', 'Shepherdson', 'Jeri', 0, '2021-11-01', 1, 702, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(964, 'grennickjo@barnesandnoble.com', 'InrIw1iVL9OI', 'Rennick', 'Gelya', 0, '2020-07-27', 1, 709, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(966, 'crookesjq@fc2.com', 'k4a18I', 'Rookes', 'Clemmy', 1, '2021-08-11', 1, 711, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(968, 'crackleyjs@plala.or.jp', 'G97EN5', 'Rackley', 'Cassius', 1, '2021-07-31', 1, 713, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(983, 'bsticklesk7@ycombinator.com', '1ldWZdb', 'Stickles', 'Britt', 0, '2020-09-04', 1, 728, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(989, 'dsearlkd@nationalgeographic.com', 'yvnE4LY', 'Searl', 'Danita', 1, '2020-07-29', 1, 734, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(992, 'ssimchenkokg@go.com', 'Mt3w4x', 'Simchenko', 'Shepperd', 1, '2020-06-22', 1, 737, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(994, 'aprovostki@sfgate.com', 'ezl9jgWH', 'Provost', 'Ag', 1, '2020-06-20', 1, 739, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1005, 'jsearbykt@edublogs.org', 'ipPY3Kwl', 'Searby', 'Jade', 0, '2021-08-22', 1, 750, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1022, 'jsherrinla@hc360.com', 'YMtVYwp47xzI', 'Sherrin', 'Jewell', 1, '2020-04-25', 1, 767, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1096, 'arebichonnc@spiegel.de', 'NXR1yQlf', 'Rebichon', 'Adam', 1, '2022-01-21', 1, 841, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1105, 'erayhillnl@pen.io', 'EohGt4Gv8f', 'Rayhill', 'Ernaline', 1, '2021-07-30', 1, 850, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1148, 'ssoutenos@state.tx.us', '7kNQsWhF', 'Souten', 'Stormie', 0, '2021-11-14', 1, 893, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1212, 'rridholeqk@csmonitor.com', 'lPeq1uk', 'Ridhole', 'Richie', 0, '2021-07-05', 1, 957, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1221, 'jpettisallqt@soundcloud.com', 'vw3xMzc', 'Pettisall', 'Jefferson', 1, '2020-09-22', 1, 966, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1248, 'tsedgerk@amazon.de', 'DU1xx0', 'Sedge', 'Ty', 0, '2020-11-17', 1, 993, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1254, 'gpoolyrq@prnewswire.com', 'T2Riufizct77', 'Pooly', 'Garold', 1, '2021-09-05', 1, 999, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1255, 'fplumleyrr@pcworld.com', 'UqQlE4c7ivW', 'Plumley', 'Franklin', 0, '2020-06-13', 1, 1000, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1257, 'alexy.lepretre76@laposte.net', '$2y$10$zELJv31X4.aYyLke61iit.20dlA72kNSIpnzzrwwNOalVY8H/7R02', 'Lepretre', 'Alexy', 1, '2022-02-20', 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `ec_collection`
--
ALTER TABLE `ec_collection`
  ADD CONSTRAINT `ec_collection_ec_category_FK` FOREIGN KEY (`cat_id`) REFERENCES `ec_category` (`cat_id`);

--
-- Contraintes pour la table `ec_commands_clients`
--
ALTER TABLE `ec_commands_clients`
  ADD CONSTRAINT `ec_commands_clients_ec_products_FK` FOREIGN KEY (`pdt_id`) REFERENCES `ec_products` (`pdt_id`),
  ADD CONSTRAINT `ec_commands_clients_ec_users0_FK` FOREIGN KEY (`usr_id`) REFERENCES `ec_users` (`usr_id`);

--
-- Contraintes pour la table `ec_comments_products`
--
ALTER TABLE `ec_comments_products`
  ADD CONSTRAINT `ec_comments_products_ec_products_FK` FOREIGN KEY (`pdt_id`) REFERENCES `ec_products` (`pdt_id`);

--
-- Contraintes pour la table `ec_get_images`
--
ALTER TABLE `ec_get_images`
  ADD CONSTRAINT `ec_get_images_ec_images_FK` FOREIGN KEY (`img_id`) REFERENCES `ec_images` (`img_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ec_get_images_ec_products0_FK` FOREIGN KEY (`pdt_id`) REFERENCES `ec_products` (`pdt_id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `ec_products`
--
ALTER TABLE `ec_products`
  ADD CONSTRAINT `ec_products_ec_collection_FK` FOREIGN KEY (`col_id`) REFERENCES `ec_collection` (`col_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
