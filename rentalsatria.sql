-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 11, 2023 at 11:05 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rentalsatria`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bank`
--

CREATE TABLE `tbl_bank` (
  `id_bank` int(11) NOT NULL,
  `nama_bank` varchar(20) NOT NULL,
  `nomor_rekening` varchar(25) NOT NULL,
  `nama_nasabah` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_bank`
--

INSERT INTO `tbl_bank` (`id_bank`, `nama_bank`, `nomor_rekening`, `nama_nasabah`) VALUES
(1, 'Mandiri', '1760002070835', 'Bebek Terbang Corporation');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mobil`
--

CREATE TABLE `tbl_mobil` (
  `id_mobil` int(11) NOT NULL,
  `id_type` int(11) NOT NULL,
  `nama_kendaraan` varchar(128) NOT NULL,
  `no_plat` varchar(20) NOT NULL,
  `warna` varchar(128) NOT NULL,
  `harga` int(11) NOT NULL,
  `gambar` varchar(50) NOT NULL,
  `tahun` int(4) NOT NULL,
  `status_sewa` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_mobil`
--

INSERT INTO `tbl_mobil` (`id_mobil`, `id_type`, `nama_kendaraan`, `no_plat`, `warna`, `harga`, `gambar`, `tahun`, `status_sewa`) VALUES
(1, 2, 'Toyota Agya', 'BE1234CD', 'Abu - Abu', 200000, 'agya.png', 2020, 0),
(2, 1, 'Kijang Innova Venturer', 'BE2345GO', 'Hitam', 250000, 'innova.png', 2020, 0),
(62, 10, 'Suzuki Swift', 'BE3456CA', 'Abu - Abu', 150000, 'swift.png', 2015, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pelanggan`
--

CREATE TABLE `tbl_pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(128) DEFAULT NULL,
  `email_pelanggan` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `gambar_pelanggan` varchar(128) DEFAULT NULL,
  `nik_ktp` varchar(20) DEFAULT NULL,
  `upload_ktp` varchar(50) DEFAULT NULL,
  `no_sim` varchar(20) DEFAULT NULL,
  `upload_sim` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pelanggan`
--

INSERT INTO `tbl_pelanggan` (`id_pelanggan`, `nama_pelanggan`, `email_pelanggan`, `password`, `gambar_pelanggan`, `nik_ktp`, `upload_ktp`, `no_sim`, `upload_sim`) VALUES
(4, 'Rafi', 'ramadhanrafi871@gmail.com', 'akumaupulang', 'A.png', '3603051710030002', 'ktp.jpeg', '0123456789101', 'ktm.jpeg'),
(20, 'raphking', 'rafiramadhanarr17@gmail.com', 'akumaupulang', '', '3603051710030003', '', '0123456789101', ''),
(22, 'kangcuci', 'aaa@gmail.com', 'aaa', NULL, '321321321321', NULL, '321321321321', NULL),
(36, 'raphking', 'rafiramadhanarr17@gmail.com', '', '', '3603051710030003', '', '0123456789101', ''),
(37, NULL, 'ramadhanrafi871@gmail.com', '', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_type`
--

CREATE TABLE `tbl_type` (
  `id_type` int(11) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `kode_type` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_type`
--

INSERT INTO `tbl_type` (`id_type`, `jenis`, `kode_type`) VALUES
(1, 'SUV', 'MAF'),
(2, 'MPV', 'KPL'),
(9, 'Crossover', 'CSR'),
(10, 'Hatback', 'HTB');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `photo_user` varchar(128) DEFAULT NULL,
  `status_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `nama`, `email`, `password`, `photo_user`, `status_user`) VALUES
(7, 'Rafi', 'ramadhanrafi871@gmail.com', '12345', 'default.jpg', 1),
(31, 'Admin', 'admin@gmail.com', '12345', 'default.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_mobil` int(11) NOT NULL,
  `tanggal_rental` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `harga` int(20) NOT NULL,
  `berapa_hari` int(20) NOT NULL,
  `sub_total` int(20) NOT NULL,
  `status_pembayaran` int(11) DEFAULT NULL,
  `total_bayar` int(120) DEFAULT NULL,
  `atas_nama_pelanggan` varchar(128) DEFAULT NULL,
  `nama_bank_pelanggan` varchar(128) DEFAULT NULL,
  `nomor_rekening_pelanggan` varchar(128) DEFAULT NULL,
  `bukti_pembayaran` varchar(120) DEFAULT NULL,
  `tanggal_pengembalian` date DEFAULT NULL,
  `status_pengembalian` varchar(50) DEFAULT NULL,
  `status_rental` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_pelanggan`, `id_mobil`, `tanggal_rental`, `tanggal_kembali`, `harga`, `berapa_hari`, `sub_total`, `status_pembayaran`, `total_bayar`, `atas_nama_pelanggan`, `nama_bank_pelanggan`, `nomor_rekening_pelanggan`, `bukti_pembayaran`, `tanggal_pengembalian`, `status_pengembalian`, `status_rental`) VALUES
(88, 4, 1, '2023-06-07', '2023-06-09', 200000, 2, 400000, 3, 400000, 'Rafi Ramadhan', 'Mandiri', '17605021321', 'bukti.jpeg', NULL, '1', '1'),
(89, 4, 2, '2023-06-07', '2023-06-09', 250000, 2, 500000, 0, 500000, 'Rafi ', 'Mandiri', '32132132132', '', NULL, NULL, NULL),
(90, 4, 1, '2023-06-09', '2023-06-11', 200000, 2, 400000, 0, 400000, 'Rafi Ramadhan', 'Mandiri', '170207000', '', NULL, NULL, NULL),
(91, 4, 1, '2023-06-10', '2023-06-12', 200000, 2, 400000, 2, 400000, 'Rafi Ramadhan', 'BCA', '7602102132', 'bukti.jpeg', '2023-06-12', '', ''),
(92, 4, 2, '2023-06-10', '2023-06-13', 250000, 3, 750000, 3, 750000, 'Rafi', 'BCA', '7160010106', 'A.png', '2023-06-13', '1', '1'),
(93, 20, 2, '2023-06-11', '2023-06-13', 250000, 2, 500000, 1, 500000, 'Rafi Ramadhan', 'Mandiri', '17601221312', 'bukti.jpeg', '2023-06-13', '0', '0'),
(94, 36, 1, '2023-06-11', '2023-06-13', 200000, 2, 400000, 0, NULL, NULL, NULL, NULL, NULL, '2023-06-13', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_bank`
--
ALTER TABLE `tbl_bank`
  ADD PRIMARY KEY (`id_bank`);

--
-- Indexes for table `tbl_mobil`
--
ALTER TABLE `tbl_mobil`
  ADD PRIMARY KEY (`id_mobil`),
  ADD KEY `id_type` (`id_type`);

--
-- Indexes for table `tbl_pelanggan`
--
ALTER TABLE `tbl_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `tbl_type`
--
ALTER TABLE `tbl_type`
  ADD PRIMARY KEY (`id_type`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `id_mobil` (`id_mobil`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_bank`
--
ALTER TABLE `tbl_bank`
  MODIFY `id_bank` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_mobil`
--
ALTER TABLE `tbl_mobil`
  MODIFY `id_mobil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `tbl_pelanggan`
--
ALTER TABLE `tbl_pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tbl_type`
--
ALTER TABLE `tbl_type`
  MODIFY `id_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_mobil`
--
ALTER TABLE `tbl_mobil`
  ADD CONSTRAINT `tbl_mobil_ibfk_1` FOREIGN KEY (`id_type`) REFERENCES `tbl_type` (`id_type`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `tbl_pelanggan` (`id_pelanggan`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_pelanggan`) REFERENCES `tbl_pelanggan` (`id_pelanggan`),
  ADD CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`id_mobil`) REFERENCES `tbl_mobil` (`id_mobil`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
