-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Jan 2025 pada 16.35
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
-- Database: `uaspw`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_izin`
--

CREATE TABLE `surat_izin` (
  `id` int(11) NOT NULL,
  `nim_mahasiswa` varchar(10) NOT NULL,
  `alasan` text NOT NULL,
  `tanggal_izin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `surat_izin`
--

INSERT INTO `surat_izin` (`id`, `nim_mahasiswa`, `alasan`, `tanggal_izin`) VALUES
(1, 'D212111001', 'Menghadiri seminar nasional', '2025-01-20'),
(2, 'D212111005', 'Sakit demam tinggi', '2025-01-21'),
(3, 'D212111002', 'Kegiatan keluarga mendesak', '2025-01-22'),
(4, 'D212111003', 'Mengurus dokumen penting di kampus lain', '2025-01-23'),
(5, 'D212111005', 'Mengikuti lomba akademik tingkat nasional', '2025-01-23'),
(6, 'D212111007', 'Menghadiri pernikahan saudara', '2025-01-24'),
(7, 'D212111011', 'Sakit flu berat', '2025-01-24'),
(8, 'D212111012', 'Mengikuti pelatihan organisasi', '2025-01-28'),
(9, 'D212111026', 'Kecelakaan kecil dan butuh istirahat', '2025-01-28'),
(10, 'D212111028', 'Acara keluarga di luar kota', '2025-01-30'),
(11, 'D212111027', 'Acara Keluarga', '2025-01-30'),
(12, 'D212111019', 'Tanpa Keterangan', '2025-01-30'),
(13, 'D212111009', 'Sakit Demam', '2025-01-31'),
(14, 'D212111033', 'Mengikuti lomba akademik tingkat nasional', '2025-02-03'),
(15, 'D212111023', 'Mengikuti Pagelaran diluar kampus', '2025-02-04'),
(17, 'D212111016', 'Pulang Kampung', '2025-02-06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `email`, `password`) VALUES
(1, 'kenianurazizah21@gmail.com', 'D212111010'),
(2, 'kenisanurfaqirah16@gmail.com', 'E212111016');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `surat_izin`
--
ALTER TABLE `surat_izin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `surat_izin`
--
ALTER TABLE `surat_izin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
