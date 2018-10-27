<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/ECivil.php');

class CivilDao
{
    private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}
    public function Listar_Civil()
    {
        try
        {
            $result = array();

            $statement = $this->pdo->prepare("call listarEstadoCi()");        
            $statement->execute();

            foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $civil = new estadoCivil();

                $civil->__SET('id_ecivil', $r->id_ecivil);
                $civil->__SET('estado_civil', $r->estado_civil);

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