-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2020 at 02:50 AM
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
  `no` int(11) NOT NULL,
  `no_bb` varchar(50) NOT NULL,
  `nama_bb` varchar(50) NOT NULL,
  `harga` int(50) NOT NULL,
  `satuan` varchar(50) DEFAULT NULL,
  `stok` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bahan_baku`
--

INSERT INTO `bahan_baku` (`no`, `no_bb`, `nama_bb`, `harga`, `satuan`, `stok`) VALUES
(0, 'BB_001', 'Susu Sapi', 5000, 'liter', 0);

-- --------------------------------------------------------

--
-- Table structure for table `bahan_dalam_proses`
--

CREATE TABLE `bahan_dalam_proses` (
  `no` int(11) NOT NULL,
  `no_bdp` varchar(50) NOT NULL,
  `nama_bdp` varchar(50) NOT NULL,
  `stok` varchar(50) NOT NULL,
  `satuan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bahan_dalam_proses`
--

INSERT INTO `bahan_dalam_proses` (`no`, `no_bdp`, `nama_bdp`, `stok`, `satuan`) VALUES
(1, 'BDP_001', 'Susu Sapi', '900', 'liter');

-- --------------------------------------------------------

--
-- Table structure for table `bahan_penolong`
--

CREATE TABLE `bahan_penolong` (
  `no` int(11) NOT NULL,
  `no_bp` varchar(100) NOT NULL,
  `nama_bp` varchar(100) NOT NULL,
  `harga` int(100) NOT NULL,
  `satuan` varchar(100) DEFAULT NULL,
  `stok` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bahan_penolong`
--

INSERT INTO `bahan_penolong` (`no`, `no_bp`, `nama_bp`, `harga`, `satuan`, `stok`) VALUES
(1, 'BP_001', 'Gula', 11500, 'kg', 900),
(2, 'BP_002', 'Bubuk Biang Yoghurt 20 gr', 74500, 'buah', 700),
(3, 'BP_003', 'Pewarna Makanan 30 ml', 4500, 'buah', 200),
(4, 'BP_004', 'Perisa Makanan', 7500, 'buah', 500),
(5, 'BP_005', 'Garam', 10000, 'kg', 700);

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
('BOP_001', '05', '2020'),
('BOP_002', '06', '2020');

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
('CK_001', '2020-06-14', 'PMB_001', '2');

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
('BOP_001', 'JBOP_004', 2000000),
('BOP_002', 'JBOP_001', 13000000),
('BOP_002', 'JBOP_002', 2000000),
('BOP_002', 'JBOP_003', 2000000),
('BOP_002', 'JBOP_004', 2000000);

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
(1, 'CK_001', '700', '200', '900');

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
(1, 'PROD1_001', '2020-06-14', 'BB_001', '700', '3500000');

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
(1, 'PROD2_001', '2020-06-14', 'BP_001', '100', '1150000'),
(2, 'PROD2_001', '2020-06-14', 'BP_005', '100', '1000000');

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
(1, 'PGB_001', '300', '400');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pembayaran`
--

CREATE TABLE `detail_pembayaran` (
  `no_trans` varchar(50) NOT NULL,
  `no_coa` varchar(50) NOT NULL,
  `subtotal` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
('PMB_001', 'BB_001', 800, 4000000, 'PTRNK_001'),
('PMB_002', 'BB_001', 200, 1000000, 'PTRNK_002'),
('PMB_003', 'BB_001', 1000, 5000000, 'PTRNK_002'),
('PMB_004', 'BB_001', 1000, 5000000, 'PTRNK_002'),
('PMB_001', 'BB_001', 100, 500000, 'PTRNK_003');

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
(1, 'PMBP_001', 'BP_001', 400, 4600000, 'SBP_001', '300'),
(2, 'PMBP_001', 'BP_002', 300, 22350000, 'SBP_002', '300'),
(3, 'PMBP_001', 'BP_003', 200, 900000, 'SBP_001', '200'),
(4, 'PMBP_001', 'BP_004', 100, 750000, 'SBP_002', '100'),
(5, 'PMBP_001', 'BP_005', 400, 4000000, 'SBP_001', '300');

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
  `jumlah_kartu_stok` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_penjualan_ips`
--

