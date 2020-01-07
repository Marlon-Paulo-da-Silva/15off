
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 11/06/2018 às 10:16:48
-- Versão do Servidor: 10.1.24-MariaDB
-- Versão do PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `u862903654_15tst`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `anuncios`
--

CREATE TABLE IF NOT EXISTS `anuncios` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `descricao` text,
  `valor` float DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `pendente` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Extraindo dados da tabela `anuncios`
--

INSERT INTO `anuncios` (`id`, `id_usuario`, `id_categoria`, `titulo`, `descricao`, `valor`, `estado`, `pendente`) VALUES
(5, 2, 3, 'Camisa Corinthians', 'camisa oficial corinthians', 1, 3, 0),
(7, 2, 2, 'Relógio Rolex', 'relógio Rolex double xx', 500, 2, 0),
(8, 2, 6, 'gol 2017', 'gol Zero KM', 4350, 2, 0),
(10, 6, 1, 'vestido da elsa', 'vestido da elsa semi-novo', 100, 2, 0),
(11, 5, 2, 'relogio da barbie', 'reloginho da barbie', 100, 2, 0),
(12, 6, 6, 'HB 20 2016', 'Carro bem conservado pela Andressa das gemeas', 35000, 2, 0),
(14, 3, 1, 'camisa nike', 'camisa toooooooooooooooopppp', 500, 2, 0),
(15, 5, 8, 'Copo ever after high', 'copo ever after high novo', 30, 3, 0),
(16, 6, 8, 'Taça', 'taça de vidro gourmet', 100, 3, 0),
(17, 5, 8, 'Copo Cúmplices de um resgate', 'copos novos C1R', 30, 3, 0),
(19, 3, 4, 'colar de ouro', 'colar de ouro 18K', 200, 2, 0),
(22, 5, 4, 'arquinho da juju', 'Arquinho da juju vermelho', 20, 2, 0),
(21, 5, 1, 'camisa monster high', 'Branca com personagem', 20, 3, 0),
(25, 5, 4, 'Lacinhos rosa e roxo com miolo brilhante', 'Roxo e rosa com miolo brilhante ', 10, 2, 0),
(28, 2, 6, 'FERRARI', 'ferrari vermelha', 1000000, 3, 0),
(31, 10, 3, 'Camisa Seleção Brasileira ', 'Camisa do Brasil 2018', 200, 3, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `anuncios_imagens`
--

CREATE TABLE IF NOT EXISTS `anuncios_imagens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_anuncio` int(11) NOT NULL,
  `url` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=77 ;

--
-- Extraindo dados da tabela `anuncios_imagens`
--

INSERT INTO `anuncios_imagens` (`id`, `id_anuncio`, `url`) VALUES
(41, 7, '60eb8bb0181d1cc9b1df2ee4e9869c7c.jpg'),
(42, 5, 'ff2a3a70e4c71480faf88ac763f408a7.jpg'),
(43, 12, '32654b1bc9b25b83671711e3d76443f5.jpg'),
(44, 10, 'd44c8c74ce75d146cd7fdf5056021c52.jpg'),
(45, 11, '6719702d7b1cabf04adec8302bc35756.jpg'),
(46, 15, '7e8887aa8dd773ff7bf08bd460675f03.jpg'),
(48, 16, '1784b35590e179ea31648a57f8523820.jpg'),
(49, 5, 'd14cd97a6ba06335375bb63d916181ea.jpg'),
(50, 5, 'a831c4fd9d2d73a659fc28879898a3b6.jpg'),
(51, 8, 'd68271bdbb64d035479dcf4dc285841a.jpg'),
(52, 8, '1d0d3c36af169a68c5ccc60834c64dae.jpg'),
(53, 8, '6df81eb44a7d0286e544122806eab9db.jpg'),
(54, 14, '82105b3a92583ae7f964229570b75b86.jpg'),
(55, 14, 'bf272e0148ed1ba5e3a3d1d846bad16f.jpg'),
(56, 14, '57b447b6c2d949132694fab95a761038.jpg'),
(57, 17, '58464b2c3422c87a56f0cf39c2b559d9.jpg'),
(58, 15, '211636403f2bc5eb3638359273d11f79.jpg'),
(59, 15, '3ab19b4b05e6817ebc3116ef8782928a.jpg'),
(60, 15, '46fd0a3eaae1d8570be3c5d5f72fd3f7.jpg'),
(64, 19, '680933c306aa0515718951ba610f71a0.jpg'),
(65, 19, 'fde65c099036174357f441740be8e063.jpg'),
(66, 21, 'f8b59eeabd43ec163f1308da5d7585b1.jpg'),
(67, 21, 'c425c1645ab6b9175c478553835463dc.jpg'),
(68, 21, '8a3fba6d7b4ab63c6a5ea89e0c0bf59f.jpg'),
(69, 22, '47bbddf6fb03e1328434ecfca292c595.jpg'),
(73, 25, 'bb3597928719cdfc0a16ee58b66ab57e.jpg'),
(74, 28, '193ea90d6eff22b344d71c8d54ce41da.jpg'),
(76, 31, '3770505f4ebe4b5d75bf8a00745fd00a.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(30) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome`) VALUES
(1, 'Roupas'),
(2, 'Relógios'),
(3, 'Roupa de time futebolístico'),
(4, 'acessórios'),
(5, 'Eletronicos'),
(6, 'Carros'),
(7, 'Alimentícios'),
(8, 'Copo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `senha` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `pendente` int(5) NOT NULL,
  `nivelusuario` int(11) DEFAULT '1',
  `cpf` int(15) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `telefone`, `pendente`, `nivelusuario`, `cpf`) VALUES
(2, 'marlon', 'a@a.com', '202cb962ac59075b964b07152d234b70', '9999999', 0, 3, 0),
(3, 'Marlon Paulo', 'b@b.com', '202cb962ac59075b964b07152d234b70', '67777', 0, 1, 0),
(5, 'Amanda', 'ama@ama.com', '81dc9bdb52d04dc20036dbd8313ed055', '1234', 0, 1, 0),
(6, 'Andressa Graziele', 'dressa@grazi.com', '81dc9bdb52d04dc20036dbd8313ed055', '123412341234', 1, 1, 0),
(7, 'Maria das cores', 'ma@co.com', '81dc9bdb52d04dc20036dbd8313ed055', '977797997', 0, 1, 0),
(8, 'Giorgio', 'gi@gi.com', '202cb962ac59075b964b07152d234b70', '123', 0, 1, 123),
(9, 'Felipe Caetano', 'fe@fe.com', '202cb962ac59075b964b07152d234b70', '123123', 0, 1, 123234213),
(10, 'Teste', 'Teste@email.com', '827ccb0eea8a706c4c34a16891f84e7b', '98899889', 0, 1, 123456),
(11, 'Teste', 'teste@t.com', '81dc9bdb52d04dc20036dbd8313ed055', '99999999', 0, 1, 123456789),
(12, 'Vitor Barbosa', 'v@b', '202cb962ac59075b964b07152d234b70', '96854545', 1, 1, 5454889);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
