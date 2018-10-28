<?php
require_once('../BOL/alumnos_rcalificacion.php');
require_once('../DAO/alumnos_rcalificacionDAO.php');

$per = new Alumnos_rcalificacion();
$perDAO = new alumnos_rcalificacionDAO();

if(isset($_POST['guardar']))
{
	$per->__SET('id_arcalificacion',	$_POST['id_arcalificacion']);
	$per->__SET('id_estudiante',				$_POST['id_estudiante']);
	$per->__SET('id_rcalificacion',$_POST['id_rcalificacion']);
	$per->__SET('nota_final',         $_POST['nota_final']);


	$perDAO->Registrar($per);
	header('Location: frmalumnos_rcalificacion.php');
}



?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>CRUD</title>        
		<!--Import Google Icon Font-->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<!--Import materialize.css-->
		<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
	</head>
    <body>



	<div class="row">
      
      <div class="col s3">
	  
	  </div>
      <div class="col s9">
		<div class="col s12">
			<h1 class="text-center">Formulario de ingreso de alumos y calificacion</h1>
		</div>
        <div class="pure-g">
            <div class="pure-u-1-12">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">

                    <table style="width:600px; border-collapse: collapse;" border="0" class="striped centered">
					<!--inicio del id-->
					<tr >
                            <th style="text-align:left;" >ID</th>
                            <td>
							<div class="row">								
								<div class="input-field col s12">
								<i class="material-icons prefix">create</i>								
									<input type="text" id="autocomplete-input1" name="id" class="autocomplete" require>
									<label for="autocomplete-input1">Ingresar el ID</label>
								</div>							
							</div>
							</td>
                        </tr>	
					
					
					<!--inicio de los nombres de competencias-->
						<tr >
                            <th style="text-align:left;" >Nombre</th>
                            <td>
							<div class="row">								
								<div class="input-field col s12">
								<i class="material-icons prefix">create</i>								
									<input type="text" id="autocomplete-input2" name="nombreCompetencia" class="autocomplete" require>
									<label for="autocomplete-input2">Ingresar nombre de la competencia</label>
								</div>							
							</div>
							</td>
                        </tr>

						<!--Inicio de los numeros de competencias-->
                        <tr>
                            <th style="text-align:left;">Competencias</th>
                            <td>


								<div class="row">								
								<div class="input-field col s12">
								<i class="material-icons prefix">create</i>								
									<input type="text" id="autocomplete-input3" name="numeroCo" class="autocomplete" require>
									<label for="autocomplete-input3">Ingresar numuero de competencias</label>
								</div>							
							</div>
								<!--
							<div class="input-field col s12" name="numeroCo">
								<select>
									<option value="" disabled selected>Seleccione</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
								</select>
								
							</div>

							-->
							</td>
                        </tr>

						</tr>

						<td colspan="2">
						<button class="btn waves-effect waves-light btn-large" type="submit" name="guardar">Guardar
							<i class="material-icons left">save</i>
						</button>
						<button class="btn waves-effect waves-light btn-large" type="submit" name="buscar">Buscar
							<i class="material-icons left">search</i>
						</button>
						</td>
						</tr>

                    </table>
                </form>
            </div>
        </div>
	  </div>
	  
    </div>

	

				<!--ESTA CONDICION SIRVE PARA REALIZAR BUSQUEDA POR DNI-->

				<?php
				if(isset($_POST['buscar']))
				{
					$resultado = array();//VARIABLE TIPO RESULTADO
					$per->__SET('dni',          $_POST['dni']);//ESTABLECEMOS EL VALOR DEL DNI
					$resultado = $perDAO->Listar($per); //CARGAMOS LOS REGISTRO EN EL ARRAY RESULTADO
					if(!empty($resultado)) //PREGUNTAMOS SI NO ESTA VACIO EL ARRAY
					{
						?>
						<table class="pure-table pure-table-horizontal">
								<thead>
										<tr>
												<th style="text-align:left;">ID</th>
												<th style="text-align:left;">Nombres</th>
												<th style="text-align:left;">Apellidos</th>
												<th style="text-align:left;">DNI</th>
										</tr>
								</thead>
						<?php
						foreach( $resultado as $r): //RECORREMOS EL ARRAY RESULTADO A TRAVES DE SUS CAMPOS
							?>
								<tr>
										<td><?php echo $r->__GET('id'); ?></td>
										<td><?php echo $r->__GET('nombres'); ?></td>
										<td><?php echo $r->__GET('apellidos'); ?></td>
										<td><?php echo $r->__GET('dni'); ?></td>
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
	
<!--JavaScript at end of body for optimized loading-->
<script type="text/javascript" src="js/materialize.min.js"></script>
<script>
	   

		document.addEventListener('DOMContentLoaded', function() {
			//inciio del parallax
			var elems = document.querySelectorAll('.parallax');
    		var instances = M.Parallax.init(elems);
			
			//inicio del combo box
			var elems = document.querySelectorAll('select');
    		var instances = M.FormSelect.init(elems);

			
 		});

		// Or with jQuery

		$(document).ready(function(){
			$('.datepicker').datepicker();
		});
      

</script>
</body>
</html>
