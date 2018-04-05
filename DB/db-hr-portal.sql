-- MySQL Script generated by MySQL Workbench
-- 04/05/18 14:56:06
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema DB_HR_portal
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema DB_HR_portal
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `DB_HR_portal` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `DB_HR_portal` ;

-- -----------------------------------------------------
-- Table `DB_HR_portal`.`Users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB_HR_portal`.`Users` (
  `idUsers` INT NOT NULL AUTO_INCREMENT,
  `firstname` VARCHAR(20) NULL,
  `lastname` VARCHAR(20) NULL,
  `username` VARCHAR(30) NULL,
  `usertype` VARCHAR(10) NULL COMMENT 'Leder/fadder etc',
  `password` VARCHAR(50) NULL,
  PRIMARY KEY (`idUsers`),
  UNIQUE INDEX `idUsers_UNIQUE` (`idUsers` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB_HR_portal`.`Checklist`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB_HR_portal`.`Checklist` (
  `idChecklist` INT NOT NULL AUTO_INCREMENT,
  `checkpoints` VARCHAR(200) NOT NULL,
  `responsible` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`idChecklist`),
  UNIQUE INDEX `idChecklist_UNIQUE` (`idChecklist` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB_HR_portal`.`Newemployee`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB_HR_portal`.`Newemployee` (
  `idNewemployee` INT NOT NULL AUTO_INCREMENT,
  `firstname` VARCHAR(45) NULL,
  `lastname` VARCHAR(45) NULL,
  `workposition` VARCHAR(45) NULL,
  `international` VARCHAR(10) NULL COMMENT 'Norsk/engelsk',
  `startdate` DATE NULL COMMENT 'Ansatt dato',
  PRIMARY KEY (`idNewemployee`),
  UNIQUE INDEX `idNewemployee_UNIQUE` (`idNewemployee` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB_HR_portal`.`Users_has_Newemployee`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB_HR_portal`.`Users_has_Newemployee` (
  `Users_idUsers` INT NOT NULL,
  `Newemployee_idNewemployee` INT NOT NULL,
  PRIMARY KEY (`Users_idUsers`, `Newemployee_idNewemployee`),
  INDEX `fk_Users_has_Newemployee_Newemployee1_idx` (`Newemployee_idNewemployee` ASC),
  INDEX `fk_Users_has_Newemployee_Users_idx` (`Users_idUsers` ASC),
  CONSTRAINT `fk_Users_has_Newemployee_Users`
    FOREIGN KEY (`Users_idUsers`)
    REFERENCES `DB_HR_portal`.`Users` (`idUsers`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Users_has_Newemployee_Newemployee1`
    FOREIGN KEY (`Newemployee_idNewemployee`)
    REFERENCES `DB_HR_portal`.`Newemployee` (`idNewemployee`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB_HR_portal`.`Newemployee_has_Checklist`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB_HR_portal`.`Newemployee_has_Checklist` (
  `Newemployee_idNewemployee` INT NOT NULL,
  `Checklist_idChecklist` INT NOT NULL,
  `checked` TINYINT(1) NULL,
  PRIMARY KEY (`Newemployee_idNewemployee`, `Checklist_idChecklist`),
  INDEX `fk_Newemployee_has_Checklist_Checklist1_idx` (`Checklist_idChecklist` ASC),
  INDEX `fk_Newemployee_has_Checklist_Newemployee1_idx` (`Newemployee_idNewemployee` ASC),
  CONSTRAINT `fk_Newemployee_has_Checklist_Newemployee1`
    FOREIGN KEY (`Newemployee_idNewemployee`)
    REFERENCES `DB_HR_portal`.`Newemployee` (`idNewemployee`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Newemployee_has_Checklist_Checklist1`
    FOREIGN KEY (`Checklist_idChecklist`)
    REFERENCES `DB_HR_portal`.`Checklist` (`idChecklist`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
