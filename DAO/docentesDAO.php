<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/docentes.php');

class InstitucionesDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(Instituciones $instituciones)
	{
		try
		{
		$statement = $this->pdo->prepare("CALL PROC_REGISTRAR_INSTITUCIONES(?,?,?)");
   		$statement->bindParam(1,$docentes->__GET('id_persona'));
			$statement->bindParam(2,$docentes->__GET('estado'));
			$statement->bindParam(3,$docentes->__GET('id_funcion'));


    $statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}


	public function Listar(Curso $cursos)
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("call up_buscar_id_curso(?)");
			$statement->bindParam(1,$persona->__GET('id_curso'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$per = new Persona();

				$per->__SET('id_curso', $r->idpersona);
				$per->__SET('curso', $r->nombres);

				$result[] = $per;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
*/
}

?>
