<?php
	session_start();
	if(!isset($_SESSION['sesion']))
			header("location: ../");
?>
<?php
		require 'CoordinadorModel.php';
		$id_eliminar =  $_GET['materia'];
		$coordinador_obj = new CoordinadorModel; 
		$coordinador_obj->eliminarMateriaSolicitadaConLista( $id_eliminar );
		$coordinador_obj->eliminarMateriaSolicitada( $id_eliminar );
?>
