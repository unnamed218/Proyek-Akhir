-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2020 at 04:48 PM
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
('BP_001', 'Gula', 'gram', 510000),
('BP_002', 'Bubuk Biang Yoghurt', 'gram', 992000),
('BP_003', 'Pewarna Makanan', 'ml', 880000),
('BP_004', 'Perisa Makanan', 'ml', 700000),
('BP_005', 'Garam', 'gram', 746000);

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
('BOP_001', '2020-07-26', '0', '0'),
('BOP_002', '2020-07-27', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `bopo`
--

CREATE TABLE `bopo` (
  `no_bopo` varchar(50) NOT NULL,
  `tgl_bopo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bopo`
--

INSERT INTO `bopo` (`no_bopo`, `tgl_bopo`) VALUES
('BOPO_001', '2020-07-26'),
('BOPO_002', '2020-07-27');

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
('BTK_001', '2020-07-26', '0', '0', '15', 300),
('BTK_002', '2020-07-27', '0', '0', '15', 250);

-- --------------------------------------------------------

--
-- Table structure for table `btko`
--

CREATE TABLE `btko` (
  `no_btko` varchar(50) NOT NULL,
  `tgl_btko` varchar(50) NOT NULL,
  `jumlah_pgw` varchar(50) NOT NULL,
  `tarif` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `btko`
--

INSERT INTO `btko` (`no_btko`, `tgl_btko`, `jumlah_pgw`, `tarif`) VALUES
('BTKO_001', '2020-07-26', '15', '300'),
('BTKO_002', '2020-07-27', '15', '200');

-- --------------------------------------------------------

--
-- Table structure for table `cek_kualitas`
--

CREATE TABLE `cek_kualitas` (
  `no_trans` varchar(50) NOT NULL,
  `tgl_trans` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cek_kualitas`
--

INSERT INTO `cek_kualitas` (`no_trans`, `tgl_trans`, `status`) VALUES
('CK_001', '2020-07-26', '2'),
('CK_002', '2020-07-27', '2');

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
('BOP_001', 'JBOP_001', 150),
('BOP_001', 'JBOP_002', 200),
('BOP_001', 'JBOP_003', 250),
('BOP_001', 'JBOP_004', 300),
('BOP_002', 'JBOP_001', 100),
('BOP_002', 'JBOP_002', 150),
('BOP_002', 'JBOP_003', 200),
('BOP_002', 'JBOP_004', 250);

-- --------------------------------------------------------

--
-- Table structure for table `detail_bopo`
--

CREATE TABLE `detail_bopo` (
  `no_bopo` varchar(50) NOT NULL,
  `no_jbop` varchar(50) NOT NULL,
  `harga` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_bopo`
--

INSERT INTO `detail_bopo` (`no_bopo`, `no_jbop`, `harga`) VALUES
('BOPO_001', 'JBOP_001', '150'),
('BOPO_001', 'JBOP_002', '200'),
('BOPO_001', 'JBOP_003', '250'),
('BOPO_001', 'JBOP_004', '300'),
('BOPO_002', 'JBOP_001', '250'),
('BOPO_002', 'JBOP_002', '200'),
('BOPO_002', 'JBOP_003', '150'),
('BOPO_002', 'JBOP_004', '100');

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

--
-- Dumping data for table `detail_cek_kualitas`
--

INSERT INTO `detail_cek_kualitas` (`no`, `no_trans`, `no_trans_pmb`, `lulus`, `gagal`, `total`, `subtotal`) VALUES
(1, 'CK_001', 'PMB_001', '140000', '10000', '150000', '750000000'),
(2, 'CK_002', 'PMB_002', '140000', '10000', '150000', '825000000');

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
(1, 'PGB_001', '130000', '10000'),
(2, 'PGB_002', '130000', '10000');

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

--
-- Dumping data for table `detail_pembayaran`
--

INSERT INTO `detail_pembayaran` (`no_trans`, `no_coa`, `subtotal`, `jenis_penjualan`) VALUES
('PMBY_001', '5221', '400000', 'ips'),
('PMBY_001', '5222', '350000', 'ips'),
('PMBY_001', '5223', '300000', 'ips'),
('PMBY_001', '5221', '250000', 'toko'),
('PMBY_001', '5222', '200000', 'toko'),
('PMBY_001', '5223', '150000', 'toko');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pembayaranv`
--

CREATE TABLE `detail_pembayaranv` (
  `no_trans` varchar(50) NOT NULL,
  `no_coa` varchar(50) NOT NULL,
  `tarif` varchar(50) NOT NULL,
  `jumlah` varchar(50) NOT NULL,
  `subtotal` varchar(50) NOT NULL,
  `jenis_penjualan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_pembayaranv`
--

INSERT INTO `detail_pembayaranv` (`no_trans`, `no_coa`, `tarif`, `jumlah`, `subtotal`, `jenis_penjualan`) VALUES
('PMBYV_003', '5213', '44', '130000', '5720000', 'ips'),
('PMBYV_004', '5211', '12', '6000', '72000', 'toko'),
('PMBYV_004', '5212', '2', '6000', '12000', 'toko');

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

--
-- Dumping data for table `detail_pembelian_bb`
--

INSERT INTO `detail_pembelian_bb` (`no_trans`, `no_bb`, `jumlah`, `harga`, `subtotal`, `no_peternak`) VALUES
('PMB_001', 'BB_001', 150000, '5000', 750000000, 'PTRNK_001'),
('PMB_002', 'BB_001', 150000, '5500', 825000000, 'PTRNK_001');

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

--
-- Dumping data for table `detail_pembelian_bp`
--

INSERT INTO `detail_pembelian_bp` (`no`, `no_trans`, `no_bp`, `jumlah`, `harga`, `subtotal`, `no_supp_bp`, `jumlah_kartu_stok`) VALUES
(1, 'PMBP_001', 'BP_001', 500000, '5', 2500000, 'SBP_001', '500000'),
(2, 'PMBP_001', 'BP_002', 500000, '6', 3000000, 'SBP_002', '500000'),
(3, 'PMBP_001', 'BP_003', 500000, '7', 3500000, 'SBP_003', '500000'),
(4, 'PMBP_001', 'BP_004', 500000, '8', 4000000, 'SBP_003', '500000'),
(5, 'PMBP_001', 'BP_005', 500000, '9', 4500000, 'SBP_004', '500000');

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
(1, 'PENJS_001', 'PR_001', 130000, '8060', 1047800000, 'IPS_001', '0', '806000000'),
(2, 'PENJS_002', 'PR_001', 130000, '8222.5', 1068925000, 'IPS_001', '0', '838500000');

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

--
-- Dumping data for table `detail_penjualan_toko`
--

INSERT INTO `detail_penjualan_toko` (`no`, `no_trans`, `no_produk`, `jumlah`, `harga`, `subtotal`, `hpp`) VALUES
(1, 'PENJT_001', 'PR_002', '2500', '9834.5', '24586250', '	\r\n18912500'),
(2, 'PENJT_001', 'PR_003', '500', '10406.5', '5203250', '4002500'),
(3, 'PENJT_001', 'PR_004', '500', '10406.5', '5203250', '4002500'),
(4, 'PENJT_001', 'PR_005', '500', '10406.5', '5203250', '4002500'),
(5, 'PENJT_001', 'PR_006', '500', '10260.9', '5130450', '3946500'),
(6, 'PENJT_001', 'PR_007', '500', '10260.9', '5130450', '3946500'),
(7, 'PENJT_001', 'PR_008', '500', '10260.9', '5130450', '3946500'),
(8, 'PENJT_001', 'PR_009', '500', '9909.9', '4954950', '3811500'),
(9, 'PENJT_002', 'PR_002', '200', '9834.5', '1966900', '1513000'),
(10, 'PENJT_002', 'PR_003', '200', '10406.5', '2081300', '1601000'),
(11, 'PENJT_002', 'PR_004', '200', '10406.5', '2081300', '1601000'),
(12, 'PENJT_002', 'PR_005', '200', '10406.5', '2081300', '1601000'),
(13, 'PENJT_002', 'PR_006', '200', '10260.9', '2052180', '1578600'),
(14, 'PENJT_002', 'PR_007', '200', '10260.9', '2052180', '1578600'),
(15, 'PENJT_002', 'PR_008', '200', '10260.9', '2052180', '1578600'),
(16, 'PENJT_002', 'PR_009', '200', '9909.9', '1981980', '1524600'),
(17, 'PENJT_003', 'PR_002', '300', '9802', '2940600', '2269500');

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

--
-- Dumping data for table `detail_produksi_ke1`
--

INSERT INTO `detail_produksi_ke1` (`no`, `no_trans`, `no_produk`, `bbb`, `btk`, `bop`, `subtotal`, `jumlah`, `stok_jual`, `jumlah_kartu_stok`) VALUES
(1, 'PROD1_001', 'PR_001', '700000000', '42000000', '126000000', '868000000', '140000', '130000', '130000'),
(2, 'PROD1_002', 'PR_001', '770000000', '35000000', '98000000', '903000000', '140000', '130000', '130000');

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

--
-- Dumping data for table `detail_produksi_ke2`
--

INSERT INTO `detail_produksi_ke2` (`no`, `no_trans`, `tgl_trans`, `no_produk`, `bbb`, `btk`, `bop`, `bp`, `subtotal`, `jumlah`, `jumlah_kartu_stok`) VALUES
(1, 'PROD2_001', '2020-07-26', 'PR_002', '18600000', '900000', '2700000', '495000', '22695000', '3000', '0'),
(2, 'PROD2_001', '2020-07-26', 'PR_003', '6200000', '300000', '900000', '605000', '8005000', '1000', '300'),
(3, 'PROD2_001', '2020-07-26', 'PR_004', '6200000', '300000', '900000', '605000', '8005000', '1000', '300'),
(4, 'PROD2_001', '2020-07-26', 'PR_005', '6200000', '300000', '900000', '605000', '8005000', '1000', '300'),
(5, 'PROD2_001', '2020-07-26', 'PR_006', '6200000', '300000', '900000', '493000', '7893000', '1000', '300'),
(6, 'PROD2_001', '2020-07-26', 'PR_007', '6200000', '300000', '900000', '493000', '7893000', '1000', '300'),
(7, 'PROD2_001', '2020-07-26', 'PR_008', '6200000', '300000', '900000', '493000', '7893000', '1000', '300'),
(8, 'PROD2_001', '2020-07-26', 'PR_009', '6200000', '300000', '900000', '223000', '7623000', '1000', '300'),
(9, 'PROD2_002', '2020-07-27', 'PR_002', '19350000', '600000', '2100000', '495000', '22545000', '3000', '3000'),
(10, 'PROD2_002', '2020-07-27', 'PR_003', '6450000', '200000', '700000', '605000', '7955000', '1000', '1000'),
(11, 'PROD2_002', '2020-07-27', 'PR_004', '6450000', '200000', '700000', '605000', '7955000', '1000', '1000'),
(12, 'PROD2_002', '2020-07-27', 'PR_005', '6450000', '200000', '700000', '605000', '7955000', '1000', '1000'),
(13, 'PROD2_002', '2020-07-27', 'PR_006', '6450000', '200000', '700000', '493000', '7843000', '1000', '1000'),
(14, 'PROD2_002', '2020-07-27', 'PR_007', '6450000', '200000', '700000', '493000', '7843000', '1000', '1000'),
(15, 'PROD2_002', '2020-07-27', 'PR_008', '6450000', '200000', '700000', '493000', '7843000', '1000', '1000'),
(16, 'PROD2_002', '2020-07-27', 'PR_009', '6450000', '200000', '700000', '223000', '7573000', '1000', '1000');

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
(1, 'TP_001', 'PR_002', 3000, '1'),
(2, 'TP_001', 'PR_003', 1000, '1'),
(4, 'TP_001', 'PR_004', 1000, '1'),
(5, 'TP_001', 'PR_005', 1000, '1'),
(6, 'TP_001', 'PR_006', 1000, '1'),
(7, 'TP_001', 'PR_007', 1000, '1'),
(8, 'TP_001', 'PR_008', 1000, '1'),
(9, 'TP_001', 'PR_009', 1000, '1'),
(10, 'TP_002', 'PR_002', 3000, '1'),
(11, 'TP_002', 'PR_003', 1000, '1'),
(12, 'TP_002', 'PR_004', 1000, '1'),
(13, 'TP_002', 'PR_005', 1000, '1'),
(14, 'TP_002', 'PR_006', 1000, '1'),
(15, 'TP_002', 'PR_007', 1000, '1'),
(16, 'TP_002', 'PR_008', 1000, '1'),
(17, 'TP_002', 'PR_009', 1000, '1');

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
(1, 'CK_001', '2020-07-26', 1112, 'd', 700000000),
(2, 'CK_001', '2020-07-26', 1111, 'k', 700000000),
(3, 'PROD1_001', '2020-07-26', 5111, 'd', 700000000),
(4, 'PROD1_001', '2020-07-26', 1112, 'k', 700000000),
(5, 'PROD1_001', '2020-07-26', 5112, 'd', 42000000),
(6, 'PROD1_001', '2020-07-26', 5311, 'k', 42000000),
(7, 'PROD1_001', '2020-07-26', 5113, 'd', 126000000),
(8, 'PROD1_001', '2020-07-26', 5312, 'k', 126000000),
(9, 'PGB_001', '2020-07-26', 1114, 'd', 62000000),
(10, 'PGB_001', '2020-07-26', 5111, 'k', 50000000),
(11, 'PGB_001', '2020-07-26', 5112, 'k', 3000000),
(12, 'PGB_001', '2020-07-26', 5113, 'k', 9000000),
(13, 'PGB_001', '2020-07-26', 1311, 'd', 806000000),
(14, 'PGB_001', '2020-07-26', 5111, 'k', 650000000),
(15, 'PGB_001', '2020-07-26', 5112, 'k', 39000000),
(16, 'PGB_001', '2020-07-26', 5113, 'k', 117000000),
(17, 'PMBP_001', '2020-07-26', 1113, 'd', 17500000),
(18, 'PMBP_001', '2020-07-26', 1111, 'k', 17500000),
(19, 'PROD2_001', '2020-07-26', 5112, 'd', 900000),
(20, 'PROD2_001', '2020-07-26', 5311, 'k', 900000),
(21, 'PROD2_001', '2020-07-26', 5113, 'd', 2700000),
(22, 'PROD2_001', '2020-07-26', 5312, 'k', 2700000),
(23, 'PROD2_001', '2020-07-26', 5135, 'd', 495000),
(24, 'PROD2_001', '2020-07-26', 1113, 'k', 495000),
(25, 'PROD2_001', '2020-07-26', 1312, 'd', 22695000),
(26, 'PROD2_001', '2020-07-26', 1114, 'k', 18600000),
(27, 'PROD2_001', '2020-07-26', 5112, 'k', 900000),
(28, 'PROD2_001', '2020-07-26', 5113, 'k', 3195000),
(29, 'PROD2_001', '2020-07-26', 5112, 'd', 300000),
(30, 'PROD2_001', '2020-07-26', 5311, 'k', 300000),
(31, 'PROD2_001', '2020-07-26', 5113, 'd', 900000),
(32, 'PROD2_001', '2020-07-26', 5312, 'k', 900000),
(33, 'PROD2_001', '2020-07-26', 5135, 'd', 605000),
(34, 'PROD2_001', '2020-07-26', 1113, 'k', 605000),
(35, 'PROD2_001', '2020-07-26', 1312, 'd', 8005000),
(36, 'PROD2_001', '2020-07-26', 1114, 'k', 6200000),
(37, 'PROD2_001', '2020-07-26', 5112, 'k', 300000),
(38, 'PROD2_001', '2020-07-26', 5113, 'k', 1505000),
(39, 'PROD2_001', '2020-07-26', 5112, 'd', 300000),
(40, 'PROD2_001', '2020-07-26', 5311, 'k', 300000),
(41, 'PROD2_001', '2020-07-26', 5113, 'd', 900000),
(42, 'PROD2_001', '2020-07-26', 5312, 'k', 900000),
(43, 'PROD2_001', '2020-07-26', 5135, 'd', 605000),
(44, 'PROD2_001', '2020-07-26', 1113, 'k', 605000),
(45, 'PROD2_001', '2020-07-26', 1312, 'd', 8005000),
(46, 'PROD2_001', '2020-07-26', 1114, 'k', 6200000),
(47, 'PROD2_001', '2020-07-26', 5112, 'k', 300000),
(48, 'PROD2_001', '2020-07-26', 5113, 'k', 1505000),
(49, 'PROD2_001', '2020-07-26', 5112, 'd', 300000),
(50, 'PROD2_001', '2020-07-26', 5311, 'k', 300000),
(51, 'PROD2_001', '2020-07-26', 5113, 'd', 900000),
(52, 'PROD2_001', '2020-07-26', 5312, 'k', 900000),
(53, 'PROD2_001', '2020-07-26', 5135, 'd', 605000),
(54, 'PROD2_001', '2020-07-26', 1113, 'k', 605000),
(55, 'PROD2_001', '2020-07-26', 1312, 'd', 8005000),
(56, 'PROD2_001', '2020-07-26', 1114, 'k', 6200000),
(57, 'PROD2_001', '2020-07-26', 5112, 'k', 300000),
(58, 'PROD2_001', '2020-07-26', 5113, 'k', 1505000),
(59, 'PROD2_001', '2020-07-26', 5112, 'd', 300000),
(60, 'PROD2_001', '2020-07-26', 5311, 'k', 300000),
(61, 'PROD2_001', '2020-07-26', 5113, 'd', 900000),
(62, 'PROD2_001', '2020-07-26', 5312, 'k', 900000),
(63, 'PROD2_001', '2020-07-26', 5135, 'd', 493000),
(64, 'PROD2_001', '2020-07-26', 1113, 'k', 493000),
(65, 'PROD2_001', '2020-07-26', 1312, 'd', 7893000),
(66, 'PROD2_001', '2020-07-26', 1114, 'k', 6200000),
(67, 'PROD2_001', '2020-07-26', 5112, 'k', 300000),
(68, 'PROD2_001', '2020-07-26', 5113, 'k', 1393000),
(69, 'PROD2_001', '2020-07-26', 5112, 'd', 300000),
(70, 'PROD2_001', '2020-07-26', 5311, 'k', 300000),
(71, 'PROD2_001', '2020-07-26', 5113, 'd', 900000),
(72, 'PROD2_001', '2020-07-26', 5312, 'k', 900000),
(73, 'PROD2_001', '2020-07-26', 5135, 'd', 493000),
(74, 'PROD2_001', '2020-07-26', 1113, 'k', 493000),
(75, 'PROD2_001', '2020-07-26', 1312, 'd', 7893000),
(76, 'PROD2_001', '2020-07-26', 1114, 'k', 6200000),
(77, 'PROD2_001', '2020-07-26', 5112, 'k', 300000),
(78, 'PROD2_001', '2020-07-26', 5113, 'k', 1393000),
(79, 'PROD2_001', '2020-07-26', 5112, 'd', 300000),
(80, 'PROD2_001', '2020-07-26', 5311, 'k', 300000),
(81, 'PROD2_001', '2020-07-26', 5113, 'd', 900000),
(82, 'PROD2_001', '2020-07-26', 5312, 'k', 900000),
(83, 'PROD2_001', '2020-07-26', 5135, 'd', 493000),
(84, 'PROD2_001', '2020-07-26', 1113, 'k', 493000),
(85, 'PROD2_001', '2020-07-26', 1312, 'd', 7893000),
(86, 'PROD2_001', '2020-07-26', 1114, 'k', 6200000),
(87, 'PROD2_001', '2020-07-26', 5112, 'k', 300000),
(88, 'PROD2_001', '2020-07-26', 5113, 'k', 1393000),
(89, 'PROD2_001', '2020-07-26', 5112, 'd', 300000),
(90, 'PROD2_001', '2020-07-26', 5311, 'k', 300000),
(91, 'PROD2_001', '2020-07-26', 5113, 'd', 900000),
(92, 'PROD2_001', '2020-07-26', 5312, 'k', 900000),
(93, 'PROD2_001', '2020-07-26', 5135, 'd', 223000),
(94, 'PROD2_001', '2020-07-26', 1113, 'k', 223000),
(95, 'PROD2_001', '2020-07-26', 1312, 'd', 7623000),
(96, 'PROD2_001', '2020-07-26', 1114, 'k', 6200000),
(97, 'PROD2_001', '2020-07-26', 5112, 'k', 300000),
(98, 'PROD2_001', '2020-07-26', 5113, 'k', 1123000),
(99, 'PENJS_001', '2020-07-26', 1111, 'd', 1047800000),
(100, 'PENJS_001', '2020-07-26', 4111, 'k', 1047800000),
(101, 'PENJS_001', '2020-07-26', 6111, 'd', 806000000),
(102, 'PENJS_001', '2020-07-26', 1311, 'k', 806000000),
(103, 'PENJT_001', '2020-07-26', 1111, 'd', 60542300),
(104, 'PENJT_001', '2020-07-26', 4112, 'k', 60542300),
(105, 'PENJT_001', '2020-07-26', 6112, 'd', 46571000),
(106, 'PENJT_001', '2020-07-26', 1312, 'k', 46571000),
(107, 'PENJT_002', '2020-07-26', 1111, 'd', 16349320),
(108, 'PENJT_002', '2020-07-26', 4112, 'k', 16349320),
(109, 'PENJT_002', '2020-07-26', 6112, 'd', 12576400),
(110, 'PENJT_002', '2020-07-26', 1312, 'k', 12576400),
(111, 'PMBY_001', '2020-07-26', 5221, 'd', 400000),
(112, 'PMBY_001', '2020-07-26', 1111, 'k', 400000),
(113, 'PMBY_001', '2020-07-26', 5222, 'd', 350000),
(114, 'PMBY_001', '2020-07-26', 1111, 'k', 350000),
(115, 'PMBY_001', '2020-07-26', 5223, 'd', 300000),
(116, 'PMBY_001', '2020-07-26', 1111, 'k', 300000),
(117, 'PMBY_001', '2020-07-26', 5221, 'd', 250000),
(118, 'PMBY_001', '2020-07-26', 1111, 'k', 250000),
(119, 'PMBY_001', '2020-07-26', 5222, 'd', 200000),
(120, 'PMBY_001', '2020-07-26', 1111, 'k', 200000),
(121, 'PMBY_001', '2020-07-26', 5223, 'd', 150000),
(122, 'PMBY_001', '2020-07-26', 1111, 'k', 150000),
(123, 'CK_002', '2020-07-27', 1112, 'd', 770000000),
(124, 'CK_002', '2020-07-27', 1111, 'k', 770000000),
(125, 'PROD1_002', '2020-07-27', 5111, 'd', 770000000),
(126, 'PROD1_002', '2020-07-27', 1112, 'k', 770000000),
(127, 'PROD1_002', '2020-07-27', 5112, 'd', 35000000),
(128, 'PROD1_002', '2020-07-27', 5311, 'k', 35000000),
(129, 'PROD1_002', '2020-07-27', 5113, 'd', 98000000),
(130, 'PROD1_002', '2020-07-27', 5312, 'k', 98000000),
(131, 'PGB_002', '2020-07-27', 1114, 'd', 64500000),
(132, 'PGB_002', '2020-07-27', 5111, 'k', 55000000),
(133, 'PGB_002', '2020-07-27', 5112, 'k', 2500000),
(134, 'PGB_002', '2020-07-27', 5113, 'k', 7000000),
(135, 'PGB_002', '2020-07-27', 1311, 'd', 838500000),
(136, 'PGB_002', '2020-07-27', 5111, 'k', 715000000),
(137, 'PGB_002', '2020-07-27', 5112, 'k', 32500000),
(138, 'PGB_002', '2020-07-27', 5113, 'k', 91000000),
(139, 'PROD2_002', '2020-07-27', 5112, 'd', 600000),
(140, 'PROD2_002', '2020-07-27', 5311, 'k', 600000),
(141, 'PROD2_002', '2020-07-27', 5113, 'd', 2100000),
(142, 'PROD2_002', '2020-07-27', 5312, 'k', 2100000),
(143, 'PROD2_002', '2020-07-27', 5135, 'd', 495000),
(144, 'PROD2_002', '2020-07-27', 1113, 'k', 495000),
(145, 'PROD2_002', '2020-07-27', 1312, 'd', 22545000),
(146, 'PROD2_002', '2020-07-27', 1114, 'k', 19350000),
(147, 'PROD2_002', '2020-07-27', 5112, 'k', 600000),
(148, 'PROD2_002', '2020-07-27', 5113, 'k', 2595000),
(149, 'PROD2_002', '2020-07-27', 5112, 'd', 200000),
(150, 'PROD2_002', '2020-07-27', 5311, 'k', 200000),
(151, 'PROD2_002', '2020-07-27', 5113, 'd', 700000),
(152, 'PROD2_002', '2020-07-27', 5312, 'k', 700000),
(153, 'PROD2_002', '2020-07-27', 5135, 'd', 605000),
(154, 'PROD2_002', '2020-07-27', 1113, 'k', 605000),
(155, 'PROD2_002', '2020-07-27', 1312, 'd', 7955000),
(156, 'PROD2_002', '2020-07-27', 1114, 'k', 6450000),
(157, 'PROD2_002', '2020-07-27', 5112, 'k', 200000),
(158, 'PROD2_002', '2020-07-27', 5113, 'k', 1305000),
(159, 'PROD2_002', '2020-07-27', 5112, 'd', 200000),
(160, 'PROD2_002', '2020-07-27', 5311, 'k', 200000),
(161, 'PROD2_002', '2020-07-27', 5113, 'd', 700000),
(162, 'PROD2_002', '2020-07-27', 5312, 'k', 700000),
(163, 'PROD2_002', '2020-07-27', 5135, 'd', 605000),
(164, 'PROD2_002', '2020-07-27', 1113, 'k', 605000),
(165, 'PROD2_002', '2020-07-27', 1312, 'd', 7955000),
(166, 'PROD2_002', '2020-07-27', 1114, 'k', 6450000),
(167, 'PROD2_002', '2020-07-27', 5112, 'k', 200000),
(168, 'PROD2_002', '2020-07-27', 5113, 'k', 1305000),
(169, 'PROD2_002', '2020-07-27', 5112, 'd', 200000),
(170, 'PROD2_002', '2020-07-27', 5311, 'k', 200000),
(171, 'PROD2_002', '2020-07-27', 5113, 'd', 700000),
(172, 'PROD2_002', '2020-07-27', 5312, 'k', 700000),
(173, 'PROD2_002', '2020-07-27', 5135, 'd', 605000),
(174, 'PROD2_002', '2020-07-27', 1113, 'k', 605000),
(175, 'PROD2_002', '2020-07-27', 1312, 'd', 7955000),
(176, 'PROD2_002', '2020-07-27', 1114, 'k', 6450000),
(177, 'PROD2_002', '2020-07-27', 5112, 'k', 200000),
(178, 'PROD2_002', '2020-07-27', 5113, 'k', 1305000),
(179, 'PROD2_002', '2020-07-27', 5112, 'd', 200000),
(180, 'PROD2_002', '2020-07-27', 5311, 'k', 200000),
(181, 'PROD2_002', '2020-07-27', 5113, 'd', 700000),
(182, 'PROD2_002', '2020-07-27', 5312, 'k', 700000),
(183, 'PROD2_002', '2020-07-27', 5135, 'd', 493000),
(184, 'PROD2_002', '2020-07-27', 1113, 'k', 493000),
(185, 'PROD2_002', '2020-07-27', 1312, 'd', 7843000),
(186, 'PROD2_002', '2020-07-27', 1114, 'k', 6450000),
(187, 'PROD2_002', '2020-07-27', 5112, 'k', 200000),
(188, 'PROD2_002', '2020-07-27', 5113, 'k', 1193000),
(189, 'PROD2_002', '2020-07-27', 5112, 'd', 200000),
(190, 'PROD2_002', '2020-07-27', 5311, 'k', 200000),
(191, 'PROD2_002', '2020-07-27', 5113, 'd', 700000),
(192, 'PROD2_002', '2020-07-27', 5312, 'k', 700000),
(193, 'PROD2_002', '2020-07-27', 5135, 'd', 493000),
(194, 'PROD2_002', '2020-07-27', 1113, 'k', 493000),
(195, 'PROD2_002', '2020-07-27', 1312, 'd', 7843000),
(196, 'PROD2_002', '2020-07-27', 1114, 'k', 6450000),
(197, 'PROD2_002', '2020-07-27', 5112, 'k', 200000),
(198, 'PROD2_002', '2020-07-27', 5113, 'k', 1193000),
(199, 'PROD2_002', '2020-07-27', 5112, 'd', 200000),
(200, 'PROD2_002', '2020-07-27', 5311, 'k', 200000),
(201, 'PROD2_002', '2020-07-27', 5113, 'd', 700000),
(202, 'PROD2_002', '2020-07-27', 5312, 'k', 700000),
(203, 'PROD2_002', '2020-07-27', 5135, 'd', 493000),
(204, 'PROD2_002', '2020-07-27', 1113, 'k', 493000),
(205, 'PROD2_002', '2020-07-27', 1312, 'd', 7843000),
(206, 'PROD2_002', '2020-07-27', 1114, 'k', 6450000),
(207, 'PROD2_002', '2020-07-27', 5112, 'k', 200000),
(208, 'PROD2_002', '2020-07-27', 5113, 'k', 1193000),
(209, 'PROD2_002', '2020-07-27', 5112, 'd', 200000),
(210, 'PROD2_002', '2020-07-27', 5311, 'k', 200000),
(211, 'PROD2_002', '2020-07-27', 5113, 'd', 700000),
(212, 'PROD2_002', '2020-07-27', 5312, 'k', 700000),
(213, 'PROD2_002', '2020-07-27', 5135, 'd', 223000),
(214, 'PROD2_002', '2020-07-27', 1113, 'k', 223000),
(215, 'PROD2_002', '2020-07-27', 1312, 'd', 7573000),
(216, 'PROD2_002', '2020-07-27', 1114, 'k', 6450000),
(217, 'PROD2_002', '2020-07-27', 5112, 'k', 200000),
(218, 'PROD2_002', '2020-07-27', 5113, 'k', 923000),
(219, 'PENJS_002', '2020-07-27', 1111, 'd', 1068925000),
(220, 'PENJS_002', '2020-07-27', 4111, 'k', 1068925000),
(221, 'PENJS_002', '2020-07-27', 6111, 'd', 838500000),
(222, 'PENJS_002', '2020-07-27', 1311, 'k', 838500000),
(223, 'PENJT_003', '2020-07-27', 1111, 'd', 2940600),
(224, 'PENJT_003', '2020-07-27', 4112, 'k', 2940600),
(225, 'PENJT_003', '2020-07-27', 6112, 'd', 2269500),
(226, 'PENJT_003', '2020-07-27', 1312, 'k', 2269500),
(227, 'PMBYV_003', '2020-07-27', 5213, 'd', 5720000),
(228, 'PMBYV_003', '2020-07-27', 1111, 'k', 5720000),
(229, 'PMBYV_004', '2020-07-27', 5211, 'd', 72000),
(230, 'PMBYV_004', '2020-07-27', 1111, 'k', 72000),
(231, 'PMBYV_004', '2020-07-27', 5212, 'd', 12000),
(232, 'PMBYV_004', '2020-07-27', 1111, 'k', 12000);

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

--
-- Dumping data for table `kartu_stok_bp`
--

INSERT INTO `kartu_stok_bp` (`no`, `no_trans`, `tgl_trans`, `no_produk`, `no_bp`, `unit1`, `harga1`, `total1`, `unit2`, `harga2`, `total2`, `unit3`, `harga3`, `total3`, `status_pro`, `status_pen`) VALUES
(1, 'CK_001', '2020-07-26 00:25:51', NULL, 'BB_001', '140000', '5000', '700000000', '-', '-', '-', '140000', '5000', '700000000', '0', '0'),
(2, 'PROD1_001', '2020-07-26 00:28:04', NULL, 'BB_001', '-', '-', '-', '140000', '5000', '700000000', '0', '0', '0', '0', '0'),
(3, 'PMBP_001', '2020-07-26 01:21:43', NULL, 'BP_001', '500000', '5', '2500000', '-', '-', '-', '500000', '5', '2500000', '0', '0'),
(4, 'PMBP_001', '2020-07-26 01:21:43', NULL, 'BP_002', '500000', '6', '3000000', '-', '-', '-', '500000', '6', '3000000', '0', '0'),
(5, 'PMBP_001', '2020-07-26 01:21:43', NULL, 'BP_003', '500000', '7', '3500000', '-', '-', '-', '500000', '7', '3500000', '0', '0'),
(6, 'PMBP_001', '2020-07-26 01:21:43', NULL, 'BP_004', '500000', '8', '4000000', '-', '-', '-', '500000', '8', '4000000', '0', '0'),
(7, 'PMBP_001', '2020-07-26 01:21:43', NULL, 'BP_005', '500000', '9', '4500000', '-', '-', '-', '500000', '9', '4500000', '0', '0'),
(8, 'PROD2_001', '2020-07-26 01:22:19', 'PR_002', 'BP_001', '-', '-', '-', '45000', '5', '225000', '455000', '5', '2275000', '0', '0'),
(9, 'PROD2_001', '2020-07-26 01:22:21', 'PR_002', 'BP_005', '-', '-', '-', '30000', '9', '270000', '470000', '9', '4230000', '0', '0'),
(10, 'PROD2_001', '2020-07-26 01:22:32', 'PR_003', 'BP_001', '-', '-', '-', '40000', '5', '200000', '415000', '5', '2075000', '0', '0'),
(11, 'PROD2_001', '2020-07-26 01:22:32', 'PR_003', 'BP_003', '-', '-', '-', '10000', '7', '70000', '490000', '7', '3430000', '0', '0'),
(12, 'PROD2_001', '2020-07-26 01:22:32', 'PR_003', 'BP_004', '-', '-', '-', '25000', '8', '200000', '475000', '8', '3800000', '0', '0'),
(13, 'PROD2_001', '2020-07-26 01:22:32', 'PR_003', 'BP_005', '-', '-', '-', '15000', '9', '135000', '455000', '9', '4095000', '0', '0'),
(14, 'PROD2_001', '2020-07-26 01:22:36', 'PR_004', 'BP_001', '-', '-', '-', '40000', '5', '200000', '375000', '5', '1875000', '0', '0'),
(15, 'PROD2_001', '2020-07-26 01:22:36', 'PR_004', 'BP_003', '-', '-', '-', '10000', '7', '70000', '480000', '7', '3360000', '0', '0'),
(16, 'PROD2_001', '2020-07-26 01:22:36', 'PR_004', 'BP_004', '-', '-', '-', '25000', '8', '200000', '450000', '8', '3600000', '0', '0'),
(17, 'PROD2_001', '2020-07-26 01:22:36', 'PR_004', 'BP_005', '-', '-', '-', '15000', '9', '135000', '440000', '9', '3960000', '0', '0'),
(18, 'PROD2_001', '2020-07-26 01:22:38', 'PR_005', 'BP_001', '-', '-', '-', '40000', '5', '200000', '335000', '5', '1675000', '0', '0'),
(19, 'PROD2_001', '2020-07-26 01:22:38', 'PR_005', 'BP_003', '-', '-', '-', '10000', '7', '70000', '470000', '7', '3290000', '0', '0'),
(20, 'PROD2_001', '2020-07-26 01:22:38', 'PR_005', 'BP_004', '-', '-', '-', '25000', '8', '200000', '425000', '8', '3400000', '0', '0'),
(21, 'PROD2_001', '2020-07-26 01:22:38', 'PR_005', 'BP_005', '-', '-', '-', '15000', '9', '135000', '425000', '9', '3825000', '0', '0'),
(22, 'PROD2_001', '2020-07-26 01:22:41', 'PR_006', 'BP_001', '-', '-', '-', '20000', '5', '100000', '315000', '5', '1575000', '0', '0'),
(23, 'PROD2_001', '2020-07-26 01:22:42', 'PR_006', 'BP_002', '-', '-', '-', '1000', '6', '6000', '499000', '6', '2994000', '0', '0'),
(24, 'PROD2_001', '2020-07-26 01:22:42', 'PR_006', 'BP_003', '-', '-', '-', '10000', '7', '70000', '460000', '7', '3220000', '0', '0'),
(25, 'PROD2_001', '2020-07-26 01:22:42', 'PR_006', 'BP_004', '-', '-', '-', '25000', '8', '200000', '400000', '8', '3200000', '0', '0'),
(26, 'PROD2_001', '2020-07-26 01:22:42', 'PR_006', 'BP_005', '-', '-', '-', '13000', '9', '117000', '412000', '9', '3708000', '0', '0'),
(27, 'PROD2_001', '2020-07-26 01:22:45', 'PR_007', 'BP_001', '-', '-', '-', '20000', '5', '100000', '295000', '5', '1475000', '0', '0'),
(28, 'PROD2_001', '2020-07-26 01:22:45', 'PR_007', 'BP_002', '-', '-', '-', '1000', '6', '6000', '498000', '6', '2988000', '0', '0'),
(29, 'PROD2_001', '2020-07-26 01:22:45', 'PR_007', 'BP_003', '-', '-', '-', '10000', '7', '70000', '450000', '7', '3150000', '0', '0'),
(30, 'PROD2_001', '2020-07-26 01:22:45', 'PR_007', 'BP_004', '-', '-', '-', '25000', '8', '200000', '375000', '8', '3000000', '0', '0'),
(31, 'PROD2_001', '2020-07-26 01:22:45', 'PR_007', 'BP_005', '-', '-', '-', '13000', '9', '117000', '399000', '9', '3591000', '0', '0'),
(32, 'PROD2_001', '2020-07-26 01:22:48', 'PR_008', 'BP_001', '-', '-', '-', '20000', '5', '100000', '275000', '5', '1375000', '0', '0'),
(33, 'PROD2_001', '2020-07-26 01:22:48', 'PR_008', 'BP_002', '-', '-', '-', '1000', '6', '6000', '497000', '6', '2982000', '0', '0'),
(34, 'PROD2_001', '2020-07-26 01:22:48', 'PR_008', 'BP_003', '-', '-', '-', '10000', '7', '70000', '440000', '7', '3080000', '0', '0'),
(35, 'PROD2_001', '2020-07-26 01:22:48', 'PR_008', 'BP_004', '-', '-', '-', '25000', '8', '200000', '350000', '8', '2800000', '0', '0'),
(36, 'PROD2_001', '2020-07-26 01:22:48', 'PR_008', 'BP_005', '-', '-', '-', '13000', '9', '117000', '386000', '9', '3474000', '0', '0'),
(37, 'PROD2_001', '2020-07-26 01:22:50', 'PR_009', 'BP_001', '-', '-', '-', '20000', '5', '100000', '255000', '5', '1275000', '0', '0'),
(38, 'PROD2_001', '2020-07-26 01:22:50', 'PR_009', 'BP_002', '-', '-', '-', '1000', '6', '6000', '496000', '6', '2976000', '0', '0'),
(39, 'PROD2_001', '2020-07-26 01:22:50', 'PR_009', 'BP_005', '-', '-', '-', '13000', '9', '117000', '373000', '9', '3357000', '0', '0'),
(40, 'CK_002', '2020-07-27 11:01:03', NULL, 'BB_001', '140000', '5500', '770000000', '-', '-', '-', '140000', '5500', '770000000', '0', '0'),
(41, 'PROD1_002', '2020-07-27 11:01:21', NULL, 'BB_001', '-', '-', '-', '140000', '5500', '770000000', '0', '0', '0', '0', '0'),
(42, 'PROD2_002', '2020-07-27 11:03:03', 'PR_002', 'BP_001', '-', '-', '-', '45000', '5', '225000', '210000', '5', '1050000', '0', '0'),
(43, 'PROD2_002', '2020-07-27 11:03:03', 'PR_002', 'BP_005', '-', '-', '-', '30000', '9', '270000', '343000', '9', '3087000', '0', '0'),
(44, 'PROD2_002', '2020-07-27 11:03:13', 'PR_003', 'BP_001', '-', '-', '-', '40000', '5', '200000', '170000', '5', '850000', '0', '0'),
(45, 'PROD2_002', '2020-07-27 11:03:13', 'PR_003', 'BP_003', '-', '-', '-', '10000', '7', '70000', '430000', '7', '3010000', '0', '0'),
(46, 'PROD2_002', '2020-07-27 11:03:13', 'PR_003', 'BP_004', '-', '-', '-', '25000', '8', '200000', '325000', '8', '2600000', '0', '0'),
(47, 'PROD2_002', '2020-07-27 11:03:13', 'PR_003', 'BP_005', '-', '-', '-', '15000', '9', '135000', '328000', '9', '2952000', '0', '0'),
(48, 'PROD2_002', '2020-07-27 11:03:15', 'PR_004', 'BP_001', '-', '-', '-', '40000', '5', '200000', '130000', '5', '650000', '0', '0'),
(49, 'PROD2_002', '2020-07-27 11:03:15', 'PR_004', 'BP_003', '-', '-', '-', '10000', '7', '70000', '420000', '7', '2940000', '0', '0'),
(50, 'PROD2_002', '2020-07-27 11:03:15', 'PR_004', 'BP_004', '-', '-', '-', '25000', '8', '200000', '300000', '8', '2400000', '0', '0'),
(51, 'PROD2_002', '2020-07-27 11:03:15', 'PR_004', 'BP_005', '-', '-', '-', '15000', '9', '135000', '313000', '9', '2817000', '0', '0'),
(52, 'PROD2_002', '2020-07-27 11:03:17', 'PR_005', 'BP_001', '-', '-', '-', '40000', '5', '200000', '90000', '5', '450000', '0', '0'),
(53, 'PROD2_002', '2020-07-27 11:03:17', 'PR_005', 'BP_003', '-', '-', '-', '10000', '7', '70000', '410000', '7', '2870000', '0', '0'),
(54, 'PROD2_002', '2020-07-27 11:03:18', 'PR_005', 'BP_004', '-', '-', '-', '25000', '8', '200000', '275000', '8', '2200000', '0', '0'),
(55, 'PROD2_002', '2020-07-27 11:03:18', 'PR_005', 'BP_005', '-', '-', '-', '15000', '9', '135000', '298000', '9', '2682000', '0', '0'),
(56, 'PROD2_002', '2020-07-27 11:03:21', 'PR_006', 'BP_001', '-', '-', '-', '20000', '5', '100000', '70000', '5', '350000', '0', '0'),
(57, 'PROD2_002', '2020-07-27 11:03:21', 'PR_006', 'BP_002', '-', '-', '-', '1000', '6', '6000', '495000', '6', '2970000', '0', '0'),
(58, 'PROD2_002', '2020-07-27 11:03:21', 'PR_006', 'BP_003', '-', '-', '-', '10000', '7', '70000', '400000', '7', '2800000', '0', '0'),
(59, 'PROD2_002', '2020-07-27 11:03:21', 'PR_006', 'BP_004', '-', '-', '-', '25000', '8', '200000', '250000', '8', '2000000', '0', '0'),
(60, 'PROD2_002', '2020-07-27 11:03:21', 'PR_006', 'BP_005', '-', '-', '-', '13000', '9', '117000', '285000', '9', '2565000', '0', '0'),
(61, 'PROD2_002', '2020-07-27 11:03:23', 'PR_007', 'BP_001', '-', '-', '-', '20000', '5', '100000', '50000', '5', '250000', '0', '0'),
(62, 'PROD2_002', '2020-07-27 11:03:23', 'PR_007', 'BP_002', '-', '-', '-', '1000', '6', '6000', '494000', '6', '2964000', '0', '0'),
(63, 'PROD2_002', '2020-07-27 11:03:23', 'PR_007', 'BP_003', '-', '-', '-', '10000', '7', '70000', '390000', '7', '2730000', '0', '0'),
(64, 'PROD2_002', '2020-07-27 11:03:23', 'PR_007', 'BP_004', '-', '-', '-', '25000', '8', '200000', '225000', '8', '1800000', '0', '0'),
(65, 'PROD2_002', '2020-07-27 11:03:23', 'PR_007', 'BP_005', '-', '-', '-', '13000', '9', '117000', '272000', '9', '2448000', '0', '0'),
(66, 'PROD2_002', '2020-07-27 11:03:26', 'PR_008', 'BP_001', '-', '-', '-', '20000', '5', '100000', '30000', '5', '150000', '0', '0'),
(67, 'PROD2_002', '2020-07-27 11:03:26', 'PR_008', 'BP_002', '-', '-', '-', '1000', '6', '6000', '493000', '6', '2958000', '0', '0'),
(68, 'PROD2_002', '2020-07-27 11:03:26', 'PR_008', 'BP_003', '-', '-', '-', '10000', '7', '70000', '380000', '7', '2660000', '0', '0'),
(69, 'PROD2_002', '2020-07-27 11:03:26', 'PR_008', 'BP_004', '-', '-', '-', '25000', '8', '200000', '200000', '8', '1600000', '0', '0'),
(70, 'PROD2_002', '2020-07-27 11:03:26', 'PR_008', 'BP_005', '-', '-', '-', '13000', '9', '117000', '259000', '9', '2331000', '0', '0'),
(71, 'PROD2_002', '2020-07-27 11:03:29', 'PR_009', 'BP_001', '-', '-', '-', '20000', '5', '100000', '10000', '5', '50000', '0', '0'),
(72, 'PROD2_002', '2020-07-27 11:03:29', 'PR_009', 'BP_002', '-', '-', '-', '1000', '6', '6000', '492000', '6', '2952000', '0', '0'),
(73, 'PROD2_002', '2020-07-27 11:03:29', 'PR_009', 'BP_005', '-', '-', '-', '13000', '9', '117000', '246000', '9', '2214000', '0', '0');

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

--
-- Dumping data for table `kartu_stok_penj`
--

INSERT INTO `kartu_stok_penj` (`no`, `no_trans`, `tgl_trans`, `no_produk`, `unit1`, `harga1`, `total1`, `unit2`, `harga2`, `total2`, `unit3`, `harga3`, `total3`, `status_pro`, `status_pen`) VALUES
(1, 'PROD1_001', '2020-07-26 00:28:20', 'PR_001', '130000', '6200', '806000000', '-', '-', '-', '130000', '6200', '806000000', '0', '0'),
(2, 'PROD2_001', '2020-07-26 01:22:21', 'PR_002', '3000', '7565', '22695000', '-', '-', '-', '3000', '7565', '22695000', '0', '0'),
(3, 'PROD2_001', '2020-07-26 01:22:32', 'PR_003', '1000', '8005', '8005000', '-', '-', '-', '1000', '8005', '8005000', '0', '0'),
(4, 'PROD2_001', '2020-07-26 01:22:36', 'PR_004', '1000', '8005', '8005000', '-', '-', '-', '1000', '8005', '8005000', '0', '0'),
(5, 'PROD2_001', '2020-07-26 01:22:38', 'PR_005', '1000', '8005', '8005000', '-', '-', '-', '1000', '8005', '8005000', '0', '0'),
(6, 'PROD2_001', '2020-07-26 01:22:42', 'PR_006', '1000', '7893', '7893000', '-', '-', '-', '1000', '7893', '7893000', '0', '0'),
(7, 'PROD2_001', '2020-07-26 01:22:45', 'PR_007', '1000', '7893', '7893000', '-', '-', '-', '1000', '7893', '7893000', '0', '0'),
(8, 'PROD2_001', '2020-07-26 01:22:48', 'PR_008', '1000', '7893', '7893000', '-', '-', '-', '1000', '7893', '7893000', '0', '0'),
(9, 'PROD2_001', '2020-07-26 01:22:50', 'PR_009', '1000', '7623', '7623000', '-', '-', '-', '1000', '7623', '7623000', '0', '0'),
(10, 'PENJS_001', '2020-07-26 01:43:55', 'PR_001', '-', '-', '-', '130000', '6200', '806000000', '0', '0', '0', '0', '0'),
(11, 'PENJT_001', '2020-07-26 01:44:03', 'PR_002', '-', '-', '-', '2500', '7565', '18912500', '500', '7565', '3782500', NULL, NULL),
(12, 'PENJT_001', '2020-07-26 01:44:07', 'PR_003', '-', '-', '-', '500', '8005', '4002500', '500', '8005', '4002500', NULL, NULL),
(13, 'PENJT_001', '2020-07-26 01:44:10', 'PR_004', '-', '-', '-', '500', '8005', '4002500', '500', '8005', '4002500', NULL, NULL),
(14, 'PENJT_001', '2020-07-26 01:44:15', 'PR_005', '-', '-', '-', '500', '8005', '4002500', '500', '8005', '4002500', NULL, NULL),
(15, 'PENJT_001', '2020-07-26 01:44:18', 'PR_006', '-', '-', '-', '500', '7893', '3946500', '500', '7893', '3946500', NULL, NULL),
(16, 'PENJT_001', '2020-07-26 01:44:21', 'PR_007', '-', '-', '-', '500', '7893', '3946500', '500', '7893', '3946500', NULL, NULL),
(17, 'PENJT_001', '2020-07-26 01:44:24', 'PR_008', '-', '-', '-', '500', '7893', '3946500', '500', '7893', '3946500', NULL, NULL),
(18, 'PENJT_001', '2020-07-26 01:44:27', 'PR_009', '-', '-', '-', '500', '7623', '3811500', '500', '7623', '3811500', NULL, NULL),
(19, 'PENJT_002', '2020-07-26 01:50:24', 'PR_002', '-', '-', '-', '200', '7565', '1513000', '300', '7565', '2269500', NULL, NULL),
(20, 'PENJT_002', '2020-07-26 01:50:29', 'PR_003', '-', '-', '-', '200', '8005', '1601000', '300', '8005', '2401500', NULL, NULL),
(21, 'PENJT_002', '2020-07-26 01:50:32', 'PR_004', '-', '-', '-', '200', '8005', '1601000', '300', '8005', '2401500', NULL, NULL),
(22, 'PENJT_002', '2020-07-26 01:50:35', 'PR_005', '-', '-', '-', '200', '8005', '1601000', '300', '8005', '2401500', NULL, NULL),
(23, 'PENJT_002', '2020-07-26 01:50:39', 'PR_006', '-', '-', '-', '200', '7893', '1578600', '300', '7893', '2367900', NULL, NULL),
(24, 'PENJT_002', '2020-07-26 01:50:43', 'PR_007', '-', '-', '-', '200', '7893', '1578600', '300', '7893', '2367900', NULL, NULL),
(25, 'PENJT_002', '2020-07-26 01:50:48', 'PR_008', '-', '-', '-', '200', '7893', '1578600', '300', '7893', '2367900', NULL, NULL),
(26, 'PENJT_002', '2020-07-26 01:50:51', 'PR_009', '-', '-', '-', '200', '7623', '1524600', '300', '7623', '2286900', NULL, NULL),
(27, 'PROD1_002', '2020-07-27 11:01:57', 'PR_001', '130000', '6450', '838500000', '-', '-', '-', '130000', '6450', '838500000', '0', '0'),
(28, 'PROD2_002', '2020-07-27 11:03:03', 'PR_002', '3000', '7515', '22545000', '-', '-', '-', '300', '7565', '2269500', '0', '0'),
(29, 'PROD2_002', '2020-07-27 11:03:03', 'PR_002', '-', '-', '-', '-', '-', '-', '3000', '7515', '22545000', '0', '0'),
(30, 'PROD2_002', '2020-07-27 11:03:13', 'PR_003', '1000', '7955', '7955000', '-', '-', '-', '300', '8005', '2401500', '0', '0'),
(31, 'PROD2_002', '2020-07-27 11:03:13', 'PR_003', '-', '-', '-', '-', '-', '-', '1000', '7955', '7955000', '0', '0'),
(32, 'PROD2_002', '2020-07-27 11:03:15', 'PR_004', '1000', '7955', '7955000', '-', '-', '-', '300', '8005', '2401500', '0', '0'),
(33, 'PROD2_002', '2020-07-27 11:03:15', 'PR_004', '-', '-', '-', '-', '-', '-', '1000', '7955', '7955000', '0', '0'),
(34, 'PROD2_002', '2020-07-27 11:03:19', 'PR_005', '1000', '7955', '7955000', '-', '-', '-', '300', '8005', '2401500', '0', '0'),
(35, 'PROD2_002', '2020-07-27 11:03:19', 'PR_005', '-', '-', '-', '-', '-', '-', '1000', '7955', '7955000', '0', '0'),
(36, 'PROD2_002', '2020-07-27 11:03:21', 'PR_006', '1000', '7843', '7843000', '-', '-', '-', '300', '7893', '2367900', '0', '0'),
(37, 'PROD2_002', '2020-07-27 11:03:21', 'PR_006', '-', '-', '-', '-', '-', '-', '1000', '7843', '7843000', '0', '0'),
(38, 'PROD2_002', '2020-07-27 11:03:24', 'PR_007', '1000', '7843', '7843000', '-', '-', '-', '300', '7893', '2367900', '0', '0'),
(39, 'PROD2_002', '2020-07-27 11:03:24', 'PR_007', '-', '-', '-', '-', '-', '-', '1000', '7843', '7843000', '0', '0'),
(40, 'PROD2_002', '2020-07-27 11:03:26', 'PR_008', '1000', '7843', '7843000', '-', '-', '-', '300', '7893', '2367900', '0', '0'),
(41, 'PROD2_002', '2020-07-27 11:03:26', 'PR_008', '-', '-', '-', '-', '-', '-', '1000', '7843', '7843000', '0', '0'),
(42, 'PROD2_002', '2020-07-27 11:03:29', 'PR_009', '1000', '7573', '7573000', '-', '-', '-', '300', '7623', '2286900', '0', '0'),
(43, 'PROD2_002', '2020-07-27 11:03:29', 'PR_009', '-', '-', '-', '-', '-', '-', '1000', '7573', '7573000', '0', '0'),
(44, 'PENJS_002', '2020-07-27 11:03:54', 'PR_001', '-', '-', '-', '130000', '6450', '838500000', '0', '0', '0', '0', '0'),
(45, 'PENJT_003', '2020-07-27 11:04:01', 'PR_002', '-', '-', '-', '300', '7565', '2269500', '3000', '7515', '22545000', NULL, NULL);

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

--
-- Dumping data for table `pembagian`
--

INSERT INTO `pembagian` (`no_trans`, `tgl_trans`, `no_trans_produksi1`, `status`, `status_penjs`) VALUES
('PGB_001', '2020-07-26', 'PROD1_001', '2', '1'),
('PGB_002', '2020-07-27', 'PROD1_002', '2', '1');

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
('PMBY_001', '2020-07-26', '1650000', '1');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaranv`
--

CREATE TABLE `pembayaranv` (
  `no_trans` varchar(50) NOT NULL,
  `tgl_trans` varchar(50) NOT NULL,
  `no_trans_penj` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `total` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaranv`
--

INSERT INTO `pembayaranv` (`no_trans`, `tgl_trans`, `no_trans_penj`, `status`, `total`) VALUES
('PMBYV_003', '2020-07-27', 'PENJS_001', '1', '5720000'),
('PMBYV_004', '2020-07-27', 'PENJT_001', '1', '84000');

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
('PMB_001', '2020-07-26', 750000000, '2'),
('PMB_002', '2020-07-27', 825000000, '2');

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

--
-- Dumping data for table `pembelian_bp`
--

INSERT INTO `pembelian_bp` (`no_trans`, `tgl_trans`, `total`, `status`) VALUES
('PMBP_001', '2020-07-26', 17500000, '1');

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
  `status_pembyv` varchar(50) DEFAULT NULL,
  `no_trans_pembg` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan_ips`
--

INSERT INTO `penjualan_ips` (`no_trans`, `tgl_trans`, `jumlah`, `total`, `status`, `status_pembyv`, `no_trans_pembg`) VALUES
('PENJS_001', '2020-07-26', '130000', 1047800000, '1', '1', 'PGB_001'),
('PENJS_002', '2020-07-27', '130000', 1068925000, '1', NULL, 'PGB_002');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_toko`
--

CREATE TABLE `penjualan_toko` (
  `no_trans` varchar(50) NOT NULL,
  `tgl_trans` varchar(50) NOT NULL,
  `total` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `status_pembyv` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan_toko`
--

INSERT INTO `penjualan_toko` (`no_trans`, `tgl_trans`, `total`, `status`, `status_pembyv`) VALUES
('PENJT_001', '2020-07-26', '60542300', '1', '1'),
('PENJT_002', '2020-07-26', '16349320', '1', NULL),
('PENJT_003', '2020-07-27', '2940600', '1', NULL);

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
('PR_001', 'Susu Sapi', 0, '8222.5', 'liter'),
('PR_002', 'Susu Murni', 3000, '9802', 'liter'),
('PR_003', 'Pasteur Coklat', 1300, '10374', 'liter'),
('PR_004', 'Pasteur Vanila', 1300, '10374', 'liter'),
('PR_005', 'Pasteur Strawberry', 1300, '10374', 'liter'),
('PR_006', 'Yoghurt Strawberry', 1300, '10228.4', 'liter'),
('PR_007', 'Yoghurt Anggur', 1300, '10228.4', 'liter'),
('PR_008', 'Yoghurt Melon', 1300, '10228.4', 'liter'),
('PR_009', 'Yoghurt Plain', 1300, '9877.4', 'liter');

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
('PROD1_001', '2020-07-26', 'CK_001', '2'),
('PROD1_002', '2020-07-27', 'CK_002', '2');

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
('PROD2_001', '2020-07-26', 'TP_001', '1'),
('PROD2_002', '2020-07-27', 'TP_002', '1');

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

--
-- Dumping data for table `target_produksi`
--

INSERT INTO `target_produksi` (`no_tp`, `tanggal`, `tgl_tp`, `status`, `no_trans_pembagian`) VALUES
('TP_001', '2020-07-26', '2020-07-26', '2', 'PGB_001'),
('TP_002', '2020-07-27', '2020-07-27', '2', 'PGB_002');

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
-- Indexes for table `btko`
--
ALTER TABLE `btko`
  ADD PRIMARY KEY (`no_btko`);

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
-- Indexes for table `pembayaranv`
--
ALTER TABLE `pembayaranv`
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
-- Indexes for table `penjualan_toko`
--
ALTER TABLE `penjualan_toko`
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
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `detail_pembagian`
--
ALTER TABLE `detail_pembagian`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `detail_pembelian_bp`
--
ALTER TABLE `detail_pembelian_bp`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `detail_penjualan_ips`
--
ALTER TABLE `detail_penjualan_ips`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `detail_penjualan_toko`
--
ALTER TABLE `detail_penjualan_toko`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `detail_produksi_ke1`
--
ALTER TABLE `detail_produksi_ke1`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `detail_produksi_ke2`
--
ALTER TABLE `detail_produksi_ke2`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `detail_target_produksi`
--
ALTER TABLE `detail_target_produksi`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `jurnal`
--
ALTER TABLE `jurnal`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=233;

--
-- AUTO_INCREMENT for table `kartu_stok_bp`
--
ALTER TABLE `kartu_stok_bp`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `kartu_stok_penj`
--
ALTER TABLE `kartu_stok_penj`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `update_stok_penj`
--
ALTER TABLE `update_stok_penj`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
