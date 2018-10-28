<?php
class alumnos_rcalificacion
{
	private $id_arcalificacion;
	private $id_rcalificacion;
	private $id_estudiante;
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
