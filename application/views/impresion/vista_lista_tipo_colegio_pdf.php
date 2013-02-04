<?php
// hereda la clase FPDF para crear header() y footer()
require('headerfooter.php');

$pdf = new Mypdf;

$pdf->Linea1 =  $this->modelo_valores->GetTexto('LINEA1');		 
$pdf->Linea2 =  $this->modelo_valores->GetTexto('LINEA2');
$pdf->Linea3 =  $this->modelo_valores->GetTexto('LINEA3');
$pdf->Titulo = utf8_decode("Estadística por tipo de colegio");
$pdf->AddPage();

$pdf->SetFont('Arial','',10);
//cabezera de columnas
//carrera
$pdf->Cell(90,5,'Reporte: '.$Reporte,0,1);
//gestion
$pdf->Cell(70,5,'Gestion: '.$Gestion,0,1);
//fecha actual 
$pdf->Cell(70,5,'Fecha actual: '.date('d/M/Y'),0,1);
$pdf->Ln(2);

$pdf->SetFont('Arial','B',8);
//titulos de columnas
$pdf->Cell(8, 5, '#', 1, 0, 'C');
$pdf->Cell(80, 5, 'Carrera', 1, 0, 'L');  
$pdf->Cell(15, 5, 'Público', 1, 0, 'C');
$pdf->Cell(15, 5, 'Privado', 1, 0, 'C');
$pdf->Cell(15, 5, 'Cema', 1, 0, 'C');
$pdf->Cell(15, 5, 'Otros', 1, 0, 'C');
$pdf->Cell(15, 5, 'Total', 1, 1, 'C');
//$pdf->Ln(1);
$pdf->SetFont('Arial','',8);
$newArray=array();
foreach($Tabla->result() as $row) {
	$newArray[$row->CodCarrera]['Carrera']=(!isset($newArray[$row->CodCarrera]['Carrera']))?0:$newArray[$row->CodCarrera]['Carrera'];
	$newArray[$row->CodCarrera]['Publico']=(!isset($newArray[$row->CodCarrera]['Publico']))?0:$newArray[$row->CodCarrera]['Publico'];
	$newArray[$row->CodCarrera]['Privado']=(!isset($newArray[$row->CodCarrera]['Privado']))?0:$newArray[$row->CodCarrera]['Privado'];
	$newArray[$row->CodCarrera]['Cema']=(!isset($newArray[$row->CodCarrera]['Cema']))?0:$newArray[$row->CodCarrera]['Cema'];
	$newArray[$row->CodCarrera]['Otro']=(!isset($newArray[$row->CodCarrera]['Otro']))?0:$newArray[$row->CodCarrera]['Otro'];
	
	$newArray[$row->CodCarrera]['NombreCarrera']=$row->NombreCarrera;
	$newArray[$row->CodCarrera]['Publico']+=$row->Publico;
	$newArray[$row->CodCarrera]['Privado']+=$row->Privado;
	$newArray[$row->CodCarrera]['Cema']+=$row->Cema;
	$newArray[$row->CodCarrera]['Otro']+=$row->Otro;
}

$count=0;
$TotalPublico=0;
$TotalPrivado=0;
$TotalCema=0;
$TotalOtro=0;
foreach($newArray as $row) {
	$count++;
	$pdf->Cell(8, 5, $count, 1, 0, 'C');
	$pdf->Cell(80, 5, utf8_decode($row["NombreCarrera"]), 1, 0, 'L');  
	$TotalPublico+=$row["Publico"];
	$pdf->Cell(15, 5, $row["Publico"], 1, 0, 'C');
	$TotalPrivado+=$row["Privado"];
	$pdf->Cell(15, 5, $row["Privado"], 1, 0, 'C');
	$TotalCema+=$row["Cema"];
	$pdf->Cell(15, 5, $row["Cema"], 1, 0, 'C');
	$TotalOtro+=$row["Otro"];
	$pdf->Cell(15, 5, $row["Otro"], 1, 0, 'C');
	$pdf->Cell(15, 5, ($row["Publico"]+$row["Privado"]+$row["Cema"]+$row["Otro"]), 1, 1, 'C');
}
$pdf->SetFont('Arial','B',8);
$pdf->Cell(8, 5, '', 1, 0, 'C');
$pdf->Cell(80, 5, 'Total', 1, 0, 'C');
$pdf->Cell(15, 5, $TotalPublico, 1, 0, 'C');
$pdf->Cell(15, 5, $TotalPrivado, 1, 0, 'C');
$pdf->Cell(15, 5, $TotalCema, 1, 0, 'C');
$pdf->Cell(15, 5, $TotalOtro, 1, 0, 'C');
$pdf->Cell(15, 5, ($TotalPublico+$TotalPrivado+$TotalCema+$TotalOtro), 1, 1, 'C');


$pdf->Output('EstadisticaColegio.pdf', 'D');  
?>