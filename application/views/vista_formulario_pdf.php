<?php
$Upea="Universidad Pública de El Alto";
$Titulo = "DATOS PERSONALES DE MATRICULACIÓN";
$Form="Formulario 01";
$maxX=170;
$marginX=25;

$this->fpdf->SetAutoPageBreak(TRUE, 20);
$this->fpdf->Open();
$this->fpdf->SetMargins(25, 10, 20);
$this->fpdf->SetTextColor(0,0,0);
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage('P', 'Letter');
$this->fpdf->SetFont('Arial', 'B', 12);

$this->fpdf->SetXY(10,10);
$this->fpdf->Image('imagenes/LogoUpea.jpg',15,10,15);
$this->fpdf->Image('imagenes/LogoUpea.jpg',180,10,15);
$this->fpdf->Cell($maxX-40, 15, utf8_decode($Upea), 0, 0, 'C');  $this->fpdf->Cell(32, 15, $Form, 0, 1, 'L');  
$this->fpdf->setFont('Arial', 'B', 12);
$this->fpdf->Cell($maxX, 15,utf8_decode( $Titulo), 0, 1, 'C');  
$this->fpdf->setFont('Arial', '', 8);
$this->fpdf->SetX($marginX);
$this->fpdf->RoundedRect($marginX, 40, $maxX, 20, 2, '13', 'DF');

$this->fpdf->setFont('Arial', '', 7);
$this->fpdf->MultiCell($maxX,5, utf8_decode("DOCUMENTOS PRESENTADOS A REGISTROS Y ADMISIONES (Esta parte debe ser llenada por el encargado de Ventanilla Única)"), "0", 'L', 0);
$this->fpdf->setFont('Arial', '', 8);
$this->fpdf->SetX($marginX);
$this->fpdf->Cell($maxX/3+10, 5,utf8_decode("Fotoc. legalizada del título de bachiller: Si: [_]" ) , "0", 0, 'C');  
$this->fpdf->Cell($maxX/3-5, 5,utf8_decode("Certificado de Nac. Comp: Si: [_]"), "0", 0, 'C');  
$this->fpdf->Cell($maxX/3-5, 5,utf8_decode("Legalizado CI/RUN/PAS.: Si: [_]"), "0", 0, 'C');  

$this->fpdf->Ln();
$this->fpdf->SetX($marginX);
$this->fpdf->Cell($maxX/3+10, 5,utf8_decode("                                                                  No: [_] " ) , "0", 0, 'C');  
$this->fpdf->Cell($maxX/3-5, 5,utf8_decode("                                           No: [_] "), "0", 0, 'C');  
$this->fpdf->Cell($maxX/3-5, 5,utf8_decode("                                          No: [_] "), "0", 0, 'C');  


$this->fpdf->Ln();
$this->fpdf->SetX($marginX);
$this->fpdf->RoundedRect($marginX, 70, $maxX, 20, 2, '14', 'DF');
$this->fpdf->setFont('Arial', 'B', 12);
$this->fpdf->Ln();
$this->fpdf->Cell($maxX, 5,utf8_decode("DATOS ACADÉMICOS"), 0, 1, 'L');  


$this->fpdf->setFont('Arial', '', 9);
$this->fpdf->SetX($marginX);
$this->fpdf->Cell($maxX/3-20, 5,utf8_decode("Gestión: ".$this->session->userdata('Gestion') ) , "0", 0, 'C');  
$this->fpdf->Cell($maxX/3-10, 5,utf8_decode("Fecha de Ingreso: [___/___/_____]"), "0", 0, 'C');  
$this->fpdf->Cell($maxX/3+30, 5,utf8_decode("Ingreso por: [_] Examen de Dispensación"), "0", 0, 'L');  
$this->fpdf->Ln();
$this->fpdf->SetX($marginX);
$this->fpdf->Cell($maxX/3-15, 5,utf8_decode("") , "0", 0, 'C');  
$this->fpdf->Cell($maxX/3-15, 5,utf8_decode(""), "0", 0, 'C');  
$this->fpdf->Cell($maxX/3+30, 5,utf8_decode("                    [_] Curso Preuniversitario"), "0", 0, 'L');  
$this->fpdf->Ln();
$this->fpdf->SetX($marginX);
$this->fpdf->Cell($maxX/3-15, 5,utf8_decode("Carrera: ") , "0", 0, 'R');  
$this->fpdf->Cell($maxX/3-15, 5,utf8_decode($Fila->NombreCarrera.$Subsede), "0", 0, 'L');

