-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09-Nov-2023 às 21:07
-- Versão do servidor: 10.4.28-MariaDB
-- versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `vadecum`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `patologia`
--

CREATE TABLE `patologia` (
  `id` int(11) NOT NULL,
  `id_` varchar(45) NOT NULL,
  `cid` varchar(150) NOT NULL,
  `patologia` varchar(150) NOT NULL,
  `descricao` longtext NOT NULL,
  `referencias` longtext NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL,
  `status` int(1) NOT NULL,
  `user_type` varchar(45) DEFAULT NULL,
  `exp` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `patologia`
--

INSERT INTO `patologia` (`id`, `id_`, `cid`, `patologia`, `descricao`, `referencias`, `createdAt`, `updatedAt`, `status`, `user_type`, `exp`) VALUES
(7, '6e18175c452c', 'C01', 'Dor de cabeça', '<blockquote><em>teste</em></blockquote>', '<h1>teste</h1>', '2023-11-08 15:00:52', '2023-11-08 15:05:04', 1, 'user', NULL),
(8, '6627c3033b76', 'C35', 'teste', '<p class=\"\">aaaaaaaaaaaaaaa</p>', '<p>vvvvvvvvvvvvvvv</p>', '2023-11-08 15:40:07', '2023-11-08 15:40:07', 1, 'user', NULL),
(9, 'f31e1c24df4a', 'C69', 'Doenca blablabla', '<p>awadwadadw</p>', '<p>dswasdw</p>', '2023-11-08 15:42:26', '2023-11-08 15:42:26', 1, 'user', NULL),
(10, '247d9ee4d649', 'C10', 'Doença de chagas', '<p><strong><u>Diagnóstico:</u></strong></p><ul><li>Hemograma completo</li><li>DHL</li><li>fosfatase alcalina</li><li>enzimas hepáticas</li><li class=\"ql-indent-1\">TGO</li><li class=\"ql-indent-1\">TGP</li><li class=\"ql-indent-1\">fosfatase alcalina</li><li class=\"ql-indent-1\">Gama GT</li><li>bilirrubinas totais e frações</li><li>creatinina</li><li>cálcio sérico</li></ul><p>Biópsia para anatomopatológico, estudo imuno-histoquímico.</p><p>Escarro para pesquisa de células neoplásicas e pesquisa de BAAR</p><p>PAAF</p><p><strong><u>Acompanhamento:</u></strong></p><ul><li>Hemograma;</li><li>função hepática</li><li class=\"ql-indent-1\">TGO,</li><li class=\"ql-indent-1\">TGP,</li><li class=\"ql-indent-1\">o fosfatase alcalina,</li><li class=\"ql-indent-1\">o Gama GT e</li><li class=\"ql-indent-1\">o bilirrubinas;</li><li>função renal com eletrólitos</li><li class=\"ql-indent-1\">ureia,</li><li class=\"ql-indent-1\">creatinina,</li><li class=\"ql-indent-1\">sódio,</li><li class=\"ql-indent-1\">potássio,</li><li class=\"ql-indent-1\">magnésio,</li><li class=\"ql-indent-1\">cloro,</li><li class=\"ql-indent-1\">fosforo e</li><li class=\"ql-indent-1\">magnésio;</li><li>glicemia.</li></ul><p>Pacientes que fazem imunoterapia:</p><p>TSH e T4 livre,</p><p>ACTH,</p><p>sorologias HIV,</p><ul><li>&nbsp;hepatites:</li><li class=\"ql-indent-1\">anti-HCV,</li><li class=\"ql-indent-1\">anti-HBS,</li><li class=\"ql-indent-1\">HbsAg,</li><li class=\"ql-indent-1\">anti-HBC total,</li><li class=\"ql-indent-1\">anti-HAV IgG e IgM,</li><li class=\"ql-indent-1\">amilase</li><li class=\"ql-indent-1\">lipase.</li></ul><p><strong><u>Seguimento:</u></strong></p><p>Consultas médicas a cada 3 meses nos dois primeiros anos e a cada 6 meses até completar o 5º ano.</p><p>Exames laboratoriais deves ser solicitados de acordo com a sintomatologia do paciente.</p>', '', '2023-11-09 14:02:26', '2023-11-09 14:07:04', 1, 'user', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `id_` varchar(45) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL,
  `status` int(1) NOT NULL,
  `user_type` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `id_`, `name`, `email`, `password`, `createdAt`, `updatedAt`, `status`, `user_type`) VALUES
(2, 'd579819cdf08', 'adm@adm.com', 'adm@adm.com', 'aa1bf4646de67fd9086cf6c79007026c', '2023-11-08 13:08:04', '2023-11-08 13:08:04', 1, 'user'),
(3, '86172bc08ff5', 'Rafael', 'adm@adm.com', 'aa1bf4646de67fd9086cf6c79007026c', '2023-11-08 15:36:24', '2023-11-08 15:36:24', 1, 'user');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `patologia`
--
ALTER TABLE `patologia`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `patologia`
--
ALTER TABLE `patologia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
