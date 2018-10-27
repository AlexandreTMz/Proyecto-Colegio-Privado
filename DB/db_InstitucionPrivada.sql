-- MySQL Script generated by MySQL Workbench
-- Mon Oct 22 09:22:34 2018
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `mydb` ;

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;




-- -----------------------------------------------------
-- Table `mydb`.`competencia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS competencia;

CREATE TABLE IF NOT EXISTS `mydb`.`competencia` (
  `id_competencia` char(7) NOT NULL,
  `nombre_competencia` VARCHAR(150) NULL,
  `numero_co` CHAR(1) NULL,
  PRIMARY KEY (`id_competencia`))
ENGINE = InnoDB;


-- procedimiento almacenado para ingresar las competencias
DELIMITER $$
DROP PROCEDURE IF EXISTS up_insertar_competencia$$
CREATE PROCEDURE  up_insertar_competencia
(
in id char(7),
in Nombre_competencia varchar(150),
in Numero_co char(1)
)
BEGIN
DECLARE contador INT(11);
    
        SET contador= (SELECT COUNT(*)+1 FROM competencia); 
        IF(contador<10)THEN
            SET id= CONCAT('C0000',contador);
        ELSE IF(contador<100) THEN
            SET id= CONCAT('C000',contador);
        ELSE IF(contador<1000)THEN
            SET id= CONCAT('C00',contador);
        ELSE IF(contador<10000)THEN
            SET id= CONCAT('C0',contador);
        ELSE IF(contador<100000)THEN
        SET id= CONCAT('C',contador);
        END IF;
        END IF;        
        END IF;
        END IF;
        END IF; 
    
insert into competencia(id_competencia,nombre_competencia,numero_co) values(id,Nombre_competencia,Numero_co);
END

