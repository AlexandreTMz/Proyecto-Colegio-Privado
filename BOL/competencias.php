<?php
class Competencias
{
	private $id;
	private $nombreCompetencia;
	private $numeroCo;

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
