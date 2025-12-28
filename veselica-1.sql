CREATE TABLE `kategorija` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
);
INSERT INTO `kategorija` (`id`, `naziv`)
VALUES (1, 'Hrana'),
  (2, 'Pijača');
CREATE TABLE `artikel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) NOT NULL,
  `kategorija` int(11) NOT NULL,
  `barva` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (kategorija) REFERENCES kategorija (id) ON DELETE CASCADE ON UPDATE CASCADE
);
INSERT INTO `artikel` (`id`, `naziv`, `kategorija`, `barva`)
VALUES (1, 'Laško 0,5l', 2, 'is-danger'),
  (2, 'Laško 0,3l', 2, 'is-danger'),
  (3, 'Hot Dog', 1, 'is-primary'),
  (7, 'Union 0,5l', 2, 'is-danger'),
  (8, 'Radler 0,5l', 2, 'is-danger'),
  (9, 'Ledeni čaj 0,33l', 2, 'is-success'),
  (10, 'Multi Sola 0,33l', 2, 'is-success'),
  (11, 'Coca-cola 0,33l', 2, 'is-success'),
  (12, 'Fanta 0,33l', 2, 'is-success'),
  (13, 'Radenska 0,5l', 2, 'is-success'),
  (14, 'Voda 0,5l', 2, 'is-success'),
  (15, 'Radenska 1,5l', 2, 'is-success'),
  (16, 'Fanta 1,5l', 2, 'is-success'),
  (17, 'Belo vino 0,2l', 2, 'is-info'),
  (18, 'Rdeče vino 0,2l', 2, 'is-info'),
  (19, 'Cviček 0,2l', 2, 'is-info'),
  (20, 'Špricar 0,2l', 2, 'is-info'),
  (21, 'Bambus 0,2l', 2, 'is-info'),
  (22, 'Sadjevec 0,05l', 2, 'is-warning'),
  (23, 'Borovničevec 0,05l', 2, 'is-warning'),
  (24, 'Smrekovec 0,05l', 2, 'is-warning'),
  (25, 'Jagermaister 0,05l', 2, 'is-warning'),
  (26, 'Stock 0,05l', 2, 'is-warning'),
  (28, 'Jeger-cola 0,15l', 2, 'is-warning'),
  (29, 'Stock-cola 0,15l', 2, 'is-warning'),
  (30, 'Čevapčiči 8 kom', 1, 'is-primary'),
  (31, 'Čevapčiči 5 kom', 1, 'is-primary'),
  (32, 'Klobasa cela', 1, 'is-primary'),
  (33, 'Klobasa 1/2', 1, 'is-primary'),
  (34, 'Čevapčiči 5 kom KUPON', 1, 'is-warning'),
  (35, 'Čevapčiči 8 kom KUPON', 1, 'is-warning'),
  (36, 'Klobasa 1/2 KUPON', 1, 'is-warning'),
  (37, 'Klobasa cela KUPON', 1, 'is-warning'),
  (38, 'Hot Dog KUPON', 1, 'is-warning'),
  (39, 'Plačilo s kartico', 1, 'is-ziga'),
  (40, 'Špricar 0,3l', 2, 'is-info');
CREATE TABLE `dodatek` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) NOT NULL,
  PRIMARY KEY (id)
);
INSERT INTO `dodatek` (`id`, `naziv`)
VALUES (1, 'Kechup'),
  (2, 'Majoneza'),
  (3, 'Gorčica'),
  (4, 'Ajvar'),
  (5, 'Čebula');
CREATE TABLE `artikel_ima_dodatek` (
  `artikel` int(11) NOT NULL,
  `dodatek` int(11) NOT NULL,
  `privzet` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`artikel`, `dodatek`),
  FOREIGN KEY (`artikel`) REFERENCES `artikel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`dodatek`) REFERENCES `dodatek` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
);
INSERT INTO `artikel_ima_dodatek` (`artikel`, `dodatek`, `privzet`)
VALUES (3, 1, 0),
  (3, 2, 0),
  (3, 3, 0),
  (3, 4, 0),
  (38, 1, 0),
  (38, 2, 0),
  (38, 3, 0),
  (38, 4, 0);
