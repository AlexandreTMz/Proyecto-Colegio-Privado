<?php
require_once('../DAL/DBconexion.php');
require_once('../BOL/alumnos_calif.php');

class alumnos_califDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBconexion();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(alumnos_rcalificacion $alumnos_rcalificacion)
	{
		try
		{
		$statement = $this->pdo->prepare("CALL addAlumnos_calif(?,?,?,?)");
    $statement->bindParam(1,$apoderado->__GET('id_arcalificacion'));
		$statement->bindParam(2,$apoderado->__GET('id_rcalificacion'));
		$statement->bindParam(3,$apoderado->__GET('id_estudiante'));
		$statement->bindParam(4,$apoderado->__GET('nota_final'));
    $statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}
}
?>
