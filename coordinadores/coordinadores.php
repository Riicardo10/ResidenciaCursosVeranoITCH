<?php
	/*session_start();
	if(!isset($_SESSION['sesion']))
			header("location: ../");*/
?>
<?php
	require 'CoordinadorModel.php';
	$coordinadores = new CoordinadorModel; 
	$listaCoordinadores = $coordinadores->getListaCoordinadores();
?>
<div class="col panel panel-success col-lg-offset-0">
	<div class="panel-heading text-center">
		<h3 >Lista de Coordinadores de Materias</h3>
	</div>
	<div class="panel-body ">
		<a href="../coordinadores/agregar.php"><img src="../img/mas.png" alt="" style="float: right;" title="Agregar" ></a>
		<table class="table">
			<thead>
				<tr>
					<th>No. control</th>
					<th>Nombre</th>
					<th>Apellidos</th>
					<th>Email</th>
					<th>Teléfono</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php  
					if ( $listaCoordinadores ){
						while($row = $listaCoordinadores->fetch_assoc()) { ?>
							<tr>
								<th> <?php echo $row['no_control']; ?> </th>
								<td> <?php echo $row['nombre']; ?> </td>
								<td> <?php echo $row['apellido_paterno'] . ' ' . $row['apellido_materno']; ?> </td>
								<td> <?php echo $row['email']; ?> </td>
								<td> <?php echo $row['telefono']; ?> </td>
								<td>
									<a class="btn btn-primary" href="../coordinadores/actualizar.php?control=<?php echo $row['no_control']; ?>">Actualizar</a>
								</td>
								<td>
									 <form action="../coordinadores/CoordinadorModel.php" method="POST">
									 	<input type="hidden" name="txt_numero_control" value="<?php echo $row['no_control']; ?>">
										<input name="btt_eliminar" type="submit" class="btn btn-danger" value="Eliminar">
									</form>
								</td>
							</tr>
				<?php } } ?>
			</tbody>
		</table>
	</div>
</div>