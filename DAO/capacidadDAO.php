<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/capacidad.php');

class CapacidadDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(Capacidad $capacidad)
	{
		try
		{
		$statement = $this->pdo->prepare("CALL up_insertar_capacidad(?,?)");
		$statement->bindParam(1,$capacidad->__GET('capacidad'));
		$statement->bindParam(2,$capacidad->__GET('ent')->__GET('id_competencia'));
		$statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	/*public function Listar(Capacidad $capacidad)
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("call up_buscar_capacidad(?)");
			$statement->bindParam(1,$capacidad->__GET('id_capacidad'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$cap = new Capacidad();

				$cap->__SET('id_capacidad', $r->id_capacidad);
				$cap->__SET('capacidad', $r->capacidad);
				$cap->__GET('ent')->__SET('id_cappetencia', $r->id_cappetencia);

				$result[] = $cap;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}*/

	public function ListarCapacidad(Capacidad $capacidad)
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("call up_listar_capacidad(?)");
			$statement->bindParam(1,$capacidad->__GET('ent')->__GET('id_competencia'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$cap = new Capacidad();

				$cap->__SET('id_capacidad', $r->id_capacidad);
				$cap->__SET('capacidad', $r->capacidad);
				$cap->__GET('ent')->__SET('id_competencia', $r->id_competencia);

				$result[] = $cap;
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
