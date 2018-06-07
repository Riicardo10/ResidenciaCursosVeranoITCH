<html>
	<head>
		<script src="../js/sweetalert.min.js"></script>
		<script src="../js/sweetAlert_functions.js"></script>
		<link rel="stylesheet" type="text/css" href="../css/sweetalert.css">
	</head>
</html>
<?php 
	class JefeModel { 
		function getProfesor ( $clave ) { 
			require '../conexion/conexion_mysqli.php';
			$sql = "SELECT nombre, apellido_paterno, apellido_materno FROM profesores WHERE clave = '$clave'";
			$result = $conexion->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					return (object) array(
						'nombre' => $row['nombre'], 'apellido_paterno' => $row['apellido_paterno'], 'apellido_materno' => $row['apellido_materno'],
					);
				}
			} 
			mysqli_close( $conexion );
			return null;
		}
		function getJefe ( $usuario ) { 
			require '../conexion/conexion_mysqli.php';
			$sql = "SELECT * FROM jefes_departamento JOIN usuarios_jefes_departamento WHERE usuario = '$usuario' AND clave = clave_profesor";
			$result = $conexion->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					return (object) array(
						'clave' => $row['clave'] ,
						'nombre' => $row['nombre'],
						'apellido_paterno' => $row['apellido_paterno'],
						'apellido_materno' => $row['apellido_materno'],
						'email' => $row['email'],
						'telefono' => $row['telefono'],
						'status' => $row['status'],
						'clave_area' => $row['clave_area'],
						'usuario' => $row['usuario'],
						'contrasenia' => $row['contrasenia'],
					);
				}
			} 
			mysqli_close( $conexion );
			return null;
		}
		function getListaJefes () { 
			require '../conexion/conexion_mysqli.php';
			$sql = "SELECT * FROM jefes_departamento";
			$result = $conexion->query($sql);
			if ($result->num_rows > 0) {
				return $result;
			}
			mysqli_close( $conexion );
			return null;
		}
		function darAltaJefe ( $clave ) {
			require '../conexion/conexion_mysqli.php';
			$sql = "UPDATE jefes_departamento SET status = 1 WHERE clave = '$clave'";
			mysqli_query( $conexion, $sql );
			if( mysqli_affected_rows( $conexion ) > 0 ){
				echo "<script>mensajeExitoso( 'Bieen!', 'Registro dado de alta.' );</script>";
				header("Refresh:1; url=../admin/inicio.php#jefes-depto");
			}
			else{
				echo "<script>mensajeError( 'Upsss!', 'No se dió de alta el registro.' );</script>";
				header("Refresh:1; url=../admin/inicio.php");
			}
			mysqli_close( $conexion );
		}
		function asignarProfesorAMateria ( $id_materia_solicitada, $id_profesor, $id_carrera, $nombre_carrera ) {
			require '../conexion/conexion_mysqli.php';
			$sql = "UPDATE materias_solicitadas SET clave_profesor = $id_profesor  WHERE id = '$id_materia_solicitada'";
			mysqli_query( $conexion, $sql );
			if( mysqli_affected_rows( $conexion ) > 0 ){
				echo "<script>mensajeExitoso( 'Bieen!', 'Registro modificado.' );</script>";
				header("Refresh:1; url=../jefes/lista_materias.php?id=$id_carrera&nombre=$nombre_carrera");
			}
			else{
				echo "<script>mensajeError( 'Upsss!', 'No se modifico el registro.' );</script>";
				header("Refresh:1; url=../jefes/inicio.php");
			}
			mysqli_close( $conexion );
		}
		function eliminarJefe ( $clave ) {
			require '../conexion/conexion_mysqli.php';
			$sql_usuario = "DELETE FROM usuarios_jefes_departamento WHERE clave_profesor = '$clave'";
			mysqli_query( $conexion, $sql_usuario );
			if( mysqli_affected_rows( $conexion ) > 0 ){
				$sql_jefe = "DELETE FROM jefes_departamento WHERE clave = '$clave'";
				mysqli_query( $conexion, $sql_jefe );
				if( mysqli_affected_rows( $conexion ) > 0 ){
					echo "<script>mensajeExitoso( 'Bieen!', 'Registro eliminado.' );</script>";
					header("Refresh:1; url=../admin/inicio.php#jefes-depto");
				}
				else{
					echo "<script>mensajeError( 'Upsss!', 'El registro no se elimino.' );</script>";
					header("Refresh:1; url=../admin/inicio.php#jefes-depto");
				}
			}
			else{
				echo "<script>mensajeError( 'Upsss!', 'El usuario no se elimino.' );</script>";
				header("Refresh:1; url=../admin/inicio.php#jefes-depto");
			}
			mysqli_close( $conexion );
		}
		function actualizarJefe ( $clave, $nombre, $apellido_paterno, $apellido_materno, $email, $telefono, $status, $area ) {
			require '../conexion/conexion_mysqli.php';
			$sql = "UPDATE jefes_departamento SET nombre = '$nombre', apellido_paterno = '$apellido_paterno', apellido_materno = '$apellido_materno', email = '$email', telefono = '$telefono', status = $status, clave_area = '$area' WHERE clave = '$clave'";
			mysqli_query( $conexion, $sql );
			if( mysqli_affected_rows( $conexion ) > 0 ){
				echo "<script>mensajeExitoso( 'Bieen!', 'Se actualizó el registro.' );</script>";
				header("Refresh:1; url=../admin/inicio.php#jefes-depto");
			}
			else{
				echo "<script>mensajeError( 'Vaya!', 'No se realizaron cambios en el registro.' );</script>";
				header("Refresh:1; url=../admin/inicio.php");
			}
			mysqli_close( $conexion );
		}
		function getListaMateriasPorCarrera ( $id_carrera ) {
			require '../conexion/conexion_mysqli.php';
			$anio = date ("Y");
			$sql = "SELECT 
				  MATERIAS_SOLICITADAS.id, 
				  MATERIAS_SOLICITADAS.clave_materia, 
				  MATERIAS_SOLICITADAS.nombre_materia, 
				  MATERIAS_SOLICITADAS.aprobada, 
				  MATERIAS_SOLICITADAS.anio, 
				  MATERIAS.clave_carrera,  
				  COORDINADORES.no_control,  
				  COORDINADORES.nombre, 
				  COORDINADORES.apellido_paterno, 
				  COORDINADORES.apellido_materno, 
				  MATERIAS_SOLICITADAS.clave_profesor 
				  FROM MATERIAS_SOLICITADAS 
				  JOIN MATERIAS 
				  JOIN COORDINADORES 
				  WHERE MATERIAS_SOLICITADAS.clave_materia = MATERIAS.clave 
				  AND MATERIAS_SOLICITADAS.no_control_coordinador = COORDINADORES.no_control  
				  AND clave_carrera = '$id_carrera' 
				  AND anio = '$anio';";
			$result = $conexion->query($sql);
			if ($result->num_rows > 0) {
				return $result;
			}
			mysqli_close( $conexion );
			return null;
		}
		function agregarJefe (  $clave, $nombre, $apellido_paterno, $apellido_materno, $email, $telefono, $status, $area, $usuario, $contrasenia ) {
			require '../conexion/conexion_mysqli.php';
			$sql = "INSERT INTO jefes_departamento values ( '$clave', '$nombre', '$apellido_paterno', '$apellido_materno', '$email', '$telefono', $status, '$area' )";
			mysqli_query( $conexion, $sql );
			if( mysqli_affected_rows( $conexion ) > 0 ){
				$sql2 = "INSERT INTO usuarios_jefes_departamento values ( '$clave','$usuario','$contrasenia' )";
				mysqli_query( $conexion, $sql2 );
				if( mysqli_affected_rows( $conexion ) > 0 ){
					echo "<script>mensajeExitoso( 'Bieen!', 'Se agregó el nuevo registro.' );</script>";
					header("Refresh:1; url=../admin/inicio.php#jefes-depto");
				}
				else{
					echo "<script>mensajeError( 'Upsss!', 'No se agregó el registro usuario jefe depto. Verifica clave' );</script>";
					header("Refresh:1; url=../jefes/agregar.php");
				}	
			}
			else{
				echo "<script>mensajeError( 'Upsss!', 'No se agregó el registro jefe depto. Verifica usuario / clave' );</script>";
				header("Refresh:2; url=../jefes/agregar.php");
			}
			mysqli_close( $conexion );
		}
		function actualizarContraseniaJefe ( $usuario, $contrasenia, $contrasenia_2 ) {
			if( $contrasenia == $contrasenia_2 ){
				require '../conexion/conexion_mysqli.php';
				$sql = "UPDATE usuarios_jefes_departamento SET contrasenia = '$contrasenia' WHERE clave_profesor = '$usuario'";
				mysqli_query( $conexion, $sql );
				if( mysqli_affected_rows( $conexion ) > 0 ){
					echo "<script>mensajeExitoso( 'Bieen!', 'Se actualizó la cuenta del jefe de depatamento. Inicia sesión de nuevo por favor' );</script>";
					header("Refresh:1; url=../admin/cerrar_sesion.php");
				}
				else{
					echo "<script>mensajeError( 'Vaya!', 'No se realizaron cambios en la cuenta del jefe de depatamento.' );</script>";
					header("Refresh:1; url=./inicio.php");
				}
				mysqli_close( $conexion );
			}
			else{
				echo "<script>mensajeError( 'Upsss!', 'Verifica contraseñas ingresadas.' );</script>";
				header("Refresh:1; url=./inicio.php");
			}
		}
	} 
	// FUNCION DEL SUBMIT PARA ACTUALIZAR AL PROFESOR
	if(isset($_POST['btt_actualizar'])){
		$clave =  $_POST['txt_clave'];
		$nombre =  $_POST['txt_nombre'];
		$apellido_paterno =  $_POST['txt_apellido_paterno'];
		$apellido_materno =  $_POST['txt_apellido_materno'];
		$email =  $_POST['txt_email'];
		$telefono =  $_POST['txt_telefono'];
		$area =  $_POST['txt_area'];
		$status = -1;
		if( isset($_POST['txt_status']) && $_POST['txt_status'] == '1' )
			$status = 1;
		else
			$status = 0;
		$jefe_obj = new JefeModel; 
		$jefe_obj->actualizarJefe( $clave, $nombre, $apellido_paterno, $apellido_materno, $email, $telefono, $status, $area );
    	} 
	// FUNCION DEL SUBMIT DE DAR DE BAJA AL PROFESOR
	if(isset($_POST['btt_eliminar'])){
		$clave =  $_POST['txt_clave'];
		$jefe_obj = new JefeModel; 
		$jefe_obj->eliminarJefe( $clave );
	}
	// FUNCION DEL SUBMIT DE AGREGAR PROFESOR
	if(isset($_POST['btt_agregar'])){
		$contrasenia =  $_POST['txt_contrasenia'];
		$contrasenia2 =  $_POST['txt_contrasenia_2'];
		if($contrasenia == $contrasenia2){
			$clave =  $_POST['txt_clave'];
			$usuario =  $_POST['txt_usuario'];
			$nombre =  $_POST['txt_nombre'];
			$apellido_paterno =  $_POST['txt_apellido_paterno'];
			$apellido_materno =  $_POST['txt_apellido_materno'];
			$email =  $_POST['txt_email'];
			$telefono =  $_POST['txt_telefono'];
			$area =  $_POST['txt_area'];
			$status = -1;
			if( isset($_POST['txt_status']) && $_POST['txt_status'] == '1' )
				$status = 1;
			else
				$status = 0;
			$jefe_obj = new JefeModel; 
			$jefe_obj->agregarJefe( $clave, $nombre, $apellido_paterno, $apellido_materno, $email, $telefono, $status, $area, $usuario, $contrasenia );
		}
		else{
			echo "<script>mensajeError( 'Upsss!', 'No se agregó el registro. Verifica contraseñas.' );</script>";
			header("Refresh:1; url=../jefes/agregar.php");			
		}
	}
	if(isset($_POST['btt_guardar_detalle_materia'])){
		$id_materia_solicitada = $_POST['txt_clave'];
		$id_profesor = $_POST['txt_carrera'];
		$id_carrera = $_POST['txt_id_carrera'];
		$nombre_carrera = $_POST['txt_nombre_carrera'];
		$jefe_obj = new JefeModel; 
		$jefe_obj->asignarProfesorAMateria($id_materia_solicitada, $id_profesor, $id_carrera, $nombre_carrera);
	}
	/*$obj_semestre = new SemestreModel; 
	$nombre_semestre = $obj_semestre->getSemestre( '1' );
	echo $nombre_semestre;*/






	if(isset($_POST['btt_configurar_contrasenia_jefe'])){
		$user = $_POST['txt_clave'];
		$contrasenia_1 = $_POST['txt_contrasenia'];
		$contrasenia_2 = $_POST['txt_contrasenia_2'];
		$jefe_obj = new JefeModel; 
		$jefe_obj->actualizarContraseniaJefe($user, $contrasenia_1, $contrasenia_2);
	}

?> 
