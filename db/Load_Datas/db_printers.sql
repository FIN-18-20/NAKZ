-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mar 03 Décembre 2019 à 09:44
-- Version du serveur :  5.7.11
-- Version de PHP :  7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `db_printers`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_brand`
--

CREATE TABLE `t_brand` (
  `idBrand` int(10) UNSIGNED NOT NULL,
  `braName` varchar(50) NOT NULL,
  `idManufacturer` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_brand`
--

INSERT INTO `t_brand` (`idBrand`, `braName`, `idManufacturer`) VALUES
(1, 'HP', 1),
(2, 'Canon', 2),
(3, 'Kyocera', 3),
(4, 'Brother', 4),
(5, 'Epson', 5),
(6, 'Xerox', 6),
(7, 'OKI', 7),
(8, 'Samsung', 8);

-- --------------------------------------------------------

--
-- Structure de la table `t_consumable`
--

CREATE TABLE `t_consumable` (
  `idConsumable` int(10) UNSIGNED NOT NULL,
  `conName` varchar(50) NOT NULL,
  `conPrice` float UNSIGNED NOT NULL,
  `conType` varchar(50) NOT NULL,
  `idBrand` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_consumable`
--

INSERT INTO `t_consumable` (`idConsumable`, `conName`, `conPrice`, `conType`, `idBrand`) VALUES
(1, '415A (C)', 128, 'Toner', 1),
(2, '415A (CF)', 99.8, 'Toner', 1),
(3, '415A (M)', 112, 'Toner', 1),
(4, '415A (Y)', 117, 'Toner', 1),
(5, '054 H (CF)', 102, 'Toner', 2),
(6, '054 H (C)', 107, 'Toner', 2),
(7, '054 H (M)', 107, 'Toner', 2),
(8, '054 H (Y)', 107, 'Toner', 2),
(9, 'TK-5240 (CF)', 61, 'Toner', 3),
(10, 'TK-5240 (C)', 89.6, 'Toner', 3),
(11, 'TK-5240 (M)', 89.7, 'Toner', 3),
(12, '203X (CF)', 86.5, 'Toner', 1),
(13, '973X (CF)', 99.6, 'Cartouche d\'encre', 1),
(14, 'TN-243BK (CF)', 51.6, 'Toner', 4),
(15, '102 EcoTank (C)', 12.5, 'Cartouche d\'encre', 5),
(16, 'Epson EcoTank unlimited printing', 47.1, 'Abonnement', 5),
(17, '410X (Y,M,C)', 479, 'Toner', 1),
(18, '106R03480 (CF)', 126, 'Toner', 6),
(19, 'Xerox Waste Toner Cartridge', 31.4, 'Rechange', 6),
(20, 'GI-50 (Y)', 14.7, 'Cartouche d\'encre', 2),
(21, '102 EcoTank (CF)', 20.3, 'Cartouche d\'encre', 5),
(22, '45862840 (CF)', 57.1, 'Toner', 7),
(23, 'OKI Transport Band C822', 106, 'Rechange', 7),
(24, '054 H (CF)', 102, 'Toner', 2),
(25, 'CLT-P404C (Y,M,C,CF)', 157, 'Toner', 8),
(26, 'TN-243 Multipack (Y,M,C,CF)', 158, 'Toner', 4),
(27, 'TN-910BK (CF)', 98.3, 'Toner', 4),
(28, 'LC-3219XlBK (CF)', 34.6, 'Cartouche d\'encre', 4),
(29, '953-XL Multipack (Y,M,C,CF)', 107, 'Cartouche d\'encre', 1),
(30, 'HP Q2510A', 26, 'Papier photo', 1),
(31, 'TN-910BK (CF)', 98.3, 'Toner', 4),
(32, '33XL Claria Premium Multipack (Y,M,C,CF)', 89.3, 'Cartouche d\'encre', 5);

-- --------------------------------------------------------

--
-- Structure de la table `t_customer`
--

CREATE TABLE `t_customer` (
  `idCustomer` int(10) UNSIGNED NOT NULL,
  `cusFirstName` varchar(50) NOT NULL,
  `cusLastName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_customer`
--

INSERT INTO `t_customer` (`idCustomer`, `cusFirstName`, `cusLastName`) VALUES
(1, 'John', 'Lennon');

-- --------------------------------------------------------

--
-- Structure de la table `t_history`
--

CREATE TABLE `t_history` (
  `idHistory` int(10) UNSIGNED NOT NULL,
  `hisDate` date NOT NULL,
  `hisPrice` float UNSIGNED NOT NULL,
  `idProduct` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_history`
--

INSERT INTO `t_history` (`idHistory`, `hisDate`, `hisPrice`, `idProduct`) VALUES
(1, '2019-12-03', 799.99, 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_manufacturer`
--

CREATE TABLE `t_manufacturer` (
  `idManufacturer` int(10) UNSIGNED NOT NULL,
  `manName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_manufacturer`
--

INSERT INTO `t_manufacturer` (`idManufacturer`, `manName`) VALUES
(1, 'HP'),
(2, 'Canon'),
(3, 'Kyocera'),
(4, 'Brother'),
(5, 'Epson'),
(6, 'Xerox'),
(7, 'OKI'),
(8, 'Samsung');

-- --------------------------------------------------------

--
-- Structure de la table `t_product`
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

--
-- Contenu de la table `t_product`
--

INSERT INTO `t_product` (`idProduct`, `proName`, `proPrintSpeedBW`, `proPrintSpeedCol`, `proPrintResX`, `proPrintResY`, `proRectoVerso`, `proColour`, `proPrintTech`, `proScanSpeedBW`, `proScanSpeedCol`, `proScanResX`, `proScanResY`, `proWeight`, `proLength`, `proHeight`, `proWidth`, `idBrand`) VALUES
(1, 'Color LaserJet Pro M479fdw', 27, 27, 600, 600, 'Y', 'Y', 'Laser', 26, 21, 1200, 1200, 23.4, 47.2, 40, 41.6, 1),
(2, 'i-SENSYS MF643Cdw', 21, 21, 1200, 1200, 'Y', 'Y', 'Laser', 27, 14, 600, 600, 20, 46, 40, 45.1, 2),
(3, 'Ecosys M5526cdw', 26, 26, 1200, 1200, 'Y', 'Y', 'Laser', 30, 23, 600, 600, 26, 42.9, 49.5, 41.7, 3),
(4, 'Color LaserJet Pro M281fdw', 18, 18, 600, 600, 'Y', 'Y', 'Laser', 21, 21, 1200, 1200, 18.7, 42.1, 33.4, 42, 1),
(5, 'PageWide Pro 477dw', 40, 40, 2400, 1200, 'Y', 'Y', 'Laser', 25, 25, 1200, 1200, 22.15, 40.7, 46.7, 53, 1),
(6, 'DCP-L3510CDW', 18, 18, 600, 2400, 'Y', 'Y', 'Laser', 32.6, 25.1, 1200, 2400, 25.6, 52.3, 52.1, 58.9, 4),
(7, 'EcoTank ET-3750', 15, 8, 4800, 1200, 'Y', 'Y', 'Ink', 0, 0, 1200, 2400, 6.7, 34.7, 23.1, 37.5, 5),
(8, 'Color LaserJet Pro M477fnw', 28, 27, 600, 600, 'Y', 'Y', 'Laser', 26, 21, 1200, 1200, 21.8, 45.9, 40, 41.6, 1),
(9, 'WorkCentre 6515V/DNI', 28, 28, 1200, 2400, 'Y', 'Y', 'Laser', 28, 28, 600, 600, 30.7, 50.6, 50, 42, 6),
(10, 'PIXMA Megatank G6050', 13, 6.8, 4800, 1200, 'Y', 'Y', 'Ink', 0, 0, 1200, 2400, 8.1, 36.9, 19.5, 45.5, 2),
(11, 'EcoTank ET-2750', 10, 5.5, 5760, 1440, 'Y', 'Y', 'Ink', 11, 28, 1200, 2400, 5.5, 34.7, 18.7, 37.5, 5),
(12, 'MC853dnct', 23, 23, 1200, 600, 'Y', 'Y', 'Laser', 50, 50, 600, 600, 93.4, 60, 121.6, 56.3, 7),
(13, 'i-SENSYS MF645Cx', 21, 21, 1200, 1200, 'Y', 'Y', 'Laser', 47, 27, 600, 600, 22.6, 46, 41.3, 45.1, 2),
(14, 'SL-C480W', 18, 4, 2400, 600, 'N', 'Y', 'Laser', 4.2, 1.6, 1200, 1200, 12.89, 36.2, 28.86, 40.6, 8),
(15, 'MFC-L3770CDW', 24, 24, 2400, 600, 'Y', 'Y', 'Laser', 27, 21, 2400, 1200, 24.5, 50.9, 41.4, 41, 4),
(16, 'MFC-L9570CDWT', 31, 31, 2400, 600, 'Y', 'Y', 'Laser', 28, 28, 1200, 600, 42.6, 52.6, 54.9, 49.5, 4),
(17, 'MFC-L2710DW', 30, 0, 2400, 600, 'Y', 'N', 'Laser', 18, 18, 1200, 2400, 11.8, 39.85, 31.85, 41, 4),
(18, 'OfficeJet Pro 7740', 22, 18, 4800, 1200, 'Y', 'Y', 'Laser', 33, 31, 600, 600, 19.5, 46.69, 38.33, 58.4, 1),
(19, 'MFC-L9570CDW', 31, 31, 2400, 600, 'Y', 'Y', 'Laser', 28, 28, 1200, 600, 36, 68, 72, 65, 4),
(20, 'Expression Premium XP-7100', 15, 11, 5760, 1440, 'Y', 'Y', 'Ink', 0, 0, 1200, 4800, 8.2, 33.9, 19.1, 39, 5);

-- --------------------------------------------------------

--
-- Structure de la table `t_purchase`
--

CREATE TABLE `t_purchase` (
  `idCustomer` int(10) UNSIGNED NOT NULL,
  `idProduct` int(10) UNSIGNED NOT NULL,
  `purDate` date NOT NULL,
  `purPrice` float UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_purchase`
--

INSERT INTO `t_purchase` (`idCustomer`, `idProduct`, `purDate`, `purPrice`) VALUES
(1, 1, '2019-12-03', 599.99);

-- --------------------------------------------------------

--
-- Structure de la table `t_supplier`
--

CREATE TABLE `t_supplier` (
  `idSupplier` int(10) UNSIGNED NOT NULL,
  `supName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_supply`
--

CREATE TABLE `t_supply` (
  `idProduct` int(10) UNSIGNED NOT NULL,
  `idSupplier` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_use`
--

CREATE TABLE `t_use` (
  `idConsumable` int(10) UNSIGNED NOT NULL,
  `idProduct` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_use`
--

INSERT INTO `t_use` (`idConsumable`, `idProduct`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 3),
(10, 3),
(11, 3),
(12, 4),
(13, 5),
(14, 6),
(15, 7),
(16, 7),
(17, 8),
(18, 9),
(19, 9),
(20, 10),
(21, 11),
(22, 12),
(23, 12),
(24, 13),
(25, 14),
(26, 15),
(27, 16),
(28, 17),
(29, 18),
(30, 18),
(31, 19),
(32, 20);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `t_brand`
--
ALTER TABLE `t_brand`
  ADD PRIMARY KEY (`idBrand`),
  ADD UNIQUE KEY `ID_t_brand_IND` (`idBrand`),
  ADD KEY `FKbuild_IND` (`idManufacturer`);

--
-- Index pour la table `t_consumable`
--
ALTER TABLE `t_consumable`
  ADD PRIMARY KEY (`idConsumable`),
  ADD UNIQUE KEY `ID_t_consumable_IND` (`idConsumable`),
  ADD KEY `FKprovide_IND` (`idBrand`);

--
-- Index pour la table `t_customer`
--
ALTER TABLE `t_customer`
  ADD PRIMARY KEY (`idCustomer`),
  ADD UNIQUE KEY `ID_t_customer_IND` (`idCustomer`);

--
-- Index pour la table `t_history`
--
ALTER TABLE `t_history`
  ADD PRIMARY KEY (`idHistory`),
  ADD UNIQUE KEY `ID_t_history_IND` (`idHistory`),
  ADD KEY `FKhave_IND` (`idProduct`);

--
-- Index pour la table `t_manufacturer`
--
ALTER TABLE `t_manufacturer`
  ADD PRIMARY KEY (`idManufacturer`),
  ADD UNIQUE KEY `ID_t_manufacturer_IND` (`idManufacturer`);

--
-- Index pour la table `t_product`
--
ALTER TABLE `t_product`
  ADD PRIMARY KEY (`idProduct`),
  ADD UNIQUE KEY `ID_t_product_IND` (`idProduct`),
  ADD KEY `FKmarket_IND` (`idBrand`);

--
-- Index pour la table `t_purchase`
--
ALTER TABLE `t_purchase`
  ADD PRIMARY KEY (`idCustomer`,`idProduct`),
  ADD UNIQUE KEY `ID_purchase_IND` (`idCustomer`,`idProduct`),
  ADD KEY `FKpur_t_p_IND` (`idProduct`);

--
-- Index pour la table `t_supplier`
--
ALTER TABLE `t_supplier`
  ADD PRIMARY KEY (`idSupplier`),
  ADD UNIQUE KEY `ID_t_supplier_IND` (`idSupplier`);

--
-- Index pour la table `t_supply`
--
ALTER TABLE `t_supply`
  ADD PRIMARY KEY (`idSupplier`,`idProduct`),
  ADD UNIQUE KEY `ID_supply_IND` (`idSupplier`,`idProduct`),
  ADD KEY `FKsup_t_p_IND` (`idProduct`);

--
-- Index pour la table `t_use`
--
ALTER TABLE `t_use`
  ADD PRIMARY KEY (`idConsumable`,`idProduct`),
  ADD UNIQUE KEY `ID_use_IND` (`idConsumable`,`idProduct`),
  ADD KEY `FKuse_t_p_IND` (`idProduct`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `t_brand`
--
ALTER TABLE `t_brand`
  MODIFY `idBrand` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `t_consumable`
--
ALTER TABLE `t_consumable`
  MODIFY `idConsumable` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT pour la table `t_customer`
--
ALTER TABLE `t_customer`
  MODIFY `idCustomer` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `t_history`
--
ALTER TABLE `t_history`
  MODIFY `idHistory` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `t_manufacturer`
--
ALTER TABLE `t_manufacturer`
  MODIFY `idManufacturer` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `t_product`
--
ALTER TABLE `t_product`
  MODIFY `idProduct` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT pour la table `t_supplier`
--
ALTER TABLE `t_supplier`
  MODIFY `idSupplier` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `t_brand`
--
ALTER TABLE `t_brand`
  ADD CONSTRAINT `FKbuild_FK` FOREIGN KEY (`idManufacturer`) REFERENCES `t_manufacturer` (`idManufacturer`);

--
-- Contraintes pour la table `t_consumable`
--
ALTER TABLE `t_consumable`
  ADD CONSTRAINT `FKprovide_FK` FOREIGN KEY (`idBrand`) REFERENCES `t_brand` (`idBrand`);

--
-- Contraintes pour la table `t_history`
--
ALTER TABLE `t_history`
  ADD CONSTRAINT `FKhave_FK` FOREIGN KEY (`idProduct`) REFERENCES `t_product` (`idProduct`);

--
-- Contraintes pour la table `t_product`
--
ALTER TABLE `t_product`
  ADD CONSTRAINT `FKmarket_FK` FOREIGN KEY (`idBrand`) REFERENCES `t_brand` (`idBrand`);

--
-- Contraintes pour la table `t_purchase`
--
ALTER TABLE `t_purchase`
  ADD CONSTRAINT `FKpur_t_c` FOREIGN KEY (`idCustomer`) REFERENCES `t_customer` (`idCustomer`),
  ADD CONSTRAINT `FKpur_t_p_FK` FOREIGN KEY (`idProduct`) REFERENCES `t_product` (`idProduct`);

--
-- Contraintes pour la table `t_supply`
--
ALTER TABLE `t_supply`
  ADD CONSTRAINT `FKsup_t_p_FK` FOREIGN KEY (`idProduct`) REFERENCES `t_product` (`idProduct`),
  ADD CONSTRAINT `FKsup_t_s` FOREIGN KEY (`idSupplier`) REFERENCES `t_supplier` (`idSupplier`);

--
-- Contraintes pour la table `t_use`
--
ALTER TABLE `t_use`
  ADD CONSTRAINT `FKuse_t_c` FOREIGN KEY (`idConsumable`) REFERENCES `t_consumable` (`idConsumable`),
  ADD CONSTRAINT `FKuse_t_p_FK` FOREIGN KEY (`idProduct`) REFERENCES `t_product` (`idProduct`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
