-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2014 at 08:24 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pramuka`
--

-- --------------------------------------------------------

--
-- Table structure for table `danggota`
--

CREATE TABLE IF NOT EXISTS `danggota` (
  `id_danggota` int(20) NOT NULL AUTO_INCREMENT,
  `tgl_keluar` date NOT NULL,
  `tgl_masuk` date NOT NULL,
  `ket_pindah` text NOT NULL,
  `id_mgudep` int(11) NOT NULL,
  `id_anggota` int(20) NOT NULL,
  PRIMARY KEY (`id_danggota`),
  KEY `id_anggota` (`id_anggota`),
  KEY `id_mgudep` (`id_mgudep`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `dasuransi`
--

CREATE TABLE IF NOT EXISTS `dasuransi` (
  `id_dasuransi` int(20) NOT NULL AUTO_INCREMENT,
  `dasuransi` varchar(30) DEFAULT NULL,
  `jenis_asuransi` varchar(30) DEFAULT NULL,
  `masa_asuransi` int(10) DEFAULT NULL,
  `kond_kesehatan` text NOT NULL,
  `id_manggota` int(20) NOT NULL,
  PRIMARY KEY (`id_dasuransi`),
  KEY `id_anggota` (`id_manggota`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `dasuransi`
--

INSERT INTO `dasuransi` (`id_dasuransi`, `dasuransi`, `jenis_asuransi`, `masa_asuransi`, `kond_kesehatan`, `id_manggota`) VALUES
(1, 'bumiputra', 'kecelakaan diri', 1, '', 1),
(2, 'asuransi AXA mandiri', 'jiwa', 12, 'sehat normal', 2);

-- --------------------------------------------------------

--
-- Table structure for table `dbina`
--

CREATE TABLE IF NOT EXISTS `dbina` (
  `id_dbina` int(20) NOT NULL AUTO_INCREMENT,
  `keahlian` varchar(50) NOT NULL,
  `thn_bina` int(10) NOT NULL,
  `thn_selesai` int(10) NOT NULL,
  `id_mgudep` int(11) NOT NULL,
  `ket_bina` text NOT NULL,
  `id_manggota` int(20) NOT NULL,
  PRIMARY KEY (`id_dbina`),
  KEY `id_anggota` (`id_manggota`),
  KEY `no_gudep` (`id_mgudep`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `djabatan`
--

CREATE TABLE IF NOT EXISTS `djabatan` (
  `id_djabatan` int(20) NOT NULL AUTO_INCREMENT,
  `nm_org` varchar(50) NOT NULL,
  `nm_jab` varchar(50) NOT NULL,
  `tgl_lantik` date NOT NULL,
  `tgl_purna` date NOT NULL,
  `ket_jab` text NOT NULL,
  `id_manggota` int(11) NOT NULL,
  PRIMARY KEY (`id_djabatan`),
  KEY `id_anggota` (`id_manggota`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `djabatan`
--

INSERT INTO `djabatan` (`id_djabatan`, `nm_org`, `nm_jab`, `tgl_lantik`, `tgl_purna`, `ket_jab`, `id_manggota`) VALUES
(1, 'pbb', 'bos juga', '1970-02-11', '1970-02-05', 'sip', 1),
(2, '9', '9', '2011-02-25', '1970-02-05', '99', 1);

-- --------------------------------------------------------

--
-- Table structure for table `dkegiatan`
--

CREATE TABLE IF NOT EXISTS `dkegiatan` (
  `id_dkegiatan` int(20) NOT NULL AUTO_INCREMENT,
  `id_mkegiatan` int(20) NOT NULL,
  `status` enum('peserta','pinkon','bindamping','cst') NOT NULL,
  `id_anggota` int(20) NOT NULL,
  PRIMARY KEY (`id_dkegiatan`),
  KEY `id_m_kegiatan` (`id_mkegiatan`),
  KEY `id_anggota` (`id_anggota`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `dkeluarga`
--

CREATE TABLE IF NOT EXISTS `dkeluarga` (
  `id_dkeluarga` int(20) NOT NULL AUTO_INCREMENT,
  `nm_ibu` varchar(50) NOT NULL,
  `nm_ayah` varchar(50) NOT NULL,
  `alamat_kel` text NOT NULL,
  `telp_kel` varchar(20) NOT NULL,
  `job_ayah` varchar(50) DEFAULT NULL,
  `id_manggota` int(20) NOT NULL,
  `job_ibu` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_dkeluarga`),
  KEY `id_anggota` (`id_manggota`),
  KEY `id_manggota` (`id_manggota`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `dkeluarga`
--

INSERT INTO `dkeluarga` (`id_dkeluarga`, `nm_ibu`, `nm_ayah`, `alamat_kel`, `telp_kel`, `job_ayah`, `id_manggota`, `job_ibu`) VALUES
(1, 'mrs seruni', 'mr paijo', 'jl kertajaya indah', '031387657', 'swasta', 1, 'ibu rumah tangga'),
(2, 'munaroh', 'marjo', 'jl sawo komplek TNI AUWO blok 89KL', '987987', 'dirut PT ok jaya', 2, 'ibu rumah tangga');

-- --------------------------------------------------------

--
-- Table structure for table `dkta`
--

CREATE TABLE IF NOT EXISTS `dkta` (
  `id_dkta` int(20) NOT NULL AUTO_INCREMENT,
  `tgl_cetak` date NOT NULL,
  `id_gudep` int(20) NOT NULL,
  `id_manggota` int(20) NOT NULL,
  `masa_berlaku` int(11) NOT NULL,
  PRIMARY KEY (`id_dkta`),
  KEY `id_gudep` (`id_gudep`),
  KEY `id_anggota` (`id_manggota`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `dpekerjaan`
--

CREATE TABLE IF NOT EXISTS `dpekerjaan` (
  `id_dpekerjaan` int(20) NOT NULL AUTO_INCREMENT,
  `nm_perusahaan` varchar(50) DEFAULT NULL,
  `bid_usaha` varchar(20) DEFAULT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  `alamat_usaha` text,
  `pendapatan` int(15) DEFAULT NULL,
  `id_manggota` int(20) NOT NULL,
  PRIMARY KEY (`id_dpekerjaan`),
  KEY `id_golongan` (`id_manggota`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `dpekerjaan`
--

INSERT INTO `dpekerjaan` (`id_dpekerjaan`, `nm_perusahaan`, `bid_usaha`, `jabatan`, `alamat_usaha`, `pendapatan`, `id_manggota`) VALUES
(1, '', '', '', '', 0, 1),
(2, 'PT antar jemput nusa jaya', 'perusahaan espedisi', 'IT manager', 'jl. raya lebar sekali 88', 10000000, 2);

-- --------------------------------------------------------

--
-- Table structure for table `drcapaikecp`
--

CREATE TABLE IF NOT EXISTS `drcapaikecp` (
  `id_dpka` int(20) NOT NULL AUTO_INCREMENT,
  `tingkat_kecakapan` varchar(30) NOT NULL,
  `no_sertifikat_keca` varchar(30) NOT NULL,
  `ket_pencapaian` text NOT NULL,
  `tgl_pencapaian` date NOT NULL,
  `id_anggota` int(20) NOT NULL,
  PRIMARY KEY (`id_dpka`),
  KEY `id_anggota` (`id_anggota`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `drkecpkhusus`
--

CREATE TABLE IF NOT EXISTS `drkecpkhusus` (
  `id_drkecpkhusus` int(20) NOT NULL AUTO_INCREMENT,
  `id_mkecpkhusus` int(20) NOT NULL,
  `id_manggota` int(20) NOT NULL,
  `no_sertifikat` varchar(30) NOT NULL,
  `level` enum('purwa','madya','utama') NOT NULL,
  `tgl` date NOT NULL,
  `ketergn` text NOT NULL,
  PRIMARY KEY (`id_drkecpkhusus`),
  KEY `id_m_kecp_kusus` (`id_mkecpkhusus`,`id_manggota`),
  KEY `id_m_kecp_kusus_2` (`id_mkecpkhusus`,`id_manggota`),
  KEY `id_m_anggota` (`id_manggota`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `drkecpkhusus`
--

INSERT INTO `drkecpkhusus` (`id_drkecpkhusus`, `id_mkecpkhusus`, `id_manggota`, `no_sertifikat`, `level`, `tgl`, `ketergn`) VALUES
(1, 4, 1, 'sc55555', 'purwa', '2011-02-05', 'ok bgt');

-- --------------------------------------------------------

--
-- Table structure for table `drkecpumum`
--

CREATE TABLE IF NOT EXISTS `drkecpumum` (
  `id_drkecpumum` int(20) NOT NULL AUTO_INCREMENT,
  `id_manggota` int(20) NOT NULL,
  `id_msubgolongan` int(20) NOT NULL,
  `tgl_pencapaian` date NOT NULL,
  `no_sertifikat` varchar(30) NOT NULL,
  `ketergn` text NOT NULL,
  PRIMARY KEY (`id_drkecpumum`),
  KEY `id_anggota` (`id_manggota`,`id_msubgolongan`),
  KEY `id_sub_gol` (`id_msubgolongan`),
  KEY `id_anggota_2` (`id_manggota`),
  KEY `id_anggota_3` (`id_manggota`),
  KEY `id_sub_gol_2` (`id_msubgolongan`),
  KEY `id_anggota_4` (`id_manggota`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `drkecpumum`
--

INSERT INTO `drkecpumum` (`id_drkecpumum`, `id_manggota`, `id_msubgolongan`, `tgl_pencapaian`, `no_sertifikat`, `ketergn`) VALUES
(13, 1, 10, '2012-05-15', '99', 'nnn'),
(14, 1, 9, '2013-02-21', '88', 'baik sekali ');

-- --------------------------------------------------------

--
-- Table structure for table `drkegnonpram`
--

CREATE TABLE IF NOT EXISTS `drkegnonpram` (
  `id_drkegnonpram` int(11) NOT NULL AUTO_INCREMENT,
  `drkegnonpram` varchar(50) NOT NULL,
  `tgl` date NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `tingkat` enum('nasional','daerah','cabang','ranting','gudep') NOT NULL,
  `stus` enum('Peserta','Pemateri','Peninjau','Panitia') NOT NULL,
  `plenggara` varchar(50) NOT NULL,
  `ket` text NOT NULL,
  `id_manggota` int(11) NOT NULL,
  PRIMARY KEY (`id_drkegnonpram`),
  KEY `id_mangggota` (`id_manggota`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `drkegnonpram`
--

INSERT INTO `drkegnonpram` (`id_drkegnonpram`, `drkegnonpram`, `tgl`, `lokasi`, `tingkat`, `stus`, `plenggara`, `ket`, `id_manggota`) VALUES
(1, 'seminar android ', '2011-02-17', 'HI tech mall surabaya ', 'cabang', 'Pemateri', 'KLAS Komunitas LInux dan Android Surabaya ', 'oke', 2),
(2, 'seminar kesehatan ', '2011-02-18', 'unesa', 'nasional', 'Peninjau', 'unair fk', 'ok bgt', 1),
(4, 'ok67', '1970-02-01', '7', 'nasional', 'Panitia', '8888', '909', 1);

-- --------------------------------------------------------

--
-- Table structure for table `drkegpram`
--

CREATE TABLE IF NOT EXISTS `drkegpram` (
  `id_drkegpram` int(11) NOT NULL AUTO_INCREMENT,
  `drkegpram` varchar(100) NOT NULL,
  `tgl` date NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `tingkat` enum('Nasional','Daerah','Cabang','Ranting','Gudep') NOT NULL,
  `id_mgolongan` int(11) NOT NULL,
  `kategori` enum('Lomba','Pesta','Seminar','Petualangan','Latihan','Bakti') NOT NULL,
  `status` enum('Peserta','Pemateri','Peninjau','Panitia') NOT NULL,
  `ket` text NOT NULL,
  `id_manggota` int(11) NOT NULL,
  PRIMARY KEY (`id_drkegpram`),
  KEY `id_manggota` (`id_manggota`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `drkegpram`
--

INSERT INTO `drkegpram` (`id_drkegpram`, `drkegpram`, `tgl`, `lokasi`, `tingkat`, `id_mgolongan`, `kategori`, `status`, `ket`, `id_manggota`) VALUES
(1, 'raimuna 2011', '2011-01-28', 'cuban rondo, malang', 'Cabang', 2, 'Seminar', 'Pemateri', 'sehat wal afiat', 1),
(2, 'jambore nasional 2012', '2012-02-11', 'cibodas , jawa barat', 'Nasional', 4, 'Petualangan', 'Peserta', 'lancar jaya', 1),
(3, 'ok', '1970-02-10', 'ji', 'Nasional', 1, 'Lomba', 'Peserta', '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `drnaiktingkat`
--

CREATE TABLE IF NOT EXISTS `drnaiktingkat` (
  `id_rnaiktingkat` int(20) NOT NULL AUTO_INCREMENT,
  `id_anggota` int(20) NOT NULL,
  `no_sertifikat` varchar(30) NOT NULL,
  `tgl` date NOT NULL,
  `ket` text NOT NULL,
  `id_subgolongan` int(20) NOT NULL,
  PRIMARY KEY (`id_rnaiktingkat`),
  KEY `id_sub_gol` (`id_subgolongan`),
  KEY `id` (`id_anggota`),
  KEY `id_sub_gol_2` (`id_subgolongan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `drpendf`
--

CREATE TABLE IF NOT EXISTS `drpendf` (
  `id_drpendf` int(20) NOT NULL AUTO_INCREMENT,
  `pendidikan` enum('SD','SMP','SMA','D1','D2','D3','S1','S2','S3') NOT NULL,
  `nm_instansi` varchar(50) NOT NULL,
  `no_ijazah` varchar(30) NOT NULL,
  `thn_masuk` int(11) NOT NULL,
  `thn_lulus` int(11) NOT NULL,
  `kelas` varchar(20) NOT NULL,
  `id_manggota` int(20) NOT NULL,
  `id_malamat` int(20) NOT NULL,
  `id_dsubpendf` int(20) DEFAULT NULL,
  `no_induk` varchar(255) NOT NULL,
  PRIMARY KEY (`id_drpendf`),
  UNIQUE KEY `id_dsub_r_pend_f` (`id_dsubpendf`),
  KEY `id_anggota` (`id_manggota`,`id_malamat`,`id_dsubpendf`),
  KEY `id_alamat` (`id_malamat`),
  KEY `id_m_sub_r_pend_f` (`id_dsubpendf`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `drpendf`
--

INSERT INTO `drpendf` (`id_drpendf`, `pendidikan`, `nm_instansi`, `no_ijazah`, `thn_masuk`, `thn_lulus`, `kelas`, `id_manggota`, `id_malamat`, `id_dsubpendf`, `no_induk`) VALUES
(2, 'SD', 'SDN tanah kali kedinding V no 579', 'n99999', 1997, 2003, '', 1, 371, NULL, '279'),
(3, 'SMP', 'SMPN 15 SBY', 'SNO3430920', 2003, 2006, '', 1, 372, NULL, '1449');

-- --------------------------------------------------------

--
-- Table structure for table `drpendi`
--

CREATE TABLE IF NOT EXISTS `drpendi` (
  `id_drpendi` int(20) NOT NULL AUTO_INCREMENT,
  `nm_kursus` varchar(30) NOT NULL,
  `no_sertifikat` varchar(11) NOT NULL,
  `nm_lembaga` varchar(50) NOT NULL,
  `alamat_pendi` text NOT NULL,
  `thn_kursus` int(4) NOT NULL,
  `id_manggota` int(20) NOT NULL,
  PRIMARY KEY (`id_drpendi`),
  KEY `id_anggota` (`id_manggota`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `drpendi`
--

INSERT INTO `drpendi` (`id_drpendi`, `nm_kursus`, `no_sertifikat`, `nm_lembaga`, `alamat_pendi`, `thn_kursus`, `id_manggota`) VALUES
(1, 'pelatihan desain grafis', 'BLK0009', 'dinas tenaga kerja surabaya & SCOMPTEC', 'jl kayoon no 99', 2011, 1),
(2, 'kursus service HP', 'xxx9', 'Tga Jaya Cell', 'jl kembang kuning 99 surabaya', 2011, 1);

-- --------------------------------------------------------

--
-- Table structure for table `drprestasi`
--

CREATE TABLE IF NOT EXISTS `drprestasi` (
  `id_drprestasi` int(20) NOT NULL AUTO_INCREMENT,
  `nm_prestasi` varchar(50) NOT NULL,
  `tingkat` varchar(30) NOT NULL,
  `thn` int(4) NOT NULL,
  `no_sertifikat` varchar(30) NOT NULL,
  `ket` text NOT NULL,
  `id_manggota` int(20) NOT NULL,
  PRIMARY KEY (`id_drprestasi`),
  KEY `id_anggota` (`id_manggota`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `drprestasi`
--

INSERT INTO `drprestasi` (`id_drprestasi`, `nm_prestasi`, `tingkat`, `thn`, `no_sertifikat`, `ket`, `id_manggota`) VALUES
(1, 'lomba mrnuliS', 'dewa', 2012, 'st67867', 'ok bgt', 1);

-- --------------------------------------------------------

--
-- Table structure for table `dsosmed`
--

CREATE TABLE IF NOT EXISTS `dsosmed` (
  `id_dsosmed` int(20) NOT NULL AUTO_INCREMENT,
  `ym` varchar(25) DEFAULT NULL,
  `gt` varchar(25) DEFAULT NULL,
  `msn` varchar(25) DEFAULT NULL,
  `skype` varchar(25) DEFAULT NULL,
  `mirc` varchar(25) DEFAULT NULL,
  `twitter` varchar(25) DEFAULT NULL,
  `fb` varchar(25) DEFAULT NULL,
  `id_manggota` int(20) NOT NULL,
  `callsing_orari` varchar(10) NOT NULL,
  PRIMARY KEY (`id_dsosmed`),
  KEY `id_anggota` (`id_manggota`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `dsosmed`
--

INSERT INTO `dsosmed` (`id_dsosmed`, `ym`, `gt`, `msn`, `skype`, `mirc`, `twitter`, `fb`, `id_manggota`, `callsing_orari`) VALUES
(1, '', '', '', '', '', '', 'www.facebook.com/epi', 1, ''),
(2, 'ym_sol', 'solsol', '', '', '', '', '', 2, '');

-- --------------------------------------------------------

--
-- Table structure for table `dsubpendf`
--

CREATE TABLE IF NOT EXISTS `dsubpendf` (
  `id_dsubpendf` int(20) NOT NULL AUTO_INCREMENT,
  `fakultas` varchar(30) NOT NULL,
  `jurusan` varchar(30) NOT NULL,
  PRIMARY KEY (`id_dsubpendf`),
  UNIQUE KEY `jurusan` (`jurusan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `dsubpendf`
--

INSERT INTO `dsubpendf` (`id_dsubpendf`, `fakultas`, `jurusan`) VALUES
(1, 'teknik', 'elektro'),
(2, 'teknik ', 'mesin');

-- --------------------------------------------------------

--
-- Table structure for table `malamat`
--

CREATE TABLE IF NOT EXISTS `malamat` (
  `id_malamat` int(20) NOT NULL AUTO_INCREMENT,
  `pre_malamat` varchar(50) DEFAULT NULL,
  `malamat` text NOT NULL,
  `id_mkec` int(11) NOT NULL,
  `kode_pos` varchar(7) NOT NULL,
  `web` varchar(20) DEFAULT NULL,
  `hp` varchar(20) DEFAULT NULL,
  `telp_1` varchar(20) DEFAULT NULL,
  `telp_2` varchar(20) DEFAULT NULL,
  `telp_3` varchar(20) DEFAULT NULL,
  `fax` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_malamat`),
  KEY `id_mkota` (`id_mkec`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=402 ;

--
-- Dumping data for table `malamat`
--

INSERT INTO `malamat` (`id_malamat`, `pre_malamat`, `malamat`, `id_mkec`, `kode_pos`, `web`, `hp`, `telp_1`, `telp_2`, `telp_3`, `fax`) VALUES
(1, 'Gedung Kwarda Jatim', 'Jalan Kertajaya Indah 77 A', 4, '60273', 'www.kwardajatim.com', NULL, '031777777', '031812232', NULL, '0137287238'),
(142, 'kantor kwaran onokromo', 'jlm wonorkomo 99', 1, '608592', 'www.wonokromo.com', '99', '0891892', '', '', ''),
(143, 'gedung kwarcab', 'jl. kwarcab malang 99', 3, '62387', 'www.malang.com', NULL, '03418989', '', '', ''),
(144, '88', 'gedung jl .wonokromo 89', 8, '274892', '3', NULL, '9', '99', '999', '9999'),
(145, 'ge', 'jl.  jala aja', 7, '989', '78', NULL, '789', '798', '7', ''),
(146, 'gedng8', '8', 4, '8', '8', NULL, '8', '8', '8', ''),
(147, '77', '7', 6, '7', '7', NULL, '7', '77', '', ''),
(148, '8', '8', 3, '8', '8', NULL, '8', '8', '', ''),
(149, '8', '8', 1, '8', '8', NULL, '8', '8', '88', '9'),
(151, '5', '5', 1, '5', '5', NULL, '', '5', '55', '5'),
(152, '5', '5', 1, '5', '5', NULL, '', '5', '55', '5'),
(153, '5', '5', 1, '5', '5', NULL, '', '5', '55', '5'),
(154, '8', '8', 1, '8', '8', NULL, '8', '8', '8', '8'),
(155, 'kantor gudep unair', 'jlan mulyorejo no 99', 8, '2847', 'www', NULL, '27938742', '8', '8', '8'),
(156, '1', '1', 1, '1', '1', NULL, '1', '1', '', ''),
(157, '8', '8', 4, '8', '8', NULL, '8', '8', '8', '8'),
(158, '77', '77', 3, '7', '', NULL, '', '', '', ''),
(159, '77', '77', 3, '7', '7', NULL, '7', '7', '7', '7'),
(160, '77', '77', 3, '7', '7', NULL, '7', '7', '7', '7'),
(161, '77', '77', 3, '7', '7', NULL, '7', '7', '7', '7'),
(162, '77', '77', 3, '7', '7', NULL, '7', '7', '7', '7'),
(163, '77', '77', 3, '7', '7', NULL, '7', '7', '7', '7'),
(164, '77', '77', 3, '7', '7', NULL, '7', '7', '7', '7'),
(165, '77', '77', 3, '7', '7', NULL, '7', '7', '7', '7'),
(166, '77', '77', 3, '7', '7', NULL, '7', '7', '7', '7'),
(167, '77', '77', 3, '7', '7', NULL, '7', '7', '7', '7'),
(168, '77', '77', 3, '7', '7', NULL, '7', '7', '7', '7'),
(169, '8', '9', 3, '11', '22', NULL, '33', '44', '55', '66'),
(170, '8', '9', 3, '11', '22', NULL, '33', '44', '55', '66'),
(171, '99', '99', 1, '999', '99', NULL, '99', '999', '99', '99'),
(172, '99', '99', 1, '999', '99', NULL, '99', '999', '99', '99'),
(173, '99', '99', 1, '999', '99', NULL, '99', '999', '99', '99'),
(174, '99', '99', 1, '999', '99', NULL, '99', '999', '99', '99'),
(175, '8', '8', 3, '8', '8', NULL, '8', '', '', ''),
(176, '8', '8', 3, '8', '8', NULL, '8', '', '', ''),
(177, '8', '8', 3, '8', '8', NULL, '8', '66', '66', '666'),
(178, '7', '7', 3, '7', '7', NULL, '7', '7', '7', '7'),
(179, '7', '7', 3, '7', '7', NULL, '7', '7', '7', '7'),
(180, '8', '8', 7, '8', '8', NULL, '8', '8', '8', '8'),
(181, '8', '8', 4, '8', '8', NULL, '8', '8', '8', '8'),
(182, '8', '8', 4, '8', '8', NULL, '8', '8', '8', '8'),
(183, '8', '8', 4, '8', '8', NULL, '8', '8', '8', '8'),
(184, '8', '8', 4, '8', '8', NULL, '8', '8', '8', '8'),
(185, '8', '8', 4, '8', '8', NULL, '8', '8', '8', '8'),
(186, '6', '66', 1, '6', '6', NULL, '6', '6', '6', '6'),
(187, '88', '88', 7, '88', '88', NULL, '88', '88', '88', '88'),
(188, '88', '88', 7, '88', '88', NULL, '88', '88', '88', '88'),
(189, '88', '88', 7, '88', '88', NULL, '88', '88', '88', '88'),
(190, 'kantor gudep kampus c unair', 'jl mulyorejo', 8, '692389', 'www.unair.com', NULL, '789', '987', '987', '9879'),
(191, '44', '44', 7, '44', '44', NULL, '44', '44', '44', '44'),
(192, '89', '89', 6, '89', '89', NULL, '898', '98', '', ''),
(193, '', 'estgeswahgs', 1, '', NULL, NULL, NULL, NULL, NULL, NULL),
(194, '', 'sdrfhs', 1, '', NULL, NULL, NULL, NULL, NULL, NULL),
(195, '', '99', 8, '', NULL, NULL, NULL, NULL, NULL, NULL),
(196, '9', 'kkk', 4, '', NULL, NULL, NULL, NULL, NULL, NULL),
(197, '9', 'kkk', 4, '', NULL, NULL, NULL, NULL, NULL, NULL),
(198, '9', 'kkk', 4, '', NULL, NULL, NULL, NULL, NULL, NULL),
(199, '9', 'kkk', 4, '', NULL, NULL, NULL, NULL, NULL, NULL),
(200, '9', 'kkk', 4, '', NULL, NULL, NULL, NULL, NULL, NULL),
(201, '9', 'kkk', 4, '', NULL, NULL, NULL, NULL, NULL, NULL),
(202, '9', 'kkk', 4, '', NULL, NULL, NULL, NULL, NULL, NULL),
(203, '9', 'kkk', 4, '', NULL, NULL, NULL, NULL, NULL, NULL),
(204, '9', 'kkk', 4, '', NULL, NULL, NULL, NULL, NULL, NULL),
(205, '9', 'kkk', 4, '', NULL, NULL, NULL, NULL, NULL, NULL),
(206, '9', 'kkk', 4, '', NULL, NULL, NULL, NULL, NULL, NULL),
(207, '9', 'kkk', 4, '', NULL, NULL, NULL, NULL, NULL, NULL),
(208, '9', 'kkk', 4, '', NULL, NULL, NULL, NULL, NULL, NULL),
(209, '9', 'kkk', 4, '', NULL, NULL, NULL, NULL, NULL, NULL),
(210, '9', 'kkk', 4, '', NULL, NULL, NULL, NULL, NULL, NULL),
(211, 'kantor ', 'jl kwarda jatim asik n 99', 5, '', NULL, NULL, NULL, NULL, NULL, NULL),
(212, 'kantor ', 'jl kwarda jatim asik n 99', 5, '', NULL, NULL, NULL, NULL, NULL, NULL),
(213, 'kantor ', 'jl kwarda jatim asik n 99', 5, '', NULL, NULL, NULL, NULL, NULL, NULL),
(214, 'kantor ', 'jl kwarda jatim asik n 99', 5, '', NULL, NULL, NULL, NULL, NULL, NULL),
(215, 'kantor ', 'jl kwarda jatim asik n 99', 5, '', NULL, NULL, NULL, NULL, NULL, NULL),
(216, 'kantor ', 'jl kwarda jatim asik n 99', 5, '', NULL, NULL, NULL, NULL, NULL, NULL),
(217, 'kantor ', 'jl kwarda jatim asik n 99', 5, '', NULL, NULL, NULL, NULL, NULL, NULL),
(218, 'kantor ', 'jl kwarda jatim asik n 99', 5, '', NULL, NULL, NULL, NULL, NULL, NULL),
(219, 'ji', 'j', 1, '', NULL, NULL, NULL, NULL, NULL, NULL),
(220, 'kantor ', 'jl kwarda jatim asik n 99', 5, '', NULL, NULL, NULL, NULL, NULL, NULL),
(221, '', 'jl angreek bualn 34', 3, '', NULL, NULL, NULL, NULL, NULL, NULL),
(222, '', 'jl angreek bualn 34', 3, '', NULL, NULL, NULL, NULL, NULL, NULL),
(223, '', 'jl angreek bualn 34', 3, '', NULL, NULL, NULL, NULL, NULL, NULL),
(224, '', 'jl angreek bualn 34', 3, '', NULL, NULL, NULL, NULL, NULL, NULL),
(225, '', 'jl angreek bualn 34', 3, '', NULL, NULL, NULL, NULL, NULL, NULL),
(226, '', 'jl angreek bualn 34', 3, '', NULL, NULL, NULL, NULL, NULL, NULL),
(227, '', 'jl angreek bualn 34', 3, '', NULL, NULL, NULL, NULL, NULL, NULL),
(228, '', 'jl angreek bualn 34', 3, '', NULL, NULL, NULL, NULL, NULL, NULL),
(229, '', 'jl angreek bualn 34', 3, '', NULL, NULL, NULL, NULL, NULL, NULL),
(230, '', 'jl angreek bualn 34', 3, '', NULL, NULL, NULL, NULL, NULL, NULL),
(231, 'gedung nya ', 'jalananya ', 3, '', NULL, NULL, NULL, NULL, NULL, NULL),
(232, '', 'jl angreek bualn 34', 3, '', NULL, NULL, NULL, NULL, NULL, NULL),
(233, 'gedung ', 'jalannya', 7, '', NULL, NULL, NULL, NULL, NULL, NULL),
(234, 'gedung ', 'jalannya', 7, '', NULL, NULL, NULL, NULL, NULL, NULL),
(235, 'gedung ', 'jalannya', 7, '', NULL, NULL, NULL, NULL, NULL, NULL),
(236, 'gedung ', 'jalannya', 7, '', NULL, NULL, NULL, NULL, NULL, NULL),
(237, 'gedung ', 'jalannya', 7, '', NULL, NULL, NULL, NULL, NULL, NULL),
(238, 'gedung ', 'jalannya', 7, '', NULL, NULL, NULL, NULL, NULL, NULL),
(239, 'gedung ', 'jalannya', 7, '', NULL, NULL, NULL, NULL, NULL, NULL),
(240, 'gedung ', 'jalannya', 7, '', NULL, NULL, NULL, NULL, NULL, NULL),
(241, 'gedung ', 'jalannya', 7, '', NULL, NULL, NULL, NULL, NULL, NULL),
(242, 'gedung ', 'jalannya', 7, '', NULL, NULL, NULL, NULL, NULL, NULL),
(243, 'gedung ', 'jalannya', 7, '', NULL, NULL, NULL, NULL, NULL, NULL),
(244, 'gedung ', 'jalannya', 7, '', NULL, NULL, NULL, NULL, NULL, NULL),
(245, '66', '66', 3, '', NULL, NULL, NULL, NULL, NULL, NULL),
(246, '66', '66', 3, '', NULL, NULL, NULL, NULL, NULL, NULL),
(247, '7', '7', 5, '', NULL, NULL, NULL, NULL, NULL, NULL),
(248, '7', '7', 5, '', NULL, NULL, NULL, NULL, NULL, NULL),
(249, '7', '7', 5, '', NULL, NULL, NULL, NULL, NULL, NULL),
(250, '7', '7', 5, '', NULL, NULL, NULL, NULL, NULL, NULL),
(251, '8', '8', 4, '', NULL, NULL, NULL, NULL, NULL, NULL),
(252, '8', '8', 4, '', NULL, NULL, NULL, NULL, NULL, NULL),
(253, '', 'jl. anggrek gg 3', 6, '', NULL, NULL, NULL, NULL, NULL, NULL),
(254, '', 'jl. anggrek gg 3', 6, '', NULL, NULL, NULL, NULL, NULL, NULL),
(255, '', '', 1, '', '', '', '', '', '', ''),
(256, NULL, '', 1, '', '', '', '', '', '', ''),
(257, NULL, '', 1, '', '', '', '', '', '', ''),
(258, NULL, '', 1, '', '', '', '', '', '', ''),
(259, NULL, '', 1, '', '', '', '', '', '', ''),
(260, NULL, '', 1, '', '', '', '', '', '', ''),
(261, NULL, '', 1, '', '', '', '', '', '', ''),
(262, NULL, '77', 1, '', '333', '77', '', '', '', ''),
(263, NULL, '8', 5, '', '9', '6', '', '', '', ''),
(264, NULL, '2', 5, '2', '6', '2', '', '', '', ''),
(265, NULL, '2', 5, '2', '6', '2', '', '', '', ''),
(266, NULL, '2', 5, '2', '6', '2', NULL, NULL, NULL, ''),
(267, NULL, '7', 5, '8', '8', '88', NULL, NULL, NULL, NULL),
(290, '5', '5', 1, '5', '5', NULL, '', '5', '55', '5'),
(291, NULL, '6', 5, '4', '4', '4', NULL, NULL, NULL, NULL),
(292, NULL, '6', 5, '4', '4', '4', NULL, NULL, NULL, NULL),
(293, NULL, '6', 5, '4', '4', '4', NULL, NULL, NULL, NULL),
(294, NULL, '6', 5, '4', '4', '4', NULL, NULL, NULL, NULL),
(295, NULL, '6', 5, '4', '4', '4', NULL, NULL, NULL, NULL),
(296, NULL, '6', 5, '4', '4', '4', NULL, NULL, NULL, NULL),
(297, NULL, '6', 5, '4', '4', '4', NULL, NULL, NULL, NULL),
(298, NULL, '6', 5, '4', '4', '4', NULL, NULL, NULL, NULL),
(299, 'jl. mojo ', 'kertajaya', 4, '', NULL, NULL, NULL, NULL, NULL, NULL),
(300, 'jl. mojo ', 'kertajaya', 4, '', NULL, NULL, NULL, NULL, NULL, NULL),
(301, 'jl. mojo ', 'kertajaya', 4, '', NULL, NULL, NULL, NULL, NULL, NULL),
(302, 'jl. mojo ', 'kertajaya', 4, '', NULL, NULL, NULL, NULL, NULL, NULL),
(303, 'ada', 'adad', 4, '', NULL, NULL, NULL, NULL, NULL, NULL),
(304, 'ada', 'adad', 4, '', NULL, NULL, NULL, NULL, NULL, NULL),
(305, 'wonokromo', 'surabaya', 1, '', NULL, NULL, NULL, NULL, NULL, NULL),
(306, 'wonokromo', 'surabaya', 1, '', NULL, NULL, NULL, NULL, NULL, NULL),
(307, 'kertajaya', 'surabaya', 7, '', NULL, NULL, NULL, NULL, NULL, NULL),
(308, 'kertajaya', 'surabaya', 7, '', NULL, NULL, NULL, NULL, NULL, NULL),
(309, NULL, '8', 5, '787', '3', '9', NULL, NULL, NULL, NULL),
(311, 'gedung kwartir cabang pacitan', 'jl pacitan', 9, '123', 'pacitanpramuka.com', NULL, '0312345', '', '', '3214567'),
(312, 'gedung kwartir cabang pacitan', 'jl pacitan', 9, '123', 'pacitanpramuka.com', NULL, '0312345', '2931', '13131', '3214567'),
(313, 'gedung kwartir cabang pacitan', 'jl pacitan', 9, '123', 'pacitanpramuka.com', NULL, '0312345', '2931', '13131', '3214567'),
(314, 'kampus unesa', 'jl ketintang', 1, '2312', 'pramukaunesa.com', NULL, '123', '1233', '1313', '131313'),
(315, 'kantor', 'ok', 7, '', NULL, NULL, NULL, NULL, NULL, NULL),
(316, 'kantor', 'ok', 7, '', NULL, NULL, NULL, NULL, NULL, NULL),
(317, 'kantor', 'ok', 7, '', NULL, NULL, NULL, NULL, NULL, NULL),
(318, 'kantor', 'ok', 7, '', NULL, NULL, NULL, NULL, NULL, NULL),
(319, 'kantor', 'ok', 7, '', NULL, NULL, NULL, NULL, NULL, NULL),
(320, 'kantor', 'ok', 7, '', NULL, NULL, NULL, NULL, NULL, NULL),
(321, 'kantor', 'ok', 7, '', NULL, NULL, NULL, NULL, NULL, NULL),
(322, 'kantor', 'ok', 7, '', NULL, NULL, NULL, NULL, NULL, NULL),
(323, 'kantor', 'ok', 7, '', NULL, NULL, NULL, NULL, NULL, NULL),
(324, 'kantor', 'ok', 7, '', NULL, NULL, NULL, NULL, NULL, NULL),
(325, 'kantor', 'ok', 7, '', NULL, NULL, NULL, NULL, NULL, NULL),
(326, 'kantor', 'ok', 7, '', NULL, NULL, NULL, NULL, NULL, NULL),
(327, 'kantor', 'ok', 7, '', NULL, NULL, NULL, NULL, NULL, NULL),
(328, 'kantor', 'ok', 7, '', NULL, NULL, NULL, NULL, NULL, NULL),
(329, 'kantor', 'ok', 7, '', NULL, NULL, NULL, NULL, NULL, NULL),
(330, 'kantor', 'ok', 7, '', NULL, NULL, NULL, NULL, NULL, NULL),
(331, NULL, 'jl kertajaya indah', 7, '60273', 'www.epi.com', '085655009393', NULL, NULL, NULL, NULL),
(332, 'kantor kwaran onokromo', 'jlm wonorkomo 99', 1, '608592', 'ww.wonokromo.com', NULL, '0891892', '', '', ''),
(333, 'kantor kwaran onokromo', 'jlm wonorkomo 99', 1, '608592', 'ww.wonokromo.com', NULL, '0891892', '', '', ''),
(334, 'KANTOR KWARAN', 'JL MULYOREKOJ 88', 8, '789787', 'WWW.MULYOREJO.COM', NULL, '8098098908', '', '', ''),
(335, 'kantor kwaran', 'jl jambangan utara 77', 4, '782938', 'www.jambagan.com', NULL, '031727777', '', '', ''),
(336, 'kantor kwaran', 'jl. gubeng kertajaya 88', 6, '734989', 'www.gubeng.com', NULL, '03189829389', '', '', ''),
(337, 'kantor klojen', 'jl klojen utara jaya 889', 3, '7385478', 'www.klojen.com', NULL, '031798798', '', '', ''),
(338, 'kantor kwaran', 'jl. rungkut asri 669', 15, '73465', 'www.rungkut-asri.com', NULL, '03198203984', '', '', ''),
(339, 'kantor kwaran', 'jl. sawahan 809', 16, '743984', '', NULL, '', '', '', ''),
(340, 'kantor kwarcab', 'jl jkebenaran no 99', 17, '67777', 'www.lamongan.com', NULL, '06273677637', '', '', ''),
(341, 'kantor kwarcab', 'jl jkebenaran no 99', 17, '67777', 'www.lamongan.com', NULL, '06273677637', '', '', ''),
(342, 'kantor kwarcab', 'jl jkebenaran no 99', 17, '67777', 'www.lamongan.com', NULL, '06273677637', '', '', ''),
(343, 'kantor kwartir cabang tulungagung', 'jl. ki mangun sarkoro beji', 18, '56765', 'www.tulungagungscout', NULL, '0355324673', '', '', '0355324673'),
(344, 'kantor kecamatan', 'jl. angrel bulan no 77', 7, '5068768', '', NULL, '', '', '', ''),
(345, 'kampus C unair', 'jl mulyorejo no 100', 8, '2783', 'www.gudep-unair.com', NULL, '809809', '', '', ''),
(346, 'kampus C unair', 'jl mulyorejo no 100', 8, '2783', 'www.gudep-unair.com', NULL, '809809', '', '', ''),
(347, 'kampus UPN', 'jl rungkut pucuk sekali', 15, '2737', 'www.rungkut.com', NULL, '', '', '', ''),
(348, 'kampus UPN', 'jl rungkut pucuk sekali', 15, '2737', 'www.rungkut.com', NULL, '', '', '', ''),
(349, 'kampus UPN', 'jl rungkut pucuk sekali', 15, '2737', 'www.rungkut.com', NULL, '', '', '', ''),
(350, 'kantor gudep unesa', 'jl katintang madya 20', 1, '2009898', '', NULL, '', '', '', ''),
(351, NULL, 'jl kertajaya indah', 8, '63940', 'www.epi.com', '085655009393', NULL, NULL, NULL, NULL),
(352, NULL, 'jl. ekstrak kulit manggis 99', 13, '990', 'solsol', '08565500266', NULL, NULL, NULL, NULL),
(353, '', 'kedinding lor gg arbei 99', 7, '', NULL, NULL, NULL, NULL, NULL, NULL),
(354, '', 'kedinding lor gg arbei 99', 7, '', NULL, NULL, NULL, NULL, NULL, NULL),
(355, '', 'kedinding lor gg arbei 99', 7, '', NULL, NULL, NULL, NULL, NULL, NULL),
(356, '', 'kedinding lor gg arbei 99', 7, '', NULL, NULL, NULL, NULL, NULL, NULL),
(357, '', 'kedinding lor gg arbei 99', 7, '', NULL, NULL, NULL, NULL, NULL, NULL),
(358, '', 'kedinding lor gg arbei 99', 7, '', NULL, NULL, NULL, NULL, NULL, NULL),
(359, '', 'kedinding lor gg arbei 99', 7, '', NULL, NULL, NULL, NULL, NULL, NULL),
(360, '', 'kedinding lor gg arbei 99', 7, '', NULL, NULL, NULL, NULL, NULL, NULL),
(361, '', 'kedinding lor gg arbei 99', 7, '', NULL, NULL, NULL, NULL, NULL, NULL),
(362, '', 'kedinding lor gg arbei 99', 7, '', NULL, NULL, NULL, NULL, NULL, NULL),
(363, '', 'kedinding lor gg arbei 99', 7, '', NULL, NULL, NULL, NULL, NULL, NULL),
(364, '', 'kedinding lor gg arbei 99', 7, '', NULL, NULL, NULL, NULL, NULL, NULL),
(365, '', 'kedinding lor gg arbei 99', 7, '', NULL, NULL, NULL, NULL, NULL, NULL),
(366, '', 'kedinding lor gg arbei 99', 7, '', NULL, NULL, NULL, NULL, NULL, NULL),
(367, '', 'kedinding lor gg arbei 99', 7, '', NULL, NULL, NULL, NULL, NULL, NULL),
(368, '', 'kedinding lor gg arbei 99', 7, '', NULL, NULL, NULL, NULL, NULL, NULL),
(369, '', 'kedinding lor gg arbei 99', 7, '', NULL, NULL, NULL, NULL, NULL, NULL),
(370, '', 'kedinding lor gg arbei 99', 7, '', NULL, NULL, NULL, NULL, NULL, NULL),
(371, '', 'kedinding lor gg arbei 99', 7, '', NULL, NULL, NULL, NULL, NULL, NULL),
(372, '', 'kedinding lor gg arbei 99', 4, '', NULL, NULL, NULL, NULL, NULL, NULL),
(373, NULL, 'bandil', 1, '66666', '', '098765', NULL, NULL, NULL, NULL),
(374, 'jl malang', 'jl malang', 10, '6789', '', NULL, '0321', '', '', ''),
(375, 'gedung pramuka', 'jl kota tua', 9, '6666', 'www.bwi.com', NULL, '0312455', '', '', ''),
(376, 'smun23sby', 'menganti babadan', 16, '66666', '', NULL, '', '', '', ''),
(377, 'smna7surabaya', 'ngaglik 27-29', 7, '66666', '', NULL, '', '', '', ''),
(378, 'sman6surabaya', 'gubernur suryo 11', 7, '66666', '', NULL, '', '', '', ''),
(379, 'smkn5sby', 'dharmahusada 167', 6, '9999', '', NULL, '', '', '', ''),
(380, 'gedung gudep tes', 'jl tes', 4, '8909809', 'www.www.ww', NULL, '', '', '', ''),
(381, 'smkn10sby', 'keputih tegal', 4, '9898', '', NULL, '', '', '', ''),
(382, 'smean1', 'jl. smea 1', 1, '6665', '', NULL, '', '', '', ''),
(383, 'manbwi', 'jl. ikan tengiri 2 solo', 9, '68416', '', NULL, '0333424610', '', '', ''),
(384, 'sman1glagah', 'jl. melati no 3', 13, '68432', 'www.sman1glagah.sch.', NULL, '0333421357', '', '', '0333421357'),
(385, 'sman1rogojampi', 'jl. ali sakti no 2', 5, '68462', '', NULL, '0333634313', '', '', ''),
(386, 'sman1genteng', 'jl. kh wahit hasim 20 maron', 14, '68465', 'www.sman1genteng.sch', NULL, '0333845134', '', '', '0333845134'),
(387, 'sman2genteng', 'jl. pandan - kembiritan', 14, '68465', 'www.sman2genteng.org', NULL, '0333845821', '', '', '0333845821'),
(388, 'uptd dinas pendidikan genteng', 'jl genteng nomer 11', 14, '68465', '', NULL, '', '', '', ''),
(389, 'kantor camat rogojampi', 'kecamatan rogojampi', 5, '68462', '', NULL, '', '', '', ''),
(390, 'kantor camat banyuwangi', 'kantor camat banyuwangi', 9, '68416', '', NULL, '', '', '', ''),
(391, 'dinas pendidikan glagah', 'jl glagah nomer 7', 13, '68432', '', NULL, '', '', '', ''),
(392, 'sd sukun 1', 'sukun 1', 12, '5555', '', NULL, '', '', '', ''),
(393, 'kantor camat lowokwaru', 'kantor camat lowokwaru', 11, '5555', '', NULL, '', '', '', ''),
(394, 'uptd dinas pendidikan kec nganjuk', 'jl brantas 101', 17, '6231', '', NULL, '', '', '', ''),
(395, 'sman2nganjuk', 'jl. anjuk ladang no 09 kec nganjuk', 17, '6231', '', NULL, '', '', '', ''),
(396, 'boyolangu', 'boyolangu', 18, '5634', '', NULL, '', '', '', ''),
(397, 'kedungwaru', 'kedungwaru', 19, '56234', '', NULL, '', '', '', ''),
(398, 'sman1boyolangu', 'beji boyolangu', 18, '5432', '', NULL, '0355321462', '', '', ''),
(399, 'sman1kedungwaru', 'kedungwaru tulungagung', 19, '6543', '', NULL, '0355321381', '', '', ''),
(400, 'gedung pramuka magetan', 'jl. cemoro sewu 15', 20, '6745', 'www.magetanscout.org', NULL, '0343388956', '', '', ''),
(401, 'sanggar pramuka magetan', 'jl. cemoro kandang 15', 20, '6723', 'www.magetanscout.org', NULL, '0324337689', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `manggota`
--

CREATE TABLE IF NOT EXISTS `manggota` (
  `id_manggota` int(20) NOT NULL AUTO_INCREMENT,
  `id_mgudep` int(20) DEFAULT NULL,
  `full_anggota` varchar(100) NOT NULL,
  `nick_anggota` varchar(50) NOT NULL,
  `temp_lahir` varchar(30) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `gol_darah` enum('A','B','O','AB') NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `agama` enum('islam','katolik','kristen','budha','hindu','konghucu') NOT NULL,
  `foto` text NOT NULL,
  `status_nikah` enum('Kawin','Belum Kawin') NOT NULL,
  `jenis_kecacatan` text NOT NULL,
  `id_malamat` int(20) NOT NULL,
  `id_mlogin` int(20) NOT NULL,
  `bakat` text NOT NULL,
  `hobi` text NOT NULL,
  `bahasa` text NOT NULL,
  PRIMARY KEY (`id_manggota`),
  KEY `id_alamat` (`id_malamat`),
  KEY `id_m_login` (`id_mlogin`),
  KEY `id_gudep` (`id_mgudep`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `manggota`
--

INSERT INTO `manggota` (`id_manggota`, `id_mgudep`, `full_anggota`, `nick_anggota`, `temp_lahir`, `tgl_lahir`, `gol_darah`, `jenis_kelamin`, `agama`, `foto`, `status_nikah`, `jenis_kecacatan`, `id_malamat`, `id_mlogin`, `bakat`, `hobi`, `bahasa`) VALUES
(1, 6, 'hardiyono elfrianto S', 'epi', 'surabaya', '1990-01-02', 'B', 'L', 'islam', 'LOOGG.png', 'Kawin', '-', 351, 299, 'main alat musik gitar', 'membaca pikiran, mancing masalah', 'indonesia'),
(2, 2, 'soleh', 'sol', 'malang', '1945-02-01', 'A', 'L', 'islam', 'LOOGG.png', 'Kawin', '', 352, 300, '', '[kosong]', 'indonesia');

-- --------------------------------------------------------

--
-- Table structure for table `mgolongan`
--

CREATE TABLE IF NOT EXISTS `mgolongan` (
  `id_mgolongan` int(20) NOT NULL AUTO_INCREMENT,
  `mgolongan` varchar(50) NOT NULL,
  `umur` varchar(10) NOT NULL,
  `urutan` int(11) NOT NULL,
  `isActive` enum('y','n') DEFAULT NULL,
  PRIMARY KEY (`id_mgolongan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `mgolongan`
--

INSERT INTO `mgolongan` (`id_mgolongan`, `mgolongan`, `umur`, `urutan`, `isActive`) VALUES
(1, 'Siaga', '10', 1, 'n'),
(2, 'Penggalang', '12', 2, 'n'),
(3, 'Penegak', '16', 3, 'y'),
(4, 'Pandega', '21', 4, 'y'),
(6, 'Anggota Dewasa', '26', 5, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mgudep`
--

CREATE TABLE IF NOT EXISTS `mgudep` (
  `id_mgudep` int(20) NOT NULL AUTO_INCREMENT,
  `nomer_gudep` varchar(20) NOT NULL,
  `nama_pangkalan` varchar(50) NOT NULL,
  `ketua_gudep` varchar(30) NOT NULL,
  `tgl_berdiri` date NOT NULL,
  `id_malamat` int(20) NOT NULL,
  `id_mkwaran` int(20) NOT NULL,
  `id_mlogin` int(20) NOT NULL,
  PRIMARY KEY (`id_mgudep`),
  KEY `id_alamat` (`id_malamat`),
  KEY `id_m_kwaran` (`id_mkwaran`),
  KEY `id_m_login` (`id_mlogin`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `mgudep`
--

INSERT INTO `mgudep` (`id_mgudep`, `nomer_gudep`, `nama_pangkalan`, `ketua_gudep`, `tgl_berdiri`, `id_malamat`, `id_mkwaran`, `id_mlogin`) VALUES
(2, '22', 'unair  kampus C', '', '2008-08-08', 346, 12, 294),
(3, '33', 'kampus UPN', '', '2012-07-30', 349, 12, 297),
(4, '44', 'unesa kampus ketintang', '', '2011-02-12', 350, 12, 298),
(5, '1702', 'smun23', '', '0200-08-27', 376, 12, 305),
(6, '789', 'sman7sby', '', '2000-09-30', 377, 12, 306),
(7, '1855', 'sman6surabaya', '', '2000-09-01', 378, 12, 307),
(8, '349', 'smkn5surabaya', '', '2000-02-11', 379, 12, 308),
(10, '339', 'smkn10sby', '', '2000-02-10', 381, 12, 310),
(11, '63', 'smean1sby', '', '2000-02-16', 382, 12, 311),
(12, '301', 'manbwi', '', '2000-01-28', 383, 13, 312),
(13, '301', 'sman1glagah', '', '2013-01-02', 384, 13, 313),
(14, '307', 'sman1rogojampi', '', '2013-01-02', 385, 13, 314),
(15, '301', 'sman1genteng', '', '2013-01-02', 386, 13, 315),
(16, '303', 'sman2genteng', '', '2013-01-02', 387, 13, 316),
(17, '111', 'sman2nganjuk', '', '2013-02-02', 395, 14, 324),
(18, '095', 'sman1boyolangu', '', '2000-01-02', 398, 15, 327),
(19, '093', 'sman1kedungwaru', '', '2000-01-05', 399, 15, 328);

-- --------------------------------------------------------

--
-- Table structure for table `mkatkecpkhusus`
--

CREATE TABLE IF NOT EXISTS `mkatkecpkhusus` (
  `id_mkatkecpkhusus` int(20) NOT NULL AUTO_INCREMENT,
  `mkatkecpkhusus` varchar(200) NOT NULL,
  PRIMARY KEY (`id_mkatkecpkhusus`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `mkatkecpkhusus`
--

INSERT INTO `mkatkecpkhusus` (`id_mkatkecpkhusus`, `mkatkecpkhusus`) VALUES
(5, 'patriotisme dan seni budaya'),
(6, 'ketangkasan dan kesehatan'),
(7, 'Keterampilan dan Teknik Pembangunan'),
(8, 'sosial, perikemanusiaan, gotong-royong, ketertiban'),
(9, 'agama, mental, moral, spiritual, pembentukan pribadi');

-- --------------------------------------------------------

--
-- Table structure for table `mkec`
--

CREATE TABLE IF NOT EXISTS `mkec` (
  `id_mkec` int(11) NOT NULL AUTO_INCREMENT,
  `mkec` varchar(50) NOT NULL,
  `id_mkota` int(11) NOT NULL,
  PRIMARY KEY (`id_mkec`),
  KEY `id_mkota` (`id_mkota`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `mkec`
--

INSERT INTO `mkec` (`id_mkec`, `mkec`, `id_mkota`) VALUES
(1, 'wonokromo', 1),
(3, 'klojen', 3),
(4, 'Sukolilo', 1),
(5, 'Rogojampi', 8),
(6, 'gubeng', 1),
(7, 'genteng', 1),
(8, 'mulyorejo', 1),
(9, 'banyuwangi', 8),
(10, 'belimbing', 3),
(11, 'lowokwaru', 3),
(12, 'sukun', 3),
(13, 'glagah', 8),
(14, 'Genteng', 8),
(15, 'rungkut', 1),
(16, 'Wiyung', 1),
(17, 'Nganjuk', 4),
(18, 'Boyolangu', 6),
(19, 'Kedungwaru', 6),
(20, 'magetan', 7);

-- --------------------------------------------------------

--
-- Table structure for table `mkecpkhusus`
--

CREATE TABLE IF NOT EXISTS `mkecpkhusus` (
  `id_mkecpkhusus` int(20) NOT NULL AUTO_INCREMENT,
  `mkecpkhusus` varchar(50) NOT NULL,
  `id_mkatkecpkhusus` int(20) NOT NULL,
  PRIMARY KEY (`id_mkecpkhusus`),
  KEY `id_kt_kecp_kusus` (`id_mkatkecpkhusus`),
  KEY `id_m_kt_kecp_kusus` (`id_mkatkecpkhusus`),
  KEY `id_mkatkecpkhusus` (`id_mkatkecpkhusus`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `mkecpkhusus`
--

INSERT INTO `mkecpkhusus` (`id_mkecpkhusus`, `mkecpkhusus`, `id_mkatkecpkhusus`) VALUES
(1, 'P.P.P.K', 8),
(2, 'Pengatur Rumah', 5),
(3, 'Pengamat', 6),
(4, 'Juru Masak', 7),
(5, 'Berkemah', 7),
(6, 'Penabung', 9),
(7, 'Menjahit', 7),
(8, 'juru kebun', 7),
(9, 'Pengaman Kampung', 8),
(10, 'Gerak Jalan', 6),
(14, 'sholat', 9),
(16, 'Khotib', 9),
(17, 'Qori', 9),
(18, 'Muadzin', 9),
(19, 'pelukis', 5),
(20, 'pimpinan menyanyi', 5),
(21, 'juru selam', 6),
(22, 'penyelidik', 6),
(23, 'perenang', 6),
(24, 'navigasi udara', 7),
(25, 'juru peta', 7),
(26, 'pemadam kebakaran', 8),
(27, 'pengatur lalu-lintas', 8),
(28, 'penunjuk jalan', 8);

-- --------------------------------------------------------

--
-- Table structure for table `mkegiatan`
--

CREATE TABLE IF NOT EXISTS `mkegiatan` (
  `id_m_kegiatan` int(20) NOT NULL AUTO_INCREMENT,
  `nama_kegiatan` varchar(60) NOT NULL,
  `id_subkat` int(10) NOT NULL,
  `lokasi` text NOT NULL,
  `id_golongan` int(20) NOT NULL,
  `tingkat` enum('Daerah','Cabang','Ranting','Gudep') NOT NULL,
  `date` date NOT NULL,
  `time` varchar(20) NOT NULL,
  `file` text NOT NULL,
  `kategori` enum('Lomba','Pesta','Seminar','Pelatihan','Petualangan','Latihan') NOT NULL,
  PRIMARY KEY (`id_m_kegiatan`),
  KEY `id_golongan` (`id_golongan`),
  KEY `id_golongan_2` (`id_golongan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mkota`
--

CREATE TABLE IF NOT EXISTS `mkota` (
  `id_mkota` int(11) NOT NULL AUTO_INCREMENT,
  `mkota` varchar(50) NOT NULL,
  PRIMARY KEY (`id_mkota`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `mkota`
--

INSERT INTO `mkota` (`id_mkota`, `mkota`) VALUES
(1, 'Surabaya'),
(3, 'Kota Malang'),
(4, 'Nganjuk'),
(6, 'Tulungagung'),
(7, 'Magetan'),
(8, 'Banyuwangi');

-- --------------------------------------------------------

--
-- Table structure for table `mkwaran`
--

CREATE TABLE IF NOT EXISTS `mkwaran` (
  `id_mkwaran` int(20) NOT NULL AUTO_INCREMENT,
  `nomer_kwaran` int(10) NOT NULL,
  `ketua_ran` varchar(30) NOT NULL,
  `id_malamat` int(20) NOT NULL,
  `id_mkwarcab` int(20) NOT NULL,
  `id_mlogin` int(20) NOT NULL,
  PRIMARY KEY (`id_mkwaran`),
  KEY `id_alamat` (`id_malamat`),
  KEY `id_m_kwarcab` (`id_mkwarcab`),
  KEY `id_m_login` (`id_mlogin`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `mkwaran`
--

INSERT INTO `mkwaran` (`id_mkwaran`, `nomer_kwaran`, `ketua_ran`, `id_malamat`, `id_mkwarcab`, `id_mlogin`) VALUES
(12, 23, '', 333, 43, 284),
(13, 22, '', 334, 43, 285),
(14, 33, '', 335, 43, 286),
(15, 44, '', 336, 43, 287),
(16, 66, '', 337, 44, 288),
(17, 97, '', 338, 43, 289),
(18, 79, '', 339, 43, 290),
(19, 11, '', 344, 43, 293),
(20, 12, '', 374, 44, 303),
(21, 18, '', 388, 49, 317),
(22, 7, '', 389, 49, 318),
(23, 1, '', 390, 49, 319),
(24, 3, '', 391, 49, 320),
(25, 5, '', 392, 44, 321),
(26, 4, '', 393, 44, 322),
(27, 1, '', 394, 47, 323),
(28, 2, '', 396, 48, 325),
(29, 3, '', 397, 48, 326);

-- --------------------------------------------------------

--
-- Table structure for table `mkwarcab`
--

CREATE TABLE IF NOT EXISTS `mkwarcab` (
  `id_mkwarcab` int(20) NOT NULL AUTO_INCREMENT,
  `id_mkwarda` int(11) NOT NULL,
  `nomer_kwarcab` varchar(10) NOT NULL,
  `ketua_cab` varchar(30) NOT NULL,
  `id_malamat` int(20) NOT NULL,
  `id_mlogin` int(20) NOT NULL,
  PRIMARY KEY (`id_mkwarcab`),
  KEY `id_alamat` (`id_malamat`),
  KEY `id_m_login` (`id_mlogin`),
  KEY `id_m_kwarda` (`id_mkwarda`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Dumping data for table `mkwarcab`
--

INSERT INTO `mkwarcab` (`id_mkwarcab`, `id_mkwarda`, `nomer_kwarcab`, `ketua_cab`, `id_malamat`, `id_mlogin`) VALUES
(43, 1, '37', '', 142, 214),
(44, 1, '17', '', 143, 215),
(47, 1, '18', 'drs. achman rifai,SH', 342, 291),
(48, 1, '4', '', 343, 292),
(49, 1, '10', '', 375, 304),
(51, 1, '20', 'dr. zaenal abidin. MPd', 401, 331);

-- --------------------------------------------------------

--
-- Table structure for table `mkwarda`
--

CREATE TABLE IF NOT EXISTS `mkwarda` (
  `id_mkwarda` int(20) NOT NULL,
  `nomer_kwarda` int(10) NOT NULL,
  `nama_kwarda` varchar(50) NOT NULL,
  `id_malamat` int(20) NOT NULL,
  `id_mlogin` int(20) NOT NULL,
  PRIMARY KEY (`id_mkwarda`),
  KEY `id_alamat` (`id_malamat`,`id_mlogin`),
  KEY `id_mlogin` (`id_mlogin`),
  KEY `id_malamat` (`id_malamat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mkwarda`
--

INSERT INTO `mkwarda` (`id_mkwarda`, `nomer_kwarda`, `nama_kwarda`, `id_malamat`, `id_mlogin`) VALUES
(1, 13, 'Jawa Timur', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mlogin`
--

CREATE TABLE IF NOT EXISTS `mlogin` (
  `id_mlogin` int(20) NOT NULL AUTO_INCREMENT,
  `level` enum('superadmin','kwarda','kwarcab','kwaran','gudep','anggota') NOT NULL,
  `paswot` varchar(150) NOT NULL,
  `email` varchar(30) NOT NULL,
  `status` enum('y','n') NOT NULL,
  `isActive` enum('n','y') NOT NULL DEFAULT 'n',
  `acak` varchar(255) NOT NULL,
  PRIMARY KEY (`id_mlogin`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=332 ;

--
-- Dumping data for table `mlogin`
--

INSERT INTO `mlogin` (`id_mlogin`, `level`, `paswot`, `email`, `status`, `isActive`, `acak`) VALUES
(1, 'kwarda', 'd78b699e67e15691bf70e57edc78360e', 'kwarda@jatim.com', 'y', 'y', 'confirmed'),
(214, 'kwarcab', '5012a1cbc560d21c9ad22c555790c2b0', 'unesa14@jatim.com', 'y', 'y', 'confirmed'),
(215, 'kwarcab', '7e00112eaecc682b95fdb2e7f476e6c8', 'malang@jatim.com', 'y', 'y', 'confirmed'),
(221, 'gudep', '8', '', 'y', 'n', ''),
(222, 'gudep', '8', '', 'y', 'n', ''),
(223, 'gudep', '5', '', 'y', 'n', ''),
(224, 'gudep', '5', '', 'y', 'n', ''),
(225, 'gudep', '5', '', 'y', 'n', ''),
(226, 'gudep', '5', '', 'y', 'n', ''),
(227, 'gudep', '88', '', 'y', 'n', ''),
(228, 'gudep', 'unair', '', 'y', 'n', ''),
(229, 'gudep', '2', '', 'y', 'n', ''),
(230, 'gudep', '2', '', 'y', 'n', ''),
(231, 'gudep', '2', '', 'y', 'n', ''),
(232, 'gudep', '2', '', 'y', 'n', ''),
(233, 'gudep', '2', '', 'y', 'n', ''),
(234, 'gudep', '8', '', 'y', 'n', ''),
(235, 'gudep', '7', '', 'y', 'n', ''),
(236, 'gudep', '7', '', 'y', 'n', ''),
(237, 'gudep', '7', '', 'y', 'n', ''),
(238, 'gudep', '7', '', 'y', 'n', ''),
(239, 'gudep', '7', '', 'y', 'n', ''),
(240, 'gudep', '7', '', 'y', 'n', ''),
(241, 'gudep', '7', '', 'y', 'n', ''),
(242, 'gudep', '7', '', 'y', 'n', ''),
(243, 'gudep', '7', '', 'y', 'n', ''),
(244, 'gudep', '7', '', 'y', 'n', ''),
(245, 'gudep', '7', '', 'y', 'n', ''),
(246, 'gudep', '2', '', 'y', 'n', ''),
(247, 'gudep', '2', '', 'y', 'n', ''),
(248, 'gudep', '99', '', 'y', 'n', ''),
(249, 'gudep', '99', '', 'y', 'n', ''),
(250, 'gudep', '99', '', 'y', 'n', ''),
(251, 'gudep', '99', '', 'y', 'n', ''),
(252, 'gudep', '8', '', 'y', 'n', ''),
(253, 'gudep', '8', '', 'y', 'n', ''),
(254, 'gudep', '8', '', 'y', 'n', ''),
(255, 'gudep', '7', '', 'y', 'n', ''),
(256, 'gudep', '7', '', 'y', 'n', ''),
(257, 'gudep', '8', '', 'y', 'n', ''),
(258, 'gudep', '8', '', 'y', 'n', ''),
(259, 'gudep', '8', '', 'y', 'n', ''),
(260, 'gudep', '8', '', 'y', 'n', ''),
(261, 'gudep', '8', '', 'y', 'n', ''),
(262, 'gudep', '8', '', 'y', 'n', ''),
(264, 'gudep', '88', '', 'y', 'n', ''),
(265, 'gudep', '88', '', 'y', 'n', ''),
(266, 'gudep', '88', '', 'y', 'n', ''),
(267, 'gudep', 'unair', '', 'y', 'n', ''),
(268, 'gudep', '44', '', 'y', 'n', ''),
(271, 'gudep', '8', '', 'y', 'n', ''),
(284, 'kwaran', '923df3486dc715e97f44349d81b0104f', 'wonokromo@kwarda.com', 'y', 'n', ''),
(285, 'kwaran', 'd6c0ff8871f228c700cc998974f27645', 'mulyorejo@jatim.com', 'y', 'n', ''),
(286, 'kwaran', '424c44f4a1ce047989217e8579dfa9b7', 'jambangan@jatim.com', 'y', 'n', ''),
(287, 'kwaran', 'bcacf8968c47364320b0b3a2af91d250', 'gubeng@jatim.com', 'y', 'n', ''),
(288, 'kwaran', '53a7042f086384d55bfb9cbac3c27846', 'klojen@jatim.com', 'y', 'n', ''),
(289, 'kwaran', '53a7042f086384d55bfb9cbac3c27846', 'klojen@jatim.com', 'y', 'n', ''),
(290, 'kwaran', 'a900790b11c53d85fa2ac4c3d1950f26', 'sawahan@jatim.com', 'y', 'n', ''),
(291, 'kwarcab', 'd934e60caf14c1e393b34bc8c022ed64', 'lamongan@jatim.com', 'y', 'n', ''),
(292, 'kwarcab', 'fe75b1cd3db8e0fdf9065d10e7112371', 'tulungagung@kwarda.com', 'y', 'n', ''),
(293, 'kwaran', '4b172ba3018220a0e379df8601868c06', 'genteng@jatim.com', 'y', 'y', 'confirmed'),
(294, 'gudep', 'unair', 'unair@jatim.com', 'y', 'n', ''),
(295, 'gudep', 'upn', 'UPN@jatim.com', 'y', 'n', ''),
(296, 'gudep', 'upn', 'UPN@jatim.com', 'y', 'n', ''),
(297, 'gudep', 'upn', 'UPN@jatim.com', 'y', 'n', ''),
(298, 'gudep', 'unesa', 'unesa@jatim.com', 'y', 'n', ''),
(299, 'anggota', '443099d7d69bb4a92aa9db7547c216dd', 'gue.elfrianto@gmail.com', 'y', 'y', 'confirmed'),
(300, 'anggota', '443099d7d69bb4a92aa9db7547c216dd', 'lfree_style@yahoo.co.id', 'y', 'y', 'confirmed'),
(303, 'kwaran', '827ccb0eea8a706c4c34a16891f84e7b', 'kwarangubeng@kwarda.com', 'y', 'n', ''),
(304, 'kwarcab', '8cbec0d6848c55e952a470b4ef5ed1d0', 'bwi@jatim.com', 'y', 'n', ''),
(305, 'gudep', 'smun23', 'smun23@kwarda.com', 'y', 'n', ''),
(306, 'gudep', 'sman7', 'sman7@kwarda.com', 'y', 'n', ''),
(307, 'gudep', 'sman6', 'sman6@kwarda.com', 'y', 'n', ''),
(308, 'gudep', 'smkn5', 'smkn5@kwarda.com', 'y', 'n', ''),
(309, 'gudep', 'tesgudep', 'tesgudep@admin.com', 'y', 'n', ''),
(310, 'gudep', 'smkn10', 'smkn10@kwarda.com', 'y', 'n', ''),
(311, 'gudep', 'smean1', 'smean1@kwarda.com', 'y', 'n', ''),
(312, 'gudep', 'manbwi', 'manbwi@kwarda.com', 'y', 'n', ''),
(313, 'gudep', 'sman1glagah', 'sman1glagah@kwarda.com', 'y', 'n', ''),
(314, 'gudep', 'sman1rogojampi', 'sman1rogojampi@kwarda.com', 'y', 'n', ''),
(315, 'gudep', 'sman1genteng', 'sman1genteng@kwarda.com', 'y', 'n', ''),
(316, 'gudep', 'sman2genteng', 'sman2genteng@kwarda.com', 'y', 'n', ''),
(317, 'kwaran', '4b172ba3018220a0e379df8601868c06', 'genteng@kwartir.com', 'y', 'n', ''),
(318, 'kwaran', '4177d1216328a5f15a71a9946de0a679', 'rogojampi@kwartir.com', 'y', 'n', ''),
(319, 'kwaran', '3e06f2af88392a8943c423d7d36d307a', 'banyuwangi@kwartir.com', 'y', 'n', ''),
(320, 'kwaran', 'c11a4bcde82558e9b63c6ea9fc44deaa', 'glagah@kwartir.com', 'y', 'n', ''),
(321, 'kwaran', '490cda0cd1562ab5128d5ff271286b0b', 'sukun@kwartir.com', 'y', 'n', ''),
(322, 'kwaran', 'e2ace4288027513e7cd85aee81931e1e', 'lowokwaru@kwartir.com', 'y', 'n', ''),
(323, 'kwaran', 'd934e60caf14c1e393b34bc8c022ed64', 'nganjuk@kwarda.com', 'y', 'n', ''),
(324, 'gudep', 'sman2nganjuk', 'sman2nganjuk@kwarda.com', 'y', 'n', ''),
(325, 'kwaran', '79c6501c996efb7199f047cdf5eae4a8', 'boyolangu@kwarda.com', 'y', 'n', ''),
(326, 'kwaran', '0be1fe4afbb44c0d4329262d150efea0', 'kedungwaru@kwarda.com', 'y', 'n', ''),
(327, 'gudep', 'sman1boy', 'sman1boy@kwarda.com', 'y', 'n', ''),
(328, 'gudep', 'sman1ked', 'sman1ked@kwarda.com', 'y', 'n', ''),
(329, 'anggota', '1a59fc4b67195ad7f28d74ec79ab25bc', 'armynila@gmail.com', 'y', 'y', 'confirmed'),
(330, 'kwarcab', '4d6615aa91fbc5b0cc070729bf558012', 'magetan@kwarda.com', 'y', 'n', ''),
(331, 'kwarcab', '4d6615aa91fbc5b0cc070729bf558012', 'magetan@kwarda.com', 'y', 'n', '');

-- --------------------------------------------------------

--
-- Table structure for table `msubgolongan`
--

CREATE TABLE IF NOT EXISTS `msubgolongan` (
  `id_msubgolongan` int(20) NOT NULL AUTO_INCREMENT,
  `msubgolongan` varchar(20) NOT NULL,
  `id_mgolongan` int(20) NOT NULL,
  PRIMARY KEY (`id_msubgolongan`),
  KEY `id_golongan` (`id_mgolongan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `msubgolongan`
--

INSERT INTO `msubgolongan` (`id_msubgolongan`, `msubgolongan`, `id_mgolongan`) VALUES
(9, 'Bantara', 3),
(10, 'Laksana', 3),
(11, 'Garuda Penegak', 3),
(12, 'Pandega', 4),
(13, 'Garuda Pandega', 4);

-- --------------------------------------------------------

--
-- Table structure for table `msurat`
--

CREATE TABLE IF NOT EXISTS `msurat` (
  `id_msurat` int(20) NOT NULL AUTO_INCREMENT,
  `file_surat` text NOT NULL,
  `judul_surat` varchar(60) NOT NULL,
  `tingkat` enum('Daerah','Cabang','Ranting','Gudep') NOT NULL,
  `id_mlogin` int(20) NOT NULL,
  PRIMARY KEY (`id_msurat`),
  KEY `id_m_login` (`id_mlogin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `danggota`
--
ALTER TABLE `danggota`
  ADD CONSTRAINT `danggota_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `manggota` (`id_manggota`),
  ADD CONSTRAINT `danggota_ibfk_2` FOREIGN KEY (`id_mgudep`) REFERENCES `mgudep` (`id_mgudep`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dasuransi`
--
ALTER TABLE `dasuransi`
  ADD CONSTRAINT `dasuransi_ibfk_1` FOREIGN KEY (`id_manggota`) REFERENCES `manggota` (`id_manggota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dbina`
--
ALTER TABLE `dbina`
  ADD CONSTRAINT `dbina_ibfk_1` FOREIGN KEY (`id_manggota`) REFERENCES `manggota` (`id_manggota`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dbina_ibfk_2` FOREIGN KEY (`id_mgudep`) REFERENCES `mgudep` (`id_mgudep`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `djabatan`
--
ALTER TABLE `djabatan`
  ADD CONSTRAINT `djabatan_ibfk_1` FOREIGN KEY (`id_manggota`) REFERENCES `manggota` (`id_manggota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dkegiatan`
--
ALTER TABLE `dkegiatan`
  ADD CONSTRAINT `dkegiatan_ibfk_1` FOREIGN KEY (`id_mkegiatan`) REFERENCES `mkegiatan` (`id_m_kegiatan`),
  ADD CONSTRAINT `dkegiatan_ibfk_2` FOREIGN KEY (`id_anggota`) REFERENCES `manggota` (`id_manggota`);

--
-- Constraints for table `dkeluarga`
--
ALTER TABLE `dkeluarga`
  ADD CONSTRAINT `dkeluarga_ibfk_1` FOREIGN KEY (`id_manggota`) REFERENCES `manggota` (`id_manggota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dkta`
--
ALTER TABLE `dkta`
  ADD CONSTRAINT `dkta_ibfk_3` FOREIGN KEY (`id_gudep`) REFERENCES `mgudep` (`id_mgudep`),
  ADD CONSTRAINT `dkta_ibfk_4` FOREIGN KEY (`id_manggota`) REFERENCES `manggota` (`id_manggota`);

--
-- Constraints for table `dpekerjaan`
--
ALTER TABLE `dpekerjaan`
  ADD CONSTRAINT `dpekerjaan_ibfk_1` FOREIGN KEY (`id_manggota`) REFERENCES `manggota` (`id_manggota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `drcapaikecp`
--
ALTER TABLE `drcapaikecp`
  ADD CONSTRAINT `drcapaikecp_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `manggota` (`id_manggota`);

--
-- Constraints for table `drkecpkhusus`
--
ALTER TABLE `drkecpkhusus`
  ADD CONSTRAINT `drkecpkhusus_ibfk_1` FOREIGN KEY (`id_mkecpkhusus`) REFERENCES `mkecpkhusus` (`id_mkecpkhusus`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `drkecpkhusus_ibfk_2` FOREIGN KEY (`id_manggota`) REFERENCES `manggota` (`id_manggota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `drkecpumum`
--
ALTER TABLE `drkecpumum`
  ADD CONSTRAINT `drkecpumum_ibfk_1` FOREIGN KEY (`id_manggota`) REFERENCES `manggota` (`id_manggota`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `drkecpumum_ibfk_2` FOREIGN KEY (`id_msubgolongan`) REFERENCES `msubgolongan` (`id_msubgolongan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `drkegnonpram`
--
ALTER TABLE `drkegnonpram`
  ADD CONSTRAINT `drkegnonpram_ibfk_1` FOREIGN KEY (`id_manggota`) REFERENCES `manggota` (`id_manggota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `drkegpram`
--
ALTER TABLE `drkegpram`
  ADD CONSTRAINT `drkegpram_ibfk_1` FOREIGN KEY (`id_manggota`) REFERENCES `manggota` (`id_manggota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `drnaiktingkat`
--
ALTER TABLE `drnaiktingkat`
  ADD CONSTRAINT `drnaiktingkat_ibfk_2` FOREIGN KEY (`id_anggota`) REFERENCES `manggota` (`id_manggota`),
  ADD CONSTRAINT `drnaiktingkat_ibfk_3` FOREIGN KEY (`id_subgolongan`) REFERENCES `msubgolongan` (`id_msubgolongan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `drpendf`
--
ALTER TABLE `drpendf`
  ADD CONSTRAINT `drpendf_ibfk_1` FOREIGN KEY (`id_manggota`) REFERENCES `manggota` (`id_manggota`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `drpendf_ibfk_2` FOREIGN KEY (`id_malamat`) REFERENCES `malamat` (`id_malamat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `drpendf_ibfk_3` FOREIGN KEY (`id_dsubpendf`) REFERENCES `dsubpendf` (`id_dsubpendf`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `drpendi`
--
ALTER TABLE `drpendi`
  ADD CONSTRAINT `drpendi_ibfk_1` FOREIGN KEY (`id_manggota`) REFERENCES `manggota` (`id_manggota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `drprestasi`
--
ALTER TABLE `drprestasi`
  ADD CONSTRAINT `drprestasi_ibfk_1` FOREIGN KEY (`id_manggota`) REFERENCES `manggota` (`id_manggota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dsosmed`
--
ALTER TABLE `dsosmed`
  ADD CONSTRAINT `dsosmed_ibfk_1` FOREIGN KEY (`id_manggota`) REFERENCES `manggota` (`id_manggota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `malamat`
--
ALTER TABLE `malamat`
  ADD CONSTRAINT `malamat_ibfk_1` FOREIGN KEY (`id_mkec`) REFERENCES `mkec` (`id_mkec`);

--
-- Constraints for table `manggota`
--
ALTER TABLE `manggota`
  ADD CONSTRAINT `manggota_ibfk_1` FOREIGN KEY (`id_malamat`) REFERENCES `malamat` (`id_malamat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `manggota_ibfk_2` FOREIGN KEY (`id_mlogin`) REFERENCES `mlogin` (`id_mlogin`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `manggota_ibfk_3` FOREIGN KEY (`id_mgudep`) REFERENCES `mgudep` (`id_mgudep`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mgudep`
--
ALTER TABLE `mgudep`
  ADD CONSTRAINT `mgudep_ibfk_1` FOREIGN KEY (`id_malamat`) REFERENCES `malamat` (`id_malamat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mgudep_ibfk_2` FOREIGN KEY (`id_mkwaran`) REFERENCES `mkwaran` (`id_mkwaran`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mgudep_ibfk_3` FOREIGN KEY (`id_mlogin`) REFERENCES `mlogin` (`id_mlogin`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mkec`
--
ALTER TABLE `mkec`
  ADD CONSTRAINT `mkec_ibfk_1` FOREIGN KEY (`id_mkota`) REFERENCES `mkota` (`id_mkota`);

--
-- Constraints for table `mkecpkhusus`
--
ALTER TABLE `mkecpkhusus`
  ADD CONSTRAINT `mkecpkhusus_ibfk_1` FOREIGN KEY (`id_mkatkecpkhusus`) REFERENCES `mkatkecpkhusus` (`id_mkatkecpkhusus`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mkegiatan`
--
ALTER TABLE `mkegiatan`
  ADD CONSTRAINT `mkegiatan_ibfk_1` FOREIGN KEY (`id_golongan`) REFERENCES `mgolongan` (`id_mgolongan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mkwaran`
--
ALTER TABLE `mkwaran`
  ADD CONSTRAINT `mkwaran_ibfk_4` FOREIGN KEY (`id_malamat`) REFERENCES `malamat` (`id_malamat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mkwaran_ibfk_5` FOREIGN KEY (`id_mkwarcab`) REFERENCES `mkwarcab` (`id_mkwarcab`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mkwaran_ibfk_6` FOREIGN KEY (`id_mlogin`) REFERENCES `mlogin` (`id_mlogin`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mkwarcab`
--
ALTER TABLE `mkwarcab`
  ADD CONSTRAINT `mkwarcab_ibfk_3` FOREIGN KEY (`id_malamat`) REFERENCES `malamat` (`id_malamat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mkwarcab_ibfk_4` FOREIGN KEY (`id_mlogin`) REFERENCES `mlogin` (`id_mlogin`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mkwarcab_ibfk_5` FOREIGN KEY (`id_mkwarda`) REFERENCES `mkwarda` (`id_mkwarda`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mkwarda`
--
ALTER TABLE `mkwarda`
  ADD CONSTRAINT `mkwarda_ibfk_1` FOREIGN KEY (`id_malamat`) REFERENCES `malamat` (`id_malamat`) ON DELETE CASCADE,
  ADD CONSTRAINT `mkwarda_ibfk_2` FOREIGN KEY (`id_mlogin`) REFERENCES `mlogin` (`id_mlogin`) ON DELETE CASCADE;

--
-- Constraints for table `msubgolongan`
--
ALTER TABLE `msubgolongan`
  ADD CONSTRAINT `msubgolongan_ibfk_1` FOREIGN KEY (`id_mgolongan`) REFERENCES `mgolongan` (`id_mgolongan`);

--
-- Constraints for table `msurat`
--
ALTER TABLE `msurat`
  ADD CONSTRAINT `msurat_ibfk_1` FOREIGN KEY (`id_mlogin`) REFERENCES `mlogin` (`id_mlogin`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