$this->fpdf->Cell($maxX/3+30, 5,utf8_decode("                    [_] Traspaso de otra Universidad"), "0", 0, 'L');  
$this->fpdf->Ln();
$this->fpdf->SetX($marginX);
$this->fpdf->Cell($maxX/3-15, 5,utf8_decode("") , "L", 0, 'C');  
$this->fpdf->Cell($maxX/3-15, 5,utf8_decode(""), "", 0, 'C');    
$this->fpdf->Cell($maxX/3+30, 5,utf8_decode("                    [_] Profesional"), "0", 1, 'L');  


$this->fpdf->Ln();
$this->fpdf->SetX($marginX);
$this->fpdf->RoundedRect($marginX, 100, $maxX, 35, 2, '14', 'DF');
$this->fpdf->RoundedRect($marginX*6+15, 102, $maxX/6, 30, 1, '14', 'DF');
$this->fpdf->setFont('Arial', 'B', 12);
$this->fpdf->Cell($maxX, 5,utf8_decode("DATOS GENERALES DEL ESTUDIANTE"), 0, 1, 'L');  

$this->fpdf->setFont('Arial', 'B', 9);
$this->fpdf->Cell($maxX/6,5, utf8_decode("Nombres:"), "0", 'C', "R");
$this->fpdf->Cell($maxX/6,5, utf8_decode($Fila->Nombres), "0", 'L', 'L');
$this->fpdf->Ln();
$this->fpdf->setFont('Arial', 'B', 9);
$this->fpdf->SetX($marginX);
$this->fpdf->Cell($maxX/6, 5,utf8_decode("Ap. Paterno:" ) , "0", 0, 'R');  
$this->fpdf->Cell($maxX/6, 5,utf8_decode($Fila->Paterno ) , "0", 0, 'L');  
$this->fpdf->Cell($maxX/3+30, 5,utf8_decode("Sexo:  ".$Genero), "", 0, 'C');  
$this->fpdf->Cell($maxX/3-30 , 5,utf8_decode(""), "0", 0, 'L');  

$this->fpdf->Ln();
$this->fpdf->SetX($marginX);
$this->fpdf->Cell($maxX/6, 5,utf8_decode("Ap. Materno:" ) , "0", 0, 'R');  
$this->fpdf->Cell($maxX/6, 5,utf8_decode($Fila->Materno ) , "0", 0, 'L');  
$this->fpdf->Cell($maxX/6, 5,utf8_decode("CI/RUN/PAS.:"), "0", 0, 'R');  
$this->fpdf->Cell($maxX/6, 5,utf8_decode($Fila->CI), "0", 0, 'L');
$this->fpdf->Cell($maxX/3 /2+1.7 , 5,utf8_decode("Exp.:    ".$Fila->Expedido), "0", 0, 'L');  
$this->fpdf->Cell($maxX/3 /2-1.7, 5,utf8_decode(""), "0", 0, 'L');  

$this->fpdf->Ln();
$this->fpdf->SetX($marginX);
$this->fpdf->Cell($maxX/6, 5,utf8_decode("Fecha de Nac.:") , "0", 0, 'R');  
$this->fpdf->Cell($maxX/6, 5,utf8_decode($FechaNac ) , "0", 0, 'L');  
$this->fpdf->Cell($maxX/6, 5,utf8_decode("Lugar de Nac.:"), "0", 0, 'R');  
$this->fpdf->Cell(($maxX/6) , 5,utf8_decode($Fila->LugarNac), "0", 0, 'L');  

$this->fpdf->Ln();
$this->fpdf->SetX($marginX);
$this->fpdf->Cell($maxX/6, 5,utf8_decode("Domicilio:") , "0", 0, 'R');  
$this->fpdf->Cell($maxX/6+30, 5,utf8_decode($Fila->Domicilio ) , "0", 0, 'L');  
$this->fpdf->Cell($maxX/6, 5,utf8_decode("Nacionalidad:"), "0", 0, 'R');  
$this->fpdf->Cell($maxX/6-30, 5,utf8_decode($Fila->NombrePaisNacimiento), "0", 0, 'L');  


