-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : Dim 30 jan. 2022 à 16:52
-- Version du serveur :  8.0.21
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bluebeard_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `address`
--

DROP TABLE IF EXISTS `address`;
CREATE TABLE IF NOT EXISTS `address` (
  `id_address` int NOT NULL AUTO_INCREMENT,
  `uuid` varchar(100) NOT NULL,
  `user_id` int NOT NULL,
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'Mon adresse',
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `street` varchar(50) NOT NULL,
  `zipcode` varchar(5) NOT NULL,
  `country` varchar(20) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_address`),
  KEY `user_id` (`user_id`),
  KEY `uuid` (`uuid`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `address`
--

INSERT INTO `address` (`id_address`, `uuid`, `user_id`, `title`, `first_name`, `last_name`, `street`, `zipcode`, `country`, `createdAt`) VALUES
(1, 'O313DAMz7y3kWJMh1452loDv1nc1', 5, 'Mon domicile', 'Nicolas', 'Lepinay', '6, chemin des oliviers, Aix-en-Provence', '13100', 'France', '2022-01-22 10:30:28'),
(3, 'uTenz34rurjEpwykkEyFDuholsbMlVOHq', 5, 'Domicile', 'Nicolas', 'Lépinay', '6, chemin des Oliviers', '13100', 'France', '2022-01-22 11:30:28'),
(4, 'CztvgooMd02WaTWUloeLxVgFMKBPvgAfwpQfTdtqNEkyUogH1YSUJYmU1TUf', 5, 'Domicile', 'Nicolas', 'Lépinay', '6, chemin des Oliviers Aix', '13100', 'France', '2022-01-22 12:30:28'),
(5, '4dB8', 5, 'Domicile', 'Nicolas', 'Lépinay', '6, chemin des Oliviers', '75000', 'France', '2022-01-22 13:30:28'),
(6, 'dFQcfDOhd6x9tlIAzThxuaoOS68Zqzw3jjuTcfN4gfKYnWk', 5, 'Domicile', 'Nicolas', 'Lépinay', '6, chemin des Oliviers', '80000', 'France', '2022-01-22 14:30:28'),
(7, 'zBeoJVwxgfnMs3AuAV7VXay0idz', 5, 'Mon travail', 'Nicolas', 'Lépinay', '18, avenue de la Violette, Aix-en-Provence', '13100', 'France', '2022-01-22 15:30:28'),
(16, 'yTGbi0PuxoP5XqIbVdyVf7g3o9BWcSpleiV7MeA6DxsnXL', 20, 'Mon adresse', 'James', 'Newman', '5, chemin des Chênes, Paris', '75000', 'France', '2022-01-22 16:30:28'),
(18, 'dcWn8vCbMrGmsCmpD', 21, 'Mon adresse', 'James', 'Newman', '5, chemin des Chênes, Paris', '75000', 'France', '2022-01-22 17:10:28'),
(19, 'QPUgctI2Z77lkPfMa', 21, 'Mon adresse', 'James', 'Newman', '11, Business District, Paris', '75000', 'France', '2022-01-22 17:30:28'),
(20, 'B3ev2sXRWbPAzDqK1nXB25ExKzCYEHb0HGYHMpwLMtC4DF9zXfpPbfQRPJ4', 5, 'Mon domicile', 'Nicolas', 'Lépinay', '6, chemin des Oliviers, Aix', '13100', 'France', '2022-01-22 16:37:20');

-- --------------------------------------------------------

--
-- Structure de la table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `collection`
--

DROP TABLE IF EXISTS `collection`;
CREATE TABLE IF NOT EXISTS `collection` (
  `id_collection` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `image` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '_blank-collection.jpg',
  `slug` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_collection`),
  KEY `name` (`name`),
  KEY `slug` (`slug`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `collection`
--

INSERT INTO `collection` (`id_collection`, `name`, `image`, `slug`) VALUES
(1, 'Fantastique', 'fantastique.jpg', 'fantastique'),
(2, 'Science-fiction', 'science-fiction.jpg', 'science-fiction'),
(3, 'Fiction historique', 'fiction-historique.jpg', 'fiction-historique'),
(4, 'Romance', 'romance.jpg', 'romance'),
(5, 'Bande-dessinée', 'bande-dessinee.jpg', 'bande-dessinee'),
(6, 'Jeunesse', 'jeunesse.jpg', 'jeunesse');

-- --------------------------------------------------------

--
-- Structure de la table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `story_rating` int NOT NULL,
  `price_rating` int NOT NULL,
  `quality_rating` int NOT NULL,
  `summary` varchar(100) NOT NULL,
  `review` varchar(2000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `feedback`
--

INSERT INTO `feedback` (`user_id`, `product_id`, `story_rating`, `price_rating`, `quality_rating`, `summary`, `review`, `createdAt`) VALUES
(10, 35, 5, 2, 4, 'Un grand classique incontournable', 'Pour moi, la série des Tintin a un parfum inoubliable de vacances d\'été et d\'enfance, car mes grands-parents paternels, que je ne voyais qu\'à l\'occasion de ces vacances, avaient la collection complète. Mes préférés j\'en ai beaucoup comme le trésor de Rackham le Rouge, et le précédent, le secret de la Licorne. Histoire de pirates et de trésors, forcément, une grande aventure ! Celle ci commence vraiment ici puisque Tintin, le Capitaine Haddock, les Dupondt et le Professeur Tournesol (nouveau venu dans le monde d\'Hergé) partent à la recherche du fameux trésor.Les péripéties sont nombreuses et l\'humour est omniprésent grâce à l\'arrivée du Professeur Tournesol. Sourd comme un pot, il est toujours à côté de la plaque ce qui a le don d\'agacer l\'impétueux Capitaine Haddock qui tente vainement de se faire entendre. Leurs conversations sont irrésistibles et hilarantes. Autre point qui, pour moi, fait que cet album est le véritable commencement des célèbres aventures du célèbre reporter et de son inestimable ami est que c\'est dans ce tome que ce dernier, le capitaine Haddock, rachète le château de Moulinsart qui a jadis appartenu à ses ancêtres.', '2022-01-30 17:16:08'),
(8, 35, 4, 4, 5, 'Un beau livre bien relié', 'Agréable à relire, toute ma jeunesse est là, c\'est de l\'action mais pas violente. De plus cette bonne odeur de papier neuf et d\'encre.', '2022-01-30 17:19:41');

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id_order` int NOT NULL AUTO_INCREMENT,
  `uuid` varchar(100) NOT NULL,
  `user_id` int NOT NULL,
  `billing_address_id` int NOT NULL,
  `shipping_address_id` int NOT NULL,
  `total` float NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`id_order`),
  KEY `user_id` (`user_id`),
  KEY `uuid` (`uuid`),
  KEY `billing_address_id` (`billing_address_id`),
  KEY `shipping_address_id` (`shipping_address_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`id_order`, `uuid`, `user_id`, `billing_address_id`, `shipping_address_id`, `total`, `createdAt`, `status`) VALUES
(1, 'pn2QB70rK1PZRMLWym9y5DC7GBBhUSAXfiJkeAVIonu8YR', 5, 5, 5, 53, '2022-01-22 13:50:55', 'pending'),
(2, 'VWxKOfa7qowxX7J7Sa96e8ANyB27SMm3zJ2g', 5, 5, 5, 53, '2022-01-22 13:52:13', 'pending'),
(3, 'RIAKZHyImGRwnX2oTvhDMKY', 5, 5, 5, 53, '2022-01-22 13:53:12', 'pending'),
(4, 'rLuvpnYy9N3ItDvo2Ii17B0q8MHzEtFZPBcBBLzBueaptorBk', 5, 5, 5, 53, '2022-01-22 13:58:27', 'pending'),
(5, '7hGZt8ZQGMWrr4fQhofz', 5, 1, 7, 106, '2022-01-22 14:01:15', 'pending'),
(7, 'eCo62bhqcaaLPGPbPMR6gxu7DxZg7EtF4WBGleeHZRvPpJgn', 21, 18, 19, 59, '2022-01-22 14:46:56', 'pending'),
(8, '49YgsGfcw7MlhQagWZn2aUTd06N7Vw9N15TfgnLB7V', 5, 20, 7, 106, '2022-01-22 16:37:20', 'pending'),
(9, 'mNGKYjHxB1LdfWYVpGrJCn8', 5, 20, 20, 106, '2022-01-22 19:34:37', 'pending'),
(10, 'gQXylKk40C2yPUobo0bqJZ', 5, 20, 20, 106, '2022-01-22 19:35:08', 'pending'),
(11, 'wNCKBbJlBBvKruin43EYqdbximQC9vN3DrVpgK892z0I', 5, 20, 20, 25, '2022-01-22 20:13:44', 'pending'),
(12, '0hMXTduqz9P4dahv5q6qvpE', 5, 20, 20, 25, '2022-01-22 21:20:00', 'pending'),
(13, 'jldpoFwDDjnkL', 5, 20, 20, 25, '2022-01-22 21:30:10', 'pending'),
(14, 'aF6hjYasfLJPgYEFQ2b9o', 5, 20, 20, 25, '2022-01-22 21:36:45', 'pending'),
(15, '3TZmmMm3fz2p7CHPUDz25m27ReqTSlJwn8', 5, 20, 20, 25, '2022-01-22 21:38:33', 'confirmed'),
(16, 'lR0z1E8ozN1V65uWuZeI1syOtUELLCELg6lS7gKFbLEbXRIlotuEjX94', 5, 20, 20, 59, '2022-01-22 22:57:32', 'confirmed'),
(17, 'zRE0E1KSAqvWXLadV6A3YTbeS9', 5, 20, 20, 59, '2022-01-22 23:10:57', 'confirmed'),
(18, 'yVimUWQ5FwVkvZh8iUVcOQK8F2nMBgXZyU', 5, 20, 20, 59, '2022-01-22 23:12:01', 'confirmed'),
(19, 'zh1Wqq4Aghu', 5, 20, 20, 146, '2022-01-23 02:49:37', 'confirmed');

-- --------------------------------------------------------

--
-- Structure de la table `order_detail`
--

DROP TABLE IF EXISTS `order_detail`;
CREATE TABLE IF NOT EXISTS `order_detail` (
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` float NOT NULL,
  KEY `product_id` (`product_id`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `order_detail`
--

INSERT INTO `order_detail` (`order_id`, `product_id`, `quantity`, `price`) VALUES
(8, 2, 2, 28),
(8, 1, 2, 25),
(4, 1, 1, 25),
(4, 2, 1, 28),
(5, 1, 2, 25),
(5, 2, 2, 28),
(7, 3, 1, 59),
(9, 1, 2, 25),
(9, 2, 2, 28),
(10, 1, 2, 25),
(10, 2, 2, 28),
(11, 1, 1, 25),
(12, 1, 1, 25),
(13, 1, 1, 25),
(14, 1, 1, 25),
(15, 1, 1, 25),
(16, 3, 1, 59),
(17, 3, 1, 59),
(18, 3, 1, 59),
(19, 2, 1, 28),
(19, 3, 2, 59);

-- --------------------------------------------------------

--
-- Structure de la table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_payment` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `order_id` int NOT NULL,
  `payer_id` varchar(100) NOT NULL,
  `payer_name` varchar(50) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `status` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `link` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_payment` (`id_payment`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `payment`
--

INSERT INTO `payment` (`id`, `id_payment`, `order_id`, `payer_id`, `payer_name`, `email_address`, `status`, `createdAt`, `link`) VALUES
(1, '1DU60993Y40385734', 13, 'NDHX49XWPRRS6', 'John Doe', 'sb-cwsj112228251@personal.example.com', 'COMPLETED', '2022-01-22 20:30:00', 'https://api.sandbox.paypal.com/v2/checkout/orders/1DU60993Y40385734'),
(2, '94219705V2464062J', 14, 'NDHX49XWPRRS6', 'John Doe', 'sb-cwsj112228251@personal.example.com', 'COMPLETED', '2022-01-22 20:36:32', 'https://api.sandbox.paypal.com/v2/checkout/orders/94219705V2464062J'),
(3, '48973016LR178742C', 15, 'NDHX49XWPRRS6', 'John Doe', 'sb-cwsj112228251@personal.example.com', 'COMPLETED', '2022-01-22 20:38:23', 'https://api.sandbox.paypal.com/v2/checkout/orders/48973016LR178742C'),
(4, '8J70874435692280A', 16, 'NDHX49XWPRRS6', 'John Doe', 'sb-cwsj112228251@personal.example.com', 'COMPLETED', '2022-01-22 21:57:18', 'https://api.sandbox.paypal.com/v2/checkout/orders/8J70874435692280A'),
(5, '9AL01261MP545224W', 17, 'NDHX49XWPRRS6', 'John Doe', 'sb-cwsj112228251@personal.example.com', 'COMPLETED', '2022-01-22 22:10:48', 'https://api.sandbox.paypal.com/v2/checkout/orders/9AL01261MP545224W'),
(6, '1BB93282KG737774V', 18, 'NDHX49XWPRRS6', 'John Doe', 'sb-cwsj112228251@personal.example.com', 'COMPLETED', '2022-01-22 22:11:52', 'https://api.sandbox.paypal.com/v2/checkout/orders/1BB93282KG737774V'),
(7, '81Y66013V00764643', 19, 'NDHX49XWPRRS6', 'John Doe', 'sb-cwsj112228251@personal.example.com', 'COMPLETED', '2022-01-23 01:48:59', 'https://api.sandbox.paypal.com/v2/checkout/orders/81Y66013V00764643');

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id_product` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `author` varchar(50) NOT NULL,
  `description` text,
  `price` float NOT NULL,
  `stock` int NOT NULL DEFAULT '10',
  `weight` float NOT NULL DEFAULT '500',
  `image` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '_blank-book.jpg',
  `collection_id` int NOT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_product`),
  KEY `title` (`title`,`author`),
  KEY `collection_id` (`collection_id`),
  KEY `slug` (`slug`)
) ENGINE=MyISAM AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id_product`, `title`, `author`, `description`, `price`, `stock`, `weight`, `image`, `collection_id`, `slug`, `createdAt`) VALUES
(1, 'Anna Karénine', 'Léon Tolstoï', 'Anna n\'est pas qu\'une femme, qu\'un splendide spécimen du sexe féminin, c\'est une femme dotée d\'un sens moral entier, tout d\'un bloc, prédominant : tout ce qui fait partie de sa personne est important, a une intensité dramatique, et cela s\'applique aussi bien à son amour.\r\nElle n\'est pas, comme Emma Bovary, une rêveuse de province, une femme désenchantée qui court en rasant des murs croulants vers les lits d\'amants interchangeables. Anna donne à Vronski toute sa vie.\r\nElle part vivre avec lui d\'abord en Italie, puis dans les terres de la Russie centrale, bien que cette liaison « notoire » la stigmatise, aux yeux du monde immoral dans lequel elle évolue, comme une femme immorale. Anna scandalise la société hypocrite moins par sa liaison amoureuse que par son mépris affiché des conventions sociales.\r\nAvec Anna Karénine, Tolstoï atteint le comble de la perfection créative.', 25, 10, 500, 'anna-karenina.jpg', 4, 'anna-karenine-leon-tolstoi', '2022-01-16 20:01:13'),
(2, 'L\'Histoire du Roi Arthur', 'Howard Pyle', 'Je le requiers de vous tous, hommes et dames de bonne maison qui lirez ce livre d\'Arthur et de ses chevaliers, du commencement à la fin, priez pour moi. Ce livre fut terminé la neuvième année du règne du roi Édouard IV, par messire Thomas Malory, chevalier.\r\nAchevé donc en 1469-1470, réagencé et publié par l\'imprimeur Caxton en 1485, Le morte d\'Arthur n\'a pas cessé d\'être réédité en Angleterre ; il est la référence arthurienne de toute la culture anglo-saxonne. De siècle en siècle, il a inspiré les grands poètes, plus tard les cinéastes. Il figurait aussi parmi les quatre livres que Lawrence d\'Arabie emportait dans ses sacoches de selle quand il partait pour de lointains voyages. Tel est, conclut Caxton, ce noble et joyeux livre, intitulé La mort d\'Arthur, nonobstant qu\'il traite de la naissance, de la vie et des faits et gestes dudit roi Arthur, de ses nobles chevaliers de la Table Ronde, de leurs merveilleuses quêtes et aventures, de l\'accès qu\'ils eurent aux secrets du Saint-Graal, et finalement de la mort douloureuse de tous et de la façon dont ils quittèrent ce monde.', 28, 10, 500, 'king-arthur.jpg', 3, 'lhistoire-du-roi-arthur-howard-pyle', '2022-01-16 20:43:04'),
(3, 'Princess Bride', 'William Goldman', 'Il était une fois... la plus belle des aventures, auréolée par le grand amour, le seul, le vrai.\r\n\r\nPlébiscité par des millions de lecteurs, Princess Bride est un livre culte qui devint un film culte. Un récit de duels à l\'épée, de vengeance, de passion et de miracles.\r\n\r\nCe conte intemporel écrit par S. Morgenstern - redécouvert et merveilleusement abrégé par William Goldman - est peuplé de personnages aussi inoubliables que Westley, le beau valet de ferme qui risque sa vie pour la femme qu\'il aime ; Inigo Montoya, le bretteur espagnol qui ne vit que pour venger la mort de son père ; et bien sûr, Bouton d\'or : la princesse, la femme idéale, la plus belle de toute l\'histoire du monde.', 59, 3, 600, 'princess-bride.jpg', 4, 'princess-bride-william-goldman', '2022-01-20 20:54:42'),
(4, '1984', 'George Orwell', 'Année 1984 en Océanie. 1984 ? C\'est en tout cas ce qu\'il semble à Winston, qui ne saurait toutefois en jurer. Le passé a été réinventé, et les événements les plus récents sont susceptibles d\'être modifiés. Winston est lui-même chargé de récrire les archives qui contredisent le présent et les promesses de Big Brother. Grâce à une technologie de pointe, ce dernier sait tout, voit tout. Liberté est Servitude. Ignorance est Puissance. Telles sont les devises du régime. Pourtant Winston refuse de perdre espoir. Avec l\'insoumise Julia, ils vont tenter d\'intégrer la Fraternité, une organisation ayant pour but de renverser Big Brother. Mais celui-ci veille...', 18, 3, 400, '1984.jpg', 2, '1984-george-orwell', '2022-01-23 17:17:02'),
(5, 'Alice au Pays des Merveilles', 'Lewis Carroll', 'Alice s\'ennuie auprès de sa sœur qui lit un livre (« sans images, ni dialogues ») tandis qu\'elle ne fait rien. « À quoi bon un livre sans images, ni dialogues ? », se demande Alice. Mais voilà qu\'un lapin blanc aux yeux roses vêtu d\'une redingote avec une montre à gousset à y ranger passe près d\'elle en courant. Cela ne l\'étonne pas le moins du monde. Pourtant, lorsqu\'elle le voit sortir une montre de sa poche et s\'écrier : « Je suis en retard ! En retard ! En retard ! », elle se dit que décidément ce lapin a quelque chose de particulier. En entrant derrière lui dans son terrier, elle fait une chute presque interminable qui l\'emmène dans un monde aux antipodes du sien. Elle va rencontrer une galerie de personnages retors et se trouver confrontée au paradoxe, à l\'absurde et au bizarre…', 23, 5, 500, 'alice-au-pays-des-merveilles-illustre.jpg', 6, 'alice-au-pays-des-merveilles-illustre-lewis-carroll', '2022-01-23 17:18:49'),
(6, 'Alice au Pays des Merveilles', 'Robert Sabuda', 'La curiosité d\'Alice l\'entraîne au fond du terrier du mystérieux Lapin blanc... Elle y rencontrera de surprenants personnages et y vivra des aventures de toutes sortes et de toutes tailles. Le texte original - dont certains passages ont été supprimés - et les illustrations - dans le style caricaturiste de l\'époque victorienne - sont dans la pure tradition carrollienne. Les nombreux pop-up de ce livre animé surgissent de toutes parts et ne se ressemblent pas : à déplier, à scruter, à toucher... Une extravagance tri-dimensionnelle qui enthousiasmera et impressionnera les petits comme les grands.', 31, 1, 600, 'alice-in-wonderland-robert-sabuda.jpg', 6, 'alice-in-wonderland-robert-sabuda.jpg', '2022-01-23 17:20:28'),
(7, 'Le Songe d\'une nuit d\'été', 'William Shakespeare', 'À la cour d’Athènes, Hermia en appelle à la clémence de son père Égée qui veut lui imposer comme mari Démétrius, alors qu’elle aime Lysandre. Pour échapper à son sort, elle se réfugie dans la forêt, bientôt suivie par les autres protagonistes. Là, Obéron, roi des elfes, qui vient de se quereller avec sa femme Titania, fait appel au malicieux lutin Puck et à ses philtres d’amour. De nombreuses aventures amoureuses vont alors se croiser, se faire et se défaire, au gré des sortilèges et des intrigues, mêlant monde classique et monde légendaire. Cette comédie à la fantaisie débridée se double d’une saveur parodique et satirique  : les amours heureuses sont-elles possibles sans enchantement  ? Avec Le Songe d’une nuit d’été, Shakespeare donne libre cours à une incroyable liberté d’imagination qui continue à fasciner le public moderne.\r\n\r\nTraduction de François-Victor Hugo.', 17, 8, 300, 'a-midsummer-nights-dream.jpg', 3, 'a-midsummer-nights-dream-william-shakespeare', '2022-01-23 17:23:36'),
(8, 'La Ferme des Animaux', 'George Orwell', 'Un jour de juin eut lieu en Angleterre la révolte des animaux. Les cochons dirigent le nouveau régime. Boule-de-Neige et Napoléon, cochons en chef, affichent un règlement : \"Tout ce qui marche sur deux pieds est un ennemi. Tout ce qui marche sur quatre pattes, ou possède des ailes, est un ami. Nul animal ne portera de vêtements. Nul animal ne dormira dans un lit. Nul animal ne boira d\'alcool. Nul animal ne tuera un autre animal. Tous les animaux sont égaux.\" Le temps passe. La pluie efface les commandements. L\'âne, un cynique, arrive encore à déchiffrer : \"Tous les animaux sont égaux, mais certains animaux sont plus égaux que d\'autres.\"', 21, 4, 400, 'animal-farm.jpg', 2, 'la-ferme-des-animaux-george-orwell', '2022-01-23 17:24:06'),
(9, 'Aventures de Trois Russes', 'Jules Verne', '\"Aventures de trois Russes et de trois Anglais dans l\'Afrique Australe\" est un roman d\'aventures de Jules Verne, publié en 1872, dont l\'action se déroule en Afrique du Sud en 1854. Trois savants russes et trois savants anglais ont pour mission de mesurer un arc de méridien. Si une amitié profonde unit William Emery et Michel Zorn, une grande rivalité oppose Mathieu Strux et le Colonel Everest, co-dirigeants de la mission anglo-russe. Une mauvaise nouvelle vient encore creuser le fossé qui les sépare : le déclenchement de la Guerre de Crimée, opposant notamment la France et l\'Angleterre à la Russie.\r\n\r\nL\'œuvre de Jules Verne est universelle ; selon l’Index Translationum, avec un total de 4 751 traductions, il vient au deuxième rang des auteurs les plus traduits en langue étrangère après Agatha Christie et devant Shakespeare1. Il est ainsi, en 2011, l\'auteur de langue française le plus traduit dans le monde. L\'année 2005 en France a été déclarée « année Jules Verne », à l\'occasion du centenaire de la mort de l\'écrivain.', 17, 4, 500, 'aventures-de-trois-russes.jpg', 2, 'aventures-de-trois-russes-jules-verne', '2022-01-23 17:27:55'),
(10, 'La Belle et la Bête', 'Mme Leprince de Beaumont', 'Il était une fois un prince qu\'un enchantement avait métamorphosé en bête et une jeune fille très belle et très bonne... Il était une fois un prince très laid mais plein d\'esprit et une jeune fille très belle mais dépourvue d\'intelligence... ou bien encore un vilain caneton qui était en réalité un cygne... De Perrault à Andersen, en passant par Madame Leprince de Beaumont, les contes merveilleux tendent à notre réalité un miroir magique dans lequel se dessine le destin de ces personnages tributaires du regard des autres et dans lequel finit par se dissiper le mirage des apparences trompeuses.\r\nAutres contes : Madame Leprince de Beaumont - La Belle et la Bête - Belote et Laidronette Charles Perrault - Riquet à la houppe Hans Christian Andersen - Le vilain petit canard - Les textes intégraux annotés de quatre contes - Des questionnaires au fil du texte - Des documents iconographiques exploités - Un dossier Lecture d\'images et histoire des Arts s\'appuyant sur 5 documents en couleur reproduits sur les rabats de couverture - Une présentation des auteurs et de leurs époques - Un aperçu du genre du conte - Un groupement de textes : \"La face cachée des monstres\".', 18, 0, 500, 'beauty-beast.jpg', 6, 'la-belle-et-la-bete-madame-leprince-de-beaumont', '2022-01-23 17:31:00'),
(11, 'Beren et Lúthien', 'J.R.R. Tolkien', 'Avec ce nouveau livre de J. R. R. Tolkien, édité par son fils Christopher Tolkien, découvrez l’histoire d’amour qui est coeur du monde du Seigneur des Anneaux ! Des milliers d’années avant Bilbo et Frodo, avant Gandalf et l’Anneau, un homme et une Elfe tentent de vivre un amour interdit par la rivalité entre leurs peuples et se lancent dans la plus grande des aventures en Terre du Milieu : reprendre un Silmaril au terrible dieu Morgoth. Traversant mille périls, ils parviendront à la forteresse du maître de Sauron, où l’Elfe Lúthien montrera que le plus grand des héros de Tolkien est une héroïne, qui inspirera à son tour l’amour d’Aragorn et Arwen, dans Le Seigneur des Anneaux. Magnifiquement illustré en couleurs et en noir et blanc par Alan Lee, illustrateur du Seigneur des Anneaux, des Enfants de Húrin, artiste oscarisé pour son travail de conception des films de Peter Jackson, ce texte a été écrit en 1917, alors que Tolkien rentre du front pendant la Première Guerre mondiale – il a participé à la bataille de la Somme. Il est présenté par Christopher Tolkien, qui raconte le monde d’avant les Hobbits et l’Anneau, et qui rappelle comment est née cette histoire d’amour et d’aventures, reflet de l’histoire de ses propres parents, Edith et J. R. R. Tolkien. Cette édition contient plusieurs versions de l’histoire, peu connues des lecteurs du Hobbit, du Silmarillion et du Seigneur des Anneaux.', 28, 5, 500, 'beren-et-luthien.jpg', 1, 'beren-et-luthien-jrr-tolkien', '2022-01-23 17:32:25'),
(12, 'Le Journal de Bridget Jones', 'Helen Fielding', '\"58,5 kg (mais post-Noël), unités d\'alcool : 14 (mais compte en fait pour deux à cause de soirée de nouvel an), cigarettes : 22, calories : 5 422\". A presque trente ans, Bridget Jones consigne ses déboires amoureux dans son journal. Elle sort trop, fume trop, boit trop, compte les calories et fantasme sur son play-boy de patron. Sa hantise : finir vieille fille. Ses objectifs : perdre du poids et trouver son prince charmant.\r\nL\'irrésistible confession de la célibataire la plus célèbre de la planète. ', 16, 4, 300, 'bridget-jones.jpg', 4, 'le-journal-de-bridget-jones-helen-fielding', '2022-01-23 17:43:23'),
(13, 'Appelle-moi par ton nom', 'André Aciman', 'Elio Perlman se souvient de l’été de ses 17 ans, à la fin des années quatre-vingt. Comme tous les ans, ses parents accueillent dans leur maison sur la côte italienne un jeune universitaire censé assister le père d’Elio, éminent professeur de littérature. Cette année l’invité sera Oliver, dont le charme et l’intelligence sautent aux yeux de tous. Au fil des jours qui passent au bord de la piscine, sur le court de tennis et à table où l’on se laisse aller à des joutes verbales enflammées, Elio se sent de plus en plus attiré par Oliver, tout en séduisant Marzia, la voisine. L’adolescent et le jeune professeur de philosophie s’apprivoisent et se fuient tour à tour, puis la confusion cède la place au désir et à la passion. Quand l’été se termine, Oliver repart aux États-Unis, et le père d’Elio lui fait savoir qu’il est loin de désapprouver cette relation singulière…\r\nQuinze ans plus tard, Elio rend visite à Oliver en Nouvelle-Angleterre. Il est nerveux à l’idée de rencontrer la femme et les enfants de ce dernier, mais les deux hommes comprennent finalement que la mémoire transforme tout, même l’histoire d’un premier grand amour. Quelques années plus tard, ils se rendent ensemble à la maison en Italie où ils se sont aimés et évoquent la mémoire du père d’Elio, décédé depuis.', 24, 1, 400, 'call-me-by-your-name', 4, 'appelle-moi-par-ton-nom-andre-aciman', '2022-01-23 17:48:44'),
(14, 'Dans l\'Abîme du temps', 'H.P. Lovecraft', 'Certaines choses devraient rester cachées pour l\'éternité... En 1935, au fin fond de l\'Australie, le Pr Nathaniel Peaslee recherche avec frénésie les traces d\'une civilisation inconnue. Il ne comprend pas pourquoi, mais il connaît ces lieux, comme si un autre avait implanté des souvenirs en lui. Il sait que quelque chose d\'aussi mystérieux que terrifiant se tapit, là, dans les profondeurs du sable du désert... Son monde a été chamboulé près de 30 ans plus tôt. À l\'époque, il enseigne à la prestigieuse université de Miskatonic. Il mène une vie paisible, entouré de sa femme et de ses enfants... jusqu\'au jour où il s\'effondre en plein cours. À son réveil, personne ne le reconnaît. Il a toujours la même apparence, mais semble avoir perdu la raison ! Il parle un dialecte inconnu et se comporte comme un étranger. Pire, il se prend de passion pour les sciences occultes, allant même jusqu\'à se plonger dans l\'étude du Necronomicon, ouvrage maudit entre tous... ', 34, 3, 600, 'dans-labime-du-temps.jpg', 1, 'dans-labime-du-temps-hp-lovecraft', '2022-01-23 17:50:40'),
(15, 'De la Terre à la Lune', 'Jules Verne', 'A la fin de la guerre fédérale des états-Unis, les fanatiques artilleurs du Gun-Club (Club-Canon) de Baltimore sont bien désoeuvrés. Un beau jour, le président, Impey Barbicane, leur fait une proposition qui, le premier moment de stupeur passé, est accueillie avec un enthousiasme délirant. Il s\'agit de se mettre en communication avec la Lune en lui envoyant un boulet, un énorme projectile qui serait lancé par un gigantesque canon ! Tandis que ce projet inouï est en voie d\'exécution, un Parisien, Michel Ardan, un de ces originaux que le Créateur invente dans un moment de fantaisie, et dont il brise aussitôt le moule, télégraphie à Barbicane : « Remplacez obus sphérique par projectile cylindroconique. Partirai dedans »... Avec ses personnages parfaitement campés, son humour toujours présent, De la Terre à la Lune est une des grandes oeuvres de Jules Verne, une de ses plus audacieuses anticipations.', 21, 7, 500, 'de-la-terre-a-la-lune.jpg', 2, 'de-la-terre-a-la-lune-jules-verne', '2022-01-23 17:51:43'),
(16, 'De l\'Autre Côté du Miroir', 'Lewis Carroll', ' Edition exceptionnelle en format broché: deux chefs-d\'oeuvres en un ouvrage unique. Entièrement illustrée par les oeuvres originales (en noir et blanc) de John Tenniel. Cette édition comprend les deux chefs-d\'oeuvre de Lewis Carroll: Alice au Pays des Merveilles (1866) et sa suite De l\'autre côté du miroir (1872).\r\n\r\nLa jeune Alice s\'ennuie dans un monde qu\'elle trouve trop conventionnel. Mais voilà qu\'un lapin blanc, vêtu d\'une redingote avec une montre à gousset, passe près d\'elle en courant. Alice part à sa poursuite et s\'égare au Pays des Merveilles, peuplé de créatures étranges et gouverné par la terrible Reine Rouge. Un monde où plus rien n’est logique!\r\nEt lorsqu\'elle passe de l\'autre côté du miroir, elle fait face à un monde à l\'envers où encore bien des surprises l\'attendent... Dans cet univers fantastique, Alice va rencontrer une galerie de personnages retors et se trouver confrontée au paradoxe, à l\'absurde, aux mystères et au bizarre.\r\n\r\nCes contes époustouflants, savoureux mélanges de fantastique, de satire, de suspens, d\'humour et de non-sens, vous transporteront dans l\'univers onirique de l\'enfance.', 25, 5, 400, 'de-lautre-cote-du-miroir.jpg', 6, 'de-lautre-cote-du-miroir-lewis-carroll', '2022-01-23 17:53:22'),
(17, 'Do Androids Dream of Electric Sheep?', 'Philip K. Dick', 'Le mouton n\'était pas mal, avec sa laine et ses bêlements plus vrais que nature - les voisins n\'y ont vu que du feu. Mais il arrive en fin de carrière : ses circuits fatigués ne maintiendront plus longtemps l\'illusion de la vie. Il va falloir le remplacer. Pas par un autre simulacre, non, par un véritable animal. Deckard en rêve, seulement ce n\'est pas avec les maigres primes que lui rapporte la chasse aux androïdes qu\'il parviendra à mettre assez de côté. Holden, c\'est lui qui récupère toujours les boulots les plus lucratifs - normal, c\'est le meilleur. Mais ce coup-ci, ça n\'a pas suffi. Face aux Nexus-6 de dernière génération, même Holden s\'est fait avoir. Alors, quand on propose à Deckard de reprendre la mission, il serre les dents et signe. De toute façon, qu\'a-t-il à perdre ?', 23, 6, 500, 'do-androids-dream-of-electric-sheep.jpg', 2, 'do-androids-dream-of-electric-sheep-philip-k-dick', '2022-01-23 17:55:03'),
(18, 'Fondation : la Trilogie', 'Isaac Asimov', 'En ce début de treizième millénaire, l\'Empire n\'a jamais été aussi puissant, aussi étendu à travers toute la galaxie. C\'est dans sa capitale, Trantor, que l\'éminent savant Hari Seldon invente la psychohistoire, une science nouvelle permettant de prédire l\'avenir. Grâce à elle, Seldon prévoit l\'effondrement de l\'Empire d\'ici cinq siècles, suivi d\'une ère de ténèbres de trente mille ans. Réduire cette période à mille ans est peut-être possible, à condition de mener à terme son projet : la Fondation, chargée de rassembler toutes les connaissances humaines. Une entreprise visionnaire qui rencontre de nombreux et puissants détracteurs...', 60, 2, 650, 'fondation-la-trilogie.jpg', 2, 'fondation-la-trilogie-isaac-asimov', '2022-01-23 17:56:46'),
(19, 'Harry Potter à l\'École des Sorciers', 'J.K. Rowling', 'Découvrez ou redécouvrez le texte intégral de J.K. Rowling avec de sublimes illustrations en couleurs et huit surprises animées : ouvrez la lettre de Poudlard, parcourez le Chemin de Traverse, faites apparaître un festin dans la Grande Salle... Vivez comme jamais auparavant l\'aventure du plus célèbre des sorciers ! Une édition collector exceptionnelle conçue pour les fans de tous âges par MinaLima, le studio mondialement célébré, à l\'origine de l\'univers graphique des films Harry Potter et Les Animaux fantastiques.', 35, 4, 600, 'harry-potter-a-lecole-des-sorciers.jpg', 1, 'harry-potter-a-lecole-des-sorciers-mina-lima-jk-rowling', '2022-01-23 17:59:08'),
(20, 'Harry Potter and the Philosopher\'s Stone', 'J.K. Rowling', 'Harry Potter has never even heard of Hogwarts when the letters start dropping on the doormat at number four, Privet Drive. Addressed in green ink on yellowish parchment with a purple seal, they are swiftly confiscated by his grisly aunt and uncle. Then, on Harry\'s eleventh birthday, a great beetle-eyed giant of a man called Rubeus Hagrid bursts in with some astonishing news: Harry Potter is a wizard, and he has a place at Hogwarts School of Witchcraft and Wizardry. An incredible adventure is about to begin! These new editions of the classic and internationally bestselling, multi-award-winning series feature instantly pick-up-able new jackets by Jonny Duddle, with huge child appeal, to bring Harry Potter to the next generation of readers. It\'s time to pass the magic on.', 22, 6, 350, 'harry-potter-and-the-philosophers-stone.jpg', 1, 'harry-potter-and-the-philosophers-stone-sotheby-jk-rowling.jpg', '2022-01-23 18:00:34'),
(21, 'Harry Potter et la Chambre des Secrets', 'J.K. Rowling', 'Découvrez ou redécouvrez le texte intégral de J.K. Rowling avec de sublimes illustrations en couleurs et huit surprises animées : explorez le Terrier des Weasley, échappez au redoutable Saule cogneur, voyagez avec la poudre de Cheminette... Vivez comme jamais auparavant l\'aventure du plus célèbre des sorciers ! Une édition collector exceptionnelle conçue pour les fans de tous âges par MinaLima, le studio à l\'origine de l\'univers graphique des films Harry Potter et Les Animaux fantastiques.', 35, 6, 600, 'harry-potter-et-la-chambre-des-secrets.jpg', 1, 'harry-potter-et-la-chambre-des-secrets-minalima-jk-rowling', '2022-01-23 18:01:39'),
(22, 'Harry Potter et le Prisonnier d\'Azkaban', 'J.K. Rowling', 'Sirius Black, un dangereux criminel, s\'est échappé de la prison d\'Azkaban et recherche Harry Potter. C\'est donc sous bonne garde que l\'apprenti sorcier fait sa troisième rentrée. Au programme : des cours de divination, la fabrication d\'une potion de ratatinage, le dressage des hippogriffes... Mais Harry est-il vraiment à l\'abri du danger qui le menace ?', 32, 9, 600, 'harry-potter-et-le-prisonnier-dazkaban.jpg', 1, 'harry-potter-et-le-prisonnier-dazkaban-jk-rowling', '2022-01-23 18:02:40'),
(23, 'John Carter of Mars', 'Edgar Rice Burroughs', 'The book \"John Carter of Mars\" comprises two novelettes originally published in Amazing Stories pulp magazine: \"John Carter and the Giant of Mars\" was published in the January 1941 issue with the byline \"Edgar Rice Burroughs\". However, ERB had nothing to do with the writing of the story! It was written by his younger son, John Coleman Burroughs. In the February 1943 issue of Amazing Stories, \"Skeleton Men of Jupiter\" appeared, the first part of a 4-part novel. Unfortunately, due to World War II and the failing health of ERB, the remaining 3 stories were not written.', 17, 10, 500, 'john-carter.jpg', 2, 'john-carter-edgar-rice-burroughs', '2022-01-23 18:04:33'),
(24, 'La Guerre des Mondes', 'H.G. Wells', '1894. Des astronomes sont témoins d\'étranges activités à la surface de Mars, comme des éclairs ou des explosions de gaz incandescent. L\'étonnant phénomène se répète pendant les dix nuits suivantes puis cesse. Des météores venant de la planète rouge se dirigent bientôt vers la Terre. Le premier s\'écrase en Angleterre, dans le Surrey : il s\'agit d\'un objet ayant la forme d\'un cylindre de vingt-cinq à trente mètres. Les curieux se rassemblent autour du cratère formé par la chute du projectile, mais ils sont bientôt tués par un « Rayon Ardent » projeté par une machine gigantesque à trois énormes jambes sortie du cylindre. ', 18, 10, 500, 'la-guerre-des-mondes.jpg', 2, 'la-guerre-des-mondes-george-orwell', '2022-01-23 18:06:17'),
(25, 'La Machine à explorer le temps', 'H.G. Wells', 'Londres, à l’extrême fin du XIXe siècle. Dans la maison d’un savant, un groupe d’amis écoute celui qui prétend être le premier voyageur du temps narrer ses aventures.\r\n\r\nLe voyageur du temps commence son récit en décrivant le monde de l’an 802 701. La Terre est habitée par les Éloïs, descendants des hommes. Androgynes, simplets et doux, ils passent leur temps à jouer tels des enfants et à manger des fruits dans le grand jardin qu’est devenue la Terre. À la surface de celle-ci, ne subsiste plus aucune mauvaise herbe, ni aucune autre espèce animale. Le monde semble être devenu un paradis.\r\nToutefois l’explorateur du temps ne tarde pas à se rendre compte que cette apparente harmonie cache un terrible secret. Des puits menant à des systèmes d’habitations souterraines sont répartis un peu partout, et un bruit de machine s’en échappe. C’est sous terre que vit une autre espèce descendante aussi des hommes, les Morlocks, sortes de singes blancs aux yeux rouges ne supportant plus la lumière à force de vivre dans l’obscurité. La nuit, ils vont et viennent à la surface en remontant par les puits, pour enlever des Éloïs dont ils se nourrissent, devenus ainsi leur bétail à leur insu.', 18, 10, 400, 'la-machine-a-explorer-le-temps.jpg', 2, 'la-machine-a-explorer-le-temps-george-orwell', '2022-01-23 18:09:05'),
(26, 'La Château des Étoiles : Tome 1', 'Alex Alice', '1869. Au nom de Sa Majesté, la conquête des étoiles commence... Et si la conquête des étoiles avait un siècle d\'avance ? 1868. À bord de son ballon de haute altitude, la mère de Séraphin disparaît mystérieusement à la frontière de l\'espace. Un an plus tard, une lettre anonyme révèle que son carnet de bord a été retrouvé... Séraphin et son père, échappant de justesse à un enlèvement, suivent la piste du carnet jusque dans les contreforts des Alpes. C\'est là, à l\'ombre d\'un château de conte de fées, que le roi Ludwig de Bavière a entrepris la construction d\'un engin spatial de cuivre et de bois qui s\'apprête à changer le cours de l\'Histoire. Mêlant aventure à la Jules Verne, romantisme et humour, ce livre s\'adresse aux rêveurs de toutes les générations et démontre, s\'il le fallait, qu\'il n\'y a pas d\'âge pour le merveilleux. Une édition de luxe grand format avec un cahier graphique supplémentaire et une couverture inédite créée spécialement pour l\'occasion, voilà de quoi ravir les yeux de chacun.', 16, 6, 600, 'le-chateau-des-etoiles-1.jpg', 5, 'le-chateau-des-etoiles-tome-1', '2022-01-23 18:17:02'),
(27, 'La Château des Étoiles : Tome 5', 'Alex Alice', 'Planète Mars, 1873 : Séraphin et ses amis escortent la Princesse et son peuple à travers les hauts plateaux. La colonne de martiaux fuit l\'invasion prussienne, et espère trouver refuge au-delà des terres interdites du pôle de Mars. Mais les phénomènes étranges se multiplient, et les aigles de guerre de Bismarck menacent... Poussés au bord du désespoir, leur salut viendra-t-il des reliques d\'une antique civilisations martienne, ou d\'une alliance plus pragmatique avec le tout nouvel empire interplanétaire de Napoléon III ?', 17, 10, 650, 'le-chateau-des-etoiles-5.jpg', 5, 'le-chateau-des-etoiles-tome-5', '2022-01-23 18:17:55'),
(28, 'Le Dit du Genji', 'Murasaki Shikibu', 'Chef-d\'œuvre de la littérature japonaise rédigé au début du xiᵉ siècle, Le Dit du Genji raconte l\'histoire de la vie du prince Genji le Radieux dans l\'atmosphère raffinée de la cour impériale de Heian, l\'actuelle Kyôto. Le héros passe sa jeunesse à errer sur les chemins de l\'amour, en quête éperdue de la femme idéale. Sa vie tumultueuse lui fait connaître la souffrance de l\'exil, la solitude, puis la reconquête du pouvoir. C\'est en élevant une toute jeune fille que le Genji façonne une femme parfaite et atteint ainsi l\'amour profond que la seule la mort peut séparer.\r\n\r\n520 œuvres en couleurs du XIIe au XVIIe siècle parmi les plus remarquables, et pour la plupart inédites en Occident, ont été sélectionnées. L\'intégralité des plus anciens fragments de rouleaux subsistant du XIIe siècle et classés trésors nationaux au Japon sont reproduits dans cette édition. On y trouve aussi deux albums d\'images et de calligraphies du XVIᵉ et du XVIIᵉ siècle, des pages d\'albums, des paravents peints en vives couleurs, des kakémonos et éventails d\'une beauté et d\'une finesse inégalables.', 155, 3, 1000, 'le-dit-du-genji.jpg', 3, 'le-dit-du-genji-murasaki-shikibu', '2022-01-23 18:20:39'),
(29, 'Le Hobbit (illustré)', 'J.R.R. Tolkien', 'Premier récit publié par JRR Tolkien, en 1937, cette histoire, inventée par lauteur pour ses propres enfants, rapporte les aventures de Bilbo, un jeune Hobbit, héros malgré lui lancé en quête dun trésor gardé par un dragon, en compagnie de Nains et du magicien Gandalf. Bien que destiné initialement à la jeunesse, ce texte a également enchanté des générations de lecteurs adultes, par son suspense, ses coups de théâtre, son humour, sa poésie mais aussi parce quil introduit le lecteur dans un monde inventé par Tolkien, la Terre du Milieu, qui sert de décor à la plupart de ses récits (dont Le Seigneur des Anneaux) ; et parce quil présente des personnages appelés à connaître une grande postérité, dont les Hobbits, Gandalf et lAnneau. Cette édition est servie par la nouvelle traduction, assurée par Daniel Lauzon, qui respecte les particularités du texte, son jeu avec les registres (du plus léger, au début du récit, vers des moments plus sombres, annonçant Le Seigneur des Anneaux qui prendra sa suite), la musicalité des chansons et des poèmes.', 37, 6, 500, 'le-hobbit.jpg', 1, 'le-hobbit-jrr-tolkien', '2022-01-23 18:21:56'),
(30, 'Le Lion, la Sorcière Blanche et l\'Armoire Magique', 'C.S. Lewis', 'Narnia... Un royaume merveilleux condamné à un hiver éternel, un pays qui attend d\'être libéré d\'une emprise maléfique. L\'arrivée extraordinaire de quatre enfants fait renaître l\'espoir. S\'ils trouvent Aslan, le grand Lion, les pouvoirs de la Sorcière Blanche pourraient enfin être anéantis...', 27, 7, 600, 'le-lion-la-sorciere-blanche-et-larmoire-magique.jpg', 1, 'le-lion-la-sorciere-blanche-et-larmoire-magique-cs-lewis', '2022-01-23 18:23:24'),
(31, 'Le Neveu du Magicien', 'C.S. Lewis', 'Polly trouve parfois que la vie à Londres n\'est guère passionnante... jusqu\'au jour où elle rencontre son nouveau voisin, Digory. Il vit avec sa mère, gravement malade, et un vieil oncle au comportement étrange. Celui-ci force les deux enfants à essayer des bagues magiques qui les transportent dans un monde inconnu. Commence alors la plus extraordinaire des aventures...', 26, 10, 500, 'le-neveu-du-magicien.jpg', 1, 'le-neveu-du-magicien-cs-lewis', '2022-01-23 18:26:42'),
(32, 'Les Aventures de Tintin, intégrale', 'Hergé', 'Ce coffret rassemble la totalité des 24 aventures du célèbre héros, depuis Tintin au pays des Soviets jusqu\'à Tintin et l\'Alph-Art. Ce coffret est l\'occasion de redécouvrir et d\'apprécier cette oeuvre totalement intemporelle.', 99, 4, 6300, 'les-aventures-de-tintin-integrale.jpg', 5, 'les-aventures-de-tintin-integrale-herge', '2022-01-23 18:28:35'),
(33, 'Les Premiers Homme dans la Lune', 'H.G. Wells', 'Cavor, un scientifique, met au point la cavorite, un métal révolutionnaire qui crée l\'apesanteur, avec lequel il construit un astronef. Accompagné par Bedford, un jeune aventurier voulant faire fortune, il se dirige vers la Lune où ils découvrent la civilisation souterraine des Sélénites.', 19, 0, 500, 'les-premiers-homme-dans-la-lune.jpg', 2, 'les-premiers-homme-dans-la-lune-george-orwell', '2022-01-23 18:29:57'),
(34, 'Le Tour du Monde en 80 Jours', 'Jules Verne', 'Le Tour du Monde en 80 Jours est un roman d’aventures de Jules Verne paru en 1872. Il relate l’histoire de Phileas Fogg, (un gentleman anglais), et de son fidèle serviteur Jean Passepartout. Lorsque Phileas Fogg apprend dans le journal local qu’il est possible de réaliser le tour du monde en moins de 80 jours grâce à l’ouverture d’une nouvelle voie de chemin de fer en Inde, il parie 20.000 livres avec ses confrères du Reform Club qu’il parviendra à réaliser ce voyage dans le temps imparti.\r\nUne aventure semée d’embûches et de péripéties à la découverte de contrées encore méconnues au XIXe siècle. Alternant récit de voyage et succession de données scientifiques, Jules Verne nous fait découvrir les avancées technologiques de l’époque au travers d’une épopée inoubliable.', 36, 9, 700, 'le-tour-du-monde-en-80-jours.jpg', 2, 'le-tour-du-monde-en-80-jours-jules-verne', '2022-01-23 18:31:21'),
(35, 'Le Trésor de Rackham le Rouge', 'Hergé', 'Le 10 janvier 1929, un jeune reporter fait son apparition dans Le Petit Vingtième, le supplément pour enfants du quotidien belge Le XXe siècle. Son nom ? Tintin. Accompagné de Milou, un jeune chien blanc, il part pour la \"Russie soviétique\". Son créateur, un certain Georges Remi, signe Hergé, pseudonyme inspiré par ses initiales. Après ce premier voyage en Russie, qui donne naissance à l\'album Tintin chez les Soviets, le jeune reporter s\'envole pour l\'Afrique (Tintin au Congo), puis pour l\'Amérique. Mais c\'est Le Lotus bleu, publié dans Le Petit Vingtième dès août 1934, qui marque un tournant important dans l\'œuvre d\'Hergé. Celui-ci, après avoir rencontré Tchang Tchong-Jen, jeune étudiant chinois qui lui a ouvert les yeux sur l\'Asie, va désormais se soucier de rigueur documentaire. Il va aussi s\'efforcer de faire passer dans ses histoires un message d\'humanisme et de tolérance. Le succès de son reporter à la houppe ne va cesser de grandir. Hergé lui fait parcourir le monde. Il teinte ses aventures d\'onirisme (L\'Étoile mystérieuse), flirte avec le surnaturel (Les Sept Boules de cristal), l\'expédie même sur la lune.', 15, 0, 430, 'le-tresor-de-rackham-le-rouge.jpg', 5, 'le-tresor-de-rackham-le-rouge-herge', '2022-01-23 18:33:10'),
(36, 'Frankenstein (Illustré)', 'Mary Shelley', 'A quinze ans, Victor Frankenstein est témoin d\'un violent orage : foudre, traînée de feu, destructions... Son destin est tracé. Après des années de labeur, il apprend à maîtriser les éléments ; l\'alchimie est pour lui une seconde nature. Et bientôt, le savant détient le pouvoir d\'animer la matière inerte. Par une terrible nuit, l\'inventeur va accomplir sa grande oeuvre, aboutissement de toutes ses recherches : il donne vie à une horrible créature faite d\'un assemblage de cadavres. Un monstre ! Repoussant, inachevé, doté d\'une force surhumaine, mais tragiquement conscient de sa solitude ; d \'esclave qu\'il aurait dû être, \"l\'autre\" va s\'échapper des ténèbres, implorer la compassion de son créateur et, dans sa détresse, semer autour de lui crimes et désolation...', 120, 1, 700, 'frankenstein.jpg', 2, 'frankenstein-limited-edition-easton-press-mary-shelley-douglas-bell', '2022-01-23 18:48:08'),
(37, 'L\'Homme Invisible', 'H.G. Wells', 'L\'hiver est morte saison à Iping. Aussi, quand l\'étranger arrive à l\'auberge, madame Hall décide-t-elle de choyer cet hôte providentiel. Il est pourtant bien étrange ! Brusque, coléreux, impatient, toujours emmitouflé de la tête aux pieds, retranché derrière d\'épaisses lunettes. Vous qui avez rêvé un jour d\'être invisible, cette histoire effroyable est pour vous... ', 19, 11, 400, 'lhomme-invisible.jpg', 2, 'lhomme-invisible-george-orwell', '2022-01-24 15:22:52'),
(38, 'L\'Île du Docteur Moreau', 'H.G. Wells', '\" Il me revint en tête - par quel procédé mental inconscient -, une phrase qui fit retourner ma mémoire de dix ans en arrière. Elle flotta imprécise en mon esprit pendant un moment, puis je revis un titre en lettres rouges : Le Docteur Moreau, sur la couverture chamois d\'une brochure révélant des expériences qui vous donnaient, à les lire, la chair de poule. Ensuite mes souvenirs se précisèrent, et cette brochure depuis longtemps oubliée me revint en mémoire, avec une surprenante netteté. J\'étais encore bien jeune à cette époque, et Moreau devait avoir au moins la cinquantaine. C\'était un physiologiste fameux et de première force, bien connu dans les cercles scientifiques pour son extraordinaire imagination et la brutale franchise avec laquelle il exposait ses opinions. \" ', 19, 1, 400, 'lile-du-docteur-moreau.jpg', 2, 'lile-du-docteur-moreau-hg-wells', '2022-01-24 15:24:03'),
(39, 'Little Nemo : 1905-1914', 'Winsor McCay', 'Little Nemo de Winsor McCay fit son entrée le 15 octobre 1905 dans les pages du New York Herald, et il est incontestablement l\'un des classiques inégalés qui peuplent l\'histoire relativement récente de la bande dessinée. Au premier coup d\'œil, le héros de ces épisodes hauts en couleur n\'a rien de sensationnel, pourtant les rêves fantastiques du gamin en pyjama n\'ont rien perdu de leur magie pour le lecteur d\'aujourd\'hui. Loin d\'être une plaisante BD pour enfants, Little Nemo transpose dans l\'univers du dessin avec un humour subtil un des thèmes les plus marquants des temps modernes - la découverte de l\'inconscient. A la recherche du légendaire pays des songes, Nemo traverse des contrées inconnues, menaçantes le plus souvent et toujours déconcertantes, où rien n\'est ce qu\'il paraît être au premier abord : les objets familiers deviennent gigantesques ou minuscules, des êtres mythiques grimaçants le guettent. Les maisons s\'élèvent à des hauteurs vertigineuses avant de s\'écrouler l\'instant qui suit - à l\'orée du XXe siècle, peut-on encore se fier au monde tel qu\'il est ?', 70, 1, 700, 'little-nemo-1905-1914.jpg', 5, 'little-nemo-1905-1914-winsor-mccay', '2022-01-24 15:26:14'),
(40, 'L\'Œuvre Complète de H.P. Lovecraft ', 'H.P. Lovecraft', 'Le plus grand écrivain américain après Edgar Poe dans le domaine du fantastique, Howard Phillips Lovecraft (1890-1937) reste aussi méconnu que lui dans son pays d\'origine. Écrits dès l\'âge de six ans, ses Premiers Contes - inédits en français - révèlent pourtant le génie précoce de celui qui allait rénover le fantastique en lui donnant une dimension cosmique. En deux romans et dix-huit nouvelles, Lovecraft imagine que les prodiges et les monstres du folklore européen (fantômes, sorciers, vampires), les abîmes temporels des religions orientales, les fables et légendes de l\'Antiquité ne sont que les manifestations d\'un culte secret unique. Culte de l\'immense et monstrueux Cthulhu, l\'un des Grands Anciens qui régnèrent il y a des millions d\'années sur la Terre et rêvent de la reconquérir. Regroupés pour la première fois, alors qu\'ils étaient dispersés chez des éditeurs différents, ces vingt textes permettent de suivre la montée du mythe de Cthulhu dans l\'inspiration de Lovecraft de 1917 à 1935. Entreprise couronnée par les Légendes du mythe de Cthulhu, la contribution des amis de Lovecraft à son mythe, faisant de celui-ci une épopée cosmique collective sur le modèle d\'une Odyssée peinte avec les seules couleurs du cauchemar.', 75, 1, 800, 'loeuvre-complete-de-hp-lovecraft.jpg', 1, 'loeuvre-complete-de-hp-lovecraft', '2022-01-24 15:28:37'),
(41, 'L\'Œuvre Complète de William Shakespeare', 'William Shakespeare', 'LES 12 TRAGÉDIES :\r\nAntoine et Cléopâtre • Coriolan • Le premier Hamlet • Le second Hamlet • Jules César • Macbeth • Othello • Le roi Lear • Roméo et Juliette • Timon d’Athènes • Titus Andronicus • Troïlus et Cressida.\r\n\r\nLES 12 COMÉDIES :\r\nBeaucoup de bruit pour rien • La comédie des méprises • Comme il vous plaira • Les deux gentilshommes de Vérone • Les joyeuses commères de Windsor • Le marchand de Venise • Mesure pour mesure • Le soir des rois ou ce que vous voudrez • Peines d’amour perdues • La mégère domptée • Le songe d’une nuit d’été • Tout est bien qui finit bien\r\n\r\nLES 5 ROMANCES :\r\nLe conte d’hiver • Cymbeline • Périclès, prince de Tyr • La tempête • Les deux nobles parents\r\n\r\nLES 10 PIÈCES HISTORIQUES :\r\nLe roi Jean • Le roi Richard II • Le roi Richard III • Le roi Henry IV (1) • Le roi Henry IV (2) • Le roi Henry V • Le roi Henry VI (1) • Le roi Henry VI (2) • Le roi Henry VI (3) • Le roi Henry VIII.\r\n\r\nLES 7 RECUEILS DE POÈMES :\r\nSonnets • Le pèlerin passionné • Le phénix et la colombe • Vénus et Adonis • Lucrèce • La plainte d’une amante • Le pèlerin amoureux.', 35, 1, 700, 'loeuvre-complete-de-shakespeare.jpg', 3, 'loeuvre-complete-de-william-shakespeare', '2022-01-24 15:31:29'),
(42, 'Marvel Universe : Volume 2', 'Melanie Scott', 'Which comic books have helped define Marvel Comics and make them the pop-culture phenomenon they are today? Find out in Marvel Greatest Comics, a compelling showcase of some of the most trailblazing and inspiring comic books ever created. From the groundbreaking original Human Torch and his aquatic adversary Namor, the Sub-Mariner in 1939 to the game-changing 1960s Super Hero icons such as Spider-Man, the Avengers, and the Fantastic Four, to smart modern makeovers in the 21st century like Guardians of the Galaxy and Squirrel Girl, Marvel have set the pace.\r\n\r\nThis book\'s specially curated and expertly appraised selection is a stunningly illustrated and insightful assessment of Marvel Comics and its legacy through the comics that made the company great. These are the comics that changed the face of an industry. These are Marvel\'s greatest comics.', 44, 2, 1200, 'marvel-universe-volume-2.jpg', 5, 'marvel-universe-volume-2', '2022-01-24 15:32:59'),
(43, 'Les Mauvais Anges', 'Eric Jourdan', 'Publié en 1955, interdit très vite, Les Mauvais Anges traîneront pendant de longues années (trente ans !), la malédiction d\'une décision prise à l\'époque par la fameuse Commission du Livre, entraînée par l\'abbé Pihan, naturellement très averti, sans doute, de ces \" amours particulières \".\r\nPourtant la première édition comportait deux textes, l\'un de Max-Pol Fouchet, l\'autre de Robert Margerit. L\'un et l\'autre célébrant le \" don de poésie exceptionnel \" de l\'auteur, adolescent à l\'époque (nous reproduisons ces textes en fin de volume). Ce que nous soulignerons surtout, c\'est à quel point ce court roman de la folle passion de deux très jeunes hommes garde – aujourd\'hui que la \" littérature homosexuelle \" se perd dans le réalisme le plus plat, le plus répétitif, le plus gratuit – une aura de trouble infini qui ira droit au coeur, même de ceux qui sont le plus étrangers à cet entraînement amoureux.', 22, 6, 300, 'mauvais-anges.jpg', 4, 'les-mauvais-anges-eric-jourdan', '2022-01-24 15:34:25'),
(44, 'Moby Dick', 'Robert Sabuda', 'Assoiffé d\'aventures, Ishmaël prend le large. De tous les Préface de Jean Giono navires qui sillonnent les mers au XIXᵉ siècle, les baleiniers sont sans doute les plus redoutables : c\'est sur l\'un d\'eux qu\'Ishmaël s\'embarque pour chasser ces léviathans et gagner l\'océan. À bord du Péquod, il fait la rencontre du capitaine Achab, voué à la destruction d\'un seul être : Moby Dick, la baleine blanche qui jadis emporta sa jambe. Rivé à un unique objet, Achab s\'identifie peu à peu à la baleine, métamorphose qui n\'épargne pas son corps : à la place de sa jambe mutilée trône désormais l\'os d\'un cétacé.Les considérations économiques et maritimes, comme les rêves de voyage d\'Ishmaël, cèdent le pas devant l\'obsession du marin pour l\'effroyable animal. Entraîné par la haine obstinée de son capitaine, l\'équipage voit son horizon progressivement réduit à la seule ombre blanche de Moby Dick. Derrière le roman d\'aventures, Melville peint les tourments d\'une haine passionnelle qui touche au plus brûlant des amours.', 38, 3, 700, 'moby-dick.jpg', 6, 'moby-dick-robert-sabuda', '2022-01-24 15:36:07'),
(45, 'Orgueil et Préjugés', 'Jane Austen', 'Elisabeth Bennet a quatre soeurs et une mère qui ne songe qu’à les marier. Quand parvient la nouvelle de l’installation à Netherfield, le domaine voisin, de Mr Bingley, célibataire et beau parti, toutes les dames des alentours sont en émoi, d’autant plus qu’il est accompagné de son ami Mr Darcy, un jeune et riche aristocrate. Les préparatifs du prochain bal occupent tous les esprits… Jane Austen peint avec ce qu’il faut d’ironie les turbulences du coeur des jeunes filles et, aujourd’hui comme hier, on s’indigne avec l’orgueilleuse Elisabeth, puis on ouvre les yeux sur les voies détournées qu’emprunte l’amour…', 29, 1, 600, 'orgueil-et-prejuges.jpg', 4, 'orgueil-et-prejuges-jane-austen', '2022-01-24 15:38:11'),
(46, 'Peter Pan', 'Robert Sabuda', 'Wendy, John et Michael n\'auraient jamais imaginé qu\'ils pouvaient voler. Ni qu\'ils s\'en iraient au Pays Imaginaire, affronter les Indiens et les Pirates du redoutable Capitaine Crochet. Seulement, un beau soir, Peter Pan a fait irruption dans leur vie bien tranquille...', 33, 8, 700, 'peter-pan.jpg', 6, 'peter-pan-robert-sabuda', '2022-01-24 15:39:56'),
(47, 'Quand le dormeur s\'éveillera', 'H.G. Wells', ' \"Comprenez bien que ce livre doit être le sommet de ma carrière. Il laissera La Guerre des mondes loin derrière.\'\r\nH. G. Wells, lettre à son agent James B. Pinker, mai 1897\r\n\r\nGraham, un Anglais vivant à Londres en 1897, prend des somnifères et tombe dans un coma profond. Il se réveille en 2100 et découvre un monde bouleversé, dans lequel il est devenu un homme puissant, détenant une grande partie des richesses du monde. Mais très vite, ce nouveau monde, plus inégalitaire que jamais, le dégoûte, au point de faire front avec des ouvriers révolutionnaires, désireux de renverser l\'ordre économique mondial.\r\n', 21, 10, 400, 'quand-le-dormeur-seveillera.jpg', 2, 'quand-le-dormeur-seveillera-hg-wells', '2022-01-24 15:41:13'),
(48, 'Raison et Sentiments', 'Jane Austen', '\r\n\r\nRedécouvrez l\'un des plus grands classiques de la littérature anglaise grâce à une édition inédite en France. Publiée en 1899 en Angleterre, cette édition comporte des illustrations de Chris Hammond, célèbre illustratrice victorienne.\r\n\r\nElinor et Marianne Dashwood sont deux soeurs aux caractères bien différents. Privées de leur héritage à la mort de leur père, elles doivent quitter le Sussex en compagnie de leur cadette Margaret et de leur mère. Dans le Devon, elles ne tardent pas à s\'habituer à leur désormais modeste quotidien au contact de leurs nouveaux voisins. Mais lorsqu\'elles tombent amoureuses, Elinor et Marianne se retrouvent tiraillées entre ce que leur impose la raison et ce que leur dicte leur coeur.\r\n\r\nPremier roman publié de Jane Austen, Raison et Sentiments est considéré comme l\'un des plus grands chefs-d\'oeuvre du XIXe siècle. Il annonçait déjà le talent de son autrice à brosser des galeries de personnages authentiques, et à peindre avec ironie et justesse les moeurs de son temps.\r\n', 28, 5, 700, 'sense-sensibility.jpg', 4, 'raison-et-sentiments-jane-austen', '2022-01-24 15:42:38'),
(49, 'The Twelve Days of Christmas', 'Robert Sabuda', 'A true holiday classic literally comes to life in this stunning pop-up edition of a seasonal favorite. With a partridge popping, snow scattering, and lords a-leaping off the page, this lavish book is a gift for readers of all ages. For this special anniversary edition legendary paper engineer Robert Sabuda encloses his own gifts to the reader: extra pages with a pop-up Christmas tree with real lights aglow, and a beautiful pop-up ornament of two turtledoves. The ornament is packaged with the book and is perfect for adding a celebratory touch to your tree. This beautiful anniversary package is one to treasure!', 30, 10, 600, 'the-12-days-of-christmas.jpg', 6, 'the-twelve-days-of-christmas-robert-sabuda', '2022-01-24 15:44:16'),
(50, 'L\'Odyssée', 'Robert Sabuda', 'Homère et la Bible, les deux sources de notre civilisation ? Des récits fondateurs de mythes, de religions, qui expliquent le monde et aident à vivre. Des modèles inépuisables, inlassablement traduits, adaptés, commentés, imités.\r\nIl existe d\'innombrables versions françaises de L\'Iliade et de L\'Odyssée. Chaque génération a inventé la sienne, conforme à son goût, ses rêves, ses ambitions. Il nous fallait la nôtre, dans la langue de notre temps, vivante, jeune, capable de nous restituer la fraîcheur, la vivacité, l\'humour de cette poésie. Une poésie populaire au meilleur sens du mot. Victor Hugo ne s\'y est pas trompé : \"Homère est l\'énorme poète enfant. Le monde naît, Homère chante. C\'est l\'oiseau de cette aurore. Homère a la candeur sacrée du matin. Il ignore presque l\'ombre [...]. Fable et histoire, hypothèse et tradition, chimère et science composent Homère. Il est sans fond, et il est riant.\"\r\nCette nouvelle traduction est l\'œuvre de Louis Bardollet, qui a enseigné le grec pendant trente ans à de jeunes lycéens. C\'est pour eux qu\'il a d\'abord transcrit L\'Iliade et L\'Odyssée, dans une langue qui est la leur. C\'est pourquoi sa traduction respire la poésie de la jeunesse. Elle est accompagnée de commentaires, de notes, de cartes et d\'un index analytique.', 35, 1, 700, 'the-odyssey.jpg', 3, 'the-odyssey-robert-sabuda', '2022-01-24 15:46:52'),
(51, 'Un Chant de Noël', 'Charles Dickens', 'Scrooge, un vieillard acariâtre, un vautour au coeur sec ignorant tout de lhumanité, reçoit le 24 décembre au soir la visite du fantôme de son défunt associé. Ce dernier lui fera vivre trois moments de sa vie, trois nuits de Noël, passée, présente et future, pour tenter de lui ouvrir les yeux et le coeur...', 28, 0, 500, 'un-chant-de-noel.jpg', 3, 'un-chant-de-noel-charles-dickens', '2022-01-24 15:48:28'),
(52, 'Le Magicien d\'Oz', 'Robert Sabuda', '\"En route, nous partons pour la Cité d\'Émeraude demander au grand Oz comment retourner au Kansas.\" Partez à l\'aventure avec Dorothée au pays magique d\'Oz ! Accompagnée de l\'Épouvantail, du Bûcheron-en-fer-blanc et du Lion Poltron, la jeune fille devra relever de nombreux défis pour parvenir à la merveilleuse Cité d\'Émeraude. En chemin, elle trouvera aussi le vrai sens de l\'amitié. Découvrez un grand classique de la littérature américaine dans cette superbe édition intégrale. Enrichi d\'illustrations et d\'animations originales du célèbre Robert Sabuda, cet ouvrage au charme unique enchantera les lecteurs de tous âges.', 33, 4, 700, 'the-wizard-of-oz.jpg', 6, 'le-magicien-d-oz-robert-sabuda', '2022-01-24 15:50:21');
INSERT INTO `product` (`id_product`, `title`, `author`, `description`, `price`, `stock`, `weight`, `image`, `collection_id`, `slug`, `createdAt`) VALUES
(53, 'Une Princesse de Mars', 'Edgar Rice Burroughs', 'Une princesse de Mars marque le début de l\'une des sagas les plus célèbres de Burroughs. Un soldat américain, John Carter, fuyant quelques bandits, entre dans une grotte et, pour des raisons inconnues, se réveille sur la planète Mars. Mais pas sur notre planète Mars, telle que nous la connaissons aujourd\'hui, mais sur Barsoom, ce que les Martiens appellent leur monde. Là, notre héros trouvera un monde merveilleux à découvrir, une civilisation nouvelle et fascinante, de l\'air respirable, des canaux, de l\'eau et différentes races se faisant face. En substance: l\'aventure dans sa forme el plus pure.', 44, 10, 500, 'une-princesse-de-mars.jpg', 2, 'une-princesse-de-mars-edgar-rice-burroughs', '2022-01-24 15:51:35'),
(54, 'Persuasion', 'Jane Austen', 'Lorsque Anne Elliot et Frederick Wentworth se rencontrent, ils tombent amoureux et se fiancent secrètement. Mais la marraine de la jeune femme le considérant peu convenable, la persuade de mettre fin à cette union. Après avoir fait fortune dans la Marine, Wentworth, devenu capitaine, revient en Angleterre et croise à nouveau Anne après des années de silence. Le temps, les non-dits et les incompréhensions auront-ils raison de leurs coeurs ? Publié après la mort de Jane Austen, Persuasion est son dernier roman achevé. Abordant le thème de la « seconde chance » en amour, il est considéré comme le plus abouti et le plus mature de tous.\r\n\r\nÉdition reliée. Couverture sur une toile impériale rose et marquage à chaud couleur or. Illustrations en noir à l\'intérieur pour enrichir le texte.', 27, 7, 650, 'persuasion.jpg', 4, 'persuasion-jane-austen', '2022-01-24 16:06:38');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `uuid` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `createdAt` datetime DEFAULT CURRENT_TIMESTAMP,
  `birthdate` datetime DEFAULT NULL,
  `role` int DEFAULT '0',
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `id_user` (`id_user`),
  UNIQUE KEY `username_2` (`username`,`email`),
  KEY `id_user_2` (`id_user`),
  KEY `url_address` (`uuid`,`first_name`,`email`,`createdAt`,`role`),
  KEY `last_name` (`last_name`),
  KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `uuid`, `first_name`, `last_name`, `username`, `email`, `password`, `createdAt`, `birthdate`, `role`) VALUES
