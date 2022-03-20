-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 04 mars 2022 à 14:33
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `ec_category`
--

INSERT INTO `ec_category` (`cat_id`, `cat_name`, `cat_position`, `cat_slug`) VALUES
(1, 'Bijoux', 3, 'bijoux'),
(2, 'Vêtements', 5, 'vetements'),
(3, 'Test', 1, 'test'),
(4, 'Test2', 4, 'test2'),
(5, 'Hadi', 2, 'hadi');

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `ec_collection`
--

INSERT INTO `ec_collection` (`col_id`, `col_name`, `col_position`, `col_slug`, `col_content_html`, `col_meta_title`, `col_meta_description`, `cat_id`) VALUES
(1, 'Bagues', 3, 'bagues', NULL, NULL, NULL, 1),
(2, 'Colliers', 1, 'colliers', NULL, NULL, NULL, 1),
(3, 'Bracelets', 2, 'bracelets', NULL, NULL, NULL, 1),
(4, 'Pantalons', 2, 'pantalons', NULL, NULL, NULL, 2),
(5, 'T-Shirts', 1, 't-shirts', NULL, NULL, NULL, 2),
(6, 'col1', 4, 'col1', NULL, NULL, NULL, 3),
(7, 'col2', 1, 'col2', NULL, NULL, NULL, 3),
(8, 'col3', 2, 'col3', NULL, NULL, NULL, 3),
(9, 'col4', 3, 'col4', NULL, NULL, NULL, 3),
(10, 'col1', 1, 'col1', NULL, NULL, NULL, 4),
(11, 'test', 1, 'test', NULL, NULL, NULL, 5);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `ec_products`
--

INSERT INTO `ec_products` (`pdt_id`, `pdt_title`, `pdt_price`, `pdt_activated`, `pdt_option`, `pdt_discount`, `pdt_slug`, `pdt_tagname`, `pdt_short_description`, `pdt_long_description`, `pdt_meta_title`, `pdt_meta_description`, `col_id`) VALUES
(5, 'Produit5', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4),
(6, 'Produit6', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5),
(7, 'Produit7', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5),
(12, 'Produit12', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(17, 'Bague Tête de Mort Diamant', 99.9, 1, 'XS,S,M,L,XL', 25, 'bague-tete-de-mort-diamant', NULL, NULL, NULL, '', '', 3),
(21, 'Bague Tête de Mort', 50, 1, 'XS,S,M,L,XL', 20, 'bague-tete-de-mort', NULL, NULL, NULL, 'Bague Tête de Mort | Crâne Faction', 'Nos Bagues Têtes de Mort forgées dans les entrailles de l\'enfer vont te faire craquer. Biker dissident, punk, métalleux énervé ou gothique : bienvenue !', 1),
(23, 'T Shirt tête de mort', 58.3, 0, 'XS,S,M,L,XL', 10, 't-shirt-tete-de-mort', NULL, NULL, NULL, 'T Shirt Tête de mort | Crâne', 'Nos T-Shirt sont conçus avec des tissus de qualité, retrouvez tous nos T-Shirt Tête de Mort dans la catégorie Vêtements et profitez de toutes les promos', 8);

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
(834, 'lsmittouneg2@ftc.gov', 'AOAovK3zYp', 'Smittoune', 'Lonna', 1, '2021-09-27', 1, 579, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(837, 'csmallshawg5@theguardian.com', 'DuM3URKS', 'Smallshaw', 'Carolus', 0, '2021-04-11', 1, 582, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(845, 'bronnaygd@wordpress.com', '8Xejng', 'Ronnay', 'Bernadette', 0, '2020-04-08', 1, 590, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(857, 'epeytogp@devhub.com', 'rhy5vXkdP', 'Peyto', 'Etty', 1, '2022-01-24', 1, 602, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(862, 'eriggottgu@wordpress.org', 'WYABam8B', 'Riggott', 'Elbertina', 1, '2021-11-30', 1, 607, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(907, 'fpeiseri3@livejournal.com', '6A8CltMARv6M', 'Peiser', 'Fionna', 1, '2021-11-26', 1, 652, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
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
(1028, 'mslorancelg@nationalgeographic.com', 'jP59zK', 'Slorance', 'Maddie', 1, '2021-06-01', 1, 773, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1096, 'arebichonnc@spiegel.de', 'NXR1yQlf', 'Rebichon', 'Adam', 1, '2022-01-21', 1, 841, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1099, 'msinnottnf@tumblr.com', 'wlq6FiFiw', 'Sinnott', 'Maximilianus', 1, '2021-12-09', 1, 844, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
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
  ADD CONSTRAINT `ec_get_images_ec_images_FK` FOREIGN KEY (`img_id`) REFERENCES `ec_images` (`img_id`),
  ADD CONSTRAINT `ec_get_images_ec_products0_FK` FOREIGN KEY (`pdt_id`) REFERENCES `ec_products` (`pdt_id`);

--
-- Contraintes pour la table `ec_products`
--
ALTER TABLE `ec_products`
  ADD CONSTRAINT `ec_products_ec_collection_FK` FOREIGN KEY (`col_id`) REFERENCES `ec_collection` (`col_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
