-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2018 at 07:29 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sicapil`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('create-user', '0', NULL),
('melihat-data', '201809150658415b9d3a41753cc', NULL),
('superadmin', '0', NULL),
('unduh-dokumen', '201809150658415b9d3a41753cc', NULL),
('update-user', '0', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('create-user', 0, 'Menambah User', NULL, NULL, '2018-09-16 15:59:49', '2018-09-16 15:59:49'),
('melihat-data', 0, 'Melihat Data Pengguna', NULL, NULL, '2018-09-16 15:13:53', '2018-09-16 15:13:53'),
('superadmin', 0, 'Superadmin', NULL, NULL, '2018-09-16 16:51:20', '2018-09-16 16:51:20'),
('unduh-dokumen', 0, 'Mengunduh Dokumen', NULL, NULL, NULL, NULL),
('update-user', 0, 'Mengubah Data User', NULL, NULL, '2018-09-16 16:00:12', '2018-09-16 16:00:12');

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  `urut` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `auth_user`
--

CREATE TABLE `auth_user` (
  `user_id` varchar(30) NOT NULL,
  `user_username` varchar(35) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_level` enum('superadmin','verifikator','public') NOT NULL,
  `user_authKey` varchar(250) NOT NULL,
  `id_layanan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_user`
--

INSERT INTO `auth_user` (`user_id`, `user_username`, `user_password`, `user_name`, `user_email`, `user_level`, `user_authKey`, `id_layanan`) VALUES
('0', 'superadmin', '$2y$13$MeLqUCfXqW4hKzKkKc.fCOoWycziYG2hx/UXBR3Zphj2Hdnlt5DP.', 'Isa Dadi', 'idadi70@gmail.com', 'superadmin', '0i3YDKv5RrOmUjU7i9-3ytMZiTI-nC0J', 1),
('201809150658415b9d3a41753cc', 'isadadi', '$2y$13$mpqg7PWZJUvp3UQ3ii8urONuS24D/Qy4kqTQqqXjmG6znz9Zj03kq', 'M Isa Dadi', 'idadi70@gmail.com', 'verifikator', '090J0CJHtFHLwNO_48axGUXw3dxWVmz2', 2);

-- --------------------------------------------------------

--
-- Table structure for table `table_data_formulir`
--

