-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2021 at 07:35 AM
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
-- Table structure for table `delivery_order`
--

CREATE TABLE `delivery_order` (
  `DO_id` varchar(255) NOT NULL,
  `PO_id` varchar(255) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `delivery_date` date NOT NULL,
  `driver` varchar(255) NOT NULL,
  `armada` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `delivery_order`
--

INSERT INTO `delivery_order` (`DO_id`, `PO_id`, `product_id`, `customer_id`, `delivery_date`, `driver`, `armada`, `quantity`, `unit`, `note`) VALUES
('HAI2004/DO/2021', 'HAI2004/PO/2001', 30002, 1002, '2021-05-19', '', '', 5000, 'Kg', '');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` varchar(255) NOT NULL,
  `PO_id` varchar(255) DEFAULT NULL,
  `DO_id` varchar(255) DEFAULT NULL,
  `other_expenses` varchar(255) DEFAULT NULL,
  `status_pembayaran` smallint(6) DEFAULT NULL,
  `due_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_id`, `PO_id`, `DO_id`, `other_expenses`, `status_pembayaran`, `due_date`) VALUES
('HAI2004/INV/2021', 'HAI2004/PO/2001', 'HAI2004/DO/2021', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `Product_id` int(11) NOT NULL,
  `Product_name` varchar(255) NOT NULL,
  `Product_availability` tinyint(1) NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `Product_price` decimal(10,0) NOT NULL,
  `product_sell_price` decimal(10,0) DEFAULT NULL,
  `unit` varchar(25) DEFAULT NULL,
  `Product_desc` varchar(255) NOT NULL,
  `Product_updated` date NOT NULL,
  `product_quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`Product_id`, `Product_name`, `Product_availability`, `supplier_id`, `Product_price`, `product_sell_price`, `unit`, `Product_desc`, `Product_updated`, `product_quantity`) VALUES
(30001, 'Ammonium Bifluoride', 1, 2001, '200000', NULL, 'Kg', 'Packing = 25 Kg/Bag', '2021-05-04', 35),
(30002, 'Ammonium Bifluoride', 1, 2002, '180000', NULL, 'Kg', 'Packing = 25 Kg/Bag', '2021-05-06', 16),
(30003, 'Ammonium Hydroxide', 1, 2003, '10000', NULL, 'Kg', 'Biaya Kemasan/Kg = Rp 6000', '2021-05-18', 20),
(30004, 'Ammonium Hydroxide', 0, 2004, '9000', NULL, 'Kg', 'Biaya Kemasan/Kg = Rp 4000', '2021-05-05', 0);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order`
--

CREATE TABLE `purchase_order` (
  `PO_id` varchar(255) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `purchase_date` date DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase_order`
--

INSERT INTO `purchase_order` (`PO_id`, `customer_id`, `product_id`, `quantity`, `unit`, `purchase_date`, `note`) VALUES
('HAI0102/PO/2021', 1001, 30001, 10, 'Kg', '2021-05-15', '1. Barang dikirim paling telat tanggal 19 Mei 2021'),
('HAI2004/PO/2001', 1002, 30002, 15, 'Kg', '2021-05-19', '1. Pembayaran 30 Hari setelah barang diterima');

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
-- Indexes for table `delivery_order`
--
ALTER TABLE `delivery_order`
  ADD PRIMARY KEY (`DO_id`),
  ADD KEY `fk_do_customer` (`customer_id`),
  ADD KEY `fk_do_product` (`product_id`),
  ADD KEY `fk_do_po` (`PO_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`),
  ADD KEY `fk_invc_PO` (`PO_id`),
  ADD KEY `fk_invc_DO` (`DO_id`) USING BTREE;

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Product_id`),
  ADD KEY `fk_product` (`supplier_id`);

--
-- Indexes for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD PRIMARY KEY (`PO_id`),
  ADD KEY `fk_po_customer` (`customer_id`),
  ADD KEY `fk_po_product` (`product_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `delivery_order`
--
ALTER TABLE `delivery_order`
  ADD CONSTRAINT `fk_do_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_do_po` FOREIGN KEY (`PO_id`) REFERENCES `purchase_order` (`PO_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_do_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`Product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `fk_in_delivery` FOREIGN KEY (`DO_id`) REFERENCES `delivery_order` (`DO_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_invc_PO` FOREIGN KEY (`PO_id`) REFERENCES `purchase_order` (`PO_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD CONSTRAINT `fk_po_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_po_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`Product_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
