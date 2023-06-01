-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11-Out-2022 às 00:31
-- Versão do servidor: 10.4.21-MariaDB
-- versão do PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `siaf_db`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE `aluno` (
  `cod` int(11) UNSIGNED NOT NULL,
  `cod_instituicao` int(11) NOT NULL,
  `cod_turma` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `nascimento` date NOT NULL,
  `genero` varchar(20) NOT NULL,
  `altura` double NOT NULL,
  `cor` varchar(20) NOT NULL,
  `pressao` varchar(20) NOT NULL,
  `frequencia_cardiaca` varchar(30) NOT NULL,
  `glicose` varchar(30) NOT NULL,
  `fumante` varchar(10) NOT NULL,
  `alergia` varchar(10) NOT NULL,
  `qual_alergia` varchar(255) NOT NULL,
  `doenca` varchar(10) NOT NULL,
  `qual_doenca` varchar(255) NOT NULL,
  `lesao` varchar(10) NOT NULL,
  `qual_lesao` varchar(255) NOT NULL,
  `medicamento` varchar(10) NOT NULL,
  `qual_medicamento` varchar(255) NOT NULL,
  `refeicoes` varchar(20) NOT NULL,
  `bebidas` varchar(10) NOT NULL,
  `atividade_fisica` varchar(10) NOT NULL,
  `qual_atividade_fisica` varchar(255) NOT NULL,
  `intensidade_fisica` varchar(20) NOT NULL,
  `suplemento` varchar(10) NOT NULL,
  `qual_suplemento` varchar(255) NOT NULL,
  `objetivo` varchar(255) NOT NULL,
  `imagem` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`cod`, `cod_instituicao`, `cod_turma`, `nome`, `nascimento`, `genero`, `altura`, `cor`, `pressao`, `frequencia_cardiaca`, `glicose`, `fumante`, `alergia`, `qual_alergia`, `doenca`, `qual_doenca`, `lesao`, `qual_lesao`, `medicamento`, `qual_medicamento`, `refeicoes`, `bebidas`, `atividade_fisica`, `qual_atividade_fisica`, `intensidade_fisica`, `suplemento`, `qual_suplemento`, `objetivo`, `imagem`) VALUES
(1, 1, 8, 'Joab Torres Alencar', '1993-08-15', 'Masculino', 1.75, 'Pardo', '12/08', '95 bpm', '99 mg/dL', 'Não', 'Não', '', 'Não', '', 'Não', '', 'Não', '', '4', 'Sim', 'Não', '', 'Inexistente', 'Não', '', 'Condicionamento Físico', 'uploads/alunos/9bbb5065fb09a8c0917bc19c06b8eefe.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliacao_fisica`
--

CREATE TABLE `avaliacao_fisica` (
  `cod` int(11) NOT NULL,
  `cod_aluno` int(11) NOT NULL,
  `data` date NOT NULL,
  `peso` varchar(10) NOT NULL,
  `braco_direito` varchar(10) NOT NULL,
  `braco_esquerdo` varchar(10) NOT NULL,
  `antebraco_direito` varchar(10) NOT NULL,
  `antebraco_esquerdo` varchar(10) NOT NULL,
  `abdomen` varchar(10) NOT NULL,
  `quadril` varchar(10) NOT NULL,
  `cintura` varchar(10) NOT NULL,
  `femu` varchar(20) NOT NULL,
  `punho` varchar(20) NOT NULL,
  `coxa_direita` varchar(10) NOT NULL,
  `coxa_esqueda` varchar(10) NOT NULL,
  `panturrilha_direita` varchar(10) NOT NULL,
  `panturrilha_esquerda` varchar(10) NOT NULL,
  `imc` varchar(40) NOT NULL,
  `deficit_calorico` varchar(40) NOT NULL,
  `tmb` varchar(40) NOT NULL,
  `massa_residual` varchar(20) NOT NULL,
  `massa_ossea` varchar(40) NOT NULL,
  `massa_muscular` varchar(40) NOT NULL,
  `massa_magra` varchar(40) NOT NULL,
  `massa_gorda` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `avaliacao_fisica`
--

INSERT INTO `avaliacao_fisica` (`cod`, `cod_aluno`, `data`, `peso`, `braco_direito`, `braco_esquerdo`, `antebraco_direito`, `antebraco_esquerdo`, `abdomen`, `quadril`, `cintura`, `femu`, `punho`, `coxa_direita`, `coxa_esqueda`, `panturrilha_direita`, `panturrilha_esquerda`, `imc`, `deficit_calorico`, `tmb`, `massa_residual`, `massa_ossea`, `massa_muscular`, `massa_magra`, `massa_gorda`) VALUES
(7, 1, '2022-10-10', '115.00 kg', '30 cm', '30 cm', '15 cm', '15 cm', '90 cm', '80 cm', '100.00 cm', '20 cm', '7 cm', '45 cm', '45 cm', '33 cm', '33 cm', '37.55', '2438.50', '1635.85', '27.72', '22.85', '23.57', '74.14', '40.86');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `instituicao`
--

INSERT INTO `instituicao` (`cod`, `nome_siglas`, `nome_completo`, `cnpj`, `endereco`, `cep`, `telefone`, `email`, `url_site`) VALUES
(1, 'IFPA', '–  Instituto Federal do Pará – Campus Itaituba', '10.763.998/0001-30', 'R. Universitário, s/n - Maria Magdalena, Itaituba - PA, ', 'CEP: 68183-300', '(93) 99172-8860', 'itaituba@ifpa.edu.br', 'itaituba.ifpa.edu.br');

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma`
--

CREATE TABLE `turma` (
  `cod` int(11) NOT NULL,
  `cod_instituicao` int(11) NOT NULL,
  `curso` varchar(255) NOT NULL,
  `turma` varchar(255) NOT NULL,
  `ano` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `turma`
--

INSERT INTO `turma` (`cod`, `cod_instituicao`, `curso`, `turma`, `ano`) VALUES
(8, 1, 'Técnico em Informática Integrado ao Ensino Médio', 'TI13', '2013');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`cod_usuario`, `cod_instituicao`, `nome_usuario`, `sobrenome_usuario`, `usuario_usuario`, `email_usuario`, `senha_usuario`, `cargo_usuario`, `genero_usuario`, `nivel_acesso_usuario`, `status_usuario`, `imagem_usuario`, `data_cadastro_usuario`) VALUES
(1, 1, 'Joab', 'Torres', 'joab.alencar', 'joabtorres1508@gmail.com', '47cafbff7d1c4463bbe7ba972a2b56e3', 'Administrador', 'M', 4, 1, 'uploads/usuarios/49d306c8f509ba2de4fbd8369e7e4b9d.jpg', '2019-04-11');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`cod`);

--
-- Índices para tabela `avaliacao_fisica`
--
ALTER TABLE `avaliacao_fisica`
  ADD PRIMARY KEY (`cod`);

--
-- Índices para tabela `instituicao`
--
ALTER TABLE `instituicao`
  ADD PRIMARY KEY (`cod`);

--
-- Índices para tabela `turma`
--
ALTER TABLE `turma`
  ADD PRIMARY KEY (`cod`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`cod_usuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aluno`
--
ALTER TABLE `aluno`
  MODIFY `cod` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `avaliacao_fisica`
--
ALTER TABLE `avaliacao_fisica`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `instituicao`
--
ALTER TABLE `instituicao`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `turma`
--
ALTER TABLE `turma`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `cod_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
