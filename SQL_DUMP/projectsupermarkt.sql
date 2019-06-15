-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 15 jun 2019 om 09:25
-- Serverversie: 10.1.37-MariaDB
-- PHP-versie: 7.2.12

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
('product 3', 6, '13.50', 'chocola.jpg', 'Product 2 omschrijving', 'L', '3'),
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
  `product_name` varchar(255) NOT NULL,
  `quantity` int(10) NOT NULL,
  `product_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
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
  `email` varchar(181) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`name`, `pass`, `isAdmin`, `honorifics`, `surname`, `address`, `house number`, `postcode`, `land`, `state`, `mobile number`, `first_name`, `email`) VALUES
('admin123', '$2y$10$F27zTDF5n.aPs4s9MOnv..jxYNUaPeSKHhp3FA1T5qXM6m99Z2EvW', 1, 'Mr', 'Admin', 'admin', '666', '6666 AD', 'Admin', 'Admin', 642839394, 'Admin', 'admin@mail.com'),
('adminpass', '$2y$10$EvNg99cvboWoye.e9kDvE.nW8sDZ7lAsKETqlL0pRwnP95/cS/DE2', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('user', '$2y$10$uLt49W/LFxyAKLyO.AftXe3ER6.H6lXQafVkASKnmUkfmGFslSfe2', 0, 'Mr', 'Orlowski', 'Jonckbloetplein 32', '69', '2523AS', 'Netherland', 'Hague', 31232134, 'Patryk', 'mijnemail@gmail.com'),
('username301', '$2y$10$BOWGV9bGWHJHq4pDs.IX7.zea.FEjPpKZjxO.aZrquTNh4VBD5riW', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('userthatisfalse', '$2y$10$YzAgBftJcOFMr/cWTk84EekOUAqFOVvvN89jnV/Ub4miOgw0/4aJ2', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('user_name', '$2y$10$tz06MGSw1KFqy1bZLoSymuE1395QZNp5b8ObWRvwkiVrSpxbIxAQ6', 0, 'Mr', 'Orlowski', 'Jonckbloetplein', '32', '2523AS', 'England', 'DEN HAAG', 649981444, 'Patryk', 'orel971111@gmail.com');

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
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`name`);

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
