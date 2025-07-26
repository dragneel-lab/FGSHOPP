-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Jul 2025 pada 17.16
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
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(50) NOT NULL,
  `country` varchar(50) DEFAULT 'Indonesia',
  `zip_code` varchar(10) DEFAULT NULL,
  `tel` varchar(20) NOT NULL,
  `note` text DEFAULT NULL,
  `total` bigint(20) NOT NULL,
  `payment_method` enum('Transfer Bank','Dompet Digital','COD') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('Menunggu','Diproses','Dikirim','Selesai') DEFAULT 'Menunggu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `first_name`, `last_name`, `email`, `address`, `city`, `country`, `zip_code`, `tel`, `note`, `total`, `payment_method`, `created_at`, `status`) VALUES
(1, 1, 'lutfhy', 'jsj', 'lutfhy@gmail.com', 'palopo', 'palopo', 'Indonesia', '232323', '32231', NULL, 0, 'Transfer Bank', '2025-07-17 00:01:54', 'Menunggu'),
(2, 1, 'lutfhy', 'jsj', 'lutfhy@gmail.com', 'palopo', 'palopo', 'Indonesia', '232323', '32231', NULL, 2150000, 'Transfer Bank', '2025-07-17 00:06:12', 'Menunggu'),
(3, 1, 'lutfhy', 'jsj', 'lutfhy@gmail.com', 'palopo', 'palopo', 'Indonesia', '232323', '32231', NULL, 8550000, 'Transfer Bank', '2025-07-17 00:08:45', 'Menunggu'),
(4, 1, 'lutfhy', 'jsj', 'lutfhy@gmail.com', 'palopo', 'palopo', 'Indonesia', '232323', '32231', NULL, 390000, 'Transfer Bank', '2025-07-17 00:33:06', 'Menunggu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_name`, `quantity`, `price`) VALUES
(1, 3, 'Fujifilm X100S', 1, 8550000.00),
(2, 4, 'MeFoto MK10 Mini', 1, 390000.00);

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
(21, 'LIGHTING', 10000000, 'Aksesoris', 'img/product05.png', 0, 1, 3),
(22, 'KAMERA ANALOG', 1000000, 'KAMERA', 'img/pexels-israelzin-oliveira-3691225-1024x683.jpg', 1, 0, 1),
(23, 'KAMERA ANALOG', 5000000, 'KAMERA', 'img/pexels-israelzin-oliveira-3691225-1024x683.jpg', 1, 0, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'lutfhy', 'lutfhy@gmail.com', '$2y$10$jLzWROqw70O89lTFu0VutukH8TN8iRNnqkZxix.eTNPWLe0Ii1Dhe', '2025-07-16 23:56:15'),
(2, 'awal', 'awal@gmail.com', '$2y$10$5sUQKp9rwhycewZPtVfZMein/5/q.nXFNeBvaaYYUIxBWe6QiAk4a', '2025-07-17 00:59:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `vendor_users`
--

CREATE TABLE `vendor_users` (
  `id` int(11) NOT NULL,
  `nama_toko` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `lokasi` varchar(150) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `vendor_users`
--

INSERT INTO `vendor_users` (`id`, `nama_toko`, `email`, `password`, `lokasi`, `deskripsi`, `gambar`, `created_at`) VALUES
(1, 'lutfhyshoop', 'lutfhy@gmail.com', '$2y$10$GU.izu3O2ZYgcsebLxaUAOeRDD27DrkaXVaXo10nEftLk6RKsjgJ2', 'palopo', 'fotografi', 'img/1752711074_LOGO.jpg', '2025-07-17 00:11:14'),
(2, 'awalshop', 'awal@gmail.com', '$2y$10$Vcyk9tT7IX2L8KpQbwQHBekuOoToF4B63HBYUFoAGwSJ.psEh4ley', 'palopo', 'fotografi', 'img/1752714012_OIP.jpg', '2025-07-17 01:00:12');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `vendor_users`
--
ALTER TABLE `vendor_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `vendor_users`
--
ALTER TABLE `vendor_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