INSERT INTO `detail_penjualan_ips` (`no`, `no_trans`, `no_produk`, `jumlah`, `harga`, `subtotal`, `no_ips`, `jumlah_kartu_stok`) VALUES
(1, 'PENJS_001', 'PR_001', 100, '8419.0488571429', 841905, 'IPS_001', '200'),
(2, 'PENJS_001', 'PR_001', 100, '8419.0488571429', 841905, 'IPS_002', '100'),
(3, 'PENJS_001', 'PR_001', 100, '8419.0488571429', 841905, 'IPS_003', '0');

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
  `cek_stok_penj` varchar(50) NOT NULL
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
  `jumlah` varchar(50) NOT NULL,
  `stok_jual` varchar(50) DEFAULT NULL,
  `jumlah_kartu_stok` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_produksi_ke1`
--

INSERT INTO `detail_produksi_ke1` (`no`, `no_trans`, `no_produk`, `bbb`, `btk`, `bop`, `jumlah`, `stok_jual`, `jumlah_kartu_stok`) VALUES
(1, 'PROD1_001', 'PR_001', '3500000', '400000', '633334', '700', '300', '0');

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
(1, 'PROD2_001', '2020-06-14', 'PR_002', '647619', '100000', '158334', '2150000', '100', '100');

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
(1, 'TP_001', 'PR_002', 100, '1'),
(2, 'TP_001', 'PR_003', 100, NULL),
(3, 'TP_001', 'PR_004', 100, NULL),
(4, 'TP_001', 'PR_006', 100, NULL);

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
(1, 'CK_001', '2020-06-14', 1112, 'd', 3500000),
(2, 'CK_001', '2020-06-14', 1111, 'k', 3500000),
(3, 'PROD1_001', '2020-06-14', 5111, 'd', 3500000),
(4, 'PROD1_001', '2020-06-14', 5112, 'd', 400000),
(5, 'PROD1_001', '2020-06-14', 5113, 'd', 633334),
(6, 'PROD1_001', '2020-06-14', 1112, 'k', 3500000),
(7, 'PROD1_001', '2020-06-14', 5311, 'k', 400000),
(8, 'PROD1_001', '2020-06-14', 5312, 'k', 633334),
(9, 'PGB_001', '2020-06-14', 1114, 'd', 2590476),
(10, 'PGB_001', '2020-06-14', 5111, 'k', 2000000),
(11, 'PGB_001', '2020-06-14', 5112, 'k', 228571),
(12, 'PGB_001', '2020-06-14', 5113, 'k', 361905),
(13, 'PGB_001', '2020-06-14', 1115, 'd', 1942858),
(14, 'PGB_001', '2020-06-14', 5111, 'k', 1500000),
(15, 'PGB_001', '2020-06-14', 5112, 'k', 171429),
(16, 'PGB_001', '2020-06-14', 5113, 'k', 271429),
(17, 'PMBP_001', '2020-06-14', 1113, 'd', 32600000),
(18, 'PMBP_001', '2020-06-14', 1111, 'k', 32600000),
(19, 'PROD2_001', '2020-06-14', 5112, 'd', 100000),
(20, 'PROD2_001', '2020-06-14', 5113, 'd', 2308334),
(21, 'PROD2_001', '2020-06-14', 5311, 'k', 100000),
(22, 'PROD2_001', '2020-06-14', 5312, 'k', 2308334),
(23, 'PROD2_001', '2020-06-14', 1115, 'd', 3055953),
(24, 'PROD2_001', '2020-06-14', 1114, 'k', 647619),
(25, 'PROD2_001', '2020-06-14', 5112, 'k', 100000),
(26, 'PROD2_001', '2020-06-14', 5113, 'k', 2308334),
(27, 'PENJS_001', '2020-06-14', 1111, 'd', 2525715),
(28, 'PENJS_001', '2020-06-14', 4111, 'k', 2525715),
(29, 'PENJS_001', '2020-06-14', 5211, 'd', 225000),
(30, 'PENJS_001', '2020-06-14', 5212, 'd', 225000),
(31, 'PENJS_001', '2020-06-14', 1111, 'k', 450000),
(32, 'PENJS_001', '2020-06-14', 6111, 'd', 1942858),
(33, 'PENJS_001', '2020-06-14', 1115, 'k', 1942858);

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
(1, 'CK_001', '2020-06-14', 'BB_001', '700', '3500000'),
(2, 'PROD1_001', '2020-06-14', 'BB_001', '0', '0');

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
(1, 'PMBP_001', '2020-06-14', 'BP_001', '400', '11500', '4600000', NULL, NULL, NULL, '400', '11500', '4600000'),
(2, 'PMBP_001', '2020-06-14', 'BP_002', '300', '74500', '22350000', NULL, NULL, NULL, '300', '74500', '22350000'),
(3, 'PMBP_001', '2020-06-14', 'BP_003', '200', '4500', '900000', NULL, NULL, NULL, '200', '4500', '900000'),
(4, 'PMBP_001', '2020-06-14', 'BP_004', '100', '7500', '750000', NULL, NULL, NULL, '100', '7500', '750000'),
(5, 'PMBP_001', '2020-06-14', 'BP_005', '400', '10000', '4000000', NULL, NULL, NULL, '400', '10000', '4000000'),
(6, 'PROD2_001', '2020-06-14', 'BP_001', NULL, NULL, NULL, '100', '11500', '1150000', '300', '11500', '3450000'),
(7, 'PROD2_001', '2020-06-14', 'BP_005', NULL, NULL, NULL, '100', '10000', '1000000', '300', '10000', '3000000');

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
(1, 'PROD2_001', '2020-06-14', 'PR_002', '100', '30559.53', '3055953', NULL, NULL, NULL, '100', '30559.53', '3055953');

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
(1, 'PGB_001', '2020-06-14', NULL, 'PR_001', '300', '1942858'),
(2, 'PENJS_001', '2020-06-14', NULL, 'PR_001', '200', '1295238.4615385'),
(3, 'PENJS_001', '2020-06-14', NULL, 'PR_001', '100', '647619.23076923'),
(4, 'PENJS_001', '2020-06-14', NULL, 'PR_001', '0', '0');

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
  `status` varchar(50) NOT NULL,
  `status_penjs` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembagian`
