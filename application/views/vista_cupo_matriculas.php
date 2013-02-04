<script type="text/javascript">
$(document).ready(function() {
	$("#CupoMatricula").validate();
});
</script>
<div class="span-10 prefix-7 suffix-7 last center">
<?php 
echo form_open("configuracion/CupoMatriculas",  array('id' => 'CupoMatricula', 'name' => 'CupoMatricula'));
?>
<fieldset><legend>Cupo de matr&iacute;culas (<?php echo $this->session->userdata('Gestion');?>)</legend>

<br /><label for='CodUsuario'>Usuario </label>
<?php echo $this->modelo_usuario->ComboUsuarios('12'); ?><br /><br />

<label for=''>Fecha </label>
<?php
echo "<input type='text' name='Fecha' id='Fecha' size='12' maxlength='10' onclick='";
echo 'fPopCalendar("Fecha")'."' value=''/>";
?><br /><br />
<label for='Desde'>Desde matr&iacute;cula</label>
<input type='text' id='Desde' name='Desde' size='10' class='required number' maxlength='10' value='' /><br /><br />

<label for='Hasta'>Hasta matr&iacute;cula</label>
<input type='text' id='Hasta' name='Hasta' size='10' class='required number' maxlength='10' value='' /><br /><br />

<hr /><br />
<div class='span-3 prefix-4 suffix-3 last center'>
	<button class="button positive">
		<img src="<?php echo base_url(); ?>css/images/icons/tick.png" alt=""> Guardar 
	</button>
</div>

</fieldset>
</form>
</div>