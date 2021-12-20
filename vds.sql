-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 25 nov. 2021 à 18:59
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `vds`
--

-- --------------------------------------------------------

--
-- Structure de la table `vds_msg`
--

CREATE TABLE `vds_msg` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `content` text NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'delivered',
  `created_at` datetime NOT NULL,
  `modified_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `vds_msg`
--

INSERT INTO `vds_msg` (`id`, `id_user`, `name`, `email`, `content`, `status`, `created_at`, `modified_at`) VALUES
(3, NULL, 'joh', 'michel@gmail.com', 'Je suis ravis', 'delivered', '2021-11-22 16:47:28', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `vds_testimonial`
--

CREATE TABLE `vds_testimonial` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime DEFAULT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'draft'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `vds_testimonial`
--

INSERT INTO `vds_testimonial` (`id`, `id_user`, `content`, `created_at`, `modified_at`, `status`) VALUES
(4, 8, 'Une amie m\'a recommandé la Vacuna Del Sol et honnêtement je ne suis pas déçu du résultat.', '2021-11-24 14:25:55', '2021-11-24 15:05:20', 'publish'),
(5, 10, 'une équipe performante, avec une bonne réactivité avec un site facile d\'accès et fluide', '2021-11-24 14:26:46', '2021-11-24 15:05:21', 'publish'),
(6, 13, 'VRAIMENT AU TOP ! je suis agréablement surpris, le fait d\'avoir des rappels pour les vaccins est vraiment top.', '2021-11-24 14:28:17', '2021-11-24 15:05:23', 'publish'),
(8, 5, 'le profil est simple d\'accès, et de plus super fluide, rien à dire, je peux désormais être au courant de mes vaccins et être à jour', '2021-11-24 14:30:42', '2021-11-24 15:05:27', 'publish'),
(9, 6, 'le fait de pouvoir insérer des vaccins déjà fait et d\'avoir un suivi sur nos vaccins est vraiment chouette de plus le site est classe', '2021-11-24 14:31:08', '2021-11-24 15:05:31', 'publish');

-- --------------------------------------------------------

--
-- Structure de la table `vds_users`
--

CREATE TABLE `vds_users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `prenom` varchar(200) NOT NULL,
  `dob` date NOT NULL,
  `sexe` char(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime DEFAULT NULL,
  `last_log` datetime NOT NULL,
  `role` varchar(30) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `vds_users`
--

INSERT INTO `vds_users` (`id`, `name`, `prenom`, `dob`, `sexe`, `email`, `password`, `token`, `created_at`, `modified_at`, `last_log`, `role`) VALUES
(5, 'joh', 'qwert', '0000-00-00', 'homme', 'jo@gmail.com', '$2y$10$i5k2yTVvLErWrsD/./.lduOx1LNc58MgXCb1e1vWgTxYprRNxBryK', 'qY8X5XrbSybI0FxYFziK8dice7ZPMUV7W2fieyRsIfbNR5qxIjb1xuNRvGMlvdnU8G2UVgLV6q4yHNm195O8o6knQGQokgZZ8q6P', '2021-11-19 16:47:09', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'user'),
(6, 'Michel', 'qwert', '2021-11-08', 'homme', 'michel@gmail.com', '$2y$10$TpdLtjNzU5LORZ.EpujL0.6V3BXvUuC4oxp3e80A7nFLJTgvl2nTW', 'c6pKajQFzPavJh0VFNGnFtG6DLDphcGgISeBbfMD8kL0LQ2WVrsUGeUo7DMGE8iVnfGV4z7y6LtPsA90aKL12wDxHqjQkymArnbK', '2021-11-19 16:56:23', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'user'),
(8, 'dls', 'mathis', '2001-03-01', 'homme', 'mathisdllss@gmail.com', '$2y$10$zV3fC/irX1Iy8f8HYlTj8ezg5CPoQi9xeaKVnp6KW4JZcP9WjG7la', 'B8yiAYCLAidXxuyQuCP4nrWH38Rl6WPiaMGulWcnTzdVWwjViHm0rOPa5s1feoU3Icyhb7UiFND9fdkWeTlsZ1gIk9wbRhzLu2wl', '2021-11-23 13:04:15', NULL, '0000-00-00 00:00:00', 'admin'),
(10, 'Dupont', 'Delphine', '1991-12-31', 'femme', 'DelphineDupont@gmail.com', '$2y$10$rul3ClsjmUlfWls6OXaF9uNchmDi6jrIlXPhWfwHavJU3rahF4kPy', 'Q5pkUQVap44LA2QlTVh5WI6uHeRgbABazALJv80wAEMeIjEr3FzvEG860UT9BBZdO0jIedw7lpVYUR14ChttDfzqewdb8PoB1xL1', '2021-11-24 16:32:49', NULL, '0000-00-00 00:00:00', 'user'),
(11, 'Dutronc', 'Marc', '1979-06-06', 'homme', 'MarcDutronc@gmail.com', '$2y$10$6v7uqkfTwux.GuAKejRUKOLHxz563TLewehVROfX5uV.fedU3.Al6', 'VWk6NAcTAXhlGQbG9yZi3AosmMy005Jzfe0Ucys7htl4Bl7lCNOCzMjGrXlKJqZwQt6qz2ybi2kAp8ap66tuMmn6NCiykIJbKxLD', '2021-11-24 16:33:58', NULL, '0000-00-00 00:00:00', 'user'),
(12, 'Dunom', 'Hervé', '1964-06-10', 'homme', 'HerveDunom@gmail.com', '$2y$10$bpk3IaIciEsbLpfqP3egNeWp.gOD4bhxesdnlwCuD3oD4jnR23i/C', 'U03ddw4IG9CHSxpatGpTN9HJBNlGZqBDFuY8HQ0AmtK1cwYA8z2qe1jYjEtE5WFlBkGcAMgtKKrWeAMrouk3zj8ctAkgxtJvCdfK', '2021-11-24 16:34:43', NULL, '0000-00-00 00:00:00', 'user'),
(13, 'Larim', 'Karim', '1998-11-24', 'homme', 'KarimLarim@gmail.com', '$2y$10$0QZXgQ4wUqsTKUrk3whpre/RW7ow/KGEhgw7Bmr.BNPD.UhNejchC', 'WmQN0O5eY5WPh9kXfXqU8wBIRuoEdsdYAEgisbYSpt7etYEHXrywCdfIoTeOcIcFDGhz7ScczfXuEnS11xcxRgS7NO8E8yKTyCOC', '2021-11-24 16:35:34', '2021-11-25 14:43:02', '0000-00-00 00:00:00', 'user'),
(14, 'Vic', 'Lucie', '1998-10-14', 'femme', 'LucieVic@gmail.com', '$2y$10$jNeDCRysPYmHlrRuuP6mQefRE6ttSn3ZvfNJGXWx6tgBCCZiulKo2', 'GaBYWtCmIMSLNaxSpifaJH3udBZcU5x8VYYh1vQhWm5Bg2QoPc7CLtNAuFV7As35tN3cvIbjgyYthB8zJNlAUXwKaz8BWpMc8NdV', '2021-11-24 16:37:49', NULL, '0000-00-00 00:00:00', 'user'),
(15, 'Michel', 'Jean', '2000-01-01', 'homme', 'michel.jean@gmail.com', '$2y$10$ZSgxoi9orBz/SUknqkBw8eywLvPoZsg7jhtR9mCYnSiBwMhm7nfyu', 'b5N2YQ1ULKD55DtofyuKR4KIODOZFZ2jBAQUIUuVTLUmZPyk4OFJ5olwuBQQtprpLy9HC1WBHn12pckIJpwTTDuYB59NKqT0Ag0V', '2021-11-25 12:08:13', NULL, '0000-00-00 00:00:00', 'admin'),
(16, 'admin', 'michel', '1970-01-01', 'homme', 'admin@gmail.com', '$2y$10$QB3oosQxlKGxgkC5ZapFe.QuSSNKQeV.aoQO0AMpe5SBj8eAu.AXq', 'wTlEo2CUiEyffi3B0eRh7lTEwKkj26qHpR3eCxtUuzzkB97JzTqs56mUf8IKG04MkngFAXd8r8iGG2xehwYGdIGxqmWQs34oKGxN', '2021-11-25 18:46:42', NULL, '0000-00-00 00:00:00', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `vds_user_vaccin`
--

CREATE TABLE `vds_user_vaccin` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_vaccin` int(11) NOT NULL,
  `vaccin_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `vds_user_vaccin`
--

INSERT INTO `vds_user_vaccin` (`id`, `id_user`, `id_vaccin`, `vaccin_at`, `created_at`) VALUES
(1, 6, 1, '2021-11-23 09:31:19', '2021-11-23 09:31:19'),
(3, 6, 2, '2021-11-23 09:32:12', '2021-11-23 09:32:12'),
(4, 7, 2, '2021-11-23 00:00:00', '2021-11-23 00:00:00'),
(5, 8, 1, '2021-11-23 14:47:48', '2021-11-23 14:47:48'),
(6, 8, 2, '2021-11-23 14:47:48', '2021-11-23 14:47:48'),
(7, 8, 7, '2020-01-01 15:19:32', '2021-11-23 15:19:32'),
(8, 8, 9, '2000-01-01 00:00:00', '2021-11-23 16:14:07');

-- --------------------------------------------------------

--
-- Structure de la table `vds_vaccin`
--

CREATE TABLE `vds_vaccin` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `rappel` int(4) NOT NULL,
  `obligatoire` varchar(50) NOT NULL DEFAULT 'non-obligatoire',
  `status` varchar(30) NOT NULL DEFAULT 'draft',
  `created_at` datetime NOT NULL,
  `modified_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `vds_vaccin`
--

INSERT INTO `vds_vaccin` (`id`, `name`, `content`, `rappel`, `obligatoire`, `status`, `created_at`, `modified_at`) VALUES
(1, 'Coqueluche', 'La coqueluche est une maladie provoquée par la bactérie Bordetella pertussis. Elle se manifeste par des accès de toux, des difficultés à respirer (surtout à l’inspiration), et des vomissements provoqués…', 120, 'non-obligatoire', 'publish', '2021-11-24 15:32:50', '2021-11-25 14:29:27'),
(2, 'Tétanos', 'La bactérie responsable du tétanos (Clostridium tetani) se trouve partout, et en particulier dans la terre et la poussière ramenée de l’extérieur. La bactérie sécrète une toxine qui provoque la maladie.', 120, 'non-obligatoire', 'publish', '2021-11-24 15:32:50', NULL),
(3, 'Hépatite A', 'Le virus de l’hépatite A est transmis par de l’eau, des jus ou des aliments insuffisamment cuits (salades, fruits non pelés, fruits de mer, glaçons), essentiellement dans des pays où les conditions d’hygiène peuvent être insuffisantes (Asie y compris la Turquie, tout le continent africain, Amérique centrale et du Sud, Europe de l’Est).', 120, 'non-obligatoire', 'publish', '2021-11-24 15:32:50', NULL),
(4, 'Hépatite B', 'Le virus de l’hépatite B s’attrape par contact avec le sang, ou lors de rapports sexuels non protégés avec une personne infectée. La phase aiguë se manifeste par une jaunisse (coloration jaune de la peau et des yeux), de la fatigue et des vomissements. Elle peut cependant aussi passer inaperçue.', 120, 'non-obligatoire', 'publish', '2021-11-24 15:32:50', NULL),
(5, 'Rubéole', 'La rubéole est due au Rubivirus, qui provoque de petites taches roses sur la peau, des ganglions dans le cou, et parfois une conjonctivite. Chez les adultes, elle peut aussi provoquer des inflammations des articulations (rhumatisme).', 120, 'non-obligatoire', 'publish', '2021-11-24 15:32:50', NULL),
(13, 'Coronavirus (COVID-19)', 'Le COVID-19 est une maladie provoquée par le coronavirus SARS-CoV-2.\r\n\r\nIl peut se manifester de différentes manières, mais les symptômes les plus courants sont :\r\n\r\n-Symptômes d’affection aiguë des voies respiratoires (maux de gorge, toux (surtout sèche), \r\n-insuffisance respiratoire, douleurs dans la poitrine)\r\nFièvre\r\n-Perte soudaine de l’odorat et/ou du goût', 120, 'non-obligatoire', 'publish', '2021-11-24 15:32:50', NULL),
(14, 'Diphtérie', 'La diphtérie est une maladie provoquée par la bactérie Corynebacterium diphtheriae. Elle n’existe que chez l’Homme et est transmise par des gouttelettes de sécrétions lors de toux ou d’éternuement, plus rarement par le contact des mains.', 120, 'non-obligatoire', 'publish', '2021-11-24 15:32:50', NULL),
(15, 'Fièvre jaune', 'La fièvre jaune est une maladie virale, parfois mortelle, transmise par les moustiques.\r\n\r\nDans les 3 à 6 jours suivant l\'infection survient une fièvre importante, des frissons, des maux de tête et des douleurs musculaires, des nausées et des vomissements. Les patients atteints de cette forme bénigne guérissent en 3-4 jours.', 120, 'non-obligatoire', 'publish', '2021-11-24 15:32:50', NULL),
(16, 'Fièvre typhoïde', 'La fièvre typhoïde est une maladie grave provoquée par la bactérie Salmonella typhi. L\'infection se transmet par l\'eau potable ou des aliments (crustacés, crèmes glacées, pâtisseries, sauces, etc.) contaminés par les matières fécales de personnes infectées.', 120, 'non-obligatoire', 'publish', '2021-11-24 15:32:50', NULL),
(17, 'Grippe (influenza)', 'La grippe est une maladie provoquée par les virus Influenza A et Influenza B.\r\n\r\nLes premiers symptômes de la grippe incluent notamment une sensation de malaise général, un abattement, une brusque poussée de fièvre, des frissons, des maux de tête, des douleurs musculaires et articulaires, généralement suivis d’une perte d’appétit et de vertiges. Fréquemment, les patients font état de gêne oculaire, notamment lors de mouvements latéraux, de photophobie, de larmoiements et de sensations de brûlure.', 120, 'non-obligatoire', 'publish', '2021-11-24 15:32:50', NULL),
(18, 'Haemophilus influenzae b', 'Haemophilus influenzae type b (Hib) est le nom de la bactérie qui provoque chez les nourrissons et les petits enfants une méningite purulente ou une inflammation de l’épiglotte pouvant conduire à un étouffement rapide. Même en administrant des antibiotiques efficaces, cette maladie entraîne dans un cas sur 10 des séquelles graves et irréversibles comme une surdité, un handicap physique ou mental – ou même la mort.', 120, 'non-obligatoire', 'publish', '2021-11-24 15:32:50', NULL),
(19, 'HPV – virus du papillome humain', 'Il existe plus d’une centaine de virus du papillome humain (HPV) qui infectent la peau ou les muqueuses génitales. Ces virus se transmettent très facilement au cours des relations sexuelles, par simple contact avec la peau ou les muqueuses infectées. Certaines souches de virus HPV provoquent des verrues génitales et d’autres des lésions précancéreuses et cancéreuses des régions génitales, de la bouche ou de la gorge.', 120, 'non-obligatoire', 'publish', '2021-11-24 15:32:50', NULL),
(20, 'Méningo-encéphalite à tiques', 'Les tiques peuvent être infectées par plusieurs microbes et donc transmettre diverses maladies. Les deux plus importantes sont la borréliose (maladie de Lyme, provoquée par la bactérie Borrelia burgdorferi) et la méningo-encéphalite à tiques provoquée par le virus FSME et connue sous le nom de méningo-encéphalite \"vernoestivale\" par référence aux saisons (printemps-été) pendant lesquelles elle sévit. Le risque de d’attraper ces deux maladies peut être diminué en se protégeant contre les tiques (habits, produits repellents, etc.)', 120, 'non-obligatoire', 'publish', '2021-11-24 15:32:50', NULL),
(21, 'Méningocoques', 'Dans la population, environ 15% des personnes portent la bactérie Neisseria meningitidis (méningocoque) dans le nez ou la gorge, sans être malades. Il y a cinq principaux types de méningocoques (A, B, C, W et Y). Si certaines souches de ces bactéries traversent les muqueuses et envahissent le sang, elles peuvent provoquer de graves maladies. Les complications sont fréquentes lors d’une infection à méningocoques. Les méningites purulentes ou les infections généralisées du sang (septicémies) à méningocoques font partie des maladies les plus graves menaçant la vie.', 120, 'non-obligatoire', 'publish', '2021-11-24 15:32:50', NULL),
(22, 'Pneumocoques', 'Les pneumocoques sont des bactéries qui peuvent engendrer de nombreuses maladies plus ou moins graves :\r\n\r\n- des otites moyennes, désagréables mais ne menaçant pas la vie,\r\n- des pneumonies pouvant provoquer des complications respiratoires,\r\n- des méningites et infections généralisées du sang (septicémie) pouvant être mortelles.', 120, 'non-obligatoire', 'draft', '2021-11-24 15:32:50', NULL),
(23, 'Poliomyélite', 'La poliomyélite ou paralysie infantile est due au poliovirus qui est transmis par le contact avec des excréments (mains souillées) ou de l’eau contaminée. Beaucoup de personnes attrapent cette infection sans même le savoir. Chez environ 1% des personnes infectées, la maladie provoque une paralysie douloureuse et souvent irréversible. Ces paralysies touchent les bras et/ou les jambes. Avant l’apparition du vaccin, il était fréquent de coucher un enfant en pleine forme le soir et de le retrouver paralysé à vie le lendemain.', 120, 'non-obligatoire', 'draft', '2021-11-24 15:32:50', NULL),
(24, 'Rage', 'La rage est une maladie provoquée par un virus (famille des Rhabdoviridae, genre Lyssavirus) et presque toujours mortelle. Elle s\'attrape par morsure/griffure ou contact avec la salive d\'animaux infectés. Il n’existe aucun traitement pour les malades. En Europe, les principaux animaux sensibles à la rage sont les renards et les chauves-souris. Dans les pays tropicaux et subtropicaux, ce sont surtout les chiens.', 120, 'obligatoire', 'publish', '2021-11-24 15:32:50', NULL),
(25, 'Rotavirus', 'À l’échelon mondial, les rotavirus sont la cause la plus fréquente de gastroentérites sévères, déshydratantes chez les enfants de moins de 5 ans. Ils provoquent des vomissements, des diarrhées et un état fébrile durant 3 à 7 jours et sont à l’origine de 30-80% des hospitalisations dues à une gastroentérite.', 120, 'non-obligatoire', 'draft', '2021-11-24 15:32:50', NULL),
(26, 'Rougeole', 'La rougeole est une maladie provoquée par un virus. Elle commence généralement par un simple rhume, suivi de toux et d’une irritation des yeux. Après quelques jours, la fièvre monte et des plaques rouges commencent à apparaître sur le visage et s’étendent sur tout le corps. Même sans complication, la rougeole est pénible à supporter: l’enfant n’a pas la force de sortir de son lit pendant au moins une semaine.', 120, 'obligatoire', 'publish', '2021-11-24 15:32:50', NULL),
(27, 'Varicelle', 'La varicelle est provoquée par le virus de la varicelle-zona. Elle se transmet de personne à personne, et est très contagieuse. La varicelle s’attrape le plus souvent durant l’enfance. Elle se manifeste par de la fièvre, de la fatigue, et des boutons qui débutent sous forme de taches rouges et qui démangent. Puis les boutons deviennent des vésicules qui finissent par se dessécher en formant des croûtes et en laissant parfois des cicatrices.', 120, 'non-obligatoire', 'draft', '2021-11-24 15:32:50', NULL),
(28, 'Zona (herpès zoster)', 'Le zona est la conséquence de la réactivation du virus varicelle-zona (VVZ). Toute personne qui a déjà eu la varicelle peut développer un zona. On estime qu’une personne sur quatre fera au moins un épisode de zona dans sa vie.', 120, 'non-obligatoire', 'draft', '2021-11-24 15:32:50', NULL),
(29, 'Dengue\r\n', 'La dengue est une maladie due à un virus qui est très présent dans les régions tropicales et subtropicales de la planète. Dans le monde chaque année, plus de 4 millions de cas sont recensés par l’OMS, et près de 500 000 personnes font une forme sévère de dengue. Des épidémies ont lieu régulièrement en Martinique, en Guadeloupe, à La Réunion et à Mayotte. Depuis 2010, on observe des cas de dengue en métropole chez des personnes n’ayant voyagé ni dans un département d’Outre-mer ni dans un autre pays que la France.', 120, 'non-obligatoire', 'draft', '2021-11-24 15:32:50', NULL),
(30, 'Choléra', 'Maladie du péril fécal pouvant être prévenue par l’hygiène, le choléra reste un problème de santé publique majeur dans de nombreuses régions du monde, surtout pour les populations vivant dans la misère et le sous-développement. Selon les estimations de l’Organisation mondiale de la santé (OMS), il y a chaque année 1,3 à 4 millions de cas de choléra, et 21 000 à 143 000 décès dus à cette maladie dans le monde.', 120, 'non-obligatoire', 'draft', '2021-11-24 15:32:50', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `vds_msg`
--
ALTER TABLE `vds_msg`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `vds_testimonial`
--
ALTER TABLE `vds_testimonial`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `vds_users`
--
ALTER TABLE `vds_users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `vds_user_vaccin`
--
ALTER TABLE `vds_user_vaccin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `vds_vaccin`
--
ALTER TABLE `vds_vaccin`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `vds_msg`
--
ALTER TABLE `vds_msg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `vds_testimonial`
--
ALTER TABLE `vds_testimonial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `vds_users`
--
ALTER TABLE `vds_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `vds_user_vaccin`
--
ALTER TABLE `vds_user_vaccin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `vds_vaccin`
--
ALTER TABLE `vds_vaccin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
