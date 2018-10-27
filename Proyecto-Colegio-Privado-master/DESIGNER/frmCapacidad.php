<?php
require_once('../BOL/capacidad.php');
require_once('../DAO/capacidadDAO.php');

session_start();

$cap = new Capacidad();
$capDAO = new CapacidadDAO();

if(isset($_POST['guardar']))
{
	$cap->__SET('capacidad',          $_POST['capacidad']);
$cap->__GET('ent')->__SET('id_competencia', $_SESSION["id"]);

	$capDAO->Registrar($cap);
	header('Location: frmCapacidad.php');
}



?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>CRUD</title>
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
	</head>
    <body style="padding:15px;">

        <div class="pure-g">
            <div class="pure-u-1-12">

                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">

                    <table style="width:500px;" border="0">
                        <tr>
                            <th style="text-align:left;">Nombre:</th>
                            <td><input type="text" name="capacidad" value="" style="width:100%;" /></td>
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

				<!--ESTA CONDICION SIRVE PARA REALIZAR BUSQUEDA POR DNI-->

				<?php


				$resultado = array();//VARIABLE TIPO RESULTADO
					$cap->__GET('ent')->__SET('id_competencia', $_SESSION["id"]);
					$resultado = $capDAO->ListarCapacidad($cap); //CARGAMOS LOS REGISTRO EN EL ARRAY RESULTADO
					if(!empty($resultado)) //PREGUNTAMOS SI NO ESTA VACIO EL ARRAY
					{
						?>
						<table class="pure-table pure-table-horizontal">
								<thead>
										<tr>
												<th style="text-align:left;">ID</th>
												<th style="text-align:left;">Nombre</th>
										</tr>
								</thead>
						<?php
						foreach( $resultado as $r): //RECORREMOS EL ARRAY RESULTADO A TRAVES DE SUS CAMPOS
							?>
								<tr>
										<td><?php echo $r->__GET('id_capacidad'); ?></td>
										<td><?php echo $r->__GET('capacidad'); ?></td>
										<td><?php echo $r->__GET('ent')->__GET('id_competencia'); ?></td>
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

				/*if(isset($_POST['buscar']))
				{
					$resultado = array();//VARIABLE TIPO RESULTADO
					$cap->__SET('id_capacidad',          $_POST['capacidad']);//ESTABLECEMOS EL VALOR DEL DNI
					$resultado = $capDAO->Listar($cap); //CARGAMOS LOS REGISTRO EN EL ARRAY RESULTADO
					if(!empty($resultado)) //PREGUNTAMOS SI NO ESTA VACIO EL ARRAY
					{
						?>
						<table class="pure-table pure-table-horizontal">
								<thead>
										<tr>
												<th style="text-align:left;">ID</th>
												<th style="text-align:left;">Nombre</th>
										</tr>
								</thead>
						<?php
						foreach( $resultado as $r): //RECORREMOS EL ARRAY RESULTADO A TRAVES DE SUS CAMPOS
							?>
								<tr>
										<td><?php echo $r->__GET('id_capacidad'); ?></td>
										<td><?php echo $r->__GET('capacidad'); ?></td>
								</tr>
						<?php endforeach;
					}
					else
					{
						echo 'no se encuentra en la base de datos!';
					}*/
					?>
					</table>
					<?php
				//}
				?>

    </body>
</html>
