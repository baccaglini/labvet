CREATE DATABASE  IF NOT EXISTS `labvet` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `labvet`;
-- MySQL dump 10.13  Distrib 5.7.13, for Linux (x86_64)
--
-- Host: localhost    Database: labvet
-- ------------------------------------------------------
-- Server version	5.7.13-0ubuntu0.16.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `acesso`
--

DROP TABLE IF EXISTS `acesso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acesso` (
  `usuario` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `ip` varchar(100) NOT NULL,
  KEY `fk_acesso_usuario1_idx` (`usuario`),
  CONSTRAINT `fk_acesso_usuario1` FOREIGN KEY (`usuario`) REFERENCES `administrador` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acesso`
--

LOCK TABLES `acesso` WRITE;
/*!40000 ALTER TABLE `acesso` DISABLE KEYS */;
/*!40000 ALTER TABLE `acesso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `administrador`
--

DROP TABLE IF EXISTS `administrador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `administrador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cpf` varchar(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `adm` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cpf_UNIQUE` (`cpf`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrador`
--

LOCK TABLES `administrador` WRITE;
/*!40000 ALTER TABLE `administrador` DISABLE KEYS */;
INSERT INTO `administrador` VALUES (1,'29504811833','ROGERIO BACCAGLINI','roger.baccaglini@gmail.com','teste123',1,1);
/*!40000 ALTER TABLE `administrador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `amostra`
--

DROP TABLE IF EXISTS `amostra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `amostra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amaostra` varchar(255) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `amostra`
--

LOCK TABLES `amostra` WRITE;
/*!40000 ALTER TABLE `amostra` DISABLE KEYS */;
/*!40000 ALTER TABLE `amostra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `atendimento`
--

DROP TABLE IF EXISTS `atendimento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `atendimento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proprietario` int(11) NOT NULL,
  `sequencia` int(3) NOT NULL,
  `veterinario` int(11) NOT NULL,
  `clinica` int(11) NOT NULL,
  `exame` int(11) NOT NULL,
  `amaostra` int(11) NOT NULL,
  `valor` double(10,2) NOT NULL,
  `liberacao` date DEFAULT NULL,
  `obs` text,
  `usuario` int(11) NOT NULL,
  `cadastro` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_atendimento_proprietario_animal1_idx` (`proprietario`,`sequencia`),
  KEY `fk_atendimento_veterinario1_idx` (`veterinario`),
  KEY `fk_atendimento_exame_amostra1_idx` (`exame`,`amaostra`),
  KEY `fk_atendimento_usuario1_idx` (`usuario`),
  KEY `fk_atendimento_clinica1_idx` (`clinica`),
  CONSTRAINT `fk_atendimento_clinica1` FOREIGN KEY (`clinica`) REFERENCES `clinica` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_atendimento_exame_amostra1` FOREIGN KEY (`exame`, `amaostra`) REFERENCES `exame_amostra` (`exame`, `amostra`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_atendimento_proprietario_animal1` FOREIGN KEY (`proprietario`, `sequencia`) REFERENCES `proprietario_animal` (`proprietario`, `sequencia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_atendimento_usuario1` FOREIGN KEY (`usuario`) REFERENCES `administrador` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_atendimento_veterinario1` FOREIGN KEY (`veterinario`) REFERENCES `veterinario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `atendimento`
--

LOCK TABLES `atendimento` WRITE;
/*!40000 ALTER TABLE `atendimento` DISABLE KEYS */;
/*!40000 ALTER TABLE `atendimento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clinica`
--

DROP TABLE IF EXISTS `clinica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clinica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cnpj` varchar(45) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `razaoSocial` varchar(255) NOT NULL,
  `cadastro` datetime NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cnpj_UNIQUE` (`cnpj`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clinica`
--

LOCK TABLES `clinica` WRITE;
/*!40000 ALTER TABLE `clinica` DISABLE KEYS */;
/*!40000 ALTER TABLE `clinica` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clinica_email`
--

DROP TABLE IF EXISTS `clinica_email`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clinica_email` (
  `clinica` int(11) NOT NULL,
  `sequencia` int(2) NOT NULL,
  `email` varchar(45) NOT NULL,
  `principal` tinyint(1) NOT NULL DEFAULT '0',
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`clinica`,`sequencia`),
  CONSTRAINT `fk_clinica_email_clinica1` FOREIGN KEY (`clinica`) REFERENCES `clinica` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clinica_email`
--

LOCK TABLES `clinica_email` WRITE;
/*!40000 ALTER TABLE `clinica_email` DISABLE KEYS */;
/*!40000 ALTER TABLE `clinica_email` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clinica_endereco`
--

DROP TABLE IF EXISTS `clinica_endereco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clinica_endereco` (
  `clinica` int(11) NOT NULL,
  `sequencia` int(2) NOT NULL,
  `principal` tinyint(1) NOT NULL,
  `cep` varchar(11) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `logradouro` varchar(255) NOT NULL,
  `numero` varchar(6) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`clinica`,`sequencia`),
  CONSTRAINT `fk_clinica_endereco_clinica1` FOREIGN KEY (`clinica`) REFERENCES `clinica` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clinica_endereco`
--

LOCK TABLES `clinica_endereco` WRITE;
/*!40000 ALTER TABLE `clinica_endereco` DISABLE KEYS */;
/*!40000 ALTER TABLE `clinica_endereco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clinica_fone`
--

DROP TABLE IF EXISTS `clinica_fone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clinica_fone` (
  `clinica` int(11) NOT NULL,
  `sequencia` int(2) NOT NULL,
  `principal` tinyint(1) NOT NULL DEFAULT '0',
  `fone` varchar(45) NOT NULL,
  `obs` text,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`clinica`,`sequencia`),
  CONSTRAINT `fk_clinica_fone_clinica1` FOREIGN KEY (`clinica`) REFERENCES `clinica` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clinica_fone`
--

LOCK TABLES `clinica_fone` WRITE;
/*!40000 ALTER TABLE `clinica_fone` DISABLE KEYS */;
/*!40000 ALTER TABLE `clinica_fone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `especie`
--

DROP TABLE IF EXISTS `especie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `especie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `especie` varchar(255) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `especie`
--

LOCK TABLES `especie` WRITE;
/*!40000 ALTER TABLE `especie` DISABLE KEYS */;
/*!40000 ALTER TABLE `especie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exame`
--

DROP TABLE IF EXISTS `exame`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exame` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exame` varchar(255) NOT NULL,
  `valor` double(10,2) NOT NULL,
  `prazo` int(2) NOT NULL COMMENT 'prazo para validade do vaolor indicado',
  `liberacao` int(3) NOT NULL COMMENT 'dias para a liberação do exeme',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exame`
--

LOCK TABLES `exame` WRITE;
/*!40000 ALTER TABLE `exame` DISABLE KEYS */;
/*!40000 ALTER TABLE `exame` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exame_amostra`
--

DROP TABLE IF EXISTS `exame_amostra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exame_amostra` (
  `exame` int(11) NOT NULL,
  `amostra` int(11) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`exame`,`amostra`),
  KEY `fk_exame_amostra_amostra1_idx` (`amostra`),
  CONSTRAINT `fk_exame_amostra_amostra1` FOREIGN KEY (`amostra`) REFERENCES `amostra` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_exame_amostra_exame1` FOREIGN KEY (`exame`) REFERENCES `exame` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exame_amostra`
--

LOCK TABLES `exame_amostra` WRITE;
/*!40000 ALTER TABLE `exame_amostra` DISABLE KEYS */;
/*!40000 ALTER TABLE `exame_amostra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feriados`
--

DROP TABLE IF EXISTS `feriados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feriados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `feriado` varchar(255) NOT NULL,
  `data` date NOT NULL,
  `tipo` int(11) NOT NULL,
  `ciclico` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_feriados_tipo_feriado1_idx` (`tipo`),
  CONSTRAINT `fk_feriados_tipo_feriado1` FOREIGN KEY (`tipo`) REFERENCES `tipo_feriado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feriados`
--

LOCK TABLES `feriados` WRITE;
/*!40000 ALTER TABLE `feriados` DISABLE KEYS */;
/*!40000 ALTER TABLE `feriados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proprietario`
--

DROP TABLE IF EXISTS `proprietario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proprietario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `cpf` varchar(11) DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cpf_UNIQUE` (`cpf`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proprietario`
--

LOCK TABLES `proprietario` WRITE;
/*!40000 ALTER TABLE `proprietario` DISABLE KEYS */;
/*!40000 ALTER TABLE `proprietario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proprietario_animal`
--

DROP TABLE IF EXISTS `proprietario_animal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proprietario_animal` (
  `proprietario` int(11) NOT NULL,
  `sequencia` int(3) NOT NULL,
  `animal` varchar(255) NOT NULL,
  `raca` int(11) NOT NULL,
  `sexo` varchar(2) NOT NULL,
  `cor` varchar(45) NOT NULL,
  `nascimento` date DEFAULT NULL,
  `obs` text,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`proprietario`,`sequencia`),
  KEY `fk_proprietario_animal_raca1_idx` (`raca`),
  CONSTRAINT `fk_proprietario_animal_proprietario1` FOREIGN KEY (`proprietario`) REFERENCES `proprietario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_proprietario_animal_raca1` FOREIGN KEY (`raca`) REFERENCES `raca` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proprietario_animal`
--

LOCK TABLES `proprietario_animal` WRITE;
/*!40000 ALTER TABLE `proprietario_animal` DISABLE KEYS */;
/*!40000 ALTER TABLE `proprietario_animal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proprietario_email`
--

DROP TABLE IF EXISTS `proprietario_email`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proprietario_email` (
  `proprietario` int(11) NOT NULL,
  `sequencia` int(2) NOT NULL,
  `email` varchar(255) NOT NULL,
  `principal` tinyint(1) NOT NULL DEFAULT '0',
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`proprietario`,`sequencia`),
  CONSTRAINT `fk_proprietario_email_proprietario1` FOREIGN KEY (`proprietario`) REFERENCES `proprietario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proprietario_email`
--

LOCK TABLES `proprietario_email` WRITE;
/*!40000 ALTER TABLE `proprietario_email` DISABLE KEYS */;
/*!40000 ALTER TABLE `proprietario_email` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proprietario_endereco`
--

DROP TABLE IF EXISTS `proprietario_endereco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proprietario_endereco` (
  `proprietario` int(11) NOT NULL,
  `cep` varchar(11) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `logradouro` varchar(255) NOT NULL,
  `numero` varchar(6) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`proprietario`),
  CONSTRAINT `fk_endereco_proprietario_proprietario1` FOREIGN KEY (`proprietario`) REFERENCES `proprietario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proprietario_endereco`
--

LOCK TABLES `proprietario_endereco` WRITE;
/*!40000 ALTER TABLE `proprietario_endereco` DISABLE KEYS */;
/*!40000 ALTER TABLE `proprietario_endereco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proprietario_fone`
--

DROP TABLE IF EXISTS `proprietario_fone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proprietario_fone` (
  `proprietario` int(11) NOT NULL,
  `sequencia` int(2) NOT NULL,
  `fone` varchar(45) NOT NULL,
  `obs` text,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`proprietario`,`sequencia`),
  CONSTRAINT `fk_contato_proprietario_proprietario1` FOREIGN KEY (`proprietario`) REFERENCES `proprietario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proprietario_fone`
--

LOCK TABLES `proprietario_fone` WRITE;
/*!40000 ALTER TABLE `proprietario_fone` DISABLE KEYS */;
/*!40000 ALTER TABLE `proprietario_fone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `raca`
--

DROP TABLE IF EXISTS `raca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `raca` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `especie` int(11) NOT NULL,
  `raca` varchar(255) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_raca_especie_idx` (`especie`),
  CONSTRAINT `fk_raca_especie` FOREIGN KEY (`especie`) REFERENCES `especie` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `raca`
--

LOCK TABLES `raca` WRITE;
/*!40000 ALTER TABLE `raca` DISABLE KEYS */;
/*!40000 ALTER TABLE `raca` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_feriado`
--

DROP TABLE IF EXISTS `tipo_feriado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_feriado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL COMMENT 'feriado nascional, estadual, municipal ou mundial',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_feriado`
--

LOCK TABLES `tipo_feriado` WRITE;
/*!40000 ALTER TABLE `tipo_feriado` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipo_feriado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `veterinario`
--

DROP TABLE IF EXISTS `veterinario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `veterinario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `crmv` varchar(45) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `veterinario`
--

LOCK TABLES `veterinario` WRITE;
/*!40000 ALTER TABLE `veterinario` DISABLE KEYS */;
/*!40000 ALTER TABLE `veterinario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `veterinario_clinica`
--

DROP TABLE IF EXISTS `veterinario_clinica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `veterinario_clinica` (
  `veterinario` int(11) NOT NULL,
  `clinica` int(11) NOT NULL,
  `ativo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`veterinario`,`clinica`),
  KEY `fk_veterinario_clinica_clinica1_idx` (`clinica`),
  CONSTRAINT `fk_veterinario_clinica_clinica1` FOREIGN KEY (`clinica`) REFERENCES `clinica` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_veterinario_clinica_veterinario1` FOREIGN KEY (`veterinario`) REFERENCES `veterinario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `veterinario_clinica`
--

LOCK TABLES `veterinario_clinica` WRITE;
/*!40000 ALTER TABLE `veterinario_clinica` DISABLE KEYS */;
/*!40000 ALTER TABLE `veterinario_clinica` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `veterinario_email`
--

DROP TABLE IF EXISTS `veterinario_email`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `veterinario_email` (
  `veterinario` int(11) NOT NULL,
  `sequencia` int(2) NOT NULL,
  `email` varchar(150) NOT NULL,
  `princia` tinyint(1) NOT NULL DEFAULT '0',
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`veterinario`),
  CONSTRAINT `fk_veterinario_email_veterinario1` FOREIGN KEY (`veterinario`) REFERENCES `veterinario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `veterinario_email`
--

LOCK TABLES `veterinario_email` WRITE;
/*!40000 ALTER TABLE `veterinario_email` DISABLE KEYS */;
/*!40000 ALTER TABLE `veterinario_email` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `veterinario_endereco`
--

DROP TABLE IF EXISTS `veterinario_endereco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `veterinario_endereco` (
  `veterinario` int(11) NOT NULL,
  `cep` varchar(11) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `logradouro` varchar(255) NOT NULL,
  `numero` varchar(6) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`veterinario`),
  CONSTRAINT `fk_veterinario_endereco_veterinario1` FOREIGN KEY (`veterinario`) REFERENCES `veterinario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `veterinario_endereco`
--

LOCK TABLES `veterinario_endereco` WRITE;
/*!40000 ALTER TABLE `veterinario_endereco` DISABLE KEYS */;
/*!40000 ALTER TABLE `veterinario_endereco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `veterinario_fone`
--

DROP TABLE IF EXISTS `veterinario_fone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `veterinario_fone` (
  `veterinario` int(11) NOT NULL,
  `sequencia` int(2) NOT NULL,
  `princiapl` tinyint(1) NOT NULL DEFAULT '0',
  `fone` varchar(45) NOT NULL,
  `obs` text,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`veterinario`,`sequencia`),
  CONSTRAINT `fk_veterinario_fone_veterinario1` FOREIGN KEY (`veterinario`) REFERENCES `veterinario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `veterinario_fone`
--

LOCK TABLES `veterinario_fone` WRITE;
/*!40000 ALTER TABLE `veterinario_fone` DISABLE KEYS */;
/*!40000 ALTER TABLE `veterinario_fone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'labvet'
--

--
-- Dumping routines for database 'labvet'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-08-30  9:59:47
