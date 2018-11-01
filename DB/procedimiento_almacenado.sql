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
CREATE PROCEDURE up_listar_aulas(
)
BEGIN
	SELECT * FROM aulas a INNER JOIN docentes d ON a.id_docente = d.id_persona INNER JOIN grados g ON a.id_grado = g.id_grado INNER JOIN secciones s ON a.id_seccion = s.id_seccion INNER JOIN personas p ON d.id_persona = p.id_persona;
END
$$

DELIMITER $$
CREATE PROCEDURE up_registrar_aula(
    IN _descripcion VARCHAR(100),
    IN _numero_aula VARCHAR(50),
    IN _numero_alumno VARCHAR(10),
    IN _turno CHAR(1),
    IN _id_docente INT(11),
    IN _id_grado INT(11),
    IN _id_seccion INT(11)
)
BEGIN
	INSERT INTO aulas VALUES (null, _descripcion, _numero_aula, _numero_alumno, _turno, _id_docente, _id_grado, _id_seccion);
END
$$

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
