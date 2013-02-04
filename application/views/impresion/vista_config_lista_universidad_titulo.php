<div id='formulario' class='span-10 prefix-7 suffix-7 center last'>
<?php 
if( validation_errors()!=false ) {  
	echo '<br />'.validation_errors();
}
echo form_open("listados/ListaPorUniversidadTitulo"); 
?>
<fieldset><legend>Listado por universidad que expidi&oacute; el t&iacute;tulo</legend>
<br />
<label for='Hasta' style='text-align:right'>Gesti&oacute;n </label>
<?php echo $ComboGestion; ?><br /><br />

<input type="checkbox" id="Varones" name="Varones" <?php echo ($Varones? 'checked':''); ?>/> Varones&nbsp;&nbsp;&nbsp;&nbsp;
<input type="checkbox" id="Mujeres" name="Mujeres" <?php echo ($Mujeres? 'checked':''); ?>/> Mujeres&nbsp;&nbsp;&nbsp;&nbsp;

<br /><br /><hr />
<button class='button positive' style='margin-left:140px;'> 
	<img src='<?php echo base_url();?>css/images/icons/tick.png' alt='' /> Imprimir
</button>
</form>
</fieldset>
</div>