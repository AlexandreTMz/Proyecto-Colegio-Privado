<?php
class Docente
{
	private $id_persona;
	private $estado;
	private $id_funcion;

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