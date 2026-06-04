-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 04, 2026 at 03:09 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flower_shop`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `cek_stok_bunga` (`id` INT) RETURNS INT DETERMINISTIC BEGIN
    DECLARE s INT;

    SELECT stok
    INTO s
    FROM produk_bunga
    WHERE id_bunga = id;

    IF s IS NULL THEN
        SET s = 0;
    END IF;

    RETURN s;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `hitung_total_pesanan` (`id` INT) RETURNS INT DETERMINISTIC BEGIN
    DECLARE total INT;

    SELECT SUM(subtotal)
    INTO total
    FROM detail_pesanan
    WHERE id_pesanan = id;

    IF total IS NULL THEN
        SET total = 0;
    END IF;

    RETURN total;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `total_belanja_pelanggan` (`id` INT) RETURNS INT DETERMINISTIC BEGIN
    DECLARE total INT;

    SELECT SUM(total_harga)
    INTO total
    FROM pesanan
    WHERE id_pelanggan = id;

    IF total IS NULL THEN
        SET total = 0;
    END IF;

    RETURN total;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int NOT NULL,
  `nama_admin` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `email`, `password`) VALUES
(1, 'Admin 1', 'admin@gmail.com', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pesanan`
--

CREATE TABLE `detail_pesanan` (
  `id_detail` int NOT NULL,
  `id_pesanan` int DEFAULT NULL,
  `id_bunga` int DEFAULT NULL,
  `jumlah_pesanan` int DEFAULT NULL,
  `subtotal` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `detail_pesanan`
--

INSERT INTO `detail_pesanan` (`id_detail`, `id_pesanan`, `id_bunga`, `jumlah_pesanan`, `subtotal`) VALUES
(1, 1, 8, 1, 150000),
(2, 2, 1, 1, 150000),
(3, 2, 7, 1, 100000),
(4, 3, 3, 1, 120000),
(5, 4, 1, 2, 300000);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int NOT NULL,
  `nama_kategori` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Bouquet'),
(2, 'Bunga Meja'),
(3, 'Bunga Wisuda');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int NOT NULL,
  `nama_pelanggan` varchar(100) DEFAULT NULL,
  `nomor_hp` varchar(15) DEFAULT NULL,
  `alamat` text,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `nomor_hp`, `alamat`, `email`) VALUES
(1, 'Adinda Alfia Az Zahra', '082233446677', 'Bandar Lampung', 'dindin@gmail.com'),
(2, 'Siti Suhaira', '086600554411', 'Tanggamus', 'airaaa@gmail.com'),
(3, 'Nailah Maya', '082244009922', 'Bandar Lampung', 'nanam@gmail.com'),
(4, 'Khoirotun Khisani Putri', '085544332244', 'Pringsewu', 'sani@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int NOT NULL,
  `id_pesanan` int DEFAULT NULL,
  `metode_pembayaran` varchar(50) DEFAULT NULL,
  `status_pembayaran` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_pesanan`, `metode_pembayaran`, `status_pembayaran`) VALUES
(1, 1, 'Cash', 'Lunas'),
(2, 2, 'QRIS', 'Lunas'),
(3, 3, 'Cash', 'Belum Lunas'),
(4, 4, 'Cash', 'Belum Lunas');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int NOT NULL,
  `id_pelanggan` int DEFAULT NULL,
  `tanggal_pesan` date DEFAULT NULL,
  `total_harga` int DEFAULT NULL,
  `status_pesanan` varchar(50) DEFAULT NULL,
  `catatan` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `id_pelanggan`, `tanggal_pesan`, `total_harga`, `status_pesanan`, `catatan`) VALUES
(1, 1, '2026-05-21', 150000, 'Selesai', 'Tolong bungkus rapi'),
(2, 2, '2026-05-21', 250000, 'Selesai', 'Kirim pagi hari'),
(3, 3, '2026-05-22', 120000, 'Diproses', 'Untuk hadiah'),
(4, 4, '2026-05-22', 300000, 'Dikirim', 'Tambah kartu ucapan');

-- --------------------------------------------------------

--
-- Table structure for table `produk_bunga`
--

CREATE TABLE `produk_bunga` (
  `id_bunga` int NOT NULL,
  `nama_bunga` varchar(100) DEFAULT NULL,
  `harga` int DEFAULT NULL,
  `stok` int DEFAULT NULL,
  `id_kategori` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `produk_bunga`
--

INSERT INTO `produk_bunga` (`id_bunga`, `nama_bunga`, `harga`, `stok`, `id_kategori`) VALUES
(1, 'Rose', 200000, 10, 1),
(2, 'Lily', 300000, 5, 2),
(3, 'Sunflower', 120000, 8, 3),
(4, 'Tulip', 350000, 6, 1),
(5, 'Orchid', 250000, 4, 2),
(6, 'Daisy', 120000, 7, 3),
(7, 'Aster', 100000, 10, 3),
(8, 'Lavender', 150000, 5, 2),
(9, 'Peony', 420000, 4, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_pesanan` (`id_pesanan`),
  ADD KEY `id_bunga` (`id_bunga`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD UNIQUE KEY `id_pesanan` (`id_pesanan`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indexes for table `produk_bunga`
--
ALTER TABLE `produk_bunga`
  ADD PRIMARY KEY (`id_bunga`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  MODIFY `id_detail` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `produk_bunga`
--
ALTER TABLE `produk_bunga`
  MODIFY `id_bunga` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD CONSTRAINT `detail_pesanan_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_pesanan_ibfk_2` FOREIGN KEY (`id_bunga`) REFERENCES `produk_bunga` (`id_bunga`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `produk_bunga`
--
ALTER TABLE `produk_bunga`
  ADD CONSTRAINT `produk_bunga_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
