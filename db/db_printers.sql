-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 26, 2019 at 09:55 AM
-- Server version: 5.7.11
-- PHP Version: 7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_printers`
--
CREATE DATABASE IF NOT EXISTS `db_printers`;
USE `db_printers`;

-- --------------------------------------------------------

--
-- Table structure for table `t_brand`
--

CREATE TABLE `t_brand` (
  `idBrand` int(10) UNSIGNED NOT NULL,
  `braName` varchar(50) NOT NULL,
  `idManufacturer` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `t_consumable`
--

CREATE TABLE `t_consumable` (
  `idConsumable` int(10) UNSIGNED NOT NULL,
  `conName` varchar(50) NOT NULL,
  `conPrice` float UNSIGNED NOT NULL,
  `conType` varchar(50) NOT NULL,
  `idBrand` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `t_customer`
--

CREATE TABLE `t_customer` (
  `idCustomer` int(10) UNSIGNED NOT NULL,
  `cusFirstName` varchar(50) NOT NULL,
  `cusLastName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `t_history`
--

CREATE TABLE `t_history` (
  `idHistory` int(10) UNSIGNED NOT NULL,
  `hisDate` date NOT NULL,
  `hisPrice` float UNSIGNED NOT NULL,
  `idProduct` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `t_manufacturer`
--

CREATE TABLE `t_manufacturer` (
  `idManufacturer` int(10) UNSIGNED NOT NULL,
  `manName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `t_product`
--

CREATE TABLE `t_product` (
  `idProduct` int(10) UNSIGNED NOT NULL,
  `proName` varchar(150) NOT NULL,
  `proPrintSpeedBW` float UNSIGNED DEFAULT NULL,
  `proPrintSpeedCol` float UNSIGNED DEFAULT NULL,
  `proPrintResX` int(10) UNSIGNED DEFAULT NULL,
  `proPrintResY` int(10) UNSIGNED DEFAULT NULL,
  `proRectoVerso` char(1) NOT NULL,
  `proColour` char(1) NOT NULL,
  `proPrintTech` varchar(50) NOT NULL,
  `proScanSpeedBW` float UNSIGNED DEFAULT NULL,
  `proScanSpeedCol` float UNSIGNED DEFAULT NULL,
  `proScanResX` int(10) UNSIGNED DEFAULT NULL,
  `proScanResY` int(10) UNSIGNED DEFAULT NULL,
  `proWeight` float UNSIGNED DEFAULT NULL,
  `proLength` float UNSIGNED DEFAULT NULL,
  `proHeight` float UNSIGNED DEFAULT NULL,
  `proWidth` float UNSIGNED DEFAULT NULL,
  `idBrand` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `t_purchase`
--

CREATE TABLE `t_purchase` (
  `idCustomer` int(10) UNSIGNED NOT NULL,
  `idProduct` int(10) UNSIGNED NOT NULL,
  `purDate` date NOT NULL,
  `purPrice` float UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `t_supplier`
--

CREATE TABLE `t_supplier` (
  `idSupplier` int(10) UNSIGNED NOT NULL,
  `supName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `t_supply`
--

CREATE TABLE `t_supply` (
  `idProduct` int(10) UNSIGNED NOT NULL,
  `idSupplier` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `t_use`
--

CREATE TABLE `t_use` (
  `idConsumable` int(10) UNSIGNED NOT NULL,
  `idProduct` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_brand`
--
ALTER TABLE `t_brand`
  ADD PRIMARY KEY (`idBrand`),
  ADD UNIQUE KEY `ID_t_brand_IND` (`idBrand`),
  ADD KEY `FKbuild_IND` (`idManufacturer`);

--
-- Indexes for table `t_consumable`
--
ALTER TABLE `t_consumable`
  ADD PRIMARY KEY (`idConsumable`),
  ADD UNIQUE KEY `ID_t_consumable_IND` (`idConsumable`),
  ADD KEY `FKprovide_IND` (`idBrand`);

--
-- Indexes for table `t_customer`
--
ALTER TABLE `t_customer`
  ADD PRIMARY KEY (`idCustomer`),
  ADD UNIQUE KEY `ID_t_customer_IND` (`idCustomer`);

--
-- Indexes for table `t_history`
--
ALTER TABLE `t_history`
  ADD PRIMARY KEY (`idHistory`),
  ADD UNIQUE KEY `ID_t_history_IND` (`idHistory`),
  ADD KEY `FKhave_IND` (`idProduct`);

--
-- Indexes for table `t_manufacturer`
--
ALTER TABLE `t_manufacturer`
  ADD PRIMARY KEY (`idManufacturer`),
  ADD UNIQUE KEY `ID_t_manufacturer_IND` (`idManufacturer`);

--
-- Indexes for table `t_product`
--
ALTER TABLE `t_product`
  ADD PRIMARY KEY (`idProduct`),
  ADD UNIQUE KEY `ID_t_product_IND` (`idProduct`),
  ADD KEY `FKmarket_IND` (`idBrand`);

--
-- Indexes for table `t_purchase`
--
ALTER TABLE `t_purchase`
  ADD PRIMARY KEY (`idCustomer`,`idProduct`),
  ADD UNIQUE KEY `ID_purchase_IND` (`idCustomer`,`idProduct`),
  ADD KEY `FKpur_t_p_IND` (`idProduct`);

--
-- Indexes for table `t_supplier`
--
ALTER TABLE `t_supplier`
  ADD PRIMARY KEY (`idSupplier`),
  ADD UNIQUE KEY `ID_t_supplier_IND` (`idSupplier`);

--
-- Indexes for table `t_supply`
--
ALTER TABLE `t_supply`
  ADD PRIMARY KEY (`idSupplier`,`idProduct`),
  ADD UNIQUE KEY `ID_supply_IND` (`idSupplier`,`idProduct`),
  ADD KEY `FKsup_t_p_IND` (`idProduct`);

--
-- Indexes for table `t_use`
--
ALTER TABLE `t_use`
  ADD PRIMARY KEY (`idConsumable`,`idProduct`),
  ADD UNIQUE KEY `ID_use_IND` (`idConsumable`,`idProduct`),
  ADD KEY `FKuse_t_p_IND` (`idProduct`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_brand`
--
ALTER TABLE `t_brand`
  MODIFY `idBrand` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_consumable`
--
ALTER TABLE `t_consumable`
  MODIFY `idConsumable` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_customer`
--
ALTER TABLE `t_customer`
  MODIFY `idCustomer` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_history`
--
ALTER TABLE `t_history`
  MODIFY `idHistory` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_manufacturer`
--
ALTER TABLE `t_manufacturer`
  MODIFY `idManufacturer` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_product`
--
ALTER TABLE `t_product`
  MODIFY `idProduct` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_supplier`
--
ALTER TABLE `t_supplier`
  MODIFY `idSupplier` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `t_brand`
--
ALTER TABLE `t_brand`
  ADD CONSTRAINT `FKbuild_FK` FOREIGN KEY (`idManufacturer`) REFERENCES `t_manufacturer` (`idManufacturer`);

--
-- Constraints for table `t_consumable`
--
ALTER TABLE `t_consumable`
  ADD CONSTRAINT `FKprovide_FK` FOREIGN KEY (`idBrand`) REFERENCES `t_brand` (`idBrand`);

--
-- Constraints for table `t_history`
--
ALTER TABLE `t_history`
  ADD CONSTRAINT `FKhave_FK` FOREIGN KEY (`idProduct`) REFERENCES `t_product` (`idProduct`);

--
-- Constraints for table `t_product`
--
ALTER TABLE `t_product`
  ADD CONSTRAINT `FKmarket_FK` FOREIGN KEY (`idBrand`) REFERENCES `t_brand` (`idBrand`);

--
-- Constraints for table `t_purchase`
--
ALTER TABLE `t_purchase`
  ADD CONSTRAINT `FKpur_t_c` FOREIGN KEY (`idCustomer`) REFERENCES `t_customer` (`idCustomer`),
  ADD CONSTRAINT `FKpur_t_p_FK` FOREIGN KEY (`idProduct`) REFERENCES `t_product` (`idProduct`);

--
-- Constraints for table `t_supply`
--
ALTER TABLE `t_supply`
  ADD CONSTRAINT `FKsup_t_p_FK` FOREIGN KEY (`idProduct`) REFERENCES `t_product` (`idProduct`),
  ADD CONSTRAINT `FKsup_t_s` FOREIGN KEY (`idSupplier`) REFERENCES `t_supplier` (`idSupplier`);

--
-- Constraints for table `t_use`
--
ALTER TABLE `t_use`
  ADD CONSTRAINT `FKuse_t_c` FOREIGN KEY (`idConsumable`) REFERENCES `t_consumable` (`idConsumable`),
  ADD CONSTRAINT `FKuse_t_p_FK` FOREIGN KEY (`idProduct`) REFERENCES `t_product` (`idProduct`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
