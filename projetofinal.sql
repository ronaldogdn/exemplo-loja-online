-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 01-Dez-2018 às 19:12
-- Versão do servidor: 10.1.36-MariaDB
-- versão do PHP: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projetofinal`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cidade`
--

CREATE TABLE `cidade` (
  `ID` int(11) NOT NULL,
  `ID_ESTADO` int(11) NOT NULL,
  `NOME` varchar(200) DEFAULT NULL,
  `SIGLA` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `ID` int(11) NOT NULL,
  `NOME` varchar(80) DEFAULT NULL,
  `CPF` varchar(15) DEFAULT NULL,
  `IDADE` int(11) DEFAULT NULL,
  `DTNASCIMENTO` date DEFAULT NULL,
  `id_pais` int(11) DEFAULT NULL,
  `login` varchar(15) DEFAULT NULL,
  `senha` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `estado`
--

CREATE TABLE `estado` (
  `ID` int(11) NOT NULL,
  `NOME` varchar(200) DEFAULT NULL,
  `SIGLA` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `item_pedido`
--

CREATE TABLE `item_pedido` (
  `ID` int(11) NOT NULL,
  `ID_PRODUTO` int(11) DEFAULT NULL,
  `ID_PEDIDO` int(11) DEFAULT NULL,
  `QUANTIDADE` int(11) DEFAULT NULL,
  `VALOR_UNITARIO` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

CREATE TABLE `pedido` (
  `ID` int(11) NOT NULL,
  `ID_CLIENTE` int(11) DEFAULT NULL,
  `VALOR_TOTAL` decimal(10,2) DEFAULT NULL,
  `DT_COMPRA` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `ID` int(11) NOT NULL,
  `NOME` varchar(200) DEFAULT NULL,
  `QUANTIDADE` int(11) DEFAULT NULL,
  `VALOR` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendedores`
--

CREATE TABLE `vendedores` (
  `ID` int(11) NOT NULL,
  `NOME` varchar(80) DEFAULT NULL,
  `CPF` varchar(15) DEFAULT NULL,
  `IDADE` int(11) DEFAULT NULL,
  `DTNASCIMENTO` date DEFAULT NULL,
  `login` varchar(15) DEFAULT NULL,
  `senha` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cidade`
--
ALTER TABLE `cidade`
  ADD KEY `fk_cidade_id_estado` (`ID_ESTADO`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `item_pedido`
--
ALTER TABLE `item_pedido`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_item_pedido_id_pedido` (`ID_PEDIDO`),
  ADD KEY `fk_item_pedido_id_produto` (`ID_PRODUTO`);

--
-- Indexes for table `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_CLIENTE` (`ID_CLIENTE`);

--
-- Indexes for table `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `vendedores`
--
ALTER TABLE `vendedores`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_pedido`
--
ALTER TABLE `item_pedido`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pedido`
--
ALTER TABLE `pedido`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendedores`
--
ALTER TABLE `vendedores`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `cidade`
--
ALTER TABLE `cidade`
  ADD CONSTRAINT `fk_cidade_id_estado` FOREIGN KEY (`ID_ESTADO`) REFERENCES `estado` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `item_pedido`
--
ALTER TABLE `item_pedido`
  ADD CONSTRAINT `fk_item_pedido_id_produto` FOREIGN KEY (`ID_PRODUTO`) REFERENCES `produto` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `fk_pedido_id_cliente` FOREIGN KEY (`ID_CLIENTE`) REFERENCES `cliente` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
