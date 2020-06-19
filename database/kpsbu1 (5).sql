-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2020 at 11:58 PM
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
('BB_001', 'Susu Sapi', 5000, 'liter', 0);

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
  `harga` int(100) NOT NULL,
  `satuan` varchar(100) DEFAULT NULL,
  `stok` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bahan_penolong`
--

INSERT INTO `bahan_penolong` (`no_bp`, `nama_bp`, `harga`, `satuan`, `stok`) VALUES
('BP_001', 'Gula 500g', 11500, 'buah', 0),
('BP_002', 'Bubuk Biang Yoghurt 1 gr', 8500, 'buah', 0),
('BP_003', 'Pewarna Makanan 30 ml', 4500, 'buah', 0),
('BP_004', 'Perisa Makanan 60ml', 7500, 'buah', 0),
('BP_005', 'Garam 200g', 10000, 'buah', 0);

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
('PR_002', 'BP_001', 1),
('PR_002', 'BP_005', 1),
('PR_004', 'BP_001', 1),
('PR_004', 'BP_002', 1),
('PR_004', 'BP_003', 1),
('PR_004', 'BP_005', 1),
('PR_005', 'BP_001', 1),
('PR_005', 'BP_002', 1),
('PR_005', 'BP_003', 1),
('PR_005', 'BP_005', 1),
('PR_006', 'BP_001', 1),
('PR_006', 'BP_002', 1),
('PR_006', 'BP_003', 1),
('PR_006', 'BP_005', 1),
('PR_007', 'BP_001', 1),
('PR_007', 'BP_002', 1),
('PR_007', 'BP_003', 1),
('PR_007', 'BP_005', 1),
('PR_008', 'BP_001', 1),
('PR_008', 'BP_002', 1),
('PR_008', 'BP_003', 1),
('PR_008', 'BP_005', 1),
('PR_009', 'BP_001', 1),
('PR_009', 'BP_002', 1),
('PR_009', 'BP_005', 1),
('PR_003', 'BP_001', 1),
('PR_003', 'BP_002', 1),
('PR_003', 'BP_005', 1),
('PR_003', 'BP_004', 1),
('PR_002', 'BDP_001', 1),
('PR_003', 'BDP_001', 1),
('PR_004', 'BDP_001', 1),
('PR_005', 'BDP_001', 1),
('PR_006', 'BDP_001', 1),
('PR_007', 'BDP_001', 1),
('PR_008', 'BDP_001', 1),
('PR_009', 'BDP_001', 1);

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
('BOP_001', NULL, '05', '2020'),
('BOP_002', NULL, '06', '2020'),
('BOP_003', '2020-06-20', '0', '0'),
('BOP_004', '2020-06-18', '0', '0'),
('BOP_005', '2020-06-18', '0', '0');

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
('BTK_001', NULL, '06', '2020', '10', 12000000),
('BTK_002', NULL, '05', '2020', '10', 12000000),
('BTK_003', NULL, '07', '2020', '10', 9300000),
('BTK_004', '2020-06-20', '0', '0', '10', 500000),
('BTK_005', '2020-06-18', '0', '0', '10', 500000);

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
('CK_001', '2020-06-18', 'PMB_001', '2'),
('CK_002', '2020-06-18', 'PMB_002', '2'),
('CK_003', '2020-06-18', 'PMB_003', '2');

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
(1115, 'Persediaan Produk Jadi', '', 0),
(4111, 'Penjualan', '', 0),
(5111, 'Produk Dalam Proses - BBB', '', 0),
(5112, 'Produk Dalam Proses - BTK', '', 0),
(5113, 'Produk Dalam Proses - BOP', '', 0),
(5134, 'BOP Tetap Sesungguhnya', '', 0),
(5135, 'BOP Sesungguhnya', '', 0),
(5211, 'Beban Administrasi dan Umum', '', 0),
(5212, 'Beban Pemasaran', '', 0),
(5221, 'Beban Listrik, Air dan Telepon', '', 0),
(5222, 'Beban Iklan', '', 0),
(5223, 'Beban Perlengkapan Kantor', '', 0),
(5224, 'Beban Perlengkapan Toko', '', 0),
(5311, 'Beban Upah dan Gaji', '', 0),
(5312, 'BOP Dibebankan', '', 0),
(6111, 'Harga Pokok Penjualan', '', 0);

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
('BOP_001', 'JBOP_004', 2000000),
('BOP_002', 'JBOP_001', 13000000),
('BOP_002', 'JBOP_002', 2000000),
('BOP_002', 'JBOP_003', 2000000),
('BOP_002', 'JBOP_004', 2000000),
('BOP_003', 'JBOP_001', 50000),
('BOP_003', 'JBOP_002', 50000),
('BOP_003', 'JBOP_003', 50000),
('BOP_003', 'JBOP_004', 50000),
('BOP_004', 'JBOP_001', 50000),
('BOP_004', 'JBOP_002', 50000),
('BOP_004', 'JBOP_003', 50000),
('BOP_004', 'JBOP_004', 50000);

-- --------------------------------------------------------

--
-- Table structure for table `detail_cek_kualitas`
--

CREATE TABLE `detail_cek_kualitas` (
  `no` int(11) NOT NULL,
  `no_trans` varchar(50) NOT NULL,
  `lulus` varchar(50) NOT NULL,
  `gagal` varchar(50) NOT NULL,
  `total` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_cek_kualitas`
