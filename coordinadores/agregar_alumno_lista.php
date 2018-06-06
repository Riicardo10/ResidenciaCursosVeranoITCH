<?php
	session_start();
	if(!isset($_SESSION['sesion']))
			header("location: ../");
?>
<?php
	$id_materia = $_POST[ 'txt_materia_id' ];
	$materia = $_POST[ 'txt_materia_nombre' ];
	$id_materia_solicitada = $_POST[ 'txt_id_materia_solicitada' ];
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container">
			<div class="modal fade" id="myModal">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Registrar alumno para la materia: <?php echo $materia; ?> </h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<div class="modal-body">
							<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

								<div class="form-group">
									<input type="hidden" class="form-control" name="txt_materia_id" value="<?php echo $id_materia;?>">
								</div>
								<div class="form-group">
									<input type="hidden" class="form-control" name="txt_materia_nombre" value="<?php echo $materia;?>">
								</div>
								<div class="form-group">
									<input type="hidden" class="form-control" name="txt_id_materia_solicitada" value="<?php echo $id_materia_solicitada;?>">
								</div>
								<div class="form-group">
									<label class="col-form-label">Numero de control:</label>
									<input type="text" class="form-control" name="txt_num_control" required="">
								</div>
								<div class="form-group">
									<label class="col-form-label">Nombre:</label>
									<input type="text" class="form-control" name="txt_nombre" required="">
								</div>
								<div class="form-group">
									<label class="col-form-label">Apellido paterno:</label>
									<input type="text" class="form-control" name="txt_apellido_paterno" required="">
								</div>
								<div class="form-group">
									<label class="col-form-label">Apellido materno:</label>
									<input type="text" class="form-control" name="txt_apellido_materno" required="">
								</div>
								<div class="form-group">
									<label class="col-form-label">Email:</label>
									<input type="text" class="form-control" name="txt_email" required="">
								</div>
								<div class="form-group">
									<label class="col-form-label">Telefono:</label>
									<input type="text" class="form-control" name="txt_telefono" required="">
								</div>
								<input type="submit" value="Agregar" class="btn btn-success" name="btt_agregar_alumno_lista">
								<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>

<?php
	if(isset($_POST['btt_agregar_alumno_lista'])){
		$id_materia_solicitada = $_POST[ 'txt_id_materia_solicitada' ];
		$id_materia = $_POST['txt_materia_id'];
		$nombre_materia = $_POST['txt_materia_nombre'];
		$no_control =  $_POST['txt_num_control'];
		$nombre =  $_POST['txt_nombre'];
		$apellido_paterno =  $_POST['txt_apellido_paterno'];
		$apellido_materno =  $_POST['txt_apellido_materno'];
		$telefono =  $_POST['txt_telefono'];
		$email =  $_POST['txt_email'];
		//echo "Alumno: $no_control $nombre $apellido_paterno $apellido_materno $telefono $email <br>";
		//echo "$id_materia_solicitada Materia: $id_materia $nombre_materia <br>";
		require '../conexion/conexion_mysqli.php';
		//echo "<br>";
		$sql_estudiante = "INSERT INTO estudiantes values ( NULL, '$no_control', '$nombre', '$apellido_paterno', '$apellido_materno', '$email', '$telefono' )";
		mysqli_query( $conexion, $sql_estudiante );
		if( mysqli_affected_rows( $conexion ) > 0 ){
			$sql_lista = "INSERT INTO lista_materia values ( $id_materia_solicitada, '$id_materia', '$no_control' )";
			mysqli_query( $conexion, $sql_lista );
			if( mysqli_affected_rows( $conexion ) > 0 ){
				
			}
			else{
				echo "<script>mensajeError( 'Upsss!', 'El estudiante no se inserto en la lista.' );</script>";
				header("Refresh:1; url=../coordinadores/lista_materia.php");
		 	}
		}
		else{
			echo "<script>mensajeError( 'Upsss!', 'El estudiante no se inserto.' );</script>";
			header("Refresh:1; url=../coordinadores/lista_materia.php");
		 }
	}
?>
