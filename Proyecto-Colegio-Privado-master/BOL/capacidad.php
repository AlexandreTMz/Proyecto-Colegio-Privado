<?php
require_once 'competencia.php';

class Capacidad
{
	private $id_capacidad;
	private $capacidad;
	private $ent;

	public function __CONSTRUCT(){
        $this->ent = new Competencia();
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
