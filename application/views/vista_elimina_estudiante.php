<hr />
<div class="span-12 prefix-6 suffix-6 last center">
   <p class="notice"><img src="<?php echo base_url(); ?>css/images/icons/help.png" alt=""/>
	Usted est&aacute; a punto de eliminar permanentemente un registro. &iquest;Est&aacute; completamente seguro?
	<?php 
	echo form_open("estudiante/EliminarEstudiante");
	?>
	<ul>
		<li> <?php echo "<strong>Universitario:</strong> $NombreEstudiante"; ?> </li>
		<li><?php echo "<strong>Carrera:</strong> $NombreCarrera"; ?> </li>
	</ul>
	<br /><hr />
	<div class="span-6 prefix-4 suffix-14 last center">
		<input type='hidden' name='CodPersona' id='CodPersona' value='<?php echo $CodPersona; ?>'/>
		<button name='submit' value='borrar' class="button positive">
			<img src="<?php echo base_url(); ?>css/images/icons/tick.png" alt=""> Borrar
		</button>
		<button name='submit' class="button positive">
			<img src="<?php echo base_url(); ?>css/images/icons/cross.png" alt=""> Cancelar  
		</button>
	</div>
	</form>
   </p>
</div>

