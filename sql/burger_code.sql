CREATE DATABASE burger_code;
USE burger_code;

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
);

INSERT INTO `category` VALUES(1, 'Menus');
INSERT INTO `category` VALUES(2, 'Burgers');
INSERT INTO `category` VALUES(3, 'Snacks');
INSERT INTO `category` VALUES(4, 'Salades');
INSERT INTO `category` VALUES(5, 'Boissons');
INSERT INTO `category` VALUES(6, 'Desserts');

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `prix` float NOT NULL,
  `picture` varchar(256) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
);

INSERT INTO `menu` VALUES(1, 'Menu Classic', 'Sandwich: Burger,  Salade, Tomate,  Cornichon + Frites + Boisson', 8.9, 'm1.png', 1);
INSERT INTO `menu` VALUES(2, 'Menu Bacon', 'Sandwich: Burger, Fromage, Bacon, Salade,  Tomate + Frites + Boisson', 9.5, 'm2.png', 1);
INSERT INTO `menu` VALUES(3, 'Menu Big', 'Sandwich: Double Burger, Fromage, Cornichon,  Salade + Frites + Boisson', 10.9, 'm3.png', 1);
INSERT INTO `menu` VALUES(4, 'Menu Chicken', 'Sandwich: Poulet Frit, Tomate,  Salade,  Mayonnaise + Frites + Boisson', 9.9, 'm4.png', 1);
INSERT INTO `menu` VALUES(5, 'Menu Fish', 'Sandwich: Poisson,  Salade,  Mayonnaise,  Cornichon + Frites + Boisson', 10.9, 'm5.png', 1);
INSERT INTO `menu` VALUES(6, 'Menu Double Steak', 'Sandwich: Double Burger, Fromage, Bacon, Salade, Tomate + Frites + Boisson', 11.9, 'm6.png', 1);
INSERT INTO `menu` VALUES(7, 'Classic', 'Sandwich: Burger,  Salade, Tomate,  Cornichon', 5.9, 'b1.png', 2);
INSERT INTO `menu` VALUES(8, 'Bacon', 'Sandwich: Burger,  Fromage, Bacon  Salade  Tomate', 6.5, 'b2.png', 2);
INSERT INTO `menu` VALUES(9, 'Big', 'Sandwich: Double Burger, Fromage,  Cornichon  Salade', 6.9, 'b3.png', 2);
INSERT INTO `menu` VALUES(10, 'Chicken', 'Sandwich: Poulet Frit,  Tomate, Salade, Mayonnaise', 5.9, 'b4.png', 2);
INSERT INTO `menu` VALUES(11, 'Fish', 'Sandwich: Poisson Pané,  Salade  Mayonnaise  Cornichon', 6.5, 'b5.png', 2);
INSERT INTO `menu` VALUES(12, 'Double Steak', 'Sandwich: Double Burger,  Fromage  Bacon  Salade  Tomate', 7.5, 'b6.png', 2);
INSERT INTO `menu` VALUES(13, 'Frites', 'Pommes de terre frites', 3.9, 's1.png', 3);
INSERT INTO `menu` VALUES(14, 'Onion Rings', 'Rondelles doignon frits', 3.4, 's2.png', 3);
INSERT INTO `menu` VALUES(15, 'Nuggets', 'Nuggets de poulet frits', 5.9, 's3.png', 3);
INSERT INTO `menu` VALUES(16, 'Nuggets Fromage', 'Nuggets de fromage frits', 3.5, 's4.png', 3);
INSERT INTO `menu` VALUES(17, 'Ailes de Poulet', 'Ailes de poulet Barbecue', 5.9, 's5.png', 3);
INSERT INTO `menu` VALUES(18, 'César Poulet Pané', 'Poulet Pané, Salade, Tomate et la fameuse sauce César', 8.9, 'sa1.png', 4);
INSERT INTO `menu` VALUES(19, 'César Poulet Grillé', 'Poulet Grillé, Salade, Tomate et la fameuse sauce César', 8.9, 'sa2.png', 4);
INSERT INTO `menu` VALUES(20, 'Salade Light', 'Salade, Tomate, Concombre,Maïs et Vinaigre balsamique', 5.9, 'sa3.png', 4);
INSERT INTO `menu` VALUES(21, 'Poulet Pané', 'Poulet Pané, Salade, Tomate et la sauce de votre choix', 7.9, 'sa4.png', 4);
INSERT INTO `menu` VALUES(22, 'Poulet Grillé', 'Poulet Grillé, Salade, Tomate et la sauce de votre choix', 7.9, 'sa5.png', 4);
INSERT INTO `menu` VALUES(23, 'Coca-Cola', 'Au choix: Petit,  Moyen ou Grand', 1.9, 'bo1.png', 5);
INSERT INTO `menu` VALUES(24, 'Coca-Cola Light', 'Au choix: Petit,  Moyen ou Grand', 1.9, 'bo2.png', 5);
INSERT INTO `menu` VALUES(25, 'Coca-Cola Zéro', 'Au choix: Petit,  Moyen ou Grand', 1.9, 'bo3.png', 5);
INSERT INTO `menu` VALUES(26, 'Fanta', 'Au choix: Petit,  Moyen ou Grand', 1.9, 'bo4.png', 5);
INSERT INTO `menu` VALUES(27, 'Sprite', 'Au choix: Petit,  Moyen ou Grand', 1.9, 'bo5.png', 5);
INSERT INTO `menu` VALUES(28, 'Nestea', 'Au choix: Petit,  Moyen ou Grand', 1.9, 'bo6.png', 5);
INSERT INTO `menu` VALUES(29, 'Fondant au chocolat', 'Au choix: Chocolat Blanc ou au lait', 4.9, 'd1.png', 6);
INSERT INTO `menu` VALUES(30, 'Muffin', 'Au choix: Au fruits ou au chocolat', 2.9, 'd2.png', 6);
INSERT INTO `menu` VALUES(31, 'Beignet', 'Au choix: Au chocolat ou à la vanille', 2.9, 'd3.png', 6);
INSERT INTO `menu` VALUES(32, 'Milkshake', 'Au choix: Fraise, Vanille ou Chocolat', 3.9, 'd4.png', 6);
INSERT INTO `menu` VALUES(33, 'Sundae', 'Au choix: Fraise, Caramel ou Chocolat', 4.9, 'd5.png', 6);

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(1024) NOT NULL,
  `token` varchar(1024) NOT NULL,
  `admin` boolean NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
);

INSERT INTO `user` VALUES(1, 'admin', '269f8d5a75a1dec7ec5db4ebbff2d09a372483a56481085cc2d259773e2555c5719ad099529d19371451a55fc32e107daf3b76687c4ce940d9230a352db84b2c', '', true);
