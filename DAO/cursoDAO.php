<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/curso.php');

class CursoDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(Curso $curso)
	{
		try
		{
		$statement = $this->pdo->prepare("CALL up_registrar_curso(?,?)");
   	$statement->bindParam(1,$curso->__GET('id_curso'));
		$statement->bindParam(2,$curso->__GET('curso'));
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

			$statement = $this->pdo->prepare("call up_listar_curso()");
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$cur = new Curso();

				$cur->__SET('id_curso', $r->id_curso);
				$cur->__SET('curso', $r->curso);

				$result[] = $cur;
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
