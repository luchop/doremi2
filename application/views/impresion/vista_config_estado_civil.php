<?php include_once('script.inc'); ?>

<div id='formulario' class='span-10 prefix-7 suffix-7 center last'>


<?php 
echo form_open("listados/EstadisticaEstadoCivil", array('id'=>'Formulario')); 
?>
<fieldset><legend>Listado por gesti&oacute;n</legend>
<br />
<label for='Hasta'>Gesti&oacute;n </label>
<?php echo $ComboGestion; ?><br /><br />

<label for='Genero'>G&eacute;nero </label>
<input type="checkbox" id="Varones" name="Varones" <?php echo ($Varones? 'checked':''); ?>/> Varones&nbsp;&nbsp;&nbsp;&nbsp;
<input type="checkbox" id="Mujeres" name="Mujeres" <?php echo ($Mujeres? 'checked':''); ?>/> Mujeres&nbsp;&nbsp;&nbsp;&nbsp;

<br /><br /><hr />
<button class='button positive' style='margin-left:145px;'> 
	<img src='<?php echo base_url();?>css/images/icons/tick.png' alt='' /> Imprimir
</button>
</form>
</fieldset>
</div>