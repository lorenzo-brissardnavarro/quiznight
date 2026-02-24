-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 24 fév. 2026 à 19:33
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
-- Base de données : `quiznight`
--

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `libelleQuestion` text NOT NULL,
  `typeQuestion` enum('qcm','vf') NOT NULL DEFAULT 'qcm',
  `correction` text NOT NULL,
  `idQuiz` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `questions`
--

INSERT INTO `questions` (`id`, `libelleQuestion`, `typeQuestion`, `correction`, `idQuiz`) VALUES
(1, 'Quel est le nom complet du maître de Fairy Tail au début de l’anime ?', 'qcm', 'Makarov Dreyar est le 3ᵉ maître de la guilde Fairy Tail au début de l’anime. Puissant mage et utilisateur de la magie des Géants, il considère les membres comme sa famille.', 1),
(2, 'Natsu Dragnir utilise principalement la magie du Dragon Slayer de feu ?', 'vf', 'Natsu utilise la magie du Dragon Slayer du Feu apprise auprès du dragon Igneel. Il peut créer, manipuler et manger les flammes pour récupérer de l’énergie.', 1),
(3, 'Quel est le nom de la constellation liée à la clé de Lucy appelée “Aquarius” ?', 'qcm', 'La clé d’Aquarius correspond à la Porte du Verseau permettant d’invoquer l’esprit céleste Aquarius.', 1),
(4, 'Qui est le premier rival de Natsu au sein de la guilde ?', 'qcm', 'Grey Fullbuster est le premier rival de Natsu. Ils ont des personnalités opposées mais se respectent profondément.', 1),
(5, 'Quel est le nom de la guilde ennemie spécialisée dans la magie noire affrontée lors d’un des premiers arcs ?', 'qcm', 'Phantom Lord est la première grande guilde ennemie affrontée par Fairy Tail.', 1),
(6, 'Erza Scarlet utilise au combat une magie de séduction ?', 'vf', 'Erza utilise la magie de Rééquipement (Requip), pas une magie de séduction.', 1),
(7, 'Quel Dragon a élevé Natsu durant son enfance ?', 'qcm', 'Igneel est le dragon du feu qui a élevé Natsu et lui a enseigné la magie du Dragon Slayer du Feu.', 1),
(8, 'Comment s’appelle le chat bleu compagnon de Natsu ?', 'qcm', 'Happy est le chat bleu volant compagnon de Natsu, capable d’utiliser la magie de l’Aera.', 1),
(9, 'Le nom de famille de Grey est : Fullbuster ?', 'vf', 'Le nom complet de Grey est bien Grey Fullbuster.', 1),
(10, 'Quel est le nom du tournoi magique organisé à Fiore ?', 'qcm', 'Les Grands Jeux Intermagiques sont un tournoi opposant plusieurs guildes.', 1),
(11, 'Quelle est la guilde la plus puissante de l’Alliance Baram ?', 'qcm', 'Grimoire Heart est la plus puissante guilde de l’Alliance Balam.', 1),
(12, 'Qui est le mage noir légendaire à l’origine de nombreuses catastrophes ?', 'qcm', 'Zeref est le mage noir légendaire responsable de nombreuses catastrophes.', 1),
(13, 'Comment s’appelle le héros principal de la série ?', 'qcm', 'Goku est le héros principal de Dragon Ball Z. Saiyan envoyé sur Terre durant son enfance, il affronte Freezer, Cell et Boo.', 4),
(14, 'De quelle race est Goku ?', 'qcm', 'Goku est un Saiyan, une race guerrière originaire de la planète Vegeta.', 4),
(15, 'Comment s’appelle le fils aîné de Goku ?', 'qcm', 'Gohan est le fils aîné de Goku et atteint notamment le stade Super Saiyan 2 contre Cell.', 4),
(16, 'Qui est le prince des Saiyans ?', 'qcm', 'Vegeta est le prince des Saiyans, héritier de la planète Vegeta.', 4),
(17, 'Quelle transformation rend les cheveux dorés ?', 'qcm', 'La transformation Super Saiyan rend les cheveux dorés et augmente fortement la puissance.', 4),
(18, 'Comment s’appelle l’attaque emblématique de Goku ?', 'qcm', 'La Kamehameha est l’attaque emblématique de Goku, enseignée par Maître Roshi.', 4),
(19, 'Qui est le premier grand ennemi de DBZ ?', 'qcm', 'Raditz est le premier grand ennemi de Dragon Ball Z et révèle les origines Saiyan de Goku.', 4),
(20, 'Sur quelle planète vivent les Nameks ?', 'qcm', 'Les Nameks vivent sur la planète Namek.', 4),
(21, 'Qui est le meilleur ami de Goku ?', 'qcm', 'Krilin est le meilleur ami de Goku depuis leur entraînement chez Maître Roshi.', 4),
(22, 'Il y a 6 Dragon Balls sur Terre ?', 'vf', 'Il y a 7 Dragon Balls sur Terre, permettant d’invoquer Shenron.', 4),
(23, 'Qui est l’ennemi capable d’absorber les autres pour devenir plus fort ?', 'qcm', 'Cell peut absorber des humains et des androïdes pour atteindre sa forme parfaite.', 4),
(24, 'Bulma est sortie avec Yamcha ?', 'vf', 'Bulma a eu une relation avec Yamcha avant de se rapprocher de Vegeta.', 4),
(25, 'Qui entraîne Goku dans l’au-delà après sa mort contre Raditz ?', 'qcm', 'Après sa mort contre Raditz, Goku est entraîné par le Kaio du Nord.', 4),
(26, 'Qui est l’ennemi rose et puissant du dernier arc de DBZ ?', 'qcm', 'Boo est l’ennemi principal du dernier arc de Dragon Ball Z.', 4),
(27, 'Comment s’appelle la fusion de Goku et Vegeta avec les Potaras ?', 'qcm', 'La fusion via les Potaras s’appelle Vegito.', 4),
(28, 'Dans quel lycée arrive Tetsuya Kuroko au début de l’anime ?', 'qcm', 'Kuroko arrive au lycée Seirin pour intégrer l’équipe de basketball et participer aux compétitions inter-lycées.', 2),
(29, 'Quel est le talent principal de Kuroko sur le terrain ?', 'qcm', 'Kuroko est célèbre pour ses passes invisibles qui le rendent presque imperceptible pour les adversaires.', 2),
(30, 'Kagami le partenaire de Kuroko à Seirin, est surnommé “le Tigre” ?', 'vf', 'Taiga Kagami est surnommé “le Tigre” en raison de sa puissance et de son style de jeu féroce.', 2),
(31, 'Quel membre de la Génération Miracle copie parfaitement les techniques des autres joueurs ?', 'qcm', 'Kise possède la capacité Copy Skill lui permettant d’imiter les techniques adverses.', 2),
(32, 'Quelle est la spécialité de Shintaro Midorima ?', 'qcm', 'Midorima excelle dans les tirs à trois points longue distance avec une précision exceptionnelle.', 2),
(33, 'Quel ancien coéquipier de Kuroko est connu pour entrer en “Zone” facilement grâce à son instinct ?', 'qcm', 'Aomine peut entrer en Zone facilement grâce à son instinct naturel exceptionnel.', 2),
(34, 'Le collège où jouait la Génération Miracle s’appelle Yosen ?', 'vf', 'La Génération Miracle jouait au collège Teiko, pas Yosen.', 2),
(35, 'Quel joueur possède “l’Œil de l’Empereur” ?', 'qcm', 'Akashi possède l’Œil de l’Empereur, lui permettant d’anticiper tous les mouvements.', 2),
(36, 'Quel est le nom de l’enseignant extraterrestre de la classe 3-E ?', 'qcm', 'Koro-sensei est l’enseignant extraterrestre doté d’une vitesse incroyable et d’une force surhumaine.', 6),
(37, 'Quelle est la particularité physique la plus remarquable de Koro-sensei ?', 'qcm', 'Koro-sensei possède une tête ronde en forme de smiley toujours souriante.', 6),
(38, 'La vitesse maximale de Koro-sensei est de Mach 30 ?', 'vf', 'Koro-sensei peut atteindre Mach 20, pas Mach 30.', 6),
(39, 'Quel est le but principal des élèves de la classe 3-E ?', 'qcm', 'Les élèves doivent tuer Koro-sensei avant qu’il ne détruise la Terre.', 6),
(40, 'Qui finit par tuer Koro-Sensei ?', 'qcm', 'Nagisa est celui qui porte le coup final à Koro-sensei avec l’aide de la classe.', 6),
(41, 'Comment s’appelle l’intelligence artificielle qui aide la classe ?', 'qcm', 'Ritsu est l’intelligence artificielle qui aide la classe 3-E.', 6),
(42, 'Koro-sensei a détruit 30% de la lune ?', 'vf', 'Koro-sensei a détruit environ 70% de la Lune.', 6),
(43, 'Kaede Kayano est amoureuse de Nagisa ?', 'vf', 'Kaede Kayano développe des sentiments pour Nagisa au cours de la série.', 6),
(44, 'Où se situe l’école de la classe 3-E ?', 'qcm', 'L’école est le collège Kunugigaoka.', 6),
(45, 'Que fait Koro-sensei pour motiver ses élèves au-delà des assassinats ?', 'qcm', 'Il les aide à progresser dans toutes les matières scolaires et leur enseigne des leçons de vie.', 6),
(46, 'Quel est le véritable nom d’Eyeshield 21 avant qu’il ne rejoigne le Deimon Devil Bats ?', 'qcm', 'Sena Kobayakawa est le véritable nom d’Eyeshield 21 avant son intégration chez les Deimon Devil Bats.', 5),
(47, 'Qui est le capitaine des Ojo White Knights, l’équipe rivale la plus redoutable de Sena ?', 'qcm', 'Seijuuro Shin est le capitaine des Ojo White Knights, redoutable adversaire des Devil Bats.', 5),
(48, 'Qu’est-ce que la Marche de la Mort dans Eyeshield 21 ?', 'qcm', 'La Marche de la Mort est un entraînement extrême de 2000 km en 40 jours imposé par Hiruma.', 5),
(49, 'Qui est le stratège des Deimon Devil Bats, connu pour ses plans machiavéliques ?', 'qcm', 'Hiruma Yoichi est le stratège des Devil Bats, célèbre pour ses plans machiavéliques.', 5),
(50, 'Les Wolves de Misaki est l’une des équipes participant au tournoi du Kantô d’automne ?', 'vf', 'Les Wolves de Misaki participent bien au tournoi du Kantô d’automne.', 5),
(51, 'Dans quelle équipe joue l’ancien ami de Sena avec qui il a grandi ?', 'qcm', 'Riku Kaitani joue pour les Wild Gunmans de Seibu.', 5);

