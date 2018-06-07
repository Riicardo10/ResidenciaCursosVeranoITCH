<?php
	session_start();
	if(!isset($_SESSION['sesion']))
			header("location: ../");
?>
<?php
	require '../profesores/ProfesorModel.php';
	$obj_profesor = new ProfesorModel; 
	$listaProfesores = $obj_profesor->getListaProfesores();


	$id_carrera = $_POST['id_carrera'];
	$nombre_carrera = $_POST['nombre_carrera'];
	$id_materia_solicitada = $_POST['id_materia_solicitada'];
	$id_materia = $_POST['id_materia'];
	$nombre_materia = $_POST['nombre_materia'];
	$aprobada_db = $_POST['aprobada_db'];
	$aprobada = $_POST['aprobada'];
	$no_control = $_POST['no_control'];
	$nombre_coordinador = $_POST['nombre_coordinador'];
	$id_profesor = $_POST['clave_profesor'];
	
	//echo $id_materia_solicitada . " " . $id_materia . " " . $nombre_materia . " " . $aprobada . " " . $aprobada_db . " " . $no_control . " " . $nombre_coordinador;
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Detalles</title>
		<?php	require '../styles-scripts.php';?>
	</head>
	<body>
		<div class="container">
			<?php	require '../banner/banner.php'; ?>
			<div class="row">
				<div class="col panel panel-success col-lg-13 col-lg-offset-0">
					<div class="panel-heading text-center">
						<h1 >Detalles</h1>
					</div>
					<div class="panel-body ">
						<form action="JefeModel.php" method="POST">
							<input type="hidden" name="txt_id_carrera" style="width: 200px; font-size: 20px" value="<?php echo $id_carrera; ?>" readonly>
							<input type="hidden" name="txt_nombre_carrera" style="width: 200px; font-size: 20px" value="<?php echo $nombre_carrera; ?>" readonly>
							<div class="row form-group text-center">
								<div class="col-xs-2"></div>
								<div class="col-xs-4">
									<label for="txt_clave" style="text-align: left; font-size: 20px;width: 200px;">Clave:</label>
									<input type="text" name="txt_clave" style="width: 200px; font-size: 20px" value="<?php echo $id_materia_solicitada; ?>" readonly>
								</div>
								
								<div class="col-xs-4">
									<label for="txt_nombre_materia" style="text-align: left; font-size: 20px;width: 200px;">Materia:</label>
									<input type="text" name="txt_nombre_materia" style="font-size: 20px" value="<?php echo $nombre_materia; ?>" readonly>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-1"></div>
								<div class="col-xs-10">
									<label for="txt_no_control" style="text-align: left; font-size: 22px;">Coordinador:</label>
									<br>
									<label for="txt_no_control" style="text-align: left; font-size: 17px; margin-left: 100px;"><?php echo "No. control: " . $no_control; ?></label>
									<label for="txt_no_control" style="text-align: left; font-size: 17px;"><?php echo "    $nombre_coordinador"; ?>:</label>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-1"></div>
								<div class="col-xs-10">
									<label for="txt_no_control" style="text-align: left; font-size: 22px;">Profesor asignado:</label>
									<br>
									<select name="txt_carrera" id="txt_carrera" class="form-control" style="margin-left: 100px;width: 280px">
										<option value="NULL">--Sin asignar--</option>
										<?php
											while($row = $listaProfesores->fetch_assoc()) 
												echo "<option value=". $row['clave'] .">" . $row['nombre'] . " " . $row['apellido_paterno'] . " " . $row['apellido_materno']  . "</option>";
										?>
									</select>
								</div>
							</div>
							<div class="row form-group text-center">
								
								
							</div>
							<div class="row form-group text-center" style="margin-top: 2%">
								<div class="col-xs-4"></div>
								<div class="col-xs-2"></div>
								<div class="col-xs-6">
									 <div class="form-group col-lg-9 col-lg-offset-3 right text-center" >
							 			<a href="../jefes/lista_materias.php?id=<?php echo $id_carrera;?>&nombre=<?php echo $nombre_carrera?>" class="btn btn-danger" style="width: 150px">Cancelar</a>
										<input type="submit" name="btt_guardar_detalle_materia" class="btn btn-success" style="width: 150px" value="Guardar">
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
	<script>
		// PONER EL CHECK ACTIVO / INACTIVO
		var status = "<?php echo $aprobada; ?>" ;
		if( status == 'Si' ) 
			document.getElementById('txt_status').checked = true;
		else if( status == 0 ) 
			document.getElementById('txt_status').checked = false;
	</script>
	<script>
		var profesor = "<?php echo $id_profesor; ?>" 
		for(var indice=0; indice<document.getElementById('txt_carrera').length; indice++) {
			if (document.getElementById('txt_carrera').options[indice].value == profesor )
				document.getElementById('txt_carrera').selectedIndex = indice;
		}      
	</script>
</html>