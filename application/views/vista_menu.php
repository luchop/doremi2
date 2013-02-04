<div class='span-24'>
<h5>Bienvenido 
<?php 
echo $this->session->userdata('NombreUsuario'); 
$Llave = $this->session->userdata('Llave'); 
echo "</h5>";

echo '<div id="page-wrap">
	<ul class="dropdown">';
    
//**** Menu Universitarios
if($Llave[1] || $Llave[1] || $Llave[1]) {
	echo '<li><a href="#">Universitarios</a>
			<ul class="sub_menu">';
		if($Llave[1]) 
			echo "<li><a href='".base_url()."index.php/formulario/NuevoEstudiante' title='Nuevo universitario'>Nuevo</a></li>";
		if($Llave[2])
			echo "<li><a href='".base_url()."index.php/estudiante/BuscaParaModificar/1' title='Modificar datos de universitario'>Modificar</a></li>";
		if($Llave[3])
			echo "<li><a href='".base_url()."ndex.php/estudiante/BuscaParaEliminar' title='Eliminar registro de universitario'>Eliminar</a></li>";
	echo "</ul></li>";
}

//**** Menu Matriculacion
if($Llave[5] || $Llave[6] || $Llave[7]) {
	echo "<li><a href='#'>Matriculaci&oacute;n</a>
			<ul class='sub_menu'>";
        if($Llave[5])
			echo "<li><a href='".base_url()."index.php/estudiante/BuscaParaMatricular' title='Registro de nueva matricula'>Nueva matr&iacute;cula</a></li>";
		/*if($Llave[5])
			echo "<li><a href='".base_url()."index.php/matriculacion/NuevaMatricula/1' title='Nueva matricula'>Nueva matricula</a></li>";*/
		if($Llave[6])
			echo "<li><a href='".base_url()."index.php/matriculacion/BuscaParaModificar' title='Modificar datos de matriculacion'>Modificar</a></li>";
		if($Llave[7])
			echo "<li><a href='".base_url()."index.php/matriculacion/BuscaParaEliminar' title='Eliminar registro de matriculacion'>Eliminar/anular</a></li>";
	echo "</ul></li>";
}

//**** Menu Reportes
if($Llave[8] || $Llave[8] || $Llave[8] || $Llave[14] || $Llave[15] || $Llave[22]) {
	echo "<li><a href='#' >Reportes</a>
			<ul>";  
		if ($Llave[8])
            echo "<li><a href='".base_url()."index.php/listados/ImprimeMatricula' title='Impresion de matricula'>Impresi&oacute;n de matrícula</a></li>";
        if ($Llave[10] || $Llave[11]  || $Llave[12] || $Llave[13]) {
			echo "<li><a href='#' title='Impresion'>Listados</a>
					<ul class='sub_menu'>";
                if ($Llave[10])
					echo "<li><a href='".base_url()."index.php/listados/ListaPorCarrera1' title='Estudiantes matriculados a una carrera'>Matriculaci&oacute;n por carrera</a></li>";
				if ($Llave[11])
					echo "<li><a href='".base_url()."index.php/listados/ListaMatriculas' title='Impresion de matricula'>Matriculas expedidas</a></li>";
				if ($Llave[12])
					echo "<li><a href='".base_url()."index.php/listados/ListaPorGestion' title=''>Lista por gestion</a></li>";
				if ($Llave[13])
					echo "<li><a href='".base_url()."index.php/impresion/ReporteDiario' title=''>Arqueo</a></li>";
				echo "</ul></li>";
		}
        
        if ($Llave[8]) 
			echo "<li><a href='#' title='Impresion'>Estadisticas</a>
					<ul class='sub_menu'>
						<li><a href='".base_url()."index.php/impresion/Matricula' title='Impresion de matricula'>Documentacion</a></li>
						<li><a href='".base_url()."index.php/listados/EstadisticaPorCarreraGenero' title='Estadistica de estudiantes y genero por carrera'>Num. estudiantes y g&eacute;nero</a></li>
						<li><a href='".base_url()."index.php/listados/EstadisticaEstadoCivil'>Estado civil</a></li>
						<li><a href='".base_url()."index.php/listados/ListaPorTipoColegio'>Tipo de colegio</a></li>
						<li><a href='".base_url()."index.php/listados/ReporteDiario'>Vivienda</a></li>
						<li><a href='".base_url()."index.php/listados/ListaPorUniversidadTitulo'>Universidad del titulo</a></li>
						<li><a href='".base_url()."index.php/listados/xx'>Zona</a></li>
						<li><a href='".base_url()."index.php/listados/xx'>Tipo de trabajo</a></li>
						<li><a href='".base_url()."index.php/listados/xx'>Trabajo</a></li>
						<li><a href='".base_url()."index.php/listados/xx'>Jornada laboral</a></li>
						<li><a href='".base_url()."index.php/listados/xx'>Propiedad de vivienda</a></li>
					</ul>
				</li>";
		if ($Llave[14]) 
			echo "<li><a href='#' title='Impresion'>Reporte de irregularidades</a>
                <ul class='sub_menu'>				
                    <li><a href='".base_url()."index.php/impresion/Matricula' >Documentaci&oacute;n Incompleta</a></li>
                    <li><a href='".base_url()."index.php/impresion/ReporteDiario' >Reg. universitario Repetido</a> </li>
                    <li><a href='".base_url()."index.php/impresion/ReporteDiario'>C.I. Repetido</a></li>
                    <li><a href='".base_url()."index.php/impresion/ReporteDiario'>Universitarios sin C.I.</a></li>
                </ul></li>";                
		if ($Llave[15]) 
			echo "<li><a href='".base_url()."index.php/listados/ExportaListaCarrera' title='Genera archivo para recuperacion en MS Excel'>Exportacion a Excel</a></li>";
		if ($Llave[22])
			echo "<li><a href='".base_url()."index.php/auditoria/BuscaParaAuditoria' >Auditor&iacute;a</a></li>";

		echo "</ul></li>";
}

