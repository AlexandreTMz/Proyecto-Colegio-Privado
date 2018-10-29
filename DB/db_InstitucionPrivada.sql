DROP DATABASE IF EXISTS mydb;

CREATE DATABASE mydb DEFAULT CHARACTER SET utf8;
USE mydb;

CREATE TABLE tipos_documentos
(
  id_tdocumento INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  tipo_documento VARCHAR(100) NOT NULL
);

CREATE TABLE estados_civiles
(
  id_ecivil INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  estado_civil VARCHAR(60) NOT NULL
);

CREATE TABLE personas
(
  id_persona INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(100) NOT NULL,
  apellido_paterno VARCHAR(50) NOT NULL,
  apellido_materno VARCHAR(50) NOT NULL,
  numero_documento VARCHAR(20) UNIQUE NOT NULL,
  fecha_nacimiento DATE NOT NULL,
  sexo CHAR(1) NOT NULL,
  direccion VARCHAR(80) NOT NULL,
  telefono VARCHAR(20) NOT NULL,
  id_tdocumento INT(11) NOT NULL,
  id_ecivil INT(11) NOT NULL,
  CONSTRAINT fk_personas_tipos_documentos FOREIGN KEY (id_tdocumento) REFERENCES tipos_documentos(id_tdocumento),
  CONSTRAINT fk_personas_estados_civiles FOREIGN KEY (id_ecivil) REFERENCES estados_civiles(id_ecivil)
);

CREATE TABLE funciones
(
  id_funcion INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  funcion VARCHAR(50) NOT NULL
);

CREATE TABLE docentes
(
  id_persona INT(11) PRIMARY KEY NOT NULL,
  estado CHAR(1) NOT NULL,
  id_funcion INT(11) NOT NULL,
  CONSTRAINT fk_docentes_personas FOREIGN KEY (id_persona) REFERENCES personas(id_persona),
  CONSTRAINT fk_personales_funciones FOREIGN KEY (id_funcion) REFERENCES funciones(id_funcion)
);

CREATE TABLE IF NOT EXISTS notas
(
  id_nota INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  nota VARCHAR(100) NOT NULL
);

CREATE TABLE periodos
(
  id_periodo INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  periodo VARCHAR(100) NOT NULL
);

CREATE TABLE secciones
(
  id_seccion INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  seccion VARCHAR(100) NOT NULL
);

CREATE TABLE grados
(
  id_grado INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  grado VARCHAR(100) NOT NULL
);

CREATE TABLE niveles_instrucciones
(
  id_ninstruccion INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  nivel_instruccion VARCHAR(100) NOT NULL
);

CREATE TABLE registros_calificaciones
(
  id_rcalificacion INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  fecha DATE NOT NULL,
  hora TIME NOT NULL,
  id_periodo INT(11) NOT NULL,
  id_grado INT(11) NOT NULL,
  id_seccion INT(11) NOT NULL,
  id_docente INT(11) NOT NULL,
  CONSTRAINT fk_registros_calificaciones_periodos FOREIGN KEY (id_periodo) REFERENCES periodos(id_periodo),
  CONSTRAINT fk_registros_calificaciones_grados FOREIGN KEY (id_grado) REFERENCES grados(id_grado),
  CONSTRAINT fk_registros_calificaciones_docentes FOREIGN KEY (id_docente) REFERENCES docentes(id_persona),
  CONSTRAINT fk_registros_calificaciones_secciones FOREIGN KEY (id_seccion) REFERENCES secciones(id_seccion)
);

CREATE TABLE estudiantes
(
  id_persona INT(11) PRIMARY KEY NOT NULL,
  codigo_estudiante VARCHAR(20) UNIQUE NOT NULL,
  CONSTRAINT fk_estudiantes_personas FOREIGN KEY (id_persona) REFERENCES personas(id_persona)
);

CREATE TABLE alumnos_rcalificaciones
(
  id_arcalificacion INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  id_rcalificacion INT(11) NOT NULL,
  id_estudiante INT(11) NOT NULL,
  nota_final VARCHAR(2) NOT NULL,
  CONSTRAINT fk_alumnos_rcalificaciones_registros_calificaciones FOREIGN KEY (id_rcalificacion) REFERENCES registros_calificaciones(id_rcalificacion),
  CONSTRAINT fk_alumnos_rcalificaciones_estudiantes FOREIGN KEY (id_estudiante) REFERENCES estudiantes(id_persona)
);

CREATE TABLE arcalificacion_notas
(
  id_arcnotas INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  id_arcalificacion INT(11) NOT NULL,
  id_nota INT(11) NOT NULL,
  CONSTRAINT fk_arcalificacion_notas_notas FOREIGN KEY (id_nota) REFERENCES notas(id_nota),
  CONSTRAINT fk_arcalificacion_notas_alumnos_rcalificaciones FOREIGN KEY (id_arcalificacion) REFERENCES alumnos_rcalificaciones(id_arcalificacion)
);

