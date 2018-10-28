-- MySQL Script generated by MySQL Workbench
-- Sun Oct 28 15:24:20 2018
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
-- Table `mydb`.`tipos_documentos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`tipos_documentos` (
  `id_tdocumento` INT(11) NOT NULL AUTO_INCREMENT,
  `tipo_documento` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id_tdocumento`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`estados_civiles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`estados_civiles` (
  `id_ecivil` INT(11) NOT NULL AUTO_INCREMENT,
  `estado_civil` VARCHAR(60) NOT NULL,
  PRIMARY KEY (`id_ecivil`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`personas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`personas` (
  `id_persona` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `apellido_paterno` VARCHAR(50) NOT NULL,
  `apellido_materno` VARCHAR(50) NOT NULL,
  `numero_documento` VARCHAR(20) NOT NULL,
  `fecha_nacimiento` DATE NOT NULL,
  `sexo` CHAR(1) NOT NULL,
  `direccion` VARCHAR(80) NOT NULL,
  `telefono` VARCHAR(20) NOT NULL,
  `id_tdocumento` INT(11) NOT NULL,
  `id_ecivil` INT(11) NOT NULL,
  PRIMARY KEY (`id_persona`),
  UNIQUE INDEX `dni_UNIQUE` (`numero_documento` ASC),
  INDEX `fk_personas_tipos_documentos1_idx` (`id_tdocumento` ASC),
  INDEX `fk_personas_estados_civiles1_idx` (`id_ecivil` ASC),
  CONSTRAINT `fk_personas_tipos_documentos1`
    FOREIGN KEY (`id_tdocumento`)
    REFERENCES `mydb`.`tipos_documentos` (`id_tdocumento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_personas_estados_civiles1`
    FOREIGN KEY (`id_ecivil`)
    REFERENCES `mydb`.`estados_civiles` (`id_ecivil`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`funciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`funciones` (
  `id_funcion` INT(11) NOT NULL AUTO_INCREMENT,
  `funcion` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id_funcion`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`docentes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`docentes` (
  `id_persona` INT(11) NOT NULL,
  `estado` CHAR(1) NOT NULL,
  `id_funcion` INT(11) NOT NULL,
  PRIMARY KEY (`id_persona`),
  INDEX `fk_docentes_personas1_idx` (`id_persona` ASC),
  INDEX `fk_personales_funciones1_idx` (`id_funcion` ASC),
  CONSTRAINT `fk_docentes_personas1`
    FOREIGN KEY (`id_persona`)
    REFERENCES `mydb`.`personas` (`id_persona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_personales_funciones1`
    FOREIGN KEY (`id_funcion`)
    REFERENCES `mydb`.`funciones` (`id_funcion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`notas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`notas` (
  `id_nota` INT(11) NOT NULL AUTO_INCREMENT,
  `nota` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id_nota`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`periodos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`periodos` (
  `id_periodo` INT(11) NOT NULL AUTO_INCREMENT,
  `periodo` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id_periodo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`secciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`secciones` (
  `id_seccion` INT(11) NOT NULL AUTO_INCREMENT,
  `seccion` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id_seccion`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`grados`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`grados` (
  `id_grado` INT(11) NOT NULL AUTO_INCREMENT,
  `grado` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id_grado`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`niveles_instrucciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`niveles_instrucciones` (
  `id_ninstruccion` INT(11) NOT NULL AUTO_INCREMENT,
  `nivel_instruccion` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id_ninstruccion`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`registros_calificaciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`registros_calificaciones` (
  `id_rcalificacion` INT(11) NOT NULL AUTO_INCREMENT,
  `fecha` DATE NOT NULL,
  `hora` TIME NOT NULL,
  `id_periodo` INT(11) NOT NULL,
  `id_grado` INT(11) NOT NULL,
  `id_seccion` INT(11) NOT NULL,
  `id_docente` INT(11) NOT NULL,
  PRIMARY KEY (`id_rcalificacion`),
  INDEX `fk_registros_calificacion_periodos1_idx` (`id_periodo` ASC),
  INDEX `fk_registros_calificacion_grados1_idx` (`id_grado` ASC),
  INDEX `fk_registros_calificacion_docentes1_idx` (`id_docente` ASC),
  INDEX `fk_registros_calificaciones_secciones1_idx` (`id_seccion` ASC),
  CONSTRAINT `fk_registros_calificacion_periodos1`
    FOREIGN KEY (`id_periodo`)
    REFERENCES `mydb`.`periodos` (`id_periodo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_registros_calificacion_grados1`
    FOREIGN KEY (`id_grado`)
    REFERENCES `mydb`.`grados` (`id_grado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_registros_calificacion_docentes1`
    FOREIGN KEY (`id_docente`)
    REFERENCES `mydb`.`docentes` (`id_persona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_registros_calificaciones_secciones1`
    FOREIGN KEY (`id_seccion`)
    REFERENCES `mydb`.`secciones` (`id_seccion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`estudiantes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`estudiantes` (
  `id_persona` INT(11) NOT NULL,
  `codigo_estudiante` VARCHAR(20) NOT NULL,
  INDEX `fk_estudiantes_personas1_idx` (`id_persona` ASC),
  PRIMARY KEY (`id_persona`),
  UNIQUE INDEX `codigo_estudiante_UNIQUE` (`codigo_estudiante` ASC),
  CONSTRAINT `fk_estudiantes_personas1`
    FOREIGN KEY (`id_persona`)
    REFERENCES `mydb`.`personas` (`id_persona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`alumnos_rcalificacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`alumnos_rcalificacion` (
  `id_arcalificacion` INT(11) NOT NULL AUTO_INCREMENT,
  `id_rcalificacion` INT(11) NOT NULL,
  `id_estudiante` INT(11) NOT NULL,
  `nota_final` VARCHAR(2) NOT NULL,
  INDEX `fk_alumnos_has_registros_calificacion_registros_calificacio_idx` (`id_rcalificacion` ASC),
  PRIMARY KEY (`id_arcalificacion`),
  CONSTRAINT `fk_alumnos_has_registros_calificacion_registros_calificacion1`
    FOREIGN KEY (`id_rcalificacion`)
    REFERENCES `mydb`.`registros_calificaciones` (`id_rcalificacion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_alumnos_rcalificacion_estudiantes1`
    FOREIGN KEY (`id_estudiante`)
    REFERENCES `mydb`.`estudiantes` (`id_persona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`arcalificacion_notas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`arcalificacion_notas` (
  `id_arcnotas` INT(11) NOT NULL AUTO_INCREMENT,
  `id_arcalificacion` INT(11) NOT NULL,
  `id_nota` INT(11) NOT NULL,
  INDEX `fk_alumnos_rcalificacion_has_notas_notas1_idx` (`id_nota` ASC),
  PRIMARY KEY (`id_arcnotas`),
  INDEX `fk_arcalificacion_notas_alumnos_rcalificacion1_idx` (`id_arcalificacion` ASC),
  CONSTRAINT `fk_alumnos_rcalificacion_has_notas_notas1`
    FOREIGN KEY (`id_nota`)
    REFERENCES `mydb`.`notas` (`id_nota`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_arcalificacion_notas_alumnos_rcalificacion1`
    FOREIGN KEY (`id_arcalificacion`)
    REFERENCES `mydb`.`alumnos_rcalificacion` (`id_arcalificacion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`aulas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`aulas` (
  `id_aula` INT(11) NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(100) NOT NULL,
  `numero_aula` VARCHAR(50) NOT NULL,
  `numero_alumno` VARCHAR(10) NOT NULL,
  `turno` CHAR(1) NOT NULL,
  `id_docente` INT(11) NOT NULL,
  `id_grado` INT(11) NOT NULL,
  `id_seccion` INT(11) NOT NULL,
  PRIMARY KEY (`id_aula`),
  INDEX `fk_aulas_docentes1_idx` (`id_docente` ASC),
  INDEX `fk_aulas_grados1_idx` (`id_grado` ASC),
  INDEX `fk_aulas_secciones1_idx` (`id_seccion` ASC),
  CONSTRAINT `fk_aulas_docentes1`
    FOREIGN KEY (`id_docente`)
    REFERENCES `mydb`.`docentes` (`id_persona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_aulas_grados1`
    FOREIGN KEY (`id_grado`)
    REFERENCES `mydb`.`grados` (`id_grado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_aulas_secciones1`
    FOREIGN KEY (`id_seccion`)
    REFERENCES `mydb`.`secciones` (`id_seccion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`especialidades`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`especialidades` (
  `id_especialidade` INT(11) NOT NULL,
  `descripcion` VARCHAR(100) NOT NULL,
  `fecha_inicio` DATE NOT NULL,
  `fecha_fin` DATE NOT NULL,
  `estado` CHAR(1) NOT NULL,
  PRIMARY KEY (`id_especialidade`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`cursos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`cursos` (
  `id_curso` INT(11) NOT NULL AUTO_INCREMENT,
  `curso` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id_curso`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`competencias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`competencias` (
  `id_competencia` INT(11) NOT NULL AUTO_INCREMENT,
  `competencia` VARCHAR(150) NOT NULL,
  `numero_co` CHAR(1) NOT NULL,
  PRIMARY KEY (`id_competencia`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`cursos_competencias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`cursos_competencias` (
  `id_ccompetencia` INT(11) NOT NULL AUTO_INCREMENT,
  `id_curso` INT(11) NOT NULL,
  `id_competencia` INT(11) NOT NULL,
  PRIMARY KEY (`id_ccompetencia`),
  INDEX `fk_cursos_competencias_cursos1_idx` (`id_curso` ASC),
  INDEX `fk_cursos_competencias_competencia1_idx` (`id_competencia` ASC),
  CONSTRAINT `fk_cursos_competencias_cursos1`
    FOREIGN KEY (`id_curso`)
    REFERENCES `mydb`.`cursos` (`id_curso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cursos_competencias_competencia1`
    FOREIGN KEY (`id_competencia`)
    REFERENCES `mydb`.`competencias` (`id_competencia`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`capacidades`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`capacidades` (
  `id_capacidad` INT(11) NOT NULL AUTO_INCREMENT,
  `capacidad` VARCHAR(100) NOT NULL,
  `id_competencia` INT(11) NOT NULL,
  PRIMARY KEY (`id_capacidad`),
  INDEX `fk_competencia_capacidad_competencia1_idx` (`id_competencia` ASC),
  CONSTRAINT `fk_competencia_capacidad_competencia1`
    FOREIGN KEY (`id_competencia`)
    REFERENCES `mydb`.`competencias` (`id_competencia`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`apoderados`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`apoderados` (
  `id_persona` INT(11) NOT NULL,
  `centro_trabajo` VARCHAR(80) NOT NULL,
  `ocupacion` VARCHAR(50) NOT NULL,
  `correo` VARCHAR(100) NULL,
  `id_ninstruccion` INT(11) NOT NULL,
  PRIMARY KEY (`id_persona`),
  INDEX `fk_apoderados_niveles_instrucciones1_idx` (`id_ninstruccion` ASC),
  CONSTRAINT `fk_apoderados_personas1`
    FOREIGN KEY (`id_persona`)
    REFERENCES `mydb`.`personas` (`id_persona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_apoderados_niveles_instrucciones1`
    FOREIGN KEY (`id_ninstruccion`)
    REFERENCES `mydb`.`niveles_instrucciones` (`id_ninstruccion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`anios_escolares`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`anios_escolares` (
  `id_aescolar` INT(11) NOT NULL AUTO_INCREMENT,
  `codigo` VARCHAR(20) NOT NULL,
  `descripcion` VARCHAR(50) NOT NULL,
  `fecha_inicio` DATE NOT NULL,
  `fecha_fin` DATE NOT NULL,
  `estado` CHAR(1) NOT NULL,
  PRIMARY KEY (`id_aescolar`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`matriculas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`matriculas` (
  `id_matricula` INT(11) NOT NULL AUTO_INCREMENT,
  `fecha` DATE NOT NULL,
  `repiete` CHAR(1) NOT NULL,
  `apoderado_parentesco` VARCHAR(50) NOT NULL,
  `id_estudiante` INT(11) NOT NULL,
  `id_apoderado` INT(11) NOT NULL,
  `id_grado` INT(11) NOT NULL,
  `id_aescolar` INT(11) NOT NULL,
  PRIMARY KEY (`id_matricula`),
  INDEX `fk_matricula_estudiantes1_idx` (`id_estudiante` ASC),
  INDEX `fk_matriculas_apoderados1_idx` (`id_apoderado` ASC),
  INDEX `fk_matriculas_grados1_idx` (`id_grado` ASC),
  INDEX `fk_matriculas_anios_escolares1_idx` (`id_aescolar` ASC),
  CONSTRAINT `fk_matricula_estudiantes1`
    FOREIGN KEY (`id_estudiante`)
    REFERENCES `mydb`.`estudiantes` (`id_persona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_matriculas_apoderados1`
    FOREIGN KEY (`id_apoderado`)
    REFERENCES `mydb`.`apoderados` (`id_persona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_matriculas_grados1`
    FOREIGN KEY (`id_grado`)
    REFERENCES `mydb`.`grados` (`id_grado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_matriculas_anios_escolares1`
    FOREIGN KEY (`id_aescolar`)
    REFERENCES `mydb`.`anios_escolares` (`id_aescolar`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`directores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`directores` (
  `personas_id_persona` INT(11) NOT NULL,
  `estado` CHAR(1) NOT NULL,
  `id_funcion` INT(11) NOT NULL,
  PRIMARY KEY (`personas_id_persona`),
  INDEX `fk_directores_funciones1_idx` (`id_funcion` ASC),
  INDEX `fk_directores_personas1_idx` (`personas_id_persona` ASC),
  CONSTRAINT `fk_directores_funciones1`
    FOREIGN KEY (`id_funcion`)
    REFERENCES `mydb`.`funciones` (`id_funcion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_directores_personas1`
    FOREIGN KEY (`personas_id_persona`)
    REFERENCES `mydb`.`personas` (`id_persona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`grados_cursos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`grados_cursos` (
  `id_gcurso` INT(11) NOT NULL AUTO_INCREMENT,
  `id_grado` INT(11) NOT NULL,
  `id_curso` INT(11) NOT NULL,
  INDEX `fk_grados_has_cursos_cursos1_idx` (`id_curso` ASC),
  INDEX `fk_grados_has_cursos_grados1_idx` (`id_grado` ASC),
  PRIMARY KEY (`id_gcurso`),
  CONSTRAINT `fk_grados_has_cursos_grados1`
    FOREIGN KEY (`id_grado`)
    REFERENCES `mydb`.`grados` (`id_grado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_grados_has_cursos_cursos1`
    FOREIGN KEY (`id_curso`)
    REFERENCES `mydb`.`cursos` (`id_curso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
