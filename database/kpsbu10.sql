-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2020 at 05:12 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kpsbu10`
--

-- --------------------------------------------------------

--
-- Table structure for table `bahan_baku`
--

CREATE TABLE `bahan_baku` (
  `no_bb` varchar(50) NOT NULL,
  `nama_bb` varchar(50) NOT NULL,
  `satuan` varchar(50) DEFAULT NULL,
  `stok` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bahan_baku`
--

INSERT INTO `bahan_baku` (`no_bb`, `nama_bb`, `satuan`, `stok`) VALUES
('BB_001', 'Susu Sapi', 'liter', 0);

-- --------------------------------------------------------

--
-- Table structure for table `bahan_dalam_proses`
--

CREATE TABLE `bahan_dalam_proses` (
  `no_bdp` varchar(50) NOT NULL,
  `nama_bdp` varchar(50) NOT NULL,
  `stok` varchar(50) NOT NULL,
  `satuan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bahan_dalam_proses`
--

INSERT INTO `bahan_dalam_proses` (`no_bdp`, `nama_bdp`, `stok`, `satuan`) VALUES
('BDP_001', 'Susu Sapi', '0', 'liter');

-- --------------------------------------------------------

--
-- Table structure for table `bahan_penolong`
--

CREATE TABLE `bahan_penolong` (
  `no_bp` varchar(100) NOT NULL,
  `nama_bp` varchar(100) NOT NULL,
  `satuan` varchar(100) DEFAULT NULL,
  `stok` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bahan_penolong`
--

INSERT INTO `bahan_penolong` (`no_bp`, `nama_bp`, `satuan`, `stok`) VALUES
('BP_001', 'Gula', 'gram', 0),
('BP_002', 'Bubuk Biang Yoghurt', 'gram', 0),
('BP_003', 'Pewarna Makanan', 'ml', 0),
('BP_004', 'Perisa Makanan', 'ml', 0),
('BP_005', 'Garam', 'gram', 0);

-- --------------------------------------------------------

--
-- Table structure for table `bom`
--

CREATE TABLE `bom` (
  `no_produk` varchar(100) NOT NULL,
  `no_bbp` varchar(100) NOT NULL,
  `jumlah` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bom`
--

INSERT INTO `bom` (`no_produk`, `no_bbp`, `jumlah`) VALUES
('PR_001', 'BB_001', 1),
('PR_003', 'BDP_001', 1),
('PR_004', 'BDP_001', 1),
('PR_005', 'BDP_001', 1),
('PR_006', 'BDP_001', 1),
('PR_007', 'BDP_001', 1),
('PR_008', 'BDP_001', 1),
('PR_009', 'BDP_001', 1),
('PR_002', 'BB_001', 1),
('PR_003', 'BB_001', 1),
('PR_004', 'BB_001', 1),
('PR_005', 'BB_001', 1),
('PR_006', 'BB_001', 1),
('PR_007', 'BB_001', 1),
('PR_008', 'BB_001', 1),
('PR_009', 'BB_001', 1),
('PR_002', 'BP_001', 15),
('PR_002', 'BP_005', 10),
('PR_003', 'BP_001', 40),
('PR_003', 'BP_005', 15),
('PR_003', 'BP_003', 10),
('PR_003', 'BP_004', 25),
('PR_004', 'BP_001', 40),
('PR_004', 'BP_003', 10),
('PR_004', 'BP_004', 25),
('PR_004', 'BP_005', 15),
('PR_005', 'BP_001', 40),
('PR_005', 'BP_003', 10),
('PR_005', 'BP_004', 25),
('PR_005', 'BP_005', 15),
('PR_006', 'BP_001', 20),
('PR_006', 'BP_005', 13),
('PR_006', 'BP_003', 10),
('PR_006', 'BP_004', 25),
('PR_006', 'BP_002', 1),
('PR_007', 'BP_001', 20),
('PR_007', 'BP_002', 1),
('PR_007', 'BP_003', 10),
('PR_007', 'BP_004', 25),
('PR_007', 'BP_005', 13),
('PR_008', 'BP_001', 20),
('PR_008', 'BP_002', 1),
('PR_008', 'BP_003', 10),
('PR_008', 'BP_004', 25),
('PR_008', 'BP_005', 13),
('PR_009', 'BP_001', 20),
('PR_009', 'BP_002', 1),
('PR_009', 'BP_005', 13);

-- --------------------------------------------------------

--
-- Table structure for table `bop`
--

CREATE TABLE `bop` (
  `no_bop` varchar(100) NOT NULL,
  `tgl_bop` varchar(50) DEFAULT NULL,
  `bulan` varchar(100) NOT NULL,
  `tahun` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bop`
--

INSERT INTO `bop` (`no_bop`, `tgl_bop`, `bulan`, `tahun`) VALUES
('BOP_001', '2020-07-10', '0', '0'),
('BOP_002', '2020-07-11', '0', '0'),
('BOP_003', '2020-07-13', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `btk`
--

CREATE TABLE `btk` (
  `no_btk` varchar(100) NOT NULL,
  `tgl_btk` varchar(50) DEFAULT NULL,
  `bulan` varchar(100) NOT NULL,
  `tahun` varchar(100) NOT NULL,
  `jumlah_pgw` varchar(100) NOT NULL,
  `tarif` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `btk`
--

INSERT INTO `btk` (`no_btk`, `tgl_btk`, `bulan`, `tahun`, `jumlah_pgw`, `tarif`) VALUES
('BTK_001', '2020-07-10', '0', '0', '150', 15000000),
('BTK_002', '2020-07-11', '0', '0', '150', 15000000),
('BTK_003', '2020-07-13', '0', '0', '10', 15000000);

-- --------------------------------------------------------

--
-- Table structure for table `cek_kualitas`
--

CREATE TABLE `cek_kualitas` (
  `no_trans` varchar(50) NOT NULL,
  `tgl_trans` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `coa`
--

CREATE TABLE `coa` (
  `no_coa` int(11) NOT NULL,
  `nama_coa` varchar(50) NOT NULL,
  `jenis_coa` varchar(50) NOT NULL,
  `saldo_awal` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coa`
--

INSERT INTO `coa` (`no_coa`, `nama_coa`, `jenis_coa`, `saldo_awal`) VALUES
(1111, 'Kas', '', 0),
(1112, 'Persediaan Bahan Baku', '', 0),
(1113, 'Persediaan Bahan Penolong', '', 0),
(1114, 'Persediaan Produk Dalam Proses', '', 0),
(1311, 'Persediaan Produk Jadi IPS', '', 0),
(1312, 'Persediaan Produk Jadi Toko', '', 0),
(4111, 'Penjualan IPS', '', 0),
(4112, 'Penjualan Toko', '', 0),
(5111, 'Produk Dalam Proses - BBB', '', 0),
(5112, 'Produk Dalam Proses - BTK', '', 0),
(5113, 'Produk Dalam Proses - BOP', '', 0),
(5134, 'BOP Tetap Sesungguhnya', '', 0),
(5135, 'BOP Sesungguhnya', '', 0),
(5211, 'Beban Administrasi dan Umum Variabel', '', 0),
(5212, 'Beban Pemasaran Variabel', '', 0),
(5213, 'Beban Angkut Penjualan', '', 0),
(5221, 'Beban Listrik, Air dan Telepon', '', 0),
(5222, 'Beban Administrasi dan Umum Tetap', '', 0),
(5223, 'Beban Pemasaran Tetap', '', 0),
(5311, 'Beban Upah dan Gaji', '', 0),
(5312, 'BOP Dibebankan', '', 0),
(6111, 'Harga Pokok Penjualan IPS', '', 0),
(6112, 'Harga Pokok Penjualan Toko', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `detail_bop`
--

CREATE TABLE `detail_bop` (
  `no_bop` varchar(100) NOT NULL,
  `no_jbop` varchar(100) NOT NULL,
  `harga` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_bop`
--

INSERT INTO `detail_bop` (`no_bop`, `no_jbop`, `harga`) VALUES
('BOP_001', 'JBOP_001', 60147),
('BOP_001', 'JBOP_002', 15550),
('BOP_001', 'JBOP_003', 12750),
('BOP_001', 'JBOP_004', 79750),
('BOP_002', 'JBOP_001', 60147),
('BOP_002', 'JBOP_002', 15550),
('BOP_002', 'JBOP_003', 12750),
('BOP_002', 'JBOP_004', 79750),
('BOP_003', 'JBOP_001', 200000),
('BOP_003', 'JBOP_002', 200000),
('BOP_003', 'JBOP_003', 200000),
('BOP_003', 'JBOP_004', 200000);

-- --------------------------------------------------------

--
-- Table structure for table `detail_cek_kualitas`
--

CREATE TABLE `detail_cek_kualitas` (
  `no` int(11) NOT NULL,
  `no_trans` varchar(50) NOT NULL,
  `no_trans_pmb` varchar(50) NOT NULL,
  `lulus` varchar(50) NOT NULL,
  `gagal` varchar(50) NOT NULL,
  `total` varchar(50) NOT NULL,
  `subtotal` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detail_pembagian`
--

CREATE TABLE `detail_pembagian` (
  `no` int(11) NOT NULL,
  `no_trans` varchar(50) NOT NULL,
  `jual` varchar(50) NOT NULL,
  `produksi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detail_pembayaran`
--

CREATE TABLE `detail_pembayaran` (
  `no_trans` varchar(50) NOT NULL,
  `no_coa` varchar(50) NOT NULL,
  `subtotal` varchar(50) NOT NULL,
  `jenis_penjualan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detail_pembelian_bb`
--

CREATE TABLE `detail_pembelian_bb` (
  `no_trans` varchar(100) NOT NULL,
  `no_bb` varchar(100) NOT NULL,
  `jumlah` int(100) NOT NULL,
  `harga` varchar(50) NOT NULL,
  `subtotal` int(100) NOT NULL,
  `no_peternak` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detail_pembelian_bp`
--

CREATE TABLE `detail_pembelian_bp` (
  `no` int(11) NOT NULL,
  `no_trans` varchar(100) NOT NULL,
  `no_bp` varchar(100) NOT NULL,
  `jumlah` int(100) NOT NULL,
  `harga` varchar(50) NOT NULL,
  `subtotal` int(100) NOT NULL,
  `no_supp_bp` varchar(100) NOT NULL,
  `jumlah_kartu_stok` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan_ips`
--

CREATE TABLE `detail_penjualan_ips` (
  `no` int(11) NOT NULL,
  `no_trans` varchar(100) NOT NULL,
  `no_produk` varchar(100) NOT NULL,
  `jumlah` int(100) NOT NULL,
  `harga` varchar(50) NOT NULL,
  `subtotal` int(100) NOT NULL,
  `no_ips` varchar(100) NOT NULL,
  `jumlah_kartu_stok` varchar(50) NOT NULL,
  `hpp` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan_toko`
--

CREATE TABLE `detail_penjualan_toko` (
  `no` int(11) NOT NULL,
  `no_trans` varchar(50) NOT NULL,
  `no_produk` varchar(50) NOT NULL,
  `jumlah` varchar(50) NOT NULL,
  `harga` varchar(50) NOT NULL,
  `subtotal` varchar(50) NOT NULL,
  `hpp` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detail_produksi_ke1`
--

CREATE TABLE `detail_produksi_ke1` (
  `no` int(11) NOT NULL,
  `no_trans` varchar(50) NOT NULL,
  `no_produk` varchar(50) NOT NULL,
  `bbb` varchar(50) NOT NULL,
  `btk` varchar(50) NOT NULL,
  `bop` varchar(50) NOT NULL,
  `subtotal` varchar(50) NOT NULL,
  `jumlah` varchar(50) NOT NULL,
  `stok_jual` varchar(50) DEFAULT NULL,
  `jumlah_kartu_stok` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detail_produksi_ke2`
--

CREATE TABLE `detail_produksi_ke2` (
  `no` int(11) NOT NULL,
  `no_trans` varchar(50) NOT NULL,
  `tgl_trans` varchar(50) NOT NULL,
  `no_produk` varchar(50) NOT NULL,
  `bbb` varchar(50) NOT NULL,
  `btk` varchar(50) NOT NULL,
  `bop` varchar(50) NOT NULL,
  `bp` varchar(50) DEFAULT NULL,
  `subtotal` varchar(50) NOT NULL,
  `jumlah` varchar(50) NOT NULL,
  `jumlah_kartu_stok` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detail_target_produksi`
--

CREATE TABLE `detail_target_produksi` (
  `no` int(11) NOT NULL,
  `no_tp` varchar(100) NOT NULL,
  `no_produk` varchar(100) NOT NULL,
  `jumlah` int(100) NOT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_bop`
--

CREATE TABLE `jenis_bop` (
  `no_jbop` varchar(50) NOT NULL,
  `nama_jbop` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_bop`
--

INSERT INTO `jenis_bop` (`no_jbop`, `nama_jbop`) VALUES
('JBOP_001', 'Beban Listrik'),
('JBOP_002', 'Beban Air'),
('JBOP_003', 'Beban Gas'),
('JBOP_004', 'Beban Overhead Pabrik Lainnya');

-- --------------------------------------------------------

--
-- Table structure for table `jurnal`
--

CREATE TABLE `jurnal` (
  `no` int(11) NOT NULL,
  `id_jurnal` varchar(100) NOT NULL,
  `tgl_jurnal` varchar(100) NOT NULL,
  `no_coa` int(100) NOT NULL,
  `posisi_dr_cr` varchar(100) NOT NULL,
  `nominal` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jurnal`
--

INSERT INTO `jurnal` (`no`, `id_jurnal`, `tgl_jurnal`, `no_coa`, `posisi_dr_cr`, `nominal`) VALUES
(1, 'CK_001', '2020-07-13', 1112, 'd', 700000000),
(2, 'CK_001', '2020-07-13', 1111, 'k', 700000000),
(3, 'CK_002', '2020-07-13', 1112, 'd', 700000000),
(4, 'CK_002', '2020-07-13', 1111, 'k', 700000000),
(5, 'CK_003', '2020-07-13', 1112, 'd', 700000000),
(6, 'CK_003', '2020-07-13', 1111, 'k', 700000000),
(7, 'CK_004', '2020-07-13', 1112, 'd', 700000000),
(8, 'CK_004', '2020-07-13', 1111, 'k', 700000000),
(9, 'PROD1_001', '2020-07-13', 5111, 'd', 700000000),
(10, 'PROD1_001', '2020-07-13', 1112, 'k', 700000000),
(11, 'PROD1_001', '2020-07-13', 5112, 'd', 15000000),
(12, 'PROD1_001', '2020-07-13', 5311, 'k', 15000000),
(13, 'PROD1_001', '2020-07-13', 5113, 'd', 800000),
(14, 'PROD1_001', '2020-07-13', 5312, 'k', 800000),
(15, 'PROD1_002', '2020-07-13', 5111, 'd', 700000000),
(16, 'PROD1_002', '2020-07-13', 1112, 'k', 700000000),
(17, 'PROD1_002', '2020-07-13', 5112, 'd', 15000000),
(18, 'PROD1_002', '2020-07-13', 5311, 'k', 15000000),
(19, 'PROD1_002', '2020-07-13', 5113, 'd', 800000),
(20, 'PROD1_002', '2020-07-13', 5312, 'k', 800000),
(21, 'PROD1_003', '2020-07-13', 5111, 'd', 700000000),
(22, 'PROD1_003', '2020-07-13', 1112, 'k', 700000000),
(23, 'PROD1_003', '2020-07-13', 5112, 'd', 15000000),
(24, 'PROD1_003', '2020-07-13', 5311, 'k', 15000000),
(25, 'PROD1_003', '2020-07-13', 5113, 'd', 800000),
(26, 'PROD1_003', '2020-07-13', 5312, 'k', 800000),
(27, 'PROD1_004', '2020-07-13', 5111, 'd', 700000000),
(28, 'PROD1_004', '2020-07-13', 1112, 'k', 700000000),
(29, 'PROD1_004', '2020-07-13', 5112, 'd', 15000000),
(30, 'PROD1_004', '2020-07-13', 5311, 'k', 15000000),
(31, 'PROD1_004', '2020-07-13', 5113, 'd', 800000),
(32, 'PROD1_004', '2020-07-13', 5312, 'k', 800000),
(33, 'PGB_001', '2020-07-13', 1114, 'd', 51128571),
(34, 'PGB_001', '2020-07-13', 5111, 'k', 50000000),
(35, 'PGB_001', '2020-07-13', 5112, 'k', 1071429),
(36, 'PGB_001', '2020-07-13', 5113, 'k', 57143),
(37, 'PGB_001', '2020-07-13', 1311, 'd', 664671429),
(38, 'PGB_001', '2020-07-13', 5111, 'k', 650000000),
(39, 'PGB_001', '2020-07-13', 5112, 'k', 13928571),
(40, 'PGB_001', '2020-07-13', 5113, 'k', 742857),
(41, 'PGB_002', '2020-07-13', 1114, 'd', 51128571),
(42, 'PGB_002', '2020-07-13', 5111, 'k', 50000000),
(43, 'PGB_002', '2020-07-13', 5112, 'k', 1071429),
(44, 'PGB_002', '2020-07-13', 5113, 'k', 57143),
(45, 'PGB_002', '2020-07-13', 1311, 'd', 664671429),
(46, 'PGB_002', '2020-07-13', 5111, 'k', 650000000),
(47, 'PGB_002', '2020-07-13', 5112, 'k', 13928571),
(48, 'PGB_002', '2020-07-13', 5113, 'k', 742857),
(49, 'PGB_003', '2020-07-13', 1114, 'd', 51128571),
(50, 'PGB_003', '2020-07-13', 5111, 'k', 50000000),
(51, 'PGB_003', '2020-07-13', 5112, 'k', 1071429),
(52, 'PGB_003', '2020-07-13', 5113, 'k', 57143),
(53, 'PGB_003', '2020-07-13', 1311, 'd', 664671429),
(54, 'PGB_003', '2020-07-13', 5111, 'k', 650000000),
(55, 'PGB_003', '2020-07-13', 5112, 'k', 13928571),
(56, 'PGB_003', '2020-07-13', 5113, 'k', 742857),
(57, 'PGB_004', '2020-07-13', 1114, 'd', 51128571),
(58, 'PGB_004', '2020-07-13', 5111, 'k', 50000000),
(59, 'PGB_004', '2020-07-13', 5112, 'k', 1071429),
(60, 'PGB_004', '2020-07-13', 5113, 'k', 57143),
(61, 'PGB_004', '2020-07-13', 1311, 'd', 664671429),
(62, 'PGB_004', '2020-07-13', 5111, 'k', 650000000),
(63, 'PGB_004', '2020-07-13', 5112, 'k', 13928571),
(64, 'PGB_004', '2020-07-13', 5113, 'k', 742857),
(65, 'PMBP_001', '2020-07-13', 1113, 'd', 230000000),
(66, 'PMBP_001', '2020-07-13', 1111, 'k', 230000000),
(67, 'PMBP_001', '2020-07-13', 1113, 'd', 230000000),
(68, 'PMBP_001', '2020-07-13', 1111, 'k', 230000000),
(69, 'PROD2_001', '2020-07-13', 5112, 'd', 4500000),
(70, 'PROD2_001', '2020-07-13', 5311, 'k', 4500000),
(71, 'PROD2_001', '2020-07-13', 5113, 'd', 800000),
(72, 'PROD2_001', '2020-07-13', 5312, 'k', 800000),
(73, 'PROD2_001', '2020-07-13', 5135, 'd', 270000),
(74, 'PROD2_001', '2020-07-13', 1113, 'k', 270000),
(75, 'PROD2_001', '2020-07-13', 1312, 'd', 20908571),
(76, 'PROD2_001', '2020-07-13', 1114, 'k', 15338571),
(77, 'PROD2_001', '2020-07-13', 5112, 'k', 4500000),
(78, 'PROD2_001', '2020-07-13', 5113, 'k', 1070000),
(79, 'PROD2_001', '2020-07-13', 5112, 'd', 1500000),
(80, 'PROD2_001', '2020-07-13', 5311, 'k', 1500000),
(81, 'PROD2_001', '2020-07-13', 5113, 'd', 800000),
(82, 'PROD2_001', '2020-07-13', 5312, 'k', 800000),
(83, 'PROD2_001', '2020-07-13', 5135, 'd', 335000),
(84, 'PROD2_001', '2020-07-13', 1113, 'k', 335000),
(85, 'PROD2_001', '2020-07-13', 1312, 'd', 7747857),
(86, 'PROD2_001', '2020-07-13', 1114, 'k', 5112857),
(87, 'PROD2_001', '2020-07-13', 5112, 'k', 1500000),
(88, 'PROD2_001', '2020-07-13', 5113, 'k', 1135000),
(89, 'PROD2_001', '2020-07-13', 5112, 'd', 1500000),
(90, 'PROD2_001', '2020-07-13', 5311, 'k', 1500000),
(91, 'PROD2_001', '2020-07-13', 5113, 'd', 800000),
(92, 'PROD2_001', '2020-07-13', 5312, 'k', 800000),
(93, 'PROD2_001', '2020-07-13', 5135, 'd', 335000),
(94, 'PROD2_001', '2020-07-13', 1113, 'k', 335000),
(95, 'PROD2_001', '2020-07-13', 1312, 'd', 7747857),
(96, 'PROD2_001', '2020-07-13', 1114, 'k', 5112857),
(97, 'PROD2_001', '2020-07-13', 5112, 'k', 1500000),
(98, 'PROD2_001', '2020-07-13', 5113, 'k', 1135000),
(99, 'PROD2_001', '2020-07-13', 5112, 'd', 7500000),
(100, 'PROD2_001', '2020-07-13', 5311, 'k', 7500000),
(101, 'PROD2_001', '2020-07-13', 5113, 'd', 800000),
(102, 'PROD2_001', '2020-07-13', 5312, 'k', 800000),
(103, 'PROD2_001', '2020-07-13', 5135, 'd', 1675000),
(104, 'PROD2_001', '2020-07-13', 1113, 'k', 1675000),
(105, 'PROD2_001', '2020-07-13', 1312, 'd', 35539286),
(106, 'PROD2_001', '2020-07-13', 1114, 'k', 25564286),
(107, 'PROD2_001', '2020-07-13', 5112, 'k', 7500000),
(108, 'PROD2_001', '2020-07-13', 5113, 'k', 2475000),
(109, 'PROD2_002', '2020-07-13', 5112, 'd', 6000000),
(110, 'PROD2_002', '2020-07-13', 5311, 'k', 6000000),
(111, 'PROD2_002', '2020-07-13', 5113, 'd', 800000),
(112, 'PROD2_002', '2020-07-13', 5312, 'k', 800000),
(113, 'PROD2_002', '2020-07-13', 5135, 'd', 360000),
(114, 'PROD2_002', '2020-07-13', 1113, 'k', 360000),
(115, 'PROD2_002', '2020-07-13', 1312, 'd', 27611428),
(116, 'PROD2_002', '2020-07-13', 1114, 'k', 20451428),
(117, 'PROD2_002', '2020-07-13', 5112, 'k', 6000000),
(118, 'PROD2_002', '2020-07-13', 5113, 'k', 1160000),
(119, 'PROD2_002', '2020-07-13', 5112, 'd', 3000000),
(120, 'PROD2_002', '2020-07-13', 5311, 'k', 3000000),
(121, 'PROD2_002', '2020-07-13', 5113, 'd', 800000),
(122, 'PROD2_002', '2020-07-13', 5312, 'k', 800000),
(123, 'PROD2_002', '2020-07-13', 5135, 'd', 670000),
(124, 'PROD2_002', '2020-07-13', 1113, 'k', 670000),
(125, 'PROD2_002', '2020-07-13', 1312, 'd', 14695714),
(126, 'PROD2_002', '2020-07-13', 1114, 'k', 10225714),
(127, 'PROD2_002', '2020-07-13', 5112, 'k', 3000000),
(128, 'PROD2_002', '2020-07-13', 5113, 'k', 1470000),
(129, 'PROD2_002', '2020-07-13', 5112, 'd', 3000000),
(130, 'PROD2_002', '2020-07-13', 5311, 'k', 3000000),
(131, 'PROD2_002', '2020-07-13', 5113, 'd', 800000),
(132, 'PROD2_002', '2020-07-13', 5312, 'k', 800000),
(133, 'PROD2_002', '2020-07-13', 5135, 'd', 670000),
(134, 'PROD2_002', '2020-07-13', 1113, 'k', 670000),
(135, 'PROD2_002', '2020-07-13', 1312, 'd', 14695714),
(136, 'PROD2_002', '2020-07-13', 1114, 'k', 10225714),
(137, 'PROD2_002', '2020-07-13', 5112, 'k', 3000000),
(138, 'PROD2_002', '2020-07-13', 5113, 'k', 1470000),
(139, 'PROD2_002', '2020-07-13', 5112, 'd', 3000000),
(140, 'PROD2_002', '2020-07-13', 5311, 'k', 3000000),
(141, 'PROD2_002', '2020-07-13', 5113, 'd', 800000),
(142, 'PROD2_002', '2020-07-13', 5312, 'k', 800000),
(143, 'PROD2_002', '2020-07-13', 5135, 'd', 670000),
(144, 'PROD2_002', '2020-07-13', 1113, 'k', 670000),
(145, 'PROD2_002', '2020-07-13', 1312, 'd', 14695714),
(146, 'PROD2_002', '2020-07-13', 1114, 'k', 10225714),
(147, 'PROD2_002', '2020-07-13', 5112, 'k', 3000000),
(148, 'PROD2_002', '2020-07-13', 5113, 'k', 1470000),
(149, 'PROD2_003', '2020-07-13', 5112, 'd', 7500000),
(150, 'PROD2_003', '2020-07-13', 5311, 'k', 7500000),
(151, 'PROD2_003', '2020-07-13', 5113, 'd', 800000),
(152, 'PROD2_003', '2020-07-13', 5312, 'k', 800000),
(153, 'PROD2_003', '2020-07-13', 5135, 'd', 450000),
(154, 'PROD2_003', '2020-07-13', 1113, 'k', 450000),
(155, 'PROD2_003', '2020-07-13', 1312, 'd', 34314286),
(156, 'PROD2_003', '2020-07-13', 1114, 'k', 25564286),
(157, 'PROD2_003', '2020-07-13', 5112, 'k', 7500000),
(158, 'PROD2_003', '2020-07-13', 5113, 'k', 1250000),
(159, 'PROD2_003', '2020-07-13', 5112, 'd', 1500000),
(160, 'PROD2_003', '2020-07-13', 5311, 'k', 1500000),
(161, 'PROD2_003', '2020-07-13', 5113, 'd', 800000),
(162, 'PROD2_003', '2020-07-13', 5312, 'k', 800000),
(163, 'PROD2_003', '2020-07-13', 5135, 'd', 335000),
(164, 'PROD2_003', '2020-07-13', 1113, 'k', 335000),
(165, 'PROD2_003', '2020-07-13', 1312, 'd', 7747857),
(166, 'PROD2_003', '2020-07-13', 1114, 'k', 5112857),
(167, 'PROD2_003', '2020-07-13', 5112, 'k', 1500000),
(168, 'PROD2_003', '2020-07-13', 5113, 'k', 1135000),
(169, 'PROD2_003', '2020-07-13', 5112, 'd', 4500000),
(170, 'PROD2_003', '2020-07-13', 5311, 'k', 4500000),
(171, 'PROD2_003', '2020-07-13', 5113, 'd', 800000),
(172, 'PROD2_003', '2020-07-13', 5312, 'k', 800000),
(173, 'PROD2_003', '2020-07-13', 5135, 'd', 1005000),
(174, 'PROD2_003', '2020-07-13', 1113, 'k', 1005000),
(175, 'PROD2_003', '2020-07-13', 1312, 'd', 21643571),
(176, 'PROD2_003', '2020-07-13', 1114, 'k', 15338571),
(177, 'PROD2_003', '2020-07-13', 5112, 'k', 4500000),
(178, 'PROD2_003', '2020-07-13', 5113, 'k', 1805000),
(179, 'PROD2_003', '2020-07-13', 5112, 'd', 1500000),
(180, 'PROD2_003', '2020-07-13', 5311, 'k', 1500000),
(181, 'PROD2_003', '2020-07-13', 5113, 'd', 800000),
(182, 'PROD2_003', '2020-07-13', 5312, 'k', 800000),
(183, 'PROD2_003', '2020-07-13', 5135, 'd', 335000),
(184, 'PROD2_003', '2020-07-13', 1113, 'k', 335000),
(185, 'PROD2_003', '2020-07-13', 1312, 'd', 7747857),
(186, 'PROD2_003', '2020-07-13', 1114, 'k', 5112857),
(187, 'PROD2_003', '2020-07-13', 5112, 'k', 1500000),
(188, 'PROD2_003', '2020-07-13', 5113, 'k', 1135000),
(189, 'PROD2_004', '2020-07-13', 5112, 'd', 9000000),
(190, 'PROD2_004', '2020-07-13', 5311, 'k', 9000000),
(191, 'PROD2_004', '2020-07-13', 5113, 'd', 800000),
(192, 'PROD2_004', '2020-07-13', 5312, 'k', 800000),
(193, 'PROD2_004', '2020-07-13', 5135, 'd', 540000),
(194, 'PROD2_004', '2020-07-13', 1113, 'k', 540000),
(195, 'PROD2_004', '2020-07-13', 1312, 'd', 41017143),
(196, 'PROD2_004', '2020-07-13', 1114, 'k', 30677143),
(197, 'PROD2_004', '2020-07-13', 5112, 'k', 9000000),
(198, 'PROD2_004', '2020-07-13', 5113, 'k', 1340000),
(199, 'PROD2_004', '2020-07-13', 5112, 'd', 2250000),
(200, 'PROD2_004', '2020-07-13', 5311, 'k', 2250000),
(201, 'PROD2_004', '2020-07-13', 5113, 'd', 800000),
(202, 'PROD2_004', '2020-07-13', 5312, 'k', 800000),
(203, 'PROD2_004', '2020-07-13', 5135, 'd', 502500),
(204, 'PROD2_004', '2020-07-13', 1113, 'k', 502500),
(205, 'PROD2_004', '2020-07-13', 1312, 'd', 11221786),
(206, 'PROD2_004', '2020-07-13', 1114, 'k', 7669286),
(207, 'PROD2_004', '2020-07-13', 5112, 'k', 2250000),
(208, 'PROD2_004', '2020-07-13', 5113, 'k', 1302500),
(209, 'PROD2_004', '2020-07-13', 5112, 'd', 2250000),
(210, 'PROD2_004', '2020-07-13', 5311, 'k', 2250000),
(211, 'PROD2_004', '2020-07-13', 5113, 'd', 800000),
(212, 'PROD2_004', '2020-07-13', 5312, 'k', 800000),
(213, 'PROD2_004', '2020-07-13', 5135, 'd', 502500),
(214, 'PROD2_004', '2020-07-13', 1113, 'k', 502500),
(215, 'PROD2_004', '2020-07-13', 1312, 'd', 11221786),
(216, 'PROD2_004', '2020-07-13', 1114, 'k', 7669286),
(217, 'PROD2_004', '2020-07-13', 5112, 'k', 2250000),
(218, 'PROD2_004', '2020-07-13', 5113, 'k', 1302500),
(219, 'PROD2_004', '2020-07-13', 5112, 'd', 1500000),
(220, 'PROD2_004', '2020-07-13', 5311, 'k', 1500000),
(221, 'PROD2_004', '2020-07-13', 5113, 'd', 800000),
(222, 'PROD2_004', '2020-07-13', 5312, 'k', 800000),
(223, 'PROD2_004', '2020-07-13', 5135, 'd', 335000),
(224, 'PROD2_004', '2020-07-13', 1113, 'k', 335000),
(225, 'PROD2_004', '2020-07-13', 1312, 'd', 7747857),
(226, 'PROD2_004', '2020-07-13', 1114, 'k', 5112857),
(227, 'PROD2_004', '2020-07-13', 5112, 'k', 1500000),
(228, 'PROD2_004', '2020-07-13', 5113, 'k', 1135000);

-- --------------------------------------------------------

--
-- Table structure for table `kartu_stok_bp`
--

CREATE TABLE `kartu_stok_bp` (
  `no` int(11) NOT NULL,
  `no_trans` varchar(50) DEFAULT NULL,
  `tgl_trans` varchar(50) DEFAULT NULL,
  `no_produk` varchar(50) DEFAULT NULL,
  `no_bp` varchar(50) DEFAULT NULL,
  `unit1` varchar(50) DEFAULT NULL,
  `harga1` varchar(50) DEFAULT NULL,
  `total1` varchar(50) DEFAULT NULL,
  `unit2` varchar(50) DEFAULT NULL,
  `harga2` varchar(50) DEFAULT NULL,
  `total2` varchar(50) DEFAULT NULL,
  `unit3` varchar(50) DEFAULT NULL,
  `harga3` varchar(50) DEFAULT NULL,
  `total3` varchar(50) DEFAULT NULL,
  `status_pro` varchar(50) NOT NULL,
  `status_pen` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kartu_stok_penj`
--

CREATE TABLE `kartu_stok_penj` (
  `no` int(11) NOT NULL,
  `no_trans` varchar(50) DEFAULT NULL,
  `tgl_trans` varchar(50) DEFAULT NULL,
  `no_produk` varchar(50) DEFAULT NULL,
  `unit1` varchar(50) DEFAULT NULL,
  `harga1` varchar(50) DEFAULT NULL,
  `total1` varchar(50) DEFAULT NULL,
  `unit2` varchar(50) DEFAULT NULL,
  `harga2` varchar(50) DEFAULT NULL,
  `total2` varchar(50) DEFAULT NULL,
  `unit3` varchar(50) DEFAULT NULL,
  `harga3` varchar(50) DEFAULT NULL,
  `total3` varchar(50) DEFAULT NULL,
  `status_pro` varchar(50) DEFAULT NULL,
  `status_pen` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `konsumen_ips`
--

CREATE TABLE `konsumen_ips` (
  `no_ips` varchar(100) NOT NULL,
  `nama_ips` varchar(100) NOT NULL,
  `notel` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `konsumen_ips`
--

INSERT INTO `konsumen_ips` (`no_ips`, `nama_ips`, `notel`, `alamat`) VALUES
('IPS_001', 'PT. Ultrajaya', '02286700700', 'Jl. Raya Cimareme 131, Padalarang, Bandung'),
('IPS_002', 'Frisian Flag', '0218410945', 'Jl. Raya Bogor KM 5, Pasar Rebo, Jakarta Timur'),
('IPS_003', 'PT. Cimory', ' 0227538770', 'Jalan Batununggal Indah No.61, Mengger, Bandung Ki');

-- --------------------------------------------------------

--
-- Table structure for table `pembagian`
--

CREATE TABLE `pembagian` (
  `no_trans` varchar(50) NOT NULL,
  `tgl_trans` varchar(50) NOT NULL,
  `no_trans_produksi1` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `status_penjs` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `no_trans` varchar(50) NOT NULL,
  `tgl_trans` varchar(50) NOT NULL,
  `total` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_bb`
--

CREATE TABLE `pembelian_bb` (
  `no_trans` varchar(100) NOT NULL,
  `tgl_trans` date NOT NULL,
  `total` int(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_bp`
--

CREATE TABLE `pembelian_bp` (
  `no_trans` varchar(100) NOT NULL,
  `tgl_trans` varchar(100) NOT NULL,
  `total` int(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_ips`
--

CREATE TABLE `penjualan_ips` (
  `no_trans` varchar(100) NOT NULL,
  `tgl_trans` date NOT NULL,
  `jumlah` varchar(50) NOT NULL,
  `total` int(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `no_trans_pembg` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_toko`
--

CREATE TABLE `penjualan_toko` (
  `no_trans` varchar(50) NOT NULL,
  `tgl_trans` varchar(50) NOT NULL,
  `total` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `peternak`
--

CREATE TABLE `peternak` (
  `no_peternak` varchar(100) NOT NULL,
  `nama_peternak` varchar(100) NOT NULL,
  `notel` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peternak`
--

INSERT INTO `peternak` (`no_peternak`, `nama_peternak`, `notel`, `alamat`) VALUES
('PTRNK_001', 'Andi', '081297276888', 'Cimahi'),
('PTRNK_002', 'Joko', '0811301180', 'Bandung'),
('PTRNK_003', 'Budi', '082337317510', 'Bandung Barat'),
('PTRNK_004', 'Adi', '082293294071', 'Lembang'),
('PTRNK_005', 'Indra', '082113572468', 'Cimahi'),
('PTRNK_006', 'Asep', '081284871175', 'Padalarang'),
('PTRNK_007', 'Andre', '082117675927', 'Bandung'),
('PTRNK_008', 'Azis', '082285701109', 'Bandung Barat'),
('PTRNK_009', 'Arif', '082170370037', 'Cimahi'),
('PTRNK_010', 'Ibrahim', '082126407059', 'Padalarang'),
('PTRNK_011', 'Agung', '082214902233', 'Bandung'),
('PTRNK_012', 'Adit', '08112009484', 'Lembang'),
('PTRNK_013', 'Gatot', '081295861043', 'Bandung'),
('PTRNK_014', 'Taufiq', '081231197192', 'Cimahi'),
('PTRNK_015', 'Iwan', '081259468020', 'Bandung Barat');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `no_produk` varchar(50) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `stok` int(50) NOT NULL,
  `harga_jual` varchar(50) NOT NULL,
  `satuan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`no_produk`, `nama_produk`, `stok`, `harga_jual`, `satuan`) VALUES
('PR_001', 'Susu Sapi', 0, '6646.7142857143', 'liter'),
('PR_002', 'Susu Murni', 0, '8944.8253411111', 'liter'),
('PR_003', 'Pasteur Coklat', 0, '9788.5778663636', 'liter'),
('PR_004', 'Pasteur Vanila', 0, '9586.8808966667', 'liter'),
('PR_005', 'Pasteur Strawberry', 0, '9494.4364522222', 'liter'),
('PR_006', 'Yoghurt Strawberry', 0, '27569.823002192', 'liter'),
('PR_007', 'Yoghurt Anggur', 0, '27569.823002192', 'liter'),
('PR_008', 'Yoghurt Melon', 0, '27569.823002192', 'liter'),
('PR_009', 'Yoghurt Plain', 0, '22092.994938951', 'liter');

-- --------------------------------------------------------

--
-- Table structure for table `produksi_ke1`
--

CREATE TABLE `produksi_ke1` (
  `no_trans` varchar(50) NOT NULL,
  `tgl_trans` varchar(50) NOT NULL,
  `no_trans_ck` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `produksi_ke2`
--

CREATE TABLE `produksi_ke2` (
  `no_trans` varchar(50) NOT NULL,
  `tgl_trans` varchar(50) NOT NULL,
  `no_tp` varchar(50) NOT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `supplier_bp`
--

CREATE TABLE `supplier_bp` (
  `no_supp_bp` varchar(100) NOT NULL,
  `nama_supp_bp` varchar(100) NOT NULL,
  `notel` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier_bp`
--

INSERT INTO `supplier_bp` (`no_supp_bp`, `nama_supp_bp`, `notel`, `alamat`) VALUES
('SBP_001', 'Putra Pribumi', '081326789678', 'Lembang'),
('SBP_002', 'Toko Fajar', '085224789657', 'Lembang'),
('SBP_003', 'Maju Jaya', '081278654456', 'Lembang'),
('SBP_004', 'Sekar Sejati', '081396578564', 'Lembang'),
('SBP_005', 'Berkah Bersama', '085783643509', 'Lembang');

-- --------------------------------------------------------

--
-- Table structure for table `target_produksi`
--

CREATE TABLE `target_produksi` (
  `no_tp` varchar(100) NOT NULL,
  `tanggal` varchar(100) NOT NULL,
  `tgl_tp` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `no_trans_pembagian` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `update_stok_penj`
--

CREATE TABLE `update_stok_penj` (
  `no` int(11) NOT NULL,
  `no_trans` varchar(50) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `harga` varchar(50) NOT NULL,
  `nominal` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `nama_lengkap` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`nama_lengkap`, `username`, `password`, `level`) VALUES
('Super Admin', 'admin', 'admin', 'admin'),
('Keuangan', 'keuangan1', 'keuangan1', 'keuangan1'),
('Keuangan', 'keuangan2', 'keuangan2', 'keuangan2'),
('Keuangan', 'keuangan3', 'keuangan3', 'keuangan3'),
('Penjualan', 'penjualan', 'penjualan', 'penjualan'),
('Produksi', 'produksi1', 'produksi1', 'produksi1'),
('Produksi', 'produksi2', 'produksi2', 'produksi2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bahan_baku`
--
ALTER TABLE `bahan_baku`
  ADD PRIMARY KEY (`no_bb`);

--
-- Indexes for table `bahan_dalam_proses`
--
ALTER TABLE `bahan_dalam_proses`
  ADD PRIMARY KEY (`no_bdp`);

--
-- Indexes for table `bahan_penolong`
--
ALTER TABLE `bahan_penolong`
  ADD PRIMARY KEY (`no_bp`);

--
-- Indexes for table `bop`
--
ALTER TABLE `bop`
  ADD PRIMARY KEY (`no_bop`);

--
-- Indexes for table `btk`
--
ALTER TABLE `btk`
  ADD PRIMARY KEY (`no_btk`);

--
-- Indexes for table `cek_kualitas`
--
ALTER TABLE `cek_kualitas`
  ADD PRIMARY KEY (`no_trans`);

--
-- Indexes for table `coa`
--
ALTER TABLE `coa`
  ADD PRIMARY KEY (`no_coa`);

--
-- Indexes for table `detail_cek_kualitas`
--
ALTER TABLE `detail_cek_kualitas`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `detail_pembagian`
--
ALTER TABLE `detail_pembagian`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `detail_pembelian_bp`
--
ALTER TABLE `detail_pembelian_bp`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `detail_penjualan_ips`
--
ALTER TABLE `detail_penjualan_ips`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `detail_penjualan_toko`
--
ALTER TABLE `detail_penjualan_toko`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `detail_produksi_ke1`
--
ALTER TABLE `detail_produksi_ke1`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `detail_produksi_ke2`
--
ALTER TABLE `detail_produksi_ke2`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `detail_target_produksi`
--
ALTER TABLE `detail_target_produksi`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `jenis_bop`
--
ALTER TABLE `jenis_bop`
  ADD PRIMARY KEY (`no_jbop`);

--
-- Indexes for table `jurnal`
--
ALTER TABLE `jurnal`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `kartu_stok_bp`
--
ALTER TABLE `kartu_stok_bp`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `kartu_stok_penj`
--
ALTER TABLE `kartu_stok_penj`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `pembagian`
--
ALTER TABLE `pembagian`
  ADD PRIMARY KEY (`no_trans`);

--
-- Indexes for table `pembelian_bb`
--
ALTER TABLE `pembelian_bb`
  ADD PRIMARY KEY (`no_trans`);

--
-- Indexes for table `penjualan_ips`
--
ALTER TABLE `penjualan_ips`
  ADD PRIMARY KEY (`no_trans`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`no_produk`);

--
-- Indexes for table `update_stok_penj`
--
ALTER TABLE `update_stok_penj`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_cek_kualitas`
--
ALTER TABLE `detail_cek_kualitas`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_pembagian`
--
ALTER TABLE `detail_pembagian`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_pembelian_bp`
--
ALTER TABLE `detail_pembelian_bp`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_penjualan_ips`
--
ALTER TABLE `detail_penjualan_ips`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_penjualan_toko`
--
ALTER TABLE `detail_penjualan_toko`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_produksi_ke1`
--
ALTER TABLE `detail_produksi_ke1`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_produksi_ke2`
--
ALTER TABLE `detail_produksi_ke2`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_target_produksi`
--
ALTER TABLE `detail_target_produksi`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jurnal`
--
ALTER TABLE `jurnal`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=229;

--
-- AUTO_INCREMENT for table `kartu_stok_bp`
--
ALTER TABLE `kartu_stok_bp`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kartu_stok_penj`
--
ALTER TABLE `kartu_stok_penj`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `update_stok_penj`
--
ALTER TABLE `update_stok_penj`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
