-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 23 jan. 2025 à 16:13
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
-- Base de données : `esembe_business`
--

-- --------------------------------------------------------

--
-- Structure de la table `abonne`
--

CREATE TABLE `abonne` (
  `id` int(11) NOT NULL,
  `mail` text NOT NULL,
  `date_abonnement` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `statut` text NOT NULL,
  `temps_attente` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `id_admin`, `statut`, `temps_attente`) VALUES
(1, 102, 'actif', 0),
(2, 130, 'actif', 0),
(3, 136, 'actif', 0),
(4, 134, 'actif', 0),
(5, 139, 'actif', 0);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id_categorie` int(11) NOT NULL,
  `titre` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `date_ajout` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `titre`, `description`, `date_ajout`) VALUES
(3, 'Technologie', 'Technologie', '2024-05-22 22:31:33'),
(4, 'Habillement', 'Habillement', '2024-05-22 22:31:43'),
(5, 'Education', 'Education', '2024-05-22 22:31:53'),
(6, 'Boisson', 'Toutes les boissons', '2024-05-28 18:25:43');

-- --------------------------------------------------------

--
-- Structure de la table `code_admin`
--

CREATE TABLE `code_admin` (
  `id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `date_change` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `code_admin`
--

INSERT INTO `code_admin` (`id`, `code`, `date_change`) VALUES
(1, '9561', '2024-07-27 16:20:16');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id_commande` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `produit_commande` varchar(50) NOT NULL,
  `prix_achat` varchar(20) NOT NULL,
  `prix_vente` varchar(30) NOT NULL,
  `quantite` int(11) NOT NULL,
  `montant_total` varchar(255) NOT NULL,
  `nom` varchar(25) NOT NULL,
  `postnom` varchar(25) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `mail` text NOT NULL,
  `phone` varchar(25) NOT NULL,
  `adresse_livraison` varchar(255) NOT NULL,
  `statut` varchar(20) NOT NULL,
  `moyen_paiement` varchar(20) NOT NULL,
  `facture` text NOT NULL,
  `type_commande` varchar(10) NOT NULL,
  `message` text NOT NULL,
  `date_commande` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `comment_page`
--

CREATE TABLE `comment_page` (
  `id` int(11) NOT NULL,
  `id_pub` int(11) NOT NULL,
  `id_expediteur` int(11) NOT NULL,
  `expediteur` text NOT NULL,
  `message` text NOT NULL,
  `date_comment` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `comment_page`
--

INSERT INTO `comment_page` (`id`, `id_pub`, `id_expediteur`, `expediteur`, `message`, `date_comment`) VALUES
(1, 1, 0, 'Russell Mpenemoke', 'salut', '2023-08-17 21:51:57'),
(2, 2, 0, 'Russell Mpenemoke', 'salut', '2023-08-18 14:27:19'),
(3, 3, 0, 'Russell Mpenemoke', 'salut', '2023-08-19 23:47:31'),
(4, 2, 0, 'Russell Mpenemoke', 'v', '2023-08-20 11:09:18'),
(5, 6, 0, 'Russell Mpenemoke', 'xccccccc', '2024-01-14 14:19:55'),
(6, 6, 0, 'Russell Mpenemoke', 'xccccccc', '2024-01-14 14:20:41'),
(7, 6, 0, 'Russell Mpenemoke', 'rrrrrrrrr', '2024-01-14 14:20:46'),
(8, 5, 0, 'Russell Mpenemoke', 's', '2024-01-14 15:34:26'),
(9, 6, 0, 'Russell Mpenemoke', 'ssssssssssssssss', '2024-01-14 15:42:00'),
(10, 6, 0, 'Russell Mpenemoke', 'sssssssssssssssssssssssssssss', '2024-01-14 15:42:35'),
(11, 33, 0, 'Russell  Mpenemoke ', 'dddddd', '2024-03-09 07:19:54');

-- --------------------------------------------------------

--
-- Structure de la table `contact_esembe`
--

CREATE TABLE `contact_esembe` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `mail` text NOT NULL,
  `sujet` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `date_message` datetime NOT NULL,
  `lu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `contact_esembe`
--

INSERT INTO `contact_esembe` (`id`, `nom`, `prenom`, `mail`, `sujet`, `message`, `date_message`, `lu`) VALUES
(3, 'Mpenemoke', 'Russell ', 'russellmk8299@gmail.com', 'Votre site', 'ccc', '2024-05-24 20:30:25', 1),
(5, 'Mpenemoke', 'Russell ', 'russellmk8299@gmail.com', 'Votre site', 'nnnn', '2024-06-11 12:58:27', 1),
(6, 'Ngoma ', 'Arechange', 'archangengoma931@gmail.com', 'Avoir un produit', 'Bonjour, j&#039;ai besoin d&#039;un jus FANTA \nAu plus possible svp', '2024-10-25 14:03:27', 0);

-- --------------------------------------------------------

--
-- Structure de la table `depense`
--

CREATE TABLE `depense` (
  `id` int(11) NOT NULL,
  `motif_depense` varchar(255) NOT NULL,
  `produit_concerne` varchar(100) NOT NULL,
  `montant_depense` int(11) NOT NULL,
  `date_depense` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `depense`
--

INSERT INTO `depense` (`id`, `motif_depense`, `produit_concerne`, `montant_depense`, `date_depense`) VALUES
(1, 'Achat jus', '', 2000, '2024-07-02 23:27:04'),
(2, 'Achat carton biscuit', '', 4750, '2024-07-01 23:34:46'),
(4, 'Achat savon', '', 900, '2024-07-07 16:33:41'),
(5, 'Réstauration', '', 9500, '2024-07-07 16:34:50'),
(6, 'Réstauration', '', 6000, '2024-07-07 16:35:59'),
(7, 'Réstauration', '', 6000, '2024-07-07 16:36:05'),
(8, 'Réstauration', '', 3500, '2024-07-08 01:10:16'),
(9, 'Réstauration', '', 5000, '2024-07-09 00:44:52'),
(10, 'Réstauration', '', 11000, '2024-07-10 01:10:18'),
(11, 'Consomé', 'ENERGY', 1000, '2024-07-13 17:48:03'),
(12, 'Restauration', '-', 4000, '2024-07-13 17:49:40'),
(13, 'HS', '-', 75000, '2024-07-13 17:50:14'),
(14, 'Restauration', '-', 5000, '2024-07-13 17:54:21'),
(15, 'Réstauration', '-', 9000, '2024-07-13 19:53:05'),
(16, 'Réstauration', '-', 9000, '2024-07-14 01:48:15'),
(17, 'Consomé', 'ENERGY', 1000, '2024-07-14 01:59:59'),
(18, 'Réstauration', '-', 3500, '2024-07-15 23:51:14'),
(19, 'Consomé', 'ENERGY', 1000, '2024-07-18 06:45:31'),
(20, 'restauration', '-', 17000, '2024-07-18 06:46:06'),
(21, 'Consomé', 'U-FRESH', 700, '2024-07-18 07:01:39'),
(22, 'Réstauration', '-', 8000, '2024-07-18 07:02:16'),
(23, 'Réstauration', '-', 10000, '2024-07-20 18:10:11'),
(24, 'Réstauration', '-', 16000, '2024-07-21 10:53:45'),
(25, 'Consomé', 'U-FRESH', 700, '2024-07-21 10:54:24'),
(26, 'Consomé', 'ENERGY', 1000, '2024-07-22 00:27:01'),
(27, 'Réstauration', '-', 10000, '2024-07-22 00:28:07'),
(28, 'Consomé', 'XXL', 2000, '2024-07-22 22:59:12'),
(29, 'Réstauration', '-', 8000, '2024-07-22 22:59:52'),
(30, 'loyer', '-', 154000, '2024-07-23 13:34:16'),
(31, 'Réstauration', '-', 8000, '2024-07-25 21:33:59'),
(32, 'Réstauration', '-', 9000, '2024-07-25 21:46:50'),
(33, 'Consomé', 'ENERGY', 1000, '2024-07-26 20:57:16'),
(34, 'Réstauration', '-', 10000, '2024-07-26 20:57:40'),
(35, 'Consomé', 'ENERGY', 1000, '2024-07-27 16:18:01'),
(36, 'restauration', 'argent', 10000, '2024-07-27 16:18:29'),
(37, 'Réstauration', '-', 10000, '2024-07-28 22:08:34'),
(38, 'Réstauration', '-', 15000, '2024-07-29 16:31:07'),
(39, 'Réstauration', '-', 7000, '2024-07-30 12:16:18'),
(40, 'Consomé', 'ENERGY 2', 2000, '2024-07-30 19:19:22'),
(41, 'Consomé', 'alpina 2', 1000, '2024-07-30 19:19:56'),
(42, 'Réstauration', '-', 7500, '2024-07-30 22:59:42'),
(43, 'Consomé', 'ENERGY', 1000, '2024-08-03 12:25:28'),
(44, 'Consomé', 'alpina ', 500, '2024-08-03 12:26:00'),
(45, 'Réstauration', '-', 8000, '2024-08-03 12:26:52'),
(46, 'Réstauration', '-', 18000, '2024-08-03 12:49:35'),
(47, 'Consomé', 'ENERGY', 1000, '2024-08-05 13:27:47'),
(48, 'Réstauration', '-', 8000, '2024-08-05 13:29:03'),
(49, 'Consomé', 'ENERGY', 1000, '2024-08-05 13:53:43'),
(50, 'Consomé', 'COCA PLASTIQUE', 1000, '2024-08-05 13:53:59'),
(51, 'Réstauration', '-', 24000, '2024-08-05 13:54:28'),
(52, 'Réstauration', '-', 10000, '2024-08-09 19:26:38'),
(53, 'Réstauration', '-', 10000, '2024-08-09 19:35:36'),
(54, 'Réstauration', '-', 10000, '2024-08-09 19:44:57');

-- --------------------------------------------------------

--
-- Structure de la table `dette_client`
--

CREATE TABLE `dette_client` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `sexe` varchar(10) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `adresse` text NOT NULL,
  `produit_emprunte` varchar(100) NOT NULL,
  `montant_emprunt` int(11) NOT NULL,
  `statut` text NOT NULL,
  `code` varchar(11) NOT NULL,
  `date_emprunt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `dette_client`
--

INSERT INTO `dette_client` (`id`, `nom`, `prenom`, `sexe`, `telephone`, `adresse`, `produit_emprunte`, `montant_emprunt`, `statut`, `code`, `date_emprunt`) VALUES
(11, 'MOISE', 'LULU GR V', 'Homme', '+243824195733', 'campus', '', 3500, 'non payéé', '9859767', '2024-07-09 00:43:43'),
(15, 'ASHURA', 'BRINEL', 'Femme', '+243824195733', 'campus', 'LULU ', 3500, 'non payéé', '1240180', '2024-07-11 00:19:18'),
(16, 'ARCHIL ', 'KAMBALE', 'Homme', '+243824195733', 'campus', 'DOPEL', 4800, 'non payéé', '7533160', '2024-07-11 20:29:15'),
(21, 'MOISE', '-', 'Homme', '+243824195733', 'campus', '10USD', 10, 'non payéé', '8847681', '2024-08-30 20:47:28'),
(24, 'Simon', 's', 'Homme', '+243824195733', 'campus', 'argent', 1000, 'non payéé', '9343495', '2024-09-01 11:19:34'),
(25, 'VOLONTE', 'V', 'Homme', '0992846177', 'campus', 'Mirinda pl', 1000, 'non payéé', '4404049', '2024-09-01 16:48:49'),
(27, 'ALEMBE', 'A', 'Homme', '+243824195733', 'campus', '1EXO,3v am', 8500, 'non payéé', '8073330', '2024-09-02 18:48:21'),
(28, 'Lavie', 'L', 'Homme', '+243824195733', 'campus', '3kolomboka', 5000, 'non payéé', '0445866', '2024-09-06 19:06:40'),
(29, 'Etienne ', 'michunga', 'Homme', '+243824195733', 'campus', 'v am, energy', 2500, 'non payéé', '1643817', '2024-09-08 09:49:13');

-- --------------------------------------------------------

--
-- Structure de la table `fichiers`
--

CREATE TABLE `fichiers` (
  `id` int(11) NOT NULL,
  `utilisateur_id` int(11) NOT NULL,
  `nom_fichier` varchar(50) NOT NULL,
  `date_ajout` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `fichiers`
--

INSERT INTO `fichiers` (`id`, `utilisateur_id`, `nom_fichier`, `date_ajout`, `description`) VALUES
(31, 196, '666413baa07bapdf', 2024, NULL),
(32, 134, '66686f8c2eab1pdf', 2024, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `fichiers_page`
--

CREATE TABLE `fichiers_page` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_page` int(11) NOT NULL,
  `nom_fichier` varchar(50) NOT NULL,
  `extension` varchar(255) NOT NULL,
  `date_ajout` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `fichiers_page`
--

INSERT INTO `fichiers_page` (`id`, `id_user`, `id_page`, `nom_fichier`, `extension`, `date_ajout`) VALUES
(35, 130, 18, '65eb0dc28a29d.pdf', 'pdf', '2024-03-08 14:08:18');

-- --------------------------------------------------------

--
-- Structure de la table `membre_effectif`
--

CREATE TABLE `membre_effectif` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `postnom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `type` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `membre_effectif`
--

INSERT INTO `membre_effectif` (`id`, `nom`, `postnom`, `prenom`, `type`) VALUES
(2, 'Mpenemoke', 'Modiri', 'Tendresse ', 'Super Administratrice'),
(4, 'Imidi', 'Ibrahim', 'Hils', 'Super Administrateur');

-- --------------------------------------------------------

--
-- Structure de la table `membre_esembe`
--

CREATE TABLE `membre_esembe` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `postnom` varchar(25) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `sexe` text NOT NULL,
  `mail` text NOT NULL,
  `type` text NOT NULL,
  `phone` text NOT NULL,
  `motdepasse` text NOT NULL,
  `status` text NOT NULL,
  `last_activity` text NOT NULL,
  `date_inscription` datetime NOT NULL,
  `confirme` int(11) NOT NULL,
  `statut` text NOT NULL,
  `derniere_activite` datetime NOT NULL,
  `avatar` longtext NOT NULL,
  `couverture` longtext NOT NULL,
  `id_parent` int(11) NOT NULL,
  `id_ancetre` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `membre_esembe`
--

INSERT INTO `membre_esembe` (`id`, `nom`, `postnom`, `prenom`, `sexe`, `mail`, `type`, `phone`, `motdepasse`, `status`, `last_activity`, `date_inscription`, `confirme`, `statut`, `derniere_activite`, `avatar`, `couverture`, `id_parent`, `id_ancetre`) VALUES
(134, 'Mpenemoke', 'Kaniki', 'Russell ', 'Homme', 'russellmk8299@gmail.com', 'Super Administrateur', '0979880155', '$2y$10$h8IKEFeaxE2bhShM0ilXV.ipf6gEfEtxH5JNHlVrzKjrfCRZCmcDe', 'Hors ligne', '1718123880', '2024-05-25 02:05:57', 1, 'actif', '2024-07-12 00:35:17', '66684249913ed.jpg', '66523ce367be7.jpeg', 0, 0),
(138, 'Esembe', 'Esembe', 'Esembe', 'Homme', 'esembe@gmail.com', 'Super Administrateur', '+24382254438', '$2y$10$Uc.deDlK71eYWPesnnA77emiwGzY20xHRj.J9lLGgart3Pk5YWS8W', 'Hors ligne', '1716748454', '2024-05-26 08:05:14', 1, 'actif', '2024-05-27 15:27:14', '6654987e9c607.jpeg', '', 135, 134),
(139, 'Imidi', 'Ibrahim', 'Hils', 'Homme', 'Hilsonalbert@gmail.com', 'Super Administrateur', '0992846177', '$2y$10$PQen6VZbbVH9uLPQNvmA1eALYycsw4saUl65DxrRMH8RKUSKKymBO', 'En ligne', '1720266387', '2024-07-06 01:07:27', 0, 'actif', '2025-01-23 15:59:08', '668dc7307836d.jpg', '', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `incoming_msg_id` int(11) NOT NULL,
  `outgoing_msg_id` int(11) NOT NULL,
  `msg` varchar(1000) NOT NULL,
  `extension` text NOT NULL,
  `msg_audio` longblob NOT NULL,
  `date_message` datetime NOT NULL,
  `lu` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`, `extension`, `msg_audio`, `date_message`, `lu`) VALUES
(830, 134, 139, 'salut', '', '', '2024-07-10 19:14:22', 0),
(831, 134, 139, '668ec22848ef8.jpg', 'jpg', '', '2024-07-10 19:17:28', 0),
(832, 138, 139, 'salut', '', '', '2024-07-10 19:18:12', 0);

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `id_from` int(11) NOT NULL,
  `id_to` int(11) NOT NULL,
  `sujet` varchar(255) NOT NULL,
  `msg` text NOT NULL,
  `lu` int(11) NOT NULL,
  `date_envoi` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `notification`
--

INSERT INTO `notification` (`id`, `id_from`, `id_to`, `sujet`, `msg`, `lu`, `date_envoi`) VALUES
(20, 138, 134, 'Code bureau admin', 'Russell  Mpenemoke  , le code d\'accès au bureau d\'administration pour cette semaine est : 1643', 1, '2024-06-11 01:58:47'),
(21, 138, 138, 'Code bureau admin', 'Esembe Esembe , le code d\'accès au bureau d\'administration pour cette semaine est : 1643', 0, '2024-06-11 01:58:47'),
(22, 138, 134, 'Code bureau admin', 'Russell  Mpenemoke  , le code d\'accès au bureau d\'administration pour cette semaine est : 4391', 1, '2024-06-11 13:19:12'),
(23, 138, 138, 'Code bureau admin', 'Esembe Esembe , le code d\'accès au bureau d\'administration pour cette semaine est : 4391', 0, '2024-06-11 13:19:12'),
(28, 138, 134, 'Produit à quantité presque épuisée', ' <span class=\'text-primary\'>Russell  Mpenemoke</span>, Alerte !!!!! Vous avez des produits dont la quantité est presque épuisée.<br>\r\n      Veuillez cliquer <a href=\'admin/produit_a_quantite_presque_epuisee\' target=\'_blank\' class=\'btn btn-primary btn-sm text-white\'> ici pour en savoir plus</a>', 0, '2024-07-12 00:35:17'),
(34, 138, 134, 'Code bureau admin', 'Russell  Mpenemoke , le code d\'accès au bureau d\'administration pour cette semaine est : 9561', 0, '2024-07-27 16:20:16'),
(35, 138, 138, 'Code bureau admin', 'Esembe Esembe , le code d\'accès au bureau d\'administration pour cette semaine est : 9561', 0, '2024-07-27 16:20:16'),
(36, 138, 139, 'Code bureau admin', 'Hils Imidi , le code d\'accès au bureau d\'administration pour cette semaine est : 9561', 1, '2024-07-27 16:20:16'),
(39, 138, 139, 'Produit à quantité presque épuisée', ' <span class=\'text-primary\'>Hils Imidi</span>, Alerte !!!!! Vous avez des produits dont la quantité est presque épuisée.<br>\r\n      Veuillez cliquer <a href=\'admin/produit_a_quantite_presque_epuisee\' target=\'_blank\' class=\'btn btn-primary btn-sm text-white\'> ici pour en savoir plus</a>', 1, '2024-08-26 20:58:24'),
(40, 138, 139, 'Produit à quantité presque épuisée', ' <span class=\'text-primary\'>Hils Imidi</span>, Alerte !!!!! Vous avez des produits dont la quantité est presque épuisée.<br>\r\n      Veuillez cliquer <a href=\'admin/produit_a_quantite_presque_epuisee\' target=\'_blank\' class=\'btn btn-primary btn-sm text-white\'> ici pour en savoir plus</a>', 1, '2024-08-28 09:14:40'),
(41, 138, 139, 'Produit à quantité presque épuisée', ' <span class=\'text-primary\'>Hils Imidi</span>, Alerte !!!!! Vous avez des produits dont la quantité est presque épuisée.<br>\r\n      Veuillez cliquer <a href=\'admin/produit_a_quantite_presque_epuisee\' target=\'_blank\' class=\'btn btn-primary btn-sm text-white\'> ici pour en savoir plus</a>', 1, '2024-08-30 12:53:18'),
(42, 138, 139, 'Produit à quantité presque épuisée', ' <span class=\'text-primary\'>Hils Imidi</span>, Alerte !!!!! Vous avez des produits dont la quantité est presque épuisée.<br>\r\n      Veuillez cliquer <a href=\'admin/produit_a_quantite_presque_epuisee\' target=\'_blank\' class=\'btn btn-primary btn-sm text-white\'> ici pour en savoir plus</a>', 1, '2024-08-30 20:45:55'),
(43, 138, 139, 'Produit à quantité presque épuisée', ' <span class=\'text-primary\'>Hils Imidi</span>, Alerte !!!!! Vous avez des produits dont la quantité est presque épuisée.<br>\r\n      Veuillez cliquer <a href=\'admin/produit_a_quantite_presque_epuisee\' target=\'_blank\' class=\'btn btn-primary btn-sm text-white\'> ici pour en savoir plus</a>', 1, '2024-09-08 09:47:52'),
(44, 138, 139, 'Produit à quantité presque épuisée', ' <span class=\'text-primary\'>Hils Imidi</span>, Alerte !!!!! Vous avez des produits dont la quantité est presque épuisée.<br>\r\n      Veuillez cliquer <a href=\'admin/produit_a_quantite_presque_epuisee\' target=\'_blank\' class=\'btn btn-primary btn-sm text-white\'> ici pour en savoir plus</a>', 1, '2024-10-11 15:44:27'),
(45, 138, 139, 'Produit à quantité presque épuisée', ' <span class=\'text-primary\'>Hils Imidi</span>, Alerte !!!!! Vous avez des produits dont la quantité est presque épuisée.<br>\r\n      Veuillez cliquer <a href=\'admin/produit_a_quantite_presque_epuisee\' target=\'_blank\' class=\'btn btn-primary btn-sm text-white\'> ici pour en savoir plus</a>', 0, '2024-11-11 13:20:54');

-- --------------------------------------------------------

--
-- Structure de la table `page`
--

