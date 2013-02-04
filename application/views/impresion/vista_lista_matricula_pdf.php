<?php
// hereda la clase FPDF para crear header() y footer()
require('headerfooter.php');

$pdf = new Mypdf;

$pdf->Linea1 =  $this->modelo_valores->GetTexto('LINEA1');		 
$pdf->Linea2 =  $this->modelo_valores->GetTexto('LINEA2');
$pdf->Linea3 =  $this->modelo_valores->GetTexto('LINEA3');
$pdf->Titulo = utf8_decode("Matrículas expedidas");
$pdf->AddPage();

$pdf->SetFont('Arial','',10);
//cabezera de columnas
//carrera
//$pdf->Cell(90,5,'Carrera: '.utf8_decode($Carrera->Nombre),0,1);
//gestion
$pdf->Cell(70,5, utf8_decode('Gestión: ').$Gestion,0,1);
//fecha actual 
$pdf->Cell(70,5,'Fecha actual: '.date('d/M/Y'),0,1);
$pdf->Ln(2);

$pdf->SetFont('Arial','B',9);
//titulos de columnas
$pdf->Cell(15, 5, utf8_decode('Matrícula'), 1, 0, 'C');
$pdf->Cell(17, 5, 'Fecha', 1, 0, 'C');
$pdf->Cell(18, 5, 'Reg.Univ.', 1, 0, 'C');  
$pdf->Cell(20, 5, 'CI', 1, 0, 'C');  
$pdf->Cell(50, 5, 'Nombre', 1, 0, 'C');  
$pdf->Cell(50, 5, 'Carrera', 1, 1, 'C');  
//$pdf->Ln(1);
$pdf->SetFont('Arial','',8);
foreach($Tabla->result() as $row) {
	$pdf->Cell(15, 5, $row->Matricula, 1, 0, 'L');  
	//$pdf->Cell(17, 5, date('d/M/Y',strtotime($row->Fecha)), 1, 0, 'L');  
    $pdf->Cell(17, 5, FechaLiteral($row->Fecha), 1, 0, 'L');  
	$pdf->Cell(18, 5, $row->RegUniversitario, 1, 0, 'L');
	$pdf->Cell(20, 5, $row->CI, 1, 0, 'L');
	$pdf->ClippedCell(50, 5, utf8_decode($row->NombreCompleto), 1, 0, 'L');
	$pdf->ClippedCell(50, 5, utf8_decode($row->NombreCarrera), 1, 1, 'L');
}

$pdf->Output('ListaMatriculados.pdf', 'D');  
?>