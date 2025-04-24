-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 15 avr. 2025 à 16:34
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
-- Base de données : `devsphere`
--

-- --------------------------------------------------------

--
-- Structure de la table `achat`
--

CREATE TABLE `achat` (
  `id` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_achat` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `bad_word`
--

CREATE TABLE `bad_word` (
  `id` int(11) NOT NULL,
  `word` varchar(255) NOT NULL,
  `severity` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 'Développement Full Stack', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'Beginner'),
(2, 'Développement Web Frontend', 'Apprenez les bases du développement web côté client avec HTML, CSS et JavaScript', 'Beginner'),
(3, 'Développement Web Backend', 'Maîtrisez le développement côté serveur avec PHP et Symfony', 'Intermediate'),
(4, 'Base de données', 'Découvrez la conception et la gestion des bases de données SQL et NoSQL', 'Beginner'),
(5, 'DevOps', 'Explorez les pratiques DevOps, Docker, CI/CD et les outils de déploiement continu', 'Advanced'),
(6, 'Intelligence Artificielle', 'Plongez dans le monde du Machine Learning, Deep Learning et des réseaux de neurones', 'Expert'),
(7, 'Cybersécurité', 'Apprenez à sécuriser vos applications, réseaux et systèmes informatiques', 'Advanced'),
(8, 'Mobile Development', 'Créez des applications mobiles natives et cross-platform avec Flutter et React Native', 'Intermediate'),
(9, 'Cloud Computing', 'Maîtrisez les services cloud AWS, Azure et les architectures distribuées', 'Advanced');

-- --------------------------------------------------------

--
-- Structure de la table `categorie_publication`
--

CREATE TABLE `categorie_publication` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `pdf_filename` varchar(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cours`
--

INSERT INTO `cours` (`id`, `categorie_cours_id`, `titre`, `description`, `duree`, `niveau`, `instructeur`, `image`, `pdf_filename`, `updated_at`) VALUES
(1, 1, 'symfony', 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', '22h', 'Beginner', 'touta', '4ed01c22-71e5-4855-9d33-fa8eb7c712d0-67c4e6b89d0c1901267543.jpg', '67c4c9dfc9429414653920-1-67c4e6b89dee9098959914.pdf', '2025-03-03 00:16:08'),
(2, 1, 'vvvvvvv', 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', '55h', 'Beginner', 'sarra', 'aaaaaaaaa-67c583f07f32f590662948.png', 'cours-symfony-67c583f080601897559426.pdf', '2025-03-03 11:26:56'),
(3, 1, 'HTML5 & CSS3 Fondamentaux', 'Maîtrisez les bases du développement web moderne avec HTML5 et CSS3', '15h', 'Beginner', 'Sarah Martin', 'aaaaaaaaa-67c584054ed4b493974218.png', 'cours-symfony-67c584054fd8d349605344.pdf', '2025-03-03 11:27:17'),
(4, 1, 'JavaScript Moderne', 'Apprenez JavaScript ES6+ et les concepts avancés du développement frontend', '25h', 'Beginner', 'John Smith', 'aaaaaaaaa-67c584054ed4b493974218.png', 'cours-symfony-67c584054fd8d349605344.pdf', NULL),
(5, 1, 'React.js Essentiel', 'Créez des applications web réactives avec React et son écosystème', '30h', 'Intermediate', 'Michael Johnson', 'aaaaaaaaa-67c584054ed4b493974218.png', 'cours-symfony-67c584054fd8d349605344.pdf', NULL),
(6, 2, 'PHP 8 Avancé', 'Découvrez les fonctionnalités avancées de PHP 8 et les bonnes pratiques', '25h', 'Intermediate', 'Marie Dubois', 'aaaaaaaaa-67c584054ed4b493974218.png', 'cours-symfony-67c584054fd8d349605344.pdf', NULL),
(7, 2, 'Symfony 6 Framework', 'Développez des applications robustes avec le framework Symfony', '40h', 'Intermediate', 'Thomas Anderson', 'aaaaaaaaa-67c584054ed4b493974218.png', 'cours-symfony-67c584054fd8d349605344.pdf', NULL),
(8, 2, 'API REST avec Symfony', 'Créez des APIs RESTful sécurisées avec Symfony et API Platform', '20h', 'Advanced', 'Lucas Martin', 'aaaaaaaaa-67c584054ed4b493974218.png', 'cours-symfony-67c584054fd8d349605344.pdf', NULL),
(9, 3, 'MySQL Fondamental', 'Apprenez les bases des bases de données relationnelles avec MySQL', '20h', 'Beginner', 'Emma Wilson', 'aaaaaaaaa-67c584054ed4b493974218.png', 'cours-symfony-67c584054fd8d349605344.pdf', NULL),
(10, 3, 'PostgreSQL Avancé', 'Maîtrisez les fonctionnalités avancées de PostgreSQL', '25h', 'Intermediate', 'David Brown', 'aaaaaaaaa-67c584054ed4b493974218.png', 'cours-symfony-67c584054fd8d349605344.pdf', NULL),
(11, 3, 'MongoDB NoSQL', 'Découvrez le monde des bases de données NoSQL avec MongoDB', '20h', 'Intermediate', 'Sophie Chen', 'aaaaaaaaa-67c584054ed4b493974218.png', 'cours-symfony-67c584054fd8d349605344.pdf', NULL),
(12, 4, 'Docker Essentiel', 'Maîtrisez la conteneurisation avec Docker et Docker Compose', '20h', 'Advanced', 'Alex Turner', 'aaaaaaaaa-67c584054ed4b493974218.png', 'cours-symfony-67c584054fd8d349605344.pdf', NULL),
(13, 4, 'CI/CD avec GitLab', 'Implémentez l\'intégration et le déploiement continus avec GitLab', '25h', 'Advanced', 'James Wilson', 'aaaaaaaaa-67c584054ed4b493974218.png', 'cours-symfony-67c584054fd8d349605344.pdf', NULL),
(14, 4, 'Kubernetes en Production', 'Déployez et gérez des applications conteneurisées avec Kubernetes', '30h', 'Expert', 'Laura Martinez', 'aaaaaaaaa-67c584054ed4b493974218.png', 'cours-symfony-67c584054fd8d349605344.pdf', NULL),
(15, 5, 'Machine Learning Python', 'Initiez-vous au Machine Learning avec Python et scikit-learn', '35h', 'Advanced', 'Pierre Dupont', 'aaaaaaaaa-67c584054ed4b493974218.png', 'cours-symfony-67c584054fd8d349605344.pdf', NULL),
(16, 5, 'Deep Learning avec TensorFlow', 'Créez des réseaux de neurones avec TensorFlow et Keras', '40h', 'Expert', 'Maria Garcia', 'aaaaaaaaa-67c584054ed4b493974218.png', 'cours-symfony-67c584054fd8d349605344.pdf', NULL),
(17, 5, 'NLP Avancé', 'Explorez le traitement du langage naturel avec les transformers', '30h', 'Expert', 'Daniel Lee', 'aaaaaaaaa-67c584054ed4b493974218.png', 'cours-symfony-67c584054fd8d349605344.pdf', NULL),
(18, 6, 'Sécurité Web', 'Apprenez à sécuriser vos applications web contre les attaques courantes', '25h', 'Beginner', 'Nicolas Blanc', 'aaaaaaaaa-67c584054ed4b493974218.png', 'cours-symfony-67c584054fd8d349605344.pdf', NULL),
(19, 6, 'Ethical Hacking', 'Découvrez les techniques de pentest et de sécurité offensive', '35h', 'Advanced', 'Emily Parker', 'aaaaaaaaa-67c584054ed4b493974218.png', 'cours-symfony-67c584054fd8d349605344.pdf', NULL),
(20, 6, 'Cryptographie Appliquée', 'Maîtrisez les concepts de cryptographie moderne et leur implémentation', '30h', 'Advanced', 'Robert Kim', 'aaaaaaaaa-67c584054ed4b493974218.png', 'cours-symfony-67c584054fd8d349605344.pdf', NULL),
(21, 7, 'Flutter Débutant', 'Créez des applications mobiles cross-platform avec Flutter', '25h', 'Beginner', 'Julie Brown', 'aaaaaaaaa-67c584054ed4b493974218.png', 'cours-symfony-67c584054fd8d349605344.pdf', NULL),
(22, 7, 'React Native Avancé', 'Développez des applications mobiles natives avec React Native', '30h', 'Intermediate', 'Mark Davis', 'aaaaaaaaa-67c584054ed4b493974218.png', 'cours-symfony-67c584054fd8d349605344.pdf', NULL),
(23, 7, 'iOS avec Swift', 'Apprenez le développement iOS moderne avec Swift et SwiftUI', '35h', 'Intermediate', 'Anna Wong', 'aaaaaaaaa-67c584054ed4b493974218.png', 'cours-symfony-67c584054fd8d349605344.pdf', NULL),
(24, 8, 'AWS Fondamentaux', 'Découvrez les services essentiels d\'Amazon Web Services', '25h', 'Beginner', 'Chris Anderson', 'aaaaaaaaa-67c584054ed4b493974218.png', 'cours-symfony-67c584054fd8d349605344.pdf', NULL),
(25, 8, 'Azure DevOps', 'Maîtrisez le cloud Microsoft Azure et ses outils DevOps', '30h', 'Advanced', 'Lisa Taylor', 'aaaaaaaaa-67c584054ed4b493974218.png', 'cours-symfony-67c584054fd8d349605344.pdf', NULL),
(26, 8, 'Architecture Cloud', 'Concevez des architectures cloud scalables et résilientes', '35h', 'Expert', 'Paul Martinez', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `participation_id` int(11) DEFAULT NULL,
  `titre` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `capacity` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `type_exercice` varchar(50) NOT NULL,
  `solution` longtext DEFAULT NULL,
  `criteres_evaluation` longtext DEFAULT NULL,
  `description` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `exercice`
--

INSERT INTO `exercice` (`id`, `user_id`, `titre`, `niveau_difficulte`, `note_minimale`, `temps_estime`, `fichier_pdf`, `type`, `type_exercice`, `solution`, `criteres_evaluation`, `description`) VALUES
(9, 1, 'exercice en python', 'facile', 10, 15, 'TD-Pratique-S14-1-67c3d383b75b3.pdf', 'pratique', 'text', 'def est_premier(n):\r\n    if n < 2:\r\n        return False\r\n    for i in range(2, int(n**0.5) + 1):\r\n        if n % i == 0:\r\n            return False\r\n    return True\r\n\r\n# Test\r\nnombre = int(input(\"Entrez un nombre : \"))\r\nif est_premier(nombre):\r\n    print(f\"{nombre} est un nombre premier.\")\r\nelse:\r\n    print(f\"{nombre} n\'est pas un nombre premier.\")', 'Utilisation correcte des conditions et des boucles,\r\nOptimisation de la vérification (jusqu’à √n),\r\nCapacité à gérer les entrées utilisateurs,\r\nRenvoie True pour les nombres premiers et False sinon', '\"Écris une fonction en Python qui vérifie si un nombre donné est un nombre premier.\"'),
(10, 1, 'Exercice en Java', 'moyen', 10, 20, 'sprint-67c3d850e7e8d.pdf', 'pratique', 'text', 'class Etudiant {\r\n    private String nom;\r\n    private int age;\r\n    private double noteMoyenne;\r\n\r\n    public Etudiant(String nom, int age, double noteMoyenne) {\r\n        this.nom = nom;\r\n        this.age = age;\r\n        this.noteMoyenne = noteMoyenne;\r\n    }\r\n\r\n    public void afficherInfos() {\r\n        System.out.println(\"Nom: \" + nom + \", Âge: \" + age + \", Moyenne: \" + noteMoyenne);\r\n    }\r\n\r\n    public boolean estAdmis() {\r\n        return noteMoyenne >= 10;\r\n    }\r\n\r\n    public static void main(String[] args) {\r\n        Etudiant e1 = new Etudiant(\"Alice\", 20, 12.5);\r\n        e1.afficherInfos();\r\n        System.out.println(\"Admis ? \" + e1.estAdmis());\r\n    }\r\n}', 'Création correcte de la classe Etudiant avec les attributs demandés,\r\nUtilisation des méthodes pour afficher les informations et vérifier l’admission,\r\nInstanciation correcte d’un objet et affichage des résultats', '\"Crée une classe Etudiant avec des attributs nom, âge et noteMoyenne. Implémente une méthode pour afficher les informations de l’étudiant et une autre pour vérifier s\'il est admis (note ≥ 10).\"'),
(11, 1, 'exercice en JavaScript', 'difficile', 10, 45, 'exercice-9-2-67c3e2b908ae0.pdf', 'pratique', 'text', 'function genererMotDePasse(longueur) {\r\n    const caracteres = \"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()_+\";\r\n    let motDePasse = \"\";\r\n    for (let i = 0; i < longueur; i++) {\r\n        motDePasse += caracteres.charAt(Math.floor(Math.random() * caracteres.length));\r\n    }\r\n    return motDePasse;\r\n}\r\n\r\n// Test\r\nconst longueur = prompt(\"Entrez la longueur du mot de passe :\");\r\nconsole.log(\"Mot de passe généré : \" + genererMotDePasse(parseInt(longueur)));', 'Utilisation d’une boucle pour générer le mot de passe,\r\nSélection aléatoire de caractères dans une chaîne donnée,\r\nCapacité à gérer une entrée utilisateur pour définir la longueur du mot de passe,\r\nAffichage du mot de passe généré', '\"Crée une fonction en JavaScript qui génère un mot de passe aléatoire de longueur définie par l\'utilisateur, contenant des lettres, chiffres et caractères spéciaux.\"'),
(12, 1, 'Exercice JavaScript', 'facile', 10, 30, 'exercice-10-4-67c452aff38a3.pdf', 'devoir', 'text', '<!DOCTYPE html>\r\n<html lang=\"fr\">\r\n<head>\r\n    <meta charset=\"UTF-8\">\r\n    <title>Nombre Aléatoire</title>\r\n    <script>\r\n        function genererNombre() {\r\n            let nombre = Math.floor(Math.random() * 100) + 1;\r\n            document.getElementById(\"resultat\").innerText = \"Nombre généré : \" + nombre;\r\n        }\r\n    </script>\r\n</head>\r\n<body>\r\n    <h1>Générateur de Nombre Aléatoire</h1>\r\n    <button onclick=\"genererNombre()\">Générer</button>\r\n    <p id=\"resultat\"></p>\r\n</body>\r\n</html>', 'Le bouton déclenche bien la génération du nombre,\r\nUtilisation correcte de JavaScript (Math.random et DOM manipulation),\r\nLe nombre est bien affiché sur la page,\r\nLe script est inclus proprement dans la page HTML,\r\nRespect des bonnes pratiques en JavaScript', '\"Créez une page HTML avec un bouton. Lorsqu\'on clique dessus, un script JavaScript génère un nombre aléatoire entre 1 et 100 et l\'affiche à l\'écran.\"'),
(13, 1, 'Exercice SQL', 'facile', 10, 10, 'exercice-10-resultat-2025-03-02-13-25-67c454a19c2f9.pdf', 'pratique', 'text', 'SELECT * FROM utilisateurs WHERE age >= 18;', 'La requête sélectionne correctement les utilisateurs avec un âge ≥ 18,\r\nUtilisation correcte de la clause WHERE,\r\nRespect de la syntaxe SQL,\r\nUtilisation correcte du SELECT *', '\"Écrivez une requête SQL permettant d\'extraire tous les utilisateurs majeurs (âge ≥ 18) d\'une table nommée utilisateurs.\"');

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
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `user_id` int(11) NOT NULL,
  `date_inscription` datetime NOT NULL,
  `statut` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `inscription_cours`
--

INSERT INTO `inscription_cours` (`id`, `cours_id`, `nom`, `email`, `telephone`, `created_at`, `user_id`, `date_inscription`, `statut`) VALUES
(1, 1, 'sarra', 'sarra@esprit.tn', '25763060', '2025-03-02 23:56:25', 2, '2025-03-02 23:56:25', 'active'),
(2, 1, 'sarra', 'sarra@esprit.tn', '25763060', '2025-03-03 00:06:53', 1, '2025-03-03 00:06:53', 'active'),
(3, 2, 'houda', 'houda@esprit.tn', '26416060', '2025-03-03 00:17:25', 2, '2025-03-03 00:17:25', 'active'),
(4, 1, 'maram', 'maram@gmail.com', '14523696', '2025-03-03 01:16:05', 3, '0000-00-00 00:00:00', ''),
(5, 2, 'maram', 'maram@gmail.com', '14523696', '2025-03-03 01:18:24', 3, '0000-00-00 00:00:00', ''),
(6, 1, 'houda', 'houda@esprit.tn', '25763060', '2025-03-03 01:32:14', 5, '2025-03-03 01:32:14', 'active'),
(7, 2, 'houda', 'houda@esprit.tn', '25763060', '2025-03-03 02:01:08', 5, '2025-03-03 02:01:09', 'active'),
(8, 5, 'anas najjar', 'anas@gmail.com', '25763060', '2025-03-03 11:38:33', 6, '2025-03-03 11:38:33', 'active');

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

--
-- Déchargement des données de la table `messenger_messages`
--

INSERT INTO `messenger_messages` (`id`, `body`, `headers`, `queue_name`, `created_at`, `available_at`, `delivered_at`) VALUES
(1, 'O:36:\\\"Symfony\\\\Component\\\\Messenger\\\\Envelope\\\":2:{s:44:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0stamps\\\";a:1:{s:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\";a:1:{i:0;O:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\":1:{s:55:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\0busName\\\";s:21:\\\"messenger.bus.default\\\";}}}s:45:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0message\\\";O:51:\\\"Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\\":2:{s:60:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0message\\\";O:28:\\\"Symfony\\\\Component\\\\Mime\\\\Email\\\":6:{i:0;N;i:1;N;i:2;s:369:\\\"\n                <h1>Confirmation de votre réclamation</h1>\n                <p>Bonjour,</p>\n                <p>Nous avons bien reçu votre réclamation concernant : bug</p>\n                <p>Notre équipe va traiter votre demande dans les plus brefs délais.</p>\n                <p>Merci de votre confiance,</p>\n                <p>L\\\'équipe DevSphere</p>\n            \\\";i:3;s:5:\\\"utf-8\\\";i:4;a:0:{}i:5;a:2:{i:0;O:37:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\\":2:{s:46:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0headers\\\";a:3:{s:4:\\\"from\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:4:\\\"From\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:21:\\\"devsphere@example.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}}}s:2:\\\"to\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:2:\\\"To\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:19:\\\"anasnajjar@gmailcom\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}}}s:7:\\\"subject\\\";a:1:{i:0;O:48:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:7:\\\"Subject\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:55:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\0value\\\";s:34:\\\"Confirmation de votre réclamation\\\";}}}s:49:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0lineLength\\\";i:76;}i:1;N;}}s:61:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0envelope\\\";N;}}', '[]', 'default', '2025-03-03 10:44:45', '2025-03-03 10:44:45', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `participation`
--

CREATE TABLE `participation` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  `quantité` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `progression_cours`
--

CREATE TABLE `progression_cours` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `cours_id` int(11) DEFAULT NULL,
  `progression` double NOT NULL,
  `dernier_acces` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `progression_cours`
--

INSERT INTO `progression_cours` (`id`, `user_id`, `cours_id`, `progression`, `dernier_acces`) VALUES
(1, 5, 1, 100, '2025-03-03 11:09:04'),
(6, 6, 5, 39.333333333333, '2025-03-03 11:43:32');

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

--
-- Déchargement des données de la table `reclamation`
--

INSERT INTO `reclamation` (`id`, `user_id`, `reponse_id`, `type`, `date`, `reclamation`) VALUES
(2, 2, NULL, 'Feature Request', '2025-04-14 21:32:00', 'Baha ayadi test'),
(3, 3, 4, 'Feature Request', '2025-04-15 09:57:09', 'ayadi');

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

CREATE TABLE `reponse` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `reponse` varchar(255) NOT NULL,
  `reclamation_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `reponse`
--

INSERT INTO `reponse` (`id`, `date`, `reponse`, `reclamation_id`) VALUES
(4, '2025-04-15 14:36:49', 'baha', 3);

-- --------------------------------------------------------

--
-- Structure de la table `tentative`
--

CREATE TABLE `tentative` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `exercice_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `reponse` longtext NOT NULL,
  `date` datetime NOT NULL,
  `statue` varchar(255) NOT NULL,
  `note` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tentative`
--

INSERT INTO `tentative` (`id`, `user_id`, `exercice_id`, `score`, `reponse`, `date`, `statue`, `note`) VALUES
(1, 5, 13, 80, 'select * from utilisateur where age>=18 ;', '2025-03-03 11:11:49', 'reussi', 16),
(2, 2, 13, 80, 'select *  from utilsateurs where age=>18;\r\n', '2025-03-03 11:49:13', 'reussi', 16);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  `cin` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `phone`, `cin`, `image`, `role`) VALUES
(1, 'sarra', 'sarra@gmail.com', '$2y$13$rRayEP6JxqI617NhMLpbX.ff14.lwFenRAfnrpUIri.5hUi81G4re', 25763060, 14441081, '728dedad-f812-415a-8495-aa64ba44a038-67c4d61858823.jpg', 'user'),
(2, 'Admin User', 'admin@devsphere.com', '$2y$13$07zF1JR4zmxE.Z18zavUvucU.XFsDXqRg51aSpSnIyfuFMxPL4dFC', 12345678, 11111111, 'default.jpg', 'admin'),
(3, 'maram', 'maram@gmail.com', '$2y$13$aQSytdPY9FCYfmTzeIPX7uPMFoUgmZjbUKnhsdOLeAYlA63QZ/N9C', 14523696, 12223654, 'aaaaaaaaa-67c4f4aac649c.png', 'user'),
(4, 'amen', 'saidani@gmail.com', '$2y$13$pTY5wlEPrTupkeI8lu1gR.uU2HmpqrPfI.y2DSKxkGMzM.6QKM/DS', 12345678, 12345678, 'aaaaaaaaa-67c4f7fb9d3d6.png', 'user'),
(5, 'houda', 'houda@gmail.com', '$2y$13$6jdG9E1LZax5GaS21fj23epadadnnDabOj6WCb/oWW0DKEGl/AmGK', 25631475, 25631475, 'aaaaaaaaa-67c4f84112339.png', 'user'),
(6, 'anas najar', 'anasnajjar@gmailcom', '$2y$13$x3lVQnNn5QNLX4r5egIJtOvRgzyIkuT/PYPe4tVuP0gH4jvnej4cS', 14758699, 22222222, 'aaaaaaaaa-67c58545821ff.png', 'user'),
(7, 'amen', 'bahaayadi@gmail.com', 'bahaaya123', 53507906, 12374665, 'user_1744726025422_DSC_0210.jpg', 'user'),
(8, 'amen', 'amen@gmail.com', 'amen123', 51515151, 5555454, 'user_1744726804861_DSC_0210.jpg', 'user');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `achat`
--
ALTER TABLE `achat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_achat_produit` (`id_produit`),
  ADD KEY `FK_achat_user` (`user_id`);

--
-- Index pour la table `bad_word`
--
ALTER TABLE `bad_word`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5387574A6ACE3B73` (`participation_id`);

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
  ADD KEY `IDX_AF83D8D17ECF78B0` (`cours_id`),
  ADD KEY `IDX_AF83D8D1A76ED395` (`user_id`);

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
  ADD KEY `IDX_AB55E24FA76ED395` (`user_id`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `progression_cours`
--
ALTER TABLE `progression_cours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_FE6EA16EA76ED395` (`user_id`),
  ADD KEY `IDX_FE6EA16E7ECF78B0` (`cours_id`);

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
  ADD KEY `IDX_DBC382F9A76ED395` (`user_id`),
  ADD KEY `IDX_DBC382F989D40298` (`exercice_id`);

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
-- AUTO_INCREMENT pour la table `achat`
--
ALTER TABLE `achat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `bad_word`
--
ALTER TABLE `bad_word`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `categorie_cours`
--
ALTER TABLE `categorie_cours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `categorie_publication`
--
ALTER TABLE `categorie_publication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `cours`
--
ALTER TABLE `cours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `exercice`
--
ALTER TABLE `exercice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `participation`
--
ALTER TABLE `participation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `progression_cours`
--
ALTER TABLE `progression_cours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `publication`
--
ALTER TABLE `publication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reaction`
--
ALTER TABLE `reaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reclamation`
--
ALTER TABLE `reclamation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `reponse`
--
ALTER TABLE `reponse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `tentative`
--
ALTER TABLE `tentative`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `achat`
--
ALTER TABLE `achat`
  ADD CONSTRAINT `FK_achat_produit` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id`),
  ADD CONSTRAINT `FK_achat_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

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
-- Contraintes pour la table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `FK_5387574A6ACE3B73` FOREIGN KEY (`participation_id`) REFERENCES `participation` (`id`);

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
  ADD CONSTRAINT `FK_AF83D8D17ECF78B0` FOREIGN KEY (`cours_id`) REFERENCES `cours` (`id`),
  ADD CONSTRAINT `FK_AF83D8D1A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `participation`
--
ALTER TABLE `participation`
  ADD CONSTRAINT `FK_AB55E24FA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `progression_cours`
--
ALTER TABLE `progression_cours`
  ADD CONSTRAINT `FK_FE6EA16E7ECF78B0` FOREIGN KEY (`cours_id`) REFERENCES `cours` (`id`),
  ADD CONSTRAINT `FK_FE6EA16EA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

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
