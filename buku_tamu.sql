-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 31 Jan 2025 pada 04.09
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
-- Database: `buku_tamu`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `asn`
--

CREATE TABLE `asn` (
  `id_asn` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `nip` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `asn`
--

INSERT INTO `asn` (`id_asn`, `id_pegawai`, `nip`) VALUES
(1, 1, '19740202 199303 1 007'),
(2, 2, '19730828 200312 1 003'),
(3, 3, '19791007 199810 2 001'),
(4, 4, '19800213 200901 1 001'),
(5, 5, '19780911 200701 2 001'),
(6, 6, '19860829 201505 2 001'),
(7, 7, '19740927 199803 1 010'),
(8, 8, '19800221 201101 2 004'),
(9, 9, '19870309 201001 2 018'),
(10, 10, '19810913 200604 2 005'),
(11, 11, '19820815 201001 2 2014'),
(12, 12, '19781003 200502 2 004'),
(13, 13, '19721009 200604 1 003'),
(14, 14, '19800305 201101 2 004'),
(15, 15, '19810603 200604 2 015'),
(16, 16, '19761110 200902 2 001'),
(17, 17, '19680110 199903 2 001'),
(18, 18, '19730627 200604 2 001'),
(19, 19, '19750613 200901 2 001'),
(20, 20, '19820404 200312 1 004'),
(21, 21, '19881230 201503 2 004'),
(22, 22, '19810111 200502 2 002'),
(23, 23, '19770304 200502 1 002'),
(24, 24, '19700211 200502 1 001'),
(25, 25, '19800529 201101 2 003'),
(26, 26, '19701010 200212 1 006'),
(27, 27, '19790128 200903 1 001'),
(28, 28, '19790404 201101 2 002'),
(29, 29, '19670203 198603 1 007'),
(30, 30, '19680120 199803 2 001'),
(31, 31, '19830512 200112 2 003'),
(32, 32, '19830927 201101 2 005'),
(33, 33, '19810202 201212 1 004'),
(34, 34, '19701202 20091 2 003'),
(35, 35, '19940504 201609 2 002'),
(36, 36, '19670805 200312 1 001'),
(37, 37, '19710428 200502 2 001'),
(38, 38, '19861030 201001 2 023'),
(39, 39, '19791025 201001 1 012'),
(40, 40, '19740602 199302 1 001'),
(41, 41, '19830627 201001 1 022'),
(42, 42, '19770508 200312 1 009'),
(43, 43, '19830813 201101 1 002'),
(44, 44, '19800903 200902 2 001'),
(45, 45, '19761209 200502 2 001'),
(46, 46, '19770327 200801 1 014'),
(47, 47, '19760128 199703 2 001'),
(48, 48, '19790322 200604 2 010'),
(49, 49, '19770629 200801 2 004'),
(50, 50, '19850829 200902 2 004'),
(51, 51, '19760704 200801 1 003'),
(52, 52, '19720810 199103 1 001'),
(53, 53, '19790411 200901 2 001'),
(54, 54, '19770812 201101 1 004'),
(55, 55, '19850505 201101 1 004'),
(56, 56, '19771230 200604 2 010'),
(57, 57, '19900525 201101 2 003'),
(58, 58, '19810608 200604 2 008'),
(59, 59, '19811209 201101 2 006'),
(60, 60, '19831202 201101 2 015'),
(61, 61, '19850506 201001 2 027'),
(62, 62, '19860619 201212 2 002'),
(63, 63, '19770803 201101 1 005'),
(64, 64, '19751023 200903 2 001'),
(65, 65, '19831006 200502 2 001'),
(66, 66, '19790712 2012 1 003'),
(67, 67, '19760716 200901 1 001'),
(68, 68, '19741001 200604 1 002'),
(69, 69, '19780509 200502 2 002'),
(70, 70, '19800504 200604 2 011'),
(71, 71, '19800729 200502 1 001'),
(72, 72, '19751126 200312 1 003'),
(73, 73, '19690710 199803 1 022'),
(74, 74, '19740512 200604 2 003'),
(75, 75, '19760112 200804 2 001'),
(76, 76, '19730329 200801 1 001'),
(77, 77, '19760306 200901 2 001'),
(78, 78, '19780402 200604 2 001'),
(79, 79, '19841119 200804 2 001'),
(80, 80, '19770403 200502 1 001');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_tamu`
--

CREATE TABLE `jenis_tamu` (
  `id_jenis_tamu` int(11) NOT NULL,
  `jenis_tamu` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kunjungan`
--

CREATE TABLE `kunjungan` (
  `id_kunjungan` int(11) NOT NULL,
  `tanggal_kunjungan` date NOT NULL,
  `jam_kunjungan` time NOT NULL,
  `id_tamu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tamu`
--

CREATE TABLE `tamu` (
  `id_tamu` int(11) NOT NULL,
  `nomor_identitas` varchar(16) NOT NULL,
  `nama_tamu` varchar(100) DEFAULT NULL,
  `gender` char(12) NOT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `id_jenis_tamu` int(11) DEFAULT NULL,
  `asal_instansi` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `id_keperluan` int(11) NOT NULL,
  `keterangan_keperluan` text NOT NULL,
  `status_notifikasi` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jabatan`
--

CREATE TABLE `tbl_jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `jabatan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_jabatan`
--

INSERT INTO `tbl_jabatan` (`id_jabatan`, `jabatan`) VALUES
(1, 'Sekretaris'),
(2, 'Kepala Sub Bagian Umum dan Kepegawaian'),
(3, 'Perancang Kebijakan Pengadaan Barang/Jasa'),
(4, 'Analis Tata Usaha'),
(5, 'Analis Layanan Umum'),
(6, 'Pengadministrasi Kepegawaian'),
(7, 'Pengelola Kepegawaian'),
(8, 'Pengadministrasi Persuratan'),
(9, 'Pemeriksa Laporan dan Transaksi Keuangan'),
(10, 'Pengolah Daftar Gaji'),
(11, 'Bendahara'),
(12, 'Pengelola Data Belanja dan Laporan Keuangan Sub Bagian Keuangan'),
(13, 'Perencana Ahli Muda'),
(14, 'Analisis Penanaman Modal'),
(15, 'Analis Perencanaan'),
(16, 'Pengelola Data dan Informasi'),
(17, 'Analis Kebijakan Ahli Muda Sub Koordinator Perencanaan Penanaman Modal'),
(18, 'Analis Perekonomian'),
(19, 'Analis Kebijakan Ahli Muda Sub Koordinator Pengkajian Pengembangan Potensi dan Kewilayahan'),
(20, 'Analis Peraturan Investasi'),
(21, 'Analis Kebijakan Ahli Muda Sub Koordinator Pengolahan Data dan Informasi'),
(22, 'Analis Iklim Usaha dan Kerjasama'),
(23, 'Kabid. Promosi'),
(24, 'Analis Kebijakan Ahli Muda Sub Koordinator Pengembangan Promosi'),
(25, 'Penyusun Rencana Promosi'),
(26, 'Penyusun Rencana Kebutuhan Sarana dan Prasarana'),
(27, 'Pengelola Data Layanan Publik dan Hubungan Investor'),
(28, 'Analis Peraturan Iklim Usaha'),
(29, 'Pelaksana Sub Koordinator Pengawasan dan Pengendalian, Sub Koordinator Pengaduan dan Advokasi Bidang Pengawasan dan Pengendalian'),
(30, 'Pemeriksa Penanaman Modal'),
(31, 'Analis Kebijakan Ahli Muda Sub Koordinator Monitoring dan Evaluasi'),
(32, 'Kepala Dinas Penanaman Modal dan PTSP'),
(35, 'Pengelola Perizinan'),
(36, 'Penata Perizinan Ahli Madya'),
(37, 'Analisis Dokumen Perizinan'),
(38, 'Analis Kebijakan Ahli Muda Sub Koordinator Pelayanan Perizinan Sumber Daya Mineral'),
(39, 'Penata Perizinan Ahli Muda'),
(40, 'Pengadministrasi Perkantoran'),
(41, 'Analis Kebijakan Ahli Muda Sub Koordinator Pelayanan PU, Perhubungan dan Kominfo'),
(42, 'Front Office'),
(43, 'Front Office (OSS)'),
(44, 'Analis Sistem Madya'),
(45, 'Operator Komputer'),
(46, 'Tenaga Ahli Peningkatan Kesediaan Layanan Peta Potensi dan Peluang Bidang Rembang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_keperluan`
--

CREATE TABLE `tbl_keperluan` (
  `id_keperluan` int(11) NOT NULL,
  `jenis_keperluan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_keperluan`
--

INSERT INTO `tbl_keperluan` (`id_keperluan`, `jenis_keperluan`) VALUES
(1, 'Kunjungan Dinas'),
(2, 'Kunjungan non Dinas'),
(3, 'Konsultasi'),
(4, 'Permohonan Informasi PPID'),
(5, 'Permohonan Informasi PB/B UMKU'),
(6, 'Pengurusan PB/PB UMKU'),
(7, 'Pengaduan Masyarakat'),
(8, 'Lainnya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_login`
--

CREATE TABLE `tbl_login` (
  `id_login` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_pegawai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pegawai`
--

CREATE TABLE `tbl_pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nama_pegawai` varchar(255) NOT NULL,
  `status` enum('ASN','Outsourcing','','') NOT NULL,
  `id_jabatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_pegawai`
--

INSERT INTO `tbl_pegawai` (`id_pegawai`, `nama_pegawai`, `status`, `id_jabatan`) VALUES
(1, 'Dr. H. Faisal Arif Nasution S.SoS, M.Si', 'ASN', 32),
(2, 'Bisman Agus, ST., M.SE., MPP', 'ASN', 1),
(3, 'Masyithah, SAP', 'ASN', 2),
(4, 'Robert Manurung, ST', 'ASN', 3),
(5, 'Jojor Nuriati Silalahi, SE', 'ASN', 4),
(6, 'Gita Alfiani Fatria, SE. M.Si', 'ASN', 5),
(7, 'Ahmad Khadafi', 'ASN', 6),
(8, 'Yurifta Amelia, A.Md', 'ASN', 7),
(9, 'Pretti D. Tambunan, A.Md', 'ASN', 8),
(10, 'Muliani S.Sos., M.SP', 'ASN', 9),
(11, 'Fitria Lubis, SE, M.Ak', 'ASN', 9),
(12, 'Sefri Simanjuntak, A.Md', 'ASN', 10),
(13, 'Ricky Ramadhan, SS', 'ASN', 9),
(14, 'Mira Andini, A.Md', 'ASN', 11),
(15, 'Sri Wahyuningsih, A.Md', 'ASN', 12),
(16, 'Romauli Sitanggang, A.Md', 'ASN', 12),
(17, 'Hotmawaty L. Pakpahan, SE, M.Si', 'ASN', 13),
(18, 'Sri Melly Bukit, S.Sos', 'ASN', 14),
(19, 'Karmila Sari Br. Sitepu, SE, M.AP', 'ASN', 15),
(20, 'David Pancaputra Poltak Sianipar, A.Md', 'ASN', 16),
(21, 'Dessy Monica Evalina, SH', 'ASN', 17),
(22, 'Ria Adelina Manurung, S.Hut', 'ASN', 18),
(23, 'Omar Arafat Sudjono, ST', 'ASN', 19),
(24, 'Parulian F.R. Sihotang, S.Kom', 'ASN', 15),
(25, 'Halimatus Saddiah Marpaung, SH', 'ASN', 20),
(26, 'Ali Syahbana H. Harahap, SH', 'ASN', 21),
(27, 'Royal T.H. Sitanggang, SE', 'ASN', 22),
(28, 'Novita Amrah, S.S', 'ASN', 20),
(29, 'Drs. Damar Wulan', 'ASN', 23),
(30, 'Ir. Siti Zaleha, M.Si', 'ASN', 24),
(31, 'Seiska Handayani', 'ASN', 8),
(32, 'Renata D.M. Butar-Butar, SS', 'ASN', 25),
(33, 'Fanda Syahputra Lubis, ST', 'ASN', 26),
(34, 'Ritayani Sukma, A.Md', 'ASN', 27),
(35, 'Nita Chartlan, S.IP', 'ASN', 25),
(36, 'Agus Linggom, ST. MH', 'ASN', 28),
(37, 'Jojor Karyawati Berutu, SE', 'ASN', 28),
(38, 'Margaret Caroline, SE', 'ASN', 28),
(39, 'Syahrul Fauzi, S. Ip', 'ASN', 28),
(40, 'Ahmad Yasir Arafat Nasution, S.Sos, MM', 'ASN', 29),
(41, 'Bonar Tota P. Sianturi, SH', 'ASN', 28),
(42, 'Ridwan Mandalaga, SE', 'ASN', 22),
(43, 'Fandy Enko Irwanto S. SH', 'ASN', 15),
(44, 'Saurlina Sihombing, A.Md', 'ASN', 27),
(45, 'Evayanti Panjaitan, SE', 'ASN', 31),
(46, 'Muhammad Ali Syamsuddin, SE', 'ASN', 30),
(47, 'Ulihon Manullang, SE', 'ASN', 30),
(48, 'Sangkot Ariani Rambe, S.Sos, MSP', 'ASN', 30),
(49, 'Elvi Zahara, ST', 'ASN', 30),
(50, 'Fransiska Sagala, A.Md', 'ASN', 35),
(51, 'Andreas Frinandus Salmon Tampubolon', 'ASN', 8),
(52, 'Abdul Aziz, S.Sos. MAP', 'ASN', 36),
(53, 'Son Syahfera, Simatupang, ST, MM', 'ASN', 37),
(54, 'Faizal Nasution, ST', 'ASN', 38),
(55, 'Yoyon Haryono, S.Kom', 'ASN', 39),
(56, 'Evi Tiurmida, SE', 'ASN', 39),
(57, 'Mey Royani M. Purba, SE', 'ASN', 37),
(58, 'Indah M. Simarmata, SE', 'ASN', 37),
(59, 'Cut Deby Andayani, ST ., M.Si', 'ASN', 39),
(60, 'Gita Amalia, SS, M.Si', 'ASN', 37),
(61, 'Radna Dewi, ST, M.Si', 'ASN', 37),
(62, 'Yunita Sahfitri', 'ASN', 8),
(63, 'Solo P, ST', 'ASN', 39),
(64, 'Olivia Maria M. Panjaitan, SE', 'ASN', 37),
(65, 'Nelly Marisi Situmeang, S.Si., M.Si', 'ASN', 37),
(66, 'Muhammad Rizky Salman', 'ASN', 40),
(67, 'Golongan Kemit, ST', 'ASN', 39),
(68, 'Haksa Romatua Pohan, SS, M.Si', 'ASN', 41),
(69, 'Nurbaya Surbakti, ST', 'ASN', 37),
(70, 'Intan Mustika Sari, A.Md', 'ASN', 35),
(71, 'Chandra Fadillah Duha', 'ASN', 8),
(72, 'Syufril Bing S. Pasaribu, SE', 'ASN', 39),
(73, 'Julianto, SKM', 'ASN', 37),
(74, 'Jariani, ST', 'ASN', 37),
(75, 'Mawar Sitorus, A.Md', 'ASN', 35),
(76, 'Juti Tumpahan Sijabat, S.Si', 'ASN', 39),
(77, 'Delfidawati, ST, M.Si', 'ASN', 37),
(78, 'Donda M. Sihite, SE', 'ASN', 37),
(79, 'Novawati Siregar, SS', 'ASN', 37),
(80, 'Edward Moring, SE', 'ASN', 37),
(81, 'Alda Ardilla, SE', 'Outsourcing', 42),
(82, 'Sheila Namira, SH., M.Kn', 'Outsourcing', 42),
(83, 'Fachri Ali Fauzi, S.P', 'Outsourcing', 42),
(84, 'Yanda Khalisa Lubis, S.P', 'Outsourcing', 42),
(85, 'Muhammad Fadlan Fadilah Lubis, SH', 'Outsourcing', 43),
(86, 'Ninda Nur\'asbah Siregar, S.AP', 'Outsourcing', 42),
(87, 'M. Hudzaifah, S.T., C.DMS', 'Outsourcing', 44),
(88, 'Divi Handoko Nasution, S.T., M.Kom', 'Outsourcing', 44),
(89, 'John Wesley Manurung, A.Md', 'Outsourcing', 45),
(90, 'Ely Afrilia, S.T', 'Outsourcing', 45),
(91, 'M. Rojih Zevita Rambe, S.Ak', 'Outsourcing', 45),
(92, 'Abdillah Rio Putra, S.T', 'Outsourcing', 45),
(93, 'Nita Asyari, S.Kom', 'Outsourcing', 45),
(94, 'Muhammad Abdan Rosadi', 'Outsourcing', 45),
(95, 'Juliandri, S.Kom., M.Kom', 'Outsourcing', 46);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `view_asn`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `view_asn` (
`id_asn` int(11)
,`nip` varchar(50)
,`id_pegawai` int(11)
,`nama_pegawai` varchar(255)
,`status` enum('ASN','Outsourcing','','')
,`nama_jabatan` text
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `view_honorer`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `view_honorer` (
`id_pegawai` int(11)
,`nama_pegawai` varchar(255)
,`status` enum('ASN','Outsourcing','','')
,`nama_jabatan` text
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `view_pegawai`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `view_pegawai` (
`id_pegawai` int(11)
,`nama_pegawai` varchar(255)
,`status` enum('ASN','Outsourcing','','')
,`nama_jabatan` text
);

-- --------------------------------------------------------

--
-- Struktur untuk view `view_asn`
--
DROP TABLE IF EXISTS `view_asn`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_asn`  AS SELECT `a`.`id_asn` AS `id_asn`, `a`.`nip` AS `nip`, `p`.`id_pegawai` AS `id_pegawai`, `p`.`nama_pegawai` AS `nama_pegawai`, `p`.`status` AS `status`, `j`.`jabatan` AS `nama_jabatan` FROM ((`asn` `a` join `tbl_pegawai` `p` on(`a`.`id_pegawai` = `p`.`id_pegawai`)) join `tbl_jabatan` `j` on(`p`.`id_jabatan` = `j`.`id_jabatan`)) WHERE `p`.`status` = 'ASN' ORDER BY `p`.`id_pegawai` ASC ;

-- --------------------------------------------------------

--
-- Struktur untuk view `view_honorer`
--
DROP TABLE IF EXISTS `view_honorer`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_honorer`  AS SELECT `p`.`id_pegawai` AS `id_pegawai`, `p`.`nama_pegawai` AS `nama_pegawai`, `p`.`status` AS `status`, `j`.`jabatan` AS `nama_jabatan` FROM (`tbl_pegawai` `p` join `tbl_jabatan` `j` on(`p`.`id_jabatan` = `j`.`id_jabatan`)) WHERE `p`.`status` <> 'ASN' ;

-- --------------------------------------------------------

--
-- Struktur untuk view `view_pegawai`
--
DROP TABLE IF EXISTS `view_pegawai`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_pegawai`  AS SELECT `p`.`id_pegawai` AS `id_pegawai`, `p`.`nama_pegawai` AS `nama_pegawai`, `p`.`status` AS `status`, `j`.`jabatan` AS `nama_jabatan` FROM (`tbl_pegawai` `p` join `tbl_jabatan` `j` on(`p`.`id_jabatan` = `j`.`id_jabatan`)) ORDER BY `p`.`id_pegawai` ASC ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `asn`
--
ALTER TABLE `asn`
  ADD PRIMARY KEY (`id_asn`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indeks untuk tabel `jenis_tamu`
--
ALTER TABLE `jenis_tamu`
  ADD PRIMARY KEY (`id_jenis_tamu`);

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
  ADD KEY `id_jenis_tamu` (`id_jenis_tamu`),
  ADD KEY `fk_id_keperluan` (`id_keperluan`);

--
-- Indeks untuk tabel `tbl_jabatan`
--
ALTER TABLE `tbl_jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indeks untuk tabel `tbl_keperluan`
--
ALTER TABLE `tbl_keperluan`
  ADD PRIMARY KEY (`id_keperluan`);

--
-- Indeks untuk tabel `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD PRIMARY KEY (`id_login`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indeks untuk tabel `tbl_pegawai`
--
ALTER TABLE `tbl_pegawai`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD KEY `id_jabatan` (`id_jabatan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `asn`
--
ALTER TABLE `asn`
  MODIFY `id_asn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT untuk tabel `jenis_tamu`
--
ALTER TABLE `jenis_tamu`
  MODIFY `id_jenis_tamu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_jabatan`
--
ALTER TABLE `tbl_jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT untuk tabel `tbl_keperluan`
--
ALTER TABLE `tbl_keperluan`
  MODIFY `id_keperluan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_pegawai`
--
ALTER TABLE `tbl_pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `asn`
--
ALTER TABLE `asn`
  ADD CONSTRAINT `asn_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `tbl_pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kunjungan`
--
ALTER TABLE `kunjungan`
  ADD CONSTRAINT `kunjungan_ibfk_1` FOREIGN KEY (`id_tamu`) REFERENCES `tamu` (`id_tamu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tamu`
--
ALTER TABLE `tamu`
  ADD CONSTRAINT `fk_id_keperluan` FOREIGN KEY (`id_keperluan`) REFERENCES `tbl_keperluan` (`id_keperluan`);

--
-- Ketidakleluasaan untuk tabel `tbl_pegawai`
--
ALTER TABLE `tbl_pegawai`
  ADD CONSTRAINT `tbl_pegawai_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `tbl_jabatan` (`id_jabatan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
