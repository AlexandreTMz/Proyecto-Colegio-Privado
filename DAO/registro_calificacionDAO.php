<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/Registro_calificacion.php');

class Registro_calificacionDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(Registro_calificacion $registro_calificacion)
	{
		try
		{
		$statement = $this->pdo->prepare("CALL up_insertar_Registro_calificacion(?,?,?,?,?,?)");
		$statement->bindParam(1,$registro_calificacion->__GET('fecha'));
		$statement->bindParam(2,$registro_calificacion->__GET('hora'));
		$statement->bindParam(3,$registro_calificacion->__GET('id_periodo'));
		$statement->bindParam(4,$registro_calificacion->__GET('id_grado'));
		$statement->bindParam(5,$registro_calificacion->__GET('id_seccion'));
		$statement->bindParam(6,$registro_calificacion->__GET('id_docente'));

        $statement->execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar(Registro_calificacion $registro_calificacion)
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("call up_buscar_registro_calificacion(?)");
			$statement->bindParam(1,$registro_calificacion->__GET('id_grado'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$est = new Registro_calificacion();

				$est->__SET('id_rcalificacion', $r->id_rcalificacion);
				$est->__SET('fecha', $r->fecha);
				$est->__SET('hora', $r->hora);
				$est->__SET('id_periodo', $r->id_periodo);
				$est->__SET('id_grado', $r->id_grado);
				$est->__SET('id_seccion', $r->id_seccion);
				$est->__SET('id_docente', $r->id_docente);
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
