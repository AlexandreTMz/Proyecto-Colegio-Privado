<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/notas.php');

class NotasDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(Notas $notas)
	{
		try
		{
		$statement = $this->pdo->prepare("CALL up_insertar_nota(?,?)");
    	$statement->bindParam(1,$notas->__GET('id_nota'));
		$statement->bindParam(2,$notas->__GET('nota'));
	
    $statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar(Notas $notas)
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("call up_buscar_nota(?)");
			$statement->bindParam(1,$notas->__GET('id_nota'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$not = new Notas();

				$not->__SET('id_nota', $r->id_nota);
				$not->__SET('nota', $r->nota);
			

				$result[] = $not;
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