$this->fpdf->Ln();
$this->fpdf->SetX($marginX);
$this->fpdf->Cell($maxX/6, 5,utf8_decode("Teléfono:") , "0", 0, 'R');  
$this->fpdf->Cell($maxX/6, 5,utf8_decode($Fila->Telefono ) , "0", 0, 'L');  
$this->fpdf->Cell($maxX/6, 5,utf8_decode("Email:"), "0", 0, 'R');  
$this->fpdf->Cell($maxX/6, 5,utf8_decode($Fila->Correo), "0", 0, 'L');  


$this->fpdf->Ln();
$this->fpdf->SetX($marginX);
$this->fpdf->Cell($maxX/6, 5,utf8_decode("Estado Civil:") , "0", 0, 'R');  
$this->fpdf->Cell($maxX/6, 5,utf8_decode($EstadoCivil) , "0", 0, 'L');  
$this->fpdf->Cell($maxX/6, 5,utf8_decode("Tel. de Emergencia:"), "0", 0, 'R');  
$this->fpdf->Cell($maxX/6, 5,utf8_decode($Fila->TelUrgencia), "0", 0, 'L');  



$this->fpdf->Ln();
$this->fpdf->Ln();
$this->fpdf->SetX($marginX);
$this->fpdf->setFont('Arial', 'B', 12);
$this->fpdf->RoundedRect($marginX, 145, $maxX, 20, 2, '14', 'DF');
$this->fpdf->Cell($maxX, 5,utf8_decode("DATOS DE EGRESO DE SECUNDARIA"), 0, 1, 'L');  
$this->fpdf->setFont('Arial', '', 9);
$this->fpdf->SetX($marginX);
$this->fpdf->Cell($maxX/6, 5,utf8_decode("Colegio:") , "0", 0, 'R');  
$this->fpdf->Cell($maxX/6, 5,utf8_decode($Fila->Colegio ) , "0", 0, 'L');  
$this->fpdf->Cell($maxX/6, 5,utf8_decode("Año de Egreso: "), "0", 0, 'R');  
$this->fpdf->Cell($maxX/6, 5,utf8_decode($Fila->AnioEgreso), "0", 0, 'L');  


$this->fpdf->Ln();
$this->fpdf->SetX($marginX);
$this->fpdf->Cell($maxX/6, 5,utf8_decode("Tipo:" ) , "0", 0, 'R');  
$this->fpdf->Cell($maxX/6, 5,utf8_decode($TipoColegio ) , "0", 0, 'L');  
$this->fpdf->Cell($maxX/6, 5,utf8_decode("Localidad:"), "0", 0, 'R');  
$this->fpdf->Cell($maxX/6, 5,utf8_decode($Fila->Localidad), "0", 0, 'L');  
$this->fpdf->Cell($maxX/6 , 5,utf8_decode("Pais:"), "0", 0, 'R');  
$this->fpdf->Cell($maxX/6 , 5,utf8_decode($Fila->NombrePaisTitulo), "0", 0, 'L');  

$this->fpdf->Ln();
$this->fpdf->SetX($marginX);
$this->fpdf->Cell($maxX/2, 5,utf8_decode("Universidad que expide el Título de Bachiller:") , "0", 0, 'R');  
$this->fpdf->Cell($maxX/2, 5,utf8_decode($Fila->Universidad ) , "0", 0, 'L');  

$this->fpdf->Ln();
$this->fpdf->SetX($marginX);
$this->fpdf->Cell($maxX/4 , 5,utf8_decode("Número del Tit. de Bachiller:"), "0", 0, 'R');  
$this->fpdf->Cell($maxX/4 , 5,utf8_decode($Fila->NumTitulo), "0", 0, 'L');
$this->fpdf->Cell($maxX/4 , 5,utf8_decode("Año del tit. de Bachiller:"), "0", 0, 'R');  
$this->fpdf->Cell($maxX/4 , 5,utf8_decode($Fila->AnioTitulo), "0", 1, 'L');  

