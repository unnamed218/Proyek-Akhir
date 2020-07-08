-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2020 at 08:27 AM
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
('BDP_001', 'Susu Sapi', '-2415000', 'liter');

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
('BP_001', 'Gula', 'gram', 6975000),
('BP_002', 'Bubuk Biang Yoghurt', 'gram', 14980000),
('BP_003', 'Pewarna Makanan', 'ml', 14165000),
('BP_004', 'Perisa Makanan', 'ml', 12775000),
('BP_005', 'Garam', 'gram', 11175000);

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
('BOP_001', '2020-07-07', '0', '0'),
('BOP_002', '2020-07-08', '0', '0');

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
('BTK_001', '2020-07-07', '0', '0', '10', 3000000),
('BTK_002', '2020-07-08', '0', '0', '10', 2500000);

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
('CK_001', '2020-07-07', '2'),
('CK_002', '2020-07-08', '2');

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
('BOP_001', 'JBOP_001', 2000000),
('BOP_001', 'JBOP_002', 2000000),
('BOP_001', 'JBOP_003', 2000000),
('BOP_001', 'JBOP_004', 2000000),
('BOP_002', 'JBOP_001', 1500000),
('BOP_002', 'JBOP_002', 1500000),
('BOP_002', 'JBOP_003', 1500000),
('BOP_002', 'JBOP_004', 1500000);

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
(1, 'CK_001', 'PMB_001', '250000', '750000', '1000000', '4294967294'),
(2, 'CK_002', 'PMB_002', '145000', '5000', '150000', '750000000');

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
(1, 'PGB_001', '150000', '100000'),
(2, 'PGB_002', '25000', '120000');

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
('PMBY_001', '5221', '250000', 'ips'),
('PMBY_001', '5222', '300000', 'ips'),
('PMBY_001', '5223', '200000', 'ips'),
('PMBY_001', '5213', '250000', 'ips'),
('PMBY_001', '5221', '300000', 'toko'),
('PMBY_001', '5222', '250000', 'toko'),
('PMBY_001', '5223', '200000', 'toko'),
('PMBY_001', '5211', '150000', 'toko'),
('PMBY_001', '5212', '175000', 'toko');

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
('PMB_001', 'BB_001', 500000, '4500', 2147483647, 'PTRNK_001'),
('PMB_001', 'BB_001', 500000, '5000', 2147483647, 'PTRNK_002'),
('PMB_002', 'BB_001', 150000, '5000', 750000000, 'PTRNK_001');

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
(1, 'PMBP_001', 'BP_001', 2500000, '9', 22500000, 'SBP_001', '2500000'),
(2, 'PMBP_001', 'BP_002', 2500000, '9', 22500000, 'SBP_002', '2500000'),
(3, 'PMBP_001', 'BP_003', 2500000, '7', 17500000, 'SBP_001', '2500000'),
(4, 'PMBP_001', 'BP_004', 2500000, '7', 17500000, 'SBP_002', '2500000'),
(5, 'PMBP_001', 'BP_005', 2500000, '5', 12500000, 'SBP_002', '2500000'),
(6, 'PMBP_002', 'BP_001', 5000000, '9', 45000000, 'SBP_001', '5000000'),
(7, 'PMBP_002', 'BP_002', 5000000, '5', 25000000, 'SBP_002', '5000000'),
(8, 'PMBP_002', 'BP_003', 5000000, '4', 20000000, 'SBP_001', '5000000'),
(9, 'PMBP_002', 'BP_004', 5000000, '8', 40000000, 'SBP_002', '5000000'),
(10, 'PMBP_002', 'BP_005', 5000000, '6', 30000000, 'SBP_001', '5000000');

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
(1, 'PENJS_001', 'PR_001', 150000, '5640.6574822', 846098622, 'IPS_001', '0', '650845094.1');

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
(1, 'PENJT_001', 'PR_009', '2500', '7108.357477', '17770893.6925', '13669918.225'),
(2, 'PENJT_002', 'PR_009', '2500', '7108.357477', '17770893.6925', '13669918.225'),
(3, 'PENJT_003', 'PR_005', '5000', '7862.357477', '39311787.385', '30239836.45'),
(4, 'PENJT_004', 'PR_005', '5000', '7862.357477', '39311787.385', '30239836.45');

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
(1, 'PROD1_001', 'PR_001', '1073741823.5', '3000000', '8000000', '1084741823.5', '250000', '150000', '150000'),
(2, 'PROD1_002', 'PR_001', '725000000', '2500000', '6000000', '733500000', '145000', '25000', '25000');

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
(1, 'PROD2_001', '2020-07-07', 'PR_002', '108474182.25', '750000', '8000000', '17250000', '134474182.25', '2500000', '2500000'),
(2, 'PROD2_001', '2020-07-07', 'PR_003', '86779345.8', '600000', '8000000', '17580000', '112959345.8', '20000', '20000'),
(3, 'PROD2_001', '2020-07-07', 'PR_004', '108474182.25', '750000', '8000000', '21975000', '139199182.25', '25000', '25000'),
(4, 'PROD2_001', '2020-07-07', 'PR_005', '43389672.9', '300000', '8000000', '8790000', '60479672.9', '10000', '0'),
(5, 'PROD2_001', '2020-07-07', 'PR_009', '86779345.8', '600000', '8000000', '13980000', '109359345.8', '20000', '15000'),
(6, 'PROD2_002', '2020-07-08', 'PR_002', '75879310.375', '312500', '6000000', '36608333.333333', '118800143.70833', '15000', '15000'),
(7, 'PROD2_002', '2020-07-08', 'PR_003', '75879310.375', '312500', '6000000', '108424083.69202', '190615894.06702', '15000', '15000'),
(8, 'PROD2_002', '2020-07-08', 'PR_005', '151758620.75', '625000', '6000000', '216848167.38405', '375231788.13405', '30000', '30000');

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
(1, 'TP_001', 'PR_002', 25000, '1'),
(2, 'TP_001', 'PR_003', 20000, '1'),
(3, 'TP_001', 'PR_004', 25000, '1'),
(4, 'TP_001', 'PR_005', 10000, '1'),
(5, 'TP_001', 'PR_009', 20000, '1'),
(6, 'TP_002', 'PR_002', 15000, '1'),
(7, 'TP_002', 'PR_003', 15000, '1'),
(8, 'TP_002', 'PR_005', 30000, '1'),
(9, 'TP_002', 'PR_009', 40000, NULL),
(10, 'TP_002', 'PR_004', 5000, NULL),
(11, 'TP_002', 'PR_006', 5000, NULL),
(12, 'TP_002', 'PR_007', 5000, NULL),
(13, 'TP_002', 'PR_008', 5000, NULL);

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
(1, 'CK_001', '2020-07-07', 1112, 'd', 1073741824),
(2, 'CK_001', '2020-07-07', 1111, 'k', 1073741824),
(3, 'PROD1_001', '2020-07-07', 5111, 'd', 1073741824),
(4, 'PROD1_001', '2020-07-07', 1112, 'k', 1073741824),
(5, 'PROD1_001', '2020-07-07', 5112, 'd', 3000000),
(6, 'PROD1_001', '2020-07-07', 5311, 'k', 3000000),
(7, 'PROD1_001', '2020-07-07', 5113, 'd', 8000000),
(8, 'PROD1_001', '2020-07-07', 5312, 'k', 8000000),
(9, 'PGB_001', '2020-07-07', 1114, 'd', 433896729),
(10, 'PGB_001', '2020-07-07', 5111, 'k', 429496729),
(11, 'PGB_001', '2020-07-07', 5112, 'k', 1200000),
(12, 'PGB_001', '2020-07-07', 5113, 'k', 3200000),
(13, 'PGB_001', '2020-07-07', 1311, 'd', 650845094),
(14, 'PGB_001', '2020-07-07', 5111, 'k', 644245094),
(15, 'PGB_001', '2020-07-07', 5112, 'k', 1800000),
(16, 'PGB_001', '2020-07-07', 5113, 'k', 4800000),
(17, 'PMBP_001', '2020-07-07', 1113, 'd', 92500000),
(18, 'PMBP_001', '2020-07-07', 1111, 'k', 92500000),
(19, 'PROD2_001', '2020-07-07', 5112, 'd', 750000),
(20, 'PROD2_001', '2020-07-07', 5311, 'k', 750000),
(21, 'PROD2_001', '2020-07-07', 5113, 'd', 8000000),
(22, 'PROD2_001', '2020-07-07', 5312, 'k', 8000000),
(23, 'PROD2_001', '2020-07-07', 5135, 'd', 17250000),
(24, 'PROD2_001', '2020-07-07', 1113, 'k', 17250000),
(25, 'PROD2_001', '2020-07-07', 1312, 'd', 134474182),
(26, 'PROD2_001', '2020-07-07', 1114, 'k', 108474182),
(27, 'PROD2_001', '2020-07-07', 5112, 'k', 750000),
(28, 'PROD2_001', '2020-07-07', 5113, 'k', 25250000),
(29, 'PROD2_001', '2020-07-07', 5112, 'd', 600000),
(30, 'PROD2_001', '2020-07-07', 5311, 'k', 600000),
(31, 'PROD2_001', '2020-07-07', 5113, 'd', 8000000),
(32, 'PROD2_001', '2020-07-07', 5312, 'k', 8000000),
(33, 'PROD2_001', '2020-07-07', 5135, 'd', 17580000),
(34, 'PROD2_001', '2020-07-07', 1113, 'k', 17580000),
(35, 'PROD2_001', '2020-07-07', 1312, 'd', 112959346),
(36, 'PROD2_001', '2020-07-07', 1114, 'k', 86779346),
(37, 'PROD2_001', '2020-07-07', 5112, 'k', 600000),
(38, 'PROD2_001', '2020-07-07', 5113, 'k', 25580000),
(39, 'PROD2_001', '2020-07-07', 5112, 'd', 750000),
(40, 'PROD2_001', '2020-07-07', 5311, 'k', 750000),
(41, 'PROD2_001', '2020-07-07', 5113, 'd', 8000000),
(42, 'PROD2_001', '2020-07-07', 5312, 'k', 8000000),
(43, 'PROD2_001', '2020-07-07', 5135, 'd', 21975000),
(44, 'PROD2_001', '2020-07-07', 1113, 'k', 21975000),
(45, 'PROD2_001', '2020-07-07', 1312, 'd', 139199182),
(46, 'PROD2_001', '2020-07-07', 1114, 'k', 108474182),
(47, 'PROD2_001', '2020-07-07', 5112, 'k', 750000),
(48, 'PROD2_001', '2020-07-07', 5113, 'k', 29975000),
(49, 'PROD2_001', '2020-07-07', 5112, 'd', 300000),
(50, 'PROD2_001', '2020-07-07', 5311, 'k', 300000),
(51, 'PROD2_001', '2020-07-07', 5113, 'd', 8000000),
(52, 'PROD2_001', '2020-07-07', 5312, 'k', 8000000),
(53, 'PROD2_001', '2020-07-07', 5135, 'd', 8790000),
(54, 'PROD2_001', '2020-07-07', 1113, 'k', 8790000),
(55, 'PROD2_001', '2020-07-07', 1312, 'd', 60479673),
(56, 'PROD2_001', '2020-07-07', 1114, 'k', 43389673),
(57, 'PROD2_001', '2020-07-07', 5112, 'k', 300000),
(58, 'PROD2_001', '2020-07-07', 5113, 'k', 16790000),
(59, 'PROD2_001', '2020-07-07', 5112, 'd', 600000),
(60, 'PROD2_001', '2020-07-07', 5311, 'k', 600000),
(61, 'PROD2_001', '2020-07-07', 5113, 'd', 8000000),
(62, 'PROD2_001', '2020-07-07', 5312, 'k', 8000000),
(63, 'PROD2_001', '2020-07-07', 5135, 'd', 13980000),
(64, 'PROD2_001', '2020-07-07', 1113, 'k', 13980000),
(65, 'PROD2_001', '2020-07-07', 1312, 'd', 109359346),
(66, 'PROD2_001', '2020-07-07', 1114, 'k', 86779346),
(67, 'PROD2_001', '2020-07-07', 5112, 'k', 600000),
(68, 'PROD2_001', '2020-07-07', 5113, 'k', 21980000),
(69, 'PENJS_001', '2020-07-07', 1111, 'd', 846098622),
(70, 'PENJS_001', '2020-07-07', 4111, 'k', 846098622),
(71, 'PENJS_001', '2020-07-07', 6111, 'd', 650845094),
(72, 'PENJS_001', '2020-07-07', 1311, 'k', 650845094),
(73, 'PENJT_001', '2020-07-07', 1111, 'd', 17770894),
(74, 'PENJT_001', '2020-07-07', 4112, 'k', 17770894),
(75, 'PENJT_001', '2020-07-07', 6112, 'd', 13669918),
(76, 'PENJT_001', '2020-07-07', 1312, 'k', 13669918),
(77, 'PENJT_002', '2020-07-07', 1111, 'd', 17770894),
(78, 'PENJT_002', '2020-07-07', 4112, 'k', 17770894),
(79, 'PENJT_002', '2020-07-07', 6112, 'd', 13669918),
(80, 'PENJT_002', '2020-07-07', 1312, 'k', 13669918),
(81, 'PMBY_001', '2020-07-07', 5221, 'd', 250000),
(82, 'PMBY_001', '2020-07-07', 1111, 'k', 250000),
(83, 'PMBY_001', '2020-07-07', 5222, 'd', 300000),
(84, 'PMBY_001', '2020-07-07', 1111, 'k', 300000),
(85, 'PMBY_001', '2020-07-07', 5223, 'd', 200000),
(86, 'PMBY_001', '2020-07-07', 1111, 'k', 200000),
(87, 'PMBY_001', '2020-07-07', 5213, 'd', 250000),
(88, 'PMBY_001', '2020-07-07', 1111, 'k', 250000),
(89, 'PMBY_001', '2020-07-07', 5221, 'd', 300000),
(90, 'PMBY_001', '2020-07-07', 1111, 'k', 300000),
(91, 'PMBY_001', '2020-07-07', 5222, 'd', 250000),
(92, 'PMBY_001', '2020-07-07', 1111, 'k', 250000),
(93, 'PMBY_001', '2020-07-07', 5223, 'd', 200000),
(94, 'PMBY_001', '2020-07-07', 1111, 'k', 200000),
(95, 'PMBY_001', '2020-07-07', 5211, 'd', 150000),
(96, 'PMBY_001', '2020-07-07', 1111, 'k', 150000),
(97, 'PMBY_001', '2020-07-07', 5212, 'd', 175000),
(98, 'PMBY_001', '2020-07-07', 1111, 'k', 175000),
(99, 'PENJT_003', '2020-07-07', 1111, 'd', 39311787),
(100, 'PENJT_003', '2020-07-07', 4112, 'k', 39311787),
(101, 'PENJT_003', '2020-07-07', 6112, 'd', 30239836),
(102, 'PENJT_003', '2020-07-07', 1312, 'k', 30239836),
(103, 'PENJT_004', '2020-07-07', 1111, 'd', 39311787),
(104, 'PENJT_004', '2020-07-07', 4112, 'k', 39311787),
(105, 'PENJT_004', '2020-07-07', 6112, 'd', 30239836),
(106, 'PENJT_004', '2020-07-07', 1312, 'k', 30239836),
(107, 'CK_002', '2020-07-08', 1112, 'd', 725000000),
(108, 'CK_002', '2020-07-08', 1111, 'k', 725000000),
(109, 'PROD1_002', '2020-07-08', 5111, 'd', 725000000),
(110, 'PROD1_002', '2020-07-08', 1112, 'k', 725000000),
(111, 'PROD1_002', '2020-07-08', 5112, 'd', 2500000),
(112, 'PROD1_002', '2020-07-08', 5311, 'k', 2500000),
(113, 'PROD1_002', '2020-07-08', 5113, 'd', 6000000),
(114, 'PROD1_002', '2020-07-08', 5312, 'k', 6000000),
(115, 'PGB_002', '2020-07-08', 1114, 'd', 607034483),
(116, 'PGB_002', '2020-07-08', 5111, 'k', 600000000),
(117, 'PGB_002', '2020-07-08', 5112, 'k', 2068966),
(118, 'PGB_002', '2020-07-08', 5113, 'k', 4965517),
(119, 'PGB_002', '2020-07-08', 1311, 'd', 126465517),
(120, 'PGB_002', '2020-07-08', 5111, 'k', 125000000),
(121, 'PGB_002', '2020-07-08', 5112, 'k', 431034),
(122, 'PGB_002', '2020-07-08', 5113, 'k', 1034483),
(123, 'PMBP_002', '2020-07-08', 1113, 'd', 160000000),
(124, 'PMBP_002', '2020-07-08', 1111, 'k', 160000000),
(125, 'PROD2_002', '2020-07-08', 5112, 'd', 312500),
(126, 'PROD2_002', '2020-07-08', 5311, 'k', 312500),
(127, 'PROD2_002', '2020-07-08', 5113, 'd', 6000000),
(128, 'PROD2_002', '2020-07-08', 5312, 'k', 6000000),
(129, 'PROD2_002', '2020-07-08', 5135, 'd', 36608333),
(130, 'PROD2_002', '2020-07-08', 1113, 'k', 36608333),
(131, 'PROD2_002', '2020-07-08', 1312, 'd', 118800144),
(132, 'PROD2_002', '2020-07-08', 1114, 'k', 75879310),
(133, 'PROD2_002', '2020-07-08', 5112, 'k', 312500),
(134, 'PROD2_002', '2020-07-08', 5113, 'k', 42608333),
(135, 'PROD2_002', '2020-07-08', 5112, 'd', 312500),
(136, 'PROD2_002', '2020-07-08', 5311, 'k', 312500),
(137, 'PROD2_002', '2020-07-08', 5113, 'd', 6000000),
(138, 'PROD2_002', '2020-07-08', 5312, 'k', 6000000),
(139, 'PROD2_002', '2020-07-08', 5135, 'd', 108424084),
(140, 'PROD2_002', '2020-07-08', 1113, 'k', 108424084),
(141, 'PROD2_002', '2020-07-08', 1312, 'd', 190615894),
(142, 'PROD2_002', '2020-07-08', 1114, 'k', 75879310),
(143, 'PROD2_002', '2020-07-08', 5112, 'k', 312500),
(144, 'PROD2_002', '2020-07-08', 5113, 'k', 114424084),
(145, 'PROD2_002', '2020-07-08', 5112, 'd', 625000),
(146, 'PROD2_002', '2020-07-08', 5311, 'k', 625000),
(147, 'PROD2_002', '2020-07-08', 5113, 'd', 6000000),
(148, 'PROD2_002', '2020-07-08', 5312, 'k', 6000000),
(149, 'PROD2_002', '2020-07-08', 5135, 'd', 216848167),
(150, 'PROD2_002', '2020-07-08', 1113, 'k', 216848167),
(151, 'PROD2_002', '2020-07-08', 1312, 'd', 375231788),
(152, 'PROD2_002', '2020-07-08', 1114, 'k', 151758621),
(153, 'PROD2_002', '2020-07-08', 5112, 'k', 625000),
(154, 'PROD2_002', '2020-07-08', 5113, 'k', 222848167);

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
(1, 'CK_001', '2020-07-07 06:55:51', NULL, 'BB_001', '250000', '4294.967294', '1073741823.5', '-', '-', '-', '250000', '4294.967294', '1073741823.5', '0', '0'),
(2, 'PROD1_001', '2020-07-07 07:08:19', NULL, 'BB_001', '-', '-', '-', '250000', '4294.967294', '1073741823.5', '-', '-', '-', '0', '0'),
(3, 'PMBP_001', '2020-07-07 07:15:51', NULL, 'BP_001', '2500000', '9', '22500000', '-', '-', '-', '2500000', '9', '22500000', '0', '0'),
(4, 'PMBP_001', '2020-07-07 07:15:51', NULL, 'BP_002', '2500000', '9', '22500000', '-', '-', '-', '2500000', '9', '22500000', '0', '0'),
(5, 'PMBP_001', '2020-07-07 07:15:51', NULL, 'BP_003', '2500000', '7', '17500000', '-', '-', '-', '2500000', '7', '17500000', '0', '0'),
(6, 'PMBP_001', '2020-07-07 07:15:51', NULL, 'BP_004', '2500000', '7', '17500000', '-', '-', '-', '2500000', '7', '17500000', '0', '0'),
(7, 'PMBP_001', '2020-07-07 07:15:51', NULL, 'BP_005', '2500000', '5', '12500000', '-', '-', '-', '2500000', '5', '12500000', '0', '0'),
(8, 'PROD2_001', '2020-07-07 07:16:51', NULL, 'BP_001', '-', '-', '-', '1500000', '9', '13500000', '1000000', '9', '9000000', '0', '0'),
(9, 'PROD2_001', '2020-07-07 07:16:51', NULL, 'BP_005', '-', '-', '-', '750000', '5', '3750000', '1750000', '5', '8750000', '0', '0'),
(10, 'PROD2_001', '2020-07-07 07:20:41', NULL, 'BP_001', '-', '-', '-', '1200000', '9', '10800000', '-200000', '9', '-1800000', '0', '0'),
(11, 'PROD2_001', '2020-07-07 07:20:41', NULL, 'BP_003', '-', '-', '-', '140000', '7', '980000', '2360000', '7', '16520000', '0', '0'),
(12, 'PROD2_001', '2020-07-07 07:20:41', NULL, 'BP_004', '-', '-', '-', '400000', '7', '2800000', '2100000', '7', '14700000', '0', '0'),
(13, 'PROD2_001', '2020-07-07 07:20:41', NULL, 'BP_005', '-', '-', '-', '600000', '5', '3000000', '1150000', '5', '5750000', '0', '0'),
(14, 'PROD2_001', '2020-07-07 07:24:37', NULL, 'BP_001', '-', '-', '-', '1500000', '9', '13500000', '-1700000', '9', '-15300000', '0', '0'),
(15, 'PROD2_001', '2020-07-07 07:24:37', NULL, 'BP_003', '-', '-', '-', '175000', '7', '1225000', '2185000', '7', '15295000', '0', '0'),
(16, 'PROD2_001', '2020-07-07 07:24:38', NULL, 'BP_004', '-', '-', '-', '500000', '7', '3500000', '1600000', '7', '11200000', '0', '0'),
(17, 'PROD2_001', '2020-07-07 07:24:38', NULL, 'BP_005', '-', '-', '-', '750000', '5', '3750000', '400000', '5', '2000000', '0', '0'),
(18, 'PROD2_001', '2020-07-07 07:24:42', NULL, 'BP_001', '-', '-', '-', '600000', '9', '5400000', '-2300000', '9', '-20700000', '0', '0'),
(19, 'PROD2_001', '2020-07-07 07:24:42', NULL, 'BP_003', '-', '-', '-', '70000', '7', '490000', '2115000', '7', '14805000', '0', '0'),
(20, 'PROD2_001', '2020-07-07 07:24:42', NULL, 'BP_004', '-', '-', '-', '200000', '7', '1400000', '1400000', '7', '9800000', '0', '0'),
(21, 'PROD2_001', '2020-07-07 07:24:42', NULL, 'BP_005', '-', '-', '-', '300000', '5', '1500000', '100000', '5', '500000', '0', '0'),
(22, 'PROD2_001', '2020-07-07 07:28:29', NULL, 'BP_001', '-', '-', '-', '1200000', '9', '10800000', '-3500000', '9', '-31500000', '0', '0'),
(23, 'PROD2_001', '2020-07-07 07:28:29', NULL, 'BP_002', '-', '-', '-', '20000', '9', '180000', '2480000', '9', '22320000', '0', '0'),
(24, 'PROD2_001', '2020-07-07 07:28:29', NULL, 'BP_005', '-', '-', '-', '600000', '5', '3000000', '-500000', '5', '-2500000', '0', '0'),
(25, 'CK_002', '2020-07-08 10:45:37', NULL, 'BB_001', '145000', '5000', '725000000', '-', '-', '-', '145000', '5000', '725000000', '0', '0'),
(26, 'PROD1_002', '2020-07-08 10:45:57', NULL, 'BB_001', '-', '-', '-', '145000', '5000', '725000000', '-', '-', '-', '0', '0'),
(27, 'PMBP_002', '2020-07-08 11:08:22', NULL, 'BP_001', '5000000', '9', '45000000', '-', '-', '-', '1500000', '115.66666666667', '173500000', '0', '0'),
(28, 'PMBP_002', '2020-07-08 11:08:22', NULL, 'BP_002', '5000000', '5', '25000000', '-', '-', '-', '7480000', '33.732620320856', '252320000', '0', '0'),
(29, 'PMBP_002', '2020-07-08 11:08:22', NULL, 'BP_003', '5000000', '4', '20000000', '-', '-', '-', '7115000', '37.217849613493', '264805000', '0', '0'),
(30, 'PMBP_002', '2020-07-08 11:08:22', NULL, 'BP_004', '5000000', '8', '40000000', '-', '-', '-', '6400000', '46.84375', '299800000', '0', '0'),
(31, 'PMBP_002', '2020-07-08 11:08:22', NULL, 'BP_005', '5000000', '6', '30000000', '-', '-', '-', '4500000', '70.555555555556', '317500000', '0', '0'),
(32, 'PROD2_002', '2020-07-08 11:09:25', NULL, 'BP_001', '-', '-', '-', '225000', '115.66666666667', '26025000.000001', '1275000', '115.66666666667', '147475000', '0', '0'),
(33, 'PROD2_002', '2020-07-08 11:09:25', NULL, 'BP_005', '-', '-', '-', '150000', '70.555555555556', '10583333.333333', '4350000', '70.555555555556', '306916666.66667', '0', '0'),
(34, 'PROD2_002', '2020-07-08 11:10:04', 'PR_003', 'BP_001', '-', '-', '-', '600000', '115.66666666667', '69400000.000002', '675000', '115.66666666667', '78075000.000002', '0', '0'),
(35, 'PROD2_002', '2020-07-08 11:10:04', NULL, 'BP_003', '-', '-', '-', '150000', '37.217849613493', '5582677.442024', '6965000', '37.217849613493', '259222322.55798', '0', '0'),
(36, 'PROD2_002', '2020-07-08 11:10:04', NULL, 'BP_004', '-', '-', '-', '375000', '46.84375', '17566406.25', '6025000', '46.84375', '282233593.75', '0', '0'),
(37, 'PROD2_002', '2020-07-08 11:10:04', NULL, 'BP_005', '-', '-', '-', '225000', '70.555555555556', '15875000', '4125000', '70.555555555556', '291041666.66667', '0', '0'),
(38, 'PROD2_002', '2020-07-08 11:39:32', 'PR_005', 'BP_001', '-', '-', '-', '1200000', '115.66666666667', '138800000', '-525000', '115.66666666667', '-60725000.000002', '0', '0'),
(39, 'PROD2_002', '2020-07-08 11:39:32', 'PR_005', 'BP_003', '-', '-', '-', '300000', '37.217849613493', '11165354.884048', '6665000', '37.217849613493', '248056967.67393', '0', '0'),
(40, 'PROD2_002', '2020-07-08 11:39:32', 'PR_005', 'BP_004', '-', '-', '-', '750000', '46.84375', '35132812.5', '5275000', '46.84375', '247100781.25', '0', '0'),
(41, 'PROD2_002', '2020-07-08 11:39:32', 'PR_005', 'BP_005', '-', '-', '-', '450000', '70.555555555556', '31750000', '3675000', '70.555555555556', '259291666.66667', '0', '0');

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
  `status_pro` varchar(50) NOT NULL,
  `status_pen` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kartu_stok_penj`
--

INSERT INTO `kartu_stok_penj` (`no`, `no_trans`, `tgl_trans`, `no_produk`, `unit1`, `harga1`, `total1`, `unit2`, `harga2`, `total2`, `unit3`, `harga3`, `total3`, `status_pro`, `status_pen`) VALUES
(1, 'PROD1_001', '2020-07-07 07:08:36', 'PR_001', '150000', '4338.967294', '650845094.1', '-', '-', '-', '150000', '4338.967294', '650845094.1', '1', '0'),
(2, 'PROD2_001', '2020-07-07 07:16:51', 'PR_002', '2500000', '53.7896729', '134474182.25', '-', '-', '-', '2500000', '53.7896729', '134474182.25', '1', '0'),
(3, 'PROD2_001', '2020-07-07 07:20:41', 'PR_003', '20000', '5647.96729', '112959345.8', '-', '-', '-', '20000', '5647.96729', '112959345.8', '1', '0'),
(4, 'PROD2_001', '2020-07-07 07:24:38', 'PR_004', '25000', '5567.96729', '139199182.25', '-', '-', '-', '25000', '5567.96729', '139199182.25', '0', '0'),
(5, 'PROD2_001', '2020-07-07 07:24:43', 'PR_005', '10000', '6047.96729', '60479672.9', '-', '-', '-', '10000', '6047.96729', '60479672.9', '1', '0'),
(6, 'PROD2_001', '2020-07-07 07:28:29', 'PR_009', '20000', '5467.96729', '109359345.8', '-', '-', '-', '20000', '5467.96729', '109359345.8', '0', '0'),
(7, 'PENJS_001', '2020-07-07 07:47:40', 'PR_001', '-', '-', '-', '150000', '5640.65748', '846098622', '0', '0', '0', '0', '0'),
(8, 'PENJT_001', '2020-07-07 07:47:56', 'PR_009', '-', '-', '-', '2500', '7108.357477', '17770893.6925', '17500', '5467.96729', '95689427.575', '', ''),
(9, 'PENJT_002', '2020-07-07 07:48:10', 'PR_009', '-', '-', '-', '2500', '7108.357477', '17770893.6925', '15000', '5467.96729', '82019509.35', '', ''),
(10, 'PENJT_003', '2020-07-07 07:52:46', 'PR_005', '-', '-', '-', '5000', '7862.357477', '39311787.385', '5000', '6047.96729', '30239836.45', '1', ''),
(11, 'PENJT_004', '2020-07-07 10:11:06', 'PR_005', '-', '-', '-', '5000', '7862.357477', '39311787.385', '5000', '7862.357477', '39311787.385', '1', ''),
(12, 'PROD1_002', '2020-07-08 10:50:12', 'PR_001', '-', '-', '-', '-', '-', '-', '150000', '4338.967294', '650845094.1', '0', '0'),
(13, 'PROD1_002', '2020-07-08 10:50:13', 'PR_001', '25000', '5058.6206896552', '126465517.24138', '-', '-', '-', '25000', '5058.6206896552', '126465517.24138', '0', '0'),
(14, 'PROD2_002', '2020-07-08 11:09:25', 'PR_002', '15000', '7920.0095805555', '118800143.70833', '-', '-', '-', '2500000', '53.7896729', '134474182.25', '0', '0'),
(15, 'PROD2_002', '2020-07-08 11:09:25', 'PR_002', '-', '-', '-', '-', '-', '-', '15000', '7920.0095805555', '118800143.70833', '0', '0'),
(16, 'PROD2_002', '2020-07-08 11:10:04', 'PR_003', '15000', '12707.726271135', '190615894.06702', '-', '-', '-', '20000', '5647.96729', '112959345.8', '0', '0'),
(17, 'PROD2_002', '2020-07-08 11:10:04', 'PR_003', '-', '-', '-', '-', '-', '-', '15000', '12707.726271135', '190615894.06702', '0', '0'),
(18, 'PROD2_002', '2020-07-08 11:39:32', 'PR_005', '30000', '12507.726271135', '375231788.13405', '-', '-', '-', '10000', '6047.96729', '60479672.9', '0', '0'),
(19, 'PROD2_002', '2020-07-08 11:39:32', 'PR_005', '-', '-', '-', '-', '-', '-', '5000', '6047.96729', '30239836.45', '0', '0'),
(20, 'PROD2_002', '2020-07-08 11:39:32', 'PR_005', '-', '-', '-', '-', '-', '-', '5000', '7862.357477', '39311787.385', '0', '0'),
(21, 'PROD2_002', '2020-07-08 11:39:32', 'PR_005', '-', '-', '-', '-', '-', '-', '30000', '12507.726271135', '375231788.13405', '0', '0');

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
('IPS_001', 'Agus', '123123123', 'Jakarta'),
('IPS_002', 'Joko', '321321321', 'Bandung'),
('IPS_003', 'Suparman', '432432432', 'Semarang');

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
('PGB_001', '2020-07-07', 'PROD1_001', '2', '1'),
('PGB_002', '2020-07-08', 'PROD1_002', '2', NULL);

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
('PMBY_001', '2020-07-07', '2075000', '1');

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
('PMB_001', '2020-07-07', 2147483647, '2'),
('PMB_002', '2020-07-08', 750000000, '2');

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
('PMBP_001', '2020-07-07', 92500000, '1'),
('PMBP_002', '2020-07-08', 160000000, '1');

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

--
-- Dumping data for table `penjualan_ips`
--

INSERT INTO `penjualan_ips` (`no_trans`, `tgl_trans`, `jumlah`, `total`, `status`, `no_trans_pembg`) VALUES
('PENJS_001', '2020-07-07', '150000', 846098622, '1', 'PGB_001');

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
('PENJT_001', '2020-07-07', '17770893.6925', '1'),
('PENJT_002', '2020-07-07', '17770893.6925', '1'),
('PENJT_003', '2020-07-07', '39311787.385', '1'),
('PENJT_004', '2020-07-07', '39311787.385', '1');

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
  `harga_jual` varchar(50) NOT NULL,
  `satuan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`no_produk`, `nama_produk`, `stok`, `harga_jual`, `satuan`) VALUES
