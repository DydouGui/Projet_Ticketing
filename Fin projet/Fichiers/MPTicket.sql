-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  jeu. 02 juil. 2020 à 12:10
-- Version du serveur :  10.3.21-MariaDB
-- Version de PHP :  7.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `MPTicket`
--

-- --------------------------------------------------------

--
-- Structure de la table `T_Categories`
--

CREATE TABLE `T_Categories` (
  `id_categorie` int(16) NOT NULL COMMENT 'id de la table Catégorie',
  `fk_categorie` int(16) DEFAULT NULL COMMENT 'Catégorie parant - Clé étrangère de la table Catégorie',
  `Categorie` varchar(30) NOT NULL COMMENT 'Nom de la catégorie',
  `Description_categorie` varchar(254) NOT NULL COMMENT 'Description de la catégorie'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `T_Categories`
--

INSERT INTO `T_Categories` (`id_categorie`, `fk_categorie`, `Categorie`, `Description_categorie`) VALUES
(1, NULL, 'Demande de droit', 'Cette catégorie permet de demander des droits manquants'),
(2, NULL, 'Login Problème', 'Problème avec les login comme mot de passe oublié ou compte bloqué'),
(3, NULL, 'MICROS', 'tOUt problème ou tout demande concernant les MICORS'),
(5, NULL, 'PC', 'Problème et demandes cancerant les PC comme les péripheriques, logiciels et fichiers'),
(6, NULL, 'Imprimante', 'Problèmes et demande sur les imprimante, comme toner, papiers et autres problème'),
(7, NULL, 'Demande Materiels', 'Demande materiels comme laptop, sipder phone et autre..'),
(8, 1, 'EMC', 'Demande d\'accès au logiciel EMC'),
(9, 1, 'Carte MICROS', 'Demande d\'avoir une carte MICROS'),
(10, 1, 'OPERA', 'Demande d\'accès au logiciel Opera'),
(11, 1, 'Materiel Control', 'Demande d\'accès au logiciel Materiel Control'),
(12, 1, 'TESA', 'Demande d\'accès au logiciel TESA'),
(13, 1, 'Outlook', 'Demande d\'accès au logiciel outlook'),
(14, 1, 'Booke4Time', 'Demande d\'accès au logiciel Booke4Time'),
(15, 1, 'AccPacc', 'Demande d\'accès au logiciel AccPacc'),
(16, 1, 'Imprimante', 'Demande d\'accès aux imprimantes '),
(17, 1, 'Talent Culture', 'Demande d\'accès au logiciel Talent Cutlure'),
(18, 1, 'VPN', 'Demande d\'accès acu VPN'),
(19, 1, 'Accés au Dossier / Fichier', 'Demande d\'accès sur un dossier ou fichiers'),
(20, 1, 'Autres', 'Autres demande de droit'),
(21, 2, 'Accès Application', 'Probleme sur un accès d\'un logiciel'),
(22, 2, 'Password', 'Problème avec un password'),
(23, 2, 'Compte bloqué', 'Problème d\'un Compte bloqué '),
(24, 2, 'Autres', 'Autres login problème'),
(25, 3, 'Problème Imprimante', 'Problème avec un imprimante MICROS '),
(26, 3, 'Problème MICROS', 'Problème avec un Terminal MICROS comme une caisse ou tablette'),
(27, 3, 'Problème Logiciel', 'Prolème avec le logiciel du système de MICROS'),
(28, 3, 'Problème Materiel', 'Problème avec les matériel des micros'),
(29, 3, 'Autres', 'Autres problème avec MICROS'),
(40, 5, 'Péripheriques', 'Tout demande qui canverne les péripheriques'),
(41, 5, 'Problème fichier / Dossier', 'Prolème ou demande avec les fichiers et dossiers '),
(42, 5, 'Problème avec un logiciel', 'Tout concerne les logiciels qui cancerne le PC'),
(43, 5, 'Installation PC', 'Tout demande des logiciel des PC'),
(44, 5, 'Autres', 'Autres demandes et problème concernent les PC'),
(45, 40, 'Ecran', 'Installation / Problème Ecran'),
(46, 40, 'Clavier', 'Installation / Problème Clavier'),
(47, 40, 'Souris', 'Installation / Problème Souris'),
(48, 40, 'Autres', 'Tout autres sur les périphériques'),
(49, 6, 'Imprimante Follow-You', 'Problème avec les printers Follow-you'),
(50, 6, 'Plus de toner ', 'PLus de toner sur l\'imprimante'),
(51, 6, 'Problème Hardware', 'Problème Hardware sur l\'imprimante'),
(52, 6, 'Problème Software', 'Problème software sur l\'imprimante'),
(53, 6, 'Problème Papiers', 'Problème papiers sur l\'imprimante'),
(54, 6, 'Autres', 'Tout autres sur les imprimantes'),
(55, 7, 'Laptop', 'Demande d\'un laptop'),
(56, 7, 'Spider Phone', 'Demande d\'un spider Phone'),
(57, 7, 'Autres', 'Autres demandes ');

-- --------------------------------------------------------

--
-- Structure de la table `T_Commentaires`
--

CREATE TABLE `T_Commentaires` (
  `id_commentaire` int(32) NOT NULL COMMENT 'id de la table Commentaire',
  `fk_id_ticket` varchar(15) NOT NULL COMMENT 'Commentaire pour le ticket - Clé étrangère de la table ticket',
  `fk_id_utilisateur` int(16) NOT NULL COMMENT 'Qui a créer le commentaire - Clé étrangère de la table Utilisateur',
  `Date_commentaire` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'Date de la création du commentaire - Champ automatique avec l''heure du jour',
  `Commentaire` text NOT NULL COMMENT 'Commentaire'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `T_Commentaires`
--

INSERT INTO `T_Commentaires` (`id_commentaire`, `fk_id_ticket`, `fk_id_utilisateur`, `Date_commentaire`, `Commentaire`) VALUES
(1, '20200330_002', 4, '2020-04-22 15:05:04', 'Voila le 1er commentaire\r\n\r\nDylan, \r\nJ\'ai redémarrer le serveur'),
(2, '20200330_002', 3, '2020-04-22 15:05:53', '2ème Commentaire\r\n\r\nProblème toujouurs pas réglé\r\n\r\nAppeler le support'),
(63, '20200504_002', 4, '2020-05-04 23:36:36', '----- Dépendre ----- recu'),
(67, '20200502_001', 4, '2020-05-07 11:03:28', '----- Suspension ----- Le ticket est susspendu dû au retarde de la commande de la nouvelle WebCam pour monsieur Lohri.\r\nDylan Guiducci'),
(68, '20200502_001', 4, '2020-05-07 11:04:00', '----- Dépendre ----- Le colis de la webCam est bien arrivé. \r\nDylan Guiducci'),
(69, '20200502_001', 4, '2020-05-07 11:05:34', '----- Suspension ----- Monsieur Lohri est en vacances. En attendant de son retour. Dylan'),
(70, '20200617_001', 9, '2020-06-25 10:57:41', 'Demande à la fille cachée de ton ami OMde B'),
(71, '20200617_001', 9, '2020-06-25 10:58:23', '----- Suspension ----- LHR vend la piscine de Bassin'),
(72, '20200617_001', 9, '2020-06-25 10:58:52', '----- Dépendre ----- Piscine vendue, le fric tombe :D'),
(73, '20200630_002', 3, '2020-06-30 23:03:27', 'Tant pis pour votre cul.\r\nOsama'),
(74, '20200630_001', 3, '2020-06-30 23:04:19', 'Bonjour, Tant pis pour votre cul, consultez HORENBACH.\r\nOsama');

-- --------------------------------------------------------

--
-- Structure de la table `T_Departements`
--

CREATE TABLE `T_Departements` (
  `id_departement` int(16) NOT NULL COMMENT 'Id et N° de département',
  `Departement` varchar(30) NOT NULL COMMENT 'Nom du département'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `T_Departements`
--

INSERT INTO `T_Departements` (`id_departement`, `Departement`) VALUES
(1, 'Achats'),
(2, 'Banquets'),
(3, 'Comptabilité'),
(4, 'Conciergerie'),
(5, 'Cuisine'),
(6, 'Direction'),
(7, 'Emm'),
(8, 'F&B'),
(9, 'Front Office'),
(10, 'Funky Claude\'S Bar'),
(11, 'Housekeeping'),
(12, 'In Room Dining'),
(13, 'IT - Informatique'),
(14, 'Marketing'),
(15, 'Montreux Jazz Cafe'),
(16, 'Mp\'S Bar & Grill'),
(17, 'Night'),
(18, 'Palmeraie'),
(19, 'Service Technique'),
(20, 'Stewarding'),
(21, 'Talent & Culture'),
(22, 'Terrasse Petit Palais'),
(23, 'Willow Stream Spa');

-- --------------------------------------------------------

--
-- Structure de la table `T_Documents`
--

CREATE TABLE `T_Documents` (
  `id_document` int(16) NOT NULL COMMENT 'Id de la table Document',
  `fk_id_ticket` varchar(15) NOT NULL COMMENT 'Document pour le ticket - Clé étrangère de la table ticket',
  `fk_id_utilisateur` int(16) NOT NULL COMMENT 'Utilisateur ayant déposé le Document - Clé étrangère de la table Utilisateur',
  `Lien_document` varchar(254) NOT NULL COMMENT 'Lien de où se trouve le document'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `T_Droits`
--

CREATE TABLE `T_Droits` (
  `id_droit` int(8) NOT NULL COMMENT 'Id de la table Droits',
  `Niveau_droit` varchar(30) NOT NULL COMMENT 'Niveau de droit (Lecture, Modification, Control Total)',
  `Description_droit` text NOT NULL COMMENT 'Description du droit'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `T_Droits`
--

INSERT INTO `T_Droits` (`id_droit`, `Niveau_droit`, `Description_droit`) VALUES
(1, 'Lecture', 'Droit de lecture :\r\nPermet de consulter les tickets'),
(2, 'Modification', 'Droit de Modification :\r\nPermet de consulter, modifier et supprimer les tickets'),
(3, 'Controle Total', 'Droit Controle Total :\r\nPermet de consulter, modifier,supprimer et de modifier les droits sur les tickets');

-- --------------------------------------------------------

--
-- Structure de la table `T_Impacts`
--

CREATE TABLE `T_Impacts` (
  `id_impact` int(8) NOT NULL COMMENT 'Id de la table impact',
  `Impact` varchar(30) NOT NULL COMMENT 'Niveau d''impact',
  `Description_impact` varchar(254) NOT NULL COMMENT 'Description de l''impact'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `T_Impacts`
--

INSERT INTO `T_Impacts` (`id_impact`, `Impact`, `Description_impact`) VALUES
(1, 'Utilisateur', 'Niveau Bas :\r\nLe problème impacte une seule personne'),
(2, 'Utilisateurs', 'Niveau Moyen :\r\nLe problème impacte entre 2 à 10 personnes'),
(3, 'Département', 'Niveau Haut :\r\nLe problème impacte plus que 10 personnes'),
(4, 'Entreprise', 'Niveau Critique :\r\nLe problème impacte toute l\'entreprise');

-- --------------------------------------------------------

--
-- Structure de la table `T_Priorites`
--

CREATE TABLE `T_Priorites` (
  `id_priorite` int(8) NOT NULL COMMENT 'id de la table priorités',
  `Priorite` varchar(30) NOT NULL COMMENT 'Niveau de priorité',
  `Description_priorite` varchar(254) NOT NULL COMMENT 'Description de la priorité'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `T_Priorites`
--

INSERT INTO `T_Priorites` (`id_priorite`, `Priorite`, `Description_priorite`) VALUES
(1, 'Basse', 'Priorité Basse :\r\nDemande non-urgente'),
(2, 'Moyenne', 'Priorité Moyenne :\r\nOutils non-productifs pour personne non-cadre'),
(3, 'Haute', 'Priorité Haute :\r\nOutils de production pour une personne non-cardre OU Outils non-productifs pour un cadre'),
(4, 'Critique', 'Priorité Critique :\r\nCadre ayant un problème avec un outil productif');

-- --------------------------------------------------------

--
-- Structure de la table `T_Status`
--

CREATE TABLE `T_Status` (
  `id_status` int(8) NOT NULL COMMENT 'Id de la table Status',
  `Status` varchar(30) NOT NULL COMMENT 'Nom du status',
  `Description_status` varchar(254) NOT NULL COMMENT 'Description du status'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `T_Status`
--

INSERT INTO `T_Status` (`id_status`, `Status`, `Description_status`) VALUES
(1, 'Ouvert', 'Le ticket est en cours de traitement'),
(2, 'Clôturé automatiquement ', 'Le ticket a été clôturer automatiquement'),
(3, 'Clôture forcée', 'La clôture du ticket a été forcée'),
(4, 'Annulé', 'Le ticket a été annulé'),
(5, 'Résolu', 'Le ticket a été résolu'),
(6, 'Suspendu', 'Le ticket est suspendu');

-- --------------------------------------------------------

--
-- Structure de la table `T_Tickets`
--

CREATE TABLE `T_Tickets` (
  `id_ticket` varchar(15) NOT NULL COMMENT 'id de la table Ticket - Format (YYYYMMDD_XXX)',
  `Utilisateur_demandeur` varchar(60) DEFAULT NULL COMMENT 'Nom du demandeur',
  `Numero_tel_demandeur` varchar(24) DEFAULT NULL COMMENT 'Numéro du téléphone du demandeur format (0041aabbbccdd)',
  `fk_id_utilisateur_depanneur` int(16) DEFAULT NULL COMMENT '(Dépanneur) Clé étrangère de la table Utilisateur',
  `fk_id_status` int(4) DEFAULT NULL COMMENT 'Status du ticket - Ouvert, Fermé, Résolu - Clé étrangère de la table Status',
  `fk_id_impact` int(4) DEFAULT NULL COMMENT 'Impacte du ticket - Nombre de personne affectée - Clé étrangère de la table Impacte',
  `fk_id_priorite` int(4) DEFAULT NULL COMMENT 'Priorité du ticket - 1,2,3 - Clé étrangère de la table Priorité',
  `fk_id_categorie` int(12) DEFAULT NULL COMMENT 'Catégorie du ticket - Clé étrangère de la table Catégorie',
  `fk_id_departement` int(11) DEFAULT NULL COMMENT 'Département de la personne - Clé étrangère de la table T_Departements ',
  `Date_ouverture` datetime DEFAULT current_timestamp() COMMENT 'Valeur automatique lors de l''ajout - Date d''ouverture du ticket',
  `Date_Probleme` datetime DEFAULT NULL COMMENT 'Date du problème que l''utilisateur entre dans l''interface WEB',
  `Date_fermeture` datetime DEFAULT NULL COMMENT 'Date fermeture ticket',
  `IP` varchar(15) DEFAULT NULL COMMENT 'IP de la machine ayant fait le ticket',
  `Nom_machine_creation` varchar(30) DEFAULT NULL COMMENT 'Nom de la machine ayant fait le ticket (PC-190043)',
  `Nom_machine_probleme` varchar(30) DEFAULT NULL COMMENT 'Nom de la machine ayant le probème (PC-190043)',
  `Localisation` varchar(64) DEFAULT NULL COMMENT 'Lieu du Problème. Exemple : Funcky ',
  `Description_ticket` text DEFAULT NULL COMMENT 'Description du ticket fait par l''utilisateur',
  `Resolution` text DEFAULT NULL COMMENT 'Résolution du ticket fait par le dépanneur'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `T_Tickets`
--

INSERT INTO `T_Tickets` (`id_ticket`, `Utilisateur_demandeur`, `Numero_tel_demandeur`, `fk_id_utilisateur_depanneur`, `fk_id_status`, `fk_id_impact`, `fk_id_priorite`, `fk_id_categorie`, `fk_id_departement`, `Date_ouverture`, `Date_Probleme`, `Date_fermeture`, `IP`, `Nom_machine_creation`, `Nom_machine_probleme`, `Localisation`, `Description_ticket`, `Resolution`) VALUES
('20200330_001', 'Dylan Guiducci', '0041215443848', 4, 5, 1, 1, 1, 13, '2020-03-30 10:44:00', '2020-04-30 08:00:00', '2020-05-26 13:49:56', '192.168.0.12', 'PO190091', '', 'Lausanne, Chemin Primerose 35', 'J\'aurais besoin de droit sur ma nouvelle machine', 'Les droits ont été ajouté depuis l\'Active Directory.\r\nDylan'),
('20200330_002', 'Moussa Shalhoub', '34 54', 4, 1, 3, 2, 1, 3, '2020-03-30 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '123.456.789', 'TB-TEST-OS', 'PCOsama', 'Montreur, bureau 469', 'Le serveur des RHs est tombés. Ils ne peuvent accéder à plus aucun dossier.', 'Osama était intelligent pour régler tout seul'),
('20200417_002', 'Barak Obama', '099 99 999 99', 9, 1, 3, 2, 56, 14, '2020-12-30 12:59:00', '2020-12-30 12:59:00', NULL, '84.226.80.150', 'adsl-84-226-80-150.adslplus.ch', 'Obama office', 'Office m°222', 'Hi gentlemen,\r\n\r\nWe have a conferance call to do \r\nThank \r\nObama', NULL),
('20200423_001', 'Roger Federrer', '+41774808689', 4, 2, 4, 4, 51, 15, '2020-04-16 12:00:00', '2020-04-16 12:00:00', '2020-04-16 12:00:00', '192.168.0.12', '192.168.0.12', 'PC134045', 'Buro', 'Guten Tag, \r\nich will eine neue PC\r\nDanke\r\nMr.Federrer', NULL),
('20200423_002', 'Nuno Palma', '+41774808689', 3, 5, 1, 1, 41, 1, '2020-04-23 12:12:37', '2020-04-08 00:00:00', '2020-06-04 11:36:47', '192.168.0.12', '192.168.0.12', 'PC134045', 'Bureau 69', 'Bonjour, \r\nJ\'aurai besoin d\'accèder aux fichiers de vos notes afin de vous\r\nmettre tous 6. \r\n\r\nKeep it btw us\r\n\r\nNuno', 'Bonjour,\r\n\r\nTout bon. On vous envois l\'argent aujourd\'hui \r\n\r\nIT Team'),
('20200423_003', 'Dylan Guiducci', '+41774808689', NULL, 3, 1, 1, 42, 1, '2020-04-23 16:03:44', '2020-04-16 00:00:00', NULL, '192.168.0.12', '192.168.0.12', 'PC134045', 'cyx', 'gchbn ', NULL),
('20200423_004', 'Tonny Favre-Bulle', '+41774808689', 3, 5, 1, 1, 13, 23, '2020-04-23 16:07:35', '4444-04-04 04:59:00', '2020-06-04 11:37:21', '192.168.0.12', '192.168.0.12', 'PC134045', 'Bureau 70', 'Bonjour,\r\nLe logiciel Outlook ne marche pas.\r\n\r\nMerci de passer voir.\r\nMr.Favre-Bulle', 'Le soft n\'était pas installé. Il fallait l\'installer.\r\nOsama'),
('20200423_005', 'Nazili', '021 966 96 96', 3, 5, 4, 1, 16, 6, '2020-04-23 16:34:35', '2021-01-01 13:00:00', '2020-06-04 11:37:51', '62.167.240.186', '62.167.240.186', 'wewe2', '2322dw', 'Bonjour,\r\nJ\'ai plus de toner, merci de me commander\r\nMr.Nazili', 'Toner commandés et remplacés.\r\nOsama'),
('20200424_001', 'Donald Trump', '+41774808689', 9, 1, 4, 2, 44, 6, '2020-04-24 19:19:03', '2020-04-10 02:02:00', NULL, '192.168.0.12', '192.168.0.12', 'PC134045', 'Office N°92', 'H, \r\nI cannot access to twiter and I need to say bullshit as always. \r\nPlease help\r\nMr.Trump', NULL),
('20200427_001', 'Jackie Chan', '+41774808689', 3, 1, 2, 1, 2, 4, '2020-04-27 14:04:37', '2020-04-27 00:06:00', NULL, '192.168.0.12', '192.168.0.12', 'PC134066', 'Office n°88', 'Hi, \r\nCould you please unlock my account. \r\nThank you\r\nJackie CHan', ''),
('20200502_001', 'Didier Lohri', '+41 21 999 99 99', 3, 5, 1, 1, 45, 6, '2020-05-02 17:10:53', '2020-12-01 01:00:00', '2020-05-07 00:00:00', '84.226.80.150', '84.226.80.150', 'LohriPc', 'chemin de le de rue', 'Bonjour, \r\n\r\nJ\'ai un problème avec ma webcame et je dois faire ma converance de Conseille fédérale.\r\n\r\nMerci de m\'aider\r\n\r\nMR.Lohri', 'Le changement de la cam a été effectué. Une augementation de salaire à été fait aussi. \r\nOsama'),
('20200502_002', 'Angelo Rogeiro', '+41 70 700 00 00', 3, 1, 1, 1, 47, 6, '2020-05-02 17:11:43', '2020-12-01 01:00:00', NULL, '84.226.80.150', '84.226.80.150', 'www', 'chemin de le de rue', 'J\'ai un un problème avec ma souris. Merci de m\'aider au plus vite, sinon vous êtes virés.\r\n\r\nMerci et bisou\r\n\r\nMr.Rogeiro\r\nDirecteur générale ', NULL),
('20200504_001', 'Mayer', '+41774808689', 4, 5, 3, 1, 1, 10, '2020-05-04 09:49:31', '2020-05-14 00:00:00', '2020-05-04 00:00:00', '192.168.0.12', '192.168.0.12', 'PC134045', 'Bioley', 'Droits dans HrAccess\r\nJe n\'ai pas accès à la rubrique Salaire\r\nMr.Mayer', 'Les droits ont été ajouté\r\nDylan'),
('20200504_002', 'Béatrice Piguet', '+41215443848', 4, 1, 1, 3, 23, 3, '2020-05-04 23:31:30', '2020-05-04 20:30:00', NULL, '192.168.0.12', '192.168.0.12', 'CAL14003', 'Bioley', 'Problème avec ma calculatrice.\r\nLa touche Z ne marche pas\r\n ', NULL),
('20200604_001', 'Yannick Widmer', '+41774808689', 4, 5, 1, 3, 45, 1, '2020-06-04 11:15:56', '2020-06-05 12:06:00', '2020-06-04 11:36:26', '192.168.0.12', '192.168.0.12', 'PC134045', 'Bureau 10', 'Bonjour,\r\nMon ecran de me... ne marche pas.\r\nMerci de m\'aider svp\r\nMr.Widmer', 'Ecran était pas branché. Tout bon\r\nDylan'),
('20200604_002', 'Stephane Blanchard', '+41774808689', 3, 1, 1, 3, 43, 1, '2020-06-04 11:16:47', '2020-06-05 12:06:00', NULL, '192.168.0.12', '192.168.0.12', 'PC134045', 'Bureau 22', 'Bonjour,\r\n\r\nJ\'aurai un stagiaire la semaine prochaine.\r\nJe peux vous demander de m\'installer un PC\r\nMr.Blanchard', 'Bonjour Mr.Blanchard,\r\nTout es OK. Redites nous si il y a un soucis.\r\nOsama'),
('20200611_001', 'Béatrice Piguet', '+41215443848', 4, 1, 2, 3, 7, 13, '2020-06-11 10:23:33', '2020-06-09 13:26:00', NULL, '178.197.235.131', '178.197.235.131', 'PC134066', 'Bioley', 'Test', NULL),
('20200617_001', 'Didier Lohri', '555 959595 99', 9, 1, 3, 2, 41, 3, '2020-06-17 18:28:57', '2020-07-01 18:28:00', NULL, '178.197.236.3', '178.197.236.3', 'Lohri PC', 'deriere le bureau la bas', 'ANGELO,\r\nRepare moi cet ecran\r\nLohri', NULL),
('20200622_001', 'Edward snowden', '077 777 77 77', 3, 1, 1, 3, 5, 5, '2020-06-22 09:01:12', '2020-06-21 21:03:00', NULL, '83.173.204.254', '83.173.204.254', 'Edword PC', 'bureau n°01', 'Bonjour, Mon pc ne marche pas et je dois voir pour recette à préparer pour le prochain mariage.\r\nMerci pour votre aide \r\nEdward Snowden', NULL),
('20200625_001', 'ARO', '+41213165858', 9, 1, 4, 4, 54, 13, '2020-06-25 10:54:51', '1970-01-01 01:00:00', NULL, '194.230.146.238', '194.230.146.238', 'Chef d\'apprenti', 'Lausanne', 'Je vous kiff les gars', NULL),
('20200626_001', 'Bernad Nicod', '+4122 548 56 89', NULL, 1, 1, 4, 23, 6, '2020-06-26 19:57:45', '2020-06-25 22:55:00', NULL, '62.2.245.123', '62.2.245.123', 'PC134143', 'Moudon', 'Bonjour,\r\nJe n\'ai pas réussi à me connecté sur mon compte Windows depuis le chantier de Moudon.\r\nVeuillez vite régler le problème !!!', NULL),
('20200629_001', 'Jimmy Cavin', '+4122 348 37 89', NULL, 1, 1, 1, 55, 9, '2020-06-29 20:55:59', '2020-05-29 18:45:00', NULL, '62.2.245.123', '', 'TB140056', 'Lausanne', 'Hello,\r\n\r\nJ\'ai un problème avec mon laptop.\r\nIl ne s\'allume plus.\r\n\r\nA+\r\nJimmy\r\n\r\n', NULL),
('20200629_002', 'Béatrice Piguet', '+4121 544 38 48', NULL, 1, 4, 2, 14, 15, '2020-06-29 21:05:46', '2020-06-24 23:03:00', NULL, '62.2.245.123', '', 'PC134045', 'Lausanne', 'Je n\'arrive pas à ouvrir Book4Time', NULL),
('20200630_001', 'Ruben D\'Amario', '+4178 337 69 16', NULL, 1, 4, 4, 6, 10, '2020-06-30 23:02:11', '2020-06-29 00:00:00', NULL, '178.198.90.109', '', 'PC454565', 'Chez Osama aussi', 'Mon congélateur a disparu. Cela me perturbe énormément car que je n\'arrive pas à dormir sans mon congélateur dans la pièce. Aidez-moi svp.', NULL),
('20200630_002', 'Loïc Damaro', '+4178 554 23 21', NULL, 1, 4, 4, 18, 6, '2020-06-30 23:02:24', '2005-02-24 08:30:00', NULL, '85.7.162.20', '', 'PC15548', 'Chez Osama', 'Mon frigo à disparue que faire ?\r\n\r\nps: j\'ai super soif du coups :(', NULL),
('20200701_001', 'Daniel Bovay', '+4122 456 28 45', NULL, 1, 3, 3, 50, 19, '2020-07-01 19:00:27', '2020-07-01 18:57:00', NULL, '62.2.245.123', '', 'PRT12657', 'Morges', 'Hello,\r\n\r\nNous n\'avons plus de toner. Il faudrait en recommander.\r\n\r\nA+', NULL),
('20200701_002', 'Bernard Meylan', '+4121 345 87 56', NULL, 1, 1, 2, 43, 6, '2020-07-01 20:08:23', '2020-07-07 20:01:00', NULL, '62.2.245.123', '', 'PC200034', 'Bussigny', 'J\'ai eu un problème lors de l\'importation de mes données sur mon nouveau PC.', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `T_Utilisateurs`
--

CREATE TABLE `T_Utilisateurs` (
  `id_utilisateur` int(16) NOT NULL COMMENT 'Id de la table Utilisateur',
  `fk_departement` int(16) NOT NULL COMMENT 'Clé étrangère de la table Dépatement',
  `fk_droit` int(8) NOT NULL COMMENT 'Clé étrangère de la table Droits',
  `Login` varchar(30) DEFAULT NULL COMMENT 'Login de l''utilisateur',
  `salt_user` varchar(64) NOT NULL COMMENT 'Salt du User (8 caractères aléatoire + Hasher en SHA-265)',
  `Password` varchar(128) DEFAULT NULL COMMENT 'Mot de passe de l''utilisateur (salt-pwd + SHA-512)',
  `token_cookie` text DEFAULT NULL COMMENT 'Valeur du cookie connectMPTickets (Hash du username + l''adresse IP + hash password',
  `Nom` varchar(30) NOT NULL COMMENT 'Nom de l''utilisateur',
  `Prenom` varchar(30) NOT NULL COMMENT 'Prénom de l''utilisateur',
  `Numero_Fix` varchar(14) NOT NULL COMMENT 'Numéro du téléphone Fix de l''utilisateur format (0041aabbbccdd)',
  `Numero_Mob` varchar(14) DEFAULT NULL COMMENT 'Numéro du mobile de l''utilisateur format (0041aabbbccdd)',
  `Email` varchar(254) NOT NULL COMMENT 'E-Mail de l''utilisateur'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `T_Utilisateurs`
--

INSERT INTO `T_Utilisateurs` (`id_utilisateur`, `fk_departement`, `fk_droit`, `Login`, `salt_user`, `Password`, `token_cookie`, `Nom`, `Prenom`, `Numero_Fix`, `Numero_Mob`, `Email`) VALUES
(3, 13, 3, 'osama', 'b24887e05a00c9c09f4f13ad72cf4b3ce616d1dce640d93eb62ac6294ac03034', '$6$rounds=5000$b24887e05a00c9c0$kw8XPW1lyfEZQE8KsGiLwe8I4j3Lq4kuu29UxBGTAHbQVkr1My6PGTAhDimQV31ZsTtaZXPqEaWH0rKTVkHZz0', 'ea32cd48b96ddd5b6178662335245ed47a7ce6544cb09e88ecbcb01e758621e0', 'Shalhoub', 'Osama', '079 269 90 35', '079 269 90 35', 'osama.shalhoub@fairmont.com'),
(4, 13, 3, 'dylan', 'e465c88bf846f48140504ae2b2c0b5e1cb29dbcfb2c153e83de81b6681e2fc7b', '$6$rounds=5000$e465c88bf846f481$PSydBhWU2PWsdcKMeq93TMEsW3tpXEE6V52W6Z7k7ocjHxvHzf3nG/xKhunBRgDtJndeQJWHzLoxQLpNzcYOp0', NULL, 'Guiducci', 'Dylan', '0215443848', '077 480 86 89', 'dylan.guiducci@fairmont.com'),
(9, 6, 3, 'rogeiroa', '9dc409fba5575f9a534029f4e2974f3aaf49fe0642791c6ebf4160c587e9ffbd', '$6$rounds=5000$9dc409fba5575f9a$21iPEE2gQL1l2vWMpQ.YpIBIagvJbSWTdjivjls8cCfKGUl/e0VHyP.j2R55ILwbI.uCEJQBWVDaQijFGeN70/', NULL, 'Rogeiro', 'Angelo', '021 316 58 58', '079 799 79 79', 'angelo.rogeiro@fairmont.com');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `T_Categories`
--
ALTER TABLE `T_Categories`
  ADD PRIMARY KEY (`id_categorie`),
  ADD KEY `fk_categorie` (`fk_categorie`);

--
-- Index pour la table `T_Commentaires`
--
ALTER TABLE `T_Commentaires`
  ADD PRIMARY KEY (`id_commentaire`),
  ADD KEY `fk_id_ticket` (`fk_id_ticket`,`fk_id_utilisateur`),
  ADD KEY `T_Commentaires_ibfk_utilisateur` (`fk_id_utilisateur`);

--
-- Index pour la table `T_Departements`
--
ALTER TABLE `T_Departements`
  ADD PRIMARY KEY (`id_departement`);

--
-- Index pour la table `T_Documents`
--
ALTER TABLE `T_Documents`
  ADD PRIMARY KEY (`id_document`),
  ADD KEY `fk_id_ticket` (`fk_id_ticket`,`fk_id_utilisateur`),
  ADD KEY `T_Documents_ibfk_Utilisateur` (`fk_id_utilisateur`);

--
-- Index pour la table `T_Droits`
--
ALTER TABLE `T_Droits`
  ADD PRIMARY KEY (`id_droit`);

--
-- Index pour la table `T_Impacts`
--
ALTER TABLE `T_Impacts`
  ADD PRIMARY KEY (`id_impact`);

--
-- Index pour la table `T_Priorites`
--
ALTER TABLE `T_Priorites`
  ADD PRIMARY KEY (`id_priorite`);

--
-- Index pour la table `T_Status`
--
ALTER TABLE `T_Status`
  ADD PRIMARY KEY (`id_status`);

--
-- Index pour la table `T_Tickets`
--
ALTER TABLE `T_Tickets`
  ADD PRIMARY KEY (`id_ticket`),
  ADD KEY `T_Tickets_ibfk_depanneur` (`fk_id_utilisateur_depanneur`),
  ADD KEY `T_Tickets_ibfk_status` (`fk_id_status`),
  ADD KEY `T_Tickets_ibfk_impact` (`fk_id_impact`),
  ADD KEY `T_Tickets_ibfk_priorite` (`fk_id_priorite`),
  ADD KEY `T_Tickets_ibfk_categorie` (`fk_id_categorie`),
  ADD KEY `T_Tickets_ibfk_departement` (`fk_id_departement`);

--
-- Index pour la table `T_Utilisateurs`
--
ALTER TABLE `T_Utilisateurs`
  ADD PRIMARY KEY (`id_utilisateur`),
  ADD KEY `fk_departement` (`fk_departement`,`fk_droit`),
  ADD KEY `T_Utilisateurs_ibfk_droit` (`fk_droit`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `T_Categories`
--
ALTER TABLE `T_Categories`
  MODIFY `id_categorie` int(16) NOT NULL AUTO_INCREMENT COMMENT 'id de la table Catégorie', AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT pour la table `T_Commentaires`
--
ALTER TABLE `T_Commentaires`
  MODIFY `id_commentaire` int(32) NOT NULL AUTO_INCREMENT COMMENT 'id de la table Commentaire', AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT pour la table `T_Documents`
--
ALTER TABLE `T_Documents`
  MODIFY `id_document` int(16) NOT NULL AUTO_INCREMENT COMMENT 'Id de la table Document';

--
-- AUTO_INCREMENT pour la table `T_Droits`
--
ALTER TABLE `T_Droits`
  MODIFY `id_droit` int(8) NOT NULL AUTO_INCREMENT COMMENT 'Id de la table Droits', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `T_Impacts`
--
ALTER TABLE `T_Impacts`
  MODIFY `id_impact` int(8) NOT NULL AUTO_INCREMENT COMMENT 'Id de la table impact', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `T_Priorites`
--
ALTER TABLE `T_Priorites`
  MODIFY `id_priorite` int(8) NOT NULL AUTO_INCREMENT COMMENT 'id de la table priorités', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `T_Status`
--
ALTER TABLE `T_Status`
  MODIFY `id_status` int(8) NOT NULL AUTO_INCREMENT COMMENT 'Id de la table Status', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `T_Utilisateurs`
--
ALTER TABLE `T_Utilisateurs`
  MODIFY `id_utilisateur` int(16) NOT NULL AUTO_INCREMENT COMMENT 'Id de la table Utilisateur', AUTO_INCREMENT=12;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `T_Categories`
--
ALTER TABLE `T_Categories`
  ADD CONSTRAINT `T_Categories_ibfk_1` FOREIGN KEY (`fk_categorie`) REFERENCES `T_Categories` (`id_categorie`);

--
-- Contraintes pour la table `T_Commentaires`
--
ALTER TABLE `T_Commentaires`
  ADD CONSTRAINT `T_Commentaires_ibfk_ticket` FOREIGN KEY (`fk_id_ticket`) REFERENCES `T_Tickets` (`id_ticket`),
  ADD CONSTRAINT `T_Commentaires_ibfk_utilisateur` FOREIGN KEY (`fk_id_utilisateur`) REFERENCES `T_Utilisateurs` (`id_utilisateur`);

--
-- Contraintes pour la table `T_Documents`
--
ALTER TABLE `T_Documents`
  ADD CONSTRAINT `T_Documents_ibfk_Ticket` FOREIGN KEY (`fk_id_ticket`) REFERENCES `T_Tickets` (`id_ticket`),
  ADD CONSTRAINT `T_Documents_ibfk_Utilisateur` FOREIGN KEY (`fk_id_utilisateur`) REFERENCES `T_Utilisateurs` (`id_utilisateur`);

--
-- Contraintes pour la table `T_Tickets`
--
ALTER TABLE `T_Tickets`
  ADD CONSTRAINT `T_Tickets_ibfk_categorie` FOREIGN KEY (`fk_id_categorie`) REFERENCES `T_Categories` (`id_categorie`),
  ADD CONSTRAINT `T_Tickets_ibfk_depanneur` FOREIGN KEY (`fk_id_utilisateur_depanneur`) REFERENCES `T_Utilisateurs` (`id_utilisateur`),
  ADD CONSTRAINT `T_Tickets_ibfk_departement` FOREIGN KEY (`fk_id_departement`) REFERENCES `T_Departements` (`id_departement`),
  ADD CONSTRAINT `T_Tickets_ibfk_impact` FOREIGN KEY (`fk_id_impact`) REFERENCES `T_Impacts` (`id_impact`),
  ADD CONSTRAINT `T_Tickets_ibfk_priorite` FOREIGN KEY (`fk_id_priorite`) REFERENCES `T_Priorites` (`id_priorite`),
  ADD CONSTRAINT `T_Tickets_ibfk_status` FOREIGN KEY (`fk_id_status`) REFERENCES `T_Status` (`id_status`);

--
-- Contraintes pour la table `T_Utilisateurs`
--
ALTER TABLE `T_Utilisateurs`
  ADD CONSTRAINT `T_Utilisateurs_ibfk_departement` FOREIGN KEY (`fk_departement`) REFERENCES `T_Departements` (`id_departement`),
  ADD CONSTRAINT `T_Utilisateurs_ibfk_droit` FOREIGN KEY (`fk_droit`) REFERENCES `T_Droits` (`id_droit`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
