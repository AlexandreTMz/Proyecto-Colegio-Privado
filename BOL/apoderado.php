<?php
class Apoderados
{
	private $id_apoderados;
	private $centro_trabajo;
	private $ocupacion;
	private $correo;

  private $id_persona;
	private $id_ninstruccion;


 //Constructor
 public function __construct(){
	 $this->id_ninstruccion = new niveles_instrucciones();
	 $this->id_persona = new Persona();
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