CREATE TABLE aulas(
  id_aula INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  descripcion VARCHAR(100) NOT NULL,
  numero_aula VARCHAR(50) NOT NULL,
  numero_alumno VARCHAR(10) NOT NULL,
  turno CHAR(1) NOT NULL,
  id_docente INT(11) NOT NULL,
  id_grado INT(11) NOT NULL,
  id_seccion INT(11) NOT NULL,
  CONSTRAINT fk_aulas_docentes FOREIGN KEY (id_docente) REFERENCES docentes(id_persona),
  CONSTRAINT fk_aulas_grados FOREIGN KEY (id_grado) REFERENCES grados(id_grado),
  CONSTRAINT fk_aulas_secciones FOREIGN KEY (id_seccion) REFERENCES secciones(id_seccion)
);

CREATE TABLE especialidades
(
  id_especialidad INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  descripcion VARCHAR(100) NOT NULL,
  fecha_inicio DATE NOT NULL,
  fecha_fin DATE NOT NULL,
  estado CHAR(1) NOT NULL
);

CREATE TABLE cursos
(
  id_curso INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  curso VARCHAR(100) NOT NULL
);

CREATE TABLE competencias
(
  id_competencia INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  competencia VARCHAR(150) NOT NULL,
  numero_co CHAR(1) NOT NULL
);

CREATE TABLE cursos_competencias
(
  id_ccompetencia INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  id_curso INT(11) NOT NULL,
  id_competencia INT(11) NOT NULL,
  CONSTRAINT fk_cursos_competencias_cursos FOREIGN KEY (id_curso) REFERENCES cursos(id_curso),
  CONSTRAINT fk_cursos_competencias_competencia FOREIGN KEY (id_competencia) REFERENCES competencias(id_competencia)
);

CREATE TABLE capacidades
(
  id_capacidad INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  capacidad VARCHAR(100) NOT NULL,
  id_competencia INT(11) NOT NULL,
  CONSTRAINT fk_capacidades_competencia FOREIGN KEY (id_competencia) REFERENCES competencias(id_competencia)
);

CREATE TABLE apoderados
(
  id_persona INT(11) PRIMARY KEY NOT NULL,
  centro_trabajo VARCHAR(80) NOT NULL,
  ocupacion VARCHAR(50) NOT NULL,
  correo VARCHAR(100) NULL,
  id_ninstruccion INT(11) NOT NULL,
  CONSTRAINT fk_apoderados_personas FOREIGN KEY (id_persona) REFERENCES personas(id_persona),
  CONSTRAINT fk_apoderados_niveles_instrucciones FOREIGN KEY (id_ninstruccion) REFERENCES niveles_instrucciones(id_ninstruccion)
);

CREATE TABLE anios_escolares(
  id_aescolar INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  codigo VARCHAR(20) NOT NULL,
  descripcion VARCHAR(50) NOT NULL,
  fecha_inicio DATE NOT NULL,
  fecha_fin DATE NOT NULL,
  estado CHAR(1) NOT NULL
);

CREATE TABLE matriculas(
  id_matricula INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  fecha DATE NOT NULL,
  repiete CHAR(1) NOT NULL,
  apoderado_parentesco VARCHAR(50) NOT NULL,
  id_estudiante INT(11) NOT NULL,
  id_apoderado INT(11) NOT NULL,
  id_grado INT(11) NOT NULL,
  id_aescolar INT(11) NOT NULL,
  CONSTRAINT fk_matriculas_estudiantes FOREIGN KEY (id_estudiante) REFERENCES estudiantes(id_persona),
  CONSTRAINT fk_matriculas_apoderados FOREIGN KEY (id_apoderado) REFERENCES apoderados(id_persona),
  CONSTRAINT fk_matriculas_grados FOREIGN KEY (id_grado) REFERENCES grados(id_grado),
  CONSTRAINT fk_matriculas_anios_escolares FOREIGN KEY (id_aescolar) REFERENCES anios_escolares(id_aescolar)
);

CREATE TABLE directores
(
  id_persona INT(11) PRIMARY KEY NOT NULL,
  estado CHAR(1) NOT NULL,
  id_funcion INT(11) NOT NULL,
  CONSTRAINT fk_directores_funciones FOREIGN KEY (id_funcion) REFERENCES funciones(id_funcion),
  CONSTRAINT fk_directores_personas FOREIGN KEY (id_persona) REFERENCES personas(id_persona)
);

CREATE TABLE grados_cursos
(
  id_gcurso INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  id_grado INT(11) NOT NULL,
  id_curso INT(11) NOT NULL,
  CONSTRAINT fk_grados_cursos_grados FOREIGN KEY (id_grado) REFERENCES grados(id_grado),
  CONSTRAINT fk_grados_cursos_cursos FOREIGN KEY (id_curso) REFERENCES cursos(id_curso)
);


DELIMITER $$
CREATE PROCEDURE up_listar_grado(
)
BEGIN
	SELECT * FROM grados;
END
$$

DELIMITER $$
CREATE PROCEDURE up_listar_seccion(
)
BEGIN
	SELECT * FROM secciones;
