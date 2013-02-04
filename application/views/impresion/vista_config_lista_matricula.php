<div id='formulario' class='span-14 prefix-5 suffix-5 center last'>

<?php 
echo form_open("listados/ListaMatriculas", array('id'=>'Formulario')); 
?>
<fieldset><legend>Listados de matr&iacute;culas</legend>
<br />
<label for='Estado'>Carrera </label>
<?php echo $ComboCarrera; ?><br /><br />

<label for='Hasta'>Gesti&oacute;n </label>
<?php echo $ComboGestion; ?><br /><br />

<br /><hr />

<button class='button positive' style='margin-left:220px;'>
	<img src='<?php echo base_url();?>css/images/icons/tick.png' alt='' /> Imprimir
</button>
</form>
</fieldset>
</div>