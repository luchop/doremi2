<?php
// hereda la clase FPDF para crear header() y footer()
require('headerfooter.php');

$pdf = new Mypdf;

$pdf->Linea1 =  $this->modelo_valores->GetTexto('LINEA1');		 
$pdf->Linea2 =  $this->modelo_valores->GetTexto('LINEA2');
$pdf->Linea3 =  $this->modelo_valores->GetTexto('LINEA3');
$pdf->Titulo = utf8_decode("Estadística por estado civil");
$pdf->AddPage();

$pdf->SetFont('Arial','',10);
//cabezera de columnas
//carrera
$pdf->Cell(90,5,'Reporte: '.$Reporte,0,1);
//gestion
$pdf->Cell(70,5, utf8_decode('Gestión: ').$Gestion,0,1);
//fecha actual 
$pdf->Cell(70,5,'Fecha actual: '.date('d/M/Y'),0,1);
$pdf->Ln(2);

$pdf->SetFont('Arial','B',8);
//titulos de columnas
$pdf->Cell(8, 5, '#', 1, 0, 'C');
$pdf->Cell(55, 5, 'Carrera', 1, 0, 'L');  
$pdf->Cell(15, 5, 'Solteros', 1, 0, 'C');
$pdf->Cell(15, 5, 'Casados', 1, 0, 'C');
$pdf->Cell(20, 5, 'Convivientes', 1, 0, 'C');
$pdf->Cell(20, 5, 'Divorciados', 1, 0, 'C');
$pdf->Cell(15, 5, 'Viudos', 1, 0, 'C');
$pdf->Cell(15, 5, 'Total', 1, 1, 'C');
//$pdf->Ln(1);
$pdf->SetFont('Arial','',8);
$newArray=array();
foreach($Tabla->result() as $row) {
	$newArray[$row->CodCarrera]['Solteros']=(!isset($newArray[$row->CodCarrera]['Solteros']))?0:$newArray[$row->CodCarrera]['Solteros'];
	$newArray[$row->CodCarrera]['Casados']=(!isset($newArray[$row->CodCarrera]['Casados']))?0:$newArray[$row->CodCarrera]['Casados'];
	$newArray[$row->CodCarrera]['Convivientes']=(!isset($newArray[$row->CodCarrera]['Convivientes']))?0:$newArray[$row->CodCarrera]['Convivientes'];
	$newArray[$row->CodCarrera]['Divorciados']=(!isset($newArray[$row->CodCarrera]['Divorciados']))?0:$newArray[$row->CodCarrera]['Divorciados'];
	$newArray[$row->CodCarrera]['Viudos']=(!isset($newArray[$row->CodCarrera]['Viudos']))?0:$newArray[$row->CodCarrera]['Viudos'];
	
	$newArray[$row->CodCarrera]['NombreCarrera']=$row->NombreCarrera;
	$newArray[$row->CodCarrera]['Solteros']+=$row->Solteros;
	$newArray[$row->CodCarrera]['Casados']+=$row->Casados;
	$newArray[$row->CodCarrera]['Convivientes']+=$row->Convivientes;
	$newArray[$row->CodCarrera]['Divorciados']+=$row->Divorciados;
	$newArray[$row->CodCarrera]['Viudos']+=$row->Viudos;
}

$count=0;
$TotalSolteros=0;
$TotalCasados=0;
$TotalConvivientes=0;
$TotalDivorciados=0;
$TotalViudos=0;
foreach($newArray as $row) {
	$count++;
	$pdf->Cell(8, 5, $count, 1, 0, 'C');
	$pdf->Cell(55, 5, utf8_decode($row["NombreCarrera"]), 1, 0, 'L');  
	$TotalSolteros+=$row["Solteros"];
	$pdf->Cell(15, 5, $row["Solteros"], 1, 0, 'C');
	$TotalCasados+=$row["Casados"];
	$pdf->Cell(15, 5, $row["Casados"], 1, 0, 'C');
	$TotalConvivientes+=$row["Convivientes"];
	$pdf->Cell(20, 5, $row["Convivientes"], 1, 0, 'C');
	$TotalDivorciados+=$row["Divorciados"];
	$pdf->Cell(20, 5, $row["Divorciados"], 1, 0, 'C');
	$TotalViudos+=$row["Viudos"];
	$pdf->Cell(15, 5, $row["Viudos"], 1, 0, 'C');
	$pdf->Cell(15, 5, ($row["Solteros"]+$row["Casados"]+$row["Convivientes"]+$row["Divorciados"]+$row["Viudos"]), 1, 1, 'C');
}
$pdf->SetFont('Arial','B',8);
$pdf->Cell(8, 5, '', 1, 0, 'C');
$pdf->Cell(55, 5, 'Total', 1, 0, 'C');
$pdf->Cell(15, 5, $TotalSolteros, 1, 0, 'C');
$pdf->Cell(15, 5, $TotalCasados, 1, 0, 'C');
$pdf->Cell(20, 5, $TotalConvivientes, 1, 0, 'C');
$pdf->Cell(20, 5, $TotalDivorciados, 1, 0, 'C');
$pdf->Cell(15, 5, $TotalViudos, 1, 0, 'C');
$pdf->Cell(15, 5, ($TotalSolteros+$TotalCasados+$TotalConvivientes+$TotalDivorciados+$TotalViudos), 1, 1, 'C');

$pdf->Output('EstadisticaEstadoCivil.pdf', 'D');  
?>