<?php
require_once('../BOL/anios_escolares.php');
require_once('../DAO/anios_escolaresDAO.php');

$per = new anios_escolares();
$perDAO = new anios_escolares();

if(isset($_POST['guardar']))
{
	$per->__SET('id_escolar',           $_POST['id_escolar']);
	$per->__SET('Codigo',          $_POST['codigo']);
	$per->__SET('descripcion',        $_POST['descripcion']);
	$per->__SET('fecha_inicioDATE', 				$_POST['fecha_inicioDATE']);
	$per->$per->__SET('fecha_finDATE',        $_POST['fecha_finDATE']);
	$per->__SET('sstado', 				$_POST['estado']);

	$perDAO->Registrar($per);
	header('Location: frmAnios_escolares.php');
}



?>
<!DOCTYPE html>
<$per->__SET('descripcion',        $_POST['descripcion']);
$per->__SET('fecha_inicioDATE', 				$_POST['fecha_inicioDATE']);tml lang="es">
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
						go del anios_escolares
                    	-->
											<tr>
													<th style="text-align:left;">anios_escolares:</th>
													<td><input type="text" name="id_escolar" value="" style="width:100%;" required="ingrese descripcion" /></td>
											</tr>
											<tr>
													<th style="text-align:left;">anios_escolares:</th>
													<td><input type="text" name="codigo" value="" style="width:100%;" required="ingrese descripcion" /></td>
											</tr>
											<tr>
													<th style="text-align:left;">anios_escolares:</th>
													<td><input type="text" name="descripcion" value="" style="width:100%;" required="ingrese descripcion" /></td>
											</tr>
											<tr>
													<th style="text-align:left;">anios_escolares:</th>
													<td><input type="text" name="fecha_inicioDATE" value="" style="width:100%;" required="ingrese descripcion" /></td>
											</tr>
											<tr>
													<th style="text-align:left;">anios_escolares:</th>
													<td><input type="text" name="fecha_finDATE" value="" style="width:100%;" required="ingrese descripcion" /></td>
											</tr>
											<tr>
													<th style="text-align:left;">anios_escolares:</th>
													<td><input type="text" name="estado" value="" style="width:100%;" required="ingrese descripcion" /></td>
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
					$per->__SET('anios_escolares',          $_POST['anios_escolares']);//ESTABLECEMOS EL VALOR DEL DNI
					$resultado = $perDAO->Listar($per); //CARGAMOS LOS REGISTRO EN EL ARRAY RESULTADO
					if(!empty($resultado)) //PREGUNTAMOS SI NO ESTA VACIO EL ARRAY
					{
						?>
						<table class="pure-table pure-table-horizontal">
								<thead>
										<tr>
												<th style="text-align:left;">id_escolar</th>
												<th style="text-align:left;">codigo</th>
												<th style="text-align:left;">descripcion</th>
												<th style="text-align:left;">fecha_inicioDATE</th>
												<th style="text-align:left;">fecha_finDATE</th>
												<th style="text-align:left;">estado</th>
										</tr>
								</thead>
						<?php
						foreach( $resultado as $r): //RECORREMOS EL ARRAY RESULTADO A TRAVES DE SUS CAMPOS
							?>
								<tr>
										<td><?php echo $r->__GET('id_escolar'); ?></td>
										<td><?php echo $r->__GET('codigo'); ?></td>
										<td><?php echo $r->__GET('descripcion'); ?></td>
										<td><?php echo $r->__GET('fecha_inicioDATE'); ?></td>
										<td><?php echo $r->__GET('fecha_finDATE'); ?></td>
										<td><?php echo $r->__GET('estado'); ?></td>
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
