<?php
class Arcalificacion_notas
{
	private $id_arcnotas;
	private $id_arcalificacion;
	private $id_nota;
	
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