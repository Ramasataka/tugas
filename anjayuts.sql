-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2023 at 01:41 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `anjayuts`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(20) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `username`, `password`) VALUES
(1, 'Jon Lembo', 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `dosen_id` char(9) NOT NULL,
  `nama_dosen` varchar(75) NOT NULL,
  `email` varchar(75) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `matkul_id` char(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`dosen_id`, `nama_dosen`, `email`, `no_hp`, `matkul_id`) VALUES
('006', 'adasfdasf', 'anjaymabar@gmail.com', '0924875', '112'),
('3245425', 'pak ando', 'ando@gmail.com', '346457356', '112'),
('3322', 'Bukj', 'rg24122003@gmail.com', '0989765214', '112');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `kelas_id` char(5) NOT NULL,
  `kode_jurusan` char(9) NOT NULL,
  `matkul_id` char(5) NOT NULL,
  `dosen_id` char(9) NOT NULL,
  `ruang_kelas` varchar(50) NOT NULL,
  `hari_kelas` varchar(25) NOT NULL,
  `mulai_jam_kelas` time NOT NULL,
  `akhir_jam_kelas` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`kelas_id`, `kode_jurusan`, `matkul_id`, `dosen_id`, `ruang_kelas`, `hari_kelas`, `mulai_jam_kelas`, `akhir_jam_kelas`) VALUES
('12321', '002', '112', '3322', '123132', 'senin', '13:54:00', '00:32:00'),
('BA221', '002', '112', '3322', 'Lantai Bawah', 'Selasa', '12:22:00', '12:33:00'),
('UG220', '002', '112', '3245425', '123132', 'minggu', '00:31:00', '12:31:00');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` char(9) NOT NULL,
  `nama_mhs` varchar(150) NOT NULL,
  `kode_jurusan` char(3) NOT NULL,
  `gender` int(11) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `no_hp` varchar(16) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama_mhs`, `kode_jurusan`, `gender`, `alamat`, `no_hp`, `email`) VALUES
('19839082', 'luh pengit', '002', 2, 'jalan satu satunya', '0892745234', 'messi@gmail.com'),
('2212221', 'Alamsyah', '002', 2, 'jalan noja saraswati no 4', '081923', 'ramaputrawibawa24@gmail.com'),
('784423242', 'dimas anjay mabar', '002', 1, 'jalan ni hari hari', '25435643534', 'anjaymabar@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa_kelas`
--

CREATE TABLE `mahasiswa_kelas` (
  `nim` char(9) NOT NULL,
  `kelas_id` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mahasiswa_kelas`
--

INSERT INTO `mahasiswa_kelas` (`nim`, `kelas_id`) VALUES
('19839082', '12321'),
('2212221', 'BA221');

-- --------------------------------------------------------

--
-- Table structure for table `mata_kuliah`
--

CREATE TABLE `mata_kuliah` (
  `matkul_id` char(9) NOT NULL,
  `nama_matkul` varchar(75) NOT NULL,
  `sks` int(11) NOT NULL,
  `kode_jurusan` char(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mata_kuliah`
--

INSERT INTO `mata_kuliah` (`matkul_id`, `nama_matkul`, `sks`, `kode_jurusan`) VALUES
('112', 'Bisnis brok', 2, '002');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_jurusan`
--

CREATE TABLE `tabel_jurusan` (
  `kode_jurusan` char(9) NOT NULL,
  `nama_jurusan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tabel_jurusan`
--

INSERT INTO `tabel_jurusan` (`kode_jurusan`, `nama_jurusan`) VALUES
('002', 'Bisnis Digital'),
('005', 'Manajemen Digital');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`dosen_id`),
  ADD KEY `matkul_fk_id` (`matkul_id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`kelas_id`),
  ADD KEY `dosen_id_fk` (`dosen_id`),
  ADD KEY `jurusan_id_fk_kelas` (`kode_jurusan`),
  ADD KEY `matkul_id_fk_kelas` (`matkul_id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`),
  ADD KEY `kode_jurusan_fk` (`kode_jurusan`);

--
-- Indexes for table `mahasiswa_kelas`
--
ALTER TABLE `mahasiswa_kelas`
  ADD PRIMARY KEY (`nim`,`kelas_id`),
  ADD KEY `kelas_id` (`kelas_id`);

--
-- Indexes for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD PRIMARY KEY (`matkul_id`),
  ADD KEY `kode_jurusan_fk_MK` (`kode_jurusan`);

--
-- Indexes for table `tabel_jurusan`
--
ALTER TABLE `tabel_jurusan`
  ADD PRIMARY KEY (`kode_jurusan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dosen`
--
ALTER TABLE `dosen`
  ADD CONSTRAINT `matkul_fk_id` FOREIGN KEY (`matkul_id`) REFERENCES `mata_kuliah` (`matkul_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `dosen_id_fk` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`dosen_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jurusan_id_fk_kelas` FOREIGN KEY (`kode_jurusan`) REFERENCES `tabel_jurusan` (`kode_jurusan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `matkul_id_fk_kelas` FOREIGN KEY (`matkul_id`) REFERENCES `mata_kuliah` (`matkul_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `kode_jurusan_fk` FOREIGN KEY (`kode_jurusan`) REFERENCES `tabel_jurusan` (`kode_jurusan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mahasiswa_kelas`
--
ALTER TABLE `mahasiswa_kelas`
  ADD CONSTRAINT `mahasiswa_kelas_ibfk_1` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mahasiswa_kelas_ibfk_2` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`kelas_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD CONSTRAINT `kode_jurusan_fk_MK` FOREIGN KEY (`kode_jurusan`) REFERENCES `tabel_jurusan` (`kode_jurusan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
