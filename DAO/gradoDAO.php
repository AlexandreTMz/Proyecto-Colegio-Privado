<?php
require_once("../DALO/DBAcces.php");
require_once('../BOL/grado.php');

class gradoDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(Grado $grado)
	{
		try
		{
		$statement = $this->pdo->prepare("CALL up_registrar_grado(?)");
		$statement->bindParam(1, $grado->__GET('grado'));
    $statement -> execute();
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar()
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("CALL up_listar_grado()");
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$gra = new Grado();

				$gra->__SET('id_grado', $r->id_grado);
				$gra->__SET('grado', $r->grado);

				$result[] = $gra;
			}
			return $result;
		} catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
}
?>
