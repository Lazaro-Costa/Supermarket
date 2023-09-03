  -- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30/08/2023 às 14:32
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cadastro`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `empresa`
--

CREATE TABLE `empresa` (
  `id` int(11) NOT NULL,
  `nome_emp` varchar(255) NOT NULL,
  `end` varchar(255) DEFAULT NULL,
  `cidade` varchar(255) DEFAULT NULL,
  `num_lojas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `empresa`
--

INSERT INTO `empresa` (`id`, `nome_emp`, `end`, `cidade`, `num_lojas`) VALUES
(1, 'Supermercado Walmart', 'Rua das Laranjeiras, 220', 'Cidade de Deus', 5),
(2, 'Hipermercado Rodrigo', 'Rua das Flores', 'Cidade Imperador Paulo I', 3),
(5, 'Minimercado Souza e Silva', 'Rua Maria Aparecida, 234', 'São Paulo', 5),
(6, 'Rede Smart', 'Av. Olinda. 34', 'Salvador', 8),
(7, 'Supermercado Estrela Dalva', 'Rua das Lamentações, 26', 'Cajazeiras', 4),
(9, 'Megamercado Aespa', 'Rua Kwangya, 298', 'Seul', 34),
(10, 'Empresa de Produtos Alimentícios', 'Rua Capitão Antonio Carlos, 255', 'São Domingos', 14),
(12, 'JYP Enterteiniment', 'JYP Center, 205', 'Gangdongdae-ro', 14);

-- --------------------------------------------------------

--
-- Estrutura para tabela `estoque`
--

CREATE TABLE `estoque` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `prod_id` int(11) DEFAULT NULL,
  `preco` decimal(10,2) DEFAULT NULL,
  `prod_quant` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `estoque`
--

INSERT INTO `estoque` (`id`, `emp_id`, `prod_id`, `preco`, `prod_quant`) VALUES
(1, 1, 1, 9.45, 15),
(2, 9, 2, 3.99, 32),
(3, 9, 1, 7.50, 15),
(4, 12, 2, 3.99, 5),
(5, 2, 2, 2.95, 8),
(6, 6, 4, 16.90, 14),
(7, 5, 3, 13.33, 5),
(17, 6, 2, 12.93, 3),
(22, 1, 3, 13.15, 4),
(37, 7, 1, 7.34, 4),
(38, 9, 3, 14.55, 14),
(39, 9, 4, 13.87, 23),
(40, 9, 5, 8.54, 16);

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome_prod` varchar(255) NOT NULL,
  `marca` varchar(255) DEFAULT NULL,
  `tam_quant` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome_prod`, `marca`, `tam_quant`) VALUES
(1, 'Colgate Total 12', 'Colgate', '90g'),
(2, 'Refrigerante Lata', 'Coca-Cola', '300ml'),
(3, 'Batata Pringles', 'Pringles', '114g'),
(4, 'Ketchup Heinz Tradicional', 'Heinz', '379g'),
(5, 'Detergente Neutro', 'Ypê', '500ml');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `estoque`
--
ALTER TABLE `estoque`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emp_id` (`emp_id`),
  ADD KEY `prod_id` (`prod_id`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `estoque`
--
ALTER TABLE `estoque`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `estoque`
--
ALTER TABLE `estoque`
  ADD CONSTRAINT `estoque_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `empresa` (`id`),
  ADD CONSTRAINT `estoque_ibfk_2` FOREIGN KEY (`prod_id`) REFERENCES `produtos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
