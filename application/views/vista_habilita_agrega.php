<script type="text/javascript">
$(document).ready(function() {
	$("#Habilitacion").validate();
});
</script>
<div class="span-12 prefix-6 suffix-6 last center">
<?php 
echo form_open("habilita/agrega",  array('id' => 'Habilitacion', 'name' => 'Habilitacion'));
?>
<fieldset><legend>Habilitaci&oacute;n de matriculaci&oacute;n (<?php echo $this->session->userdata('Gestion');?>)</legend>

<br /><label for='FechaInicio'>Fecha de inicio </label>
<?php
echo "<input type='text' name='FechaInicio' id='FechaInicio' size='12' maxlength='10' class='required'  onclick='";
echo 'fPopCalendar("FechaInicio")'."' value=''/>";
?><br /><br />

<br /><label for='FechaFin'>Fecha de fin </label>
<?php
echo "<input type='text' name='FechaFin' id='FechaFin' size='12' maxlength='10' class='required' onclick='";
echo 'fPopCalendar("FechaFin")'."' value=''/>";
?><br /><br />

<br /><label for='CodCarrera'>Carrera </label>
<?php echo $this->modelo_carrera->ComboCarrerasHabilitadas(); ?><br /><br />

<label for='DesdeNombre'>Desde nombre </label>
<input type='text' id='DesdeNombre' name='DesdeNombre' size='10' maxlength='10' value='' /><br /><br />

<label for='HastaNombre'>Hasta nombre</label>
<input type='text' id='HastaNombre' name='HastaNombre' size='10' maxlength='10' value='' /><br /><br />

<hr />
<div class='span-3 prefix-5 suffix-4 last center'>
	<button class="button positive">
		<img src="<?php echo base_url(); ?>css/images/icons/tick.png" alt=""> Guardar 
	</button>
</div>

</fieldset>
</form>
</div>