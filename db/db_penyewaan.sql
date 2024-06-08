-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2022 at 02:32 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_penyewaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `18073_alat`
--

CREATE TABLE `18073_alat` (
  `id_alat` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `harga_sewa` decimal(10,0) DEFAULT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `18073_alat`
--

INSERT INTO `18073_alat` (`id_alat`, `nama`, `jumlah`, `harga_sewa`, `gambar`, `keterangan`) VALUES
(23, 'Ciel Phantomhive', 4, '32000', 'ciel.jpg', 'Ciel Kuroshitsuji Set Cosplay'),
(24, 'Gura Gawr', 3, '23000', 'gura.jpg', 'Gura Gawr Hololive Vtuber '),
(25, 'Jibaku Hanako', 4, '22000', 'jibaku.jpg', 'Hanako Jibaku Shounen'),
(26, 'Ibuki Namida', 1, '34000', 'ibuki.jpg', 'Ibuki Namida Danganronpa Set cosplay'),
(27, 'Kaedahara Kazuha', 5, '31000', 'kazuha.jpg', 'Kazuha Genshin Impact Set Cosplay'),
(28, 'Krul Tepez', 1, '31500', 'krul.jpg', 'Krul tepez Owari no Seraph Set Cosplay'),
(29, 'Kurapika', 6, '12000', 'kurapika.jpg', 'Kurapika HuntexHunter Set Cosplay'),
(30, 'Maki Zenin', 18, '25000', 'maki.jpg', 'Maki Zenin Jujutsu Kaisen Set Cosplay'),
(31, 'Yor forger', 15, '12000', 'mamayor.jpg', 'Yor Forger SpyxFamily Set Cosplay'),
(32, 'Megurine Set Rin & Len', 1, '48000', 'megurine.jpg', 'Megurine Rin Megurine Len Vocaloid Set Cosplay'),
(33, 'Ryusui Nanami', 3, '21000', 'ryusu .jpg', 'Ryusui Nanami Dr. Stone Set Cosplay'),
(34, 'Scaramouche', 2, '33500', 'scara.jpg', 'Scaramouche Genshin Impact Game Set Cosplay'),
(35, 'Mai Sakurajima & Sakuta Azusagawa Set', 5, '39000', 'seishun.jpg', 'Seishun Buta Yarou wa Bunny Girl Senpai no Yume wo Minai Couple Set Cosplay '),
(36, 'Sesshomaru', 3, '31000', 'sesho.jpg', 'Sesshomaru Inuyasha Set Cosplay'),
(37, 'Suguru Geto', 14, '29000', 'suguru.jpg', 'Suguru geto Jujutsu Kaisen Set Cosplay'),
(38, 'Zero Two', 13, '12000', 'zerotu.jpg', 'Zero Two Darling in the Franxx Set Cosplay');

-- --------------------------------------------------------

--
-- Table structure for table `18073_d_sewa`
--

CREATE TABLE `18073_d_sewa` (
  `id_sewa` char(10) DEFAULT NULL,
  `id_alat` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `18073_d_sewa`
--

INSERT INTO `18073_d_sewa` (`id_sewa`, `id_alat`, `jumlah`, `keterangan`) VALUES
('sewa01', 25, 1, 'Event Bunkansai Udinus'),
('sewa02', 28, 1, 'Event Sukaku');

-- --------------------------------------------------------

--
-- Table structure for table `18073_pembayaran`
--

CREATE TABLE `18073_pembayaran` (
  `id_bayar` int(11) NOT NULL,
  `id_sewa` char(10) DEFAULT NULL,
  `tgl_bayar` datetime DEFAULT NULL,
  `jml_uang` decimal(10,0) DEFAULT NULL,
  `total_bayar` decimal(10,0) DEFAULT NULL,
  `kembalian` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `18073_pembayaran`
--

INSERT INTO `18073_pembayaran` (`id_bayar`, `id_sewa`, `tgl_bayar`, `jml_uang`, `total_bayar`, `kembalian`) VALUES
(13, 'sewa01', '2022-12-23 04:33:57', '0', '0', '0'),
(14, 'sewa02', '2022-12-23 05:12:24', '102000', '101500', '500');

-- --------------------------------------------------------

--
-- Table structure for table `18073_penyewaan`
--

CREATE TABLE `18073_penyewaan` (
  `id_sewa` char(10) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `tgl_sewa` datetime DEFAULT NULL,
  `tgl_kembali` datetime DEFAULT NULL,
  `lama_sewa` int(11) NOT NULL,
  `jaminan` varchar(50) DEFAULT NULL,
  `biaya_sewa` decimal(10,0) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `uang_muka` decimal(10,0) DEFAULT NULL,
  `status` enum('pre-sewa','disewa','selesai','temp') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `18073_penyewaan`
--

INSERT INTO `18073_penyewaan` (`id_sewa`, `id_user`, `tgl_sewa`, `tgl_kembali`, `lama_sewa`, `jaminan`, `biaya_sewa`, `keterangan`, `uang_muka`, `status`) VALUES
('sewa01', 5, '2022-12-22 04:30:00', '2022-12-23 04:30:00', 1, 'ktm', '22000', 'Event Bunkansai', '22000', 'selesai'),
('sewa02', 24, '2022-12-23 05:07:00', '2022-12-28 05:07:00', 5, 'fotocopy ktp', '157500', 'Event Sukaku', '56000', 'selesai');

-- --------------------------------------------------------

--
-- Table structure for table `18073_user`
--

CREATE TABLE `18073_user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `telp` varchar(15) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `role` enum('admin','penyewa') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `18073_user`
--

INSERT INTO `18073_user` (`id_user`, `nama`, `telp`, `alamat`, `username`, `password`, `role`) VALUES
(1, 'Faradil', '083155616880', 'Jl. Foxnine No 3', 'khuntamvan', 'c4b96b07c870a9c6f9fbc8b951c2bb9f', 'admin'),
(2, 'Kunikun', '087693554231', 'Jl. Sawo Raya Rt 5 RW 1', 'kunikun', 'ba984ab271ea02a804cbfd66fc9f9eef', 'penyewa'),
(3, 'Kola Tieza', '087968523441', 'Jl. Permadani No 32 Rt 7 Rw 3', 'Kola', '86f41d669c9eb10fdd869715a77a25d4', 'penyewa'),
(4, 'Nata Dinagara', '085698742384', 'Jl. Patriot No 45 Sumurwatu Mrican ', 'nata', '093d8a0793df4654fee95cc1215555b3', 'penyewa'),
(5, 'Sai Dirgadinata', '081657988546', 'Jl.Puntadewa Raya No 14 ', 'nanamin', '3de7e2f926c05332e7e440672655a25e', 'penyewa'),
(6, 'Ulya', '085633569155', 'Jl. Woltermonginsidi, Bangetayu Kulon RT 4/I No 1', 'ulya', '278704eef0c87e7426f40f51c95b375b', 'penyewa'),
(7, 'Arjuna Irana', '083689567559', 'Jl. Matahari No 887 ', 'arjun', '7626d28b710e7f9e98d9dfbe9bf0d123', 'penyewa'),
(24, 'Senoa Kurmois', '085258697462', 'Jl. Bojongbata IX No 98', 'senkuy', 'baecbd61cd1751d06e69e37b0a11160c', 'penyewa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `18073_alat`
--
ALTER TABLE `18073_alat`
  ADD PRIMARY KEY (`id_alat`);

--
-- Indexes for table `18073_d_sewa`
--
ALTER TABLE `18073_d_sewa`
  ADD KEY `id_sewa` (`id_sewa`),
  ADD KEY `id_alat` (`id_alat`);

--
-- Indexes for table `18073_pembayaran`
--
ALTER TABLE `18073_pembayaran`
  ADD PRIMARY KEY (`id_bayar`),
  ADD KEY `id_sewa` (`id_sewa`);

--
-- Indexes for table `18073_penyewaan`
--
ALTER TABLE `18073_penyewaan`
  ADD PRIMARY KEY (`id_sewa`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `18073_user`
--
ALTER TABLE `18073_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `18073_alat`
--
ALTER TABLE `18073_alat`
  MODIFY `id_alat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `18073_pembayaran`
--
ALTER TABLE `18073_pembayaran`
  MODIFY `id_bayar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `18073_user`
--
ALTER TABLE `18073_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `18073_d_sewa`
--
ALTER TABLE `18073_d_sewa`
  ADD CONSTRAINT `18073_d_sewa_ibfk_1` FOREIGN KEY (`id_sewa`) REFERENCES `18073_penyewaan` (`id_sewa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `18073_d_sewa_ibfk_2` FOREIGN KEY (`id_alat`) REFERENCES `18073_alat` (`id_alat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `18073_pembayaran`
--
ALTER TABLE `18073_pembayaran`
  ADD CONSTRAINT `18073_pembayaran_ibfk_1` FOREIGN KEY (`id_sewa`) REFERENCES `18073_penyewaan` (`id_sewa`);

--
-- Constraints for table `18073_penyewaan`
--
ALTER TABLE `18073_penyewaan`
  ADD CONSTRAINT `18073_penyewaan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `18073_user` (`id_user`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
