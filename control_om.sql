-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01-Jun-2023 às 23:08
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
-- Banco de dados: `control_om`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `celula`
--

CREATE TABLE `celula` (
  `id` int(10) UNSIGNED NOT NULL,
  `celula` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `celula`
--

INSERT INTO `celula` (`id`, `celula`) VALUES
(1, 'Rotativos'),
(2, 'Motor de Tração'),
(3, 'Kit Estacionários'),
(4, 'Laboratório de Eletrônica'),
(5, 'Sala de Baterias');

-- --------------------------------------------------------

--
-- Estrutura da tabela `instituicao`
--

CREATE TABLE `instituicao` (
  `cod` int(11) NOT NULL,
  `nome_siglas` varchar(20) DEFAULT NULL,
  `nome_completo` varchar(255) DEFAULT NULL,
  `cnpj` varchar(20) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `cep` varchar(30) DEFAULT NULL,
  `telefone` varchar(40) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `url_site` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `instituicao`
--

INSERT INTO `instituicao` (`cod`, `nome_siglas`, `nome_completo`, `cnpj`, `endereco`, `cep`, `telefone`, `email`, `url_site`) VALUES
(1, 'IFPA', '–  Instituto Federal do Pará – Campus Itaituba', '10.763.998/0001-30', 'R. Universitário, s/n - Maria Magdalena, Itaituba - PA, ', 'CEP: 68183-300', '(93) 99172-8860', 'itaituba@ifpa.edu.br', 'itaituba.ifpa.edu.br');

-- --------------------------------------------------------

--
-- Estrutura da tabela `manutencao`
--

CREATE TABLE `manutencao` (
  `id` int(10) UNSIGNED NOT NULL,
  `manutencao` text NOT NULL,
  `celula` varchar(255) NOT NULL,
  `responsavel` varchar(255) NOT NULL,
  `duracao` varchar(255) NOT NULL,
  `status_id` int(11) UNSIGNED NOT NULL,
  `created_manutencao` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_manutencao` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `manutencao`
--

INSERT INTO `manutencao` (`id`, `manutencao`, `celula`, `responsavel`, `duracao`, `status_id`, `created_manutencao`, `updated_manutencao`) VALUES
(1, 'asdasdasd2222222222', 'Kit Estacionários', '123123212222222222', '01:11:11', 3, '2023-05-30 00:31:00', '2023-06-02 02:07:39'),
(3, 'asdasdasd222222222222', 'Laboratório de Eletrônica', '12312321', '01:11:11', 5, '2023-06-01 00:05:12', '2023-06-01 01:52:24');

-- --------------------------------------------------------

--
-- Estrutura da tabela `manutencao_desvio`
--

CREATE TABLE `manutencao_desvio` (
  `id` int(10) UNSIGNED NOT NULL,
  `manutencao_id` int(10) UNSIGNED NOT NULL,
  `ordem` varchar(255) NOT NULL,
  `duracao` int(11) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `created_desvio` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_desvio` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `manutencao_desvio`
--

INSERT INTO `manutencao_desvio` (`id`, `manutencao_id`, `ordem`, `duracao`, `tipo`, `descricao`, `created_desvio`, `updated_desvio`) VALUES
(1, 3, 'Fim do desvio', 2, 'Meio de Medição', '2', '2023-06-02 01:17:27', '2023-06-02 01:57:49'),
(2, 3, 'Início do desvio', 20, 'Mão de Obra', '22222222222', '2023-06-02 01:58:27', NULL),
(3, 3, 'Início do desvio', 1, 'Mão de Obra', '11111111111', '2023-06-02 01:59:11', NULL),
(4, 3, 'Início do desvio', 13, 'Mão de Obra', '', '2023-06-02 02:01:18', NULL),
(5, 1, 'Início do desvio', 22, 'Mão de Obra', '111111111111111111111', '2023-06-02 02:03:58', NULL),
(6, 1, 'Início do desvio', 11, 'Mão de Obra', '', '2023-06-02 02:07:39', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `manutencao_desvio_tipo`
--

CREATE TABLE `manutencao_desvio_tipo` (
  `id` int(10) UNSIGNED NOT NULL,
  `tipo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `manutencao_desvio_tipo`
--

INSERT INTO `manutencao_desvio_tipo` (`id`, `tipo`) VALUES
(1, 'Mão de Obra'),
(2, 'Meio Ambiente'),
(3, 'Material'),
(4, 'Máquina'),
(5, 'Método'),
(6, 'Meio de Medição');

-- --------------------------------------------------------

--
-- Estrutura da tabela `manutencao_duracao`
--

CREATE TABLE `manutencao_duracao` (
  `id` int(10) UNSIGNED NOT NULL,
  `duracao` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `manutencao_duracao`
--

INSERT INTO `manutencao_duracao` (`id`, `duracao`) VALUES
(1, '01:00:00 h'),
(2, '02:00:00 h');

-- --------------------------------------------------------

--
-- Estrutura da tabela `manutencao_encerra`
--

CREATE TABLE `manutencao_encerra` (
  `id` int(10) UNSIGNED NOT NULL,
  `maintenance_id` int(10) UNSIGNED NOT NULL,
  `status_time` int(1) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_finsh` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_finsh` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `manutencao_status`
--

CREATE TABLE `manutencao_status` (
  `id` int(10) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL,
  `class_color` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `manutencao_status`
--

INSERT INTO `manutencao_status` (`id`, `status`, `class_color`) VALUES
(1, 'Aguardando', 'bg-secondary text-white'),
(2, 'Iniciado', 'bg-success  text-white'),
(3, 'Com desvio', 'bg-danger  text-white'),
(4, 'Atrasado', 'bg-warring  text-white'),
(5, 'Encerrado', 'bg-primary  text-white');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `cod_usuario` int(11) NOT NULL,
  `cod_instituicao` int(11) NOT NULL,
  `nome_usuario` varchar(20) NOT NULL,
  `sobrenome_usuario` varchar(100) NOT NULL,
  `usuario_usuario` varchar(30) NOT NULL,
  `email_usuario` varchar(100) NOT NULL,
  `senha_usuario` varchar(32) NOT NULL,
  `cargo_usuario` varchar(45) NOT NULL,
  `genero_usuario` varchar(10) DEFAULT NULL,
  `nivel_acesso_usuario` int(1) UNSIGNED NOT NULL,
  `status_usuario` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `imagem_usuario` varchar(255) DEFAULT NULL,
  `data_cadastro_usuario` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`cod_usuario`, `cod_instituicao`, `nome_usuario`, `sobrenome_usuario`, `usuario_usuario`, `email_usuario`, `senha_usuario`, `cargo_usuario`, `genero_usuario`, `nivel_acesso_usuario`, `status_usuario`, `imagem_usuario`, `data_cadastro_usuario`) VALUES
(1, 1, 'Joab', 'Torres', 'joab.alencar', 'joabtorres1508@gmail.com', '47cafbff7d1c4463bbe7ba972a2b56e3', 'Administrador', 'M', 4, 1, 'uploads/usuarios/49d306c8f509ba2de4fbd8369e7e4b9d.jpg', '2019-04-11');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `celula`
--
ALTER TABLE `celula`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `instituicao`
--
ALTER TABLE `instituicao`
  ADD PRIMARY KEY (`cod`);

--
-- Índices para tabela `manutencao`
--
ALTER TABLE `manutencao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_stats_id` (`status_id`) USING BTREE;

--
-- Índices para tabela `manutencao_desvio`
--
ALTER TABLE `manutencao_desvio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_maintenance_id` (`manutencao_id`);

--
-- Índices para tabela `manutencao_desvio_tipo`
--
ALTER TABLE `manutencao_desvio_tipo`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `manutencao_duracao`
--
ALTER TABLE `manutencao_duracao`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `manutencao_encerra`
--
ALTER TABLE `manutencao_encerra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_maintenance_id_finsh` (`maintenance_id`);

--
-- Índices para tabela `manutencao_status`
--
ALTER TABLE `manutencao_status`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`cod_usuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `celula`
--
ALTER TABLE `celula`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `instituicao`
--
ALTER TABLE `instituicao`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `manutencao`
--
ALTER TABLE `manutencao`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `manutencao_desvio`
--
ALTER TABLE `manutencao_desvio`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `manutencao_desvio_tipo`
--
ALTER TABLE `manutencao_desvio_tipo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `manutencao_duracao`
--
ALTER TABLE `manutencao_duracao`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `manutencao_encerra`
--
ALTER TABLE `manutencao_encerra`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `manutencao_status`
--
ALTER TABLE `manutencao_status`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `cod_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `manutencao`
--
ALTER TABLE `manutencao`
  ADD CONSTRAINT `fk_statsid_01` FOREIGN KEY (`status_id`) REFERENCES `manutencao_status` (`id`);

--
-- Limitadores para a tabela `manutencao_desvio`
--
ALTER TABLE `manutencao_desvio`
  ADD CONSTRAINT `fk_maintenance_id` FOREIGN KEY (`manutencao_id`) REFERENCES `manutencao` (`id`);

--
-- Limitadores para a tabela `manutencao_encerra`
--
ALTER TABLE `manutencao_encerra`
  ADD CONSTRAINT `fk_maintenance_id_finsh` FOREIGN KEY (`maintenance_id`) REFERENCES `manutencao` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
