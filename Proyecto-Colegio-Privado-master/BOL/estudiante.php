<?php 
class Estudiante
{
	private $id_persona;
	private $codigo_estudiante;

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