--

INSERT INTO `detail_cek_kualitas` (`no`, `no_trans`, `lulus`, `gagal`, `total`) VALUES
(1, 'CK_001', '100', '0', '100'),
(2, 'CK_002', '200', '0', '200'),
(3, 'CK_003', '100', '0', '100');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pemakaian_bb`
--

CREATE TABLE `detail_pemakaian_bb` (
  `no` int(11) NOT NULL,
  `no_trans` varchar(50) NOT NULL,
  `tgl_trans` varchar(50) NOT NULL,
  `no_bb` varchar(50) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `total` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_pemakaian_bb`
--

INSERT INTO `detail_pemakaian_bb` (`no`, `no_trans`, `tgl_trans`, `no_bb`, `unit`, `total`) VALUES
(1, 'PROD1_001', '2020-06-18', 'BB_001', '100', '500000'),
(2, 'PROD1_002', '2020-06-18', 'BB_001', '200', '1000000'),
(3, 'PROD1_003', '2020-06-18', 'BB_001', '100', '500000');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pemakaian_bp`
--

CREATE TABLE `detail_pemakaian_bp` (
  `no` int(11) NOT NULL,
  `no_trans` varchar(50) NOT NULL,
  `tgl_trans` varchar(50) NOT NULL,
  `no_bp` varchar(50) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `total` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_pemakaian_bp`
--

INSERT INTO `detail_pemakaian_bp` (`no`, `no_trans`, `tgl_trans`, `no_bp`, `unit`, `total`) VALUES
(1, 'PROD2_001', '2020-06-18', 'BP_001', '50', '575000'),
(2, 'PROD2_001', '2020-06-18', 'BP_005', '50', '500000'),
(3, 'PROD2_001', '2020-06-18', 'BP_001', '40', '460000'),
(4, 'PROD2_001', '2020-06-18', 'BP_002', '40', '340000'),
(5, 'PROD2_001', '2020-06-18', 'BP_004', '40', '300000'),
(6, 'PROD2_001', '2020-06-18', 'BP_005', '40', '400000'),
(7, 'PROD2_002', '2020-06-18', 'BP_001', '100', '1150000'),
(8, 'PROD2_002', '2020-06-18', 'BP_005', '100', '1000000'),
(9, 'PROD2_002', '2020-06-18', 'BP_001', '90', '1035000'),
(10, 'PROD2_002', '2020-06-18', 'BP_002', '90', '765000'),
(11, 'PROD2_002', '2020-06-18', 'BP_004', '90', '675000'),
(12, 'PROD2_002', '2020-06-18', 'BP_005', '90', '900000'),
(13, 'PROD2_003', '2020-06-18', 'BP_001', '50', '575000'),
(14, 'PROD2_003', '2020-06-18', 'BP_005', '50', '500000'),
(15, 'PROD2_003', '2020-06-18', 'BP_001', '40', '460000'),
(16, 'PROD2_003', '2020-06-18', 'BP_002', '40', '340000'),
(17, 'PROD2_003', '2020-06-18', 'BP_004', '40', '300000'),
(18, 'PROD2_003', '2020-06-18', 'BP_005', '40', '400000');

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

--
-- Dumping data for table `detail_pembagian`
--

INSERT INTO `detail_pembagian` (`no`, `no_trans`, `jual`, `produksi`) VALUES
(1, 'PGB_001', '10', '90'),
(2, 'PGB_002', '10', '190'),
(3, 'PGB_003', '10', '90');

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
('PMBY_001', '5221', '200000'),
('PMBY_001', '5222', '50000');

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
('PMB_001', 'BB_001', 100, 500000, 'PTRNK_002'),
('PMB_002', 'BB_001', 200, 1000000, 'PTRNK_001'),
('PMB_003', 'BB_001', 100, 500000, 'PTRNK_003');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pembelian_bp`
--

CREATE TABLE `detail_pembelian_bp` (
  `no` int(11) NOT NULL,
  `no_trans` varchar(100) NOT NULL,
  `no_bp` varchar(100) NOT NULL,
  `jumlah` int(100) NOT NULL,
  `subtotal` int(100) NOT NULL,
  `no_supp_bp` varchar(100) NOT NULL,
  `jumlah_kartu_stok` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_pembelian_bp`
--