(7, '8x9JFRXsRImfUsgdzgZq8OH3mLTdZ3P2KfN9GgmLr64mMx1cm6', 'test', 'test', 'test', 'test@ynov.com', 'b44dda1dadd351948fcace1856ed97366e679239', '2022-01-16 20:34:52', NULL, 0),
(5, '5O13DzMz2y3kWJM', 'Nicolas', 'LEPINAY', 'nicolaslepinay', 'nicolas.lepinay@ynov.com', 'b44dda1dadd351948fcace1856ed97366e679239', '2022-01-16 14:39:03', NULL, 1),
(8, 'gOSqNk3kG9crqJ0QaalxSZ', 'Theo', 'Scaffidi', 'tscaff', 'theo@gmail.com', 'b44dda1dadd351948fcace1856ed97366e679239', '2022-01-17 13:47:34', NULL, 0),
(9, 'IDN0a', 'Testie', 'Testo', 'test-test', 'test.test@ynov.com', 'b44dda1dadd351948fcace1856ed97366e679239', '2022-01-17 13:56:08', NULL, 0),
(10, 'Dc0UEqBH5C8f5VhhGem7', 'James', 'Dorian', 'james', 'james.dorian@gmail.com', 'b44dda1dadd351948fcace1856ed97366e679239', '2022-01-18 19:51:11', NULL, 0),
(21, 'QxLRZRkRU8KGxApYon8388CCTe1I7RKRSYPEDxmmPBQ3XpL', 'James', 'Newman', 'JamesNewman', 'james.newman@gmail.com', 'b44dda1dadd351948fcace1856ed97366e679239', '2022-01-22 13:46:56', NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `wishlist`
--

DROP TABLE IF EXISTS `wishlist`;
CREATE TABLE IF NOT EXISTS `wishlist` (
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `wishlist`
--

INSERT INTO `wishlist` (`user_id`, `product_id`) VALUES
(5, 41),
(5, 36),
(5, 7),
(5, 35),
(5, 2),
(5, 51);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
