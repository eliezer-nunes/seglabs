-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Tempo de geração: 15/12/2021 às 07:51
-- Versão do servidor: 5.7.34
-- Versão do PHP: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `saglabs`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `servico`
--

CREATE TABLE `servico` (
  `id` int(11) NOT NULL,
  `origem` varchar(100) NOT NULL,
  `destino` varchar(100) NOT NULL,
  `data_saida` date NOT NULL,
  `transporte_id` int(11) NOT NULL,
  `valor` decimal(13,2) NOT NULL,
  `cancelado` tinyint(4) DEFAULT NULL,
  `finalizado` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipo_transporte`
--

CREATE TABLE `tipo_transporte` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `custo_medio` decimal(13,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `tipo_transporte`
--

INSERT INTO `tipo_transporte` (`id`, `nome`, `custo_medio`) VALUES
(1, 'Caminhão', '35.00'),
(2, 'Navio', '22.00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `transporte`
--

CREATE TABLE `transporte` (
  `id` int(11) NOT NULL,
  `altura` decimal(13,2) NOT NULL,
  `largura` decimal(13,2) NOT NULL,
  `comprimento` decimal(13,2) NOT NULL,
  `responsavel` varchar(100) NOT NULL,
  `tipo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `servico`
--
ALTER TABLE `servico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ServicoTransporte` (`transporte_id`);

--
-- Índices de tabela `tipo_transporte`
--
ALTER TABLE `tipo_transporte`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `transporte`
--
ALTER TABLE `transporte`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_TransporteTipo` (`tipo_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `servico`
--
ALTER TABLE `servico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tipo_transporte`
--
ALTER TABLE `tipo_transporte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `transporte`
--
ALTER TABLE `transporte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `servico`
--
ALTER TABLE `servico`
  ADD CONSTRAINT `fk_ServicoTransporte` FOREIGN KEY (`transporte_id`) REFERENCES `transporte` (`id`);

--
-- Restrições para tabelas `transporte`
--
ALTER TABLE `transporte`
  ADD CONSTRAINT `fk_TransporteTipo` FOREIGN KEY (`tipo_id`) REFERENCES `tipo_transporte` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
