-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 22-Abr-2019 às 14:42
-- Versão do servidor: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carros`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `admins`
--

CREATE TABLE `admins` (
  `id` int(10) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `pass` varchar(250) NOT NULL,
  `privilegios` varchar(10) NOT NULL DEFAULT '0',
  `email` varchar(50) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `no_del` varchar(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `admins`
--

INSERT INTO `admins` (`id`, `nome`, `pass`, `privilegios`, `email`, `tipo`, `no_del`) VALUES
(24, 'Admin', '21232f297a57a5a743894a0e4a801fc3', '2', 'r.peleira@hotmail.com', 'Administrator', '1'),
(43, 'rogerio_dias', 'd4f3923781e4e14d7e1b5f206e5e1888', '3', 'rogeriomanueldias@gmail.com', 'GestorPlus', '0'),
(44, 'Elisa_dias', '8070b0b01d9042fdbc54f095bd2832ef', '4', 'elisadias8@gmail.com', 'Gestor', '0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `carros`
--

CREATE TABLE `carros` (
  `id` int(11) NOT NULL,
  `modelo` int(11) NOT NULL,
  `nome_carro` varchar(255) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `kms` decimal(10,2) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `carros`
--

INSERT INTO `carros` (`id`, `modelo`, `nome_carro`, `preco`, `kms`, `img`) VALUES
(20, 5, 'Toyota Yaris Z', '190000.00', '900.00', 'yaris-hatch_xl_man_040_carPage.png'),
(21, 6, 'Toyota Corolla', '120000.00', '190.00', 'corolla2.png'),
(23, 7, 'Toyota SUPRA RZ 97', '290000.00', '560.00', 'supra1.jpg'),
(24, 7, 'Supra 2019', '10000000.00', '120.00', 'supra3.jpg'),
(25, 5, 'Toyota Yaris 2000', '12000.00', '149.00', 'ezgif.com-webp-to-jpg.jpg'),
(26, 11, 'GT-86 PR', '19000000.00', '200.00', 'gt86_2.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentario` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `nome_pessoa` int(11) NOT NULL,
  `data` int(11) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `activo` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `comentarios`
--

INSERT INTO `comentarios` (`id_comentario`, `titulo`, `nome_pessoa`, `data`, `descricao`, `activo`) VALUES
(4, 'Supra RZ', 24, 1559952000, 'manel', 1),
(8, 'Supra YZ', 43, 1555718400, 'Drive your emotions', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `companhia`
--

CREATE TABLE `companhia` (
  `id` int(10) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `logo` varchar(250) NOT NULL,
  `morada` varchar(100) NOT NULL,
  `cod_postal` varchar(50) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `tlm` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `site` varchar(100) NOT NULL,
  `nif` varchar(12) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `companhia`
--

INSERT INTO `companhia` (`id`, `nome`, `logo`, `morada`, `cod_postal`, `tel`, `tlm`, `email`, `site`, `nif`) VALUES
(1, 'ToyotaCarsRental', 'upload/logo1.png', 'Estrada Sao Caetano', '8100-123 Loule', '289150167', '914564564', 'r.peleira@hotmail.com', 'toyotacarsrental.com', '123456789');

-- --------------------------------------------------------

--
-- Estrutura da tabela `modelo`
--

CREATE TABLE `modelo` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `modelo`
--

INSERT INTO `modelo` (`id`, `nome`) VALUES
(5, 'Yaris'),
(6, 'Corolla'),
(7, 'Supra'),
(10, 'Auris'),
(11, 'GT-86');

-- --------------------------------------------------------

--
-- Estrutura da tabela `privilegios`
--

CREATE TABLE `privilegios` (
  `id` int(2) NOT NULL,
  `tipo` varchar(25) NOT NULL,
  `carro_novo_pri` varchar(10) NOT NULL DEFAULT 'false',
  `carro_pes_pri` varchar(10) NOT NULL DEFAULT 'false',
  `modelo_novo_pri` varchar(10) NOT NULL DEFAULT 'false',
  `modelo_pes_pri` varchar(10) NOT NULL DEFAULT 'false',
  `comentarios_list_pri` varchar(10) NOT NULL DEFAULT 'false',
  `reserva_list_pri` varchar(10) NOT NULL DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `privilegios`
--

INSERT INTO `privilegios` (`id`, `tipo`, `carro_novo_pri`, `carro_pes_pri`, `modelo_novo_pri`, `modelo_pes_pri`, `comentarios_list_pri`, `reserva_list_pri`) VALUES
(1, 'SuperUser', 'checked', 'checked', 'checked', 'checked', 'checked', 'checked'),
(2, 'Administrator', 'checked', 'checked', 'checked', 'checked', 'checked', 'checked'),
(3, 'GestorPlus', 'checked', 'checked', 'checked', 'checked', 'false', 'false'),
(4, 'Gestor', 'false', 'false', 'false', 'false', 'false', 'false');

-- --------------------------------------------------------

--
-- Estrutura da tabela `reserva`
--

CREATE TABLE `reserva` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `pais` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefone` int(11) NOT NULL,
  `data_reserva` int(11) NOT NULL,
  `hora_reserva` int(11) NOT NULL,
  `carro` int(11) NOT NULL,
  `observacoes` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `reserva`
--

INSERT INTO `reserva` (`id`, `nome`, `pais`, `email`, `telefone`, `data_reserva`, `hora_reserva`, `carro`, `observacoes`) VALUES
(1, 'Joao Torres', 'Portugal', 'ricardopeleira16@gmail.com', 123456789, 1556668800, 1556670900, 23, 'O inicio de vida do desportivo mais famoso da Toyota foi como Celica XX ou Celica Supra em determinados mercados. Derivado de um Celica com um motor de 6 cilindros suave e luxuoso, obteve grande Ãªxito no mercado de turismos na America do Norte'),
(4, 'Joao Pires', 'Portugal', 'ricardopeleira16@gmail.com', 963354089, 1555027200, 1555059060, 23, 'Like it'),
(6, 'Rogerio Goncalves', 'FranÃ§a', 'ricardopeleira16@gmail.com', 289707181, 1554768000, 1554768000, 21, 'Gosto disto'),
(7, 'Luis Simao', 'Portugal', 'ricardopeleira16@gmail.com', 918777567, 1556323200, 1556323200, 24, 'Espera ai'),
(9, 'Alexandre Sousa', 'Portugal', 'r.peleira@hotmail.com', 963354089, 1555459200, 1555459200, 26, '-/-');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carros`
--
ALTER TABLE `carros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_modelo_carro` (`modelo`);

--
-- Indexes for table `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `id_nome_utilizador_comentarios` (`nome_pessoa`);

--
-- Indexes for table `companhia`
--
ALTER TABLE `companhia`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modelo`
--
ALTER TABLE `modelo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `privilegios`
--
ALTER TABLE `privilegios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_carro_reserva` (`carro`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `carros`
--
ALTER TABLE `carros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `companhia`
--
ALTER TABLE `companhia`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `modelo`
--
ALTER TABLE `modelo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `privilegios`
--
ALTER TABLE `privilegios`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reserva`
--
ALTER TABLE `reserva`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `carros`
--
ALTER TABLE `carros`
  ADD CONSTRAINT `id_modelo_carro` FOREIGN KEY (`modelo`) REFERENCES `modelo` (`id`);

--
-- Limitadores para a tabela `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `id_nome_utilizador_comentarios` FOREIGN KEY (`nome_pessoa`) REFERENCES `admins` (`id`);

--
-- Limitadores para a tabela `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `id_carro_reserva` FOREIGN KEY (`carro`) REFERENCES `carros` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
