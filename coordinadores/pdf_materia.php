<?php
	session_start();
	if(!isset($_SESSION['sesion']))
			header("location: ../");
?>
<?php
	require 'CoordinadorModel.php';
	$id_materia = $_GET['materia'];

	$objeto = new CoordinadorModel; 
	$lista = $objeto->getListaDeMateriaPDF( $id_materia );
	$objeto_materia = $objeto->getNombreMateriaPDF( $id_materia );
	
	$nombre_materia = utf8_decode( $objeto_materia->nombre_materia );
	$creditos = utf8_decode( $objeto_materia->creditos );
	$carrera = utf8_decode( $objeto_materia->carrera );
	$semestre = utf8_decode( $objeto_materia->semestre );

	if( $lista ){
		require '../fpdf/fpdf.php';
		ob_start();
		$pdf = new FPDF();
		$pdf->AddPage();
		$pdf->Image('../img/logo-tec.jpg', 5, 10, 190);
		$pdf->SetFont('Arial','B',14);
		$pdf->SetY(35);

		//$pdf->Cell(0,10,'INSTITUTO TECNOLOGICO DE CHILPANCINGO', 0,0,'C');
		$pdf->Ln();
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(0, 7, "Lista de la materia: $nombre_materia ", 0, 0, 'C');
		$pdf->Ln();
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(0, 10, "Semestre: $semestre            Carrera: $carrera", 0, 0, 'C');
		$pdf->Ln();
		$pdf->SetX(20);
		$pdf->SetFillColor(232,232,232);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(25, 10, "No. control", 1, 0, 'L');
		$pdf->Cell(45, 10, "Nombre", 1, 0, 'L');
		$pdf->Cell(45, 10, "Apellido paterno", 1, 0, 'L');
		$pdf->Cell(45, 10, "Apellido materno", 1, 1, 'L');
		$pdf->SetFont('Arial','B',10);
		while($row = $lista->fetch_assoc()) {
			//$registro =   . "\t\t\t\t\t" . $row['nombre'] . "\t\t\t\t\t" . $row['apellido_paterno'] .  "\t\t\t\t\t" . $row['apellido_materno'];
			$pdf->SetX(20);
			$pdf->Cell(25, 10, utf8_decode( $row['no_control'] ), 1, 0, 'L');
			$pdf->Cell(45, 10, utf8_decode( $row['nombre'] ), 1, 0, 'L');
			$pdf->Cell(45, 10, utf8_decode( $row['apellido_paterno'] ), 1, 0, 'L');
			$pdf->Cell(45, 10, utf8_decode( $row['apellido_materno'] ), 1, 0, 'L');
			$pdf->Ln();
		}

		// PIE
		$pdf->SetY(-40);
		$pdf->SetFont('Arial','I',8);
		$pdf->Cell(0, 10, "Tecnologico de CHikpo", 0, 0, 'C');

		$pdf->Output("lista_materia.pdf", "D");
		ob_end_flush();
	}
	else{
		echo "La materia no tiene lista de alumnos.";
	}

?>



  <?php  
    /*
        # PDF
        require 'fpdf/fpdf.php';
        ob_start();
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',14);
        $pdf->Cell(0,10,'INSTITUTO TECNOLOGICO DE CHILPANCINGO', 0,0,'C');
        $pdf->Ln();
        $pdf->Cell(0, 7, "Alumno:", 0, 0, 'L');
        $pdf->Ln();
        $pdf->Cell(0, 7, "      " . $nombre . " " . $apellido_paterno . " " . $apellido_materno, 0, 0, 'L');
        $pdf->Ln();
        $pdf->Cell(0, 7, "Semestre: " . $semestre . "   Sexo: " . $sexo, 0, 0, 'L');
        $pdf->Ln();
        $pdf->Cell(0, 7, "Telefono: " . $telefono, 0, 0, 'L');
        $pdf->Ln();
        if($imagen == ""){
          $pdf->Cell(0, 8, "Sin imagen.", 0, 0, 'L');
        }
        else{
          $pdf->Image("img/" . $imagen, $pdf->GetX(), $pdf->GetY(), 25, 28, '', '');
        }
        #$pdf->Output("pdf/credencial.pdf", "F");
        #$pdf->Output("pdf/credencial.pdf", "D");
        $pdf->Output("credencial.pdf", "D");
        ob_end_flush();
      }
      else{
        echo "<script>swMensajeError('Error', 'Verifica matricula del alumno.')</script>";
        header("refresh:1; credencial_alumno.php");
      }
      
    }*/
  ?>




  <!-- 
  FM05161730
  fsmc_jazmin30@hotmail.com
   -->