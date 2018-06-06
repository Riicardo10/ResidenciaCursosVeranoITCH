
<div class='tab-content'>
	<div class='tab-pane active' id='general' role='tabpanel' aria-labelledby='general-tab'>
		<center>
		 	<h1>Bienvenido Administrador!</h1>
			<img src='../img/admin1.jpg' class='fondo img-circle' style='width: 35%; opacity: 0.8; '>
		</center>
	</div>
	<div class='tab-pane' id='usuarios' role='tabpanel' aria-labelledby='usuarios-tab'>
		<?php	require '../admin/usuarios.php'; ?>
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