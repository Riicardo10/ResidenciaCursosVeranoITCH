<?php 
	require 'AdminModel.php';
	$admin = new AdminModel; 
	$lista = $admin->getListaMontos();
?>

<?php
	if(isset($_POST['btt_actualizar_monto'])){
		
	}
	else if(isset($_POST['btt_eliminar_monto'])){
		$admin->eliminarMonto( $_POST['txt_id'] );
	}
?>

<div class='tab-content'>
	<div class='tab-pane active' id='general' role='tabpanel' aria-labelledby='general-tab'>
		<div class="row">
			<div class="col-xs-3">
				<?php $anio = Date('Y');?>
				<h3>Verano <?php echo $anio; ?></h3>
			</div>
			<div class="col-xs-1"></div>
			<div class="col-xs-5">
				<?php
				if ($lista){
					?>
					<table class="table">
						<th>Creditos</th>
						<th>Horas</th>
						<th>Monto</th>
						<th></th>
						<th></th>
						<?php
						while($row = $lista->fetch_assoc()) {
							?>
							<tr>
								<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
									<input type="hidden" value="<?php echo $row['id']; ?>" name="txt_id">
									<td> <?php echo $row['creditos'] ?> </td>
									<td> <?php echo $row['horas'] ?> </td>
									<td> <?php echo $row['montos'] ?> </td>
									<td><input type="submit" name="btt_eliminar_monto" value="Eliminar" class="btn btn-danger btn-sm"></td>
								</form>
							</tr>
							<?php
					}
				}
			?>
						</table>
				<a href="agregar_monto.php"><img src="../img/mas.png" ></a>
				
			</div>
		</div>
		<hr>
	</div>
	<div class='tab-pane' id='usuarios' role='tabpanel' aria-labelledby='usuarios-tab'>
		<?php	require '../admin/usuarios.php'; ?>
	</div>
	<div class='tab-pane' id='altas' role='tabpanel' aria-labelledby='altas-tab'>
		<?php	require '../admin/altas.php'; ?>
	</div>
	<div class='tab-pane' id='ver' role='tabpanel' aria-labelledby='ver-tab'>
		<?php	require '../admin/visualizar.php'; ?>
	</div>
	<div class='tab-pane' id='areas' role='tabpanel' aria-labelledby='areas-tab'>
		<?php	require '../areas/areas.php'; ?>
	</div>
	<div class='tab-pane' id='carreras' role='tabpanel' aria-labelledby='carreras-tab'>
		<?php	require '../carreras/carreras.php'; ?>
	</div>
	<div class='tab-pane' id='semestres' role='tabpanel' aria-labelledby='semestres-tab'>
		<?php	require '../semestres/semestres.php'; ?>
	</div>
	<div class='tab-pane' id='materias' role='tabpanel' aria-labelledby='materias-tab'>
		<?php	require '../materias/materias.php'; ?>
	</div>
	<div class='tab-pane' id='subdirector' role='tabpanel' aria-labelledby='subdirector-tab'>
		<?php	require '../subdirector/subdirector.php'; ?>
	</div>
	<div class='tab-pane' id='jefes-depto' role='tabpanel' aria-labelledby='jefes-depto-tab'>
		<?php	require '../jefes/jefes.php'; ?>
	</div>
	<div class='tab-pane' id='profesores' role='tabpanel' aria-labelledby='profesores-tab'>
		<?php	require '../profesores/profesores.php'; ?>
	</div>
	<div class='tab-pane' id='coordinadores' role='tabpanel' aria-labelledby='coordinadores-tab'>
		<?php	require '../coordinadores/coordinadores.php'; ?>
	</div>
	<div class='tab-pane' id='configuracion' role='tabpanel' aria-labelledby='configuracion-tab'>
		<?php	require '../admin/configuracion.php'; ?>
	</div>
	<!-- <div class='tab-pane' id='cerrar_sesion' role='tabpanel' aria-labelledby='cerrar_sesion-tab'>
		<a href="../">Cerrar</a>
	</div> -->
	
</div>


<?php
	if(isset($_POST['btt_actualizar_monto'])){
		echo "ACTUALIZAR";
	}
	else if(isset($_POST['btt_eliminar_monto'])){
		echo "ELIMINAR";
	}
?>