<!-- Stylesheets -->
<?php echo $css; ?>
<!-- Javascript -->
<?php echo $javascript; ?>
<div id='formulario' class='span-14 prefix-5 suffix-5 center last'>
<fieldset><legend>Impresion de matr&iacute;culas</legend>
<?php 
if( validation_errors()!=false ) {  
	echo '<br />'.validation_errors();
}
echo form_open("listados/ImprimeMatricula"); 
?>

<input type="button" onclick="javascript:guarda();" value="Guardar" />
					<input type="button" onclick="javascript:exportar();" value="Exportar diseno" />
					<input type="button" onclick="javascript:resetD();" value="Resetear calibracion" />
					<!--<input type="submit" onclick="javascript:imprime();" value="Imprimir prueba" />-->
					<input type="submit" value="Imprimir prueba" />
					<br />
					Separaci&oacute;n horizontal: <input type="text" name="hs" id="hs" value="<?php echo (isset($espacios['hs']))?$espacios['hs']:''; ?>" /><br />
					Separaci&oacute;n vertical: <input type="text" name="vs" id="vs" value="<?php echo (isset($espacios['vs']))?$espacios['vs']:''; ?>" /><br />
					Margen superior para pie: <input type="text" name="ms" id="ms" value="<?php echo (isset($espacios['ms']))?$espacios['ms']:''; ?>" />
					<br />
					<div id="anverso" style='height:350px'>
						<?php if ($anverso){ echo stripslashes($anverso);} else { ?>
						<div class="draggable">{Apellidos y Nombres}</div>
						<div class="draggable">{Carnet}</div>
						<div class="draggable">{Reg. univ.}</div>
						<div class="draggable">{Carrera}</div>
						<div class="draggable">{Domicilio}</div>
						<div class="draggable">{Fecha}</div>
						<div class="draggable">{Categoria}</div>
						<div class="draggable">{Numero}</div>
						<?php } ?>
					</div>
					<br />
					<div id="reverso" style='height:345px'>
						<?php if ($reverso){ echo stripslashes($reverso);} else { ?>
						<div class="draggable">{Apellidos y Nombres}</div>
						<div class="draggable">{Carnet}</div>
						<div class="draggable">{Reg. univ.}</div>
						<div class="draggable">{Carrera}</div>
						<div class="draggable">{Domicilio}</div>
						<div class="draggable">{Fecha}</div>
						<div class="draggable">{Categoria}</div>
						<div class="draggable">{Numero}</div>
						<?php } ?>
					</div>
<br /><hr />

<button class='button positive' style='margin-left:220px;'>
	<img src='<?php echo base_url();?>css/images/icons/tick.png' alt='' /> Imprimir
</button>
</form>
</fieldset>
</div>