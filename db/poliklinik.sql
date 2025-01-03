-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Jan 2025 pada 17.38
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `poliklinik`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftar_poli`
--

CREATE TABLE `daftar_poli` (
  `id` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `id_jadwal` int(11) NOT NULL,
  `keluhan` text NOT NULL,
  `no_antrian` int(11) DEFAULT NULL,
  `status_periksa` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `daftar_poli`
--

INSERT INTO `daftar_poli` (`id`, `id_pasien`, `id_jadwal`, `keluhan`, `no_antrian`, `status_periksa`) VALUES
(1, 7, 1, 'pusing', 1, '1'),
(2, 7, 10, 'cenut cenut', 1, '1'),
(3, 7, 10, 'sesak', 2, '1'),
(4, 23, 10, 'berdebar', 3, '1'),
(5, 5, 10, 'keringat dingin', 4, '0'),
(6, 5, 10, 'tertusuk', 5, '1'),
(7, 18, 12, 'cek kehamilan', 1, '1'),
(8, 18, 10, 'berdebar debar', 6, '0'),
(9, 18, 14, 'berdebar', 1, '0'),
(10, 18, 14, 'mual', 2, '0'),
(11, 26, 14, 'berdebar', 3, '1'),
(12, 7, 12, 'program hamil', 2, '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_periksa`
--

