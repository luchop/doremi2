<div  class='span-10 prefix-7 suffix-7 center'>

<?php echo form_open("auditoria/BuscaParaAuditoria",  array('id' => 'Busqueda', 'name' => 'Busqueda')); ?>

<fieldset>
    <legend>Buscar universitario afectado:</legend>
    <br/>
    
    <label>Registro universitario</label><input type="text" size='10' maxlength='11' name="Registro" id="Registro" value="" /><br /><br />
    <label>Apellido : </label>  <input type="text" name="Apellido" id="Apellido" size='20'  maxlength="20" value=""/><br /><br />
    <label>N&uacute;mero de carnet o pasaporte :</label><input type="text" name="Carnet" id="Carnet" maxlength="10" value=""/><br /><br /><hr />
    
    <!-- <input type="button" value="Buscar" name="buscar" id="buscar" class='buttonok' /> -->
    
    <div class='span-3 prefix-4 suffix-3 last center'>
	<button class="button positive">
		<img src="<?php echo base_url(); ?>css/images/icons/tick.png" alt=""> Buscar  
	</button>
</div>
</fieldset>
</form>

<div id="resultado">
</div>

</div>