$this->fpdf->Ln();
$this->fpdf->SetX($marginX);
$this->fpdf->RoundedRect($marginX, 175, $maxX, 15, 2, '14', 'DF');
$this->fpdf->setFont('Arial', 'B', 12);
$this->fpdf->Cell($maxX, 5,utf8_decode("DATOS SOCIO ECONÓMICOS"), 0, 1, 'L');  

$this->fpdf->setFont('Arial', '', 9);
$this->fpdf->SetX($marginX);

$this->fpdf->Cell($maxX/2, 5,utf8_decode("Zona aproximada de la vivienda:  ") , "0", 0, 'R');  
$this->fpdf->Cell($maxX/2, 5,utf8_decode($Fila->Zona ) , "0", 0, 'L');  

$this->fpdf->Ln();
$this->fpdf->SetX($marginX);
$this->fpdf->Cell($maxX/2 , 5,utf8_decode("La vivienda que habita es:  ".$TipoVivienda), "0", 0, 'L');  
$this->fpdf->Cell($maxX/2 , 5,utf8_decode("Características de la vivienda:  ".$Caracteristicas), "0", 0, 'L');  

$this->fpdf->Ln();
$this->fpdf->SetX($marginX);
$this->fpdf->Cell($maxX/3 , 5,utf8_decode("¿Trabaja?:     ".$Trabaja), "0", 0, 'L');  
$this->fpdf->Cell($maxX/3 , 5,utf8_decode("¿Trabaja Como?:    ".$Trabajo), "0", 0, 'L');  
$this->fpdf->Cell($maxX/3 , 5,utf8_decode("Jornada:     ".$Jornada), "0", 1, 'L');  

$this->fpdf->Ln();
$this->fpdf->SetX($marginX);
$this->fpdf->RoundedRect($marginX, 200, $maxX, 20, 2, '14', 'DF');
$this->fpdf->setFont('Arial', 'B', 12);
$this->fpdf->Cell($maxX, 5,utf8_decode("CAMBIOS DE CARRERA REALIZADOS"), 0, 1, 'L');   

$this->fpdf->setFont('Arial', '', 9);

$this->fpdf->Ln();
$this->fpdf->SetX($marginX);
$this->fpdf->Cell($maxX/3 , 5,utf8_decode(" "), "0", 0, 'L');  
$this->fpdf->Cell($maxX/3 , 5,utf8_decode("Carrera de Origen:  "), "0", 0, 'L');  
$this->fpdf->Cell($maxX/3 , 5,utf8_decode("-----------------------------------------"), "0", 0, 'L');  
$this->fpdf->Ln();
$this->fpdf->SetX($marginX);
$this->fpdf->Cell($maxX/3 , 5,utf8_decode(" "), "0", 0, 'L');  
$this->fpdf->Cell($maxX/3 , 5,utf8_decode("1er Cambio de carrera:  "), "0", 0, 'L');  
$this->fpdf->Cell($maxX/3 , 5,utf8_decode("-----------------------------------------"), "0", 0, 'L');  

$this->fpdf->Ln();
$this->fpdf->SetX($marginX);
$this->fpdf->Cell($maxX/3 , 5,utf8_decode(" "), "0", 0, 'L');  
$this->fpdf->Cell($maxX/3 , 5,utf8_decode("2do Cambio de carrera:  "), "0", 0, 'L');  
$this->fpdf->Cell($maxX/3 , 5,utf8_decode("-----------------------------------------"), "0", 0, 'L');  

$this->fpdf->Ln();
$this->fpdf->SetX($marginX);
$this->fpdf->Cell($maxX , 5,utf8_decode(""), "0", 0, 'L');  
$this->fpdf->Ln();
$this->fpdf->Ln();
$this->fpdf->Ln();
$this->fpdf->Ln();
$this->fpdf->Ln();
$this->fpdf->SetX($marginX);
$this->fpdf->Cell($maxX , 5,utf8_decode("Generado por el sistema de Matriculación de la Universidad Pública y Autónoma de El Alto (".date("d-m-Y H:i").")"), "0", 0, 'L');  

$this->fpdf->Ln();

$aux = "Formulario01_".$Fila->CI.".pdf";
$this->fpdf->Output($aux, 'D');