-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 18-Jan-2022 às 15:18
-- Versão do servidor: 10.4.20-MariaDB
-- versão do PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_finecrew`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias_de_produtos`
--

CREATE TABLE `categorias_de_produtos` (
  `id_categoria` int(11) NOT NULL,
  `nome_categoria` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categorias_de_produtos`
--

INSERT INTO `categorias_de_produtos` (`id_categoria`, `nome_categoria`) VALUES
(1, 'Enlatados'),
(2, 'Verduras\r\n                                                            '),
(3, 'Fruta'),
(8, 'Carne Branca'),
(10, 'Carne Vermelha');

-- --------------------------------------------------------

--
-- Estrutura da tabela `controle`
--

CREATE TABLE `controle` (
  `id_controle` int(11) NOT NULL,
  `dataCriacao_controle` datetime NOT NULL,
  `observacao_controle` text DEFAULT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `controle`
--

INSERT INTO `controle` (`id_controle`, `dataCriacao_controle`, `observacao_controle`, `id_usuario`) VALUES
(74, '2022-01-18 11:08:16', 'Batatas em ótimo estado....', 1),
(75, '2022-01-18 11:10:10', 'Batatas em ótimo estado....', 1),
(76, '2022-01-18 11:12:03', 'Kiwis bem verdinhos por dentro', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `controle_produto`
--

CREATE TABLE `controle_produto` (
  `id` int(11) NOT NULL,
  `id_controle` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `controle_produto`
--

INSERT INTO `controle_produto` (`id`, `id_controle`, `id_produto`) VALUES
(71, 74, 115),
(72, 76, 116);

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupo_usuarios`
--

CREATE TABLE `grupo_usuarios` (
  `id_grupo` int(11) NOT NULL,
  `nome_grupo` varchar(45) NOT NULL,
  `nivel_grupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `grupo_usuarios`
--

INSERT INTO `grupo_usuarios` (`id_grupo`, `nome_grupo`, `nivel_grupo`) VALUES
(1, 'Administrador', 1),
(2, 'Funcionário(a)', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `id_produto` int(11) NOT NULL,
  `nome_produto` varchar(75) NOT NULL,
  `quantidade_produto` float NOT NULL,
  `entrega_produto` date NOT NULL,
  `validade_produto` date NOT NULL,
  `observacao_produto` text NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id_produto`, `nome_produto`, `quantidade_produto`, `entrega_produto`, `validade_produto`, `observacao_produto`, `id_categoria`) VALUES
(115, 'Batata', 98.2, '2022-01-11', '2022-04-23', 'Batatas em ótimo estado....', 2),
(116, 'Kiwi', 50.2, '2022-01-18', '2022-04-30', 'Kiwis bem verdinhos por dentro', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `requisicao`
--

CREATE TABLE `requisicao` (
  `id_requisicao` int(11) NOT NULL,
  `data_requisicao` datetime NOT NULL,
  `id_produto` int(11) DEFAULT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `requisicao`
--

INSERT INTO `requisicao` (`id_requisicao`, `data_requisicao`, `id_produto`, `id_usuario`) VALUES
(25, '2022-01-18 11:08:46', 114, 1),
(26, '2022-01-18 11:10:32', 115, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `requisicao_produto`
--

CREATE TABLE `requisicao_produto` (
  `id` int(11) NOT NULL,
  `quantidade` float NOT NULL,
  `id_requisicao` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `requisicao_produto`
--

INSERT INTO `requisicao_produto` (`id`, `quantidade`, `id_requisicao`, `id_produto`) VALUES
(23, 2, 26, 115);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usarios_grupos`
--

CREATE TABLE `usarios_grupos` (
  `id` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nome_usuario` varchar(75) NOT NULL,
  `username_usuario` varchar(75) NOT NULL,
  `senha_usuario` varchar(75) NOT NULL,
  `nivel_usuario` int(2) NOT NULL DEFAULT 0,
  `status_usuario` binary(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome_usuario`, `username_usuario`, `senha_usuario`, `nivel_usuario`, `status_usuario`) VALUES
(1, 'Administrador', 'Admin', '9eb71ab7420eb452a22787ca4fab501b', 1, 0x31),
(2, 'Usuario', 'User', '30cd2f99101cdd52cc5fda1e996ee137', 0, 0x31);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `categorias_de_produtos`
--
ALTER TABLE `categorias_de_produtos`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Índices para tabela `controle`
--
ALTER TABLE `controle`
  ADD PRIMARY KEY (`id_controle`,`id_usuario`),
  ADD KEY `fk_id_usuario` (`id_usuario`);

--
-- Índices para tabela `controle_produto`
--
ALTER TABLE `controle_produto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_produto_produto` (`id_produto`),
  ADD KEY `fk_id_controle` (`id_controle`);

--
-- Índices para tabela `grupo_usuarios`
--
ALTER TABLE `grupo_usuarios`
  ADD PRIMARY KEY (`id_grupo`);

--
-- Índices para tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id_produto`),
  ADD KEY `fk_produto_categorias_de_produtos1` (`id_categoria`);

--
-- Índices para tabela `requisicao`
--
ALTER TABLE `requisicao`
  ADD PRIMARY KEY (`id_requisicao`,`id_usuario`) USING BTREE,
  ADD KEY `fk_requisicao_usuarios1` (`id_usuario`);

--
-- Índices para tabela `requisicao_produto`
--
ALTER TABLE `requisicao_produto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_requisicao_has_produto_requisicao1` (`id_requisicao`),
  ADD KEY `fk_id_produto` (`id_produto`);

--
-- Índices para tabela `usarios_grupos`
--
ALTER TABLE `usarios_grupos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_GrupoDeUsuarios_has_usuarios_GrupoDeUsuarios1` (`id_grupo`),
  ADD KEY `fk_GrupoDeUsuarios_has_usuarios_usuarios1` (`id_usuario`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categorias_de_produtos`
--
ALTER TABLE `categorias_de_produtos`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `controle`
--
ALTER TABLE `controle`
  MODIFY `id_controle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT de tabela `controle_produto`
--
ALTER TABLE `controle_produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT de tabela `grupo_usuarios`
--
ALTER TABLE `grupo_usuarios`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT de tabela `requisicao`
--
ALTER TABLE `requisicao`
  MODIFY `id_requisicao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `requisicao_produto`
--
ALTER TABLE `requisicao_produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `controle`
--
ALTER TABLE `controle`
  ADD CONSTRAINT `fk_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Limitadores para a tabela `controle_produto`
--
ALTER TABLE `controle_produto`
  ADD CONSTRAINT `fk_id_controle` FOREIGN KEY (`id_controle`) REFERENCES `controle` (`id_controle`),
  ADD CONSTRAINT `fk_id_produto_produto` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id_produto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `fk_produto_categorias_de_produtos1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias_de_produtos` (`id_categoria`);

--
-- Limitadores para a tabela `requisicao`
--
ALTER TABLE `requisicao`
  ADD CONSTRAINT `fk_requisicao_usuarios1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Limitadores para a tabela `requisicao_produto`
--
ALTER TABLE `requisicao_produto`
  ADD CONSTRAINT `fk_id_produto` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id_produto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_requisicao_has_produto_requisicao1` FOREIGN KEY (`id_requisicao`) REFERENCES `requisicao` (`id_requisicao`);

--
-- Limitadores para a tabela `usarios_grupos`
--
ALTER TABLE `usarios_grupos`
  ADD CONSTRAINT `fk_GrupoDeUsuarios_has_usuarios_GrupoDeUsuarios1` FOREIGN KEY (`id_grupo`) REFERENCES `grupo_usuarios` (`id_grupo`),
  ADD CONSTRAINT `fk_GrupoDeUsuarios_has_usuarios_usuarios1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
