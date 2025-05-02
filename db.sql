-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema agencia_autos
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema agencia_autos
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `agencia_autos` DEFAULT CHARACTER SET utf8 ;
USE `agencia_autos` ;

-- -----------------------------------------------------
-- Table `agencia_autos`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `agencia_autos`.`usuarios` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(60) NOT NULL,
  `rol` ENUM('empleado', 'admin') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `agencia_autos`.`vehiculos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `agencia_autos`.`vehiculos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `marca` VARCHAR(45) NOT NULL,
  `modelo` VARCHAR(45) NOT NULL,
  `anio` YEAR NOT NULL,
  `precio` DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

INSERT INTO `agencia_autos`.`usuarios` (`id`, `nombre`, `email`, `password`, `rol`)
VALUES (DEFAULT, 'Gonzalo', 'gonzalomiguelrigoni@gmail.com','$2y$10$YsFwFzgH16CXl.UTtlnJgOMq4SpVGnC3YjHN8/soz3xfgVJYfsQ2q', 'admin');