//**** Menu Utilidades
if($Llave[16] || $Llave[21] || $Llave[17] || $Llave[18] || $Llave[19] || $Llave[20]) {        
	echo "<li><a href='#' >Utilidades</a>
			<ul>";
		if ($Llave[16])
			echo "<li><a href='".base_url()."index.php/calibra' title='Ajuste de la impresion de matriculas'>Calibraci&oacute;n de la matricula</a> </li>";
		if ($Llave[21])
			echo "<li><a href='".base_url()."index.php/usuario/Listado' >Administraci&oacute;n de usuarios</a> 
					<ul>
						<li><a href='".base_url()."index.php/usuario/Nuevo' >Nuevo usuario</a> </li>
						<li><a href='".base_url()."index.php/usuario/Listado'>Modificacion datos usuario</a> </li>
						<li><a href='".base_url()."index.php/perfil/Nuevo'>Nuevo perfil</a> </li>
						<li><a href='".base_url()."index.php/perfil/Listado'>Modificacion de perfil</a> </li>
					</ul>
				</li>";
        if ($Llave[17])
			echo "<li><a href='".base_url()."index.php/configuracion/CupoMatriculas' >Control de cupos de matr&iacute;culas</a> </li>";
        if ($Llave[18]) 
			echo "<li><a href='".base_url()."index.php/habilita/agrega' >Habilitaci&oacute;n de registro web</a> </li>";
		if ($Llave[19])
			echo "<li><a href='".base_url()."index.php/configuracion/Depuracion' >Depuraci&oacute;n de registro web</a> </li>";
		if ($Llave[20])
			echo "<li><a href='#' >Varios</a> 
                    <ul>
                        <li><a href='".base_url()."index.php/configuracion/Varios' title='Gestion e importes de matricula'>Gesti&oacute;n, montos y depuraci&oacute;n</a> </li>
                        <li><a href='".base_url()."index.php/administrador/Carrera' >Carreras</a> </li>
                        <li><a href='".base_url()."index.php/administrador/Pais' >Paises</a> </li>
                        <li><a href='".base_url()."index.php/administrador/Banco' >Bancos</a> </li>
                        <li><a href='".base_url()."index.php/administrador/GradoAcademico' >Grados acad&eacute;micos</a> </li>
                        <li><a href='".base_url()."index.php/administrador/Banco' >Idiomas</a> </li>
                        <li><a href='".base_url()."index.php/administrador/Universidad'>Universidades</a> </li>
                    </ul>
                </li>";
        echo "</ul></li>";
}
echo "<li><a href='".base_url()."index.php/cambia_clave' title='Cambio de contraseña'>Cambia clave</a></li>";
echo "<li><a href='".base_url()."index.php/login/Logout' title='Cerrar sesi&oacute;n'>Salir</a></li>";
?>
</ul>
</div>
<hr />
</div>