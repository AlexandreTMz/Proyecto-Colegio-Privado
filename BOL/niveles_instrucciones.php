<?php
class niveles_instrucciones
{
	private $id_ninstruccion;
	private $niveles_instruccion;

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
