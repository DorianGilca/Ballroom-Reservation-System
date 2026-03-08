-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2026 at 03:30 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ballroomdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `client_id` int(11) NOT NULL,
  `nume` varchar(50) NOT NULL,
  `prenume` varchar(50) NOT NULL,
  `telefon` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `parola` varchar(50) DEFAULT NULL,
  `adresa` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`client_id`, `nume`, `prenume`, `telefon`, `email`, `parola`, `adresa`) VALUES
(1, 'Admin', 'User', '0700000000', 'admin@test.com', '1234', 'Bucuresti'),
(2, 'Ionescu', 'Maria', '0722333444', 'maria@test.com', '1234', 'Cluj'),
(3, 'Georgescu', 'Vlad', '0722555666', 'vlad@test.com', '1234', 'Iasi'),
(4, 'Dumitru', 'Ana', '0722777888', 'ana@test.com', '1234', 'Brasov'),
(5, 'Popa', 'Andrei', '0722999000', 'andrei@test.com', '1234', 'Timisoara'),
(6, 'Stanescu', 'Mihai', '0722111000', 'mihai@test.com', '1234', 'Sibiu'),
(7, 'Popescu', 'Ion', '0799888777', 'ion.popescu@test.com', 'pass123', 'Bucuresti'),
(8, 'Popescu', 'Ion', '0799888777', 'ion.popescu@test.com', 'pass123', 'Bucuresti'),
(9, 'Popescu', 'Ion', '0799888777', 'ion.popescu@test.com', 'pass123', 'Bucuresti'),
(10, 'Popescu', 'Ion', '0799888777', 'ion.popescu@test.com', 'pass123', 'Bucuresti'),
(11, 'Popescu', 'Ion', '0799888777', 'ion.popescu@test.com', 'pass123', 'Bucuresti'),
(12, 'Popescu', 'Ion', '0799888777', 'ion.popescu@test.com', 'pass123', 'Bucuresti'),
(13, 'Popescu', 'Ion', '0799888777', 'ion.popescu@test.com', 'pass123', 'Bucuresti'),
(14, 'Popescu', 'Ion', '0799888777', 'ion.popescu@test.com', 'pass123', 'Bucuresti'),
(15, 'Popescu', 'Ion', '0799888777', 'ion.popescu@test.com', 'pass123', 'Bucuresti'),
(16, 'Popescu', 'Ion', '0799888777', 'ion.popescu@test.com', 'pass123', 'Bucuresti'),
(17, 'Popescu', 'Ion', '0799888777', 'ion.popescu@test.com', 'pass123', 'Bucuresti'),
(18, 'Popescu', 'Ion', '0799888777', 'ion.popescu@test.com', 'pass123', 'Bucuresti'),
(19, 'Popescu', 'Ion', '0799888777', 'ion.popescu@test.com', 'pass123', 'Bucuresti'),
(20, 'Popescu', 'Ion', '0799888777', 'ion.popescu@test.com', 'pass123', 'Bucuresti'),
(21, 'Popescu', 'Ion', '0799888777', 'ion.popescu@test.com', 'pass123', 'Bucuresti'),
(22, 'Popescu', 'Ion', '0799888777', 'ion.popescu@test.com', 'pass123', 'Bucuresti'),
(23, '', '', '', 'doriangdg1234@gmail.com', 'doriangilca', ''),
(24, 'dorian', 'rex', '074132131444', 'rexvinoinapoi@gmail.com', 'dorianxdx', 'osica'),
(25, 'dorian', 'xdx', '0734546782', 'dorian@gmail.com', '123455', 'bucinisu');

-- --------------------------------------------------------

--
-- Table structure for table `eveniment`
--

