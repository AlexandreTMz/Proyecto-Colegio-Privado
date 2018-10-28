<?php
class Persona
{
	private $nombres;
	private $apellidosP;
	private $apellidosM;
	private $numero_ducmento;
	private $fecha_nacimiento;
	private $sexo;
	private $direccion;
	private $telefono;
	//private documento;
	//private ecivil;

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