CREATE TABLE `page` (
  `id` int(11) NOT NULL,
  `id_createur` int(11) NOT NULL,
  `pays` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `categorie` text NOT NULL,
  `biographie` text NOT NULL,
  `site` text NOT NULL,
  `mail` text NOT NULL,
  `phone` text NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `photo` longtext NOT NULL,
  `cover` longtext NOT NULL,
  `abonnement` varchar(255) NOT NULL,
  `statut` text NOT NULL,
  `unique_id` text NOT NULL,
  `confirme` int(11) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `page`
--

INSERT INTO `page` (`id`, `id_createur`, `pays`, `ville`, `adresse`, `categorie`, `biographie`, `site`, `mail`, `phone`, `titre`, `description`, `photo`, `cover`, `abonnement`, `statut`, `unique_id`, `confirme`, `date_creation`) VALUES
(18, 134, 'France', 'Paris', 'Lemba', 'Transport', '', '', 'm@gmail.com', '0822251453', 'Rus Business', 'Rus business /république démocratique du congo', '65eae4c1bfdf3.jpg', '18.jpg', '', 'active', '65ea3de17d1fa', 0, '2024-05-28 01:05:46');

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `id_panier` int(11) NOT NULL,
  `id_client` text NOT NULL,
  `id_produit` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix_total` decimal(10,0) NOT NULL,
  `date_ajout` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`id_panier`, `id_client`, `id_produit`, `quantite`, `prix_total`, `date_ajout`) VALUES
(62, '66683b2e3947e', 13, 1, '1', '2024-06-11 12:59:41'),
(63, '66683b2e3947e', 10, 1, '1', '2024-06-11 12:59:51'),
(64, '66683b2e3947e', 11, 1, '1', '2024-06-11 12:59:53'),
(65, '66683b2e3947e', 12, 1, '1', '2024-06-11 12:59:58'),
(67, '666869ba13602', 15, 1, '24', '2024-06-11 16:14:16'),
(68, '666869ba13602', 31, 1, '1000', '2024-06-11 16:14:19'),
(69, '666869ba13602', 10, 1, '1', '2024-06-11 16:17:52');

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

CREATE TABLE `photo` (
  `id` int(11) NOT NULL,
  `utilisateur_id` int(11) NOT NULL,
  `nom_fichier` varchar(255) NOT NULL,
  `extension` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date_ajout` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `photo`
--

INSERT INTO `photo` (`id`, `utilisateur_id`, `nom_fichier`, `extension`, `description`, `date_ajout`) VALUES
(102, 134, '66686ff6ef445.jpeg', 'jpeg', '', '2024-06-11 17:40:38');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id_produit` int(11) NOT NULL,
  `nom_produit` varchar(50) NOT NULL,
  `type_produit` varchar(30) NOT NULL,
  `categorie` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `prix_achat_gros` varchar(20) NOT NULL,
  `prix_achat_details` decimal(31,2) NOT NULL,
  `prix_vente_gros` decimal(38,2) NOT NULL,
  `prix_vente_details` decimal(31,2) NOT NULL,
  `quantite` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `fichier` longtext NOT NULL,
  `date_ajout` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `nom_produit`, `type_produit`, `categorie`, `description`, `prix_achat_gros`, `prix_achat_details`, `prix_vente_gros`, `prix_vente_details`, `quantite`, `stock`, `fichier`, `date_ajout`) VALUES
(33, 'Festa energy inv', 'Jus', 'Boisson', 'Jus energy festa petite bouteille', '136000', '700.00', '196000.00', '1000.00', 181, 0, '668935e81963a.jpg', '2024-07-06 14:17:44'),
(34, 'Festa ananas', 'Jus', 'Boisson', 'Festa anana petite bouteille ', '1200', '600.00', '8400.00', '700.00', -34, 25, '668936aead3d5.jpg', '2024-07-06 14:21:02'),
(35, 'Alpina inv', 'eau', 'Boisson', 'Eau en bouteille', '150000', '400.00', '198000.00', '500.00', 360, 0, '6689378dc78c0.jpg', '2024-07-06 14:24:45'),
(36, 'Eau bidon', 'eau', 'Boisson', 'Eau purifiée en bidon', '135450', '630.00', '215000.00', '1000.00', -143, 215, '66893a2d1e197.jpg', '2024-07-06 14:29:41'),
(37, 'Zesta mangue 1L', 'Jus', 'Boisson', 'zesta mangue grande bouteille', '4200', '1400.00', '12000.00', '2000.00', -13, 17, '66893bee216fe.jpg', '2024-07-06 14:43:26'),
(38, 'Compal', 'Sucré', 'Boisson', 'Sucré canette', '1900', '1900.00', '67200.00', '2800.00', 21, 0, '668940bb3f0ea.jpg', '2024-07-06 15:03:55'),
(39, '7up', 'Sucré', 'Boisson', 'Sucré canette', '1900', '1900.00', '67200.00', '2800.00', 6, 0, '6689415bdcc90.jpg', '2024-07-06 15:06:35'),
(40, 'Mirinda', 'Jus', 'Boisson', 'Sucré canette', '1900', '1900.00', '67200.00', '2800.00', 5, 0, '668941f38cbb8.jpg', '2024-07-06 15:09:07'),
(41, 'Sprite', 'Sucré', 'Boisson', '', '1700', '1700.00', '60000.00', '2500.00', 7, 0, '668943806d35e.jpg', '2024-07-06 15:15:44'),
(42, 'Cuca inv', 'Alcool', 'Boisson', 'Boisson alcoolisée en canette', '34000', '1420.00', '48000.00', '2000.00', 22, 0, '668945d65050c.jpg', '2024-07-06 15:25:42'),
(43, 'XXL', 'Sucré', 'Boisson', '', '32000', '1400.00', '48000.00', '2000.00', -12, 24, '6689477b079b4.jpg', '2024-07-06 15:32:43'),
(44, 'Bavaria', 'Sucré', 'Boisson', '', '3400', '3400.00', '108000.00', '4500.00', 0, 0, '668949538eb4a.jpg', '2024-07-06 15:40:35'),
(45, 'Bavaria petit', 'Sucré', 'Boisson', '', '2100', '2100.00', '72000.00', '3000.00', 7, 0, '66894a57d66e7.jpg', '2024-07-06 15:44:55'),
(46, 'Fanta', 'Sucré', 'Boisson', '', '38000', '1600.00', '60000.00', '2500.00', -2, 0, '66894af241ea9.jpg', '2024-07-06 15:47:30'),
(47, 'Coca', 'Sucré', 'Boisson', '', '1700', '1700.00', '60000.00', '2500.00', -13, 14, '66894b506a1a3.jpg', '2024-07-06 15:49:04'),
(48, 'Bella', 'Alcool', 'Boisson', '', '1500', '1500.00', '48000.00', '2000.00', 4, 0, '66894bfe3897d.jpg', '2024-07-06 15:51:58'),
(49, 'Villa grand', 'Alcool', 'Boisson', '', '6500', '6500.00', '90000.00', '7500.00', -8, 8, '66894ccee601a.jpg', '2024-07-06 15:55:26'),
(50, 'Villa Petit', 'Alcool', 'Boisson', '', '46000', '2000.00', '60000.00', '2500.00', 2, 0, '66894d926619d.jpg', '2024-07-06 15:58:42'),
(51, 'Londowis', 'Alcool', 'Boisson', '', '900', '900.00', '15600.00', '1300.00', -18, 9, '66894e558a55c.jpg', '2024-07-06 16:01:57'),
(52, 'Dopel', 'Alcool', 'Boisson', 'Bière', '40000', '1700.00', '60000.00', '2500.00', 20, 0, '6689865697bed.jpg', '2024-07-06 20:00:54'),
(54, 'Reserve 7', 'Alcool', 'Boisson', 'whisky petite bouteille', '6000', '6000.00', '168000.00', '7000.00', 4, 0, '6689891cdc212.jpg', '2024-07-06 20:12:44'),
(55, 'Mokonzi', 'Alcool', 'Boisson', '', '1800', '1800.00', '48000.00', '2000.00', -1, 0, '66898a0942feb.jpg', '2024-07-06 20:16:41'),
(56, 'Kolo mboka', 'Alcool', 'Boisson', '', '15500', '1300.00', '18000.00', '1500.00', 0, 0, '66898b1a6a5b2.jpg', '2024-07-06 20:21:14'),
(57, 'Boss', 'Alcool', 'Boisson', '', '1800', '1800.00', '55200.00', '2300.00', 0, 0, '66898c210e026.jpg', '2024-07-06 20:25:37'),
(58, 'Splendeur', 'Alcool', 'Boisson', '', '1800', '1800.00', '55200.00', '2300.00', -2, 0, '66898cdeb54ee.jpg', '2024-07-06 20:28:46'),
(59, 'Pastis', 'Alcool', 'Boisson', '', '1800', '1800.00', '55200.00', '2300.00', 11, 0, '66898d65ae95d.jpg', '2024-07-06 20:31:01'),
(60, 'Reserve 7 GR', 'Alcool', 'Boisson', '', '52000', '13000.00', '56000.00', '14000.00', 4, 4, '66a40545354f6.jpg', '2024-07-06 20:33:48'),
(61, 'Monarch', 'Alcool', 'Boisson', '', '4200', '6000.00', '120000.00', '5000.00', -2, 4, '66898f298495b.jpg', '2024-07-06 20:38:33'),
(62, 'Savana', 'Alcool', 'Boisson', '', '3200', '3200.00', '96000.00', '4000.00', 9, 0, '66898ffc077d1.jpg', '2024-07-06 20:42:04'),
(63, 'Lulu gr rouge', 'Jus', 'Boisson', '', '3000', '3000.00', '42000.00', '3500.00', -9, 10, '668990de6303f.jpg', '2024-07-06 20:45:50'),
(64, 'Lulu gr vert', 'Jus', 'Boisson', '', '3000', '3000.00', '42000.00', '3500.00', -8, 6, '6689914e2a360.jpg', '2024-07-06 20:47:42'),
(65, 'Lulu pt vert', 'Jus', 'Boisson', '', '700', '700.00', '24000.00', '1000.00', 6, 0, '668992057a896.jpg', '2024-07-06 20:50:45'),
(66, 'Lulu pt rouge', 'Jus', 'Boisson', '', '700', '700.00', '24000.00', '1000.00', -2, 7, '66899283de601.jpg', '2024-07-06 20:52:51'),
(67, 'Festa rouge', 'Jus', 'Boisson', '', '2400', '600.00', '8400.00', '700.00', -37, 42, '6689936d655aa.jpg', '2024-07-06 20:56:45'),
(68, 'Biscuit mariamar', 'biscuit', 'Boisson', '', '1500', '750.00', '24000.00', '1000.00', 40, 0, '668994e464e5c.jpg', '2024-07-06 21:03:00'),
(69, 'U-FRESH', 'Jus', 'Boisson', '', '58000', '440.00', '8400.00', '700.00', 63, 132, '668f191bf263a.jpg', '2024-07-06 21:05:37'),
(70, 'Zesta cola', 'Jus', 'Boisson', '', '1600', '800.00', '12000.00', '1000.00', 21, 36, '668996ce708da.jpg', '2024-07-06 21:11:10'),
(71, 'Zesta orange', 'Jus', 'Boisson', '', '800', '800.00', '12000.00', '1000.00', 16, 24, '6689975497f07.jpg', '2024-07-06 21:13:24'),
(72, 'Zesta marakuja', 'Jus', 'Boisson', '', '8500', '800.00', '12000.00', '1000.00', 100, 120, '668997e7ab82e.jpg', '2024-07-06 21:15:51'),
(73, 'zesta mangue', 'Jus', 'Boisson', '', '8500', '800.00', '12000.00', '1000.00', -82, 26, '66899896eca59.jpg', '2024-07-06 21:18:46'),
(74, 'zesta ananas', 'Jus', 'Boisson', '', '8500', '800.00', '12000.00', '1000.00', -125, 24, '66cdf741dc768.jpg', '2024-07-06 21:21:54'),
(75, 'Zesta banane', 'Jus', 'Boisson', '', '1400', '700.00', '12000.00', '1000.00', -22, 24, '66899bf8ec3b4.jpg', '2024-07-06 21:33:12'),
(76, 'swista inv', 'Eau', 'Boisson', '', '55000', '460.00', '84000.00', '700.00', 113, 0, '66899d05c9c5d.jpg', '2024-07-06 21:37:41'),
(77, 'Festa vert', 'Jus', 'Boisson', '', '600', '600.00', '8400.00', '700.00', -9, 2, '66899d954ca01.jpg', '2024-07-06 21:40:05'),
(78, 'Vain amour', 'Alcool', 'Boisson', '', '14500', '1300.00', '18000.00', '1500.00', -2, 0, '66899e5ca12e2.jpg', '2024-07-06 21:43:24'),
(79, 'Festa ananas grd', 'Jus', 'Boisson', '', '750', '750.00', '12000.00', '1000.00', 34, 36, '66899fc11e753.jpg', '2024-07-06 21:49:21'),
(80, 'Festa orange grd', 'Jus', 'Boisson', '', '750', '750.00', '12000.00', '1000.00', -9, 5, '6689a0220ceec.jpg', '2024-07-06 21:50:58'),
(81, 'Festa noir grd', 'Jus', 'Boisson', '', '750', '750.00', '12000.00', '1000.00', -2, 2, '6689a08d6bf44.jpg', '2024-07-06 21:52:45'),
(82, 'Festa noir ', 'Jus', 'Boisson', '', '700', '600.00', '8400.00', '700.00', -33, 12, '6689a1303cd57.jpg', '2024-07-06 21:55:28'),
(83, 'Eau pure', 'eau', 'Boisson', '', '60', '30.00', '3500.00', '100.00', -105, 35, '6689af28335e2.jpg', '2024-07-06 22:55:04'),
(84, 'Pepsi', 'Sucré', 'Boisson', '', '1900', '1900.00', '67200.00', '2800.00', 1, 0, '6689b87535c91.jpg', '2024-07-06 23:34:45'),
(85, 'ORANGINA', 'Jus', 'Boisson', '', '10000', '900.00', '12000.00', '1000.00', 72, 120, '668dc7b188563.jpg', '2024-07-07 00:07:48'),
(86, 'zesta rouge', 'Jus', 'Boisson', '', '8500', '800.00', '12000.00', '1000.00', -53, 12, '668a9c5088993.jpg', '2024-07-07 15:46:56'),
(87, 'Festa cola gr', 'Jus', 'Boisson', '', '750', '750.00', '12000.00', '1000.00', -2, 4, '668aa6198f457.jpg', '2024-07-07 16:28:41'),
(88, 'Festa tangawizi', 'Jus', 'Boisson', '', '1200', '600.00', '12000.00', '1000.00', -20, 24, '6692b050859eb.jpg', '2024-07-09 00:26:43'),
(89, 'Festa orange', 'Jus', 'Boisson', '', '1200', '600.00', '8400.00', '700.00', -23, 24, '668f0f925cc28.jpg', '2024-07-11 00:47:46'),
(90, 'Cuca bouteille inv', 'Alcool', 'Boisson', '', '1500', '1500.00', '48000.00', '2000.00', 24, 0, '668f182bc0fd2.jpg', '2024-07-11 01:24:27'),
(91, 'Coca plasique', 'Sucré', 'Boisson', '', '10000', '900.00', '12000.00', '1000.00', -10, 24, '6692aef2e1c6a.jpg', '2024-07-13 18:44:34'),
(92, 'Fanta plasique', 'Sucré', 'Boisson', '', '10800', '900.00', '12000.00', '1000.00', 92, 120, '6692af2c5cfc5.jpg', '2024-07-13 18:45:32'),
(93, 'EXO', 'Alcool', 'Boisson', '', '72000', '3000.00', '84000.00', '3500.00', 24, 0, '669eb30be6ac5.jpg', '2024-07-22 20:29:15'),
(94, 'Shaka inv', 'Alcool', 'Boisson', '', '68000', '2900.00', '84000.00', '3500.00', 24, 0, '669eb3848b18d.jpg', '2024-07-22 20:31:16'),
(95, 'POWER ROUGE', 'Jus', 'Boisson', '', '43200', '2400.00', '27000.00', '3000.00', 0, 0, '66a404e55c0ad.jpg', '2024-07-25 21:54:46'),
(96, 'POWER JAUNE', 'Jus', 'Boisson', '', '16000', '1400.00', '19200.00', '1600.00', 6, 0, '66a404b4a86ee.jpg', '2024-07-25 21:58:02'),
(97, 'Pepsi plastique inv', 'Sucré', 'Boisson', '', '190000', '900.00', '228000.00', '1000.00', 194, 0, '66a403fccbcd5.jpg', '2024-07-26 21:15:56'),
(98, 'Mirinda plastique inv', 'Sucré', 'Boisson', '', '120000', '900.00', '144000.00', '1000.00', 134, 0, '66a40431dec6e.jpg', '2024-07-26 21:16:49'),
(99, 'Angel', 'Alcool', 'Boisson', '', '26400', '1100.00', '36000.00', '1500.00', 19, 20, '66b0ca8b748e0.jpg', '2024-08-05 13:50:19'),
(100, 'Zesta mangue ', 'Jus', 'Boisson', '', '75240', '570.00', '12000.00', '1000.00', 114, 132, '66cdf8308cd0a.jpg', '2024-08-26 20:39:07'),
(101, 'Zesta energy', 'Jus', 'Boisson', '', '77880', '590.00', '12000.00', '1000.00', 87, 132, '66cdf1602b5a8.jpg', '2024-08-26 20:54:43'),
(102, '7up plastique inv', 'Jus', 'Boisson', '', '70000', '900.00', '84000.00', '1000.00', 77, 0, '66cdf86334bd7.jpg', '2024-08-26 21:02:19'),
(103, 'Guerrifier', 'Alcool', 'Boisson', '', '110000', '11000.00', '15000.00', '1500.00', 6, 10, '66cdf1152724e.jpg', '2024-08-27 16:30:29'),
(104, 'Festa ananas', 'Jus', 'Boisson', '', '6996', '583.00', '8400.00', '700.00', 11, 12, '66cedfbc68b35.jpg', '2024-08-28 09:28:44'),
(105, 'American inv', 'Eau', 'Boisson', '', '54120', '410.00', '66000.00', '500.00', 87, 0, '6708057c7445d.jpg', '2024-10-10 17:49:00'),
(106, 'Blue band sachet gr', '-', 'Boisson', '', '5800', '580.00', '7000.00', '700.00', 10, 10, '673c8a91b3fcb.jpg', '2024-11-19 13:54:41'),
(107, 'Blue band petit  sachet', '-', 'Boisson', '', '2800', '280.00', '4000.00', '400.00', 10, 10, '673c8dceb5558.jpg', '2024-11-19 14:08:30'),
(108, 'Belvie', 'boisson', 'Boisson', '', '540', '54.00', '7000.00', '700.00', 10, 10, '673c8ecec821e.jpg', '2024-11-19 14:12:46'),
(109, 'Biscuit bistella', 'biscuit', 'Boisson', '', '29040', '1210.00', '36000.00', '1500.00', 24, 24, '673c8f9fb099d.jpg', '2024-11-19 14:16:15'),
(110, 'Biscuit choco', 'biscuit', 'Boisson', '', '13440', '560.00', '19200.00', '800.00', 24, 24, '673c906b2dd82.jpg', '2024-11-19 14:19:39'),
(111, 'Biscuit limousine', 'biscuit', 'Boisson', '', '13440', '560.00', '19200.00', '800.00', 24, 24, '673c923883f2e.jpg', '2024-11-19 14:27:20'),
(112, 'Biscuit Africa choice', 'biscuit', 'Boisson', '', '16320', '170.00', '28800.00', '300.00', 96, 96, '673c93d300eb4.jpg', '2024-11-19 14:34:11'),
(113, 'Blue band', '-', 'Boisson', '', '25000', '2500.00', '30000.00', '3000.00', 10, 10, '673c944742804.jpg', '2024-11-19 14:36:07'),
(114, 'Biscuit petit beure', 'biscuit', 'Boisson', '', '7200', '120.00', '12000.00', '200.00', 60, 60, '673c96e07a05c.jpg', '2024-11-19 14:47:12'),
(115, 'Biscuit prince', 'biscuit', 'Boisson', '', '7680', '160.00', '14400.00', '300.00', 48, 48, '673c978cc81f5.jpg', '2024-11-19 14:50:04'),
(116, 'Lait mix well', 'lait', 'Boisson', '', '1800', '180.00', '3000.00', '300.00', 10, 10, '673c980a5027c.jpg', '2024-11-19 14:52:10'),
(117, 'Lait nido', 'lait', 'Boisson', '', '2800', '280.00', '5000.00', '500.00', 10, 10, '673c986812d8e.jpg', '2024-11-19 14:53:44'),
(118, 'Café chica', 'Café', 'Boisson', '', '1400', '140.00', '2000.00', '200.00', 10, 10, '673c98f50852b.jpg', '2024-11-19 14:56:05'),
(119, 'Café carioca', 'Café', 'Boisson', '', '3400', '340.00', '5000.00', '500.00', 10, 10, '673c995b3ae49.jpg', '2024-11-19 14:57:47'),
(120, 'Spaghetti gloria pt  ', 'spaghetti', 'Boisson', '', '2640', '110.00', '28800.00', '1200.00', 24, 24, '673c9aed2ef0c.jpg', '2024-11-19 15:04:29'),
(121, 'Spaghetti gloria gr', 'spaghetti', 'Boisson', '', '27600', '1150.00', '36000.00', '1500.00', 24, 24, '673c9bea7f42c.jpg', '2024-11-19 15:08:42'),
(122, 'Colgate', '-', 'Boisson', '', '18720', '1560.00', '21600.00', '1800.00', 12, 12, '673c9e36ec277.jpg', '2024-11-19 15:18:30'),
(123, 'Colgate gra,nd', '-', 'Boisson', '', '26760', '2230.00', '36000.00', '3000.00', 12, 12, '673c9ea8e4530.jpg', '2024-11-19 15:20:24'),
(124, 'Maxam', '-', 'Boisson', '', '10800', '900.00', '12000.00', '1000.00', 12, 12, '673ca0ea50796.jpg', '2024-11-19 15:30:02'),
(125, 'Maxam', '-', 'Boisson', '', '10800', '900.00', '12000.00', '1000.00', 12, 12, '673ca154e569d.jpg', '2024-11-19 15:31:48'),
(126, 'Savon le coq', 'Savon', 'Boisson', '', '25200', '700.00', '28800.00', '800.00', 36, 36, '673ca2df81bd5.jpg', '2024-11-19 15:38:23'),
(127, 'Savon  derma ', 'Savon', 'Boisson', '', '30240', '420.00', '43200.00', '600.00', 72, 72, '673ca38fe0964.jpg', '2024-11-19 15:41:19'),
(128, 'Savon  munganga', 'Savon', 'Boisson', '', '30000', '500.00', '43200.00', '600.00', 60, 60, '673ca407e3c3e.jpg', '2024-11-19 15:43:19'),
(129, 'Bombom white rose', 'bombom', 'Boisson', '', '4200', '42.00', '10000.00', '100.00', 100, 100, '673ca4bc57c05.jpg', '2024-11-19 15:46:20'),
(130, 'Jojo Africlass                                    ', 'jojo', 'Boisson', '', '5500', '55.00', '10000.00', '100.00', 100, 100, '673ca55feebaa.jpg', '2024-11-19 15:49:03'),
(131, 'Sardine Anny                                      ', 'Sardine', 'Boisson', '', '112000', '2240.00', '14000.00', '2800.00', 50, 50, '673ca689ab312.jpg', '2024-11-19 15:54:01'),
(132, 'Sardine apolo                                     ', 'Sardine', 'Boisson', '', '18000', '1800.00', '22000.00', '2200.00', 10, 10, '673ca6e477324.jpg', '2024-11-19 15:55:32'),
(133, 'Sardine bon appétit                               ', 'Sardine', 'Boisson', '', '17000', '1700.00', '20000.00', '2000.00', 10, 10, '673ca737cfdc8.jpg', '2024-11-19 15:56:55'),
(134, 'Sardine bon appétit                               ', 'Sardine', 'Boisson', '', '17000', '1700.00', '20000.00', '2000.00', 10, 10, '673ca81b5d3a2.jpg', '2024-11-19 16:00:43'),
(135, 'Sardine bella                                     ', 'Sardine', 'Boisson', '', '17000', '1700.00', '20000.00', '2000.00', 10, 10, '673ca86f26c28.jpg', '2024-11-19 16:02:07'),
(136, 'Biscuit princess                                  ', 'biscuit', 'Boisson', '', '11400', '190.00', '18000.00', '300.00', 60, 60, '673ca8f90a796.jpg', '2024-11-19 16:04:25'),
(137, 'Savon génie                                       ', 'Savon', 'Boisson', '', '22320', '620.00', '25200.00', '700.00', 36, 36, '673cab9ca9a23.jpg', '2024-11-19 16:15:40'),
(138, 'Savon cinthol                                     ', 'Savon ', 'Boisson', '', '19200', '1600.00', '24000.00', '2000.00', 12, 36, '673cac8ec4ea4.jpg', '2024-11-19 16:19:42'),
(139, 'Biscuit bistella petit                            ', 'biscuit', 'Boisson', '', '11040', '460.00', '14400.00', '600.00', 24, 24, '673cae1d00814.jpg', '2024-11-19 16:26:21'),
(140, 'Biscuit Malt n&#039; milk                         ', 'biscuit', 'Boisson', '', '12000', '40.00', '30000.00', '100.00', 300, 300, '673cb07d99f0e.jpg', '2024-11-19 16:36:29'),
(141, 'Indica pt                                         ', 'Alcool', 'Boisson', '', '25200', '1050.00', '28800.00', '1200.00', 24, 24, '673cb1da7a5a4.jpg', '2024-11-19 16:42:18'),
(142, 'Indica gr                                         ', 'Alcool', 'Boisson', '', '27600', '2300.00', '36000.00', '3000.00', 12, 12, '673cb290c6f39.jpg', '2024-11-19 16:45:20'),
(143, 'High club                                         ', 'Alcool', 'Boisson', '', '50000', '5000.00', '60000.00', '6000.00', 10, 10, '673cb389190ed.jpg', '2024-11-19 16:49:29'),
(144, 'Tangawizi wisky                                   ', 'Alcool', 'Boisson', '', '43200', '1800.00', '55200.00', '2300.00', 24, 24, '673cb441dc535.jpg', '2024-11-19 16:52:33'),
(145, 'Montana                                           ', 'Alcool', 'Boisson', '', '13500', '1500.00', '18000.00', '2000.00', 9, 9, '673cb588ae2c4.jpg', '2024-11-19 16:58:00'),
(146, 'Boss en verre                                     ', 'Alcool', 'Boisson', '', '42000', '3500.00', '48000.00', '4000.00', 12, 12, '673cb73d076c4.jpg', '2024-11-19 17:05:17');

-- --------------------------------------------------------

--
-- Structure de la table `recup_mdp`
--

CREATE TABLE `recup_mdp` (
  `id` int(11) NOT NULL,
  `mail` text NOT NULL,
  `code` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `temoignage_client`
--

CREATE TABLE `temoignage_client` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `message` text NOT NULL,
  `date_post` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `temoignage_client`
--

INSERT INTO `temoignage_client` (`id`, `id_user`, `message`, `date_post`) VALUES
(2, 130, 'Ici, c&#039;est super cool', '2024-04-17 00:27:29'),
(3, 134, 'Ici c&#039;est vraiment cool', '2024-05-25 22:50:49');

-- --------------------------------------------------------

--
-- Structure de la table `vente`
--

CREATE TABLE `vente` (
  `id` int(11) NOT NULL,
  `nom_produit` varchar(50) NOT NULL,
  `prix_achat` decimal(20,0) NOT NULL,
  `prix_vente` decimal(20,0) NOT NULL,
  `quantite` int(11) NOT NULL,
  `montant_total` int(11) NOT NULL,
  `date_vente` datetime NOT NULL,
  `vendeur` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `vente`
--

INSERT INTO `vente` (`id`, `nom_produit`, `prix_achat`, `prix_vente`, `quantite`, `montant_total`, `date_vente`, `vendeur`) VALUES
(29, 'Eau bidon', '450', '1000', 7, 7000, '2024-07-06 22:20:50', 'Russell  Mpenemoke'),
(30, 'Alpina', '96000', '800', 29, 14500, '2024-07-06 22:24:55', 'Russell  Mpenemoke'),
(31, 'Swista', '500', '700', 2, 1400, '2024-07-06 22:26:05', 'Russell  Mpenemoke'),
(32, 'Festa energy', '700', '1000', 1, 1000, '2024-07-06 22:26:57', 'Russell  Mpenemoke'),
(33, 'Festa ananas', '600', '700', 3, 2100, '2024-07-06 22:27:41', 'Russell  Mpenemoke'),
(34, 'Festa noir ', '600', '700', 2, 1400, '2024-07-06 22:28:18', 'Russell  Mpenemoke'),
(35, 'zesta ananas', '800', '1000', 1, 1000, '2024-07-06 22:29:23', 'Russell  Mpenemoke'),
(36, 'Zesta cola', '800', '1000', 2, 2000, '2024-07-06 22:30:02', 'Russell  Mpenemoke'),
(38, 'zesta mangue 1L', '1400', '2000', 1, 2000, '2024-07-06 22:32:40', 'Russell  Mpenemoke'),
(39, 'Zesta orange', '800', '1000', 2, 2000, '2024-07-06 22:33:27', 'Russell  Mpenemoke'),
(40, 'zesta mangue', '800', '1000', 1, 1000, '2024-07-06 22:35:09', 'Russell  Mpenemoke'),
(41, 'Zesta banane', '700', '1000', 2, 2000, '2024-07-06 22:36:30', 'Russell  Mpenemoke'),
(42, 'Zesta marakuja', '800', '1000', 3, 3000, '2024-07-06 22:37:45', 'Russell  Mpenemoke'),
(43, 'Fanta', '1700', '2500', 3, 7500, '2024-07-06 22:38:44', 'Russell  Mpenemoke'),
(44, 'XXL', '1500', '2000', 3, 6000, '2024-07-06 22:39:38', 'Russell  Mpenemoke'),
(45, 'Lulu pt vert', '700', '1000', 4, 4000, '2024-07-06 22:40:34', 'Russell  Mpenemoke'),
(46, 'Boss', '1800', '2300', 1, 2300, '2024-07-06 22:41:35', 'Russell  Mpenemoke'),
(47, 'Splendeur', '1800', '2300', 1, 2300, '2024-07-06 22:42:25', 'Russell  Mpenemoke'),
(48, 'Vain amour', '1250', '1700', 4, 6800, '2024-07-06 22:43:51', 'Russell  Mpenemoke'),
(49, 'Kolo mboka', '1300', '1700', 4, 6800, '2024-07-06 22:44:35', 'Russell  Mpenemoke'),
(50, 'Cuca', '1500', '2000', 1, 2000, '2024-07-06 22:46:15', 'Russell  Mpenemoke'),
(51, 'Savana', '3200', '4000', 1, 4000, '2024-07-06 22:47:28', 'Russell  Mpenemoke'),
(52, 'Dopel', '1500', '2000', 1, 2000, '2024-07-06 22:48:01', 'Russell  Mpenemoke'),
(53, 'Londowis', '900', '1300', 2, 2600, '2024-07-06 22:48:54', 'Russell  Mpenemoke'),
(57, 'Eau bidon', '450', '1000', 18, 18000, '2024-07-06 23:07:49', 'Russell  Mpenemoke'),
(58, 'Alpina', '96000', '800', 19, 9500, '2024-07-06 23:12:49', 'Russell  Mpenemoke'),
(59, 'Festa energy', '700', '1000', 4, 4000, '2024-07-06 23:14:00', 'Russell  Mpenemoke'),
(60, 'Festa ananas', '600', '700', 1, 700, '2024-07-06 23:16:05', 'Russell  Mpenemoke'),
(61, 'Festa vert', '600', '700', 2, 1400, '2024-07-06 23:16:47', 'Russell  Mpenemoke'),
(62, 'Festa noir ', '600', '700', 1, 700, '2024-07-06 23:17:19', 'Russell  Mpenemoke'),
(63, 'zesta ananas', '800', '1000', 3, 3000, '2024-07-06 23:18:01', 'Russell  Mpenemoke'),
(64, 'Zesta cola', '800', '1000', 1, 1000, '2024-07-06 23:25:01', 'Russell  Mpenemoke'),
(65, 'zesta mangue', '800', '1000', 6, 6000, '2024-07-06 23:25:47', 'Russell  Mpenemoke'),
(66, 'Zesta marakuja', '800', '1000', 5, 5000, '2024-07-06 23:26:49', 'Russell  Mpenemoke'),
(67, 'Zesta banane', '700', '1000', 1, 1000, '2024-07-06 23:27:41', 'Russell  Mpenemoke'),
(68, 'Coca', '1700', '2500', 1, 2500, '2024-07-06 23:28:47', 'Russell  Mpenemoke'),
(69, 'XXL', '1500', '2000', 3, 6000, '2024-07-06 23:29:20', 'Russell  Mpenemoke'),
(70, 'Pepsi', '1900', '2800', 2, 5600, '2024-07-06 23:36:32', 'Russell  Mpenemoke'),
(71, 'Lulu gr vert', '3000', '3500', 1, 3500, '2024-07-06 23:37:55', 'Russell  Mpenemoke'),
(72, 'Boss', '1800', '2300', 2, 4000, '2024-07-06 23:38:27', 'Russell  Mpenemoke'),
(73, 'Vain amour', '1250', '1700', 5, 8500, '2024-07-06 23:39:14', 'Russell  Mpenemoke'),
(74, 'Kolo mboka', '1300', '1700', 2, 3400, '2024-07-06 23:40:37', 'Russell  Mpenemoke'),
(75, 'Biscuit mariamar', '750', '1000', 2, 2000, '2024-07-06 23:42:35', 'Russell  Mpenemoke'),
(76, 'Dopel', '1500', '2000', 1, 2000, '2024-07-06 23:44:11', 'Russell  Mpenemoke'),
(77, 'Monarch', '4200', '5000', 1, 5000, '2024-07-06 23:44:49', 'Russell  Mpenemoke'),
(78, 'Eau bidon', '450', '1000', 14, 14000, '2024-07-06 23:51:58', 'Russell  Mpenemoke'),
(79, 'Alpina', '96000', '800', 18, 9000, '2024-07-06 23:52:30', 'Russell  Mpenemoke'),
(80, 'Eau pure', '30', '100', 7, 700, '2024-07-06 23:53:23', 'Russell  Mpenemoke'),
(81, 'Festa energy', '700', '1000', 5, 5000, '2024-07-06 23:54:12', 'Russell  Mpenemoke'),
(82, 'Festa ananas', '600', '700', 2, 1400, '2024-07-06 23:55:09', 'Russell  Mpenemoke'),
(83, 'Festa rouge', '600', '700', 1, 700, '2024-07-06 23:56:04', 'Russell  Mpenemoke'),
(84, 'Festa noir ', '600', '700', 6, 4200, '2024-07-06 23:56:47', 'Russell  Mpenemoke'),
(85, 'Coca', '1700', '2500', 1, 2500, '2024-07-06 23:57:47', 'Russell  Mpenemoke'),
(86, 'Sprite', '1700', '2500', 1, 2500, '2024-07-06 23:58:35', 'Russell  Mpenemoke'),
(88, 'Vain amour', '1250', '1700', 6, 10200, '2024-07-06 23:59:48', 'Russell  Mpenemoke'),
(89, 'Kolo mboka', '1300', '1700', 9, 15300, '2024-07-07 00:00:40', 'Russell  Mpenemoke'),
(90, 'Pastis', '1800', '2300', 2, 4600, '2024-07-07 00:02:09', 'Russell  Mpenemoke'),
(91, 'Dopel', '1500', '2000', 2, 4000, '2024-07-07 00:02:33', 'Russell  Mpenemoke'),
(92, 'Monarch', '4200', '5000', 1, 5000, '2024-07-07 00:03:09', 'Russell  Mpenemoke'),
(93, 'Londowis', '900', '1300', 1, 1300, '2024-07-07 00:03:36', 'Russell  Mpenemoke'),
(94, 'Zesta marakuja', '800', '1000', 2, 2000, '2024-07-07 00:04:35', 'Russell  Mpenemoke'),
(95, 'Mokonzi', '1800', '2300', 1, 2300, '2024-07-07 00:05:13', 'Russell  Mpenemoke'),
(96, 'orangina', '900', '1000', 1, 1000, '2024-07-07 00:09:26', 'Russell  Mpenemoke'),
(97, 'Festa orange grd', '750', '1000', 1, 1000, '2024-07-07 00:11:07', 'Russell  Mpenemoke'),
(98, 'XXL', '1500', '2000', 1, 2000, '2024-07-07 15:31:59', 'Russell  Mpenemoke'),
(99, 'Eau bidon', '450', '1000', 8, 8000, '2024-07-07 15:38:02', 'Russell  Mpenemoke'),
(100, 'Alpina', '96000', '800', 19, 9500, '2024-07-07 15:38:52', 'Russell  Mpenemoke'),
(101, 'Festa energy', '700', '1000', 6, 6000, '2024-07-07 15:39:30', 'Russell  Mpenemoke'),
(102, 'Festa ananas', '600', '700', 1, 700, '2024-07-07 15:40:05', 'Russell  Mpenemoke'),
(103, 'Festa rouge', '600', '700', 1, 700, '2024-07-07 15:40:26', 'Russell  Mpenemoke'),
(104, 'Festa noir ', '600', '700', 2, 1400, '2024-07-07 15:40:56', 'Russell  Mpenemoke'),
(105, 'zesta ananas', '800', '1000', 3, 3000, '2024-07-07 15:41:53', 'Russell  Mpenemoke'),
(106, 'zesta rouge', '800', '1000', 1, 1000, '2024-07-07 15:50:07', 'Russell  Mpenemoke'),
(107, 'Zesta cola', '800', '1000', 5, 5000, '2024-07-07 15:50:51', 'Russell  Mpenemoke'),
(108, 'zesta mangue', '800', '1000', 4, 4000, '2024-07-07 15:52:08', 'Russell  Mpenemoke'),
(109, 'Zesta orange', '800', '1000', 1, 1000, '2024-07-07 15:53:11', 'Russell  Mpenemoke'),
(110, 'Zesta banane', '700', '1000', 1, 1000, '2024-07-07 15:53:36', 'Russell  Mpenemoke'),
(111, 'Coca', '1700', '2500', 1, 2500, '2024-07-07 15:53:56', 'Russell  Mpenemoke'),
(112, 'XXL', '1500', '2000', 5, 10000, '2024-07-07 15:54:25', 'Russell  Mpenemoke'),
(113, 'Pepsi', '1900', '2800', 1, 2800, '2024-07-07 15:55:26', 'Russell  Mpenemoke'),
(114, 'Villa grand', '6500', '7500', 1, 7500, '2024-07-07 15:56:35', 'Russell  Mpenemoke'),
(115, 'Villa Petit', '2100', '2500', 1, 2500, '2024-07-07 15:57:34', 'Russell  Mpenemoke'),
(116, 'Vain amour', '1250', '1700', 3, 5100, '2024-07-07 15:58:17', 'Russell  Mpenemoke'),
(117, 'Kolo mboka', '1300', '1700', 6, 10200, '2024-07-07 15:58:51', 'Russell  Mpenemoke'),
(118, 'Dopel', '1500', '2000', 1, 2000, '2024-07-07 15:59:42', 'Russell  Mpenemoke'),
(119, 'Londowis', '900', '1300', 1, 1300, '2024-07-07 16:00:21', 'Russell  Mpenemoke'),
(120, 'Biscuit mariamar', '750', '1000', 1, 1000, '2024-07-07 16:00:46', 'Russell  Mpenemoke'),
(121, 'Festa orange grd', '750', '1000', 1, 1000, '2024-07-07 16:01:42', 'Russell  Mpenemoke'),
(122, 'Zesta marakuja', '800', '1000', 2, 2000, '2024-07-07 16:02:12', 'Russell  Mpenemoke'),
(123, 'Eau bidon', '450', '1000', 7, 7000, '2024-07-07 16:08:55', 'Russell  Mpenemoke'),
(124, 'Alpina', '96000', '800', 8, 4000, '2024-07-07 16:10:08', 'Russell  Mpenemoke'),
(125, 'Swista', '500', '700', 1, 700, '2024-07-07 16:10:37', 'Russell  Mpenemoke'),
(126, 'Eau pure', '30', '100', 16, 1600, '2024-07-07 16:11:07', 'Russell  Mpenemoke'),
(127, 'Festa energy', '700', '1000', 6, 6000, '2024-07-07 16:12:07', 'Russell  Mpenemoke'),
(128, 'Festa ananas', '600', '700', 1, 700, '2024-07-07 16:12:49', 'Russell  Mpenemoke'),
(129, 'Festa rouge', '600', '700', 2, 1400, '2024-07-07 16:13:43', 'Russell  Mpenemoke'),
(130, 'Festa noir ', '600', '700', 2, 1400, '2024-07-07 16:14:28', 'Russell  Mpenemoke'),
(131, 'Zesta ananas ', '800', '1000', 3, 3000, '2024-07-07 16:15:30', 'Russell  Mpenemoke'),
(132, 'Zesta cola', '800', '1000', 1, 1000, '2024-07-07 16:17:10', 'Russell  Mpenemoke'),
(133, 'zesta mangue', '800', '1000', 1, 1000, '2024-07-07 16:17:46', 'Russell  Mpenemoke'),
(134, 'Zesta marakuja', '800', '1000', 4, 4000, '2024-07-07 16:18:32', 'Russell  Mpenemoke'),
(135, 'Coca', '1700', '2500', 1, 2500, '2024-07-07 16:19:13', 'Russell  Mpenemoke'),
(136, 'XXL', '1500', '2000', 1, 2000, '2024-07-07 16:19:48', 'Russell  Mpenemoke'),
(137, 'Pepsi', '1900', '2800', 3, 6000, '2024-07-07 16:20:29', 'Russell  Mpenemoke'),
(138, 'Boss', '1800', '2300', 2, 4600, '2024-07-07 16:21:08', 'Russell  Mpenemoke'),
(139, 'Vain amour', '1250', '1700', 2, 3400, '2024-07-07 16:22:28', 'Russell  Mpenemoke'),
(140, 'Kolo mboka', '1300', '1700', 6, 10200, '2024-07-07 16:22:54', 'Russell  Mpenemoke'),
(141, 'Dopel', '1500', '2000', 1, 2000, '2024-07-07 16:23:19', 'Russell  Mpenemoke'),
(142, 'Reserve 7', '6000', '7000', 1, 7000, '2024-07-07 16:23:47', 'Russell  Mpenemoke'),
(143, 'Londowis', '900', '1300', 2, 2600, '2024-07-07 16:24:25', 'Russell  Mpenemoke'),
(144, 'Angel', '1000', '18000', 1, 1500, '2024-07-07 16:24:57', 'Russell  Mpenemoke'),
(145, 'Festa cola gr', '750', '1000', 1, 1000, '2024-07-07 16:30:25', 'Russell  Mpenemoke'),
(146, 'Eau bidon', '300', '1000', 13, 13000, '2024-07-08 00:50:15', 'Hils Imidi'),
(147, 'Alpina', '500', '500', 26, 13000, '2024-07-08 00:50:45', 'Hils Imidi'),
(148, 'Swista', '500', '700', 4, 2800, '2024-07-08 00:51:17', 'Hils Imidi'),
(149, 'Festa energy', '700', '1000', 5, 5000, '2024-07-08 00:51:49', 'Hils Imidi'),
(150, 'Festa ananas', '600', '700', 2, 1400, '2024-07-08 00:52:20', 'Hils Imidi'),
(151, 'Festa noir ', '600', '700', 2, 1400, '2024-07-08 00:52:51', 'Hils Imidi'),
(152, 'Festa orange grd', '750', '1000', 1, 1000, '2024-07-08 00:53:23', 'Hils Imidi'),
(153, 'zesta ananas', '800', '1000', 4, 4000, '2024-07-08 00:53:58', 'Hils Imidi'),
(154, 'zesta rouge', '800', '1000', 1, 1000, '2024-07-08 00:54:38', 'Hils Imidi'),
(155, 'Zesta cola', '800', '1000', 5, 5000, '2024-07-08 00:55:07', 'Hils Imidi'),
(156, 'zesta mangue', '800', '1000', 7, 7000, '2024-07-08 00:55:49', 'Hils Imidi'),
(157, 'Zesta marakuja', '800', '1000', 5, 5000, '2024-07-08 00:56:15', 'Hils Imidi'),
(158, 'Zesta banane', '700', '1000', 5, 5000, '2024-07-08 00:56:47', 'Hils Imidi'),
(159, 'XXL', '1500', '2000', 4, 8000, '2024-07-08 00:57:19', 'Hils Imidi'),
(160, 'Lulu gr vert', '3000', '3500', 1, 3500, '2024-07-08 00:58:00', 'Hils Imidi'),
(161, 'Lulu pt vert', '700', '1000', 2, 2000, '2024-07-08 00:58:49', 'Hils Imidi'),
(162, 'Boss', '1800', '2300', 1, 2300, '2024-07-08 00:59:25', 'Hils Imidi'),
(163, 'Vain amour', '1250', '1700', 2, 3400, '2024-07-08 01:00:29', 'Hils Imidi'),
(164, 'Kolo mboka', '1300', '1700', 3, 4500, '2024-07-08 01:01:21', 'Hils Imidi'),
(165, 'Kolo mboka', '1300', '1700', 4, 6800, '2024-07-08 01:01:50', 'Hils Imidi'),
(166, 'Bavaria petit', '2100', '3000', 2, 6000, '2024-07-08 01:02:27', 'Hils Imidi'),
(167, 'Biscuit mariamar', '750', '1000', 1, 1000, '2024-07-08 01:03:27', 'Hils Imidi'),
(168, 'Festa noir grd', '750', '1000', 1, 1000, '2024-07-08 01:04:03', 'Hils Imidi'),
(169, 'zesta mangue 1L', '1400', '2000', 1, 2000, '2024-07-08 01:04:42', 'Hils Imidi'),
(170, 'Mokonzi', '1800', '2300', 1, 2000, '2024-07-08 01:05:04', 'Hils Imidi'),
(171, 'orangina', '900', '1000', 3, 3000, '2024-07-08 01:05:30', 'Hils Imidi'),
(172, 'Savana', '3200', '4000', 1, 4000, '2024-07-08 01:05:53', 'Hils Imidi'),
(173, 'Eau bidon', '300', '1000', 14, 14000, '2024-07-09 00:18:03', 'Hils Imidi'),
(174, 'Alpina', '500', '500', 16, 8000, '2024-07-09 00:18:25', 'Hils Imidi'),
(175, 'Swista', '500', '700', 2, 1400, '2024-07-09 00:19:52', 'Hils Imidi'),
(176, 'Festa energy', '700', '1000', 11, 11000, '2024-07-09 00:20:17', 'Hils Imidi'),
(177, 'Festa ananas', '600', '700', 3, 2100, '2024-07-09 00:20:50', 'Hils Imidi'),
(178, 'Festa rouge', '600', '700', 4, 2800, '2024-07-09 00:21:18', 'Hils Imidi'),
(179, 'Festa noir ', '600', '700', 1, 700, '2024-07-09 00:21:35', 'Hils Imidi'),
(180, 'orangina', '900', '1000', 3, 3000, '2024-07-09 00:22:03', 'Hils Imidi'),
(181, 'zesta ananas', '800', '1000', 5, 5000, '2024-07-09 00:22:30', 'Hils Imidi'),
(182, 'zesta rouge', '800', '1000', 1, 1000, '2024-07-09 00:22:50', 'Hils Imidi'),
(183, 'zesta mangue', '800', '1000', 5, 5000, '2024-07-09 00:23:33', 'Hils Imidi'),
(184, 'Zesta banane', '700', '1000', 1, 1000, '2024-07-09 00:24:00', 'Hils Imidi'),
(185, 'XXL', '1500', '2000', 1, 2000, '2024-07-09 00:24:21', 'Hils Imidi'),
(186, 'Zesta marakuja', '800', '1000', 7, 7000, '2024-07-09 00:25:24', 'Hils Imidi'),
(187, 'Festa tangawizi', '600', '1000', 5, 3500, '2024-07-09 00:27:38', 'Hils Imidi'),
(188, 'Lulu gr vert', '3000', '3500', 2, 7000, '2024-07-09 00:28:09', 'Hils Imidi'),
(189, 'Lulu gr vert', '3000', '3500', 1, 3500, '2024-07-09 00:28:35', 'Hils Imidi'),
(190, 'Lulu pt vert', '700', '1000', 1, 1000, '2024-07-09 00:29:11', 'Hils Imidi'),
(191, 'Boss', '1800', '2300', 1, 2300, '2024-07-09 00:29:57', 'Hils Imidi'),
(192, 'Splendeur', '1800', '2300', 1, 2300, '2024-07-09 00:30:25', 'Hils Imidi'),
(193, 'Kolo mboka', '1300', '1700', 2, 3400, '2024-07-09 00:31:18', 'Hils Imidi'),
(194, 'Alpina', '500', '500', 1, 500, '2024-07-09 00:31:38', 'Hils Imidi'),
(195, 'Cuca', '1500', '2000', 10, 20000, '2024-07-09 00:36:48', 'Hils Imidi'),
(196, 'Cuca', '1500', '2000', 2, 4000, '2024-07-09 00:37:11', 'Hils Imidi'),
(197, 'Mokonzi', '1800', '2300', 2, 4600, '2024-07-09 00:37:38', 'Hils Imidi'),
(198, 'Biscuit mariamar', '750', '1000', 2, 2000, '2024-07-09 00:38:01', 'Hils Imidi'),
(199, 'Londowis', '900', '1300', 1, 1300, '2024-07-09 00:41:57', 'Hils Imidi'),
(200, 'Eau bidon', '200', '1000', 13, 13000, '2024-07-10 00:54:26', 'Hils Imidi'),
(202, 'Alpina', '500', '500', 18, 9000, '2024-07-10 00:56:03', 'Hils Imidi'),
(203, 'Eau pure', '30', '100', 7, 700, '2024-07-10 00:56:20', 'Hils Imidi'),
(204, 'Festa energy', '700', '1000', 12, 12000, '2024-07-10 00:56:58', 'Hils Imidi'),
(205, 'Festa ananas', '600', '700', 4, 2800, '2024-07-10 00:57:32', 'Hils Imidi'),
(206, 'Festa vert', '600', '700', 1, 700, '2024-07-10 00:57:58', 'Hils Imidi'),
(207, 'Festa rouge', '600', '700', 3, 2100, '2024-07-10 00:58:25', 'Hils Imidi'),
(209, 'Festa noir ', '600', '700', 4, 2800, '2024-07-10 01:01:06', 'Hils Imidi'),
(210, 'Zesta marakuja', '800', '1000', 2, 2000, '2024-07-10 01:01:47', 'Hils Imidi'),
(211, 'zesta rouge', '800', '1000', 5, 5000, '2024-07-10 01:02:22', 'Hils Imidi'),
(212, 'zesta mangue', '800', '1000', 7, 7000, '2024-07-10 01:02:54', 'Hils Imidi'),
(213, 'Bavaria', '3400', '4500', 1, 4500, '2024-07-10 01:04:01', 'Hils Imidi'),
(214, 'XXL', '1500', '2000', 1, 2000, '2024-07-10 01:04:21', 'Hils Imidi'),
(215, 'Festa tangawizi', '600', '1000', 1, 1000, '2024-07-10 01:05:26', 'Hils Imidi'),
(216, 'orangina', '900', '1000', 2, 2000, '2024-07-10 01:05:58', 'Hils Imidi'),
(217, 'Bella', '1500', '2000', 1, 2300, '2024-07-10 01:06:25', 'Hils Imidi'),
(218, 'U-FRESH', '500', '700', 1, 700, '2024-07-10 01:06:44', 'Hils Imidi'),
(219, 'Lulu pt vert', '700', '1000', 1, 1000, '2024-07-10 01:07:14', 'Hils Imidi'),
(220, 'Vain amour', '1250', '1700', 7, 11900, '2024-07-10 01:07:51', 'Hils Imidi'),
(221, 'Savana', '3200', '4000', 2, 8000, '2024-07-10 01:08:43', 'Hils Imidi'),
(222, 'Londowis', '900', '1300', 1, 1300, '2024-07-10 01:09:17', 'Hils Imidi'),
(223, 'Cuca bouteille', '1500', '2000', 1, 2000, '2024-07-10 01:09:40', 'Hils Imidi'),
(224, 'Eau bidon', '200', '1000', 12, 12000, '2024-07-11 00:36:17', 'Hils Imidi'),
(225, 'Alpina', '500', '500', 13, 6500, '2024-07-11 00:37:26', 'Hils Imidi'),
(226, 'Festa energy', '700', '1000', 4, 4000, '2024-07-11 00:38:02', 'Hils Imidi'),
(227, 'Festa ananas', '600', '700', 1, 700, '2024-07-11 00:39:02', 'Hils Imidi'),
(228, 'Festa noir ', '600', '700', 1, 700, '2024-07-11 00:42:10', 'Hils Imidi'),
(229, 'Festa tangawizi', '600', '1000', 1, 1000, '2024-07-11 00:43:08', 'Hils Imidi'),
(230, 'Festa orange', '600', '700', 3, 2100, '2024-07-11 00:49:14', 'Hils Imidi'),
(231, 'zesta ananas', '800', '1000', 3, 3000, '2024-07-11 00:49:44', 'Hils Imidi'),
(232, 'zesta rouge', '800', '1000', 3, 3000, '2024-07-11 00:50:53', 'Hils Imidi'),
(235, 'Zesta cola', '800', '1000', 1, 1000, '2024-07-11 00:54:13', 'Hils Imidi'),
(236, 'Zesta orange', '800', '1000', 1, 1000, '2024-07-11 00:54:48', 'Hils Imidi'),
(237, 'Zesta mangue 1L', '1400', '2000', 1, 2000, '2024-07-11 00:55:34', 'Hils Imidi'),
(238, 'zesta mangue', '800', '1000', 2, 2000, '2024-07-11 00:56:08', 'Hils Imidi'),
(239, 'Zesta banane', '700', '1000', 1, 1000, '2024-07-11 00:56:46', 'Hils Imidi'),
(240, 'Coca', '1700', '2500', 3, 7500, '2024-07-11 00:58:21', 'Hils Imidi'),
(241, 'Fanta', '1700', '2500', 1, 2500, '2024-07-11 00:59:07', 'Hils Imidi'),
(242, 'orangina', '900', '1000', 5, 5000, '2024-07-11 00:59:40', 'Hils Imidi'),
(243, 'U-FRESH', '500', '700', 3, 2100, '2024-07-11 01:00:19', 'Hils Imidi'),
(244, 'Villa grand', '6500', '7500', 1, 7500, '2024-07-11 01:01:16', 'Hils Imidi'),
(246, 'Kolo mboka', '1300', '1700', 7, 11900, '2024-07-11 01:03:03', 'Hils Imidi'),
(247, 'Biscuit mariamar', '750', '1000', 4, 4000, '2024-07-11 01:04:59', 'Hils Imidi'),
(248, 'Savana', '3200', '4000', 1, 4000, '2024-07-11 01:07:25', 'Hils Imidi'),
(249, 'Zesta marakuja', '800', '1000', 3, 3000, '2024-07-11 01:13:28', 'Hils Imidi'),
(250, 'Eau bidon', '200', '1000', 5, 5000, '2024-07-13 16:54:25', 'Hils Imidi'),
(251, 'Alpina', '500', '500', 16, 8000, '2024-07-13 16:54:56', 'Hils Imidi'),
(252, 'Festa ananas', '600', '700', 1, 700, '2024-07-13 16:55:37', 'Hils Imidi'),
(253, 'Festa rouge', '600', '700', 1, 700, '2024-07-13 16:55:59', 'Hils Imidi'),
(255, 'Festa orange', '600', '700', 1, 700, '2024-07-13 16:56:37', 'Hils Imidi'),
(256, 'Kolo mboka', '1300', '1700', 6, 10200, '2024-07-13 16:57:05', 'Hils Imidi'),
(257, 'Festa energy', '700', '1000', 6, 6000, '2024-07-13 16:57:55', 'Hils Imidi'),
(258, 'Zesta cola', '800', '1000', 1, 1000, '2024-07-13 16:58:49', 'Hils Imidi'),
(259, 'Bella', '1500', '2000', 1, 2000, '2024-07-13 16:59:24', 'Hils Imidi'),
(260, 'zesta ananas', '800', '1000', 5, 5000, '2024-07-13 17:00:27', 'Hils Imidi'),
(261, 'Vain amour', '1250', '1700', 5, 8500, '2024-07-13 17:01:00', 'Hils Imidi'),
(262, 'Zesta orange', '800', '1000', 1, 1000, '2024-07-13 17:01:47', 'Hils Imidi'),
(263, 'Zesta banane', '700', '1000', 1, 1000, '2024-07-13 17:02:29', 'Hils Imidi'),
(264, 'zesta mangue', '800', '1000', 3, 3000, '2024-07-13 17:04:08', 'Hils Imidi'),
(265, 'zesta rouge', '800', '1000', 2, 2000, '2024-07-13 17:05:16', 'Hils Imidi'),
(266, 'U-FRESH', '500', '700', 7, 4900, '2024-07-13 17:06:30', 'Hils Imidi'),
(267, 'Lulu gr vert', '3000', '3500', 1, 3500, '2024-07-13 17:08:25', 'Hils Imidi'),
(268, 'Splendeur', '1800', '2300', 1, 2300, '2024-07-13 17:09:05', 'Hils Imidi'),
(269, 'Splendeur', '1800', '2300', 3, 6900, '2024-07-13 17:09:34', 'Hils Imidi'),
(270, 'Festa tangawizi', '600', '1000', 1, 1000, '2024-07-13 17:12:33', 'Hils Imidi'),
(271, 'Cuca ', '1500', '2000', 1, 2000, '2024-07-13 17:13:46', 'Hils Imidi'),
(272, 'Cuca bouteille', '1500', '2000', 2, 4000, '2024-07-13 17:14:11', 'Hils Imidi'),
(273, 'orangina', '900', '1000', 3, 3000, '2024-07-13 17:14:42', 'Hils Imidi'),
(274, 'Zesta marakuja', '800', '1000', 2, 2000, '2024-07-13 17:15:12', 'Hils Imidi'),
(275, 'Festa noir ', '600', '700', 2, 1400, '2024-07-13 17:18:07', 'Hils Imidi'),
(276, 'Alpina', '500', '500', 1, 500, '2024-07-13 17:21:53', 'Hils Imidi'),
(277, 'Eau bidon', '200', '1000', 4, 4000, '2024-07-13 19:05:22', 'Hils Imidi'),
(278, 'Alpina', '500', '500', 7, 3500, '2024-07-13 19:06:21', 'Hils Imidi'),
(279, 'Zesta marakuja', '800', '1000', 3, 3000, '2024-07-13 19:06:51', 'Hils Imidi'),
(280, 'Mokonzi', '1800', '2300', 1, 2300, '2024-07-13 19:07:12', 'Hils Imidi'),
(281, 'Fanta plasique', '900', '1000', 2, 2000, '2024-07-13 19:11:33', 'Hils Imidi'),
(283, 'Festa energy', '700', '1000', 1, 1000, '2024-07-13 19:13:48', 'Hils Imidi'),
(284, 'zesta ananas', '800', '1000', 1, 1000, '2024-07-13 19:17:13', 'Hils Imidi'),
(285, 'Zesta orange', '800', '1000', 1, 1000, '2024-07-13 19:19:16', 'Hils Imidi'),
(286, 'Zesta banane', '700', '1000', 1, 1000, '2024-07-13 19:21:19', 'Hils Imidi'),
(287, 'XXL', '1500', '2000', 1, 2000, '2024-07-13 19:22:28', 'Hils Imidi'),
(288, 'Pepsi', '1900', '2800', 1, 2800, '2024-07-13 19:23:06', 'Hils Imidi'),
(289, 'Lulu gr rouge', '3000', '3500', 1, 3500, '2024-07-13 19:23:58', 'Hils Imidi'),
(290, 'Lulu gr vert', '3000', '3500', 1, 3500, '2024-07-13 19:25:57', 'Hils Imidi'),
(291, 'Vain amour', '1250', '1700', 1, 1700, '2024-07-13 19:27:00', 'Hils Imidi'),
(292, 'Dopel', '1700', '2500', 1, 2500, '2024-07-13 19:27:34', 'Hils Imidi'),
(293, 'Londowis', '900', '1300', 1, 1300, '2024-07-13 19:28:06', 'Hils Imidi'),
(294, 'U-FRESH', '500', '700', 5, 3500, '2024-07-14 01:21:53', 'Hils Imidi'),
(295, 'Eau bidon', '200', '1000', 13, 13000, '2024-07-14 01:23:07', 'Hils Imidi'),
(296, 'Festa orange', '600', '700', 3, 2100, '2024-07-14 01:23:37', 'Hils Imidi'),
(297, 'Festa noir ', '600', '700', 2, 1400, '2024-07-14 01:24:10', 'Hils Imidi'),
(298, 'zesta ananas', '800', '1000', 4, 4000, '2024-07-14 01:24:30', 'Hils Imidi'),
(299, 'Alpina', '500', '500', 26, 13000, '2024-07-14 01:25:24', 'Hils Imidi'),
(300, 'Zesta marakuja', '800', '1000', 2, 2000, '2024-07-14 01:25:35', 'Hils Imidi'),
(301, 'Festa orange', '600', '700', 2, 1400, '2024-07-14 01:26:58', 'Hils Imidi'),
(302, 'Festa ananas', '600', '700', 1, 700, '2024-07-14 01:27:17', 'Hils Imidi'),
(303, 'Zesta cola', '800', '1000', 4, 4000, '2024-07-14 01:27:37', 'Hils Imidi'),
(304, 'Festa vert', '600', '700', 1, 700, '2024-07-14 01:28:38', 'Hils Imidi'),
(305, 'Festa tangawizi', '600', '1000', 1, 1000, '2024-07-14 01:29:17', 'Hils Imidi'),
(306, 'Mokonzi', '1800', '2300', 1, 2300, '2024-07-14 01:29:54', 'Hils Imidi'),
(307, 'Lulu gr rouge', '3000', '3500', 1, 3500, '2024-07-14 01:30:20', 'Hils Imidi'),
(308, 'Festa energy', '700', '1000', 5, 5000, '2024-07-14 01:31:24', 'Hils Imidi'),
(309, 'Festa noir ', '600', '700', 2, 1400, '2024-07-14 01:32:26', 'Hils Imidi'),
(310, 'zesta mangue', '800', '1000', 1, 1000, '2024-07-14 01:34:08', 'Hils Imidi'),
(311, 'Zesta mangue 1L', '1400', '2000', 2, 4000, '2024-07-14 01:35:12', 'Hils Imidi'),
(312, 'Zesta banane', '700', '1000', 1, 1000, '2024-07-14 01:38:13', 'Hils Imidi'),
(313, 'Coca plasique', '900', '1000', 1, 1000, '2024-07-14 01:38:37', 'Hils Imidi'),
(314, 'Mokonzi', '1800', '2300', 1, 2300, '2024-07-14 01:39:17', 'Hils Imidi'),
(315, 'XXL', '1500', '2000', 3, 6000, '2024-07-14 01:39:51', 'Hils Imidi'),
(316, 'Splendeur', '1800', '2300', 2, 4600, '2024-07-14 01:40:49', 'Hils Imidi'),
(317, 'Villa grand', '6500', '7500', 1, 7500, '2024-07-14 01:41:26', 'Hils Imidi'),
(318, 'Vain amour', '1250', '1700', 5, 8500, '2024-07-14 01:42:10', 'Hils Imidi'),
(319, 'Kolo mboka', '1300', '1700', 7, 11900, '2024-07-14 01:42:35', 'Hils Imidi'),
(320, 'orangina', '900', '1000', 1, 1000, '2024-07-14 01:46:18', 'Hils Imidi'),
(321, 'Fanta plasique', '900', '1000', 2, 2000, '2024-07-14 01:47:14', 'Hils Imidi'),
(322, 'Eau bidon', '200', '1000', 12, 12000, '2024-07-15 23:38:04', 'Hils Imidi'),
(323, 'Alpina', '500', '500', 15, 7500, '2024-07-15 23:39:13', 'Hils Imidi'),
(324, 'Festa orange', '600', '700', 1, 700, '2024-07-15 23:39:50', 'Hils Imidi'),
(325, 'Festa energy', '700', '1000', 8, 8000, '2024-07-15 23:40:29', 'Hils Imidi'),
(326, 'Festa ananas', '600', '700', 2, 1400, '2024-07-15 23:41:40', 'Hils Imidi'),
(327, 'Festa rouge', '600', '700', 1, 700, '2024-07-15 23:42:18', 'Hils Imidi'),
(328, 'Festa tangawizi', '600', '1000', 1, 1000, '2024-07-15 23:42:43', 'Hils Imidi'),
(329, 'zesta ananas', '800', '1000', 3, 3000, '2024-07-15 23:43:27', 'Hils Imidi'),
(330, 'Zesta cola', '800', '1000', 3, 3000, '2024-07-15 23:44:15', 'Hils Imidi'),
(331, 'Zesta marakuja', '800', '1000', 5, 5000, '2024-07-15 23:44:44', 'Hils Imidi'),
(332, 'zesta mangue', '800', '1000', 1, 1000, '2024-07-15 23:45:23', 'Hils Imidi'),
(333, 'Sprite', '1700', '2500', 1, 2500, '2024-07-15 23:45:42', 'Hils Imidi'),
(334, 'XXL', '1500', '2000', 6, 12000, '2024-07-15 23:46:01', 'Hils Imidi'),
(335, 'U-FRESH', '500', '700', 2, 1400, '2024-07-15 23:46:23', 'Hils Imidi'),
(336, 'Lulu gr vert', '3000', '3500', 1, 3500, '2024-07-15 23:46:56', 'Hils Imidi'),
(337, 'Lulu gr rouge', '3000', '3500', 1, 3500, '2024-07-15 23:47:19', 'Hils Imidi'),
(338, 'Kolo mboka', '1300', '1700', 3, 5100, '2024-07-15 23:47:47', 'Hils Imidi'),
(339, 'Coca plasique', '900', '1000', 3, 3000, '2024-07-15 23:48:17', 'Hils Imidi'),
(340, 'Fanta plasique', '900', '1000', 2, 2000, '2024-07-15 23:48:42', 'Hils Imidi'),
(341, 'Pastis', '1800', '2300', 1, 2300, '2024-07-15 23:49:10', 'Hils Imidi'),
(342, 'orangina', '900', '1000', 1, 1000, '2024-07-15 23:49:45', 'Hils Imidi'),
(343, 'Eau bidon', '200', '1000', 3, 3000, '2024-07-15 23:55:31', 'Hils Imidi'),
(344, 'Alpina', '500', '500', 9, 4500, '2024-07-15 23:56:17', 'Hils Imidi'),
(345, 'Festa energy', '700', '1000', 4, 4000, '2024-07-15 23:56:52', 'Hils Imidi'),
(346, 'Festa ananas', '600', '700', 1, 700, '2024-07-15 23:57:16', 'Hils Imidi'),
(347, 'Festa rouge', '600', '700', 1, 700, '2024-07-15 23:58:03', 'Hils Imidi'),
(348, 'zesta ananas', '800', '1000', 2, 2000, '2024-07-15 23:58:57', 'Hils Imidi'),
(349, 'zesta rouge', '800', '1000', 1, 1000, '2024-07-15 23:59:20', 'Hils Imidi'),
(350, 'Zesta banane', '700', '1000', 1, 1000, '2024-07-15 23:59:49', 'Hils Imidi'),
(351, 'Zesta marakuja', '800', '1000', 1, 1000, '2024-07-16 00:00:14', 'Hils Imidi'),
(352, 'Sprite', '1700', '2500', 1, 2500, '2024-07-16 00:00:39', 'Hils Imidi'),
(353, 'U-FRESH', '500', '700', 5, 3500, '2024-07-16 00:01:09', 'Hils Imidi'),
(354, 'Villa grand', '6500', '7500', 1, 7500, '2024-07-16 00:01:28', 'Hils Imidi'),
(355, 'Vain amour', '1250', '1700', 2, 3400, '2024-07-16 00:01:53', 'Hils Imidi'),
(356, 'Savana', '3200', '4000', 1, 4000, '2024-07-16 00:02:09', 'Hils Imidi'),
(357, 'Bavaria petit', '2100', '3000', 1, 3000, '2024-07-16 00:02:45', 'Hils Imidi'),
(358, 'Eau bidon', '200', '1000', 7, 7000, '2024-07-18 06:32:05', 'Hils Imidi'),
(359, 'Alpina', '500', '500', 24, 12000, '2024-07-18 06:32:24', 'Hils Imidi'),
(360, 'Festa energy', '700', '1000', 5, 5000, '2024-07-18 06:32:51', 'Hils Imidi'),
(361, 'Festa ananas', '600', '700', 2, 1400, '2024-07-18 06:33:22', 'Hils Imidi'),
(362, 'Festa rouge', '600', '700', 1, 700, '2024-07-18 06:33:48', 'Hils Imidi'),
(363, 'Festa orange', '600', '700', 1, 700, '2024-07-18 06:34:43', 'Hils Imidi'),
(364, 'Festa noir ', '600', '700', 2, 1400, '2024-07-18 06:35:27', 'Hils Imidi'),
(365, 'zesta ananas', '800', '1000', 2, 2000, '2024-07-18 06:36:01', 'Hils Imidi'),
(366, 'zesta rouge', '800', '1000', 1, 1000, '2024-07-18 06:36:27', 'Hils Imidi'),
(367, 'Zesta cola', '800', '1000', 4, 4000, '2024-07-18 06:37:04', 'Hils Imidi'),
(368, 'zesta mangue', '800', '1000', 3, 3000, '2024-07-18 06:37:46', 'Hils Imidi'),
(369, 'Zesta orange', '800', '1000', 1, 1000, '2024-07-18 06:38:29', 'Hils Imidi'),
(370, 'Zesta marakuja', '800', '1000', 2, 2000, '2024-07-18 06:38:58', 'Hils Imidi'),
(371, 'Bavaria', '3400', '4500', 2, 9000, '2024-07-18 06:39:44', 'Hils Imidi'),
(372, 'Zesta banane', '700', '1000', 1, 1000, '2024-07-18 06:40:08', 'Hils Imidi'),
(373, 'Coca plasique', '900', '1000', 2, 2000, '2024-07-18 06:40:41', 'Hils Imidi'),
(374, 'orangina', '900', '1000', 4, 4000, '2024-07-18 06:41:02', 'Hils Imidi'),
(375, 'U-FRESH', '500', '700', 2, 1400, '2024-07-18 06:41:25', 'Hils Imidi'),
(376, 'Boss', '1800', '2300', 1, 2300, '2024-07-18 06:41:48', 'Hils Imidi'),
(377, 'Splendeur', '1800', '2300', 5, 11500, '2024-07-18 06:42:17', 'Hils Imidi'),
(378, 'Mokonzi', '1800', '2300', 1, 2300, '2024-07-18 06:42:51', 'Hils Imidi'),
(379, 'Cuca bouteille', '1500', '2000', 4, 8000, '2024-07-18 06:43:15', 'Hils Imidi'),
(380, 'Reserve 7', '6000', '7000', 1, 7000, '2024-07-18 06:43:45', 'Hils Imidi'),
(381, 'Eau bidon', '200', '1000', 6, 6000, '2024-07-18 06:52:33', 'Hils Imidi'),
(382, 'Alpina', '500', '500', 19, 9500, '2024-07-18 06:52:51', 'Hils Imidi'),
(383, 'Festa energy', '700', '1000', 4, 4000, '2024-07-18 06:53:26', 'Hils Imidi'),
(384, 'Festa noir ', '600', '700', 1, 700, '2024-07-18 06:54:06', 'Hils Imidi'),
(385, 'Zesta cola', '800', '1000', 1, 1000, '2024-07-18 06:54:53', 'Hils Imidi'),
(386, 'Zesta marakuja', '800', '1000', 4, 4000, '2024-07-18 06:55:22', 'Hils Imidi'),
(387, 'orangina', '900', '1000', 1, 1000, '2024-07-18 06:55:54', 'Hils Imidi'),
(388, 'U-FRESH', '500', '700', 2, 1400, '2024-07-18 06:56:11', 'Hils Imidi'),
(389, 'Lulu gr rouge', '3000', '3500', 1, 3500, '2024-07-18 06:57:06', 'Hils Imidi'),
(390, 'Lulu pt rouge', '700', '1000', 1, 1000, '2024-07-18 06:57:26', 'Hils Imidi'),
(391, 'Vain amour', '1250', '1700', 1, 1700, '2024-07-18 06:57:49', 'Hils Imidi'),
(392, 'Cuca bouteille', '1500', '2000', 1, 2000, '2024-07-18 06:58:28', 'Hils Imidi'),
(393, 'Biscuit mariamar', '750', '1000', 2, 2000, '2024-07-18 06:59:06', 'Hils Imidi'),
(394, 'Monarch', '4200', '5000', 1, 5000, '2024-07-18 06:59:34', 'Hils Imidi'),
(395, 'Mokonzi', '1800', '2300', 4, 9200, '2024-07-18 07:00:14', 'Hils Imidi'),
(396, 'Eau bidon', '200', '1000', 8, 8000, '2024-07-19 08:42:49', 'Hils Imidi'),
(397, 'Alpina', '500', '500', 23, 11500, '2024-07-19 08:43:06', 'Hils Imidi'),
(398, 'Festa orange', '600', '700', 1, 700, '2024-07-19 08:43:27', 'Hils Imidi'),
(399, 'Festa energy', '700', '1000', 7, 7000, '2024-07-19 08:43:57', 'Hils Imidi'),
(400, 'Festa ananas', '600', '700', 1, 700, '2024-07-19 08:44:21', 'Hils Imidi'),
(401, 'Zesta mangue 1L', '1400', '2000', 1, 2000, '2024-07-19 08:44:57', 'Hils Imidi'),
(402, 'Zesta cola', '800', '1000', 3, 3000, '2024-07-19 08:45:59', 'Hils Imidi'),
(403, 'zesta ananas', '800', '1000', 2, 2000, '2024-07-19 08:46:34', 'Hils Imidi'),
(404, 'Zesta orange', '800', '1000', 2, 2000, '2024-07-19 08:47:16', 'Hils Imidi'),
(405, 'zesta mangue', '800', '1000', 1, 1000, '2024-07-19 08:47:35', 'Hils Imidi'),
(406, 'Zesta banane', '700', '1000', 2, 2000, '2024-07-19 08:48:14', 'Hils Imidi'),
(407, 'XXL', '1500', '2000', 5, 10000, '2024-07-19 08:48:34', 'Hils Imidi'),
(408, 'Pepsi', '1900', '2800', 1, 2800, '2024-07-19 08:48:48', 'Hils Imidi'),
(409, 'Festa tangawizi', '600', '1000', 2, 2000, '2024-07-19 08:49:17', 'Hils Imidi'),
(410, 'Fanta plasique', '900', '1000', 1, 1000, '2024-07-19 08:49:47', 'Hils Imidi'),
(411, 'orangina', '900', '1000', 2, 2000, '2024-07-19 08:50:02', 'Hils Imidi'),
(412, 'U-FRESH', '500', '700', 5, 3500, '2024-07-19 08:50:28', 'Hils Imidi'),
(413, 'Vain amour', '1250', '1700', 2, 3400, '2024-07-19 08:50:53', 'Hils Imidi'),
(414, 'Eau bidon', '200', '1000', 10, 10000, '2024-07-19 23:18:52', 'Hils Imidi'),
(415, 'Bavaria', '3400', '4500', 10, 45000, '2024-07-19 23:19:02', 'Hils Imidi'),
(416, 'Eau bidon', '200', '1000', 10, 10000, '2024-07-19 23:19:39', 'Hils Imidi'),
(417, 'Eau bidon', '200', '1000', 10, 10000, '2024-07-19 23:27:10', 'Hils Imidi'),
(418, 'Zesta banane', '700', '1000', 1, 1000, '2024-07-19 23:34:12', 'Hils Imidi'),
(420, 'Eau bidon', '200', '1000', 8, 8000, '2024-07-20 17:59:18', 'Hils Imidi'),
(421, 'Alpina', '500', '500', 15, 7500, '2024-07-20 17:59:32', 'Hils Imidi'),
(422, 'Festa energy', '700', '1000', 14, 14000, '2024-07-20 17:59:49', 'Hils Imidi'),
(423, 'Festa ananas', '600', '700', 1, 700, '2024-07-20 18:00:13', 'Hils Imidi'),
(424, 'zesta ananas', '800', '1000', 6, 6000, '2024-07-20 18:00:39', 'Hils Imidi'),
(425, 'Zesta cola', '800', '1000', 2, 2000, '2024-07-20 18:01:23', 'Hils Imidi'),
(426, 'zesta mangue', '800', '1000', 2, 2000, '2024-07-20 18:02:01', 'Hils Imidi'),
(427, 'Sprite', '1700', '2500', 1, 2500, '2024-07-20 18:02:18', 'Hils Imidi'),
(428, 'Bavaria petit', '2100', '3000', 1, 3000, '2024-07-20 18:02:37', 'Hils Imidi'),
(429, 'orangina', '900', '1000', 3, 3000, '2024-07-20 18:02:54', 'Hils Imidi'),
(430, 'Coca plasique', '900', '1000', 2, 2000, '2024-07-20 18:03:15', 'Hils Imidi'),
(431, 'U-FRESH', '500', '700', 2, 1400, '2024-07-20 18:03:32', 'Hils Imidi'),
(432, 'Lulu pt rouge', '700', '1000', 1, 1000, '2024-07-20 18:03:56', 'Hils Imidi'),
(433, 'Boss', '1800', '2300', 3, 6900, '2024-07-20 18:04:24', 'Hils Imidi'),
(434, 'Splendeur', '1800', '2300', 1, 2300, '2024-07-20 18:04:42', 'Hils Imidi'),
(435, 'Villa grand', '6500', '7500', 1, 7500, '2024-07-20 18:05:04', 'Hils Imidi'),
(436, 'Vain amour', '1250', '1700', 5, 8500, '2024-07-20 18:05:28', 'Hils Imidi'),
(437, 'Festa tangawizi', '600', '1000', 1, 1000, '2024-07-20 18:05:49', 'Hils Imidi'),
(438, 'Fanta plasique', '900', '1000', 1, 1000, '2024-07-20 18:06:32', 'Hils Imidi'),
(439, 'Cuca bouteille', '1500', '2000', 1, 2000, '2024-07-20 18:06:50', 'Hils Imidi'),
(440, 'Mirinda', '1900', '2800', 1, 2800, '2024-07-20 18:07:47', 'Hils Imidi'),
(441, 'Biscuit mariamar', '750', '1000', 1, 1000, '2024-07-20 18:08:07', 'Hils Imidi'),
(442, 'Savana', '3200', '4000', 1, 4000, '2024-07-20 18:08:29', 'Hils Imidi'),
(443, 'Mokonzi', '1800', '2300', 1, 2300, '2024-07-20 18:08:45', 'Hils Imidi'),
(444, 'Eau bidon', '200', '1000', 11, 11000, '2024-07-21 10:25:13', 'Hils Imidi'),
(445, 'Alpina', '500', '500', 13, 6500, '2024-07-21 10:25:28', 'Hils Imidi'),
(446, 'Festa energy', '700', '1000', 9, 9000, '2024-07-21 10:25:48', 'Hils Imidi'),
(447, 'Festa vert', '600', '700', 3, 2100, '2024-07-21 10:26:13', 'Hils Imidi'),
(448, 'Festa rouge', '600', '700', 3, 2100, '2024-07-21 10:26:36', 'Hils Imidi'),
(449, 'Festa orange grd', '750', '1000', 3, 3000, '2024-07-21 10:28:34', 'Hils Imidi'),
(450, 'zesta ananas', '800', '1000', 3, 3000, '2024-07-21 10:29:15', 'Hils Imidi'),
(451, 'Zesta cola', '800', '1000', 4, 4000, '2024-07-21 10:29:40', 'Hils Imidi'),
(452, 'Zesta marakuja', '800', '1000', 2, 2000, '2024-07-21 10:29:58', 'Hils Imidi'),
(453, 'zesta mangue', '800', '1000', 2, 2000, '2024-07-21 10:30:25', 'Hils Imidi'),
(455, 'Sprite', '1700', '2500', 1, 2500, '2024-07-21 10:31:47', 'Hils Imidi'),
(456, 'Bavaria', '3400', '4500', 1, 4500, '2024-07-21 10:32:09', 'Hils Imidi'),
(457, 'orangina', '900', '1000', 1, 1000, '2024-07-21 10:32:36', 'Hils Imidi'),
(458, 'Coca plasique', '900', '1000', 1, 1000, '2024-07-21 10:32:57', 'Hils Imidi'),
(459, 'U-FRESH', '500', '700', 1, 700, '2024-07-21 10:33:14', 'Hils Imidi'),
(460, 'Lulu gr rouge', '3000', '3500', 2, 7000, '2024-07-21 10:33:39', 'Hils Imidi'),
(461, 'Lulu pt vert', '700', '1000', 1, 1000, '2024-07-21 10:34:09', 'Hils Imidi'),
(462, 'Boss', '1800', '2300', 3, 6900, '2024-07-21 10:34:33', 'Hils Imidi'),
(463, 'Splendeur', '1800', '2300', 1, 2300, '2024-07-21 10:35:34', 'Hils Imidi'),
(464, 'Villa grand', '6500', '7500', 1, 7500, '2024-07-21 10:36:40', 'Hils Imidi'),
(465, 'Mirinda', '1900', '2800', 1, 2800, '2024-07-21 10:37:46', 'Hils Imidi'),
(466, 'Cuca bouteille', '1500', '2000', 5, 10000, '2024-07-21 10:39:31', 'Hils Imidi'),
(467, 'Mokonzi', '1800', '2300', 2, 4600, '2024-07-21 10:40:01', 'Hils Imidi'),
(468, 'Dopel', '1700', '2500', 4, 10000, '2024-07-21 10:40:24', 'Hils Imidi'),
(469, 'Savana', '3200', '4000', 1, 4000, '2024-07-21 10:40:51', 'Hils Imidi'),
(470, 'Alpina', '500', '500', 10, 5000, '2024-07-21 10:41:43', 'Hils Imidi'),
(471, 'Eau bidon', '200', '1000', 15, 15000, '2024-07-22 00:03:03', 'Hils Imidi'),
(472, 'Alpina', '500', '500', 13, 6500, '2024-07-22 00:03:22', 'Hils Imidi'),
(473, 'Festa energy', '700', '1000', 10, 10000, '2024-07-22 00:03:44', 'Hils Imidi'),
(474, 'Festa rouge', '600', '700', 1, 700, '2024-07-22 00:04:16', 'Hils Imidi'),
(475, 'Festa noir ', '600', '700', 3, 2100, '2024-07-22 00:04:41', 'Hils Imidi'),
(476, 'Festa orange', '600', '700', 2, 1400, '2024-07-22 00:06:00', 'Hils Imidi'),
(477, 'Festa tangawizi', '600', '1000', 1, 1000, '2024-07-22 00:07:15', 'Hils Imidi'),
(478, 'zesta ananas', '800', '1000', 2, 2000, '2024-07-22 00:08:26', 'Hils Imidi'),
(479, 'zesta rouge', '800', '1000', 1, 1000, '2024-07-22 00:08:45', 'Hils Imidi'),
(480, 'Zesta cola', '800', '1000', 2, 2000, '2024-07-22 00:09:11', 'Hils Imidi'),
(481, 'Zesta orange', '800', '1000', 4, 4000, '2024-07-22 00:10:02', 'Hils Imidi'),
(482, 'Zesta mangue 1L', '1400', '2000', 3, 6000, '2024-07-22 00:11:40', 'Hils Imidi'),
(483, 'zesta mangue', '800', '1000', 1, 1000, '2024-07-22 00:12:25', 'Hils Imidi'),
(484, 'Zesta banane', '700', '1000', 3, 3000, '2024-07-22 00:12:45', 'Hils Imidi'),
(485, 'Coca', '1700', '2500', 2, 5000, '2024-07-22 00:13:22', 'Hils Imidi'),
(486, 'Sprite', '1700', '2500', 1, 2500, '2024-07-22 00:14:27', 'Hils Imidi'),
(487, 'XXL', '1400', '2000', 1, 2000, '2024-07-22 00:14:51', 'Hils Imidi'),
(488, 'Pepsi', '1900', '2800', 2, 5600, '2024-07-22 00:15:10', 'Hils Imidi'),
(489, 'U-FRESH', '500', '700', 4, 2800, '2024-07-22 00:17:10', 'Hils Imidi'),
(490, 'Lulu gr rouge', '3000', '3500', 1, 3500, '2024-07-22 00:17:48', 'Hils Imidi'),
(491, 'Lulu pt rouge', '700', '1000', 1, 1000, '2024-07-22 00:18:05', 'Hils Imidi'),
(492, 'Villa grand', '6500', '7500', 2, 15000, '2024-07-22 00:18:31', 'Hils Imidi'),
(493, 'Vain amour', '1250', '1700', 4, 6800, '2024-07-22 00:18:58', 'Hils Imidi'),
(494, 'CUCA', '1500', '2000', 1, 2000, '2024-07-22 00:19:36', 'Hils Imidi'),
(495, 'Fanta plasique', '900', '1000', 1, 1000, '2024-07-22 00:20:17', 'Hils Imidi'),
(496, 'Zesta marakuja', '800', '1000', 4, 4000, '2024-07-22 00:20:51', 'Hils Imidi'),
(497, 'orangina', '900', '1000', 3, 3000, '2024-07-22 00:21:18', 'Hils Imidi'),
(498, 'Coca plasique', '900', '1000', 4, 4000, '2024-07-22 00:21:50', 'Hils Imidi'),
(499, 'Mokonzi', '1800', '2300', 5, 11500, '2024-07-22 00:22:28', 'Hils Imidi'),
(500, 'Bavaria', '3400', '4500', 1, 4500, '2024-07-22 00:25:45', 'Hils Imidi'),
(501, 'Eau bidon', '200', '1000', 15, 15000, '2024-07-22 22:49:35', 'Hils Imidi'),
(502, 'Alpina', '500', '500', 19, 9500, '2024-07-22 22:49:58', 'Hils Imidi'),
(503, 'Festa energy', '700', '1000', 5, 5000, '2024-07-22 22:50:39', 'Hils Imidi'),
(504, 'Festa noir ', '600', '700', 1, 700, '2024-07-22 22:51:13', 'Hils Imidi'),
(505, 'zesta ananas', '800', '1000', 1, 1000, '2024-07-22 22:51:32', 'Hils Imidi'),
(506, 'Zesta cola', '800', '1000', 1, 1000, '2024-07-22 22:52:13', 'Hils Imidi'),
(507, 'Zesta orange', '800', '1000', 1, 1000, '2024-07-22 22:52:36', 'Hils Imidi'),
(508, 'zesta mangue', '800', '1000', 2, 2000, '2024-07-22 22:54:26', 'Hils Imidi'),
(509, 'Zesta marakuja', '800', '1000', 1, 1000, '2024-07-22 22:54:46', 'Hils Imidi'),
(510, 'XXL', '1400', '2000', 3, 6000, '2024-07-22 22:55:00', 'Hils Imidi'),
(511, 'U-FRESH', '500', '700', 4, 2800, '2024-07-22 22:55:17', 'Hils Imidi'),
(512, 'Boss', '1800', '2300', 1, 2300, '2024-07-22 22:55:43', 'Hils Imidi'),
(513, 'Vain amour', '1250', '1700', 4, 6800, '2024-07-22 22:56:04', 'Hils Imidi'),
(514, 'Mirinda', '1900', '2800', 1, 2800, '2024-07-22 22:56:25', 'Hils Imidi'),
(515, 'orangina', '900', '1000', 3, 3000, '2024-07-22 22:56:50', 'Hils Imidi'),
(516, 'Festa tangawizi', '600', '1000', 1, 1000, '2024-07-22 22:57:29', 'Hils Imidi'),
(517, 'Savana', '3200', '4000', 1, 4000, '2024-07-22 22:57:52', 'Hils Imidi'),
(518, 'Zesta marakuja', '800', '1000', 1, 1000, '2024-07-22 22:58:12', 'Hils Imidi'),
(519, 'Eau bidon', '200', '1000', 7, 7000, '2024-07-24 23:59:01', 'Hils Imidi'),
(520, 'Alpina', '500', '500', 18, 9000, '2024-07-24 23:59:19', 'Hils Imidi'),
(521, 'Festa energy', '700', '1000', 7, 7000, '2024-07-24 23:59:39', 'Hils Imidi'),
(523, 'Eau bidon', '200', '1000', 10, 10000, '2024-07-25 21:23:44', 'Hils Imidi'),
(524, 'Alpina', '500', '500', 8, 4000, '2024-07-25 21:24:02', 'Hils Imidi'),
(525, 'Swista', '500', '700', 9, 6300, '2024-07-25 21:24:23', 'Hils Imidi'),
(526, 'Festa energy', '700', '1000', 7, 7000, '2024-07-25 21:24:44', 'Hils Imidi'),
(527, 'Festa vert', '600', '700', 1, 700, '2024-07-25 21:25:10', 'Hils Imidi'),
(528, 'Festa rouge', '600', '700', 2, 1400, '2024-07-25 21:25:33', 'Hils Imidi'),
(529, 'Festa orange', '600', '700', 1, 700, '2024-07-25 21:25:47', 'Hils Imidi'),
(530, 'zesta ananas', '800', '1000', 5, 5000, '2024-07-25 21:26:32', 'Hils Imidi'),
(531, 'zesta rouge', '800', '1000', 2, 2000, '2024-07-25 21:26:53', 'Hils Imidi'),
(532, 'Zesta cola', '800', '1000', 1, 1000, '2024-07-25 21:27:31', 'Hils Imidi'),
(533, 'zesta mangue', '800', '1000', 2, 2000, '2024-07-25 21:27:55', 'Hils Imidi'),
(534, 'Zesta mangue 1L', '1400', '2000', 2, 4000, '2024-07-25 21:28:15', 'Hils Imidi'),
(535, 'XXL', '1400', '2000', 3, 6000, '2024-07-25 21:28:30', 'Hils Imidi'),
(536, 'U-FRESH', '500', '700', 3, 2100, '2024-07-25 21:28:43', 'Hils Imidi'),
(537, 'Lulu gr rouge', '3000', '3500', 2, 7000, '2024-07-25 21:29:12', 'Hils Imidi'),
(538, 'Boss', '1800', '2300', 1, 2300, '2024-07-25 21:29:42', 'Hils Imidi'),
(539, 'Vain amour', '1250', '1700', 2, 3400, '2024-07-25 21:30:07', 'Hils Imidi'),
(540, 'Shaka', '3000', '3500', 1, 3500, '2024-07-25 21:30:33', 'Hils Imidi'),
(541, 'CUCA', '1500', '2000', 2, 4000, '2024-07-25 21:30:59', 'Hils Imidi'),
(542, 'Zesta marakuja', '800', '1000', 3, 3000, '2024-07-25 21:31:32', 'Hils Imidi'),
(543, 'Coca plasique', '900', '1000', 2, 2000, '2024-07-25 21:31:58', 'Hils Imidi'),
(544, 'orangina', '900', '1000', 5, 5000, '2024-07-25 21:32:27', 'Hils Imidi'),
(545, 'Pastis', '1800', '2300', 1, 2300, '2024-07-25 21:32:42', 'Hils Imidi'),
(546, 'Eau bidon', '200', '1000', 7, 7000, '2024-07-25 21:36:52', 'Hils Imidi'),
(547, 'Alpina', '500', '500', 18, 9000, '2024-07-25 21:37:10', 'Hils Imidi'),
(548, 'Festa energy', '700', '1000', 7, 7000, '2024-07-25 21:37:42', 'Hils Imidi'),
(549, 'Festa vert', '600', '700', 1, 700, '2024-07-25 21:38:09', 'Hils Imidi'),
(550, 'Festa rouge', '600', '700', 2, 1400, '2024-07-25 21:38:49', 'Hils Imidi'),
(551, 'Festa noir ', '600', '700', 1, 700, '2024-07-25 21:39:11', 'Hils Imidi'),
(552, 'zesta ananas', '800', '1000', 1, 1000, '2024-07-25 21:39:36', 'Hils Imidi'),
(553, 'zesta rouge', '800', '1000', 1, 1000, '2024-07-25 21:40:03', 'Hils Imidi'),
(554, 'Zesta cola', '800', '1000', 3, 3000, '2024-07-25 21:40:26', 'Hils Imidi'),
(555, 'zesta mangue', '800', '1000', 3, 3000, '2024-07-25 21:41:02', 'Hils Imidi'),
(556, 'Zesta mangue 1L', '1400', '2000', 1, 2000, '2024-07-25 21:41:34', 'Hils Imidi'),
(557, 'Zesta marakuja', '800', '1000', 4, 4000, '2024-07-25 21:42:12', 'Hils Imidi'),
(558, 'Coca', '1700', '2500', 1, 2500, '2024-07-25 21:42:36', 'Hils Imidi'),
(559, 'XXL', '1400', '2000', 1, 2000, '2024-07-25 21:42:53', 'Hils Imidi'),
(560, 'orangina', '900', '1000', 1, 1000, '2024-07-25 21:43:08', 'Hils Imidi'),
(561, 'Festa tangawizi', '600', '1000', 3, 3000, '2024-07-25 21:43:38', 'Hils Imidi'),
(562, 'Fanta plasique', '900', '1000', 1, 1000, '2024-07-25 21:44:05', 'Hils Imidi'),
(563, 'U-FRESH', '500', '700', 3, 2100, '2024-07-25 21:44:21', 'Hils Imidi'),
(564, 'Boss', '1800', '2300', 1, 2300, '2024-07-25 21:44:43', 'Hils Imidi'),
(565, 'CUCA', '1500', '2000', 1, 2000, '2024-07-25 21:45:04', 'Hils Imidi'),
(566, 'Dopel', '1700', '2500', 1, 2500, '2024-07-25 21:45:23', 'Hils Imidi'),
(567, 'EXO', '3200', '3500', 1, 3500, '2024-07-25 21:45:50', 'Hils Imidi'),
(568, 'Eau bidon', '200', '1000', 17, 17000, '2024-07-25 23:03:24', 'Hils Imidi'),
(569, 'Eau bidon', '200', '1000', 17, 17000, '2024-07-26 20:50:15', 'Hils Imidi'),
(570, 'Alpina', '500', '500', 4, 2000, '2024-07-26 20:50:29', 'Hils Imidi'),
(571, 'Festa energy', '700', '1000', 5, 5000, '2024-07-26 20:50:44', 'Hils Imidi'),
(572, 'Festa rouge', '600', '700', 2, 1400, '2024-07-26 20:51:02', 'Hils Imidi'),
(573, 'zesta ananas', '800', '1000', 1, 1000, '2024-07-26 20:51:31', 'Hils Imidi'),
(574, 'zesta mangue', '800', '1000', 2, 2000, '2024-07-26 20:52:44', 'Hils Imidi'),
(575, 'Vain amour', '1300', '1500', 2, 3000, '2024-07-26 20:54:32', 'Hils Imidi'),
(576, 'Zesta marakuja', '800', '1000', 4, 4000, '2024-07-26 20:55:25', 'Hils Imidi'),
(577, 'orangina', '900', '1000', 3, 3000, '2024-07-26 20:55:43', 'Hils Imidi'),
(578, 'Coca plasique', '900', '1000', 1, 1000, '2024-07-26 20:56:04', 'Hils Imidi'),
(579, 'Eau bidon', '200', '1000', 7, 7000, '2024-07-26 23:10:10', 'Hils Imidi'),
(580, 'Eau bidon', '200', '1000', 7, 7000, '2024-07-27 16:11:07', 'Hils Imidi'),
(581, 'Alpina', '500', '500', 18, 9000, '2024-07-27 16:11:33', 'Hils Imidi'),
(582, 'Swista', '500', '700', 2, 1400, '2024-07-27 16:11:49', 'Hils Imidi'),
(583, 'Festa energy', '700', '1000', 3, 3000, '2024-07-27 16:12:17', 'Hils Imidi'),
(584, 'Festa rouge', '600', '700', 2, 1400, '2024-07-27 16:12:41', 'Hils Imidi'),
(585, 'zesta ananas', '800', '1000', 4, 4000, '2024-07-27 16:12:57', 'Hils Imidi'),
(586, 'zesta rouge', '800', '1000', 2, 2000, '2024-07-27 16:13:11', 'Hils Imidi'),
(587, 'Zesta orange', '800', '1000', 2, 2000, '2024-07-27 16:13:36', 'Hils Imidi'),
(588, 'Zesta marakuja', '800', '1000', 3, 3000, '2024-07-27 16:13:58', 'Hils Imidi'),
(589, 'Bavaria', '3400', '4500', 1, 4500, '2024-07-27 16:14:17', 'Hils Imidi'),
(590, 'ORANGINA', '900', '1000', 2, 2000, '2024-07-27 16:14:30', 'Hils Imidi'),
(591, 'POWER JAUNE', '1400', '1600', 2, 3200, '2024-07-27 16:14:44', 'Hils Imidi'),
(592, 'Pepsi', '1900', '2800', 2, 5600, '2024-07-27 16:14:58', 'Hils Imidi'),
(593, 'U-FRESH', '500', '700', 2, 1400, '2024-07-27 16:15:10', 'Hils Imidi'),
(594, 'Boss', '1800', '2300', 2, 4600, '2024-07-27 16:15:21', 'Hils Imidi'),
(595, 'Splendeur', '1800', '2300', 2, 4600, '2024-07-27 16:15:37', 'Hils Imidi'),
(596, 'Vain amour', '1300', '1500', 6, 9000, '2024-07-27 16:15:57', 'Hils Imidi'),
(597, 'CUCA', '1500', '2000', 1, 2000, '2024-07-27 16:16:13', 'Hils Imidi'),
(598, 'Fanta plasique', '900', '1000', 3, 3000, '2024-07-27 16:16:31', 'Hils Imidi'),
(599, 'Fanta plasique', '900', '1000', 1, 1000, '2024-07-27 16:16:54', 'Hils Imidi'),
(600, 'Eau bidon', '200', '1000', 11, 11000, '2024-07-28 21:58:41', 'Hils Imidi'),
(601, 'Alpina', '500', '500', 14, 7000, '2024-07-28 21:58:57', 'Hils Imidi'),
(602, 'Festa energy', '700', '1000', 9, 9000, '2024-07-28 21:59:22', 'Hils Imidi'),
(603, 'Festa rouge', '600', '700', 2, 1400, '2024-07-28 21:59:41', 'Hils Imidi'),
(604, 'zesta ananas', '800', '1000', 5, 5000, '2024-07-28 21:59:59', 'Hils Imidi'),
(605, 'zesta rouge', '800', '1000', 1, 1000, '2024-07-28 22:00:16', 'Hils Imidi'),
(606, 'Zesta cola', '800', '1000', 2, 2000, '2024-07-28 22:00:36', 'Hils Imidi'),
(607, 'Zesta orange', '800', '1000', 3, 3000, '2024-07-28 22:01:07', 'Hils Imidi'),
(608, 'zesta mangue', '800', '1000', 2, 2000, '2024-07-28 22:01:39', 'Hils Imidi'),
(609, 'Zesta mangue 1L', '1400', '2000', 1, 2000, '2024-07-28 22:01:52', 'Hils Imidi'),
(610, 'XXL', '1400', '2000', 1, 2000, '2024-07-28 22:02:06', 'Hils Imidi'),
(611, 'Pepsi', '1900', '2800', 2, 5600, '2024-07-28 22:02:16', 'Hils Imidi'),
(612, 'U-FRESH', '500', '700', 3, 2100, '2024-07-28 22:02:31', 'Hils Imidi'),
(613, 'Boss', '1800', '2300', 1, 2300, '2024-07-28 22:02:49', 'Hils Imidi'),
(614, 'Vain amour', '1300', '1500', 26, 39000, '2024-07-28 22:03:40', 'Hils Imidi'),
(615, 'CUCA', '1500', '2000', 4, 8000, '2024-07-28 22:04:05', 'Hils Imidi'),
(616, 'ORANGINA', '900', '1000', 5, 5000, '2024-07-28 22:04:24', 'Hils Imidi'),
(617, 'Mirinda plastique', '900', '1000', 1, 1000, '2024-07-28 22:04:43', 'Hils Imidi'),
(618, 'Fanta plasique', '900', '1000', 4, 4000, '2024-07-28 22:05:13', 'Hils Imidi'),
(619, 'Zesta marakuja', '800', '1000', 6, 6000, '2024-07-28 22:05:38', 'Hils Imidi'),
(620, 'Cuca bouteille', '1500', '2000', 1, 2000, '2024-07-28 22:06:11', 'Hils Imidi'),
(621, 'Bavaria', '3400', '4500', 2, 9000, '2024-07-29 15:57:28', 'Hils Imidi'),
(622, 'Eau bidon', '630', '1000', 21, 21000, '2024-07-29 16:22:31', 'Hils Imidi'),
(623, 'Alpina', '500', '500', 12, 6000, '2024-07-29 16:22:46', 'Hils Imidi'),
(624, 'Festa energy', '700', '1000', 9, 9000, '2024-07-29 16:23:11', 'Hils Imidi'),
(625, 'Festa ananas', '600', '700', 1, 700, '2024-07-29 16:23:46', 'Hils Imidi'),
(626, 'zesta ananas', '800', '1000', 6, 6000, '2024-07-29 16:24:14', 'Hils Imidi'),
(627, 'zesta rouge', '800', '1000', 2, 2000, '2024-07-29 16:24:43', 'Hils Imidi'),
(628, 'Zesta mangue 1L', '1400', '2000', 1, 2000, '2024-07-29 16:24:58', 'Hils Imidi'),
(629, 'zesta mangue', '800', '1000', 1, 1000, '2024-07-29 16:25:17', 'Hils Imidi'),
(630, 'XXL', '1400', '2000', 2, 4000, '2024-07-29 16:25:32', 'Hils Imidi'),
(631, 'U-FRESH', '500', '700', 3, 2100, '2024-07-29 16:25:44', 'Hils Imidi'),
(632, 'Lulu gr vert', '3000', '3500', 1, 3500, '2024-07-29 16:26:00', 'Hils Imidi'),
(633, 'Boss', '1800', '2300', 3, 6900, '2024-07-29 16:26:23', 'Hils Imidi'),
(634, 'Splendeur', '1800', '2300', 2, 4600, '2024-07-29 16:26:39', 'Hils Imidi'),
(635, 'Villa Petit', '2000', '2500', 1, 2500, '2024-07-29 16:27:07', 'Hils Imidi'),
(636, 'Vain amour', '1300', '1500', 6, 9000, '2024-07-29 16:27:28', 'Hils Imidi'),
(637, 'Kolo mboka', '1300', '1500', 9, 13500, '2024-07-29 16:27:45', 'Hils Imidi'),
(638, 'Savana', '3200', '4000', 2, 8000, '2024-07-29 16:28:04', 'Hils Imidi'),
(639, 'ORANGINA', '900', '1000', 11, 11000, '2024-07-29 16:28:19', 'Hils Imidi'),
(640, 'Zesta marakuja', '800', '1000', 3, 3000, '2024-07-29 16:28:45', 'Hils Imidi'),
(641, 'Fanta plasique', '900', '1000', 4, 4000, '2024-07-29 16:29:04', 'Hils Imidi'),
(642, 'POWER JAUNE', '1400', '1600', 1, 1600, '2024-07-29 16:29:24', 'Hils Imidi'),
(644, 'Eau bidon', '630', '1000', 9, 9000, '2024-07-30 11:47:54', 'Hils Imidi'),
(645, 'Alpina', '500', '500', 24, 12000, '2024-07-30 11:49:51', 'Hils Imidi'),
(646, 'Swista', '500', '700', 1, 700, '2024-07-30 11:50:06', 'Hils Imidi'),
(647, 'Festa energy', '700', '1000', 12, 12000, '2024-07-30 11:50:54', 'Hils Imidi'),
(648, 'Festa noir ', '600', '700', 2, 1400, '2024-07-30 11:51:27', 'Hils Imidi'),
(649, 'Festa orange', '600', '700', 1, 700, '2024-07-30 11:55:19', 'Hils Imidi'),
(650, 'zesta ananas', '800', '1000', 2, 2000, '2024-07-30 11:55:37', 'Hils Imidi'),
(651, 'zesta rouge', '800', '1000', 3, 3000, '2024-07-30 11:56:04', 'Hils Imidi'),
(652, 'Zesta cola', '800', '1000', 3, 3000, '2024-07-30 11:56:34', 'Hils Imidi'),
(653, 'Zesta orange', '800', '1000', 1, 1000, '2024-07-30 12:03:52', 'Hils Imidi'),
(654, 'XXL', '1400', '2000', 3, 6000, '2024-07-30 12:04:46', 'Hils Imidi'),
(655, 'Pepsi', '1900', '2800', 1, 2800, '2024-07-30 12:05:14', 'Hils Imidi'),
(656, 'U-FRESH', '500', '700', 1, 700, '2024-07-30 12:05:28', 'Hils Imidi');
INSERT INTO `vente` (`id`, `nom_produit`, `prix_achat`, `prix_vente`, `quantite`, `montant_total`, `date_vente`, `vendeur`) VALUES
(657, 'Lulu pt vert', '700', '1000', 1, 1000, '2024-07-30 12:05:42', 'Hils Imidi'),
(658, 'Vain amour', '1300', '1500', 2, 3000, '2024-07-30 12:05:54', 'Hils Imidi'),
(659, 'Kolo mboka', '1300', '1500', 2, 3000, '2024-07-30 12:06:32', 'Hils Imidi'),
(660, 'Cuca bouteille', '1500', '2000', 1, 2000, '2024-07-30 12:06:53', 'Hils Imidi'),
(661, 'Biscuit mariamar', '750', '1000', 1, 1000, '2024-07-30 12:07:15', 'Hils Imidi'),
(662, 'Mirinda plastique', '900', '1000', 3, 3000, '2024-07-30 12:07:36', 'Hils Imidi'),
(663, 'ORANGINA', '900', '1000', 3, 3000, '2024-07-30 12:07:52', 'Hils Imidi'),
(664, 'Pepsi plastique', '900', '1000', 1, 1000, '2024-07-30 12:08:11', 'Hils Imidi'),
(665, 'Eau bidon', '630', '1000', 12, 12000, '2024-07-30 22:39:43', 'Hils Imidi'),
(666, 'Alpina', '500', '500', 12, 6000, '2024-07-30 22:42:12', 'Hils Imidi'),
(667, 'Swista', '500', '700', 1, 700, '2024-07-30 22:42:34', 'Hils Imidi'),
(668, 'Festa energy', '700', '1000', 5, 5000, '2024-07-30 22:43:36', 'Hils Imidi'),
(669, 'Festa rouge', '600', '700', 2, 1400, '2024-07-30 22:44:30', 'Hils Imidi'),
(670, 'Festa noir ', '600', '700', 1, 700, '2024-07-30 22:44:58', 'Hils Imidi'),
(671, 'zesta ananas', '800', '1000', 4, 4000, '2024-07-30 22:45:34', 'Hils Imidi'),
(672, 'zesta rouge', '800', '1000', 2, 2000, '2024-07-30 22:46:30', 'Hils Imidi'),
(673, 'Zesta cola', '800', '1000', 1, 1000, '2024-07-30 22:47:31', 'Hils Imidi'),
(674, 'Zesta orange', '800', '1000', 2, 2000, '2024-07-30 22:48:10', 'Hils Imidi'),
(675, 'zesta mangue', '800', '1000', 1, 1000, '2024-07-30 22:48:39', 'Hils Imidi'),
(676, 'Zesta mangue 1L', '1400', '2000', 1, 2000, '2024-07-30 22:49:11', 'Hils Imidi'),
(677, 'Coca', '1700', '2500', 1, 2500, '2024-07-30 22:49:41', 'Hils Imidi'),
(678, 'U-FRESH', '500', '700', 1, 700, '2024-07-30 22:49:58', 'Hils Imidi'),
(679, 'Lulu pt vert', '700', '1000', 1, 1000, '2024-07-30 22:50:28', 'Hils Imidi'),
(680, 'Boss', '1800', '2300', 1, 2300, '2024-07-30 22:50:45', 'Hils Imidi'),
(681, 'Villa Petit', '2000', '2500', 1, 2500, '2024-07-30 22:51:05', 'Hils Imidi'),
(682, 'Vain amour', '1300', '1500', 3, 4500, '2024-07-30 22:51:29', 'Hils Imidi'),
(683, 'Kolo mboka', '1300', '1500', 1, 1500, '2024-07-30 22:51:38', 'Hils Imidi'),
(684, 'Dopel', '1700', '2500', 3, 7500, '2024-07-30 22:51:57', 'Hils Imidi'),
(685, 'Zesta marakuja', '800', '1000', 3, 3000, '2024-07-30 22:52:20', 'Hils Imidi'),
(686, 'Pepsi plastique', '900', '1000', 1, 1000, '2024-07-30 22:52:44', 'Hils Imidi'),
(687, 'Fanta plasique', '900', '1000', 4, 4000, '2024-07-30 22:53:04', 'Hils Imidi'),
(688, 'ORANGINA', '900', '1000', 4, 4000, '2024-07-30 22:53:23', 'Hils Imidi'),
(689, 'Mirinda plastique', '900', '1000', 2, 2000, '2024-07-30 22:53:39', 'Hils Imidi'),
(690, 'POWER JAUNE', '1400', '1600', 1, 1600, '2024-07-30 22:54:06', 'Hils Imidi'),
(691, 'Alpina', '500', '500', 3, 1500, '2024-07-31 08:02:14', 'Hils Imidi'),
(692, 'Eau bidon', '630', '1000', 12, 12000, '2024-08-01 23:08:30', 'Hils Imidi'),
(693, 'Eau bidon', '630', '1000', 12, 12000, '2024-08-03 12:16:35', 'Hils Imidi'),
(694, 'Alpina', '500', '500', 21, 10500, '2024-08-03 12:16:58', 'Hils Imidi'),
(695, 'Swista', '500', '700', 2, 1400, '2024-08-03 12:17:17', 'Hils Imidi'),
(696, 'Festa energy', '700', '1000', 6, 6000, '2024-08-03 12:17:38', 'Hils Imidi'),
(697, 'Festa rouge', '600', '700', 1, 700, '2024-08-03 12:18:02', 'Hils Imidi'),
(698, 'Festa energy', '700', '1000', 1, 1000, '2024-08-03 12:18:32', 'Hils Imidi'),
(699, 'zesta ananas', '800', '1000', 5, 5000, '2024-08-03 12:19:08', 'Hils Imidi'),
(700, 'Zesta orange', '800', '1000', 2, 2000, '2024-08-03 12:19:45', 'Hils Imidi'),
(701, 'Zesta mangue 1L', '1400', '2000', 1, 2000, '2024-08-03 12:20:14', 'Hils Imidi'),
(702, 'Coca', '1700', '2500', 1, 2500, '2024-08-03 12:20:33', 'Hils Imidi'),
(703, 'Fanta', '1600', '2500', 3, 7500, '2024-08-03 12:20:54', 'Hils Imidi'),
(704, 'Sprite', '1700', '2500', 1, 2500, '2024-08-03 12:21:07', 'Hils Imidi'),
(705, 'Bavaria', '3400', '4500', 1, 4500, '2024-08-03 12:21:20', 'Hils Imidi'),
(706, 'Lulu gr rouge', '3000', '3500', 1, 3500, '2024-08-03 12:21:42', 'Hils Imidi'),
(707, 'Lulu pt vert', '700', '1000', 1, 1000, '2024-08-03 12:21:56', 'Hils Imidi'),
(708, 'Vain amour', '1300', '1500', 6, 9000, '2024-08-03 12:22:15', 'Hils Imidi'),
(709, 'Kolo mboka', '1300', '1500', 6, 9000, '2024-08-03 12:22:32', 'Hils Imidi'),
(710, 'ORANGINA', '900', '1000', 1, 1000, '2024-08-03 12:22:51', 'Hils Imidi'),
(711, 'Pepsi plastique', '900', '1000', 1, 1000, '2024-08-03 12:23:16', 'Hils Imidi'),
(712, 'Pepsi plastique', '900', '1000', 2, 2000, '2024-08-03 12:23:35', 'Hils Imidi'),
(713, 'Zesta marakuja', '800', '1000', 1, 1000, '2024-08-03 12:24:05', 'Hils Imidi'),
(714, 'POWER ROUGE', '2400', '3000', 1, 3000, '2024-08-03 12:24:26', 'Hils Imidi'),
(715, 'Eau bidon', '630', '1000', 12, 12000, '2024-08-03 12:33:21', 'Hils Imidi'),
(716, 'Alpina', '500', '500', 17, 8500, '2024-08-03 12:33:39', 'Hils Imidi'),
(717, 'Swista', '500', '700', 1, 700, '2024-08-03 12:33:53', 'Hils Imidi'),
(718, 'Festa energy', '700', '1000', 3, 3000, '2024-08-03 12:34:17', 'Hils Imidi'),
(719, 'Festa rouge', '600', '700', 1, 700, '2024-08-03 12:35:11', 'Hils Imidi'),
(720, 'Festa noir ', '600', '700', 1, 700, '2024-08-03 12:35:45', 'Hils Imidi'),
(721, 'Festa orange', '600', '700', 1, 700, '2024-08-03 12:36:14', 'Hils Imidi'),
(722, 'zesta ananas', '800', '1000', 6, 6000, '2024-08-03 12:36:38', 'Hils Imidi'),
(723, 'Zesta orange', '800', '1000', 1, 1000, '2024-08-03 12:38:52', 'Hils Imidi'),
(724, 'Zesta banane', '700', '1000', 2, 2000, '2024-08-03 12:39:41', 'Hils Imidi'),
(725, 'XXL', '1400', '2000', 1, 2000, '2024-08-03 12:39:58', 'Hils Imidi'),
(726, 'U-FRESH', '500', '700', 3, 2100, '2024-08-03 12:40:15', 'Hils Imidi'),
(727, 'Vain amour', '1300', '1500', 1, 1500, '2024-08-03 12:40:29', 'Hils Imidi'),
(728, 'Kolo mboka', '1300', '1500', 1, 1500, '2024-08-03 12:40:42', 'Hils Imidi'),
(729, 'Zesta marakuja', '800', '1000', 4, 4000, '2024-08-03 12:41:02', 'Hils Imidi'),
(730, 'Fanta plasique', '900', '1000', 4, 4000, '2024-08-03 12:41:19', 'Hils Imidi'),
(731, 'Pepsi plastique', '900', '1000', 2, 2000, '2024-08-03 12:41:37', 'Hils Imidi'),
(732, 'ORANGINA', '900', '1000', 3, 3000, '2024-08-03 12:41:58', 'Hils Imidi'),
(733, 'Savana', '3200', '4000', 1, 4000, '2024-08-03 12:42:15', 'Hils Imidi'),
(734, 'Mirinda plastique', '900', '1000', 1, 1000, '2024-08-03 12:42:28', 'Hils Imidi'),
(735, 'POWER ROUGE', '2400', '3000', 1, 3000, '2024-08-03 12:48:32', 'Hils Imidi'),
(736, 'Eau bidon', '630', '1000', 6, 6000, '2024-08-03 12:55:38', 'Hils Imidi'),
(737, 'Alpina', '500', '500', 14, 7000, '2024-08-03 12:57:10', 'Hils Imidi'),
(738, 'Swista', '500', '700', 1, 700, '2024-08-03 12:57:27', 'Hils Imidi'),
(739, 'Festa energy', '700', '1000', 3, 3000, '2024-08-03 12:57:53', 'Hils Imidi'),
(740, 'Festa ananas', '600', '700', 1, 700, '2024-08-03 12:58:14', 'Hils Imidi'),
(741, 'Festa rouge', '600', '700', 1, 700, '2024-08-03 12:58:43', 'Hils Imidi'),
(742, 'Festa noir ', '600', '700', 2, 1400, '2024-08-03 12:59:07', 'Hils Imidi'),
(743, 'Festa orange grd', '750', '1000', 1, 1000, '2024-08-03 13:05:59', 'Hils Imidi'),
(744, 'zesta ananas', '800', '1000', 1, 1000, '2024-08-03 13:06:19', 'Hils Imidi'),
(745, 'zesta mangue', '800', '1000', 1, 1000, '2024-08-03 13:06:41', 'Hils Imidi'),
(746, 'XXL', '1400', '2000', 1, 2000, '2024-08-03 13:07:04', 'Hils Imidi'),
(747, 'U-FRESH', '500', '700', 1, 700, '2024-08-03 13:07:21', 'Hils Imidi'),
(748, 'Boss', '1800', '2300', 1, 2300, '2024-08-03 13:07:34', 'Hils Imidi'),
(749, 'Kolo mboka', '1300', '1500', 2, 3000, '2024-08-03 13:08:18', 'Hils Imidi'),
(750, 'ORANGINA', '900', '1000', 4, 4000, '2024-08-03 13:09:43', 'Hils Imidi'),
(751, 'Coca plasique', '900', '1000', 5, 5000, '2024-08-03 13:13:14', 'Hils Imidi'),
(753, 'Eau bidon', '630', '1000', 10, 10000, '2024-08-05 13:12:17', 'Hils Imidi'),
(754, 'Alpina', '500', '500', 14, 7000, '2024-08-05 13:12:28', 'Hils Imidi'),
(755, 'Festa energy', '700', '1000', 11, 11000, '2024-08-05 13:12:51', 'Hils Imidi'),
(756, 'Festa rouge', '600', '700', 1, 700, '2024-08-05 13:20:19', 'Hils Imidi'),
(757, 'Festa noir ', '600', '700', 1, 700, '2024-08-05 13:20:51', 'Hils Imidi'),
(758, 'Festa orange', '600', '700', 3, 2100, '2024-08-05 13:21:07', 'Hils Imidi'),
(759, 'zesta ananas', '800', '1000', 3, 3000, '2024-08-05 13:21:28', 'Hils Imidi'),
(760, 'zesta rouge', '800', '1000', 2, 2000, '2024-08-05 13:21:51', 'Hils Imidi'),
(761, 'Zesta cola', '800', '1000', 4, 4000, '2024-08-05 13:22:34', 'Hils Imidi'),
(762, 'zesta mangue', '800', '1000', 2, 2000, '2024-08-05 13:22:57', 'Hils Imidi'),
(763, 'Fanta', '1600', '2500', 1, 2500, '2024-08-05 13:23:24', 'Hils Imidi'),
(764, 'XXL', '1400', '2000', 2, 4000, '2024-08-05 13:23:37', 'Hils Imidi'),
(765, 'U-FRESH', '500', '700', 1, 700, '2024-08-05 13:23:49', 'Hils Imidi'),
(766, 'Lulu pt vert', '700', '1000', 1, 1000, '2024-08-05 13:24:08', 'Hils Imidi'),
(767, 'Villa Petit', '2000', '2500', 2, 5000, '2024-08-05 13:24:24', 'Hils Imidi'),
(768, 'Vain amour', '1300', '1500', 3, 4500, '2024-08-05 13:24:46', 'Hils Imidi'),
(769, 'Kolo mboka', '1300', '1500', 6, 9000, '2024-08-05 13:25:02', 'Hils Imidi'),
(770, 'Coca plasique', '900', '1000', 3, 3000, '2024-08-05 13:25:34', 'Hils Imidi'),
(771, 'Zesta marakuja', '800', '1000', 5, 5000, '2024-08-05 13:26:02', 'Hils Imidi'),
(772, 'ORANGINA', '900', '1000', 1, 1000, '2024-08-05 13:26:20', 'Hils Imidi'),
(773, 'POWER ROUGE', '2400', '3000', 1, 3000, '2024-08-05 13:26:35', 'Hils Imidi'),
(774, 'ORANGINA', '900', '1000', 3, 3000, '2024-08-05 13:26:58', 'Hils Imidi'),
(775, 'Eau bidon', '630', '1000', 8, 8000, '2024-08-05 13:35:07', 'Hils Imidi'),
(776, 'Alpina', '500', '500', 25, 12500, '2024-08-05 13:35:21', 'Hils Imidi'),
(777, 'Swista', '500', '700', 1, 700, '2024-08-05 13:37:08', 'Hils Imidi'),
(778, 'Festa energy', '700', '1000', 7, 7000, '2024-08-05 13:37:42', 'Hils Imidi'),
(779, 'Festa ananas', '600', '700', 2, 1400, '2024-08-05 13:38:11', 'Hils Imidi'),
(780, 'Festa rouge', '600', '700', 2, 1400, '2024-08-05 13:38:31', 'Hils Imidi'),
(781, 'zesta ananas', '800', '1000', 2, 2000, '2024-08-05 13:38:47', 'Hils Imidi'),
(782, 'zesta rouge', '800', '1000', 3, 3000, '2024-08-05 13:39:08', 'Hils Imidi'),
(783, 'Zesta cola', '800', '1000', 3, 3000, '2024-08-05 13:39:38', 'Hils Imidi'),
(784, 'zesta mangue', '800', '1000', 4, 4000, '2024-08-05 13:40:01', 'Hils Imidi'),
(785, 'Coca', '1700', '2500', 2, 5000, '2024-08-05 13:40:23', 'Hils Imidi'),
(786, 'Fanta', '1600', '2500', 1, 2500, '2024-08-05 13:40:47', 'Hils Imidi'),
(787, 'Bavaria', '3400', '4500', 1, 4500, '2024-08-05 13:41:14', 'Hils Imidi'),
(788, 'U-FRESH', '500', '700', 2, 1400, '2024-08-05 13:41:31', 'Hils Imidi'),
(789, 'Boss', '1800', '2300', 2, 4600, '2024-08-05 13:43:06', 'Hils Imidi'),
(790, 'Villa Petit', '2000', '2500', 2, 5000, '2024-08-05 13:43:29', 'Hils Imidi'),
(791, 'Vain amour', '1300', '1500', 3, 4500, '2024-08-05 13:43:45', 'Hils Imidi'),
(792, 'Kolo mboka', '1300', '1500', 3, 4500, '2024-08-05 13:43:58', 'Hils Imidi'),
(793, 'Coca plasique', '900', '1000', 2, 2000, '2024-08-05 13:44:21', 'Hils Imidi'),
(794, 'ORANGINA', '900', '1000', 4, 4000, '2024-08-05 13:44:31', 'Hils Imidi'),
(795, 'Zesta marakuja', '800', '1000', 2, 2000, '2024-08-05 13:45:12', 'Hils Imidi'),
(796, 'Biscuit mariamar', '750', '1000', 3, 3000, '2024-08-05 13:45:36', 'Hils Imidi'),
(797, 'Angel', '1100', '1500', 1, 1500, '2024-08-05 13:51:08', 'Hils Imidi'),
(798, 'Eau bidon', '630', '1000', 15, 15000, '2024-08-05 23:11:42', 'Hils Imidi'),
(799, 'Eau bidon', '630', '1000', 15, 15000, '2024-08-06 21:43:37', 'Hils Imidi'),
(800, 'Alpina', '500', '500', 26, 13000, '2024-08-06 21:43:55', 'Hils Imidi'),
(801, 'Swista', '500', '700', 6, 4200, '2024-08-06 21:44:17', 'Hils Imidi'),
(802, 'Festa energy', '700', '1000', 5, 5000, '2024-08-06 21:45:02', 'Hils Imidi'),
(803, 'Festa ananas', '600', '700', 2, 1400, '2024-08-06 21:45:24', 'Hils Imidi'),
(804, 'zesta ananas', '800', '1000', 3, 3000, '2024-08-06 21:45:40', 'Hils Imidi'),
(805, 'zesta rouge', '800', '1000', 1, 1000, '2024-08-06 21:45:56', 'Hils Imidi'),
(806, 'Zesta cola', '800', '1000', 3, 3000, '2024-08-06 21:46:20', 'Hils Imidi'),
(807, 'Fanta', '1600', '2500', 1, 2500, '2024-08-06 21:46:37', 'Hils Imidi'),
(808, 'XXL', '1400', '2000', 1, 2000, '2024-08-06 21:46:49', 'Hils Imidi'),
(809, 'U-FRESH', '500', '700', 2, 1400, '2024-08-06 21:47:00', 'Hils Imidi'),
(810, 'Lulu pt vert', '700', '1000', 1, 1000, '2024-08-06 21:47:22', 'Hils Imidi'),
(811, 'Boss', '1800', '2300', 1, 2300, '2024-08-06 21:47:43', 'Hils Imidi'),
(812, 'Splendeur', '1800', '2300', 1, 2300, '2024-08-06 21:47:52', 'Hils Imidi'),
(813, 'Splendeur', '1800', '2300', 2, 4600, '2024-08-06 21:48:05', 'Hils Imidi'),
(814, 'Kolo mboka', '1300', '1500', 2, 3000, '2024-08-06 21:48:18', 'Hils Imidi'),
(815, 'Angel', '1100', '1500', 1, 1500, '2024-08-06 21:48:33', 'Hils Imidi'),
(816, 'POWER ROUGE', '2400', '3000', 1, 3000, '2024-08-06 21:48:46', 'Hils Imidi'),
(817, 'ORANGINA', '900', '1000', 3, 3000, '2024-08-06 21:48:59', 'Hils Imidi'),
(818, 'Coca plasique', '900', '1000', 7, 7000, '2024-08-06 21:49:27', 'Hils Imidi'),
(819, 'Zesta marakuja', '800', '1000', 1, 1000, '2024-08-06 21:49:56', 'Hils Imidi'),
(820, 'Eau bidon', '630', '1000', 15, 15000, '2024-08-09 19:17:40', 'Hils Imidi'),
(821, 'Alpina', '500', '500', 23, 11500, '2024-08-09 19:17:59', 'Hils Imidi'),
(822, 'Swista', '500', '700', 6, 4200, '2024-08-09 19:18:26', 'Hils Imidi'),
(823, 'Festa orange', '600', '700', 4, 2800, '2024-08-09 19:18:56', 'Hils Imidi'),
(824, 'Festa energy', '700', '1000', 2, 2000, '2024-08-09 19:19:14', 'Hils Imidi'),
(825, 'Festa ananas', '600', '700', 3, 2100, '2024-08-09 19:19:34', 'Hils Imidi'),
(826, 'Festa rouge', '600', '700', 3, 2100, '2024-08-09 19:19:57', 'Hils Imidi'),
(827, 'Festa noir ', '600', '700', 1, 700, '2024-08-09 19:20:20', 'Hils Imidi'),
(828, 'zesta ananas', '800', '1000', 4, 4000, '2024-08-09 19:20:44', 'Hils Imidi'),
(829, 'Zesta cola', '800', '1000', 1, 1000, '2024-08-09 19:21:05', 'Hils Imidi'),
(830, 'Zesta orange', '800', '1000', 1, 1000, '2024-08-09 19:21:23', 'Hils Imidi'),
(831, 'zesta mangue', '800', '1000', 1, 1000, '2024-08-09 19:21:40', 'Hils Imidi'),
(832, 'XXL', '1400', '2000', 2, 4000, '2024-08-09 19:21:53', 'Hils Imidi'),
(833, 'U-FRESH', '500', '700', 7, 4900, '2024-08-09 19:22:06', 'Hils Imidi'),
(834, 'Boss', '1800', '2300', 2, 4600, '2024-08-09 19:22:19', 'Hils Imidi'),
(835, 'Splendeur', '1800', '2300', 2, 4600, '2024-08-09 19:22:50', 'Hils Imidi'),
(836, 'Kolo mboka', '1300', '1500', 2, 3000, '2024-08-09 19:23:12', 'Hils Imidi'),
(837, 'Reserve 7', '6000', '7000', 1, 7000, '2024-08-09 19:23:27', 'Hils Imidi'),
(838, 'Coca plasique', '900', '1000', 2, 2000, '2024-08-09 19:23:46', 'Hils Imidi'),
(839, 'Zesta marakuja', '800', '1000', 5, 5000, '2024-08-09 19:24:02', 'Hils Imidi'),
(840, 'ORANGINA', '900', '1000', 1, 1000, '2024-08-09 19:24:14', 'Hils Imidi'),
(841, 'Pepsi plastique', '900', '1000', 1, 1000, '2024-08-09 19:24:39', 'Hils Imidi'),
(842, 'Pastis', '1800', '2300', 1, 2300, '2024-08-09 19:24:52', 'Hils Imidi'),
(843, 'Mirinda plastique', '900', '1000', 1, 1000, '2024-08-09 19:25:12', 'Hils Imidi'),
(844, 'Eau bidon', '630', '1000', 11, 11000, '2024-08-09 19:28:00', 'Hils Imidi'),
(845, 'Alpina', '500', '500', 12, 6000, '2024-08-09 19:28:16', 'Hils Imidi'),
(846, 'Swista', '500', '700', 1, 700, '2024-08-09 19:28:33', 'Hils Imidi'),
(847, 'Festa energy', '700', '1000', 5, 5000, '2024-08-09 19:28:53', 'Hils Imidi'),
(848, 'Festa rouge', '600', '700', 1, 700, '2024-08-09 19:29:18', 'Hils Imidi'),
(849, 'Festa noir ', '600', '700', 3, 2100, '2024-08-09 19:30:02', 'Hils Imidi'),
(850, 'zesta ananas', '800', '1000', 4, 4000, '2024-08-09 19:30:29', 'Hils Imidi'),
(851, 'zesta mangue', '800', '1000', 1, 1000, '2024-08-09 19:30:54', 'Hils Imidi'),
(852, 'Fanta', '1600', '2500', 1, 2500, '2024-08-09 19:31:21', 'Hils Imidi'),
(853, 'Sprite', '1700', '2500', 1, 2500, '2024-08-09 19:31:42', 'Hils Imidi'),
(854, 'XXL', '1400', '2000', 1, 2000, '2024-08-09 19:31:58', 'Hils Imidi'),
(855, 'U-FRESH', '500', '700', 5, 3500, '2024-08-09 19:32:14', 'Hils Imidi'),
(856, 'Kolo mboka', '1300', '1500', 4, 6000, '2024-08-09 19:32:30', 'Hils Imidi'),
(857, 'Mirinda plastique', '900', '1000', 2, 2000, '2024-08-09 19:32:54', 'Hils Imidi'),
(858, 'Mirinda', '1900', '2800', 2, 5600, '2024-08-09 19:33:11', 'Hils Imidi'),
(859, 'Festa tangawizi', '600', '1000', 1, 1000, '2024-08-09 19:33:28', 'Hils Imidi'),
(860, 'Fanta plasique', '900', '1000', 1, 1000, '2024-08-09 19:33:49', 'Hils Imidi'),
(861, 'Zesta marakuja', '800', '1000', 1, 1000, '2024-08-09 19:34:05', 'Hils Imidi'),
(862, 'Pepsi plastique', '900', '1000', 1, 1000, '2024-08-09 19:34:18', 'Hils Imidi'),
(863, 'Eau bidon', '630', '1000', 11, 11000, '2024-08-09 19:39:14', 'Hils Imidi'),
(864, 'Alpina', '500', '500', 7, 3500, '2024-08-09 19:39:29', 'Hils Imidi'),
(865, 'Swista', '500', '700', 1, 700, '2024-08-09 19:39:42', 'Hils Imidi'),
(866, 'Festa energy', '700', '1000', 3, 3000, '2024-08-09 19:40:00', 'Hils Imidi'),
(867, 'Festa vert', '600', '700', 1, 700, '2024-08-09 19:40:18', 'Hils Imidi'),
(868, 'zesta ananas', '800', '1000', 6, 6000, '2024-08-09 19:40:43', 'Hils Imidi'),
(869, 'zesta rouge', '800', '1000', 4, 4000, '2024-08-09 19:41:05', 'Hils Imidi'),
(870, 'XXL', '1400', '2000', 1, 2000, '2024-08-09 19:41:20', 'Hils Imidi'),
(871, 'U-FRESH', '500', '700', 1, 700, '2024-08-09 19:41:37', 'Hils Imidi'),
(872, 'Splendeur', '1800', '2300', 1, 2300, '2024-08-09 19:41:51', 'Hils Imidi'),
(873, 'Savana', '3200', '4000', 1, 4000, '2024-08-09 19:42:04', 'Hils Imidi'),
(874, 'Coca plasique', '900', '1000', 1, 1000, '2024-08-09 19:42:19', 'Hils Imidi'),
(875, 'Fanta plasique', '900', '1000', 1, 1000, '2024-08-09 19:42:38', 'Hils Imidi'),
(876, 'Zesta marakuja', '800', '1000', 6, 6000, '2024-08-09 19:43:10', 'Hils Imidi'),
(877, 'POWER JAUNE', '1400', '1600', 2, 3200, '2024-08-09 19:43:30', 'Hils Imidi'),
(878, 'Pepsi plastique', '900', '1000', 1, 1000, '2024-08-09 19:43:47', 'Hils Imidi'),
(879, 'Eau bidon', '630', '1000', 8, 8000, '2024-08-11 23:41:15', 'Hils Imidi'),
(880, 'Eau bidon', '630', '1000', 8, 8000, '2024-08-11 23:44:43', 'Hils Imidi'),
(881, 'Splendeur', '1800', '2300', 8, 18400, '2024-08-11 23:46:54', 'Hils Imidi'),
(882, 'Eau bidon', '630', '1000', 12, 12000, '2024-08-28 09:15:18', 'Hils Imidi'),
(883, 'Alpina', '500', '500', 30, 15000, '2024-08-28 09:15:36', 'Hils Imidi'),
(884, 'Swista', '500', '700', 1, 700, '2024-08-28 09:15:56', 'Hils Imidi'),
(885, 'Festa energy', '700', '1000', 4, 4000, '2024-08-28 09:16:57', 'Hils Imidi'),
(886, 'Zesta energy', '590', '1000', 4, 4000, '2024-08-28 09:17:58', 'Hils Imidi'),
(887, 'zesta ananas', '800', '1000', 4, 4000, '2024-08-28 09:18:23', 'Hils Imidi'),
(888, 'Zesta cola', '800', '1000', 4, 4000, '2024-08-28 09:18:53', 'Hils Imidi'),
(889, 'Zesta orange', '800', '1000', 1, 1000, '2024-08-28 09:19:15', 'Hils Imidi'),
(890, 'zesta mangue', '800', '1000', 1, 1000, '2024-08-28 09:19:29', 'Hils Imidi'),
(891, 'Fanta', '1600', '2500', 4, 10000, '2024-08-28 09:19:58', 'Hils Imidi'),
(892, 'U-FRESH', '440', '700', 5, 3500, '2024-08-28 09:20:33', 'Hils Imidi'),
(893, 'Sprite', '1700', '2500', 1, 2500, '2024-08-28 09:20:44', 'Hils Imidi'),
(894, 'Vain amour', '1300', '1500', 2, 3000, '2024-08-28 09:20:58', 'Hils Imidi'),
(895, 'Kolo mboka', '1300', '1500', 1, 1500, '2024-08-28 09:21:16', 'Hils Imidi'),
(896, 'Mokonzi', '1800', '2000', 3, 6000, '2024-08-28 09:21:47', 'Hils Imidi'),
(897, 'CUCA', '1500', '2000', 2, 4000, '2024-08-28 09:22:05', 'Hils Imidi'),
(898, 'Pepsi plastique', '900', '1000', 7, 7000, '2024-08-28 09:22:31', 'Hils Imidi'),
(899, '7up plastique', '900', '1000', 1, 1000, '2024-08-28 09:22:56', 'Hils Imidi'),
(900, 'Mirinda plastique', '900', '1000', 4, 4000, '2024-08-28 09:23:10', 'Hils Imidi'),
(901, 'ORANGINA', '900', '1000', 2, 2000, '2024-08-28 09:23:31', 'Hils Imidi'),
(902, 'Fanta plasique', '900', '1000', 3, 3000, '2024-08-28 09:23:51', 'Hils Imidi'),
(903, 'Dopel', '1700', '2500', 2, 5000, '2024-08-28 09:24:10', 'Hils Imidi'),
(904, 'Festa ananas', '583', '700', 1, 700, '2024-08-28 09:29:25', 'Hils Imidi'),
(905, 'Eau bidon', '630', '1000', 6, 6000, '2024-08-29 09:59:43', 'Hils Imidi'),
(906, 'Alpina', '500', '500', 17, 8500, '2024-08-29 10:00:02', 'Hils Imidi'),
(907, 'Festa energy', '700', '1000', 2, 2000, '2024-08-29 10:00:37', 'Hils Imidi'),
(908, 'Zesta energy', '590', '1000', 1, 1000, '2024-08-29 10:00:58', 'Hils Imidi'),
(909, 'zesta ananas', '800', '1000', 3, 3000, '2024-08-29 10:01:16', 'Hils Imidi'),
(910, 'zesta rouge', '800', '1000', 1, 1000, '2024-08-29 10:01:42', 'Hils Imidi'),
(911, 'Zesta cola', '800', '1000', 2, 2000, '2024-08-29 10:02:04', 'Hils Imidi'),
(912, 'Fanta', '1600', '2500', 1, 2500, '2024-08-29 10:02:20', 'Hils Imidi'),
(913, 'Mirinda', '1900', '2800', 1, 2800, '2024-08-29 10:02:33', 'Hils Imidi'),
(914, 'U-FRESH', '440', '700', 4, 2800, '2024-08-29 10:02:47', 'Hils Imidi'),
(915, 'XXL', '1400', '2000', 1, 2000, '2024-08-29 10:03:10', 'Hils Imidi'),
(916, 'Boss', '1800', '2300', 1, 2300, '2024-08-29 10:03:20', 'Hils Imidi'),
(917, 'Splendeur', '1800', '2300', 2, 4600, '2024-08-29 10:03:33', 'Hils Imidi'),
(918, 'Vain amour', '1300', '1500', 1, 1500, '2024-08-29 10:04:01', 'Hils Imidi'),
(919, 'Kolo mboka', '1300', '1500', 2, 3000, '2024-08-29 10:04:35', 'Hils Imidi'),
(920, 'Mokonzi', '1800', '2000', 1, 2000, '2024-08-29 10:04:55', 'Hils Imidi'),
(921, 'Coca plasique', '900', '1000', 2, 2000, '2024-08-29 10:05:15', 'Hils Imidi'),
(922, 'Pepsi plastique', '900', '1000', 19, 19000, '2024-08-29 10:05:37', 'Hils Imidi'),
(923, 'Zesta marakuja', '800', '1000', 2, 2000, '2024-08-29 10:06:16', 'Hils Imidi'),
(924, 'Mirinda plastique', '900', '1000', 6, 6000, '2024-08-29 10:06:35', 'Hils Imidi'),
(925, 'Festa tangawizi', '600', '1000', 1, 1000, '2024-08-29 10:06:54', 'Hils Imidi'),
(926, 'ORANGINA', '900', '1000', 3, 3000, '2024-08-29 10:07:10', 'Hils Imidi'),
(927, 'zesta mangue', '800', '1000', 1, 1000, '2024-08-29 10:12:36', 'Hils Imidi'),
(928, 'Eau bidon', '630', '1000', 7, 7000, '2024-08-30 09:48:39', 'Hils Imidi'),
(929, 'Alpina', '500', '500', 39, 19500, '2024-08-30 09:48:53', 'Hils Imidi'),
(930, 'Festa energy', '700', '1000', 8, 8000, '2024-08-30 09:49:19', 'Hils Imidi'),
(931, 'Festa orange', '600', '700', 1, 700, '2024-08-30 09:49:39', 'Hils Imidi'),
(932, 'Zesta energy', '590', '1000', 3, 3000, '2024-08-30 09:50:12', 'Hils Imidi'),
(933, 'zesta ananas', '800', '1000', 2, 2000, '2024-08-30 09:50:18', 'Hils Imidi'),
(934, 'Zesta orange', '800', '1000', 1, 1000, '2024-08-30 09:50:45', 'Hils Imidi'),
(935, 'zesta mangue', '800', '1000', 1, 1000, '2024-08-30 09:51:02', 'Hils Imidi'),
(936, 'Fanta', '1600', '2500', 1, 2500, '2024-08-30 09:51:14', 'Hils Imidi'),
(937, 'XXL', '1400', '2000', 3, 6000, '2024-08-30 09:51:23', 'Hils Imidi'),
(938, 'U-FRESH', '440', '700', 2, 1400, '2024-08-30 09:51:32', 'Hils Imidi'),
(939, 'Lulu pt vert', '700', '1000', 3, 3000, '2024-08-30 09:51:57', 'Hils Imidi'),
(940, 'Splendeur', '1800', '2300', 2, 4600, '2024-08-30 09:52:35', 'Hils Imidi'),
(941, 'Kolo mboka', '1300', '1500', 1, 1500, '2024-08-30 09:52:49', 'Hils Imidi'),
(942, 'Vain amour', '1300', '1500', 1, 1500, '2024-08-30 09:53:02', 'Hils Imidi'),
(943, 'CUCA', '1500', '2000', 1, 2000, '2024-08-30 09:53:12', 'Hils Imidi'),
(944, 'Mirinda plastique', '900', '1000', 3, 3000, '2024-08-30 09:53:29', 'Hils Imidi'),
(945, 'Shaka', '3000', '3500', 1, 3500, '2024-08-30 09:53:42', 'Hils Imidi'),
(946, 'Pepsi plastique', '900', '1000', 15, 15000, '2024-08-30 09:53:58', 'Hils Imidi'),
(947, 'Zesta marakuja', '800', '1000', 2, 2000, '2024-08-30 09:54:22', 'Hils Imidi'),
(948, 'POWER JAUNE', '1400', '1600', 1, 1600, '2024-08-30 09:54:43', 'Hils Imidi'),
(949, 'ORANGINA', '900', '1000', 3, 3000, '2024-08-30 09:54:53', 'Hils Imidi'),
(950, 'Fanta plasique', '900', '1000', 1, 1000, '2024-08-30 09:55:15', 'Hils Imidi'),
(951, 'Coca plasique', '900', '1000', 1, 1000, '2024-08-30 09:55:33', 'Hils Imidi'),
(952, 'Eau bidon', '630', '1000', 15, 15000, '2024-08-31 16:30:57', 'Hils Imidi'),
(953, 'Alpina', '500', '500', 18, 9000, '2024-08-31 16:31:15', 'Hils Imidi'),
(954, 'Alpina', '500', '500', 9, 4500, '2024-08-31 16:31:43', 'Hils Imidi'),
(955, 'Festa energy', '700', '1000', 5, 5000, '2024-08-31 16:32:10', 'Hils Imidi'),
(956, 'Zesta energy', '590', '1000', 2, 2000, '2024-08-31 16:32:30', 'Hils Imidi'),
(957, 'zesta rouge', '800', '1000', 1, 1000, '2024-08-31 16:32:42', 'Hils Imidi'),
(958, 'Zesta cola', '800', '1000', 1, 1000, '2024-08-31 16:32:57', 'Hils Imidi'),
(959, 'Zesta orange', '800', '1000', 1, 1000, '2024-08-31 16:33:10', 'Hils Imidi'),
(960, 'Fanta', '1600', '2500', 1, 2500, '2024-08-31 16:33:32', 'Hils Imidi'),
(961, 'Bavaria', '3400', '4500', 1, 4500, '2024-08-31 16:33:43', 'Hils Imidi'),
(962, 'U-FRESH', '440', '700', 3, 2100, '2024-08-31 16:33:55', 'Hils Imidi'),
(963, 'Splendeur', '1800', '2300', 4, 9200, '2024-08-31 16:34:09', 'Hils Imidi'),
(964, 'Vain amour', '1300', '1500', 5, 7500, '2024-08-31 16:34:37', 'Hils Imidi'),
(965, 'Kolo mboka', '1300', '1500', 2, 3000, '2024-08-31 16:34:49', 'Hils Imidi'),
(966, 'CUCA', '1500', '2000', 4, 8000, '2024-08-31 16:35:05', 'Hils Imidi'),
(967, 'Mokonzi', '1800', '2000', 2, 4000, '2024-08-31 16:35:25', 'Hils Imidi'),
(968, 'Biscuit mariamar', '750', '1000', 2, 2000, '2024-08-31 16:36:08', 'Hils Imidi'),
(969, 'Pepsi plastique', '900', '1000', 14, 14000, '2024-08-31 16:36:27', 'Hils Imidi'),
(970, 'ORANGINA', '900', '1000', 8, 8000, '2024-08-31 16:37:04', 'Hils Imidi'),
(971, 'POWER ROUGE', '2400', '3000', 1, 3000, '2024-08-31 16:37:32', 'Hils Imidi'),
(972, 'Coca plasique', '900', '1000', 1, 1000, '2024-08-31 16:37:50', 'Hils Imidi'),
(973, 'Zesta marakuja', '800', '1000', 1, 1000, '2024-08-31 16:38:08', 'Hils Imidi'),
(974, 'Mirinda plastique', '900', '1000', 5, 5000, '2024-08-31 16:38:42', 'Hils Imidi'),
(975, 'Fanta plasique', '900', '1000', 2, 2000, '2024-08-31 16:39:19', 'Hils Imidi'),
(976, 'EXO', '3200', '3500', 1, 3500, '2024-08-31 16:40:20', 'Hils Imidi'),
(977, 'Eau bidon', '630', '1000', 10, 10000, '2024-09-01 11:31:05', 'Hils Imidi'),
(978, 'Alpina', '500', '500', 20, 10000, '2024-09-01 11:31:21', 'Hils Imidi'),
(979, 'Festa energy', '700', '1000', 7, 7000, '2024-09-01 11:31:48', 'Hils Imidi'),
(980, 'Zesta energy', '590', '1000', 1, 1000, '2024-09-01 11:32:03', 'Hils Imidi'),
(981, 'zesta ananas', '800', '1000', 2, 2000, '2024-09-01 11:32:18', 'Hils Imidi'),
(982, 'zesta mangue', '800', '1000', 2, 2000, '2024-09-01 11:32:42', 'Hils Imidi'),
(983, 'U-FRESH', '440', '700', 3, 2100, '2024-09-01 11:32:55', 'Hils Imidi'),
(984, 'Boss', '1800', '2300', 1, 2300, '2024-09-01 11:33:08', 'Hils Imidi'),
(985, 'Kolo mboka', '1300', '1500', 2, 3000, '2024-09-01 11:33:21', 'Hils Imidi'),
(986, 'Mokonzi', '1800', '2000', 2, 4000, '2024-09-01 11:33:34', 'Hils Imidi'),
(987, 'Pepsi plastique', '900', '1000', 6, 6000, '2024-09-01 11:33:53', 'Hils Imidi'),
(988, 'Mirinda plastique', '900', '1000', 1, 1000, '2024-09-01 11:34:11', 'Hils Imidi'),
(989, 'Fanta plasique', '900', '1000', 1, 1000, '2024-09-01 11:34:30', 'Hils Imidi'),
(990, 'Mirinda plastique', '900', '1000', 2, 2000, '2024-09-01 11:34:53', 'Hils Imidi'),
(991, 'Mokonzi', '1800', '2000', 1, 2000, '2024-09-01 11:35:09', 'Hils Imidi'),
(992, 'EXO', '3200', '3500', 1, 3500, '2024-09-01 11:35:22', 'Hils Imidi'),
(993, '7up plastique', '900', '1000', 1, 1000, '2024-09-01 11:35:34', 'Hils Imidi'),
(994, 'Eau bidon', '630', '1000', 12, 12000, '2024-09-02 16:43:33', 'Hils Imidi'),
(995, 'Alpina', '500', '500', 40, 20000, '2024-09-02 16:43:52', 'Hils Imidi'),
(996, 'Festa energy', '700', '1000', 9, 9000, '2024-09-02 16:44:11', 'Hils Imidi'),
(997, 'Zesta energy', '590', '1000', 7, 7000, '2024-09-02 16:44:32', 'Hils Imidi'),
(998, 'zesta ananas', '800', '1000', 4, 4000, '2024-09-02 16:49:48', 'Hils Imidi'),
(999, 'zesta rouge', '800', '1000', 1, 1000, '2024-09-02 16:50:09', 'Hils Imidi'),
(1000, 'Zesta mangue ', '570', '1000', 3, 3000, '2024-09-02 16:50:33', 'Hils Imidi'),
(1001, 'XXL', '1400', '2000', 3, 6000, '2024-09-02 16:50:44', 'Hils Imidi'),
(1002, 'U-FRESH', '440', '700', 3, 2100, '2024-09-02 16:50:53', 'Hils Imidi'),
(1003, 'Splendeur', '1800', '2300', 2, 4600, '2024-09-02 16:51:06', 'Hils Imidi'),
(1004, 'Vain amour', '1300', '1500', 2, 3000, '2024-09-02 16:51:20', 'Hils Imidi'),
(1005, 'Kolo mboka', '1300', '1500', 3, 4500, '2024-09-02 16:51:36', 'Hils Imidi'),
(1006, 'CUCA', '1500', '2000', 1, 2000, '2024-09-02 16:51:54', 'Hils Imidi'),
(1007, 'Savana', '3200', '4000', 2, 8000, '2024-09-02 16:54:07', 'Hils Imidi'),
(1008, 'ORANGINA', '900', '1000', 6, 6000, '2024-09-02 16:54:24', 'Hils Imidi'),
(1009, 'POWER ROUGE', '2400', '3000', 2, 6000, '2024-09-02 16:54:46', 'Hils Imidi'),
(1010, 'Pepsi plastique', '900', '1000', 20, 20000, '2024-09-02 16:55:11', 'Hils Imidi'),
(1011, 'Mokonzi', '1800', '2000', 1, 2000, '2024-09-02 16:55:30', 'Hils Imidi'),
(1012, 'Fanta plasique', '900', '1000', 2, 2000, '2024-09-02 16:55:46', 'Hils Imidi'),
(1013, 'Zesta marakuja', '800', '1000', 4, 4000, '2024-09-02 16:56:15', 'Hils Imidi'),
(1014, 'Mokonzi', '1800', '2000', 3, 6000, '2024-09-02 16:56:32', 'Hils Imidi'),
(1015, 'Mirinda plastique', '900', '1000', 13, 13000, '2024-09-02 16:56:57', 'Hils Imidi'),
(1016, '7up plastique', '900', '1000', 1, 1000, '2024-09-02 16:57:16', 'Hils Imidi'),
(1017, 'Eau bidon', '630', '1000', 14, 14000, '2024-09-03 12:49:04', 'Hils Imidi'),
(1018, 'Alpina', '500', '500', 19, 9500, '2024-09-03 12:49:20', 'Hils Imidi'),
(1019, 'Zesta marakuja', '800', '1000', 1, 1000, '2024-09-03 12:49:44', 'Hils Imidi'),
(1020, 'Zesta energy', '590', '1000', 3, 3000, '2024-09-03 12:50:07', 'Hils Imidi'),
(1021, 'Zesta mangue ', '570', '1000', 4, 4000, '2024-09-03 12:50:22', 'Hils Imidi'),
(1022, 'Festa energy', '700', '1000', 4, 4000, '2024-09-03 12:51:07', 'Hils Imidi'),
(1023, 'Fanta', '1600', '2500', 1, 2500, '2024-09-03 12:51:27', 'Hils Imidi'),
(1024, 'Vain amour', '1300', '1500', 2, 3000, '2024-09-03 12:52:02', 'Hils Imidi'),
(1025, 'Kolo mboka', '1300', '1500', 3, 4500, '2024-09-03 12:52:22', 'Hils Imidi'),
(1026, 'Cuca bouteille', '1500', '2000', 1, 2000, '2024-09-03 12:52:40', 'Hils Imidi'),
(1027, 'Pepsi plastique', '900', '1000', 7, 7000, '2024-09-03 12:52:59', 'Hils Imidi'),
(1028, 'Fanta plasique', '900', '1000', 3, 3000, '2024-09-03 12:53:31', 'Hils Imidi'),
(1029, 'ORANGINA', '900', '1000', 3, 3000, '2024-09-03 12:53:43', 'Hils Imidi'),
(1030, 'U-FRESH', '440', '700', 6, 4200, '2024-09-03 12:53:56', 'Hils Imidi'),
(1031, 'Zesta orange', '800', '1000', 1, 1000, '2024-09-03 13:01:19', 'Hils Imidi'),
(1032, 'Zesta cola', '800', '1000', 1, 1000, '2024-09-03 13:02:48', 'Hils Imidi'),
(1033, 'Bavaria petit', '2100', '3000', 1, 3000, '2024-09-03 13:03:07', 'Hils Imidi'),
(1034, 'XXL', '1400', '2000', 1, 2000, '2024-09-03 13:03:20', 'Hils Imidi'),
(1035, 'POWER ROUGE', '2400', '3000', 1, 3000, '2024-09-03 13:03:40', 'Hils Imidi'),
(1036, 'POWER JAUNE', '1400', '1600', 1, 1600, '2024-09-03 13:03:55', 'Hils Imidi'),
(1037, 'Splendeur', '1800', '2300', 1, 2300, '2024-09-03 13:04:15', 'Hils Imidi'),
(1038, 'CUCA', '1500', '2000', 2, 4000, '2024-09-03 13:04:38', 'Hils Imidi'),
(1039, 'Mokonzi', '1800', '2000', 1, 2000, '2024-09-03 13:04:53', 'Hils Imidi'),
(1040, 'Villa Petit', '2000', '2500', 2, 5000, '2024-09-03 13:05:09', 'Hils Imidi'),
(1041, 'Shaka', '3000', '3500', 1, 3500, '2024-09-03 13:05:30', 'Hils Imidi'),
(1042, 'Mirinda plastique', '900', '1000', 2, 2000, '2024-09-03 13:05:50', 'Hils Imidi'),
(1043, 'Londowis', '900', '1300', 1, 1300, '2024-09-03 13:06:35', 'Hils Imidi'),
(1044, '7up plastique', '900', '1000', 1, 1000, '2024-09-03 13:11:41', 'Hils Imidi'),
(1045, 'Splendeur', '1800', '2300', 1, 2300, '2024-09-03 13:12:23', 'Hils Imidi'),
(1046, 'Eau bidon', '630', '1000', 28, 28000, '2024-09-05 19:22:00', 'Hils Imidi'),
(1047, 'Alpina', '500', '500', 46, 23000, '2024-09-05 19:24:09', 'Hils Imidi'),
(1048, 'zesta ananas', '800', '1000', 4, 4000, '2024-09-05 19:25:41', 'Hils Imidi'),
(1049, 'Zesta energy', '590', '1000', 6, 6000, '2024-09-05 19:27:20', 'Hils Imidi'),
(1050, 'zesta mangue', '800', '1000', 4, 4000, '2024-09-05 19:28:02', 'Hils Imidi'),
(1051, 'Festa energy', '700', '1000', 6, 6000, '2024-09-05 19:28:31', 'Hils Imidi'),
(1053, 'Vain amour', '1300', '1500', 14, 21000, '2024-09-05 19:31:44', 'Hils Imidi'),
(1054, 'Kolo mboka', '1300', '1500', 16, 24000, '2024-09-05 19:33:10', 'Hils Imidi'),
(1055, 'Cuca bouteille', '1500', '2000', 1, 2000, '2024-09-05 19:33:51', 'Hils Imidi'),
(1056, 'Savana', '3200', '4000', 1, 4000, '2024-09-05 19:42:33', 'Hils Imidi'),
(1057, 'Reserve 7', '6000', '7000', 2, 14000, '2024-09-05 19:42:51', 'Hils Imidi'),
(1058, 'Pepsi plastique', '900', '1000', 29, 29000, '2024-09-05 19:45:07', 'Hils Imidi'),
(1059, '7up plastique', '900', '1000', 2, 2000, '2024-09-05 19:45:58', 'Hils Imidi'),
(1060, 'Fanta plasique', '900', '1000', 4, 4000, '2024-09-05 19:46:46', 'Hils Imidi'),
(1061, 'ORANGINA', '900', '1000', 4, 4000, '2024-09-05 19:47:22', 'Hils Imidi'),
(1062, 'U-FRESH', '440', '700', 16, 11200, '2024-09-05 19:48:29', 'Hils Imidi'),
(1063, 'Zesta orange', '800', '1000', 2, 2000, '2024-09-05 19:49:28', 'Hils Imidi'),
(1064, 'Zesta cola', '800', '1000', 2, 2000, '2024-09-05 19:50:40', 'Hils Imidi'),
(1065, 'zesta rouge', '800', '1000', 3, 3000, '2024-09-05 19:53:02', 'Hils Imidi'),
(1066, 'Bavaria petit', '2100', '3000', 1, 3000, '2024-09-05 19:54:59', 'Hils Imidi'),
(1067, 'XXL', '1400', '2000', 4, 8000, '2024-09-05 19:56:45', 'Hils Imidi'),
(1068, 'Dopel', '1700', '2500', 1, 2500, '2024-09-05 19:57:11', 'Hils Imidi'),
(1069, 'Splendeur', '1800', '2300', 9, 20700, '2024-09-05 19:58:50', 'Hils Imidi'),
(1070, 'CUCA', '1500', '2000', 5, 10000, '2024-09-05 19:59:25', 'Hils Imidi'),
(1071, 'Mokonzi', '1800', '2000', 2, 4000, '2024-09-05 19:59:55', 'Hils Imidi'),
(1072, 'EXO', '3200', '3500', 3, 10500, '2024-09-05 20:00:34', 'Hils Imidi'),
(1073, 'Biscuit mariamar', '750', '1000', 2, 2000, '2024-09-05 20:03:16', 'Hils Imidi'),
(1074, 'Mirinda plastique', '900', '1000', 12, 12000, '2024-09-05 20:04:21', 'Hils Imidi'),
(1075, 'Londowis', '900', '1300', 2, 2600, '2024-09-05 20:05:05', 'Hils Imidi'),
(1076, 'Angel', '1100', '1500', 1, 1500, '2024-09-05 20:05:28', 'Hils Imidi'),
(1077, 'Eau bidon', '630', '1000', 11, 11000, '2024-09-06 23:08:23', 'Hils Imidi'),
(1078, 'Eau bidon', '630', '1000', 22, 22000, '2024-09-07 13:07:36', 'Hils Imidi'),
(1079, 'Alpina', '500', '500', 46, 23000, '2024-09-07 13:08:33', 'Hils Imidi'),
(1080, 'zesta ananas', '800', '1000', 5, 5000, '2024-09-07 13:09:02', 'Hils Imidi'),
(1081, 'Zesta marakuja', '800', '1000', 2, 2000, '2024-09-07 13:10:29', 'Hils Imidi'),
(1082, 'Zesta energy', '590', '1000', 6, 6000, '2024-09-07 13:11:06', 'Hils Imidi'),
(1083, 'zesta mangue', '800', '1000', 5, 5000, '2024-09-07 13:11:27', 'Hils Imidi'),
(1084, 'Festa energy', '700', '1000', 9, 9000, '2024-09-07 13:12:14', 'Hils Imidi'),
(1085, 'Sprite', '1700', '2500', 1, 2500, '2024-09-07 13:12:33', 'Hils Imidi'),
(1086, 'Vain amour', '1300', '1500', 5, 7500, '2024-09-07 13:22:11', 'Hils Imidi'),
(1087, 'Kolo mboka', '1300', '1500', 12, 18000, '2024-09-07 13:22:29', 'Hils Imidi'),
(1088, 'Savana', '3200', '4000', 7, 28000, '2024-09-07 13:23:02', 'Hils Imidi'),
(1089, 'Reserve 7', '6000', '7000', 1, 7000, '2024-09-07 13:23:32', 'Hils Imidi'),
(1090, 'Pepsi plastique', '900', '1000', 26, 26000, '2024-09-07 13:25:53', 'Hils Imidi'),
(1091, '7up plastique', '900', '1000', 1, 1000, '2024-09-07 13:26:45', 'Hils Imidi'),
(1092, 'Fanta plasique', '900', '1000', 4, 4000, '2024-09-07 13:27:26', 'Hils Imidi'),
(1093, 'ORANGINA', '900', '1000', 3, 3000, '2024-09-07 13:27:47', 'Hils Imidi'),
(1094, 'U-FRESH', '440', '700', 15, 10500, '2024-09-07 13:28:10', 'Hils Imidi'),
(1095, 'Zesta orange', '800', '1000', 1, 1000, '2024-09-07 13:28:46', 'Hils Imidi'),
(1096, 'Zesta cola', '800', '1000', 2, 2000, '2024-09-07 13:29:38', 'Hils Imidi'),
(1097, 'zesta rouge', '800', '1000', 5, 5000, '2024-09-07 13:30:19', 'Hils Imidi'),
(1098, 'XXL', '1400', '2000', 4, 8000, '2024-09-07 13:33:45', 'Hils Imidi'),
(1099, 'POWER JAUNE', '1400', '1600', 3, 4800, '2024-09-07 13:34:23', 'Hils Imidi'),
(1100, 'Dopel', '1700', '2500', 1, 2500, '2024-09-07 13:34:41', 'Hils Imidi'),
(1101, 'Splendeur', '1800', '2300', 2, 4600, '2024-09-07 13:36:21', 'Hils Imidi'),
(1102, 'CUCA', '1500', '2000', 3, 6000, '2024-09-07 13:36:47', 'Hils Imidi'),
(1103, 'Mokonzi', '1800', '2000', 2, 4000, '2024-09-07 13:37:16', 'Hils Imidi'),
(1104, 'Shaka', '3000', '3500', 1, 3500, '2024-09-07 13:37:57', 'Hils Imidi'),
(1105, 'Biscuit mariamar', '750', '1000', 3, 3000, '2024-09-07 13:38:19', 'Hils Imidi'),
(1106, 'Mirinda plastique', '900', '1000', 15, 15000, '2024-09-07 13:38:47', 'Hils Imidi'),
(1107, 'Londowis', '900', '1300', 1, 1300, '2024-09-07 13:39:09', 'Hils Imidi'),
(1108, 'Guerrifier', '11000', '1500', 1, 1500, '2024-09-07 13:39:26', 'Hils Imidi'),
(1109, 'Eau bidon', '630', '1000', 18, 18000, '2024-09-08 09:07:06', 'Hils Imidi'),
(1110, 'Alpina', '500', '500', 26, 13000, '2024-09-08 09:08:10', 'Hils Imidi'),
(1111, 'zesta ananas', '800', '1000', 4, 4000, '2024-09-08 09:08:56', 'Hils Imidi'),
(1112, 'Zesta energy', '590', '1000', 4, 4000, '2024-09-08 09:09:33', 'Hils Imidi'),
(1113, 'Zesta mangue ', '570', '1000', 3, 3000, '2024-09-08 09:10:03', 'Hils Imidi'),
(1114, 'Festa energy', '700', '1000', 8, 8000, '2024-09-08 09:10:28', 'Hils Imidi'),
(1115, 'Vain amour', '1300', '1500', 5, 7500, '2024-09-08 09:11:09', 'Hils Imidi'),
(1116, 'Kolo mboka', '1300', '1500', 4, 6000, '2024-09-08 09:12:13', 'Hils Imidi'),
(1117, 'Savana', '3200', '4000', 1, 4000, '2024-09-08 09:12:45', 'Hils Imidi'),
(1118, 'Pepsi plastique', '900', '1000', 19, 19000, '2024-09-08 09:13:20', 'Hils Imidi'),
(1119, 'Fanta plasique', '900', '1000', 1, 1000, '2024-09-08 09:13:41', 'Hils Imidi'),
(1120, 'ORANGINA', '900', '1000', 8, 8000, '2024-09-08 09:14:08', 'Hils Imidi'),
(1121, 'U-FRESH', '440', '700', 5, 3500, '2024-09-08 09:14:23', 'Hils Imidi'),
(1122, 'Zesta cola', '800', '1000', 1, 1000, '2024-09-08 09:14:46', 'Hils Imidi'),
(1123, 'zesta rouge', '800', '1000', 1, 1000, '2024-09-08 09:15:05', 'Hils Imidi'),
(1124, 'XXL', '1400', '2000', 5, 10000, '2024-09-08 09:15:22', 'Hils Imidi'),
(1125, '7up plastique', '900', '1000', 1, 1000, '2024-09-08 09:15:43', 'Hils Imidi'),
(1126, 'Dopel', '1700', '2500', 1, 2500, '2024-09-08 09:16:12', 'Hils Imidi'),
(1127, 'CUCA', '1500', '2000', 1, 2000, '2024-09-08 09:16:30', 'Hils Imidi'),
(1128, 'Mokonzi', '1800', '2000', 2, 4000, '2024-09-08 09:16:54', 'Hils Imidi'),
(1129, 'EXO', '3200', '3500', 1, 3500, '2024-09-08 09:17:25', 'Hils Imidi'),
(1130, 'Shaka', '3000', '3500', 1, 3500, '2024-09-08 09:17:37', 'Hils Imidi'),
(1131, 'Mirinda plastique', '900', '1000', 2, 2000, '2024-09-08 09:18:20', 'Hils Imidi'),
(1132, 'Londowis', '900', '1300', 1, 1300, '2024-09-08 09:18:42', 'Hils Imidi'),
(1133, 'Guerrifier', '11000', '1500', 3, 4500, '2024-09-08 09:19:15', 'Hils Imidi'),
(1134, 'Eau bidon', '630', '1000', 11, 11000, '2024-09-09 22:52:51', 'Hils Imidi'),
(1135, 'Alpina', '500', '500', 35, 17500, '2024-09-09 22:53:07', 'Hils Imidi'),
(1136, 'zesta ananas', '800', '1000', 3, 3000, '2024-09-09 22:53:27', 'Hils Imidi'),
(1137, 'Zesta marakuja', '800', '1000', 2, 2000, '2024-09-09 22:53:43', 'Hils Imidi'),
(1138, 'Zesta energy', '590', '1000', 8, 8000, '2024-09-09 22:54:04', 'Hils Imidi'),
(1139, 'Zesta mangue ', '570', '1000', 3, 3000, '2024-09-09 22:54:21', 'Hils Imidi'),
(1140, 'Festa energy', '700', '1000', 10, 10000, '2024-09-09 22:54:43', 'Hils Imidi'),
(1141, 'Fanta', '1600', '2500', 1, 2500, '2024-09-09 22:55:00', 'Hils Imidi'),
(1142, 'Kolo mboka', '1300', '1500', 1, 1500, '2024-09-09 22:55:13', 'Hils Imidi'),
(1143, 'Boss', '1800', '2300', 2, 4600, '2024-09-09 22:55:27', 'Hils Imidi'),
(1144, 'Pepsi plastique', '900', '1000', 14, 14000, '2024-09-09 22:55:48', 'Hils Imidi'),
(1145, '7up plastique', '900', '1000', 2, 2000, '2024-09-09 22:56:04', 'Hils Imidi'),
(1146, 'Fanta plasique', '900', '1000', 4, 4000, '2024-09-09 22:56:46', 'Hils Imidi'),
(1147, 'Coca plasique', '900', '1000', 2, 2000, '2024-09-09 22:56:58', 'Hils Imidi'),
(1148, 'ORANGINA', '900', '1000', 5, 5000, '2024-09-09 22:57:13', 'Hils Imidi'),
(1149, 'U-FRESH', '440', '700', 1, 700, '2024-09-09 22:57:26', 'Hils Imidi'),
(1150, 'Zesta orange', '800', '1000', 1, 1000, '2024-09-09 22:57:43', 'Hils Imidi'),
(1151, 'Zesta cola', '800', '1000', 1, 1000, '2024-09-09 22:57:59', 'Hils Imidi'),
(1152, 'XXL', '1400', '2000', 6, 12000, '2024-09-09 22:58:21', 'Hils Imidi'),
(1153, 'POWER JAUNE', '1400', '1600', 1, 1600, '2024-09-09 22:58:42', 'Hils Imidi'),
(1154, 'Mirinda plastique', '900', '1000', 6, 6000, '2024-09-09 22:59:12', 'Hils Imidi'),
(1155, 'Mirinda plastique', '900', '1000', 7, 7000, '2024-09-09 22:59:30', 'Hils Imidi'),
(1156, 'Londowis', '900', '1300', 3, 3900, '2024-09-09 22:59:49', 'Hils Imidi'),
(1157, 'Pepsi plastique inv', '900', '1000', 34, 34000, '2024-10-11 15:45:06', 'Hils Imidi'),
(1158, '7up plastique inv', '900', '1000', 7, 7000, '2024-10-11 15:48:42', 'Hils Imidi'),
(1159, 'American inv', '410', '500', 45, 22500, '2024-10-11 15:49:16', 'Hils Imidi'),
(1160, 'Alpina inv', '400', '500', 36, 18000, '2024-10-11 15:49:39', 'Hils Imidi'),
(1161, 'Festa energy inv', '700', '1000', 15, 15000, '2024-10-11 15:50:21', 'Hils Imidi'),
(1162, 'Cuca inv', '1420', '2000', 2, 4000, '2024-10-11 15:50:43', 'Hils Imidi'),
(1163, 'Eau bidon', '630', '1000', 28, 28000, '2024-10-11 15:56:22', 'Hils Imidi'),
(1164, 'swista inv', '460', '700', 7, 4900, '2024-10-11 15:56:55', 'Hils Imidi'),
(1165, 'Zesta marakuja', '800', '1000', 6, 6000, '2024-10-11 15:57:18', 'Hils Imidi'),
(1166, 'Zesta mangue ', '570', '1000', 5, 5000, '2024-10-11 15:57:35', 'Hils Imidi'),
(1167, 'Vain amour', '1300', '1500', 12, 18000, '2024-10-11 15:58:02', 'Hils Imidi'),
(1168, 'Boss', '1800', '2300', 3, 6900, '2024-10-11 15:58:20', 'Hils Imidi'),
(1169, 'Fanta plasique', '900', '1000', 3, 3000, '2024-10-11 15:59:04', 'Hils Imidi'),
(1170, 'ORANGINA', '900', '1000', 3, 3000, '2024-10-11 15:59:20', 'Hils Imidi'),
(1171, 'U-FRESH', '440', '700', 6, 4200, '2024-10-11 15:59:35', 'Hils Imidi'),
(1172, 'Zesta cola', '800', '1000', 1, 1000, '2024-10-11 15:59:56', 'Hils Imidi'),
(1173, 'zesta rouge', '800', '1000', 2, 2000, '2024-10-11 16:00:15', 'Hils Imidi'),
(1174, 'Festa ananas grd', '750', '1000', 2, 2000, '2024-10-11 16:00:36', 'Hils Imidi'),
(1175, 'Festa orange grd', '750', '1000', 3, 3000, '2024-10-11 16:01:10', 'Hils Imidi'),
(1176, 'XXL', '1400', '2000', 4, 8000, '2024-10-11 16:01:23', 'Hils Imidi'),
(1177, 'Dopel', '1700', '2500', 1, 2500, '2024-10-11 16:01:37', 'Hils Imidi'),
(1178, 'Splendeur', '1800', '2300', 1, 2300, '2024-10-11 16:01:51', 'Hils Imidi'),
(1179, 'Mokonzi', '1800', '2000', 1, 2000, '2024-10-11 16:02:12', 'Hils Imidi'),
(1180, 'Villa grand', '6500', '7500', 1, 7500, '2024-10-11 16:02:30', 'Hils Imidi'),
(1181, 'Villa Petit', '2000', '2500', 1, 2500, '2024-10-11 16:02:41', 'Hils Imidi'),
(1182, 'Mirinda plastique inv', '900', '1000', 10, 10000, '2024-10-11 16:03:07', 'Hils Imidi'),
(1183, 'Londowis', '900', '1300', 2, 2600, '2024-10-11 16:03:29', 'Hils Imidi');

-- --------------------------------------------------------

--
-- Structure de la table `visiteur`
--

CREATE TABLE `visiteur` (
  `id` int(11) NOT NULL,
  `ip_visiteur` varchar(255) NOT NULL,
  `date_visite` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `visiteur`
--

INSERT INTO `visiteur` (`id`, `ip_visiteur`, `date_visite`) VALUES
(1, '::1', '2024-05-28 00:25:09'),
(2, '::1', '2024-05-28 00:26:13'),
(3, '::1', '2024-05-28 00:26:29'),
(4, '::1', '2024-05-28 00:27:55'),
(5, '::1', '2024-05-28 00:31:00'),
(6, '::1', '2024-05-28 00:32:16'),
(7, '::1', '2024-05-28 00:32:46'),
(8, '::1', '2024-05-28 00:33:29'),
(9, '::1', '2024-05-28 00:34:37'),
(10, '::1', '2024-05-28 00:36:40'),
(11, '::1', '2024-05-28 00:47:18'),
(12, '::1', '2024-05-28 00:53:36'),
(13, '::1', '2024-05-28 01:13:26'),
(14, '::1', '2024-05-28 01:19:42'),
(15, '::1', '2024-05-28 01:20:26'),
(16, '::1', '2024-05-28 01:22:10'),
(17, '::1', '2024-05-28 01:22:48'),
(18, '::1', '2024-05-28 01:23:00'),
(19, '::1', '2024-05-28 01:24:36'),
(20, '::1', '2024-05-28 01:35:23'),
(21, '::1', '2024-05-28 01:36:55'),
(22, '::1', '2024-05-28 01:37:53'),
(23, '::1', '2024-05-28 01:41:58'),
(24, '::1', '2024-05-28 01:42:06'),
(25, '::1', '2024-05-28 01:42:36'),
(26, '::1', '2024-05-28 01:49:33'),
(27, '::1', '2024-05-28 01:51:15'),
(28, '::1', '2024-05-28 01:53:30'),
(29, '::1', '2024-05-28 01:54:37'),
(30, '::1', '2024-05-28 12:19:33'),
(31, '::1', '2024-05-28 12:26:00'),
(32, '::1', '2024-05-28 12:26:05'),
(33, '::1', '2024-05-28 12:26:16'),
(34, '::1', '2024-05-28 13:06:38'),
(35, '::1', '2024-05-28 13:11:44'),
(36, '::1', '2024-05-28 13:13:36'),
(37, '::1', '2024-05-28 13:17:58'),
(38, '::1', '2024-05-28 13:21:50'),
(39, '::1', '2024-05-28 13:28:09'),
(40, '::1', '2024-05-28 17:55:50'),
(41, '::1', '2024-05-28 18:10:04'),
(42, '::1', '2024-05-28 21:26:00'),
(43, '::1', '2024-05-28 21:31:17'),
(44, '::1', '2024-05-28 21:34:48'),
(45, '::1', '2024-05-28 21:36:34'),
(46, '::1', '2024-05-28 21:40:27'),
(47, '::1', '2024-05-28 21:41:12'),
(48, '::1', '2024-05-28 21:41:43'),
(49, '::1', '2024-05-28 21:43:15'),
(50, '::1', '2024-05-28 21:44:18'),
(51, '::1', '2024-05-28 21:45:30'),
(52, '::1', '2024-05-28 21:46:46'),
(53, '::1', '2024-05-28 21:47:49'),
(54, '::1', '2024-05-28 21:50:01'),
(55, '::1', '2024-05-28 21:50:13'),
(56, '::1', '2024-05-28 21:50:32'),
(57, '::1', '2024-05-28 21:51:28'),
(58, '::1', '2024-05-28 21:51:39'),
(59, '::1', '2024-05-28 21:59:23'),
(60, '::1', '2024-05-28 21:59:45'),
(61, '::1', '2024-05-28 22:07:18'),
(62, '::1', '2024-05-28 22:07:50'),
(63, '::1', '2024-05-28 22:09:36'),
(64, '::1', '2024-05-28 22:10:55'),
(65, '::1', '2024-05-28 22:33:14'),
(66, '::1', '2024-05-28 22:37:42'),
(67, '::1', '2024-06-10 23:09:11'),
(68, '::1', '2024-06-10 23:15:31'),
(69, '::1', '2024-06-10 23:16:22'),
(70, '::1', '2024-06-10 23:18:37'),
(71, '::1', '2024-06-10 23:21:48'),
(72, '::1', '2024-06-10 23:21:58'),
(73, '::1', '2024-06-10 23:22:27'),
(74, '::1', '2024-06-10 23:22:47'),
(75, '::1', '2024-06-10 23:23:07'),
(76, '::1', '2024-06-10 23:26:26'),
(77, '::1', '2024-06-10 23:26:53'),
(78, '::1', '2024-06-10 23:28:22'),
(79, '::1', '2024-06-10 23:29:56'),
(80, '::1', '2024-06-10 23:32:21'),
(81, '::1', '2024-06-11 00:08:19'),
(82, '::1', '2024-06-11 00:08:34'),
(83, '::1', '2024-06-11 00:08:35'),
(84, '::1', '2024-06-11 12:55:26'),
(85, '::1', '2024-06-11 16:14:02'),
(86, '::1', '2024-06-25 20:12:03'),
(87, '::1', '2024-06-25 20:12:10'),
(88, '::1', '2024-06-25 21:58:47'),
(89, '::1', '2024-06-30 16:23:09'),
(90, '::1', '2024-06-30 16:33:18'),
(91, '::1', '2024-06-30 16:33:19'),
(92, '::1', '2024-07-01 21:55:41'),
(93, '::1', '2024-07-02 00:13:07'),
(94, '::1', '2024-07-02 00:17:38'),
(95, '::1', '2024-07-03 21:42:56'),
(96, '::1', '2024-07-04 17:55:21'),
(97, '::1', '2024-07-04 21:17:35'),
(98, '::1', '2024-07-04 21:23:59'),
(99, '::1', '2024-07-04 21:24:20'),
(100, '::1', '2024-07-04 21:24:25'),
(101, '::1', '2024-07-04 21:24:51'),
(102, '::1', '2024-07-04 21:25:03'),
(103, '::1', '2024-07-04 21:35:25'),
(104, '::1', '2024-07-04 21:39:54'),
(105, '::1', '2024-07-04 21:44:36'),
(106, '::1', '2024-07-04 21:48:43'),
(107, '::1', '2024-07-05 19:35:22'),
(108, '::1', '2024-07-05 20:08:54'),
(109, '::1', '2024-07-05 20:14:03'),
(110, '::1', '2024-07-05 20:57:30'),
(111, '::1', '2024-07-05 23:21:56'),
(112, '::1', '2024-07-05 23:28:51'),
(113, '::1', '2024-07-05 23:28:51'),
(114, '::1', '2024-07-05 23:33:49'),
(115, '::1', '2024-07-05 23:33:49'),
(116, '::1', '2024-07-05 23:38:15'),
(117, '::1', '2024-07-05 23:38:15'),
(118, '::1', '2024-07-06 13:30:23'),
(119, '::1', '2024-07-06 13:30:23'),
(120, '::1', '2024-07-06 13:37:25'),
(121, '::1', '2024-07-06 13:37:48'),
(122, '::1', '2024-07-06 13:41:53'),
(123, '::1', '2024-07-06 13:54:05'),
(124, '::1', '2024-07-06 14:00:56'),
(125, '::1', '2024-07-06 14:00:56'),
(126, '::1', '2024-07-06 14:31:21'),
(127, '::1', '2024-07-06 19:48:48'),
(128, '::1', '2024-07-06 19:48:48'),
(129, '::1', '2024-07-06 21:23:39'),
(130, '::1', '2024-07-06 23:03:23'),
(131, '::1', '2024-07-07 14:40:51'),
(132, '::1', '2024-07-07 14:40:51'),
(133, '::1', '2024-07-07 15:21:30'),
(134, '::1', '2024-07-07 16:51:00'),
(135, '::1', '2024-07-07 16:54:52'),
(136, '::1', '2024-07-07 16:56:41'),
(137, '::1', '2024-07-07 17:25:32'),
(138, '::1', '2024-07-07 17:25:32'),
(139, '::1', '2024-07-07 18:45:38'),
(140, '::1', '2024-07-09 00:16:48'),
(141, '::1', '2024-07-09 00:16:48'),
(142, '::1', '2024-07-09 00:46:55'),
(143, '::1', '2024-07-09 19:09:05'),
(144, '::1', '2024-07-09 19:09:05'),
(145, '::1', '2024-07-10 00:35:56'),
(146, '::1', '2024-07-10 00:35:56'),
(147, '::1', '2024-07-10 01:18:15'),
(148, '::1', '2024-07-10 18:27:49'),
(149, '::1', '2024-07-10 18:27:49'),
(150, '::1', '2024-07-10 23:24:19'),
(151, '::1', '2024-07-11 00:01:23'),
(152, '::1', '2024-07-11 01:15:19'),
(153, '::1', '2024-07-11 20:26:44'),
(154, '::1', '2024-07-11 20:26:44'),
(155, '::1', '2024-07-12 00:20:04'),
(156, '::1', '2024-07-12 00:25:32'),
(157, '::1', '2024-07-12 00:28:01'),
(158, '::1', '2024-07-12 00:32:12'),
(159, '::1', '2024-07-12 00:32:26'),
(160, '::1', '2024-07-12 18:32:01'),
(161, '::1', '2024-07-12 18:32:01'),
(162, '::1', '2024-07-12 18:57:28'),
(163, '::1', '2024-07-12 20:09:59'),
(164, '::1', '2024-07-12 20:09:59'),
(165, '::1', '2024-07-13 16:20:14'),
(166, '::1', '2024-07-13 16:28:16'),
(167, '::1', '2024-07-13 16:43:40'),
(168, '::1', '2024-07-13 16:44:20'),
(169, '::1', '2024-07-13 17:55:46'),
(170, '::1', '2024-07-13 18:41:07'),
(171, '::1', '2024-07-13 23:12:11'),
(172, '::1', '2024-07-14 01:20:44'),
(173, '::1', '2024-07-14 01:20:44'),
(174, '::1', '2024-07-14 01:51:06'),
(175, '::1', '2024-07-14 02:00:33'),
(176, '::1', '2024-07-15 23:35:19'),
(177, '::1', '2024-07-15 23:35:19'),
(178, '::1', '2024-07-16 00:04:55'),
(179, '::1', '2024-07-16 00:04:55'),
(180, '::1', '2024-07-16 02:19:30'),
(181, '::1', '2024-07-18 06:30:29'),
(182, '::1', '2024-07-18 06:50:25'),
(183, '::1', '2024-07-18 06:50:25'),
(184, '::1', '2024-07-19 08:41:15'),
(185, '::1', '2024-07-19 08:41:15'),
(186, '::1', '2024-07-19 08:52:36'),
(187, '::1', '2024-07-19 23:15:47'),
(188, '::1', '2024-07-19 23:15:47'),
(189, '::1', '2024-07-19 23:25:01'),
(190, '::1', '2024-07-19 23:25:01'),
(191, '::1', '2024-07-19 23:27:19'),
(192, '::1', '2024-07-19 23:33:23'),
(193, '::1', '2024-07-20 17:46:23'),
(194, '::1', '2024-07-20 18:15:12'),
(195, '::1', '2024-07-20 18:15:12'),
(196, '::1', '2024-07-21 10:24:05'),
(197, '::1', '2024-07-21 10:55:40'),
(198, '::1', '2024-07-21 10:55:41'),
(199, '::1', '2024-07-21 23:52:55'),
(200, '::1', '2024-07-21 23:52:55'),
(201, '::1', '2024-07-22 00:29:42'),
(202, '::1', '2024-07-22 20:23:10'),
(203, '::1', '2024-07-22 20:23:10'),
(204, '::1', '2024-07-22 22:46:17'),
(205, '::1', '2024-07-22 22:46:17'),
(206, '::1', '2024-07-23 13:25:38'),
(207, '::1', '2024-07-23 13:25:38'),
(208, '::1', '2024-07-23 13:30:33'),
(209, '::1', '2024-07-23 21:39:10'),
(210, '::1', '2024-07-23 21:39:10'),
(211, '::1', '2024-07-24 23:57:30'),
(212, '::1', '2024-07-24 23:57:30'),
(213, '::1', '2024-07-25 20:33:51'),
(214, '::1', '2024-07-25 20:33:51'),
(215, '::1', '2024-07-25 21:49:50'),
(216, '::1', '2024-07-25 22:55:24'),
(217, '::1', '2024-07-25 22:55:24'),
(218, '::1', '2024-07-26 20:48:31'),
(219, '::1', '2024-07-26 20:48:31'),
(220, '::1', '2024-07-26 23:08:08'),
(221, '::1', '2024-07-26 23:08:08'),
(222, '::1', '2024-07-27 13:25:48'),
(223, '::1', '2024-07-27 13:25:48'),
(224, '::1', '2024-07-27 16:09:16'),
(225, '::1', '2024-07-27 16:09:16'),
(226, '::1', '2024-07-27 16:21:34'),
(227, '::1', '2024-07-27 16:21:34'),
(228, '::1', '2024-07-27 23:26:03'),
(229, '::1', '2024-07-27 23:26:03'),
(230, '::1', '2024-07-27 23:27:09'),
(231, '::1', '2024-07-28 10:22:54'),
(232, '::1', '2024-07-28 17:22:09'),
(233, '::1', '2024-07-28 17:22:09'),
(234, '::1', '2024-07-28 18:20:38'),
(235, '::1', '2024-07-28 18:20:38'),
(236, '::1', '2024-07-28 21:57:27'),
(237, '::1', '2024-07-29 15:16:03'),
(238, '::1', '2024-07-29 16:35:14'),
(239, '::1', '2024-07-29 17:27:56'),
(240, '::1', '2024-07-29 17:34:30'),
(241, '::1', '2024-07-30 01:32:17'),
(242, '::1', '2024-07-30 01:32:17'),
(243, '::1', '2024-07-30 11:42:41'),
(244, '::1', '2024-07-30 19:17:06'),
(245, '::1', '2024-07-30 22:36:06'),
(246, '::1', '2024-07-31 08:00:51'),
(247, '::1', '2024-08-01 23:06:05'),
(248, '::1', '2024-08-01 23:06:05'),
(249, '::1', '2024-08-03 12:10:24'),
(250, '::1', '2024-08-03 12:10:24'),
(251, '::1', '2024-08-03 13:16:26'),
(252, '::1', '2024-08-03 13:24:43'),
(253, '::1', '2024-08-03 13:30:19'),
(254, '::1', '2024-08-03 17:07:13'),
(255, '::1', '2024-08-04 10:18:10'),
(256, '::1', '2024-08-04 10:18:10'),
(257, '::1', '2024-08-05 13:08:05'),
(258, '::1', '2024-08-05 23:10:46'),
(259, '::1', '2024-08-06 21:41:43'),
(260, '::1', '2024-08-06 21:41:43'),
(261, '::1', '2024-08-09 19:16:13'),
(262, '::1', '2024-08-09 19:16:13'),
(263, '::1', '2024-08-11 23:31:46'),
(264, '::1', '2024-08-11 23:31:46'),
(265, '::1', '2024-08-11 23:34:31'),
(266, '::1', '2024-08-11 23:42:12'),
(267, '::1', '2024-08-16 23:05:04'),
(268, '::1', '2024-08-16 23:05:04'),
(269, '::1', '2024-08-17 09:40:14'),
(270, '::1', '2024-08-21 13:54:04'),
(271, '::1', '2024-08-21 20:22:03'),
(272, '::1', '2024-08-21 20:22:03'),
(273, '::1', '2024-08-25 09:18:48'),
(274, '::1', '2024-08-25 09:18:48'),
(275, '::1', '2024-08-25 13:53:53'),
(276, '::1', '2024-08-25 13:53:53'),
(277, '::1', '2024-08-25 22:18:49'),
(278, '::1', '2024-08-25 22:18:49'),
(279, '::1', '2024-08-25 22:25:17'),
(280, '::1', '2024-08-25 22:25:17'),
(281, '::1', '2024-08-26 19:28:07'),
(282, '::1', '2024-08-26 19:28:07'),
(283, '::1', '2024-08-26 20:29:01'),
(284, '::1', '2024-08-26 20:59:11'),
(285, '::1', '2024-08-26 20:59:50'),
(286, '::1', '2024-08-27 14:29:52'),
(287, '::1', '2024-08-27 14:29:53'),
(288, '::1', '2024-08-27 16:26:08'),
(289, '::1', '2024-08-27 16:26:08'),
(290, '::1', '2024-08-27 16:55:45'),
(291, '::1', '2024-08-27 16:55:45'),
(292, '::1', '2024-08-27 19:59:19'),
(293, '::1', '2024-08-28 09:11:11'),
(294, '::1', '2024-08-28 09:11:11'),
(295, '::1', '2024-08-28 09:40:13'),
(296, '::1', '2024-08-28 09:40:13'),
(297, '::1', '2024-08-29 09:57:24'),
(298, '::1', '2024-08-29 10:15:41'),
(299, '::1', '2024-08-29 12:08:31'),
(300, '::1', '2024-08-30 09:39:39'),
(301, '::1', '2024-08-30 09:39:39'),
(302, '::1', '2024-08-30 09:58:21'),
(303, '::1', '2024-08-30 12:52:58'),
(304, '::1', '2024-08-30 12:52:58'),
(305, '::1', '2024-08-30 20:45:40'),
(306, '::1', '2024-08-30 20:45:40'),
(307, '::1', '2024-08-31 16:20:20'),
(308, '::1', '2024-08-31 16:20:20'),
(309, '::1', '2024-08-31 16:44:16'),
(310, '::1', '2024-09-01 11:12:49'),
(311, '::1', '2024-09-01 11:12:49'),
(312, '::1', '2024-09-01 11:35:57'),
(313, '::1', '2024-09-01 11:35:57'),
(314, '::1', '2024-09-01 11:38:10'),
(315, '::1', '2024-09-01 13:42:37'),
(316, '::1', '2024-09-01 13:42:37'),
(317, '::1', '2024-09-01 16:47:00'),
(318, '::1', '2024-09-01 17:00:09'),
(319, '::1', '2024-09-01 22:30:33'),
(320, '::1', '2024-09-01 22:30:40'),
(321, '::1', '2024-09-02 14:53:39'),
(322, '::1', '2024-09-02 15:33:35'),
(323, '::1', '2024-09-02 15:33:35'),
(324, '::1', '2024-09-02 15:51:19'),
(325, '::1', '2024-09-02 15:51:27'),
(326, '::1', '2024-09-02 16:41:03'),
(327, '::1', '2024-09-02 16:41:31'),
(328, '::1', '2024-09-02 17:17:23'),
(329, '::1', '2024-09-03 12:47:55'),
(330, '::1', '2024-09-03 12:47:55'),
(331, '::1', '2024-09-03 13:14:20'),
(332, '::1', '2024-09-03 13:14:24'),
(333, '::1', '2024-09-05 11:17:57'),
(334, '::1', '2024-09-05 11:17:57'),
(335, '::1', '2024-09-05 11:18:03'),
(336, '::1', '2024-09-05 19:17:24'),
(337, '::1', '2024-09-05 20:19:15'),
(338, '::1', '2024-09-06 10:27:42'),
(339, '::1', '2024-09-06 10:27:42'),
(340, '::1', '2024-09-06 23:00:17'),
(341, '::1', '2024-09-06 23:02:08'),
(342, '::1', '2024-09-06 23:02:08'),
(343, '::1', '2024-09-07 13:05:27'),
(344, '::1', '2024-09-07 13:05:27'),
(345, '::1', '2024-09-07 13:47:40'),
(346, '::1', '2024-09-07 13:47:40'),
(347, '::1', '2024-09-07 19:18:01'),
(348, '::1', '2024-09-08 09:05:33'),
(349, '::1', '2024-09-08 09:05:33'),
(350, '::1', '2024-09-08 09:24:01'),
(351, '::1', '2024-09-09 22:49:27'),
(352, '::1', '2024-09-09 22:49:27'),
(353, '::1', '2024-09-09 23:00:26'),
(354, '::1', '2024-09-12 19:28:47'),
(355, '::1', '2024-09-20 20:26:54'),
(356, '::1', '2024-09-20 20:26:54'),
(357, '::1', '2024-10-02 15:04:56'),
(358, '::1', '2024-10-10 16:05:55'),
(359, '::1', '2024-10-13 17:54:02'),
(360, '::1', '2024-10-13 17:54:27'),
(361, '::1', '2024-10-21 09:18:39'),
(362, '::1', '2024-10-21 09:18:39'),
(363, '::1', '2024-10-25 13:51:09'),
(364, '::1', '2024-10-25 13:57:32'),
(365, '::1', '2024-10-25 13:57:55'),
(366, '::1', '2024-10-25 14:05:58'),
(367, '::1', '2024-10-25 14:09:12'),
(368, '::1', '2024-10-25 14:09:45'),
(369, '::1', '2024-10-25 14:09:54'),
(370, '::1', '2024-10-25 14:10:23'),
(371, '::1', '2024-10-25 14:10:58'),
(372, '::1', '2024-10-25 14:12:59'),
(373, '::1', '2024-10-28 14:50:33'),
(374, '::1', '2024-11-11 13:20:26'),
(375, '::1', '2024-11-11 13:20:26'),
(376, '::1', '2024-11-11 20:24:32'),
(377, '::1', '2024-11-11 20:24:33'),
(378, '::1', '2024-11-11 20:25:08'),
(379, '::1', '2024-11-16 12:07:19'),
(380, '::1', '2024-11-16 12:07:19'),
(381, '::1', '2024-11-17 13:39:44'),
(382, '::1', '2024-11-17 13:39:44'),
(383, '::1', '2024-11-17 17:48:26'),
(384, '::1', '2024-11-18 15:02:22'),
(385, '::1', '2024-11-18 15:02:22'),
(386, '::1', '2024-11-19 11:55:43'),
(387, '::1', '2024-11-19 11:55:43'),
(388, '::1', '2024-11-19 11:55:58'),
(389, '::1', '2024-11-19 14:05:23'),
(390, '::1', '2024-11-20 11:22:19'),
(391, '::1', '2024-11-20 11:22:19'),
(392, '::1', '2024-11-25 11:21:21'),
(393, '::1', '2024-11-25 11:21:21'),
(394, '::1', '2024-12-02 10:15:49'),
(395, '::1', '2024-12-02 10:15:49'),
(396, '::1', '2025-01-23 15:33:50'),
(397, '::1', '2025-01-23 15:58:06');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `abonne`
--
ALTER TABLE `abonne`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id_categorie`);

