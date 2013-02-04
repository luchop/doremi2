<div class='span-24'>
<h5>Bienvenido <?php echo $this->session->userdata('NombreUsuario'); echo $this->session->userdata('CodUsuario');
$Llave = $this->session->userdata('Llave'); ?></h5>
<div id="page-wrap">
	<ul class="dropdown">
		<li><a href='#'>Universitarios</a>
			<ul class="sub_menu">
				<?php if ($Llave[1]) { ?>
					<li><a href='<?php echo base_url() ?>index.php/formulario/NuevoEstudiante' title="Nuevo universitario">Nuevo</a></li>
				<?php } ?>
				<?php if ($Llave[2]) { ?>
					<li><a href='<?php echo base_url() ?>index.php/estudiante/BuscaParaModificar/1' title="Modificar datos de universitario">Modificar</a></li>
				<?php } ?>
				<?php if ($Llave[3]) { ?>
					<li><a href='<?php echo base_url() ?>index.php/estudiante/BuscaParaEliminar' title="Eliminar registro de universitario">Eliminar</a></li>
				<?php } ?>
			</ul>
		</li>

		<li><a href='#'>Matriculaci&oacute;n</a>
			<ul class="sub_menu">				
				<?php if ($Llave[5]) { ?>
					<li><a href='<?php echo base_url() ?>index.php/estudiante/BuscaParaMatricular' title="Matriculacion de registrado via web">Confirmaci&oacute;n de registro web</a></li>
				<?php } ?>
				<?php if ($Llave[5]) { ?>
					<li><a href='<?php echo base_url() ?>index.php/matriculacion/NuevaMatricula/1' title="Nueva matricula">Nueva matricula</a></li>
				<?php } ?>
				<?php if ($Llave[6]) { ?>
					<li><a href='<?php echo base_url() ?>index.php/matriculacion/BuscaParaModificar' title="Modificar datos de matriculacion">Modificar</a></li>
				<?php } ?>
				<?php if ($Llave[7]) { ?>
					<li><a href='<?php echo base_url() ?>index.php/matriculacion/BuscaParaEliminar' title="Eliminar registro de matriculacion">Eliminar/anular</a></li>
				<?php } ?>
			</ul>
		</li>

		<li><a href='#' >Reportes</a>
			<ul>
				<?php if ($Llave[8]) { ?>
				<li><a href='<?php echo base_url() ?>index.php/listados/ImprimeMatricula' title="Impresion de matricula">Impresi&oacute;n de matrícula</a></li>
				 <?php } ?>
				<li><a href='#' title="Impresion">Listados</a>
					<ul class="sub_menu">				
						<?php if ($Llave[10]) { ?>
						<li><a href='<?php echo base_url() ?>index.php/listados/ListaPorCarrera1' title="Estudiantes matriculados a una carrera">Matriculaci&oacute;n por carrera</a></li>
						<?php } ?>
						<?php if ($Llave[11]) { ?>
						<li><a href='<?php echo base_url() ?>index.php/listados/ListaMatriculas' title="Impresion de matricula">Matriculas expedidas</a></li>
						<?php } ?>
						<?php if ($Llave[12]) { ?>
						<li><a href='<?php echo base_url() ?>index.php/listados/ListaPorGestion' title="">Lista por gestion</a></li>
						<?php } ?>
						<?php if ($Llave[13]) { ?>
						<li><a href='<?php echo base_url() ?>index.php/impresion/ReporteDiario' title="">Arqueo</a></li>
						<?php } ?>
					</ul>
				</li>
				<?php if ($Llave[8]) { ?>
				<li><a href='#' title="Impresion">Estadisticas</a>
					<ul class="sub_menu">				
						<li><a href='<?php echo base_url() ?>index.php/impresion/Matricula' title="Impresion de matricula">Documentacion</a></li>
						<li><a href='<?php echo base_url() ?>index.php/listados/EstadisticaPorCarreraEdad' title="Estadistica de estudiantes y genero por carrera">Num. estudiantes y genero</a></li>
						<li><a href='<?php echo base_url() ?>index.php/listados/ListaPorGestion'>Estado civil</a></li>
						<li><a href='<?php echo base_url() ?>index.php/listados/ListaPorTipoColegio'>Tipo de colegio</a></li>
						<li><a href='<?php echo base_url() ?>index.php/listados/ReporteDiario'>Vivienda</a></li>
						<li><a href='<?php echo base_url() ?>index.php/listados/ListaPorUniversidadTitulo'>Universidad del titulo</a></li>
						<li><a href='<?php echo base_url() ?>index.php/listados/xx'>Zona</a></li>
						<li><a href='<?php echo base_url() ?>index.php/listados/xx'>Tipo de trabajo</a></li>
						<li><a href='<?php echo base_url() ?>index.php/listados/xx'>Trabajo</a></li>
						<li><a href='<?php echo base_url() ?>index.php/listados/xx'>Jornada laboral</a></li>
						<li><a href='<?php echo base_url() ?>index.php/listados/xx'>Propiedad de vivienda</a></li>
					</ul>
				</li>
				<?php } ?>
				<?php if ($Llave[14]) { ?>
				<li><a href='#' title="Impresion">Reporte de irregularidades</a>
					<ul class="sub_menu">				
						<li><a href='<?php echo base_url() ?>index.php/impresion/Matricula' >Documentaci&oacute;n Incompleta</a></li>
						<li><a href='<?php echo base_url() ?>index.php/impresion/ReporteDiario' >Reg. universitario Repetido</a> </li>
						<li><a href='<?php echo base_url() ?>index.php/impresion/ReporteDiario'>C.I. Repetido</a></li>
						<li><a href='<?php echo base_url() ?>index.php/impresion/ReporteDiario'>Universitarios sin C.I.</a></li>
					</ul>
				</li>
				<?php } ?>
				<?php if ($Llave[15]) { ?>
				<li><a href='<?php echo base_url() ?>index.php/listados/ExportaListaCarrera' title="Genera archivo para recuperacion en MS Excel">Exportacion a Excel</a></li>
				<?php } ?>
				<?php if ($Llave[22]) { ?>
				<li><a href='<?php echo base_url() ?>index.php/auditoria/Busqueda' >Auditoria</a></li>
				<?php } ?>
			</ul>
		</li>
		<li><a href='#' >Utilidades</a>
			<ul>
				<?php if ($Llave[16]) { ?>
				<li><a href='<?php echo base_url() ?>index.php/calibra' title="Ajuste de la impresion de matriculas">Calibraci&oacute;n de la matricula</a> </li>
				<?php } ?>
				<?php if ($Llave[21]) { ?>
				<li><a href='<?php echo base_url() ?>index.php/usuario/Listado' >Administraci&oacute;n de usuarios</a> 
					<ul>
						<li><a href='<?php echo base_url() ?>index.php/usuario/Nuevo' >Nuevo usuario</a> </li>
						<li><a href='<?php echo base_url() ?>index.php/usuario/Listado'>Modificacion datos usuario</a> </li>
						<li><a href='<?php echo base_url() ?>index.php/perfil/Nuevo'>Nuevo perfil</a> </li>
						<li><a href='<?php echo base_url() ?>index.php/perfil/Listado'>Modificacion de perfil</a> </li>
					</ul>
				</li>
				<?php } ?>
				<?php if ($Llave[17]) { ?>
				<li><a href='<?php echo base_url() ?>index.php/configuracion/CupoMatriculas' >Control de cupos de matr&iacute;culas</a> </li>
				<?php } ?>
				<?php if ($Llave[18]) { ?>
				<li><a href='<?php echo base_url() ?>index.php/habilita/agrega' >Habilitaci&oacute;n de registro web</a> </li>
				<?php } ?>
				<?php if ($Llave[19]) { ?>
				<li><a href='<?php echo base_url() ?>index.php/configuracion/Depuracion' >Depuraci&oacute;n de registro web</a> </li>
				<?php } ?>
				<?php if ($Llave[20]) { ?>
				<li><a href='<?php echo base_url() ?>index.php/usuario/Listado' >Varios</a> 
					<ul>
						<li><a href='<?php echo base_url() ?>index.php/configuracion/Varios' title="Gestion e importes de matricula">Gesti&oacute;n, montos y depuraci&oacute;n</a> </li>
						<li><a href='<?php echo base_url() ?>index.php/administrador/Carrera' >Carreras</a> </li>
						<li><a href='<?php echo base_url() ?>index.php/administrador/Pais' >Paises</a> </li>
						<li><a href='<?php echo base_url() ?>index.php/administrador/Banco' >Bancos</a> </li>
						<li><a href='<?php echo base_url() ?>index.php/administrador/GradoAcademico' >Grados acad&eacute;micos</a> </li>
						<li><a href='<?php echo base_url() ?>index.php/administrador/Banco' >Idiomas</a> </li>
						<li><a href='<?php echo base_url() ?>index.php/administrador/Universidad'>Universidades</a> </li>
					</ul>
				</li>
				<?php } ?>

			</ul>
		<li><a href='<?php echo base_url() ?>index.php/login/Logout' title="Cerrar sesi&oacute;n">Salir</a></li>
	</ul>
</div>
<hr />
</div>