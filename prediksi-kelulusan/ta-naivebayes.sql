-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 25 Jan 2019 pada 10.06
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
  `status_kelulusan` varchar(10) NOT NULL,
  `ipk_lulus` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengujian`
--

CREATE TABLE `tb_pengujian` (
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
  `status_kelulusan` varchar(10) NOT NULL,
  `ipk_lulus` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengujian_test`
--

CREATE TABLE `tb_pengujian_test` (
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
  `status_kelulusan` varchar(10) NOT NULL,
  `ipk_lulus` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Indexes for table `tb_pengujian`
--
ALTER TABLE `tb_pengujian`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `tb_pengujian_test`
--
ALTER TABLE `tb_pengujian_test`
  ADD PRIMARY KEY (`nim`);

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
