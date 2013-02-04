<hr />
<div class="span-12 prefix-6 suffix-6 last center">
   <p class="notice"><img src="<?php echo base_url(); ?>css/images/icons/help.png" alt=""/>
	Esta funci&oacute;n eliminar&aacute; a los estudiantes registrados y que no hubieran sido matriculados dentro del plazo 
	definido.;
	<?php 
	echo form_open("configuracion/Depuracion");
	?>
	Configuraci&oacute;n actual: 
	<input type='text' readonly id='Dias' name='Dias' size='4' class='required number' value='<?php echo $this->modelo_valores->GetNumero('DEPURACION')?>' /> 
	d&iacute;as
	<br /><br />
	&iquest;Est&aacute; seguro de que quiere proceder a la depuraci&oacute;n?
	<br /><hr />
	<div class="span-6 prefix-3 suffix-15 last center">
		<button name='submit' value='borrar' class="button positive">
			<img src="<?php echo base_url(); ?>css/images/icons/tick.png" alt=""> Depurar
		</button>
		<button name='submit' class="button positive">
			<img src="<?php echo base_url(); ?>css/images/icons/cross.png" alt=""> Cancelar  
		</button>
	</div>
	</form>
   </p>
</div>

