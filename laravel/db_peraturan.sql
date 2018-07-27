-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.31-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for db_peraturan
CREATE DATABASE IF NOT EXISTS `db_peraturan` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_peraturan`;

-- Dumping structure for table db_peraturan.d_menu
CREATE TABLE IF NOT EXISTS `d_menu` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `no_urut` int(5) NOT NULL,
  `url` varchar(255) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `parent_id` int(5) NOT NULL,
  `is_parent` int(1) NOT NULL,
  `aktif` int(1) NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `new_tab` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_peraturan.d_menu: ~12 rows (approximately)
/*!40000 ALTER TABLE `d_menu` DISABLE KEYS */;
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
	(12, 'Monitoring Pengajuan', 2, 'pengajuan/monitoring', 'fa fa-circle-o', 2, 0, 1, 'monitoring-pengajuan.html', 0);
/*!40000 ALTER TABLE `d_menu` ENABLE KEYS */;

-- Dumping structure for table db_peraturan.d_menu_level
CREATE TABLE IF NOT EXISTS `d_menu_level` (
  `menu_id` int(11) NOT NULL,
  `kd_level` varchar(2) NOT NULL,
  KEY `kd_level` (`kd_level`),
  KEY `menu_id` (`menu_id`),
  CONSTRAINT `FK_d_menu_level_d_menu` FOREIGN KEY (`menu_id`) REFERENCES `d_menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_d_menu_level_r_level` FOREIGN KEY (`kd_level`) REFERENCES `r_level` (`kd_level`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_peraturan.d_menu_level: ~27 rows (approximately)
/*!40000 ALTER TABLE `d_menu_level` DISABLE KEYS */;
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
	(11, '00');
/*!40000 ALTER TABLE `d_menu_level` ENABLE KEYS */;

-- Dumping structure for table db_peraturan.r_instansi
CREATE TABLE IF NOT EXISTS `r_instansi` (
  `id` int(2) unsigned NOT NULL AUTO_INCREMENT,
  `nama_instansi` varchar(255) NOT NULL,
  `kota` varchar(255) NOT NULL,
  `aktif` varchar(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table db_peraturan.r_instansi: ~3 rows (approximately)
/*!40000 ALTER TABLE `r_instansi` DISABLE KEYS */;
INSERT INTO `r_instansi` (`id`, `nama_instansi`, `kota`, `aktif`) VALUES
	(1, 'DJPB', 'Jakarta', '1'),
	(2, 'DJP', 'Makassar', '1'),
	(3, 'DJBC', 'Rawamangun', '1');
/*!40000 ALTER TABLE `r_instansi` ENABLE KEYS */;

-- Dumping structure for table db_peraturan.r_jenis_peraturan
CREATE TABLE IF NOT EXISTS `r_jenis_peraturan` (
  `id` int(5) NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `singkatan` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_peraturan.r_jenis_peraturan: ~11 rows (approximately)
/*!40000 ALTER TABLE `r_jenis_peraturan` DISABLE KEYS */;
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
/*!40000 ALTER TABLE `r_jenis_peraturan` ENABLE KEYS */;

-- Dumping structure for table db_peraturan.r_label
CREATE TABLE IF NOT EXISTS `r_label` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_label` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table db_peraturan.r_label: ~3 rows (approximately)
/*!40000 ALTER TABLE `r_label` DISABLE KEYS */;
INSERT INTO `r_label` (`id`, `nama_label`) VALUES
	(1, 'Test'),
	(3, 'andhika'),
	(4, 'lutfi');
/*!40000 ALTER TABLE `r_label` ENABLE KEYS */;

