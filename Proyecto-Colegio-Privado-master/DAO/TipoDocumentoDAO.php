<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/TipoDocumento.php');

class TipoDocumentoDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}


	public function Listar(TipoDocumento $TipoDocumento)
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("call up_buscar_documento(?)");
			$statement->bindParam(1,$TipoDocumento->__GET('codigo'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$per = new TipoDocumento();

				$per->__SET('id', $r->idpersona);
				$per->__SET('nombres', $r->nombres);
				$per->__SET('apellidos', $r->apellidos);
				$per->__SET('dni', $r->dni);

				$result[] = $per;
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
