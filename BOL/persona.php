<?php
require_once('../DAO/TDocumentoDAO.php');
class Persona
{
	//NECESITO IMPROTAR LAS OTRAS CLASES 
	
	private $nombres;
	private $apellidosP;
	private $apellidosM;
	private $numero_documento;
	private $fecha_nacimiento;
	private $sexo;
	private $direccion;
	private $telefono;
	private $id_tDocu;
	private $id_eCivil;
 
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