-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2020 at 10:07 PM
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
-- Database: `kpsbu1`
--

-- --------------------------------------------------------

--
-- Table structure for table `bahan_baku`
--

CREATE TABLE `bahan_baku` (
  `no_bb` varchar(50) NOT NULL,
  `nama_bb` varchar(50) NOT NULL,
  `harga` int(50) NOT NULL,
  `satuan` varchar(50) DEFAULT NULL,
  `stok` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bahan_baku`
--

INSERT INTO `bahan_baku` (`no_bb`, `nama_bb`, `harga`, `satuan`, `stok`) VALUES
('BB_001', 'Susu Sapi', 5000, 'liter', 4528);

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
('BDP_001', 'Susu Sapi', '431', 'liter');

-- --------------------------------------------------------

--
-- Table structure for table `bahan_penolong`
--

CREATE TABLE `bahan_penolong` (
  `no_bp` varchar(100) NOT NULL,
  `nama_bp` varchar(100) NOT NULL,
  `harga` int(100) NOT NULL,
  `satuan` varchar(100) DEFAULT NULL,
  `stok` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bahan_penolong`
--

INSERT INTO `bahan_penolong` (`no_bp`, `nama_bp`, `harga`, `satuan`, `stok`) VALUES
('BP_001', 'Gula', 11500, 'kg', 602),
('BP_002', 'Bubuk Biang Yoghurt 20 gr', 74500, 'buah', 160),
('BP_003', 'Pewarna Makanan 30 ml', 4500, 'buah', 643),
('BP_004', 'Perisa Makanan', 7500, 'buah', 920),
('BP_005', 'Garam', 10000, 'kg', 352);

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
('PR_002', 'BB_001', 1),
('PR_002', 'BP_001', 1),
('PR_002', 'BP_005', 1),
('PR_004', 'BB_001', 1),
('PR_004', 'BP_001', 1),
('PR_004', 'BP_002', 1),
('PR_004', 'BP_003', 1),
('PR_004', 'BP_005', 1),
('PR_005', 'BB_001', 1),
('PR_005', 'BP_001', 1),
('PR_005', 'BP_002', 1),
('PR_005', 'BP_003', 1),
('PR_005', 'BP_005', 1),
('PR_006', 'BB_001', 1),
('PR_006', 'BP_001', 1),
('PR_006', 'BP_002', 1),
('PR_006', 'BP_003', 1),
('PR_006', 'BP_005', 1),
('PR_007', 'BB_001', 1),
('PR_007', 'BP_001', 1),
('PR_007', 'BP_002', 1),
('PR_007', 'BP_003', 1),
('PR_007', 'BP_005', 1),
('PR_008', 'BB_001', 1),
('PR_008', 'BP_001', 1),
('PR_008', 'BP_002', 1),
('PR_008', 'BP_003', 1),
('PR_008', 'BP_005', 1),
('PR_009', 'BB_001', 1),
('PR_009', 'BP_001', 1),
('PR_009', 'BP_002', 1),
('PR_009', 'BP_003', 1),
('PR_009', 'BP_004', 1),
('PR_009', 'BP_005', 1),
('PR_003', 'BB_001', 1),
('PR_003', 'BP_001', 1),
('PR_003', 'BP_002', 1),
('PR_003', 'BP_005', 1),
('PR_003', 'BP_004', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bop`
--

CREATE TABLE `bop` (
  `no_bop` varchar(100) NOT NULL,
  `bulan` varchar(100) NOT NULL,
  `tahun` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bop`
--

INSERT INTO `bop` (`no_bop`, `bulan`, `tahun`) VALUES
('BOP_001', '05', '2020');

-- --------------------------------------------------------

--
-- Table structure for table `btk`
--

CREATE TABLE `btk` (
  `no_btk` varchar(100) NOT NULL,
  `bulan` varchar(100) NOT NULL,
  `tahun` varchar(100) NOT NULL,
  `jumlah_pgw` varchar(100) NOT NULL,
  `tarif` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `btk`
--

INSERT INTO `btk` (`no_btk`, `bulan`, `tahun`, `jumlah_pgw`, `tarif`) VALUES
('BTK_001', '06', '2020', '10', 12000000),
('BTK_002', '05', '2020', '10', 12000000),
('BTK_003', '07', '2020', '10', 9300000);

-- --------------------------------------------------------

--
-- Table structure for table `cek_kualitas`
--

CREATE TABLE `cek_kualitas` (
  `no_trans` varchar(50) NOT NULL,
  `tgl_trans` varchar(50) NOT NULL,
  `no_trans_pembb` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cek_kualitas`
--

INSERT INTO `cek_kualitas` (`no_trans`, `tgl_trans`, `no_trans_pembb`, `status`) VALUES
('CK_001', '2020-05-24', 'PMB_001', '2'),
('CK_002', '2020-05-30', 'PMB_002', '2'),
('CK_003', '2020-05-30', 'PMB_003', '0'),
('CK_004', '2020-05-31', 'PMB_005', '2'),
('CK_005', '2020-05-31', 'PMB_004', '2'),
('CK_006', '2020-05-31', 'PMB_006', '2');

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
(4111, 'Penjualan', '', 0),
(6111, 'Harga Pokok Penjualan', '', 0),
(5111, 'Produk Dalam Proses - BBB', '', 0),
(5112, 'Produk Dalam Proses - BTK', '', 0),
(5113, 'Produk Dalam Proses - BOP', '', 0),
(1112, 'Persediaan Bahan Baku', '', 0),
(1113, 'Persediaann Bahan Penolong', '', 0),
(1114, 'Persediaan Produk Dalam Proses', '', 0),
(1115, 'Persediaan Produk Jadi', '', 0),
(5211, 'Beban Administrasi dan Umum', '', 0),
(5212, 'Beban Pemasaran', '', 0),
(5311, 'Beban Upah dan Gaji', '', 0),
(5312, 'BOP Dibebankan', '', 0),
(5221, 'Beban Listrik, Air dan Telepon', '', 0),
(5222, 'Beban Iklan', '', 0),
(5223, 'Beban Perlengkapan Kantor', '', 0),
(5224, 'Beban Perlengkapan Toko', '', 0);

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
('BOP_001', 'JBOP_001', 2000000),
('BOP_001', 'JBOP_002', 2000000),
('BOP_001', 'JBOP_003', 2000000),
('BOP_001', 'JBOP_004', 2000000);

-- --------------------------------------------------------

--
-- Table structure for table `detail_cek_kualitas`
--

CREATE TABLE `detail_cek_kualitas` (
  `no_trans` varchar(50) NOT NULL,
  `lulus` varchar(50) NOT NULL,
  `gagal` varchar(50) NOT NULL,
  `total` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_cek_kualitas`
--

INSERT INTO `detail_cek_kualitas` (`no_trans`, `lulus`, `gagal`, `total`) VALUES
('CK_001', '150', '50', '200'),
('CK_002', '150', '150', '300'),
('CK_004', '200', '100', '300'),
('CK_005', '220', '200', '420'),
('CK_006', '180', '0', '180');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pembagian`
--

CREATE TABLE `detail_pembagian` (
  `no_trans` varchar(50) NOT NULL,
  `jual` varchar(50) NOT NULL,
  `produksi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_pembagian`
--

INSERT INTO `detail_pembagian` (`no_trans`, `jual`, `produksi`) VALUES
('PGB_001', '50', '50'),
('PGB_002', '100', '100'),
('PGB_003', '50', '50'),
('PGB_004', '100', '20'),
('PGB_005', '40', '40');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pembayaran`
--

CREATE TABLE `detail_pembayaran` (
  `no_trans` varchar(50) NOT NULL,
  `no_coa` varchar(50) NOT NULL,
  `subtotal` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_pembayaran`
--

INSERT INTO `detail_pembayaran` (`no_trans`, `no_coa`, `subtotal`) VALUES
('0', '5222', '500000'),
('0', '5221', '900000'),
('PMBY_009', '5221', '200000'),
('PMBY_009', '5222', '500000');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pembelian_bb`
--

CREATE TABLE `detail_pembelian_bb` (
  `no_trans` varchar(100) NOT NULL,
  `no_bb` varchar(100) NOT NULL,
  `jumlah` int(100) NOT NULL,
  `subtotal` int(100) NOT NULL,
  `no_peternak` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_pembelian_bb`
--

INSERT INTO `detail_pembelian_bb` (`no_trans`, `no_bb`, `jumlah`, `subtotal`, `no_peternak`) VALUES
('PMB_001', 'BB_001', 200, 0, 'PTRNK_001'),
('PMB_002', 'BB_001', 100, 0, 'PTRNK_001'),
('PMB_002', 'BB_001', 100, 0, 'PTRNK_001'),
('PMB_002', 'BB_001', 100, 0, 'PTRNK_001'),
('PMB_003', 'BB_001', 50, 0, 'PTRNK_001'),
('PMB_003', 'BB_001', 50, 0, 'PTRNK_002'),
('PMB_003', 'BB_001', 50, 0, 'PTRNK_003'),
('PMB_004', 'BB_001', 120, 0, 'PTRNK_001'),
('PMB_004', 'BB_001', 150, 0, 'PTRNK_001'),
('PMB_004', 'BB_001', 150, 0, 'PTRNK_001'),
('PMB_005', 'BB_001', 200, 0, 'PTRNK_001'),
('PMB_005', 'BB_001', 100, 0, 'PTRNK_002'),
('PMB_006', 'BB_001', 80, 0, 'PTRNK_002'),
('PMB_006', 'BB_001', 20, 0, 'PTRNK_001'),
('PMB_006', 'BB_001', 80, 0, 'PTRNK_003'),
('PMB_007', 'BB_001', 1, 0, 'PTRNK_001'),
('PMB_007', 'BB_001', 80, 0, 'PTRNK_002'),
('PMB_007', 'BB_001', 20, 0, 'PTRNK_003'),
('PMB_009', 'BB_001', 40, 200000, 'PTRNK_001'),
('PMB_009', 'BB_001', 80, 400000, 'PTRNK_002');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pembelian_bp`
--

CREATE TABLE `detail_pembelian_bp` (
  `no_trans` varchar(100) NOT NULL,
  `no_bp` varchar(100) NOT NULL,
  `jumlah` int(100) NOT NULL,
  `subtotal` int(100) NOT NULL,
  `no_supp_bp` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_pembelian_bp`
--

INSERT INTO `detail_pembelian_bp` (`no_trans`, `no_bp`, `jumlah`, `subtotal`, `no_supp_bp`) VALUES
('PMBP_001', 'BP_005', 102, 1020000, 'SBP_001'),
('PMBP_001', 'BP_001', 204, 2346000, 'SBP_002'),
('PMBP_001', 'BP_004', 510, 3825000, 'SBP_001'),
('PMBP_001', 'BP_003', 306, 1377000, 'SBP_002'),
('PMBP_002', 'BP_002', 160, 11920000, 'SBP_001'),
('PMBP_002', 'BP_005', 180, 1800000, 'SBP_002'),
('PMBP_002', 'BP_001', 180, 2070000, 'SBP_001'),
('PMBP_002', 'BP_004', 160, 1200000, 'SBP_002'),
('PMBP_002', 'BP_003', 160, 720000, 'SBP_001'),
('PMBP_003', 'BP_005', 20, 200000, 'SBP_001'),
('PMBP_003', 'BP_001', 20, 230000, 'SBP_002');

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan_ips`
--

CREATE TABLE `detail_penjualan_ips` (
  `no_trans` varchar(100) NOT NULL,
  `no_produk` varchar(100) NOT NULL,
  `jumlah` int(100) NOT NULL,
  `subtotal` int(100) NOT NULL,
  `no_ips` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan_toko`
--

CREATE TABLE `detail_penjualan_toko` (
  `no_trans` varchar(50) NOT NULL,
  `no_produk` varchar(50) NOT NULL,
  `jumlah` varchar(50) NOT NULL,
  `subtotal` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detail_produksi_ke1`
--

CREATE TABLE `detail_produksi_ke1` (
  `no_trans` varchar(50) NOT NULL,
  `no_produk` varchar(50) NOT NULL,
  `bbb` varchar(50) NOT NULL,
  `btk` varchar(50) NOT NULL,
  `bop` varchar(50) NOT NULL,
  `jumlah` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_produksi_ke1`
--

INSERT INTO `detail_produksi_ke1` (`no_trans`, `no_produk`, `bbb`, `btk`, `bop`, `jumlah`) VALUES
('PROD1_001', 'PR_005', '1000000', '0', '0', '200'),
('PROD1_002', 'PR_005', '500000', '387097', '258064', '100'),
('PROD1_003', 'PR_005', '1000000', '387097', '258064', '200'),
('PROD1_004', 'PR_005', '600000', '387097', '258064', '120'),
('PROD1_005', 'PR_005', '400000', '387097', '258064', '80');

-- --------------------------------------------------------

--
-- Table structure for table `detail_produksi_ke2`
--

CREATE TABLE `detail_produksi_ke2` (
  `no_trans` varchar(50) NOT NULL,
  `no_produk` varchar(50) NOT NULL,
  `bbb` varchar(50) NOT NULL,
  `btk` varchar(50) NOT NULL,
  `bop` varchar(50) NOT NULL,
  `bp` varchar(50) DEFAULT NULL,
  `jumlah` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_produksi_ke2`
--

INSERT INTO `detail_produksi_ke2` (`no_trans`, `no_produk`, `bbb`, `btk`, `bop`, `bp`, `jumlah`) VALUES
('PROD2_003', 'PR_002', '261291', '193548', '129032', '430000', '20');

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

--
-- Dumping data for table `detail_target_produksi`
--

INSERT INTO `detail_target_produksi` (`no`, `no_tp`, `no_produk`, `jumlah`, `status`) VALUES
(1, 'TP_001', 'PR_002', 100, NULL),
(2, 'TP_001', 'PR_003', 2, NULL),
(3, 'TP_002', 'PR_002', 20, NULL),
(5, 'TP_002', 'PR_009', 160, NULL),
(6, 'TP_003', 'PR_002', 20, NULL),
(7, 'TP_003', 'PR_003', 20, NULL);

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
(1, 'PMBP_001', '2020-05-25', 113, 'd', 8568000),
(2, 'PMBP_001', '2020-05-25', 111, 'k', 8568000),
(3, 'CK_002', '2020-05-30', 1112, 'd', 750000),
(4, 'CK_002', '2020-05-30', 1111, 'k', 750000),
(5, 'PROD1_002', '2020-05-31', 5111, 'd', 500000),
(6, 'PROD1_002', '2020-05-31', 5112, 'd', 387097),
(7, 'PROD1_002', '2020-05-31', 5113, 'd', 258064),
(8, 'PROD1_002', '2020-05-31', 1112, 'k', 500000),
(9, 'PROD1_002', '2020-05-31', 5311, 'k', 387097),
(10, 'PROD1_002', '2020-05-31', 5312, 'k', 258064),
(11, 'CK_004', '2020-05-31', 1112, 'd', 1000000),
(12, 'CK_004', '2020-05-31', 1111, 'k', 1000000),
(13, 'PROD1_003', '2020-05-31', 5111, 'd', 1000000),
(14, 'PROD1_003', '2020-05-31', 5112, 'd', 387097),
(15, 'PROD1_003', '2020-05-31', 5113, 'd', 258064),
(16, 'PROD1_003', '2020-05-31', 1112, 'k', 1000000),
(17, 'PROD1_003', '2020-05-31', 5311, 'k', 387097),
(18, 'PROD1_003', '2020-05-31', 5312, 'k', 258064),
(19, 'PGB_002', '2020-05-31', 1114, 'd', 0),
(20, 'PGB_002', '2020-05-31', 5111, 'k', 0),
(21, 'PGB_002', '2020-05-31', 5112, 'k', 0),
(22, 'PGB_002', '2020-05-31', 5113, 'k', 0),
(23, 'PGB_002', '2020-05-31', 1115, 'd', 0),
(24, 'PGB_002', '2020-05-31', 5111, 'k', 0),
(25, 'PGB_002', '2020-05-31', 5112, 'k', 0),
(26, 'PGB_002', '2020-05-31', 5113, 'k', 0),
(27, 'PMBP_002', '2020-05-31', 113, 'd', 17710000),
(28, 'PMBP_002', '2020-05-31', 111, 'k', 17710000),
(29, 'PGB_003', '2020-06-01', 1114, 'd', 0),
(30, 'PGB_003', '2020-06-01', 5111, 'k', 0),
(31, 'PGB_003', '2020-06-01', 5112, 'k', 0),
(32, 'PGB_003', '2020-06-01', 5113, 'k', 0),
(33, 'PGB_003', '2020-06-01', 1115, 'd', 0),
(34, 'PGB_003', '2020-06-01', 5111, 'k', 0),
(35, 'PGB_003', '2020-06-01', 5112, 'k', 0),
(36, 'PGB_003', '2020-06-01', 5113, 'k', 0),
(37, 'CK_005', '2020-06-01', 1112, 'd', 1100000),
(38, 'CK_005', '2020-06-01', 1111, 'k', 1100000),
(39, 'CK_006', '2020-06-01', 1112, 'd', 900000),
(40, 'CK_006', '2020-06-01', 1111, 'k', 900000),
(41, 'PROD1_004', '2020-06-01', 5111, 'd', 600000),
(42, 'PROD1_004', '2020-06-01', 5112, 'd', 387097),
(43, 'PROD1_004', '2020-06-01', 5113, 'd', 258064),
(44, 'PROD1_004', '2020-06-01', 1112, 'k', 600000),
(45, 'PROD1_004', '2020-06-01', 5311, 'k', 387097),
(46, 'PROD1_004', '2020-06-01', 5312, 'k', 258064),
(47, 'PGB_004', '2020-06-01', 1114, 'd', 0),
(48, 'PGB_004', '2020-06-01', 5111, 'k', 0),
(49, 'PGB_004', '2020-06-01', 5112, 'k', 0),
(50, 'PGB_004', '2020-06-01', 5113, 'k', 0),
(51, 'PGB_004', '2020-06-01', 1115, 'd', 0),
(52, 'PGB_004', '2020-06-01', 5111, 'k', 0),
(53, 'PGB_004', '2020-06-01', 5112, 'k', 0),
(54, 'PGB_004', '2020-06-01', 5113, 'k', 0),
(55, 'PROD1_005', '2020-06-01', 5111, 'd', 400000),
(56, 'PROD1_005', '2020-06-01', 5112, 'd', 387097),
(57, 'PROD1_005', '2020-06-01', 5113, 'd', 258064),
(58, 'PROD1_005', '2020-06-01', 1112, 'k', 400000),
(59, 'PROD1_005', '2020-06-01', 5311, 'k', 387097),
(60, 'PROD1_005', '2020-06-01', 5312, 'k', 258064),
(61, 'PGB_005', '2020-06-01', 1114, 'd', 522581),
(62, 'PGB_005', '2020-06-01', 5111, 'k', 200000),
(63, 'PGB_005', '2020-06-01', 5112, 'k', 193549),
(64, 'PGB_005', '2020-06-01', 5113, 'k', 129032),
(65, 'PGB_005', '2020-06-01', 1115, 'd', 522581),
(66, 'PGB_005', '2020-06-01', 5111, 'k', 200000),
(67, 'PGB_005', '2020-06-01', 5112, 'k', 193549),
(68, 'PGB_005', '2020-06-01', 5113, 'k', 129032),
(69, 'PMBP_003', '2020-06-01', 113, 'd', 430000),
(70, 'PMBP_003', '2020-06-01', 111, 'k', 430000),
(71, 'PROD2_003', '2020-06-01', 5112, 'd', 193548),
(72, 'PROD2_003', '2020-06-01', 5113, 'd', 559032),
(73, 'PROD2_003', '2020-06-01', 5311, 'k', 193548),
(74, 'PROD2_003', '2020-06-01', 5312, 'k', 559032),
(75, 'PROD2_003', '2020-06-01', 1115, 'd', 1013871),
(76, 'PROD2_003', '2020-06-01', 1114, 'k', 261291),
(77, 'PROD2_003', '2020-06-01', 5112, 'k', 193548),
(78, 'PROD2_003', '2020-06-01', 5113, 'k', 559032),
(79, 'PMBY_009', '2020-06-03', 5221, 'd', 200000),
(80, 'PMBY_009', '2020-06-03', 1111, 'k', 200000),
(81, 'PMBY_009', '2020-06-03', 5222, 'd', 500000),
(82, 'PMBY_009', '2020-06-03', 1111, 'k', 500000);

-- --------------------------------------------------------

--
-- Table structure for table `kartu_stok_bb`
--

CREATE TABLE `kartu_stok_bb` (
  `no` int(11) NOT NULL,
  `no_trans` varchar(50) DEFAULT NULL,
  `tgl_trans` varchar(50) DEFAULT NULL,
  `no_bb` varchar(50) DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `total` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kartu_stok_bp`
--

CREATE TABLE `kartu_stok_bp` (
  `no` int(11) NOT NULL,
  `no_trans` varchar(50) DEFAULT NULL,
  `tgl_trans` varchar(50) DEFAULT NULL,
  `no_bp` varchar(50) DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `total` varchar(50) DEFAULT NULL
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
  `unit` varchar(50) DEFAULT NULL,
  `total` varchar(50) DEFAULT NULL
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
('IPS_001', 'PT.Ultramilk', '', ''),
('IPS_002', 'PT.Ultrajaya', '', ''),
('IPS_003', 'PT.Cimory', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `pembagian`
--

CREATE TABLE `pembagian` (
  `no_trans` varchar(50) NOT NULL,
  `tgl_trans` varchar(50) NOT NULL,
  `no_trans_produksi1` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembagian`
--

INSERT INTO `pembagian` (`no_trans`, `tgl_trans`, `no_trans_produksi1`, `status`) VALUES
('PGB_001', '2020-05-24', 'PROD1_001', '2'),
('PGB_002', '2020-05-31', 'PROD1_003', '2'),
('PGB_003', '2020-05-31', 'PROD1_002', '1'),
('PGB_004', '2020-05-31', 'PROD1_004', '1'),
('PGB_005', '2020-05-31', 'PROD1_005', '2');

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

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`no_trans`, `tgl_trans`, `total`, `status`) VALUES
('PMBY_009', '2020-06-02', '700000', '1');

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

--
-- Dumping data for table `pembelian_bb`
--

INSERT INTO `pembelian_bb` (`no_trans`, `tgl_trans`, `total`, `status`) VALUES
('PMB_001', '2020-05-24', 0, '2'),
('PMB_002', '2020-05-30', 0, '2'),
('PMB_003', '2020-05-30', 0, '2'),
('PMB_004', '2020-05-30', 0, '2'),
('PMB_005', '2020-05-31', 0, '2'),
('PMB_006', '2020-05-31', 0, '2'),
('PMB_007', '2020-05-31', 0, '1'),
('PMB_008', '2020-06-01', 0, '0'),
('PMB_009', '2020-06-03', 600000, '1');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_bp`
--

CREATE TABLE `pembelian_bp` (
  `no_trans` varchar(100) NOT NULL,
  `tgl_trans` varchar(100) NOT NULL,
  `total` int(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `no_tp` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian_bp`
--

INSERT INTO `pembelian_bp` (`no_trans`, `tgl_trans`, `total`, `status`, `no_tp`) VALUES
('PMBP_001', '2020-05-25', 8568000, '1', 'TP_001'),
('PMBP_002', '2020-05-31', 17710000, '1', 'TP_002'),
('PMBP_003', '2020-05-31', 430000, '1', 'TP_003');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_ips`
--

CREATE TABLE `penjualan_ips` (
  `no_trans` varchar(100) NOT NULL,
  `tgl_trans` date NOT NULL,
  `total` int(100) NOT NULL,
  `status` varchar(100) NOT NULL
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
('PTRNK_001', 'Tester', '', ''),
('PTRNK_002', 'testing', '', ''),
('PTRNK_003', 'testingg', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `no_produk` varchar(50) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `stok` int(50) NOT NULL,
  `satuan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`no_produk`, `nama_produk`, `stok`, `satuan`) VALUES
('PR_001', 'Susu Sapi', 0, 'liter'),
('PR_002', 'Susu Murni', 0, 'liter'),
('PR_003', 'Pasteur Coklat 180 ml', 0, 'buah'),
('PR_004', 'Pasteur Vanila 180 ml', 0, 'buah'),
('PR_005', 'Pasteur Strawberry 180 ml', 0, 'buah'),
('PR_006', 'Yoghurt Strawberry 180 ml', 0, 'buah'),
('PR_007', 'Yoghurt Anggur 180 ml', 0, 'buah'),
('PR_008', 'Yoghurt Plain 180 ml', 0, 'buah'),
('PR_009', 'Yoghurt Plain', 0, 'liter');

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

--
-- Dumping data for table `produksi_ke1`
--

INSERT INTO `produksi_ke1` (`no_trans`, `tgl_trans`, `no_trans_ck`, `status`) VALUES
('PROD1_001', '2020-05-24', 'CK_001', '2'),
('PROD1_002', '2020-05-30', 'CK_002', '2'),
('PROD1_003', '2020-05-31', 'CK_004', '2'),
('PROD1_004', '2020-05-31', 'CK_005', '2'),
('PROD1_005', '2020-05-31', 'CK_006', '2');

-- --------------------------------------------------------

--
-- Table structure for table `produksi_ke2`
--

CREATE TABLE `produksi_ke2` (
  `no_trans` varchar(50) NOT NULL,
  `tgl_trans` varchar(50) NOT NULL,
  `no_tp` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produksi_ke2`
--

INSERT INTO `produksi_ke2` (`no_trans`, `tgl_trans`, `no_tp`, `status`) VALUES
('PROD2_001', '2020-05-25', 'TP_001', '0'),
('PROD2_002', '2020-05-31', 'TP_002', '0'),
('PROD2_003', '2020-05-31', 'TP_003', '0');

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
('SBP_001', 'Tester', '', ''),
('SBP_002', 'hyuuu', '', '');

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

--
-- Dumping data for table `target_produksi`
--

INSERT INTO `target_produksi` (`no_tp`, `tanggal`, `tgl_tp`, `status`, `no_trans_pembagian`) VALUES
('TP_001', '2020-05-25', '2020-05-28', '3', 'PGB_001'),
('TP_002', '2020-05-31', '2020-06-02', '3', 'PGB_002'),
('TP_003', '2020-05-31', '2020-06-03', '3', 'PGB_005');

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
('', 'admin', 'admin', 'admin'),
('', 'produksi1', 'produksi1', 'produksi1'),
('', 'produksi2', 'produksi2', 'produksi2'),
('', 'penjualan', 'penjualan', 'penjualan'),
('', 'keuangan', 'keuangan', 'keuangan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_target_produksi`
--
ALTER TABLE `detail_target_produksi`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `jurnal`
--
ALTER TABLE `jurnal`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `kartu_stok_bb`
--
ALTER TABLE `kartu_stok_bb`
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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_target_produksi`
--
ALTER TABLE `detail_target_produksi`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jurnal`
--
ALTER TABLE `jurnal`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `kartu_stok_bb`
--
ALTER TABLE `kartu_stok_bb`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