CREATE TABLE `eveniment` (
  `eveniment_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `sala_id` int(11) DEFAULT NULL,
  `meniu_id` int(11) DEFAULT NULL,
  `tip_eveniment` varchar(50) DEFAULT NULL,
  `data_eveniment` date DEFAULT NULL,
  `numar_persoane` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eveniment`
--

INSERT INTO `eveniment` (`eveniment_id`, `client_id`, `sala_id`, `meniu_id`, `tip_eveniment`, `data_eveniment`, `numar_persoane`, `status`) VALUES
(2, 2, 2, 2, 'Botez', '2024-07-20', 100, 'Confirmat'),
(3, 3, 3, 1, 'Majorat', '2024-08-05', 250, 'Confirmat'),
(4, 4, 1, 3, 'Conferinta', '2024-09-10', 150, 'Confirmat'),
(5, 5, 2, 2, 'Petrecere firma', '2024-10-01', 110, 'Anulat'),
(7, 1, 2, 1, 'Cununie', '2024-12-25', 50, 'In asteptare'),
(8, 1, 2, 1, 'Cununie', '2024-12-25', 50, 'In asteptare'),
(9, 1, 2, 1, 'Cununie', '2024-12-25', 50, 'In asteptare'),
(10, 1, 2, 1, 'Cununie', '2024-12-25', 50, 'In asteptare'),
(11, 1, 2, 1, 'Cununie', '2024-12-25', 50, 'In asteptare'),
(12, 1, 2, 1, 'Cununie', '2024-12-25', 50, 'In asteptare'),
(13, 1, 2, 1, 'Cununie', '2024-12-25', 50, 'In asteptare'),
(14, 1, 2, 1, 'Cununie', '2024-12-25', 50, 'In asteptare'),
(15, 1, 2, 1, 'Cununie', '2024-12-25', 50, 'In asteptare'),
(16, 1, 2, 1, 'Cununie', '2024-12-25', 50, 'In asteptare'),
(17, 1, 2, 1, 'Cununie', '2024-12-25', 50, 'In asteptare'),
(18, 1, 2, 1, 'Cununie', '2024-12-25', 50, 'In asteptare'),
(19, 1, 2, 1, 'Cununie', '2024-12-25', 50, 'In asteptare'),
(20, 1, 2, 1, 'Cununie', '2024-12-25', 50, 'In asteptare'),
(21, 1, 2, 1, 'Cununie', '2024-12-25', 50, 'In asteptare'),
(22, 1, 2, 1, 'Cununie', '2024-12-25', 50, 'In asteptare'),
(23, 1, 2, 3, 'Nunta', '2027-11-02', 40, 'In Asteptare'),
(24, 23, 3, 4, 'Botez', '2031-11-11', 111, 'In Asteptare'),
(27, 24, 1, 1, 'Nunta', '2006-11-12', 670, 'In Asteptare'),
(30, 24, 1, 2, 'Botez', '2003-11-09', 100, 'In Asteptare'),
(31, 25, 5, 3, 'Gala', '2995-11-09', 200, 'In Asteptare'),
(32, 25, 2, 2, 'Botez', '2027-04-05', 70, 'In Asteptare');

-- --------------------------------------------------------

--
-- Table structure for table `meniu`
--

CREATE TABLE `meniu` (
  `meniu_id` int(11) NOT NULL,
  `denumire` varchar(100) DEFAULT NULL,
  `pret_persoana` decimal(10,2) DEFAULT NULL,
  `descriere` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meniu`
--

INSERT INTO `meniu` (`meniu_id`, `denumire`, `pret_persoana`, `descriere`) VALUES
(1, 'Meniu Clasic', 150.00, 'Aperitiv, fel principal, tort'),
(2, 'Meniu Premium', 250.00, 'All inclusive, open bar'),
(3, 'Meniu Clasic', 150.00, 'Aperitiv, fel principal, tort'),
(4, 'Meniu Premium', 250.00, 'All inclusive, open bar'),
(5, 'Meniu Vegetarian', 140.00, 'Preparate fara carne'),
(6, 'Meniu Botez', 180.00, 'Special pentru botez'),
(7, 'Meniu Corporate', 200.00, 'Buffet suedez'),
(8, 'Meniu VIP', 400.00, 'Fructe de mare si sampanie');

-- --------------------------------------------------------

--
-- Table structure for table `personal`
--

CREATE TABLE `personal` (
  `personal_id` int(11) NOT NULL,
  `nume` varchar(50) DEFAULT NULL,
  `prenume` varchar(50) DEFAULT NULL,
  `functie` varchar(50) DEFAULT NULL,
  `telefon` varchar(20) DEFAULT NULL,
  `salariu` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personal`
--

INSERT INTO `personal` (`personal_id`, `nume`, `prenume`, `functie`, `telefon`, `salariu`) VALUES
(1, 'Radu', 'Ionut', 'Manager', '0711111222', 5500.00),
(2, 'Matei', 'Alina', 'Bucatar', '0711333444', 4500.00),
(3, 'Dobre', 'Cristian', 'Ospatar', '0711555666', 3000.00),
(4, 'Lupu', 'Diana', 'Barman', '0711777888', 3200.00),
(5, 'Serban', 'Victor', 'DJ', '0711999000', 3500.00),
(6, 'Mocanu', 'Elena', 'Hostess', '0711222333', 2800.00);

-- --------------------------------------------------------

--
-- Table structure for table `personal_eveniment`
--

CREATE TABLE `personal_eveniment` (
  `id` int(11) NOT NULL,
  `eveniment_id` int(11) DEFAULT NULL,
  `personal_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personal_eveniment`
--

INSERT INTO `personal_eveniment` (`id`, `eveniment_id`, `personal_id`) VALUES
(1, 1, 1),
(2, 1, 3),
(3, 2, 2),
(4, 3, 5),
(5, 4, 1),
(6, 5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `plata`
--

CREATE TABLE `plata` (
  `plata_id` int(11) NOT NULL,
  `eveniment_id` int(11) DEFAULT NULL,
  `data_plata` date DEFAULT NULL,
  `suma` decimal(10,2) DEFAULT NULL,
  `metoda_plata` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plata`
--

INSERT INTO `plata` (`plata_id`, `eveniment_id`, `data_plata`, `suma`, `metoda_plata`) VALUES
(2, 2, '2024-07-01', 3000.00, 'Cash'),
(3, 3, '2024-07-15', 1000.00, 'Transfer'),
(4, 4, '2024-09-01', 4000.00, 'Card'),
(5, 5, '2024-09-20', 500.00, 'Cash');

-- --------------------------------------------------------

--
-- Table structure for table `sala`
--

CREATE TABLE `sala` (
  `sala_id` int(11) NOT NULL,
  `denumire` varchar(100) DEFAULT NULL,
  `capacitate` int(11) DEFAULT NULL,
  `pret_inchiriere` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sala`
--

INSERT INTO `sala` (`sala_id`, `denumire`, `capacitate`, `pret_inchiriere`) VALUES
(1, 'Salonul Gold', 200, 5000.00),
(2, 'Salonul Silver', 120, 3000.00),
(3, 'Salonul Cristal', 300, 7500.00),
(4, 'Salonul Diamant', 400, 9000.00),
(5, 'Salonul Intim', 80, 2000.00),
(6, 'Salonul Garden', 250, 4500.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `eveniment`
--
ALTER TABLE `eveniment`
  ADD PRIMARY KEY (`eveniment_id`);

--
-- Indexes for table `meniu`
--
ALTER TABLE `meniu`
  ADD PRIMARY KEY (`meniu_id`);

--
-- Indexes for table `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`personal_id`);

--
-- Indexes for table `personal_eveniment`
--
ALTER TABLE `personal_eveniment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plata`
--
ALTER TABLE `plata`
  ADD PRIMARY KEY (`plata_id`);

--
-- Indexes for table `sala`
--
ALTER TABLE `sala`
  ADD PRIMARY KEY (`sala_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `eveniment`
--
ALTER TABLE `eveniment`
  MODIFY `eveniment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `meniu`
--
ALTER TABLE `meniu`
  MODIFY `meniu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal`
--
ALTER TABLE `personal`
  MODIFY `personal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_eveniment`
--
ALTER TABLE `personal_eveniment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `plata`
--
ALTER TABLE `plata`
  MODIFY `plata_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sala`
--
ALTER TABLE `sala`
  MODIFY `sala_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
