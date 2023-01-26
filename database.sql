-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 26-Jan-2023 às 14:23
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `database`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `list_accounts`
--

CREATE TABLE `list_accounts` (
  `id` int(11) NOT NULL,
  `nomeBanco` varchar(20) NOT NULL,
  `nomeCliente` varchar(50) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `enderecoCliente` varchar(50) NOT NULL,
  `numeroConta` varchar(10) NOT NULL,
  `numeroAgencia` int(4) NOT NULL,
  `dinheiroConta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `list_accounts`
--

INSERT INTO `list_accounts` (`id`, `nomeBanco`, `nomeCliente`, `cpf`, `enderecoCliente`, `numeroConta`, `numeroAgencia`, `dinheiroConta`) VALUES
(2, 'nu', 'asd', '45432552345', 'gfdshfgh', '123', 42344, 7),
(3, 'nubank', 'gsdfg', '454234', 'gfdshfgh', '123253', 42344, 15),
(4, 'nu', 'asd', '452352', 'agfsd', '321', 132, 38);

-- --------------------------------------------------------

--
-- Estrutura da tabela `list_banks`
--

CREATE TABLE `list_banks` (
  `id` int(11) NOT NULL,
  `nomeBanco` varchar(50) NOT NULL,
  `numeroAgencia` int(4) NOT NULL,
  `endereco` varchar(50) NOT NULL,
  `bandeira` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `list_banks`
--

INSERT INTO `list_banks` (`id`, `nomeBanco`, `numeroAgencia`, `endereco`, `bandeira`) VALUES
(6, 'sadf', 143, 'asdf', 'Visa'),
(8, 'fgsdfg', 123432, 'fasdgfd', 'Mastercard'),
(9, 'fgsdfg', 123432, 'fasdgfd', 'Mastercard'),
(10, 'gfafdsg', 5423, '', 'Mastercard'),
(11, 'gfafdsg', 5423, 'asd', 'Mastercard'),
(12, 'gfafdsg', 5423, 'asd', 'Mastercard'),
(13, 'gdfsd', 12341, 'dgasf', 'Visa'),
(14, 'Nubank', 5556, 'asd', 'Visa'),
(15, 'gdfsd', 12341, 'dgasf', 'Visa'),
(16, 'gdfsd', 12341, 'dgasf', 'Visa'),
(20, 'fsda', 534, 'fgsda', 'Visa'),
(21, 'fsda', 534, 'fgsda', 'Visa'),
(22, 'fsda', 534, 'fgsda', 'Visa'),
(23, 'fsda', 534, 'fgsda', 'Visa'),
(24, 'gdfs', 234, 'asg', 'Visa');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `list_accounts`
--
ALTER TABLE `list_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `list_banks`
--
ALTER TABLE `list_banks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `list_accounts`
--
ALTER TABLE `list_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `list_banks`
--
ALTER TABLE `list_banks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