-- --------------------------------------------------------

--
-- Structure de la table `quiz`
--

CREATE TABLE `quiz` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `difficulte` enum('Facile','Moyen','Difficile') NOT NULL DEFAULT 'Facile'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `quiz`
--

INSERT INTO `quiz` (`id`, `titre`, `description`, `image`, `difficulte`) VALUES
(1, 'Fairy Tail', 'As-tu la magie nécessaire pour rejoindre Fairy Tail ? Prouve ta valeur avec ce quiz !', 'fairytail.jpg', 'Moyen'),
(2, 'Kuroko\'s Basket', 'As-tu le talent pour entrer dans la Génération Miracle ? Montre-nous ton niveau !', 'kurokosbasket.jpg', 'Moyen'),
(4, 'Dragon Ball Z', 'As-tu la puissance d’un Super Saiyan ? Teste ton niveau dans ce quiz ultime !', 'dragonballz.jpg', 'Facile'),
(5, 'Eyeshield 21', 'As-tu la vitesse d’Eyeshield 21 ? Lance-toi et marque un touchdown avec ce quiz !', 'eyeshield21.jpeg', 'Difficile'),
(6, 'Assassination Classroom', 'Aurais-tu réussi à éliminer Koro-sensei ? Teste tes compétences dès maintenant !', 'assassinationclassroom.jpg', 'Facile');

