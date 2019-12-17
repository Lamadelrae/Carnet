-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2019 at 12:41 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carnet`
--

-- --------------------------------------------------------

--
-- Table structure for table `contratos`
--

CREATE TABLE `contratos` (
  `id_contrato` int(55) NOT NULL,
  `contrato_CPF` varchar(55) NOT NULL,
  `contrato_CNPJ` varchar(55) NOT NULL,
  `numero_contrato` varchar(44) NOT NULL,
  `contrato_pdf` varchar(244) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id_parcela` int(55) NOT NULL,
  `Parcela_Valor` varchar(55) NOT NULL,
  `Parcela_Status` varchar(55) NOT NULL,
  `cnpj` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(55) NOT NULL,
  `cnpj` varchar(55) NOT NULL,
  `password` varchar(55) NOT NULL,
  `parcelas` int(55) NOT NULL,
  `valor_total_parcelas` varchar(55) NOT NULL,
  `boleto` varchar(144) NOT NULL,
  `numero_contrato` varchar(44) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_investidor`
--

CREATE TABLE `user_investidor` (
  `id` int(11) NOT NULL,
  `cpf` varchar(55) NOT NULL,
  `password` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contratos`
--
ALTER TABLE `contratos`
  ADD PRIMARY KEY (`id_contrato`,`contrato_CNPJ`,`contrato_CPF`,`numero_contrato`),
  ADD KEY `contrato_CPF` (`contrato_CPF`),
  ADD KEY `numero_contrato` (`numero_contrato`),
  ADD KEY `contrato_CNPJ` (`contrato_CNPJ`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_parcela`,`cnpj`),
  ADD KEY `Parcela_cnpj` (`cnpj`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`,`cnpj`,`parcelas`,`numero_contrato`),
  ADD UNIQUE KEY `id` (`id`,`cnpj`,`parcelas`,`numero_contrato`),
  ADD KEY `parcelas` (`parcelas`),
  ADD KEY `cnpj` (`cnpj`),
  ADD KEY `numero_contrato` (`numero_contrato`);

--
-- Indexes for table `user_investidor`
--
ALTER TABLE `user_investidor`
  ADD PRIMARY KEY (`id`,`cpf`),
  ADD KEY `cpf` (`cpf`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contratos`
--
ALTER TABLE `contratos`
  MODIFY `id_contrato` int(55) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id_parcela` int(55) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(55) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_investidor`
--
ALTER TABLE `user_investidor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contratos`
--
ALTER TABLE `contratos`
  ADD CONSTRAINT `contratos_ibfk_2` FOREIGN KEY (`contrato_CPF`) REFERENCES `user_investidor` (`cpf`),
  ADD CONSTRAINT `contratos_ibfk_3` FOREIGN KEY (`numero_contrato`) REFERENCES `users` (`numero_contrato`),
  ADD CONSTRAINT `contratos_ibfk_4` FOREIGN KEY (`contrato_CNPJ`) REFERENCES `users` (`cnpj`);

--
-- Constraints for table `status`
--
ALTER TABLE `status`
  ADD CONSTRAINT `status_ibfk_1` FOREIGN KEY (`cnpj`) REFERENCES `users` (`cnpj`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
