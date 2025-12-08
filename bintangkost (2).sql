-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 24, 2025 at 05:41 AM
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `data_kamar`
--

INSERT INTO `data_kamar` (`id_kamar`, `nama_kamar`, `kategori`, `deskripsi`, `fasilitas`, `harga`, `gambar`, `ketersediaan`) VALUES
(7, 'kamar 90', '1.000.000-2.000.000', 'kamar dengan level high class, dijamin serasa rumah sendiri', 'kasur, meja, kamarmandi, lemari, dapur, rooftop', 1900000, '731-item-large8.jpg', 'Tersedia'),
(10, 'kamar 2', '350k - 500k', 'cocok buat kaum mendang mending tapi pengen fasilitas lebih', '- kamar\r\n- lemari\r\n- meja\r\n- km. Luar', 450, 'kos5 .jpg', 'sedia'),
(11, 'kamar 3', '550k - 700k', 'cocok buat kaum introvert yang ingin mencari tempat santai', '- kamar\r\n- lemari\r\n- meja\r\n- km. Luar', 450, 'kos4 .jpg', 'sedia');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_kamar`
--

CREATE TABLE `kategori_kamar` (
  `id_kategori` int NOT NULL,
  `nama_kategori` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `login_user`
--

INSERT INTO `login_user` (`id_user`, `email`, `username`, `password`, `nama`, `no_telp`, `role`) VALUES
(1, 'admin@gmail.com', 'admin', 'admin123', 'Admin kost', '0', 'admin'),
(2, 'santoso@gmail.com', 'pemilik', 'pemilik123', 'adhi', '0', 'pemilik'),
(6, 'm.b.adhipura37@gmail.com', 'adhi', 'adhi', '', '0', 'penyewa'),
(7, 'dataplus37@gmail.com', 'nopalGopal', 'nopaljmk', 'nopal', '0', 'penyewa'),
(8, '202451165@std.umk.ac.id', 'dimasjosjis', 'dimasanjay', 'dimas', '0', 'penyewa'),
(9, 'zudi@gmail.com', 'zudi12', '12345678', 'zud', '0', 'penyewa'),
(10, 'nopalsimalakama2gmail.com', 'nopal', 'simalakama', 'dwijanto', '0', 'penyewa'),
(11, 'fatur@gmail.com', 'fatur123', 'miyabi', 'fatur', '0', 'penyewa'),
(12, '1@gmail.com', '1', '1234', '1', '1', 'penyewa'),
(13, 'zzzz@gmail.com', 'zudi kalcer', '12345678', 'zudiadi', '098876765432', 'penyewa'),
(14, 'vanss@gmail.com', 'vanesco', '12345678', 'vanss', '098997865434', 'penyewa'),
(15, 'vanss@gmail.com', 'vans', '123321', 'vanss', '098997865434', 'penyewa'),
(16, 'ya@gmail.com', 'ya', '12345678', 'ya', '09878658700', 'penyewa'),
(17, 'amba@gmail.com', 'amba', 'amba123', 'amba', '0812345678', 'penyewa'),
(18, 'yo', 'yo', '12345678', 'yo', '0986666666', 'penyewa');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `bukti_bayar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pengajuan_sewa`
--

INSERT INTO `pengajuan_sewa` (`id_sewa`, `id_user`, `id_kamar`, `nama_lengkap`, `alamat_ktp`, `foto_ktp`, `tanggal_pengajuan`, `status`, `bukti_bayar`) VALUES
(2, 16, 7, 'adhi', 'hjdjdshsd', '427_pembuatan erd.png', '2025-11-23 02:34:01', 'Lunas', 'BUKTI-7752-contact4.png'),
(3, 6, 11, 'adhi', 'kecapi', '845_contact4.png', '2025-11-23 03:17:30', 'Ditolak', NULL),
(4, 17, 6, 'adhi', 'dsgjdgashdg', '955_contact4.png', '2025-11-24 11:34:38', 'Lunas', 'BUKTI-2310-pembuatan erd.png');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  MODIFY `id_kamar` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `kategori_kamar`
--
ALTER TABLE `kategori_kamar`
  MODIFY `id_kategori` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login_user`
--
ALTER TABLE `login_user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pemilik`
--
ALTER TABLE `pemilik`
  MODIFY `id_pemilik` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengajuan_sewa`
--
ALTER TABLE `pengajuan_sewa`
  MODIFY `id_sewa` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `penyewa`
--
ALTER TABLE `penyewa`
  MODIFY `id_kamar` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
