<?php
	session_start();
	if(!isset($_SESSION['sesion']))
			header("location: ../");
?>

<?php
	$arreglo = array();
    if( isset( $_POST['btt_registrar_materias'] ) ) {
    	require 'CoordinadorModel.php';
		$reticula = new CoordinadorModel; 
		$cantidad = $reticula->getCantidadMateriasSolicitadas( $_SESSION['sesion'] )->contador;
		//echo '-> ' . $cantidad;
		if( $cantidad < 2 ) {
			$arreglo_id = array();
			$carrera_id = $_POST['txt_carrera_id'];
			$lista = $reticula->getReticula( $carrera_id );
			if ( $lista ){
				while($row = $lista->fetch_assoc()) {
					$id = $row['clave'];
					if (isset( $_POST['txt_materia_' . $id] ) ) {
						$arreglo_id[] = $id;
					}
				}
			}
			if( count($arreglo_id) == 0 ){
				echo "<script>mensajeError( 'Ups!', 'Debes seleccionar por lo menos una materia para solicitarla.' );</script>";
				header("Refresh:2; url=../coordinadores/inicio.php");
			}
			else if( count($arreglo_id) > 2 ) {
				echo "<script>mensajeError( 'Ups!', 'Puedes solicitar máximo dos materias.' );</script>";
				header("Refresh:2; url=../coordinadores/inicio.php");
			}
			else{
				for( $i=0; $i<count($arreglo_id); $i++ ) {
					$materia = $reticula->getNombreMateria( $carrera_id, $arreglo_id[$i] );
					$objeto = (object) array('id'=>$materia->clave, 'nombre'=>$materia->materia);
					$arreglo[] = $objeto;
				}
				// INSERTAR EN MATERIA SOLICITADA
				for( $i=0; $i<count($arreglo); $i++ ) {
					$objeto = $reticula->solicitarMateria( $_SESSION['sesion'], $arreglo[$i]->id, $arreglo[$i]->nombre );
				}
			}



			header("Refresh:0; url=../coordinadores/materias_solicitadas.php");
			/**/
			//OBTENER MATERIAS SOLICITADAS
			//$lista_materias_solicitadas = $reticula->getMateriasSolicitadas( '1111' );
			/*while($row = $lista_materias_solicitadas->fetch_assoc()) {
				echo $row['id'];
			}*/
		}
		else{
			echo "<script>mensajeError( 'Ups!', 'Puedes solicitar máximo dos materias.' );</script>";
			header("Refresh:2; url=../coordinadores/inicio.php");
		}
	}
?>