-- --------------------------------------------------------

--
-- Structure de la table `reponses`
--

CREATE TABLE `reponses` (
  `id` int(11) NOT NULL,
  `libelleReponse` text NOT NULL,
  `verite` tinyint(1) NOT NULL,
  `idQuestion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reponses`
--

INSERT INTO `reponses` (`id`, `libelleReponse`, `verite`, `idQuestion`) VALUES
(1, 'Makarof Draer', 0, 1),
(2, 'Makarov Dreyar', 1, 1),
(3, 'Ivan Dreyar', 0, 1),
(4, 'Hadès', 0, 1),
(5, 'VRAI', 1, 2),
(6, 'FAUX', 0, 2),
(7, 'La Porte du Verseau', 1, 3),
(8, 'L’Esprit de l’Eau', 0, 3),
(9, 'La Clé Dorée du Verseau', 0, 3),
(10, 'Le Zodiaque Marin', 0, 3),
(11, 'Luxus', 0, 4),
(12, 'Grey', 1, 4),
(13, 'Gajeel', 0, 4),
(14, 'Erza', 0, 4),
(15, 'Grimoire Heart', 0, 5),
(16, 'Tartaros', 0, 5),
(17, 'Oración Seis', 0, 5),
(18, 'Phantom Lord', 1, 5),
(19, 'VRAI', 0, 6),
(20, 'FAUX', 1, 6),
(21, 'Metalicana', 0, 7),
(22, 'Igneel', 1, 7),
(23, 'Atlas Flame', 0, 7),
(24, 'Acnologia', 0, 7),
(25, 'Carla', 0, 8),
(26, 'Panther Lily', 0, 8),
(27, 'Happy', 1, 8),
(28, 'Lecter', 0, 8),
(29, 'VRAI', 1, 9),
(30, 'FAUX', 0, 9),
(31, 'Les Jeux Royaux', 0, 10),
(32, 'Le Grand Festival Magique', 0, 10),
(33, 'Les Grands Jeux Intermagiques', 1, 10),
(34, 'Le Tournoi des Mages', 0, 10),
(35, 'Sabertooth', 0, 11),
(36, 'Oracion Seis', 0, 11),
(37, 'Raven Tail', 0, 11),
(38, 'Grimoire Heart', 1, 11),
(39, 'Hades', 0, 12),
(40, 'Acnologia', 0, 12),
(41, 'Zeref', 1, 12),
(42, 'August', 0, 12),
(43, 'Vegeta', 0, 13),
(44, 'Gohan', 0, 13),
(45, 'Goku', 1, 13),
(46, 'Trunks', 0, 13),
(47, 'Namek', 0, 14),
(48, 'Saiyan', 1, 14),
(49, 'Terrien', 0, 14),
(50, 'Androïde', 0, 14),
(51, 'Goten', 0, 15),
(52, 'Raditz', 0, 15),
(53, 'Gohan', 1, 15),
(54, 'Krilin', 0, 15),
(55, 'Broly', 0, 16),
(56, 'Bardock', 0, 16),
(57, 'Nappa', 0, 16),
(58, 'Vegeta', 1, 16),
(59, 'Super Guerrier Divin', 0, 17),
(60, 'Super Saiyan', 1, 17),
(61, 'Kaioken', 0, 17),
(62, 'Ultra Instinct', 0, 17),
(63, 'Final Flash', 0, 18),
(64, 'Big Bang Attack', 0, 18),
(65, 'Kamehameha', 1, 18),
(66, 'Genkidama', 0, 18),
(67, 'Cell', 0, 19),
(68, 'Freezer', 0, 19),
(69, 'Raditz', 1, 19),
(70, 'Boo', 0, 19),
(71, 'Terre', 0, 20),
(72, 'Vegeta', 0, 20),
(73, 'Namek', 1, 20),
(74, 'Kaio', 0, 20),
(75, 'Yamcha', 0, 21),
(76, 'Krilin', 1, 21),
(77, 'Tenshinhan', 0, 21),
(78, 'Piccolo', 0, 21),
(79, 'VRAI', 0, 22),
(80, 'FAUX', 1, 22),
(81, 'Freezer', 0, 23),
(82, 'Cell', 1, 23),
(83, 'Nappa', 0, 23),
(84, 'Raditz', 0, 23),
(85, 'VRAI', 1, 24),
(86, 'FAUX', 0, 24),
(87, 'Kaio du Nord', 1, 25),
(88, 'Kaio Shin', 0, 25),
(89, 'Maître Roshi', 0, 25),
(90, 'Kami', 0, 25),
(91, 'Cell', 0, 26),
(92, 'Freezer', 0, 26),
(93, 'Boo', 1, 26),
(94, 'Jiren', 0, 26),
(95, 'Gogeta', 0, 27),
(96, 'Vegito', 1, 27),
(97, 'Goketa', 0, 27),
(98, 'Vegeto', 0, 27),
(99, 'Teiko', 0, 28),
(100, 'Seirin', 1, 28),
(101, 'Kaijo', 0, 28),
(102, 'Shutoku', 0, 28),
(103, 'Les tirs à trois points', 0, 29),
(104, 'La vitesse pure', 0, 29),
(105, 'Les passes invisibles', 1, 29),
(106, 'Les dunks puissants', 0, 29),
(107, 'VRAI', 1, 30),
(108, 'FAUX', 0, 30),
(109, 'Akashi', 0, 31),
(110, 'Aomine', 0, 31),
(111, 'Kise', 1, 31),
(112, 'Murasakibara', 0, 31),
(113, 'Les contres', 0, 32),
(114, 'Les tirs à trois points longue distance', 1, 32),
(115, 'Les passes éclairs', 0, 32),
(116, 'Les interceptions', 0, 32),
(117, 'Aomine', 1, 33),
(118, 'Akashi', 0, 33),
(119, 'Kise', 0, 33),
(120, 'Takao', 0, 33),
(121, 'VRAI', 0, 34),
(122, 'FAUX', 1, 34),
(123, 'Kagami', 0, 35),
(124, 'Aomine', 0, 35),
(125, 'Akashi', 1, 35),
(126, 'Kuroko', 0, 35),
(127, 'Koro-sensei', 1, 36),
(128, 'Nagisa', 0, 36),
(129, 'Karma', 0, 36),
(130, 'Takaoka', 0, 36),
(131, 'Il a trois yeux', 0, 37),
(132, 'Il est complètement bleu', 0, 37),
(133, 'Il a une tête en forme de smiley', 1, 37),
(134, 'Il a des ailes', 0, 37),
(135, 'VRAI', 0, 38),
(136, 'FAUX', 1, 38),
(137, 'Devenir meilleurs enseignants', 0, 39),
(138, 'Tuer Koro-sensei avant qu’il ne détruise la Terre', 1, 39),
(139, 'Gagner le championnat sportif', 0, 39),
(140, 'Voyager dans l’espace', 0, 39),
(141, 'Karma', 0, 40),
(142, 'Kaede', 0, 40),
(143, 'Nagisa', 1, 40),
(144, 'Kayano', 0, 40),
(145, 'Ritsu', 1, 41),
(146, 'KoroAI', 0, 41),
(147, 'SenseiBot', 0, 41),
(148, 'NagisaX', 0, 41),
(149, 'VRAI', 0, 42),
(150, 'FAUX', 1, 42),
(151, 'VRAI', 1, 43),
(152, 'FAUX', 0, 43),
(153, 'Tokyo', 0, 44),
(154, 'Kunugigaoka', 1, 44),
(155, 'Kyoto', 0, 44),
(156, 'Osaka', 0, 44),
(157, 'Leur enseigne la magie', 0, 45),
(158, 'Les aide aussi à progresser dans toutes les matières scolaires', 1, 45),
(159, 'Les fait participer à des combats clandestins', 0, 45),
(160, 'Les entraîne uniquement physiquement', 0, 45),
(161, 'Sena Kobayakawa', 1, 46),
(162, 'Hiruma Yoichi', 0, 46),
(163, 'Monta', 0, 46),
(164, 'Seijuuro Shin', 0, 46),
(165, 'Seijuuro Shin', 1, 47),
(166, 'Mamori Anezaki', 0, 47),
(167, 'Monta', 0, 47),
(168, 'Hiruma Yoichi', 0, 47),
(169, 'Une technique de sprint sur le terrain', 0, 48),
(170, 'Un entraînement intense où les membres des Devil Bats doivent traverser les États-Unis à pied', 1, 48),
(171, 'Une stratégie pour déstabiliser mentalement les adversaires', 0, 48),
(172, 'Une course chronométrée contre une équipe rivale', 0, 48),
(173, 'Monta', 0, 49),
(174, 'Hiruma Yoichi', 1, 49),
(175, 'Sena Kobayakawa', 0, 49),
(176, 'Taki', 0, 49),
(177, 'VRAI', 1, 50),
(178, 'FAUX', 0, 50),
(179, 'Spiders de Bandô', 0, 51),
(180, 'Poséidons de Kyoshin', 0, 51),
(181, 'Wild Gunmans de Seibu', 1, 51),
(182, 'Naga de Shinryûji', 0, 51);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','utilisateur') NOT NULL DEFAULT 'utilisateur'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `role`) VALUES
(1, 'test@gmail.com', '$2y$10$3gHtK9fgsrL591NEgEgATuS8ipv3NlreFx9orkk2wRUpdcaXu3NTq', 'utilisateur'),
(2, 'admin@gmail.com', '$2y$10$CLzcMW8uQ5iXyPOj02PRHupdGtnzNRiv1zj4O5TTZ5L7Vo6fQdNjK', 'admin');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reponses`
--
ALTER TABLE `reponses`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT pour la table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `reponses`
--
ALTER TABLE `reponses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