--
-- Index pour la table `code_admin`
--
ALTER TABLE `code_admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id_commande`);

--
-- Index pour la table `comment_page`
--
ALTER TABLE `comment_page`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `contact_esembe`
--
ALTER TABLE `contact_esembe`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `depense`
--
ALTER TABLE `depense`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `dette_client`
--
ALTER TABLE `dette_client`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fichiers`
--
ALTER TABLE `fichiers`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fichiers_page`
--
ALTER TABLE `fichiers_page`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `membre_effectif`
--
ALTER TABLE `membre_effectif`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `membre_esembe`
--
ALTER TABLE `membre_esembe`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Index pour la table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id_panier`);

--
-- Index pour la table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id_produit`);

--
-- Index pour la table `recup_mdp`
--
ALTER TABLE `recup_mdp`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `temoignage_client`
--
ALTER TABLE `temoignage_client`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `vente`
--
ALTER TABLE `vente`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `visiteur`
--
ALTER TABLE `visiteur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `abonne`
--
ALTER TABLE `abonne`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id_categorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `code_admin`
--
ALTER TABLE `code_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id_commande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT pour la table `comment_page`
--
ALTER TABLE `comment_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `contact_esembe`
--
ALTER TABLE `contact_esembe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `depense`
--
ALTER TABLE `depense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT pour la table `dette_client`
--
ALTER TABLE `dette_client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `fichiers`
--
ALTER TABLE `fichiers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `fichiers_page`
--
ALTER TABLE `fichiers_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `membre_effectif`
--
ALTER TABLE `membre_effectif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `membre_esembe`
--
ALTER TABLE `membre_esembe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=833;

--
-- AUTO_INCREMENT pour la table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT pour la table `page`
--
ALTER TABLE `page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `id_panier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT pour la table `photo`
--
ALTER TABLE `photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id_produit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT pour la table `recup_mdp`
--
ALTER TABLE `recup_mdp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `temoignage_client`
--
ALTER TABLE `temoignage_client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `vente`
--
ALTER TABLE `vente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1184;

--
-- AUTO_INCREMENT pour la table `visiteur`
--
ALTER TABLE `visiteur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=398;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
