-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Sam 11 Mai 2013 à 15:04
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `medicpi`
--

-- --------------------------------------------------------

--
-- Structure de la table `anomalie`
--

CREATE TABLE IF NOT EXISTS `anomalie` (
  `idAno` int(11) NOT NULL AUTO_INCREMENT,
  `idData` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `idUser` int(11) NOT NULL,
  PRIMARY KEY (`idAno`),
  KEY `idData` (`idData`,`idUser`),
  KEY `idData_2` (`idData`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- Contenu de la table `anomalie`
--

INSERT INTO `anomalie` (`idAno`, `idData`, `description`, `idUser`) VALUES
(2, 18, 'Il fait trop chaud', 0),
(3, 19, 'Il fait trop froid', 0),
(4, 10, 'Pas de mouvement depuis 23heures le 22/04/2013', 0),
(5, 10, 'Pas de mouvement depuis 23heures le 22/04/2013', 0),
(6, 10, 'Pas de mouvement depuis 23heures le 22/04/2013', 0),
(7, 10, 'Pas de mouvement depuis 23heures le 22/04/2013', 0),
(8, 10, 'Pas de mouvement depuis 23heures le 22/04/2013', 0),
(9, 10, 'Pas de mouvement depuis 23heures le 22/04/2013', 0),
(10, 1, 'Il fait trop chaud', 0),
(11, 1, 'Il fait trop chaud', 0),
(12, 1, 'Il fait trop chaud', 0),
(13, 1, 'Il fait trop chaud', 0),
(14, 1, 'Il fait trop chaud', 0),
(15, 145, 'Il fait trop chaud', 0),
(16, 146, 'Il fait trop froid', 0),
(17, 147, 'Il fait trop froid', 0),
(18, 148, 'Il fait trop froid', 0),
(19, 149, 'Il fait trop chaud', 0),
(20, 150, 'Il fait trop chaud', 0),
(21, 151, 'Il fait trop chaud', 0),
(22, 152, 'Il fait trop chaud', 0),
(23, 153, 'Il fait trop chaud', 0),
(24, 154, 'Il fait trop chaud', 0),
(25, 155, 'Il fait trop chaud', 0),
(26, 156, 'Il fait trop chaud', 0),
(27, 157, 'Il fait trop chaud', 0),
(28, 158, 'Il fait trop chaud', 0),
(29, 159, 'Il fait trop chaud', 0),
(30, 160, 'Il fait trop chaud', 0),
(31, 161, 'Il fait trop chaud', 0),
(32, 162, 'Il fait trop chaud', 0),
(33, 163, 'Il fait trop chaud', 0),
(34, 206, 'Il fait trop chaud', 0),
(35, 207, 'Il fait trop chaud', 0),
(36, 208, 'Il fait trop chaud', 0),
(37, 214, 'Il fait trop froid', 0),
(38, 222, 'Il fait trop chaud', 0),
(39, 202, 'Pas de mouvement depuis 16 heures le 06/05/2013', 0),
(40, 225, 'Il fait trop froid', 0);

-- --------------------------------------------------------

--
-- Structure de la table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('c1a3ac5838fbb92aef393ed755cc0a65', '::1', 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.22 (KHTML, like Gecko) Chrome/25.0.1364.152 Safari/537.22', 1368274744, '');

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

CREATE TABLE IF NOT EXISTS `compte` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(25) NOT NULL,
  `prenom` varchar(25) NOT NULL,
  `login` varchar(20) CHARACTER SET utf8 NOT NULL,
  `pwd` varchar(100) NOT NULL,
  `role` varchar(10) CHARACTER SET utf8 NOT NULL,
  `mail` varchar(50) NOT NULL,
  `confirm` tinyint(4) NOT NULL,
  PRIMARY KEY (`idUser`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Contenu de la table `compte`
--

INSERT INTO `compte` (`idUser`, `nom`, `prenom`, `login`, `pwd`, `role`, `mail`, `confirm`) VALUES
(11, 'Leclercq', 'Paul', 'polo', 'nDJaSlngC2KaMlD0t+zVf6F8xDNE+rsafzrxb73I/KLJ2uw62ZCXgHDD/7Rg/8JVyW/43INGrb67eWnSeIZD3g==', 'Patient', '', 1),
(12, 'Eduardo', 'Gonsalez', 'medic', 'qcFB/iGTbMoShEx9sLdw8M343rg1wxY9p0kwGG54ox3rbLwJZ+drOqR8c19QtxFD/f7zT3S5Ml/RYo5rRDo0ZQ==', 'Medecin', '', 1),
(13, 'Eduardo', 'Gonsalez', 'test', '60r5UzBK/QklgS7+gJKajZHKysanI7uW/FEFFGC+oJMCEi4CbRojgLAuXU9Ws1+leSt1jfFlkdCsrOHaRDcbfg==', 'Medecin', '', 1),
(14, 'aaa', 'aaa', 'fezfze', 'q4HF3d5J4IiqmIHzJfQXWAOJi6zuMTu5g38ddO+/ihMUlQ8Y75Uz0z5flxEUadA/AprVCHa0SuFCPcursZ+pjg==', 'Admin', '', 1),
(15, 'LEclerco', 'Polo', 'yoyo', 'NAcZNROEdsNHtbVdJ16GfqXsD1msevH4Gdljk1qX+Z1LFQykeJVyo4nF4rY7ayvK3TNLEnakc7l/arFnEVBMrw==', 'Admin', '', 1),
(16, 'LEclerco', 'Polo', 'yoyo', 'sSYzrY0t1MozeF1QnOkc21kM3L70HNoj7AzsYk6KSw+CsHcUcQWt4/1mOI70LKwJtLFeOldx+C1xqHkzy5XwaA==', 'Admin', '', 1),
(17, 'LEclrco', 'Thmas', 'thomas', 'pGnjFLZLrIWoU1KjLyXjyp4N5wxACF5VVMbdvKS0XJUTDXByyeha3artdxToHR2av2J0zSEH9R5oS8E/bNueMQ==', 'Admin', '', 1),
(18, 'adrien', 'adrien', 'adrien', 'hrxKC9S2qnuBjbTeYISZMeWI/iV8MgNGgNdgSuCCKiYiKrmLBh/mKnsDsw7YMLcKrZWEzdenEKPWEnXZbUHYKg==', 'Admin', '', 1),
(19, 'aaaaa', 'aaa', 'aaaaa', '0swMEucD6vIwhdgDIrWmY9CgnOFEAHcpfkiPFAmkm7TYrbYUJvMF3OprjtuTNIClZ7kRhi/NbW2UyCpudU44NQ==', 'Admin', '', 0),
(20, 'Leclecq', 'Paul', 'paulo', 'U0SHv5DOr1316LzQuLQ99Kv+OV2ZQy50P7I1z+o6xEU6DdKeHe83n3P0gq4dLi6GUCBtchSThwNzIYPaoZbmMw==', 'Admin', '', 1),
(21, 'Leclercq', 'Florian', 'flo', 'MISb4K/aZvPKg2oAdWL1o0QF0CzDpTnJbjMGz1Ngb9Kfz3ASIeo1aRaT7onENXixF2XnO3E5+dOXYZbGZjZVzg==', 'Admin', '', 1),
(22, 'Carotte', 'Lapin', 'lapinou', 'fZNe58Inp2t5fI4lOJQD1C4dbuiMcqutbKU0mXuB31/wTs5xu8njwrqqrC/r/m0EyfOgdomr/+CoP4nBFu27xQ==', 'Admin', '', 1),
(23, 'mailo', 'mailo', 'mailo', 'aAjQtmotTyINAho36Iwkri131PsHHAdplJA1boCdNb+3mH9FOOWj/iCtaLakgTs/2Yp4pmfXPAc9NKw/6GA80g==', 'Admin', 'mailo@gmailµ.com', 0),
(24, 'Patrick', 'Schizie', 'medicin', 'vwIrSZp/aS7MeTtbjBYxqashUqr1FhvKKCaon5JAbP3TbVpXhSnNF1ahj+YME7i4EjxC2eAH3WuuuRLsm5vJZw==', 'Medecin', 'patrick@me.fr', 1),
(25, 'admin', 'admin', 'admin', '9aguqNj+IEWMK2DAw9P5dNNBd3QGcNaqmhKvLVyW9lJeQvCgN9IDr7i1J07HUlZUM5XxpPhEPDDfIyp9KNjKnw==', 'Admin', 'admin@ad.fr', 1),
(26, 'medico', 'medio', 'medico', 'IanMF7Uh2nMQSW7EaUMU5pHb1m1VjTLBcos/fDTAdHAunX0e/lsRsphDVZvEkYd4yn5ipGfMmZZZRZeWIFv3lw==', 'Patient', 'medeico', 0),
(27, 'paul', 'paul', 'paul', '8dMuIQpRXUQQsZRw9tchQFFR0AmqWNv1gN0bWt+QyMwC3tbqPdFmmNKnLbpZghg2ohiytEPqRFMYCLfiNyYg8Q==', 'Medecin', 'paul', 0);

-- --------------------------------------------------------

--
-- Structure de la table `configuration`
--

CREATE TABLE IF NOT EXISTS `configuration` (
  `idConfig` int(11) NOT NULL AUTO_INCREMENT,
  `nbHourAlert` int(11) NOT NULL,
  `minTemp` int(11) NOT NULL,
  `maxTemp` int(11) NOT NULL,
  `holiday` tinyint(4) NOT NULL,
  PRIMARY KEY (`idConfig`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `configuration`
--

INSERT INTO `configuration` (`idConfig`, `nbHourAlert`, `minTemp`, `maxTemp`, `holiday`) VALUES
(1, 5, 4, 27, 1);

-- --------------------------------------------------------

--
-- Structure de la table `dashboard`
--

CREATE TABLE IF NOT EXISTS `dashboard` (
  `idDash` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(25) NOT NULL,
  `nbAno` int(11) NOT NULL,
  `averTemp` float NOT NULL,
  `nbActiv` int(11) NOT NULL,
  `nbVisit` int(11) NOT NULL,
  PRIMARY KEY (`idDash`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `dashboard`
--

INSERT INTO `dashboard` (`idDash`, `date`, `nbAno`, `averTemp`, `nbActiv`, `nbVisit`) VALUES
(1, '04-2013', 1, 20, 2, 0),
(2, '03-2013', 16, 18.7, 72, 5),
(3, '02-2013', 24, 17.8, 97, 9),
(4, '05-2013', 4, -40, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `data`
--

CREATE TABLE IF NOT EXISTS `data` (
  `idData` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(25) NOT NULL,
  PRIMARY KEY (`idData`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=227 ;

--
-- Contenu de la table `data`
--

INSERT INTO `data` (`idData`, `type`) VALUES
(1, ''),
(4, 'motion'),
(5, 'motion'),
(6, 'motion'),
(7, 'motion'),
(8, 'motion'),
(9, 'motion'),
(10, 'motion'),
(11, 'temperature'),
(12, 'temperature'),
(13, 'temperature'),
(14, 'temperature'),
(15, 'temperature'),
(16, 'temperature'),
(17, 'temperature'),
(18, 'temperature'),
(19, 'temperature'),
(20, 'temperature'),
(21, 'temperature'),
(22, 'temperature'),
(23, 'temperature'),
(24, 'temperature'),
(25, 'temperature'),
(26, 'temperature'),
(27, 'temperature'),
(28, 'temperature'),
(29, 'temperature'),
(30, 'temperature'),
(31, 'temperature'),
(32, 'temperature'),
(33, 'temperature'),
(34, 'temperature'),
(35, 'temperature'),
(36, 'temperature'),
(37, 'temperature'),
(38, 'temperature'),
(39, 'temperature'),
(40, 'temperature'),
(41, 'temperature'),
(42, 'temperature'),
(43, 'temperature'),
(44, 'temperature'),
(45, 'temperature'),
(46, 'temperature'),
(47, 'temperature'),
(48, 'temperature'),
(49, 'temperature'),
(50, 'temperature'),
(51, 'temperature'),
(52, 'temperature'),
(53, 'temperature'),
(54, 'temperature'),
(55, 'temperature'),
(56, 'temperature'),
(57, 'temperature'),
(58, 'temperature'),
(59, 'temperature'),
(60, 'temperature'),
(61, 'temperature'),
(62, 'temperature'),
(63, 'temperature'),
(64, 'temperature'),
(65, 'temperature'),
(66, 'temperature'),
(67, 'temperature'),
(68, 'temperature'),
(69, 'temperature'),
(70, 'temperature'),
(71, 'temperature'),
(72, 'temperature'),
(73, 'temperature'),
(74, 'temperature'),
(75, 'temperature'),
(76, 'temperature'),
(77, 'temperature'),
(78, 'temperature'),
(79, 'temperature'),
(80, 'temperature'),
(81, 'temperature'),
(82, 'temperature'),
(83, 'temperature'),
(84, 'temperature'),
(85, 'temperature'),
(86, 'temperature'),
(87, 'temperature'),
(88, 'temperature'),
(89, 'temperature'),
(90, 'temperature'),
(91, 'temperature'),
(92, 'temperature'),
(93, 'temperature'),
(94, 'temperature'),
(95, 'temperature'),
(96, 'temperature'),
(97, 'temperature'),
(98, 'temperature'),
(99, 'temperature'),
(100, 'temperature'),
(101, 'temperature'),
(102, 'temperature'),
(103, 'temperature'),
(104, 'temperature'),
(105, 'temperature'),
(106, 'temperature'),
(107, 'temperature'),
(108, 'temperature'),
(109, 'temperature'),
(110, 'temperature'),
(111, 'temperature'),
(112, 'temperature'),
(113, 'temperature'),
(114, 'temperature'),
(115, 'temperature'),
(116, 'temperature'),
(117, 'temperature'),
(118, 'temperature'),
(119, 'temperature'),
(120, 'temperature'),
(121, 'temperature'),
(122, 'temperature'),
(123, 'temperature'),
(124, 'temperature'),
(125, 'temperature'),
(126, 'temperature'),
(127, 'temperature'),
(128, 'temperature'),
(129, 'temperature'),
(130, 'temperature'),
(131, 'temperature'),
(132, 'temperature'),
(133, 'temperature'),
(134, 'temperature'),
(135, 'temperature'),
(136, 'temperature'),
(137, 'temperature'),
(138, 'temperature'),
(139, 'temperature'),
(140, 'temperature'),
(141, 'temperature'),
(142, 'temperature'),
(143, 'temperature'),
(144, 'temperature'),
(145, 'temperature'),
(146, 'temperature'),
(147, 'temperature'),
(148, 'temperature'),
(149, 'temperature'),
(150, 'temperature'),
(151, 'temperature'),
(152, 'temperature'),
(153, 'temperature'),
(154, 'temperature'),
(155, 'temperature'),
(156, 'temperature'),
(157, 'temperature'),
(158, 'temperature'),
(159, 'temperature'),
(160, 'temperature'),
(161, 'temperature'),
(162, 'temperature'),
(163, 'temperature'),
(164, 'temperature'),
(165, 'temperature'),
(166, 'temperature'),
(167, 'temperature'),
(168, 'temperature'),
(169, 'temperature'),
(170, 'temperature'),
(171, 'temperature'),
(172, 'temperature'),
(173, 'temperature'),
(174, 'temperature'),
(175, 'temperature'),
(176, 'temperature'),
(177, 'temperature'),
(178, 'temperature'),
(179, 'temperature'),
(180, 'temperature'),
(181, 'temperature'),
(182, 'temperature'),
(183, 'temperature'),
(184, 'temperature'),
(185, 'temperature'),
(186, 'temperature'),
(187, 'temperature'),
(188, 'temperature'),
(189, 'temperature'),
(190, 'temperature'),
(191, 'temperature'),
(192, 'temperature'),
(193, 'temperature'),
(194, 'temperature'),
(195, 'temperature'),
(196, 'temperature'),
(197, 'temperature'),
(198, 'temperature'),
(199, 'temperature'),
(200, 'motion'),
(201, 'temperature'),
(202, 'motion'),
(203, 'temperature'),
(204, 'temperature'),
(205, 'temperature'),
(206, 'temperature'),
(207, 'temperature'),
(208, 'temperature'),
(209, 'temperature'),
(210, 'temperature'),
(211, 'temperature'),
(212, 'temperature'),
(213, 'temperature'),
(214, 'temperature'),
(215, 'temperature'),
(216, 'temperature'),
(217, 'temperature'),
(218, 'temperature'),
(219, 'temperature'),
(220, 'temperature'),
(221, 'temperature'),
(222, 'temperature'),
(223, 'temperature'),
(224, 'temperature'),
(225, 'temperature'),
(226, 'motion');

-- --------------------------------------------------------

--
-- Structure de la table `motion`
--

CREATE TABLE IF NOT EXISTS `motion` (
  `idMvt` int(11) NOT NULL AUTO_INCREMENT,
  `dateMo` datetime NOT NULL,
  `idData` int(11) NOT NULL,
  PRIMARY KEY (`idMvt`),
  KEY `idData` (`idData`),
  KEY `idData_2` (`idData`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45 ;

--
-- Contenu de la table `motion`
--

INSERT INTO `motion` (`idMvt`, `dateMo`, `idData`) VALUES
(1, '2013-04-07 00:00:00', 0),
(2, '0000-00-00 00:00:00', 0),
(3, '2013-04-07 20:22:08', 0),
(4, '2013-04-07 22:29:23', 0),
(5, '2013-04-07 22:55:17', 0),
(6, '2013-04-07 22:59:51', 0),
(7, '2013-04-07 23:08:48', 0),
(8, '2013-04-07 23:08:52', 0),
(9, '2013-04-07 23:13:10', 0),
(10, '2013-04-07 23:20:33', 0),
(11, '2013-04-07 23:26:11', 0),
(12, '2013-04-07 23:26:26', 0),
(13, '2013-04-07 23:27:19', 0),
(14, '2013-04-07 23:27:57', 0),
(15, '2013-04-07 23:29:33', 0),
(16, '2013-04-07 23:29:48', 0),
(17, '2013-04-07 23:30:24', 0),
(18, '2013-04-07 23:30:45', 0),
(19, '2013-04-07 23:30:57', 0),
(20, '2013-04-07 23:32:49', 0),
(21, '2013-04-07 23:34:52', 0),
(22, '2013-04-07 23:35:29', 0),
(23, '2013-04-07 23:37:03', 0),
(24, '2013-04-08 21:50:03', 0),
(25, '2013-04-09 22:19:34', 0),
(26, '2013-04-09 22:19:38', 0),
(27, '0000-00-00 00:00:00', 0),
(28, '0000-00-00 00:00:00', 0),
(29, '0000-00-00 00:00:00', 0),
(30, '2013-04-09 23:06:47', 0),
(31, '2013-04-09 23:16:42', 0),
(32, '2013-04-09 23:18:04', 0),
(33, '2013-04-09 23:19:32', 0),
(34, '2013-04-09 23:20:36', 0),
(35, '2013-04-09 23:21:28', 0),
(36, '2013-04-09 23:22:42', 0),
(37, '2013-04-16 23:49:48', 6),
(38, '2013-04-16 23:51:25', 7),
(39, '2013-04-17 00:00:21', 8),
(40, '2013-04-17 00:00:24', 9),
(41, '2013-04-17 16:18:44', 10),
(42, '2013-04-29 21:25:53', 200),
(43, '2013-04-29 21:32:12', 202),
(44, '2013-05-06 21:06:14', 226);

-- --------------------------------------------------------

--
-- Structure de la table `readano`
--

CREATE TABLE IF NOT EXISTS `readano` (
  `idAno` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  KEY `idAno` (`idAno`,`idUser`),
  KEY `idUser` (`idUser`),
  KEY `idUser_2` (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `temperature`
--

CREATE TABLE IF NOT EXISTS `temperature` (
  `idTmp` int(11) NOT NULL AUTO_INCREMENT,
  `val` float NOT NULL,
  `dateTmp` datetime NOT NULL,
  `idData` int(11) NOT NULL,
  PRIMARY KEY (`idTmp`),
  KEY `idDate` (`idData`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=213 ;

--
-- Contenu de la table `temperature`
--

INSERT INTO `temperature` (`idTmp`, `val`, `dateTmp`, `idData`) VALUES
(1, 20.5, '2013-04-17 23:11:49', 11),
(2, 6, '2013-04-17 23:12:51', 12),
(3, 20.5, '2013-04-21 17:13:18', 13),
(4, 20.5, '2013-04-21 17:52:12', 15),
(5, 20.5, '2013-04-21 17:55:10', 16),
(6, 20.5, '2013-04-21 17:55:35', 17),
(7, 20.5, '2013-04-21 17:55:46', 18),
(8, 20.5, '2013-04-21 17:56:06', 19),
(9, 20.5, '2013-04-21 17:56:07', 20),
(10, 20.5, '2013-04-21 17:56:16', 21),
(11, 6, '2013-04-21 22:00:42', 22),
(12, 6, '2013-04-21 22:01:20', 23),
(13, 6, '2013-04-21 22:02:44', 24),
(14, 6, '2013-04-21 22:02:59', 25),
(15, 6, '2013-04-21 22:03:31', 26),
(16, 15, '2013-04-21 22:03:34', 27),
(17, 6, '2013-04-21 22:04:51', 28),
(18, 50, '2013-04-21 22:27:42', 29),
(19, -6, '2013-04-21 22:28:00', 30),
(20, 20.5, '2013-04-21 22:29:40', 31),
(21, 20.5, '2013-04-21 22:30:00', 32),
(22, 20.5, '2013-04-21 23:42:32', 33),
(23, 20.5, '2013-04-22 00:09:14', 34),
(24, 20.5, '2013-04-22 00:09:41', 35),
(25, 20.5, '2013-04-22 00:10:36', 36),
(26, 20.5, '2013-04-22 00:19:19', 37),
(27, 20.5, '2013-04-22 00:20:12', 38),
(28, 20.5, '2013-04-22 00:20:21', 39),
(29, 20.5, '2013-04-22 00:21:36', 40),
(30, 20.5, '2013-04-22 00:27:56', 41),
(31, 20.5, '2013-04-22 00:29:41', 42),
(32, 20.5, '2013-04-22 00:30:40', 43),
(33, 20.5, '2013-04-22 00:30:54', 44),
(34, 20.5, '2013-04-22 00:31:39', 45),
(35, 20.5, '2013-04-22 00:31:52', 46),
(36, 20.5, '2013-04-22 00:32:02', 47),
(37, 20.5, '2013-04-22 00:32:27', 48),
(38, 20.5, '2013-04-22 14:52:03', 49),
(39, 20.5, '2013-04-22 15:02:46', 50),
(40, 20.5, '2013-04-22 15:38:46', 51),
(41, 20.5, '2013-04-22 15:38:52', 52),
(42, 20.5, '2013-04-22 15:38:59', 53),
(43, 20.5, '2013-04-22 19:19:35', 54),
(44, 20.5, '2013-04-22 19:20:12', 55),
(45, 20.5, '2013-04-22 19:21:35', 56),
(46, 0, '2013-04-22 19:21:58', 57),
(47, 20.5, '2013-04-24 14:27:32', 58),
(48, 20.5, '2013-04-24 14:33:17', 59),
(49, 20.5, '2013-04-24 14:35:13', 60),
(50, 20.5, '2013-04-24 14:35:15', 61),
(51, 20.5, '2013-04-24 14:36:39', 62),
(52, 20.5, '2013-04-24 14:37:12', 63),
(53, 20.5, '2013-04-24 14:37:20', 64),
(54, 20.5, '2013-04-24 14:37:37', 65),
(55, 20.5, '2013-04-24 14:38:11', 66),
(56, 20.5, '2013-04-24 14:39:21', 67),
(57, 20.5, '2013-04-24 14:44:25', 68),
(58, 20.5, '2013-04-24 14:44:58', 69),
(59, 20.5, '2013-04-24 14:50:32', 70),
(60, 20.5, '2013-04-24 14:52:07', 71),
(61, 20.5, '2013-04-24 14:54:49', 72),
(62, 20.5, '2013-04-24 14:55:54', 73),
(63, 20.5, '2013-04-24 14:56:38', 74),
(64, 20.5, '2013-04-24 14:56:52', 75),
(65, 20.5, '2013-04-24 14:57:06', 76),
(66, 20.5, '2013-04-24 14:58:18', 77),
(67, 20.5, '2013-04-24 14:58:24', 78),
(68, 20.5, '2013-04-24 14:59:10', 79),
(69, 20.5, '2013-04-24 14:59:20', 80),
(70, 20.5, '2013-04-24 14:59:37', 81),
(71, 20.5, '2013-04-24 14:59:47', 82),
(72, 20.5, '2013-04-24 14:59:50', 83),
(73, 20.5, '2013-04-24 15:00:06', 84),
(74, 20.5, '2013-04-24 15:00:43', 85),
(75, 20.5, '2013-04-24 15:00:52', 86),
(76, 20.5, '2013-04-24 15:01:50', 87),
(77, 20.5, '2013-04-24 15:07:13', 88),
(78, 20.5, '2013-04-24 15:07:21', 89),
(79, 20.5, '2013-04-24 15:07:27', 90),
(80, 20.5, '2013-04-24 15:07:55', 91),
(81, 20.5, '2013-04-24 15:09:13', 92),
(82, 20.5, '2013-04-24 15:09:26', 93),
(83, 20.5, '2013-04-24 15:09:26', 94),
(84, 20.5, '2013-04-24 15:10:55', 95),
(85, 20.5, '2013-04-24 15:11:42', 96),
(86, 20.5, '2013-04-24 15:11:58', 97),
(87, 20.5, '2013-04-24 15:11:59', 98),
(88, 20.5, '2013-04-24 15:12:37', 99),
(89, 20.5, '2013-04-24 15:13:04', 100),
(90, 20.5, '2013-04-24 15:13:13', 101),
(91, 20.5, '2013-04-24 15:13:27', 102),
(92, 20.5, '2013-04-24 15:13:41', 103),
(93, 20.5, '2013-04-24 15:13:56', 104),
(94, 20.5, '2013-04-24 15:14:23', 105),
(95, 20.5, '2013-04-24 15:14:42', 106),
(96, 20.5, '2013-04-24 15:14:55', 107),
(97, 20.5, '2013-04-24 15:15:03', 108),
(98, 20.5, '2013-04-24 15:16:21', 109),
(99, 20.5, '2013-04-24 15:16:29', 110),
(100, 20.5, '2013-04-24 15:17:46', 111),
(101, 20.5, '2013-04-24 15:18:02', 112),
(102, 20.5, '2013-04-24 15:18:13', 113),
(103, 20.5, '2013-04-24 15:20:02', 114),
(104, 20.5, '2013-04-24 15:20:11', 115),
(105, 20.5, '2013-04-24 15:20:41', 116),
(106, 20.5, '2013-04-24 15:21:19', 117),
(107, 20.5, '2013-04-24 15:21:31', 118),
(108, 20.5, '2013-04-24 15:22:43', 119),
(109, 20.5, '2013-04-24 15:23:00', 120),
(110, 20.5, '2013-04-24 15:23:33', 121),
(111, 20.5, '2013-04-24 15:25:14', 122),
(112, 20.5, '2013-04-24 15:26:03', 123),
(113, 20.5, '2013-04-24 15:26:56', 124),
(114, 20.5, '2013-04-24 15:27:06', 125),
(115, 20.5, '2013-04-24 15:28:06', 126),
(116, 20.5, '2013-04-24 23:08:50', 127),
(117, 20.5, '2013-04-24 23:10:12', 128),
(118, 20.5, '2013-04-24 23:11:01', 129),
(119, 20.5, '2013-04-24 23:27:24', 130),
(120, 20.5, '2013-04-24 23:27:33', 131),
(121, 5, '2013-04-24 23:30:59', 132),
(122, 5, '2013-04-24 23:34:56', 133),
(123, 10, '2013-04-24 23:34:59', 134),
(124, 455, '2013-04-24 23:35:05', 135),
(125, 455, '2013-04-24 23:35:34', 136),
(126, 455, '2013-04-24 23:36:10', 137),
(127, 455, '2013-04-24 23:36:32', 138),
(128, 455, '2013-04-24 23:37:33', 139),
(129, 455, '2013-04-24 23:38:10', 140),
(130, 455, '2013-04-24 23:39:16', 141),
(131, 455, '2013-04-24 23:39:35', 142),
(132, 455, '2013-04-24 23:41:18', 143),
(133, 455, '2013-04-24 23:41:30', 144),
(134, 455, '2013-04-24 23:41:46', 145),
(135, -6, '2013-04-24 23:42:01', 146),
(136, -6, '2013-04-24 23:42:03', 147),
(137, -6, '2013-04-24 23:42:23', 148),
(138, 455, '2013-04-24 23:42:54', 149),
(139, 455, '2013-04-24 23:42:55', 150),
(140, 455, '2013-04-24 23:42:55', 151),
(141, 455, '2013-04-24 23:42:56', 152),
(142, 455, '2013-04-24 23:42:56', 153),
(143, 455, '2013-04-24 23:42:56', 154),
(144, 455, '2013-04-24 23:42:56', 155),
(145, 455, '2013-04-24 23:42:57', 156),
(146, 455, '2013-04-24 23:42:57', 157),
(147, 455, '2013-04-24 23:42:57', 158),
(148, 455, '2013-04-24 23:42:57', 159),
(149, 455, '2013-04-24 23:42:58', 160),
(150, 455, '2013-04-24 23:42:58', 161),
(151, 455, '2013-04-24 23:42:58', 162),
(152, 455, '2013-04-24 23:42:59', 163),
(153, 20.5, '2013-04-24 23:43:23', 164),
(154, 20.5, '2013-04-25 17:11:57', 165),
(155, 20.5, '2013-04-25 17:12:14', 166),
(156, 20.5, '2013-04-25 17:12:21', 167),
(157, 20.5, '2013-04-25 17:12:35', 168),
(158, 20.5, '2013-04-25 17:12:59', 169),
(159, 20.5, '2013-04-25 17:13:03', 170),
(160, 20.5, '2013-04-25 17:19:42', 171),
(161, 20.5, '2013-04-25 17:19:45', 172),
(162, 20.5, '2013-04-25 17:20:11', 173),
(163, 20.5, '2013-04-25 17:20:14', 174),
(164, 20.5, '2013-04-25 17:20:18', 175),
(165, 20.5, '2013-04-25 17:20:33', 176),
(166, 20.5, '2013-04-25 17:20:36', 177),
(167, 20.5, '2013-04-25 17:20:50', 178),
(168, 20.5, '2013-04-25 17:20:59', 179),
(169, 20.5, '2013-04-25 17:21:57', 180),
(170, 20.5, '2013-04-25 17:22:12', 181),
(171, 20.5, '2013-04-25 17:25:39', 182),
(172, 20.5, '2013-04-25 17:26:21', 183),
(173, 20.5, '2013-04-25 17:26:34', 184),
(174, 20.5, '2013-04-25 17:27:51', 185),
(175, 20.5, '2013-04-25 17:30:34', 186),
(176, 20.5, '2013-04-25 17:30:58', 187),
(177, 20.5, '2013-04-25 17:31:42', 188),
(178, 20.5, '2013-04-25 17:32:09', 189),
(179, 20.5, '2013-04-25 17:32:18', 190),
(180, 20.5, '2013-04-25 17:32:43', 191),
(181, 20.5, '2013-04-25 17:33:25', 192),
(182, 20.5, '2013-04-25 17:36:49', 193),
(183, 20.5, '2013-04-25 17:36:56', 194),
(184, 20.5, '2013-04-25 17:36:59', 195),
(185, 20.5, '2013-04-25 17:37:04', 196),
(186, 20.5, '2013-04-25 22:16:18', 197),
(187, 20.5, '2013-04-25 22:16:26', 198),
(188, 20, '2013-04-29 09:47:38', 199),
(189, 34, '2013-04-29 21:30:59', 201),
(190, 34, '2013-04-29 21:32:21', 203),
(191, 21, '2013-04-29 21:33:41', 204),
(192, 1234, '2013-04-29 21:35:10', 205),
(193, 21, '2013-04-29 21:36:32', 206),
(194, 21, '2013-04-29 21:37:30', 207),
(195, 17, '2013-04-29 21:37:34', 208),
(196, 17, '2013-04-29 21:38:06', 209),
(197, 17, '2013-04-29 21:38:39', 210),
(198, 17, '2013-04-29 21:38:44', 211),
(199, 17, '2013-04-29 21:38:47', 212),
(200, 17, '2013-04-29 21:38:57', 213),
(201, -1, '2013-04-29 21:40:21', 214),
(202, -1, '2013-04-29 21:40:40', 215),
(203, 17, '2013-04-29 21:43:57', 216),
(204, 17, '2013-04-29 22:15:41', 217),
(205, -1, '2013-04-29 22:15:41', 218),
(206, -1, '2013-04-29 22:25:26', 219),
(207, -1, '2013-04-29 22:25:39', 220),
(208, 10000, '2013-04-29 23:33:10', 221),
(209, 10002, '2013-04-29 23:36:03', 222),
(210, 10002, '2013-04-29 23:36:11', 223),
(211, 10002, '2013-04-29 23:37:32', 224),
(212, -80, '2013-05-06 19:04:12', 225);

-- --------------------------------------------------------

--
-- Structure de la table `visit`
--

CREATE TABLE IF NOT EXISTS `visit` (
  `idVis` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `idUser` int(11) NOT NULL,
  PRIMARY KEY (`idVis`),
  KEY `idUser` (`idUser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `visit`
--

INSERT INTO `visit` (`idVis`, `date`, `idUser`) VALUES
(1, '2013-05-01 00:00:00', 12),
(2, '2013-05-02 00:00:00', 12),
(3, '2013-05-02 00:00:00', 12),
(4, '2013-05-02 00:00:00', 12),
(5, '2013-05-17 00:00:00', 12),
(6, '2013-05-18 00:00:00', 12);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `anomalie`
--
ALTER TABLE `anomalie`
  ADD CONSTRAINT `anomalie_ibfk_1` FOREIGN KEY (`idData`) REFERENCES `data` (`idData`);

--
-- Contraintes pour la table `readano`
--
ALTER TABLE `readano`
  ADD CONSTRAINT `readano_ibfk_1` FOREIGN KEY (`idAno`) REFERENCES `anomalie` (`idAno`);

--
-- Contraintes pour la table `temperature`
--
ALTER TABLE `temperature`
  ADD CONSTRAINT `temperature_ibfk_1` FOREIGN KEY (`idData`) REFERENCES `data` (`idData`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