INSERT INTO `detail_pembelian_bp` (`no`, `no_trans`, `no_bp`, `jumlah`, `subtotal`, `no_supp_bp`, `jumlah_kartu_stok`) VALUES
(1, 'PMBP_001', 'BP_001', 90, 1035000, 'SBP_001', '0'),
(2, 'PMBP_001', 'BP_002', 40, 340000, 'SBP_001', '0'),
(3, 'PMBP_001', 'BP_004', 40, 300000, 'SBP_002', '0'),
(4, 'PMBP_001', 'BP_005', 90, 900000, 'SBP_001', '0'),
(5, 'PMBP_002', 'BP_001', 190, 2185000, 'SBP_001', '0'),
(6, 'PMBP_002', 'BP_002', 90, 765000, 'SBP_001', '0'),
(7, 'PMBP_002', 'BP_004', 90, 675000, 'SBP_001', '0'),
(8, 'PMBP_002', 'BP_005', 190, 1900000, 'SBP_002', '0'),
(9, 'PMBP_003', 'BP_001', 90, 1035000, 'SBP_001', '0'),
(10, 'PMBP_003', 'BP_002', 40, 340000, 'SBP_002', '0'),
(11, 'PMBP_003', 'BP_004', 40, 300000, 'SBP_001', '0'),
(12, 'PMBP_003', 'BP_005', 90, 900000, 'SBP_002', '0');

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

--
-- Dumping data for table `detail_penjualan_ips`
--

INSERT INTO `detail_penjualan_ips` (`no`, `no_trans`, `no_produk`, `jumlah`, `harga`, `subtotal`, `no_ips`, `jumlah_kartu_stok`, `hpp`) VALUES
(1, 'PENJS_001', 'PR_001', 10, '13000', 130000, 'IPS_001', '0', '100000');

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan_toko`
--

CREATE TABLE `detail_penjualan_toko` (
  `no_trans` varchar(50) NOT NULL,
  `no_produk` varchar(50) NOT NULL,
  `jumlah` varchar(50) NOT NULL,
  `harga` varchar(50) NOT NULL,
  `subtotal` varchar(50) NOT NULL,
  `cek_stok_penj` varchar(50) NOT NULL,
  `hpp` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_penjualan_toko`
--

INSERT INTO `detail_penjualan_toko` (`no_trans`, `no_produk`, `jumlah`, `harga`, `subtotal`, `cek_stok_penj`, `hpp`) VALUES
('PENJT_001', 'PR_002', '50', '48172.228', '2408611.4', '0', NULL),
('PENJT_001', 'PR_002', '1', '41121.054', '41121.054', '99', NULL);

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
  `jumlah` varchar(50) NOT NULL,
  `stok_jual` varchar(50) DEFAULT NULL,
  `jumlah_kartu_stok` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_produksi_ke1`
--

INSERT INTO `detail_produksi_ke1` (`no`, `no_trans`, `no_produk`, `bbb`, `btk`, `bop`, `jumlah`, `stok_jual`, `jumlah_kartu_stok`) VALUES
(1, 'PROD1_001', 'PR_001', '500000', '500000', '0', '100', '10', '0'),
(2, 'PROD1_002', 'PR_001', '1000000', '500000', '0', '200', '10', '10'),
(3, 'PROD1_003', 'PR_001', '500000', '500000', '0', '100', '10', '10');

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
  `jumlah` varchar(50) NOT NULL,
  `jumlah_kartu_stok` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_produksi_ke2`
--

