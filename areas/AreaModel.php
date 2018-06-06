<html>
	<head>
		<script src="../js/sweetalert.min.js"></script>
		<script src="../js/sweetAlert_functions.js"></script>
		<link rel="stylesheet" type="text/css" href="../css/sweetalert.css">
	</head>
</html>
<?php 
	class AreaModel { 
		function getArea ( $clave ) { 
			require '../conexion/conexion_mysqli.php';
			$sql = "SELECT * FROM areas WHERE clave = '$clave'";
			$result = $conexion->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					return $row['area'] ;
				}
			} 
			mysqli_close( $conexion );
			return "--";
		}
		function getListaAreas () { 
			require '../conexion/conexion_mysqli.php';
			$sql = "SELECT * FROM areas";
			$result = $conexion->query($sql);
			if ($result->num_rows > 0) {
				return $result;
			}
			mysqli_close( $conexion );
			return null;
		}
		function eliminarArea ( $clave ) {
			require '../conexion/conexion_mysqli.php';
			$sql = "DELETE FROM areas WHERE clave = '$clave'";
			mysqli_query( $conexion, $sql );
			if( mysqli_affected_rows( $conexion ) > 0 ){
				echo "<script>mensajeExitoso( 'Bieen!', 'Registro eliminado.' );</script>";
				header("Refresh:1; url=../admin/inicio.php#areas");
			}
			else{
				echo "<script>mensajeError( 'Upsss!', 'No se eliminó el registro.' );</script>";
				header("Refresh:1; url=../admin/inicio.php");
			}
			mysqli_close( $conexion );
		}
		function actualizarArea ( $clave, $area ) {
			require '../conexion/conexion_mysqli.php';
			$sql = "UPDATE areas SET area = '$area' WHERE clave = '$clave'";
			mysqli_query( $conexion, $sql );
			if( mysqli_affected_rows( $conexion ) > 0 ){
				echo "<script>mensajeExitoso( 'Bieen!', 'Se actualizó el registro.' );</script>";
				header("Refresh:1; url=../admin/inicio.php#areas");
			}
			else{
				echo "<script>mensajeError( 'Upsss!', 'No se actualizó el registro.' );</script>";
				header("Refresh:1; url=../admin/inicio.php");
			}
			mysqli_close( $conexion );
		}
		function agregarArea ( $clave, $area ) {
			require '../conexion/conexion_mysqli.php';
			$sql = "INSERT INTO areas values ( '$clave', '$area' )";
			mysqli_query( $conexion, $sql );
			if( mysqli_affected_rows( $conexion ) > 0 ){
				echo "<script>mensajeExitoso( 'Bieen!', 'Se agregó el nuevo registro.' );</script>";
				header("Refresh:1; url=../admin/inicio.php#areas");
			}
			else{
				echo "<script>mensajeError( 'Upsss!', 'No se agregó el registro. Verifica clave' );</script>";
				header("Refresh:1; url=../areas/agregar.php");
			}
			mysqli_close( $conexion );
		}
	} 
	// FUNCION DEL SUBMIT DE ACTUALIZAR AREA
	if(isset($_POST['btt_actualizar'])){
		$clave = $_POST['txt_clave'];
		$area = $_POST['txt_area'];
		$area_obj = new AreaModel; 
		$area_obj->actualizarArea( $clave, $area );
    	} 
	// FUNCION DEL SUBMIT DE ELIMINAR AREA
	if(isset($_POST['btt_eliminar'])){
		$clave =  $_POST['txt_clave'];
		$area_obj = new AreaModel; 
		$area_obj->eliminarArea( $clave );
	}
	// FUNCION DEL SUBMIT DE AGREGAR AREA
	if(isset($_POST['btt_agregar'])){
		$clave =  $_POST['txt_clave'];
		$area = $_POST['txt_area'];
		$area_obj = new AreaModel; 
		$area_obj->agregarArea( $clave, $area );
	}
?> 
