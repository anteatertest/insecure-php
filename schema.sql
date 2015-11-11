SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='POSTGRESQL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `cs3235` ;
CREATE SCHEMA IF NOT EXISTS `cs3235` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `cs3235` ;

-- -----------------------------------------------------
-- Table `cs3235`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cs3235`.`users` ;

CREATE TABLE IF NOT EXISTS `cs3235`.`users` (
  `matric` VARCHAR(100) NOT NULL,
  `mcode` VARCHAR(100) NOT NULL,
  `grade` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`matric`, `mcode`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `cs3235`.`comments`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cs3235`.`comments` ;

CREATE TABLE IF NOT EXISTS `cs3235`.`comments` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `time` VARCHAR(100) NOT NULL,
  `content` TEXT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `cs3235`.`accounts`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cs3235`.`accounts` ;

CREATE TABLE IF NOT EXISTS `cs3235`.`accounts` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `password` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;
