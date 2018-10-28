<?php
require_once('../BOL/docentes.php');
require_once('../DAO/docentesDAO.php');
$per = new docentes();
$perDAO = new docentesDAO();

if(isset($_POST['guardar']))
{
	$per->__SET('id_persona',           $_POST['id_persona']);
	$per->__SET('estado',          			$_POST['estado']);
	$per->__SET('id_funcion',						$_POST['id_funcion']);

	$perDAO->Registrar($per);
	header('Location: frmDocentes.php');
}



?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>CRUD</title>
        <!-- <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">-->
        <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" ">
	</head>
    <body style="padding:15px;">

        <div class="pure-g">
            <div class="pure-u-1-12">

                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">

                    <table style="width:500px;" border="0">
                    	<!-- esto es un comentario en Html
						Con respecto a estas lineas se ha implementado para ingresar el codi
						go del curso

                        <tr>
                            <th style="text-align:left;">docentes:</th>
                            <td><input type="text" name="id_persona" value="" style="width:100%;" required="ingrese descripcion" /></td>
                        </tr>
												<tr>
                            <th style="text-align:left;">docentes:</th>
                            <td><input type="text" name="estado" value="" style="width:100%;" required="ingrese descripcion" /></td>
                        </tr>
												<tr>
                            <th style="text-align:left;">docentes:</th>
                            <td><input type="text" name="id_funcion" value="" style="width:100%;" required="ingrese descripcion" /></td>
                        </tr>
                        <tr>
                            <td colspan="2">
								<input type="submit" value="GUARDAR" name="guardar"class="pure-button pure-button-primary">
								<input type="submit" value="BUSCAR" name="buscar"class="pure-button pure-button-primary">
                            </td>
                        </tr>
                    </table>
                </form>


            </div>
        </div>

				<?php
				if(isset($_POST['buscar']))
				{
					$resultado = array();//VARIABLE TIPO RESULTADO
					$per->__SET('id_persona',          $_POST['id_persona']);//ESTABLECEMOS EL VALOR DEL DNI
					$resultado = $perDAO->Listar($per); //CARGAMOS LOS REGISTRO EN EL ARRAY RESULTADO
					if(!empty($resultado)) //PREGUNTAMOS SI NO ESTA VACIO EL ARRAY
					{
						?>
						<table class="pure-table pure-table-horizontal">
								<thead>
										<tr>
												<th style="text-align:left;">id_persona</th>
												<th style="text-align:left;">estado</th>
												<th style="text-align:left;">id_funcion</th>
										</tr>
								</thead>
						<?php
						foreach( $resultado as $r): //RECORREMOS EL ARRAY RESULTADO A TRAVES DE SUS CAMPOS
							?>
								<tr>
										<td><?php echo $r->__GET('id_persona'); ?></td>
										<td><?php echo $r->__GET('estado'); ?></td>
										<td><?php echo $r->__GET('$id_funcion'); ?></td>
								</tr>
						<?php endforeach;
					}
					else
					{
						echo 'no se encuentra en la base de datos!';
					}
					?>
					</table>
					<?php
				}
				?>

    </body>
</html>
