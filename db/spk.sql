-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2020 at 11:39 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk`
--

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id` int(11) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `jenis` enum('cf','sf') NOT NULL,
  `ket` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id`, `nama`, `jenis`, `ket`) VALUES
(1, 'Indeks prestasi komulatif (IPK)', 'cf', 'Core Factor'),
(2, 'Penghasilan Orang Tua', 'cf', 'Core Factor'),
(3, 'Jumlah Tanggungan', 'sf', 'Secondary Factor'),
(4, 'Semester', 'sf', 'Secondary Factor');

-- --------------------------------------------------------

--
-- Table structure for table `mhs`
--

CREATE TABLE `mhs` (
  `id` int(11) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `profil_ipk` int(11) NOT NULL,
  `profil_penghasilanortu` int(11) NOT NULL,
  `profil_tanggungan` int(11) NOT NULL,
  `profil_semester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mhs`
--

INSERT INTO `mhs` (`id`, `nama`, `profil_ipk`, `profil_penghasilanortu`, `profil_tanggungan`, `profil_semester`) VALUES
(1, 'Hafizul Furqan', 4, 3, 4, 3),
(2, 'Aiyub ', 4, 1, 4, 4),
(3, 'Khadafi', 4, 4, 1, 2),
(4, 'tes', 1, 1, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `pembobotan`
--

CREATE TABLE `pembobotan` (
  `id` int(11) NOT NULL,
  `selisih` float NOT NULL,
  `bobot` float NOT NULL,
  `ket` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembobotan`
--

INSERT INTO `pembobotan` (`id`, `selisih`, `bobot`, `ket`) VALUES
(1, 0, 5, 'Tidak Ada Selisih (kompetensi sesuai dengan yang dibutuhkan)'),
(2, 1, 4.5, 'Kompetensi individu kelebihan 1 tingkat/level'),
(3, -1, 4, 'Kompetensi individu kekurangan 1 tingkat/level'),
(4, 2, 3.5, 'Kompetensi individu kelebihan 2 tingkat/level'),
(5, -2, 3, 'Kompetensi individu kekurangan 2 tingkat/level'),
(6, 3, 2.5, 'Kompetensi individu kelebihan 3 tingkat/level'),
(7, -3, 2, 'Kompetensi individu kekurangan 3 tingkat/level'),
(8, 4, 1.5, 'Kompetensi individu kelebihan 4 tingkat/level'),
(9, -4, 1, 'Kompetensi individu kekurangan 4 tingkat/level');

-- --------------------------------------------------------

--
-- Table structure for table `peringkat`
--

CREATE TABLE `peringkat` (
  `id` int(11) NOT NULL,
  `mhs_id` int(11) NOT NULL,
  `nilai_total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peringkat`
--

INSERT INTO `peringkat` (`id`, `mhs_id`, `nilai_total`) VALUES
(1, 1, 4.6),
(2, 2, 3.8),
(3, 3, 4.4),
(4, 4, 2.7);

-- --------------------------------------------------------

--
-- Table structure for table `profil_standar`
--

CREATE TABLE `profil_standar` (
  `id` int(11) NOT NULL,
  `kriteria_id` int(11) NOT NULL,
  `subkriteria_id` int(11) NOT NULL,
  `nilaiprofil_std` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profil_standar`
--

INSERT INTO `profil_standar` (`id`, `kriteria_id`, `subkriteria_id`, `nilaiprofil_std`) VALUES
(1, 1, 14, 4),
(2, 2, 12, 4),
(3, 3, 8, 4),
(4, 4, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sub_kriteria`
--

CREATE TABLE `sub_kriteria` (
  `id` int(11) NOT NULL,
  `kriteria_id` int(11) NOT NULL,
  `nama` varchar(68) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_kriteria`
--

INSERT INTO `sub_kriteria` (`id`, `kriteria_id`, `nama`, `nilai`) VALUES
(1, 4, '<= 2', 1),
(2, 4, '3 dan 4', 2),
(3, 4, '5 dan 6', 3),
(4, 4, '7 dan 8', 4),
(5, 3, '1', 1),
(6, 3, '2', 2),
(7, 3, '3', 3),
(8, 3, '> 3', 4),
(9, 2, '>= 5.000.000', 1),
(10, 2, '>= 3.000.000 < 5.000.000', 2),
(11, 2, '>= 1.500.000 < 3.000.000', 3),
(12, 2, '< 1.500.000', 4),
(13, 1, '< 2.5', 1),
(14, 1, '>= 2.5 - < 3', 2),
(15, 1, '>= 3 - < 3.5', 3),
(16, 1, '> 3.5', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mhs`
--
ALTER TABLE `mhs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembobotan`
--
ALTER TABLE `pembobotan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peringkat`
--
ALTER TABLE `peringkat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mhs_id` (`mhs_id`);

--
-- Indexes for table `profil_standar`
--
ALTER TABLE `profil_standar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kriteria_id` (`kriteria_id`),
  ADD KEY `subkriteria_id` (`subkriteria_id`);

--
-- Indexes for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_kriteria_ibfk_1` (`kriteria_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mhs`
--
ALTER TABLE `mhs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pembobotan`
--
ALTER TABLE `pembobotan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `peringkat`
--
ALTER TABLE `peringkat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `profil_standar`
--
ALTER TABLE `profil_standar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `peringkat`
--
ALTER TABLE `peringkat`
  ADD CONSTRAINT `peringkat_ibfk_1` FOREIGN KEY (`mhs_id`) REFERENCES `mhs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `profil_standar`
--
ALTER TABLE `profil_standar`
  ADD CONSTRAINT `profil_standar_ibfk_1` FOREIGN KEY (`kriteria_id`) REFERENCES `kriteria` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `profil_standar_ibfk_2` FOREIGN KEY (`subkriteria_id`) REFERENCES `sub_kriteria` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD CONSTRAINT `sub_kriteria_ibfk_1` FOREIGN KEY (`kriteria_id`) REFERENCES `kriteria` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
