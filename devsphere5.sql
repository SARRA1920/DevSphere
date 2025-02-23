-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 23 fév. 2025 à 12:18
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `devsphere4`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie_cours`
--

CREATE TABLE `categorie_cours` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `niveau` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categorie_cours`
--

INSERT INTO `categorie_cours` (`id`, `nom`, `description`, `niveau`) VALUES
(1, 'Web Development', 'Learn modern web development technologies', '');

-- --------------------------------------------------------

--
-- Structure de la table `categorie_publication`
--

CREATE TABLE `categorie_publication` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categorie_publication`
--

INSERT INTO `categorie_publication` (`id`, `category`, `description`) VALUES
(1, 'Data Science', 'Data Science related discussions'),
(2, 'Web Development', 'Web Development related discussions'),
(3, 'Mobile Development', 'Mobile Development related discussions');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id` int(11) NOT NULL,
  `publication_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `contenu` varchar(255) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id`, `publication_id`, `user_id`, `contenu`, `date`) VALUES
(1, 1, 1, 'gfvhgfhgh', '2025-02-12 22:12:58'),
(2, 2, 1, 'dgfchfdhfhfdhcgch', '2025-02-12 22:15:52');

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

CREATE TABLE `cours` (
  `id` int(11) NOT NULL,
  `categorie_cours_id` int(11) DEFAULT NULL,
  `titre` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `duree` varchar(50) NOT NULL,
  `niveau` varchar(50) NOT NULL,
  `instructeur` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `pdf_filename` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cours`
--

INSERT INTO `cours` (`id`, `categorie_cours_id`, `titre`, `description`, `duree`, `niveau`, `instructeur`, `image`, `pdf_filename`) VALUES
(1, 1, 'PHP Symfony Framework', 'Master Symfony framework and build modern web applications', '40 hours', 'Intermediate', NULL, NULL, NULL),
(2, 1, 'python', 'mahboul', '55h', 'facile', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20240217103000', '2025-02-17 10:35:21', 40);

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `capacity` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `events`
--

INSERT INTO `events` (`id`, `titre`, `type`, `capacity`, `date`, `location`) VALUES
(4, 'event 1', 'hackathon', 20, '2025-02-28 00:00:00', 'ariabn'),
(5, 'event 2', 'learning', 100, '2025-03-07 00:00:00', 'Under A Rock'),
(6, 'event 3', 'hackathon', 20, '2025-02-28 00:00:00', 'ariabn'),
(7, 'event 4 *', 'learning', 100, '2025-03-07 00:00:00', 'Under A Rock'),
(8, 'event 5', 'hackathon', 20, '2025-02-28 00:00:00', 'ariabn'),
(9, 'event 6', 'learning', 100, '2025-03-07 00:00:00', 'Under A Rock'),
(10, 'event 7*', 'hackathon', 20, '2025-02-28 00:00:00', 'ariabn'),
(11, 'event 8', 'learning', 100, '2025-03-07 00:00:00', 'Under A Rock');

-- --------------------------------------------------------

--
-- Structure de la table `exercice`
--

CREATE TABLE `exercice` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `titre` varchar(255) NOT NULL,
  `niveau_difficulte` varchar(255) NOT NULL,
  `note_minimale` double NOT NULL,
  `temps_estime` int(11) NOT NULL,
  `fichier_pdf` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `solution` longtext DEFAULT NULL,
  `criteres_evaluation` longtext DEFAULT NULL,
  `type_exercice` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `exercice`
--

INSERT INTO `exercice` (`id`, `user_id`, `titre`, `niveau_difficulte`, `note_minimale`, `temps_estime`, `fichier_pdf`, `type`, `solution`, `criteres_evaluation`, `type_exercice`) VALUES
(1, 1, 'html', 'facile', 10, 15, NULL, 'quiz', '<!DOCTYPE html>\n<html>\n<head>\n    <title>Ma première page</title>\n</head>\n<body>\n    <h1>Bienvenue</h1>\n    <p>Ceci est un paragraphe.</p>\n</body>\n</html>', 'Structure HTML complète,Utilisation correcte des balises head et body,Présence des balises title h1 et p', 'html'),
(3, 1, 'chapitre1 html', 'moyen', 10, 10, 'TP1-SQLAVANCE-67b27a4c8a04e.pdf', 'quiz', '', NULL, 'html'),
(4, 1, 'chapitre1 html', 'facile', 10, 10, 'TP3-2425-enonce-67b27aebb8181.pdf', 'quiz', '<html> \r\n<titre> bonjour </titre>\r\n<p> je suis ....</p>\r\n\r\n</html>', 'Utilisation des balises html ', 'html'),
(5, NULL, 'Exercice de Test - Boucles PHP', 'facile', 10, 30, NULL, '', 'for (let i = 1; i <= 10; i++) {\n    console.log(Nombre );\n}', 'Utilisation de la boucle for,Affichage des nombres de 1 à 10,Template string ES6', 'javascript'),
(6, NULL, 'QCM - Bases HTML', 'facile', 10, 15, NULL, 'quiz', '{\"Question 1: Quelle balise d\\u00e9finit un paragraphe en HTML ?\":[\"<p>\",\"<paragraph>\",\"<text>\",\"<para>\"],\"Question 2: Comment d\\u00e9finir un titre de niveau 1 ?\":[\"<h1>\",\"<heading1>\",\"<title>\",\"<head1>\"]}', 'Connaissance des balises de base,Compréhension de la hiérarchie des titres', 'qcm'),
(7, NULL, 'Vrai/Faux - Les variables en JavaScript', 'facile', 10, 5, NULL, 'quiz', 'true', 'En JavaScript, \"let\" et \"var\" déclarent des variables avec la même portée.', 'true_false'),
(8, NULL, 'Expliquez les boucles en PHP', 'moyen', 12, 20, NULL, 'theory', 'Les boucles en PHP permettent d\'exécuter un bloc de code plusieurs fois. Les principales boucles sont for, while, et foreach.', 'Mention des types de boucles,Explication du fonctionnement,Cas d\'utilisation', 'text');

-- --------------------------------------------------------

--
-- Structure de la table `forum`
--

CREATE TABLE `forum` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `category` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `views` int(11) NOT NULL,
  `replies` int(11) NOT NULL,
  `author` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `inscription`
--

CREATE TABLE `inscription` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date_inscription` datetime NOT NULL,
  `statut` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `inscription_cours`
--

CREATE TABLE `inscription_cours` (
  `id` int(11) NOT NULL,
  `cours_id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `inscription_cours`
--

INSERT INTO `inscription_cours` (`id`, `cours_id`, `nom`, `email`, `telephone`, `created_at`) VALUES
(1, 1, 'sarra', 'sarra@esprit.tn', '25763060', '2025-02-12 14:01:42');

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `participation`
--

CREATE TABLE `participation` (
  `id` int(11) NOT NULL,
  `id_u` int(11) DEFAULT NULL,
  `id_e` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `participation`
--

INSERT INTO `participation` (`id`, `id_u`, `id_e`) VALUES
(22, 6, 5);

-- --------------------------------------------------------

--
-- Structure de la table `publication`
--

CREATE TABLE `publication` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `contenu` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `publication`
--

INSERT INTO `publication` (`id`, `user_id`, `category_id`, `titre`, `date`, `contenu`) VALUES
(1, 1, 2, 'flen', '2025-02-12', 'aaaaaaaaaaaaaaaaaaaaaabbbbbbbbbbbbbbbbbbbbbbbb'),
(2, 1, 2, 'amen', '2025-02-12', 'vhchcghbbbbbbbbbbbbbbb');

-- --------------------------------------------------------

--
-- Structure de la table `reaction`
--

CREATE TABLE `reaction` (
  `id` int(11) NOT NULL,
  `commentaire_id` int(11) DEFAULT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reclamation`
--

CREATE TABLE `reclamation` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `reponse_id` int(11) DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `reclamation` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

CREATE TABLE `reponse` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `reponse` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tentative`
--

CREATE TABLE `tentative` (
  `id` int(11) NOT NULL,
  `exercice_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `statue` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `reponse` longtext NOT NULL,
  `user_id` int(11) NOT NULL,
  `note` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tentative`
--

INSERT INTO `tentative` (`id`, `exercice_id`, `score`, `statue`, `date`, `reponse`, `user_id`, `note`) VALUES
(1, 5, 75, 'reussi', '2025-02-17 10:55:44', '\"for (i=1; i<=10; i++) { console.log(i); }', 1, NULL),
(2, 5, 75, 'reussi', '2025-02-17 10:56:45', '0', 1, NULL),
(4, 5, 33, 'echoue', '2025-02-17 11:03:04', 'for each ', 1, NULL),
(5, 5, 50, 'reussi', '2025-02-17 00:00:00', 'for (let i = 1; i <= 10; i++) { console.log(i); }', 1, NULL),
(6, 1, 0, 'echoue', '2025-02-17 11:14:58', '<', 1, NULL),
(7, 1, 0, 'echoue', '2025-02-17 11:15:37', '<html>\r\n<titre> good morning</titre>\r\n\r\n</html>', 1, NULL),
(8, 1, 0, 'echoue', '2025-02-17 11:16:44', '<html>\r\n<titre> bonjour</titre>\r\n<p>je suis </p> \r\n</html>', 1, NULL),
(9, 1, 0, 'echoue', '2025-02-17 11:17:09', '<html> \r\n<titre> bonjour </titre>\r\n<p> je suis ....</p>\r\n\r\n</html>', 1, NULL),
(10, 1, 100, 'reussi', '2025-02-17 11:26:19', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n    <title>Ma première page</title>\r\n</head>\r\n<body>\r\n    <h1>Bienvenue</h1>\r\n    <p>Ceci est un paragraphe.</p>\r\n</body>\r\n</html>', 1, NULL),
(11, 7, 100, 'reussi', '2025-02-17 11:37:42', 'true', 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `cin` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `phone`, `password`, `name`, `cin`, `image`, `role`) VALUES
(1, 'arfaoui.sarra@esprit.tn', 25763090, '$2y$13$ZgDi4tsVXwBHMUP8MqcSVuG79ERVvMw2k9MAaVI0yCXuQvZtyi5QK', 'sarra', 1441081, 'bbbbbbbbbbbbbbb-67ad09f7a5310.jpg', 'ROLE_ADMIN'),
(2, 'amen.saidani@esprit.tn', 51753119, '$2y$13$jIUcHXnQg/vFZaoMpbWRDunnYD9GWpgZwkGl9xPi9VOTqepGdSrZ.', 'amen ', 11457187, 'bbbbbbbbbbbbbbb-67b0d229bb0b3.jpg', 'ROLE_USER'),
(3, 'ahmed.saidani@esprit.tn', 0, '$2y$13$TIj0WtWcj0oFsSUnKEsgCeaXXk7cygm28lKNZK0rpV5T/KnBCo13O', 'ahmed ', 1154255, 'hhhhhhhhhhh-67b0d3561e931.jpg', 'ROLE_ADMIN'),
(4, 'aymen.landolsi@esprit.tn', 0, '$2y$13$Xllw9b7uDJYbi4Nf6mNrTex4u//55USoB3CSl4uUWyu2vWAeS0n0i', 'aymen', 77777777, '3-67b0d93169f93.png', 'admin'),
(5, 'maram.smati@esprit.tn', 22552720, '$2y$13$w/.orpTgvBeBfy1wYrrx5ePYwYQiCsrX5up4Z.e2mvuCecI.6iS5O', 'maram smati', 14440154, 'OIP-1-67b301326eee8.jpg', 'user'),
(6, 'hamza.ghorbal@esprit.tn', 2147483647, '$2y$13$YnSB5ECBXxVul3XWJotZFuxxKuWtsUXeisDO.feCouEcJFxAk0W8a', 'hamza', 5332412, 'other-67b3988c903ca.jpg', 'admin');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie_cours`
--
ALTER TABLE `categorie_cours`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categorie_publication`
--
ALTER TABLE `categorie_publication`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_67F068BC38B217A7` (`publication_id`),
  ADD KEY `IDX_67F068BCA76ED395` (`user_id`);

--
-- Index pour la table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_FDCA8C9C464839DA` (`categorie_cours_id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `exercice`
--
ALTER TABLE `exercice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E418C74DA76ED395` (`user_id`);

--
-- Index pour la table `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `inscription`
--
ALTER TABLE `inscription`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5E90F6D6A76ED395` (`user_id`);

--
-- Index pour la table `inscription_cours`
--
ALTER TABLE `inscription_cours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_AF83D8D17ECF78B0` (`cours_id`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `participation`
--
ALTER TABLE `participation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_AB55E24FA76ED395` (`id_u`),
  ADD KEY `id_e` (`id_e`);

--
-- Index pour la table `publication`
--
ALTER TABLE `publication`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_AF3C6779A76ED395` (`user_id`),
  ADD KEY `IDX_AF3C677912469DE2` (`category_id`);

--
-- Index pour la table `reaction`
--
ALTER TABLE `reaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_A4D707F7BA9CD190` (`commentaire_id`);

--
-- Index pour la table `reclamation`
--
ALTER TABLE `reclamation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_CE606404A76ED395` (`user_id`),
  ADD KEY `IDX_CE606404CF18BB82` (`reponse_id`);

--
-- Index pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tentative`
--
ALTER TABLE `tentative`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_DBC382F989D40298` (`exercice_id`),
  ADD KEY `IDX_DBC382F9A76ED395` (`user_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie_cours`
--
ALTER TABLE `categorie_cours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `categorie_publication`
--
ALTER TABLE `categorie_publication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `cours`
--
ALTER TABLE `cours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `exercice`
--
ALTER TABLE `exercice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `forum`
--
ALTER TABLE `forum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `inscription`
--
ALTER TABLE `inscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `inscription_cours`
--
ALTER TABLE `inscription_cours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `participation`
--
ALTER TABLE `participation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `publication`
--
ALTER TABLE `publication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `reaction`
--
ALTER TABLE `reaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reclamation`
--
ALTER TABLE `reclamation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reponse`
--
ALTER TABLE `reponse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tentative`
--
ALTER TABLE `tentative`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `FK_67F068BC38B217A7` FOREIGN KEY (`publication_id`) REFERENCES `publication` (`id`),
  ADD CONSTRAINT `FK_67F068BCA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `cours`
--
ALTER TABLE `cours`
  ADD CONSTRAINT `FK_FDCA8C9C464839DA` FOREIGN KEY (`categorie_cours_id`) REFERENCES `categorie_cours` (`id`);

--
-- Contraintes pour la table `exercice`
--
ALTER TABLE `exercice`
  ADD CONSTRAINT `FK_E418C74DA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `inscription`
--
ALTER TABLE `inscription`
  ADD CONSTRAINT `FK_5E90F6D6A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `inscription_cours`
--
ALTER TABLE `inscription_cours`
  ADD CONSTRAINT `FK_AF83D8D17ECF78B0` FOREIGN KEY (`cours_id`) REFERENCES `cours` (`id`);

--
-- Contraintes pour la table `participation`
--
ALTER TABLE `participation`
  ADD CONSTRAINT `FK_AB55E24FA76ED395` FOREIGN KEY (`id_u`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `participation_ibfk_1` FOREIGN KEY (`id_e`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `publication`
--
ALTER TABLE `publication`
  ADD CONSTRAINT `FK_AF3C677912469DE2` FOREIGN KEY (`category_id`) REFERENCES `categorie_publication` (`id`),
  ADD CONSTRAINT `FK_AF3C6779A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `reaction`
--
ALTER TABLE `reaction`
  ADD CONSTRAINT `FK_A4D707F7BA9CD190` FOREIGN KEY (`commentaire_id`) REFERENCES `commentaire` (`id`);

--
-- Contraintes pour la table `reclamation`
--
ALTER TABLE `reclamation`
  ADD CONSTRAINT `FK_CE606404A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_CE606404CF18BB82` FOREIGN KEY (`reponse_id`) REFERENCES `reponse` (`id`);

--
-- Contraintes pour la table `tentative`
--
ALTER TABLE `tentative`
  ADD CONSTRAINT `FK_DBC382F989D40298` FOREIGN KEY (`exercice_id`) REFERENCES `exercice` (`id`),
  ADD CONSTRAINT `FK_DBC382F9A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
