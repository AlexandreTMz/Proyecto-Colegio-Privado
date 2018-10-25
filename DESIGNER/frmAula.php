<?php
require_once('../BOL/aula.php');
require_once('../DAO/aulaDAO.php');

$aul = new aula();
$aulDAO = new aulaDAO();

if(isset($_POST['guardar']))
{
	$aul->__SET('idAula',          $_POST['idAula']);
	$aul->__SET('descripcion',        $_POST['descripcion']);
	$aul->__SET('numeroAula', $_POST['numeroAula']);
	$aul->__SET('numeroAlumno',          $_POST['numeroAlumno']);
	$aul->__SET('turno',          $_POST['turno']);
	$aul->__SET('idDocente',          $_POST['idDocente']);
	$aul->__SET('idGrado',          $_POST['idGrado']);
	$aul->__SET('idSeccion',          $_POST['idSeccion']);

	$aulDAO->Registrar($aul);
	header('Location: frmAula.php');
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
                            <th style="text-align:left;">Id Aula</th>
                            <td><input type="text" name="idAula" value="" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Descripción</th>
                            <td><input type="text" name="descripcion" value="" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Número de Aula</th>
                            <td><input type="text" name="numeroAula" value="" style="width:100%;" /></td>
                        </tr>
												<tr>
                            <th style="text-align:left;">Número de Alumno</th>
                            <td><input type="text" name="numeroAlumno" value="" style="width:100%;" /></td>
                        </tr>
												<tr>
                            <th style="text-align:left;">Turno</th>
                            <td><input type="text" name="turno" value="" style="width:100%;" /></td>
                        </tr>
												<tr>
                            <th style="text-align:left;">Id Docente</th>
                            <td><input type="text" name="idDocente" value="" style="width:100%;" /></td>
                        </tr>
												<tr>
														<th style="text-align:left;">Id Grado</th>
														<td><input type="text" name="idGrado" value="" style="width:100%;" /></td>
												</tr>
												<tr>
														<th style="text-align:left;">Id Seccion</th>
														<td><input type="text" name="idSeccion" value="" style="width:100%;" /></td>
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
				if(isset($_POST['buscar']))
				{
					$resultado = array();//VARIABLE TIPO RESULTADO
					$aul->__SET('idAula',          $_POST['idAula']);//ESTABLECEMOS EL VALOR DEL DNI
					$resultado = $aulDAO->Listar($aul); //CARGAMOS LOS REGISTRO EN EL ARRAY RESULTADO
					if(!empty($resultado)) //PREGUNTAMOS SI NO ESTA VACIO EL ARRAY
					{
						?>
						<table class="pure-table pure-table-horizontal">
								<thead>
										<tr>
												<th style="text-align:left;">Id Aula</th>
												<th style="text-align:left;">Descripción</th>
												<th style="text-align:left;">Número de Aula</th>
												<th style="text-align:left;">Número de Alumno</th>
												<th style="text-align:left;">Turno</th>
												<th style="text-align:left;">Id Docente</th>
												<th style="text-align:left;">Id Grado</th>
												<th style="text-align:left;">Id Seccion</th>
										</tr>
								</thead>
						<?php
						foreach( $resultado as $r): //RECORREMOS EL ARRAY RESULTADO A TRAVES DE SUS CAMPOS
							?>
								<tr>
										<td><?php echo $r->__GET('idAula'); ?></td>
										<td><?php echo $r->__GET('descripcion'); ?></td>
										<td><?php echo $r->__GET('numeroAula'); ?></td>
										<td><?php echo $r->__GET('numeroAlumno'); ?></td>
										<td><?php echo $r->__GET('turno'); ?></td>
										<td><?php echo $r->__GET('idDocente'); ?></td>
										<td><?php echo $r->__GET('idGrado'); ?></td>
										<td><?php echo $r->__GET('idSeccion'); ?></td>
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
