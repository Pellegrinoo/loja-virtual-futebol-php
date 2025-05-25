-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.32-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.10.0.7000
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para loja_futebol
CREATE DATABASE IF NOT EXISTS `loja_futebol` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `loja_futebol`;

-- Copiando estrutura para tabela loja_futebol.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela loja_futebol.categorias: ~3 rows (aproximadamente)
INSERT INTO `categorias` (`id`, `nome`) VALUES
	(1, 'Camisas'),
	(2, 'Chuteiras'),
	(3, 'Bolas');

-- Copiando estrutura para tabela loja_futebol.produtos
CREATE TABLE IF NOT EXISTS `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categoria_id` (`categoria_id`),
  CONSTRAINT `produtos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela loja_futebol.produtos: ~12 rows (aproximadamente)
INSERT INTO `produtos` (`id`, `nome`, `preco`, `categoria_id`, `imagem`) VALUES
	(1, 'Camisa Time A', 129.90, 1, 'image/franca.jpg'),
	(2, 'Chuteira Nike', 199.99, 2, 'image/chuteira-nike.png'),
	(3, 'Bola Ile-De-Foot Adidas', 248.90, 3, 'image/bola-adidas.jpg'),
	(4, 'Camisa Arsenal', 249.99, 1, 'image/arsenal.jpg'),
	(8, 'Camisa Real Madrid', 279.90, 1, 'image/real_madrid.png'),
	(9, 'Camisa Barcelona', 259.90, 1, 'image/barcelona.png'),
	(10, 'Camisa PSG', 299.90, 1, 'image/psg.png'),
	(11, 'Camisa Manchester United', 289.90, 1, 'image/manchester_united.png'),
	(12, 'Camisa Bayern de Munique', 269.90, 1, 'image/bayern.png'),
	(14, 'Chuteira Umbro Adamant', 237.40, 2, 'image/chuteira-umbro.jpg'),
	(15, 'Chuteira Adidas F-50', 776.65, 2, 'image/chuteira-adidas.jpg'),
	(16, 'Bola Puma Big Cat', 169.99, 3, 'image/bola-puma.jpg');

-- Copiando estrutura para tabela loja_futebol.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela loja_futebol.usuarios: ~2 rows (aproximadamente)
INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`) VALUES
	(1, 'Administrador', 'admin@loja.com', 'senha123'),
	(2, 'Lucas', 'lucas@gmail.com', 'furacao1924');

-- Copiando estrutura para tabela loja_futebol.vendas
CREATE TABLE IF NOT EXISTS `vendas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_venda` datetime DEFAULT current_timestamp(),
  `id_usuario` int(11) NOT NULL,
  `vlr_total` decimal(20,6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela loja_futebol.vendas: ~3 rows (aproximadamente)
INSERT INTO `vendas` (`id`, `data_venda`, `id_usuario`, `vlr_total`) VALUES
	(1, '2025-05-19 02:29:42', 1, 459.790000),
	(2, '2025-05-19 02:30:29', 1, 649.700000),
	(3, '2025-05-25 03:05:06', 1, 199.990000);

-- Copiando estrutura para tabela loja_futebol.vendas_itens
CREATE TABLE IF NOT EXISTS `vendas_itens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `venda_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `venda_id` (`venda_id`),
  KEY `produto_id` (`produto_id`),
  CONSTRAINT `vendas_itens_ibfk_1` FOREIGN KEY (`venda_id`) REFERENCES `vendas` (`id`),
  CONSTRAINT `vendas_itens_ibfk_2` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela loja_futebol.vendas_itens: ~6 rows (aproximadamente)
INSERT INTO `vendas_itens` (`id`, `venda_id`, `produto_id`, `quantidade`) VALUES
	(2, 1, 1, 2),
	(3, 1, 2, 1),
	(4, 2, 8, 1),
	(5, 2, 12, 1),
	(6, 2, 3, 1),
	(7, 3, 2, 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
