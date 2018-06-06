<div class="row" style="background:white">
	<br>
	<div class="col-xs-9">
		<img src="img/logo-tec.jpg" width=100%' height='auto'>
	</div>
	<div class="col-xs-3">
		<div class="panel-body ">
			<form action="admin/AdminModel.php" method="POST">
				<table>
					<tr>
						<td>
							<label for="txt_usuario" style="text-align: left;">Usuario:</label>
						</td>
						<td>
							<input type="text" name="txt_usuario" required>
						</td>
					</tr>
					<tr>
						<td>
							<label for="txt_contrasenia" style="text-align: left;">Contraseña:</label>
						</td>
						<td>
							<input type="password" name="txt_contrasenia" required>	
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="submit" class="btn btn-success" name="btt_ingresar" value="Ingresar">
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</div>