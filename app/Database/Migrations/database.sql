-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.22-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for perpustakaan
DROP DATABASE IF EXISTS `perpustakaan`;
CREATE DATABASE IF NOT EXISTS `perpustakaan` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `perpustakaan`;

-- Dumping structure for table perpustakaan.anggota
DROP TABLE IF EXISTS `anggota`;
CREATE TABLE IF NOT EXISTS `anggota` (
  `id_anggota` int(11) NOT NULL AUTO_INCREMENT,
  `kode_anggota` varchar(45) NOT NULL,
  `nama_anggota` varchar(45) NOT NULL,
  `jurusan_anggota` varchar(45) NOT NULL,
  `no_telp_anggota` varchar(25) NOT NULL,
  `alamat_anggota` text NOT NULL,
  PRIMARY KEY (`id_anggota`),
  UNIQUE KEY `kode_anggota` (`kode_anggota`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table perpustakaan.anggota: ~3 rows (approximately)
/*!40000 ALTER TABLE `anggota` DISABLE KEYS */;
INSERT INTO `anggota` (`id_anggota`, `kode_anggota`, `nama_anggota`, `jurusan_anggota`, `no_telp_anggota`, `alamat_anggota`) VALUES
	(1, '41519120101', 'Mugia Adha Kusumah', 'Informatika', '089198912', 'jln tanjung no 7b'),
	(3, '41519120102', 'Hilmi', 'TI', '089198912', 'jln tanjung no 7b');
/*!40000 ALTER TABLE `anggota` ENABLE KEYS */;

-- Dumping structure for table perpustakaan.buku
DROP TABLE IF EXISTS `buku`;
CREATE TABLE IF NOT EXISTS `buku` (
  `id_buku` int(11) NOT NULL AUTO_INCREMENT,
  `id_rak` int(11) DEFAULT NULL,
  `kode_buku` char(5) NOT NULL,
  `judul_buku` varchar(50) NOT NULL,
  `penulis_buku` varchar(45) NOT NULL,
  `penerbit_buku` varchar(45) NOT NULL,
  `tahun_penerbit` year(4) NOT NULL,
  `harga_per_hari` int(11) NOT NULL DEFAULT 0,
  `stok` int(11) NOT NULL,
  PRIMARY KEY (`id_buku`),
  UNIQUE KEY `UNIQUE` (`kode_buku`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table perpustakaan.buku: ~7 rows (approximately)
/*!40000 ALTER TABLE `buku` DISABLE KEYS */;
INSERT INTO `buku` (`id_buku`, `id_rak`, `kode_buku`, `judul_buku`, `penulis_buku`, `penerbit_buku`, `tahun_penerbit`, `harga_per_hari`, `stok`) VALUES
	(3, 2, 'A13', 'Aplikasi Praktis Asuhan Keperawatan Keluarga', 'Samsulhadi', 'Sagung Seto', '2013', 5000, 9),
	(4, 2, 'A14', 'Buku Ajar Tumbuh Kembang Remaja & Permasalahanya', 'Komang Ayu Heni', 'Sagung Seto', '2011', 2000, 10),
	(5, 4, 'A15', 'Dasar Dasar Uroginekologi', 'Zainul Anwar', 'Andi Offset', '2009', 5000, 9),
	(6, 3, 'A16', 'Etnografi Pengobatan; Praktik Budaya peramuan & su', 'Nasruddin Anshoriy', 'LKiS', '2011', 3000, 10),
	(7, 5, 'A17', 'Keanekaragaman klinik peny. Trofoblas gestasional', 'Greg Barton', 'LKiS', '2013', 2000, 10),
	(8, 3, 'A18', 'Kumpulan Undang undang Sistem peradilan Pidana', 'Soetjiningsih', 'Sagung Seto', '2009', 3000, 10),
	(9, 6, 'A19', 'Makna Budaya Dalam Komunikasi Antar Budaya', 'M. Z. Arifin', 'Sagung Seto', '1998', 5000, 10);
/*!40000 ALTER TABLE `buku` ENABLE KEYS */;

-- Dumping structure for table perpustakaan.peminjaman
DROP TABLE IF EXISTS `peminjaman`;
CREATE TABLE IF NOT EXISTS `peminjaman` (
  `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT,
  `kode_peminjaman` varchar(50) DEFAULT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `id_buku` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `id_petugas` int(11) NOT NULL,
  PRIMARY KEY (`id_peminjaman`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table perpustakaan.peminjaman: ~8 rows (approximately)
/*!40000 ALTER TABLE `peminjaman` DISABLE KEYS */;
INSERT INTO `peminjaman` (`id_peminjaman`, `kode_peminjaman`, `tanggal_pinjam`, `tanggal_kembali`, `id_buku`, `id_anggota`, `id_petugas`) VALUES
	(46, 'PJM-20220330-355', '2022-03-30', '2022-03-30', 4, 1, 1),
	(47, 'PJM-20220330-283', '2022-03-30', '2022-03-31', 3, 1, 1),
	(48, 'PJM-20220330-527', '2022-03-30', '2022-03-30', 5, 1, 1);
/*!40000 ALTER TABLE `peminjaman` ENABLE KEYS */;

-- Dumping structure for table perpustakaan.pengembalian
DROP TABLE IF EXISTS `pengembalian`;
CREATE TABLE IF NOT EXISTS `pengembalian` (
  `id_pengembalian` int(11) NOT NULL AUTO_INCREMENT,
  `id_pinjam` int(11) DEFAULT NULL,
  `tanggal_pengembalian` date NOT NULL,
  `total_pembayaran` int(11) NOT NULL,
  `denda` int(11) NOT NULL,
  `id_petugas` int(11) NOT NULL,
  PRIMARY KEY (`id_pengembalian`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table perpustakaan.pengembalian: ~0 rows (approximately)
/*!40000 ALTER TABLE `pengembalian` DISABLE KEYS */;
INSERT INTO `pengembalian` (`id_pengembalian`, `id_pinjam`, `tanggal_pengembalian`, `total_pembayaran`, `denda`, `id_petugas`) VALUES
	(57, 46, '2022-03-30', 2000, 0, 0),
	(58, 48, '2022-03-30', 5000, 0, 0),
	(59, 47, '2022-03-30', 5000, 0, 0);
/*!40000 ALTER TABLE `pengembalian` ENABLE KEYS */;

-- Dumping structure for table perpustakaan.petugas
DROP TABLE IF EXISTS `petugas`;
CREATE TABLE IF NOT EXISTS `petugas` (
  `id_petugas` int(11) NOT NULL AUTO_INCREMENT,
  `nama_petugas` varchar(45) NOT NULL,
  `jabatan_petugas` varchar(45) NOT NULL,
  `no_telp_petugas` varchar(20) NOT NULL,
  `alamat_petugas` text NOT NULL,
  `username_petugas` varchar(45) NOT NULL,
  `password_petugas` varchar(45) NOT NULL,
  PRIMARY KEY (`id_petugas`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table perpustakaan.petugas: ~0 rows (approximately)
/*!40000 ALTER TABLE `petugas` DISABLE KEYS */;
INSERT INTO `petugas` (`id_petugas`, `nama_petugas`, `jabatan_petugas`, `no_telp_petugas`, `alamat_petugas`, `username_petugas`, `password_petugas`) VALUES
	(1, 'Mugia Adha Kusumah', 'User', '089614696651', 'jln tanjung no 7b kampus ipb dramaga bogor', 'mugiaadha', 'Admin123');
/*!40000 ALTER TABLE `petugas` ENABLE KEYS */;

-- Dumping structure for table perpustakaan.rak
DROP TABLE IF EXISTS `rak`;
CREATE TABLE IF NOT EXISTS `rak` (
  `id_rak` int(11) NOT NULL AUTO_INCREMENT,
  `nama_rak` varchar(45) NOT NULL,
  `lokasi_rak` varchar(45) NOT NULL,
  PRIMARY KEY (`id_rak`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table perpustakaan.rak: ~7 rows (approximately)
/*!40000 ALTER TABLE `rak` DISABLE KEYS */;
INSERT INTO `rak` (`id_rak`, `nama_rak`, `lokasi_rak`) VALUES
	(1, 'General', 'Blok A'),
	(2, 'Matematika', 'Blok A'),
	(3, 'Hoby', 'Blok B'),
	(4, 'Komputer', 'Blok B'),
	(5, 'Sosial', 'Blok C'),
	(6, 'Ekonomi', 'Blok C'),
	(7, 'Sains', 'Blok C');
/*!40000 ALTER TABLE `rak` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
