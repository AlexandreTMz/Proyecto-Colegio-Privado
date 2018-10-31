<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/grado.php');

class GradoDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(Grado $grado)
	{
		try
		{

		$statement = $this->pdo->prepare("CALL up_insertar_grado(?,?)");
		$statement->bindParam(1, $grado->__GET('id_grado'));
		$statement->bindParam(2, $grado->__GET('grado'));
    $statement -> execute();

		$statement = $this->pdo->prepare("CALL up_registrar_grado(?)");
		$statement->bindParam(1, $grado->__GET('grado'));
    	$statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar(Grado $grado)
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("CALL up_buscar_grado(?)");
			$statement->bindParam(1,$grado->__GET('id_grado'));

			//ASIGNAR A UNA VARIABLE TEMPORAL
    		$tempIdPeriodo = $grado->__GET("id_grado");
     		//EJECUTAR Y ENVIANDO LOS PARAMETROS TEMPORALES
			$statement->bindParam(1, $tempIdPeriodo);
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$gra = new Grado();

				$gra->__SET('id_grado', $r->id_grado);
				$gra->__SET('grado', $r->grado);

				$result[] = $gra;
			}
			return $result;
		} catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
}
?>
