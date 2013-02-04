<?php
// hereda la clase FPDF para crear header() y footer()
require('headerfooter.php');

$pdf = new Mypdf;

$pdf->Linea1 =  $this->modelo_valores->GetTexto('LINEA1');		 
$pdf->Linea2 =  $this->modelo_valores->GetTexto('LINEA2');
$pdf->Linea3 =  $this->modelo_valores->GetTexto('LINEA3');
$pdf->Titulo = utf8_decode("Estadística por universidad que expidió el título");
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

$pdf->SetFont('Arial','B',6);
//titulos de columnas
$pdf->Cell(7, 5, '#', 1, 0, 'C');
$pdf->Cell(45, 5, 'Carrera', 1, 0, 'L');  
$pdf->Cell(8, 5, 'UPEA', 1, 0, 'C');
$pdf->Cell(8, 5, 'UMSA', 1, 0, 'C');
$pdf->Cell(8, 5, 'UTO', 1, 0, 'C');
$pdf->Cell(8, 5, 'UTF', 1, 0, 'C');
$pdf->Cell(8, 5, 'USXX', 1, 0, 'C');
$pdf->Cell(8, 5, 'USFX', 1, 0, 'C');
$pdf->Cell(8, 5, 'UMSS', 1, 0, 'C');
$pdf->Cell(10, 5, 'UAGRM', 1, 0, 'C');
$pdf->Cell(8, 5, 'UAP', 1, 0, 'C');
$pdf->Cell(8, 5, 'UJMS', 1, 0, 'C');
$pdf->Cell(8, 5, 'UTB', 1, 0, 'C');
$pdf->Cell(12, 5, 'SEDUCA', 1, 0, 'C');
$pdf->Cell(8, 5, 'Total', 1, 1, 'C');
//$pdf->Ln(1);
$pdf->SetFont('Arial','',6);
$newArray=array();
foreach($Tabla->result() as $row) {
	$newArray[$row->CodCarrera]['UPEA']=(!isset($newArray[$row->CodCarrera]['UPEA']))?0:$newArray[$row->CodCarrera]['UPEA'];
	$newArray[$row->CodCarrera]['UMSA']=(!isset($newArray[$row->CodCarrera]['UMSA']))?0:$newArray[$row->CodCarrera]['UMSA'];
	$newArray[$row->CodCarrera]['UTO']=(!isset($newArray[$row->CodCarrera]['UTO']))?0:$newArray[$row->CodCarrera]['UTO'];
	$newArray[$row->CodCarrera]['UTF']=(!isset($newArray[$row->CodCarrera]['UTF']))?0:$newArray[$row->CodCarrera]['UTF'];
	$newArray[$row->CodCarrera]['USXX']=(!isset($newArray[$row->CodCarrera]['Otro']))?0:$newArray[$row->CodCarrera]['Otro'];
	$newArray[$row->CodCarrera]['USFX']=(!isset($newArray[$row->CodCarrera]['Otro']))?0:$newArray[$row->CodCarrera]['Otro'];
	$newArray[$row->CodCarrera]['UMSS']=(!isset($newArray[$row->CodCarrera]['Otro']))?0:$newArray[$row->CodCarrera]['Otro'];
	$newArray[$row->CodCarrera]['UAGRM']=(!isset($newArray[$row->CodCarrera]['Otro']))?0:$newArray[$row->CodCarrera]['Otro'];
	$newArray[$row->CodCarrera]['UAP']=(!isset($newArray[$row->CodCarrera]['Otro']))?0:$newArray[$row->CodCarrera]['Otro'];
	$newArray[$row->CodCarrera]['UJMS']=(!isset($newArray[$row->CodCarrera]['Otro']))?0:$newArray[$row->CodCarrera]['Otro'];
	$newArray[$row->CodCarrera]['UTB']=(!isset($newArray[$row->CodCarrera]['Otro']))?0:$newArray[$row->CodCarrera]['Otro'];
	$newArray[$row->CodCarrera]['SEDUCA']=(!isset($newArray[$row->CodCarrera]['Otro']))?0:$newArray[$row->CodCarrera]['Otro'];
	
	$newArray[$row->CodCarrera]['NombreCarrera']=$row->NombreCarrera;
	$newArray[$row->CodCarrera]['UPEA']+=$row->UPEA;
	$newArray[$row->CodCarrera]['UMSA']+=$row->UMSA;
	$newArray[$row->CodCarrera]['UTO']+=$row->UTO;
	$newArray[$row->CodCarrera]['UTF']+=$row->UTF;
	$newArray[$row->CodCarrera]['USXX']+=$row->USXX;
	$newArray[$row->CodCarrera]['USFX']+=$row->USFX;
	$newArray[$row->CodCarrera]['UMSS']+=$row->UMSS;
	$newArray[$row->CodCarrera]['UAGRM']+=$row->UAGRM;
	$newArray[$row->CodCarrera]['UAP']+=$row->UAP;
	$newArray[$row->CodCarrera]['UJMS']+=$row->UJMS;
	$newArray[$row->CodCarrera]['UTB']+=$row->UTB;
	$newArray[$row->CodCarrera]['SEDUCA']+=$row->SEDUCA;
}

