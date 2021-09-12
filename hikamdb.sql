-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2021 at 10:19 AM
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

INSERT INTO `delivery_order` (`DO_id`, `PO_id`, `customer_id`, `delivery_date`, `driver`, `armada`, `quantity`, `unit`, `note`) VALUES
('HAI2004/DO/2021', 'HAI2004/PO/2001', 1002, '2021-05-19', '', '', 5000, 'Kg', '');

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
(1009, 6, 'Ready', '1 Ton/Bag', 'Ton', 'PT Kimia ABC Indonesia', 125000, '2021-09-12 08:14:42');

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
-- Table structure for table `po_line`
--

CREATE TABLE `po_line` (
  `PO_id` varchar(255) NOT NULL,
  `PO_line_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `po_line`
--

INSERT INTO `po_line` (`PO_id`, `PO_line_id`, `product_id`, `quantity`) VALUES
('HAI0102/PO/2021', 1001, 1, 4),
('HAI0102/PO/2021', 1002, 2, 3),
('HAI0102/PO/2021', 1003, 3, 5);

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
(6, 'Nitric Acid', '200000', 'Ton', '1 Ton/Bag', '2021-09-12 08:09:47', 12);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order`
--

CREATE TABLE `purchase_order` (
  `PO_id` varchar(255) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `purchase_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase_order`
--

INSERT INTO `purchase_order` (`PO_id`, `customer_id`, `purchase_date`) VALUES
('HAI0102/PO/2021', 1001, '2021-05-15'),
('HAI2004/PO/2001', 1002, '2021-05-19');

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
  ADD KEY `fk_do_po` (`PO_id`);

--
-- Indexes for table `infoproduct`
--
ALTER TABLE `infoproduct`
  ADD PRIMARY KEY (`infoproduct_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`),
  ADD KEY `fk_invc_PO` (`PO_id`),
  ADD KEY `fk_invc_DO` (`DO_id`) USING BTREE;

--
-- Indexes for table `po_line`
--
ALTER TABLE `po_line`
  ADD PRIMARY KEY (`PO_line_id`),
  ADD KEY `fk_pol_po` (`PO_id`),
  ADD KEY `fk_pol_product` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD PRIMARY KEY (`PO_id`),
  ADD KEY `fk_po_customer` (`customer_id`);

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
  MODIFY `infoproduct_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1010;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `delivery_order`
--
ALTER TABLE `delivery_order`
  ADD CONSTRAINT `fk_do_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_do_po` FOREIGN KEY (`PO_id`) REFERENCES `purchase_order` (`PO_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `fk_in_delivery` FOREIGN KEY (`DO_id`) REFERENCES `delivery_order` (`DO_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_invc_PO` FOREIGN KEY (`PO_id`) REFERENCES `purchase_order` (`PO_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `po_line`
--
ALTER TABLE `po_line`
  ADD CONSTRAINT `fk_pol_po` FOREIGN KEY (`PO_id`) REFERENCES `purchase_order` (`PO_id`),
  ADD CONSTRAINT `fk_pol_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD CONSTRAINT `fk_po_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