CREATE TABLE `table_data_formulir` (
  `id` int(11) NOT NULL,
  `nama_data` varchar(200) NOT NULL,
  `datatype` varchar(20) NOT NULL,
  `id_formulir` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `table_dokumen`
--

CREATE TABLE `table_dokumen` (
  `id` int(11) NOT NULL,
  `nama_dokumen` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `table_dokumen_urusanlayanan`
--

CREATE TABLE `table_dokumen_urusanlayanan` (
  `id` int(11) NOT NULL,
  `id_urusanlayanan` int(11) NOT NULL,
  `id_dokumen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `table_dokumen_user`
--

CREATE TABLE `table_dokumen_user` (
  `id` int(11) NOT NULL,
  `id_urusanlayanan_user` int(11) NOT NULL,
  `id_dokumen` int(11) NOT NULL,
  `file_dokumen` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `table_formulir`
--

CREATE TABLE `table_formulir` (
  `id` int(11) NOT NULL,
  `nama_formulir` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `table_formulir_urusanlayanan`
--

CREATE TABLE `table_formulir_urusanlayanan` (
  `id` int(11) NOT NULL,
  `id_formulir` int(11) NOT NULL,
  `id_urusanlayanan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `table_layanan`
--

CREATE TABLE `table_layanan` (
  `id` int(11) NOT NULL,
  `nama_layanan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_layanan`
--

INSERT INTO `table_layanan` (`id`, `nama_layanan`) VALUES
(1, 'master'),
(2, 'ktp'),
(3, 'Kartu Keluarga'),
(4, 'Akta Kematian');

-- --------------------------------------------------------

--
-- Table structure for table `table_urusan`
--

CREATE TABLE `table_urusan` (
  `id` int(11) NOT NULL,
  `nama_urusan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_urusan`
--

INSERT INTO `table_urusan` (`id`, `nama_urusan`) VALUES
(1, 'Penerbitan KTP Baru Bagi penduduk WNI'),
(2, 'Penerbitan KTP Baru Bagi OA yang Memiliki Izin Tinggal Tetap');

-- --------------------------------------------------------

--
-- Table structure for table `table_urusanlayanan`
--

CREATE TABLE `table_urusanlayanan` (
  `id` int(11) NOT NULL,
  `id_urusan` int(11) NOT NULL,
  `id_layanan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `table_urusanlayanan_user`
--

CREATE TABLE `table_urusanlayanan_user` (
  `id` int(11) NOT NULL,
  `id_user` varchar(30) NOT NULL,
  `id_urusanlayanan` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `table_user_formulir_value`
--

CREATE TABLE `table_user_formulir_value` (
  `id` int(11) NOT NULL,
  `id_urusanlayanan_user` int(11) NOT NULL,
  `id_dataformulir` int(11) NOT NULL,
  `value` text NOT NULL,
  `related` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `auth_user`
--
ALTER TABLE `auth_user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `id_layanan` (`id_layanan`);

--
-- Indexes for table `table_data_formulir`
--
ALTER TABLE `table_data_formulir`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tipedata` (`datatype`),
  ADD KEY `id_formulir` (`id_formulir`);

--
-- Indexes for table `table_dokumen`
--
ALTER TABLE `table_dokumen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_dokumen_urusanlayanan`
--
ALTER TABLE `table_dokumen_urusanlayanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_urusanlayanan` (`id_urusanlayanan`,`id_dokumen`),
  ADD KEY `table_dokumen_urusanlayanan_ibfk_1` (`id_dokumen`);

--
-- Indexes for table `table_dokumen_user`
--
ALTER TABLE `table_dokumen_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_urusanlayanan_user`,`id_dokumen`),
  ADD KEY `table_dokumen_user_ibfk_1` (`id_dokumen`);

--
-- Indexes for table `table_formulir`
--
ALTER TABLE `table_formulir`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_formulir_urusanlayanan`
--
ALTER TABLE `table_formulir_urusanlayanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_formulir` (`id_formulir`,`id_urusanlayanan`),
  ADD KEY `table_formulir_urusanlayanan_ibfk_2` (`id_urusanlayanan`);

--
-- Indexes for table `table_layanan`
--
ALTER TABLE `table_layanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_urusan`
--
ALTER TABLE `table_urusan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_urusanlayanan`
--
ALTER TABLE `table_urusanlayanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_urusan` (`id_urusan`,`id_layanan`),
  ADD KEY `table_urusanlayanan_ibfk_2` (`id_layanan`);

--
-- Indexes for table `table_urusanlayanan_user`
--
ALTER TABLE `table_urusanlayanan_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_urusanlayanan` (`id_urusanlayanan`);

--
-- Indexes for table `table_user_formulir_value`
--
ALTER TABLE `table_user_formulir_value`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_urusanlayanan_user`,`id_dataformulir`),
  ADD KEY `table_user_formulir_value_ibfk_1` (`id_dataformulir`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `table_data_formulir`
--
ALTER TABLE `table_data_formulir`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `table_dokumen`
--
ALTER TABLE `table_dokumen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `table_dokumen_urusanlayanan`
--
ALTER TABLE `table_dokumen_urusanlayanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `table_dokumen_user`
--
ALTER TABLE `table_dokumen_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `table_formulir`
--
ALTER TABLE `table_formulir`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `table_formulir_urusanlayanan`
--
ALTER TABLE `table_formulir_urusanlayanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `table_layanan`
--
ALTER TABLE `table_layanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `table_urusan`
--
ALTER TABLE `table_urusan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `table_urusanlayanan`
--
ALTER TABLE `table_urusanlayanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `table_user_formulir_value`
--
ALTER TABLE `table_user_formulir_value`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_assignment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `auth_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_user`
--
ALTER TABLE `auth_user`
  ADD CONSTRAINT `auth_user_ibfk_1` FOREIGN KEY (`id_layanan`) REFERENCES `table_layanan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `table_data_formulir`
--
ALTER TABLE `table_data_formulir`
  ADD CONSTRAINT `table_data_formulir_ibfk_1` FOREIGN KEY (`id_formulir`) REFERENCES `table_formulir` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `table_dokumen_urusanlayanan`
--
ALTER TABLE `table_dokumen_urusanlayanan`
  ADD CONSTRAINT `table_dokumen_urusanlayanan_ibfk_1` FOREIGN KEY (`id_dokumen`) REFERENCES `table_dokumen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `table_dokumen_urusanlayanan_ibfk_2` FOREIGN KEY (`id_urusanlayanan`) REFERENCES `table_urusanlayanan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `table_dokumen_user`
--
ALTER TABLE `table_dokumen_user`
  ADD CONSTRAINT `table_dokumen_user_ibfk_1` FOREIGN KEY (`id_dokumen`) REFERENCES `table_dokumen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `table_dokumen_user_ibfk_2` FOREIGN KEY (`id_urusanlayanan_user`) REFERENCES `table_urusanlayanan_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `table_formulir_urusanlayanan`
--
ALTER TABLE `table_formulir_urusanlayanan`
  ADD CONSTRAINT `table_formulir_urusanlayanan_ibfk_1` FOREIGN KEY (`id_formulir`) REFERENCES `table_formulir` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `table_formulir_urusanlayanan_ibfk_2` FOREIGN KEY (`id_urusanlayanan`) REFERENCES `table_urusanlayanan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `table_urusanlayanan`
--
ALTER TABLE `table_urusanlayanan`
  ADD CONSTRAINT `table_urusanlayanan_ibfk_1` FOREIGN KEY (`id_urusan`) REFERENCES `table_urusan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `table_urusanlayanan_ibfk_2` FOREIGN KEY (`id_layanan`) REFERENCES `table_layanan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `table_urusanlayanan_user`
--
ALTER TABLE `table_urusanlayanan_user`
  ADD CONSTRAINT `table_urusanlayanan_user_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `auth_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `table_user_formulir_value`
--
ALTER TABLE `table_user_formulir_value`
  ADD CONSTRAINT `table_user_formulir_value_ibfk_1` FOREIGN KEY (`id_dataformulir`) REFERENCES `table_data_formulir` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `table_user_formulir_value_ibfk_2` FOREIGN KEY (`id_urusanlayanan_user`) REFERENCES `table_urusanlayanan_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
