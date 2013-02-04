<?php
$this->output->set_header('Content-Disposition: attachment; filename="lista.csv"');
$this->output->set_header('Content-Type: application/force-download');
//Lista de matriculados por carrera
echo 'Nombre' . $Delimitador . 'CI' . $Delimitador . 'Reg.Univ.';
foreach($Tabla->result() as $row) {
	echo "\r\n".$row->NombreCompleto . $Delimitador . $row->CI . $Delimitador . $row->RegUniversitario;
}
?>