END
$$

DELIMITER $$
<<<<<<< HEAD
=======

>>>>>>> d0b75668260ecf6993d7487d577aaa664ee2a059
CREATE PROCEDURE up_listar_aulas(
)
BEGIN
	SELECT * FROM aulas a INNER JOIN docentes d ON a.id_docente = d.id_persona INNER JOIN grados g ON a.id_grado = g.id_grado INNER JOIN secciones s ON a.id_seccion = s.id_seccion INNER JOIN personas p ON d.id_persona = p.id_persona;
END
$$
<<<<<<< HEAD
=======



/*REGISTRO DE CALIFICACION*/

# REGISTRAR periodo
DELIMITER $$
CREATE PROCEDURE up_registrar_periodos
(
    IN _descripcion VARCHAR(20)
)
BEGIN
INSERT INTO periodos(descripcion) VALUES (_descripcion);
END
$$

# BUSCAR periodo
DELIMITER $$
CREATE PROCEDURE up_buscar_Periodos
(
    IN _id_periodo VARCHAR(20)
)
BEGIN

select * from periodos where id_periodo LIKE CONCAT('%', _id_periodo , '%');

END
$$


# REGISTRAR grado
DELIMITER $$
CREATE PROCEDURE up_registrar_grado
(
    IN _grado VARCHAR(20)
)
BEGIN
INSERT INTO grados(grado) VALUES (_grado);
END
$$

# BUSCAR grado
DELIMITER $$
CREATE PROCEDURE up_buscar_grado
(
    IN _id_grado VARCHAR(20)
)
BEGIN

select * from grados where id_grado LIKE CONCAT('%', _id_grado , '%');

END
$$



# REGISTRAR seccioon
DELIMITER $$
CREATE PROCEDURE up_registrar_seccion
(
    IN _seccion VARCHAR(20)
)
BEGIN

INSERT INTO secciones(seccion) VALUES (_seccion);

END
$$

# BUSCAR seccioon
DELIMITER $$
CREATE PROCEDURE up_buscar_seccion
(
    IN _id_seccion VARCHAR(20)
)
BEGIN

select * from secciones where id_seccion LIKE CONCAT('%', _id_seccion , '%');

END
$$


# REGISTRAR docente
DELIMITER $$
CREATE PROCEDURE up_registrar_docente
(
    IN _id_persona VARCHAR(20),
    IN _estado VARCHAR(20),
    IN _id_funcion VARCHAR(20)
)
BEGIN
INSERT INTO docentes(id_persona, estado, id_funcion) VALUES (_id_persona,_estado,_id_funcion);
END
$$

# BUSCAR docente
DELIMITER $$
CREATE PROCEDURE up_buscar_docente
(
    IN _id_persona VARCHAR(20)
)
BEGIN

select * from docentes where id_persona LIKE CONCAT('%', _id_persona , '%');

END
$$



# REGISTRAR docente
DELIMITER $$
CREATE PROCEDURE up_registrar_registro_calificacion
(
    IN _fecha VARCHAR(20),
    IN _hora VARCHAR(20),
    IN _id_periodo VARCHAR(20),
    IN _id_grado VARCHAR(20),
    IN _id_seccion VARCHAR(20),
    IN _id_docente VARCHAR(20)
)
BEGIN

INSERT INTO registros_calificaciones(fecha, hora, id_periodo, id_grado, id_seccion, id_docente)
VALUES (_fecha,_hora,_id_periodo,_id_grado,_id_seccion,_id_docente);

END
$$

# BUSCAR docente
DELIMITER $$
CREATE PROCEDURE up_buscar_registro_calificacion
(
    IN _id_rcalificacion VARCHAR(20)
)
BEGIN

select * from registros_calificaciones where id_rcalificacion LIKE CONCAT('%', _id_rcalificacion , '%');

END
$$
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `up_buscar_director`(IN `_id_personad` INT)
BEGIN
SELECT * FROM directores where persona_id_persona=_id_personad;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `up_buscar_grado`(IN `_id_grado` INT)
BEGIN
SELECT * FROM grados where id_grado=_id_grado;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `up_insertar_directores`(
persona_id_persona int(11),
funcion int(11),
estado char(1)
)
INSERT INTO directores (persona_id_persona, funcion, estado) VALUES(persona_id_persona, funcion, estado)$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `up_buscar_nota`(IN `_id_nota` INT)
BEGIN
SELECT * FROM notas where id_nota=_id_nota;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `up_insertar_grado`(IN `grado` VARCHAR(100), IN `id_grado` INT(11))
INSERT INTO grados (id_grado,grado) VALUES(id_grado,grado)$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `up_insertar_nota`(
id_nota int(11),
nota VARCHAR(100)
)
INSERT INTO notas (id_nota, nota) VALUES(id_nota, nota)$$
DELIMITER ;


/*FIN REGISTRO DE CALIFICACION*/
>>>>>>> d0b75668260ecf6993d7487d577aaa664ee2a059
