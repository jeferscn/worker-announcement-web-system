-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: sistema_anuncios
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `anuncio`
--

DROP TABLE IF EXISTS `anuncio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `anuncio` (
  `id_anuncio` int(4) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(200) DEFAULT NULL,
  `categoria` varchar(100) DEFAULT NULL,
  `preco` decimal(7,2) DEFAULT NULL,
  `fk_id_usuario` int(4) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `status` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id_anuncio`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anuncio`
--

LOCK TABLES `anuncio` WRITE;
/*!40000 ALTER TABLE `anuncio` DISABLE KEYS */;
INSERT INTO `anuncio` VALUES (4,'Serviços de Jardinagem estão relacionados com a administração e a manutenção de jardins, formação de jardins, limpeza e conservação, podas, controle de pragas e tratamento de doenças.','Jardinagem',12.00,3,'41999944444','anúncio ativo'),(6,'Serviços de Jardinagem estão relacionados com a administração e a manutenção de jardins, formação de jardins, limpeza e conservação, podas, controle de pragas e tratamento de doenças.','Jardinagem',10.00,3,'41999944444','anúncio ativo'),(7,'Serviços de Jardinagem estão relacionados com a administração e a manutenção de jardins, formação de jardins, limpeza e conservação, podas, controle de pragas e tratamento de doenças.','Jardinagem',13.50,3,'41999944444','anúncio ativo'),(13,'Instalar e ajustar esquadrias de madeira e outras peças tais como: janelas, portas, escadas, rodapés, divisórias, forros e guardições. Construir formas de madeira para concretagem.','Carpintaria',45.00,14,'55444444444','anúncio ativo'),(15,'ASAAAAAAAAAAAAAAAAAAA','Técnico de Informática',45.00,15,'41888888888','anúncio ativo'),(23,'Serviços de técnico de informática relacionados a formatação, backup de arquivos, recuperação de dados de HD, limpezas, manutenções em geral. Atendo toda região de curitiba sem taxas.','Técnico de Informática',100.00,16,'41999999999','anúncio ativo'),(34,'TesteTestee','Jardinagem',45.55,25,'41999999999','anúncio ativo'),(35,'Testeteste1','Jardinagem',55.55,26,'41999999999','anúncio ativo');
/*!40000 ALTER TABLE `anuncio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria` (
  `id_categoria` int(4) NOT NULL AUTO_INCREMENT,
  `nome_categoria` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (7,'Técnico de Informática'),(8,'Carpintaria'),(10,'Jardinagem'),(11,'Padeiro'),(14,'Alfaiate');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id_usuario` int(4) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) DEFAULT NULL,
  `login` varchar(30) DEFAULT NULL,
  `senha` varchar(80) DEFAULT NULL,
  `nivel` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (3,'Evelyn','evelyn','202cb962ac59075b964b07152d234b70','USER'),(4,'Administrador','admin','202cb962ac59075b964b07152d234b70','ADM'),(10,'Paulo','paulo','e10adc3949ba59abbe56e057f20f883e','USER'),(12,'David','david','81dc9bdb52d04dc20036dbd8313ed055','USER'),(13,'Pedro','pedro','202cb962ac59075b964b07152d234b70','USER'),(14,'João','joao','202cb962ac59075b964b07152d234b70','USER'),(15,'David','david1','202cb962ac59075b964b07152d234b70','USER'),(16,'Jeferson','jeferson1','202cb962ac59075b964b07152d234b70','USER'),(17,'','','',''),(18,'','','',''),(19,'Pedro1','pedro1','202cb962ac59075b964b07152d234b70','USER'),(20,'Jeferson','jefe','202cb962ac59075b964b07152d234b70','USER'),(21,'Jeferson','jefer','202cb962ac59075b964b07152d234b70','USER'),(22,'Jeferson','jefers','202cb962ac59075b964b07152d234b70','USER'),(23,'Teste','teste','202cb962ac59075b964b07152d234b70','USER'),(24,'teste1','teste1','202cb962ac59075b964b07152d234b70','USER'),(25,'teste2','teste2','202cb962ac59075b964b07152d234b70','USER'),(26,'teste3','teste3','202cb962ac59075b964b07152d234b70','USER'),(27,'Pedro2','pedro2','202cb962ac59075b964b07152d234b70','USER');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-04-25 15:58:41
