<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/alumnos_rcalificacion.php');

class alumnos_rcalificacionDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(Alumnos_rcalificacion $alumnos_rcalificacion)
	{
		try
		{
		$statement = $this->pdo->prepare("call up_insertar_alumnos_rcalificacion(?,?,?)");
		$statement->bindParam(1,$alumnos_rcalificacion->__GET('id_estudiante'));
		$statement->bindParam(2,$alumnos_rcalificacion->__GET('id_rcalificacion'));
		$statement->bindParam(3,$alumnos_rcalificacion->__GET('nota_final'));

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

			$statement = $this->pdo->prepare("call up_buscar_alumnos_rcalificacion()");
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$est = new Alumnos_rcalificacion();

				$est->__SET('id_arcalificacion', $r->id_arcalificacion);
				$est->__GET('id_rcalificacion')->__SET('id_rcalificacion',$r->id_rcalificacion);
				$est->__GET('id_estudiante')->__SET('id_estudiante'), $r->id_estudiante);
				$est->__SET('nota_final', $r->nota_final);
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
