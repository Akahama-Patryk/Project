-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 16 jun 2019 om 22:19
-- Serverversie: 10.1.38-MariaDB
-- PHP-versie: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectsupermarkt`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `category`
--

CREATE TABLE `category` (
  `category_id` varchar(1) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
('D', 'Bakkerij'),
('O', 'Bewuste voeding'),
('I', 'Bier, sterke drank, apertieven'),
('M', 'Diepvries'),
('N', 'Drogisterij, baby'),
('F', 'Frisdranken,koffie,thee,sappen'),
('A', 'Groenten, fruit'),
('P', 'Huishouden, huisdieren'),
('Q', 'Koken, tafelen, non-food'),
('G', 'Ontbijtgranen, broodbeleg, tussendoor'),
('J', 'Pasta, rijst, internationale keuken'),
('L', 'Snoep, koek, chips'),
('K', 'Soepen, conserven, sauzen, smaakmakers'),
('E', 'Verse kant-en-klaar maaltijden, salades'),
('B', 'Vlees, kip, vis'),
('H', 'Wijn'),
('X', 'Xenio'),
('C', 'Zuivel, eieren');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `coupon_code`
--

CREATE TABLE `coupon_code` (
  `expire_date` date NOT NULL,
  `coupon_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `coupon_code`
--

INSERT INTO `coupon_code` (`expire_date`, `coupon_code`) VALUES
('2019-06-15', '123testing'),
('2019-06-17', 'testing123');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `land`
--

