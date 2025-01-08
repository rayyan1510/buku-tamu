-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Jan 2025 pada 04.14
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
-- Database: `buku_tamu`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_tamu`
--

CREATE TABLE `jenis_tamu` (
  `id_jenisTamu` int(11) NOT NULL,
  `jenis_tamu` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `keperluan`
--

CREATE TABLE `keperluan` (
  `id_keperluan` int(11) NOT NULL,
  `deskripsi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kunjungan`
--

CREATE TABLE `kunjungan` (
  `id_kunjungan` int(11) NOT NULL,
  `tanggal_kunjungan` date NOT NULL,
  `id_tamu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tamu`
--

CREATE TABLE `tamu` (
  `id_tamu` int(11) NOT NULL,
  `nama_tamu` varchar(100) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `id_keperluan` int(11) DEFAULT NULL,
  `id_jenisTamu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jabatan` enum('Fo','Kadis','Staf','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `jabatan`) VALUES
(1, 'farhan', 'd1bbb2af69fd350b6d6bd88655757b47', 'farhan', 'Staf'),
(2, 'dimas', '7d49e40f4b3d8f68c19406a58303f826', 'dimas', 'Fo'),
(3, 'ichan', 'ff53c790f13053b325b498b70e352d58', 'ichan', 'Kadis'),
(4, 'rayyan', '62ed597b338095651312245f2063ef2a', 'rayyan', 'Staf');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `jenis_tamu`
--
ALTER TABLE `jenis_tamu`
  ADD PRIMARY KEY (`id_jenisTamu`);

--
-- Indeks untuk tabel `keperluan`
--
ALTER TABLE `keperluan`
  ADD PRIMARY KEY (`id_keperluan`);

--
-- Indeks untuk tabel `kunjungan`
--
ALTER TABLE `kunjungan`
  ADD PRIMARY KEY (`id_kunjungan`),
  ADD KEY `id_tamu` (`id_tamu`);

--
-- Indeks untuk tabel `tamu`
--
ALTER TABLE `tamu`
  ADD PRIMARY KEY (`id_tamu`),
  ADD KEY `id_keperluan` (`id_keperluan`),
  ADD KEY `id_jenisTamu` (`id_jenisTamu`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `jenis_tamu`
--
ALTER TABLE `jenis_tamu`
  MODIFY `id_jenisTamu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `keperluan`
--
ALTER TABLE `keperluan`
  MODIFY `id_keperluan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kunjungan`
--
ALTER TABLE `kunjungan`
  MODIFY `id_kunjungan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tamu`
--
ALTER TABLE `tamu`
  MODIFY `id_tamu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `kunjungan`
--
ALTER TABLE `kunjungan`
  ADD CONSTRAINT `kunjungan_ibfk_1` FOREIGN KEY (`id_tamu`) REFERENCES `tamu` (`id_tamu`);

--
-- Ketidakleluasaan untuk tabel `tamu`
--
ALTER TABLE `tamu`
  ADD CONSTRAINT `tamu_ibfk_1` FOREIGN KEY (`id_keperluan`) REFERENCES `keperluan` (`id_keperluan`),
  ADD CONSTRAINT `tamu_ibfk_2` FOREIGN KEY (`id_jenisTamu`) REFERENCES `jenis_tamu` (`id_jenisTamu`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
