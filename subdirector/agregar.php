<?php
	session_start();
	if(!isset($_SESSION['sesion']))
			header("location: ../");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Registro de subdirector</title>
		<?php	require '../styles-scripts.php';?>
		<?php 
			require '../areas/AreaModel.php';
			$areas = new AreaModel; 
			$listaAreas = $areas->getListaAreas();
		?>
	</head>
	<body>
		<div class="container">
			<?php	require '../banner/banner.php'; ?>
			<div class="row">
				<div class="col panel panel-success col-lg-13 col-lg-offset-0">
					<div class="panel-heading text-center">
						<h1 >Registro de subdirector</h1>
					</div>
					<div class="panel-body ">
						<form action="SubdirectorModel.php" method="POST">
							<div class="row form-group text-center">
								<div class="col-xs-4">
									<label for="txt_nombre" style="text-align: left; font-size: 20px;width: 200px;">Nombre:</label>
									<input type="text" name="txt_nombre" style="width: 200px; font-size: 20px" required>
								</div>
								<div class="col-xs-4">
									<label for="txt_apellido_paterno" style="text-align: left; font-size: 20px;width: 200px;">Apellido paterno:</label>
									<input type="text" name="txt_apellido_paterno" style="width: 200px; font-size: 20px" required>
								</div>
								<div class="col-xs-4">
									<label for="txt_apellido_materno" style="text-align: left; font-size: 20px;width: 200px;">Apellido materno:</label>
									<input type="text" name="txt_apellido_materno" style="width: 200px; font-size: 20px" required>
								</div>
							</div>
							<div class="row form-group text-center">
								<div class="col-xs-3"></div>
								<div class="col-xs-3">
									<label for="txt_email" style="text-align: left; font-size: 20px;width: 200px;">Email:</label>
									<input type="text" name="txt_email" style="width: 200px; font-size: 20px" required>
								</div>
								<div class="col-xs-3" style="">
									<label for="txt_telefono" style="text-align: left; font-size: 20px;width: 200px;">Telefono:</label>
									<input type="text" name="txt_telefono" style="width: 200px; font-size: 20px" required>
								</div>
							</div>
							<div class="row form-group text-center" style="margin-top: 2%">
								<div class="col-xs-4"></div>
								<div class="col-xs-2"></div>
								<div class="col-xs-6">
									 <div class="form-group col-lg-9 col-lg-offset-3 right text-center" >
							 			<a href="../admin/inicio.php#subdirector" class="btn btn-danger" style="width: 150px">Cancelar</a>
										<input type="submit" name="btt_agregar" class="btn btn-success" style="width: 150px" value="Registrar">
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