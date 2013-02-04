<?php echo form_open("matriculacion/ImprimeMatricula/$CodMatricula",  array('id' => 'Impresion', 'name' => 'Impresion')); ?>
    <div class='span-10 prefix-7 suffix-7 last center'>
        <h5>Importante!</h5><br />
        <p>Por favor, coloque el papel valorado # <strong><?php echo $NumMatricula; ?></strong> en la impresora y presione el bot&oacute;n de abajo.</p>
    </div>
    <div class='span-3 prefix-9 suffix-12 last center'>
        <button type='submit' value='Imprimir' id='Imprimir' name='submit' class="button positive" style="width:200px">
            <img src="<?php echo base_url(); ?>css/images/icons/tick.png" alt=""> Imprimir matr&iacute;cula 
        </button><br /><br /><br />
        <button type='submit' id='Cerrar' name='submit' value='Cerrar' class="button positive" style="width:200px">
            <img src="<?php echo base_url(); ?>css/images/icons/cross.png" alt=""> Cancelar impresi&oacute;n 
        </button>
    </div>
    <input type="hidden" name="CodMatricula" value="<?php echo $CodMatricula;?>" />
    <hr />
</form>