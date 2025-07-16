-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Jul 2025 pada 20.30
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fgshop`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `nama_produk` varchar(255) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `kategori` varchar(100) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `is_new` tinyint(1) DEFAULT 0,
  `is_sale` tinyint(1) DEFAULT 0,
  `vendor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `nama_produk`, `harga`, `kategori`, `gambar`, `is_new`, `is_sale`, `vendor_id`) VALUES
(1, 'KAMERA CANON EOS 250D', 8328000, 'KAMERA', './img/product01.png', 1, 1, NULL),
(2, 'Fujifilm X100S', 8550000, 'KAMERA', './img/product02.png', 1, 0, NULL),
(3, 'Sony FE 55mm f/1.8', 2150000, 'lensa', './img/productacc01.png', 1, 0, NULL),
(4, 'Lighting Kit 2', 3500000, 'LIGHTING', './img/product04.png', 0, 0, NULL),
(5, 'Tripod Manfrotto 545GB', 7000000, 'Aksesoris', './img/product05.png', 0, 0, NULL),
(7, 'Gimbal Stabilizer', 3250000, 'Aksesoris', './img/productacc02.png', 1, 0, NULL),
(8, 'MeFoto MK10 Mini', 390000, 'Aksesoris', './img/productacc03.png', 1, 0, NULL),
(9, 'Sony PCK-LG1 Glass', 509000, 'Aksesoris', './img/productacc04.png', 1, 0, NULL),
(10, 'Sony A6400 Kit 16-50mm', 13199000, 'KAMERA', './img/productacc05.png', 0, 0, NULL),
(11, 'Sony Digital Vlogging', 7499000, 'KAMERA', './img/productacc06.png', 0, 0, NULL),
(12, 'Nikon D810 Body', 42315000, 'KAMERA', './img/productacc07.png', 0, 0, NULL),
(13, 'Nikon D810', 51975000, 'KAMERA', './img/productacc08.png', 0, 0, NULL),
(14, 'Godox MS200-E', 350000, 'LIGHTING', './img/productacc09.png', 0, 0, NULL),
(15, 'Tronic TR250e', 2125000, 'LIGHTING', './img/productacc10.png', 0, 0, NULL),
(16, 'Tronic TR500e', 6300000, 'LIGHTING', './img/productacc11.png', 0, 0, NULL),
(17, 'NiceFoto Wireless', 6300000, 'LIGHTING', './img/productacc12.png', 0, 0, NULL),
(18, 'kamera', 50, 'KAMERA', 'img/Screenshot 2025-07-03 234247.png', 1, 0, 2),
(19, 'LENSA', 1, 'Aksesoris', 'img/shop01.png', 1, 0, 3),
(20, 'LIGHTING', 10000000, 'Aksesoris', 'img/product05.png', 0, 1, 3),
(21, 'LIGHTING', 10000000, 'Aksesoris', 'img/product05.png', 0, 1, 3);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
