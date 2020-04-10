-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2020 at 03:50 AM
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
('BB_001', 'Susu Sapi', 5000, 'liter', 3127);

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
('BDP_001', 'Susu Sapi', '141', 'liter');

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
('BP_001', 'Gula', 11500, 'kg', 198),
('BP_002', 'Bubuk Biang Yoghurt 20 gr', 74500, 'buah', 0),
('BP_003', 'Pewarna Makanan 30 ml', 4500, 'buah', 177),
('BP_004', 'Perisa Makanan', 7500, 'buah', 250),
('BP_005', 'Garam', 10000, 'kg', 50);

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
('PR_001', 'BP_001', 2),
('PR_002', 'BB_002', 4),
('PR_002', 'BP_001', 2),
('PR_002', 'BP_003', 3),
('PR_003', 'BB_002', 3),
('PR_003', 'BP_001', 2),
('PR_003', 'BP_003', 2),
('PR_002', 'BP_004', 5),
('PR_002', 'BP_005', 1),
('PR_003', 'BP_004', 3),
('PR_003', 'BP_005', 2),
('PR_005', 'BB_001', 1),
('PR_002', 'BB_001', 3),
('PR_003', 'BB_001', 3),
('PR_004', 'BB_001', 3),
('PR_004', 'BP_001', 2),
('PR_004', 'BP_004', 2),
('PR_004', 'BP_003', 2),
('PR_004', 'BP_005', 2),
('PR_010', 'BB_001', 2),
('PR_010', 'BP_001', 1),
('PR_010', 'BP_002', 2);

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
('BOP_001', '12', '2019');

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
('BTK_001', '12', '2019', '10', 2000000);

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
(111, 'Kas', 'Aktiva', 0),
(112, 'Pembelian Bahan Baku', '', 0),
(113, 'Pembelian Bahan Penolong', '', 0),
(411, 'Penjualan', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `detail_bop`
--

CREATE TABLE `detail_bop` (
  `no_bop` varchar(100) NOT NULL,
  `nama_bop` varchar(100) NOT NULL,
  `harga` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_bop`
--

INSERT INTO `detail_bop` (`no_bop`, `nama_bop`, `harga`) VALUES
('BOP_001', 'beban listrik', 222222);

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
('PGB_001', '30', '70');

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
('0', '0', 4, 20000, 'PTRNK_001'),
('0', '0', 4, 20000, 'PTRNK_001'),
('PMB_001', 'BB_001', 4, 20000, 'PTRNK_001'),
('PMB_002', 'BB_001', 5, 25000, 'PTRNK_001'),
('PMB_003', 'BB_001', 3, 15000, 'PTRNK_001'),
('PMB_004', 'BB_001', 1400, 7000000, 'PTRNK_001'),
('PMB_005', 'BB_001', 1400, 7000000, 'PTRNK_001'),
('PMB_006', 'BB_001', 5, 25000, 'PTRNK_001'),
('PMB_007', '5500', 2, 0, 'PTRNK_001'),
('PMB_007', '5500', 2, 0, 'PTRNK_001'),
('PMB_007', 'BB_001', 2, 11000, 'PTRNK_001'),
('PMB_008', 'BB_001', 100, 500000, 'PTRNK_001'),
('PMB_009', 'BB_001', 200, 1000000, 'PTRNK_001');

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
('PMBP_002', 'BP_001', 6, 69000, 'SBP_001'),
('PMBP_002', 'BP_003', 9, 40500, 'SBP_001'),
('PMBP_003', 'BP_001', 12, 138000, 'SBP_001'),
('PMBP_003', 'BP_003', 18, 81000, 'SBP_001'),
('PMBP_005', 'BP_001', 6, 69000, 'SBP_001'),
('PMBP_007', 'BP_005', 5, 50000, 'SBP_001'),
('PMBP_007', 'BP_001', 4, 46000, 'SBP_001'),
('PMBP_007', 'BP_004', 25, 187500, 'SBP_002'),
('PMBP_007', 'BP_003', 15, 67500, 'SBP_001'),
('PMBP_008', 'BP_005', 5, 50000, 'SBP_001'),
('PMBP_008', 'BP_001', 10, 115000, 'SBP_001'),
('PMBP_008', 'BP_004', 25, 187500, 'SBP_001'),
('PMBP_008', 'BP_003', 15, 67500, 'SBP_001'),
('PMBP_009', 'BP_005', 40, 400000, 'SBP_001'),
('PMBP_009', 'BP_001', 160, 1840000, 'SBP_001'),
('PMBP_009', 'BP_004', 200, 1500000, 'SBP_001'),
('PMBP_009', 'BP_003', 120, 540000, 'SBP_001');

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

--
-- Dumping data for table `detail_penjualan_ips`
--

INSERT INTO `detail_penjualan_ips` (`no_trans`, `no_produk`, `jumlah`, `subtotal`, `no_ips`) VALUES
('PENJS_001', 'PR_005', 130, 910000000, 'IPS_001'),
('PENJS_002', 'PR_005', 130, 910000000, 'IPS_001');

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
('PROD1_001', 'PR_005', '10000', '0', '0', '1'),
('PROD1_002', 'PR_005', '500000', '0', '0', '1'),
('PROD1_003', 'PR_005', '1000000', '0', '0', '200');

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
  `jumlah` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detail_target_produksi`
--

CREATE TABLE `detail_target_produksi` (
  `no` int(11) NOT NULL,
  `no_tp` varchar(100) NOT NULL,
  `no_produk` varchar(100) NOT NULL,
  `jumlah` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_target_produksi`
--

INSERT INTO `detail_target_produksi` (`no`, `no_tp`, `no_produk`, `jumlah`) VALUES
(1, 'TP_001', 'PR_001', 4),
(2, 'TP_002', 'PR_002', 3),
(3, 'TP_002', 'PR_003', 2),
(4, 'TP_003', 'PR_001', 5),
(5, 'TP_004', 'PR_002', 6),
(6, 'TP_005', 'PR_002', 500),
(7, 'TP_006', 'PR_002', 2),
(8, 'TP_007', 'PR_002', 2),
(9, 'TP_008', 'PR_003', 1),
(10, 'TP_009', 'PR_002', 3),
(11, 'TP_009', 'PR_003', 1),
(12, 'TP_010', 'PR_001', 3),
(13, 'TP_012', 'PR_002', 1),
(14, 'TP_013', 'PR_005', 1400),
(15, 'TP_014', 'PR_001', 2),
(16, 'TP_014', 'PR_002', 5),
(17, 'TP_014', 'PR_003', 2),
(18, 'TP_015', 'PR_005', 1400),
(19, 'TP_016', 'PR_002', 5),
(20, 'TP_017', 'PR_005', 5),
(21, 'TP_018', 'PR_002', 40),
(22, 'TP_018', 'PR_001', 40);

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
(1, 'PMB_004', '2019-12-15', 112, 'd', 7000000),
(2, 'PMB_004', '2019-12-15', 111, 'k', 7000000),
(3, 'PENJS_001', '2019-12-15', 111, 'd', 0),
(4, 'PENJS_001', '2019-12-15', 411, 'k', 0),
(5, 'PENJS_002', '2019-12-15', 111, 'd', 110000),
(6, 'PENJS_002', '2019-12-15', 411, 'k', 110000),
(7, 'PMBP_007', '2019-12-15', 113, 'd', 351000),
(8, 'PMBP_007', '2019-12-15', 111, 'k', 351000),
(9, 'PENJS_001', '2019-12-17', 111, 'd', 910000000),
(10, 'PENJS_001', '2019-12-17', 411, 'k', 910000000),
(11, 'PMB_005', '2019-12-17', 112, 'd', 7000000),
(12, 'PMB_005', '2019-12-17', 111, 'k', 7000000),
(13, 'PMBP_008', '2019-12-17', 113, 'd', 420000),
(14, 'PMBP_008', '2019-12-17', 111, 'k', 420000),
(15, 'PENJS_002', '2019-12-17', 111, 'd', 910000000),
(16, 'PENJS_002', '2019-12-17', 411, 'k', 910000000),
(17, 'PMB_007', '2020-04-06', 112, 'd', 11000),
(18, 'PMB_007', '2020-04-06', 111, 'k', 11000),
(19, 'PMB_008', '2020-04-08', 112, 'd', 500000),
(20, 'PMB_008', '2020-04-08', 111, 'k', 500000),
(21, 'PMB_009', '2020-04-08', 112, 'd', 1000000),
(22, 'PMB_009', '2020-04-08', 111, 'k', 1000000),
(23, 'PMBP_009', '2020-04-09', 113, 'd', 4280000),
(24, 'PMBP_009', '2020-04-09', 111, 'k', 4280000);

-- --------------------------------------------------------

--
-- Table structure for table `konsumen_ips`
--

CREATE TABLE `konsumen_ips` (
  `no_ips` varchar(100) NOT NULL,
  `nama_ips` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `konsumen_ips`
--

INSERT INTO `konsumen_ips` (`no_ips`, `nama_ips`) VALUES
('IPS_001', 'PT.Ultramilk'),
('IPS_002', 'PT.Ultrajaya'),
('IPS_003', 'PT.Cimory');

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
('PGB_001', '2020-04-08', 'PROD1_003', '2');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_bb`
--

CREATE TABLE `pembelian_bb` (
  `no_trans` varchar(100) NOT NULL,
  `tgl_trans` date NOT NULL,
  `total` int(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `no_tp` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian_bb`
--

INSERT INTO `pembelian_bb` (`no_trans`, `tgl_trans`, `total`, `status`, `no_tp`) VALUES
('PMB_001', '2019-12-13', 20000, '1', 'TP_001'),
('PMB_002', '2019-12-14', 25000, '1', 'TP_003'),
('PMB_003', '2019-12-15', 15000, '1', 'TP_010'),
('PMB_004', '2019-12-15', 7000000, '1', 'TP_013'),
('PMB_005', '2019-12-17', 7000000, '1', 'TP_015'),
('PMB_006', '2020-04-05', 0, '0', 'TP_017'),
('PMB_007', '2020-04-05', 11000, '2', NULL),
('PMB_008', '2020-04-08', 500000, '2', NULL),
('PMB_009', '2020-04-08', 1000000, '2', NULL),
('PGB_001', '2020-04-08', 0, '0', NULL),
('PMB_010', '2020-04-08', 0, '0', NULL);

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
('PMBP_002', '2019-12-14', 109500, '1', 'TP_002'),
('PMBP_003', '2019-12-14', 219000, '1', 'TP_004'),
('PMBP_003', '2019-12-15', 219000, '1', 'TP_005'),
('PMBP_003', '2019-12-15', 0, '0', 'TP_006'),
('PMBP_003', '2019-12-15', 0, '0', 'TP_007'),
('PMBP_004', '2019-12-15', 0, '0', 'TP_008'),
('PMBP_005', '2019-12-15', 0, '0', 'TP_009'),
('PMBP_006', '2019-12-15', 0, '0', 'TP_012'),
('PMBP_007', '2019-12-15', 351000, '1', 'TP_014'),
('PMBP_008', '2019-12-17', 420000, '1', 'TP_016'),
('PMBP_009', '2020-04-08', 4280000, '1', 'TP_018');

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

--
-- Dumping data for table `penjualan_ips`
--

INSERT INTO `penjualan_ips` (`no_trans`, `tgl_trans`, `total`, `status`) VALUES
('PENJS_001', '2019-12-17', 910000000, '1'),
('PENJS_002', '2019-12-17', 910000000, '1');

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
  `nama_peternak` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peternak`
--

INSERT INTO `peternak` (`no_peternak`, `nama_peternak`) VALUES
('PTRNK_001', 'Tester');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `no_produk` varchar(50) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `stok` int(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `satuan` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`no_produk`, `nama_produk`, `stok`, `harga`, `satuan`, `user`) VALUES
('PR_001', 'Susu Murni', 0, 7000, 'liter', ''),
('PR_002', 'Susu Strawberry', 0, 4000, 'liter', ''),
('PR_003', 'Susu Coklat', 0, 4000, 'liter', ''),
('PR_004', 'Susu Vanilla', 0, 4000, 'liter', ''),
('PR_005', 'Susu Sapi', 141, 5500, 'ton', ''),
('PR_006', 'Yoghurt Mocca', 0, 8000, 'ml', ''),
('PR_007', 'Yoghurt Strawberry', 0, 8000, 'ml', ''),
('PR_008', 'Yoghurt Durian', 0, 8000, 'ml', ''),
('PR_009', 'Yoghurt Anggur', 0, 8000, 'ml', ''),
('PR_010', 'Yoghurt Melon', 0, 8000, 'ml', ''),
('PR_011', 'Yoghurt Mocca', 0, 25000, 'buah', ''),
('PR_012', 'Yoghurt Strawberry', 0, 25000, 'buah', ''),
('PR_013', 'Yoghurt Durian', 0, 25000, 'buah', ''),
('PR_014', 'Yoghurt Anggur', 0, 25000, 'buah', ''),
('PR_015', 'Yoghurt Melon', 0, 25000, 'buah', '');

-- --------------------------------------------------------

--
-- Table structure for table `produksi_ke1`
--

CREATE TABLE `produksi_ke1` (
  `no_trans` varchar(50) NOT NULL,
  `tgl_trans` varchar(50) NOT NULL,
  `no_trans_pembb` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produksi_ke1`
--

INSERT INTO `produksi_ke1` (`no_trans`, `tgl_trans`, `no_trans_pembb`, `status`) VALUES
('PROD1_001', '2020-04-07', 'PMB_007', '1'),
('PROD1_002', '2020-04-08', 'PMB_008', '1'),
('PROD1_003', '2020-04-08', 'PMB_009', '2');

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
('PROD2_001', '2020-04-08', 'TP_018', '0'),
('PROD2_001', '2020-04-08', 'TP_018', '0');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_bp`
--

CREATE TABLE `supplier_bp` (
  `no_supp_bp` varchar(100) NOT NULL,
  `nama_supp_bp` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier_bp`
--

INSERT INTO `supplier_bp` (`no_supp_bp`, `nama_supp_bp`) VALUES
('SBP_001', 'Tester'),
('SBP_002', 'hyuuu');

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
('TP_001', '2019-12-08', '2019-12-17', '2', ''),
('TP_002', '2019-12-14', '2019-12-14', '2', ''),
('TP_003', '2019-12-14', '2019-12-16', '2', ''),
('TP_004', '2019-12-14', '2019-12-15', '2', ''),
('TP_005', '2019-12-15', '2019-12-15', '2', ''),
('TP_006', '2019-12-15', '2019-12-15', '2', ''),
('TP_007', '2019-12-15', '2019-12-16', '2', ''),
('TP_008', '2019-12-15', '2019-12-16', '2', ''),
('TP_009', '2019-12-15', '2019-12-17', '2', ''),
('TP_010', '2019-12-15', '2019-12-16', '2', ''),
('TP_011', '2019-12-15', '2019-12-17', '0', ''),
('TP_012', '2019-12-15', '2019-12-16', '2', ''),
('TP_013', '2019-12-15', '2019-12-18', '2', ''),
('TP_014', '2019-12-15', '2019-12-19', '2', ''),
('TP_015', '2019-12-17', '2019-12-18', '2', ''),
('TP_016', '2019-12-17', '2019-12-18', '2', ''),
('TP_017', '2020-04-05', '2020-04-08', '2', ''),
('TP_018', '2020-04-08', '2020-04-11', '3', 'PGB_001');

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_target_produksi`
--
ALTER TABLE `detail_target_produksi`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `jurnal`
--
ALTER TABLE `jurnal`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
