<html>
<head>
	<meta charset="UTF-8">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col panel panel-success col-lg-13 col-lg-offset-0">
				<div class="panel-heading text-center">
					<h1 >Configuración del administrador</h1>
				</div>
				<div class="panel-body ">
					<form action="AdminModel.php" method="POST">
						<div class="form-group text-center">
							<label for="txt_usuario" style="text-align: left; font-size: 20px;width: 200px;">Usuario:</label>
							<input type="text" name="txt_usuario" style="width: 200px; font-size: 20px" required>
						</div>
						<div class="form-group text-center">
							<label for="txt_contrasenia" style="width: 200px;text-align: left;  font-size: 20px">Contraseña:</label>
							<input type="text" name="txt_contrasenia" style="width: 200px; font-size: 20px" required>
						</div>
						<div class="form-group text-center">
							<label for="txt_contrasenia_2" style="width: 200px;text-align: left;  font-size: 20px">Confirma contraseña:</label>
							<input type="text" name="txt_contrasenia_2" style="width: 200px; font-size: 20px" required>
						</div>
						 <div class="form-group col-lg-6 col-lg-offset-3 right text-center"> 
						 	<a href="../admin/inicio.php" class="btn btn-danger" style="width: 150px">Cancelar</a>
							<input type="submit" name="btt_actualizar" class="btn btn-success" style="width: 150px" value="Actualizar">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>