<?php
require_once("../DAL/DBAccess.php");
require_once('../BOL/seccion.php');

class seccionDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(Seccion $seccion)
	{
		try
		{

		$statement = $this->pdo->prepare("CALL up_registrar_seccion(?)");
		$statement->bindParam(1, $seccion->__GET('seccion'));
    	$statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar(Seccion $seccion)
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("CALL up_buscar_seccion(?)");
			$tempId_seccion = $seccion->__GET('id_seccion');
			$statement->bindParam(1, $tempId_seccion);
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$sec = new Seccion();

				$sec->__SET('id_seccion', $r->id_seccion);
				$sec->__SET('seccion', $r->seccion);

				$result[] = $sec;
			}
			return $result;
		} catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
}
?>
