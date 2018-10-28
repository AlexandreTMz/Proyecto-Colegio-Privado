<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/alumnos_rcalificacion.php');

class alumnos_rcalificacionDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(Alumnos_rcalificacion $alumnos_rcalificacion)
	{
		try
		{
		$statement = $this->pdo->prepare("call up_insertar_alumnos_rcalificacio(?,?,?,?)");
		$statement->bindParam(1,$alumnos_rcalificacion->__GET('id_arcalificacion'));
		$statement->bindParam(1,$alumnos_rcalificacion->__GET('id_estudiante'));
		$statement->bindParam(1,$alumnos_rcalificacion->__GET('$id_rcalificacion'));
		$statement->bindParam(1,$alumnos_rcalificacion->__GET('nota_final'));

    $statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

}

?>