--

INSERT INTO `pembagian` (`no_trans`, `tgl_trans`, `no_trans_produksi1`, `status`, `status_penjs`) VALUES
('PGB_001', '2020-06-14', 'PROD1_001', '2', '1');

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

--
-- Dumping data for table `pembelian_bb`
--

INSERT INTO `pembelian_bb` (`no_trans`, `tgl_trans`, `total`, `status`) VALUES
('PMB_001', '2020-06-14', 4500000, '2');

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
('PMBP_001', '2020-06-14', 32600000, '1', 'TP_001');

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
('PENJS_001', '2020-06-14', 2525715, '1', 'PGB_001');

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
('PR_001', 'Susu Sapi', -1500, 'liter'),
('PR_002', 'Susu Murni', 1220, 'liter'),
('PR_003', 'Pasteur Coklat 180 ml', 380, 'buah'),
('PR_004', 'Pasteur Vanila 180 ml', 0, 'buah'),
('PR_005', 'Pasteur Strawberry 180 ml', 50, 'buah'),
('PR_006', 'Yoghurt Strawberry 180 ml', 50, 'buah'),
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
('PROD1_001', '2020-06-14', 'CK_001', '2');

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
('PROD2_001', '2020-06-14', 'TP_001', '0');

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
('TP_001', '2020-06-14', '2020-06-16', '3', 'PGB_001');

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
-- Indexes for table `bahan_baku`
--
ALTER TABLE `bahan_baku`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `bahan_dalam_proses`
--
ALTER TABLE `bahan_dalam_proses`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `bahan_penolong`
--
ALTER TABLE `bahan_penolong`
  ADD PRIMARY KEY (`no`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bahan_dalam_proses`
--
ALTER TABLE `bahan_dalam_proses`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bahan_penolong`
--
ALTER TABLE `bahan_penolong`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `detail_cek_kualitas`
--
ALTER TABLE `detail_cek_kualitas`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `detail_pemakaian_bb`
--
ALTER TABLE `detail_pemakaian_bb`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `detail_pemakaian_bp`
--
ALTER TABLE `detail_pemakaian_bp`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `detail_pembagian`
--
ALTER TABLE `detail_pembagian`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `detail_pembelian_bp`
--
ALTER TABLE `detail_pembelian_bp`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `detail_penjualan_ips`
--
ALTER TABLE `detail_penjualan_ips`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `detail_produksi_ke1`
--
ALTER TABLE `detail_produksi_ke1`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `detail_produksi_ke2`
--
ALTER TABLE `detail_produksi_ke2`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `detail_target_produksi`
--
ALTER TABLE `detail_target_produksi`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jurnal`
--
ALTER TABLE `jurnal`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `kartu_stok_bb`
--
ALTER TABLE `kartu_stok_bb`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kartu_stok_bp`
--
ALTER TABLE `kartu_stok_bp`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kartu_stok_penj`
--
ALTER TABLE `kartu_stok_penj`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kartu_stok_penj_ips`
--
ALTER TABLE `kartu_stok_penj_ips`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
