INSERT INTO utilisateurs(id, username, password, email, role, prenom, nom, ddn) VALUES
(1, 'alice22', md5('1234'),  'alice22@example.com', 'admin', 'Alice', 'Dumoulin', '1982-11-26'),
(2, 'chalie', md5('1234'), 'chalie@example.com', 'gerant', 'Charlie', 'Elachocoleterie', '1977-01-12'),
(3, 'bobdu35', md5('1234'), 'bobdu35@example.com', 'client', 'Robert', 'Kinsey', '1982-10-12'),
(4, 'tywin', md5('1234'), 'tywin@example.com', 'client', 'Charles', 'Dance', '1946-10-10');

INSERT INTO `boutiques` (`id`, `nom`, `utilisateur_id`, `numero_rue`, `nom_adresse`, `code_postal`, `ville`, `pays`) VALUES
(1, 'La mika-line', 1, '10', 'Rue des Bonbons', '75001', 'Paris', 'France'),
(2, 'OK Bonbons', 2, '20', 'Avenue des Friandises', '69001', 'Lyon', 'France'),
(3, 'Saccharo', 3, '30', 'Boulevard des Saveurs', '13001', 'Marseille', 'France'),
(4, 'quoi feur', 3, '40', 'rue du ketchup', '56520', 'Guidel', 'France');


INSERT INTO `confiseries` (`id`, `nom`, `type`, `prix`, `illustration`, `description`) VALUES
(1, 'Haribo Tagada', 'Acide', 2.50, 'tagada.png', 'Bonbon Haribo Tagada, goût fraise'),
(2, 'Haribo Carensac', 'Réglisse', 2.00, 'carensac.png', 'Bonbon Haribo à la réglisse en forme de petites boules colorées'),
(3, 'Haribo Chamallows', 'Guimauve', 3.00, 'chamallows.png', 'Guimauves Haribo moelleuses'),
(4, 'Haribo Croco', 'Gélifié', 1.80, 'croco.png', 'Bonbon gélifié Haribo en forme de crocodile'),
(5, 'Haribo Dragibus', 'Fruité', 2.30, 'dragibus.png', 'Bonbons Haribo Dragibus, assortiment de couleurs et de saveurs fruitées'),
(6, 'Haribo Schtroumpfs', 'Gélifié', 1.90, 'schtroumpfs.png', 'Bonbons gélifiés Haribo en forme de Schtroumpfs'),
(7, 'Haribo Rotella', 'Réglisse', 2.20, 'rotella.png', 'Bonbons Haribo à la réglisse en forme de rouleau'),
(8, 'Haribo Maoam', 'Fruité', 2.70, 'maoam.png', 'Bonbons mâche Haribo Maoam, saveurs fruitées assorties'),
(9, 'Haribo Happy Cola', 'Gélifié', 1.95, '', 'Bonbons Haribo en forme de bouteille de cola'),
(10, 'Haribo Miami Pik', 'Acide', 2.50, '', 'Bonbons Haribo acidulés, forme de bâtonnets'),
(11, 'Haribo Goldbears', 'Gélifié', 2.40, '', 'Bonbons Haribo en forme de petits ours, saveurs fruitées'),
(12, 'Haribo Balla Balla', 'Fruité', 2.60, '', 'Bonbons longs et fruités Haribo Balla Balla'),
(13, 'Haribo Smurfs', 'Gélifié', 2.50, '', 'Bonbons Haribo en forme de Schtroumpfs, goût fruité'),
(14, 'Haribo Color-Rado', 'Assortiment', 3.00, '', 'Assortiment de bonbons Haribo'),
(15, 'Haribo Peaches', 'Fruité', 2.20, '', 'Bonbons gélifiés Haribo goût pêche'),
(16, 'Haribo Pico-Balla', 'Fruité', 2.30, '', 'Bonbons gélifiés Haribo, saveurs fruitées'),
(17, 'Haribo Saure Pommes', 'Acide', 2.40, '', 'Bonbons Haribo acidulés, goût pomme'),
(18, 'Haribo Worms', 'Gélifié', 2.10, '', 'Bonbons Haribo en forme de vers, saveurs fruitées'),
(19, 'Haribo Starmix', 'Assortiment', 2.80, '', 'Assortiment de bonbons Haribo, formes variées'),
(20, 'Haribo Twin Cherries', 'Fruité', 2.25, '', 'Bonbons gélifiés Haribo en forme de cerises jumelles'),
(21, 'Haribo Tropifrutti', 'Fruité', 2.50, '', 'Bonbons gélifiés Haribo saveurs tropicales'),
(22, 'Haribo Jelly Babies', 'Gélifié', 2.30, '', 'Bonbons gélifiés Haribo en forme de bébés'),
(23, 'Haribo Berry Mix', 'Fruité', 2.70, '', 'Assortiment de bonbons Haribo goût fruits rouges'),
(24, 'Haribo Fantasia', 'Assortiment', 2.90, '', 'Assortiment de bonbons Haribo en différentes formes et saveurs'),
(25, 'Haribo Giant Strawbs', 'Fruité', 2.60, '', 'Bonbons gélifiés Haribo en forme de fraise géante');

INSERT INTO stocks(quantite, date_de_modification, boutique_id, confiserie_id) VALUES
(24, NOW(), 1, 1),
(54, NOW(), 1, 4),
(17, NOW(), 2, 6),
(120, NOW(), 2, 7),
(8, NOW(), 2, 10);
