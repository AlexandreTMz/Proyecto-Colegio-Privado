<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/competencia.php');

class CompetenciaDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(Competencia $competencia)
	{
		try
		{
		$statement = $this->pdo->prepare("CALL up_insertar_competencia(?,?)");
		$statement->bindParam(1,$competencia->__GET('nombre_competencia'));
		$statement->bindParam(2,$competencia->__GET('numero_co'));
		$statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar(Competencia $competencia)
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("call up_buscar_competencia(?)");
			$statement->bindParam(1,$competencia->__GET('id_competencia'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$com = new Competencia();

				$com->__SET('id_competencia', $r->id_competencia);
				$com->__SET('nombre_competencia', $r->nombre_competencia);
				$com->__SET('numero_co', $r->numero_co);

				$result[] = $com;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ListarTodo()
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("call up_listar_competencia()");
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$com = new Competencia();

				$com->__SET('id_competencia', $r->id_competencia);
				$com->__SET('nombre_competencia', $r->nombre_competencia);
				$com->__SET('numero_co', $r->numero_co);

				$result[] = $com;
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
