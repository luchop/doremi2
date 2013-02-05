<div id='formulario' class='span-8 prefix-8 suffix-8 center last'>
<?php 
if( validation_errors()!=false ) {  
	echo '<br />'.validation_errors();
}
echo form_open("listados/EstadisticaPorCarreraGenero"); 
?>
<fieldset><legend>Estad&iacute;sticas por carrera y edad</legend>
<br />
<label for='Hasta'>Gesti&oacute;n </label>
<?php echo $ComboGestion; ?><br /><br />

<br /><hr />

<button class='button positive' style='margin-left:100px;'>
	<img src='<?php echo base_url();?>css/images/icons/tick.png' alt='' /> Imprimir
</button>
</form>
</fieldset>
</div>