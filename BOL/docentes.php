<?php

require_once 'persona.php';
require_once 'funcion.php';

class Docente
{

 	/*CAMPOS DE LA TABLA DOCENTE*/
	private $estado;
	/*CAMPOS QUE REQUIERE LA TABLA DOCENTE*/
	private $id_persona;
	private $id_funcion;

	/*CREANDO EL CONSTRUCTOR*/

	public function __CONSTRUCT()
	{
		$this->id_persona = new Persona();
		$this->id_funcion = new funcion1();
	}

	/*EL GET (INGRESAR) Y EL SET (OBTENER)*/

	public function __GET($x)
	{
		return $this->$x;
	}
	public function __SET($x, $y)
	{
		return $this->$x = $y;
	}
}
?>
