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

	// Constructor
	public function __construct(){
		$this->id_estudiante = new Estudiante();
		$this->id_apoderados = new Apoderados();
		$this->id_grado   = new Grado();
		$this->id_aescolar  = new anios_escolares();
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
