<?php
require_once 'competencias.php';
require_once 'curso.php';

class Curso_Competencia
{
	private $id_ccompetencia;
	private $id_curso;
	private $id_competencia;

	public function _CONSTRUCT(){
		$this->id_curso = new Curso();
		$this->id_competencia = new Competencias();
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
