-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Jun 2024 pada 10.38
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `multi-user-login`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `userName`, `password`, `role`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(5, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(6, 'admin', 'e00cf25ad42683b3df678c61f42c6bda', 'admin'),
(7, 'admin', 'e00cf25ad42683b3df678c61f42c6bda', 'admin'),
(8, 'Imam', 'ee50bd0634f6c585bf4aeded338b80e7', 'user'),
(9, 'Imam', 'ee50bd0634f6c585bf4aeded338b80e7', 'user'),
(10, 'annisa', '$2y$10$93MekbyZes9j1OsKXJ6YK.5GZIZUUMXHjM7LJnJKEo4MBZ4kJ9wWW', 'user'),
(11, 'imam33', '$2y$10$Jod3CD7btcrTLJdeLkJTXept6CakHXF9CahTFGMxAsAN4sjQp8.CC', 'user'),
(12, 'imam12345', '$2y$10$9ToQny8ixmmHy17LC6EjA.nfhsTZU1hEC.e89Axy4MtKykuIVWl5a', 'user'),
(13, 'asdasdasdasdasd', '$2y$10$3bYlhucduLnUj8drIp2b/em.q4EUKpehBleHQKdu8lDe5zSW05Ngu', 'user'),
(14, 'Annisasalsabila', '$2y$10$0All0LEnF0BPdE/oV4d/tefApkmy/DcNYNgZAJfIzIs/ZVs964lta', 'user');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
