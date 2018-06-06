<?php
	session_start();
	if(!isset($_SESSION['sesion']))
			header("location: ../");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Actualizar profesor</title>
		<?php	require '../styles-scripts.php';?>
		<?php 
			$clave_profe = $_GET['clave'];
			require '../areas/AreaModel.php';
			$areas = new AreaModel; 
			$listaAreas = $areas->getListaAreas();
			require 'ProfesorModel.php';
			$obj_profesor = new ProfesorModel; 
			$profesor = $obj_profesor->getProfesor( $_GET['clave'] );
			//echo $profesor->nombre;
		?>
	</head>
	<body>
		<div class="container">
			<?php	require '../banner/banner.php'; ?>
			<div class="row">
				<div class="col panel panel-success col-lg-13 col-lg-offset-0">
					<div class="panel-heading text-center">
						<h1 >Actualizar profesor</h1>
					</div>
					<div class="panel-body ">
						<form action="ProfesorModel.php" method="POST">
							<div class="row form-group text-center">
								<label for="txt_clave" style="text-align: left; font-size: 20px;">Clave:</label>
								<input type="text" name="txt_clave" style="width: 200px; font-size: 20px" value="<?php echo $profesor->clave; ?>" readonly>
							</div>
							<div class="row form-group text-center">
								<div class="col-xs-4">
									<label for="txt_nombre" style="text-align: left; font-size: 20px;width: 200px;">Nombre:</label>
									<input type="text" name="txt_nombre" style="width: 200px; font-size: 20px" value="<?php echo $profesor->nombre; ?>">
								</div>
								<div class="col-xs-4">
									<label for="txt_apellido_paterno" style="text-align: left; font-size: 20px;width: 200px;">Apellido paterno:</label>
									<input type="text" name="txt_apellido_paterno" style="width: 200px; font-size: 20px" value="<?php echo $profesor->apellido_paterno; ?>">
								</div>
								<div class="col-xs-4">
									<label for="txt_apellido_materno" style="text-align: left; font-size: 20px;width: 200px;">Apellido materno:</label>
									<input type="text" name="txt_apellido_materno" style="width: 200px; font-size: 20px" value="<?php echo $profesor->apellido_materno; ?>">
								</div>
							</div>
							<div class="row form-group text-center">
								<div class="col-xs-3">
									<label for="txt_email" style="text-align: left; font-size: 20px;width: 200px;">Email:</label>
									<input type="text" name="txt_email" style="width: 200px; font-size: 20px" value="<?php echo $profesor->email; ?>">
								</div>
								<div class="col-xs-3" style="">
									<label for="txt_telefono" style="text-align: left; font-size: 20px;width: 200px;">Telefono:</label>
									<input type="text" name="txt_telefono" style="width: 200px; font-size: 20px" value="<?php echo $profesor->telefono; ?>">
								</div>
								<div class="col-xs-3" style="">
									<label for="txt_area" style="text-align: left; font-size: 20px;width: 200px;">Área:</label>
									<select name="txt_area" class="form-control" style="width: 280px" id="txt_area">
										<?php
											while($row = $listaAreas->fetch_assoc()) 
												echo "<option value=". $row['clave'] .">" . $row['area'] . "</option>";
										?>
									</select>
								</div>
								<div class="col-xs-3" style="">
									<label for="txt_status" style="text-align: left; font-size: 20px;width: 200px;">Status:</label>
									<input type="checkbox" name="txt_status" value="1" class="form-control" id="txt_status">Activo / Inactivo
								</div>
							</div>
							<div class="row form-group text-center" style="margin-top: 2%">
								<div class="col-xs-4"></div>
								<div class="col-xs-2"></div>
								<div class="col-xs-6">
									 <div class="form-group col-lg-9 col-lg-offset-3 right text-center" >
							 			<a href="../admin/inicio.php#profesores" class="btn btn-danger" style="width: 150px">Cancelar</a>
										<input type="submit" name="btt_actualizar" class="btn btn-success" style="width: 150px" value="Actualizar">
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
		var status = "<?php echo $profesor->status; ?>" ;
		if( status == 1 ) 
			document.getElementById('txt_status').checked = true;
		else if( status == 0 ) 
			document.getElementById('txt_status').checked = false;
	</script>
	<script>
		// PONER EN EL AREA AL CUAL PERTENECE EL PROFESOR
		var area = "<?php echo $profesor->clave_area; ?>" 
		for(var indice=0; indice<document.getElementById('txt_area').length; indice++) {
			if (document.getElementById('txt_area').options[indice].value == area )
				document.getElementById('txt_area').selectedIndex = indice;
		}      
	</script>
</html>