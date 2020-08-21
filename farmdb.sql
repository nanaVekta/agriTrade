-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema agric_db
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema agric_db
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `agric_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `agric_db` ;

-- -----------------------------------------------------
-- Table `agric_db`.`Farmer`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `agric_db`.`Farmer` (
  `Farm_Id` INT NOT NULL COMMENT '',
  `username` VARCHAR(45) NOT NULL COMMENT '',
  `password` VARCHAR(45) NOT NULL COMMENT '',
  `name` VARCHAR(100) NOT NULL COMMENT '',
  `number` VARCHAR(45) NOT NULL COMMENT '',
  `region` VARCHAR(45) NOT NULL COMMENT '',
  `district` VARCHAR(45) NOT NULL COMMENT '',
  `town` VARCHAR(45) NOT NULL COMMENT '',
  PRIMARY KEY (`Farm_Id`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `agric_db`.`Buyer`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `agric_db`.`Buyer` (
  `Buy_Id` INT NOT NULL COMMENT '',
  `username` VARCHAR(45) NOT NULL COMMENT '',
  `password` VARCHAR(45) NOT NULL COMMENT '',
  `name` VARCHAR(100) NOT NULL COMMENT '',
  `number` VARCHAR(45) NOT NULL COMMENT '',
  `region` VARCHAR(45) NOT NULL COMMENT '',
  `district` VARCHAR(45) NOT NULL COMMENT '',
  `town` VARCHAR(45) NOT NULL COMMENT '',
  PRIMARY KEY (`Buy_Id`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `agric_db`.`Buy_mark`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `agric_db`.`Buy_mark` (
  `bm_Id` INT NOT NULL COMMENT '',
  `products` VARCHAR(45) NOT NULL COMMENT '',
  `description` VARCHAR(45) NOT NULL COMMENT '',
  `quantity` INT NOT NULL COMMENT '',
  `duration` DATE NOT NULL COMMENT '',
  PRIMARY KEY (`bm_Id`)  COMMENT '',
  CONSTRAINT `bm_Id`
    FOREIGN KEY (`bm_Id`)
    REFERENCES `agric_db`.`Buyer` (`Buy_Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `agric_db`.`Farm_mark`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `agric_db`.`Farm_mark` (
  `fm_Id` INT NOT NULL COMMENT '',
  `description` VARCHAR(45) NOT NULL COMMENT '',
  `quantity_a` INT NOT NULL COMMENT '',
  `quantity_b` INT NULL COMMENT '',
  PRIMARY KEY (`fm_Id`)  COMMENT '',
  CONSTRAINT `fm_Id`
    FOREIGN KEY (`fm_Id`)
    REFERENCES `agric_db`.`Farmer` (`Farm_Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
