<?php
class Apoderados
{
	private $id_apoderados;
	private $centro_trabajo;
	private $ocupacion;
	private $correo;

  	private $id_persona;
	private $id_ninstruccion;


	public function __construct(){
		$this->id_persona = new Persona();
		$this->id_ninstruccion = new niveles_instrucciones();
	}

	//>>>>>>> 802743be71d0bd29c5c6c8b441a0d050677691f1
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
