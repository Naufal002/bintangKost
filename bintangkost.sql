-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 14, 2025 at 03:37 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bintangkost`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int NOT NULL,
  `email_admin` varchar(100) NOT NULL,
  `username_adnin` varchar(100) NOT NULL,
  `password_admin` varchar(100) NOT NULL,
  `laporan_admin` varchar(100) NOT NULL,
  `acc_admin` varchar(100) NOT NULL,
  `gambar_admin` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_kamar`
--

CREATE TABLE `data_kamar` (
  `id_kamar` int NOT NULL,
  `nama_kamar` varchar(100) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `fasilitas` varchar(100) NOT NULL,
  `harga` int NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `ketersediaan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_kamar`
--

INSERT INTO `data_kamar` (`id_kamar`, `nama_kamar`, `kategori`, `deskripsi`, `fasilitas`, `harga`, `gambar`, `ketersediaan`) VALUES
(10, 'kamar 2', '350k - 500k', 'cocok buat kaum mendang mending tapi pengen fasilitas lebih', '- kamar\r\n- lemari\r\n- meja\r\n- km. Luar', 450, 'kos5 .jpg', 'sedia'),
(11, 'kamar 3', '550k - 700k', 'cocok buat kaum introvert yang ingin mencari tempat santai', '- kamar\r\n- lemari\r\n- meja\r\n- km. Luar', 450, 'kos4 .jpg', 'Tersedia'),
(13, 'kamar 90', '250k-300k', 'nyaman', 'kasur', 5000000, '1807170285_contact4.png', 'Tersedia'),
(14, 'kamar 4', '400k-600k', 'kamar nyaman dan bagus ', 'kamar mandi dalam ', 550000, '1592820815_item7.jpg', 'Tersedia'),
(15, 'kamar 5', '400k-600k', 'kamar mandi luar- mewah', 'ac ', 590000, '1516736475_kos4 .jpg', 'Penuh');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_kamar`
--

CREATE TABLE `kategori_kamar` (
  `id_kategori` int NOT NULL,
  `nama_kategori` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `keluhan`
--

CREATE TABLE `keluhan` (
  `id_keluhan` int NOT NULL,
  `id_user` int NOT NULL,
  `judul_laporan` varchar(100) NOT NULL,
  `deskripsi` varchar(200) NOT NULL,
  `bukti` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keluhan`
--

INSERT INTO `keluhan` (`id_keluhan`, `id_user`, `judul_laporan`, `deskripsi`, `bukti`) VALUES
(1, 0, 'lampu mati', 'kampunya pecah pakk', '376_Screenshot (17).png'),
(2, 6, 'lampu mati', 'lampu pecah', '322_contact4.png'),
(3, 6, 'lampu mati', 'lampu bakar', '714_Screenshot (14).png'),
(4, 6, 'pintu jebol', 'woy pintunya pak😭😭😭😭', '507_Screenshot (7).png'),
(5, 22, 'pintu jebol', 'tolong', '561_Screenshot (10).png'),
(6, 24, 'wifi lemot', 'ganti wifi ke starlink', '467_Screenshot (3).png'),
(7, 25, 'bau busuk', 'kayak e ada orang mabuk pak', '655_Screenshot (10).png');

-- --------------------------------------------------------

--
-- Table structure for table `login_user`
--

CREATE TABLE `login_user` (
  `id_user` int NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_telp` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_user`
--

INSERT INTO `login_user` (`id_user`, `email`, `username`, `password`, `nama`, `no_telp`, `role`) VALUES
(1, 'admin@gmail.com', 'admin', 'admin123', 'Admin kost', '0', 'admin'),
(2, 'santoso@gmail.com', 'pemilik', 'pemilik123', 'adhi', '0', 'pemilik'),
(6, 'm.b.adhipura37@gmail.com', 'adhi', 'adhi', 'ahdi', '0', 'penyewa'),
(22, 'pupu@gmail.com', 'pupu123', 'pupu', 'pupu', '098997865434', 'penyewa'),
(23, 'wisam@gmail.com', 'sam', '123', 'wisam ikbar', '123456789', 'penyewa'),
(24, 'vanss_a2@gmail.com', 'ranss', 'vanss123456789', 'vanesco', '083843853036', 'penyewa'),
(25, 'ahdi@gmail.com', 'ahdi123', 'ahdi123', 'ahdi', '087654321', 'penyewa');

-- --------------------------------------------------------

--
-- Table structure for table `pemilik`
--

CREATE TABLE `pemilik` (
  `id_pemilik` int NOT NULL,
  `gmail_pemilik` varchar(100) NOT NULL,
  `username_pemilik` varchar(100) NOT NULL,
  `password_pemilik` varchar(100) NOT NULL,
  `laporan_pemilik` varchar(100) NOT NULL,
  `gambar_pemilik` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_sewa`
--

CREATE TABLE `pengajuan_sewa` (
  `id_sewa` int NOT NULL,
  `id_user` int NOT NULL,
  `id_kamar` int NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `alamat_ktp` text NOT NULL,
  `foto_ktp` varchar(255) NOT NULL,
  `tanggal_pengajuan` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(50) NOT NULL,
  `bukti_bayar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengajuan_sewa`
--

INSERT INTO `pengajuan_sewa` (`id_sewa`, `id_user`, `id_kamar`, `nama_lengkap`, `alamat_ktp`, `foto_ktp`, `tanggal_pengajuan`, `status`, `bukti_bayar`) VALUES
(10, 6, 11, 'adhipura pura', 'asdasd', '1568238448_pembuatan erd.png', '2025-12-04 02:12:23', 'Lunas', 'BUKTI-6504-pembuatan erd.png'),
(11, 22, 13, 'pupukecapi', 'kecapi', '1869754517_contact4.png', '2025-12-04 02:45:03', 'Lunas', 'BUKTI-4534-pembuatan erd.png'),
(12, 23, 11, 'wisam ikbar', 'kudus', '883599222_Screenshot (823).png', '2025-12-08 00:40:34', 'Lunas', 'BUKTI-9171-Screenshot (822).png'),
(13, 6, 10, 'si imut anjay kata fahri imut banget sumpah', 'ngawi kidul', '1500207625_contact4.png', '2025-12-08 16:08:16', 'Lunas', 'BUKTI-6595-penentuan atribnit.png'),
(16, 24, 14, 'jordi', 'jerman ', '1872592444_Screenshot (7).png', '2025-12-08 16:38:51', 'Lunas', 'BUKTI-6162-Screenshot (4).png'),
(17, 24, 11, 'vanss', 'pati', '2020573125_Screenshot (2).png', '2025-12-08 16:57:05', 'Disetujui', NULL),
(18, 25, 10, 'muhammad bintang adhipura', 'kecapi', '708730027_Screenshot 2025-11-30 184827.png', '2025-12-08 17:18:41', 'Lunas', 'BUKTI-9287-contact4.png');

-- --------------------------------------------------------

--
-- Table structure for table `penyewa`
--

CREATE TABLE `penyewa` (
  `id_kamar` int NOT NULL,
  `nama_kamar` varchar(100) NOT NULL,
  `penyewa` varchar(100) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `fasilitas` varchar(100) NOT NULL,
  `harga` varchar(100) NOT NULL,
  `gambar` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `data_kamar`
--
ALTER TABLE `data_kamar`
  ADD PRIMARY KEY (`id_kamar`);

--
-- Indexes for table `kategori_kamar`
--
ALTER TABLE `kategori_kamar`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `keluhan`
--
ALTER TABLE `keluhan`
  ADD PRIMARY KEY (`id_keluhan`);

--
-- Indexes for table `login_user`
--
ALTER TABLE `login_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `pemilik`
--
ALTER TABLE `pemilik`
  ADD PRIMARY KEY (`id_pemilik`);

--
-- Indexes for table `pengajuan_sewa`
--
ALTER TABLE `pengajuan_sewa`
  ADD PRIMARY KEY (`id_sewa`);

--
-- Indexes for table `penyewa`
--
ALTER TABLE `penyewa`
  ADD PRIMARY KEY (`id_kamar`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_kamar`
--
ALTER TABLE `data_kamar`
  MODIFY `id_kamar` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `kategori_kamar`
--
ALTER TABLE `kategori_kamar`
  MODIFY `id_kategori` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `keluhan`
--
ALTER TABLE `keluhan`
  MODIFY `id_keluhan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `login_user`
--
ALTER TABLE `login_user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `pemilik`
--
ALTER TABLE `pemilik`
  MODIFY `id_pemilik` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengajuan_sewa`
--
ALTER TABLE `pengajuan_sewa`
  MODIFY `id_sewa` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `penyewa`
--
ALTER TABLE `penyewa`
  MODIFY `id_kamar` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
