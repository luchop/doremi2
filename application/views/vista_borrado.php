<hr />
<div class="span-12 prefix-6 suffix-6 last center">
   <p class="notice"><img src="img/icons/help.png" alt=""/>
	<h6>Usted est&aacute; a punto de eliminar permanentemente un registro. ¿Est&aacute; completamente seguro? </h6>
	<br />
	<?php 
	echo form_open("estudiante/BorraEstudiante");
	echo "Univ. $NombreEstudiante<br/>"
	?>
	<ul>
		<li> <?php echo "Universitario: $NombreEstudiante"; ?> </li>
		<li><?php echo "Carrera: $NombreCarrera"; ?> </li>
	</ul>
	<br /><hr />
	<div class='span-3 prefix-4 suffix-3 last center'>
		<button class="button positive">
			<img src="<?php echo base_url(); ?>css/images/icons/tick.png" alt=""> Borrar
		</button>
		<button class="button positive">
			<img src="<?php echo base_url(); ?>css/images/icons/cross.png" alt=""> Cancelar  
		</button>
	</div>
   </p>
</div>

