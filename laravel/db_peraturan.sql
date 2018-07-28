-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2018 at 04:14 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_peraturan`
--

-- --------------------------------------------------------

--
-- Table structure for table `d_menu`
--

CREATE TABLE `d_menu` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `no_urut` int(5) NOT NULL,
  `url` varchar(255) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `parent_id` int(5) NOT NULL,
  `is_parent` int(1) NOT NULL,
  `aktif` int(1) NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `new_tab` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d_menu`
--

INSERT INTO `d_menu` (`id`, `title`, `no_urut`, `url`, `icon`, `parent_id`, `is_parent`, `aktif`, `nama_file`, `new_tab`) VALUES
(1, 'Dashboard', 1, 'dashboard', 'fa fa-dashboard', 0, 0, 1, 'dashboard.html', 0),
(2, 'Pengajuan', 2, '', 'fa  fa-arrow-circle-right', 0, 1, 1, '', 0),
(3, 'Peraturan Final', 3, 'peraturan', 'fa fa-book', 0, 0, 1, 'peraturan.html', 0),
(4, 'Survei', 4, 'survei', 'fa fa-star-half-o', 0, 0, 1, 'survei.html', 0),
(5, 'Laporan', 5, '', 'fa fa-files-o', 0, 1, 1, '', 0),
(6, 'Referensi', 6, '', 'fa fa-list-ul', 0, 1, 1, '', 0),
(7, 'Label', 1, 'ref/label', 'fa fa-circle-o', 6, 0, 1, 'ref-label.html', 0),
(8, 'Instansi', 2, 'ref/instansi', 'fa fa-circle-o', 6, 0, 1, 'ref-instansi.html', 0),
(9, 'Jenis Peraturan', 3, 'ref/jenis-peraturan', 'fa fa-circle-o', 6, 0, 1, 'ref-jenis-peraturan.html', 0),
(10, 'User', 4, 'ref/user', 'fa fa-circle-o', 6, 0, 1, 'ref-user.html', 0),
(11, 'Daftar Pengajuan', 1, 'pengajuan/daftar', 'fa fa-circle-o', 2, 0, 1, 'daftar-pengajuan.html', 0),
(12, 'Monitoring Pengajuan', 2, 'pengajuan/monitoring', 'fa fa-circle-o', 2, 0, 1, 'monitoring-pengajuan.html', 0),
(13, 'Survei - Pertanyaan', 5, 'ref/survei-tanya', 'fa fa-circle-o', 6, 0, 1, 'ref-survei-tanya.html', 0),
(14, 'Survei - Jawaban', 6, 'ref/survei-jawab', 'fa fa-circle-o', 6, 0, 1, 'ref-survei-jawab.html', 0);

-- --------------------------------------------------------

--
-- Table structure for table `d_menu_level`
--

