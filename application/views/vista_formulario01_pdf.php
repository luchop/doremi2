<script>
$(document).ready(function() {  
    $("#Imprimir").bind("click",function() {
        setTimeout(function() {
            $("#Cerrar").click();
        }, 4000);
    });
}); 
</script>

<?php echo form_open("formulario_pdf/ImpresionF01/$CodPersona",  array('id' => 'Impresion', 'name' => 'Impresion')); ?>
    <hr />
    <div class='span-10 prefix-7 suffix-7 last center'>
        <h5>Importante!</h5><br />
        <p>Ahora, s&oacute;lo resta que usted imprima el formulario 01 y lo presente en ventanillas de la oficina de Registros y Admisiones de la UPEA</p>
        <!-- <p>Gracias por su colaboraci&oacute;n en las pruebas del nuevo sistema de matriculaci&oacute;n. Con estas pruebas se tomar&aacute;n desiciones respecto al servidor y ancho de banda.</p> -->
    </div>
    <div class='span-3 prefix-9 suffix-12 last center'>
        <button type='submit' value='Imprimir' id='Imprimir' name='submit' class="button positive" style="width:200px">
            <img src="<?php echo base_url(); ?>css/images/icons/tick.png" alt=""> Imprimir Formulario 01 
        </button><br /><br /><br />
        <button type='submit' id='Cerrar' name='submit' value='Cerrar' class="button positive" style="width:200px">
            <img src="<?php echo base_url(); ?>css/images/icons/cross.png" alt=""> Finalizar inscripci&oacute;n 
        </button>
    </div>
    <input type="hidden" name="CodPersona" value="<?php echo $CodPersona;?>" />
    <hr />
</form>