CREATE TABLE `land` (
  `id` int(20) NOT NULL,
  `land_name` varchar(181) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `land`
--

INSERT INTO `land` (`id`, `land_name`) VALUES
(6, 'Afghanistan'),
(7, 'Albania'),
(8, 'Algeria'),
(9, 'Andorra'),
(10, 'Angola'),
(11, 'Antigua and Barbuda'),
(12, 'Argentina'),
(13, 'Armenia'),
(14, 'Australia'),
(15, 'Austria'),
(16, 'Azerbaijan'),
(17, 'Bahamas'),
(18, 'Bahrain'),
(19, 'Bangladesh'),
(20, 'Barbados'),
(21, 'Belarus'),
(22, 'Belgium'),
(23, 'Belize'),
(24, 'Benin'),
(25, 'Bhutan'),
(26, 'Bolivia'),
(27, 'Bosnia and Herzegovina'),
(28, 'Botswana'),
(29, 'Brunei'),
(30, 'Burkina'),
(31, 'Faso'),
(32, 'Burundi'),
(33, 'Cote d Ivoire'),
(34, 'Cabo'),
(35, 'Verde'),
(36, 'Cambodia'),
(37, 'Cameroon'),
(38, 'Canada'),
(39, 'Central African Republic'),
(42, 'Chad'),
(43, 'Chile'),
(44, 'China'),
(45, 'Colombia'),
(46, 'Comoros'),
(47, 'Congo'),
(48, 'Costa Rica'),
(50, 'Croatia'),
(51, 'Cuba'),
(52, 'Cyprus'),
(53, 'Czech Republic'),
(55, 'Democratic Republic of the Congo'),
(60, 'Denmark'),
(61, 'Djibouti'),
(62, 'Dominica'),
(63, 'Dominican Republic'),
(65, 'Ecuador'),
(66, 'Egypt'),
(67, 'El Salvador'),
(69, 'Equatorial'),
(70, 'Guinea'),
(71, 'Eritrea'),
(72, 'Estonia'),
(73, 'Ethiopia'),
(74, 'Fiji'),
(75, 'Finland'),
(76, 'France'),
(77, 'Gabon'),
(78, 'Gambia'),
(79, 'Georgia'),
(80, 'Germany'),
(81, 'Ghana'),
(82, 'Greece'),
(83, 'Grenada'),
(84, 'Guatemala'),
(85, 'Guinea'),
(86, 'Guinea-Bissau'),
(87, 'Guyana'),
(88, 'Haiti'),
(89, 'Holy See'),
(90, 'Honduras'),
(91, 'Hungary'),
(92, 'Iceland'),
(93, 'India'),
(94, 'Indonesia'),
(95, 'Iran'),
(96, 'Iraq'),
(97, 'Ireland'),
(98, 'Israel'),
(99, 'Italy'),
(100, 'Jamaica'),
(101, 'Japan'),
(102, 'Jordan'),
(103, 'Kazakhstan'),
(104, 'Kenya'),
(105, 'Kiribati'),
(106, 'Kuwait'),
(107, 'Kyrgyzstan'),
(108, 'Laos'),
(109, 'Latvia'),
(110, 'Lebanon'),
(111, 'Lesotho'),
(112, 'Liberia'),
(113, 'Libya'),
(114, 'Liechtenstein'),
(115, 'Lithuania'),
(116, 'Luxembourg'),
(117, 'Macedonia'),
(118, 'Madagascar'),
(119, 'Malawi'),
(120, 'Malaysia'),
(121, 'Maldives'),
(122, 'Mali'),
(123, 'Malta'),
(124, 'Marshall'),
(125, 'Islands'),
(126, 'Mauritania'),
(127, 'Mauritius'),
(128, 'Mexico'),
(129, 'Micronesia'),
(130, 'Moldova'),
(131, 'Monaco'),
(132, 'Mongolia'),
(133, 'Montenegro'),
(134, 'Morocco'),
(135, 'Mozambique'),
(136, 'Myanmar'),
(137, 'Namibia'),
(138, 'Nauru'),
(139, 'Nepal'),
(140, 'Netherlands'),
(141, 'New Zealand'),
(143, 'Nicaragua'),
(144, 'Niger'),
(145, 'Nigeria'),
(146, 'North Korea'),
(148, 'Norway'),
(149, 'Oman'),
(150, 'Pakistan'),
(151, 'Palau'),
(153, 'Palestine State'),
(155, 'Panama'),
(156, 'Papua'),
(157, 'New Guinea'),
(159, 'Paraguay'),
(160, 'Peru'),
(161, 'Philippines'),
(162, 'Poland'),
(163, 'Portugal'),
(164, 'Qatar'),
(165, 'Romania'),
(166, 'Russia'),
(167, 'Rwanda'),
(168, 'Saint'),
(169, 'Kitts and'),
(171, 'Nevis'),
(172, 'Saint Lucia'),
(173, 'Saint'),
(174, 'Vincent and the'),
(177, 'Grenadines'),
(178, 'Samoa'),
(179, 'San'),
(180, 'Marino'),
(181, 'Sao'),
(182, 'Tome and'),
(184, 'Principe'),
(185, 'Saudi'),
(186, 'Arabia'),
(187, 'Senegal'),
(188, 'Serbia'),
(189, 'Seychelles'),
(190, 'Sierra'),
(191, 'Leone'),
(192, 'Singapore'),
(193, 'Slovakia'),
(194, 'Slovenia'),
(195, 'Solomon Islands'),
(197, 'Somalia'),
(198, 'South'),
(199, 'Africa'),
(200, 'South Korea'),
(201, 'South Sudan'),
(202, 'Spain'),
(203, 'Sri Lanka'),
(204, 'Sudan'),
(205, 'Suriname'),
(206, 'Swaziland'),
(207, 'Sweden'),
(208, 'Switzerland'),
(209, 'Syria'),
(210, 'Tajikistan'),
(211, 'Tanzania'),
(212, 'Thailand'),
(213, 'Timor-Leste'),
(214, 'Togo'),
(215, 'Tonga'),
(216, 'Trinidad and Tobago'),
(217, 'Tunisia'),
(218, 'Turkey'),
(219, 'Turkmenistan'),
(220, 'Tuvalu'),
(221, 'Uganda'),
(222, 'Ukraine'),
(223, 'United Arab Emirates'),
(224, 'United Kingdom'),
(225, 'United States of America'),
(226, 'Uruguay'),
(227, 'Uzbekistan'),
(228, 'Vanuatu'),
(229, 'Venezuela'),
(230, 'Vietnam'),
(231, 'Yemen'),
(232, 'Zambia'),
(233, 'Zimbabwe');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `product`
--

CREATE TABLE `product` (
  `name` varchar(181) NOT NULL,
  `quantity` int(225) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(181) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `category_id` varchar(1) DEFAULT NULL,
  `id_product` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `product`
--

INSERT INTO `product` (`name`, `quantity`, `price`, `image`, `description`, `category_id`, `id_product`) VALUES
('Pepsi', 30, '2.05', 'cola.jpg', 'Pepsi 2L cola.', 'F', '1'),
('Coca Cola', 12, '0.25', 'cola2.jpg', 'Coca Cola 2L cola', 'F', '2'),
('Milk Chocolate', 5000, '1.50', '8bc944dbd052ef51652e70a5104492e3.jpg', 'Milk Chocolate AH', 'L', '3'),
('product 4', 160, '0.60', 'chips.jpg', 'Product 2 omschrijving', 'L', '4'),
('product 5', 74, '1.50', 'ijs.png', 'Product 2 omschrijving', 'L', '5'),
('product 6', 500, '5.00', 'vlees.jpg', 'Product 2 omschrijving', 'B', '6'),
('Iglo Vissticks', 245, '2.69', '4b9aee37478ca97de4d0f6a344469704.jpg', 'Iglo Vissticks zijn vernieuwd. De vertrouwde iglo kwaliteit, maar met een nog krokanter jasje uit de oven. Onweerstaanbaar lekker en voedzaam, lege borden verzekerd.', 'B', '616cddba-7f2a-11e9-b49e-8c1645254d96'),
('Red Apple', 65, '0.25', 'appel.jpg', 'Red apple', 'A', '7');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `shopping_cart`
--

CREATE TABLE `shopping_cart` (
  `cart_id` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `product_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `shop_client_history`
--

CREATE TABLE `shop_client_history` (
  `history_id` varchar(255) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `id_product` varchar(255) NOT NULL,
  `order_quantity` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `shop_client_history`
--

INSERT INTO `shop_client_history` (`history_id`, `order_id`, `user_id`, `id_product`, `order_quantity`) VALUES
('0191f84d-904b-11e9-a096-d8cb8ae722c6', '018d0b9a-904b-11e9-a096-d8cb8ae722c6', '1', '4', 1),
('39412b5f-9038-11e9-a096-d8cb8ae722c6', '39385612-9038-11e9-a096-d8cb8ae722c6', '1', '5', 99999),
('6a4a83d7-9038-11e9-a096-d8cb8ae722c6', '6a40c398-9038-11e9-a096-d8cb8ae722c6', '1', '1', 1),
('7a163331-9051-11e9-a096-d8cb8ae722c6', '7a0c196e-9051-11e9-a096-d8cb8ae722c6', '7', '2', 1),
('90fa4fc2-9049-11e9-a096-d8cb8ae722c6', '90f0629a-9049-11e9-a096-d8cb8ae722c6', '1', '616cddba-7f2a-11e9-b49e-8c1645254d96', 1),
('9105670f-9049-11e9-a096-d8cb8ae722c6', '90f0629a-9049-11e9-a096-d8cb8ae722c6', '1', '7', 3),
('a0776baf-9051-11e9-a096-d8cb8ae722c6', 'a06a91f3-9051-11e9-a096-d8cb8ae722c6', 'a', '7', 1),
('c37c29c9-904a-11e9-a096-d8cb8ae722c6', 'c36f0a71-904a-11e9-a096-d8cb8ae722c6', '1', '7', 1),
('ce2ce6f0-9051-11e9-a096-d8cb8ae722c6', 'ce240003-9051-11e9-a096-d8cb8ae722c6', 'c', '1', 30),
('ce36a691-9051-11e9-a096-d8cb8ae722c6', 'ce240003-9051-11e9-a096-d8cb8ae722c6', 'c', '2', 12),
('ce474c16-9051-11e9-a096-d8cb8ae722c6', 'ce240003-9051-11e9-a096-d8cb8ae722c6', 'c', '4', 160),
('d6586267-9043-11e9-a096-d8cb8ae722c6', 'd6505f51-9043-11e9-a096-d8cb8ae722c6', '1', '616cddba-7f2a-11e9-b49e-8c1645254d96', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `shop_order`
--

CREATE TABLE `shop_order` (
  `order_id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `orderdate` date NOT NULL,
  `type_delivery` tinyint(1) NOT NULL,
  `total_price` decimal(20,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `shop_order`
--

INSERT INTO `shop_order` (`order_id`, `user_id`, `orderdate`, `type_delivery`, `total_price`) VALUES
('018d0b9a-904b-11e9-a096-d8cb8ae722c6', '1', '2019-06-16', 2, '5.38'),
('39385612-9038-11e9-a096-d8cb8ae722c6', '1', '2019-06-16', 2, '181.00'),
('6a40c398-9038-11e9-a096-d8cb8ae722c6', '1', '2019-06-16', 2, '7.13'),
('7a0c196e-9051-11e9-a096-d8cb8ae722c6', '7a03b0b1-9051-11e9-a096-d8cb8ae722c6', '2019-06-16', 2, '4.95'),
('90f0629a-9049-11e9-a096-d8cb8ae722c6', '1', '2019-06-16', 2, '8.81'),
('a06a91f3-9051-11e9-a096-d8cb8ae722c6', 'a05dff2a-9051-11e9-a096-d8cb8ae722c6', '2019-06-16', 1, '4.95'),
('c36f0a71-904a-11e9-a096-d8cb8ae722c6', '1', '2019-06-16', 2, '4.95'),
('ce240003-9051-11e9-a096-d8cb8ae722c6', 'ce1cc657-9051-11e9-a096-d8cb8ae722c6', '2019-06-16', 1, '198.86'),
('d6505f51-9043-11e9-a096-d8cb8ae722c6', '1', '2019-06-16', 2, '7.90');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE `user` (
  `name` varchar(181) NOT NULL,
  `pass` varchar(181) NOT NULL,
  `isAdmin` tinyint(1) DEFAULT NULL,
  `honorifics` varchar(5) DEFAULT NULL,
  `surname` varchar(181) DEFAULT NULL,
  `address` varchar(181) DEFAULT NULL,
  `house number` varchar(10) DEFAULT NULL,
  `postcode` varchar(181) DEFAULT NULL,
  `land` varchar(181) DEFAULT NULL,
  `state` varchar(181) DEFAULT NULL,
  `mobile number` int(10) DEFAULT NULL,
  `first_name` varchar(181) DEFAULT NULL,
  `email` varchar(181) DEFAULT NULL,
  `user_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `user`
--

INSERT INTO `user` (`name`, `pass`, `isAdmin`, `honorifics`, `surname`, `address`, `house number`, `postcode`, `land`, `state`, `mobile number`, `first_name`, `email`, `user_id`) VALUES
('admin123', '$2y$10$7QahgE9WK7z57ZWx3PpVsuPGr4sa8lWUMC7IoaD72PnBDHi.yEAJy', 1, 'Mr', 'Orlowski', 'Jonckbloetplein 32', '32', '2523AS', 'Antigua and Barbuda', 'Netherlands', 649981444, 'Patry', 'orel971111@gmail.com', '1'),
('adminpass', '$2y$10$EvNg99cvboWoye.e9kDvE.nW8sDZ7lAsKETqlL0pRwnP95/cS/DE2', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2'),
('user', '$2y$10$uLt49W/LFxyAKLyO.AftXe3ER6.H6lXQafVkASKnmUkfmGFslSfe2', 0, 'Mr', 'Orlowski', 'Jonckbloetplein 32', '69', '2523AS', 'Netherland', 'Hague', 31232134, 'Patry', 'mijnemail@gmail.com', '3'),
('username301', '$2y$10$BOWGV9bGWHJHq4pDs.IX7.zea.FEjPpKZjxO.aZrquTNh4VBD5riW', 0, 'Mr', 'Orlowski', 'Jonckbloetplein 32', '32', '2523AS', 'Belgium', 'Netherlands', 649981444, 'Patry', 'orel971111@gmail.com', '4'),
('userthatisfalse', '$2y$10$YzAgBftJcOFMr/cWTk84EekOUAqFOVvvN89jnV/Ub4miOgw0/4aJ2', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5'),
('user_name', '$2y$10$tz06MGSw1KFqy1bZLoSymuE1395QZNp5b8ObWRvwkiVrSpxbIxAQ6', 0, 'Mr', 'Orlowski', 'Jonckbloetplein', '32', '2523AS', 'England', 'DEN HAAG', 649981444, 'Patry', 'orel971111@gmail.com', '6'),
('', '', 0, 'Mr', 'Orlowski', 'Jonckbloetplein 32', '32', '2523AS', 'Belgium', 'Netherlands', 649981444, 'Patryk', 'orel971111@gmail.com', 'a05dff2a-9051-11e9-a096-d8cb8ae722c6'),
('', '', 0, 'Mrs', 'Orlowski', 'Jonckbloetplein 32', '32', '2523AS', 'Trinidad and Tobago', 'Netherlands', 649981444, 'Patryk', 'orel971111@gmail.com', 'ce1cc657-9051-11e9-a096-d8cb8ae722c6');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexen voor tabel `coupon_code`
--
ALTER TABLE `coupon_code`
  ADD PRIMARY KEY (`coupon_code`);

--
-- Indexen voor tabel `land`
--
ALTER TABLE `land`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`);

--
-- Indexen voor tabel `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexen voor tabel `shop_client_history`
--
ALTER TABLE `shop_client_history`
  ADD PRIMARY KEY (`history_id`);

--
-- Indexen voor tabel `shop_order`
--
ALTER TABLE `shop_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexen voor tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `land`
--
ALTER TABLE `land`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=234;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
