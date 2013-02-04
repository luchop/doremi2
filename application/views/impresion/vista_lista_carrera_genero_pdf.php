<?php
// hereda la clase FPDF para crear header() y footer()
require('headerfooter.php');

$pdf = new Mypdf;

$pdf->Linea1 =  $this->modelo_valores->GetTexto('LINEA1');		 
$pdf->Linea2 =  $this->modelo_valores->GetTexto('LINEA2');
$pdf->Linea3 =  $this->modelo_valores->GetTexto('LINEA3');
$pdf->Titulo = utf8_decode("Estadística por carrera y género");
$pdf->AddPage();

$pdf->SetFont('Arial','',10);
//cabezera de columnas
//gestion
$pdf->Cell(70,5, utf8_decode('Gestión: ').$Gestion,0,1);
//fecha actual 
$pdf->Cell(70,5,'Fecha del reporte: '.date('d/M/Y'),0,1);
$pdf->Ln(2);

$pdf->SetFont('Arial','B',10);
//titulos de columnas
$pdf->Cell(8, 5, '#', 1, 0, 'C');
$pdf->Cell(80, 5, 'Nombre de la carrera', 1, 0, 'L');
$pdf->Cell(25, 5, 'Varones', 1, 0, 'R');
$pdf->Cell(25, 5, 'Mujeres', 1, 0, 'R');  
$pdf->Cell(25, 5, 'Total', 1, 1, 'R');  
//$pdf->Ln(1);
$pdf->SetFont('Arial','',10);

$newArray=array();
foreach($Tabla->result() as $row) {
	$newArray[$row->CodCarrera]['Varones']=(!isset($newArray[$row->CodCarrera]['Varones']))?0:$newArray[$row->CodCarrera]['Varones'];
	$newArray[$row->CodCarrera]['Mujeres']=(!isset($newArray[$row->CodCarrera]['Mujeres']))?0:$newArray[$row->CodCarrera]['Mujeres'];
	$newArray[$row->CodCarrera]['NombreCarrera']=$row->NombreCarrera;
	$newArray[$row->CodCarrera]['Varones']+=$row->Varones;
	$newArray[$row->CodCarrera]['Mujeres']+=$row->Mujeres;
}

$count=0;
$TotalVarones=0;
$TotalMujeres=0;
foreach($newArray as $row) {
	$count++;
	$pdf->Cell(8, 5, $count, 1, 0, 'C');
	$pdf->Cell(80, 5, utf8_decode($row["NombreCarrera"]), 1, 0, 'L');
	$pdf->Cell(25, 5, $row["Varones"], 1, 0, 'R');
	$TotalVarones+=$row["Varones"];
	$pdf->Cell(25, 5, $row["Mujeres"], 1, 0, 'R');
	$TotalMujeres+=$row["Mujeres"];
	$pdf->Cell(25, 5, ($row["Varones"]+$row["Mujeres"]), 1, 1, 'R');
}
$pdf->SetFont('Arial','B',10);
$pdf->Cell(8, 5, '', 1, 0, 'C');
$pdf->Cell(80, 5, 'Total', 1, 0, 'C');
$pdf->Cell(25, 5, $TotalVarones, 1, 0, 'R');
$pdf->Cell(25, 5, $TotalMujeres, 1, 0, 'R');
$pdf->Cell(25, 5, ($TotalVarones+$TotalMujeres), 1, 1, 'R');

$pdf->Output('EstadisticaGenero.pdf', 'D');  
?>