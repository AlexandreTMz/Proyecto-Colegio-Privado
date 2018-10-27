<?php 
class Registro_calificacion
{
	private $id_rcalificacion;
	private $fecha;
	private $hora;
	private $id_periodo;
	private $id_grado;
	private $id_seccion;
	private $id_docente;

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