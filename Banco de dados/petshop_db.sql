-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema petshop_db
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema petshop_db
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `petshop_db` DEFAULT CHARACTER SET utf8 ;
USE `petshop_db` ;

-- -----------------------------------------------------
-- Table `petshop_db`.`alimentos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `petshop_db`.`alimentos` (
  `idalimentos` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NULL DEFAULT NULL,
  `sabor` VARCHAR(100) NULL DEFAULT NULL,
  `categoria` VARCHAR(100) NULL DEFAULT NULL,
  `marca` VARCHAR(100) NULL DEFAULT NULL,
  `peso` VARCHAR(50) NULL DEFAULT NULL,
  `validade` DATE NULL DEFAULT NULL,
  `faixa_etaria` VARCHAR(50) NULL DEFAULT NULL,
  `codigo` INT(11) NULL DEFAULT NULL,
  `fabricante` VARCHAR(100) NULL DEFAULT NULL,
  `valor` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`idalimentos`))
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `petshop_db`.`brinquedos/acessorios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `petshop_db`.`brinquedos/acessorios` (
  `idbrinquedos/acessorios` INT(11) NOT NULL AUTO_INCREMENT,
  `marca` VARCHAR(100) NULL DEFAULT NULL,
  `nome` VARCHAR(100) NULL DEFAULT NULL,
  `material` VARCHAR(100) NULL DEFAULT NULL,
  `cores` VARCHAR(100) NULL DEFAULT NULL,
  `fabricacao` DATE NULL DEFAULT NULL,
  `faixa_etaria` VARCHAR(50) NULL DEFAULT NULL,
  `tamanho` VARCHAR(50) NULL DEFAULT NULL,
  `especie_indicada` VARCHAR(100) NULL DEFAULT NULL,
  `beneficios` VARCHAR(100) NULL DEFAULT NULL,
  `codigo` INT(11) NULL DEFAULT NULL,
  `fabricante` VARCHAR(100) NULL DEFAULT NULL,
  `valor` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`idbrinquedos/acessorios`))
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `petshop_db`.`higiene`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `petshop_db`.`higiene` (
  `idhigiene` INT(11) NOT NULL AUTO_INCREMENT,
  `marca` VARCHAR(100) NULL DEFAULT NULL,
  `nome` VARCHAR(100) NULL DEFAULT NULL,
  `beneficios` VARCHAR(100) NULL DEFAULT NULL,
  `finalidade` VARCHAR(150) NULL DEFAULT NULL,
  `precausoes` VARCHAR(100) NULL DEFAULT NULL,
  `validade` DATE NULL DEFAULT NULL,
  `material` VARCHAR(100) NULL DEFAULT NULL,
  `alertas` VARCHAR(100) NULL DEFAULT NULL,
  `codigo` INT(11) NULL DEFAULT NULL,
  `fabricante` VARCHAR(100) NULL DEFAULT NULL,
  `valor` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`idhigiene`))
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `petshop_db`.`medicamentos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `petshop_db`.`medicamentos` (
  `idmedicamentos` INT(11) NOT NULL AUTO_INCREMENT,
  `marca` VARCHAR(100) NULL DEFAULT NULL,
  `nome` VARCHAR(100) NULL DEFAULT NULL,
  `peso` VARCHAR(50) NULL DEFAULT NULL,
  `validade` DATE NULL DEFAULT NULL,
  `vencimento` DATE NULL DEFAULT NULL,
  `faixa_etaria` VARCHAR(50) NULL DEFAULT NULL,
  `especialidade` VARCHAR(100) NULL DEFAULT NULL,
  `beneficios` VARCHAR(100) NULL DEFAULT NULL,
  `precausoes` VARCHAR(100) NULL DEFAULT NULL,
  `finalidade` VARCHAR(100) NULL DEFAULT NULL,
  `codigo` INT(11) NULL DEFAULT NULL,
  `fabricante` VARCHAR(100) NULL DEFAULT NULL,
  `valor` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`idmedicamentos`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
