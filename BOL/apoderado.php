<?php
class Apoderados
{
	private $id_persona;
	private $centro_trabajo;
	private $ocupacion;
	private $correo;
	private $id_ninstruccion;

	public function __construct(){
		$this->id_persona = new Persona();
		$this->id_ninstruccion = new niveles_instrucciones();
	}

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
