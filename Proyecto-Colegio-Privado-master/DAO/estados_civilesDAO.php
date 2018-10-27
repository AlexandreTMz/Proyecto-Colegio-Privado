<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/estados_civiles.php');

class Estados_civilesDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(Estados_civiles $estado_civil)
	{
		try
		{
		$statement = $this->pdo->prepare("CALL up_insertar_estados_civiles(?)");
    $statement->bindParam(1,$estado_civil}
		->__GET('estados_civiles'));
    $statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar(Estados_civiles $estado_civil)
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("call up_buscar_estados_civiles(?)");
			$statement->bindParam(1,$estado_civil->__GET('estados_civiles'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$est = new Estados_civiles();

				$est->__SET('id', $r->id_);


				$result[] = $est;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
}

?>
