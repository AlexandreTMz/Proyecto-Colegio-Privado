<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/persona.php');

class PeriodosDAO
{
  private $pdo;

  public function __CONSTRUCT()
  {
    $dba = new DBAccess();

    $this->pdo = $dba->get_connection();
  }

  public function Registrar(Periodos $periodos)
  {
    try
    {

    $statement = $this->pdo->prepare("CALL up_insertar_periodos(?,?)");
    $statement->bindParam(1,$periodos->__GET('id_periodo'));
    $statement->bindParam(2,$periodos->__GET('descripcion'));
    $statement -> execute();

  }  catch (Exception $e)
  {
    die($e->getMessage());
  }
}

 public function Listar(Periodos $periodos)
 {
   try
   {
     $result = array();

     $statement = $this->pdo->prepare("CALL up_buscar_periodos(?)");
     $statement->bindParam(1,$periodos->__GET('dni'));
     $statement->execute();

     foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
     {
       $per = new Periodos();

       $per->__SET('id_periodo', $r->id_periodo);
       $per->__SET('descripcion', $r->descripcion);

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
