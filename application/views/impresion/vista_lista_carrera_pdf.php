<?php
// hereda la clase FPDF para crear header() y footer()
require('headerfooter.php');

$pdf = new Mypdf;

$pdf->Linea1 =  $this->modelo_valores->GetTexto('LINEA1');		 
$pdf->Linea2 =  $this->modelo_valores->GetTexto('LINEA2');
$pdf->Linea3 =  $this->modelo_valores->GetTexto('LINEA3');
$pdf->Titulo = "Lista de matriculados por carrera";
$pdf->AddPage();

$pdf->SetFont('Arial','',10);
//cabezera de columnas
//carrera
$NombreCarrera = utf8_decode($Carrera->Nombre);
$pdf->Cell(90,5,'Carrera: '.$NombreCarrera, 0, 1);
//gestion
$pdf->Cell(70,5, utf8_decode('Gestión: ').$Gestion,0,1);
//fecha actual 
$pdf->Cell(70,5,'Fecha actual: '.date('d/M/Y'),0,1);
$pdf->Ln(2);

$pdf->SetFont('Arial','B',10);

//titulos de columnas
if( $CI && $RegUniversitario) {
    $pdf->Cell(100, 5, 'Nombre del universitario', 1, 0, 'C' );  
    $pdf->Cell(35, 5, 'C.I.', 1, 0, 'C');  
    $pdf->Cell(35, 5, 'Reg. Univ.', 1, 1, 'C');  
}
else if( $CI ) {
    $pdf->Cell(120, 5, 'Nombre del universitario', 1, 0, 'C' );  
    $pdf->Cell(50, 5, 'C.I.', 1, 1, 'C');  
}
else if( $RegUniversitario ) {
    $pdf->Cell(120, 5, 'Nombre del universitario', 1, 0, 'C' );  
    $pdf->Cell(50, 5, 'Reg.Univ.', 1, 1, 'C');  
}
else 
    $pdf->Cell(170, 5, 'Nombre del universitario', 1, 1, 'C'); 

//$pdf->Ln(1);
$pdf->SetFont('Arial','',10);
foreach($Tabla->result() as $row) {
    if( $CI && $RegUniversitario) {
        $pdf->Cell(100, 5, $row->NombreCompleto, 1, 0, 'L' );  
        $pdf->Cell(35, 5, $row->CI, 1, 0, 'L');  
        $pdf->Cell(35, 5, $row->RegUniversitario, 1, 1, 'L');  
    }
    else if( $CI ) {
        $pdf->Cell(120, 5, $row->NombreCompleto, 1, 0, 'L' );  
        $pdf->Cell(50, 5, $row->CI, 1, 1, 'L');  
    }
    else if( $RegUniversitario ) {
        $pdf->Cell(120, 5, $row->NombreCompleto, 1, 0, 'L' );  
        $pdf->Cell(50, 5, $row->RegUniversitario, 1, 1, 'L');  
    }
    else 
        $pdf->Cell(170, 5, $row->NombreCompleto, 1, 1, 'L');         
}

$pdf->Output("$NombreCarrera.pdf", 'D');  
?>