-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le : mar. 25 avr. 2023 à 13:47
-- Version du serveur : 8.0.29
-- Version de PHP : 8.0.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db_name`
--

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

CREATE TABLE `classe` (
  `id` int NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `carac_e` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pv` int NOT NULL,
  `pe` int NOT NULL,
  `competence_niveau` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `classe`
--

INSERT INTO `classe` (`id`, `titre`, `text`, `carac_e`, `pv`, `pe`, `competence_niveau`) VALUES
(1, 'Agent', '<p>L&rsquo;agent poss&egrave;de les comp&eacute;tences pour accomplir presque n&rsquo;importe quelle mission exigeant de la discr&eacute;tion et de la ruse, qu&rsquo;il s&rsquo;agisse d&rsquo;une op&eacute;ration d&rsquo;espionnage ou d&rsquo;&eacute;limination.</p>', 'DEX', 6, 6, 8),
(2, 'Émissaire', '<p>Un &eacute;missaire use de son intelligence et de son magn&eacute;tisme personnel pour aider ses alli&eacute;s et tromper ses ennemis, souvent dans le cadre de n&eacute;gociations ou de d&eacute;marches politiques.</p>', 'CHA', 6, 6, 8),
(3, 'Mécano', '<p>Ma&icirc;trisant l&rsquo;art de la construction et de la modification des appareils, le m&eacute;cano a pour compagnon soit une intelligence artificielle &eacute;volu&eacute;e, soit un drone robot dernier cri.</p>', 'INT', 6, 6, 4),
(4, 'Mystique', '<p>Le mystique canalise par magie l&rsquo;&eacute;nergie qui relie toutes choses souvent gr&acirc;ce &agrave; un lien divin ou la compr&eacute;hension instinctive des syst&egrave;mes biologiques.</p>', 'SAG', 6, 6, 6),
(5, 'Solarien', '<p>Le solarien &eacute;tudie et tire sa puissance du cycle de vie des &eacute;toiles. Ses techniques lui permettent de cr&eacute;er une arme ou une armure &agrave; partir d&rsquo;un fragment d&rsquo;&eacute;nergie stellaire.</p>', 'CHA', 7, 7, 4),
(6, 'Soldat', '<p>Ma&icirc;trisant parfaitement les armes de la guerre, le soldat est pr&ecirc;t &agrave; semer le chaos quand il est n&eacute;cessaire d&rsquo;avoir recours &agrave; la force. Il se sp&eacute;cialise g&eacute;n&eacute;ralement dans une forme de combat.</p>', 'FOR,DEX', 7, 7, 4),
(7, 'Technomancien', '<p>Le technomancien comprend le lien entre la magie et la technologie et l&rsquo;exploite en pliant la r&eacute;alit&eacute; &agrave; sa volont&eacute;, en fonction de ses besoins.</p>', 'INT,DEX', 5, 5, 4);

-- --------------------------------------------------------

--
-- Structure de la table `competence`
--

