-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.31-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.5.0.5288
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
	(4, 'Survei', 4, 'survei', 'fa fa-star-half-o', 0, 0, 0, 'survei.html', 0),
	(5, 'Laporan', 5, '', 'fa fa-files-o', 0, 1, 1, '', 0),
	(6, 'Referensi', 6, '', 'fa fa-list-ul', 0, 1, 1, '', 0),
	(7, 'Label', 1, 'ref/label', 'fa fa-circle-o', 6, 0, 0, 'ref-label.html', 0),
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
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `jenis` varchar(255) NOT NULL,
  `singkatan` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table db_peraturan.r_survei_jawab: ~5 rows (approximately)
/*!40000 ALTER TABLE `r_survei_jawab` DISABLE KEYS */;
INSERT INTO `r_survei_jawab` (`id`, `deskripsi`) VALUES
	(1, 'Tidak Puas'),
	(2, 'Kurang Puas'),
	(3, 'Cukup Puas'),
	(4, 'Puas'),
	(5, 'Sangat Puas'),
	(6, '20 Tahun');
/*!40000 ALTER TABLE `r_survei_jawab` ENABLE KEYS */;

-- Dumping structure for table db_peraturan.r_survei_tanya
CREATE TABLE IF NOT EXISTS `r_survei_tanya` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(255) NOT NULL,
  `jenis` varchar(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- Dumping data for table db_peraturan.r_survei_tanya: ~20 rows (approximately)
/*!40000 ALTER TABLE `r_survei_tanya` DISABLE KEYS */;
INSERT INTO `r_survei_tanya` (`id`, `deskripsi`, `jenis`) VALUES
	(1, 'Mohon mengisi kantor tempat Saudara bekerja saat ini :', '1'),
	(2, 'Berapa usia Saudara saat ini?', '2'),
	(3, 'Rata-rata dalam 1 minggu, berapa kali anda menggunakan aplikasi SHIP tersebut?', '1'),
	(4, 'Dari Skala 1-10, Seberapa besar Manfaat Aplikasi SHIP dalam menunjang pekerjaan Saudara ?', '1'),
	(5, 'Kemudahan mengakses aplikasi (awal buka aplikasi)', '3'),
	(6, 'Kecepatan pencarian data/informasi', '3'),
	(7, 'Kecepatan mengunduh data/dokumen', '3'),
	(8, 'Kestabilan aplikasi', '3'),
	(9, 'Kesesuaian fitur/menu terhadap kebutuhan', '3'),
	(10, 'Fitur/menu mudah digunakan', '3'),
	(11, 'Ketersediaan petunjuk penggunaan', '3'),
	(12, 'Kejelasan petunjuk penggunaan', '3'),
	(13, 'Desain tampilan aplikasi', '3'),
	(14, 'Kemudahan penggunaan aplikasi', '3'),
	(15, 'Keakuratan data yang ditampilkan', '3'),
	(16, 'Data yang dihasilkan informatif', '3'),
	(17, 'Data yang dihasilkan sesuai dengan kebutuhan', '3'),
	(18, 'Apakah anda pernah mengalami kendala pada saat menggunakan aplikasi SHIP?', '4'),
	(19, 'Silahkan berikan informasi terkait kendala terhadap aplikasi tersebut', '1'),
	(20, 'Silahkan berikan saran dan masukkan terhadap aplikasi tersebut', '1');
/*!40000 ALTER TABLE `r_survei_tanya` ENABLE KEYS */;

-- Dumping structure for table db_peraturan.tb_ip_client
CREATE TABLE IF NOT EXISTS `tb_ip_client` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table db_peraturan.tb_ip_client: ~1 rows (approximately)
/*!40000 ALTER TABLE `tb_ip_client` DISABLE KEYS */;
INSERT INTO `tb_ip_client` (`id`, `ip_address`) VALUES
	(8, '::1');
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
  KEY `user_id` (`user_id`),
  CONSTRAINT `FK_tb_peraturan_r_jenis_peraturan` FOREIGN KEY (`jenis_id`) REFERENCES `r_jenis_peraturan` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;

-- Dumping data for table db_peraturan.tb_peraturan: ~62 rows (approximately)
/*!40000 ALTER TABLE `tb_peraturan` DISABLE KEYS */;
INSERT INTO `tb_peraturan` (`id`, `nomor`, `tahun`, `tentang`, `abstrak`, `jenis_id`, `nama_file`, `status_id`, `user_id`, `aktif`, `keterangan`, `created_at`, `updated_at`) VALUES
	(1, 'ND-123', '2018', 'Test Pemrograman', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ut quam vitae orci bibendum porttitor. Nunc et auctor felis. Donec vestibulum molestie malesuada. Morbi mattis magna non arcu ultricies elementum. Cras viverra lorem nisi, quis egestas enim varius in. Praesent euismod, justo lacinia mattis iaculis, est nisi ullamcorper nisl, quis mattis orci velit et augue. Donec a erat eu nisl elementum ullamcorper et nec lacus. Aenean fringilla molestie sem, interdum consequat sapien cursus non. Proin neque lorem, rhoncus vitae eleifend et, lobortis id nunc. Morbi vitae ex porta, venenatis magna sit amet, faucibus velit. Pellentesque dignissim tortor et dui porttitor, at accumsan libero fringilla. Nunc vel augue quis ante dictum scelerisque. Cras molestie eget felis vel sagittis. Vestibulum est elit, pretium hendrerit orci id, fermentum molestie justo.', 5, 'test.pdf', 5, 2, '0', 'Test salah', '2018-05-24 06:04:14', '2018-08-02 06:27:44'),
	(2, 'S-3456', '2017', 'Programming Test', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ut quam vitae orci bibendum porttitor. Nunc et auctor felis. Donec vestibulum molestie malesuada. Morbi mattis magna non arcu ultricies elementum. Cras viverra lorem nisi, quis egestas enim varius in. Praesent euismod, justo lacinia mattis iaculis, est nisi ullamcorper nisl, quis mattis orci velit et augue. Donec a erat eu nisl elementum ullamcorper et nec lacus. Aenean fringilla molestie sem, interdum consequat sapien cursus non. Proin neque lorem, rhoncus vitae eleifend et, lobortis id nunc. Morbi vitae ex porta, venenatis magna sit amet, faucibus velit. Pellentesque dignissim tortor et dui porttitor, at accumsan libero fringilla. Nunc vel augue quis ante dictum scelerisque. Cras molestie eget felis vel sagittis. Vestibulum est elit, pretium hendrerit orci id, fermentum molestie justo.', 10, 'test.pdf', 5, 2, '0', 'Test salah', '2018-06-24 13:58:59', '2018-08-02 06:27:29'),
	(4, 'ND-1231', '2018', 'Keuangan Negara', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ut quam vitae orci bibendum porttitor. Nunc et auctor felis. Donec vestibulum molestie malesuada. Morbi mattis magna non arcu ultricies elementum. Cras viverra lorem nisi, quis egestas enim varius in. Praesent euismod, justo lacinia mattis iaculis, est nisi ullamcorper nisl, quis mattis orci velit et augue. Donec a erat eu nisl elementum ullamcorper et nec lacus. Aenean fringilla molestie sem, interdum consequat sapien cursus non. Proin neque lorem, rhoncus vitae eleifend et, lobortis id nunc. Morbi vitae ex porta, venenatis magna sit amet, faucibus velit. Pellentesque dignissim tortor et dui porttitor, at accumsan libero fringilla. Nunc vel augue quis ante dictum scelerisque. Cras molestie eget felis vel sagittis. Vestibulum est elit, pretium hendrerit orci id, fermentum molestie justo.', 5, '61b005d0f5566bfadc75c9fc5d07e404.pdf', 6, 2, '0', 'Lampiran tidak ada', '2018-07-27 14:20:13', '2018-08-02 06:28:34'),
	(5, '2e7243tas', '2006', 'Penanganan Korupsi Tahun Lampau', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ut quam vitae orci bibendum porttitor. Nunc et auctor felis. Donec vestibulum molestie malesuada. Morbi mattis magna non arcu ultricies elementum. Cras viverra lorem nisi, quis egestas enim varius in. Praesent euismod, justo lacinia mattis iaculis, est nisi ullamcorper nisl, quis mattis orci velit et augue. Donec a erat eu nisl elementum ullamcorper et nec lacus. Aenean fringilla molestie sem, interdum consequat sapien cursus non. Proin neque lorem, rhoncus vitae eleifend et, lobortis id nunc. Morbi vitae ex porta, venenatis magna sit amet, faucibus velit. Pellentesque dignissim tortor et dui porttitor, at accumsan libero fringilla. Nunc vel augue quis ante dictum scelerisque. Cras molestie eget felis vel sagittis. Vestibulum est elit, pretium hendrerit orci id, fermentum molestie justo.', 3, '1921d787b0a99eee744f002472c22d34.pdf', 2, 2, '0', '', '2018-07-29 15:26:02', '2018-08-02 06:25:48'),
	(7, '190', '2012', 'Pencairan Anggaran', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ut quam vitae orci bibendum porttitor. Nunc et auctor felis. Donec vestibulum molestie malesuada. Morbi mattis magna non arcu ultricies elementum. Cras viverra lorem nisi, quis egestas enim varius in. Praesent euismod, justo lacinia mattis iaculis, est nisi ullamcorper nisl, quis mattis orci velit et augue. Donec a erat eu nisl elementum ullamcorper et nec lacus. Aenean fringilla molestie sem, interdum consequat sapien cursus non. Proin neque lorem, rhoncus vitae eleifend et, lobortis id nunc. Morbi vitae ex porta, venenatis magna sit amet, faucibus velit. Pellentesque dignissim tortor et dui porttitor, at accumsan libero fringilla. Nunc vel augue quis ante dictum scelerisque. Cras molestie eget felis vel sagittis. Vestibulum est elit, pretium hendrerit orci id, fermentum molestie justo.', 5, '3c3eee0e0f632c455f53ea2e4631109c.pdf', 5, 2, '0', 'Test salah', '2018-07-29 15:30:53', '2018-08-02 06:27:22'),
	(8, 'PER 120', '2015', 'Tests', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ut quam vitae orci bibendum porttitor. Nunc et auctor felis. Donec vestibulum molestie malesuada. Morbi mattis magna non arcu ultricies elementum. Cras viverra lorem nisi, quis egestas enim varius in. Praesent euismod, justo lacinia mattis iaculis, est nisi ullamcorper nisl, quis mattis orci velit et augue. Donec a erat eu nisl elementum ullamcorper et nec lacus. Aenean fringilla molestie sem, interdum consequat sapien cursus non. Proin neque lorem, rhoncus vitae eleifend et, lobortis id nunc. Morbi vitae ex porta, venenatis magna sit amet, faucibus velit. Pellentesque dignissim tortor et dui porttitor, at accumsan libero fringilla. Nunc vel augue quis ante dictum scelerisque. Cras molestie eget felis vel sagittis. Vestibulum est elit, pretium hendrerit orci id, fermentum molestie justo.', 7, '97a2d0c895f691ac9fcddda09ce3337c.pdf', 5, 2, '0', 'Test salah', '2018-07-29 16:17:38', '2018-08-02 06:27:15'),
	(9, 'SE 234', '5873', 'Test, Haloo', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ut quam vitae orci bibendum porttitor. Nunc et auctor felis. Donec vestibulum molestie malesuada. Morbi mattis magna non arcu ultricies elementum. Cras viverra lorem nisi, quis egestas enim varius in. Praesent euismod, justo lacinia mattis iaculis, est nisi ullamcorper nisl, quis mattis orci velit et augue. Donec a erat eu nisl elementum ullamcorper et nec lacus. Aenean fringilla molestie sem, interdum consequat sapien cursus non. Proin neque lorem, rhoncus vitae eleifend et, lobortis id nunc. Morbi vitae ex porta, venenatis magna sit amet, faucibus velit. Pellentesque dignissim tortor et dui porttitor, at accumsan libero fringilla. Nunc vel augue quis ante dictum scelerisque. Cras molestie eget felis vel sagittis. Vestibulum est elit, pretium hendrerit orci id, fermentum molestie justo.', 9, '2e0d2d333becf1cd3d92674b6ca41a9e.pdf', 3, 2, '0', '', '2018-07-29 16:23:25', '2018-08-02 06:26:48'),
	(10, 'KMK 208', '2013', 'Test', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ut quam vitae orci bibendum porttitor. Nunc et auctor felis. Donec vestibulum molestie malesuada. Morbi mattis magna non arcu ultricies elementum. Cras viverra lorem nisi, quis egestas enim varius in. Praesent euismod, justo lacinia mattis iaculis, est nisi ullamcorper nisl, quis mattis orci velit et augue. Donec a erat eu nisl elementum ullamcorper et nec lacus. Aenean fringilla molestie sem, interdum consequat sapien cursus non. Proin neque lorem, rhoncus vitae eleifend et, lobortis id nunc. Morbi vitae ex porta, venenatis magna sit amet, faucibus velit. Pellentesque dignissim tortor et dui porttitor, at accumsan libero fringilla. Nunc vel augue quis ante dictum scelerisque. Cras molestie eget felis vel sagittis. Vestibulum est elit, pretium hendrerit orci id, fermentum molestie justo.', 6, 'd4377d724e88759c7dbd43dbe91865c4.pdf', 3, 2, '0', '', '2018-07-30 09:36:50', '2018-08-02 06:27:49'),
	(11, 'KEP 7532143', '2005', 'Test', 'Test', 4, 'f9476ae61d9054234b66be68136470f6.pdf', 2, 2, '0', '', '2018-07-30 11:05:25', '2018-07-30 11:05:31'),
	(13, 'UU No 17 Tahun 2003', '2003', 'Keuangan Negara', 'Menimbang bahwa penyelenggaraan pemerintahan negara untuk mewujudkan\r\ntujuan bernegara menimbulkan hak dan kewajiban negara yang dapat dinilai dengan uang, bahwa pengelolaan hak dan kewajiban negara sebagaimana dimaksud pada huruf a telah diatur dalam Bab VIII UUD 1945, bahwa Pasal 23C Bab VIII UUD 1945 mengamanatkan hal-hal lain mengenai keuangan negara diatur dengan undang-undang, bahwa berdasarkan pertimbangan sebagaimana dimaksud pada huruf a, huruf b, dan huruf c perlu dibentuk Undang-undang tentang Keuangan Negara', 1, '565df24e9844ca03000a129e46487696.pdf', 4, 2, '1', NULL, '2018-08-02 05:43:32', '2018-08-02 05:43:52'),
	(14, 'S-3278/PB.1/2017', '2017', 'Pengumpulan Data Volume Kerja dan Norma Waktu dalam rangka Penyusunan Analisis Beban Kerja Direktorat Jenderal Perbendaharaan', 'Pengumpulan Data Volume Kerja dan Norma Waktu dalam rangka Penyusunan Analisis Beban Kerja Direktorat Jenderal Perbendaharaan', 10, '4b8d53f5ed3a25856c476cb836b54868.pdf', 1, 2, '0', NULL, '2018-08-02 05:56:24', '2018-08-02 05:56:24'),
	(15, '190/PMK.05/2012', '2012', 'TATA CARA PEMBAYARAN DALAM RANGKA PELAKSANAAN ANGGARAN PENDAPATAN DAN BELANJA NEGARA', 'TATA CARA PEMBAYARAN DALAM RANGKA PELAKSANAAN ANGGARAN PENDAPATAN DAN BELANJA NEGARA', 5, '6e8b989acd4b2187cfde310d076c0016.pdf', 4, 2, '1', NULL, '2018-08-02 06:03:37', '2018-08-02 06:18:53'),
	(16, 'PER-38/PB/2016', '2016', 'Pembina Pengelola Perbendaharaan (Treasury Management Representative)', 'Pembina Pengelola Perbendaharaan (Treasury Management Representative)', 7, '4fcf33f15ff9424f54d6e0e05262f76c.pdf', 4, 2, '1', NULL, '2018-08-02 06:15:53', '2018-08-02 06:18:14'),
	(17, 'PP 11 TAHUN 2017', '2017', 'MANAJEMEN PEGAWAI NEGERI SIPIL', 'MANAJEMEN PNS', 2, '7fa05e32efc8d230f18a765994be530c.pdf', 1, 2, '0', NULL, '2018-08-02 06:23:04', '2018-08-02 06:23:48'),
	(18, '59/PMK.010/2018', '2018', 'Penambahan Investasi Pemerintah Republik Indonesia Pada Lembaga Keuangan Internasional Tahun Anggaran 2018', 'PERATURAN MENTERI KEUANGAN REPUBLIK INDONESIA TENTANG PENAMBAHAN INVESTASI PEMERINTAH REPUBLIK INDONESIA PADA LEMBAGA KEUANGAN INTERNASIONAL TAHUN ANGGARAN 2018', 5, '59_PMK.010_2018Per.pdf', 1, 2, '1', NULL, '2018-07-24 00:00:00', '2018-07-24 00:00:01'),
	(19, '58/PMK.05/2018', '2018', 'Tarif Layanan Badan Layanan Umum Balai Kesehatan Penerbangan pada Kementerian Perhubungan', 'PERATURAN MENTERI KEUANGAN REPUBLIK INDONESIA TENTANG TARIF LAYANAN BADAN LAYANAN UMUM BALAI KESEHATAN PENERBANGAN PADA KEMENTERIAN PERHUBUNGAN', 5, '58_PMK.05_2018Per.pdf', 2, 2, '1', NULL, '2018-04-17 00:00:01', '2018-04-17 00:00:02'),
	(20, '57/PMK.06/2018', '2018', 'Perubahan Atas Peraturan Menteri Keuangan Nomor 118/PMK. 06/2017 tentang Pedoman Pelaksanaan Penilaian Kembali Barang Milik Negara', 'PERATURAN MENTERI KEUANGAN REPUBLIK INDONESIA TENTANG PERUBAHAN ATAS PERATURAN MENTERI KEUANGAN NOMOR 118/PMK.06/2017 TENTANG PEDOMAN PELAKSANAAN PENILAIAN KEMBALI BARANG MILIK NEGARA', 5, '57_PMK.06_2018Per.pdf', 3, 2, '1', NULL, '2018-03-10 00:00:02', '2018-03-10 00:00:03'),
	(21, '135/KMK.01/2013', '2013', 'Perubahan Kedua Atas Keputusan Menteri Keuangan Nomor 454/KMK.01/2011 tentang Pengelolaan Kinerja Di Lingkungan Kementerian Keuangan.', 'Perubahan Kedua Atas Keputusan Menteri Keuangan Nomor 454/KMK.01/2011 tentang Pengelolaan Kinerja Di Lingkungan Kementerian Keuangan.', 6, '135_KMK.01_2013Kep.HTM', 4, 2, '1', NULL, '2013-05-13 00:00:03', '2013-05-13 00:00:04'),
	(22, '128/KMK.01/2013', '2013', 'Pedoman Penilaian Kantor Pelayanan Percontohan Di Lingkungan Kementerian Keuangan.', 'Pedoman Penilaian Kantor Pelayanan Percontohan Di Lingkungan Kementerian Keuangan.', 6, '135_KMK.01_2013Kep.HTM', 3, 2, '1', NULL, '2013-01-30 00:00:04', '2013-01-30 00:00:05'),
	(23, '107TAHUN2017', '2017', 'Rincian Anggaran Pendapatan dan Belanja Negara Tahun Anggaran 2018.', 'Rincian Anggaran Pendapatan dan Belanja Negara Tahun Anggaran 2018.', 3, '107TAHUN2017PERPRES.pdf', 4, 2, '1', NULL, '2018-02-02 00:00:05', '2018-02-02 00:00:06'),
	(24, '96TAHUN2017', '2017', 'Perubahan Atas Peraturan Presiden Nomor 37 Tahun 2015 tentang Tunjangan Kinerja Pegawai di Lingkungan Direktorat Jenderal Pajak.', 'Perubahan Atas Peraturan Presiden Nomor 37 Tahun 2015 tentang Tunjangan Kinerja Pegawai di Lingkungan Direktorat Jenderal Pajak.', 3, '96TAHUN2017PERPRES.pdf', 4, 2, '1', NULL, '2018-04-24 00:00:06', '2018-04-24 00:00:07'),
	(25, 'SE-037/PB/2018', '2018', 'Batas Maksimum Pencairan Dana PNBP Kementerian Agama tahun 2018', 'Batas Maksimum Pencairan Dana PNBP Kementerian Agama tahun 2018', 9, 'se_037_pb_2018.pdf', 4, 2, '1', NULL, '2018-03-21 00:00:07', '2018-03-21 00:00:08'),
	(26, 'SE-039/PB/2018', '2018', 'Batas Maksimum Pencairan Dana PNBP Lembaga Penyiaran Radio tahun 2018', 'Batas Maksimum Pencairan Dana PNBP Lembaga Penyiaran Radio tahun 2018', 9, 'se_039_pb_2018.pdf', 2, 2, '1', NULL, '2018-03-31 00:00:08', '2018-03-31 00:00:09'),
	(27, 'SE-030/PB/2018', '2018', 'Batas Maksimum Pencairan Dana Direktorat Jenderal Bimbingan Masyarakat Islam tahun 2018', 'Batas Maksimum Pencairan Dana Direktorat Jenderal Bimbingan Masyarakat Islam tahun 2018', 9, 'se_030_pb_2018.pdf', 3, 2, '1', NULL, '2018-07-24 00:00:09', '2018-07-24 00:00:10'),
	(28, '69/PMK.010/2018', '2018', 'Penambahan Investasi Pemerintah Republik Indonesia Pada Lembaga Keuangan Internasional Tahun Anggaran 2018.', 'PERATURAN MENTERI KEUANGAN REPUBLIK INDONESIA TENTANG PENAMBAHAN INVESTASI PEMERINTAH REPUBLIK INDONESIA PADA LEMBAGA KEUANGAN INTERNASIONAL TAHUN ANGGARAN 2018', 5, '59_PMK.010_2018Per.pdf', 4, 2, '1', NULL, '2018-06-03 00:00:10', '2018-06-03 00:00:11'),
	(29, '68/PMK.05/2018', '2018', 'Tarif Layanan Badan Layanan Umum Balai Kesehatan Penerbangan pada Kementerian Perhubungan.', 'PERATURAN MENTERI KEUANGAN REPUBLIK INDONESIA TENTANG TARIF LAYANAN BADAN LAYANAN UMUM BALAI KESEHATAN PENERBANGAN PADA KEMENTERIAN PERHUBUNGAN', 5, '58_PMK.05_2018Per.pdf', 4, 2, '1', NULL, '2018-05-03 00:00:11', '2018-05-03 00:00:12'),
	(30, '67/PMK.06/2018', '2018', 'Perubahan Atas Peraturan Menteri Keuangan Nomor 118/PMK. 06/2017 tentang Pedoman Pelaksanaan Penilaian Kembali Barang Milik Negara', 'PERATURAN MENTERI KEUANGAN REPUBLIK INDONESIA TENTANG PERUBAHAN ATAS PERATURAN MENTERI KEUANGAN NOMOR 118/PMK.06/2017 TENTANG PEDOMAN PELAKSANAAN PENILAIAN KEMBALI BARANG MILIK NEGARA', 5, '57_PMK.06_2018Per.pdf', 1, 2, '1', NULL, '2018-02-27 00:00:12', '2018-02-27 00:00:13'),
	(31, '235/KMK.01/2013', '2013', 'Perubahan Kedua Atas Keputusan Menteri Keuangan Nomor 454/KMK.01/2011 tentang Pengelolaan Kinerja Di Lingkungan Kementerian Keuangan.', 'Perubahan Kedua Atas Keputusan Menteri Keuangan Nomor 454/KMK.01/2011 tentang Pengelolaan Kinerja Di Lingkungan Kementerian Keuangan.', 6, '135_KMK.01_2013Kep.HTM', 4, 2, '1', NULL, '2013-03-20 00:00:13', '2013-03-20 00:00:14'),
	(32, '228/KMK.01/2013', '2013', 'Pedoman Penilaian Kantor Pelayanan Percontohan Di Lingkungan Kementerian Keuangan.', 'Pedoman Penilaian Kantor Pelayanan Percontohan Di Lingkungan Kementerian Keuangan.', 6, '135_KMK.01_2013Kep.HTM', 4, 2, '1', NULL, '2013-06-05 00:00:14', '2013-06-05 00:00:15'),
	(33, '207TAHUN2017', '2017', 'Rincian Anggaran Pendapatan dan Belanja Negara Tahun Anggaran 2018.', 'Rincian Anggaran Pendapatan dan Belanja Negara Tahun Anggaran 2018.', 3, '107TAHUN2017PERPRES.pdf', 2, 2, '1', NULL, '2018-01-30 00:00:15', '2018-01-30 00:00:16'),
	(34, '106TAHUN2017', '2017', 'Perubahan Atas Peraturan Presiden Nomor 37 Tahun 2015 tentang Tunjangan Kinerja Pegawai di Lingkungan Direktorat Jenderal Pajak', 'Perubahan Atas Peraturan Presiden Nomor 37 Tahun 2015 tentang Tunjangan Kinerja Pegawai di Lingkungan Direktorat Jenderal Pajak.', 3, '96TAHUN2017PERPRES.pdf', 4, 2, '1', NULL, '2018-06-29 00:00:16', '2018-06-29 00:00:17'),
	(35, 'SE-047/PB/2018', '2018', 'Batas Maksimum Pencairan Dana PNBP Kementerian Agama tahun 2018', 'Batas Maksimum Pencairan Dana PNBP Kementerian Agama tahun 2018', 9, 'se_037_pb_2018.pdf', 4, 2, '1', NULL, '2018-07-02 00:00:17', '2018-07-02 00:00:18'),
	(36, 'SE-049/PB/2018', '2018', 'Batas Maksimum Pencairan Dana PNBP Lembaga Penyiaran Radio tahun 2018', 'Batas Maksimum Pencairan Dana PNBP Lembaga Penyiaran Radio tahun 2018', 9, 'se_039_pb_2018.pdf', 4, 2, '1', NULL, '2018-08-01 00:00:18', '2018-08-01 00:00:19'),
	(37, 'SE-040/PB/2018', '2018', 'Batas Maksimum Pencairan Dana Direktorat Jenderal Bimbingan Masyarakat Islam tahun 2018', 'Batas Maksimum Pencairan Dana Direktorat Jenderal Bimbingan Masyarakat Islam tahun 2018', 9, 'se_030_pb_2018.pdf', 3, 2, '1', NULL, '2018-06-26 00:00:19', '2018-06-26 00:00:20'),
	(38, '69/PMK.010/2018', '2018', 'Penambahan Investasi Pemerintah Republik Indonesia Pada Lembaga Keuangan Internasional Tahun Anggaran 2018', 'PERATURAN MENTERI KEUANGAN REPUBLIK INDONESIA TENTANG PENAMBAHAN INVESTASI PEMERINTAH REPUBLIK INDONESIA PADA LEMBAGA KEUANGAN INTERNASIONAL TAHUN ANGGARAN 2018', 5, '59_PMK.010_2018Per.pdf', 4, 2, '1', NULL, '2018-07-24 00:00:00', '2018-07-24 00:00:01'),
	(39, '78/PMK.05/2018', '2018', 'Tarif Layanan Badan Layanan Umum Balai Kesehatan Penerbangan pada Kementerian Perhubungan', 'PERATURAN MENTERI KEUANGAN REPUBLIK INDONESIA TENTANG TARIF LAYANAN BADAN LAYANAN UMUM BALAI KESEHATAN PENERBANGAN PADA KEMENTERIAN PERHUBUNGAN', 5, '58_PMK.05_2018Per.pdf', 4, 2, '1', NULL, '2018-04-17 00:00:01', '2018-04-17 00:00:02'),
	(40, '37/PMK.06/2018', '2018', 'Perubahan Atas Peraturan Menteri Keuangan Nomor 118/PMK. 06/2017 tentang Pedoman Pelaksanaan Penilaian Kembali Barang Milik Negara', 'PERATURAN MENTERI KEUANGAN REPUBLIK INDONESIA TENTANG PERUBAHAN ATAS PERATURAN MENTERI KEUANGAN NOMOR 118/PMK.06/2017 TENTANG PEDOMAN PELAKSANAAN PENILAIAN KEMBALI BARANG MILIK NEGARA', 5, '57_PMK.06_2018Per.pdf', 1, 2, '1', NULL, '2018-03-10 00:00:02', '2018-03-10 00:00:03'),
	(41, '335/KMK.01/2013', '2013', 'Perubahan Kedua Atas Keputusan Menteri Keuangan Nomor 454/KMK.01/2011 tentang Pengelolaan Kinerja Di Lingkungan Kementerian Keuangan.', 'Perubahan Kedua Atas Keputusan Menteri Keuangan Nomor 454/KMK.01/2011 tentang Pengelolaan Kinerja Di Lingkungan Kementerian Keuangan.', 6, '135_KMK.01_2013Kep.HTM', 2, 2, '1', NULL, '2013-05-13 00:00:03', '2013-05-13 00:00:04'),
	(42, '228/KMK.01/2013', '2013', 'Pedoman Penilaian Kantor Pelayanan Percontohan Di Lingkungan Kementerian Keuangan.', 'Pedoman Penilaian Kantor Pelayanan Percontohan Di Lingkungan Kementerian Keuangan.', 6, '135_KMK.01_2013Kep.HTM', 3, 2, '1', NULL, '2013-01-30 00:00:04', '2013-01-30 00:00:05'),
	(43, '207TAHUN2017', '2017', 'Rincian Anggaran Pendapatan dan Belanja Negara Tahun Anggaran 2018.', 'Rincian Anggaran Pendapatan dan Belanja Negara Tahun Anggaran 2018.', 3, '107TAHUN2017PERPRES.pdf', 4, 2, '1', NULL, '2018-02-02 00:00:05', '2018-02-02 00:00:06'),
	(44, '106TAHUN2017', '2017', 'Perubahan Atas Peraturan Presiden Nomor 37 Tahun 2015 tentang Tunjangan Kinerja Pegawai di Lingkungan Direktorat Jenderal Pajak.', 'Perubahan Atas Peraturan Presiden Nomor 37 Tahun 2015 tentang Tunjangan Kinerja Pegawai di Lingkungan Direktorat Jenderal Pajak.', 3, '96TAHUN2017PERPRES.pdf', 4, 2, '1', NULL, '2018-04-24 00:00:06', '2018-04-24 00:00:07'),
	(45, 'SE-047/PB/2018', '2018', 'Batas Maksimum Pencairan Dana PNBP Kementerian Agama tahun 2018', 'Batas Maksimum Pencairan Dana PNBP Kementerian Agama tahun 2018', 9, 'se_037_pb_2018.pdf', 3, 2, '1', NULL, '2018-03-21 00:00:07', '2018-03-21 00:00:08'),
	(46, 'SE-049/PB/2018', '2018', 'Batas Maksimum Pencairan Dana PNBP Lembaga Penyiaran Radio tahun 2018', 'Batas Maksimum Pencairan Dana PNBP Lembaga Penyiaran Radio tahun 2018', 9, 'se_039_pb_2018.pdf', 4, 2, '1', NULL, '2018-03-31 00:00:08', '2018-03-31 00:00:09'),
	(47, 'SE-060/PB/2018', '2018', 'Batas Maksimum Pencairan Dana Direktorat Jenderal Bimbingan Masyarakat Islam tahun 2018', 'Batas Maksimum Pencairan Dana Direktorat Jenderal Bimbingan Masyarakat Islam tahun 2018', 9, 'se_030_pb_2018.pdf', 4, 2, '1', NULL, '2018-07-24 00:00:09', '2018-07-24 00:00:10'),
	(48, '59/PMK.010/2018', '2018', 'Penambahan Investasi Pemerintah Republik Indonesia Pada Lembaga Keuangan Internasional Tahun Anggaran 2018.', 'PERATURAN MENTERI KEUANGAN REPUBLIK INDONESIA TENTANG PENAMBAHAN INVESTASI PEMERINTAH REPUBLIK INDONESIA PADA LEMBAGA KEUANGAN INTERNASIONAL TAHUN ANGGARAN 2018', 5, '59_PMK.010_2018Per.pdf', 4, 2, '1', NULL, '2018-06-03 00:00:10', '2018-06-03 00:00:11'),
	(49, '78/PMK.05/2018', '2018', 'Tarif Layanan Badan Layanan Umum Balai Kesehatan Penerbangan pada Kementerian Perhubungan.', 'PERATURAN MENTERI KEUANGAN REPUBLIK INDONESIA TENTANG TARIF LAYANAN BADAN LAYANAN UMUM BALAI KESEHATAN PENERBANGAN PADA KEMENTERIAN PERHUBUNGAN', 5, '58_PMK.05_2018Per.pdf', 4, 2, '1', NULL, '2018-05-03 00:00:11', '2018-05-03 00:00:12'),
	(50, '77/PMK.06/2018', '2018', 'Perubahan Atas Peraturan Menteri Keuangan Nomor 118/PMK. 06/2017 tentang Pedoman Pelaksanaan Penilaian Kembali Barang Milik Negara', 'PERATURAN MENTERI KEUANGAN REPUBLIK INDONESIA TENTANG PERUBAHAN ATAS PERATURAN MENTERI KEUANGAN NOMOR 118/PMK.06/2017 TENTANG PEDOMAN PELAKSANAAN PENILAIAN KEMBALI BARANG MILIK NEGARA', 5, '57_PMK.06_2018Per.pdf', 4, 2, '1', NULL, '2018-02-27 00:00:12', '2018-02-27 00:00:13'),
	(51, '335/KMK.01/2013', '2013', 'Perubahan Kedua Atas Keputusan Menteri Keuangan Nomor 454/KMK.01/2011 tentang Pengelolaan Kinerja Di Lingkungan Kementerian Keuangan.', 'Perubahan Kedua Atas Keputusan Menteri Keuangan Nomor 454/KMK.01/2011 tentang Pengelolaan Kinerja Di Lingkungan Kementerian Keuangan.', 6, '135_KMK.01_2013Kep.HTM', 4, 2, '1', NULL, '2013-03-20 00:00:13', '2013-03-20 00:00:14'),
	(52, '328/KMK.01/2013', '2013', 'Pedoman Penilaian Kantor Pelayanan Percontohan Di Lingkungan Kementerian Keuangan.', 'Pedoman Penilaian Kantor Pelayanan Percontohan Di Lingkungan Kementerian Keuangan.', 6, '135_KMK.01_2013Kep.HTM', 4, 2, '1', NULL, '2013-06-05 00:00:14', '2013-06-05 00:00:15'),
	(53, '307TAHUN2017', '2017', 'Rincian Anggaran Pendapatan dan Belanja Negara Tahun Anggaran 2018.', 'Rincian Anggaran Pendapatan dan Belanja Negara Tahun Anggaran 2018.', 3, '107TAHUN2017PERPRES.pdf', 4, 2, '1', NULL, '2018-01-30 00:00:15', '2018-01-30 00:00:16'),
	(54, '206TAHUN2017', '2017', 'Perubahan Atas Peraturan Presiden Nomor 37 Tahun 2015 tentang Tunjangan Kinerja Pegawai di Lingkungan Direktorat Jenderal Pajak', 'Perubahan Atas Peraturan Presiden Nomor 37 Tahun 2015 tentang Tunjangan Kinerja Pegawai di Lingkungan Direktorat Jenderal Pajak.', 3, '96TAHUN2017PERPRES.pdf', 4, 2, '1', NULL, '2018-06-29 00:00:16', '2018-06-29 00:00:17'),
	(55, 'SE-057/PB/2018', '2018', 'Batas Maksimum Pencairan Dana PNBP Kementerian Agama tahun 2018', 'Batas Maksimum Pencairan Dana PNBP Kementerian Agama tahun 2018', 9, 'se_037_pb_2018.pdf', 4, 2, '1', NULL, '2018-07-02 00:00:17', '2018-07-02 00:00:18'),
	(56, 'SE-059/PB/2018', '2018', 'Batas Maksimum Pencairan Dana PNBP Lembaga Penyiaran Radio tahun 2018', 'Batas Maksimum Pencairan Dana PNBP Lembaga Penyiaran Radio tahun 2018', 9, 'se_039_pb_2018.pdf', 4, 2, '1', NULL, '2018-08-01 00:00:18', '2018-08-01 00:00:19'),
	(57, 'SE-050/PB/2018', '2018', 'Batas Maksimum Pencairan Dana Direktorat Jenderal Bimbingan Masyarakat Islam tahun 2018', 'Batas Maksimum Pencairan Dana Direktorat Jenderal Bimbingan Masyarakat Islam tahun 2018', 9, 'se_030_pb_2018.pdf', 4, 2, '1', NULL, '2018-06-26 00:00:19', '2018-06-26 00:00:20'),
	(58, '87/PMK.06/2018', '2018', 'Perubahan Atas Peraturan Menteri Keuangan Nomor 118/PMK. 06/2017 tentang Pedoman Pelaksanaan Penilaian Kembali Barang Milik Negara', 'PERATURAN MENTERI KEUANGAN REPUBLIK INDONESIA TENTANG PERUBAHAN ATAS PERATURAN MENTERI KEUANGAN NOMOR 118/PMK.06/2017 TENTANG PEDOMAN PELAKSANAAN PENILAIAN KEMBALI BARANG MILIK NEGARA', 5, '57_PMK.06_2018Per.pdf', 5, 2, '1', NULL, '2018-02-27 00:00:12', '2018-02-27 00:00:13'),
	(59, '435/KMK.01/2013', '2013', 'Perubahan Kedua Atas Keputusan Menteri Keuangan Nomor 454/KMK.01/2011 tentang Pengelolaan Kinerja Di Lingkungan Kementerian Keuangan.', 'Perubahan Kedua Atas Keputusan Menteri Keuangan Nomor 454/KMK.01/2011 tentang Pengelolaan Kinerja Di Lingkungan Kementerian Keuangan.', 6, '135_KMK.01_2013Kep.HTM', 5, 2, '1', NULL, '2013-03-20 00:00:13', '2013-03-20 00:00:14'),
	(60, '428/KMK.01/2013', '2013', 'Pedoman Penilaian Kantor Pelayanan Percontohan Di Lingkungan Kementerian Keuangan.', 'Pedoman Penilaian Kantor Pelayanan Percontohan Di Lingkungan Kementerian Keuangan.', 6, '135_KMK.01_2013Kep.HTM', 6, 2, '1', NULL, '2013-06-05 00:00:14', '2013-06-05 00:00:15'),
	(61, '407TAHUN2017', '2017', 'Rincian Anggaran Pendapatan dan Belanja Negara Tahun Anggaran 2018.', 'Rincian Anggaran Pendapatan dan Belanja Negara Tahun Anggaran 2018.', 3, '107TAHUN2017PERPRES.pdf', 6, 2, '1', NULL, '2018-01-30 00:00:15', '2018-01-30 00:00:16'),
	(62, '306TAHUN2017', '2017', 'Perubahan Atas Peraturan Presiden Nomor 37 Tahun 2015 tentang Tunjangan Kinerja Pegawai di Lingkungan Direktorat Jenderal Pajak', 'Perubahan Atas Peraturan Presiden Nomor 37 Tahun 2015 tentang Tunjangan Kinerja Pegawai di Lingkungan Direktorat Jenderal Pajak.', 3, '96TAHUN2017PERPRES.pdf', 5, 2, '1', NULL, '2018-06-29 00:00:16', '2018-06-29 00:00:17'),
	(63, 'SE-067/PB/2018', '2018', 'Batas Maksimum Pencairan Dana PNBP Kementerian Agama tahun 2018', 'Batas Maksimum Pencairan Dana PNBP Kementerian Agama tahun 2018', 9, 'se_037_pb_2018.pdf', 6, 2, '1', NULL, '2018-07-02 00:00:17', '2018-07-02 00:00:18'),
	(64, 'SE-069/PB/2018', '2018', 'Batas Maksimum Pencairan Dana PNBP Lembaga Penyiaran Radio tahun 2018', 'Batas Maksimum Pencairan Dana PNBP Lembaga Penyiaran Radio tahun 2018', 9, 'se_039_pb_2018.pdf', 5, 2, '1', NULL, '2018-08-01 00:00:18', '2018-08-01 00:00:19'),
	(65, 'SE-060/PB/2018', '2018', 'Batas Maksimum Pencairan Dana Direktorat Jenderal Bimbingan Masyarakat Islam tahun 2018', 'Batas Maksimum Pencairan Dana Direktorat Jenderal Bimbingan Masyarakat Islam tahun 2018', 9, 'se_030_pb_2018.pdf', 4, 2, '1', NULL, '2018-06-26 00:00:19', '2018-06-26 00:00:20');
/*!40000 ALTER TABLE `tb_peraturan` ENABLE KEYS */;

-- Dumping structure for table db_peraturan.tb_survei
CREATE TABLE IF NOT EXISTS `tb_survei` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_id` int(11) NOT NULL,
  `pertanyaan` int(11) NOT NULL,
  `jawaban` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

-- Dumping data for table db_peraturan.tb_survei: ~20 rows (approximately)
/*!40000 ALTER TABLE `tb_survei` DISABLE KEYS */;
INSERT INTO `tb_survei` (`id`, `ip_id`, `pertanyaan`, `jawaban`) VALUES
	(5, 8, 1, 'Test'),
	(6, 8, 2, '6'),
	(7, 8, 3, '12'),
	(8, 8, 4, '1'),
	(9, 8, 5, '1'),
	(10, 8, 6, '1'),
	(11, 8, 7, '1'),
	(12, 8, 8, '1'),
	(13, 8, 9, '1'),
	(14, 8, 10, '1'),
	(15, 8, 11, '1'),
	(16, 8, 12, '1'),
	(17, 8, 13, '1'),
	(18, 8, 14, '1'),
	(19, 8, 15, '1'),
	(20, 8, 16, '1'),
	(21, 8, 17, '1'),
	(22, 8, 18, 'Tidak'),
	(23, 8, 19, 'Test'),
	(24, 8, 20, 'Test');
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

-- Dumping data for table db_peraturan.tb_user: ~2 rows (approximately)
/*!40000 ALTER TABLE `tb_user` DISABLE KEYS */;
INSERT INTO `tb_user` (`id`, `username`, `password`, `nama`, `nip`, `email`, `foto`, `kd_level`, `instansi_id`, `aktif`, `created_at`, `updated_at`) VALUES
	(1, 'admin', '741406c6940752b8ccf1834696338373', 'Administrator', '', '', '', '00', 0, '1', '2018-07-19 09:00:09', '2018-08-02 06:39:13'),
	(2, 'operator', '741406c6940752b8ccf1834696338373', 'Operator', NULL, NULL, NULL, '01', 1, '1', '2018-07-26 08:15:21', '2018-07-26 17:44:13'),
	(3, 'verifikator', '741406c6940752b8ccf1834696338373', 'Verifikator', NULL, NULL, NULL, '02', 1, '1', '2018-07-27 02:04:51', '2018-07-27 02:04:52');
/*!40000 ALTER TABLE `tb_user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
