-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 24-Jan-2018 às 07:10
-- Versão do servidor: 10.1.26-MariaDB
-- PHP Version: 7.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lineauditdb`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `audit`
--

CREATE TABLE `audit` (
  `id` int(11) NOT NULL,
  `status` varchar(250) NOT NULL,
  `total_score` int(11) DEFAULT NULL,
  `line` varchar(250) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `checklist`
--

CREATE TABLE `checklist` (
  `id` int(11) NOT NULL,
  `id_audit` int(11) NOT NULL,
  `id_item_checklist` int(11) NOT NULL,
  `image` text,
  `status` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `counter_measure`
--

CREATE TABLE `counter_measure` (
  `id` int(11) NOT NULL,
  `description` text NOT NULL,
  `id_item_checklist` int(11) NOT NULL,
  `id_checklist` int(11) NOT NULL,
  `status` varchar(250) NOT NULL,
  `image` text,
  `answer` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `item_checklist`
--

CREATE TABLE `item_checklist` (
  `id` int(11) NOT NULL,
  `section` varchar(250) NOT NULL,
  `item` text NOT NULL,
  `detail` text NOT NULL,
  `specification` text NOT NULL,
  `line` varchar(250) NOT NULL,
  `weight` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `item_checklist`
--

INSERT INTO `item_checklist` (`id`, `section`, `item`, `detail`, `specification`, `line`, `weight`) VALUES
(1, 'Auditoria de Ciclo', 'Soldagem', 'Fonte de Remoção', 'Verificar Condição de Instalação ', 'LP01', 2),
(2, 'Auditoria de Ciclo', 'Vedação', 'Pressão - Condição de Vencimento', 'Inserir Nitrogênio', 'LP01', 1),
(3, 'Auditoria de Ciclo', 'Vácuo', 'Nível de Óleo', 'Checar Especificação', 'LP01', 2),
(4, 'Auditoria de Ciclo', 'Vazamento', 'Sensibilidade', 'Condição Muito Doida', 'LP01', 1),
(5, 'Auditoria Heavy Metal', 'Vedação', 'Pressão', 'Condição Irregular', 'LP02', 3),
(6, 'Auditoria Heavy Metal', 'Vedação Especial', 'Ultra Sensibilidade', 'Muito bem especificada ', 'LP02', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `line` varchar(250) NOT NULL,
  `category` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `firstname`, `lastname`, `line`, `category`) VALUES
(1, 'thiagometal', 'thiagometal', 'Thiago', 'Oliveira', 'LP01', ''),
(2, 'sirkeen', 'sirkeen', 'Sir', 'keen', 'LP02', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit`
--
ALTER TABLE `audit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `checklist`
--
ALTER TABLE `checklist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_audit` (`id_audit`,`id_item_checklist`),
  ADD KEY `fkChecklistItemChecklist` (`id_item_checklist`);

--
-- Indexes for table `counter_measure`
--
ALTER TABLE `counter_measure`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_item_checklist` (`id_item_checklist`,`id_checklist`),
  ADD KEY `fkCounterMeasureChecklist` (`id_checklist`);

--
-- Indexes for table `item_checklist`
--
ALTER TABLE `item_checklist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit`
--
ALTER TABLE `audit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `checklist`
--
ALTER TABLE `checklist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `counter_measure`
--
ALTER TABLE `counter_measure`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_checklist`
--
ALTER TABLE `item_checklist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `audit`
--
ALTER TABLE `audit`
  ADD CONSTRAINT `fkAuditUser` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Limitadores para a tabela `checklist`
--
ALTER TABLE `checklist`
  ADD CONSTRAINT `fkChecklistAudit` FOREIGN KEY (`id_audit`) REFERENCES `audit` (`id`),
  ADD CONSTRAINT `fkChecklistItemChecklist` FOREIGN KEY (`id_item_checklist`) REFERENCES `item_checklist` (`id`);

--
-- Limitadores para a tabela `counter_measure`
--
ALTER TABLE `counter_measure`
  ADD CONSTRAINT `fkCounterMeasureChecklist` FOREIGN KEY (`id_checklist`) REFERENCES `checklist` (`id`),
  ADD CONSTRAINT `fkCounterMeasureItemChecklist` FOREIGN KEY (`id_item_checklist`) REFERENCES `item_checklist` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
