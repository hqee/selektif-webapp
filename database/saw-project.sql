-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Bulan Mei 2025 pada 04.36
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!40101 SET NAMES utf8mb4 */
;
--
-- Database: `saw-project`
--
-- --------------------------------------------------------
--
-- Struktur dari tabel `kriteria`
--
CREATE TABLE `kriteria` (
    `id` int(11) NOT NULL,
    `nama_kriteria` varchar(100) DEFAULT NULL,
    `bobot` float DEFAULT NULL,
    `jenis` enum('benefit', 'cost') NOT NULL DEFAULT 'benefit'
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
--
-- Dumping data untuk tabel `kriteria`
--
INSERT INTO `kriteria` (`id`, `nama_kriteria`, `bobot`, `jenis`)
VALUES (1, 'Psikotes', 0.15, 'benefit'),
    (2, 'Wawancara', 0.35, 'benefit'),
    (3, 'Organisasi', 0.15, 'benefit'),
    (4, 'Penugasan', 0.35, 'benefit');
-- --------------------------------------------------------
--
-- Struktur dari tabel `nilai`
--
CREATE TABLE `nilai` (
    `id` int(11) NOT NULL,
    `peserta_id` int(11) DEFAULT NULL,
    `kriteria_id` int(11) DEFAULT NULL,
    `nilai` float DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
--
-- Dumping data untuk tabel `nilai`
--
INSERT INTO `nilai` (`id`, `peserta_id`, `kriteria_id`, `nilai`)
VALUES (1, 1, 1, 85),
    (2, 1, 2, 60),
    (3, 1, 3, 75),
    (4, 1, 4, 70),
    (5, 2, 1, 90),
    (6, 2, 2, 80),
    (7, 2, 3, 65),
    (8, 2, 4, 85),
    (9, 3, 1, 80),
    (10, 3, 2, 55),
    (11, 3, 3, 90),
    (12, 3, 4, 60),
    (13, 4, 1, 88),
    (14, 4, 2, 70),
    (15, 4, 3, 80),
    (16, 4, 4, 95),
    (17, 5, 1, 75),
    (18, 5, 2, 50),
    (19, 5, 3, 60),
    (20, 5, 4, 65),
    (21, 6, 1, 92),
    (22, 6, 2, 85),
    (23, 6, 3, 70),
    (24, 6, 4, 80),
    (29, 8, 1, 83),
    (30, 8, 2, 58),
    (31, 8, 3, 72),
    (32, 8, 4, 77),
    (33, 9, 1, 87),
    (34, 9, 2, 90),
    (35, 9, 3, 88),
    (36, 9, 4, 92),
    (37, 10, 1, 79),
    (38, 10, 2, 66),
    (39, 10, 3, 63),
    (40, 10, 4, 75),
    (41, 11, 1, 86),
    (42, 11, 2, 62),
    (43, 11, 3, 95),
    (44, 11, 4, 70),
    (45, 12, 1, 91),
    (46, 12, 2, 72),
    (47, 12, 3, 85),
    (48, 12, 4, 80),
    (49, 13, 1, 76),
    (50, 13, 2, 54),
    (51, 13, 3, 50),
    (52, 13, 4, 55),
    (53, 14, 1, 84),
    (54, 14, 2, 60),
    (55, 14, 3, 66),
    (56, 14, 4, 78),
    (61, 16, 1, 60),
    (62, 16, 2, 80),
    (63, 16, 3, 90),
    (64, 16, 4, 75);
-- --------------------------------------------------------
--
-- Struktur dari tabel `peserta`
--
CREATE TABLE `peserta` (
    `id` int(11) NOT NULL,
    `nama` varchar(100) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
--
-- Dumping data untuk tabel `peserta`
--
INSERT INTO `peserta` (`id`, `nama`)
VALUES (1, 'Andi'),
    (2, 'Budi'),
    (3, 'Citra'),
    (4, 'Dedi'),
    (5, 'Eka'),
    (6, 'Fajar'),
    (8, 'Hana'),
    (9, 'Irfan'),
    (10, 'Joko'),
    (11, 'Kiki'),
    (12, 'Lina'),
    (13, 'Miko'),
    (14, 'Nina'),
    (16, 'Fawaz');
--
-- Indexes for dumped tables
--
--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
ADD PRIMARY KEY (`id`);
--
-- Indeks untuk tabel `nilai`
--
ALTER TABLE `nilai`
ADD PRIMARY KEY (`id`),
    ADD KEY `peserta_id` (`peserta_id`),
    ADD KEY `kriteria_id` (`kriteria_id`);
--
-- Indeks untuk tabel `peserta`
--
ALTER TABLE `peserta`
ADD PRIMARY KEY (`id`);
--
-- AUTO_INCREMENT untuk tabel yang dibuang
--
--
-- AUTO_INCREMENT untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 5;
--
-- AUTO_INCREMENT untuk tabel `nilai`
--
ALTER TABLE `nilai`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 65;
--
-- AUTO_INCREMENT untuk tabel `peserta`
--
ALTER TABLE `peserta`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 17;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--
--
-- Ketidakleluasaan untuk tabel `nilai`
--
ALTER TABLE `nilai`
ADD CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`peserta_id`) REFERENCES `peserta` (`id`),
    ADD CONSTRAINT `nilai_ibfk_2` FOREIGN KEY (`kriteria_id`) REFERENCES `kriteria` (`id`);
COMMIT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;