CREATE TABLE `detail_periksa` (
  `id` int(11) NOT NULL,
  `id_periksa` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_periksa`
--

INSERT INTO `detail_periksa` (`id`, `id_periksa`, `id_obat`) VALUES
(2, 5, 1),
(4, 7, 2),
(7, 8, 1),
(8, 4, 2),
(12, 6, 1),
(16, 9, 1),
(17, 9, 2),
(18, 10, 3),
(19, 11, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokter`
--

CREATE TABLE `dokter` (
  `id` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `no_hp` varchar(50) DEFAULT NULL,
  `id_poli` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('dokter') NOT NULL DEFAULT 'dokter'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `dokter`
--

INSERT INTO `dokter` (`id`, `nama`, `alamat`, `no_hp`, `id_poli`, `password`, `role`) VALUES
(1, 'drFarida', 'jl.merdeka pelajar', '0813324324324', 1, '32d4b77ebea7f1c5798381262b43c206', 'dokter'),
(2, 'zidni', 'jl pengurahan', '085553464774', 1, 'a9ea96e1d699281472715bfdb86a06ad', 'dokter'),
(3, 'rafi', 'jl mawar putih', '3463749', 1, '$2y$10$40e453/ySH4LE5jMY1HLkumFobIZdk3XSnQsUd/wFbwNVFMHDhDda', 'dokter'),
(10, 'acenk', 'aaaa', '4294967295', 1, '$2y$10$AMWCcKt0kBZQixaepMfYhOWeJEU1DdU3GG36wAkBA.q86L0KMT5pi', 'dokter'),
(13, 'ali', 'gdfgdgdfg', '087885343219', 1, '$2y$10$RPjwB4UD5rwO1e5lPnw10.SDxTRm2t59oPhy3e6OloEPbP2Aw.0iq', 'dokter'),
(14, 'adi', 'jl.imam bonjol', '87786666', 1, 'c46335eb267e2e1cde5b017acb4cd799', 'dokter'),
(15, 'dedi', 'jl.melayu', '0812297654213', 1, 'c5897fbcc14ddcf30dca31b2735c3d7e', 'dokter'),
(17, 'heri', 'jl. gasal', '081567678155', 1, '6812af90c6a1bbec134e323d7e70587b', 'dokter'),
(18, 'jordi', 'jl.malaya', '0896999779449', 3, '$2y$10$LclZISofWehfya/HqD9tKO7x7Sb6BN.xKkWu3z8N5x4ZN3ZC7l9kG', 'dokter'),
(20, 'valey', 'jl merpati', '0874564564', 3, '$2y$10$lE493oHGpZ2K3Qfac.mAyevB7BIqbBMbtXD.Pf9jhFA/krxzwXXta', 'dokter');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_periksa`
--

CREATE TABLE `jadwal_periksa` (
  `id` int(11) NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `hari` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu') NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `status` char(1) DEFAULT '2',
  `aktif` char(1) NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jadwal_periksa`
--

INSERT INTO `jadwal_periksa` (`id`, `id_dokter`, `hari`, `jam_mulai`, `jam_selesai`, `status`, `aktif`) VALUES
(1, 3, 'Senin', '15:00:00', '18:00:00', '2', 'N'),
(9, 3, 'Jumat', '08:00:00', '11:00:00', '2', 'N'),
(10, 3, 'Selasa', '14:00:00', '16:00:00', '2', 'N'),
(11, 3, 'Senin', '00:00:00', '03:00:00', '2', 'N'),
(12, 18, 'Senin', '08:00:00', '10:00:00', '2', '1'),
(13, 2, 'Senin', '09:00:00', '12:00:00', '2', '1'),
(14, 3, 'Senin', '08:00:00', '10:00:00', '2', '1'),
(15, 3, 'Sabtu', '08:00:00', '11:00:00', '2', 'N'),
(16, 3, 'Sabtu', '15:00:00', '17:00:00', '2', 'N'),
(17, 3, 'Rabu', '14:00:00', '16:00:00', '2', 'N');

-- --------------------------------------------------------

--
-- Struktur dari tabel `obat`
--

CREATE TABLE `obat` (
  `id` int(11) NOT NULL,
  `nama_obat` varchar(50) NOT NULL,
  `kemasan` varchar(35) DEFAULT NULL,
  `harga` int(10) UNSIGNED DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `obat`
--

INSERT INTO `obat` (`id`, `nama_obat`, `kemasan`, `harga`) VALUES
(1, 'atorvastatin', 'kaplet', 120000),
(2, 'simvastatin', 'kaplet', 150000),
(3, 'ibu profen', 'botol', 50000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE `pasien` (
  `id` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_ktp` varchar(50) DEFAULT NULL,
  `no_hp` varchar(50) DEFAULT NULL,
  `no_rm` char(10) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('pasien') NOT NULL DEFAULT 'pasien'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`id`, `nama`, `alamat`, `no_ktp`, `no_hp`, `no_rm`, `password`, `role`) VALUES
(5, 'alex', 'jl.mawar', '33240908070003', '087755674447', '082412-002', 'e10adc3949ba59abbe56e057f20f883e', 'pasien'),
(18, 'alaya', 'jl. melati', '3374023109990005', '0858885113445', '202412-003', 'e10adc3949ba59abbe56e057f20f883e', 'pasien'),
(19, 'alfi', 'jl.jambu', '3374052902270001', '0878816565113', '202412-004', 'b8aab85cb5b70a866972a694a27b7ed6', 'pasien'),
(20, 'faris', 'jl.melanding', '3374050813040001', '0856446766886', '202412-005', '7d77e825b80cff62a72e680c1c81424f', 'pasien'),
(21, 'faiz', 'jl.garuda', '337110809660002', '0811441677881', '202412-006', 'e10adc3949ba59abbe56e057f20f883e', 'pasien'),
(22, 'tea', 'jl.es', '335667766588865', '0822213452232', '202412-007', '7239ea2b5dc943f61f3c0a0276c20974', 'pasien'),
(23, 'alfred', 'jl pelat', '2342353464643636', '085746436436346', '202412-008', 'e10adc3949ba59abbe56e057f20f883e', 'pasien'),
(24, 'heli', 'jfdhdhf', '33754323524', '084456365252', '202412-009', 'bfbae0e563a0b07b7f14c781d375e5cd', 'pasien'),
(25, 'akil', 'jl gasem', '2543643636', '7456456757', '202412-010', 'e10adc3949ba59abbe56e057f20f883e', 'pasien'),
(26, 'alaya', 'jl belok', '33752984237235', '086856756757', '202412-011', '202cb962ac59075b964b07152d234b70', 'pasien');

-- --------------------------------------------------------

--
-- Struktur dari tabel `periksa`
--

CREATE TABLE `periksa` (
  `id` int(11) NOT NULL,
  `id_daftar_poli` int(11) NOT NULL,
  `tgl_periksa` datetime NOT NULL,
  `catatan` text NOT NULL,
  `biaya_periksa` int(11) DEFAULT NULL,
  `status_pembayaran` enum('Lunas','Belum Bayar') DEFAULT 'Belum Bayar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `periksa`
--

INSERT INTO `periksa` (`id`, `id_daftar_poli`, `tgl_periksa`, `catatan`, `biaya_periksa`, `status_pembayaran`) VALUES
(4, 1, '2024-12-25 00:00:00', 'tidur banyak', 300000, 'Belum Bayar'),
(5, 2, '2024-12-25 20:11:00', 'istirahat', 270000, 'Belum Bayar'),
(6, 4, '2024-12-26 01:47:00', 'perbanyak minum', 270000, 'Belum Bayar'),
(7, 3, '2024-12-25 01:53:00', 'tes', 300000, 'Belum Bayar'),
(8, 6, '2024-12-25 06:57:00', 'diminum tiap hari', 270000, 'Belum Bayar'),
(9, 11, '2024-12-30 13:52:00', 'perbanyak istirahat', 420000, 'Belum Bayar'),
(10, 7, '2024-12-30 15:04:00', 'istirahat\r\n', 200000, 'Belum Bayar'),
(11, 12, '2024-12-30 18:44:00', 'jangan kecapekan', 200000, 'Belum Bayar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `poli`
--

CREATE TABLE `poli` (
  `id` int(11) NOT NULL,
  `nama_poli` varchar(25) NOT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `poli`
--

INSERT INTO `poli` (`id`, `nama_poli`, `keterangan`) VALUES
(1, 'Jantung', 'menangani keluhan pada masalah jantung'),
(3, 'kandungan', 'menangani masalah seputar kandungan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin') NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role`) VALUES
(1, 'pei3', '$2y$10$CY0QT3ojDPs6bK/pAWXPGOw1ikzcWI//0sT84aH/fEQtNFs8LoMRC', 'admin'),
(2, 'pei', '$2y$10$3r9YUb8AZUlmeopnqwmxiO4bMFn.VSFyGij2W1uEwEqVMFYiATvuK', 'admin'),
(3, 'acenk', '$2y$10$HoDUf4J2xd//6mOJMHlQLuNBZP2ISa/hfCSJOLmmY7plXohgiHBw.', 'admin'),
(4, 'afel', '$2y$10$5rM7J.2eTefmYKijZIdDY.T3kOmZtRfLhmNjolVTxUOD9lElTeBCO', 'admin'),
(5, 'afla', '$2y$10$pvvkkvxsfP5GskSl3tpVjOUGNgOUJi25xXowmvNyJ/JJnYl8Nlgx6', 'admin'),
(6, 'alei', '$2y$10$1rkbq1I2UuFUNOGcGKJCJ.WnQGWTSplK2gHzsGSpxUvxNPioc35Lu', 'admin'),
(7, 'alfi', '$2y$10$YLG.5EWGcmU10AOPRpo8Iujq9VphpV.jmZ0ByqfxtHqC13sPoN3FO', 'admin'),
(8, 'pai', '$2y$10$Y28IQYAIBOhHBsedewe2m.vtpzVewwtmHdQjnc9Ej/2rbW.o6umZW', 'admin'),
(9, 'alfred', '$2y$10$SfU8ld7.cyBRmIVKdvpUK.sSD7rRzlOrzW7AM/EQ5G9bxEdpt5WTa', 'admin'),
(10, 'rafi', '$2y$10$GM1kqOl2diLqmTsFGvl75eOY/JV3DF/R.Do28woV44O44/xi.Bp96', 'admin'),
(11, 'albert', '$2y$10$Rhaj0lK6XR4bl9KHvjyXSuycC/RY4LHx7c0B7vyHP9mZzf0xzippe', 'admin'),
(12, 'cuenk', '$2y$10$JfFunYldq.ne9YgaBGxZjegsQK46jCv.WKhcBI7UxnCCHDj0vhaN2', 'admin'),
(13, 'ss', '$2y$10$5l5BEbcf.pexfUKO5U9GguVlFvQ3Lmdzr9gmZfoukSfBUpQ2zIxXO', 'admin'),
(14, 'mzrafi1708@gmail.com', '$2y$10$jjQ49X6jf//I/gz9RlRg8u.hgwRT2S6FyDHGB91FCuqQuX66wL7uC', 'admin'),
(15, 'agil', '$2y$10$SYOcLvLwadDZ.6G6ICxErO.M9QwW71BHhWOsFncTum9kzonSPZbeq', 'admin'),
(16, 'zaidan', '$2y$10$jSemjEbjYzqyw7zHOST0o.q.7HmznwavHyVPYQhVLRvukRoevY8S6', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `daftar_poli`
--
ALTER TABLE `daftar_poli`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pasien` (`id_pasien`),
  ADD KEY `id_jadwal` (`id_jadwal`);

--
-- Indeks untuk tabel `detail_periksa`
--
ALTER TABLE `detail_periksa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_periksa` (`id_periksa`),
  ADD KEY `id_obat` (`id_obat`);

--
-- Indeks untuk tabel `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_poli` (`id_poli`);

--
-- Indeks untuk tabel `jadwal_periksa`
--
ALTER TABLE `jadwal_periksa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_dokter` (`id_dokter`);

--
-- Indeks untuk tabel `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `periksa`
--
ALTER TABLE `periksa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_daftar_poli` (`id_daftar_poli`);

--
-- Indeks untuk tabel `poli`
--
ALTER TABLE `poli`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `daftar_poli`
--
ALTER TABLE `daftar_poli`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `detail_periksa`
--
ALTER TABLE `detail_periksa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `jadwal_periksa`
--
ALTER TABLE `jadwal_periksa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `obat`
--
ALTER TABLE `obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `periksa`
--
ALTER TABLE `periksa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `poli`
--
ALTER TABLE `poli`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `daftar_poli`
--
ALTER TABLE `daftar_poli`
  ADD CONSTRAINT `daftar_poli_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id`),
  ADD CONSTRAINT `daftar_poli_ibfk_2` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal_periksa` (`id`);

--
-- Ketidakleluasaan untuk tabel `detail_periksa`
--
ALTER TABLE `detail_periksa`
  ADD CONSTRAINT `detail_periksa_ibfk_1` FOREIGN KEY (`id_periksa`) REFERENCES `periksa` (`id`),
  ADD CONSTRAINT `detail_periksa_ibfk_2` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id`);

--
-- Ketidakleluasaan untuk tabel `dokter`
--
ALTER TABLE `dokter`
  ADD CONSTRAINT `dokter_ibfk_1` FOREIGN KEY (`id_poli`) REFERENCES `poli` (`id`);

--
-- Ketidakleluasaan untuk tabel `jadwal_periksa`
--
ALTER TABLE `jadwal_periksa`
  ADD CONSTRAINT `jadwal_periksa_ibfk_1` FOREIGN KEY (`id_dokter`) REFERENCES `dokter` (`id`);

--
-- Ketidakleluasaan untuk tabel `periksa`
--
ALTER TABLE `periksa`
  ADD CONSTRAINT `periksa_ibfk_1` FOREIGN KEY (`id_daftar_poli`) REFERENCES `daftar_poli` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
