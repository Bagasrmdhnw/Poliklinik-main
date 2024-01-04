-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2024 at 06:16 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `poli`
--

-- --------------------------------------------------------

--
-- Table structure for table `daftar_poli`
--

CREATE TABLE `daftar_poli` (
  `id` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `id_jadwal` int(11) NOT NULL,
  `keluhan` text NOT NULL,
  `no_antrian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `daftar_poli`
--

INSERT INTO `daftar_poli` (`id`, `id_pasien`, `id_jadwal`, `keluhan`, `no_antrian`) VALUES
(1, 2, 6, 'Pusing dan Mual', 1),
(2, 1, 6, 'Pusing dan Badan Dingin', 2),
(3, 3, 4, 'Perih Bagian Dalam ', 3),
(4, 4, 5, 'Cabut gigi ', 4),
(5, 5, 1, 'Panas Dingin', 5),
(6, 6, 6, 'Panas , Pilex , Batuk', 6),
(7, 7, 2, 'Batuk Berdahak , Dada Sesak', 7),
(8, 8, 3, 'Mata Merah , Nyeri', 8),
(9, 9, 7, 'Check up rutin kandungan', 9),
(10, 10, 8, 'Pusing dan Batuk', 10),
(11, 11, 9, 'Check up rutin', 11);

-- --------------------------------------------------------

--
-- Table structure for table `detail_periksa`
--

CREATE TABLE `detail_periksa` (
  `id` int(11) NOT NULL,
  `id_periksa` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_periksa`
--

INSERT INTO `detail_periksa` (`id`, `id_periksa`, `id_obat`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 2),
(4, 4, 3),
(5, 5, 2),
(6, 6, 1),
(7, 7, 6),
(8, 8, 5),
(9, 9, 6),
(10, 10, 4),
(11, 11, 3);

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `id_poli` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`id`, `nama`, `nip`, `password`, `alamat`, `no_hp`, `id_poli`) VALUES
(1, 'Dr. Farhan', '10111', '$2y$10$SHxyzQXGXUi29IqeAHanUev9HhLPeXxBPmIqPW3v1Zm0yjHSoUW.O', 'Jl. Bandungan RT 02 RW 01 no.21 Kec.Gajahmungkur Kab.Semarang', '081462226835', 1),
(2, 'Dr. Sri winarno', '10112', '$2y$10$mxcJ8dEe0wPZ5rp2l/plSezvmpXli.gaw/yi7zNzQHssM8knP.CbC', 'Jl. Bandungan RT 02 RW 01 no.22 Kec.Gajahmungkur Kab.Semarang', '081462226836', 2),
(3, 'Dr. Ricardus', '10113', '$2y$10$DjovYT7OQ0abQzYm5hqm2uqqwtJrwVHdD0GztmMhOI9Ryw3nyNljq', 'Jl. Bandungan RT 02 RW 01 no.21 Kec.Gajahmungkur Kab.Semarang Timur', '081462226837', 3),
(4, 'Dr. Minari', '10114', '$2y$10$3rEpqWpKlZHX05VNw7SSFuU6qoP/XTz5biVj6x.0g7r1OIWsaDNhG', 'Jl. Bandungan RT 02 RW 01 no.22 Kec.Gajahmungkur Kab.Semarang Timur', '081462226838', 4),
(5, 'Dr. Evi Nirmala S', '10115', '$2y$10$d4cWgMoAQCYC2fydvXhHDOYJq9rOnT7IPN9yyxDFGBnUbd7KF/sGG', 'Jl. Bandungan RT 02 RW 01 no.21 Kec.Gajahmungkur Kab.Semarang Barat', '081462226839', 5),
(6, 'Dr . Rizal', '10116', '$2y$10$62ZHLF.LO0D.fjdC0SM3fu51u.8A.4zBb3Kv2Vg12juLowoQAT7MW', 'Jl. Bandungan RT 02 RW 01 no.22 Kec.Gajahmungkur Kab.Semarang Barat', '081462226840', 6),
(7, 'Dr. Tania', '10117', '$2y$10$jVbQbapY1KQi4TnF.uwdXuOUxFTm/1t.m.rSL8B5HFkYRwSYkPsNS', 'Jl. Bandungan RT 02 RW 01 no.21 Kec.Gajahmungkur Kab.Semarang', '081462226841', 7),
(8, 'Dr .Ina Risada', '10118', '$2y$10$VFXn5tF3z.E74OTAVmlcLOXzcppyukTGsvYWveWuht/qjJ1vY5Y6K', 'Jl. Bandungan RT 02 RW 01 no.21 Kec.Gajahmungkur Kab.Semarang', '081462226837', 7),
(9, 'Dr. Niken', '10119', '$2y$10$hjKyXxqFZyvhUaa0lxL3deH6P3uNF8daMGvryhEAUUNRJ1STPkLsS', 'Jl. Bandungan RT 02 RW 01 no.21 Kec.Gajahmungkur Kab.Semarang', '081462226835', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_periksa`
--

CREATE TABLE `jadwal_periksa` (
  `id` int(11) NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `hari` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu') NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal_periksa`
--

INSERT INTO `jadwal_periksa` (`id`, `id_dokter`, `hari`, `jam_mulai`, `jam_selesai`) VALUES
(1, 1, 'Senin', '08:00:00', '10:00:00'),
(2, 2, 'Selasa', '13:00:00', '15:00:00'),
(3, 3, 'Rabu', '10:00:00', '12:00:00'),
(4, 4, 'Kamis', '13:00:00', '15:00:00'),
(5, 5, 'Kamis', '08:00:00', '11:00:00'),
(6, 6, 'Jumat', '13:00:00', '15:30:00'),
(7, 7, 'Sabtu', '08:00:00', '10:00:00'),
(8, 9, 'Rabu', '08:00:00', '10:00:00'),
(9, 8, 'Selasa', '08:00:00', '10:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `id` int(11) NOT NULL,
  `nama_obat` varchar(50) NOT NULL,
  `kemasan` varchar(35) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id`, `nama_obat`, `kemasan`, `harga`) VALUES
(1, 'Paramex', 'Strip', 5000),
(2, 'Sanmol', 'Botol', 3000),
(3, 'Inasito', 'Tetes', 20000),
(4, 'Paracetamol', 'Blister', 10000),
(5, 'Amoxilin', 'Blister', 8000),
(6, 'Alopurinol', 'Tablet', 16000),
(7, 'Aminofilin', 'Ampul', 8000),
(8, 'Clobazam ', 'Blister', 50000),
(9, 'Bromheksin', 'Blister', 30000);

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_ktp` varchar(255) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `no_rm` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id`, `nama`, `alamat`, `no_ktp`, `no_hp`, `no_rm`) VALUES
(1, 'Basuki', 'Jl. Bandungan RT 02 RW 01 no.24 Kec.Gajahmungkur Kab.Semarang', '3328101999116', '081462226831', '202401-001'),
(2, 'Wadiman', 'Jl. Bandungan RT 02 RW 01 no.22 Kec. Kebon Jeruk Kab.Semarang', '3328101999117', '081462226842', '202401-002'),
(3, 'Fajri', 'Jl. Bandungan RT 02 RW 01 no.21 Kec.Gajahmungkur Kab.Semarang', '3328101999118', '081462226839', '202401-003'),
(4, 'Maman Sukiman', 'Jl. Bandungan RT 02 RW 01 no.22 Kec.Gajahmungkur Kab.Semarang Timur', '3328101999119', '081462226844', '202401-004'),
(5, 'Anna', 'Jl. Bandungan RT 02 RW 01 no.21 Kec.Gajahmungkur Kab.Semarang Timur', '3328101999120', '081462226839', '202401-005'),
(6, 'Munawir', 'Jl. Bandungan RT 02 RW 01 no.25 Kec.Gajahmungkur Kab.Semarang', '3328101999121', '081462226850', '202401-006'),
(7, 'Parman', 'Jl. Bandungan RT 02 RW 01 no.21 Kec.Gajahmungkur Kab.Semarang ', '3328101999122', '081462226851', '202401-007'),
(8, 'Pardi', 'Jl. Bandungan RT 02 RW 01 no.21 Kec.Gajahmungkur Kab.Semarang', '3328101999123', '081462226840', '202401-008'),
(9, 'Shinta Azzahra', 'Jl. Bandungan RT 02 RW 01 no.21 Kec.Gajahmungkur Kab.Semarang', '3328101999124', '081462226836', '202401-009'),
(10, 'Riska', 'Jl. Bandungan RT 02 RW 01 no.21 Kec.Gajahmungkur Kab.Semarang', '3328101999125', '081462226835', '202401-010'),
(11, 'Sinta komala sari', 'Jl. Bandungan RT 02 RW 01 no.21 Kec.Gajahmungkur Kab.Semarang', '3328101999126', '081462226839', '202401-011');

-- --------------------------------------------------------

--
-- Table structure for table `periksa`
--

CREATE TABLE `periksa` (
  `id` int(11) NOT NULL,
  `id_daftar_poli` int(11) NOT NULL,
  `tgl_periksa` datetime NOT NULL,
  `catatan` text NOT NULL,
  `biaya_periksa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `periksa`
--

INSERT INTO `periksa` (`id`, `id_daftar_poli`, `tgl_periksa`, `catatan`, `biaya_periksa`) VALUES
(1, 1, '2024-01-05 13:05:00', 'Diminum obatnya jangan makan sembarangan', 155000),
(2, 2, '2024-01-05 14:10:00', 'Diminum obatnya jangan cape\"', 155000),
(3, 6, '2024-01-05 14:20:00', 'Diminum obatnya jangan cape\"', 153000),
(4, 3, '2024-01-04 14:00:00', 'Diminum obatnya jangan sering pakai cuttonbad', 170000),
(5, 4, '2024-01-04 08:30:00', 'Diminum rutin ya obatnya', 153000),
(6, 5, '2024-01-01 09:00:00', 'Diminum obatnya jangan cape\" istirahat yang cukup', 155000),
(7, 7, '2024-01-02 14:00:00', 'Diminum rutin obatnya dan Istirahat yang cukup', 166000),
(8, 8, '2024-01-03 10:10:00', 'Diminumrutin obatnya jangan cape\" istirahat yang cukup', 158000),
(9, 9, '2024-01-06 09:00:00', 'Diminum rutin obatnya , banyakin minum vitamin sama susu dan jangan cape\" istirahat yang cukup', 166000),
(10, 10, '2024-01-03 09:00:00', 'Diminum obatnya jangan cape\" istirahat yang cukup', 160000),
(11, 11, '2024-01-02 09:00:00', 'Diminum obatnya jangan cape\" istirahat yang cukup', 170000);

-- --------------------------------------------------------

--
-- Table structure for table `poli`
--

CREATE TABLE `poli` (
  `id` int(11) NOT NULL,
  `nama_poli` varchar(25) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `poli`
--

INSERT INTO `poli` (`id`, `nama_poli`, `keterangan`) VALUES
(1, 'Poli Anak', 'Ini untuk poli Anak'),
(2, 'Poli Umum', 'Untuk Sakit umum'),
(3, 'Poli Mata', 'Untuk Sakit Mata dan yang berhubungan'),
(4, 'Poli Telinga', 'Untuk Sakit Telinga '),
(5, 'Poli Gigi', 'Untuk sakit Gigi'),
(6, 'Poli Lansia', 'Untuk Pasien Sakit Berumur lansia'),
(7, 'Poli Ibu Hamil', 'Untuk Ibu-Ibu Hamil Saja');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`) VALUES
(1, 'Bagas', 'segomagelang', '$2y$10$PQ8tKj/Vdhb76nkP.QMwQOrGDf8yA4lQctYi5Jlv.3gtxWT03j14i'),
(2, 'Masduki', 'msdki', '$2y$10$LDs0oemg.1SsKTtfpj9xi.A3WSxGhlINZwq6hqRpi5HlIKFhDljBu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daftar_poli`
--
ALTER TABLE `daftar_poli`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_daftar_poli_pasien` (`id_pasien`),
  ADD KEY `fk_daftar_poli_jadwal_periksa` (`id_jadwal`);

--
-- Indexes for table `detail_periksa`
--
ALTER TABLE `detail_periksa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_detail_periksa_obat` (`id_obat`),
  ADD KEY `fk_detail_periksa_periksa` (`id_periksa`);

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_dokter_poli` (`id_poli`);

--
-- Indexes for table `jadwal_periksa`
--
ALTER TABLE `jadwal_periksa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_jadwal_periksa_dokter` (`id_dokter`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `periksa`
--
ALTER TABLE `periksa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_periksa_daftar_poli` (`id_daftar_poli`);

--
-- Indexes for table `poli`
--
ALTER TABLE `poli`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daftar_poli`
--
ALTER TABLE `daftar_poli`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `detail_periksa`
--
ALTER TABLE `detail_periksa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jadwal_periksa`
--
ALTER TABLE `jadwal_periksa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `periksa`
--
ALTER TABLE `periksa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `poli`
--
ALTER TABLE `poli`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `daftar_poli`
--
ALTER TABLE `daftar_poli`
  ADD CONSTRAINT `fk_daftar_poli_jadwal_periksa` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal_periksa` (`id`),
  ADD CONSTRAINT `fk_daftar_poli_pasien` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id`);

--
-- Constraints for table `detail_periksa`
--
ALTER TABLE `detail_periksa`
  ADD CONSTRAINT `fk_detail_periksa_obat` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id`),
  ADD CONSTRAINT `fk_detail_periksa_periksa` FOREIGN KEY (`id_periksa`) REFERENCES `periksa` (`id`);

--
-- Constraints for table `dokter`
--
ALTER TABLE `dokter`
  ADD CONSTRAINT `fk_dokter_poli` FOREIGN KEY (`id_poli`) REFERENCES `poli` (`id`);

--
-- Constraints for table `jadwal_periksa`
--
ALTER TABLE `jadwal_periksa`
  ADD CONSTRAINT `fk_jadwal_periksa_dokter` FOREIGN KEY (`id_dokter`) REFERENCES `dokter` (`id`);

--
-- Constraints for table `periksa`
--
ALTER TABLE `periksa`
  ADD CONSTRAINT `fk_periksa_daftar_poli` FOREIGN KEY (`id_daftar_poli`) REFERENCES `daftar_poli` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
