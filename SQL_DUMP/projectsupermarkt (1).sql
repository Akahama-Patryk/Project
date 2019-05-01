-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 01 mei 2019 om 12:50
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
(1, 'Netherland'),
(2, 'England'),
(3, 'France');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `product`
--

CREATE TABLE `product` (
  `name` varchar(181) NOT NULL,
  `quantity` int(225) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(181) NOT NULL,
  `description` varchar(181) DEFAULT NULL,
  `category_id` varchar(1) DEFAULT NULL,
  `id_product` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `product`
--

INSERT INTO `product` (`name`, `quantity`, `price`, `image`, `description`, `category_id`, `id_product`) VALUES
('Pepsi', 30, '2.05', 'img/cola.jpg', 'Pepsi 2L cola.', 'F', 1),
('Coca Cola', 12, '0.25', 'img/cola2.jpg', 'Coca Cola 2L cola', 'F', 2),
('product 3', 6, '13.50', 'img/chocola.jpg', 'Product 2 omschrijving', 'L', 3),
('product 4', 160, '0.60', 'img/chips.jpg', 'Product 2 omschrijving', 'L', 4),
('product 5', 74, '1.50', 'img/ijs.png', 'Product 2 omschrijving', 'L', 5),
('product 6', 500, '5.00', 'img/vlees.jpg', 'Product 2 omschrijving', 'B', 6),
('Red Apple', 65, '0.25', 'img/appel.jpg', 'Red apple', 'A', 7);

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
('user', '$2y$10$uLt49W/LFxyAKLyO.AftXe3ER6.H6lXQafVkASKnmUkfmGFslSfe2', 0, 'Mr', 'Orlowski', 'Jonckbloetplein 32', '69', '2523AS', 'Netherland', 'Hague', 31232134, 'Patryk', 'mijnemail@gmail.com');

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
