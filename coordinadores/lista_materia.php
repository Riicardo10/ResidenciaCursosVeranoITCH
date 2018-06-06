


<?php require 'agregar_alumno_lista.php'; ?>

<!DOCTYPE html>
<html>
	<head>
		<script src="../js/sweetalert.min.js"></script>
		<script src="../js/sweetAlert_functions.js"></script>
		<link rel="stylesheet" type="text/css" href="../css/sweetalert.css">


<?php
	if( !$_POST[ 'txt_materia_id' ] || !$_POST[ 'txt_materia_nombre' ] || !$_POST[ 'txt_id_materia_solicitada' ] ) {
		echo "<script>mensajeError( 'Upsss!', 'Verifica numero de control.' );</script>";
		header("Refresh:1; url=../coordinadores/inicio.php");
	}
	$id_materia = $_POST[ 'txt_materia_id' ];
	$materia = $_POST[ 'txt_materia_nombre' ];
	$id_materia_solicitada = $_POST[ 'txt_id_materia_solicitada' ];
?>

<?php
	require 'CoordinadorModel.php';
	$coordinador = new CoordinadorModel; 
?>

		<title>Lista de materia</title>
		<?php	require '../styles-scripts.php';?>
		<style>
			.carrera{
				width: 80%;
			}
		</style>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container">
			<?php	require '../banner/banner.php'; ?>
			<hr>
			<div class="row">
				<div class="col-xs-1"></div>
				<div class="col-xs-10">
					<div class="col panel panel-success col-lg-offset-0">
						<div class="panel-heading text-center">
							<h3>Materia: <?php  echo $materia; ?> </h3>
							<a class="btn btn-link" href="materias_solicitadas.php">Cancelar</a>
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"> Agregar </button>
						</div>
						<div class="panel-body ">
							<?php
								// echo "LM... Materia solicitada: $id_materia_solicitada";
								// echo "<br>";
								// echo "LM... Materia: $id_materia";
								// echo "<br>";
								// echo "LM... Materia nombre: $materia";
								// echo "<br>";
								$lista = $coordinador->getListaDeMateria( $id_materia_solicitada );			
							?>
							<table class="table">
								<thead>
									<tr>
										<th>Materia solicitada</th>
										<th>Clave materia</th>
										<th>No. Control</th>
										<th>Nombre</th>
										<th>Apellidos</th>
									</tr>
								</thead>
								<tbody>
									<?php  
										if ( $lista ){
											while($row = $lista->fetch_assoc()) { ?>
												<tr>
													<th> <?php echo $row['id_materia_solicitada']; ?> </th>
													<th> <?php echo $row['clave_materia']; ?> </th>
													<th> <?php echo $row['no_control']; ?> </th>
													<td> <?php echo $row['nombre']; ?> </td>
													<td> <?php echo $row['apellido_paterno'] . ' ' . $row['apellido_materno']; ?> </td>
													<td>
														 <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
														 	<input type="hidden" name="txt_numero_control" value="<?php echo $row['no_control']; ?>">
														</form>
													</td>
												</tr>
									<?php } } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="col-xs-1"></div>
			</div>
		</div>
	</body>
</html>












<?php
	if(isset($_POST['btt_eliminar_alumno_de_materia'])){
		echo "HOLA";
	}
?>
