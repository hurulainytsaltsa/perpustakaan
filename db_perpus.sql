-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2024 at 10:35 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_perpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `issn` int(11) NOT NULL,
  `kode_buku` varchar(20) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `category_id` varchar(20) NOT NULL,
  `pengarang` int(11) NOT NULL,
  `penerbit` int(11) NOT NULL,
  `available_books` int(11) NOT NULL,
  `total_books` int(11) NOT NULL,
  `photo` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `issn`, `kode_buku`, `judul`, `category_id`, `pengarang`, `penerbit`, `available_books`, `total_books`, `photo`) VALUES
(11, 123456, 'A002', 'Pemogramman 2', '001', 19, 1, 6, 10, 'a2.jpeg'),
(12, 123456, 'A005', 'Pemogramman 5', '001', 19, 1, 8, 10, 'a3.jpeg'),
(13, 123456, 'A004', 'Pemogramman 4', '001', 19, 1, 7, 10, 'a4.jpeg'),
(15, 123456, 'A003', 'Pemogramman 3', '001', 19, 1, 9, 10, 'a5.jpeg'),
(16, 123456, 'A001', 'Pemogramman 1', '001', 19, 1, 10, 10, 'Pemogramman.jpeg'),
(21, 123456, 'A007', 'Pemograman 7', '001', 20, 1, -1, 2, 'a7.jpeg'),
(22, 456, 'A009', 'Pemrogramann', '001', 1, 1, 10, 10, 'Pemogramman.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id_kategori` varchar(20) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `nomor_kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id_kategori`, `nama_kategori`, `photo`, `nomor_kategori`) VALUES
('001', 'Technology', 'computer.png', 1),
('002', 'Psychology', 'psychology.png', 2),
('003', 'Religion', 'religion.png', 3),
('004', 'Social Science', 'social_science.png', 4),
('005', 'Language', 'language.png', 5),
('006', 'Pure Science', 'pure_science.png', 6),
('007', 'Applied Science', 'applied_science.png', 7),
('008', 'Art and Recreation', 'art.png', 8),
('009', 'Literature and Reading', 'literature.png', 9),
('010', 'History and Geography', 'history.png', 10),
('011', 'Something Guide', 'guide.png', 11),
('012', 'Novel and Comic', 'novelll.png', 12),
('013', 'Something', 'novel.png', 13);

-- --------------------------------------------------------

--
-- Table structure for table `kunjungan`
--

CREATE TABLE `kunjungan` (
  `id_kunjungan` int(11) NOT NULL,
  `member_id` varchar(20) NOT NULL,
  `prodi_id` int(20) NOT NULL,
  `tanggal_kunjungan` date NOT NULL,
  `jam_kunjungan` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kunjungan`
--

INSERT INTO `kunjungan` (`id_kunjungan`, `member_id`, `prodi_id`, `tanggal_kunjungan`, `jam_kunjungan`) VALUES
(2, '2201092012', 1, '2024-01-03', '10:27:18'),
(5, '2201092012', 1, '2024-01-05', '09:48:57'),
(6, '2201092012', 1, '2024-01-06', '13:12:58'),
(12, '2201092014', 1, '2024-01-10', '22:34:06'),
(13, '2201092014', 1, '2024-01-11', '08:04:07'),
(14, '2201092012', 1, '2024-01-11', '08:04:22'),
(16, '2201092029', 1, '2024-01-11', '08:39:37'),
(17, '2201092046', 1, '2024-01-11', '10:06:58'),
(18, '2201092041', 1, '2024-01-11', '10:07:16'),
(20, '2201092014', 1, '2024-01-11', '10:07:58'),
(21, '2201092014', 1, '2024-01-11', '10:08:33'),
(22, '2201092014', 1, '2024-01-11', '10:08:50'),
(23, '2201092014', 1, '2024-01-12', '14:29:40');

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id_transaksi` int(11) NOT NULL,
  `id_member` varchar(20) NOT NULL,
  `kode_buku` varchar(20) NOT NULL,
  `tanggal_peminjaman` date NOT NULL,
  `tanggal_pengembalian` date NOT NULL,
  `status` enum('Sedang Dipinjam','Sudah Dikembalikan') NOT NULL,
  `denda` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id_transaksi`, `id_member`, `kode_buku`, `tanggal_peminjaman`, `tanggal_pengembalian`, `status`, `denda`) VALUES
(5, '2201092014', 'A003', '2024-01-10', '2024-01-17', 'Sudah Dikembalikan', 0),
(6, '2201092014', 'A004', '2024-01-11', '2024-01-18', 'Sudah Dikembalikan', 0),
(7, '2201092014', 'A002', '2024-01-11', '2024-01-18', 'Sudah Dikembalikan', 0),
(8, '2201092012', 'A002', '2024-01-11', '2024-01-18', 'Sedang Dipinjam', 0),
(9, '2201092012', 'A004', '2024-01-11', '2024-01-18', 'Sedang Dipinjam', 0),
(10, '2201092029', 'A002', '2024-01-11', '2024-01-18', 'Sedang Dipinjam', 0),
(11, '2201092029', 'A004', '2024-01-11', '2024-01-18', 'Sedang Dipinjam', 0),
(12, '2201092029', 'A005', '2024-01-11', '2024-01-18', 'Sedang Dipinjam', 0),
(13, '2201092041', 'A002', '2024-01-11', '2024-01-18', 'Sedang Dipinjam', 0),
(14, '2201092041', 'A004', '2024-01-11', '2024-01-18', 'Sedang Dipinjam', 0),
(15, '2201092041', 'A003', '2024-01-11', '2024-01-18', 'Sedang Dipinjam', 0),
(16, '2201092046', 'A005', '2024-01-11', '2024-01-18', 'Sedang Dipinjam', 0),
(17, '2201092046', 'A002', '2024-01-11', '2024-01-18', 'Sedang Dipinjam', 0),
(18, '2201092046', 'A003', '2024-01-01', '2024-01-07', 'Sudah Dikembalikan', 800),
(19, '2201092014', 'A001', '2024-01-01', '2024-01-07', 'Sudah Dikembalikan', 0),
(20, '2201092014', 'A007', '2024-01-11', '2024-01-18', 'Sedang Dipinjam', 0),
(21, '2201092014', 'A007', '2024-01-11', '2024-01-18', 'Sedang Dipinjam', 0),
(22, '2201092014', 'A007', '2024-01-11', '2024-01-18', 'Sedang Dipinjam', 0);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id_member` varchar(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `type` enum('Mahasiswa','Dosen','Staff') NOT NULL,
  `email` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `tanggal_registrasi` date NOT NULL,
  `tanggal_berakhir` date NOT NULL,
  `jekel` enum('Laki-laki','Perempuan') NOT NULL,
  `alamat` text NOT NULL,
  `id_prodi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id_member`, `nama`, `type`, `email`, `tanggal_lahir`, `tanggal_registrasi`, `tanggal_berakhir`, `jekel`, `alamat`, `id_prodi`) VALUES
('2201092012', 'Hurul Asya', 'Mahasiswa', 'hurulainy@gmail.com', '2023-12-04', '2023-12-24', '2025-12-23', 'Perempuan', 'Balai Baru', 2),
('2201092014', 'Khairal Satria', 'Mahasiswa', 'khairal@gmail.com', '2003-11-29', '2024-01-10', '2027-01-10', 'Laki-laki', 'Pauh, Padang', 1),
('2201092029', 'Raihan Oprinande', 'Mahasiswa', 'raihan@gmail.com', '2003-12-31', '2024-01-10', '2027-01-10', 'Laki-laki', 'Dumai', 1),
('2201092041', 'Hafis Enaldo', 'Mahasiswa', 'hafis@gmail.com', '2003-02-15', '2024-01-10', '2027-12-10', 'Laki-laki', 'Batusangkar', 1),
('2201092046', 'Fauzan Maulana', 'Mahasiswa', 'fauzan@gmail.com', '2024-01-01', '2024-01-11', '2027-01-11', 'Laki-laki', 'Padang', 1),
('2201092055', 'Rezky Ilham', 'Mahasiswa', 'rezky@gmail.com', '2001-01-01', '2024-01-10', '2027-01-10', 'Laki-laki', 'Padang', 1),
('666666666', 'Etek', 'Staff', 'etek@gmail.com', '2002-01-01', '2024-01-10', '2001-01-10', 'Perempuan', 'Padang', 1),
('9999999999', 'Ari', 'Dosen', 'seseorang@gmial.com', '2001-01-01', '2024-01-10', '2027-01-10', 'Laki-laki', 'Padang', 1);

-- --------------------------------------------------------

--
-- Table structure for table `penerbit`
--

CREATE TABLE `penerbit` (
  `id` int(11) NOT NULL,
  `id_penerbit` varchar(20) NOT NULL,
  `nama_penerbit` varchar(100) NOT NULL,
  `kota` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penerbit`
--

INSERT INTO `penerbit` (`id`, `id_penerbit`, `nama_penerbit`, `kota`) VALUES
(1, '001', 'Pustaka Media', 'Jakarta'),
(2, '002', 'Gramedia', 'Padang');

-- --------------------------------------------------------

--
-- Table structure for table `pengarang`
--

CREATE TABLE `pengarang` (
  `id` int(11) NOT NULL,
  `id_pengarang` int(11) NOT NULL,
  `nama_pengarang` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengarang`
--

INSERT INTO `pengarang` (`id`, `id_pengarang`, `nama_pengarang`) VALUES
(1, 1, 'Achmad Djunaedi'),
(2, 2, 'Jaenal Arifin'),
(3, 3, 'Emil Bachtiar'),
(4, 4, 'Soemarso'),
(5, 5, 'Wasilah'),
(6, 6, 'Taufiq Rechim'),
(7, 7, 'Saludin Muis'),
(8, 8, 'Ika Yunia Fauzia'),
(10, 10, 'Agus S. Sadana'),
(11, 11, 'Zakiah Hidayati'),
(12, 12, 'Wahyu'),
(13, 13, 'Etty Indriani'),
(14, 14, 'Yusri Abdillah'),
(15, 15, 'Muharto'),
(16, 0, 'Samsul Arifin'),
(17, 0, 'Yudi Antomi'),
(18, 0, 'Imam Sakti Yudhistira'),
(19, 0, 'Jongkers Tampubolon'),
(20, 0, 'Siti Najma'),
(21, 0, 'Irham WP'),
(22, 0, 'Edmund Conway'),
(23, 0, 'Jones,Charles P'),
(24, 0, 'Pinto Rakhmat'),
(25, 0, 'Mumun Syaban'),
(26, 0, 'Ruminta'),
(27, 0, 'Solichah Larasati'),
(28, 0, 'Agus Suryanto'),
(29, 0, 'Hermayawati'),
(30, 0, 'Gede Eka Putrawan'),
(31, 0, 'Ari Nurweni'),
(32, 0, 'Ageng Trisna Surya Pradana Putra'),
(33, 0, 'Suardi'),
(34, 0, 'LIlis Sholihah'),
(35, 0, 'Schaarwachter, Georg'),
(36, 0, 'Tim Perumus Fakultas Teknik UMJ Jakarta'),
(37, 0, 'Muhammad'),
(38, 0, 'Theodorus M.Tuanakotta.'),
(39, 0, 'Yoli Hemdi'),
(40, 0, 'Fajar Kurnianto'),
(41, 0, 'Blyton,Enicl'),
(42, 0, 'Hartman Laura P'),
(43, 0, 'Clare A. Gunn'),
(44, 0, 'Hamka'),
(45, 0, 'Muchlis Anwar'),
(46, 0, 'Bagus Rumbogo'),
(47, 0, 'Fitryane Lihawa'),
(48, 0, 'Morris, Travor ; Goldsworthy, Simon'),
(49, 0, 'Heru Dibyo Laksono Fajril Akbar'),
(50, 0, 'Budi Rahajo'),
(51, 0, 'Shalih Bin Fauzan Al-Fauzan'),
(52, 0, 'McClave,James T'),
(53, 0, 'Cook,Martie'),
(54, 0, 'Gerald Millerson'),
(55, 0, 'kuncoro Harto widodo'),
(56, 0, 'Amir Salipu'),
(57, 0, 'Heru Dibyo Laksono'),
(58, 0, 'Wayan Suparta'),
(59, 0, 'Armein Z.R.Langi'),
(60, 0, 'Supriono'),
(61, 0, 'Eko Budi Santoso'),
(62, 0, 'Sentot Imam Wahjono'),
(63, 0, 'Eliada Herwiyanti'),
(64, 0, 'Sakti Alamsyah'),
(65, 0, 'Luki Karunia, Azas Mabrur'),
(66, 0, 'Sifa Fauziah , Wati Erawati'),
(67, 0, 'Ade Fitria Lestari'),
(68, 0, 'Lita Sari Marita'),
(69, 0, 'Deasy Purwaningtias'),
(70, 0, 'Etika Profesi'),
(71, 0, 'Oris Krianto Sulaiman'),
(72, 0, 'Eva Zuraida'),
(73, 0, 'Siti Ummi Masruroh'),
(74, 0, 'Fitri Marisa'),
(75, 0, 'Titon Dutono'),
(76, 0, 'Arna Fariza'),
(77, 0, 'Arif Akbarul Huda'),
(78, 0, 'Novega Pratama Adiputra'),
(79, 0, 'Fendi Hidayat'),
(80, 0, 'Devi Hellystia'),
(81, 0, 'Basturi Hasan'),
(82, 0, 'Berita Mambarasi Nehe'),
(83, 0, 'Jufrizal'),
(84, 0, 'A.Soerjowardhana'),
(85, 0, 'Muhammad Sukirlan'),
(86, 0, 'Elok Widiyati'),
(87, 0, 'Herri Susanto'),
(88, 0, 'Dede Mahdiyah'),
(89, 0, 'Yani Sri Mulyani'),
(90, 0, 'Swastha, Basu'),
(91, 0, 'Warman Djohan'),
(92, 0, 'M. Iqbal Hasann'),
(93, 0, 'L Robut, Mott'),
(94, 0, 'qosim manang,yusuf'),
(95, 0, 'Theodorus M.Tuanakotta'),
(96, 0, 'Mott, Robert L'),
(97, 0, 'zuhri saifuddin'),
(98, 0, 'tty Indriati'),
(99, 0, 'Carter, Philip'),
(100, 0, 'Ron Simpson'),
(101, 0, 'Mienati Somya Lasmana.'),
(102, 0, 'Ary Ginanjar Agustian'),
(103, 0, 'Nawacita Komunika'),
(104, 0, 'Donna Widjajanto'),
(105, 0, 'Her Suganda'),
(106, 0, 'Myrtha Soeroto'),
(107, 0, 'Gagas Ulung'),
(108, 0, 'Kimono Experience'),
(109, 0, 'Bahtiar'),
(110, 0, 'Blyton Enid'),
(111, 0, 'Enid Blayton'),
(112, 0, 'Hanum Salsabiela Rais'),
(113, 0, 'Ita Susanto'),
(114, 0, 'Tere Liye'),
(115, 0, 'Endri K'),
(116, 0, 'Harry Wijaya'),
(117, 9, 'Seseorang');

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `prodi_id` int(11) NOT NULL,
  `nama_prodi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`prodi_id`, `nama_prodi`) VALUES
(1, 'D3 Manajemen Informatika'),
(2, 'D4 Teknologi Rekayasa Perangkat Lunak'),
(3, 'D3 Teknik Komputer'),
(5, 'D3 Teknik Sipil'),
(6, 'D3 Teknik Mesin'),
(7, 'D3 Teknik Elektronika'),
(8, 'D3 Teknik Listrik'),
(9, 'D3 Teknik Alat Berat'),
(10, 'D3 Teknik Telekomunikasi'),
(11, 'D3 Bahasa Inggris');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `id_user` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` enum('Admin','Pustakawan') NOT NULL,
  `photo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `id_user`, `email`, `nama`, `password`, `level`, `photo`) VALUES
(1, '20000', 'admin@gmail.com', 'Deddy  Prayamaa', '123456', 'Admin', 'user-deddy.png'),
(2, '0029910', 'ratnawati@gmail.com', 'Ratnawati', '123456', 'Pustakawan', 'user_ratnawati.png'),
(3, '666', 'isma@gmail.com', 'Ismaneli', '123456', 'Admin', 'ismaneli.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_buku` (`kode_buku`),
  ADD KEY `id_penerbit` (`penerbit`),
  ADD KEY `id_pengarang` (`pengarang`),
  ADD KEY `kategori_id` (`category_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `kunjungan`
--
ALTER TABLE `kunjungan`
  ADD PRIMARY KEY (`id_kunjungan`),
  ADD KEY `fk_member_id` (`member_id`),
  ADD KEY `fk_prodi_id` (`prodi_id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_member` (`id_member`),
  ADD KEY `kode_buku` (`kode_buku`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indexes for table `penerbit`
--
ALTER TABLE `penerbit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengarang`
--
ALTER TABLE `pengarang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`prodi_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `kunjungan`
--
ALTER TABLE `kunjungan`
  MODIFY `id_kunjungan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `penerbit`
--
ALTER TABLE `penerbit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `pengarang`
--
ALTER TABLE `pengarang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `id_penerbit` FOREIGN KEY (`penerbit`) REFERENCES `penerbit` (`id`),
  ADD CONSTRAINT `id_pengarang` FOREIGN KEY (`pengarang`) REFERENCES `pengarang` (`id`),
  ADD CONSTRAINT `kategori_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id_kategori`);

--
-- Constraints for table `kunjungan`
--
ALTER TABLE `kunjungan`
  ADD CONSTRAINT `fk_member_id` FOREIGN KEY (`member_id`) REFERENCES `member` (`id_member`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_prodi_id` FOREIGN KEY (`prodi_id`) REFERENCES `prodi` (`prodi_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `id_member` FOREIGN KEY (`id_member`) REFERENCES `member` (`id_member`),
  ADD CONSTRAINT `kode_buku` FOREIGN KEY (`kode_buku`) REFERENCES `books` (`kode_buku`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
