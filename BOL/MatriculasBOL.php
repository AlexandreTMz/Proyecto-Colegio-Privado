<?php
class matriculas
{
	private $id_matricula;
	private $fecha;
	private $repiete;
	private $apoderado_parentesco;
	private $id_estudiante;
	private $id_apoderados;
	private $id_grado;
	private $id_aescolar;

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
