<html>
	<head>
		<script src="../js/sweetalert.min.js"></script>
		<script src="../js/sweetAlert_functions.js"></script>
		<link rel="stylesheet" type="text/css" href="../css/sweetalert.css">
	</head>
</html>
<?php 
	class CarreraModel { 
		function getCarrera ( $clave ) { 
			require '../conexion/conexion_mysqli.php';
			$sql = "SELECT * FROM carreras WHERE clave = '$clave'";
			$result = $conexion->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					return $row['carrera'] ;
				}
			} 
			mysqli_close( $conexion );
			return "--";
		}
		function getListaCarreras () { 
			require '../conexion/conexion_mysqli.php';
			$sql = "SELECT * FROM carreras";
			$result = $conexion->query($sql);
			if ($result->num_rows > 0) {
				return $result;
			}
			mysqli_close( $conexion );
			return null;
		}
		function eliminarCarrera ( $clave ) {
			require '../conexion/conexion_mysqli.php';
			$sql = "DELETE FROM carreras WHERE clave = '$clave'";
			mysqli_query( $conexion, $sql );
			if( mysqli_affected_rows( $conexion ) > 0 ){
				echo "<script>mensajeExitoso( 'Bieen!', 'Registro eliminado.' );</script>";
				header("Refresh:1; url=../admin/inicio.php#carreras");
			}
			else{
				echo "<script>mensajeError( 'Upsss!', 'No se eliminó el registro.' );</script>";
				header("Refresh:1; url=../admin/inicio.php");
			}
			mysqli_close( $conexion );
		}
		function actualizarCarrera ( $clave, $carrera ) {
			require '../conexion/conexion_mysqli.php';
			$sql = "UPDATE carreras SET carrera = '$carrera' WHERE clave = '$clave'";
			mysqli_query( $conexion, $sql );
			if( mysqli_affected_rows( $conexion ) > 0 ){
				echo "<script>mensajeExitoso( 'Bieen!', 'Se actualizó el registro.' );</script>";
				header("Refresh:1; url=../admin/inicio.php#carreras");
			}
			else{
				echo "<script>mensajeError( 'Upsss!', 'No se actualizó el registro.' );</script>";
				header("Refresh:1; url=../admin/inicio.php");
			}
			mysqli_close( $conexion );
		}
		function agregarCarrera ( $clave, $carrera ) {
			require '../conexion/conexion_mysqli.php';
			$sql = "INSERT INTO carreras values ( '$clave', '$carrera' )";
			mysqli_query( $conexion, $sql );
			if( mysqli_affected_rows( $conexion ) > 0 ){
				echo "<script>mensajeExitoso( 'Bieen!', 'Se agregó el nuevo registro.' );</script>";
				header("Refresh:1; url=../admin/inicio.php#carreras");
			}
			else{
				echo "<script>mensajeError( 'Upsss!', 'No se agregó el registro. Verifica clave' );</script>";
				header("Refresh:1; url=../areas/agregar.php");
			}
			mysqli_close( $conexion );
		}
	} 
	// FUNCION DEL SUBMIT DE ACTUALIZAR CARRERA
	if(isset($_POST['btt_actualizar'])){
		$clave = $_POST['txt_clave'];
		$carrera = $_POST['txt_carrera'];
		$area_obj = new CarreraModel; 
		$area_obj->actualizarCarrera( $clave, $carrera );
    	} 
	// FUNCION DEL SUBMIT DE ELIMINAR CARRERA
	if(isset($_POST['btt_eliminar'])){
		$clave =  $_POST['txt_clave'];
		$area_obj = new CarreraModel; 
		$area_obj->eliminarCarrera( $clave );
	}
	// FUNCION DEL SUBMIT DE AGREGAR CARRERA
	if(isset($_POST['btt_agregar'])){
		$clave =  $_POST['txt_clave'];
		$carrera = $_POST['txt_carrera'];
		$area_obj = new CarreraModel; 
		$area_obj->agregarCarrera( $clave, $carrera );
	}
?> 
