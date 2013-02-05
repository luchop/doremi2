<script type="text/javascript">
$(document).ready(function() {
	$("#habilitacion").validate();
});
</script>
<div class="span-10 prefix-7 suffix-7 last center">
<?php 
echo form_open("habilita/edita/".$Fila->CodHabilitacion);
?>
<fieldset><legend>Habilitacion (<?php echo $this->session->userdata('GESTION');?>)</legend>

<input type='hidden' name='CodHabilitacion' id='CodHabilitacion' value='<?php echo $Fila->CodHabilitacion; ?>' />
<br /><label for='FechaInicio'>Fecha de inicio </label>
<?php
echo "<input type='text' name='FechaInicio' id='FechaInicio' size='12' maxlength='10' onclick='";
echo 'fPopCalendar("FechaInicio")'."' value='".FechaDeMySQL($Fila->FechaInicio)."'/>";
?><br /><br />

<br /><label for='FechaFin'>Fecha de fin </label>
<?php
echo "<input type='text' name='FechaFin' id='FechaFin' size='12' maxlength='10' onclick='";
echo 'fPopCalendar("FechaFin")'."' value='".FechaDeMySQL($Fila->FechaFin)."'/>";
?><br /><br />

<br /><label for='CodCarrera'>Carrera </label>
<?php echo $this->modelo_carrera->ComboCarreraHabilitada($Fila->CodCarrera, 'CodCarrera', True, True); ?><br /><br />

<label for='DesdeNombre'>Desde nombre </label>
<input type='text' id='DesdeNombre' name='DesdeNombre' size='10' class='required' maxlength='10' value='<?php echo $Fila->DesdeNombre; ?>' /><br /><br />

<label for='HastaNombre'>Hasta nombre</label>
<input type='text' id='HastaNombre' name='HastaNombre' size='10' class='required' maxlength='10' value='<?php echo $Fila->HastaNombre; ?>' /><br /><br />

<hr /><br />
<div class='span-3 prefix-4 suffix-3 last center'>
	<button class="button positive">
		<img src="<?php echo base_url(); ?>css/images/icons/tick.png" alt=""> Guardar 
	</button>
</div>

</fieldset>
</form>
</div>