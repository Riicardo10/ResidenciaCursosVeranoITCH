<?php
	require 'SubdirectorModel.php';
	$subdirectores = new SubdirectorModel; 
	$listaProfesores = $subdirectores->getListaSubdirectores();
?>
<div class="col panel panel-success col-lg-offset-0">
	<div class="panel-heading text-center">
		<h3 >Lista de subdirectores</h3>
	</div>
	<div class="panel-body ">
		<a href="../subdirector/agregar.php"><img src="../img/mas.png" alt="" style="float: right;" title="Agregar" ></a>
		<table class="table">
			<thead>
				<tr>
					<th>Clave</th>
					<th>Nombre</th>
					<th>Apellidos</th>
					<th>Email</th>
					<th>Teléfono</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php  
					if ( $listaProfesores ){
						while($row = $listaProfesores->fetch_assoc()) { ?>
							<tr>
								<th> <?php echo $row['id']; ?> </th>
								<td> <?php echo $row['nombre']; ?> </td>
								<td> <?php echo $row['apellido_paterno'] . ' ' . $row['apellido_materno']; ?> </td>
								<td> <?php echo $row['email']; ?> </td>
								<td> <?php echo $row['telefono']; ?> </td>
								<td>
									 <form action="../subdirector/SubdirectorModel.php" method="POST">
									 	<input type="hidden" name="txt_id" value="<?php echo $row['id']; ?>">
										<input name="btt_eliminar" type="submit" class="btn btn-danger" value="Eliminar">
									</form>
								</td>
							</tr>
				<?php } } ?>
			</tbody>
		</table>
	</div>
</div>