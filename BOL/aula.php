<?php
class Aula
{
	private $idAula;
	private $descripcion;
	private $numeroAula;
	private $numeroAlumno;
	private $turno;
	private $idDocente;
	private $idGrado;
	private $idSeccion;

	public function __CONSTRUCT(){
				$this->idDocente = new Docente();
				$this->idGrado = new Grado();
				$this->idSeccion = new Secciones();
		//echo $this->ent -> __GET('id_competencia');
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
