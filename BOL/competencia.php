<?php
class Competencia
{
	private $id_competencia;
	private $competencia;
	private $numero_co;

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