-- Dumping structure for table db_peraturan.r_level
CREATE TABLE IF NOT EXISTS `r_level` (
  `kd_level` varchar(2) NOT NULL,
  `nama_level` varchar(255) NOT NULL,
  PRIMARY KEY (`kd_level`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_peraturan.r_level: ~4 rows (approximately)
/*!40000 ALTER TABLE `r_level` DISABLE KEYS */;
INSERT INTO `r_level` (`kd_level`, `nama_level`) VALUES
	('00', 'Administrator'),
	('01', 'Operator'),
	('02', 'Verifikator'),
	('99', 'Super Admin');
/*!40000 ALTER TABLE `r_level` ENABLE KEYS */;

-- Dumping structure for table db_peraturan.r_status
CREATE TABLE IF NOT EXISTS `r_status` (
  `id` int(1) NOT NULL,
  `nama_status` varchar(255) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_peraturan.r_status: ~6 rows (approximately)
/*!40000 ALTER TABLE `r_status` DISABLE KEYS */;
INSERT INTO `r_status` (`id`, `nama_status`, `keterangan`) VALUES
	(1, 'Rekam', ''),
	(2, 'Pengajuan (Verifikator)', ''),
	(3, 'Draft (Administrator)', ''),
	(4, 'Terbit', ''),
	(5, 'Penolakan Pengajuan (by Verifikator)', ''),
	(6, 'Penolakan Draft (by Administrator)', '');
/*!40000 ALTER TABLE `r_status` ENABLE KEYS */;

-- Dumping structure for table db_peraturan.r_survei_jawab
CREATE TABLE IF NOT EXISTS `r_survei_jawab` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table db_peraturan.r_survei_jawab: ~5 rows (approximately)
/*!40000 ALTER TABLE `r_survei_jawab` DISABLE KEYS */;
INSERT INTO `r_survei_jawab` (`id`, `deskripsi`) VALUES
	(1, 'Tidak Puas'),
	(2, 'Kurang Puas'),
	(3, 'Cukup Puas'),
	(4, 'Puas'),
	(5, 'Sangat Puas');
/*!40000 ALTER TABLE `r_survei_jawab` ENABLE KEYS */;

-- Dumping structure for table db_peraturan.r_survei_tanya
CREATE TABLE IF NOT EXISTS `r_survei_tanya` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- Dumping data for table db_peraturan.r_survei_tanya: ~20 rows (approximately)
/*!40000 ALTER TABLE `r_survei_tanya` DISABLE KEYS */;
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
/*!40000 ALTER TABLE `r_survei_tanya` ENABLE KEYS */;

-- Dumping structure for table db_peraturan.tb_ip_client
CREATE TABLE IF NOT EXISTS `tb_ip_client` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_peraturan.tb_ip_client: ~0 rows (approximately)
/*!40000 ALTER TABLE `tb_ip_client` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_ip_client` ENABLE KEYS */;

-- Dumping structure for table db_peraturan.tb_label_peraturan
CREATE TABLE IF NOT EXISTS `tb_label_peraturan` (
  `peraturan_id` int(5) NOT NULL,
  `label_id` int(11) NOT NULL,
  KEY `label_id` (`label_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_peraturan.tb_label_peraturan: ~0 rows (approximately)
/*!40000 ALTER TABLE `tb_label_peraturan` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_label_peraturan` ENABLE KEYS */;

-- Dumping structure for table db_peraturan.tb_peraturan
CREATE TABLE IF NOT EXISTS `tb_peraturan` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
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
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `jenis_id` (`jenis_id`),
  KEY `status_id` (`status_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table db_peraturan.tb_peraturan: ~3 rows (approximately)
/*!40000 ALTER TABLE `tb_peraturan` DISABLE KEYS */;
INSERT INTO `tb_peraturan` (`id`, `nomor`, `tahun`, `tentang`, `abstrak`, `jenis_id`, `nama_file`, `status_id`, `user_id`, `aktif`, `keterangan`, `created_at`, `updated_at`) VALUES
	(1, 'ND-123', '2018', 'Test Pemrograman', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ut quam vitae orci bibendum porttitor. Nunc et auctor felis. Donec vestibulum molestie malesuada. Morbi mattis magna non arcu ultricies elementum. Cras viverra lorem nisi, quis egestas enim varius in. Praesent euismod, justo lacinia mattis iaculis, est nisi ullamcorper nisl, quis mattis orci velit et augue. Donec a erat eu nisl elementum ullamcorper et nec lacus. Aenean fringilla molestie sem, interdum consequat sapien cursus non. Proin neque lorem, rhoncus vitae eleifend et, lobortis id nunc. Morbi vitae ex porta, venenatis magna sit amet, faucibus velit. Pellentesque dignissim tortor et dui porttitor, at accumsan libero fringilla. Nunc vel augue quis ante dictum scelerisque. Cras molestie eget felis vel sagittis. Vestibulum est elit, pretium hendrerit orci id, fermentum molestie justo.', 11, 'test.pdf', 4, 2, '1', '', '2018-07-24 06:04:14', '2018-07-27 01:44:49'),
	(2, 'S-3456', '2017', 'Programming Test', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ut quam vitae orci bibendum porttitor. Nunc et auctor felis. Donec vestibulum molestie malesuada. Morbi mattis magna non arcu ultricies elementum. Cras viverra lorem nisi, quis egestas enim varius in. Praesent euismod, justo lacinia mattis iaculis, est nisi ullamcorper nisl, quis mattis orci velit et augue. Donec a erat eu nisl elementum ullamcorper et nec lacus. Aenean fringilla molestie sem, interdum consequat sapien cursus non. Proin neque lorem, rhoncus vitae eleifend et, lobortis id nunc. Morbi vitae ex porta, venenatis magna sit amet, faucibus velit. Pellentesque dignissim tortor et dui porttitor, at accumsan libero fringilla. Nunc vel augue quis ante dictum scelerisque. Cras molestie eget felis vel sagittis. Vestibulum est elit, pretium hendrerit orci id, fermentum molestie justo.', 10, 'test.pdf', 1, 2, '1', NULL, '2018-07-24 13:58:59', '2018-07-27 01:44:41'),
	(3, 'UU 17 Tahun 2003', '2003', 'Keuangan Negara', 'Bla bla bla', 1, 'a5e298ec0c75a3bb12fe0dc851e291ea.pdf', 4, 2, '1', '', '2018-07-27 01:35:40', '2018-07-27 03:47:30');
/*!40000 ALTER TABLE `tb_peraturan` ENABLE KEYS */;

-- Dumping structure for table db_peraturan.tb_survei
CREATE TABLE IF NOT EXISTS `tb_survei` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_id` int(11) NOT NULL,
  `pertanyaan` int(11) NOT NULL,
  `jawaban` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_peraturan.tb_survei: ~0 rows (approximately)
/*!40000 ALTER TABLE `tb_survei` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_survei` ENABLE KEYS */;

-- Dumping structure for table db_peraturan.tb_user
CREATE TABLE IF NOT EXISTS `tb_user` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
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
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `nip` (`nip`),
  KEY `instansi_id` (`instansi_id`),
  KEY `kd_level` (`kd_level`),
  CONSTRAINT `FK_tb_user_r_level` FOREIGN KEY (`kd_level`) REFERENCES `r_level` (`kd_level`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table db_peraturan.tb_user: ~3 rows (approximately)
/*!40000 ALTER TABLE `tb_user` DISABLE KEYS */;
INSERT INTO `tb_user` (`id`, `username`, `password`, `nama`, `nip`, `email`, `foto`, `kd_level`, `instansi_id`, `aktif`, `created_at`, `updated_at`) VALUES
	(1, 'admin', '741406c6940752b8ccf1834696338373', 'Admin SP', '', '', '', '00', 0, '1', '2018-07-19 09:00:09', '2018-07-19 11:03:44'),
	(2, 'operator', '741406c6940752b8ccf1834696338373', 'Operator', NULL, NULL, NULL, '01', 1, '1', '2018-07-26 08:15:21', '2018-07-26 17:44:13'),
	(3, 'verifikator', '741406c6940752b8ccf1834696338373', 'Verifikator', NULL, NULL, NULL, '02', 1, '1', '2018-07-27 02:04:51', '2018-07-27 02:04:52');
/*!40000 ALTER TABLE `tb_user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
