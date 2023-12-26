-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Des 2023 pada 15.02
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vehicle`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cutomers`
--

CREATE TABLE `cutomers` (
  `id_customers` int(11) NOT NULL,
  `first_name` varchar(128) DEFAULT NULL,
  `last_name` varchar(128) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `mobile` varchar(64) DEFAULT NULL,
  `email` varchar(128) NOT NULL,
  `details` text DEFAULT NULL,
  `insert_ts` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `cutomers`
--

INSERT INTO `cutomers` (`id_customers`, `first_name`, `last_name`, `company_name`, `address`, `mobile`, `email`, `details`, `insert_ts`) VALUES
(222, 'Choirul', 'Anam', 'Intelligo', NULL, '086512345678', 'anam@yahoo.com', 'anam orang madure', '2023-12-20 01:38:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `make`
--

CREATE TABLE `make` (
  `id` int(11) NOT NULL,
  `make_name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `make`
--

INSERT INTO `make` (`id`, `make_name`) VALUES
(1, 'China'),
(2, 'Indonesia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `model`
--

CREATE TABLE `model` (
  `id` int(11) NOT NULL,
  `model_name` varchar(128) NOT NULL,
  `make_id` int(11) NOT NULL,
  `vehicle_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `model`
--

INSERT INTO `model` (`id`, `model_name`, `make_id`, `vehicle_type_id`) VALUES
(0, 'Lamborghini Aventador', 2, 2),
(1, 'SUV', 1, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `vehicle_type`
--

CREATE TABLE `vehicle_type` (
  `Id` int(11) NOT NULL,
  `type_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `vehicle_type`
--

INSERT INTO `vehicle_type` (`Id`, `type_name`) VALUES
(2, 'Micro'),
(3, 'Hatchbacko');

-- --------------------------------------------------------

--
-- Struktur dari tabel `vin`
--

CREATE TABLE `vin` (
  `vehicle_id` int(11) NOT NULL,
  `vin` varchar(225) NOT NULL,
  `license_plate` varchar(64) NOT NULL,
  `customers_id` int(11) NOT NULL,
  `model_id` int(11) NOT NULL,
  `manufactured_year` int(11) NOT NULL,
  `manufactured_month` text DEFAULT NULL,
  `details` text DEFAULT NULL,
  `insert_ts` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cutomers`
--
ALTER TABLE `cutomers`
  ADD PRIMARY KEY (`id_customers`);

--
-- Indeks untuk tabel `make`
--
ALTER TABLE `make`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vehicle_type_id` (`vehicle_type_id`),
  ADD UNIQUE KEY `make_id` (`make_id`);

--
-- Indeks untuk tabel `vehicle_type`
--
ALTER TABLE `vehicle_type`
  ADD PRIMARY KEY (`Id`);

--
-- Indeks untuk tabel `vin`
--
ALTER TABLE `vin`
  ADD PRIMARY KEY (`vehicle_id`),
  ADD KEY `customers_id` (`customers_id`),
  ADD KEY `model_id` (`model_id`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `model`
--
ALTER TABLE `model`
  ADD CONSTRAINT `model_ibfk_1` FOREIGN KEY (`make_id`) REFERENCES `make` (`id`),
  ADD CONSTRAINT `model_ibfk_2` FOREIGN KEY (`vehicle_type_id`) REFERENCES `vehicle_type` (`Id`);

--
-- Ketidakleluasaan untuk tabel `vin`
--
ALTER TABLE `vin`
  ADD CONSTRAINT `vin_ibfk_1` FOREIGN KEY (`customers_id`) REFERENCES `cutomers` (`id_customers`),
  ADD CONSTRAINT `vin_ibfk_2` FOREIGN KEY (`model_id`) REFERENCES `model` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
