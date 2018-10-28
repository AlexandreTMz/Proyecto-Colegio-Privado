<?php
class Alumnos_rcalificacion
{
    private $id_arcalificacion;
	private $id_estudiante;
	private $id_rcalificacion;
	private $nota_final;



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