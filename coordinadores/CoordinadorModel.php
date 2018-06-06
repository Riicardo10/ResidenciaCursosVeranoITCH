<html>
	<head>
		<script src="../js/sweetalert.min.js"></script>
		<script src="../js/sweetAlert_functions.js"></script>
		<link rel="stylesheet" type="text/css" href="../css/sweetalert.css">
	</head>
</html>
<?php 
	class CoordinadorModel { 
		function getNombreMateria ( $clave_carrera, $clave_materia ) { 
			require '../conexion/conexion_mysqli.php';
			$sql = "SELECT clave, materia FROM materias WHERE clave = '$clave_materia' AND clave_carrera = '$clave_carrera';";
			$result = $conexion->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					return (object) array(
						'clave' => $row['clave'] ,
						'materia' => $row['materia'] 
					);
				}
			} 
			mysqli_close( $conexion );
			return "--";
		}
		
		function listaMateriasDeCarrera ( $clave_carrera ) { 
			require '../conexion/conexion_mysqli.php';
			$sql = "SELECT materias.clave, materias.materia, materias.creditos FROM materias WHERE clave_carrera = '$clave_carrera';";
			$result = $conexion->query($sql);
			if ($result->num_rows > 0) {
				return $result;
			}
			mysqli_close( $conexion );
			return null;
		}

		function getCoordinador ( $no_control ) { 
			require '../conexion/conexion_mysqli.php';
			$sql = "SELECT * FROM coordinadores WHERE no_control = '$no_control'";
			$result = $conexion->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					return (object) array(
						'no_control' => $row['no_control'] ,
						'nombre' => $row['nombre'],
						'apellido_paterno' => $row['apellido_paterno'],
						'apellido_materno' => $row['apellido_materno'],
						'email' => $row['email'],
						'telefono' => $row['telefono']
					);
				}
			} 
			mysqli_close( $conexion );
			return null;
		}
		function getListaCoordinadores () { 
			require '../conexion/conexion_mysqli.php';
			$sql = "SELECT * FROM coordinadores";
			$result = $conexion->query($sql);
			if ($result->num_rows > 0) {
				return $result;
			}
			mysqli_close( $conexion );
			return null;
		}
		function getListaMateriasPorSemestre ( $clave_carrera, $clave_semestre ) { 
			require '../conexion/conexion_mysqli.php';
			$sql = "SELECT materias.clave, materias.materia, materias.creditos FROM materias WHERE clave_carrera = '$clave_carrera' AND clave_semestre = '$clave_semestre';";
			$result = $conexion->query($sql);
			if ($result->num_rows > 0) {
				return $result;
			}
			mysqli_close( $conexion );
			return null;
		}
		function getReticula ( $clave_carrera ) { 
			require '../conexion/conexion_mysqli.php';
			$sql = "SELECT materias.clave, materias.materia, materias.creditos, materias.clave_semestre FROM materias WHERE clave_carrera = '$clave_carrera';";
			$result = $conexion->query($sql);
			if ($result->num_rows > 0) {
				return $result;
			}
			mysqli_close( $conexion );
			return null;
		}
		function getCantidadSemestresDeLaCarrera ( $clave_carrera ) { 
			require '../conexion/conexion_mysqli.php';
			$sql = "SELECT MAX(clave_semestre) AS max FROM MATERIAS WHERE clave_carrera = '$clave_carrera'";
			$result = $conexion->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					return (object) array(
						'max' => $row['max'] ,
					);
				}
			} 
			mysqli_close( $conexion );
			return "--";
		}
		function eliminarCoordinador ( $num_control ) {
			require '../conexion/conexion_mysqli.php';
			$sql_usuario = "DELETE FROM usuarios_coordinadores WHERE no_control_coordinador = '$num_control'";
			mysqli_query( $conexion, $sql_usuario );
			if( mysqli_affected_rows( $conexion ) > 0 ){
				$sql_jefe = "DELETE FROM coordinadores WHERE no_control = '$num_control'";
				mysqli_query( $conexion, $sql_jefe );
				if( mysqli_affected_rows( $conexion ) > 0 ){
					echo "<script>mensajeExitoso( 'Bieen!', 'Registro eliminado.' );</script>";
					header("Refresh:1; url=../admin/inicio.php#coordinadores");
				}
				else{
					echo "<script>mensajeError( 'Upsss!', 'El registro no se elimino.' );</script>";
					header("Refresh:1; url=../admin/inicio.php#coordinadores");
				}
			}
			else{
				echo "<script>mensajeError( 'Upsss!', 'El usuario no se elimino.' );</script>";
				header("Refresh:1; url=../admin/inicio.php#no_control");
			}
			mysqli_close( $conexion );
		}
		function actualizarCoordinador ( $no_control, $nombre, $apellido_paterno, $apellido_materno, $email, $telefono ) {
			require '../conexion/conexion_mysqli.php';
			$sql = "UPDATE coordinadores SET nombre = '$nombre', apellido_paterno = '$apellido_paterno', apellido_materno = '$apellido_materno', email = '$email', telefono = '$telefono' WHERE no_control = '$no_control'";
			mysqli_query( $conexion, $sql );
			if( mysqli_affected_rows( $conexion ) > 0 ){
				echo "<script>mensajeExitoso( 'Bieen!', 'Se actualizó el registro.' );</script>";
				header("Refresh:1; url=../admin/inicio.php#coordinadores");
			}
			else{
				echo "<script>mensajeError( 'Vaya!', 'No se realizaron cambios en el registro.' );</script>";
				header("Refresh:1; url=../admin/inicio.php");
			}
			mysqli_close( $conexion );
		}
		function agregarCoordinador (  $no_control, $nombre, $apellido_paterno, $apellido_materno, $email, $telefono ) {
			require '../conexion/conexion_mysqli.php';
			$sql = "INSERT INTO coordinadores values ( '$no_control', '$nombre', '$apellido_paterno', '$apellido_materno', '$email', '$telefono' )";
			mysqli_query( $conexion, $sql );
			if( mysqli_affected_rows( $conexion ) > 0 ){
				$sql2 = "INSERT INTO usuarios_coordinadores values ( '$no_control','$no_control' )";
				mysqli_query( $conexion, $sql2 );
				if( mysqli_affected_rows( $conexion ) > 0 ){
					echo "<script>mensajeExitoso( 'Bieen!', 'Se agregó el nuevo registro.' );</script>";
					header("Refresh:1; url=../admin/inicio.php#coordinadores");
				}
				else{
					echo "<script>mensajeError( 'Upsss!', 'No se agregó el registro usuario coordinador. Verifica clave' );</script>";
					header("Refresh:1; url=../coordinador/agregar.php");
				}	
			}
			else{
				echo "<script>mensajeError( 'Upsss!', 'No se agregó el registro coordinador. Verifica usuario / clave' );</script>";
				header("Refresh:2; url=../coordinador/agregar.php");
			}
			mysqli_close( $conexion );
		}
		function solicitarMateria ( $num_control, $clave_materia, $nombre_materia ) {
			$anio = date ("Y");
			require '../conexion/conexion_mysqli.php';
			$sql = "INSERT INTO materias_solicitadas VALUES ( NULL, '$num_control', NULL, '$clave_materia', '$nombre_materia', 0, '$anio' );";
			mysqli_query( $conexion, $sql );
			if( mysqli_affected_rows( $conexion ) > 0 ){
				/*echo "<script>mensajeExitoso( 'Bieen!', 'Se agregó el nuevo registro.' );</script>";
				header("Refresh:1; url=../admin/inicio.php#coordinadores");*/
			}
			else{
				echo "<script>mensajeError( 'Upsss!', 'No se registro.' );</script>";
				header("Refresh:1; url=../coordinadores/inicio.php");
			}
			mysqli_close( $conexion );
		}
		function getMateriasSolicitadas ( $num_control ) { 
			$anio = date ("Y");
			require '../conexion/conexion_mysqli.php';
			$sql = "SELECT * FROM materias_solicitadas WHERE no_control_coordinador = '$num_control' AND anio = '$anio'";
			$result = $conexion->query($sql);
			if ($result->num_rows > 0) {
				return $result;
			}
			mysqli_close( $conexion );
			return null;
		}
		/* SABER CUANTAS MATERIAS HA PEDIDO EL COORDINADOR */
		function getCantidadMateriasSolicitadas ( $no_control ) {
			$anio = date ("Y");
			require '../conexion/conexion_mysqli.php';
			$sql = "SELECT COUNT(no_control_coordinador) AS contador FROM materias_solicitadas WHERE no_control_coordinador = '$no_control' AND anio = '$anio';";
			//echo $sql;
			$result = $conexion->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					return (object) array(
						'contador' => $row['contador'] ,
					);
				}
			} 
			mysqli_close( $conexion );
			return "--";
		}
		/* ELIMINAR MATERIA SOLICITADA */
		function eliminarMateriaSolicitada ( $id ) {
			require '../conexion/conexion_mysqli.php';
			$sql = "DELETE FROM materias_solicitadas WHERE id = '$id'";
			mysqli_query( $conexion, $sql );
			if( mysqli_affected_rows( $conexion ) > 0 ){
					echo "<script>mensajeExitoso( 'Bieen!', 'Registro eliminado.' );</script>";
					header("Refresh:1; url=../coordinadores/materias_solicitadas.php");
			}
			else{
				echo "<script>mensajeError( 'Upsss!', 'La materia solicitada ya tiene una lista de alumnos.' );</script>";
				header("Refresh:1; url=../coordinadores/inicio.php");
			}
			mysqli_close( $conexion );
		}
		function eliminarMateriaSolicitadaConLista ( $id ) {
			require '../conexion/conexion_mysqli.php';
			$sql = "DELETE FROM lista_materia WHERE id_materia_solicitada = $id";
			mysqli_query( $conexion, $sql );
			mysqli_close( $conexion );
		}
		function agregarEstudiante( $id_materia_solicitada, $id_materia, $no_control, $nombre, $apellido_paterno, $apellido_materno, $email, $telefono ){
			$sql_estudiante = "INSERT INTO estudiantes values ( NULL, '$no_control', '$nombre', '$apellido_paterno', '$apellido_materno', '$email', '$telefono' )";
			echo "<br>";
			echo $sql_estudiante;
			$sql_lista = "INSERT INTO lista_materia values ( $id_materia_solicitada, $id_materia, '$no_control' )";
			echo "<br>";
			echo $sql_lista;
			/*require '../conexion/conexion_mysqli.php';
			$sql_estudiante = "INSERT INTO estudiantes values ( NULL, '$no_control', '$nombre', '$apellido_paterno', '$apellido_materno', '$email', '$telefono' )";
			// echo $sql_estudiante . "<br>";
			// mysqli_query( $conexion, $sql_estudiante );
			// if( mysqli_affected_rows( $conexion ) > 0 ){
				$sql_lista = "INSERT INTO lista_materia values ( $id_materia, '$no_control' )";
				echo $sql_lista;
			// }
			// else{
			// 	echo "<script>mensajeError( 'Upsss!', 'El estudiante no se inserto.' );</script>";
			// 	header("Refresh:1; url=../coordinadores/lista_materia.php");
			// }*/
		}
		function getListaDeMateria ( $id_materia_solicitada ) { 
			require '../conexion/conexion_mysqli.php';
			$sql = "SELECT lista_materia.id_materia_solicitada, lista_materia.clave_materia, materias.materia, lista_materia.no_control, estudiantes.nombre, estudiantes.apellido_paterno, estudiantes.apellido_materno FROM lista_materia JOIN estudiantes JOIN materias WHERE lista_materia.no_control = estudiantes.no_control AND lista_materia.clave_materia = materias.clave AND lista_materia.id_materia_solicitada = $id_materia_solicitada GROUP BY lista_materia.no_control";
			$result = $conexion->query($sql);
			if ($result->num_rows > 0) {
				return $result;
			}
			mysqli_close( $conexion );
			return null;
		}
		function getListaDeMateriaPDF ( $id_materia ) { 
			require '../conexion/conexion_mysqli.php';
			$sql = "SELECT lista_materia.id_materia_solicitada, lista_materia.clave_materia, materias.materia, lista_materia.no_control, estudiantes.nombre, estudiantes.apellido_paterno, estudiantes.apellido_materno FROM lista_materia JOIN estudiantes JOIN materias WHERE lista_materia.no_control = estudiantes.no_control AND lista_materia.clave_materia = materias.clave AND lista_materia.id_materia_solicitada = $id_materia GROUP BY lista_materia.no_control ORDER BY lista_materia.no_control";
			$result = $conexion->query($sql);
			if ($result->num_rows > 0) {
				return $result;
			}
			mysqli_close( $conexion );
			return null;
		}
		function getNombreMateriaPDF ( $id ) {
			require '../conexion/conexion_mysqli.php';
			$sql = "SELECT materias_solicitadas.id, materias_solicitadas.nombre_materia, materias.creditos, semestres.semestre, carreras.carrera FROM materias_solicitadas JOIN materias JOIN semestres JOIN carreras WHERE materias_solicitadas.clave_materia = materias.clave AND materias.clave_semestre = semestres.clave AND materias.clave_carrera = carreras.clave AND materias_solicitadas.id = '$id';";
			$result = $conexion->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					return (object) array(
						'id' => $row['id'] ,
						'nombre_materia' => $row['nombre_materia'] ,
						'creditos' => $row['creditos'] ,
						'semestre' => $row['semestre'] ,
						'carrera' => $row['carrera'] ,
					);
				}
			} 
			mysqli_close( $conexion );
			return "--";
		}
	}
	// FUERA DE CLASE
	function getListaAlumnosMateria ( $clave_carrera ) { 
			require '../conexion/conexion_mysqli.php';
			$sql = "SELECT MAX(clave_semestre) AS max FROM MATERIAS WHERE clave_carrera = '$clave_carrera'";
			$result = $conexion->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					return (object) array(
						'max' => $row['max'] ,
					);
				}
			} 
			mysqli_close( $conexion );
			return "--";
		}

	// FUNCION DEL SUBMIT PARA ACTUALIZAR AL PROFESOR
	if(isset($_POST['btt_actualizar'])){
		$no_control =  $_POST['txt_numero_control'];		
		$nombre =  $_POST['txt_nombre'];
		$apellido_paterno =  $_POST['txt_apellido_paterno'];
		$apellido_materno =  $_POST['txt_apellido_materno'];
		$email =  $_POST['txt_email'];
		$telefono =  $_POST['txt_telefono'];
		$coordinador_obj = new CoordinadorModel; 
		$coordinador_obj->actualizarCoordinador( $no_control, $nombre, $apellido_paterno, $apellido_materno, $email, $telefono );
    	} 
	// FUNCION DEL SUBMIT DE ELIMINAR AL COORDINADOR
	if(isset($_POST['btt_eliminar'])){
		$no_control =  $_POST['txt_numero_control'];
		$coordinador_obj = new CoordinadorModel; 
		$coordinador_obj->eliminarCoordinador( $no_control );
	}
	// FUNCION DEL SUBMIT DE AGREGAR COORDINADOR
	if(isset($_POST['btt_agregar'])){
		$no_control =  $_POST['txt_numero_control'];		
		$nombre =  $_POST['txt_nombre'];
		$apellido_paterno =  $_POST['txt_apellido_paterno'];
		$apellido_materno =  $_POST['txt_apellido_materno'];
		$email =  $_POST['txt_email'];
		$telefono =  $_POST['txt_telefono'];
		$coordinador_obj = new CoordinadorModel; 
		$coordinador_obj->agregarCoordinador( $no_control, $nombre, $apellido_paterno, $apellido_materno, $email, $telefono);
	}
	if(isset($_POST['btt_lista_materia_solicitada'])){
		//echo "lista";
	}
	if(isset($_POST['btt_guardar_materia_solicitada'])){
		echo "materia solicitada";
	}
	if(isset($_POST['btt_eliminar_materia_solicitada'])){
		$id_eliminar =  $_POST['txt_id_materia_solicitada'];
		$coordinador_obj = new CoordinadorModel; 
		$coordinador_obj->eliminarMateriaSolicitada( $id_eliminar );
	}
	if(isset($_POST['btt_agregar_alumno_lista'])){
		/*$id_materia = $_POST['txt_id_materia'];
		$nombre_materia = $_POST['txt_nombre_materia'];
		$no_control =  $_POST['txt_num_control'];
		$nombre =  $_POST['txt_nombre'];
		$apellido_paterno =  $_POST['txt_apellido_paterno'];
		$apellido_materno =  $_POST['txt_apellido_materno'];
		$telefono =  $_POST['txt_telefono'];
		$email =  $_POST['txt_email'];
		$id_materia_solicitada = $_POST[ 'txt_id_materia_solicitada' ];
		echo "Alumno: $no_control $nombre $apellido_paterno $apellido_materno $telefono $email <br>";
		echo "$id_materia_solicitada Materia: $id_materia $nombre_materia <br>";
		$coordinador_obj = new CoordinadorModel; 
		$coordinador_obj->agregarEstudiante( $no_control, $nombre, $apellido_paterno, $apellido_materno, $email, $telefono, $id_materia_solicitada, $id_materia );		*/
	}
?> 









