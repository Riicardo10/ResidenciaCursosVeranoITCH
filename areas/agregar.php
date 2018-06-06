<?php
	session_start();
	if(!isset($_SESSION['sesion']))
			header("location: ../");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Registro de áreas</title>
		<?php	require '../styles-scripts.php';?>
	</head>
	<body>
		<div class="container">
			<?php	require '../banner/banner.php'; ?>
			<div class="row">
				<div class="col panel panel-success col-lg-13 col-lg-offset-0">
					<div class="panel-heading text-center">
						<h1 >Registro de áreas</h1>
					</div>
					<div class="panel-body ">
						<form action="../areas/AreaModel.php" method="POST">
							<div class="form-group text-center">
								<label for="txt_clave" style="text-align: left; font-size: 20px;width: 200px;">Clave:</label>
								<input type="text" name="txt_clave" style="width: 200px; font-size: 20px" required>
							</div>
							<div class="form-group text-center">
								<label for="txt_area" style="width: 200px;text-align: left;  font-size: 20px">Área:</label>
								<input type="text" name="txt_area" style="width: 200px; font-size: 20px" required>
							</div>
							 <div class="form-group col-lg-6 col-lg-offset-3 right text-center"> 
							 	<a href="../admin/inicio.php#areas" class="btn btn-danger" style="width: 150px">Cancelar</a>
								<input type="submit" name="btt_agregar" class="btn btn-success" style="width: 150px" value="Registrar">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>