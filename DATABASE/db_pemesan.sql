-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Okt 2025 pada 14.54
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pemesan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun`
--

CREATE TABLE `akun` (
  `id` int(123) NOT NULL,
  `nama` varchar(231) NOT NULL,
  `email` varchar(231) NOT NULL,
  `password` varchar(231) NOT NULL,
  `sebagai` enum('cust','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`id`, `nama`, `email`, `password`, `sebagai`) VALUES
(1, 'Fauzi', 'simsalabim@gmail.com', 'oji123', 'cust'),
(2, 'Elma', 'fauzi@gmail.com', 'elma123', 'cust'),
(8, 'Oji', 'oji@gmail.com', 'oji123', 'user'),
(9, 'Fauzi', 'gilang@gmail.com', 'gilang123', 'cust'),
(10, 'GIlang', 'mayo@gmail.com', 'mayo123', 'user');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_barang`
--

CREATE TABLE `data_barang` (
  `id_barang` int(123) NOT NULL,
  `nama_barang` varchar(231) NOT NULL,
  `jenis_barang` enum('Sticker','Banner','Laminating','Print') NOT NULL,
  `harga_barang` int(231) NOT NULL,
  `satuan` varchar(231) NOT NULL,
  `gambar_produk` varchar(231) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_barang`
--

INSERT INTO `data_barang` (`id_barang`, `nama_barang`, `jenis_barang`, `harga_barang`, `satuan`, `gambar_produk`) VALUES
(1, 'Banner Flexy 280', 'Banner', 20000, 'Meter', 'bannerflexy.jpeg'),
(2, 'Stiker vinyl indoor', 'Sticker', 85000, 'Meter', 'stikervinyl.jpeg'),
(3, 'Print HVS A4 Hitam Putih ', 'Print', 1000, 'Lembar', 'printa4hitamputih.jpeg'),
(4, 'Print HVS A4 warna', 'Print', 3000, 'Lembar', 'printa4warna.jpeg'),
(7, 'Laminating dingin', 'Laminating', 30000, 'Meter', '1761130392_laminatingdingin.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_pemesanan`
--

CREATE TABLE `data_pemesanan` (
  `id` int(123) NOT NULL,
  `id_cust` int(22) NOT NULL,
  `nama_barang` varchar(231) NOT NULL,
  `no_pesanan` varchar(123) NOT NULL,
  `nama_cust` varchar(123) NOT NULL,
  `no_telp` varchar(123) NOT NULL,
  `tanggal_pemesanan` date NOT NULL,
  `tanggal_pengambilan` date NOT NULL,
  `lebar` int(123) NOT NULL,
  `tinggi` int(123) NOT NULL,
  `jumlah_barang` int(123) NOT NULL,
  `desain_cetak` varchar(123) NOT NULL,
  `jenis_pembayaran` varchar(123) NOT NULL,
  `bukti_pembayaran` varchar(123) NOT NULL,
  `total_harga` int(123) NOT NULL,
  `validasi` varchar(231) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_pemesanan`
--

INSERT INTO `data_pemesanan` (`id`, `id_cust`, `nama_barang`, `no_pesanan`, `nama_cust`, `no_telp`, `tanggal_pemesanan`, `tanggal_pengambilan`, `lebar`, `tinggi`, `jumlah_barang`, `desain_cetak`, `jenis_pembayaran`, `bukti_pembayaran`, `total_harga`, `validasi`) VALUES
(5, 2, 'Print HVS A4 warna', 'BMB001', 'Elma', '3123131231', '2025-10-21', '2025-10-22', 0, 0, 5, 'BMB001_rasya.png', 'tunai', '', 15000, 'Pesanan Sudah Di Ambil'),
(6, 2, 'Banner Flexy 280', 'BMB002', 'Elma', '0934893', '2025-10-21', '2025-10-23', 3, 3, 1, 'BMB002_desain corel.png', 'qris', 'bukti_BMB002_laminatingdingin.jpeg', 180000, 'Pesanan Sudah Di Ambil'),
(7, 9, 'Banner Flexy 280', 'BMB003', 'Fauzi', '088790807', '2025-10-22', '2025-10-23', 2, 2, 1, 'BMB003_Transformers-Revenge-Of-The-Fallen-Thumbnail-A.jpg', 'qris', 'bukti_BMB003_laminatingdingin.jpeg', 80000, 'Pesanan Sudah Di Ambil'),
(8, 9, 'Print HVS A4 Hitam Putih ', 'BMB004', 'Fauzi', '3123131231', '2025-10-22', '2025-10-22', 0, 0, 1, 'BMB004_laminatingdingin.jpeg', 'tunai', '', 1000, 'Pesanan Sudah Di Ambil'),
(9, 2, 'Laminating dingin', 'BMB005', 'Elma', '0890839074', '2025-10-26', '2025-10-27', 1, 1, 1, 'BMB005_Logo.Fatih.jpg', 'tunai', '', 30000, 'Pesanan Sudah Di Ambil'),
(10, 2, 'Stiker vinyl indoor', 'BMB006', 'Elma', '079677345', '2025-10-26', '2025-10-27', 1, 1, 1, 'BMB006_Logo.Fatih.jpg', 'tunai', '', 85000, 'Pesanan Sudah Di Ambil');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rating`
--

CREATE TABLE `rating` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rating`
--

INSERT INTO `rating` (`id`, `user_id`, `produk_id`, `rating`, `created_at`) VALUES
(1, 2, 1, 5, '2025-10-23 01:49:24'),
(2, 9, 1, 3, '2025-10-23 02:14:52');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_barang`
--
ALTER TABLE `data_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `data_pemesanan`
--
ALTER TABLE `data_pemesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_rating` (`user_id`,`produk_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `akun`
--
ALTER TABLE `akun`
  MODIFY `id` int(123) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `data_barang`
--
ALTER TABLE `data_barang`
  MODIFY `id_barang` int(123) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `data_pemesanan`
--
ALTER TABLE `data_pemesanan`
  MODIFY `id` int(123) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
