<script>
$(document).ready(function(){
   $(":input:first").focus();
 });
</script>

<div class="span-10 prefix-7 suffix-7 last center">
<?php 
if(isset($Modificacion))
	echo form_open("matriculacion/BuscaParaModificar",  array('id' => 'Matricula', 'name' => 'Matricula'));
else
    echo form_open("matriculacion/BuscaParaEliminar",  array('id' => 'Matricula', 'name' => 'Matricula'));
?>

<fieldset><legend>B&uacute;squeda de matr&iacute;cula de estudiante</legend>
<br />
<label for='CI'>C&eacute;dula de identidad </label>
<input type='text' name='CI' id='CI' maxlength='12' size='12' value=''/><br /><br />

<label for='Apellido'>Apellido </label>
<input type='text' name='Apellido' id='Apellido' maxlength='30' size='30' value='' /><br /><br />

<label for='RegUniversitario'>Registro universitario </label>
<input type='text' name='RegUniversitario' id='RegUniversitario' maxlength='12' size='12' value=''/><br /><br />
	  
<br /><hr />
<div class='span-3 prefix-4 suffix-3 last center'>
	<button class="button positive">
		<img src="<?php echo base_url(); ?>css/images/icons/tick.png" alt=""> Buscar  
	</button>
</div>

</fieldset>
</form>
</div>