('PR_001', 'Susu Sapi', 25000, '16301.478417586', 'liter'),
('PR_002', 'Susu Murni', 2515000, '130.91714661862', 'liter'),
('PR_003', 'Pasteur Coklat', 35000, '11275.651766489', 'liter'),
('PR_004', 'Pasteur Vanila', 25000, '7238.357477', 'liter'),
('PR_005', 'Pasteur Strawberry', 30000, '14160.622483607', 'liter'),
('PR_006', 'Yoghurt Strawberry', 0, '0', 'liter'),
('PR_007', 'Yoghurt Anggur', 0, '0', 'liter'),
('PR_008', 'Yoghurt Melon', 0, '0', 'liter'),
('PR_009', 'Yoghurt Plain', 15000, '7108.357477', 'liter');

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
('PROD1_001', '2020-07-07', 'CK_001', '2'),
('PROD1_002', '2020-07-08', 'CK_002', '2');

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
('PROD2_001', '2020-07-07', 'TP_001', '1'),
('PROD2_002', '2020-07-08', 'TP_002', '0');

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
('TP_001', '2020-07-07', '2020-07-07', '2', 'PGB_001'),
('TP_002', '2020-07-08', '2020-07-08', '2', 'PGB_002');

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
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `detail_penjualan_ips`
--
ALTER TABLE `detail_penjualan_ips`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `detail_penjualan_toko`
--
ALTER TABLE `detail_penjualan_toko`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `detail_produksi_ke1`
--
ALTER TABLE `detail_produksi_ke1`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `detail_produksi_ke2`
--
ALTER TABLE `detail_produksi_ke2`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `detail_target_produksi`
--
ALTER TABLE `detail_target_produksi`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `jurnal`
--
ALTER TABLE `jurnal`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT for table `kartu_stok_bp`
--
ALTER TABLE `kartu_stok_bp`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `kartu_stok_penj`
--
ALTER TABLE `kartu_stok_penj`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
