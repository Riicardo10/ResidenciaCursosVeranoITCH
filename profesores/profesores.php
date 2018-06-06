<?php
	require 'ProfesorModel.php';
	$profesores = new ProfesorModel; 
	$listaProfesores = $profesores->getListaProfesores();
	$obj_area = new AreaModel; 
?>
<div class="col panel panel-success col-lg-offset-0">
	<div class="panel-heading text-center">
		<h3 >Lista de profesores</h3>
	</div>
	<div class="panel-body ">
		<a href="../profesores/agregar.php"><img src="../img/mas.png" alt="" style="float: right;" title="Agregar" ></a>
		<table class="table">
			<thead>
				<tr>
					<th>Clave</th>
					<th>Nombre</th>
					<th>Apellidos</th>
					<th>Email</th>
					<th>Teléfono</th>
					<th>Status</th>
					<th>Área</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php  
					if ( $listaProfesores ){
						while($row = $listaProfesores->fetch_assoc()) { ?>
							<tr>
								<th> <?php echo $row['clave']; ?> </th>
								<td> <?php echo $row['nombre']; ?> </td>
								<td> <?php echo $row['apellido_paterno'] . ' ' . $row['apellido_materno']; ?> </td>
								<td> <?php echo $row['email']; ?> </td>
								<td> <?php echo $row['telefono']; ?> </td>
								<td> <?php  echo $status = ($row['status'] == 1) ? "Activo" : "Inactivo"; ?> </td>
								<td> <?php 									
									echo $obj_area->getArea( $row['clave_area'] )
								?> </td>
								<td>
									<a class="btn btn-primary" href="../profesores/actualizar.php?clave=<?php echo $row['clave']; ?>">Actualizar</a>
								</td>
								<td>
									 <form action="../profesores/ProfesorModel.php" method="POST">
									 	<input type="hidden" name="txt_clave" value="<?php echo $row['clave']; ?>">
										<input name="btt_eliminar" type="submit" class="btn btn-danger" value="Dar de baja">
									</form>
								</td>
							</tr>
				<?php } } ?>
			</tbody>
		</table>
	</div>
</div>