$count=0;
$TotalUPEA=0;
$TotalUMSA=0;
$TotalUTO=0;
$TotalUTF=0;
$TotalUSXX=0;
$TotalUSFX=0;
$TotalUMSS=0;
$TotalUAGRM=0;
$TotalUAP=0;
$TotalUJMS=0;
$TotalUTB=0;
$TotalSEDUCA=0;

foreach($newArray as $row) {
	$count++;
	$pdf->Cell(7, 5, $count, 1, 0, 'C');
	$pdf->Cell(45, 5, utf8_decode($row["NombreCarrera"]), 1, 0, 'L');  
	$TotalUPEA+=$row["UPEA"];
	$pdf->Cell(8, 5, $row["UPEA"], 1, 0, 'R');
	$TotalUMSA+=$row["UMSA"];
	$pdf->Cell(8, 5, $row["UMSA"], 1, 0, 'R');
	$TotalUTO+=$row["UTO"];
	$pdf->Cell(8, 5, $row["UTO"], 1, 0, 'R');
	$TotalUTF+=$row["UTF"];
	$pdf->Cell(8, 5, $row["UTF"], 1, 0, 'R');
	$TotalUSXX+=$row["USXX"];
	$pdf->Cell(8, 5, $row["USXX"], 1, 0, 'R');
	$TotalUSFX+=$row["USFX"];
	$pdf->Cell(8, 5, $row["USFX"], 1, 0, 'R');
	$TotalUMSS+=$row["UMSS"];
	$pdf->Cell(8, 5, $row["UMSS"], 1, 0, 'R');
	$TotalUAGRM+=$row["UAGRM"];
	$pdf->Cell(10, 5, $row["UAGRM"], 1, 0, 'R');
	$TotalUAP+=$row["UAP"];
	$pdf->Cell(8, 5, $row["UAP"], 1, 0, 'R');
	$TotalUJMS+=$row["UJMS"];
	$pdf->Cell(8, 5, $row["UJMS"], 1, 0, 'R');
	$TotalUTB+=$row["UTB"];
	$pdf->Cell(8, 5, $row["UTB"], 1, 0, 'R');
	$TotalSEDUCA+=$row["SEDUCA"];
	$pdf->Cell(12, 5, $row["SEDUCA"], 1, 0, 'R');
	$pdf->Cell(8, 5, ($row["UPEA"]+$row["UMSA"]+$row["UTO"]+$row["UTF"]+$row["USXX"]+$row["USFX"]+$row["UMSS"]+$row["UAGRM"]+$row["UAP"]+$row["UJMS"]+$row["UTB"]+$row["SEDUCA"]), 'BR', 1, 'R');
}
$pdf->SetFont('Arial','B',6);
$pdf->Cell(7, 5, '', 1, 0, 'R');
$pdf->Cell(45, 5, 'Total', 1, 0, 'R');
$pdf->Cell(8, 5, $TotalUPEA, 1, 0, 'R');
$pdf->Cell(8, 5, $TotalUMSA, 1, 0, 'R');
$pdf->Cell(8, 5, $TotalUTO, 1, 0, 'R');
$pdf->Cell(8, 5, $TotalUTF, 1, 0, 'R');
$pdf->Cell(8, 5, $TotalUSXX, 1, 0, 'R');
$pdf->Cell(8, 5, $TotalUSFX, 1, 0, 'R');
$pdf->Cell(8, 5, $TotalUMSS, 1, 0, 'R');
$pdf->Cell(10, 5, $TotalUAGRM, 1, 0, 'R');
$pdf->Cell(8, 5, $TotalUAP, 1, 0, 'R');
$pdf->Cell(8, 5, $TotalUJMS,1, 0, 'R');
$pdf->Cell(8, 5, $TotalUTB, 1, 0, 'R');
$pdf->Cell(12, 5, $TotalSEDUCA, 1, 0, 'R');
$pdf->Cell(8, 5, ($TotalUPEA+$TotalUMSA+$TotalUTO+$TotalUTF+$TotalUSXX+$TotalUSFX+$TotalUMSS+$TotalUAGRM+$TotalUAP+$TotalUJMS+$TotalUTB+$TotalSEDUCA), 1, 1, 'R');

$pdf->Output('UniversidadTitulo.pdf', 'D');  
?>