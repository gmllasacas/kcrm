-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2021 at 06:12 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kcrm`
--

-- --------------------------------------------------------

--
-- Table structure for table `proceso_categoria_producto`
--

CREATE TABLE `proceso_categoria_producto` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `proceso_categoria_producto`
--

INSERT INTO `proceso_categoria_producto` (`id`, `descripcion`, `estado`) VALUES
(1, 'Abarrotes', 1),
(2, 'Limpieza', 1),
(3, 'Belleza', 1);

-- --------------------------------------------------------

--
-- Table structure for table `proceso_producto`
--

CREATE TABLE `proceso_producto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `referencia` varchar(255) NOT NULL,
  `precio` int(11) NOT NULL,
  `peso` int(11) NOT NULL,
  `categoria` int(11) DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `fecha_ultima_venta` datetime DEFAULT NULL,
  `estado` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `proceso_venta`
--

CREATE TABLE `proceso_venta` (
  `id` int(11) NOT NULL,
  `producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `proceso_categoria_producto`
--
ALTER TABLE `proceso_categoria_producto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `proceso_producto`
--
ALTER TABLE `proceso_producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_tipo` (`categoria`);

--
-- Indexes for table `proceso_venta`
--
ALTER TABLE `proceso_venta`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `proceso_categoria_producto`
--
ALTER TABLE `proceso_categoria_producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `proceso_producto`
--
ALTER TABLE `proceso_producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `proceso_venta`
--
ALTER TABLE `proceso_venta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `proceso_producto`
--
ALTER TABLE `proceso_producto`
  ADD CONSTRAINT `producto_tipo` FOREIGN KEY (`categoria`) REFERENCES `proceso_categoria_producto` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