INSERT INTO `detail_produksi_ke2` (`no`, `no_trans`, `tgl_trans`, `no_produk`, `bbb`, `btk`, `bop`, `bp`, `jumlah`, `jumlah_kartu_stok`) VALUES
(1, 'PROD2_001', '2020-06-18', 'PR_002', '500000', '277778', '0', '1075000', '50', '0'),
(2, 'PROD2_001', '2020-06-18', 'PR_003', '400000', '222222', '0', '1500000', '40', '40'),
(3, 'PROD2_002', '2020-06-18', 'PR_002', '750000', '263158', '0', '2150000', '100', '99'),
(4, 'PROD2_002', '2020-06-18', 'PR_003', '675000', '236842', '0', '3375000', '90', '90'),
(5, 'PROD2_003', '2020-06-18', 'PR_002', '500000', '277778', '0', '1075000', '50', '50'),
(6, 'PROD2_003', '2020-06-18', 'PR_003', '400000', '222222', '0', '1500000', '40', '40');

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
(1, 'TP_001', 'PR_002', 50, '1'),
(2, 'TP_001', 'PR_003', 40, '1'),
(3, 'TP_002', 'PR_002', 100, '1'),
(4, 'TP_002', 'PR_003', 90, '1'),
(5, 'TP_003', 'PR_002', 50, '1'),
(6, 'TP_003', 'PR_003', 40, '1');

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
(1, 'CK_001', '2020-06-18', 1112, 'd', 500000),
(2, 'CK_001', '2020-06-18', 1111, 'k', 500000),
(3, 'CK_002', '2020-06-18', 1112, 'd', 1000000),
(4, 'CK_002', '2020-06-18', 1111, 'k', 1000000),
(5, 'CK_003', '2020-06-18', 1112, 'd', 500000),
(6, 'CK_003', '2020-06-18', 1111, 'k', 500000),
(7, 'PROD1_001', '2020-06-18', 5111, 'd', 500000),
(8, 'PROD1_001', '2020-06-18', 5112, 'd', 500000),
(9, 'PROD1_001', '2020-06-18', 1112, 'k', 500000),
(10, 'PROD1_001', '2020-06-18', 5311, 'k', 500000),
(11, 'PROD1_001', '2020-06-18', 5134, 'd', 200000),
(12, 'PROD1_001', '2020-06-18', 5135, 'k', 200000),
(13, 'PROD1_002', '2020-06-18', 5111, 'd', 1000000),
(14, 'PROD1_002', '2020-06-18', 5112, 'd', 500000),
(15, 'PROD1_002', '2020-06-18', 1112, 'k', 1000000),
(16, 'PROD1_002', '2020-06-18', 5311, 'k', 500000),
(17, 'PROD1_002', '2020-06-18', 5134, 'd', 200000),
(18, 'PROD1_002', '2020-06-18', 5135, 'k', 200000),
(19, 'PROD1_003', '2020-06-18', 5111, 'd', 500000),
(20, 'PROD1_003', '2020-06-18', 5112, 'd', 500000),
(21, 'PROD1_003', '2020-06-18', 1112, 'k', 500000),
(22, 'PROD1_003', '2020-06-18', 5311, 'k', 500000),
(23, 'PROD1_003', '2020-06-18', 5134, 'd', 200000),
(24, 'PROD1_003', '2020-06-18', 5135, 'k', 200000),
(25, 'PGB_001', '2020-06-18', 1114, 'd', 900000),
(26, 'PGB_001', '2020-06-18', 5111, 'k', 450000),
(27, 'PGB_001', '2020-06-18', 5112, 'k', 450000),
(28, 'PGB_001', '2020-06-18', 1115, 'd', 100000),
(29, 'PGB_001', '2020-06-18', 5111, 'k', 50000),
(30, 'PGB_001', '2020-06-18', 5112, 'k', 50000),
(31, 'PGB_002', '2020-06-18', 1114, 'd', 1425000),
(32, 'PGB_002', '2020-06-18', 5111, 'k', 950000),
(33, 'PGB_002', '2020-06-18', 5112, 'k', 475000),
(34, 'PGB_002', '2020-06-18', 1115, 'd', 75000),
(35, 'PGB_002', '2020-06-18', 5111, 'k', 50000),
(36, 'PGB_002', '2020-06-18', 5112, 'k', 25000),
(37, 'PGB_003', '2020-06-18', 1114, 'd', 900000),
(38, 'PGB_003', '2020-06-18', 5111, 'k', 450000),
(39, 'PGB_003', '2020-06-18', 5112, 'k', 450000),
(40, 'PGB_003', '2020-06-18', 1115, 'd', 100000),
(41, 'PGB_003', '2020-06-18', 5111, 'k', 50000),
(42, 'PGB_003', '2020-06-18', 5112, 'k', 50000),
(43, 'PMBP_001', '2020-06-18', 1113, 'd', 2575000),
(44, 'PMBP_001', '2020-06-18', 1111, 'k', 2575000),
(45, 'PMBP_002', '2020-06-18', 1113, 'd', 5525000),
(46, 'PMBP_002', '2020-06-18', 1111, 'k', 5525000),
(47, 'PMBP_003', '2020-06-18', 1113, 'd', 2575000),
(48, 'PMBP_003', '2020-06-18', 1111, 'k', 2575000),
(49, 'PROD2_001', '2020-06-18', 5112, 'd', 277778),
(50, 'PROD2_001', '2020-06-18', 5113, 'd', 1075000),
(51, 'PROD2_001', '2020-06-18', 5311, 'k', 277778),
(52, 'PROD2_001', '2020-06-18', 5312, 'k', 1075000),
(53, 'PROD2_001', '2020-06-18', 1115, 'd', 1852778),
(54, 'PROD2_001', '2020-06-18', 1114, 'k', 500000),
(55, 'PROD2_001', '2020-06-18', 5112, 'k', 277778),
(56, 'PROD2_001', '2020-06-18', 5113, 'k', 1075000),
(57, 'PROD2_001', '2020-06-18', 5112, 'd', 222222),
(58, 'PROD2_001', '2020-06-18', 5113, 'd', 1500000),
(59, 'PROD2_001', '2020-06-18', 5311, 'k', 222222),
(60, 'PROD2_001', '2020-06-18', 5312, 'k', 1500000),
(61, 'PROD2_001', '2020-06-18', 1115, 'd', 2122222),
(62, 'PROD2_001', '2020-06-18', 1114, 'k', 400000),
(63, 'PROD2_001', '2020-06-18', 5112, 'k', 222222),
(64, 'PROD2_001', '2020-06-18', 5113, 'k', 1500000),
(65, 'PROD2_001', '2020-06-18', 5134, 'd', 200000),
(66, 'PROD2_001', '2020-06-18', 5135, 'k', 200000),
(67, 'PROD2_002', '2020-06-18', 5112, 'd', 263158),
(68, 'PROD2_002', '2020-06-18', 5113, 'd', 2150000),
(69, 'PROD2_002', '2020-06-18', 5311, 'k', 263158),
(70, 'PROD2_002', '2020-06-18', 5312, 'k', 2150000),
(71, 'PROD2_002', '2020-06-18', 1115, 'd', 3163158),
(72, 'PROD2_002', '2020-06-18', 1114, 'k', 750000),
(73, 'PROD2_002', '2020-06-18', 5112, 'k', 263158),
(74, 'PROD2_002', '2020-06-18', 5113, 'k', 2150000),
(75, 'PROD2_002', '2020-06-18', 5112, 'd', 236842),
(76, 'PROD2_002', '2020-06-18', 5113, 'd', 3375000),
(77, 'PROD2_002', '2020-06-18', 5311, 'k', 236842),
(78, 'PROD2_002', '2020-06-18', 5312, 'k', 3375000),
(79, 'PROD2_002', '2020-06-18', 1115, 'd', 4286842),
(80, 'PROD2_002', '2020-06-18', 1114, 'k', 675000),
(81, 'PROD2_002', '2020-06-18', 5112, 'k', 236842),
(82, 'PROD2_002', '2020-06-18', 5113, 'k', 3375000),
(83, 'PROD2_002', '2020-06-18', 5134, 'd', 200000),
(84, 'PROD2_002', '2020-06-18', 5135, 'k', 200000),
(85, 'PROD2_003', '2020-06-18', 5112, 'd', 277778),
(86, 'PROD2_003', '2020-06-18', 5113, 'd', 1075000),
(87, 'PROD2_003', '2020-06-18', 5311, 'k', 277778),
(88, 'PROD2_003', '2020-06-18', 5312, 'k', 1075000),
(89, 'PROD2_003', '2020-06-18', 1115, 'd', 1852778),
(90, 'PROD2_003', '2020-06-18', 1114, 'k', 500000),
(91, 'PROD2_003', '2020-06-18', 5112, 'k', 277778),
(92, 'PROD2_003', '2020-06-18', 5113, 'k', 1075000),
(93, 'PROD2_003', '2020-06-18', 5112, 'd', 222222),
(94, 'PROD2_003', '2020-06-18', 5113, 'd', 1500000),
(95, 'PROD2_003', '2020-06-18', 5311, 'k', 222222),
(96, 'PROD2_003', '2020-06-18', 5312, 'k', 1500000),
(97, 'PROD2_003', '2020-06-18', 1115, 'd', 2122222),
(98, 'PROD2_003', '2020-06-18', 1114, 'k', 400000),
(99, 'PROD2_003', '2020-06-18', 5112, 'k', 222222),
(100, 'PROD2_003', '2020-06-18', 5113, 'k', 1500000),
(101, 'PROD2_003', '2020-06-18', 5134, 'd', 200000),
(102, 'PROD2_003', '2020-06-18', 5135, 'k', 200000),
(103, 'PENJS_001', '2020-06-18', 1111, 'd', 130000),
(104, 'PENJS_001', '2020-06-18', 4111, 'k', 130000),
(105, 'PENJS_001', '2020-06-18', 6111, 'd', 100000),
(106, 'PENJS_001', '2020-06-18', 1115, 'k', 100000),
(107, 'PENJS_001', '2020-06-18', 5211, 'd', 7500),
(108, 'PENJS_001', '2020-06-18', 5212, 'd', 7500),
(109, 'PENJS_001', '2020-06-18', 1111, 'k', 15000),
(110, 'PENJT_001', '2020-06-18', 1111, 'd', 2449732),
(111, 'PENJT_001', '2020-06-18', 4111, 'k', 2449732),
(112, 'PENJT_001', '2020-06-18', 6111, 'd', 1884410),
(113, 'PENJT_001', '2020-06-18', 1115, 'k', 1884410),
(114, 'PENJT_001', '2020-06-18', 5211, 'd', 0),
(115, 'PENJT_001', '2020-06-18', 5212, 'd', 0),
(116, 'PENJT_001', '2020-06-18', 1111, 'k', 0),
(117, 'PMBY_001', '2020-06-18', 5221, 'd', 200000),
(118, 'PMBY_001', '2020-06-18', 1111, 'k', 200000),
(119, 'PMBY_001', '2020-06-18', 5222, 'd', 50000),
(120, 'PMBY_001', '2020-06-18', 1111, 'k', 50000);

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

