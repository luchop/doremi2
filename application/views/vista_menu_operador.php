<div class='span-24'>
<h5>Bienvenido <?php echo $this->session->userdata('NombreUsuario');?></h5>
<hr />
<div id="page-wrap">
	<ul class="dropdown">
		<li><a href='#' >Reportes</a>
			<ul>
				<li><a href='<?php echo base_url() ?>index.php/listados/ListaPorCarrera1' title="Estudiantes matriculados a una carrera">Matriculaci&oacute;n por carrera</a></li>
				<li><a href='<?php echo base_url() ?>index.php/listados/ExportaListaCarrera' title="Genera archivo para recuperacion en MS Excel">Exportacion a Excel</a></li>
			</ul>
		</li>
        <li><a href='<?php echo base_url() ?>index.php/cambia_clave' title="Cambiar la contrase&ntilde;a del usuario">Cambia clave</a> </li>
		<li><a href='<?php echo base_url() ?>index.php/login/Logout' title="Cerrar sesi&oacute;n">Salir</a></li>
	</ul>
</div>
<hr />
</div>