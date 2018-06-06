<?php
	session_start();
	if(!isset($_SESSION['sesion']))
			header("location: ../");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Actualizar Coordinador de materia</title>
		<?php	require '../styles-scripts.php';?>
		<?php 
			$clave_coordinador = $_GET['control'];
			require 'CoordinadorModel.php';
			$obj_coordinador = new CoordinadorModel; 
			$coordinador = $obj_coordinador->getCoordinador( $_GET['control'] );
		?>
	</head>
	<body>
		<div class="container">
			<?php	require '../banner/banner.php'; ?>
			<div class="row">
				<div class="col panel panel-success col-lg-13 col-lg-offset-0">
					<div class="panel-heading text-center">
						<h1 >Actualizar Coordinador de materia</h1>
					</div>
					<div class="panel-body ">
						<form action="CoordinadorModel.php" method="POST">
							<div class="row form-group text-center">
								<div class="col-xs-10">
									<label for="txt_numero_control" style="text-align: left; font-size: 20px;width: 200px;">Numero de control:</label>
									<input type="text" name="txt_numero_control" style="width: 200px; font-size: 20px" value="<?php echo $coordinador->no_control; ?>" readonly>
								</div>
							</div>
							<div class="row form-group text-center">
								<div class="col-xs-4">
									<label for="txt_nombre" style="text-align: left; font-size: 20px;width: 200px;">Nombre:</label>
									<input type="text" name="txt_nombre" style="width: 200px; font-size: 20px" value="<?php echo $coordinador->nombre; ?>">
								</div>
								<div class="col-xs-4">
									<label for="txt_apellido_paterno" style="text-align: left; font-size: 20px;width: 200px;">Apellido paterno:</label>
									<input type="text" name="txt_apellido_paterno" style="width: 200px; font-size: 20px" value="<?php echo $coordinador->apellido_paterno; ?>">
								</div>
								<div class="col-xs-4">
									<label for="txt_apellido_materno" style="text-align: left; font-size: 20px;width: 200px;">Apellido materno:</label>
									<input type="text" name="txt_apellido_materno" style="width: 200px; font-size: 20px" value="<?php echo $coordinador->apellido_materno; ?>">
								</div>
							</div>
							<div class="row form-group text-center">
								<div class="col-xs-4">
									<label for="txt_email" style="text-align: left; font-size: 20px;width: 200px;">Email:</label>
									<input type="text" name="txt_email" style="width: 200px; font-size: 20px" value="<?php echo $coordinador->email; ?>">
								</div>
								<div class="col-xs-4" style="">
									<label for="txt_telefono" style="text-align: left; font-size: 20px;width: 200px;">Telefono:</label>
									<input type="text" name="txt_telefono" style="width: 200px; font-size: 20px" value="<?php echo $coordinador->telefono; ?>">
								</div>
							</div>
							<div class="row form-group text-center" style="margin-top: 2%">
								<div class="col-xs-4"></div>
								<div class="col-xs-2"></div>
								<div class="col-xs-6">
									 <div class="form-group col-lg-9 col-lg-offset-3 right text-center" >
							 			<a href="../admin/inicio.php#coordinadores" class="btn btn-danger" style="width: 150px">Cancelar</a>
										<input type="submit" name="btt_actualizar	" class="btn btn-success" style="width: 150px" value="Actualizar">
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>