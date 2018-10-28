<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/cursos_competencias.php');

class Cursos_competenciasDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(Cursos_competencias $cursos_competencias)
	{
		try
		{
		$statement = $this->pdo->prepare("CALL up_insertar_cursos_competencias(?,?,?)");
    $statement->bindParam(1,$cursos_competencias->__GET('id_competencia'));
		$statement->bindParam(2,$cursos_competencias->__GET('nombre_competencia'));
		$statement->bindParam(3,$cursos_competencias->__GET('numero_co'));
    $statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar(Cursos_competencias $cursos_competencias)
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("call up_buscar_cursos_competencias(?)");
			$statement->bindParam(1,$cursos_competencias->__GET(''));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$comp = new Cursos_competencias();

				$comp->__SET('id_competencia', $r->id_competencias);
				$comp->__SET('nombre_competencia', $r->nombre_competencia);
				$comp->__SET('numero_co', $r->numero_co);
			

				$result[] = $comp;
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