CREATE TABLE `competence` (
  `id` int NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caracteristique` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `competence`
--

INSERT INTO `competence` (`id`, `titre`, `caracteristique`) VALUES
(1, 'Acrobaties', 'DEX'),
(2, 'Athlétisme', 'FOR'),
(3, 'Buff', 'CHA'),
(4, 'Culture', 'INT'),
(5, 'Déguisement', 'CHA'),
(6, 'Diplomatie', 'CHA'),
(7, 'Discrétion', 'DEX'),
(8, 'Escamotage', 'DEX'),
(9, 'Informatique', 'INT'),
(10, 'Ingénierie', 'INT'),
(11, 'Intimidation', 'CHA'),
(12, 'Médecine', 'INT'),
(13, 'Mysticisme', 'SAG'),
(14, 'Perception', 'SAG'),
(15, 'Pilotage', 'DEX'),
(16, 'Profession', 'CHA,INT,SAG'),
(17, 'Psychologie', 'SAG'),
(18, 'Science de la vie', 'INT'),
(19, 'sciences physiques', 'INT'),
(20, 'Survie', 'SAG');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220705181847', '2022-07-27 15:29:18', 653),
('DoctrineMigrations\\Version20220711193844', '2022-07-27 15:29:19', 20),
('DoctrineMigrations\\Version20220711232438', '2022-07-27 15:29:19', 13),
('DoctrineMigrations\\Version20220711233234', '2022-07-27 15:29:19', 12),
('DoctrineMigrations\\Version20220711235736', '2022-07-27 15:29:19', 9),
('DoctrineMigrations\\Version20220725212308', '2022-07-27 15:29:19', 11),
('DoctrineMigrations\\Version20220725214411', '2022-07-27 15:29:19', 27),
('DoctrineMigrations\\Version20220726194908', '2022-07-27 15:29:19', 201),
('DoctrineMigrations\\Version20220726203823', '2022-07-27 15:29:19', 10),
('DoctrineMigrations\\Version20220726205115', '2022-07-27 15:29:19', 10),
('DoctrineMigrations\\Version20220726205912', '2022-07-27 15:29:19', 96),
('DoctrineMigrations\\Version20220728201356', '2022-07-28 20:23:36', 684),
('DoctrineMigrations\\Version20230411161212', '2023-04-11 16:12:55', 743);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personnage`
--

CREATE TABLE `personnage` (
  `id` int NOT NULL,
  `classe_id` int NOT NULL,
  `race_id` int NOT NULL,
  `themes_id` int NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `carac_for` int NOT NULL,
  `carac_dex` int NOT NULL,
  `carac_con` int NOT NULL,
  `carac_int` int NOT NULL,
  `carac_sag` int NOT NULL,
  `mod_force` int NOT NULL,
  `mod_dex` int NOT NULL,
  `mod_con` int NOT NULL,
  `mod_int` int NOT NULL,
  `mod_sag` int NOT NULL,
  `mod_cha` int NOT NULL,
  `pe` int NOT NULL,
  `pv` int NOT NULL,
  `pp` int NOT NULL,
  `cae` int NOT NULL,
  `cac` int NOT NULL,
  `vigueur` int NOT NULL,
  `reflexe` int NOT NULL,
  `volonte` int NOT NULL,
  `att_cac` int NOT NULL,
  `att_dist` int NOT NULL,
  `att_lancer` int NOT NULL,
  `carac_cha` int NOT NULL,
  `points_competence` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `personnage`
--

INSERT INTO `personnage` (`id`, `classe_id`, `race_id`, `themes_id`, `nom`, `carac_for`, `carac_dex`, `carac_con`, `carac_int`, `carac_sag`, `mod_force`, `mod_dex`, `mod_con`, `mod_int`, `mod_sag`, `mod_cha`, `pe`, `pv`, `pp`, `cae`, `cac`, `vigueur`, `reflexe`, `volonte`, `att_cac`, `att_dist`, `att_lancer`, `carac_cha`, `points_competence`) VALUES
(1, 4, 3, 4, 'test 1', 12, 12, 11, 8, 12, 1, 1, 0, -1, 1, 0, 6, 10, 0, 11, 11, 0, 1, 1, 1, 1, 1, 10, 10),
(2, 6, 7, 6, 'sullivan ange', 13, 10, 12, 8, 10, 1, 0, 1, -1, 0, 0, 8, 13, 0, 10, 10, 1, 0, 0, 1, 1, 1, 10, 10);

-- --------------------------------------------------------

--
-- Structure de la table `perso_competence`
--

CREATE TABLE `perso_competence` (
  `id` int NOT NULL,
  `comp_classe` tinyint(1) NOT NULL,
  `rang` int DEFAULT NULL,
  `bonus_classe` int DEFAULT NULL,
  `mod_carac` int DEFAULT NULL,
  `mod_divers` int DEFAULT NULL,
  `personnage_id` int DEFAULT NULL,
  `competence_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `perso_competence`
--

INSERT INTO `perso_competence` (`id`, `comp_classe`, `rang`, `bonus_classe`, `mod_carac`, `mod_divers`, `personnage_id`, `competence_id`) VALUES
(36, 0, 0, 0, 1, 0, 1, 1),
(37, 1, 1, 3, 1, 0, 1, 2),
(38, 0, 0, 0, 0, 0, 1, 3),
(39, 0, 0, 0, -1, 0, 1, 4),
(40, 0, 0, 0, 0, 0, 1, 5),
(41, 0, 0, 0, 0, 0, 1, 6),
(42, 0, 0, 0, 1, 0, 1, 7),
(43, 0, 0, 0, 1, 0, 1, 8),
(44, 1, 0, 0, -1, 0, 1, 9),
(45, 0, 0, 0, -1, 0, 1, 10),
(46, 0, 0, 0, 0, 0, 1, 11),
(47, 0, 0, 0, -1, 0, 1, 12),
(48, 0, 0, 0, 1, 0, 1, 13),
(49, 0, 0, 0, 1, 0, 1, 14),
(50, 0, 0, 0, 1, 0, 1, 15),
(51, 0, 0, 0, 0, 0, 1, 16),
(52, 0, 0, 0, 1, 0, 1, 17),
(53, 0, 0, 0, -1, 0, 1, 18),
(54, 0, 0, 0, -1, 0, 1, 19),
(55, 0, 0, 0, 1, 0, 1, 20),
(56, 0, 0, 0, 0, 0, 2, 1),
(57, 0, 0, 0, 1, 0, 2, 2),
(58, 0, 0, 0, 0, 0, 2, 3),
(59, 0, 0, 0, -1, 0, 2, 4),
(60, 0, 0, 0, 0, 0, 2, 5),
(61, 0, 0, 0, 0, 0, 2, 6),
(62, 0, 0, 0, 0, 0, 2, 7),
(63, 0, 0, 0, 0, 0, 2, 8),
(64, 0, 0, 0, -1, 0, 2, 9),
(65, 0, 0, 0, -1, 0, 2, 10),
(66, 0, 0, 0, 0, 0, 2, 11),
(67, 0, 0, 0, -1, 0, 2, 12),
(68, 0, 0, 0, 0, 0, 2, 13),
(69, 0, 0, 0, 0, 0, 2, 14),
(70, 0, 0, 0, 0, 0, 2, 15),
(71, 0, 0, 0, 0, 0, 2, 16),
(72, 0, 0, 0, 0, 0, 2, 17),
(73, 0, 0, 0, -1, 0, 2, 18),
(74, 0, 0, 0, -1, 0, 2, 19),
(75, 0, 0, 0, 0, 0, 2, 20);

-- --------------------------------------------------------

--
-- Structure de la table `race`
--

CREATE TABLE `race` (
  `id` int NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bonus_for` int DEFAULT NULL,
  `bonus_dex` int DEFAULT NULL,
  `bonus_con` int DEFAULT NULL,
  `bonus_int` int DEFAULT NULL,
  `bonus_sag` int DEFAULT NULL,
  `bonus_cha` int DEFAULT NULL,
  `bonus_choix` tinyint(1) DEFAULT NULL,
  `text` longtext COLLATE utf8mb4_unicode_ci,
  `pv` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `race`
--

INSERT INTO `race` (`id`, `titre`, `bonus_for`, `bonus_dex`, `bonus_con`, `bonus_int`, `bonus_sag`, `bonus_cha`, `bonus_choix`, `text`, `pv`) VALUES
(1, 'Androïdes', 0, 2, 0, 2, 0, -2, 0, '<p>Les andro&iuml;des sont des cr&eacute;atures artificielles, compos&eacute;es d&rsquo;&eacute;l&eacute;ments aussi bien biologiques qu&rsquo;artificiels, qui, &agrave; l&rsquo;origine, ont &eacute;t&eacute; cr&eacute;&eacute;es par les humains pour &ecirc;tre des serviteurs. Ils sont aujourd&rsquo;hui affranchis et libres de poursuivre leur propre destin&eacute;e parmi les &eacute;toiles</p>', 4),
(2, 'Humains', 0, 0, 0, 0, 0, 0, 1, '<p>Pr&eacute;sents presque partout dans les Mondes du Pacte, les humains se sont r&eacute;pandus &agrave; travers les &eacute;toiles depuis la disparition de leur monde natal de Golarion. Ils ont la r&eacute;putation d&rsquo;&ecirc;tre curieux, tenaces et d&rsquo;avoir une grande facult&eacute; d&rsquo;adaptation.</p>', 4),
(3, 'Kasathas', 2, 0, 0, -2, 2, 0, 0, '<p>Ancienne race d&rsquo;&ecirc;tres dot&eacute;s de quatre bras, venus d&rsquo;un lointain syst&egrave;me stellaire, les kasathas sont de fervents traditionalistes dont les coutumes leur conf&egrave;rent vis-&agrave;-vis des autres races une aura de sagesse et de myst&egrave;re.</p>', 4),
(4, 'Lashuntas (damayas)', 0, 0, -2, 2, 0, 2, 0, '<p>Les lashuntas ont des dons psychiques naturels. Ils regroupent en fait deux races&nbsp;: les damayas sont constitu&eacute;e d&rsquo;individus grands et maigres. Les deux fascinent tout autant les autres races et elles se consacrent &agrave; l&rsquo;&eacute;rudition pour atteindre la perfection.</p>', 4),
(5, 'Lashuntas (korashas)', 2, 0, 0, 0, -2, 2, 0, '<p>Les lashuntas ont des dons psychiques naturels. Ils regroupent en fait deux races&nbsp;: les korashas sont compos&eacute;s d&rsquo;individus petits et puissants. Les deux fascinent tout autant les autres races et elles se consacrent &agrave; l&rsquo;&eacute;rudition pour atteindre la perfection.</p>', 4),
(6, 'Shirrens', 0, 0, 2, 0, 2, -2, 0, '<p>Autrefois int&eacute;gr&eacute;s &agrave; une terrifiante intelligence collective qui d&eacute;vore tout sur son passage, les shirrens insecto&iuml;des ont mut&eacute; et sont parvenus &agrave; &eacute;chapper &agrave; son emprise. Ce sont aujourd&rsquo;hui des individus ind&eacute;pendants &eacute;pris de la libert&eacute; de choix mais qui conservent un fort attachement communautaire.</p>', 6),
(7, 'Vesks', 2, 0, 2, -2, 0, 0, 0, '<p>Vou&eacute;s &agrave; la conqu&ecirc;te et &agrave; la domination, les vesks reptiliens viennent tr&egrave;s r&eacute;cemment de mettre un terme &agrave; leur longue guerre contre les autres races des Mondes du Pacte. Cependant, beaucoup se m&eacute;fient encore d&rsquo;eux malgr&eacute; leur sens de l&rsquo;honneur et leur utilit&eacute; au combat.</p>', 6),
(8, 'Ysokis', -2, 2, 0, 2, 0, 0, 0, '<p>Passionn&eacute;s et bagarreurs, les ysokis sont des &ecirc;tres &eacute;voquant des rats. Ce sont des experts aussi bien dans l&rsquo;art de se fourrer dans le p&eacute;trin que de s&rsquo;en sortir. Leur amour de la technologie, de l&rsquo;exploration et des aventures les pousse &agrave; voyager &agrave; travers la galaxie.</p>', 2);

-- --------------------------------------------------------

--
-- Structure de la table `themes`
--

CREATE TABLE `themes` (
  `id` int NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bonus_for` int NOT NULL,
  `bonus_dex` int NOT NULL,
  `bonus_con` int NOT NULL,
  `bonus_int` int NOT NULL,
  `bonus_sag` int NOT NULL,
  `bonus_cha` int NOT NULL,
  `bonus_choix` tinyint(1) DEFAULT NULL,
  `txt` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `themes`
--

INSERT INTO `themes` (`id`, `titre`, `bonus_for`, `bonus_dex`, `bonus_con`, `bonus_int`, `bonus_sag`, `bonus_cha`, `bonus_choix`, `txt`) VALUES
(1, 'Chasseur de primes', 0, 0, 1, 0, 0, 0, 0, '<p>Rien ou presque ne peut vous emp&ecirc;cher de traquer vos proies et de les ramener mortes ou vives</p>'),
(2, 'Érudit', 0, 0, 0, 1, 0, 0, 0, '<p>En tant qu&rsquo;universitaire, vous avez assimil&eacute; une solide base de connaissances diverses et vous &ecirc;tes toujours avide d&rsquo;en savoir plus</p>'),
(3, 'Explorateur stellaire', 0, 0, 1, 0, 0, 0, 0, '<p>Vous vivez au milieu des &eacute;toiles &agrave; la recherche de mondes nouveaux &agrave; explorer et &ecirc;tes toujours pr&ecirc;t pour l&rsquo;aventure.</p>'),
(4, 'Hors-la-loi', 0, 1, 0, 0, 0, 0, 0, '<p>Que vous soyez coupable ou non, vous &ecirc;tes un criminel recherch&eacute; dans une cit&eacute;, sur une plan&egrave;te ou m&ecirc;me dans toute la galaxie.</p>'),
(5, 'Icône', 0, 0, 0, 0, 0, 1, 0, '<p>Vous &ecirc;tes une c&eacute;l&eacute;brit&eacute; populaire et respect&eacute;e au sein de l&rsquo;espace colonis&eacute;</p>'),
(6, 'Mercenaire', 1, 0, 0, 0, 0, 0, 0, '<p>Vous &ecirc;tes un mercenaire convenablement entra&icirc;n&eacute; qui joue un r&ocirc;le essentiel aux c&ocirc;t&eacute;s de vos compagnons lors des combats</p>'),
(7, 'Pilote de chasse', 0, 1, 0, 0, 0, 0, 0, '<p>Gr&acirc;ce &agrave; vos mains toujours fermes et vos nerfs d&rsquo;acier, vous &ecirc;tes devenu un pilote comp&eacute;tent de vaisseaux spatiaux et d&rsquo;autres v&eacute;hicules</p>'),
(8, 'Prêtre', 0, 0, 0, 0, 1, 0, 0, '<p>Votre in&eacute;branlable d&eacute;votion &agrave; une philosophie ou une religion compose l&rsquo;essentiel de votre personnalit&eacute;.</p>'),
(9, 'Xéno-chercheur', 0, 0, 0, 0, 0, 1, 0, '<p>En voyageant au-del&agrave; des fronti&egrave;res de l&rsquo;espace des Mondes du Pacte, vous vous efforcez d&rsquo;&eacute;tablir des contacts avec des formes de vie extraterrestres</p>');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `competence`
--
ALTER TABLE `competence`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `personnage`
--
ALTER TABLE `personnage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6AEA486D8F5EA509` (`classe_id`),
  ADD KEY `IDX_6AEA486D6E59D40D` (`race_id`),
  ADD KEY `IDX_6AEA486D94F4A9D2` (`themes_id`);

--
-- Index pour la table `perso_competence`
--
ALTER TABLE `perso_competence`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_8885BE145E315342` (`personnage_id`),
  ADD KEY `IDX_8885BE1415761DAB` (`competence_id`);

--
-- Index pour la table `race`
--
ALTER TABLE `race`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `classe`
--
ALTER TABLE `classe`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `competence`
--
ALTER TABLE `competence`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `personnage`
--
ALTER TABLE `personnage`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `perso_competence`
--
ALTER TABLE `perso_competence`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT pour la table `race`
--
ALTER TABLE `race`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `themes`
--
ALTER TABLE `themes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `personnage`
--
ALTER TABLE `personnage`
  ADD CONSTRAINT `FK_6AEA486D6E59D40D` FOREIGN KEY (`race_id`) REFERENCES `race` (`id`),
  ADD CONSTRAINT `FK_6AEA486D8F5EA509` FOREIGN KEY (`classe_id`) REFERENCES `classe` (`id`),
  ADD CONSTRAINT `FK_6AEA486D94F4A9D2` FOREIGN KEY (`themes_id`) REFERENCES `themes` (`id`);

--
-- Contraintes pour la table `perso_competence`
--
ALTER TABLE `perso_competence`
  ADD CONSTRAINT `FK_8885BE1415761DAB` FOREIGN KEY (`competence_id`) REFERENCES `competence` (`id`),
  ADD CONSTRAINT `FK_8885BE145E315342` FOREIGN KEY (`personnage_id`) REFERENCES `personnage` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
