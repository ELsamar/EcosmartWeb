-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 21, 2019 at 03:11 PM
-- Server version: 5.7.21
-- PHP Version: 7.0.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecosmartf`
--

-- --------------------------------------------------------

--
-- Table structure for table `annonce`
--

DROP TABLE IF EXISTS `annonce`;
CREATE TABLE IF NOT EXISTS `annonce` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `createur` int(11) DEFAULT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `dateannonce` date NOT NULL,
  `adresse` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F65593E5FAD8DA84` (`createur`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `annonce`
--

INSERT INTO `annonce` (`id`, `createur`, `titre`, `description`, `photo`, `dateannonce`, `adresse`) VALUES
(1, 2, 'anonce', 'qiovhujvBUJ', '6c94fa33deed586ad60b7129d1a3452f.jpeg', '2019-03-07', ''),
(2, 6, 'test', 'aaaa', '6c57e258d60325ca0140f1dd51d12a48.png', '2019-05-21', 'Ariana');

-- --------------------------------------------------------

--
-- Table structure for table `association`
--

DROP TABLE IF EXISTS `association`;
CREATE TABLE IF NOT EXISTS `association` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_resp` int(11) DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `num_contact` int(11) NOT NULL,
  `site` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FD8521CC7159F9CB` (`id_resp`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `association`
--

INSERT INTO `association` (`id`, `id_resp`, `nom`, `description`, `adresse`, `num_contact`, `site`, `logo`) VALUES
(1, NULL, 'Interact', 'xxxxxxxxxxxxxxxxxxxxxxxx', 'Boumhal', 23915434, 'http://test', '87c608f986377a58cd3d638b1aead839.png'),
(2, 6, 'Interact 2', 'xxxxxxxxxxxxxxxxxxxxxxxx', 'Boumhal', 11111111, 'http://testlll', '5bc6d7649c22bc775d392c0069b322f9.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`product_id`),
  KEY `IDX_BA388B7A76ED395` (`user_id`),
  KEY `IDX_BA388B74584665A` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `challenge`
--

DROP TABLE IF EXISTS `challenge`;
CREATE TABLE IF NOT EXISTS `challenge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `commentaireannonce`
--

DROP TABLE IF EXISTS `commentaireannonce`;
CREATE TABLE IF NOT EXISTS `commentaireannonce` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `annonce_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `contenu` longtext COLLATE utf8_unicode_ci NOT NULL,
  `posted_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1BE2A4E18805AB2F` (`annonce_id`),
  KEY `IDX_1BE2A4E1A76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `commentaireannonce`
--

INSERT INTO `commentaireannonce` (`id`, `annonce_id`, `user_id`, `contenu`, `posted_at`) VALUES
(1, 1, 6, 'waw', '2019-05-21 14:18:31');

-- --------------------------------------------------------

--
-- Table structure for table `demande_association`
--

DROP TABLE IF EXISTS `demande_association`;
CREATE TABLE IF NOT EXISTS `demande_association` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `num_tel` int(11) DEFAULT NULL,
  `qualite` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `experience` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `motivation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `etat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `User_id` int(11) DEFAULT NULL,
  `Assoc_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5CA27EB868D3EA09` (`User_id`),
  KEY `IDX_5CA27EB87BD20C90` (`Assoc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `demande_association`
--

INSERT INTO `demande_association` (`id`, `nom`, `email`, `num_tel`, `qualite`, `experience`, `motivation`, `etat`, `User_id`, `Assoc_id`) VALUES
(2, 'ttt', 'ahmed.sahli@esprit.tn', 11111111, 'yyyyy', 'yyyyyy', 'yyyyyy', 'Acceptée', 6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `evenement`
--

DROP TABLE IF EXISTS `evenement`;
CREATE TABLE IF NOT EXISTS `evenement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idcreateur` int(11) DEFAULT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start` date NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `etat` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'en attente',
  `realise` tinyint(1) NOT NULL,
  `place` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `affiche` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dateajout` date NOT NULL,
  `nb` int(11) NOT NULL,
  `heure` time DEFAULT NULL,
  `vu` int(11) NOT NULL,
  `etoile` int(11) DEFAULT NULL,
  `latitude` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B26681E500D9289` (`idcreateur`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `evenement`
--

INSERT INTO `evenement` (`id`, `idcreateur`, `titre`, `start`, `description`, `type`, `etat`, `realise`, `place`, `affiche`, `dateajout`, `nb`, `heure`, `vu`, `etoile`, `latitude`, `longitude`) VALUES
(5, 2, 'jardinage', '2019-05-02', 'khsqiohqoihnvh', 'jardinage', 'en attente', 1, 'iopshio', '6b572e0a7ab184213b85d990fac79270.jpeg', '2019-05-02', 2, '06:00:00', 100, 4, '36.81897', '10.16579'),
(6, 3, 'bricolage enfant', '2019-03-09', 'zfijfihjaioknojvenoihzozb<ve<', 'bricolage recyclage', 'accepted', 1, 'chez jardin d\'enfants happy kids', '5a3567a745e5e39580f8d0ed50424c22.jpeg', '2019-04-19', 3, '08:00:00', 21, 3, '36.81897', '10.16579'),
(7, 2, 'jardinage à la ville', '2019-02-19', 'kvdnjjBHUJUGOJIOHUIbduviduhv', 'jardinage', 'accepted', 1, 'rue l  independence  , tunis', '6fafdfef2904bed712cffcdee52e0733.jpeg', '2019-04-19', 18, '07:00:00', 12, 3, '36.81897', '10.16579'),
(8, 2, 'ecosysteme', '2019-03-15', 'ovpdsjoihbidj<vin<ibojinioghiodhfn<r', 'conférence environnementale', 'accepted', 1, 'Sousse Palace Hotel & Spa, Avenue Habib Bourguiba, Sousse', '71282e6dde12cd23040860b7f78d5c27.jpeg', '2019-04-19', 0, '08:00:00', 16, 0, '35.8310325', '10.6395668'),
(9, 2, 'ecosysteme 2', '2019-05-02', 'sdid<hioh<digniodkignbjduy<ygyu', 'conférence environnementale', 'en attente', 1, 'Sousse Palace Hotel & Spa, Avenue Habib Bourguiba, Sousse', '7ad658ca17af3b05b1ea4f9cec3a451e.jpeg', '2019-05-02', 0, '08:00:00', 12, 2, '35.8310325', '10.6395668'),
(13, 1, 'tetsupdate', '2019-04-19', 'descrptio', 'type', 'accepted', 0, 'place', '7ad658ca17af3b05b1ea4f9cec3a451e.jpeg', '2019-04-01', 1, '00:00:00', 0, 0, '36.81897', '10.16579'),
(14, 4, 'bricolage enfant', '2019-04-01', 'hjiofjxihuhfgyugydxkvklbkbjkb', 'bricolage recyclage', 'accepted', 1, 'chez jardin d\'enfants happy kids', 'f4214e58d9dac4d391fd9505063240ab.jpeg', '2019-04-17', 0, '08:00:00', 1, 0, '36.81897', '10.16579'),
(16, 1, 'workshop recyclage', '2019-04-30', 'fenofbjbvheqbuqbveoqvnifk', 'bricolage recyclage', 'accepted', 1, 'ecole ', '5a3567a745e5e39580f8d0ed50424c22.jpeg', '2019-04-19', 0, '05:35:00', 3, 3, '36.81897', '10.16579'),
(21, 1, 'Fete des arbres', '2019-04-19', 'nous fetton toujour le meme date .. les arbres sont .....', 'Campagne de propreté', 'accepted', 1, 'dar zaghouan', '1c8a527f59217bdc998878824269b41b.jpeg', '2019-04-19', 0, '23:37:00', 4, 0, '36.81897', '10.16579'),
(23, 1, 'conference v0.1', '2019-04-30', 'testt', 'conférence environnementale', 'accepted', 1, 'place', '325240080c9e7445eafcfe844669a13765843234f.jpg', '2019-04-19', 1, '00:51:00', 5, 0, '36.81897', '10.16579'),
(32, 2, 'test', '2019-05-03', 'test', 'Choisir type', 'en attente', 1, 'ttt', 'temp6668546668955940327..jpg', '2019-05-03', 0, NULL, 0, 0, '10.16579', '36.81897');

-- --------------------------------------------------------

--
-- Table structure for table `fos_user`
--

DROP TABLE IF EXISTS `fos_user`;
CREATE TABLE IF NOT EXISTS `fos_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `nom` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `adresse` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gouvernorat` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ville` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telephone` int(11) DEFAULT NULL,
  `fax` int(11) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `date_creation` date DEFAULT NULL,
  `genre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activite` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `adresse_siteweb` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `responsable_association` tinyint(1) DEFAULT NULL,
  `membre_association` tinyint(1) DEFAULT NULL,
  `imageprofile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idasso` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_957A6479C05FB297` (`confirmation_token`),
  UNIQUE KEY `UNIQ_957A6479FEB93E2F` (`idasso`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fos_user`
--

INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`, `nom`, `prenom`, `adresse`, `gouvernorat`, `ville`, `telephone`, `fax`, `date_naissance`, `date_creation`, `genre`, `activite`, `adresse_siteweb`, `responsable_association`, `membre_association`, `imageprofile`, `idasso`) VALUES
(1, 'selim', 'selim', 'selimbous@aaa.com', 'selimbous@aaa.com', 1, NULL, '$2y$13$pglfnGVXgS/92d2yPa3cA.RKSUZwiH3TWhGDha5w9vWYXtgkAFiBe', '2019-03-01 10:58:13', 'Dybv8_-Scqp-FyjFHntXcnD1hS-WkqmgwPoufJkozT8', NULL, 'a:2:{i:0;s:15:\"ROLE_COLLECTEUR\";i:1;s:10:\"ROLE_ADMIN\";}', 'selim', 'selkim', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'samarel', 'samarel', 'samarelouafi@gmail.com', 'samarelouafi@gmail.com', 1, NULL, '$2y$13$zSPIwCdzY8U91Ns3hftJvOGhs7cOXSCRiSpSBWirss6t2lgiK5n8.', '2019-03-01 09:12:44', 'jKE2mnTTyz9od1hfpwsy0bJGAPgr0qGJ484AND-ag-c', NULL, 'a:1:{i:0;s:12:\"ROLE_CITOYEN\";}', 'samar', 'elouafi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'C:\\wamp64\\tmp\\phpCDC4.tmp', NULL),
(3, 'samarSam', 'samarSAm', 'samarelouafi@yahoo.fr', 'samar.elouafi@yahoo.fr', 1, NULL, '$2y$13$gKlC0SvPX6pZYBTu9hm59.17EmSP7Ti5WZzCSivb4n/42HoX4MeTu', '2019-03-01 08:25:34', 'VNFc-nExzqiPg1SUMpJj203Rw5nxmf6B4rUb2dMD0pU', NULL, 'a:2:{i:0;s:15:\"ROLE_COLLECTEUR\";i:1;s:10:\"ROLE ADMIN\";}', 'samar', 'elouafi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'C:\\wamp64\\tmp\\phpACB6.tmp', NULL),
(4, 'samarelouafi', 'samarelouafi', 'samarelouafi@esprit.tn', 'samarelouafi@esprit.tn', 1, NULL, '$2y$13$FwSv1W2CKOx1qmFZTNgDR.HUrsyAlyRhuTQU9.Tt2u91I34u9vOea', '2019-04-25 19:17:26', NULL, NULL, 'a:1:{i:0;s:12:\"ROLE_CITOYEN\";}', 'ssss', 'sssss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'ahmed', 'ahmed', 'ahmed.sahli@esprit.tn', 'ahmed.sahli@esprit.tn', 1, NULL, '$2y$13$DJwl2c4CeoGq6Tkq.QXOFeJIh4uy0syIKlAqdcyjw0/iHPutQMeN2', '2019-05-21 14:59:25', 'AXeKeiwY8ZoY17EBept_Xx4q3xBwYBgb6TN3hG92KsE', NULL, 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}', 'sahli', 'ahmed', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mail`
--

DROP TABLE IF EXISTS `mail`;
CREATE TABLE IF NOT EXISTS `mail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `marker`
--

DROP TABLE IF EXISTS `marker`;
CREATE TABLE IF NOT EXISTS `marker` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idcreateur` int(11) DEFAULT NULL,
  `name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `imagemarker` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_82CF20FE500D9289` (`idcreateur`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `marker`
--

INSERT INTO `marker` (`id`, `idcreateur`, `name`, `lat`, `lng`, `type`, `imagemarker`) VALUES
(1, NULL, 'event1', 36.89939144563391, 9.947722858937937, 'evenement', 'blog-grid-img-2.jpg'),
(2, NULL, 'annonce', 36.86879100139176, 9.893494879570085, 'annonce', 'blog-grid-img-6.jpg'),
(3, NULL, 'smartphone', 37.01452206952869, 9.707564069407226, 'produit', 'banner-thumb-1.png'),
(4, NULL, 'ecoasso', 37.064191247719734, 9.930830787835362, 'associtaion', 'blog-grid-img-6.jpg'),
(5, NULL, 'event2', 37.11753691532365, 9.775291637835494, 'evenement', 'blog-grid-img-8.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `membres_assoc`
--

DROP TABLE IF EXISTS `membres_assoc`;
CREATE TABLE IF NOT EXISTS `membres_assoc` (
  `membre_association_id` int(11) NOT NULL,
  `association_id` int(11) NOT NULL,
  PRIMARY KEY (`membre_association_id`,`association_id`),
  KEY `IDX_1100792D274932CB` (`membre_association_id`),
  KEY `IDX_1100792DEFB9C8A5` (`association_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `membre_association`
--

DROP TABLE IF EXISTS `membre_association`;
CREATE TABLE IF NOT EXISTS `membre_association` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `num_contact` int(11) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `id_Assoc` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `route` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `route_parameters` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `notification_date` datetime NOT NULL,
  `seen` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `title`, `description`, `icon`, `route`, `route_parameters`, `notification_date`, `seen`) VALUES
(1, 'test', 'aaaa', NULL, 'annonce_show', 'a:1:{s:2:\"id\";N;}', '2019-05-21 14:37:03', 0);

-- --------------------------------------------------------

--
-- Table structure for table `offre_vente`
--

DROP TABLE IF EXISTS `offre_vente`;
CREATE TABLE IF NOT EXISTS `offre_vente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `participation`
--

DROP TABLE IF EXISTS `participation`;
CREATE TABLE IF NOT EXISTS `participation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idevents` int(11) DEFAULT NULL,
  `idparticipant` int(11) DEFAULT NULL,
  `idinvitant` int(11) DEFAULT NULL,
  `datedeparti` date NOT NULL,
  `type` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_AB55E24F373AFAE6` (`idevents`),
  KEY `IDX_AB55E24F115E1BBE` (`idparticipant`),
  KEY `IDX_AB55E24F93DD857C` (`idinvitant`)
) ENGINE=InnoDB AUTO_INCREMENT=284 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `participation`
--

INSERT INTO `participation` (`id`, `idevents`, `idparticipant`, `idinvitant`, `datedeparti`, `type`) VALUES
(1, 6, 2, NULL, '2019-03-01', 'participer'),
(2, 6, 3, 2, '2019-03-01', 'inviter'),
(4, 6, 4, NULL, '2019-03-01', 'participer'),
(268, 5, 4, 2, '2019-04-15', 'inviter'),
(272, 8, 2, 1, '2019-04-17', 'participer'),
(273, 23, 2, 2, '2019-04-19', 'participer'),
(275, 16, 2, 1, '2019-04-19', 'participer'),
(276, 23, 4, NULL, '2019-04-26', 'participer'),
(279, 13, 2, NULL, '2019-04-30', 'participer'),
(283, 5, 2, NULL, '2019-05-03', 'participer');

-- --------------------------------------------------------

--
-- Table structure for table `postlike`
--

DROP TABLE IF EXISTS `postlike`;
CREATE TABLE IF NOT EXISTS `postlike` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `annonce_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B84FD43A8805AB2F` (`annonce_id`),
  KEY `IDX_B84FD43AA76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `postlike`
--

INSERT INTO `postlike` (`id`, `annonce_id`, `user_id`) VALUES
(1, 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `postlikeassociation`
--

DROP TABLE IF EXISTS `postlikeassociation`;
CREATE TABLE IF NOT EXISTS `postlikeassociation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `association_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_65821CA3EFB9C8A5` (`association_id`),
  KEY `IDX_65821CA3A76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `image_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(14,2) NOT NULL,
  `updated_at` datetime NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_D34A04AD989D9B62` (`slug`),
  KEY `IDX_D34A04AD12469DE2` (`category_id`),
  KEY `IDX_D34A04AD8DE820D9` (`seller_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `category_id`, `seller_id`, `name`, `description`, `image_name`, `quantity`, `price`, `updated_at`, `slug`) VALUES
(1, 1, NULL, 'sss', 'sssss', 'admin-post-img.jpg', 12, '100.00', '2019-03-01 06:43:46', 'sss');

-- --------------------------------------------------------

--
-- Table structure for table `products_order`
--

DROP TABLE IF EXISTS `products_order`;
CREATE TABLE IF NOT EXISTS `products_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `verified` tinyint(1) NOT NULL,
  `products` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:json_array)',
  `total` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_15706D48A76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

DROP TABLE IF EXISTS `product_category`;
CREATE TABLE IF NOT EXISTS `product_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_CDFC73565E237E06` (`name`),
  UNIQUE KEY `UNIQ_CDFC7356989D9B62` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`id`, `name`, `slug`) VALUES
(1, 'tv', 'tv');

-- --------------------------------------------------------

--
-- Table structure for table `product_promotions`
--

DROP TABLE IF EXISTS `product_promotions`;
CREATE TABLE IF NOT EXISTS `product_promotions` (
  `product_id` int(11) NOT NULL,
  `promotion_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`promotion_id`),
  KEY `IDX_797C6F1F4584665A` (`product_id`),
  KEY `IDX_797C6F1F139DF194` (`promotion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produit_recycle`
--

DROP TABLE IF EXISTS `produit_recycle`;
CREATE TABLE IF NOT EXISTS `produit_recycle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `promotion`
--

DROP TABLE IF EXISTS `promotion`;
CREATE TABLE IF NOT EXISTS `promotion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `discount` int(11) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_C11D7DD15E237E06` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reclamation`
--

DROP TABLE IF EXISTS `reclamation`;
CREATE TABLE IF NOT EXISTS `reclamation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_CE6064045E5C27E9` (`iduser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

DROP TABLE IF EXISTS `review`;
CREATE TABLE IF NOT EXISTS `review` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) DEFAULT NULL,
  `idevents` int(11) DEFAULT NULL,
  `commentaire` varchar(2500) COLLATE utf8_unicode_ci NOT NULL,
  `dateajout` date DEFAULT NULL,
  `note` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7EEF84F05E5C27E9` (`iduser`),
  KEY `IDX_7EEF84F0373AFAE6` (`idevents`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `iduser`, `idevents`, `commentaire`, `dateajout`, `note`) VALUES
(2, 2, 7, 'bien', '2019-03-01', 3),
(3, 4, 7, 'tres bien', '2019-03-01', 5),
(4, 4, 9, 'bien', '2019-03-01', 2),
(5, 1, 9, 'tres bien', '2019-03-01', 5),
(8, 2, 5, 'bien', '2019-04-13', 2),
(9, 1, 5, 'tres bien', '2019-04-13', 5),
(10, 4, 5, 'bien', '2019-04-13', 3),
(16, 2, 16, 'bien', '2019-04-19', 3),
(17, 2, 6, 'tres bien', '2019-04-19', 5),
(18, 4, 6, 'bien', '2019-04-19', 2),
(23, 3, 5, 'bien', '2019-04-30', 4),
(24, 2, 5, 'tres bien', '2019-05-02', 4),
(25, 2, 5, 'tres bien', '2019-05-03', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tache`
--

DROP TABLE IF EXISTS `tache`;
CREATE TABLE IF NOT EXISTS `tache` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users_challenge`
--

DROP TABLE IF EXISTS `users_challenge`;
CREATE TABLE IF NOT EXISTS `users_challenge` (
  `challenge_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`challenge_id`,`user_id`),
  KEY `IDX_B174F3B098A21AC6` (`challenge_id`),
  KEY `IDX_B174F3B0A76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `annonce`
--
ALTER TABLE `annonce`
  ADD CONSTRAINT `FK_F65593E5FAD8DA84` FOREIGN KEY (`createur`) REFERENCES `fos_user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `association`
--
ALTER TABLE `association`
  ADD CONSTRAINT `FK_FD8521CC7159F9CB` FOREIGN KEY (`id_resp`) REFERENCES `fos_user` (`id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `FK_BA388B74584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_BA388B7A76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `commentaireannonce`
--
ALTER TABLE `commentaireannonce`
  ADD CONSTRAINT `FK_1BE2A4E18805AB2F` FOREIGN KEY (`annonce_id`) REFERENCES `annonce` (`id`),
  ADD CONSTRAINT `FK_1BE2A4E1A76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`);

--
-- Constraints for table `demande_association`
--
ALTER TABLE `demande_association`
  ADD CONSTRAINT `FK_5CA27EB868D3EA09` FOREIGN KEY (`User_id`) REFERENCES `fos_user` (`id`),
  ADD CONSTRAINT `FK_5CA27EB87BD20C90` FOREIGN KEY (`Assoc_id`) REFERENCES `association` (`id`);

--
-- Constraints for table `evenement`
--
ALTER TABLE `evenement`
  ADD CONSTRAINT `FK_B26681E500D9289` FOREIGN KEY (`idcreateur`) REFERENCES `fos_user` (`id`);

--
-- Constraints for table `fos_user`
--
ALTER TABLE `fos_user`
  ADD CONSTRAINT `FK_957A6479FEB93E2F` FOREIGN KEY (`idasso`) REFERENCES `association` (`id`);

--
-- Constraints for table `marker`
--
ALTER TABLE `marker`
  ADD CONSTRAINT `FK_82CF20FE500D9289` FOREIGN KEY (`idcreateur`) REFERENCES `fos_user` (`id`);

--
-- Constraints for table `membres_assoc`
--
ALTER TABLE `membres_assoc`
  ADD CONSTRAINT `FK_1100792D274932CB` FOREIGN KEY (`membre_association_id`) REFERENCES `membre_association` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_1100792DEFB9C8A5` FOREIGN KEY (`association_id`) REFERENCES `association` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `participation`
--
ALTER TABLE `participation`
  ADD CONSTRAINT `FK_AB55E24F115E1BBE` FOREIGN KEY (`idparticipant`) REFERENCES `fos_user` (`id`),
  ADD CONSTRAINT `FK_AB55E24F373AFAE6` FOREIGN KEY (`idevents`) REFERENCES `evenement` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_AB55E24F93DD857C` FOREIGN KEY (`idinvitant`) REFERENCES `fos_user` (`id`);

--
-- Constraints for table `postlike`
--
ALTER TABLE `postlike`
  ADD CONSTRAINT `FK_B84FD43A8805AB2F` FOREIGN KEY (`annonce_id`) REFERENCES `annonce` (`id`),
  ADD CONSTRAINT `FK_B84FD43AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`);

--
-- Constraints for table `postlikeassociation`
--
ALTER TABLE `postlikeassociation`
  ADD CONSTRAINT `FK_65821CA3A76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`),
  ADD CONSTRAINT `FK_65821CA3EFB9C8A5` FOREIGN KEY (`association_id`) REFERENCES `association` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_D34A04AD12469DE2` FOREIGN KEY (`category_id`) REFERENCES `product_category` (`id`),
  ADD CONSTRAINT `FK_D34A04AD8DE820D9` FOREIGN KEY (`seller_id`) REFERENCES `fos_user` (`id`);

--
-- Constraints for table `products_order`
--
ALTER TABLE `products_order`
  ADD CONSTRAINT `FK_15706D48A76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`);

--
-- Constraints for table `product_promotions`
--
ALTER TABLE `product_promotions`
  ADD CONSTRAINT `FK_797C6F1F139DF194` FOREIGN KEY (`promotion_id`) REFERENCES `promotion` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_797C6F1F4584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reclamation`
--
ALTER TABLE `reclamation`
  ADD CONSTRAINT `FK_CE6064045E5C27E9` FOREIGN KEY (`iduser`) REFERENCES `fos_user` (`id`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `FK_7EEF84F0373AFAE6` FOREIGN KEY (`idevents`) REFERENCES `evenement` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_7EEF84F05E5C27E9` FOREIGN KEY (`iduser`) REFERENCES `fos_user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users_challenge`
--
ALTER TABLE `users_challenge`
  ADD CONSTRAINT `FK_B174F3B098A21AC6` FOREIGN KEY (`challenge_id`) REFERENCES `challenge` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_B174F3B0A76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