--
-- Dumping data for table `kartu_stok_bb`
--

INSERT INTO `kartu_stok_bb` (`no`, `no_trans`, `tgl_trans`, `no_bb`, `unit`, `total`) VALUES
(1, 'CK_001', '2020-06-18', 'BB_001', '100', '500000'),
(2, 'CK_002', '2020-06-18', 'BB_001', '200', '1000000'),
(3, 'CK_003', '2020-06-18', 'BB_001', '100', '500000'),
(4, 'PROD1_001', '2020-06-18', 'BB_001', '0', '0'),
(5, 'PROD1_002', '2020-06-18', 'BB_001', '0', '0'),
(6, 'PROD1_003', '2020-06-18', 'BB_001', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `kartu_stok_bp`
--

CREATE TABLE `kartu_stok_bp` (
  `no` int(11) NOT NULL,
  `no_trans` varchar(50) DEFAULT NULL,
  `tgl_trans` varchar(50) DEFAULT NULL,
  `no_bp` varchar(50) DEFAULT NULL,
  `unit1` varchar(50) DEFAULT NULL,
  `harga1` varchar(50) DEFAULT NULL,
  `total1` varchar(50) DEFAULT NULL,
  `unit2` varchar(50) DEFAULT NULL,
  `harga2` varchar(50) DEFAULT NULL,
  `total2` varchar(50) DEFAULT NULL,
  `unit3` varchar(50) DEFAULT NULL,
  `harga3` varchar(50) DEFAULT NULL,
  `total3` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kartu_stok_bp`
--

INSERT INTO `kartu_stok_bp` (`no`, `no_trans`, `tgl_trans`, `no_bp`, `unit1`, `harga1`, `total1`, `unit2`, `harga2`, `total2`, `unit3`, `harga3`, `total3`) VALUES
(1, 'PMBP_001', '2020-06-18', 'BP_001', '90', '11500', '1035000', NULL, NULL, NULL, '90', '11500', '1035000'),
(2, 'PMBP_001', '2020-06-18', 'BP_002', '40', '8500', '340000', NULL, NULL, NULL, '40', '8500', '340000'),
(3, 'PMBP_001', '2020-06-18', 'BP_004', '40', '7500', '300000', NULL, NULL, NULL, '40', '7500', '300000'),
(4, 'PMBP_001', '2020-06-18', 'BP_005', '90', '10000', '900000', NULL, NULL, NULL, '90', '10000', '900000'),
(5, 'PMBP_002', '2020-06-18', 'BP_001', '190', '11500', '2185000', NULL, NULL, NULL, '190', '11500', '2185000'),
(6, 'PMBP_002', '2020-06-18', 'BP_002', '90', '8500', '765000', NULL, NULL, NULL, '90', '8500', '765000'),
(7, 'PMBP_002', '2020-06-18', 'BP_004', '90', '7500', '675000', NULL, NULL, NULL, '90', '7500', '675000'),
(8, 'PMBP_002', '2020-06-18', 'BP_005', '190', '10000', '1900000', NULL, NULL, NULL, '190', '10000', '1900000'),
(9, 'PMBP_003', '2020-06-18', 'BP_001', '90', '11500', '1035000', NULL, NULL, NULL, '90', '11500', '1035000'),
(10, 'PMBP_003', '2020-06-18', 'BP_002', '40', '8500', '340000', NULL, NULL, NULL, '40', '8500', '340000'),
(11, 'PMBP_003', '2020-06-18', 'BP_004', '40', '7500', '300000', NULL, NULL, NULL, '40', '7500', '300000'),
(12, 'PMBP_003', '2020-06-18', 'BP_005', '90', '10000', '900000', NULL, NULL, NULL, '90', '10000', '900000'),
(13, 'PROD2_001', '2020-06-18', 'BP_001', NULL, NULL, NULL, '50', '11500', '575000', '40', '11500', '460000'),
(14, 'PROD2_001', '2020-06-18', 'BP_005', NULL, NULL, NULL, '50', '10000', '500000', '40', '10000', '400000'),
(15, 'PROD2_001', '2020-06-18', 'BP_001', NULL, NULL, NULL, '40', '11500', '460000', '0', '11500', '0'),
(16, 'PROD2_001', '2020-06-18', 'BP_002', NULL, NULL, NULL, '40', '8500', '340000', '0', '8500', '0'),
(17, 'PROD2_001', '2020-06-18', 'BP_004', NULL, NULL, NULL, '40', '7500', '300000', '0', '7500', '0'),
(18, 'PROD2_001', '2020-06-18', 'BP_005', NULL, NULL, NULL, '40', '10000', '400000', '0', '10000', '0'),
(19, 'PROD2_002', '2020-06-18', 'BP_001', NULL, NULL, NULL, '100', '11500', '1150000', '90', '11500', '1035000'),
(20, 'PROD2_002', '2020-06-18', 'BP_005', NULL, NULL, NULL, '100', '10000', '1000000', '90', '10000', '900000'),
(21, 'PROD2_002', '2020-06-18', 'BP_001', NULL, NULL, NULL, '90', '11500', '1035000', '0', '11500', '0'),
(22, 'PROD2_002', '2020-06-18', 'BP_002', NULL, NULL, NULL, '90', '8500', '765000', '0', '8500', '0'),
(23, 'PROD2_002', '2020-06-18', 'BP_004', NULL, NULL, NULL, '90', '7500', '675000', '0', '7500', '0'),
(24, 'PROD2_002', '2020-06-18', 'BP_005', NULL, NULL, NULL, '90', '10000', '900000', '0', '10000', '0'),
(25, 'PROD2_003', '2020-06-18', 'BP_001', NULL, NULL, NULL, '50', '11500', '575000', '40', '11500', '460000'),
(26, 'PROD2_003', '2020-06-18', 'BP_005', NULL, NULL, NULL, '50', '10000', '500000', '40', '10000', '400000'),
(27, 'PROD2_003', '2020-06-18', 'BP_001', NULL, NULL, NULL, '40', '11500', '460000', '0', '11500', '0'),
(28, 'PROD2_003', '2020-06-18', 'BP_002', NULL, NULL, NULL, '40', '8500', '340000', '0', '8500', '0'),
(29, 'PROD2_003', '2020-06-18', 'BP_004', NULL, NULL, NULL, '40', '7500', '300000', '0', '7500', '0'),
(30, 'PROD2_003', '2020-06-18', 'BP_005', NULL, NULL, NULL, '40', '10000', '400000', '0', '10000', '0');

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
  `total3` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kartu_stok_penj`
--

INSERT INTO `kartu_stok_penj` (`no`, `no_trans`, `tgl_trans`, `no_produk`, `unit1`, `harga1`, `total1`, `unit2`, `harga2`, `total2`, `unit3`, `harga3`, `total3`) VALUES
(1, 'PROD2_001', '2020-06-18', 'PR_002', '50', '37055.56', '1852778', NULL, NULL, NULL, '50', '37055.56', '1852778'),
(2, 'PROD2_001', '2020-06-18', 'PR_003', '40', '53055.55', '2122222', NULL, NULL, NULL, '40', '53055.55', '2122222'),
(3, 'PROD2_002', '2020-06-18', 'PR_002', '100', '31631.58', '3163158', NULL, NULL, NULL, '100', '31631.58', '3163158'),
(4, 'PROD2_002', '2020-06-18', 'PR_003', '90', '47631.577777778', '4286842', NULL, NULL, NULL, '90', '47631.577777778', '4286842'),
(5, 'PROD2_003', '2020-06-18', 'PR_002', '50', '37055.56', '1852778', NULL, NULL, NULL, '50', '37055.56', '1852778'),
(6, 'PROD2_003', '2020-06-18', 'PR_003', '40', '53055.55', '2122222', NULL, NULL, NULL, '40', '53055.55', '2122222'),
(7, 'PENJT_001', '2020-06-18', 'PR_002', NULL, NULL, NULL, '0', '48172.228', '0', '0', '48172.228', '0'),
(8, 'PENJT_001', '2020-06-18', 'PR_002', NULL, NULL, NULL, '99', '41121.054', '4070979', '99', '41121.054', '4070979');

-- --------------------------------------------------------

--
-- Table structure for table `kartu_stok_penj_ips`
--

CREATE TABLE `kartu_stok_penj_ips` (
  `no` int(11) NOT NULL,
  `no_trans` varchar(50) NOT NULL,
  `tgl_trans` varchar(50) NOT NULL,
  `no_ips` varchar(50) DEFAULT NULL,
  `no_produk` varchar(50) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `total` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kartu_stok_penj_ips`
--

INSERT INTO `kartu_stok_penj_ips` (`no`, `no_trans`, `tgl_trans`, `no_ips`, `no_produk`, `unit`, `total`) VALUES
(1, 'PGB_001', '2020-06-18', NULL, 'PR_001', '10', '100000'),
(2, 'PGB_002', '2020-06-18', NULL, 'PR_001', '10', '75000'),
(3, 'PGB_003', '2020-06-18', NULL, 'PR_001', '10', '100000'),
(4, 'PENJS_001', '2020-06-18', NULL, 'PR_001', '0', '0');

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
('IPS_001', 'PT.Ultramilk', '1231231', 'testes'),
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
  `status` varchar(50) NOT NULL,
  `status_penjs` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembagian`
--

INSERT INTO `pembagian` (`no_trans`, `tgl_trans`, `no_trans_produksi1`, `status`, `status_penjs`) VALUES
('PGB_001', '2020-06-18', 'PROD1_001', '2', '1'),
('PGB_002', '2020-06-18', 'PROD1_002', '2', NULL),
('PGB_003', '2020-06-18', 'PROD1_003', '2', NULL);

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
('PMBY_001', '2020-06-18', '250000', '1');

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
('PMB_001', '2020-06-18', 500000, '2'),
('PMB_002', '2020-06-18', 1000000, '2'),
('PMB_003', '2020-06-18', 500000, '2');

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
('PMBP_001', '2020-06-18', 2575000, '1', 'TP_001'),
('PMBP_002', '2020-06-18', 5525000, '1', 'TP_002'),
('PMBP_003', '2020-06-18', 2575000, '1', 'TP_003');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_ips`
--

CREATE TABLE `penjualan_ips` (
  `no_trans` varchar(100) NOT NULL,
  `tgl_trans` date NOT NULL,
  `total` int(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `no_trans_pembg` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan_ips`
--

INSERT INTO `penjualan_ips` (`no_trans`, `tgl_trans`, `total`, `status`, `no_trans_pembg`) VALUES
('PENJS_001', '2020-06-18', 130000, '1', 'PGB_001');

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

--
-- Dumping data for table `penjualan_toko`
--

INSERT INTO `penjualan_toko` (`no_trans`, `tgl_trans`, `total`, `status`) VALUES
('PENJT_001', '2020-06-18', '2449732.454', '1');

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
('PR_001', 'Susu Sapi', 10, 'liter'),
('PR_002', 'Susu Murni', 149, 'liter'),
('PR_003', 'Pasteur Coklat', 170, 'liter'),
('PR_004', 'Pasteur Vanila', 0, 'liter'),
('PR_005', 'Pasteur Strawberry', 0, 'liter'),
('PR_006', 'Yoghurt Strawberry', 0, 'liter'),
('PR_007', 'Yoghurt Anggur', 0, 'liter'),
('PR_008', 'Yoghurt Melon', 0, 'liter'),
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
('PROD1_001', '2020-06-18', 'CK_001', '2'),
('PROD1_002', '2020-06-18', 'CK_002', '2'),
('PROD1_003', '2020-06-18', 'CK_003', '2');

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

--
-- Dumping data for table `produksi_ke2`
--

INSERT INTO `produksi_ke2` (`no_trans`, `tgl_trans`, `no_tp`, `status`) VALUES
('PROD2_001', '2020-06-18', 'TP_001', '1'),
('PROD2_002', '2020-06-18', 'TP_002', '1'),
('PROD2_003', '2020-06-18', 'TP_003', '1');

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
('TP_001', '2020-06-18', '2020-06-18', '3', 'PGB_001'),
('TP_002', '2020-06-18', '2020-06-18', '3', 'PGB_002'),
('TP_003', '2020-06-18', '2020-06-18', '3', 'PGB_003');

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
('', 'keuangan', 'keuangan', 'keuangan'),
('', 'pembelian', 'pembelian', 'pembelian'),
('', 'penjualan', 'penjualan', 'penjualan'),
('', 'produksi', 'produksi', 'produksi');

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
-- Indexes for table `detail_pemakaian_bb`
--
ALTER TABLE `detail_pemakaian_bb`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `detail_pemakaian_bp`
--
ALTER TABLE `detail_pemakaian_bp`
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
-- Indexes for table `kartu_stok_penj_ips`
--
ALTER TABLE `kartu_stok_penj_ips`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`no_produk`);

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
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `detail_pemakaian_bb`
--
ALTER TABLE `detail_pemakaian_bb`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `detail_pemakaian_bp`
--
ALTER TABLE `detail_pemakaian_bp`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `detail_pembagian`
--
ALTER TABLE `detail_pembagian`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `detail_pembelian_bp`
--
ALTER TABLE `detail_pembelian_bp`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `detail_penjualan_ips`
--
ALTER TABLE `detail_penjualan_ips`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `detail_produksi_ke1`
--
ALTER TABLE `detail_produksi_ke1`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `detail_produksi_ke2`
--
ALTER TABLE `detail_produksi_ke2`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `detail_target_produksi`
--
ALTER TABLE `detail_target_produksi`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jurnal`
--
ALTER TABLE `jurnal`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `kartu_stok_bb`
--
ALTER TABLE `kartu_stok_bb`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kartu_stok_bp`
--
ALTER TABLE `kartu_stok_bp`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `kartu_stok_penj`
--
ALTER TABLE `kartu_stok_penj`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kartu_stok_penj_ips`
--
ALTER TABLE `kartu_stok_penj_ips`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
