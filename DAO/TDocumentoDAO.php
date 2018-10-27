<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/tipoDocumento.php');

class DocumentoDao
{
    private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}
    public function Listar_Documento()
    {
        try
        {
            $result = array();

            $statement = $this->pdo->prepare("call listar_tDocuemento()");        
            $statement->execute();

            foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $civil = new estadoCivil();
                $civil->__SET('id_tdocumento', $r->id_tdocumento);
                $civil->__SET('tipo_documento', $r->tipo_documento);

                $result[] = $civil;
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