CREATE TABLE `miza` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vrsta` char(1) NOT NULL,
  `stolpec` int(11) NOT NULL,
  PRIMARY KEY(`id`)
);
INSERT INTO `miza` (`id`, `vrsta`, `stolpec`)
VALUES (6, 'A', 1),
  (7, 'A', 2),
  (8, 'A', 3),
  (9, 'A', 4),
  (10, 'A', 5),
  (11, 'A', 6),
  (12, 'A', 7),
  (13, 'A', 8),
  (14, 'A', 9),
  (16, 'B', 1),
  (17, 'B', 2),
  (18, 'B', 3),
  (19, 'B', 4),
  (20, 'B', 5),
  (21, 'B', 6),
  (22, 'B', 7),
  (23, 'B', 8),
  (24, 'B', 9),
  (26, 'C', 1),
  (27, 'C', 2),
  (28, 'C', 3),
  (29, 'C', 4),
  (30, 'C', 5),
  (31, 'C', 6),
  (32, 'C', 7),
  (33, 'C', 8),
  (34, 'C', 9),
  (36, 'D', 1),
  (37, 'D', 2),
  (38, 'D', 3),
  (39, 'D', 4),
  (40, 'D', 5),
  (41, 'D', 6),
  (42, 'D', 7),
  (43, 'D', 8),
  (44, 'D', 9),
  (46, 'E', 1),
  (47, 'E', 2),
  (48, 'E', 3),
  (49, 'E', 4),
  (50, 'E', 5),
  (51, 'E', 6),
  (52, 'E', 7),
  (53, 'E', 8),
  (54, 'E', 9),
  (56, 'F', 1),
  (57, 'F', 2),
  (58, 'F', 3),
  (59, 'F', 4),
  (60, 'F', 5),
  (61, 'F', 6),
  (62, 'F', 7),
  (63, 'F', 8),
  (64, 'F', 9),
  (66, 'G', 1),
  (67, 'G', 2),
  (68, 'G', 3),
  (69, 'G', 4),
  (70, 'G', 5),
  (71, 'G', 6),
  (72, 'G', 7),
  (73, 'G', 8),
  (74, 'G', 9),
  (76, 'H', 1),
  (77, 'H', 2),
  (78, 'H', 3),
  (79, 'H', 4),
  (80, 'H', 5),
  (81, 'H', 6),
  (82, 'H', 7),
  (83, 'H', 8),
  (84, 'H', 9),
  (85, 'I', 1),
  (86, 'I', 2),
  (87, 'I', 3),
  (88, 'I', 4),
  (89, 'I', 5),
  (90, 'I', 6),
  (91, 'I', 7),
  (92, 'I', 8),
  (93, 'I', 9),
  (94, 'J', 1),
  (95, 'J', 2),
  (96, 'J', 3),
  (97, 'J', 4),
  (98, 'J', 5),
  (99, 'J', 6),
  (100, 'J', 7),
  (101, 'J', 8),
  (102, 'J', 9),
  (103, 'M', 1),
  (104, 'M', 2),
  (105, 'M', 3),
  (106, 'M', 4);
CREATE TABLE `uporabnik` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ime` varchar(45) NOT NULL,
  `user` varchar(45) NOT NULL,
  `pass` varchar(45) NOT NULL,
  `admin` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
);
INSERT INTO `uporabnik` (`id`, `ime`, `user`, `pass`, `admin`)
VALUES (1, 'Administrator', 'admin', 'admin', 1);
CREATE TABLE `narocilo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `miza` int(11) NOT NULL,
  `uporabnik` int(11) NOT NULL,
  `cas` timestamp NULL DEFAULT NULL,
  `kuhinja` tinyint(4) NOT NULL DEFAULT 0,
  `pokazi` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`miza`) REFERENCES `miza` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`uporabnik`) REFERENCES `uporabnik` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE `pozicija` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kolicina` int(11) NOT NULL DEFAULT 1,
  `narocilo` int(11) NOT NULL,
  `artikel` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`narocilo`) REFERENCES `narocilo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`artikel`) REFERENCES `artikel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TRIGGER `kopiraj_privzete`
AFTER
INSERT ON `pozicija` FOR EACH ROW
INSERT INTO pozicija_ima_dodatek (pozicija, dodatek)
SELECT new.id,
  dodatek
FROM artikel_ima_dodatek aid
WHERE aid.artikel = new.artikel
  AND aid.privzet = 1;
-- --------------------------------------------------------
--
-- Struktura tabele `pozicija_ima_dodatek`
--

CREATE TABLE `pozicija_ima_dodatek` (
  `pozicija` int(11) NOT NULL,
  `dodatek` int(11) NOT NULL,
  PRIMARY KEY (`pozicija`, `dodatek`),
  FOREIGN KEY (`pozicija`) REFERENCES `pozicija` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`dodatek`) REFERENCES `dodatek` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
);