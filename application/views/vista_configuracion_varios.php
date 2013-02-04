<script type="text/javascript">
$(document).ready(function() {
	$("#Configuracion").validate({
    rules: {
		Depuracion: {
			required: true,
			min: 2,
			number: true
		}
	}
	});
});
</script>

<style>
    label { width:200;}
</style>

<div class="span-10 prefix-7 suffix-7 last center">
<?php 
echo form_open("configuracion/Varios",  array('id' => 'Configuracion', 'name' => 'Configuracion'));
?>
<fieldset><legend>Configuraci&oacute;n (<?php echo $this->session->userdata('Gestion');?>)</legend>

<br /><label for='Gestion'>Gesti&oacute;n </label>
<?php echo ComboGestion($this->session->userdata('Gestion')); ?><br /><br />

<label for='Desde'>Costo matr&iacute;cula nacional Bs. </label>
<input type='text' id='Nacional' name='Nacional' size='10' class='required number' maxlength='10' value='<?php echo $Nacional; ?>' /><br /><br />

<label for='Desde'>Costo matr&iacute;cula extranjero Bs. </label>
<input type='text' id='Extranjero' name='Extranjero' size='10' class='required number' maxlength='10' value='<?php echo $Extranjero; ?>' /><br /><br />

<label for='Depuracion'>D&iacute;as para depuraci&oacute;n </label>
<input type='text' id='Depuracion' name='Depuracion' size='10' maxlength='10' value='<?php echo $Depuracion; ?>' /><br /><br />

<label for='Depuracion'>Delimitador de listas </label>
<input type='text' id='Delimitador' name='Delimitador' size='2' maxlength='1' value='<?php echo $Delimitador; ?>' /><br /><br />

<hr /><br />
<div class='span-3 prefix-4 suffix-3 last center'>
	<button class="button positive">
		<img src="<?php echo base_url(); ?>css/images/icons/tick.png" alt=""> Guardar 
	</button>
</div>

</fieldset>
</form>
</div>