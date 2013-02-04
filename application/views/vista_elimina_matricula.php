<div class="span-12 prefix-6 suffix-6 last center">
   <p class="notice"><img src="<?php echo base_url(); ?>css/images/icons/help.png" alt=""/>
	Usted est&aacute; a punto de eliminar permanentemente un registro. &iquest;Est&aacute; completamente seguro?
	<?php 
	echo form_open("matriculacion/EliminarMatricula");
	?>
	<ul>
		<li> <?php echo "<strong>Universitario:</strong> $NombreEstudiante"; ?> </li>
		<li><?php echo "<strong>Carrera:</strong> $NombreCarrera"; ?> </li>
        <li><?php echo "<strong>No. de matr&iacute;cula:</strong> $Matricula"; ?> </li>
        <li><?php echo "<strong>Gesti&oacute;n:</strong> $Gestion"; ?> </li>
	</ul>
	<br /><hr />
	<div class="span-8 prefix-2 suffix-2 last center">
		<input type='hidden' name='CodMatricula' id='CodMatricula' value='<?php echo $CodMatricula; ?>'/>
		<button name='submit' value='borrar' class="button positive">
			<img src="<?php echo base_url(); ?>css/images/icons/tick.png" alt=""> Borrar
		</button>
        <button name='submit' value='anular' class="button positive">
			<img src="<?php echo base_url(); ?>css/images/icons/tick.png" alt=""> Anular
		</button>
		<button name='submit' class="button positive">
			<img src="<?php echo base_url(); ?>css/images/icons/cross.png" alt=""> Cancelar  
		</button>
	</div>
	</form>
   </p>
</div>

