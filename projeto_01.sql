-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11-Nov-2022 às 21:37
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `projeto_01`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_admin.online`
--

CREATE TABLE `tb_admin.online` (
  `id` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `ultima_acao` datetime NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_admin.online`
--

INSERT INTO `tb_admin.online` (`id`, `ip`, `ultima_acao`, `token`) VALUES
(19, '127.0.0.1', '2022-11-11 17:35:54', '636ea26640bcc');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_admin.usuarios`
--

CREATE TABLE `tb_admin.usuarios` (
  `id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cargo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_admin.usuarios`
--

INSERT INTO `tb_admin.usuarios` (`id`, `user`, `password`, `img`, `nome`, `cargo`) VALUES
(1, 'admin', 'admin', '6352acb8439a8.jpg', 'Marcos Almeida', 2),
(2, 'guigui768', '123456', 'danki_bg.jpg', 'Guilherme C. Grillo', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_admin.visitas`
--

CREATE TABLE `tb_admin.visitas` (
  `id` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `dia` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_admin.visitas`
--

INSERT INTO `tb_admin.visitas` (`id`, `ip`, `dia`) VALUES
(1, '::1', '2017-06-12'),
(2, '192.168.0.2', '2017-06-11'),
(3, '::1', '2017-06-13'),
(4, '::1', '2017-06-13'),
(5, '::1', '2017-06-13'),
(6, '::1', '2017-06-13'),
(7, '::1', '2017-06-14'),
(8, '::1', '2017-06-14'),
(9, '::1', '2017-06-16'),
(10, '::1', '2017-06-20'),
(11, '::1', '2017-06-20'),
(12, '::1', '2017-06-20'),
(13, '::1', '2017-06-20'),
(14, '::1', '2017-06-26'),
(15, '::1', '2022-09-14'),
(16, '::1', '2022-10-21'),
(17, '::1', '2022-10-27'),
(18, '::1', '2022-11-03'),
(19, '127.0.0.1', '2022-11-11');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site.categorias`
--

CREATE TABLE `tb_site.categorias` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_site.categorias`
--

INSERT INTO `tb_site.categorias` (`id`, `nome`, `slug`, `order_id`) VALUES
(1, 'Novelas', 'novelas', 6),
(3, 'Geral', 'geral', 3),
(5, 'Esportes', 'esportes', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site.config`
--

CREATE TABLE `tb_site.config` (
  `titulo` varchar(255) NOT NULL,
  `nome_autor` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `icone1` varchar(255) NOT NULL,
  `descricao1` text NOT NULL,
  `icone2` varchar(255) NOT NULL,
  `descricao2` text NOT NULL,
  `icone3` varchar(255) NOT NULL,
  `descricao3` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_site.config`
--

INSERT INTO `tb_site.config` (`titulo`, `nome_autor`, `descricao`, `icone1`, `descricao1`, `icone2`, `descricao2`, `icone3`, `descricao3`) VALUES
('Projeto editado', 'Marcos Almeida', 'descricao do autor', 'fa fa-css3', 'descricao css3', 'fa fa-html5', 'descricao html5', 'fa fa-gg-circle', 'descricao javascript');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site.depoimentos`
--

CREATE TABLE `tb_site.depoimentos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `depoimento` text NOT NULL,
  `data` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_site.depoimentos`
--

INSERT INTO `tb_site.depoimentos` (`id`, `nome`, `depoimento`, `data`, `order_id`) VALUES
(8, 'Guilherme', 'Olá, funcionando', '19/09/2019', 11),
(9, 'João', 'Olá, funcionando', '19/09/2019', 10),
(10, 'Mario', 'Depoimento', '19/09/2019', 9),
(11, 'Outro', 'Ok', '19/08/2016', 8),
(12, 'Guilherme Grillo', 'Depoimento de teste', '25/05/1993', 12),
(13, 'Joao', 'outro depoimento editado', '25/05/1993', 13);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site.noticias`
--

CREATE TABLE `tb_site.noticias` (
  `id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `data` date NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `conteudo` text NOT NULL,
  `capa` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_site.noticias`
--

INSERT INTO `tb_site.noticias` (`id`, `categoria_id`, `data`, `titulo`, `conteudo`, `capa`, `slug`, `order_id`) VALUES
(5, 3, '2022-11-09', 'Noticia Teste2', '<p>Teste 6</p>', '636041a62e9b8.png', 'noticia-teste2', 9),
(9, 5, '2022-11-07', 'Noticia Teste2', '<h1>Teste de Not&iacute;cia</h1>\r\n<p>&nbsp;</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eget augue ut ligula semper pretium ac quis velit. Proin sollicitudin, leo ac consequat ullamcorper, enim nisi venenatis est, non pulvinar libero odio quis velit. Nulla sagittis tortor quam, eget venenatis magna tristique et. Donec augue ex, eleifend vitae egestas eget, consequat eget eros. Donec suscipit augue ultrices nisl efficitur, non sagittis justo porttitor. Suspendisse tempus nulla orci, ut vestibulum purus tincidunt porttitor. Suspendisse bibendum nec nisi ut sollicitudin. Aenean vel ultricies odio, tempus pellentesque elit. Suspendisse a porta libero. Nullam vehicula dolor faucibus tortor maximus, eget auctor ligula auctor. Nunc ut vestibulum libero. Sed tortor sapien, molestie sit amet tempus sed, condimentum eu quam. Duis consequat ante id neque ultrices, at rhoncus ipsum elementum. Vestibulum ut ex sed magna porttitor scelerisque id quis sapien.</p>\r\n<p>Cras finibus semper quam vel vulputate. Maecenas viverra lectus id ex hendrerit, eget consectetur quam malesuada. Ut ipsum dui, mattis commodo iaculis vel, euismod at risus. Morbi id euismod lectus, pharetra dignissim dui. Nunc dapibus sem magna, non facilisis justo aliquam id. Nullam laoreet neque augue, at interdum diam mollis at. Mauris nec quam quam. Nullam ut purus et purus varius vestibulum. Donec a faucibus quam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur finibus erat urna, in suscipit nibh aliquet sed.</p>\r\n<p>Nullam quis tellus eget felis consequat convallis et vitae mauris. Aliquam malesuada finibus varius. Cras vulputate, lorem sit amet mollis tristique, neque dui consectetur tortor, tempor pellentesque augue neque eu metus. Integer dictum efficitur diam vel efficitur. Nulla a lacinia lorem, id venenatis ante. Phasellus vestibulum quis leo nec laoreet. Aenean accumsan posuere iaculis. Maecenas vel metus odio. Nam nec eleifend velit. Suspendisse tristique magna quis urna ultricies, in auctor turpis egestas. Cras orci libero, blandit lacinia eros ac, dignissim sagittis libero. Cras non risus sed lorem dapibus iaculis sit amet vel ipsum. Fusce eleifend orci sed turpis consectetur, at imperdiet dolor luctus. Vestibulum aliquam at diam eu aliquet.</p>\r\n<p><span style=\"font-family: \'book antiqua\', palatino, serif;\">lorem</span></p>\r\n<p><em><strong><span style=\"font-family: \'book antiqua\', palatino, serif; font-size: 18pt;\">Beleza</span></strong></em></p>\r\n<table style=\"border-collapse: collapse; width: 100%;\" border=\"1\"><colgroup><col style=\"width: 16.698%;\"><col style=\"width: 25.6465%;\"><col style=\"width: 57.6555%;\"></colgroup>\r\n<tbody>\r\n<tr>\r\n<td>CAca</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>', '636917505767f.png', 'noticia-teste2', 5),
(10, 1, '2022-11-09', 'Titulo Novela', '<p>Lorem C&aacute;c&aacute;</p>', '636c1e8c29f35.png', 'titulo-novela', 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site.servicos`
--

CREATE TABLE `tb_site.servicos` (
  `id` int(11) NOT NULL,
  `servico` text NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_site.servicos`
--

INSERT INTO `tb_site.servicos` (`id`, `servico`, `order_id`) VALUES
(4, 'Meu serviço #1', 0),
(5, 'Meu serviço #2 EDITADO novamente', 6),
(6, 'Meu serviço #3 EDITADO NOVAMENTE NOVAMENTE', 10),
(7, 'Meu servico #4', 5),
(8, 'Teste 3', 4),
(9, 'Serviço 4', 0),
(10, 'Serviço 4', 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site.slides`
--

CREATE TABLE `tb_site.slides` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `slide` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_site.slides`
--

INSERT INTO `tb_site.slides` (`id`, `nome`, `slide`, `order_id`) VALUES
(8, 'Imagem de teste', '594d4e65b16be.jpg', 8),
(9, 'Meu slide', '594d4ec5ad5dd.jpg', 9);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tb_admin.online`
--
ALTER TABLE `tb_admin.online`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_admin.usuarios`
--
ALTER TABLE `tb_admin.usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_admin.visitas`
--
ALTER TABLE `tb_admin.visitas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_site.categorias`
--
ALTER TABLE `tb_site.categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_site.depoimentos`
--
ALTER TABLE `tb_site.depoimentos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_site.noticias`
--
ALTER TABLE `tb_site.noticias`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_site.servicos`
--
ALTER TABLE `tb_site.servicos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_site.slides`
--
ALTER TABLE `tb_site.slides`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_admin.online`
--
ALTER TABLE `tb_admin.online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `tb_admin.usuarios`
--
ALTER TABLE `tb_admin.usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tb_admin.visitas`
--
ALTER TABLE `tb_admin.visitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `tb_site.categorias`
--
ALTER TABLE `tb_site.categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `tb_site.depoimentos`
--
ALTER TABLE `tb_site.depoimentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `tb_site.noticias`
--
ALTER TABLE `tb_site.noticias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `tb_site.servicos`
--
ALTER TABLE `tb_site.servicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `tb_site.slides`
--
ALTER TABLE `tb_site.slides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
