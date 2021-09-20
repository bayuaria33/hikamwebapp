-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2021 at 11:27 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hikamdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `alamat1` varchar(255) NOT NULL,
  `alamat2` varchar(255) NOT NULL,
  `no_telp1` varchar(255) NOT NULL,
  `no_telp2` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `alamat1`, `alamat2`, `no_telp1`, `no_telp2`, `email`) VALUES
(1001, 'PT Ahmad Prasetyo Industri', 'Jl. Jalan no.123 Blok Z Kota Bekasi', '', '0812345678', '', 'ahpras@ahpras.com'),
(1002, 'PT Jaki Yuhari Maju', 'Jl. Jalan no.234 Blok X Jakarta', '', '081122334455', '', 'Jari@Jari.com'),
(1003, 'PT Hakim Abadi Nusantara', 'Jl. Boulevard no.39 Bekasi Selatan', '', '02182737617', '', 'hikamindo@hikamindo.com'),
(1004, 'PT Aldi Jaya Chemical', 'Jl. tol Kabupaten no. 10', '', '02112312323', '', 'alditaher@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `infoproduct`
--

CREATE TABLE `infoproduct` (
  `infoproduct_id` int(4) NOT NULL,
  `product_id` int(4) NOT NULL,
  `product_avb` varchar(25) NOT NULL,
  `product_desc` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `supplier_name` varchar(25) NOT NULL,
  `product_price` int(20) NOT NULL,
  `product_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `infoproduct`
--

INSERT INTO `infoproduct` (`infoproduct_id`, `product_id`, `product_avb`, `product_desc`, `unit`, `supplier_name`, `product_price`, `product_updated`) VALUES
(1001, 1, 'Ready', 'Packing = 30 Kg/Bag', 'Kg', 'PT Kimia ABC Indonesia', 125000, '2021-09-12 08:03:07'),
(1002, 1, 'Ready', 'Packing = 25 Kg/Bag', 'Kg', 'Alchemindo XYZ', 120000, '2021-09-12 07:47:44'),
(1003, 2, 'Ready', 'Packing = 25 Kg/Bag', 'Kg', 'PT Kimia ABC Indonesia', 150000, '2021-09-12 07:47:44'),
(1004, 2, 'Ready', 'Packing = 25 Kg/Bag', 'Kg', 'Alchemindo XYZ', 130000, '2021-09-12 07:47:44'),
(1005, 3, 'Ready', 'Packing = 25 Kg/Bag', 'Kg', 'PT Kimia ABC Indonesia', 10000, '2021-09-12 07:47:44'),
(1006, 4, 'Ready', 'Packing = 25 Kg/Bag', 'Kg', 'PT Permata Kimia ', 90000, '2021-09-12 07:47:44'),
(1007, 4, 'Ready', 'Packing = 25 Kg/Bag', 'Kg', 'Alchemindo XYZ', 120000, '2021-09-12 07:47:44'),
(1008, 5, 'Ready', 'Packing = 25 Kg/Bag', 'Kg', 'PT Kimia ABC Indonesia', 20000, '2021-09-12 07:47:44'),
(1009, 6, 'Ready', '1 Ton/Bag', 'Ton', 'PT Kimia ABC Indonesia', 125000, '2021-09-12 08:14:42'),
(1010, 7, 'Ready', '1 Kg/Bag', 'Kg', 'PT Kimia ABC Indonesia', 45000, '2021-09-13 17:00:00'),
(1011, 7, 'Ready', '1 Kg/Bag', 'Kg', 'Alchemindo XYZ', 48000, '2021-09-13 17:00:00'),
(1012, 7, 'Ready', '1 Kg/Bag', 'Kg', 'PT Berlian Chemicals ', 42000, '2021-09-15 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `invc_item`
--

CREATE TABLE `invc_item` (
  `invc_item_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invc_item`
--

INSERT INTO `invc_item` (`invc_item_id`, `invoice_id`, `product_id`, `quantity`, `price`) VALUES
(1001, 2004, 1, 5, '25000'),
(1002, 2004, 2, 3, '24000'),
(1003, 2004, 6, 2, '200000'),
(1004, 2005, 1, 1, '1'),
(1005, 2005, 2, 2, '2'),
(1006, 2005, 3, 3, '3'),
(1007, 2006, 1, 1, '1'),
(1008, 2006, 2, 2, '2'),
(1009, 2006, 3, 3, '3'),
(1010, 2006, 4, 4, '4'),
(1011, 2004, 3, 3, '3'),
(1012, 2004, 7, 7, '7');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` int(11) NOT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `invoice_date` date DEFAULT NULL,
  `other_expenses` varchar(255) DEFAULT NULL,
  `status_pembayaran` varchar(12) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `PO_id` int(11) DEFAULT NULL,
  `DO_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_id`, `customer_name`, `invoice_date`, `other_expenses`, `status_pembayaran`, `due_date`, `PO_id`, `DO_id`) VALUES
(2004, 'PT Ahmad Prasetyo Industri', '2021-09-01', 'Tidak ada', 'Lunas', '2021-08-31', 0, 0),
(2005, 'PT Jaki Yuhari Maju', '2021-09-03', 'none', 'Lunas', '2021-09-01', 0, 0),
(2006, 'PT Hakim Abadi Nusantara', '2021-08-29', 'Tidak ada', 'Lunas', '2021-09-04', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_sell_price` decimal(10,0) DEFAULT NULL,
  `unit` varchar(25) DEFAULT NULL,
  `product_desc` varchar(255) NOT NULL,
  `product_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `product_quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_sell_price`, `unit`, `product_desc`, `product_updated`, `product_quantity`) VALUES
(1, 'Ammonium Bifluoride UH', '25000', 'liter', 'Packing = 25 Kg/Bag', '2021-08-30 07:04:10', 35),
(2, 'Ammonium Bifluoride BK', '24000', 'Kg', 'Packing = 25 Kg/Bag', '2021-05-05 17:00:00', 16),
(3, 'Ammonium Hydroxide NO', '13000', 'Kg', 'Biaya Kemasan/Kg = Rp 6000', '2021-05-17 17:00:00', 20),
(4, 'Ammonium Hydroxide ACL', '75000', 'liter', 'Biaya Kemasan/Kg = Rp 4000', '2021-06-21 07:21:58', 10),
(5, 'asam nitrat', '200000', 'liter', 'Packing = 25 Kg/Bag', '2021-08-30 07:05:01', 30),
(6, 'Nitric Acid', '200000', 'Ton', '1 Ton/Bag', '2021-09-12 08:09:47', 12),
(7, 'Kalsium Hipoklorit', '50000', 'Kg', '1Kg/Bag', '2021-09-14 09:24:54', 5);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `sales_name` varchar(255) NOT NULL,
  `norek1` varchar(255) NOT NULL,
  `norek2` varchar(255) NOT NULL,
  `alamat1` varchar(255) NOT NULL,
  `alamat2` varchar(255) NOT NULL,
  `no_telp1` varchar(255) NOT NULL,
  `no_telp2` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier_name`, `sales_name`, `norek1`, `norek2`, `alamat1`, `alamat2`, `no_telp1`, `no_telp2`, `email`) VALUES
(2001, 'PT Kimia ABC Indonesia', 'Dodi', '012 234 4566', '233 334 4456', 'Jl. Tangkuban Perahu Perumahan ABC Kota Bandung', '', '021 22334455', '', 'dodi@kimiaabc.com'),
(2002, 'Alchemindo XYZ', 'Zulkifar', '445 556 1234', '', 'Jl. Berlian XYZ Kota Depok', '', '021 98798766', '', 'zul@alchemindo.com'),
(2003, 'PT Taromono ID ', 'Lutfi', '111 222 3334', '', 'Jl. Proyek No.22 Kalimalang ', '', '021 12233456', '', 'lutfi@tarmoindustri.com'),
(2004, 'PT Berlian Chemicals ', 'Jodi', '444 333 2221', '', 'Jl. Utama Jakarta Pusat DKI', '', '021 99887766', '', 'Jodi@berlianchem.com'),
(2005, 'PT Permata Kimia ', 'Boy', '999 223 3455', '', 'Jl. Panglima ABC no.2 Jakarta Timur', '', '02108232380', '', 'boy@permatakimia.com');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_name` varchar(255) NOT NULL,
  `level_user` int(11) NOT NULL,
  `departemen` int(11) NOT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `infoproduct`
--
ALTER TABLE `infoproduct`
  ADD PRIMARY KEY (`infoproduct_id`);

--
-- Indexes for table `invc_item`
--
ALTER TABLE `invc_item`
  ADD PRIMARY KEY (`invc_item_id`),
  ADD KEY `fk_invcit_invc` (`invoice_id`),
  ADD KEY `fk_invcit_product` (`product_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `infoproduct`
--
ALTER TABLE `infoproduct`
  MODIFY `infoproduct_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1013;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invc_item`
--
ALTER TABLE `invc_item`
  ADD CONSTRAINT `fk_invcit_invc` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`invoice_id`),
  ADD CONSTRAINT `fk_invcit_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
