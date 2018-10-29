<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/competencias.php');

class CompetenciaDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(Competencias $competencias)
	{
		try
		{
		$statement = $this->pdo->prepare("call up_registrar_competencia(?,?,?)");
		$statement->bindParam(1,$competencias->__GET('id'));
		$statement->bindParam(2,$competencias->__GET('nombreCompetencia'));
		$statement->bindParam(3,$competencias->__GET('numeroCo'));

    $statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ListarCapacidad(Competencia $competencia)
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
