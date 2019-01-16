-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 23 Nov 2018 pada 18.50
-- Versi Server: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ta-naivebayes`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_datatest`
--

CREATE TABLE `tb_datatest` (
  `nim` varchar(15) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jk` varchar(15) NOT NULL,
  `status_mahasiswa` varchar(10) NOT NULL,
  `ipk_1` float NOT NULL,
  `ipk_2` double NOT NULL,
  `ipk_3` double NOT NULL,
  `ipk_4` double NOT NULL,
  `rataipk` double DEFAULT NULL,
  `ips_1` double NOT NULL,
  `ips_2` double NOT NULL,
  `ips_3` double NOT NULL,
  `ips_4` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_datatest`
--

INSERT INTO `tb_datatest` (`nim`, `nama`, `jk`, `status_mahasiswa`, `ipk_1`, `ipk_2`, `ipk_3`, `ipk_4`, `rataipk`, `ips_1`, `ips_2`, `ips_3`, `ips_4`) VALUES
('1', 'a', 'LAKI-LAKI', 'MAHASISWA', 4, 4, 4, 1, 3.25, 3, 3, 3, 4),
('2', 'b', 'LAKI-LAKI', 'MAHASISWA', 3, 1, 2, 2, 2, 3, 2, 3, 3),
('3', 'c', 'LAKI-LAKI', 'MAHASISWA', 2, 2, 3, 4, 2.75, 4, 3, 4, 2),
('4', 'd', 'LAKI-LAKI', 'MAHASISWA', 1, 3, 1, 4, 2.25, 4, 3, 4, 3),
('5', 'w', 'LAKI-LAKI', 'MAHASISWA', 4, 4, 3, 3, 3.5, 2, 4, 4, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_datatraining`
--

CREATE TABLE `tb_datatraining` (
  `nim` varchar(15) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jk` varchar(15) NOT NULL,
  `status_mahasiswa` varchar(10) NOT NULL,
  `ipk_1` float NOT NULL,
  `ipk_2` double NOT NULL,
  `ipk_3` double NOT NULL,
  `ipk_4` double NOT NULL,
  `rataipk` double DEFAULT NULL,
  `ips_1` double NOT NULL,
  `ips_2` double NOT NULL,
  `ips_3` double NOT NULL,
  `ips_4` double NOT NULL,
  `masa_studi` varchar(5) NOT NULL,
  `status_kelulusan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_datatraining`
--

INSERT INTO `tb_datatraining` (`nim`, `nama`, `jk`, `status_mahasiswa`, `ipk_1`, `ipk_2`, `ipk_3`, `ipk_4`, `rataipk`, `ips_1`, `ips_2`, `ips_3`, `ips_4`, `masa_studi`, `status_kelulusan`) VALUES
('1', 'asdsa', 'LAKI-LAKI', 'MAHASISWA', 2, 2, 2, 2, 2, 2, 2, 2, 2, '9', 'TERLAMBAT'),
('12', 'asdasd', 'LAKI-LAKI', 'PEKERJA', 3, 3, 3, 1, 2.5, 1, 4, 2, 1, '9', 'TEPAT'),
('13', 'adsad', 'LAKI-LAKI', 'PEKERJA', 3, 2, 2, 2, 2.25, 2, 4, 3, 2, '9', 'TERLAMBAT'),
('14', 'asdsads', 'LAKI-LAKI', 'PEKERJA', 3, 3, 3, 3, 3, 3, 4, 4, 3, '8', 'TERLAMBAT'),
('15', 'asdasdas', 'LAKI-LAKI', 'MAHASISWA', 2, 2, 2, 4, 2.5, 4, 1, 3, 1, '6', 'TERLAMBAT'),
('2', 'adasd', 'LAKI-LAKI', 'MAHASISWA', 2, 3, 3, 3, 2.75, 4, 4, 4, 4, '8', 'TEPAT'),
('3', 'adasd', 'LAKI-LAKI', 'MAHASISWA', 3, 3, 3, 3, 3, 3, 3, 3, 3, '7', 'TEPAT'),
('4', 'asdsad', 'PEREMPUAN', 'MAHASISWA', 2.6, 1.1, 2.1, 1.2, 1.75, 1, 1, 1, 1.5, '10', 'TERLAMBAT'),
('5', 'asdsad', 'LAKI-LAKI', 'MAHASISWA', 2.8, 2, 2.8, 2.5, 2.525, 2.2, 2.2, 2.5, 2.9, '12', 'TERLAMBAT');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(5) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `user` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id`, `username`, `password`, `user`) VALUES
(1, 'admin', 'admin', 'rikza ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_datatest`
--
ALTER TABLE `tb_datatest`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `tb_datatraining`
--
ALTER TABLE `tb_datatraining`
  ADD PRIMARY KEY (`nim`),
  ADD UNIQUE KEY `nim` (`nim`),
  ADD UNIQUE KEY `nim_2` (`nim`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
