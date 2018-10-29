<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/grados_curso.php');

class grados_cursoDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(Grados_curso $grados_cursos)
	{
		try
		{
		$statement = $this->pdo->prepare("Call_addgrados_cursos(?,?)");
		$statement->bindParam(1,$apoderado->__GET('id_grado'));
		$statement->bindParam(2,$apoderado->__GET('id_curso'));
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

			$statement = $this->pdo->prepare("call up_buscargrados_cursos()");
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$est = new grados_cursos();

				$est->__SET('id_gcurso', $r->id_gcurso);
				$est->__GET('id_grado')->__SET('id_grado', $r->id_grado);
				$est->__GET('id_curso')->__SET('id_curso', $r->id_curso);
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
