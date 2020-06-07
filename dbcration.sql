-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema languagesys
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `languagesys` ;

-- -----------------------------------------------------
-- Schema languagesys
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `languagesys` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci ;
USE `languagesys` ;

-- -----------------------------------------------------
-- Table `languagesys`.`course`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `languagesys`.`course` ;

CREATE TABLE IF NOT EXISTS `languagesys`.`course` (
  `idcourse` INT(11) NOT NULL,
  `coursename` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idcourse`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `languagesys`.`student`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `languagesys`.`student` ;

CREATE TABLE IF NOT EXISTS `languagesys`.`student` (
  `idstudent` INT(11) NOT NULL,
  `name` VARCHAR(45) NULL DEFAULT NULL,
  `password` VARCHAR(128) NULL DEFAULT NULL,
  PRIMARY KEY (`idstudent`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `languagesys`.`lesson`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `languagesys`.`lesson` ;

CREATE TABLE IF NOT EXISTS `languagesys`.`lesson` (
  `idlesson` INT(11) NOT NULL,
  `lesson_cid` INT(11) NULL DEFAULT NULL,
  `lesson_sid` INT(11) NULL DEFAULT NULL,
  `name` VARCHAR(45) NULL DEFAULT NULL,
  `grade` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idlesson`),
  INDEX `cid_idx` (`lesson_cid` ASC) VISIBLE,
  INDEX `sid_idx` (`lesson_sid` ASC) VISIBLE,
  CONSTRAINT `lesson_cid`
    FOREIGN KEY (`lesson_cid`)
    REFERENCES `languagesys`.`course` (`idcourse`),
  CONSTRAINT `lesson_sid`
    FOREIGN KEY (`lesson_sid`)
    REFERENCES `languagesys`.`student` (`idstudent`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `languagesys`.`takes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `languagesys`.`takes` ;

CREATE TABLE IF NOT EXISTS `languagesys`.`takes` (
  `takes_cid` INT(11) NOT NULL,
  `takes_sid` INT(11) NOT NULL,
  INDEX `cid_idx` (`takes_cid` ASC) VISIBLE,
  INDEX `takes_sid_idx` (`takes_sid` ASC) VISIBLE,
  CONSTRAINT `takes_cid`
    FOREIGN KEY (`takes_cid`)
    REFERENCES `languagesys`.`course` (`idcourse`),
  CONSTRAINT `takes_sid`
    FOREIGN KEY (`takes_sid`)
    REFERENCES `languagesys`.`student` (`idstudent`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