CREATE TABLE `d_menu_level` (
  `menu_id` int(11) NOT NULL,
  `kd_level` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d_menu_level`
--

INSERT INTO `d_menu_level` (`menu_id`, `kd_level`) VALUES
(1, '00'),
(2, '00'),
(3, '00'),
(4, '00'),
(5, '00'),
(6, '00'),
(7, '00'),
(8, '00'),
(9, '00'),
(10, '99'),
(1, '01'),
(2, '01'),
(6, '01'),
(7, '01'),
(8, '01'),
(9, '01'),
(1, '02'),
(2, '02'),
(6, '02'),
(7, '02'),
(8, '02'),
(9, '02'),
(11, '01'),
(11, '02'),
(12, '01'),
(12, '02'),
(11, '00'),
(13, '00'),
(13, '99'),
(14, '00'),
(14, '99');

-- --------------------------------------------------------

--
-- Table structure for table `r_instansi`
--

CREATE TABLE `r_instansi` (
  `id` int(2) UNSIGNED NOT NULL,
  `nama_instansi` varchar(255) NOT NULL,
  `kota` varchar(255) NOT NULL,
  `aktif` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_instansi`
--

INSERT INTO `r_instansi` (`id`, `nama_instansi`, `kota`, `aktif`) VALUES
(1, 'DJPB', 'Jakarta', '1'),
(2, 'DJP', 'Makassar', '1'),
(3, 'DJBC', 'Rawamangun', '1');

-- --------------------------------------------------------

--
-- Table structure for table `r_jenis_peraturan`
--

CREATE TABLE `r_jenis_peraturan` (
  `id` int(5) NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `singkatan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_jenis_peraturan`
--

INSERT INTO `r_jenis_peraturan` (`id`, `jenis`, `singkatan`) VALUES
(1, 'Undang-Undang', 'UU'),
(2, 'Peraturan Pemerintah', 'PP'),
(3, 'Peraturan Presiden', 'Perpres'),
(4, 'Keputusan Presiden', 'Keppres'),
(5, 'Peraturan Menteri Keuangan', 'PMK'),
(6, 'Keputusan Menteri Keuangan', 'KMK'),
(7, 'Peraturan Direktur Jenderal', 'Perdirjen'),
(8, 'Keputusan Direktur Jenderal', 'Kepdirjen'),
(9, 'Surat Edaran', 'SE'),
(10, 'Surat', 'S'),
(11, 'Nota Dinas', 'ND');

-- --------------------------------------------------------

--
-- Table structure for table `r_label`
--

CREATE TABLE `r_label` (
  `id` int(11) NOT NULL,
  `nama_label` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_label`
--

INSERT INTO `r_label` (`id`, `nama_label`) VALUES
(1, 'Test'),
(2, 'admin'),
(3, 'andhika'),
(4, 'lutfi');

-- --------------------------------------------------------

--
-- Table structure for table `r_level`
--

CREATE TABLE `r_level` (
  `kd_level` varchar(2) NOT NULL,
  `nama_level` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_level`
--

INSERT INTO `r_level` (`kd_level`, `nama_level`) VALUES
('00', 'Administrator'),
('01', 'Operator'),
('02', 'Verifikator'),
('99', 'Super Admin');

-- --------------------------------------------------------

--
-- Table structure for table `r_status`
--

CREATE TABLE `r_status` (
  `id` int(1) NOT NULL,
  `nama_status` varchar(255) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_status`
--

INSERT INTO `r_status` (`id`, `nama_status`, `keterangan`) VALUES
(1, 'Rekam', ''),
(2, 'Pengajuan (Verifikator)', ''),
(3, 'Draft (Administrator)', ''),
(4, 'Terbit', ''),
(5, 'Penolakan Pengajuan (by Verifikator)', ''),
(6, 'Penolakan Draft (by Administrator)', '');

-- --------------------------------------------------------

--
-- Table structure for table `r_survei_jawab`
--

CREATE TABLE `r_survei_jawab` (
  `id` int(11) NOT NULL,
  `deskripsi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_survei_jawab`
--

INSERT INTO `r_survei_jawab` (`id`, `deskripsi`) VALUES
(1, 'Tidak Puas'),
(2, 'Kurang Puas'),
(3, 'Cukup Puas'),
(4, 'Puas'),
(5, 'Sangat Puas');

-- --------------------------------------------------------

--
-- Table structure for table `r_survei_tanya`
--

CREATE TABLE `r_survei_tanya` (
  `id` int(11) NOT NULL,
  `deskripsi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_survei_tanya`
--

INSERT INTO `r_survei_tanya` (`id`, `deskripsi`) VALUES
(1, 'Mohon mengisi kantor tempat Saudara bekerja saat ini :'),
(2, 'Silahkan menyebutkan usia Saudara :'),
(3, 'Rata-rata dalam 1 minggu, berapa kali anda menggunakan aplikasi SHIP tersebut?'),
(4, 'Dari Skala 1-10, Seberapa besar Manfaat Aplikasi SHIP dalam menunjang pekerjaan Saudara ?'),
(5, 'Kemudahan mengakses aplikasi (awal buka aplikasi)'),
(6, 'Kecepatan pencarian data/informasi'),
(7, 'Kecepatan mengunduh data/dokumen'),
(8, 'Kestabilan aplikasi'),
(9, 'Kesesuaian fitur/menu terhadap kebutuhan'),
(10, 'Fitur/menu mudah digunakan'),
(11, 'Ketersediaan petunjuk penggunaan'),
(12, 'Kejelasan petunjuk penggunaan'),
(13, 'Desain tampilan aplikasi'),
(14, 'Kemudahan penggunaan aplikasi'),
(15, 'Keakuratan data yang ditampilkan'),
(16, 'Data yang dihasilkan informatif'),
(17, 'Data yang dihasilkan sesuai dengan kebutuhan'),
(18, 'Apakah anda pernah mengalami kendala pada saat menggunakan aplikasi SHIP?'),
(19, 'Silahkan berikan informasi terkait kendala terhadap aplikasi tersebut'),
(20, 'Silahkan berikan saran dan masukkan terhadap aplikasi tersebut');

-- --------------------------------------------------------

--
-- Table structure for table `tb_ip_client`
--

CREATE TABLE `tb_ip_client` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_label_peraturan`
--

CREATE TABLE `tb_label_peraturan` (
  `peraturan_id` int(5) NOT NULL,
  `label_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_peraturan`
--

CREATE TABLE `tb_peraturan` (
  `id` int(11) UNSIGNED NOT NULL,
  `nomor` varchar(255) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `tentang` varchar(4000) NOT NULL,
  `abstrak` varchar(4000) DEFAULT NULL,
  `jenis_id` int(5) NOT NULL,
  `nama_file` varchar(255) DEFAULT NULL,
  `status_id` int(1) NOT NULL,
  `user_id` int(5) NOT NULL,
  `aktif` varchar(1) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_peraturan`
--

INSERT INTO `tb_peraturan` (`id`, `nomor`, `tahun`, `tentang`, `abstrak`, `jenis_id`, `nama_file`, `status_id`, `user_id`, `aktif`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'ND-123', '2018', 'Test Pemrograman', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ut quam vitae orci bibendum porttitor. Nunc et auctor felis. Donec vestibulum molestie malesuada. Morbi mattis magna non arcu ultricies elementum. Cras viverra lorem nisi, quis egestas enim varius in. Praesent euismod, justo lacinia mattis iaculis, est nisi ullamcorper nisl, quis mattis orci velit et augue. Donec a erat eu nisl elementum ullamcorper et nec lacus. Aenean fringilla molestie sem, interdum consequat sapien cursus non. Proin neque lorem, rhoncus vitae eleifend et, lobortis id nunc. Morbi vitae ex porta, venenatis magna sit amet, faucibus velit. Pellentesque dignissim tortor et dui porttitor, at accumsan libero fringilla. Nunc vel augue quis ante dictum scelerisque. Cras molestie eget felis vel sagittis. Vestibulum est elit, pretium hendrerit orci id, fermentum molestie justo.', 11, 'test.pdf', 4, 2, '1', '', '2018-07-23 23:04:14', '2018-07-26 18:44:49'),
(2, 'S-3456', '2017', 'Programming Test', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ut quam vitae orci bibendum porttitor. Nunc et auctor felis. Donec vestibulum molestie malesuada. Morbi mattis magna non arcu ultricies elementum. Cras viverra lorem nisi, quis egestas enim varius in. Praesent euismod, justo lacinia mattis iaculis, est nisi ullamcorper nisl, quis mattis orci velit et augue. Donec a erat eu nisl elementum ullamcorper et nec lacus. Aenean fringilla molestie sem, interdum consequat sapien cursus non. Proin neque lorem, rhoncus vitae eleifend et, lobortis id nunc. Morbi vitae ex porta, venenatis magna sit amet, faucibus velit. Pellentesque dignissim tortor et dui porttitor, at accumsan libero fringilla. Nunc vel augue quis ante dictum scelerisque. Cras molestie eget felis vel sagittis. Vestibulum est elit, pretium hendrerit orci id, fermentum molestie justo.', 10, 'test.pdf', 1, 2, '1', NULL, '2018-07-24 06:58:59', '2018-07-26 18:44:41'),
(3, 'UU 17 Tahun 2003', '2003', 'Keuangan Negara', 'Bla bla bla', 1, 'a5e298ec0c75a3bb12fe0dc851e291ea.pdf', 4, 2, '1', '', '2018-07-26 18:35:40', '2018-07-26 20:47:30');

-- --------------------------------------------------------

--
-- Table structure for table `tb_survei`
--

CREATE TABLE `tb_survei` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_id` int(11) NOT NULL,
  `pertanyaan` int(11) NOT NULL,
  `jawaban` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nip` varchar(18) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `kd_level` varchar(2) NOT NULL,
  `instansi_id` int(2) NOT NULL,
  `aktif` varchar(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `username`, `password`, `nama`, `nip`, `email`, `foto`, `kd_level`, `instansi_id`, `aktif`, `created_at`, `updated_at`) VALUES
(1, 'admin', '741406c6940752b8ccf1834696338373', 'Admin SP', '', '', '', '00', 0, '1', '2018-07-19 02:00:09', '2018-07-19 04:03:44'),
(2, 'operator', '741406c6940752b8ccf1834696338373', 'Operator', NULL, NULL, NULL, '01', 1, '1', '2018-07-26 01:15:21', '2018-07-26 10:44:13'),
(3, 'verifikator', '741406c6940752b8ccf1834696338373', 'Verifikator', NULL, NULL, NULL, '02', 1, '1', '2018-07-26 19:04:51', '2018-07-26 19:04:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `d_menu`
--
ALTER TABLE `d_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `d_menu_level`
--
ALTER TABLE `d_menu_level`
  ADD KEY `kd_level` (`kd_level`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indexes for table `r_instansi`
--
ALTER TABLE `r_instansi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `r_jenis_peraturan`
--
ALTER TABLE `r_jenis_peraturan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `r_label`
--
ALTER TABLE `r_label`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `r_level`
--
ALTER TABLE `r_level`
  ADD PRIMARY KEY (`kd_level`);

--
-- Indexes for table `r_status`
--
ALTER TABLE `r_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `r_survei_jawab`
--
ALTER TABLE `r_survei_jawab`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `r_survei_tanya`
--
ALTER TABLE `r_survei_tanya`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_ip_client`
--
ALTER TABLE `tb_ip_client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_label_peraturan`
--
ALTER TABLE `tb_label_peraturan`
  ADD KEY `label_id` (`label_id`);

--
-- Indexes for table `tb_peraturan`
--
ALTER TABLE `tb_peraturan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jenis_id` (`jenis_id`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tb_survei`
--
ALTER TABLE `tb_survei`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `nip` (`nip`),
  ADD KEY `instansi_id` (`instansi_id`),
  ADD KEY `kd_level` (`kd_level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `r_instansi`
--
ALTER TABLE `r_instansi`
  MODIFY `id` int(2) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `r_label`
--
ALTER TABLE `r_label`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `r_survei_jawab`
--
ALTER TABLE `r_survei_jawab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `r_survei_tanya`
--
ALTER TABLE `r_survei_tanya`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tb_ip_client`
--
ALTER TABLE `tb_ip_client`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_peraturan`
--
ALTER TABLE `tb_peraturan`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_survei`
--
ALTER TABLE `tb_survei`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `d_menu_level`
--
ALTER TABLE `d_menu_level`
  ADD CONSTRAINT `FK_d_menu_level_d_menu` FOREIGN KEY (`menu_id`) REFERENCES `d_menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_d_menu_level_r_level` FOREIGN KEY (`kd_level`) REFERENCES `r_level` (`kd_level`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `FK_tb_user_r_level` FOREIGN KEY (`kd_level`) REFERENCES `r_level` (`kd_level`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
